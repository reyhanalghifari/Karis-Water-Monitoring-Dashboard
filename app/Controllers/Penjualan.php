<?php
 
namespace App\Controllers;

class Penjualan extends BaseController
{

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
    
        $this->penjualan_model = new \App\Models\Penjualan();
        $this->pelanggan_model = new \App\Models\Pelanggan();
        $this->barang_model = new \App\Models\Barang();
    }

    public function index()
    {
        $datapenjualan = $this->penjualan_model->getDataPenjualan();
        return view('penjualan/list_penjualan', ['datapenjualan' => $datapenjualan]);
    }

    public function add()
    {
        $data_pelanggan = $this->pelanggan_model->getDataPelanggan();
        $data_barang = $this->barang_model->getDataBarang();
        return view('penjualan/tambah_penjualan', ['data_pelanggan' => $data_pelanggan, 'data_barang' => $data_barang]);
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
