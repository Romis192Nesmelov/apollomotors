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
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class AdminBaseController extends Controller
{
    use HelperTrait;

    protected array $data = [];
    protected array $breadcrumbs = [];
    protected array $menu;

    public function __construct()
    {
        $this->menu = [
            'home'              => ['hidden' => true, 'name' => trans('admin_menu.home'), 'href' => 'admin.home', 'icon' => 'icon-home2'],
            'users'             => ['hidden' => true, 'name' => trans('admin_menu.admins'), 'href' => 'admin.users', 'description' => trans('admin_menu.admins_description'), 'icon' => 'icon-users'],
            'contents'          => ['hidden' => true, 'name' => trans('admin_menu.content'), 'href' => 'admin.contents', 'description' => trans('admin_menu.content_description'), 'icon' => 'icon-pencil6'],
            'contacts'          => ['hidden' => true, 'name' => trans('menu.contacts'), 'href' => 'admin.contacts', 'description' => trans('admin_menu.contacts_description'), 'icon' => 'icon-bookmark'],
            'offer_repairs'     => ['hidden' => true, 'name' => trans('content.we_offer_repairs'), 'href' => 'admin.offer_repairs', 'description' => trans('admin_menu.home_page_block_editing'), 'icon' => 'icon-hammer-wrench'],
            'free_checks'       => ['hidden' => true, 'name' => str_replace(':','',trans('content.free_check')), 'href' => 'admin.free_checks', 'description' => trans('admin_menu.home_page_block_editing'), 'icon' => 'icon-shield-check'],
            'checks'            => ['hidden' => true, 'href' => 'admin.checks'],
            'prices'            => ['hidden' => true, 'name' => str_replace(':','',trans('content.our_prices')), 'href' => 'admin.prices', 'description' => trans('admin_menu.home_page_block_editing'), 'icon' => 'icon-price-tags'],
            'questions'         => ['hidden' => true, 'name' => trans('content.do_you_know_that'), 'href' => 'admin.questions', 'description' => trans('admin_menu.home_page_block_editing'), 'icon' => 'icon-question4'],
            'clients'           => ['hidden' => true, 'name' => trans('content.we_are_trusted'), 'href' => 'admin.clients', 'description' => trans('admin_menu.home_page_block_editing'), 'icon' => 'icon-truck'],
            'articles'          => ['hidden' => true, 'name' => trans('menu.articles'), 'href' => 'admin.articles', 'description' => trans('admin_menu.articles'), 'icon' => 'icon-magazine'],
            'gallery'           => ['hidden' => true, 'name' => trans('admin_menu.gallery'), 'href' => 'admin.gallery', 'description' => trans('admin_menu.gallery_description'), 'icon' => 'icon-images3'],
            'csv_files'         => ['hidden' => true, 'name' => trans('admin_menu.csv_files'), 'href' => 'admin.csv_files', 'description' => trans('admin_menu.csv_files_description'), 'icon' => 'icon-table2'],
            'brands'            => ['hidden' => true, 'name' => trans('admin_menu.brands'), 'href' => 'admin.brands', 'description' => trans('admin_menu.brands_description'), 'icon' => 'icon-chess-queen'],
            'cars'              => ['hidden' => true, 'href' => 'admin.cars'],
            'spares'            => ['hidden' => true, 'href' => 'admin.spares'],
            'def_cars'          => ['hidden' => true, 'name' => trans('admin_menu.def_cars'), 'href' => 'admin.def_cars', 'description' => trans('admin_menu.def_cars_description'), 'icon' => 'icon-info22'],
            'actions'           => ['hidden' => true, 'name' => trans('admin_menu.actions'), 'href' => 'admin.actions', 'description' => trans('admin_menu.actions_description'), 'icon' => 'icon-gift'],
            'action_questions'  => ['hidden' => true, 'href' => 'admin.action_questions'],
            'repairs'           => ['hidden' => true, 'href' => 'admin.repairs'],
            'sub_repairs'       => ['hidden' => true, 'href' => 'admin.sub_repairs'],
            'mechanics'         => ['hidden' => true, 'name' => trans('admin_menu.mechanics'), 'href' => 'admin.mechanics', 'description' => trans('admin_menu.mechanics_description'), 'icon' => 'icon-users4'],
            'records'           => ['hidden' => true, 'name' => trans('admin_menu.records'), 'href' => 'admin.records', 'description' => trans('admin_menu.records_description'), 'icon' => 'icon-pencil6'],
            'site_map'          => ['hidden' => true, 'name' => trans('admin_menu.site_map'), 'href' => 'admin.site_map', 'description' => trans('admin_menu.site_map_description'), 'icon' => 'icon-map4'],
        ];
        $this->breadcrumbs[] = $this->menu['home'];
    }

    public function home(): View
    {
        $this->data['menu_key'] = 'home';
        return $this->showView('home');
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function users(Request $request, $slug=null): View
    {
        $this->data['menu_key'] = 'users';
        $this->breadcrumbs[] = [
            'href' => 'admin.users',
            'params' => [],
            'name' => trans('admin_menu.admins'),
        ];

        if ($request->has('id')) {
            $this->data['user_types'] = [
                ['val' => 0, 'descript' => trans('admin.users0')],
                ['val' => 1, 'descript' => trans('admin.users1')],
                ['val' => 2, 'descript' => trans('admin.users2')],
                ['val' => 3, 'descript' => trans('admin.users3')],
            ];
            if (Gate::allows('all')) {
                $this->data['user_types'][] = ['val' => 4, 'descript' => trans('admin.users4')];
            }
        }

        return $this->getSomething(
            $request,
            'user',
            'email',
            new User(),
            $slug
        );
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function contents(Request $request): View
    {
        $this->data['menu_key'] = 'contents';
        $this->breadcrumbs[] = [
            'href' => 'admin.contents',
            'params' => [],
            'name' => trans('admin_menu.content'),
        ];
        return $this->getSomething(
            $request,
            'content',
            'head',
            new Content()
        );
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function contacts(Request $request): View
    {
        $this->data['menu_key'] = 'contacts';
        $this->breadcrumbs[] = [
            'href' => 'admin.contacts',
            'params' => [],
            'name' => trans('admin_menu.contacts'),
        ];
        return $this->getSomething(
            $request,
            'contact',
            'contact',
            new Contact(),
        );
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function offerRepairs(Request $request, $slug=null): View
    {
        $this->data['menu_key'] = 'offer_repairs';
        $this->breadcrumbs[] = [
            'href' => 'admin.offer_repairs',
            'params' => [],
            'name' => trans('content.we_offer_repairs'),
        ];
        return $this->getSomething(
            $request,
            'offer_repair',
            'name',
            new OfferRepair(),
            $slug
        );
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function freeChecks(Request $request, $slug=null): View
    {
        $this->data['menu_key'] = 'free_checks';
        $this->breadcrumbs[] = [
            'href' => 'admin.free_checks',
            'params' => [],
            'name' => str_replace(':','',trans('content.free_check')),
        ];
        return $this->getSomething(
            $request,
            'free_check',
            'name',
            new FreeCheck(),
            $slug
        );
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function checks(Request $request, $slug=null): View
    {
        $this->data['menu_key'] = 'checks';
        $this->breadcrumbs[] = [
            'href' => 'admin.free_checks',
            'params' => [],
            'name' => str_replace(':','',trans('content.free_check')),
        ];

        $this->data['free_check'] = FreeCheck::findOrFail($request->input('parent_id'));
        $this->breadcrumbs[] = [
            'href' => 'admin.free_checks',
            'params' => ['id' => $this->data['free_check']->id],
            'name' => trans($this->getEditOrView().'free_check', ['free_check' => $this->data['free_check']->name]),
        ];
        $this->data['free_checks'] = FreeCheck::all();

        return $this->getSomething(
            $request,
            'check',
            'name',
            new Check(),
            $slug
        );
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function prices(Request $request, $slug=null): View
    {
        $this->data['menu_key'] = 'prices';
        $this->breadcrumbs[] = [
            'href' => 'admin.prices',
            'params' => [],
            'name' => str_replace(':','',trans('content.our_prices')),
        ];

        $this->data['brands'] = Brand::where('elected',1)->get();
        return $this->getSomething(
            $request,
            'price',
            'name',
            new HomePrice(),
            $slug
        );
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function questions(Request $request, $slug=null): View
    {
        $this->data['menu_key'] = 'questions';
        $this->breadcrumbs[] = [
            'href' => 'admin.questions',
            'params' => [],
            'name' => str_replace(':','',trans('content.do_you_know_that')),
        ];

        return $this->getSomething(
            $request,
            'question',
            'question',
            new Question(),
            $slug
        );
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function clients(Request $request, $slug=null): View
    {
        $this->data['menu_key'] = 'clients';
        $this->breadcrumbs[] = [
            'href' => 'admin.questions',
            'params' => [],
            'name' => str_replace(':','',trans('content.we_are_trusted')),
        ];

        return $this->getSomething(
            $request,
            'client',
            'name',
            new Client(),
            $slug
        );
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function articles(Request $request, $slug=null): View
    {
        $this->data['menu_key'] = 'articles';
        $this->breadcrumbs[] = [
            'href' => 'admin.articles',
            'params' => [],
            'name' => str_replace(':','',trans('menu.articles')),
        ];

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

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function getSomething (
        Request $request,
        string $key,
        string $head,
        Model $model,
        string $slug=null
    ): View
    {
        $this->authorize('view');
        $breadcrumbsParams = [];
        if ($request->has('parent_id')) $breadcrumbsParams['parent_id'] = $request->input('parent_id');

        if ($request->has('id')) {
            if (!isset($this->data[$key])) $this->data[$key] = $model->findOrFail($request->input('id'));
            $breadcrumbsParams['id'] = $this->data[$key]->id;
            $this->breadcrumbs[] = [
                'href' => $this->menu[$key.'s']['href'],
                'params' => $breadcrumbsParams,
                'name' => trans($this->getEditOrView().$key, [$key => $this->data[$key][$head]]),
            ];
            return $this->showView($key);
        } else if ($slug && $slug == 'add') {
            $this->authorize('edit');
            $breadcrumbsParams['slug'] = 'add';
            $this->breadcrumbs[] = [
                'href' => $this->menu[$key.'s']['href'],
                'params' => $breadcrumbsParams,
                'name' => trans('admin.adding_'.$key),
            ];
            return $this->showView($key);
        } else {
            if ($model instanceof HomePrice) $this->data[$key.'s'] = $model->orderBy('brand_id')->get();
            elseif ($model instanceof User && Gate::denies('all')) $this->data[$key.'s'] =  $model->where('type','<=',3)->get();
            else $this->data[$key.'s'] = $model->all();
            return $this->showView($key.'s');
        }
    }

    protected function showView($view): View
    {
        if (Gate::allows('all')) {
            foreach (
                [
                    'users',
                    'contents',
                    'offer_repairs',
                    'free_checks',
                    'prices',
                    'questions',
                    'clients',
                    'articles',
                    'gallery',
                    'csv_files',
                    'brands',
                    'def_cars',
                    'actions',
                    'site_map',
                    'records'
                ] as $menu) {
                    $this->menu[$menu]['hidden'] = false;
                }
        } else if (Gate::allows('records')) $this->menu['records']['hidden'] = false;

        return view('admin.'.$view, array_merge
            (
                ['breadcrumbs' => $this->breadcrumbs, 'menu' => $this->menu],
                $this->data
            )
        );
    }

    protected function getEditOrView(): string
    {
        return 'admin.'.(Gate::allows('edit') ? 'edit_' : 'view_');
    }
}
