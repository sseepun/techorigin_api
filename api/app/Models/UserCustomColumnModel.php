<?php namespace App\Models;

use CodeIgniter\Model;

class UserCustomColumnModel extends Model {
    protected $table = 'user_custom_columns';
    protected $primaryKey = 'id';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['column_id', 'name', 'status'];
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

    
    public function getList($isAdmin){
        if(!$isAdmin){
            $query = $this->db->query(
                "SELECT * FROM `user_custom_columns` WHERE `status` = ? 
                ORDER BY `column_id` ASC", [ 1 ]
            );
        }else{
            $query = $this->db->query(
                "SELECT * FROM `user_custom_columns` WHERE 1 
                ORDER BY `column_id` ASC"
            );
        }
        return $query->getResultArray();
    }

    public function getNextColumnId(){
        $query = $this->db->query(
            "SELECT `column_id` FROM `user_custom_columns` WHERE 1 
            ORDER BY `column_id` DESC LIMIT 1"
        );
        $result = $query->getRowArray();
        if(!$result) return 1;
        else return $result['column_id'] + 1;
    }

}
