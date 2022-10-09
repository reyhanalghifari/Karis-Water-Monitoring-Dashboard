<?php

namespace App\Controllers;
 
class DataMaster extends BaseController
{
    public function __construct()
    {
        $this->barang_model = new \App\Models\Barang();
        $this->penjualan_model = new \App\Models\Penjualan();
    }

    public function getBarang($barang_id)
    {
        $barang = $this->barang_model->getBarang($barang_id);

        echo json_encode($barang);
    }

    public function getPenjualanPerBulan($cabang_id, $tahun)
    {
    	$penjualan = $this->penjualan_model->getPenjualanPerBulanByCabang($cabang_id, $tahun);

        echo json_encode($penjualan);
    }
}
