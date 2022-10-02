<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
        $this->user_model = new \App\Models\User();
        $this->user_cabang_model = new \App\Models\UserCabang();
    }

    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $this->validation->setRules(
            [
                'username' => 'required|min_length[3]',
                'password' => 'required|min_length[5]',
            ],
            [   // Errors
                'username' => [
                    'required' => 'Username tidak boleh kosong',
                    'min_length' => 'Username tidak boleh kurang dari 3 karakter',
                ],
                'password' => [
                    'required' => 'Password tidak boleh kosong',
                    'min_length' => 'Password tidak boleh kurang dari 5 karakter',
                ],
            ]
        );

        if (! $this->validation->withRequest($this->request)->run()) {
            $this->session->setFlashdata('login_form_error_message', $this->validation->getErrors());
            return redirect()->to('/login');
        }
        else {
            $result = $this->user_model->authenticate($username, $password);

            if ($result != null) {
                $user_cabang = $this->user_cabang_model->getUserCabangByUserId($result->user_id);
                $tipe_cabang = "";
                $cabang_id = "";
                if ( isset($user_cabang->tipe_cabang)){
                    $tipe_cabang =  $user_cabang->tipe_cabang;
                    $cabang_id = $user_cabang->cabang_id;
                }

                $user_data = [
                    'nama_lengkap' => $result->nama_lengkap,
                    'username' => $result->username,
                    'account_type' => $result->account_type,
                    'user_status' => $result->user_status,
                    'email' => $result->email,
                    'user_id' => $result->user_id,
                    'logged_in' => true,
                    'tipe_cabang' => $tipe_cabang,
                    'cabang_id' => $cabang_id
                ];

                $this->session->set($user_data);

                // kalau sukses, redirect ke halaman dashboard
                return redirect()->to('/');                
            }
            else {
                $this->session->setFlashdata('login_form_error_message', 'Akun tidak ditemukan. Tidak dapat mengakses sistem!');
                return redirect()->to('/login');
            }
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
