<?php

namespace App\Http\Controllers;

use App\Models\Spare;
use Illuminate\View\View;
//use Illuminate\Http\Request;

class BrandController extends BaseController
{
    use HelperTrait;

//    public function parser()
//    {
//        return view('parser', ['spares' => Spare::all()]);
//    }

    public function __construct()
    {
        parent::__construct();
    }

    public function repair($slug=null) :View
    {
        return $this->showView('repair');
    }

    public function maintenance($slug=null) :View
    {
        return $this->showView('maintenance');
    }

    public function spares($slug=null) :View
    {
        return $this->showView('spares');
    }
}
