<?php

namespace App\Controllers;
 
class Barang extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
    
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
        $barang_data = [
            'nama_barang' => $this->request->getVar('nama_barang'),
            'jenis' => $this->request->getVar('jenis'),
            'ukuran' => $this->request->getVar('ukuran'),
            'harga' => $this->request->getVar('harga'),
            'harga_jual' => $this->request->getVar('harga_jual'),
             
        ];

        $result = $this->barang_model->insert($barang_data);

        return redirect()->to('/barang');    
    }

    public function edit($barang_id)
    {
        $barang = $this->barang_model->getBarang($barang_id);

        return view('barang/edit_barang', ['barang' => $barang]);
        
    }

    public function process_edit()
    {
        $barang_id = $this->request->getVar('barang_id');

        $barang_data = [
            'nama_barang' => $this->request->getVar('nama_barang'),
            'jenis' => $this->request->getVar('jenis'),
            'ukuran' => $this->request->getVar('ukuran'),
            'harga' => $this->request->getVar('harga'),
            'harga_jual' => $this->request->getVar('harga_jual'),
            
        ];

        $result = $this->barang_model->update($barang_id, $barang_data);

        return redirect()->to('/barang');    
    }

    public function delete($barang_id)
    {
           $barang = $this->barang_model->delete($barang_id);

           return redirect()->to('/barang');
        
    }
    
}
