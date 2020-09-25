<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'users';
    protected $allowedFields = ['firstname', 'lastname', 'email', 'password', 'role_id', 'status'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];
    protected $primaryKey = 'id';

    public function __construct(){
        // connect to DB
        $this->db = \Config\Database::connect();
    }

    public function getRoleById($roleId){
        $query = $this->db->query("SELECT u.`role_id`, ur.`is_admin`, ur.`is_super_admin`, ur.`rank` FROM `users` AS u 
                        INNER JOIN `user_roles` AS ur ON ur.`id` = u.`role_id`
                        WHERE u.`id` = ?
                        ", array($roleId));
        $row = $query->getRowArray();
        return $row;
    }

    protected function beforeInsert(array $data) {
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function beforeUpdate(array $data) {
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function passwordHash(array $data) {
        if(isset($data['data']['password'])){
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;

    }

}


?>