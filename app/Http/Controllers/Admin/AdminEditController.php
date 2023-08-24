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
use App\Models\Contact;
use App\Models\Content;
use App\Models\FreeCheck;
use App\Models\HomePrice;
use App\Models\Mechanic;
use App\Models\MissingMechanic;
use App\Models\OfferRepair;
use App\Models\Question;
use App\Models\RecommendedWork;
use App\Models\Record;
use App\Models\Repair;
use App\Models\RepairImage;
use App\Models\RepairSpare;
use App\Models\Seo;
use App\Models\Spare;
use App\Models\SubRepair;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminEditController extends Controller
{
    use HelperTrait;

    public function editUser(Request $request): RedirectResponse
    {
        $validationArr = [
            'email' => 'required|email|unique:users,email',
            'type' => 'required|integer|min:1|max:3'
        ];
        $fields = [];

        if ($request->has('id')) {
            $validationArr['email'] .= ','.$request->input('id');
            if ($request->input('password')) {
                $validationArr['password'] = $this->validationPassword;
                $fields['password'] = bcrypt($request->input('password'));
            }
        } else {
            $validationArr['password'] = $this->validationPassword;
            $fields['password'] = bcrypt($request->input('password'));
        }

        $this->editSomething(
            $request,
            $validationArr,
            new User(),
            [],
            '',
            $fields
        );
        return redirect(route('admin.users'));
    }

    public function editContent(Request $request): RedirectResponse
    {
        $content = $this->editSomething(
            $request,
            ['head' => $this->validationString, 'text' => $this->validationText],
            new Content()
        );
        if ($content->id != 1) $this->setSeo($request, $content);
        return redirect(route('admin.contents'));
    }

    public function editContact(Request $request): RedirectResponse
    {
        if ($request->has('id')) {
            if ($request->id == 3 || $request->id == 4) $validationArr = ['contact' => 'required|email|unique:contacts,contact,'.$request->input('id')];
            elseif ($request->id == 6 || $request->id == 7) $validationArr = ['contact' => $this->validationPhone.'|unique:contacts,contact,'.$request->input('id')];
            else $validationArr = ['contact' => $this->validationString];
        }
        $this->editSomething(
            $request,
            $validationArr,
            new Contact()
        );
        return redirect(route('admin.contacts'));
    }

    public function editOfferRepair(Request $request): RedirectResponse
    {
        $this->editSomething(
            $request,
            ['name' => $this->validationString],
            new OfferRepair(),
            ['image' => $this->validationJpg],
            'storage/images/offer_repairs/',
        );
        return redirect(route('admin.offer_repairs'));
    }

    public function editFreeCheck(Request $request): RedirectResponse
    {
        $this->editSomething(
            $request,
            ['name' => $this->validationString],
            new FreeCheck()
        );
        return redirect(route('admin.free_checks'));
    }

    public function editCheck(Request $request): RedirectResponse
    {
        $this->editSomething(
            $request,
            ['name' => $this->validationString, 'free_check_id' => 'required|integer|exists:free_checks,id'],
            new Check()
        );
        return redirect(route('admin.free_checks',['id' => $request->free_check_id]));
    }

    public function editPrice(Request $request): RedirectResponse
    {
        $this->editSomething(
            $request,
            ['name' => $this->validationString, 'brand_id' => $this->validationBrandId],
            new HomePrice()
        );
        return redirect(route('admin.prices'));
    }

    public function editQuestion(Request $request): RedirectResponse
    {
        $this->editSomething(
            $request,
            ['question' => $this->validationString, 'answer' => $this->validationText],
            new Question()
        );
        return redirect(route('admin.questions'));
    }

    public function editClient(Request $request): RedirectResponse
    {
        $this->editSomething(
            $request,
            ['name' => $this->validationString],
            new Client(),
            ['image' => $this->validationJpgAndPng],
            'storage/images/clients/',
        );
        return redirect(route('admin.clients'));
    }

    public function editArticle(Request $request): RedirectResponse
    {
        $article = $this->editSomething(
            $request,
            ['head' => $this->validationString, 'text' => $this->validationLongText],
            new Article()
        );
        $this->setSeo($request, $article);
        return redirect(route('admin.articles'));
    }

    public function addImage(Request $request): RedirectResponse
    {
        $fields = $this->validate($request, ['image' => 'required|'.$this->validationJpgAndPng, 'folder' => $this->validationString]);
        $imageName = $request->file('image')->getClientOriginalName().'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(base_path('public/storage/images/'.$fields['folder']), $imageName);
        return redirect(route('admin.gallery',$fields['folder']));
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

    public function editBrandRepair(Request $request): RedirectResponse
    {
        $brand = $this->editRMS($request, new Brand(),'repair');
        $this->setSeo($request, $brand->repair);
        return redirect(route('admin.brands',['id' => $brand->id]));
    }

    public function editBrandMaintenances(Request $request): RedirectResponse
    {
        $brand = $this->editRMS($request, new Brand(),'maintenances');
        $this->setSeo($request, $brand->maintenances[0]);
        return redirect(route('admin.brands',['id' => $brand->id]));
    }

    public function editBrandSpare(Request $request): RedirectResponse
    {
        $brand = $this->editRMS($request, new Brand(),'spare');
        $this->setSeo($request, $brand->spare);
        return redirect(route('admin.brands',['id' => $brand->id]));
    }

    public function editCar(Request $request): RedirectResponse
    {
        $car = $this->editSomething(
            $request,
            ['name_ru' => $this->validationString, 'name_en' => $this->validationString, 'brand_id' => $this->validationBrandId],
            new Car(),
            ['image_full' => $this->validationPng, 'image_preview' => $this->validationJpg],
            'storage/images/cars/',
        );
        return redirect(route('admin.brands', ['id' => $car->brand->id]));
    }

    public function editCarRepairs(Request $request): RedirectResponse
    {
        $car = $this->editRMS($request, new Car(),'repairs');
        $this->setSeo($request, $car->repairs[0]);
        return redirect(route('admin.cars',['id' => $car->id, 'parent_id' => $car->brand->id]));
    }

    public function editCarMaintenance(Request $request): RedirectResponse
    {
        $car = $this->editRMS($request, new Car(),'maintenance');
        $this->setSeo($request, $car->maintenance);
        return redirect(route('admin.cars',['id' => $car->id, 'parent_id' => $car->brand->id]));
    }

    public function editCarSpare(Request $request): RedirectResponse
    {
        $car = $this->editRMS($request, new Car(),'spare');
        $this->setSeo($request, $car->spare);
        return redirect(route('admin.cars',['id' => $car->id, 'parent_id' => $car->brand->id]));
    }

    public function editSpare(Request $request): RedirectResponse
    {
        $fields = [
            'price_original_from' => $request->price_original_from ? 1 : 0,
            'price_non_original_from' => $request->price_non_original_from ? 1 : 0
        ];

        $spare = $this->editSomething(
            $request,
            [
                'slug' => 'nullable|min:3|max:255',
                'code' => $this->validationString,
                'price_original' => $this->validationInteger,
                'price_non_original' => $this->validationInteger,
                'head' => $this->validationString,
                'text' => 'nullable|max:5000',
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

    public function editAction(Request $request): RedirectResponse
    {
        $action = $this->editSomething(
            $request,
            ['head' => $this->validationString, 'text' => $this->validationLongText],
            new Action(),
            ['image' => $this->validationJpg, 'image_small' => $this->validationJpg],
            'storage/images/actions/',
        );
        $action->brand()->sync($request->input('brands_id'));
        $this->setSeo($request, $action);
        return redirect(route('admin.actions'));
    }

    public function editActionQuestion(Request $request): RedirectResponse
    {
        $actionQuestion = $this->editSomething(
            $request,
            ['question' => $this->validationString, 'answer' => $this->validationText, 'action_id' => 'required|integer|exists:actions,id'],
            new ActionQuestion()
        );
        return redirect(route('admin.actions', ['id' => $actionQuestion->action->id]));
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
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

    public function editSubRepair(Request $request): RedirectResponse
    {
        $subRepair = $this->editSomething(
            $request,
            ['name' => $this->validationString, 'price' => $this->validationInteger, 'repair_id' => $this->validationRepairId],
            new SubRepair()
        );
        return redirect(route('admin.repairs', ['id' => $subRepair->repair_id, 'parent_id' => $subRepair->repair->car_id]));
    }

    public function addRecommendedWork(Request $request): RedirectResponse
    {
        return $this->editRepairSomething($request, ['repair_id' => $this->validationRepairId, 'work_id' => $this->validationRepairId], new RecommendedWork());
    }

    public function addRepairImage(Request $request): RedirectResponse
    {
        $errors = [];
        if (!is_file(base_path('public'.$request->preview))) $errors['preview'] = trans('admin.wrong_file');
        if (!is_file(base_path('public'.$request->image))) $errors['image'] = trans('admin.wrong_file');
        if (count($errors)) return redirect()->back()->withErrors($errors);
        return $this->editRepairSomething($request, ['repair_id' => $this->validationRepairId, 'image' => 'required', 'preview' => 'required'], new RepairImage());
    }

    public function addRepairSpare(Request $request): RedirectResponse
    {
        return $this->editRepairSomething($request, ['repair_id' => $this->validationRepairId, 'spare_id' => $this->validationSpareId], new RepairSpare());
    }

    public function editMechanic(Request $request): RedirectResponse
    {
        $this->editSomething(
            $request,
            ['name' => $this->validationString],
            new Mechanic()
        );
        return redirect(route('admin.mechanics'));
    }

    public function editMissingMechanics(Request $request): RedirectResponse
    {
        if (!$this->authorize('edit')) abort(403, trans('content.403'));
        $validateArr = ['date' => 'required|integer|min:'.strtotime(date('m/d/Y'))];
        $missingMechanics = $request->has('missing_mechanics') && $request->input('missing_mechanics') ? [] : null;
        if ($missingMechanics) $validateArr['missing_mechanics'] = 'required|array';

        $this->validate($request, $validateArr);

        $this->data['date'] = $request->input('date');

        if (is_array($missingMechanics)) {
            foreach ($request->input('missing_mechanics') as $id) {
                $missingMechanics[] = (int)$id;
            }
        }

        $this->getMissingMechanics();

        if (is_array($missingMechanics)) {
            foreach ($missingMechanics as $id) {
                if (!in_array($id, $this->data['missing_mechanics'])) {
                    MissingMechanic::create([
                        'date' => $this->data['date'],
                        'mechanic_id' => $id
                    ]);
                }
            }
        }
        foreach ($this->data['mechanics'] as $mechanic) {
            if (!$missingMechanics || (in_array($mechanic->id,$this->data['missing_mechanics']) && !in_array($mechanic->id,$missingMechanics))) {
                MissingMechanic::where('date',$this->data['date'])->where('mechanic_id',$mechanic->id)->delete();
            }
        }

        $this->saveCompleteMessage();
        return redirect(route('admin.records', ['date' => $this->data['date']]));
    }

    public function editRecord(Request $request): RedirectResponse
    {
        if (!$this->authorize('edit')) abort(403, trans('content.403'));
        $validateArr = [
            'point' => 'required|integer|min:1|max:7',
            'title' => $this->validationString,
            'phone' => $this->validationPhone,
            'time' => 'regex:/^((\d){2}:(\d){2})$/',
            'status' => 'nullable|integer|min:0|max:5',
//            'duration' => 'regex:/^((\d){1,2}:(\d){2})$/'
        ];

        $fields = [
            'send_notice' => ($request->input('send_notice') ? 1 : 0),
            'date' => $this->convertTimestamp($request->input('date')),
            'duration' => $request->input('duration')
        ];

        if ($request->input('email')) $validateArr['email'] = 'email';
        if ($request->input('car')) {
            $validateArr['car'] = 'min:2|max:255';
            $fields['car_id'] = null;
        } else {
            $validateArr['car_id'] = 'required|integer|exists:cars,id';
            $fields['car'] = null;
        }

        $startTime = $this->convertTime($request->input('time'));
        $endTime = $startTime + $this->convertTime($request->input('duration'));
        $sendNotice = false;
        if ($endTime > 21) {
            $timeParts = explode('.',(21-$startTime));
            $fields['duration'] = $timeParts[0].':'.(isset($timeParts[1]) ? '30' : '00');
        }

        if ($request->has('id')) {
            $fields = array_merge($fields, $this->validate($request, $validateArr));
            $record = Record::findOrFail($request->input('id'));
            if (!$this->authorize('edit') && auth()->user()->id != $record->id) abort(403, trans('content.403'));

            if ($this->checkBusyRecord($fields,$record->id) ) {
                return redirect(route('admin.records',['id' => $record->id]).'#record')->withInput()->withErrors($this->getBusyRecordErrors());
            }

            if ($record->status != 2 && $fields['status'] == 2) $sendNotice = 1;
            elseif ($record->status != 3 && $fields['status'] == 3) $sendNotice = 2;

            $record->update($fields);
        } else {
            $fields = array_merge($fields, $this->validate($request, $validateArr));
            if (!$this->authorize('edit') || !$this->checkRecordTime($fields['date'])) abort(403, trans('content.403'));
            if ($this->checkBusyRecord($fields))
                return redirect(route('admin.records',['slug' => 'add', 'date' => $fields['date']]).'#record')->withInput()->withErrors($this->getBusyRecordErrors());
            else $record = Record::create($fields);

            if ($record->status == 2) $sendNotice = 1;
            elseif ($record->status == 3) $sendNotice = 2;
        }

        $phone = $record->phone ? str_replace(['+','(',')','-'],'',$record->phone) : null;
        if ($sendNotice && $sendNotice == 2 && $record->email) {
            $this->sendMessage($record->email, [], 'work_is_done');
        }

        if ($sendNotice && $sendNotice == 2 && $phone && $request->input('send_notice_now')) {
            $this->sendSms($phone, trans('admin_content.work_is_done'));
        }

        $this->saveCompleteMessage();
        return redirect(route('admin.records',['date' => $record->date]));
    }

    public function deleteRecord(Request $request): RedirectResponse
    {
        if (!$this->authorize('delete')) abort(403, trans('content.403'));
        $record = Record::findOrFail($request->input('id'));
        $record->status = 5;
        $record->user_id = auth()->id;
        $record->save();
        session()->flash('message', trans('admin.delete_complete'));
        return redirect(route('admin.records', ['date' => $record->date]));
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    private function editSomething(
        Request $request,
        array $validationArr,
        Model $model,
        array $imageValidationArr = [],
        string $pathToImages = '',
        array $fields = []
    ): Model
    {
        if (!$this->authorize('edit')) abort(403, trans('content.403'));
        $validationArr = array_merge($validationArr,$imageValidationArr);

        if ($request->has('id') && $request->input('id')) {
            // Base validation, merging fields and setting special fields
            $fields = array_merge($fields, $this->setSpecialFields($request, $this->validate($request, $validationArr)));
            $fields = $this->checkSlugField($fields);

            // Getting item
            $item = $model->findOrFail($request->input('id'));

            // Processing image define images fields
            $fields = $this->processingImages($request, $fields, array_keys($imageValidationArr), $pathToImages, $item);

            // Updating item
            $item->update($fields);
        } else {
            // Define images validation rules
            if (count($imageValidationArr)) {
                $newImageValidationArr = [];
                foreach ($imageValidationArr as $field => $rule) {
                    $newImageValidationArr[$field] = 'required|'.$rule;
                }
                $validationArr = array_merge($validationArr, $newImageValidationArr);
            }

            // Base validation, merging (if exist password fields) and setting special fields
            $fields = array_merge($fields, $this->setSpecialFields($request, $this->validate($request, $validationArr)));
            $fields = $this->checkSlugField($fields);

            // Processing image define images fields
            if ($pathToImages) $fields = $this->processingImages($request, $fields, array_keys($imageValidationArr), $pathToImages);

            // Creating item
            $item = $model->create($fields);
        }

        $this->saveCompleteMessage();
        return $item->refresh();
    }

    private function editRepairSomething(Request $request, array $validationArr, Model $model): RedirectResponse
    {
        if (!$this->authorize('edit')) abort(403, trans('content.403'));
        $fields = $this->validate($request, $validationArr);
        $item = $model->create($fields);
        $this->saveCompleteMessage();
        return redirect(route('admin.repairs', ['id' => $item->repair_id, 'parent_id' => $item->repair->car_id]));
    }

    private function setSeo(Request $request, ?Model $item): void
    {
        $seoFields = $this->validate($request, [
            'title' => 'nullable|max:255',
            'keywords' => 'nullable|max:3000',
            'description' => 'nullable|max:3000',
        ]);

        $existSeo = false;
        foreach ($seoFields as $field) {
            if ($field) {
                $existSeo = true;
                break;
            }
        }

        if ($existSeo) {
            if ($item->seo) {
                $item->seo->update($seoFields);
            } else {
                $seoFields[$this->getRelationIdName($item)] = $item->id;
                Seo::create($seoFields);
            }
        }
    }

    private function editRMS(Request $request, Model $model, string $relationName): Model
    {
        if (!$this->authorize('edit')) abort(403, trans('content.403'));
        $item = $model->findOrFail($request->input('id'));

        if ($relationName == 'repairs' || $relationName == 'maintenances') {
            $fields = $this->validate($request, ['text1' => $this->validationLongText,'text2' => $this->validationLongText]);
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

    private function setSpecialFields(Request $request, $fields): array
    {
        if ($request->has('active')) $fields['active'] = $request->active ? 1 : 0;
        if ($request->has('limit')) $fields['limit'] = $this->convertTimestamp($request->limit);
        return $fields;
    }

    private function processingImages(Request $request, array $fields, array $imagesFields, string $pathToImages, $itemModel=null): array
    {
        if ($pathToImages) {
            foreach ($imagesFields as $imageField) {
                if ($request->hasFile($imageField)) {
                    if ($itemModel) $this->deleteFile($itemModel[$imageField]);

                    $imageName = null;
                    foreach (['head', 'name', 'name_en'] as $headField) {
                        if ($request->has($headField)) {
                            $imageName = Str::slug($request->input($headField));
                            break;
                        }
                    }

                    if (!$imageName) $imageName = Str::random(10);

                    foreach (['_small', '_full', '_preview'] as $annex) {
                        if (strpos($imageField, $annex)) {
                            $imageName .= $annex;
                            break;
                        }
                    }

                    $imageName .= '.'.$request->file($imageField)->getClientOriginalExtension();
                    $fields[$imageField] = $pathToImages.$imageName;
                    $request->file($imageField)->move(base_path('public/'.$pathToImages), $imageName);
                }
            }
        }
        return $fields;
    }

    private function getRelationIdName(Model $item) :string
    {
        return $this->getCutTableName($item).'_id';
    }

    private function getMissingMechanics(): void
    {
        $this->data['mechanics'] = Mechanic::where('active',1)->orderBy('name')->get();
        $this->data['missing_mechanics'] = MissingMechanic::where('date',$this->data['date'])->pluck('mechanic_id')->toArray();
    }

    private function checkBusyRecord($fields,$id=null): bool
    {
        $records = Record::where('date',$fields['date'])->where('point',$fields['point'])->get();
        $checkingStatTime = $this->convertTime($fields['time']);
        $checkingEndTime = $checkingStatTime + $this->convertTime($fields['duration']);
        $matches = false;
        foreach ($records as $record) {
            $currentStartTime = $this->convertTime($record->time);
            $currentEndTime = $currentStartTime + $this->convertTime($record->duration);
            if (
                (
                    ($checkingStatTime >= $currentStartTime && $checkingStatTime < $currentEndTime)
                    ||
                    ($checkingStatTime < $currentStartTime && $checkingEndTime > $currentEndTime)
                    ||
                    ($checkingEndTime > $currentStartTime && $checkingEndTime <= $currentEndTime)
                )
                &&
                (!$id || $id != $record->id)
                &&
                $record->status != 5
            ) {
                $matches = true;
                break;
            }
        }
        return $matches;
    }

    private function getBusyRecordErrors(): array
    {
        return [
            'date' => trans('records.busy'),
            'time' => trans('records.busy'),
            'point' => trans('records.busy'),
            'duration' => trans('records.busy')
        ];
    }

    private function checkRecordTime($date): int
    {
        return strtotime(date('m').'/'.date('d').'/'.date('Y')) <= $date;
    }

    private function convertTimestamp($time): int
    {
        $time = explode('/', $time);
        return strtotime($time[1].'/'.$time[0].'/'.$time[2]);
    }

    private function convertTime($time): int
    {
        $parts = explode(':',$time);
        return (double)$parts[0]+($parts[1] == '30' ? 0.5 : 0);
    }

    private function checkSlugField(array $fields): array
    {
        if (isset($fields['slug'])) $fields['slug'] = Str::slug($fields['slug']);
        return $fields;
    }
}
