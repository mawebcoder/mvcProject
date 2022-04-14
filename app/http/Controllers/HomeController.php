<?php

namespace App\http\Controllers;


use App\Models\Test;

class HomeController extends Controller
{

    public function index()
    {

        (new Test())->firstName;

    }

}