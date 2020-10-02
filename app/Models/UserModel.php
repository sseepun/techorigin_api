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
        parent::__construct();
        $this->db = \Config\Database::connect();
        $this->checkSignIn();
    }
    
    protected function checkSignIn(){
        if(session()->get(getenv('app.sessionCookieName').'SALT') 
        && session()->get(getenv('app.sessionCookieName').'USERNAME') 
        && session()->get(getenv('app.sessionCookieName').'EMAIL') 
        && session()->get(getenv('app.sessionCookieName').'FIRSTNAME') 
        && session()->get(getenv('app.sessionCookieName').'LASTNAME')){
            $this->signInWithSession();
        }
    }

    protected function signInWithSession(){
        $encrypter = \Config\Services::encrypter();
        $query = $this->db->query(
            "SELECT * FROM `users` WHERE `id` = ? OR `username` = ?", 
            [
                $encrypter->decrypt(session()->get(getenv('app.sessionCookieName').'SALT')), 
                session()->get(getenv('app.sessionCookieName').'USERNAME')
            ]
        );
        $user = $query->getRowArray();
        if($user){
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

    public function setUserSession($user){
        $encrypter = \Config\Services::encrypter();
        session()->set([
            getenv('app.sessionCookieName').'SALT' => $encrypter->encrypt($user['id']),
            getenv('app.sessionCookieName').'USERNAME' => $user['username'],
            getenv('app.sessionCookieName').'EMAIL' => $user['email'],
            getenv('app.sessionCookieName').'FIRSTNAME' => $user['firstname'],
            getenv('app.sessionCookieName').'LASTNAME' => $user['lastname'],
        ]);
        return true;
    }

    public function signout(){
        session()->destroy();
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
