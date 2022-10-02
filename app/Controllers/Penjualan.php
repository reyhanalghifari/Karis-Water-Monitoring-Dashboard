<?php
 
namespace App\Controllers;

class Penjualan extends BaseController
{

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
    
        $this->penjualan_model = new \App\Models\Penjualan();
        $this->pelanggan_model = new \App\Models\Pelanggan();
        $this->barang_model = new \App\Models\Barang();
    }

    public function index()
    {
        if ($this->session->get('cabang_id') != ""){
            $datapenjualan = $this->penjualan_model->getDataPenjualanByCabangID($this->session->get('cabang_id'));
        } else {
            $datapenjualan = $this->penjualan_model->getDataPenjualan();   
        }

        return view('penjualan/list_penjualan', ['datapenjualan' => $datapenjualan]);
    }

    public function add()
    {
        $data_pelanggan = $this->pelanggan_model->getDataPelanggan();
        $data_barang = $this->barang_model->getDataBarang();
        return view('penjualan/tambah_penjualan', ['data_pelanggan' => $data_pelanggan, 'data_barang' => $data_barang]);
    }

    public function add_cabang()
    {
        $data_pelanggan = $this->pelanggan_model->getDataPelanggan();
        $data_barang = $this->barang_model->getDataBarang();
        return view('penjualan/tambah_penjualan_cabang', ['data_pelanggan' => $data_pelanggan, 'data_barang' => $data_barang]);
    }

    public function process_add()
    {

        $this->validation->setRules(
            [
                'jumlah' => 'required|integer',
                
            ],
            
            [   // Errors
                
                'jumlah' => [
                    'required' => 'Jumlah pembelian tidak boleh kosong',
                    'integer' => 'Jumlah pembelian harus di isi dengan angka'
                ],

            ]
        );

        if (! $this->validation->withRequest($this->request)->run()) {
            $this->session->setFlashdata('form_penjualan_error_message', $this->validation->getErrors());
            return redirect()->to('/penjualan/add');
        }
        else {

            $penjualan_data = [
                'user_id' => $this->request->getVar('user_id'),
                'cabang_id' => $this->request->getVar('cabang_id'),
                'pelanggan_id' => $this->request->getVar('pelanggan_id'),
                'barang_id' => $this->request->getVar('barang_id'),
                'tanggal_penjualan' => $this->request->getVar('tanggal_penjualan'),
                'jenis_transaksi' => $this->request->getVar('jenis_transaksi'),
                'harga_saat_dibeli' => $this->request->getVar('harga_saat_dibeli'),
                'jumlah' => $this->request->getVar('jumlah'),
            
            ];

            $result = $this->penjualan_model->insert($penjualan_data);
            $this->session->setFlashdata('form_penjualan_success_message', 'Transaksi berhasil');
            return redirect()->to('/penjualan');    
        }
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
