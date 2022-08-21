<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();

        $this->user_model = new \App\Models\User();
    }

    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $result = $this->user_model->authenticate($username, $password);

        if ($result != null) {
            
            $user_data = [
                'username' => $result->username,
                'nama_lengkap' => $result->nama_lengkap,
                'account_type' => $result->account_type,
                'user_status' => $result->user_status,
                'email' => $result->email,
                'user_id' => $result->user_id,
                'logged_in' => true,
            ];

            $this->session->set($user_data);

            // kalau sukses, redirect ke halaman dashboard
            return redirect()->to('/');                
        }
        else {
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $this->session->destroy();

        // kalau sukses, redirect ke halaman login
        return redirect()->to('/login');
    }

    public function registration()
    {
        echo "Registration...";
    }

    public function process_registration()
    {
        echo "Process Registration...";
    }
}
