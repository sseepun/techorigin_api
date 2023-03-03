<?php namespace App\Models;

use CodeIgniter\Model;

class ModulePermissionModel extends Model {
    protected $table = 'module_permissions';
    protected $primaryKey = 'id';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'module_id', 'role_id', 'create', 'read', 'update', 'delete',
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
