<?php

namespace App\Controllers;
 
class DataMaster extends BaseController
{
    public function __construct()
    {
        $this->barang_model = new \App\Models\Barang();
        $this->penjualan_model = new \App\Models\Penjualan();
        $this->cabang_model = new \App\Models\Cabang();
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

    public function getPenjualanPerMingguTahunan($cabang_id, $tahun)
    {
        $penjualan = $this->penjualan_model->getPenjualanPerMingguByCabangTahunan($cabang_id, $tahun);

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

    public function getPenjualanTahunanAllCabang()
    {

        // ambil semua tahun
        $list_tahun_penjualan = $this->penjualan_model->getTahunPenjualan();

        // ambil semua cabang
        $list_cabang = $this->cabang_model->getDataCabang();

        // ambil data penjualan tahunan setiap cabangnya
        $penjualan_tahunan_all_cabang = array();
        foreach ($list_tahun_penjualan as $tahun) {
            $row = array("tahun" => $tahun->tahun_penjualan);
            foreach ($list_cabang as $cabang) {
                $penjualan = $this->penjualan_model->getPenjualanPerTahunTertentuByCabang($cabang->cabang_id, $tahun->tahun_penjualan);

                $nama_cabang = str_replace(" ", "-", strtolower($cabang->nama_cabang));
                if (is_object($penjualan)){
                    $row[$nama_cabang] = $penjualan->total_pembelian;
                } else {
                    $row[$nama_cabang] = 0;
                }
                
            }

            array_push($penjualan_tahunan_all_cabang, $row);
        }

        echo json_encode($penjualan_tahunan_all_cabang);
    }

    public function getPenjualanBulananAllCabang($tahun)
    {
        // ambil semua cabang
        $list_cabang = $this->cabang_model->getDataCabang();

        // ambil data penjualan tahunan setiap cabangnya
        $penjualan_bulanan_all_cabang = array();
        for ($i = 1; $i < 13; $i++) {
            $row = array("bulan" => $i);
            foreach ($list_cabang as $cabang) {
                $penjualan = $this->penjualan_model->getPenjualanPerBulanTertentuByCabang($cabang->cabang_id, $i, $tahun);

                $nama_cabang = str_replace(" ", "-", strtolower($cabang->nama_cabang));
                if (is_object($penjualan)){
                    $row[$nama_cabang] = $penjualan->total_pembelian;
                } else {
                    $row[$nama_cabang] = 0;
                }
            }

            array_push($penjualan_bulanan_all_cabang, $row);
        }

        echo json_encode($penjualan_bulanan_all_cabang);
    }

    public function getPenjualanHarianAllCabang($tahun, $bulan)
    {
        // ambil semua cabang
        $list_cabang = $this->cabang_model->getDataCabang();

        $lama_hari = 0;

        $odd_months = [1, 3, 5, 7, 8, 10, 12];
        $even_months = [4, 6, 9, 11];

        if (in_array($bulan, $odd_months)){
            // January, March, May, July, August, October, December

            $lama_hari = 31;
        } else if (in_array($bulan, $even_months)){
            // April, June, September, November

            $lama_hari = 30;
        } else {
            // February
            
            $lama_hari = 28;
        }

        // ambil data penjualan tahunan setiap cabangnya
        $penjualan_harian_all_cabang = array();
        for ($i = 1; $i <= $lama_hari; $i++) {
            $row = array("tanggal" => $i);
            foreach ($list_cabang as $cabang) {
                $penjualan = $this->penjualan_model->getPenjualanPerHariTertentuByCabang($cabang->cabang_id, $i, $bulan, $tahun);

                $nama_cabang = str_replace(" ", "-", strtolower($cabang->nama_cabang));
                if (is_object($penjualan)){
                    $row[$nama_cabang] = $penjualan->total_pembelian;
                } else {
                    $row[$nama_cabang] = 0;
                }
            }

            array_push($penjualan_harian_all_cabang, $row);
        }

        echo json_encode($penjualan_harian_all_cabang);
    }

    public function getPenjualanMingguanAllCabang($tahun, $bulan)
    {
        // ambil semua cabang
        $list_cabang = $this->cabang_model->getDataCabang();

        $lama_hari = 0;

        // tentukan lamanya hari
        $odd_months = [1, 3, 5, 7, 8, 10, 12];
        $even_months = [4, 6, 9, 11];

        if (in_array($bulan, $odd_months)){
            // January, March, May, July, August, October, December

            $lama_hari = 31;
        } else if (in_array($bulan, $even_months)){
            // April, June, September, November

            $lama_hari = 30;
        } else {
            // February
            
            $lama_hari = 28;
        }

        // tentukan lamanya minggu
        $tanggal_awal_bulan = $tahun."-".$bulan."-1";
        $tanggal_akhir_bulan = $tahun."-".$bulan."-".$lama_hari;

        // hitung awal minggu dan akhir minggu suatu bulan dengan MySQL
        $awal_bulan = new \DateTime($tanggal_awal_bulan);
        $minggu_awal = (int) $awal_bulan->format("W");

        if ($minggu_awal >= 52){
            $minggu_awal = 1;
        }

        $akhir_bulan = new \DateTime($tanggal_akhir_bulan);
        $minggu_akhir = (int) $akhir_bulan->format("W");

        // echo $minggu_awal." --- ".$minggu_akhir;

        // ambil data penjualan tahunan setiap cabangnya
        $penjualan_mingguan_all_cabang = array();

        $j = 1;
        for ($i = $minggu_awal; $i <= $minggu_akhir; $i++) {
            $row = array("minggu" => $j);
            foreach ($list_cabang as $cabang) {
                $penjualan = $this->penjualan_model->getPenjualanPerMingguTertentuByCabang($cabang->cabang_id, $tahun, $bulan, $i);

                $nama_cabang = str_replace(" ", "-", strtolower($cabang->nama_cabang));
                if (is_object($penjualan)){
                    $row[$nama_cabang] = $penjualan->total_pembelian;
                } else {
                    $row[$nama_cabang] = 0;
                }
            }

            array_push($penjualan_mingguan_all_cabang, $row);
            $j++;
        }

        echo json_encode($penjualan_mingguan_all_cabang);
    }

    public function getGalonTerjualTahunanAllCabang()
    {

        // ambil semua tahun
        $list_tahun_penjualan = $this->penjualan_model->getTahunPenjualan();

        // ambil semua cabang
        $list_cabang = $this->cabang_model->getDataCabang();

        // ambil data penjualan tahunan setiap cabangnya
        $penjualan_tahunan_all_cabang = array();
        foreach ($list_tahun_penjualan as $tahun) {
            $row = array("tahun" => $tahun->tahun_penjualan);
            foreach ($list_cabang as $cabang) {
                $penjualan = $this->penjualan_model->getPenjualanPerTahunTertentuByCabang($cabang->cabang_id, $tahun->tahun_penjualan);

                $nama_cabang = str_replace(" ", "-", strtolower($cabang->nama_cabang));
                if (is_object($penjualan)){
                    $row[$nama_cabang] = $penjualan->jumlah;
                } else {
                    $row[$nama_cabang] = 0;
                }
                
            }

            array_push($penjualan_tahunan_all_cabang, $row);
        }

        echo json_encode($penjualan_tahunan_all_cabang);
    }

    public function getGalonTerjualBulananAllCabang($tahun)
    {
        // ambil semua cabang
        $list_cabang = $this->cabang_model->getDataCabang();

        // ambil data penjualan tahunan setiap cabangnya
        $penjualan_bulanan_all_cabang = array();
        for ($i = 1; $i < 13; $i++) {
            $row = array("bulan" => $i);
            foreach ($list_cabang as $cabang) {
                $penjualan = $this->penjualan_model->getPenjualanPerBulanTertentuByCabang($cabang->cabang_id, $i, $tahun);

                $nama_cabang = str_replace(" ", "-", strtolower($cabang->nama_cabang));
                if (is_object($penjualan)){
                    $row[$nama_cabang] = $penjualan->jumlah;
                } else {
                    $row[$nama_cabang] = 0;
                }
            }

            array_push($penjualan_bulanan_all_cabang, $row);
        }

        echo json_encode($penjualan_bulanan_all_cabang);
    }

    public function getGalonTerjualHarianAllCabang($tahun, $bulan)
    {
        // ambil semua cabang
        $list_cabang = $this->cabang_model->getDataCabang();

        $lama_hari = 0;

        $odd_months = [1, 3, 5, 7, 8, 10, 12];
        $even_months = [4, 6, 9, 11];

        if (in_array($bulan, $odd_months)){
            // January, March, May, July, August, October, December

            $lama_hari = 31;
        } else if (in_array($bulan, $even_months)){
            // April, June, September, November

            $lama_hari = 30;
        } else {
            // February
            
            $lama_hari = 28;
        }

        // ambil data penjualan tahunan setiap cabangnya
        $penjualan_harian_all_cabang = array();
        for ($i = 1; $i <= $lama_hari; $i++) {
            $row = array("tanggal" => $i);
            foreach ($list_cabang as $cabang) {
                $penjualan = $this->penjualan_model->getPenjualanPerHariTertentuByCabang($cabang->cabang_id, $i, $bulan, $tahun);

                $nama_cabang = str_replace(" ", "-", strtolower($cabang->nama_cabang));
                if (is_object($penjualan)){
                    $row[$nama_cabang] = $penjualan->jumlah;
                } else {
                    $row[$nama_cabang] = 0;
                }
            }

            array_push($penjualan_harian_all_cabang, $row);
        }

        echo json_encode($penjualan_harian_all_cabang);
    }

    public function getGalonTerjualMingguanAllCabang($tahun, $bulan)
    {
        // ambil semua cabang
        $list_cabang = $this->cabang_model->getDataCabang();

        $lama_hari = 0;

        // tentukan lamanya hari
        $odd_months = [1, 3, 5, 7, 8, 10, 12];
        $even_months = [4, 6, 9, 11];

        if (in_array($bulan, $odd_months)){
            // January, March, May, July, August, October, December

            $lama_hari = 31;
        } else if (in_array($bulan, $even_months)){
            // April, June, September, November

            $lama_hari = 30;
        } else {
            // February
            
            $lama_hari = 28;
        }

        // tentukan lamanya minggu
        $tanggal_awal_bulan = $tahun."-".$bulan."-1";
        $tanggal_akhir_bulan = $tahun."-".$bulan."-".$lama_hari;

        // hitung awal minggu dan akhir minggu suatu bulan dengan MySQL
        $awal_bulan = new \DateTime($tanggal_awal_bulan);
        $minggu_awal = (int) $awal_bulan->format("W");

        if ($minggu_awal >= 52){
            $minggu_awal = 1;
        }

        $akhir_bulan = new \DateTime($tanggal_akhir_bulan);
        $minggu_akhir = (int) $akhir_bulan->format("W");

        // echo $minggu_awal." --- ".$minggu_akhir;

        // ambil data penjualan tahunan setiap cabangnya
        $penjualan_mingguan_all_cabang = array();

        $j = 1;
        for ($i = $minggu_awal; $i <= $minggu_akhir; $i++) {
            $row = array("minggu" => $j);
            foreach ($list_cabang as $cabang) {
                $penjualan = $this->penjualan_model->getPenjualanPerMingguTertentuByCabang($cabang->cabang_id, $tahun, $bulan, $i);

                $nama_cabang = str_replace(" ", "-", strtolower($cabang->nama_cabang));
                if (is_object($penjualan)){
                    $row[$nama_cabang] = $penjualan->jumlah;
                } else {
                    $row[$nama_cabang] = 0;
                }
            }

            array_push($penjualan_mingguan_all_cabang, $row);
            $j++;
        }

        echo json_encode($penjualan_mingguan_all_cabang);
    }
}
