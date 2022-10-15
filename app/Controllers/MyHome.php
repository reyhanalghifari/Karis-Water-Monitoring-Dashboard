<?php

namespace App\Controllers;

class MyHome extends BaseController
{
	public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
        $this->penjualan_model = new \App\Models\Penjualan();
        $this->cabang_model = new \App\Models\Cabang();
    }

    public function index()
    {
    	$list_tahun_penjualan = $this->penjualan_model->getTahunPenjualan();
    	$list_cabang = $this->cabang_model->getDataCabang();
        return view('homepage', ["list_tahun_penjualan" => $list_tahun_penjualan, "list_cabang" => $list_cabang]);
    }
}
