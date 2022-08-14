<?php

namespace App\Controllers;

class MyHome extends BaseController
{
    public function index()
    {
        return view('homepage');
    }
}
