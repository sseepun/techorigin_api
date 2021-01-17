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
        if($type=='Total Report'){
            $queryStr = "SELECT COUNT(`id`) AS `total` FROM `traffic_logs` WHERE 1";
            $condition = "";
            if(!empty($filter['start_date'])){
                $condition .= " AND `created_at` >= '{$filter['start_date']}'";
            }
            if(!empty($filter['end_date'])){
                $condition .= " AND `created_at` <= '{$filter['end_date']}'";
            }
            if(!empty($filter['only_users']) && $filter['only_users']){
                $condition .= " AND `user_id` IS NOT NULL";
            }else if(!empty($filter['only_visitors']) && $filter['only_visitors']){
                $condition .= " AND `user_id` IS NULL";
            }
            $query = $this->db->query($queryStr.$condition);
            return $query->getRowArray();
        }else if($type=='Daily Report'){
            $queryStr = "SELECT DATE(`created_at`) AS `date`, COUNT(`id`) AS `total` 
                FROM `traffic_logs` WHERE 1";
            $condition = "";
            if(!empty($filter['start_date'])){
                $condition .= " AND `created_at` >= '{$filter['start_date']}'";
            }
            if(!empty($filter['end_date'])){
                $condition .= " AND `created_at` <= '{$filter['end_date']}'";
            }
            if(!empty($filter['only_users']) && $filter['only_users']){
                $condition .= " AND `user_id` IS NOT NULL";
            }else if(!empty($filter['only_visitors']) && $filter['only_visitors']){
                $condition .= " AND `user_id` IS NULL";
            }
            $query = $this->db->query($queryStr.$condition." GROUP BY `date` ORDER BY `date` ASC");
            return $query->getResultArray();
        }else if($type=='Monthly Report'){
            $queryStr = "SELECT SUBSTRING(DATE(`created_at`), 1, 7) AS `date`, COUNT(`id`) AS `total` 
                FROM `traffic_logs` WHERE 1";
            $condition = "";
            if(!empty($filter['start_date'])){
                $condition .= " AND `created_at` >= '{$filter['start_date']}'";
            }
            if(!empty($filter['end_date'])){
                $condition .= " AND `created_at` <= '{$filter['end_date']}'";
            }
            if(!empty($filter['only_users']) && $filter['only_users']){
                $condition .= " AND `user_id` IS NOT NULL";
            }else if(!empty($filter['only_visitors']) && $filter['only_visitors']){
                $condition .= " AND `user_id` IS NULL";
            }
            $query = $this->db->query($queryStr.$condition." GROUP BY `date` ORDER BY `date` ASC");
            return $query->getResultArray();
        }else if($type=='Yearly Report'){
            $queryStr = "SELECT YEAR(`created_at`) AS `date`, COUNT(`id`) AS `total` 
                FROM `traffic_logs` WHERE 1";
            $condition = "";
            if(!empty($filter['start_date'])){
                $condition .= " AND `created_at` >= '{$filter['start_date']}'";
            }
            if(!empty($filter['end_date'])){
                $condition .= " AND `created_at` <= '{$filter['end_date']}'";
            }
            if(!empty($filter['only_users']) && $filter['only_users']){
                $condition .= " AND `user_id` IS NOT NULL";
            }else if(!empty($filter['only_visitors']) && $filter['only_visitors']){
                $condition .= " AND `user_id` IS NULL";
            }
            $query = $this->db->query($queryStr.$condition." GROUP BY `date` ORDER BY `date` ASC");
            return $query->getResultArray();
        }else if($type=='Full Report'){
            $queryStr = "SELECT `user_id`, `url`, `ip`, `created_at` AS `visited_time` 
                FROM `traffic_logs` WHERE 1";
            $condition = "";
            if(!empty($filter['start_date'])){
                $condition .= " AND `created_at` >= '{$filter['start_date']}'";
            }
            if(!empty($filter['end_date'])){
                $condition .= " AND `created_at` <= '{$filter['end_date']}'";
            }
            if(!empty($filter['only_users']) && $filter['only_users']){
                $condition .= " AND `user_id` IS NOT NULL";
            }else if(!empty($filter['only_visitors']) && $filter['only_visitors']){
                $condition .= " AND `user_id` IS NULL";
            }
            $query = $this->db->query($queryStr.$condition." ORDER BY `created_at` ASC");
            return $query->getResultArray();
        }
        return false;
    }

}
