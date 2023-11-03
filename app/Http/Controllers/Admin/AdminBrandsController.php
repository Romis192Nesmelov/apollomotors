<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\HelperTrait;
use App\Models\Brand;
use App\Models\Car;
use App\Models\DefCar;
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

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function brands(Request $request, $slug=null): View
    {
        $this->getFirstBreadcrumbBrand();
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

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function cars(Request $request, $slug=null): View
    {
        $this->getFirstBreadcrumbBrand();
        if ($request->has('id')) {
            $this->data['car'] = Car::findOrFail($request->input('id'));
            $this->getSecondBreadcrumbBrand($this->data['car']->brand);
        } else {
            $this->getSecondBreadcrumbBrand(Brand::findOrFail($request->input('parent_id')));
        }
        $this->data['brands'] = Brand::all();

        return $this->getSomething(
            $request,
            'car',
            'name_'.app()->getLocale(),
            new Car(),
            $slug
        );
    }

    public function defCars(Request $request, $slug=null): View
    {
        $this->data['menu_key'] = 'def_cars';
        $this->breadcrumbs[] = $this->menu['def_cars'];

        if ($slug) {
            $this->data['content'] = DefCar::where('slug',$slug)->get();
            $this->breadcrumbs[] = [
                'href' => $this->menu['def_cars']['href'],
                'params' => ['slug' => $this->data['content'][0]->slug],
                'name' => trans('admin.'.(Gate::allows('edit') ? 'edit_def_car' : 'view_def_car'), ['def_car' => $this->data['content'][0]->head]),
            ];
            return $this->showView('def_car_content');
        } else {
            $this->data['contents'] = DefCar::all()->unique('slug');
            return $this->showView('def_car_contents');
        }
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
        $this->getFirstBreadcrumbBrand();
        if ($request->has('id')) {
            $this->data['spare'] = Spare::findOrFail($request->input('id'));
            $this->getSecondBreadcrumbBrand($this->data['spare']->car->brand);
            $this->getFirstBreadcrumbCar($this->data['spare']->car);
        } else {
            $car = Car::findOrFail($request->input('parent_id'));
            $this->getSecondBreadcrumbBrand($car->brand);
            $this->getFirstBreadcrumbCar($car);
        }
        $this->data['cars'] = Car::all();

        return $this->getSomething(
            $request,
            'spare',
            'head',
            new Spare(),
            $slug
        );
    }

    public function repairs(Request $request, $slug=null): View
    {
        $this->getFirstBreadcrumbBrand();
        if ($request->has('id')) {
            $this->getFreeWorksCountForRepair($request->id);
            $this->data['repair'] = Repair::findOrFail($request->input('id'));
            $this->getSecondBreadcrumbBrand($this->data['repair']->car->brand);
            $this->getFirstBreadcrumbCar($this->data['repair']->car);
        } else {
            $car = Car::findOrFail($request->input('parent_id'));
            $this->getSecondBreadcrumbBrand($car->brand);
            $this->getFirstBreadcrumbCar($car);
        }
        $this->data['cars'] = Car::all();

        return $this->getSomething(
            $request,
            'repair',
            'head',
            new Repair(),
            $slug
        );
    }

    public function subRepairs(Request $request, $slug=null): View
    {
        $this->getFirstBreadcrumbBrand();
        if ($request->has('id')) {
            $this->data['sub_repair'] = SubRepair::findOrFail($request->input('id'));
            $this->getSecondBreadcrumbBrand($this->data['sub_repair']->repair->car->brand);
            $this->getFirstBreadcrumbCar($this->data['sub_repair']->repair->car);
            $this->getFirstBreadcrumbRepair($this->data['sub_repair']->repair);
        } else {
            $repair = Repair::findOrFail($request->input('parent_id'));
            $this->getSecondBreadcrumbBrand($repair->car->brand);
            $this->getFirstBreadcrumbCar($repair->car);
            $this->getFirstBreadcrumbRepair($repair);
        }
        $this->data['repairs'] = Repair::all();

        return $this->getSomething(
            $request,
            'sub_repair',
            'name',
            new SubRepair(),
            $slug
        );
    }

    public function repairImages(Request $request): View
    {
        $this->getRepairSomething($request->input('parent_id'),'repair_image');
        return $this->showView('repair_image');
    }

    public function recommendedWorks(Request $request): View
    {
        $this->getRepairSomething($request->input('parent_id'),'recommended_work');
        $this->data['free_works'] = $this->getRepairRelationsFree(new Repair(), 'recommendedWorks', 'work_id');
        return $this->showView('recommended_work');
    }

    public function repairSpares(Request $request): View
    {
        $this->getRepairSomething($request->input('parent_id'),'repair_spare');
        $this->data['free_spares'] = $this->getRepairRelationsFree(new Spare(), 'repairSpares', 'spare_id');
        return $this->showView('repair_spare');
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function defRepairs(Request $request, $slug=null): View
    {
        if ($request->has('id')) $this->getFreeWorksCountForRepair($request->id);
        $this->data['def_mode'] = true;
        $this->getFirstBreadcrumbDefCar();
        if ($request->has('id')) {
            $this->getSecondBreadcrumbDefCar();
        } else if ($slug && $slug == 'add') {
            $this->authorize('edit');
            $this->breadcrumbs[] = [
                'href' => 'admin.def_repairs',
                'params' => ['slug' => 'add'],
                'name' => trans('admin.adding_repair'),
            ];
        }
        return $this->showView('repair');
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function defSubRepairs(Request $request, $slug=null): View
    {
        $this->getRepair($request->input('parent_id'));
        $this->getFirstBreadcrumbDefCar();
        $this->getSecondBreadcrumbDefCar();
        $this->data['repairs'] = Repair::where('active',1)->get();;

        if ($request->has('id')) {
            $this->data['sub_repair'] = SubRepair::findOrFail($request->input('id'));
            $this->breadcrumbs[] = [
                'href' => 'admin.def_sub_repairs',
                'params' => ['id' => $this->data['sub_repair']->id, 'parent_id' => $this->data['repair']->id],
                'name' => trans('admin.edit_sub_repair', ['sub_repair' => $this->data['sub_repair']->name]),
            ];
        } else if ($slug && $slug == 'add') {
            $this->authorize('edit');
            $this->breadcrumbs[] = [
                'href' => 'admin.def_sub_repairs',
                'params' => ['slug' => 'add', 'parent_id' => $this->data['repair']->id],
                'name' => trans('admin.add_sub_repairs'),
            ];
        }
        return $this->showView('sub_repair');
    }

    public function defRepairImages(Request $request): View
    {
        $this->getRepair($request->input('parent_id'));
        $this->getFirstBreadcrumbDefCar();
        $this->getSecondBreadcrumbDefCar();

        $this->breadcrumbs[] = [
            'href' => 'admin.def_repair_images',
            'params' => ['slug' => 'add', 'parent_id' => $this->data['repair']->id],
            'name' => trans('admin.adding_repair_image'),
        ];
        return $this->showView('repair_image');
    }

    public function defRecommendedWorks(Request $request): View
    {
        $this->getRepair($request->input('parent_id'));
        $this->data['free_works'] = $this->getRepairRelationsFree(new Repair(), 'recommendedWorks', 'work_id');

        $this->getFirstBreadcrumbDefCar();
        $this->getSecondBreadcrumbDefCar();

        $this->breadcrumbs[] = [
            'href' => 'admin.def_recommended_works',
            'params' => ['slug' => 'add', 'parent_id' => $this->data['repair']->id],
            'name' => trans('admin.adding_recommended_work'),
        ];
        return $this->showView('recommended_work');
    }

    public function defRepairSpares(Request $request): View
    {
        $this->getRepair($request->input('parent_id'));
        $this->data['free_spares'] = $this->getRepairRelationsFree(new Spare(), 'repairSpares', 'spare_id');
        $this->getFirstBreadcrumbDefCar();
        $this->getSecondBreadcrumbDefCar();

        $this->breadcrumbs[] = [
            'href' => 'admin.def_repair_spares',
            'params' => ['slug' => 'add', 'parent_id' => $this->data['repair']->id],
            'name' => trans('admin.adding_spare'),
        ];
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
            $this->data['menu_key'] = 'clients';
            $this->breadcrumbs[] = [
                'href' => 'admin.cars',
                'params' => ['parent_id' => $this->data['item']->brand->id, 'id' => $this->data['item']->id],
                'name' => trans('admin.'.(Gate::allows('edit') ? 'edit_' : 'view_').'car', ['car' => $this->data['item']['name_'.app()->getLocale()]]),
            ];
        } else {
            $this->breadcrumbs[] = [
                'href' => 'admin.brands',
                'params' => ['id' => $this->data['item']->id],
                'name' => trans('admin.'.(Gate::allows('edit') ? 'edit_' : 'view_').'car', ['car' => $this->data['item']['name_'.app()->getLocale()]]),
            ];
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
        $this->getRepair($parentId);

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
            'id' => 'add_something',
            'href' => 'admin.'.$key.'s',
            'params' => ['slug' => 'add', 'parent_id' => $this->data['repair']->id],
            'name' => trans('admin.adding_'.$key),
        ];
    }

    private function getRepairRelationsFree(Model $model, string $repairRelation, string $field): Collection
    {
        return $model->where('car_id',$this->data['repair']->car_id)->whereNotIn('id',$this->data['repair'][$repairRelation]->pluck($field)->toArray())->get();
    }

    private function getFreeWorksCountForRepair(int $id): void
    {
        $this->getRepair($id);
        $this->data['free_works_count'] = $this->getRepairRelationsFree(new Repair(), 'recommendedWorks', 'work_id')->count();
        $this->data['free_spares_count'] = $this->getRepairRelationsFree(new Repair(), 'recommendedWorks', 'spare_id')->count();
    }

    private function getRepair(int $id): void
    {
        $this->data['repair'] = Repair::findOrFail($id);
    }

    private function getFirstBreadcrumbBrand(): void
    {
        $this->data['menu_key'] = 'brands';
        $this->breadcrumbs[] = [
            'href' => 'admin.brands',
            'params' => [],
            'name' => str_replace(':','',trans('admin_menu.brands'))
        ];
    }

    private function getSecondBreadcrumbBrand(Brand $brand): void
    {
        $this->breadcrumbs[] = [
            'href' => 'admin.brands',
            'params' => ['id' => $brand->id],
            'name' => trans('admin.'.(Gate::allows('edit') ? 'edit_' : 'view_').'brand', ['brand' => $brand['name_'.app()->getLocale()]])
        ];
    }

    private function getFirstBreadcrumbCar(Car $car): void
    {
        $this->breadcrumbs[] = [
            'href' => 'admin.cars',
            'params' => ['id' => $car->id, 'parent_id' => $car->brand->id],
            'name' => trans('admin.'.(Gate::allows('edit') ? 'edit_' : 'view_').'car', ['car' => $car['name_'.app()->getLocale()]]),
        ];
    }

    private function getFirstBreadcrumbRepair(Repair $repair): void
    {
        $this->breadcrumbs[] = [
            'href' => 'admin.repairs',
            'params' => ['id' => $repair->id, 'parent_id' => $repair->car->id],
            'name' => trans('admin.'.(Gate::allows('edit') ? 'edit_' : 'view_').'repair', ['repair' => $repair->head]),
        ];
    }

    private function getFirstBreadcrumbDefCar(): void
    {
        $this->data['menu_key'] = 'def_cars';
        $this->breadcrumbs[] = [
            'href' => 'admin.def_cars',
            'params' => ['slug' => 'repair'],
            'name' => trans('admin.'.(Gate::allows('edit') ? 'edit_' : 'view_').'def_car', ['def_car' => DefCar::where('slug','repair')->pluck('head')->first()])
        ];
    }

    private function getSecondBreadcrumbDefCar(): void
    {
        $this->breadcrumbs[] = [
            'href' => 'admin.def_repairs',
            'params' => ['id' => $this->data['repair']->id],
            'name' => trans('admin.'.(Gate::allows('edit') ? 'edit_' : 'view_').'repair', ['repair' => $this->data['repair']->head])
        ];
    }
}
