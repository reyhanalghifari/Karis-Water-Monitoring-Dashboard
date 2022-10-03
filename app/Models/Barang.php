<?php

namespace App\Models;
  
use CodeIgniter\Model;

class Barang extends Model
{
	protected $table = 'barang';
	protected $primaryKey = 'barang_id';
	protected $allowedFields = ['nama_barang', 'jenis', 'ukuran','harga', 'harga_jual'];

	public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getDataBarang()
    {
        $query_stmt = 'SELECT barang_id, nama_barang, jenis, ukuran, harga, harga_jual FROM barang ORDER BY barang_id DESC';
        $query   = $this->db->query($query_stmt);
        $result = $query->getResult();

        return $result;
    }

    public function getBarang($barang_id)
    {
    	$query_stmt = 'SELECT * FROM barang WHERE barang_id="'.$barang_id.'"';
    	$query   = $this->db->query($query_stmt);
        $result = $query->getRow();

        return $result;
    }     

}