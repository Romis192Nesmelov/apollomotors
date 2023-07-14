<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\Repair;
use App\Models\Spare;
use Illuminate\View\View;
//use Illuminate\Http\Request;

class BrandController extends BaseController
{
    use HelperTrait;

//    public function parser()
//    {
//        return view('parser', ['spares' => Spare::all()]);
//    }

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
                    if (!$this->data['repair'] = Repair::where('slug',$job)->first()) abort(404, trans('404'));
                    $this->setSeo($this->data['repair']->seo);
                    return $this->showView('issues.repair');
                } else {
                    if (!$this->data['car'] = Car::where('slug',$car)->first()) abort(404, trans('404'));

                    if ($issue == 'repair') $this->setSeo($this->data['car']->repairs[0]->seo);
                    else $this->setSeo($this->data['car'][$issue]->seo);

                    return $this->showView('issues.car');
                }
            } else {
                if (!$this->data['brand'] = Brand::where('slug',$brand)->first()) abort(404, trans('404'));

                if ($issue == 'maintenance') $this->setSeo($this->data['brand']->maintenances[0]->seo);
                else $this->setSeo($this->data['brand'][$issue]->seo);

                return $this->showView('issues.brand');
            }
        } else {
            // TODO: Get general repair page
            return $this->showView('brand');
        }
    }
}
