<?php 
namespace App\Validation;

use App\Models\UserCustomColumnModel;

class UserCustomColumn {
    
    public function isValidUserColumnName(string $str, string $fields, array $data){
        return !preg_match('/[^a-z_]/', $data['name']);
    }

    public function exceedUserColumnNumber(string $str, string $fields, array $data){
        $userCustomColumnModel = new UserCustomColumnModel();
        $columnId = $userCustomColumnModel->getNextColumnId();
        return $columnId <= 20;
    }

    public function restrictedUserColumnNames(string $str, string $fields, array $data){
        if(in_array($data['name'], [
            'id', 'user_id', 'role_id', 'column_id', 'name', 'status', 'firstname', 'lastname',
            'created_at', 'updated_at', 'username', 'password', 'email', 'is_password_set',
            'profile', 'thia_id', 'thai_id_path', 'facebook_id', 'google_id', 'ip', 'last_ip',
            'user_type_id', 'user_subtype_id', 'address', 'phone', 'title', 'company',
            'company_address', 'company_phone'
        ])){
            return false;
        }else{
            return true;
        }
    }

}

?>