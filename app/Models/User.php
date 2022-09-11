<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
	protected $table = 'user';
	protected $primaryKey = 'user_id';
	protected $allowedFields = ['nama_lengkap', 'username', 'password', 'email', 'no_telp', 'account_type', 'user_status'];

	public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function authenticate($username, $password)
    {
        $query_stmt = 'SELECT * FROM user WHERE username="'.$username.'" AND password="'.hash('sha256', $password).'" AND user_status="active"';
    	$query   = $this->db->query($query_stmt);
        $result = $query->getRow();

        return $result;
    }

    public function getUsers()
    {
        $query_stmt = 'SELECT user_id, nama_lengkap, username, email, no_telp, account_type, user_status FROM user WHERE user_status="active" ORDER BY user_id DESC';
        $query   = $this->db->query($query_stmt);
        $result = $query->getResult();

        return $result;
    }

    public function getUser($user_id)
    {
    	$query_stmt = 'SELECT * FROM user WHERE user_id="'.$user_id.'"';
    	$query   = $this->db->query($query_stmt);
        $result = $query->getRow();

        return $result;
    }
 
    public function changeUserProfile($id, $nama_lengkap, $username)
    {
        $data = [
		    'username' => $username,
            'nama_lengkap'    => $nama_lengkap,
            
		];

		$result = $this->update($id, $data);

        return $result;
    }

    public function setAsInactive($id)
    {
        $data = [
            'user_status' => 'inactive'
        ];

        $result = $this->update($id, $data);

        return $result;
    }

}
