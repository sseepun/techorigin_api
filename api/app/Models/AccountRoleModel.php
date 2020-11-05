<?php namespace App\Models;

use CodeIgniter\Model;

class AccountRoleModel extends Model {
    protected $table = 'account_roles';
    protected $primaryKey = 'id';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'access_code', 'is_default', 'order', 'status'];
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

    
    public function getTableObject($page=1, $pp=10, $keyword=''){
        $whereQuery = "";
        if(!empty($keyword)){
            $whereQuery = " AND `name` LIKE '%".$keyword."%'";
        }

        $getQuery = $this->db->query(
            "SELECT * FROM `account_roles` 
            WHERE 1 ".$whereQuery." 
            ORDER BY `order` ASC, `created_at` DESC 
            LIMIT :start:, :pp:",
            [ 'start' => ($page - 1) * $pp, 'pp' => $pp ]
        );
        $result = $getQuery->getResultArray();

        $totalQuery = $this->db->query(
            "SELECT COUNT(`id`) AS `total` 
            FROM `account_roles` 
            WHERE 1 ".$whereQuery,
        );
        $total = $totalQuery->getRowArray()['total'];

        return [
            'result' => $result,
            'page' => $page,
            'pp' => $pp,
            'total' => $total,
            'total_pages' => ceil($total / $pp)
        ];
    }


    public function getAccountRoleById($id){
        $query = $this->db->query(
            "SELECT * FROM `account_roles` WHERE `id` = ?",
            [ $id ]
        );
        return $query->getRowArray();
    }

}
