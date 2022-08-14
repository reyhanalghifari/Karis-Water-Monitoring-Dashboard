<?php

namespace App\Controllers;

class Barang extends BaseController
{
    public function index()
    {
        return view('barang/list_barang');
    }

    public function add()
    {
    	// 1. Query heula ti database tabel X

    	// 2. looping hasil queryna didieu jadi array PHP

    	// 3. kirim array barangna ka form_tambah_barang. Engke edit diditu
        
        return view('barang/tambah_barang');
    }

    public function edit()
    {
        return view('barang/edit_barang');
    }

    public function delete()
    {
        // redirect halaman ke Barang/Index
    }
}
