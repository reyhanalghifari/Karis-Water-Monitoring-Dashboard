<?php

namespace App\Models;

use CodeIgniter\Model;

class UserCabang extends Model
{
	protected $table = 'user_cabang';
	protected $primaryKey = 'user_cabang_id';
	protected $allowedFields = ['user_id', 'cabang_id', 'username', 'nama_cabang'];

	public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getUserCabang()
    {
        $query_stmt = 'SELECT uc.user_cabang_id, u.username, c.nama_cabang FROM user u LEFT JOIN user_cabang uc ON u.user_id = uc.user_id RIGHT JOIN cabang c ON uc.cabang_id=c.cabang_id WHERE u.user_status="active" ORDER BY user_cabang_id DESC';
        $query   = $this->db->query($query_stmt);
        $result = $query->getResult();

        return $result;
    }

    public function getUnassignedUsers()
    {
        $query_stmt = 'SELECT u.user_id, u.username, c.nama_cabang FROM user u LEFT JOIN user_cabang uc ON u.user_id = uc.user_id LEFT JOIN cabang c ON uc.cabang_id=c.cabang_id WHERE u.user_status="active" AND c.nama_cabang IS NULL ORDER BY user_cabang_id DESC';
        $query   = $this->db->query($query_stmt);
        $result = $query->getResult();

        return $result;
    }

    public function getUserCabangByUserId($user_id)
    {
        $query_stmt = 'SELECT u.user_id, u.username, c.nama_cabang, c.tipe_cabang, c.cabang_id FROM user u LEFT JOIN user_cabang uc ON u.user_id = uc.user_id LEFT JOIN cabang c ON uc.cabang_id=c.cabang_id WHERE u.user_status="active" AND c.nama_cabang IS NOT NULL AND u.user_id='.$user_id;
        $query   = $this->db->query($query_stmt);
        $result = $query->getRow();

        return $result;
    }
}
