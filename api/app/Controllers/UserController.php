<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Models\UserModel;
use App\Models\UserDetailModel;
use App\Models\UserRoleModel;

use App\Models\ModuleModel;

use App\Models\ActionLogModel;
use App\Models\TrafficLogModel;

class UserController extends ResourceController{
    protected $format = 'json';

    private $decoded;

    private $userModel;
    private $user;

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
    }

    
    public function selfRead(){
        if($this->request->getMethod()=='get'){
            $userDetailModel = new UserDetailModel();
            $userRoleModel = new UserRoleModel();

            $data = $this->user;
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
    public function selfUpdate(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            unset($input['id']);
            unset($input['role_id']);
            unset($input['password']);
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
            
            $input = $this->userModel->cleanData($input);
            $this->userModel->update($this->decoded['id'], $input);
            
            $actionLogModel = new ActionLogModel();
            $actionLogModel->insert([
                'user_id' => $this->user['id'],
                'action' => 'User Update',
                'url' => !empty($input['url'])? $input['url']: null,
                'ip' => !empty($input['ip'])? $input['ip']: null,
            ]);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'แก้ไขข้อมูลสำเร็จ' ],
                'data' => $input,
                'jwt' => jwtUpdateUserToken($input, $this->decoded)
            ]);
        }
        return $this->failValidationError();
    }
    public function selfUpdateDetail(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            $input['user_id'] = $this->decoded['id'];
            unset($input['id']);
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'userUpdateDetail')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            
            $userDetailModel = new UserDetailModel();
            $detail = $userDetailModel->where('user_id', $input['user_id'])->first();
            if($detail) $input['id'] = $detail['id'];
            $userDetailModel->save($input);
            
            $actionLogModel = new ActionLogModel();
            $actionLogModel->insert([
                'user_id' => $this->user['id'],
                'action' => 'User Update Detail',
                'url' => !empty($input['url'])? $input['url']: null,
                'ip' => !empty($input['ip'])? $input['ip']: null,
            ]);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'แก้ไขข้อมูลสำเร็จ' ],
                'data' => $input,
            ]);
        }
        return $this->failValidationError();
    }
    public function selfUpdatePassword(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            $input['id'] = $this->decoded['id'];
            
            $validation = \Config\Services::validation();
            if($this->user['is_password_set']){
                if(!$validation->run($input, 'userUpdatePassword')){
                    return $this->respond([
                        'status' => 400,
                        'messages' => $validation->getErrors()
                    ]);
                }
            }else{
                if(!$validation->run($input, 'userUpdatePasswordWithoutPassword')){
                    return $this->respond([
                        'status' => 400,
                        'messages' => $validation->getErrors()
                    ]);
                }
            }
            
            $this->userModel->save([
                'id' => $this->decoded['id'], 'password' => $input['new_password'],
                'is_password_set' => 1,
            ]);
            
            $actionLogModel = new ActionLogModel();
            $actionLogModel->insert([
                'user_id' => $this->user['id'],
                'action' => 'User Update Password',
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

    
    public function userList(){
        if($this->request->getMethod()=='get'){
            $tableObject = $this->userModel->getTableObject();
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $tableObject,
            ]);
        }
        return $this->failValidationError();
    }
    public function userRead($id){
        if($this->request->getMethod()=='get' && !empty($id)){
            $userModel = new UserModel();
            $userDetailModel = new UserDetailModel();
            $userRoleModel = new UserRoleModel();

            $data = $userModel->where(['id' => $id])->first();
            if(!$data) return $this->failValidationError();
            else{
                unset($data['password']);
                unset($data['thai_id']);
                unset($data['thai_id_path']);
                unset($data['code']);
                unset($data['last_ip']);
                $detail = $userDetailModel->where('user_id', $data['id'])->first();
                if($detail) $data['detail'] = $detail;
                $data['role'] = $userRoleModel->find($data['role_id']);
            }

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $data,
            ]);
        }
        return $this->failValidationError();
    }

    public function selfModulePermissions(){
        if($this->request->getMethod()=='get'){
            $moduleModel = new ModuleModel();
            $permissions = $moduleModel->getPermissionsByUserRoleId($this->user['role_id']);
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $permissions,
            ]);
        }
        return $this->failValidationError();
    }


    public function signout(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());

            $actionLogModel = new ActionLogModel();
            $actionLogModel->insert([
                'user_id' => $this->user['id'],
                'action' => 'Sign Out',
                'url' => !empty($input['url'])? $input['url']: null,
                'ip' => !empty($input['ip'])? $input['ip']: null,
            ]);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'คุณได้ออกจากระบบสำเร็จแล้ว' ],
                'jwt' => null,
            ]);
        }
        return $this->failValidationError();
    }


    public function trafficCreate(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());

            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'trafficCreate')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            
            $trafficLogModel = new TrafficLogModel();
            $trafficLogModel->insert([
                'user_id' => $this->user['id'],
                'url' => $input['url'],
                'ip' => $input['ip'],
            ]);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'เพิ่มการเข้าชมสำเร็จแล้ว' ],
                'data' => true,
            ]);
        }
        return $this->failValidationError();
    }

}
