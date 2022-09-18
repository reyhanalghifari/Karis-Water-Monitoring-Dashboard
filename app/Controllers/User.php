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

        $this->validation->setRules(
            [
                'nama_lengkap' => 'required',
                'username' => 'required|min_length[3]',
                'password' => 'required|min_length[5]',
                'email' => 'required|valid_email',
                'no_telp' => 'required|integer',
                
            ],
            
            [   // Errors
                'nama_lengkap' => [
                    'required' => 'Nama lengkap tidak boleh kosong',
                    
                ],

                'username' => [
                    'required' => 'Username tidak boleh kosong',
                    'min_length' => 'Username tidak boleh kurang dari 3 karakter',
                    
                ],

                'password' => [
                    'required' => 'Password tidak boleh kosong',
                    'min_length' => 'Password tidak boleh kurang dari 5 karakter',
                ],
                    
            
                'email' => [
                    'required' => 'Email pelanggan tidak boleh kosong',
                    'valid_email' => 'Data email harus berupa alamat email',
                    
                ],

                'no_telp' => [
                    'required' => 'Nomor telepon tidak boleh kosong',
                    'integer' => 'Nomor telepon harus di isi dengan angka',
                    
                ],                

            ]
        );

        if (! $this->validation->withRequest($this->request)->run()) {
            $this->session->setFlashdata('form_tambah_user_error_message', $this->validation->getErrors());
            return redirect()->to('/user/add');
        }
        else {

            $user_data = [
                'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                'username' => $this->request->getVar('username'),
                'password' => hash('sha256', $this->request->getVar('password')),
                'email' => $this->request->getVar('email'),
                'no_telp' => $this->request->getVar('no_telp'),
                'account_type' => $this->request->getVar('account_type'),
                'user_status' => $this->request->getVar('user_status'),
            ];

            $result = $this->user_model->insert($user_data);
            $this->session->setFlashdata('form_tambah_user_success_message', 'Tambah pengguna berhasil');
            return redirect()->to('/user');    
        }
    }

    public function edit($user_id)
    {
        $user = $this->user_model->getUser($user_id);

        return view('user/edit_user', ['user' => $user]);
    }

    public function process_edit()
    {
        $user_id = $this->request->getVar('user_id');

        $this->validation->setRules(
            [
                'nama_lengkap' => 'required',
                'username' => 'required|min_length[3]',
                'email' => 'required|valid_email',
                'no_telp' => 'required|integer',
                
            ],
            
            [   // Errors
                'nama_lengkap' => [
                    'required' => 'Nama lengkap tidak boleh kosong',
                    
                ],

                'username' => [
                    'required' => 'Username tidak boleh kosong',
                    'min_length' => 'Username tidak boleh kurang dari 3 karakter',
                    
                ],
                'email' => [
                    'required' => 'Email pelanggan tidak boleh kosong',
                    'valid_email' => 'Data email harus berupa alamat email'
                    
                ],

                'no_telp' => [
                    'required' => 'Nomor telepon tidak boleh kosong',
                    'integer' => 'Nomor telepon harus di isi dengan angka'
                    
                ],                

            ]
        );

        if (! $this->validation->withRequest($this->request)->run()) {
            $this->session->setFlashdata('form_edit_user_error_message', $this->validation->getErrors());
            return redirect()->to('/user/edit/'.$user_id);
        }
        else {

            $user_data = [
                'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'no_telp' => $this->request->getVar('no_telp'),
                'account_type' => $this->request->getVar('account_type'),
                'user_status' => $this->request->getVar('user_status'),
            ];

            $result = $this->user_model->update($user_id, $user_data);
            $this->session->setFlashdata('form_edit_user_success_message', 'Edit pengguna berhasil!');
            return redirect()->to('/user');    
        }
    }

    public function delete($user_id)
    {
        $user = $this->user_model->setAsInactive($user_id);

        $this->session->setFlashdata('delete_user_success_message', 'Hapus pengguna berhasil!');
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
