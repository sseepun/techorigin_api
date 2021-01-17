<?php namespace App\Models;

use CodeIgniter\Model;

class UserTypeModel extends Model {
    protected $table = 'user_types';
    protected $primaryKey = 'id';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['parent_id', 'name', 'status'];
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

    public function getUserTypes($isAdmin){
        if(!$isAdmin){
            $query = $this->db->query(
                "SELECT * FROM `user_types` WHERE `status` = ? 
                ORDER BY `parent_id` ASC, `id` ASC", [ 1 ]
            );
        }else{
            $query = $this->db->query(
                "SELECT * FROM `user_types` WHERE 1 
                ORDER BY `parent_id` ASC, `id` ASC"
            );
        }
        $data = $query->getResultArray();
        $userTypes = [];
        foreach($data as $d){
            if(empty($d['parent_id'])){
                $d['subtypes'] = [];
                $userTypes[$d['id']] = $d;
            }else{
                $userTypes[$d['parent_id']]['subtypes'][] = $d;
            }
        }
        return array_values($userTypes);
    }

}
