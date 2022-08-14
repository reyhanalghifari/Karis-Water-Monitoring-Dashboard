<?php

namespace App\Controllers;

class CabangDistribusi extends BaseController
{
    public function index()
    {
        return view('cabang_distribusi/list_cabang_distribusi');
    }

    public function add()
    {
    	// 1. Query heula ti database tabel X

    	// 2. looping hasil queryna didieu jadi array PHP

    	// 3. kirim array barangna ka form_tambah_barang. Engke edit diditu
        
        return view('cabang_distribusi/tambah_cabang_distribusi');
    }

    public function edit()
    {
        return view('cabang_distribusi/edit_cabang_distribusi');
    }

    public function delete()
    {
        // redirect halaman ke Barang/Index
    }
}
