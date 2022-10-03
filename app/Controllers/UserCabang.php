<?php

namespace App\Controllers;

class UserCabang extends BaseController
{
 
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
        $this->user_cabang_model = new \App\Models\UserCabang();
        $this->cabang_model = new \App\Models\Cabang();
    }
  
    public function index()
    {
        $users = $this->user_cabang_model->getUserCabang();
        return view('user_cabang/list_user_cabang', ['users' => $users]);
    }

    public function add()
    { 
        $users = $this->user_cabang_model->getUnassignedUsers();
        $list_cabang = $this->cabang_model->getDataCabang();
        return view('user_cabang/tambah_user_cabang', ['list_cabang' => $list_cabang, 'users' => $users]);
    }

    public function process_add()
    {

        $this->validation->setRules(
            [
                'user_id' => 'required',
                'cabang_id' => 'required',
            ],
            
            [   // Errors
                'user_id' => [
                    'required' => 'Nama lengkap tidak boleh kosong',
                    
                ],

                'cabang_id' => [
                    'required' => 'Username tidak boleh kosong',
                ],
            ]
        );

        if (! $this->validation->withRequest($this->request)->run()) {
            $this->session->setFlashdata('form_tambah_user_error_message', $this->validation->getErrors());
            return redirect()->to('/user-cabang/add');
        }
        else {

            $user_data = [
                'user_id' => $this->request->getVar('user_id'),
                'cabang_id' => $this->request->getVar('cabang_id'),
            ];

            $result = $this->user_cabang_model->insert($user_data);
            $this->session->setFlashdata('form_tambah_user_success_message', 'Tambah penempatan pengguna berhasil');
            return redirect()->to('/user-cabang');    
        }
    }

    public function delete($user_cabang_id)
    {
        $user_cabang = $this->user_cabang_model->delete($user_cabang_id);

        $this->session->setFlashdata('delete_user_success_message', 'Hapus penempatan pengguna berhasil!');
        return redirect()->to('/user-cabang');  
    }
}
