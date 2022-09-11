<?php

namespace App\Controllers;
 
class DataMaster extends BaseController
{
    public function __construct()
    {
        $this->barang_model = new \App\Models\Barang();
    }

    public function getBarang($barang_id)
    {
        $barang = $this->barang_model->getBarang($barang_id);

        echo json_encode($barang);
    }    
}
