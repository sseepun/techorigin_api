<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'users';
    protected $primaryKey = 'id';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'role_id', 'username', 'firstname', 'lastname', 'email', 'password', 
        'profile', 'thai_id', 'thai_id_path', 'code', 'last_ip', 'status',
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
        return $data;
    }


    public function getUserById($userId){
        $query = $this->db->query(
            "SELECT `id`, `role_id`, `username`, `firstname`, `lastname`, `email`, 
            `profile`, `thai_id`, `thai_id_path`, `code`, `last_ip`, `status` 
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
            return [ 'email' => $user['email'], 'salt' => $salt ];
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


    public function getTableObject($page=1, $pp=10, $keyword=''){
        $whereQuery = "";
        if(!empty($keyword)){
            $whereQuery = " AND u.`firstname` LIKE '%".$keyword."%' 
                OR u.`lastname` LIKE '%".$keyword."%' 
                OR u.`email` LIKE '%".$keyword."%' 
                OR u.`username` LIKE '%".$keyword."%' 
                OR ur.`name` LIKE '%".$keyword."%'";
        }

        $getQuery = $this->db->query(
            "SELECT u.`id`, u.`role_id`, u.`firstname`, u.`lastname`, u.`email`, 
            u.`profile`, u.`status`, u.`last_ip`, u.`created_at`, u.`updated_at`, 
            ur.`name` AS `role`, ur.`is_admin` AS `role_is_admin`, 
            ur.`is_super_admin` AS `role_is_super_admin` 
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

}

?>
