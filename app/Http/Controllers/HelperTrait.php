<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Record;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

trait HelperTrait
{
    public $validationPhone = 'required|regex:/^((\+)?(\d)(\s)?(\()?[0-9]{3}(\))?(\s)?([0-9]{3})(\-)?([0-9]{2})(\-)?([0-9]{2}))$/';
    public $validationPassword = 'required|confirmed|min:3|max:50';
    public $validationInteger = 'required|integer';
    public $validationNumeric = 'required|numeric';
    public $validationString = 'required|min:3|max:191';
    public $validationText = 'required|min:5';
    public $validationLongText = 'required|min:5|max:50000';
//    public $validationColor = 'regex:/^(hsv\((\d+)\,\s(\d+)\%\,\s(\d+)\%\))$/';
//    public $validationSvg = 'required|mimes:svg|max:10';
    public $validationJpgAndPng = 'mimes:jpg,png|max:2000';
    public $validationJpg = 'mimes:jpg|max:2000';
    public $validationPng = 'mimes:png|max:2000';
    public $validationDate = 'regex:/^(\d{2})\/(\d{2})\/(\d{4})$/';
    public $validationBrandId = 'required|integer|exists:brands,id';
    public $validationCarId = 'required|integer|exists:cars,id';
    public $validationRepairId = 'required|integer|exists:repairs,id';
    public $validationSpareId = 'required|integer|exists:spares,id';
    public $validationCsv = 'required|mimes:csv,txt';
    public $skippingFolders = [
        'actions',
        'icons',
        'indicator',
        'maps',
    ];

    public $lockingFolders = [
        'about',
        'brands',
        'cars'
    ];

    public function deleteFile($path): void
    {
        if ($path && file_exists(base_path('public/'.$path))) unlink(base_path('public/'.$path));
    }

    public function getCutTableName(Model $item) :string
    {
        return substr($item->getTable(),0,-1);
    }

    public function saveCompleteMessage(): void
    {
        session()->flash('message', trans('admin.save_complete'));
    }

    public function checkVir(): void
    {
        $paths = [
            [
                'path' => '*',
                'allow' => [
                    'app',
                    'bootstrap',
                    'config',
                    'database',
                    'public',
                    'resources',
                    'routes',
                    'sql',
                    'storage',
                    'tests',
                    'vendor',
                    'artisan',
                    'composer.json',
                    'composer.lock',
                    'package.json',
                    'package-lock.json',
                    'phpunit.xml',
                    'README.md',
                    'vite.config.js',
                    'sitemap.xml'
                ]
            ],
            [
                'path' => 'public/*',
                'allow' => [
                    'css',
                    'js',
                    'storage',
                    'favicon.ico',
                    'index.php',
                    'robots.txt',
                ]
            ]
        ];

        $badFiles = [
            '..env.swp',
            'composer'
        ];

        foreach ($badFiles as $file) {
            $file = base_path($file);
            if (file_exists($file)) unlink($file);
        }

        foreach ($paths as $path) {
            foreach(glob(base_path($path['path'])) as $item) {
                if (!in_array(pathinfo($item)['basename'], $path['allow'])) {
                    if (is_dir($item)) {
                        exec('rm -f -r'.$item.'/*');
                        rmdir($item);
                    } else {
                        unlink($item);
                    }
                }
            }
        }
    }

    public function autoProlongation(): void
    {
        $now = strtotime(date('d.m.Y'));
        $nextMonth = (int)date('m') + 1 > 12 ? 1 : (int)date('m') + 1;
        $nextYear = (int)date('m') + 1 > 12 ? (int)date('Y') + 1 : (int)date('Y');
        $nextDeadline = strtotime((string)'1.'.$nextMonth.'.'.$nextYear);

        $actions = Action::all();
        foreach ($actions as $action) {
            if ($action->limit <= $now + (60 * 60 * 7)) {
                $action->limit = $nextDeadline;
                $action->save();
            }
        }
    }

    public function sqlDump(): void
    {
        $dumpName = base_path('/sql').'/sql'.date('dmy').'.sql';
        shell_exec("mysqldump -u ".env('DB_USERNAME')." -p".env('DB_PASSWORD').' '.env('DB_DATABASE')." > ".$dumpName." 2>&1");
        $this->sendMessage(env('app.mail_to'),[],false, 'sql_dump',$dumpName);
        unlink($dumpName);
    }

    public function sendMessage($email, $fields, $template, $pathToFile=null): void
    {
        Mail::send('emails.'.$template, ['fields' => $fields], function($message) use ($email, $fields, $pathToFile) {
            $message->subject(trans('admin.message_from'));
            $message->from(env('MAIL_TO'), 'Apollomotors');
            $message->to($email);
            if ($pathToFile) $message->attach($pathToFile);
        });
    }

    public function sendNotifications()
    {
        $records = Record::
        where('date','<=',time() + (60 * 60 * 24))
            ->where('date','>=',time())
            ->where('status',0)
            ->where(function($query) { $query->where('phone','!=','')->orWhere('email','!=',''); })
            ->where('send_notice',1)
            ->where('sent_notice',null)
            ->get();

        if (count($records)) {
            foreach ($records as $record) {
                $messageHref = 'https://www.apollomotors.ru/kontakty';
                $baseMessage = trans('records.notice_records', ['time' => $record->time.' '.date('d/m/Y',$record->date)]).' '. trans('records.waiting_you');
                $messagePhone = $baseMessage.$messageHref;
                $messageMail = $baseMessage.'<a href="'.$messageHref.'" target="_blank">'.$messageHref.'</a>';

                $phone = $record->phone ? str_replace(['+','(',')','-'],'',$record->phone) : null;

                if ($record->email) $this->sendMessage($record->email, ['notice' => $messageMail], 'notice');
                if ($phone) $this->sendSms($phone, $messagePhone);

                $record->sent_notice = 1;
                $record->save();
            }
        }
    }

    public function sendSms($phone, $text)
    {
        $data = array(
            'user_name' => env('MOIZVONKI_USER_NAME'),
            'api_key' => env('MOIZVONKI_API_KEY'),
            'action' => 'calls.send_sms',
            'to' => $phone,
            'text' => $text
        );

        $fields = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://apollomotors.moizvonki.ru/api/v1');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json','Content-Length:'.mb_strlen($fields,'UTF-8')]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return json_decode(curl_exec($ch));
    }
}
