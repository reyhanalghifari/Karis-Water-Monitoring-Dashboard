<?php

namespace App\Models;
   
use CodeIgniter\Model;
 
class Pelanggan extends Model
{
	protected $table = 'pelanggan';
	protected $primaryKey = 'pelanggan_id';
	protected $allowedFields = ['nama_pelanggan', 'alamat_pelanggan', 'no_telepon', 'email', 'jenis_pelanggan'];

	public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getDataPelanggan()
    {
        $query_stmt = 'SELECT pelanggan_id, nama_pelanggan, alamat_pelanggan, no_telepon, email, jenis_pelanggan FROM pelanggan ORDER BY pelanggan_id DESC';
        $query   = $this->db->query($query_stmt);
        $result = $query->getResult();

        return $result;
    }

    public function getDataPelangganCabang()
    {
        $query_stmt = "SELECT pelanggan_id, nama_pelanggan, alamat_pelanggan, no_telepon, email, jenis_pelanggan FROM pelanggan WHERE jenis_pelanggan='cabang' ORDER BY pelanggan_id DESC";
        $query   = $this->db->query($query_stmt);
        $result = $query->getResult();

        return $result;
    }

    public function getDataPelangganEceran()
    {
        $query_stmt = "SELECT pelanggan_id, nama_pelanggan, alamat_pelanggan, no_telepon, email, jenis_pelanggan FROM pelanggan WHERE jenis_pelanggan='eceran' ORDER BY pelanggan_id DESC";
        $query   = $this->db->query($query_stmt);
        $result = $query->getResult();

        return $result;
    }

    public function getPelanggan($pelanggan_id)
    {
    	$query_stmt = 'SELECT * FROM pelanggan WHERE pelanggan_id="'.$pelanggan_id.'"';
    	$query   = $this->db->query($query_stmt);
        $result = $query->getRow();

        return $result;
    }     

}