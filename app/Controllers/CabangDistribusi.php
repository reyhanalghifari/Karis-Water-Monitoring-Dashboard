<?php

namespace App\Controllers;

class CabangDistribusi extends BaseController
{

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
        $this->cabang_model = new \App\Models\Cabang();
    }
 
    public function index()
    {
        $datacabang = $this->cabang_model->getDataCabang();
        return view('cabang_distribusi/list_cabang_distribusi', ['datacabang' => $datacabang]);
    }

    public function add()
    {
    	return view('cabang_distribusi/tambah_cabang_distribusi');
    }

    public function process_add()
    {
        $this->validation->setRules(
            [
                'nama_cabang' => 'required',
                'kepala_cabang' => 'required',
                'alamat_cabang' => 'required',
                'email' => 'required',
                'no_telp' => 'required|integer',
            ],
            
            [   // Errors
                'nama_cabang' => [
                    'required' => 'Nama cabang tidak boleh kosong',
                    
                ],
                'kepala_cabang' => [
                    'required' => 'Nama kepala cabang tidak boleh kosong',
                    
                ],

                'alamat_cabang' => [
                    'required' => 'Alamat cabang tidak boleh kosong',
                    
                ],

                'email' => [
                    'required' => 'Email cabang tidak boleh kosong',
                    
                ],

                'no_telp' => [
                    'required' => 'Nomor telepon cabang tidak boleh kosong',
                    'integer' => 'Nomor telepon cabang harus diisi dengan angka'
                ],

            ]
        );

        if (! $this->validation->withRequest($this->request)->run()) {
            $this->session->setFlashdata('form_tambah_cabang_error_message', $this->validation->getErrors());
            return redirect()->to('/cabang/add');
        }
        else {
            $cabang_data = [
                'nama_cabang' => $this->request->getVar('nama_cabang'),
                'kepala_cabang' => $this->request->getVar('kepala_cabang'),
                'alamat_cabang' => $this->request->getVar('alamat_cabang'),
                'email' => $this->request->getVar('email'),
                'no_telp' => $this->request->getVar('no_telp'),
                'tipe_cabang' => $this->request->getVar('tipe_cabang'),
            ];

            $result = $this->cabang_model->insert($cabang_data);
            $this->session->setFlashdata('form_tambah_cabang_success_message', 'Tambah cabang berhasil');
            return redirect()->to('/cabang');    
        }
    }

    public function edit($cabang_id)
    {
        $cabang = $this->cabang_model->getCabang($cabang_id);

        return view('cabang_distribusi/edit_cabang_distribusi', ['cabang' => $cabang]);
    }

    public function process_edit()
    {
        $cabang_id = $this->request->getVar('cabang_id');

        $this->validation->setRules(
            [
                'nama_cabang' => 'required',
                'kepala_cabang' => 'required',
                'alamat_cabang' => 'required',
                'email' => 'required',
                'no_telp' => 'required|integer',
            ],
            
            [   // Errors
                'nama_cabang' => [
                    'required' => 'Nama cabang tidak boleh kosong',
                    
                ],
                'kepala_cabang' => [
                    'required' => 'Nama kepala cabang tidak boleh kosong',
                    
                ],

                'alamat_cabang' => [
                    'required' => 'Alamat cabang tidak boleh kosong',
                    
                ],

                'email' => [
                    'required' => 'Email cabang tidak boleh kosong',
                    
                ],

                'no_telp' => [
                    'required' => 'Nomor telepon cabang tidak boleh kosong',
                    'integer' => 'Nomor telepon cabang harus diisi dengan angka'
                ],

            ]
        );

        if (! $this->validation->withRequest($this->request)->run()) {
            $this->session->setFlashdata('form_edit_cabang_error_message', $this->validation->getErrors());
            return redirect()->to('/cabang/edit/'.$cabang_id);
        }
        else {

            $cabang_data = [
                'nama_cabang' => $this->request->getVar('nama_cabang'),
                'kepala_cabang' => $this->request->getVar('kepala_cabang'),
                'alamat_cabang' => $this->request->getVar('alamat_cabang'),
                'email' => $this->request->getVar('email'),
                'no_telp' => $this->request->getVar('no_telp'),
                'tipe_cabang' => $this->request->getVar('tipe_cabang'),
            ];

            $result = $this->cabang_model->update($cabang_id, $cabang_data);
            $this->session->setFlashdata('form_edit_cabang_success_message', 'Edit cabang berhasil');
            return redirect()->to('/cabang');    
        }
    }

    public function delete($cabang_id)
    {
        $cabang = $this->cabang_model->delete($cabang_id);
        $this->session->setFlashdata('delete_cabang_success_message', 'Hapus cabang berhasil!');
           return redirect()->to('/cabang');
    }
}
