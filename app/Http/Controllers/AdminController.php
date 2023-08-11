<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Article;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Check;
use App\Models\Client;
use App\Models\FreeCheck;
use App\Models\HomePrice;
use App\Models\OfferRepair;
use App\Models\Question;
use App\Models\Seo;
use App\Models\User;
use App\Models\Content;
use App\Models\Contact;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse ;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    use HelperTrait;

    private array $data = [];
    private array $breadcrumbs = [];
    private array $menu;

    public function __construct()
    {
        $this->getMenuItem('home', trans('admin_menu.home'), '', 'icon-home2');
        $this->getMenuItem('users', trans('admin_menu.admins'), trans('admin_menu.admins_description'), 'icon-users');
        $this->getMenuItem('contents', trans('admin_menu.content'), trans('admin_menu.content_description'), 'icon-pencil6');
        $this->getMenuItem('contacts', trans('menu.contacts'), trans('admin_menu.contacts_description'), 'icon-bookmark');
        $this->getMenuItem('offer_repairs', trans('content.we_offer_repairs'), trans('admin_menu.home_page_block_editing'), 'icon-hammer-wrench');
        $this->getMenuItem('free_checks', trans('content.free_check'), trans('admin_menu.home_page_block_editing'), 'icon-shield-check');
        $this->getMenuItem('checks', trans('admin.checks'), trans('admin_menu.home_page_block_editing'), 'icon-checkmark2', true);
        $this->getMenuItem('prices', trans('content.our_prices'), trans('admin_menu.home_page_block_editing'), 'icon-price-tags');
        $this->getMenuItem('questions', trans('content.do_you_know_that'), trans('admin_menu.home_page_block_editing'), 'icon-question4');
        $this->getMenuItem('clients', trans('content.we_are_trusted'), trans('admin_menu.home_page_block_editing'), 'icon-truck');
        $this->getMenuItem('articles', trans('menu.articles'), trans('admin_menu.articles'), 'icon-magazine');
        $this->breadcrumbs[] = $this->menu['home'];
    }

    public function home(): View
    {
        $this->breadcrumbs[] = $this->menu['home'];
        $this->data['menu_key'] = 'home';
        return $this->showView('home');
    }

    public function users(Request $request, $slug=null): View
    {
        return $this->getSomething(
            $request,
            'user',
            'email',
            new User(),
            $slug
        );
    }

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

    public function deleteUser(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new User());
    }

    public function contents(Request $request): View
    {
        return $this->getSomething(
            $request,
            'content',
            'head',
            new Content(),
            null,
            [1,2,3,7]
        );
    }

    public function editContent(Request $request): RedirectResponse
    {
        $this->editSomething(
            $request,
            ['head' => $this->validationString, 'text' => $this->validationText],
            new Content()
        );
        return redirect(route('admin.contents'));
    }

    public function contacts(Request $request): View
    {
        return $this->getSomething(
            $request,
            'contact',
            'contact',
            new Contact(),
        );
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

    public function offerRepairs(Request $request, $slug=null): View
    {
        return $this->getSomething(
            $request,
            'offer_repair',
            'name',
            new OfferRepair(),
            $slug
        );
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

    public function deleteOfferRepair(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new OfferRepair(), 'image');
    }

    public function freeChecks(Request $request, $slug=null): View
    {
        return $this->getSomething(
            $request,
            'free_check',
            'name',
            new FreeCheck(),
            $slug
        );
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

    public function deleteFreeCheck(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new FreeCheck());
    }

    public function checks(Request $request, $slug=null): View
    {
        return $this->getSomething(
            $request,
            'check',
            'name',
            new Check(),
            $slug,
            [],
            'free_check',
            'name',
            new FreeCheck()
        );
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

    public function deleteCheck(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Check());
    }

    public function prices(Request $request, $slug=null): View
    {
        $this->data['brands'] = Brand::where('elected',1)->get();
        return $this->getSomething(
            $request,
            'price',
            'name',
            new HomePrice(),
            $slug
        );
    }

    public function editPrice(Request $request): RedirectResponse
    {
        $this->editSomething(
            $request,
            ['name' => $this->validationString, 'brand_id' => 'required|integer|exists:brands,id'],
            new Check()
        );
        return redirect(route('admin.prices'));
    }

    public function deletePrice(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new HomePrice());
    }

    public function questions(Request $request, $slug=null): View
    {
        return $this->getSomething(
            $request,
            'question',
            'question',
            new Question(),
            $slug
        );
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

    public function deleteQuestion(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Question());
    }

    public function clients(Request $request, $slug=null): View
    {
        return $this->getSomething(
            $request,
            'client',
            'name',
            new Client(),
            $slug
        );
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

    public function deleteClient(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Client(), 'image');
    }

    public function articles(Request $request, $slug=null): View
    {
        return $this->getSomething(
            $request,
            'article',
            'head',
            new Article(),
            $slug
        );
    }

    public function editArticle(Request $request): RedirectResponse
    {
        $this->editSomething(
            $request,
            ['head' => $this->validationString, 'text' => $this->validationLongText],
            new Article()
        );
        return redirect(route('admin.articles'));
    }

    public function deleteArticle(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Article());
    }

    private function deleteSomething(Request $request, Model $model, string $fileField=null): JsonResponse
    {
        if (!$this->authorize('delete')) abort(403, trans('content.403'));
        $this->validate($request, ['id' => 'required|integer|exists:'.$model->getTable().',id']);
        $itemModel = $model->find($request->input('id'));
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

    private function getSomething(
        Request $request,
        string $key,
        string $head,
        Model $model,

        string $slug=null,
        array $ids=[],

        string $parentKey=null,
        string $parentHead=null,
        Model $parentModel=null,

        string $parentParentsKey=null,
        string $parentParentsHead=null,
    ): View
    {
        if ($parentKey) {
            $this->data['menu_key'] = $parentKey.'s';
            $this->data[$parentKey] = $parentModel->findOrFail($request->input('parent_id'));
            $this->data[$parentKey.'s'] = $parentModel->all();

            if ($parentParentsKey) {
                $this->data[$parentParentsKey] = $this->data[$parentKey][$parentParentsKey];
                $this->breadcrumbs[] = $this->menu[$parentParentsKey.'s'];
                $this->breadcrumbs[] = $this->getBreadcrumbs($parentParentsKey, $parentParentsHead);
            }

            $this->breadcrumbs[] = $this->menu[$parentKey.'s'];
            $this->breadcrumbs[] = $this->getBreadcrumbs($parentKey, $parentHead);
        } else {
            $this->breadcrumbs[] = $this->menu[$key.'s'];
            $this->data['menu_key'] = $key.'s';
        }

        if ($request->has('id')) {
            $this->data[$key] = $model->findOrFail($request->input('id'));
            $this->breadcrumbs[] = $this->getBreadcrumbs($key, $head);
            return $this->showView($key);
        } else if ($slug && $slug == 'add') {
            if (!$this->authorize('edit')) abort(403, trans('403'));
            $this->breadcrumbs[] = [
                'id' => $this->menu[$key.'s']['id'],
                'href' => $this->menu[$key.'s']['href'],
                'slug' => 'add',
                'name' => trans('admin.adding_'.$key),
            ];
            return $this->showView($key);
        } else {
            $this->data[$key.'s'] = count($ids) ? $model->whereIn('id',$ids)->get() : $model->all();
            return $this->showView($key.'s');
        }
    }

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
        $seoValidationArr = [
            'title' => 'nullable|max:255',
            'keywords' => 'nullable|max:3000',
            'description' => 'nullable|max:3000',
        ];
        $validationArr = array_merge($validationArr,$imageValidationArr);

        if ($request->has('id')) {
            // Base validation, merging fields and setting special fields
            $fields = array_merge(
                $fields,
                $this->setSpecialFields($request, $this->validate($request, $validationArr))
            );

            // Getting item
            $item = $model->findOrFail($request->input('id'));

            // Validation SEO
            $seoFields = $this->validate($request, $seoValidationArr);

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
            $fields = array_merge(
                $fields,
                $this->setSpecialFields($request, $this->validate($request, $validationArr))
            );

            // Validation SEO
            $seoFields = $this->validate($request, $seoValidationArr);

            // Processing image define images fields
            if ($pathToImages) {
                $fields = $this->processingImages($request, $fields, array_keys($imageValidationArr), $pathToImages);
            }

            // Creating item
            $item = $model->create($fields);
        }

        // Setting SEO
        $this->setSeo($item, $seoFields);

        $this->saveCompleteMessage();
        return $item;
    }

    private function setSeo(Model $item, array $seoFields): void
    {
        if (count($seoFields)) {
            if (isset($item->seo)) $item->seo->update($seoFields);
            else {
                $seoFields[substr($item->getTable(),0,-1).'_id'] = $item->id;
                Seo::create($seoFields);
            }
        }
    }

    private function showView($view): View
    {
        return view('admin.'.$view, array_merge
            (
                ['breadcrumbs' => $this->breadcrumbs, 'menu' => $this->menu],
                $this->data
            )
        );
    }

    private function setSpecialFields(Request $request, $fields): array
    {
        if ($request->has('active')) $fields['active'] = $request->active ? 1 : 0;
        if ($request->has('limit')) $fields['limit'] = $this->convertTime($request->limit);
        return $fields;
    }

    private function convertTime($time): int
    {
        $time = explode('/', $time);
        return strtotime($time[1].'/'.$time[0].'/'.$time[2]);
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

    private function deleteFile($path): void
    {
        if (file_exists(base_path('public/'.$path))) unlink(base_path('public/'.$path));
    }

    private function getMenuItem(string $key, string $name, string $description, string $icon, bool $hidden=false): void
    {
        $this->menu[$key] = [
            'id' => $key,
            'href' => 'admin.'.$key,
            'name' => str_replace(':','', $name),
            'description' => $description,
            'icon' => $icon,
            'hidden' => $hidden
        ];
    }

    private function getBreadcrumbs($key, $head): array
    {
        return [
            'id' => $this->menu[$key.'s']['id'],
            'href' => $this->menu[$key.'s']['href'],
            'params' => ['id' => $this->data[$key]->id],
            'name' => trans('admin.'.($this->authorize('edit') ? 'edit_' : 'view_').$key, [$key => $this->data[$key][$head]]),
        ];
    }
}
