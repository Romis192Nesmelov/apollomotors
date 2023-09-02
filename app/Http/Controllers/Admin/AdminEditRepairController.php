<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\HelperTrait;

use App\Models\RecommendedWork;
use App\Models\Repair;
use App\Models\RepairImage;
use App\Models\RepairSpare;
use App\Models\SubRepair;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminEditRepairController extends AdminEditController
{
    use HelperTrait;

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function editRepair(Request $request): RedirectResponse
    {
        $fields = [
            'price_from' => $request->price_from ? 1 : 0,
            'upon_reaching_conditions' => $request->upon_reaching_conditions ? 1 : 0,
            'free_diagnostics' => $request->free_diagnostics ? 1 : 0
        ];

        $repair = $this->editSomething(
            $request,
            [
                'slug' => 'nullable|min:3|max:255',
                'price' => $this->validationInteger,
                'old_price' => $this->validationInteger,
                'work_time' => $this->validationNumeric,
                'upon_reaching_years' => 'required|integer|min:1|max:50',
                'upon_reaching_mileage' => $this->validationInteger,
                'warranty_years' => $this->validationNumeric,
                'head' => $this->validationString,
                'text' => 'nullable|max:5000',
                'car_id' => $this->validationCarId
            ],
            new Repair(),
            ['spares_image' => $this->validationJpg],
            'storage/images/repair/',
            $fields
        );
        $this->setSeo($request, $repair);
        return redirect(route('admin.cars', ['id' => $repair->car_id, 'parent_id' => $repair->car->brand_id]));
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function editSubRepair(Request $request): RedirectResponse
    {
        $subRepair = $this->editSomething(
            $request,
            ['name' => $this->validationString, 'price' => $this->validationInteger, 'repair_id' => $this->validationRepairId],
            new SubRepair()
        );
        return redirect(route('admin.repairs', ['id' => $subRepair->repair_id, 'parent_id' => $subRepair->repair->car_id]));
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function addRecommendedWork(Request $request): RedirectResponse
    {
        return $this->editRepairSomething($request, ['repair_id' => $this->validationRepairId, 'work_id' => $this->validationRepairId], new RecommendedWork());
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function addRepairImage(Request $request): RedirectResponse
    {
        $errors = [];
        if (!is_file(base_path('public'.$request->preview))) $errors['preview'] = trans('admin.wrong_file');
        if (!is_file(base_path('public'.$request->image))) $errors['image'] = trans('admin.wrong_file');
        if (count($errors)) return redirect()->back()->withErrors($errors);
        return $this->editRepairSomething($request, ['repair_id' => $this->validationRepairId, 'image' => 'required', 'preview' => 'required'], new RepairImage());
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function addRepairSpare(Request $request): RedirectResponse
    {
        return $this->editRepairSomething($request, ['repair_id' => $this->validationRepairId, 'spare_id' => $this->validationSpareId], new RepairSpare());
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    private function editRepairSomething(Request $request, array $validationArr, Model $model): RedirectResponse
    {
        $this->authorize('edit');
        $fields = $this->validate($request, $validationArr);
        $item = $model->create($fields);
        $this->saveCompleteMessage();
        return redirect(route('admin.repairs', ['id' => $item->repair_id, 'parent_id' => $item->repair->car_id]));
    }
}
