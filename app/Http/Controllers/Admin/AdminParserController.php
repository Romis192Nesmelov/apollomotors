<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\MissingMechanic;
//use Illuminate\Http\Request;
//use Illuminate\View\View;

class AdminParserController extends Controller
{
    public function __invoke()
    {
        return view('admin.parser', ['missing_mechanics' => MissingMechanic::all()]);
    }
}
