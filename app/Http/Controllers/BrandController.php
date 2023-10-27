<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;

use App\Models\Content;
use App\Models\DefCar;
use App\Models\Repair;
use App\Models\Spare;
use Illuminate\View\View;
//use Illuminate\Http\Request;

class BrandController extends BaseController
{
    use HelperTrait;

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

    public function spares($brand=null, $car=null, $spare=null) :View
    {
        return $this->getIssues('spare', $brand, $car, null, $spare);
    }

    private function getIssues(string $issue, string $brand=null, string $car=null, string $job=null, string $spare=null): View
    {
        $this->activeMenu = $issue;
        if ($brand) {
            if ($car) {
                if ($job) {
                    $this->getItem('repair', new Repair(), $job);
                    $this->getItem('brand', new Brand(), $brand);
                    $this->setSeo($this->data['repair']->seo);

                    if ($car != 'def') $this->getItem('car', new Car(), $car);
                    else $this->data['car'] = null;

                    $this->data['price'] = $this->data['repair']->price;
                    $this->data['old_price'] = $this->data['repair']->old_price ? $this->data['repair']->old_price : $this->data['price'] * 3;

                    $this->data['left_digits'] = [
                        ['top' => 245, 'indent' => 70],
                        ['top' => 200, 'indent' => 55],
                        ['top' => 150, 'indent' => 55],
                        ['top' => 110, 'indent' => 70],
                        ['top' => 75, 'indent' => (strlen((string)$this->data['price']) >= 4) ? 90 : 100],
                        ['top' => 50, 'indent' => (strlen((string)$this->data['price']) >= 4) ? 125 : 135],
                        ['top' => 42, 'indent' => '50%'],
                    ];

                    $this->data['right_digits'] = [
                        ['margin-top' => 287, 'left' => '50%', 'transform' => 'translate(-50%)'],
                        ['margin-top' => 270, 'left' => 115],
                        ['margin-top' => 220, 'left' => 70],
                        ['margin-top' => 160, 'left' => 50],
                        ['margin-top' => 95, 'left' => 70],
                        ['margin-top' => 55, 'left' => 115],
                        ['margin-top' => 40, 'left' => '50%', 'transform' => 'translate(-50%)'],
                        ['margin-top' => 55, 'right' => 110],
                        ['margin-top' => 95, 'right' => 65],
                        ['margin-top' => 160, 'right' => 45],
                        ['margin-top' => 210, 'right' => 60],
                        ['margin-top' => 270, 'right' => 105],
                    ];
                    $this->data['price_step'] = round($this->data['price'] * 2 / 12);
                    return $this->showView('issues.repair');
                } elseif ($spare) {
                    $this->getItem('spare', new Spare(), $spare);
                    $this->setSeo($this->data['spare']->seo);
                    return $this->showView('issues.spare');
                } else {
                    if ($issue == 'repair') {
                        $this->getItem('car', new Car(), $car);
                        if (!count($this->data['car']->repairs)) abort(404, trans('404'));
                        $this->setSeo($this->data['car']->repairs[0]->seo);
                    } else {
                        $this->getItem('car', new Car(), $car);
                        $this->setSeo($this->data['car'][$issue]->seo);
                    }
                    return $this->showView('issues.car');
                }
            } else {
                if ($issue == 'maintenance') {
                    $this->getItem('brand', new Brand(), $brand);
                    if (!count($this->data['brand']->maintenances)) {
                        $this->getDefContent('maintenances');
                        return $this->showView('issues.def_brand');
                    } else {
                        $this->setSeo($this->data['brand']->maintenances[0]->seo);
                        return $this->showView('issues.brand');
                    }
                } else {
                    $this->getItem('brand', new Brand(), $brand);
                    if (!$this->data['brand'][$issue]) {
//                        if ($issue == 'repair') $this->data['price_table'] = Car::find(7)->priceRepairs;
                        $this->getDefContent($issue);
                        return $this->showView('issues.def_brand');
                    } else {
                        $this->setSeo($this->data['brand'][$issue]->seo);
                        return $this->showView('issues.brand');
                    }
                }
            }
        } else {
            // Get default brand page
            $this->data['content'] = Content::where('slug',($issue == 'maintenance' ? 'maintenances' : $issue))->first();
            $this->data['brands'] = Brand::where('active',1)->get();
            $this->setSeo($this->data['content']->seo);
            return $this->showView('issues.def_brand');
        }
    }

    private function getDefContent($slug): void
    {
        $this->data['contents'] = DefCar::where('slug',$slug)->get();
        if (!$this->data['contents']) abort(404, trans('404'));
        $this->data['brands'] = Brand::where('active',1)->get();
        $this->setSeo($this->data['contents'][0]->seo);
    }
}
