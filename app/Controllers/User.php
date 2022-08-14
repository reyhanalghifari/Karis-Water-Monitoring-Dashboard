<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index()
    {
        return view('user/list_user');
    }

    public function add()
    {
    	// 1. Query heula ti database tabel X

    	// 2. looping hasil queryna didieu jadi array PHP

    	// 3. kirim array barangna ka form_tambah_barang. Engke edit diditu
        
        return view('user/tambah_user');
    }

    public function edit()
    {
        return view('user/edit_user');
    }

    public function delete()
    {
        // redirect halaman ke Barang/Index
    }
}
