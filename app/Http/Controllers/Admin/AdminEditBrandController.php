<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;

use App\Models\Brand;
use App\Models\Car;

use App\Models\DefCar;
use App\Models\Spare;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminEditBrandController extends AdminEditController
{
    use HelperTrait;

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function editBrand(Request $request): RedirectResponse
    {
        $this->editSomething(
            $request,
            [
                'name_ru' => $this->validationString,
                'name_en' => $this->validationString
            ],
            new Brand(),
            ['logo' => $this->validationJpgAndPng, 'image' => $this->validationJpgAndPng],
            'storage/images/brands/',
        );
        return redirect(route('admin.brands'));
    }

    /**
     * @throws AuthorizationException
     */
    public function editDefCar(Request $request): RedirectResponse
    {
        $this->authorize('edit');
        if (!$request->has('slug')) abort(403);
        $validationArr = ['head' => $this->validationString];

        if ($request->slug == 'repair') {
            $validationArr['text1'] = $this->validationText;
            $validationArr['text2'] = $this->validationText;
            $fields = $this->validate($request, $validationArr);
            $content = DefCar::where('slug',$request->slug)->get();

            $content[0]->update([
                'head' => $fields['head'],
                'text' => $fields['text1']
            ]);
            $content[1]->update(['text' => $fields['text2']]);
        } else {
            $validationArr['text'] = $this->validationText;
            $fields = $this->validate($request, $validationArr);
            $content = DefCar::where('slug',$request->slug)->first();
            $content->update($fields);
        }
        $this->saveCompleteMessage();
        return redirect(route('admin.def_cars'));
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function editBrandRepairs(Request $request): RedirectResponse
    {
        $brand = $this->editRMS($request, new Brand(),'repairs');
        $this->setSeo($request, $brand->repairs[0]);
        return redirect(route('admin.brands',['id' => $brand->id]));
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function editBrandMaintenances(Request $request): RedirectResponse
    {
        $brand = $this->editRMS($request, new Brand(),'maintenances');
        $this->setSeo($request, $brand->maintenances[0]);
        return redirect(route('admin.brands',['id' => $brand->id]));
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function editBrandSpare(Request $request): RedirectResponse
    {
        $brand = $this->editRMS($request, new Brand(),'spare');
        $this->setSeo($request, $brand->spare);
        return redirect(route('admin.brands',['id' => $brand->id]));
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function editCar(Request $request): RedirectResponse
    {
        $car = $this->editSomething(
            $request,
            ['name_ru' => $this->validationString, 'name_en' => $this->validationString, 'brand_id' => $this->validationBrandId],
            new Car(),
            ['image_full' => $this->validationJpgAndPng, 'image_preview' => $this->validationJpgAndPng],
            'storage/images/cars/',
        );
        return redirect(route('admin.brands', ['id' => $car->brand->id]));
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function editCarRepairs(Request $request): RedirectResponse
    {
        $car = $this->editRMS($request, new Car(),'repairs');
        $this->setSeo($request, $car->repairs[0]);
        return redirect(route('admin.cars',['id' => $car->id, 'parent_id' => $car->brand->id]));
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function editCarMaintenance(Request $request): RedirectResponse
    {
        $car = $this->editRMS($request, new Car(),'maintenance');
        $this->setSeo($request, $car->maintenance);
        return redirect(route('admin.cars',['id' => $car->id, 'parent_id' => $car->brand->id]));
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function editCarSpare(Request $request): RedirectResponse
    {
        $car = $this->editRMS($request, new Car(),'spare');
        $this->setSeo($request, $car->spare);
        return redirect(route('admin.cars',['id' => $car->id, 'parent_id' => $car->brand->id]));
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function editSpare(Request $request): RedirectResponse
    {
        $fields = [
            'price_original_from' => $request->price_original_from ? 1 : 0,
            'price_non_original_from' => $request->price_non_original_from ? 1 : 0
        ];

        $spare = $this->editSomething(
            $request,
            [
                'slug' => 'nullable|min:3|max:191',
                'code' => $this->validationString,
                'price_original' => $this->validationInteger,
                'price_non_original' => $this->validationInteger,
                'head' => $this->validationString,
                'text' => 'nullable|max:50000',
                'car_id' => $this->validationCarId
            ],
            new Spare(),
            [],
            '',
            $fields
        );
        $this->setSeo($request, $spare);
        return redirect(route('admin.cars', ['id' => $spare->car_id, 'parent_id' => $spare->car->brand_id]));
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    private function editRMS(Request $request, Model $model, string $relationName): Model
    {
        $this->authorize('edit');
        $item = $model->findOrFail($request->input('id'));

        if ($relationName == 'repairs' || $relationName == 'maintenances') {
            $fields = $this->validate($request, ['text1' => $this->validationLongText,'text2' => 'nullable|min:5|max:50000']);
            for ($i=0;$i<2;$i++) {
                $newFields = ['text' => $fields['text'.($i+1)]];
                if ( isset($item->$relationName[$i]) ) $item->$relationName[$i]->update($newFields);
                else {
                    $newFields[$this->getRelationIdName($item)] = $item->id;
                    $item->$relationName()->create($newFields);
                }
            }
        } else {
            $fields = $this->validate($request, ['text' => $this->validationLongText]);
            if ($item->$relationName) $item->$relationName->update($fields);
            else {
                $fields[$this->getRelationIdName($item)] = $item->id;
                $item->$relationName()->create($fields);
            }
        }

        $this->saveCompleteMessage();
        return $item->refresh();
    }
}
