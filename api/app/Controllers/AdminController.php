<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Models\UserModel;
use App\Models\UserDetailModel;
use App\Models\UserRoleModel;

class AdminController extends ResourceController{
    protected $format = 'json';

    private $decoded;

    private $userModel;
    private $userRoleModel;
    private $user;
    private $userRole;

    public function __construct(){
        helper(['input', 'jwt']);
        $request = \Config\Services::request();
        
        $this->decoded = stdClassToArray(jwtDecodeToken(
            $request->getHeaderLine('Authorization')
        ));

        $this->userModel = new UserModel();
        $this->user = $this->userModel->getUserById($this->decoded['id']);
        if(!$this->user){ echo '404'; exit; }

        $this->userRoleModel = new UserRoleModel();
        $this->userRole = $this->userRoleModel->find($this->user['role_id']);
        if(!$this->userRole || 
        (!$this->userRole['is_admin'] && !$this->userRole['is_super_admin'])){
            echo '404'; exit;
        }
    }


    public function checkRoleAccess($userId){
        $user = $this->userModel->getUserById($userId);
        if(!$user) return false;

        if(!$this->userRole['is_super_admin']){
            $role = $this->userModel->getRoleByUserId($userId);
            if($this->user['id'] != $user['id'] 
            && (!$role || $role['is_admin'] || $role['is_super_admin'])){
                return false;
            }
        }
        
        return $user;
    }
    

    public function userCreate(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            if(!empty($input['role_id']) && $input['role_id']==1) unset($input['role_id']);

            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'signup')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }

            $roleId = !empty($input['role_id'])
                ? $input['role_id']: $this->userModel->getDefaultRoleId();
            $this->userModel->insert([
                'role_id' => $roleId,
                'firstname' => $input['firstname'],
                'lastname' => $input['lastname'],
                'email' => $input['email'],
                'username' => $input['username'],
                'password' => $input['password'],
                'last_ip' => $input['ip'],
            ]);
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'สร้างข้อมูลสำเร็จ' ],
                'data' => $input,
            ]);
        }
        return $this->failValidationError();
    }
    public function userRead($id){
        if($this->request->getMethod()=='get' && !empty($id)){
            $userDetailModel = new UserDetailModel();

            $data = $this->userModel->where(['id' => $id])->first();
            if($data){
                unset($data['password']);
                $detail = $userDetailModel->where('user_id', $data['id'])->first();
                if($detail) $data['detail'] = $detail;
                $data['role'] = $this->userRoleModel->find($data['role_id']);
            }

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
            if(!empty($input['role_id']) && $input['role_id']==1) unset($input['role_id']);
            unset($input['password']);
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'adminUserUpdate')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }

            $user = $this->checkRoleAccess($input['id']);
            if(!$user) return $this->failValidationError();
            
            $this->userModel->update($input['id'], $input);
            $input = $this->userModel->cleanData($input);

            if($this->user['id']==$user['id']){
                return $this->respond([
                    'status' => 200,
                    'messages' => [ 'success' => 'แก้ไขข้อมูลสำเร็จ' ],
                    'data' => $input,
                    'jwt' => jwtUpdateUserToken($input, $this->decoded)
                ]);
            }else{
                return $this->respond([
                    'status' => 200,
                    'messages' => [ 'success' => 'แก้ไขข้อมูลสำเร็จ' ],
                    'data' => $input,
                ]);
            }
        }
        return $this->failValidationError();
    }
    public function userDelete(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            if($input['id']<3) unset($input['id']);
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'adminUserDelete')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }

            $user = $this->checkRoleAccess($input['id']);
            if(!$user) return $this->failValidationError();
            
            $this->userModel->delete($input['id']);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ลบข้อมูลสำเร็จ' ],
                'data' => $input,
            ]);
        }
        return $this->failValidationError();
    }

    public function userDetailUpdate(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            unset($input['id']);
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'userDetailUpdate')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            
            $user = $this->checkRoleAccess($input['user_id']);
            if(!$user) return $this->failValidationError();
            
            $userDetailModel = new UserDetailModel();
            $detail = $userDetailModel->where('user_id', $input['user_id'])->first();
            if($detail) $input['id'] = $detail['id'];
            $userDetailModel->save($input);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'แก้ไขข้อมูลสำเร็จ' ],
                'data' => $user,
            ]);
        }
        return $this->failValidationError();
    }
    public function userPasswordUpdate(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'adminUserPasswordUpdate')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            
            $user = $this->checkRoleAccess($input['id']);
            if(!$user) return $this->failValidationError();
            
            $this->userModel->save([
                'id' => $input['id'], 'password' => $input['new_password']
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
