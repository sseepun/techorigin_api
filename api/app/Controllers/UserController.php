<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Models\UserRoleModel;
use App\Models\UserModel;

class UserController extends ResourceController{
    protected $format = 'json';

    public function __construct(){ }


    public function userRead(){
        if($this->request->getMethod()=='get'){
            helper(['input', 'jwt']);
            $decoded = stdClassToArray(jwtDecodeToken(
                $this->request->getHeaderLine('Authorization')
            ));

            $userModel = new UserModel();
            $info = $userModel->getInfo($decoded['id']);
            if(!empty($info['profile']) && strpos($info['profile'], 'http')===false){
                $info['profile'] = getenv('app.baseURL').$info['profile'];
            }
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $info,
            ]);
        }
        return $this->failValidationError();
    }
    public function userUpdate(){
        if($this->request->getMethod()=='post'){
            helper(['input', 'jwt']);
            $decoded = stdClassToArray(jwtDecodeToken(
                $this->request->getHeaderLine('Authorization')
            ));

            $input = stdClassToArray($this->request->getJSON());
            unset($input['id']);
            unset($input['role_id']);
            unset($input['password']);
            unset($input['thai_id']);
            unset($input['status']);
            
            $validation = \Config\Services::validation();
            if(!$validation->run(array_merge(['id' => $decoded['id']], $input), 'userUpdate')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            
            $userModel = new UserModel();
            $userModel->update($decoded['id'], $input);
            
            if(!empty($input['profile']) && strpos($input['profile'], 'http')===false){
                $input['profile'] = getenv('app.baseURL').$input['profile'];
            }

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'แก้ไขข้อมูลสำเร็จ' ],
                'data' => $input,
                'jwt' => jwtUpdateUserToken($input, $decoded)
            ]);
        }
        return $this->failValidationError();
    }


    public function roleRead(){
        if($this->request->getMethod()=='get'){
            helper(['input', 'jwt']);
            $decoded = stdClassToArray(jwtDecodeToken(
                $this->request->getHeaderLine('Authorization')
            ));

            $userRoleModel = new UserRoleModel();
            $role = $userRoleModel->find($decoded['role_id']);
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $role,
            ]);
        }
        return $this->failValidationError();
    }

}
