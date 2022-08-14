<?php

namespace App\Controllers;

class Penjualan extends BaseController
{
    public function index()
    {
        return view('penjualan/list_penjualan');
    }

    public function add()
    {
    	// 1. Query heula ti database tabel X

    	// 2. looping hasil queryna didieu jadi array PHP

    	// 3. kirim array barangna ka form_tambah_barang. Engke edit diditu
        
        return view('penjualan/tambah_penjualan');
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
