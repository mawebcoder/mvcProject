<?php

namespace App\http\Controllers;


class article extends Controller
{

    public function index()
    {
        echo 'index method in article';
    }

    public function test($id)
    {

        $name='ali';
        $this->view('article',compact('name'));
    }
}