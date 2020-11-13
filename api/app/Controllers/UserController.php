<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Models\UserModel;
use App\Models\UserDetailModel;
use App\Models\UserRoleModel;

class UserController extends ResourceController{
    protected $format = 'json';

    private $decoded;

    private $userModel;
    private $user;

    public function __construct(){
        helper(['input', 'jwt']);
        $request = \Config\Services::request();
        
        $this->decoded = stdClassToArray(jwtDecodeToken(
            $request->getHeaderLine('Authorization')
        ));

        $this->userModel = new UserModel();
        $this->user = $this->userModel->getUser($this->decoded['id']);
        
        if(!$this->user){ echo '404'; exit; }
    }

    public function userRead(){
        if($this->request->getMethod()=='get'){
            $userDetailModel = new UserDetailModel();
            $userRoleModel = new UserRoleModel();

            $data = $this->user;
            if(!empty($data['profile']) && strpos($data['profile'], 'http')===false){
                $data['profile'] = getenv('app.baseURL').$data['profile'];
            }
            $detail = $userDetailModel->where('user_id', $data['id'])->first();
            if($detail) $data['detail'] = $detail;
            $data['role'] = $userRoleModel->find($data['role_id']);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $data,
            ]);
        }
        return $this->failValidationError();
    }

    public function userUpdate(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            unset($input['id']);
            unset($input['role_id']);
            unset($input['password']);
            unset($input['thai_id']);
            unset($input['code']);
            unset($input['status']);
            
            $validation = \Config\Services::validation();
            if(!$validation->run(
                array_merge(['id' => $this->decoded['id']], $input), 'userUpdate'
            )){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            
            $this->userModel->update($this->decoded['id'], $input);
            if(!empty($input['profile']) && strpos($input['profile'], 'http')===false){
                $input['profile'] = getenv('app.baseURL').$input['profile'];
            }

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'แก้ไขข้อมูลสำเร็จ' ],
                'data' => $input,
                'jwt' => jwtUpdateUserToken($input, $this->decoded)
            ]);
        }
        return $this->failValidationError();
    }

    public function userDetailUpdate(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            $input = array_merge(['user_id' => $this->decoded['id']], $input);
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'userDetailUpdate')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            
            $userDetailModel = new UserDetailModel();
            $detail = $userDetailModel->where('user_id', $input['user_id'])->first();
            if($detail){
                $userDetailModel->save(array_merge(['id' => $detail['id']], $input));
            }else{
                $userDetailModel->save($input);
            }

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'แก้ไขข้อมูลสำเร็จ' ],
                'data' => $input,
            ]);
        }
        return $this->failValidationError();
    }

    public function userPasswordUpdate(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            $input = array_merge(['id' => $this->decoded['id']], $input);
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'userPasswordUpdate')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            
            $this->userModel->save([
                'id' => $this->decoded['id'], 'password' => $input['new_password']
            ]);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'แก้ไขข้อมูลสำเร็จ' ],
                'data' => true,
            ]);
        }
        return $this->failValidationError();
    }

}
