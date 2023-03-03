<?php namespace App\Models;

use CodeIgniter\Model;

class UserDetailModel extends Model {
    protected $table = 'user_details';
    protected $primaryKey = 'id';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'user_id', 'user_type_id', 'user_subtype_id',
        'display_name', 'birth_date', 'sex', 'prefix',
        'address', 'phone', 'title', 'company', 'company_address', 'company_phone'
    ];
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


    public function updateCustomDetails($userId, $data){
        $columnsQuery = $this->db->query(
            "SELECT * FROM `user_custom_columns` WHERE `status` = ? 
            ORDER BY `column_id` ASC", [ 1 ]
        );
        $columns = $columnsQuery->getResultArray();
        if($columns){
            $variables = [];
            $coefficients = [];
            $updateVariables = [];
            $insertData = [];
            foreach($columns as $c){
                if(isset($data[$c['name']])){
                    $columnId = 'column_'.$c['column_id'];
                    $variables[] = '`'.$columnId.'`';
                    $coefficients[] = ':'.$columnId.':';
                    $updateVariables[] = '`'.$columnId.'` = :'.$columnId.':';
                    $insertData[$columnId] = $data[$c['name']];
                }
            }
            if(sizeof($variables)){
                $getQuery = $this->db->query(
                    "SELECT `user_id` FROM `user_custom_details` 
                    WHERE `user_id` = ?", [ $userId ]
                );
                $getDetails = $getQuery->getRowArray();
                if($getDetails){
                    $insertData['user_id'] = $userId;
                    $query = $this->db->query(
                        "UPDATE `user_custom_details` 
                        SET ".implode(',', $updateVariables)." 
                        WHERE `user_id` = :user_id:",
                        $insertData
                    );
                }else{
                    $variables[] = '`user_id`';
                    $coefficients[] = ':user_id:';
                    $insertData['user_id'] = $userId;
                    $query = $this->db->query(
                        "INSERT INTO `user_custom_details` 
                        (".implode(',', $variables).") VALUES 
                        (".implode(',', $coefficients).")",
                        $insertData
                    );
                }
            }
        }
        return true;
    }
    public function getCustomDetails($isAdmin, $userId){
        if($isAdmin){
            $columnsQuery = $this->db->query(
                "SELECT * FROM `user_custom_columns` WHERE 1 
                ORDER BY `column_id` ASC"
            );
        }else{
            $columnsQuery = $this->db->query(
                "SELECT * FROM `user_custom_columns` WHERE `status` = ? 
                ORDER BY `column_id` ASC", [ 1 ]
            );
        }
        $columns = $columnsQuery->getResultArray();

        $result = [];
        if($columns){
            $variables = [];
            foreach($columns as $c){
                $columnId = 'column_'.$c['column_id'];
                $variables[] = '`'.$columnId.'` AS `'.$c['name'].'`';
            }
            if(sizeof($variables)){
                $query = $this->db->query(
                    "SELECT ".implode(',', $variables)." FROM `user_custom_details` 
                    WHERE `user_id` = ?", [ $userId ]
                );
                $result = $query->getRowArray();
            }
        }

        return $result;
    }

}
