<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;

use App\Models\Mechanic;
use App\Models\MechanicMissingMechanic;
use App\Models\MissingMechanic;
use App\Models\Record;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use JetBrains\PhpStorm\ArrayShape;

class AdminEditRecordController extends AdminEditController
{
    use HelperTrait;

    public function editMechanic(Request $request): RedirectResponse
    {
        $this->editSomething(
            $request,
            ['name' => $this->validationString],
            new Mechanic()
        );
        return redirect(route('admin.mechanics'));
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function editMissingMechanics(Request $request): RedirectResponse
    {
        $this->authorize('edit');
        $fields = $this->validate($request, [
            'date' => $this->validationInteger,
            'missing_mechanics' => 'nullable|array'
        ]);

        if (isset($fields['missing_mechanics']) && count($fields['missing_mechanics'])) {
            $missingMechanic = MissingMechanic::where('date',$fields['date'])->first();
            if ($missingMechanic) $missingMechanic->mechanics()->sync($fields['missing_mechanics']);
            else {
                $insertArr = [];
                $missingMechanic = MissingMechanic::create(['date' => $fields['date']]);
                foreach ($fields['missing_mechanics'] as $id) {
                    $insertArr[] = ['mechanic_id' => $id, 'missing_mechanic_id' => $missingMechanic->id];
                }
                MechanicMissingMechanic::insert($insertArr);
            }
        }

        $this->saveCompleteMessage();
        return redirect(route('admin.records', ['date' => $fields['date']]));
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function editRecord(Request $request): RedirectResponse
    {
        $validateArr = [
            'point' => 'required|integer|min:1|max:7',
            'title' => $this->validationString,
            'phone' => str_replace('required','nullable',$this->validationPhone),
            'time' => 'regex:/^((\d){2}:(\d){2})$/',
            'status' => 'nullable|integer|min:0|max:5',
//            'duration' => 'regex:/^((\d){1,2}:(\d){2})$/'
        ];

        $fields = [
            'send_notice' => ($request->input('send_notice') ? 1 : 0),
            'date' => $this->convertTimestamp($request->input('date')),
            'duration' => $request->input('duration')
        ];

        if ($request->input('email')) $validateArr['email'] = 'email';
        if ($request->input('car')) {
            $validateArr['car'] = 'min:2|max:255';
            $fields['car_id'] = null;
        } else {
            $validateArr['car_id'] = 'required|integer|exists:cars,id';
            $fields['car'] = null;
        }

        $startTime = $this->convertTime($request->input('time'));
        $endTime = $startTime + $this->convertTime($request->input('duration'));
        $sendNotice = false;
        if ($endTime > 21) {
            $timeParts = explode('.',(21-$startTime));
            $fields['duration'] = $timeParts[0].':'.(isset($timeParts[1]) ? '30' : '00');
        }

        if ($request->has('id')) {
            $fields = array_merge($fields, $this->validate($request, $validateArr));
            $record = Record::findOrFail($request->input('id'));
            $this->authorize('owner',$record);

            if ($this->checkBusyRecord($fields,$record->id) ) {
                return redirect(route('admin.records',['id' => $record->id]).'#record')->withInput()->withErrors($this->getBusyRecordErrors());
            }

            if ($record->status != 2 && $fields['status'] == 2) $sendNotice = 1;
            elseif ($record->status != 3 && $fields['status'] == 3) $sendNotice = 2;

            $record->update($fields);
        } else {
            $fields = array_merge($fields, $this->validate($request, $validateArr));
            if (!$this->checkRecordTime($fields['date'])) abort(403, trans('content.403'));
            if ($this->checkBusyRecord($fields))
                return redirect(route('admin.records',['slug' => 'add', 'date' => $fields['date']]).'#record')->withInput()->withErrors($this->getBusyRecordErrors());
            else $record = Record::create($fields);

            if ($record->status == 2) $sendNotice = 1;
            elseif ($record->status == 3) $sendNotice = 2;
        }

        $phone = $record->phone ? str_replace(['+','(',')','-'],'',$record->phone) : null;
        if ($sendNotice && $sendNotice == 2 && $record->email) {
            $this->sendMessage($record->email, [], 'work_is_done');
        }

        if ($sendNotice && $sendNotice == 2 && $phone && $request->input('send_notice_now')) {
            $this->sendSms($phone, trans('admin_content.work_is_done'));
        }

        $this->saveCompleteMessage();
        return redirect(route('admin.records',['date' => $record->date]));
    }

    /**
     * @throws AuthorizationException
     */
    public function deleteRecord(Request $request): RedirectResponse
    {
        $record = Record::findOrFail($request->input('id'));
        $this->authorize('owner',$record);
        $record->status = 5;
        $record->user_id = auth()->user()->id;
        $record->save();
        session()->flash('message', trans('admin.delete_complete'));
        return redirect(route('admin.records', ['date' => $record->date]));
    }

    private function getMissingMechanics(): void
    {
        $this->data['mechanics'] = Mechanic::where('active',1)->orderBy('name')->get();
        $this->data['missing_mechanics'] = MissingMechanic::where('date',$this->data['date'])->pluck('mechanic_id')->toArray();
    }

    private function checkBusyRecord($fields,$id=null): bool
    {
        $records = Record::where('date',$fields['date'])->where('point',$fields['point'])->get();
        $checkingStatTime = $this->convertTime($fields['time']);
        $checkingEndTime = $checkingStatTime + $this->convertTime($fields['duration']);
        $matches = false;
        foreach ($records as $record) {
            $currentStartTime = $this->convertTime($record->time);
            $currentEndTime = $currentStartTime + $this->convertTime($record->duration);
            if (
                (
                    ($checkingStatTime >= $currentStartTime && $checkingStatTime < $currentEndTime)
                    ||
                    ($checkingStatTime < $currentStartTime && $checkingEndTime > $currentEndTime)
                    ||
                    ($checkingEndTime > $currentStartTime && $checkingEndTime <= $currentEndTime)
                )
                &&
                (!$id || $id != $record->id)
                &&
                $record->status != 5
            ) {
                $matches = true;
                break;
            }
        }
        return $matches;
    }

    #[ArrayShape(['date' => "mixed", 'time' => "mixed", 'point' => "mixed", 'duration' => "mixed"])]
    private function getBusyRecordErrors(): array
    {
        return [
            'date' => trans('records.busy'),
            'time' => trans('records.busy'),
            'point' => trans('records.busy'),
            'duration' => trans('records.busy')
        ];
    }

    private function checkRecordTime($date): int
    {
        return strtotime(date('m').'/'.date('d').'/'.date('Y')) <= $date;
    }

    private function convertTime($time): int
    {
        $parts = explode(':',$time);
        return (double)$parts[0]+($parts[1] == '30' ? 0.5 : 0);
    }
}
