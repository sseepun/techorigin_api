<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Models\UserModel;
use App\Models\UserDetailModel;
use App\Models\UserRoleModel;

class SuperAdminController extends ResourceController{
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
        if(!$this->userRole || !$this->userRole['is_super_admin']){ echo '404'; exit; }
    }


    // public function checkRoleAccess($userId){
    //     $user = $this->userModel->getUserById($userId);
    //     if(!$user) return false;

    //     if(!$this->userRole['is_super_admin']){
    //         $role = $this->userModel->getRoleByUserId($userId);
    //         if($this->user['id'] != $user['id'] 
    //         && (!$role || $role['is_admin'] || $role['is_super_admin'])){
    //             return false;
    //         }
    //     }
        
    //     return $user;
    // }


    public function userRoleCreate(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            unset($input['id']);
            unset($input['is_super_admin']);

            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'sadminUserRoleCreate')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }

            $this->userRoleModel->save($input);
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'สร้างข้อมูลสำเร็จ' ],
                'data' => $input,
            ]);
        }
        return $this->failValidationError();
    }
    public function userRoleRead($roleId){
        if($this->request->getMethod()=='get' && !empty($roleId)){
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $this->userRoleModel->find($roleId),
            ]);
        }
        return $this->failValidationError();
    }
    public function userRoleUpdate(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            unset($input['is_super_admin']);

            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'sadminUserRoleUpdate')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }

            $this->userRoleModel->save($input);
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'แก้ไขข้อมูลสำเร็จ' ],
                'data' => $input,
            ]);
        }
        return $this->failValidationError();
    }
    public function userRoleDelete(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            if($input['id']<3) return $this->failValidationError();
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'sadminUserRoleDelete')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            
            $this->userRoleModel->delete($input['id']);
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ลบข้อมูลสำเร็จ' ],
                'data' => $input,
            ]);
        }
        return $this->failValidationError();
    }

}
