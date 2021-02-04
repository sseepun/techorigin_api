<?php namespace App\Models;

use CodeIgniter\Model;

class ActionLogModel extends Model {
    protected $table = 'action_logs';
    protected $primaryKey = 'id';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'external_app_id', 'user_id', 'target_user_id', 'action', 'url', 'ip'
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
            $queryStr = "SELECT e.`name` AS `external_app_name`, 
                db.`user_id`, u.`username`, u.`firstname`, u.`lastname`,
                db.`action`, db.`url`, db.`ip`, db.`created_at` AS `visited_time` 
                FROM `action_logs` AS db 
                LEFT JOIN `users` AS u ON u.`id` = db.`user_id` 
                LEFT JOIN `external_apps` AS e ON e.`id` = db.`external_app_id` 
                WHERE 1";
            $condition = "";
            if(!empty($filter['start_date'])){
                $condition .= " AND db.`created_at` >= '{$filter['start_date']}'";
            }
            if(!empty($filter['end_date'])){
                $condition .= " AND db.`created_at` <= '{$filter['end_date']}'";
            }
            $limit = "";
            if(!empty($filter['limit'])){
                $limit .= " LIMIT {$filter['limit']}";
            }
            $query = $this->db->query(
                $queryStr.$condition." ORDER BY db.`created_at` DESC".$limit
            );
            return $query->getResultArray();
        }
        return false;
    }

    public function saveLog($data){
        if(!empty($data['external_app_id'])){
            $tempQuery = $this->db->query(
                "SELECT `id` FROM `external_apps` WHERE `id` = ? LIMIT 1", 
                [ $data['external_app_id'] ]
            );
            $temp = $tempQuery->getRowArray();
            if(!$temp) $data['external_app_id'] = null;
        }else{
            $data['external_app_id'] = null;
        }
        $this->db->query(
            "INSERT INTO `action_logs` 
            (`external_app_id`, `user_id`, `target_user_id`, `action`, `url`, `ip`) 
            VALUES 
            (:external_app_id:, :user_id:, :target_user_id:, :action:, :url:, :ip:)",
            [
                'external_app_id' => $data['external_app_id'],
                'user_id' => empty($data['user_id'])? null: $data['user_id'],
                'target_user_id' => empty($data['target_user_id'])? null: $data['target_user_id'],
                'action' => empty($data['action'])? null: $data['action'],
                'url' => empty($data['url'])? null: $data['url'],
                'ip' => empty($data['ip'])? null: $data['ip'],
            ]
        );
    }

}
