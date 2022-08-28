<?php

namespace App\Controllers;

class CabangDistribusi extends BaseController
{

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
    
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
        $cabang_data = [
            'nama_cabang' => $this->request->getVar('nama_cabang'),
            'kepala_cabang' => $this->request->getVar('kepala_cabang'),
            'alamat_cabang' => $this->request->getVar('alamat_cabang'),
            'email' => $this->request->getVar('email'),
            'no_telp' => $this->request->getVar('no_telp'),
             
        ];

        $result = $this->cabang_model->insert($cabang_data);

        return redirect()->to('/cabang');    
    }

    public function edit($cabang_id)
    {
        $cabang = $this->cabang_model->getCabang($cabang_id);

        return view('cabang_distribusi/edit_cabang_distribusi', ['cabang' => $cabang]);
    }

    public function process_edit()
    {
        $cabang_id = $this->request->getVar('cabang_id');

        $cabang_data = [
            'nama_cabang' => $this->request->getVar('nama_cabang'),
            'kepala_cabang' => $this->request->getVar('kepala_cabang'),
            'alamat_cabang' => $this->request->getVar('alamat_cabang'),
            'email' => $this->request->getVar('email'),
            'no_telp' => $this->request->getVar('no_telp'),
            
        ];

        $result = $this->cabang_model->update($cabang_id, $cabang_data);

        return redirect()->to('/cabang');    
    }

    public function delete($cabang_id)
    {
        $cabang = $this->cabang_model->delete($cabang_id);

           return redirect()->to('/cabang');
    }
}
