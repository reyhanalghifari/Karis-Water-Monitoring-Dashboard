<?php

namespace App\Controllers;

class Pelanggan extends BaseController
{
    public function index()
    {
        return view('pelanggan/list_pelanggan');
    }

    public function add()
    {
    	// 1. Query heula ti database tabel X

    	// 2. looping hasil queryna didieu jadi array PHP

    	// 3. kirim array barangna ka form_tambah_barang. Engke edit diditu
        
        return view('pelanggan/tambah_pelanggan');
    }

    public function edit()
    {
        return view('pelanggan/edit_pelanggan');
    }

    public function delete()
    {
        // redirect halaman ke Barang/Index
    }
}
