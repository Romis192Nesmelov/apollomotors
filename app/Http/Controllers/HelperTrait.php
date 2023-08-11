<?php

namespace App\Http\Controllers;

use App\Models\Action;

trait HelperTrait
{
    public $validationPhone = 'required|regex:/^((\+)?(\d)(\s)?(\()?[0-9]{3}(\))?(\s)?([0-9]{3})(\-)?([0-9]{2})(\-)?([0-9]{2}))$/';
    public $validationPassword = 'required|confirmed|min:3|max:50';
    public $validationInteger = 'required|integer';
    public $validationString = 'required|min:3|max:255';
    public $validationText = 'required|min:5|max:3000';
    public $validationLongText = 'required|min:5|max:50000';
//    public $validationColor = 'regex:/^(hsv\((\d+)\,\s(\d+)\%\,\s(\d+)\%\))$/';
//    public $validationSvg = 'required|mimes:svg|max:10';
    public $validationJpgAndPng = 'mimes:jpg,png|max:2000';
    public $validationJpg = 'mimes:jpg|max:2000';
    public $validationPng = 'mimes:png|max:2000';
    public $validationDate = 'regex:/^(\d{2})\/(\d{2})\/(\d{4})$/';

    public function saveCompleteMessage()
    {
        session()->flash('message', trans('admin.save_complete'));
    }

    public function checkVir()
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

    public function autoProlongation()
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

    public function sqlDump()
    {
        $dumpName = base_path('/sql').'/sql'.date('dmy').'.sql';
        shell_exec("mysqldump -u ".env('DB_USERNAME')." -p".env('DB_PASSWORD').' '.env('DB_DATABASE')." > ".$dumpName." 2>&1");
        $this->sendMessage(env('app.mail_to'),[],false, 'sql_dump',$dumpName);
        unlink($dumpName);
    }
}
