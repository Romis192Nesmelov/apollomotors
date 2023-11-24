<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperTrait;

use App\Models\Article;
use App\Models\Check;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Content;
use App\Models\FreeCheck;
use App\Models\HomePrice;
use App\Models\OfferRepair;
use App\Models\Question;
use App\Models\Seo;
use App\Models\User;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AdminEditController extends Controller
{
    use HelperTrait;

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
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
                $fields['password'] = Hash::make($request->input('password'));
            }
        } else {
            $validationArr['password'] = $this->validationPassword;
            $fields['password'] = Hash::make($request->input('password'));
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

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
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

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
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

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
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

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function editFreeCheck(Request $request): RedirectResponse
    {
        $this->editSomething(
            $request,
            ['name' => $this->validationString],
            new FreeCheck()
        );
        return redirect(route('admin.free_checks'));
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function editCheck(Request $request): RedirectResponse
    {
        $this->editSomething(
            $request,
            ['name' => $this->validationString, 'free_check_id' => 'required|integer|exists:free_checks,id'],
            new Check()
        );
        return redirect(route('admin.free_checks',['id' => $request->free_check_id]));
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function editPrice(Request $request): RedirectResponse
    {
        $this->editSomething(
            $request,
            [
                'name' => $this->validationString,
                'value' => $this->validationInteger,
                'brand_id' => $this->validationBrandId
            ],
            new HomePrice()
        );
        return redirect(route('admin.prices'));
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function editQuestion(Request $request): RedirectResponse
    {
        $this->editSomething(
            $request,
            ['question' => $this->validationString, 'answer' => $this->validationText],
            new Question()
        );
        return redirect(route('admin.questions'));
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
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

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
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

    /**
     * @throws ValidationException
     */
    public function addImage(Request $request): RedirectResponse
    {
        $fields = $this->validate($request, ['image' => 'required|'.$this->validationJpgAndPng, 'folder' => $this->validationString]);
        $imageName = $request->file('image')->getClientOriginalName().'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(base_path('public/storage/images/'.$fields['folder']), $imageName);
        return redirect(route('admin.gallery',$fields['folder']));
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    protected function editSomething(
        Request $request,
        array $validationArr,
        Model $model,
        array $imageValidationArr = [],
        string $pathToImages = '',
        array $fields = []
    ): Model
    {
        $this->authorize('edit');
        $validationArr = array_merge($validationArr,$imageValidationArr);

        if ($request->has('id') && $request->input('id')) {
            // Base validation, merging fields and setting special fields
            $fields = array_merge($fields, $this->setSpecialFields($request, $model, $this->validate($request, $validationArr)));
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
//                $newImageValidationArr = [];
//                foreach ($imageValidationArr as $field => $rule) {
//                    $newImageValidationArr[$field] = 'required|'.$rule;
//                }
                $validationArr = array_merge($validationArr, $imageValidationArr);
            }

            // Base validation, merging (if exist password fields) and setting special fields
            $fields = array_merge($fields, $this->setSpecialFields($request, $model, $this->validate($request, $validationArr)));
            $fields = $this->checkSlugField($fields);

            // Processing image define images fields
            if ($pathToImages) $fields = $this->processingImages($request, $fields, array_keys($imageValidationArr), $pathToImages);

            // Creating item
            $item = $model->create($fields);
        }
        $this->saveCompleteMessage();
        return $item->refresh();
    }

    protected function convertTimestamp($time): int
    {
        $time = explode('/', $time);
        return strtotime($time[1].'/'.$time[0].'/'.$time[2]);
    }

    /**
     * @throws ValidationException
     */
    protected function setSeo(Request $request, ?Model $item): void
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

    private function setSpecialFields(Request $request, Model $model, $fields): array
    {
        $fillable = $model->getFillable();
        if (in_array('active',$fillable)) $fields['active'] = $request->has('active') ? 1 : 0;
        if (in_array('elected',$fillable)) $fields['elected'] = $request->has('elected') ? 1 : 0;
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

    private function checkSlugField(array $fields): array
    {
        if (isset($fields['slug'])) $fields['slug'] = Str::slug($fields['slug']);
        return $fields;
    }
}
