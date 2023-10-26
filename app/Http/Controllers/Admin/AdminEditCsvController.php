<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\HelperTrait;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Repair;
use App\Models\SubRepair;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminEditCsvController extends AdminEditController
{
    use HelperTrait;

    public function generateCsvWorks(Request $request): RedirectResponse
    {
        $brands = Brand::all();
        foreach ($brands as $brand) {
            if ($request->has('brands_id'.$brand->id) && $request->input('brands_id'.$brand->id)) {
                foreach ($brand->cars as $car) {
                    $fileName = base_path('public/csvs_works/'.str_replace(' ','_',$brand->name_en.'_'.$car->name_en).'_repair.csv');
                    if (file_exists($fileName)) unlink($fileName);
                    $content =
                        'Марка;'.
                        'Модель;'.
                        'Работа;'.
                        'Цена от;'.
                        'Цена;'.
                        'Старая цена;'.
                        'Время работы;'.
                        'Проводить ремонт по достижению лет;'.
                        'Проводить ремонт по достижению пробега;'.
                        'Проводить ремонт по достижению состояния;'.
                        'Бесплатная диагностика;Гарантия'."\n";
                    foreach ($car->priceRepairs as $repair) {
                        $content .=
                            $brand->name_en.';'.
                            $car->name_en.';'.
                            $repair->head.';'.
                            ($repair->price_from ? 'Да' : 'Нет').';'.
                            $repair->price.';'.
                            $repair->old_price.';'.
                            $repair->work_time.';'.
                            $repair->upon_reaching_years.';'.
                            $repair->upon_reaching_mileage.';'.
                            ($repair->upon_reaching_conditions ? 'Да' : 'Нет').';'.
                            ($repair->free_diagnostics ? 'Да' : 'Нет').';'.
                            $repair->warranty_years."\n";
                    }
                    file_put_contents($fileName,$content);
                }
            }
        }
        Session::flash('message',trans('admin.generating_complete'));
        return redirect()->back();
    }

    public function generateCsvSubWorks(Request $request): RedirectResponse
    {
        $brands = Brand::all();
        foreach ($brands as $brand) {
            if ($request->has('brands_id'.$brand->id) && $request->input('brands_id'.$brand->id)) {
                foreach ($brand->cars as $car) {
                    $fileName = base_path('public/csvs_sub_works/' . str_replace(' ', '_', $brand->name_en.'_'.$car->name_en) . '_sub_repair.csv');
                    if (file_exists($fileName)) unlink($fileName);
                    $content =
                        'Марка;'.
                        'Модель;'.
                        'Работа;'.
                        'Под-работа;'.
                        'Цена'."\n";

                    foreach ($car->priceRepairs as $repair) {
                        foreach ($repair->subRepairs as $subRepair) {
                            $content .=
                                $brand->name_en.';'.
                                $car->name_en.';'.
                                $repair->head.';'.
                                $subRepair->name.';'.
                                $subRepair->price."\n";
                        }
                    }
                    file_put_contents($fileName,$content);
                }
            }
        }
        Session::flash('message',trans('admin.generating_complete'));
        return redirect()->back();
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function deleteCsvWorks(Request $request): RedirectResponse
    {
        $this->authorize('delete');
        $this->deleteCsv($request,'csvs_works');
        return redirect()->back();
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function deleteCsvSubWorks(Request $request): RedirectResponse
    {
        $this->authorize('delete');
        $this->deleteCsv($request,'csvs_sub_works');
        return redirect()->back();
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function repairParserWorks(Request $request): RedirectResponse
    {
        $this->authorize('edit');
        $this->validate($request, ['csv_works' => $this->validationCsv]);
        $data = $this->fistProcessingRepairParser($request,'csv_works');

        foreach ($data as $k => $row) {
            if (mb_strlen($row,'UTF-8')) {
                if (preg_match('/^(\w{4,11};.+?;.+?;(Да|Нет);\d+;(\d+)?;(\d+\.(0|5));(\d+)?;(\d+)?;(Да|Нет);(Да|Нет);(\d+\.(0|5)))/ui',$row)) {
                    $cells = explode(';',$row);
                    list($car,$repair) = $this->getParserData($cells,new Repair(),'head');
                    $fields = [
                        'price_from' => (trim($cells[3]) == 'Да'),
                        'price' => (int)$cells[4],
                        'old_price' => $cells[5] ? (int)$cells[5] : 0,
                        'work_time' => (double)$cells[6],
                        'upon_reaching_years' => $cells[7] ? (int)$cells[7] : 0,
                        'upon_reaching_mileage' => $cells[8] ? (int)$cells[8] : 0,
                        'upon_reaching_conditions' => (trim($cells[9]) == 'Да'),
                        'free_diagnostics' => (trim($cells[10]) == 'Да'),
                        'warranty_years' => (double)$cells[11]
                    ];
                    if ($repair) $repair->update($fields);
                    elseif ($car) $this->createRepairForParser($cells[2], $car->id);
                } else return redirect()->back()->withErrors(['csv_works' => trans('validation.wrong_row_format',['row' => ($k+1)])]);
            }
        }
        Session::flash('message',trans('admin.save_complete'));
        return redirect(route('admin.csv_files'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function repairParserSubWorks(Request $request): RedirectResponse
    {
        $this->authorize('edit');
        $this->validate($request, ['csv_sub_works' => $this->validationCsv]);
        $data = $this->fistProcessingRepairParser($request,'csv_sub_works');

        foreach ($data as $k => $row) {
            if (mb_strlen($row, 'UTF-8')) {
                if (preg_match('/(\w{4,11};.+?;.+?;.+?;\d+)/ui', $row)) {
                    $cells = explode(';', $row);
                    list($car,$repair) = $this->getParserData($cells,new Repair(),'head');
                    $fields = [
                        'name' => $cells[3],
                        'price' => (int)$cells[4]
                    ];
                    if ($repair) {
                        $subRepair = SubRepair::where('name',$cells[3])->where('repair_id',$repair->id)->first();
                        if ($subRepair) $subRepair->update($fields);
                        else {
                            $fields['repair_id'] = $repair->id;
                            SubRepair::create($fields);
                        }
                    } elseif ($car) {
                        $repair = $this->createRepairForParser($cells[2], $car->id);
                        $fields['repair_id'] = $repair->id;
                        SubRepair::create($fields);
                    }
                } else return redirect()->back()->withErrors(['csv_sub_works' => trans('validation.wrong_row_format',['row' => ($k+1)])]);
            }
        }
        Session::flash('message',trans('admin.save_complete'));
        return redirect(route('admin.csv_files'));
    }

    private function deleteCsv(Request $request, $path): void
    {
        $files = glob(base_path('public/'.$path.'/*'));
        $matches = false;
        foreach ($files as $file) {
            if ($request->input(pathinfo($file)['filename'])) {
                unlink($file);
                $matches = true;
            }
        }
        if ($matches) Session::flash('message',trans('admin.deleting_complete'));
        else Session::flash('message',trans('admin.deleting_not_complete'));
    }

    private function fistProcessingRepairParser(Request $request, $fileName): array
    {
        $data = explode("\n",file_get_contents($request->file($fileName)));
        for($i=0;$i<1;$i++) {
            unset($data[$i]);
        }
        return $data;
    }

    private function getParserData($cells, Model $model, $fieldName): array
    {
        $data = false;
        $car = null;
        if ($cells && count($cells) > 3) {
            $car = Car::where('name_en',$cells[1])->orWhere('name_ru',$cells[1])->first();
            if ($car) $data = $model->where($fieldName,$cells[2])->where('car_id',$car->id)->first();
        }
        return [$car,$data];
    }

    private function createRepairForParser($head, $carId): Collection
    {
        $fields['head'] = $head;
        $fields['text'] = '';
        $fields['car_id'] = $carId;
        $repair = Repair::create($fields);
        return $repair;
    }
}
