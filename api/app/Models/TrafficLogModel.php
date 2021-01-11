<?php namespace App\Models;

use CodeIgniter\Model;

class TrafficLogModel extends Model {
    protected $table = 'traffic_logs';
    protected $primaryKey = 'id';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['user_id', 'url', 'ip'];
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

    public function getReport($type, $filter){
        if($type=='Total'){
            $queryStr = "SELECT COUNT(`id`) AS `total` FROM `traffic_logs` WHERE 1";
            if(!empty($filter['start_date'])){
                $queryStr .= " AND `created_at` >= '{$filter['start_date']}'";
            }
            if(!empty($filter['end_date'])){
                $queryStr .= " AND `created_at` <= '{$filter['end_date']}'";
            }
            if(!empty($filter['only_users']) && $filter['only_users']){
                $queryStr .= " AND `user_id` IS NOT NULL";
            }else if(!empty($filter['only_visitors']) && $filter['only_visitors']){
                $queryStr .= " AND `user_id` IS NULL";
            }
            $query = $this->db->query($queryStr);
            return $query->getRowArray();
        }else if($type=='Daily'){
            $queryStr = "SELECT * FROM `traffic_logs` WHERE 1";
            // if(!empty($filter['start_date'])){
            //     $queryStr .= " AND `created_at` >= '{$filter['start_date']}'";
            // }
            // if(!empty($filter['end_date'])){
            //     $queryStr .= " AND `created_at` <= '{$filter['end_date']}'";
            // }
            // if(!empty($filter['only_users']) && $filter['only_users']){
            //     $queryStr .= " AND `user_id` IS NOT NULL";
            // }else if(!empty($filter['only_visitors']) && $filter['only_visitors']){
            //     $queryStr .= " AND `user_id` IS NULL";
            // }
            $query = $this->db->query($queryStr);
            return $query->getRowResult();
        }
        return false;
    }

}
