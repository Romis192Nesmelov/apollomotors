<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Brand;
use App\Models\Client;
use App\Models\Contact;
use App\Models\FreeCheck;
use App\Models\OfferRepair;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BaseController extends Controller
{
    use HelperTrait;

    protected array $data = [];
    protected array $menu = [];
    protected string $activeMenu = '';
    protected string $activeSubMenu = '';
    protected $contacts;

    public function __construct()
    {
        $this->menu = [
            'home' =>           ['href' => true],
            'about' =>          ['sub' => ['about','cc']],
            'repair' =>         ['href' => false],
            'maintenance' =>    ['href' => false],
            'spares' =>         ['href' => false],
            'actions' =>        ['href' => true],
            'articles' =>       ['href' => true],
            'contacts' =>       ['href' => true]
        ];

        $this->contacts = Contact::all();
        $this->data['elected_brands'] = Brand::where('active',1)->where('elected',1)->get();
    }

    public function index() :View
    {
        $this->data['actions'] = Action::where('active',1)->get();
        $this->data['brands'] = Brand::where('active',1)->get();
        $this->data['offers_repair'] = OfferRepair::where('active',1)->get();
        $this->data['free_checks'] = FreeCheck::where('active',1)->get();
        $this->data['questions'] = Question::where('active',1)->get();
        $this->data['clients'] = Client::where('active',1)->get();
        return $this->showView('home');
    }

    public function about() :View
    {
        return $this->showView('home');
    }

    public function corporativeClients() :View
    {
        return $this->showView('home');
    }

    public function actions() :View
    {
        return $this->showView('home');
    }

    public function articles() :View
    {
        return $this->showView('home');
    }

    public function contacts() :View
    {
        return $this->showView('contacts');
    }

    public function policy() :View
    {
        return $this->showView('policy');
    }

    protected function showView($view) :View
    {
        return view($view, array_merge(
            $this->data,
            [
                'menu' => $this->menu,
                'activeMenu' => $this->activeMenu,
                'activeSubMenu' => $this->activeSubMenu,
                'contacts' => $this->contacts
            ]
        ));
    }
}
