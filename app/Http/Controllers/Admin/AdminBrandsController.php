<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\HelperTrait;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Repair;

use App\Models\Spare;
use App\Models\SubRepair;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class AdminBrandsController extends AdminBaseController
{
    use HelperTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function brands(Request $request, $slug=null): View
    {
        return $this->getSomething(
            $request,
            'brand',
            'name_'.app()->getLocale(),
            new Brand(),
            $slug
        );
    }

    public function brandRepair(Request $request): View
    {
        return $this->getRMS($request, new Brand(), $request->id, 'repair');
    }

    public function brandMaintenances(Request $request): View
    {
        return $this->getRMS($request, new Brand(), $request->id, 'maintenances');
    }

    public function brandSpare(Request $request): View
    {
        return $this->getRMS($request, new Brand(), $request->id, 'spare');
    }

    public function cars(Request $request, $slug=null): View
    {
        return $this->getSomething(
            $request,
            'car',
            'name_'.app()->getLocale(),
            new Car(),
            $slug,
            'brand',
            'name_'.app()->getLocale(),
            new Brand(),
        );
    }

    public function carRepairs(Request $request): View
    {
        return $this->getRMS($request, new Car(), $request->id, 'repairs');
    }

    public function carMaintenance(Request $request): View
    {
        return $this->getRMS($request, new Car(), $request->id, 'maintenance');
    }

    public function carSpare(Request $request): View
    {
        return $this->getRMS($request, new Car(), $request->id, 'spare');
    }

    public function spares(Request $request, $slug=null): View
    {
        return $this->getSomething(
            $request,
            'spare',
            'head',
            new Spare(),
            $slug,
            'car',
            'name_'.app()->getLocale(),
            new Car(),
            'brand',
            'name_'.app()->getLocale(),
        );
    }

    public function repairs(Request $request, $slug=null): View
    {
        if ($request->has('id')) {
            $this->data['repair'] = Repair::findOrFail($request->input('id'));
            $this->data['free_works_count'] = count($this->getRepairRelationsFree(new Repair(), 'recommendedWorks', 'work_id'));
            $this->data['free_spares_count'] = count($this->getRepairRelationsFree(new Repair(), 'recommendedWorks', 'spare_id'));
        }

        return $this->getSomething(
            $request,
            'repair',
            'head',
            new Repair(),
            $slug,
            'car',
            'name_'.app()->getLocale(),
            new Car(),
            'brand',
            'name_'.app()->getLocale(),
        );
    }

    public function subRepairs(Request $request, $slug=null): View
    {
        return $this->getSomething(
            $request,
            'sub_repair',
            'name',
            new SubRepair(),
            $slug,
            'repair',
            'head',
            new Repair(),
            'car',
            'name_'.app()->getLocale(),
            'brand',
            'name_'.app()->getLocale(),
        );
    }

    public function recommendedWorks(Request $request): View
    {
        $this->getRepairSomething($request->input('parent_id'),'recommended_work');
        $this->data['free_works'] = $this->getRepairRelationsFree(new Repair(), 'recommendedWorks', 'work_id');
        return $this->showView('recommended_work');
    }

    public function repairImages(Request $request): View
    {
        $this->getRepairSomething($request->input('parent_id'),'repair_image');
        return $this->showView('repair_image');
    }

    public function repairSpares(Request $request): View
    {
        $this->getRepairSomething($request->input('parent_id'),'repair_spare');
        $this->data['free_spares'] = $this->getRepairRelationsFree(new Spare(), 'repairSpares', 'spare_id');
        return $this->showView('repair_spare');
    }

    private function getRMS(Request $request, Model $model, int $id, string $relationName): View
    {
        $itemName = $this->getCutTableName($model);
        $this->data['item'] = $model->findOrFail($id);
        $this->data['relation'] = $relationName;
        $this->data['route'] = route('admin.edit_'.$itemName.'_'.$relationName);
        $this->data['menu_key'] = 'brands';

        $this->breadcrumbs[] = $this->menu['brands'];
        if ($model instanceof Car) {
            $this->breadcrumbs[] = [
                'href' => $this->menu['brands']['href'],
                'params' => ['id' => $this->data['item']->brand->id],
                'name' => trans('admin.'.(Gate::allows('edit') ? 'edit_' : 'view_').'brand', ['brand' => $this->data['item']->brand['name_'.app()->getLocale()]]),
            ];
            $this->getBreadcrumbs(
                'car',
                'name_'.app()->getLocale(),
                ['parent_id' => $this->data['item']->brand->id, 'id' => $this->data['item']->id],
                'item'
            );
        } else {
            $this->getBreadcrumbs(
                'brand',
                'name_'.app()->getLocale(),
                ['id' => $this->data['item']->id],
                'item'
            );
        }

        $this->breadcrumbs[] = [
            'id' => 'rmp_',
            'href' => 'admin.'.$itemName.'_'.$relationName,
            'params' => ['id' => $this->data['item']->id],
            'name' => trans('admin.'.$itemName.'_'.$relationName),
        ];

        return $this->showView('rms');
    }

    private function getRepairSomething(int $parentId, string $key): void
    {
        $this->data['menu_key'] = 'brands';
        $this->data['repair'] = Repair::findOrFail($parentId);

        $this->breadcrumbs[] = [
            'id' => 'brands',
            'href' => 'admin.brands',
            'name' => trans('admin_menu.brands'),
        ];

        $this->breadcrumbs[] = [
            'id' => 'brand',
            'href' => 'admin.brands',
            'params' => ['id' => $this->data['repair']->car->brand_id],
            'name' => trans('admin.edit_brand',['brand' => $this->data['repair']->car->brand['name_'.app()->getLocale()]]),
        ];

        $this->breadcrumbs[] = [
            'id' => 'car',
            'href' => 'admin.cars',
            'params' => ['id' => $this->data['repair']->car_id, 'parent_id' => $this->data['repair']->car->brand_id],
            'name' => trans('admin.edit_car',['car' => $this->data['repair']->car['name_'.app()->getLocale()]]),
        ];

        $this->breadcrumbs[] = [
            'id' => 'repair',
            'href' => 'admin.repairs',
            'params' => ['id' => $this->data['repair']->id, 'parent_id' => $this->data['repair']->car_id],
            'name' => trans('admin.edit_repair',['repair' => $this->data['repair']->head]),
        ];

        $this->breadcrumbs[] = [
            'id' => 'add_recommended_work',
            'href' => 'admin.'.$key.'s',
            'params' => ['slug' => 'add', 'parent_id' => $this->data['repair']->id],
            'name' => trans('admin.adding_'.$key),
        ];
    }

    private function getRepairRelationsFree(Model $model, string $repairRelation, string $field): Collection
    {
        return $model->where('car_id',$this->data['repair']->car_id)->whereNotIn('id',$this->data['repair'][$repairRelation]->pluck($field)->toArray())->get();
    }
}
