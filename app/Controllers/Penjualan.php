<?php
 
namespace App\Controllers;

class Penjualan extends BaseController
{

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
    
        $this->penjualan_model = new \App\Models\Penjualan();
    }

    public function index()
    {
        $datapenjualan = $this->penjualan_model->getDataPenjualan();
        return view('penjualan/list_penjualan', ['datapenjualan' => $datapenjualan]);
    }

    public function add()
    {
       return view('penjualan/tambah_penjualan');
    }

    public function process_add()
    {
        $penjualan_data = [
            'pelanggan_id' => $this->request->getVar('pelanggan_id'),
            'barang_id' => $this->request->getVar('barang_id'),
            'tanggal_penjualan' => $this->request->getVar('tanggal_penjualan'),
            'harga_saat_dibeli' => $this->request->getVar('harga_saat_dibeli'),
            'jumlah' => $this->request->getVar('jumlah'),
            
        ];

        $result = $this->penjualan_model->insert($penjualan_data);

        return redirect()->to('/penjualan');    
    }

    public function edit()
    {
        return view('penjualan/edit_penjualan');
    }

    public function delete()
    {
        // redirect halaman ke Barang/Index
    }
}
