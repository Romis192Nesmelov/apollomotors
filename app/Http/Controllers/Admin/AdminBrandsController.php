<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\HelperTrait;

use App\Models\Brand;
use App\Models\Car;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
//use Illuminate\Support\Str;
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

    public function editBrand(Request $request): RedirectResponse
    {
        $this->editSomething(
            $request,
            ['name_ru' => $this->validationString, 'name_en' => $this->validationString, 'elected' => 'nullable|integer'],
            new Brand(),
            ['logo' => $this->validationPng, 'image' => $this->validationJpg],
            'storage/images/brands/',
        );
        return redirect(route('admin.brands'));
    }

    public function deleteBrand(Request $request): JsonResponse
    {
        if (!$this->authorize('delete')) abort(403, trans('content.403'));
        $fields = $this->validate($request, ['id' => 'required|integer|exists:brands,id']);

        $brand = Brand::find($fields['id']);
        $this->deleteFile($brand['logo']);
        $this->deleteFile($brand['image']);

        foreach ($brand->cars as $car) {
            $this->deleteFile($car['image_full']);
            $this->deleteFile($car['image_preview']);
        }
        $brand->delete();
        return response()->json(['success' => true]);
    }

    public function brandRepair(Request $request): View
    {
        return $this->getRMS(new Brand(), $request->id, 'repair');
    }

    public function brandMaintenances(Request $request): View
    {
        return $this->getRMS(new Brand(), $request->id, 'maintenances');
    }

    public function brandSpare(Request $request): View
    {
        return $this->getRMS(new Brand(), $request->id, 'spare');
    }

    public function editBrandRepair(Request $request): RedirectResponse
    {
        $brand = $this->editRMS($request, new Brand(),'repair');
        $this->setSeo($request, $brand->repair);
        $this->saveCompleteMessage();
        return redirect(route('admin.brands',['id' => $brand->id]));
    }

    public function editBrandMaintenances(Request $request): RedirectResponse
    {
        $brand = $this->editRMS($request, new Brand(),'maintenances');
        $this->setSeo($request, $brand->maintenances[0]);
        $this->saveCompleteMessage();
        return redirect(route('admin.brands',['id' => $brand->id]));
    }

    public function editBrandSpare(Request $request): RedirectResponse
    {
        $brand = $this->editRMS($request, new Brand(),'spare');
        $this->setSeo($request, $brand->spare);
        $this->saveCompleteMessage();
        return redirect(route('admin.brands',['id' => $brand->id]));
    }

    private function getRMS(Model $model, int $id, string $relationName): View
    {
        $itemName = $this->getCutTableName($model);
        $this->data['item'] = $model->findOrFail($id);
        $this->data['relation'] = $relationName;
        $this->data['route'] = route('admin.edit_'.$itemName.'_'.$relationName);
        $this->data['menu_key'] = $model->getTable();

        $this->breadcrumbs[] = $this->menu['brands'];
        if ($model instanceof Car) {
            $this->breadcrumbs[] = [
                'href' => $this->menu['brands']['href'],
                'params' => ['id' => $this->data['item']->brand->id],
                'name' => trans('admin.'.($this->authorize('edit') ? 'edit_' : 'view_').'brand', ['brand' => $this->data['item']->brand['name_'.app()->getLocale()]]),
            ];
        }
        $this->breadcrumbs[] = $this->getBreadcrumbs($itemName, 'name_'.app()->getLocale(), 'item');
        $this->breadcrumbs[] = [
            'id' => 'rmp_',
            'href' => 'admin.'.$itemName.'_'.$relationName,
            'params' => ['id' => $this->data['item']->id],
            'name' => trans('admin.'.$itemName.'_'.$relationName),
        ];

        return $this->showView('rms');
    }

    private function editRMS(Request $request, Model $model, string $relationName): Model
    {
        if (!$this->authorize('edit')) abort(403, trans('content.403'));
        $item = $model->findOrFail($request->input('id'));

        if ($relationName == 'repairs' || $relationName == 'maintenances') {
            $fields = $this->validate($request, ['text1' => $this->validationText,'text2' => 'nullable|max:3000']);
            for ($i=0;$i<2;$i++) {
                $newFields = ['text' => $fields['text'.($i+1)]];
                if (isset($item->$relationName[$i])) $item->$relationName[$i]->update($newFields);
                else {
                    $newFields[$this->getRelationIdName($item)] = $item->id;
                    $item->$relationName()->create($newFields);
                }
            }
        } else {
            $fields = $this->validate($request, ['text' => $this->validationText]);
            if ($item->$relationName) $item->$relationName->update($fields);
            else {
                $fields[$this->getRelationIdName($item)] = $item->id;
                $item->$relationName()->create($fields);
            }
        }
        return $item->refresh();
    }
}
