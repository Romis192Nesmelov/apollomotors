<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

class CronController extends Controller
{
    use HelperTrait;

//    public function __construct()
//    {
//        $this->middleware('secret');
//    }

    public function hourly()
    {
        $this->checkVir();
    }

    public function daily()
    {
        $this->autoProlongation();
        $this->sendNotifications();
    }

    public function monthly()
    {
        $this->sqlDump();
    }
}
