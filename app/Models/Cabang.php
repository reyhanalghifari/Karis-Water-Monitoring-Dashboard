<?php

namespace App\Models;
  
use CodeIgniter\Model;
 
class Cabang extends Model
{
	protected $table = 'cabang';
	protected $primaryKey = 'cabang_id';
	protected $allowedFields = ['nama_cabang', 'kepala_cabang', 'alamat_cabang', 'email', 'no_telp'];

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

    public function getDataCabang()
    {
        $query_stmt = 'SELECT cabang_id, nama_cabang, kepala_cabang, alamat_cabang, email, no_telp FROM cabang ORDER BY cabang_id DESC';
        $query   = $this->db->query($query_stmt);
        $result = $query->getResult();

        return $result;
    }

    public function getCabang($cabang_id)
    {
    	$query_stmt = 'SELECT * FROM cabang WHERE cabang_id="'.$cabang_id.'"';
    	$query   = $this->db->query($query_stmt);
        $result = $query->getRow();

        return $result;
    }     

}