<?php

namespace App\Models;
   
use CodeIgniter\Model;
 
class Penjualan extends Model
{
	protected $table = 'penjualan';
	protected $primaryKey = 'penjualan_id';
	protected $allowedFields = ['pelanggan_id', 'barang_id', 'tanggal_penjualan', 'harga_saat_dibeli', 'jumlah'];

	public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function authenticate($username, $password)
    {
    	$query_stmt = 'SELECT * FROM user WHERE username="'.$username.'" AND password="'.hash('sha256', $password).'"';
    	$query   = $this->db->query($query_stmt);
        $result = $query->getRow();

        return $result;
    }

    public function getDataPenjualan()
    {
        $query_stmt = 'SELECT penjualan_id, pelanggan_id, barang_id, tanggal_penjualan, harga_saat_dibeli, jumlah FROM penjualan ORDER BY penjualan_id DESC';
        $query   = $this->db->query($query_stmt);
        $result = $query->getResult();

        return $result;
    }

    public function getPenjualan($penjualan_id)
    {
    	$query_stmt = 'SELECT * FROM penjualan WHERE penjualan_id="'.$penjualan_id.'"';
    	$query   = $this->db->query($query_stmt);
        $result = $query->getRow();

        return $result;
    }     

}