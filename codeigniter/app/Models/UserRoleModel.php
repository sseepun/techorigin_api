<?php namespace App\Models;

use CodeIgniter\Model;

class UserRoleModel extends Model {
    protected $table = 'user_roles';
    protected $primaryKey = 'id';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'is_admin', 'is_default', 'rank', 'status'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    private $user;
    private $role;

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
            "SELECT * FROM `user_roles` 
            WHERE 1 ".$whereQuery." 
            ORDER BY `rank` ASC, `created_at` DESC 
            LIMIT :start:, :pp:",
            [ 'start' => ($page - 1) * $pp, 'pp' => $pp ]
        );
        $result = $getQuery->getResultArray();

        $totalQuery = $this->db->query(
            "SELECT COUNT(`id`) AS `total` 
            FROM `user_roles` 
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


    public function getUserRoleById($id){
        $query = $this->db->query(
            "SELECT * FROM `user_roles` WHERE `id` = ?",
            [ $id ]
        );
        return $query->getRowArray();
    }

}
