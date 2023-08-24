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
use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
//use Illuminate\Support\Str;
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
            ['key' => 'checks', 'hidden' => true],
            ['key' => 'prices', 'name' => trans('content.our_prices'), 'description' => trans('admin_menu.home_page_block_editing'), 'icon' => 'icon-price-tags'],
            ['key' => 'questions', 'name' => trans('content.do_you_know_that'), 'description' => trans('admin_menu.home_page_block_editing'), 'icon' => 'icon-question4'],
            ['key' => 'clients', 'name' => trans('content.we_are_trusted'), 'description' => trans('admin_menu.home_page_block_editing'), 'icon' => 'icon-truck'],
            ['key' => 'articles', 'name' => trans('menu.articles'), 'description' => trans('admin_menu.articles'), 'icon' => 'icon-magazine'],
            ['key' => 'gallery', 'name' => trans('admin_menu.gallery'), 'description' => trans('admin_menu.gallery_description'), 'icon' => 'icon-images3'],
            ['key' => 'brands', 'name' => trans('admin_menu.brands'), 'description' => trans('admin_menu.brands_description'), 'icon' => 'icon-chess-queen'],
            ['key' => 'cars', 'hidden' => true],
            ['key' => 'spares', 'hidden' => true],
            ['key' => 'actions', 'name' => trans('admin_menu.actions'), 'description' => trans('admin_menu.actions_description'), 'icon' => 'icon-gift'],
            ['key' => 'action_questions', 'hidden' => true],
            ['key' => 'repairs', 'hidden' => true],
            ['key' => 'sub_repairs', 'hidden' => true],
            ['key' => 'mechanics', 'name' => trans('admin_menu.mechanics'), 'description' => trans('admin_menu.mechanics_description'), 'icon' => 'icon-users4'],
            ['key' => 'records', 'name' => trans('admin_menu.records'), 'description' => trans('admin_menu.records_description'), 'icon' => 'icon-pencil6'],
        ];

        foreach ($menuData as $data) {
            $this->menu[$data['key']] = [
                'id' => $data['key'],
                'href' => 'admin.'.$data['key']
            ];
            if (isset($data['name'])) $this->menu[$data['key']]['name'] = str_replace(':','', $data['name']);
            if (!isset($data['hidden']) || !$data['hidden']) {
                $this->menu[$data['key']]['description'] = isset($data['description']) ? $data['description'] : null;
                $this->menu[$data['key']]['icon'] = $data['icon'];
                $this->menu[$data['key']]['hidden'] = false;
            } else $this->menu[$data['key']]['hidden'] = true;
        }
        $this->breadcrumbs[] = $this->menu['home'];
    }

    public function home(): View
    {
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

    public function contents(Request $request): View
    {
        return $this->getSomething(
            $request,
            'content',
            'head',
            new Content()
        );
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

    protected function getSomething(
        Request $request,
        string $key,
        string $head,
        Model $model,

        string $slug=null,
        string $parentKey=null,
        string $parentHead=null,
        Model $parentModel=null,

        string $secondParentsKey=null,
        string $secondParentsHead=null,

        string $thirdParentsKey=null,
        string $thirdParentsHead=null,
    ): View
    {
        if ($parentKey) {
            $this->data[$parentKey] = $parentModel->findOrFail($request->input('parent_id'));
            $this->data[$parentKey.'s'] = $parentModel->all();

            if ($secondParentsKey) {
                if ($thirdParentsKey) {
                    $this->data['menu_key'] = $thirdParentsKey.'s';
                    $this->data[$thirdParentsKey] = $this->data[$parentKey][$secondParentsKey][$thirdParentsKey];
                    $this->getBreadcrumbs(
                        $thirdParentsKey,
                        $thirdParentsHead,
                        ['id' => $this->data[$thirdParentsKey]->id]
                    );
                } else {
                    $this->data['menu_key'] = $secondParentsKey.'s';
                }

                $this->data[$secondParentsKey] = $this->data[$parentKey][$secondParentsKey];
                $this->breadcrumbs[] = $this->menu[$secondParentsKey.'s'];
                $this->getBreadcrumbs(
                    $secondParentsKey,
                    $secondParentsHead,
                    ['id' => $this->data[$secondParentsKey]->id, 'parent_id' => ($thirdParentsKey ? $this->data[$thirdParentsKey]->id : '')]
                );
            } else {
                $this->data['menu_key'] = $parentKey.'s';
            }

            $this->breadcrumbs[] = $this->menu[$parentKey.'s'];
            $this->getBreadcrumbs(
                $parentKey,
                $parentHead,
                ['id' => $this->data[$parentKey]->id, 'parent_id' => ($secondParentsKey ? $this->data[$secondParentsKey]->id : '')]
            );
        } else {
            $this->data['menu_key'] = $key.'s';
            $this->breadcrumbs[] = $this->menu[$key.'s'];
        }

        $breadcrumbsParams = [];
        if ($parentKey) $breadcrumbsParams['parent_id'] = $this->data[$parentKey]->id;

        if ($request->has('id')) {
            if (!isset($this->data[$key])) $this->data[$key] = $model->findOrFail($request->input('id'));
            $breadcrumbsParams['id'] = $this->data[$key]->id;
            $this->getBreadcrumbs($key, $head, $breadcrumbsParams);
            return $this->showView($key);
        } else if ($slug && $slug == 'add') {
            if (!$this->authorize('edit')) abort(403, trans('403'));
            $breadcrumbsParams['slug'] = 'add';
            $this->breadcrumbs[] = [
                'id' => $this->menu[$key.'s']['id'],
                'href' => $this->menu[$key.'s']['href'],
                'params' => $breadcrumbsParams,
                'name' => trans('admin.adding_'.$key),
            ];
            return $this->showView($key);
        } else {
            $this->data[$key.'s'] = $model->all();
            return $this->showView($key.'s');
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

    protected function getBreadcrumbs(string $key, string $head, array $params=[], string $paramKey=null): void
    {
        $this->breadcrumbs[] = [
            'href' => $this->menu[$key.'s']['href'],
            'params' => $params,
            'name' => trans('admin.'.($this->authorize('edit') ? 'edit_' : 'view_').$key, [$key => $this->data[$paramKey ?: $key][$head]]),
        ];
    }
}
