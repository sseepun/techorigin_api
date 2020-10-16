<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'users';
    protected $primaryKey = 'id';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['role_id', 'firstname', 'lastname', 'email', 'password', 'status'];
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

        if(get_cookie(getenv('app.sessionCookieName').'_SALT') 
        && get_cookie(getenv('app.sessionCookieName').'_USERNAME') 
        && get_cookie(getenv('app.sessionCookieName').'_EMAIL') 
        && get_cookie(getenv('app.sessionCookieName').'_FIRSTNAME') 
        && get_cookie(getenv('app.sessionCookieName').'_LASTNAME')){
            $this->signInWithCookies();
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
                $encrypter->decrypt(get_cookie(getenv('app.sessionCookieName').'_SALT')), 
                get_cookie(getenv('app.sessionCookieName').'_USERNAME')
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


    protected function beforeInsert(array $data) {
        $data = $this->passwordHash($data);
        return $data;
    }
    protected function beforeUpdate(array $data) {
        $data = $this->passwordHash($data);
        return $data;
    }


    protected function passwordHash(array $data) {
        if(isset($data['data']['password'])){
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }


    public function getInfo(){return $this->user;}
    public function getRole(){return $this->role;}
    public function getUserId(){return $this->user['id'];}


    public function authUserByUsernameOrEmain($string, $password){
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
                getenv('app.sessionCookieName').'_SALT', $encrypter->encrypt($user['id']), 
                $expire = 60 * 60 * 24 * 30, $path = '/'
            );
            set_cookie(
                getenv('app.sessionCookieName').'_USERNAME', $user['username'], 
                $expire = 60 * 60 * 24 * 30, $path = '/'
            );
            set_cookie(
                getenv('app.sessionCookieName').'_EMAIL', $user['email'], 
                $expire = 60 * 60 * 24 * 30, $path = '/'
            );
            set_cookie(
                getenv('app.sessionCookieName').'_FIRSTNAME', $user['firstname'], 
                $expire = 60 * 60 * 24 * 30, $path = '/'
            );
            set_cookie(
                getenv('app.sessionCookieName').'_LASTNAME', $user['lastname'], 
                $expire = 60 * 60 * 24 * 30, $path = '/'
            );
        }

        return true;
    }

    public function signout(){
        session()->destroy();
        delete_cookie(getenv('app.sessionCookieName').'_SALT', $path = '/');
        delete_cookie(getenv('app.sessionCookieName').'_USERNAME', $path = '/');
        delete_cookie(getenv('app.sessionCookieName').'_EMAIL', $path = '/');
        delete_cookie(getenv('app.sessionCookieName').'_FIRSTNAME', $path = '/');
        delete_cookie(getenv('app.sessionCookieName').'_LASTNAME', $path = '/');
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

}

?>
