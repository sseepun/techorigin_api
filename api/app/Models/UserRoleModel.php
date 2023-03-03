<?php namespace App\Models;

use CodeIgniter\Model;

class UserRoleModel extends Model {
    protected $table = 'user_roles';
    protected $primaryKey = 'id';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'is_admin', 'is_default', 'order', 'status'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    public function __construct(){
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    
    protected function beforeInsert(array $data){
        return $data;
    }
    protected function beforeUpdate(array $data){
        return $data;
    }

    public function getUserRoles($isAdmin){
        if(!$isAdmin){
            $query = $this->db->query(
                "SELECT * FROM `user_roles` WHERE `status` = ? 
                ORDER BY `order` ASC", [ 1 ]
            );
        }else{
            $query = $this->db->query(
                "SELECT * FROM `user_roles` WHERE 1 
                ORDER BY `order` ASC"
            );
        }
        return $query->getResultArray();
    }

}
