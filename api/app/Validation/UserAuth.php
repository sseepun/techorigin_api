<?php 
namespace App\Validation;
use App\Models\UserModel;

class UserAuth {

    public function validateUser(string $str, string $fields, array $data){
        $model = new UserModel();

        $userByEmail = $model->where('email', $data['username'])->first();
        $userByUsername = $model->where('username', $data['username'])->first();
        if(!$userByEmail && !$userByUsername) return false;

        $user = $userByEmail;
        if($userByUsername) $user = $userByUsername;

        return password_verify($data['password'], $user['password']);
    }
    public function validateForgetPassword(string $str, string $fields, array $data){
        $model = new UserModel();
        $user = $model->where('email', $data['email'])->first();
        if(!$user) return false;
        else return true;
    }

    public function isUniqureEmail(string $str, string $fields, array $data){
        $model = new UserModel();
        $userByEmail = $model->where('email', $data['email'])->first();
        if($userByEmail) return false;
        else return true;
    }
    public function isUniqureUsername(string $str, string $fields, array $data){
        $model = new UserModel();
        $userByUsername = $model->where('username', $data['username'])->first();
        if($userByUsername) return false;
        else return true;
    }

}

?>