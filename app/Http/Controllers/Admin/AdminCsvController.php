<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\HelperTrait;
use App\Models\Brand;
use Illuminate\View\View;

class AdminCsvController extends AdminBaseController
{
    use HelperTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function csvFiles(): View
    {
        $this->data['menu_key'] = 'csv_files';
        $this->breadcrumbs[] = $this->menu['csv_files'];

        $this->data['brands'] = Brand::select('id','name_en','name_ru')->get();
        $this->data['csvs_works'] = glob(base_path('public/csvs_works/*.csv'));
        $this->data['csvs_sub_works'] = glob(base_path('public/csvs_sub_works/*.csv'));

        return $this->showView('csv_files');
    }
}
