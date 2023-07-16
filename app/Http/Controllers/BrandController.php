<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;

use App\Models\Repair;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;
//use Illuminate\Http\Request;

class BrandController extends BaseController
{
    use HelperTrait;

    public function parser()
    {
//        $images = [];
//        $repairImages = RepairImage::all();
//        foreach ($repairImages as $repairImage) {
//            $image = Image::find($repairImage->image_id);
//            if ($image) {
//                $images[] = [
//                    'image' => $image->real,
//                    'repair_id' => $repairImage->repair_id
//                ];
//            }
//        }
//        return view('parser', ['items' => RecommendedWork::all()]);
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function repair($brand=null, $car=null, $job=null) :View
    {
        return $this->getIssues('repair', $brand, $car, $job);
    }

    public function maintenance($brand=null, $car=null) :View
    {
        return $this->getIssues('maintenance', $brand, $car, null);
    }

    public function spares($brand=null, $car=null) :View
    {
        return $this->getIssues('spare', $brand, $car, null);
    }

    private function getIssues(string $issue, string $brand=null, string $car=null, string $job=null): View
    {
        $this->activeMenu = $issue;
        if ($brand) {
            if ($car) {
                if ($job) {
                    $this->getItem('repair', null, new Repair(), $job);
                    $this->setSeo($this->data['repair']->seo);

                    $this->data['price'] = $this->data['repair']->price;
                    $this->data['old_price'] = $this->data['repair']->old_price ? $this->data['repair']->old_price : $this->data['price'] * 3;

                    $this->data['left_digits'] = [
                        ['top' => 245, 'indent' => 65],
                        ['top' => 200, 'indent' => 50],
                        ['top' => 150, 'indent' => 50],
                        ['top' => 110, 'indent' => 65],
                        ['top' => 75, 'indent' => (strlen((string)$this->data['price']) >= 4) ? 80 : 95],
                        ['top' => 50, 'indent' => (strlen((string)$this->data['price']) >= 4) ? 125 : 135],
                        ['top' => 42, 'indent' => '50%'],
                    ];

                    $this->data['price_step'] = $this->data['price'] * 2 / count($this->data['left_digits']);
                    if ($this->data['price_step'] < 1) $this->data['price_step'] = 100;
                    return $this->showView('issues.repair');
                } else {
                    $this->getItem('car', ($issue == 'repair' ? 'repairs' : $issue), new Car(), $car);
                    if ($issue == 'repair') $this->setSeo($this->data['car']->repairs[0]->seo);
                    else $this->setSeo($this->data['car'][$issue]->seo);
                    return $this->showView('issues.car');
                }
            } else {
                $this->getItem('brand', ($issue == 'maintenance' ? 'maintenances' : $issue), new Brand(), $brand);
                if ($issue == 'maintenance') $this->setSeo($this->data['brand']->maintenances[0]->seo);
                else $this->setSeo($this->data['brand'][$issue]->seo);
                return $this->showView('issues.brand');
            }
        } else {
            // TODO: Get general repair page
            return $this->showView('brand');
        }
    }

    private function getItem(string $itemName, $relations, Model $model, $slug)
    {
        $this->data[$itemName] = $model->where('slug',$slug)->where('active',1)->first();
        if (!$this->data[$itemName] || ($relations && !$this->data[$itemName][$relations]))
            abort(404, trans('404'));
    }
}
