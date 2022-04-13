<?php

namespace App\http\Controllers;

class category extends Controller
{

    public \App\Models\Category $category;

    public function __construct()
    {
        $this->category = new \App\Models\Category();
    }

    public function index()
    {

        print_r($this->category->all());

    }

    public function show($id)
    {
        print_r($this->category->find(1));
    }


    public function update($id)
    {
        $values = ['title' => 'new title 2'];

        $this->category->update($id, $values);
    }


    public function store()
    {
        $values = ['title' => 'category title'];

        $this->category->insert($values);
    }

    public function delete($id)
    {
        $this->category->delete($id);
    }
}