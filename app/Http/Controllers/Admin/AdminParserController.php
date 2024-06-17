<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Record;

class AdminParserController extends Controller
{
    public function __invoke()
    {
//        return view('admin.parser', ['missing_mechanics' => MissingMechanic::all()]);
        return view('admin.parser', ['records' => Record::all()]);
    }
}
