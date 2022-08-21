<?php

namespace App\Controllers;

class User extends BaseController
{

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
    
        $this->user_model = new \App\Models\User();
    }

    public function index()
    {
        $users = $this->user_model->getUsers();
        return view('user/list_user', ['users' => $users]);
    }

    public function add()
    { 
        return view('user/tambah_user');
    }

    public function process_add()
    {
        $user_data = [
            'username' => $this->request->getVar('username'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'password' => hash('sha256', $this->request->getVar('password')),
            'email' => $this->request->getVar('email'),
            'account_type' => $this->request->getVar('account_type'),
            'user_status' => $this->request->getVar('user_status'),
        ];

        $result = $this->user_model->insert($user_data);

        return redirect()->to('/user');    
    }

    public function edit($user_id)
    {
        $user = $this->user_model->getUser($user_id);

        return view('user/edit_user', ['user' => $user]);
    }

    public function process_edit()
    {
        $user_id = $this->request->getVar('user_id');

        $user_data = [
            'username' => $this->request->getVar('username'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'password' => hash('sha256', $this->request->getVar('password')),
            'email' => $this->request->getVar('email'),
            'account_type' => $this->request->getVar('account_type'),
            'user_status' => $this->request->getVar('user_status'),
        ];

        $result = $this->user_model->update($user_id, $user_data);

        return redirect()->to('/user');    
    }

    public function delete($user_id)
    {
        $user = $this->user_model->setAsInactive($user_id);

        return redirect()->to('/user');  
    }

    public function user_profile()
    {
        $user_id = $this->session->get('user_id');
        $user = $this->user_model->getUser($user_id);

        return view('user/user_profile', ['user' => $user]);
    }

    public function edit_user_profile()
    {
        $user_id = $this->request->getVar('user_id');
        $username = $this->request->getVar('username');
        $nama_lengkap = $this->request->getVar('nama_lengkap');

        $result = $this->user_model->changeUserProfile($user_id, $nama_lengkap, $username);

        if ($result == 1) {
            $this->session->set([
                'username' => $username,
                'nama_lengkap' => $nama_lengkap
            ]);
        }

        return redirect()->to('/user-profile');    
    }
}
