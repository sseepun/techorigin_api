<?php namespace App\Models;

use CodeIgniter\Model;

class ModuleModel extends Model {
    protected $table = 'modules';
    protected $primaryKey = 'id';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'code', 'order', 'status'];
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


    public function getPermissionsByUserRoleId($roleId){
        $query = $this->db->query(
            "SELECT m.`id` AS 'module_id', m.`name`, m.`code`, m.`status`, 
            COALESCE(mp.`create`, 0) AS 'create', 
            COALESCE(mp.`read`, 0) AS 'read', 
            COALESCE(mp.`update`, 0) AS 'update', 
            COALESCE(mp.`delete`, 0) AS 'delete' 
            FROM `modules` AS m 
            LEFT JOIN `module_permissions` AS mp 
                ON mp.`module_id` = m.`id` AND mp.`role_id` = ? 
            WHERE 1",
            [ $roleId ]
        );
        $permissions = $query->getResultArray();

        $query2 = $this->db->query(
            "SELECT `id` FROM `user_roles` 
            WHERE `id` = ? AND `is_super_admin` = 1",
            [ $roleId ]
        );
        $isSuperAdmin = $query2->getRowArray();

        if(!$isSuperAdmin) return $permissions;
        else{
            $result = [];
            foreach($permissions as $p){
                $p['create'] = 1;
                $p['read'] = 1;
                $p['update'] = 1;
                $p['delete'] = 1;
                $result[] = $p;
            }
            return $result;
        }
    }

}
