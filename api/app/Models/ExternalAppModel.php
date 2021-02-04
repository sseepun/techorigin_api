<?php namespace App\Models;

use CodeIgniter\Model;

class ExternalAppModel extends Model {
    protected $table = 'external_apps';
    protected $primaryKey = 'id';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'description', 'url', 'status'];
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
