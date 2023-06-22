<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'users';
    protected $primaryKey = 'id';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'role_id', 'username', 'firstname', 'lastname', 'email', 
        'password', 'is_password_set', 'profile', 'thai_id', 'thai_id_path', 
        'code', 'facebook_id', 'google_id', 'liff_id', 'last_ip', 'status',
    ];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    private $user;
    private $role;

    public function __construct(){
        helper(['security']);
        parent::__construct();
        $this->db = \Config\Database::connect();
    }


    protected function beforeInsert(array $data){
        $data['data'] = $this->cleanData($data['data']);
        return $data;
    }
    protected function beforeUpdate(array $data){
        $data['data'] = $this->cleanData($data['data']);
        return $data;
    }

    public function cleanData(array $data){
        if(!empty($data['password'])){
            $data['password'] = password_hash( $data['password'], PASSWORD_DEFAULT);
        }
        if(!empty($data['profile']) && strpos($data['profile'], 'http')===false){
            $data['profile'] = getenv('app.baseURL').$data['profile'];
        }
        if(!empty($data['thai_id_path']) && strpos($data['thai_id_path'], 'http')===false){
            $data['thai_id_path'] = getenv('app.baseURL').$data['thai_id_path'];
        }
        if(!empty($data['ip'])){
            $data['last_ip'] = $data['ip'];
        }
        return $data;
    }


    public function getUserById($userId){
        $query = $this->db->query(
            "SELECT `id`, `role_id`, `username`, `firstname`, `lastname`, `email`, 
            `is_password_set`, `profile`, `thai_id`, `thai_id_path`, `code`, 
            `facebook_id`, `google_id`, `last_ip`, `status` 
            FROM `users` WHERE `id` = ?",
            [ $userId ]
        );
        $user = $query->getRowArray();
        if(!$user) return false;
        return $user;
    }

    public function getDefaultRoleId(){
        $query = $this->db->query("SELECT `id` FROM `user_roles` WHERE `is_default` = 1 
            ORDER BY `created_at` DESC LIMIT 1");
        $role = $query->getRowArray();
        if(!$role) return null;
        else return $role['id'];
    }
    public function getRoleByUserId($userId){
        $query = $this->db->query("SELECT ur.* 
            FROM `users` AS u 
            INNER JOIN `user_roles` AS ur ON ur.`id` = u.`role_id` 
            WHERE u.`id` = ?", [ $userId ]);
        $role = $query->getRowArray();
        if(!$role) return null;
        else return $role;
    }

    public function getNewestUserId(){
        $query = $this->db->query("SELECT `id` FROM `users` ORDER BY `id` DESC LIMIT 1");
        $temp = $query->getRowArray();
        if(!$temp) return 1;
        else return $temp['id']+1;
    }

    public function authUserByUsernameOrEmail($string, $password){
        $query = $this->db->query(
            "SELECT * FROM `users` WHERE `username` = ? OR `email` = ?", 
            [ $string, $string ]
        );
        $user = $query->getRowArray();
        if(!$user) return false;
        else if(!password_verify($password, $user['password'])) return false;
        else{
            $this->user = $user;
            return $user;
        }
    }
    public function authUserByFacebookId($email, $facebookId){
        if(empty($email)){
            $query = $this->db->query(
                "SELECT * FROM `users` 
                WHERE (`email` IS NULL AND `facebook_id` IS NULL) 
                OR (`email` IS NULL AND `facebook_id` = ?)", 
                [ $facebookId ]
            );
        }else{
            $query = $this->db->query(
                "SELECT * FROM `users` 
                WHERE (`email` = ? AND `facebook_id` IS NULL) 
                OR (`email` = ? AND `facebook_id` = ?)", 
                [ $email, $email, $facebookId ]
            );
        }
        $user = $query->getRowArray();
        if(!$user) return false;
        else{
            $this->user = $user;
            return $user;
        }
    }
    public function authUserByGoogleId($email, $googleId){
        $query = $this->db->query(
            "SELECT * FROM `users` 
            WHERE (`email` = ? AND `google_id` IS NULL) 
            OR (`email` = ? AND `google_id` = ?)", 
            [ $email, $email, $googleId ]
        );
        $user = $query->getRowArray();
        if(!$user) return false;
        else{
            $this->user = $user;
            return $user;
        }
    }
    public function authUserByLIFFId($liffId){
        $query = $this->db->query(
            "SELECT * FROM `users` 
            WHERE `liff_id` = ?", 
            [ $liffId ]
        );
        $user = $query->getRowArray();
        if(!$user) return false;
        else{
            $this->user = $user;
            return $user;
        }
    }


    public function generateUserTemp($action, $email=false, $userId=false, $ip=null){
        if(!empty($action)){
            $user = false;
            if($email){
                $query = $this->db->query(
                    "SELECT `id`, `email` FROM `users` WHERE `email` = ?", [ $email ]
                );
                $user = $query->getRowArray();
            }else if($userId){
                $query = $this->db->query(
                    "SELECT `id`, `email` FROM `users` WHERE `id` = ?", [ $userId ]
                );
                $user = $query->getRowArray();
            }
            
            if(!$user) return false;
            $salt = randomAlphanum(64);
            if(!empty($ip)){
                $this->db->query(
                    "INSERT INTO `user_temp` (`user_id`, `action`, `salt`, `ip`) 
                    VALUES (?, ?, ?, ?)", 
                    [ $user['id'], $action, $salt, $ip ]
                );
            }else{
                $this->db->query(
                    "INSERT INTO `user_temp` (`user_id`, `action`, `salt`) 
                    VALUES (?, ?, ?)", 
                    [ $user['id'], $action, $salt ]
                );
            }
            return [
                'user_id' => $user['id'],
                'email' => $user['email'], 
                'salt' => $salt
            ];
        }
        return false;
    }
    public function getUserTemp($action, $salt, $isUsed=0){
        if(!empty($action) && !empty($salt)){
            $query = $this->db->query(
                "SELECT ut.* 
                FROM `users` AS u 
                INNER JOIN `user_temp` AS ut ON ut.`user_id` = u.`id` 
                WHERE ut.`action` = ? AND ut.`salt` = ? AND ut.`is_used` = ?", 
                [ $action, $salt, $isUsed ]
            );
            return $query->getRowArray();
        }
        return false;
    }
    public function useUserTemp($action, $salt, $ip=null){
        if(!empty($action) && !empty($salt)){
            $query = $this->db->query(
                "SELECT u.`id`, u.`email`, u.`username` 
                FROM `users` AS u 
                INNER JOIN `user_temp` AS ut ON ut.`user_id` = u.`id` 
                WHERE ut.`action` = ? AND ut.`salt` = ? AND ut.`is_used` = ?", 
                [ $action, $salt, 0 ]
            );
            $user = $query->getRowArray();
            if(!$user) return false;

            $this->db->query(
                "UPDATE `user_temp` SET `is_used` = ?, `used_ip` = ? 
                WHERE `user_id` = ? AND `salt` = ?", 
                [ 1, $ip, $user['id'], $salt ]
            );
            return $user;
        }
        return false;
    }


    public function getTableObject($isAdmin=false, $page=1, $pp=10, $keyword=''){
        $page = (int) $page;
        $pp = (int) $pp;

        $whereQuery = "";
        if(!$isAdmin){
            $whereQuery .= " AND u.`status` = 1";
        }
        if(!empty($keyword)){
            $keywords = explode(" ", str_replace("  ", " ", trim($keyword)));
            $sep = " AND ";
            foreach($keywords as $k){
                $whereQuery .= $sep."u.`firstname` LIKE '%".$k."%'"; $sep = " OR ";
                $whereQuery .= $sep."u.`lastname` LIKE '%".$k."%'";
                $whereQuery .= $sep."u.`email` LIKE '%".$k."%'";
                $whereQuery .= $sep."u.`username` LIKE '%".$k."%'";
                $whereQuery .= $sep."u.`name` LIKE '%".$k."%'";
            }
        }

        $getQuery = $this->db->query(
            "SELECT u.`id`, u.`role_id`, u.`firstname`, u.`lastname`, u.`email`, 
            u.`profile`, u.`status`, u.`last_ip`, u.`created_at`, u.`updated_at`, 
            ur.`name` AS `role`, ur.`is_admin` AS `role_is_admin`, 
            ur.`is_super_admin` AS `role_is_super_admin`, 
            u.`facebook_id`, u.`google_id`, u.`liff_id` 
            FROM `users` AS u 
            INNER JOIN `user_roles` AS ur ON ur.`id` = u.`role_id` 
            WHERE 1 ".$whereQuery." 
            ORDER BY u.`created_at` DESC 
            LIMIT :start:, :pp:",
            [ 'start' => ($page - 1) * $pp, 'pp' => $pp ]
        );
        $result = $getQuery->getResultArray();

        $totalQuery = $this->db->query(
            "SELECT COUNT(u.`id`) AS `total` 
            FROM `users` AS u 
            INNER JOIN `user_roles` AS ur ON ur.`id` = u.`role_id` 
            WHERE 1 ".$whereQuery,
        );
        $total = $totalQuery->getRowArray()['total'];

        return [
            'page' => $page,
            'pp' => $pp,
            'total' => $total,
            'total_pages' => ceil($total / $pp),
            'result' => $result,
        ];
    }


    public function getRegistrationReport($type, $filter){
        if($type=='Total Report'){
            $queryStr = "SELECT COUNT(`id`) AS `total` FROM `users` WHERE 1";
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
            $queryStr = "SELECT DATE(`created_at`) AS `date`, COUNT(`id`) AS `total` 
                FROM `users` WHERE 1";
            $condition = "";
            if(!empty($filter['start_date'])){
                $condition .= " AND `created_at` >= '{$filter['start_date']}'";
            }
            if(!empty($filter['end_date'])){
                $condition .= " AND `created_at` <= '{$filter['end_date']}'";
            }
            $query = $this->db->query($queryStr.$condition." GROUP BY `date` ORDER BY `date` ASC");
            return $query->getResultArray();
        }else if($type=='Monthly Report'){
            $queryStr = "SELECT SUBSTRING(DATE(`created_at`), 1, 7) AS `date`, COUNT(`id`) AS `total` 
                FROM `users` WHERE 1";
            $condition = "";
            if(!empty($filter['start_date'])){
                $condition .= " AND `created_at` >= '{$filter['start_date']}'";
            }
            if(!empty($filter['end_date'])){
                $condition .= " AND `created_at` <= '{$filter['end_date']}'";
            }
            $query = $this->db->query($queryStr.$condition." GROUP BY `date` ORDER BY `date` ASC");
            return $query->getResultArray();
        }else if($type=='Yearly Report'){
            $queryStr = "SELECT YEAR(`created_at`) AS `date`, COUNT(`id`) AS `total` 
                FROM `users` WHERE 1";
            $condition = "";
            if(!empty($filter['start_date'])){
                $condition .= " AND `created_at` >= '{$filter['start_date']}'";
            }
            if(!empty($filter['end_date'])){
                $condition .= " AND `created_at` <= '{$filter['end_date']}'";
            }
            $query = $this->db->query($queryStr.$condition." GROUP BY `date` ORDER BY `date` ASC");
            return $query->getResultArray();
        }else if($type=='Full Report'){
            $queryStr = "SELECT `username`, `firstname`, `lastname`, `created_at` 
                FROM `users` WHERE 1";
            $condition = "";
            if(!empty($filter['start_date'])){
                $condition .= " AND `created_at` >= '{$filter['start_date']}'";
            }
            if(!empty($filter['end_date'])){
                $condition .= " AND `created_at` <= '{$filter['end_date']}'";
            }
            $limit = "";
            if(!empty($filter['limit'])){
                $limit .= " LIMIT {$filter['limit']}";
            }
            $query = $this->db->query(
                $queryStr.$condition." ORDER BY `created_at` DESC".$limit
            );
            return $query->getResultArray();
        }
        return false;
    }


    public function integrationIDs(){
        $userQuery = $this->db->query("SELECT `id`, `email` 
            FROM `users` ORDER BY `id` ASC");
        $users = $userQuery->getResultArray();

        $userIds = [];
        foreach($users as $u){
            $userIds[] = $u['id'];
        }

        if(sizeof($userIds)){
            $deleteQuery = $this->db->query("DELETE FROM `user_temp`  
                WHERE `action` = 'RESET PASSWORD' AND `is_used` = 0 
                AND `user_id` IN (".implode(',', $userIds).")");
            foreach($users as $u){
                $this->generateUserTemp(
                    $action = 'RESET PASSWORD', 
                    $email = $u['email'], $userId = $u['id']
                );
            }
        }

        $query = $this->db->query("SELECT u.`id` AS `user_id`, 
            u.`username`, u.`email`, 
            u.`facebook_id`, u.`google_id`, 
            ut.`salt` AS `reset_password_salt` 
            FROM `users` AS u 
            LEFT JOIN `user_temp` AS ut ON ut.`user_id` = u.`id` 
            WHERE ut.`action` = 'RESET PASSWORD' AND ut.`is_used` = 0 
            ORDER BY u.`id` ASC");
        return $query->getResultArray();
    }

}

?>
