<?php 
namespace App\Validation;

use App\Models\UserTypeModel;

class UserType {
    
    public function isValidUserType(string $str, string $fields, array $data){
        $userTypeModel = new UserTypeModel();
        if(empty($data['user_type_id'])){
            $data['user_type_id'] = $data['parent_id'];
        }
        $userType = $userTypeModel
            ->where([ 'id' => $data['user_type_id'], 'parent_id' => null ])
            ->first();
        if($userType) return true;
        else return false;
    }
    public function isValidUserSubtype(string $str, string $fields, array $data){
        $userTypeModel = new UserTypeModel();
        $userSubtype = $userTypeModel
            ->where([ 'id' => $data['user_subtype_id'], 'parent_id' => $data['user_type_id'] ])
            ->first();
        if($userSubtype) return true;
        else return false;
    }

}

?>