<?php

namespace App\Controllers;
 
class Barang extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
        $this->barang_model = new \App\Models\Barang();
    }
    public function index()
    {
        $databarang = $this->barang_model->getDataBarang();
        return view('barang/list_barang', ['databarang' => $databarang]);
        
    }

    public function add()
    {
        return view('barang/tambah_barang');
    }

     public function process_add()
    {
        $this->validation->setRules(
            [
                'nama_barang' => 'required',
                'jenis' => 'required',
                'harga' => 'required|integer',
                'harga_jual' => 'required|integer',
            ],
            [   // Errors
                'nama_barang' => [
                    'required' => 'Nama Barang tidak boleh kosong',
                    
                ],
                'jenis' => [
                    'required' => 'Jenis Barang tidak boleh kosong',
                    
                ],

                'harga' => [
                    'required' => 'Harga Barang tidak boleh kosong',
                    'integer' => 'Harga harus diisi dengan angka'
                ],

                'harga_jual' => [
                    'required' => 'Harga Jual Barang tidak boleh kosong',
                    'integer' => 'Harga jual harus diisi dengan angka'
                ],
            ]
        );

        if (! $this->validation->withRequest($this->request)->run()) {
            $this->session->setFlashdata('form_tambah_barang_error_message', $this->validation->getErrors());
            return redirect()->to('/barang/add');
        }
        else {
            $barang_data = [
                'nama_barang' => $this->request->getVar('nama_barang'),
                'jenis' => $this->request->getVar('jenis'),
                'ukuran' => $this->request->getVar('ukuran'),
                'harga' => $this->request->getVar('harga'),
                'harga_jual' => $this->request->getVar('harga_jual'),
         
            ];
            
            $result = $this->barang_model->insert($barang_data);
            $this->session->setFlashdata('form_tambah_barang_success_message', 'Tambah barang berhasil');
            return redirect()->to('/barang');
        }
    }

    public function edit($barang_id)
    {
        $barang = $this->barang_model->getBarang($barang_id);

        return view('barang/edit_barang', ['barang' => $barang]);
        
    }

    public function process_edit()
    {
        $barang_id = $this->request->getVar('barang_id');

        $this->validation->setRules(
            [
                'nama_barang' => 'required',
                'jenis' => 'required',
                'harga' => 'required|integer',
                'harga_jual' => 'required|integer',
            ],
            [   // Errors
                'nama_barang' => [
                    'required' => 'Nama Barang tidak boleh kosong',
                    
                ],
                'jenis' => [
                    'required' => 'Jenis Barang tidak boleh kosong',
                    
                ],

                'harga' => [
                    'required' => 'Harga Barang tidak boleh kosong',
                    'integer' => 'Harga harus diisi dengan angka'
                ],

                'harga_jual' => [
                    'required' => 'Harga Jual Barang tidak boleh kosong',
                    'integer' => 'Harga jual harus diisi dengan angka'
                ],
            ]
        );

        if (! $this->validation->withRequest($this->request)->run()) {
            $this->session->setFlashdata('form_edit_barang_error_message', $this->validation->getErrors());
            return redirect()->to('/barang/edit/'.$barang_id);
        }
        else {
        $barang_data = [
            'nama_barang' => $this->request->getVar('nama_barang'),
            'jenis' => $this->request->getVar('jenis'),
            'ukuran' => $this->request->getVar('ukuran'),
            'harga' => $this->request->getVar('harga'),
            'harga_jual' => $this->request->getVar('harga_jual'),
            
        ];

        $result = $this->barang_model->update($barang_id, $barang_data);
        $this->session->setFlashdata('form_edit_barang_success_message', 'Edit barang berhasil');
        return redirect()->to('/barang');    
        }
    }

    public function delete($barang_id)
    {
           $barang = $this->barang_model->delete($barang_id);
           $this->session->setFlashdata('delete_barang_success_message', 'Hapus barang berhasil!');
           return redirect()->to('/barang');
        
    }
    
}
