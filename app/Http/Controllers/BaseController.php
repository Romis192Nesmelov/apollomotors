<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Article;
use App\Models\Brand;
use App\Models\Client;
use App\Models\Contact;
use App\Models\FreeCheck;
use App\Models\OfferRepair;
use App\Models\Question;
use App\Models\Content;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

class BaseController extends Controller
{
    use HelperTrait;

    protected array $data = [];
    protected array $menu = [];
    protected string $activeMenu = '';
    protected string $activeSubMenu = '';
    protected Collection $contacts;
    protected Collection $electedBrands;

    public function __construct()
    {
        $this->menu = [
            'home' =>           ['href' => true],
            'about' =>          ['sub' => ['about','cc']],
            'repair' =>         ['href' => false],
            'maintenance' =>    ['href' => false],
            'spare' =>         ['href' => false],
            'actions' =>        ['href' => true],
            'articles' =>       ['href' => true],
            'contacts' =>       ['href' => true]
        ];

        $this->contacts = Contact::all();
        $this->electedBrands = Brand::where('active',1)->where('elected',1)->get();
    }

    public function index() :View
    {
        $this->data['content'] = Content::find(1);
        $this->data['actions'] = Action::where('active',1)->get();
        $this->data['brands'] = Brand::where('active',1)->get();
        $this->data['offers_repair'] = OfferRepair::where('active',1)->get();
        $this->data['free_checks'] = FreeCheck::where('active',1)->get();
        $this->data['questions'] = Question::where('active',1)->get();
        $this->data['clients'] = Client::where('active',1)->get();
        $this->setSeo(Seo::find(1));
        return $this->showView('home');
    }

    public function search(Request $request) :View
    {
        $this->data['title'] = trans('content.search_result', ['search' => $request->text]);
        return $this->showView('search');
    }

    public function about() :View
    {
        $this->activeMenu = 'about';
        $this->data['content'] = Content::find(2);
        $this->setSeo($this->data['content']->seo);
        return $this->showView('about.about');
    }

    public function corporativeClients() :View
    {
        $this->activeMenu = 'about';
        return $this->showView('home');
    }

    public function actions($action=null) :View
    {
        $this->activeMenu = 'actions';
        if ($action) {
            $this->getItem('action', null, new Action(), $action);
            $this->setSeo($this->data['action']->seo);
            return $this->showView('actions.action');
        } else {
            $this->data['actions'] = Action::where('active',1)->get();
            $this->setSeo(Seo::find(3));
            return $this->showView('actions.actions');
        }
    }

    public function articles($slug=null) :View
    {
        $this->activeMenu = 'articles';
        $this->data['articles'] = Article::where('active',1)->get();
        if ($slug) {
            $this->data['article'] = Article::where('slug',$slug)->first();
            $this->setSeo($this->data['article']->seo);
            return $this->showView('articles.article');
        } else {
            $this->setSeo(Seo::find(2));
            return $this->showView('articles.articles');
        }
    }

    public function contacts() :View
    {
        $this->activeMenu = 'contacts';
        $this->setSeo(Seo::find(4));
        return $this->showView('contacts');
    }

    public function policy() :View
    {
        return $this->showView('policy');
    }

    protected function setSeo($seo): void
    {
        if ($seo) {
            foreach (['title', 'keywords', 'description'] as $item) {
                $this->data[$item] = $seo[$item];
            }
        }
    }

    protected function showView($view) :View
    {
        return view($view, array_merge(
            $this->data,
            [
                'menu' => $this->menu,
                'activeMenu' => $this->activeMenu,
                'activeSubMenu' => $this->activeSubMenu,
                'contacts' => $this->contacts,
                'electedBrands' => $this->electedBrands
            ]
        ));
    }

    protected function getItem(string $itemName, $relations, Model $model, $slug)
    {
        $contentSlugs = Content::where('id','>=',3)->where('id','<=',5)->pluck('slug')->toArray();
        $this->data[$itemName] = $model->where('slug',$slug)->where('active',1)->first();
//        dd($relations == $contentSlugs[1]);
        if (!$this->data[$itemName]) {
            abort(404, trans('404'));
        } elseif (
            $relations &&
            (
                !$this->data[$itemName][$relations] ||
                ($relations == $contentSlugs[1] && !count($this->data[$itemName][$relations]))
            )
        ) {
            // If brand is default
            if (in_array($relations, $contentSlugs)) {
                $this->data['content'] = Content::where('slug',$relations)->first();
            } else abort(404, trans('404'));
        }
    }
}
