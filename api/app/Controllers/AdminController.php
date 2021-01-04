<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Models\UserModel;
use App\Models\UserDetailModel;
use App\Models\UserRoleModel;

use App\Models\ActionLogModel;

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
        
        $input = stdClassToArray($request->getJSON());
        if(empty($input['app_id']) || $input['app_id']!=getenv('app.id')){
            echo '404'; exit;
        }
        
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
                'profile' => !empty($input['profile'])? $input['profile']: null,
            ]);
            
            $actionLogModel = new ActionLogModel();
            $actionLogModel->insert([
                'user_id' => $this->user['id'],
                'target_user_id' => $this->userModel->getInsertID(),
                'action' => 'Admin - User Create',
                'url' => !empty($input['url'])? $input['url']: null,
                'ip' => !empty($input['ip'])? $input['ip']: null,
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

            $actionLogModel = new ActionLogModel();
            $actionLogModel->insert([
                'user_id' => $this->user['id'],
                'target_user_id' => $user['id'],
                'action' => 'Admin - User Update',
                'url' => !empty($input['url'])? $input['url']: null,
                'ip' => !empty($input['ip'])? $input['ip']: null,
            ]);

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
    public function userUpdateDetail(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            unset($input['id']);
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'userUpdateDetail')){
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

            $actionLogModel = new ActionLogModel();
            $actionLogModel->insert([
                'user_id' => $this->user['id'],
                'target_user_id' => $user['id'],
                'action' => 'Admin - User Update Detail',
                'url' => !empty($input['url'])? $input['url']: null,
                'ip' => !empty($input['ip'])? $input['ip']: null,
            ]);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'แก้ไขข้อมูลสำเร็จ' ],
                'data' => $user,
            ]);
        }
        return $this->failValidationError();
    }
    public function userUpdatePassword(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'adminUserUpdatePassword')){
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

            $actionLogModel = new ActionLogModel();
            $actionLogModel->insert([
                'user_id' => $this->user['id'],
                'target_user_id' => $input['id'],
                'action' => 'Admin - User Update Password',
                'url' => !empty($input['url'])? $input['url']: null,
                'ip' => !empty($input['ip'])? $input['ip']: null,
            ]);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'แก้ไขข้อมูลสำเร็จ' ],
                'data' => true,
            ]);
        }
        return $this->failValidationError();
    }

    public function userDelete(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'adminUserDelete')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            if($input['id']<3) unset($input['id']);

            $user = $this->checkRoleAccess($input['id']);
            if(!$user) return $this->failValidationError();
            
            $this->userModel->delete($input['id']);

            $actionLogModel = new ActionLogModel();
            $actionLogModel->insert([
                'user_id' => $this->user['id'],
                'target_user_id' => $input['id'],
                'action' => 'Admin - User Delete',
                'url' => !empty($input['url'])? $input['url']: null,
                'ip' => !empty($input['ip'])? $input['ip']: null,
            ]);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ลบข้อมูลสำเร็จ' ],
                'data' => $input,
            ]);
        }
        return $this->failValidationError();
    }

}
