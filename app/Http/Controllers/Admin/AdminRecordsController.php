<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mechanic;
use App\Models\MissingMechanic;
use App\Models\Record;
use App\Models\User;
use App\Models\Brand;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminRecordsController extends AdminBaseController
{
    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function mechanics(Request $request, $slug=null): View
    {
        $this->data['menu_key'] = 'mechanics';
        $this->breadcrumbs[] = [
            'href' => 'admin.mechanics',
            'params' => [],
            'name' => trans('admin_menu.mechanics'),
        ];
        return $this->getSomething(
            $request,
            'mechanic',
            'name',
            new Mechanic(),
            $slug
        );
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function records(Request $request, $slug=null): View
    {
        $this->authorize('records');
        $this->data['menu_key'] = 'records';
        $this->breadcrumbs[] = $this->menu['records'];
        $this->data['points'] = [];
        for($i=1;$i<=7;$i++) {
            $this->data['points'][] = ['val' => $i, 'descript' => trans('records.point'.$i)];
        }

        if ($request->has('id')) {
            $this->data['record'] = Record::findOrFail($request->id);

            $this->authorize('records');

            $this->data['date'] = $this->data['record']->date;
            $this->breadcrumbs[] = [
                'href' => 'admin.records',
                'params' => ['time' => $this->data['date']],
                'name' => trans('records.records_by').date('d.m.Y',$this->data['date']),
            ];
            $this->breadcrumbs[] = [
                'href' => 'admin.records',
                'params' => ['id' => $request->id],
                'name' => trans('records.record_by',['time' => $this->data['record']->time]).date('d.m.Y', $this->data['record']->date),
            ];
            $this->getRecordsData();
            $this->getMissingMechanics();
            return $this->showView('record');
        } elseif ($request->has('date') && !$slug) {
            $this->data['date'] = $request->input('date');
            $this->breadcrumbs[] = [
                'href' => 'admin.records',
                'params' => ['time' => $this->data['date']],
                'name' => trans('records.records_by').date('d.m.Y',$this->data['date']),
            ];
            $this->getRecordsData();
            $this->getMissingMechanics();
            return $this->showView('record');
        } elseif ($slug && $slug == 'add') {
            $this->breadcrumbs[] = [
                'href' => 'admin.records',
                'params' => ['slug' => 'add'],
                'name' => trans('records.adding_record'),
            ];
            $this->data['record'] = 0;
            $this->data['date'] = $request->input('date');
            $this->getMissingMechanics();
            $this->getRecordsData();
            return $this->showView('record');
        } else {
            $this->data['date'] = strtotime(date('m/d/Y'));
            $this->getMissingMechanics();
            $slugIsYear = $slug && preg_match('/^20(\d){2}$/',$slug);
            $this->data['year'] = $slugIsYear ? $slug : date('Y');
            $nextYear = $slugIsYear ? $slug+1 : (int)date('Y')+1;
            $baseDate = '1 January ';
            $records = Record::where('date','>=',strtotime($baseDate.$this->data['year']))->where('date','<',strtotime($baseDate.$nextYear))->orderBy('date','desc')->orderBy('time')->get();
            $this->data['records'] = [];
            for($m=12;$m>=1;$m--) {
                foreach ($records as $record) {
                    $recordMonth = date('n',$record->date);
                    $recordDay = date('j',$record->date);
                    if ($m == $recordMonth) {
                        $this->data['records'][$recordMonth][$recordDay][] = $record;
                    }
                }
            }
            $this->data['years'] = [];
            for($y=2010;$y<=(int)date('Y');$y++) {
                if (Record::where('date','>=',strtotime($baseDate.$y))->where('date','<',strtotime($baseDate.($y+1)))->count()) $this->data['years'][] = $y;
            }
            if (date('m') >= 10) $this->data['years'][] = (int)date('Y') + 1;
            return $this->showView('records');
        }
    }

    private function getRecordsData()
    {
        $this->data['cars'] = [];
        $brands = Brand::where('active',1)->get();
        foreach ($brands as $brand) {
            foreach ($brand->cars as $car) {
                if ($car->active) $this->data['cars'][$car->id] = ucfirst($brand['name_'.app()->getLocale()]).' '.$car['name_'.app()->getLocale()];
            }
        }
        $this->data['records'] = Record::where('date',$this->data['date'])->orderBy('time')->get();
        $this->data['times'] = ['','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00'];
    }

    private function getMissingMechanics()
    {
        $this->data['mechanics'] = Mechanic::where('active',1)->orderBy('name')->get();
        $missingMechanics = MissingMechanic::where('date',$this->data['date'])->first();
        $this->data['missing_mechanics'] = $missingMechanics ? $missingMechanics->mechanics->pluck('id')->toArray() : [];
    }
}
