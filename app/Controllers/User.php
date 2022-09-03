<?php

namespace App\Controllers;

class User extends BaseController
{
 
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
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
            'no_telp' => $this->request->getVar('no_telp'),
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
            'no_telp' => $this->request->getVar('no_telp'),
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

        $this->validation->setRules(
            [
                'user_id' => 'required',
                'username' => 'required|min_length[3]',
                'nama_lengkap' => 'required|min_length[3]',
            ],
            [   // Errors
                'user_id' => [
                    'required' => 'User ID tidak boleh kosong',
                ],
                'username' => [
                    'required' => 'Username tidak boleh kosong',
                    'min_length' => 'Username tidak boleh kurang dari 3 karakter',
                ],
                'nama_lengkap' => [
                    'required' => 'Nama Lengkap tidak boleh kosong',
                    'min_length' => 'Nama Lengkap tidak boleh kurang dari 3 karakter',
                ],
            ]
        );

        if (! $this->validation->withRequest($this->request)->run()) {
            $this->session->setFlashdata('login_form_error_message', $this->validation->getErrors());
            return redirect()->to('/user-profile');
        }
        else {
            $result = $this->user_model->changeUserProfile($user_id, $nama_lengkap, $username);

            if ($result == 1) {
                $this->session->set([
                    'username' => $username,
                    'nama_lengkap' => $nama_lengkap
                ]);
            }

            $this->session->setFlashdata('login_form_success_message', "Edit profile berhasil!");
            return redirect()->to('/user-profile');
        }
    }
}
