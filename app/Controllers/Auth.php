<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        echo "Logging in...";
    }

    public function logout()
    {
        echo "Logging out...";
    }

    public function registration()
    {
        echo "Registration...";
    }

    public function user_profile()
    {
        return view('user/user_profile');
    }
}
