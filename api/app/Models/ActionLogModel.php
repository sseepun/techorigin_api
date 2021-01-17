<?php namespace App\Models;

use CodeIgniter\Model;

class ActionLogModel extends Model {
    protected $table = 'action_logs';
    protected $primaryKey = 'id';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['user_id', 'target_user_id', 'action', 'url', 'ip'];
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
            $queryStr = "SELECT COUNT(`id`) AS `total` FROM `action_logs` WHERE 1";
            $condition = "";
            if(!empty($filter['start_date'])){
                $condition .= " AND `created_at` >= '{$filter['start_date']}'";
            }
            if(!empty($filter['end_date'])){
                $condition .= " AND `created_at` <= '{$filter['end_date']}'";
            }
            $query = $this->db->query($queryStr.$condition);
            return $query->getRowArray();
        }else if($type=='Daily Report'){
            $queryStr = "SELECT DATE(`created_at`) AS `date`, 
                COUNT(`id`) AS `total`, `action` 
                FROM `action_logs` WHERE 1";
            $condition = "";
            if(!empty($filter['start_date'])){
                $condition .= " AND `created_at` >= '{$filter['start_date']}'";
            }
            if(!empty($filter['end_date'])){
                $condition .= " AND `created_at` <= '{$filter['end_date']}'";
            }
            $query = $this->db->query($queryStr.$condition
                ." GROUP BY `date`, `action` ORDER BY `date` ASC");
            $data = $query->getResultArray();

            $dates = [];
            $result = [];
            foreach($data as $d){
                if(!in_array($d['date'], $dates)){
                    $dates[] = $d['date'];
                    $result[$d['date']] = [ 
                        'date' => $d['date'], 'total' => 0, 'types' => []
                    ];
                }
                $result[$d['date']]['total'] += $d['total'];
                $result[$d['date']]['types'][] = [
                    'action' => $d['action'], 'total' => $d['total']
                ];
            }
            return array_values($result);
        }else if($type=='Monthly Report'){
            $queryStr = "SELECT SUBSTRING(DATE(`created_at`), 1, 7) AS `date`, 
                COUNT(`id`) AS `total`, `action` 
                FROM `action_logs` WHERE 1";
            $condition = "";
            if(!empty($filter['start_date'])){
                $condition .= " AND `created_at` >= '{$filter['start_date']}'";
            }
            if(!empty($filter['end_date'])){
                $condition .= " AND `created_at` <= '{$filter['end_date']}'";
            }
            $query = $this->db->query($queryStr.$condition
                ." GROUP BY `date`, `action` ORDER BY `date` ASC");
            $data = $query->getResultArray();

            $dates = [];
            $result = [];
            foreach($data as $d){
                if(!in_array($d['date'], $dates)){
                    $dates[] = $d['date'];
                    $result[$d['date']] = [ 
                        'date' => $d['date'], 'total' => 0, 'types' => []
                    ];
                }
                $result[$d['date']]['total'] += $d['total'];
                $result[$d['date']]['types'][] = [
                    'action' => $d['action'], 'total' => $d['total']
                ];
            }
            return array_values($result);
        }else if($type=='Yearly Report'){
            $queryStr = "SELECT YEAR(`created_at`) AS `date`, 
                COUNT(`id`) AS `total`, `action` 
                FROM `action_logs` WHERE 1";
            $condition = "";
            if(!empty($filter['start_date'])){
                $condition .= " AND `created_at` >= '{$filter['start_date']}'";
            }
            if(!empty($filter['end_date'])){
                $condition .= " AND `created_at` <= '{$filter['end_date']}'";
            }
            $query = $this->db->query($queryStr.$condition
                ." GROUP BY `date`, `action` ORDER BY `date` ASC");
            $data = $query->getResultArray();

            $dates = [];
            $result = [];
            foreach($data as $d){
                if(!in_array($d['date'], $dates)){
                    $dates[] = $d['date'];
                    $result[$d['date']] = [ 
                        'date' => $d['date'], 'total' => 0, 'types' => []
                    ];
                }
                $result[$d['date']]['total'] += $d['total'];
                $result[$d['date']]['types'][] = [
                    'action' => $d['action'], 'total' => $d['total']
                ];
            }
            return array_values($result);
        }else if($type=='Full Report'){
            $queryStr = "SELECT `user_id`, `target_user_id`, `action`, 
                `url`, `ip`, `created_at` AS `visited_time` 
                FROM `action_logs` WHERE 1";
            $condition = "";
            if(!empty($filter['start_date'])){
                $condition .= " AND `created_at` >= '{$filter['start_date']}'";
            }
            if(!empty($filter['end_date'])){
                $condition .= " AND `created_at` <= '{$filter['end_date']}'";
            }
            $query = $this->db->query($queryStr.$condition." ORDER BY `created_at` ASC");
            return $query->getResultArray();
        }
        return false;
    }

}
