<?php namespace App\Models;

use CodeIgniter\Model;

class UserDetailModel extends Model {
    protected $table = 'user_details';
    protected $primaryKey = 'id';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'user_id', 'user_type_id', 'user_subtype_id', 'address', 'phone', 
        'title', 'company', 'company_address', 'company_phone'
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

}
