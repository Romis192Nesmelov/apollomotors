<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperTrait;

use App\Models\Article;
use App\Models\Brand;
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

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminBaseController extends Controller
{
    use HelperTrait;

    protected array $data = [];
    protected array $breadcrumbs = [];
    protected array $menu;

    public function __construct()
    {
        $menuData = [
            ['key' => 'home', 'name' => trans('admin_menu.home'), 'icon' => 'icon-home2'],
            ['key' => 'users', 'name' => trans('admin_menu.admins'), 'description' => trans('admin_menu.admins_description'), 'icon' => 'icon-users'],
            ['key' => 'contents', 'name' => trans('admin_menu.content'), 'description' => trans('admin_menu.content_description'), 'icon' => 'icon-pencil6'],
            ['key' => 'contacts', 'name' => trans('menu.contacts'), 'description' => trans('admin_menu.contacts_description'), 'icon' => 'icon-bookmark'],
            ['key' => 'offer_repairs', 'name' => trans('content.we_offer_repairs'), 'description' => trans('admin_menu.home_page_block_editing'), 'icon' => 'icon-hammer-wrench'],
            ['key' => 'free_checks', 'name' => trans('content.free_check'), 'description' => trans('admin_menu.home_page_block_editing'), 'icon' => 'icon-shield-check'],
            ['key' => 'checks', 'name' => trans('admin.checks'), 'description' => trans('admin_menu.home_page_block_editing'), 'icon' => 'icon-checkmark2', 'hidden' => true],
            ['key' => 'prices', 'name' => trans('content.our_prices'), 'description' => trans('admin_menu.home_page_block_editing'), 'icon' => 'icon-price-tags'],
            ['key' => 'questions', 'name' => trans('content.do_you_know_that'), 'description' => trans('admin_menu.home_page_block_editing'), 'icon' => 'icon-question4'],
            ['key' => 'clients', 'name' => trans('content.we_are_trusted'), 'description' => trans('admin_menu.home_page_block_editing'), 'icon' => 'icon-truck'],
            ['key' => 'articles', 'name' => trans('menu.articles'), 'description' => trans('admin_menu.articles'), 'icon' => 'icon-magazine'],
            ['key' => 'gallery', 'name' => trans('admin_menu.gallery'), 'description' => trans('admin_menu.gallery_description'), 'icon' => 'icon-images3'],
            ['key' => 'brands', 'name' => trans('admin_menu.brands'), 'description' => trans('admin_menu.brands_description'), 'icon' => 'icon-chess-queen'],
        ];
        $this->getMenu($menuData);
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
            new Content()
        );
    }

    public function editContent(Request $request): RedirectResponse
    {
        $content = $this->editSomething(
            $request,
            ['head' => $this->validationString, 'text' => $this->validationText],
            new Content()
        );
        $this->setSeo($request, $content);
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
        $article = $this->editSomething(
            $request,
            ['head' => $this->validationString, 'text' => $this->validationLongText],
            new Article()
        );
        $this->setSeo($request, $article);
        return redirect(route('admin.articles'));
    }

    public function deleteArticle(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Article());
    }

    public function gallery($folder=null, $subFolder=null): View
    {
        $finalPath = '';
        $this->breadcrumbs[] = $this->menu['gallery'];
        $this->data['menu_key'] = 'gallery';
        $this->data['route'] = route('admin.gallery');

        if ($folder) {
            $finalPath = $folder.'/';
            $this->data['up_to'] = route('admin.gallery');
            $this->data['lock'] = in_array($folder, $this->lockingFolders);;
        }
        if ($subFolder) {
            $finalPath = $folder.'/'.$subFolder.'/';
            $this->data['up_to'] = route('admin.gallery',$folder);
        }
        ;
        $basePath = 'public/storage/images/';

        if (!file_exists(base_path($basePath.$finalPath)) || in_array($folder, $this->skippingFolders)) abort(404);

        $this->data['route'] .= '/'.$finalPath;
        $finalPath .= '*';
        $this->data['folder'] = '/'.$finalPath;
        $this->data['base_folder'] = $folder.($subFolder ? '/'.$subFolder : '');
        $this->data['objects'] = glob(base_path($basePath.$finalPath));
        $this->data['skipping_folders'] = $this->skippingFolders;

        return $this->showView('gallery');
    }

    public function addImage(Request $request): RedirectResponse
    {
        $fields = $this->validate($request, ['image' => 'required|'.$this->validationJpgAndPng, 'folder' => $this->validationString]);
        $imageName = $request->file('image')->getClientOriginalName().'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(base_path('public/storage/images/'.$fields['folder']), $imageName);
        return redirect(route('admin.gallery',$fields['folder']));
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

    protected function deleteSomething(Request $request, Model $model, string $fileField=null): JsonResponse
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

    protected function getSomething(
        Request $request,
        string $key,
        string $head,
        Model $model,

        string $slug=null,
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
            $this->data[$key.'s'] = $model->all();
            return $this->showView($key.'s');
        }
    }

    protected function editSomething(
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
            $fields = array_merge(
                $fields,
                $this->setSpecialFields($request, $this->validate($request, $validationArr))
            );

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
            $fields = array_merge(
                $fields,
                $this->setSpecialFields($request, $this->validate($request, $validationArr))
            );

            // Processing image define images fields
            if ($pathToImages) {
                $fields = $this->processingImages($request, $fields, array_keys($imageValidationArr), $pathToImages);
            }

            // Creating item
            $item = $model->create($fields);
        }

        $this->saveCompleteMessage();
        return $item;
    }

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

    protected function showView($view): View
    {
        return view('admin.'.$view, array_merge
            (
                ['breadcrumbs' => $this->breadcrumbs, 'menu' => $this->menu],
                $this->data
            )
        );
    }

    protected function setSpecialFields(Request $request, $fields): array
    {
        if ($request->has('active')) $fields['active'] = $request->active ? 1 : 0;
        if ($request->has('limit')) $fields['limit'] = $this->convertTime($request->limit);
        return $fields;
    }

    protected function convertTime($time): int
    {
        $time = explode('/', $time);
        return strtotime($time[1].'/'.$time[0].'/'.$time[2]);
    }

    protected function processingImages(Request $request, array $fields, array $imagesFields, string $pathToImages, $itemModel=null): array
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

    protected function deleteFile($path): void
    {
        if (file_exists(base_path('public/'.$path))) unlink(base_path('public/'.$path));
    }

    protected function getMenu(array $menuData): void
    {
        foreach ($menuData as $data) {
            $this->menu[$data['key']] = [
                'id' => $data['key'],
                'href' => 'admin.'.$data['key'],
                'name' => str_replace(':','', $data['name']),
                'description' => isset($data['description']) ? $data['description'] : '',
                'icon' => $data['icon'],
                'hidden' => isset($data['hidden']) && $data['hidden']
            ];
        }
    }

    protected function getBreadcrumbs(string $key, string $head, string $paramKey=null): array
    {
        return [
            'href' => $this->menu[$key.'s']['href'],
            'params' => ['id' => $this->data[$paramKey ?: $key]->id],
            'name' => trans('admin.'.($this->authorize('edit') ? 'edit_' : 'view_').$key, [$key => $this->data[$paramKey ?: $key][$head]]),
        ];
    }

    protected function getRelationIdName(Model $item) :string
    {
        return $this->getCutTableName($item).'_id';
    }

    protected function getCutTableName(Model $item) :string
    {
        return substr($item->getTable(),0,-1);
    }
}
