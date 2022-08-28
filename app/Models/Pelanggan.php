<?php

namespace App\Models;
   
use CodeIgniter\Model;
 
class Pelanggan extends Model
{
	protected $table = 'pelanggan';
	protected $primaryKey = 'pelanggan_id';
	protected $allowedFields = ['nama_pelanggan', 'alamat_pelanggan', 'no_telepon', 'email'];

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

    public function getDataPelanggan()
    {
        $query_stmt = 'SELECT pelanggan_id, nama_pelanggan, alamat_pelanggan, no_telepon, email FROM pelanggan ORDER BY pelanggan_id DESC';
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