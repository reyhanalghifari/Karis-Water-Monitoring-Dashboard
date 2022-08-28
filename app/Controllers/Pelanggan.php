<?php
 
namespace App\Controllers;
 
class Pelanggan extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
    
        $this->pelanggan_model = new \App\Models\Pelanggan();
    }

    public function index()
    {
        $datapelanggan = $this->pelanggan_model->getDataPelanggan();
        return view('pelanggan/list_pelanggan', ['datapelanggan' => $datapelanggan]);
    }

    public function add()
    {
        return view('pelanggan/tambah_pelanggan');
    }

    public function process_add()
    {
        $pelanggan_data = [
            'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
            'alamat_pelanggan' => $this->request->getVar('alamat_pelanggan'),
            'no_telepon' => $this->request->getVar('no_telepon'),
            'email' => $this->request->getVar('email'),
            
        ];

        $result = $this->pelanggan_model->insert($pelanggan_data);

        return redirect()->to('/pelanggan');    
    }

    public function edit($pelanggan_id)
    {
        $pelanggan = $this->pelanggan_model->getPelanggan($pelanggan_id);

        return view('pelanggan/edit_pelanggan', ['pelanggan' => $pelanggan]);
    }

    public function process_edit()
    {
        $pelanggan_id = $this->request->getVar('pelanggan_id');

        $pelanggan_data = [
            'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
            'alamat_pelanggan' => $this->request->getVar('alamat_pelanggan'),
            'no_telepon' => $this->request->getVar('no_telepon'),
            'email' => $this->request->getVar('email'),
            
        ];

        $result = $this->pelanggan_model->update($pelanggan_id, $pelanggan_data);

        return redirect()->to('/pelanggan');    
    }

    public function delete($pelanggan_id)
    {
        $pelanggan = $this->pelanggan_model->delete($pelanggan_id);

           return redirect()->to('/pelanggan');
    }
}
