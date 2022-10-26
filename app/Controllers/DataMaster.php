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

    public function getPenjualanPerTahun($cabang_id)
    {
        $penjualan = $this->penjualan_model->getPenjualanPerTahunByCabang($cabang_id);

        echo json_encode($penjualan);
    }

    public function getPenjualanPerMinggu($cabang_id, $tahun, $bulan)
    {
        $penjualan = $this->penjualan_model->getPenjualanPerMingguByCabang($cabang_id, $tahun, $bulan);

        echo json_encode($penjualan);
    }

    public function getTahunPenjualan()
    {
        $penjualan = $this->penjualan_model->getTahunPenjualan();

        echo json_encode($penjualan);
    }

    public function getPenjualanPerHari($cabang_id, $tahun, $bulan)
    {
        $penjualan = $this->penjualan_model->getPenjualanPerHariByCabang($cabang_id, $tahun, $bulan);

        echo json_encode($penjualan);
    }
}
