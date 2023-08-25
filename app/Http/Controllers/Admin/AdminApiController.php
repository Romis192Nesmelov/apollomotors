<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperTrait;

use App\Models\Action;
use App\Models\ActionQuestion;
use App\Models\Article;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Check;
use App\Models\Client;
use App\Models\FreeCheck;
use App\Models\HomePrice;
use App\Models\Mechanic;
use App\Models\MechanicMissingMechanic;
use App\Models\OfferRepair;
use App\Models\Question;
use App\Models\RecommendedWork;
use App\Models\Repair;
use App\Models\RepairImage;
use App\Models\RepairSpare;
use App\Models\Spare;
use App\Models\SubRepair;
use App\Models\User;
use App\Models\MissingMechanic;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminApiController extends Controller
{
    use HelperTrait;

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function deleteUser(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new User());
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function deleteOfferRepair(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new OfferRepair(), 'image');
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function deleteFreeCheck(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new FreeCheck());
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function deleteCheck(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Check());
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function deletePrice(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new HomePrice());
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function deleteQuestion(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Question());
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function deleteClient(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Client(), 'image');
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function deleteArticle(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Article());
    }

    public function deleteImage(Request $request): JsonResponse
    {
        $this->validate($request, ['id' => 'required']);
        $pathFile = $request->id;
        $folder = str_replace([base_path('public'),'/storage/images/'],'',pathinfo($pathFile)['dirname']);
        if (in_array($folder, $this->lockingFolders) || in_array($folder, $this->skippingFolders)) abort(403);
        $this->deleteFile($pathFile);
        return response()->json(['success' => true]);
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
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

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function deleteCar(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Car(), ['image_full', 'image_preview']);
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function deleteSpare(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Spare());
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function deleteRepair(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Repair(), 'spares_image');
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function deleteSubRepair(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new SubRepair());
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function deleteRepairImage(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new RepairImage(), ['image','preview']);
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function deleteRecommendedWork(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new RecommendedWork());
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function deleteRepairSpare(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new RepairSpare());
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function deleteAction(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Action(), ['image', 'image_small']);
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function deleteActionQuestion(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new ActionQuestion());
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function deleteMechanic(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Mechanic());
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    private function deleteSomething(Request $request, Model $model, $fileField=null): JsonResponse
    {
        if (!$this->authorize('delete')) abort(403, trans('content.403'));
        $fields = $this->validate($request, ['id' => 'required|integer|exists:'.$model->getTable().',id']);
        $itemModel = $model->find($fields['id']);
        if ($fileField) {
            if (is_array($fileField)) {
                foreach ($fileField as $field) {
                    $this->deleteFile($itemModel[$field]);
                }
            } else $this->deleteFile($itemModel[$fileField]);
        }
        $itemModel->delete();
        return response()->json(['success' => true]);
    }

    /**
     * @throws AuthorizationException|ValidationException
     */
    public function changeIdleMechanic(Request $request): JsonResponse
    {
        if (!$this->authorize('edit')) abort(403, trans('content.403'));
        $fields = $this->validate($request, [
            'date' => 'required|integer',
            'id' => 'required|integer|exists:mechanics,id'
        ]);

        $missingMechanic = MissingMechanic::where('date',$fields['date'])->first();
        if (!$missingMechanic) {
            $missingMechanic = MissingMechanic::create(['date' => $fields['date']]);
            MechanicMissingMechanic::create([
                'mechanic_id' => $fields['id'],
                'missing_mechanic_id' => $missingMechanic->id
            ]);
            $mode = 2;
        }  else {
            $mechanicMissingMechanic = $missingMechanic->mechanics->find($fields['id']);
            if (!$mechanicMissingMechanic) {
                MechanicMissingMechanic::create([
                    'mechanic_id' => $fields['id'],
                    'missing_mechanic_id' => $missingMechanic->id
                ]);
                $mode = 2;
            } else {
                $mechanicMissingMechanic->delete();
                $mode = 1;
            }
        }

        return response()->json(['success' => true, 'mode' => $mode]);
    }
}
