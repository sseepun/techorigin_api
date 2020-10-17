<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'users';
    protected $primaryKey = 'id';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'role_id', 'username', 'firstname', 'lastname', 'email', 'password', 
        'status', 'profile', 'last_ip'
    ];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    private $user;
    private $role;

    public function __construct(){
        helper('cookie');
        parent::__construct();
        $this->db = \Config\Database::connect();
        $this->checkSignIn();
    }
    
    protected function checkSignIn(){
        if(session()->get(getenv('app.sessionCookieName').'_SALT') 
        && session()->get(getenv('app.sessionCookieName').'_USERNAME') 
        && session()->get(getenv('app.sessionCookieName').'_EMAIL') 
        && session()->get(getenv('app.sessionCookieName').'_FIRSTNAME') 
        && session()->get(getenv('app.sessionCookieName').'_LASTNAME')){
            $this->signInWithSession();
        }

        if(get_cookie(getenv('app.cookiePrefix').'_SALT') 
        && get_cookie(getenv('app.cookiePrefix').'_USERNAME') 
        && get_cookie(getenv('app.cookiePrefix').'_EMAIL') 
        && get_cookie(getenv('app.cookiePrefix').'_FIRSTNAME') 
        && get_cookie(getenv('app.cookiePrefix').'_LASTNAME')){
            $this->signInWithCookies();
        }

        if($this->isSignedIn()){
            $query = $this->db->query(
                "UPDATE `users` SET `last_ip` = ? WHERE `id` = ?", 
                [ service('request')->getIPAddress(), $this->user['id'] ]
            );
        }
    }
    protected function signInWithSession(){
        $encrypter = \Config\Services::encrypter();
        $query = $this->db->query(
            "SELECT * FROM `users` WHERE `id` = ? OR `username` = ?", 
            [
                $encrypter->decrypt(session()->get(getenv('app.sessionCookieName').'_SALT')), 
                session()->get(getenv('app.sessionCookieName').'_USERNAME')
            ]
        );
        $user = $query->getRowArray();
        if($user){
            $this->setUserSession($user);
            $this->user = $user;
            $query2 = $this->db->query(
                "SELECT * FROM `user_roles` WHERE `id` = ?", 
                [ $this->user['role_id'] ]
            );
            $this->role = $query2->getRowArray();
        }
    }
    protected function signInWithCookies(){
        $encrypter = \Config\Services::encrypter();
        $query = $this->db->query(
            "SELECT * FROM `users` WHERE `id` = ? OR `username` = ?", 
            [
                $encrypter->decrypt(get_cookie(getenv('app.cookiePrefix').'_SALT')), 
                get_cookie(getenv('app.cookiePrefix').'_USERNAME')
            ]
        );
        $user = $query->getRowArray();
        if($user){
            $this->setUserSession($user);
            $this->user = $user;
            $query2 = $this->db->query(
                "SELECT * FROM `user_roles` WHERE `id` = ?", 
                [ $this->user['role_id'] ]
            );
            $this->role = $query2->getRowArray();
        }
    }


    protected function beforeInsert(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }
    protected function beforeUpdate(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function passwordHash(array $data){
        if(isset($data['data']['password'])){
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }


    public function getInfo(){return $this->user;}
    public function getRole(){return $this->role;}
    public function getUserId(){return $this->user['id'];}

    public function getDefaultRoleId(){
        $query = $this->db->query("SELECT `id` FROM `user_roles` WHERE `is_default` = 1 LIMIT 1");
        $role = $query->getRowArray();
        if(!$role) return null;
        else return $role['id'];
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

    public function setUserSession($user, $remember=false){
        $encrypter = \Config\Services::encrypter();
        session()->set([
            getenv('app.sessionCookieName').'_SALT' => $encrypter->encrypt($user['id']),
            getenv('app.sessionCookieName').'_USERNAME' => $user['username'],
            getenv('app.sessionCookieName').'_EMAIL' => $user['email'],
            getenv('app.sessionCookieName').'_FIRSTNAME' => $user['firstname'],
            getenv('app.sessionCookieName').'_LASTNAME' => $user['lastname'],
        ]);

        if($remember){
            set_cookie(
                getenv('app.cookiePrefix').'_SALT', $encrypter->encrypt($user['id']), 
                $expire = 60 * 60 * 24 * 30, $path = getenv('app.cookiePath')
            );
            set_cookie(
                getenv('app.cookiePrefix').'_USERNAME', $user['username'], 
                $expire = 60 * 60 * 24 * 30, $path = getenv('app.cookiePath')
            );
            set_cookie(
                getenv('app.cookiePrefix').'_EMAIL', $user['email'], 
                $expire = 60 * 60 * 24 * 30, $path = getenv('app.cookiePath')
            );
            set_cookie(
                getenv('app.cookiePrefix').'_FIRSTNAME', $user['firstname'], 
                $expire = 60 * 60 * 24 * 30, $path = getenv('app.cookiePath')
            );
            set_cookie(
                getenv('app.cookiePrefix').'_LASTNAME', $user['lastname'], 
                $expire = 60 * 60 * 24 * 30, $path = getenv('app.cookiePath')
            );
        }

        return true;
    }

    public function signout(){
        session()->destroy();
        delete_cookie(getenv('app.sessionCookieName').'_SALT', $path = getenv('app.cookiePath'));
        delete_cookie(getenv('app.sessionCookieName').'_USERNAME', $path = getenv('app.cookiePath'));
        delete_cookie(getenv('app.sessionCookieName').'_EMAIL', $path = getenv('app.cookiePath'));
        delete_cookie(getenv('app.sessionCookieName').'_FIRSTNAME', $path = getenv('app.cookiePath'));
        delete_cookie(getenv('app.sessionCookieName').'_LASTNAME', $path = getenv('app.cookiePath'));
        return true;
    }
    

    public function isSignedIn(){
        if($this->user && $this->role) return true;
        else return false;
    }

    public function isAdmin(){
        if($this->isSignedIn() && ($this->role['is_admin'] || $this->role['is_super_admin'])){
            return true;
        }else return false;
    }

    public function isSuperAdmin(){
        if($this->isSignedIn() && $this->role['is_super_admin']){
            return true;
        }else return false;
    }


    public function generateUserTemp($action, $username=false, $userId=false){
        if(!empty($action)){
            if($username){
                $query = $this->db->query(
                    "SELECT `id`, `email` FROM `users` WHERE `username` = ? OR `email` = ?", 
                    [ $username, $username ]
                );
                $user = $query->getRowArray();
                if(!$user) return false;
                else{
                    $salt = $this->randomChars(64);
                    $query2 = $this->db->query(
                        "INSERT INTO `user_temp` (`user_id`, `action`, `salt`, `ip`) 
                        VALUES (?, ?, ?, ?)", 
                        [ $user['id'], $action, $salt, service('request')->getIPAddress() ]
                    );
                    return [ 'email' => $user['email'], 'salt' => $salt ];
                }
            }else if($userId){

            }
        }
        return false;
    }
    public function getUserTemp($action, $salt, $isUsed=0){
        if(!empty($action) && !empty($salt)){
            $query = $this->db->query(
                "SELECT u.* FROM `users` AS u 
                INNER JOIN `user_temp` AS ut ON ut.`user_id` = u.`id` 
                WHERE ut.`action` = ? AND ut.`salt` = ? AND ut.`is_used` = ?", 
                [ $action, $salt, $isUsed ]
            );
            return $query->getRowArray();
        }
        return false;
    }
    public function useUserTemp($action, $salt){
        if(!empty($action) && !empty($salt)){
            $query = $this->db->query(
                "SELECT u.* FROM `users` AS u 
                INNER JOIN `user_temp` AS ut ON ut.`user_id` = u.`id` 
                WHERE ut.`action` = ? AND ut.`salt` = ? AND ut.`is_used` = ?", 
                [ $action, $salt, 0 ]
            );
            $user = $query->getRowArray();
            if(!$user) return false;

            $this->db->query(
                "UPDATE `user_temp` SET `is_used` = ?, `used_ip` = ? 
                WHERE `user_id` = ? AND `salt` = ?", 
                [ 1, service('request')->getIPAddress(), $user['id'], $salt ]
            );
            return $user;
        }
        return false;
    }

    public function randomChars($size){
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for($i=0; $i<$size; $i++){
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

}

?>
