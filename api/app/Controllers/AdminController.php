<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Models\UserTypeModel;
use App\Models\UserModel;
use App\Models\UserDetailModel;
use App\Models\UserRoleModel;
use App\Models\UserCustomColumnModel;

use App\Models\ModuleModel;
use App\Models\ModulePermissionModel;

use App\Models\ExternalAppModel;
use App\Models\ActionLogModel;
use App\Models\TrafficLogModel;

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
        if($request->getMethod()!='get'){
            if(empty($input['app_id']) || $input['app_id']!=getenv('app.id')){
                echo '404'; exit;
            }
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


    public function userTypeList(){
        if($this->request->getMethod()=='get'){
            $userTypeModel = new UserTypeModel();
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $userTypeModel->getUserTypes(true),
            ]);
        }
        return $this->failValidationError();
    }
    public function userTypeRead($id){
        if($this->request->getMethod()=='get' && !empty($id)){
            $userTypeModel = new UserTypeModel();
            $data = $userTypeModel->where(['id' => $id])->first();
            if(!$data) return $this->failValidationError();

            $data['subtypes'] = $userTypeModel->getUserSubtypes($data['id']);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $data,
            ]);
        }
        return $this->failValidationError();
    }

    
    public function userRoleList(){
        if($this->request->getMethod()=='get'){
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $this->userRoleModel->getUserRoles(true),
            ]);
        }
        return $this->failValidationError();
    }
    public function userRoleRead($roleId){
        if($this->request->getMethod()=='get' && !empty($roleId)){
            $role = $this->userRoleModel->find($roleId);
            if(!$role) return $this->failValidationError();

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $role,
            ]);
        }
        return $this->failValidationError();
    }

    
    public function userList(){
        if($this->request->getMethod()=='get'){
            $pp = !empty($this->request->getGet('pp'))? $this->request->getGet('pp'): 10;
            if($pp>1000) $pp = 1000;
            $tableObject = $this->userModel->getTableObject(
                true, !empty($this->request->getGet('page'))? $this->request->getGet('page'): 1,
                $pp, !empty($this->request->getGet('keyword'))? $this->request->getGet('keyword'): '',
            );
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $tableObject,
            ]);
        }
        return $this->failValidationError();
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
            $insertData = [
                'role_id' => $roleId,
                'firstname' => $input['firstname'],
                'lastname' => $input['lastname'],
                'email' => $input['email'],
                'username' => $input['username'],
                'password' => $input['password'],
                'profile' => !empty($input['profile'])? $input['profile']: null,
            ];
            $this->userModel->insert($insertData);
            $insertData['id'] = $this->userModel->getInsertID();
            
            $actionLogModel = new ActionLogModel();
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                'user_id' => $this->user['id'],
                'target_user_id' => $this->userModel->getInsertID(),
                'action' => 'Admin - User Create',
                'url' => !empty($input['url'])? $input['url']: null,
                'ip' => !empty($input['ip'])? $input['ip']: null,
            ]);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'สร้างข้อมูลสำเร็จ' ],
                'data' => $insertData,
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
                 
                $customDetails = $userDetailModel->getCustomDetails(true, $data['id']);
                if($customDetails) $data = array_merge($data, $customDetails);
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
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
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
            if(!empty($input['user_subtype_id']) && !$validation->run($input, 'userUpdateUserTypes')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }else if(!empty($input['user_type_id']) && !$validation->run($input, 'userUpdateUserType')){
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
            $userDetailModel->updateCustomDetails($input['user_id'], $input);

            $actionLogModel = new ActionLogModel();
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
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
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
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
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                'user_id' => $this->user['id'],
                'target_user_id' => $input['id'],
                'action' => 'Admin - User Delete',
                'url' => !empty($input['url'])? $input['url']: null,
                'ip' => !empty($input['ip'])? $input['ip']: null,
            ]);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ลบข้อมูลสำเร็จ' ],
                'data' => true,
            ]);
        }
        return $this->failValidationError();
    }
    
    public function userCustomColumnList(){
        if($this->request->getMethod()=='get'){
            $userCustomColumnModel = new UserCustomColumnModel();
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $userCustomColumnModel->getList(true),
            ]);
        }
        return $this->failValidationError();
    }
    public function userCustomColumnRead($id){
        if($this->request->getMethod()=='get' && !empty($id)){
            $userCustomColumnModel = new UserCustomColumnModel();
            $userColumn = $userCustomColumnModel->find($id);
            if(!$userColumn) return $this->failValidationError();

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $userColumn,
            ]);
        }
        return $this->failValidationError();
    }


    public function externalAppList(){
        if($this->request->getMethod()=='get'){
            $externalAppModel = new ExternalAppModel();
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $externalAppModel->findAll(),
            ]);
        }
        return $this->failValidationError();
    }
    public function externalAppCreate(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());

            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'adminExternalAppCreate')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }

            $externalAppModel = new ExternalAppModel();
            $externalAppModel->insert($input);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'สร้างข้อมูลสำเร็จ' ],
                'data' => true,
            ]);
        }
        return $this->failValidationError();
    }
    public function externalAppRead($id){
        if($this->request->getMethod()=='get' && !empty($id)){
            $externalAppModel = new ExternalAppModel();
            $data = $externalAppModel->where(['id' => $id])->first();
            if(!$data) return $this->failValidationError();
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $data,
            ]);
        }
        return $this->failValidationError();
    }
    public function externalAppUpdate(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'adminExternalAppUpdate')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }

            $externalAppModel = new ExternalAppModel();
            $externalApp = $externalAppModel->where('id', $input['id'])->first();
            if(!$externalApp) return $this->failValidationError();

            $externalAppModel->update($input['id'], $input);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'แก้ไขข้อมูลสำเร็จ' ],
                'data' => $input,
            ]);
        }
        return $this->failValidationError();
    }
    public function externalAppDelete(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'adminExternalAppDelete')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            
            $externalAppModel = new ExternalAppModel();
            $externalApp = $externalAppModel->where('id', $input['id'])->first();
            if(!$externalApp) return $this->failValidationError();
            
            $externalAppModel->delete($input['id']);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ลบข้อมูลสำเร็จ' ],
                'data' => true,
            ]);
        }
        return $this->failValidationError();
    }

    public function moduleList(){
        if($this->request->getMethod()=='get'){
            $moduleModel = new ModuleModel();
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $moduleModel->findAll(),
            ]);
        }
        return $this->failValidationError();
    }
    public function moduleRead($moduleId){
        if($this->request->getMethod()=='get' && !empty($moduleId)){
            $moduleModel = new ModuleModel();
            $module = $moduleModel->find($moduleId);
            if(!$module) return $this->failValidationError();

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $module,
            ]);
        }
        return $this->failValidationError();
    }


    public function rolePermissionsRead($roleId){
        if($this->request->getMethod()=='get' && !empty($roleId)){
            $role = $this->userRoleModel->find($roleId);
            if(!$role) return $this->failValidationError();

            $moduleModel = new ModuleModel();
            $permissions = $moduleModel->getPermissionsByUserRoleId($roleId);
            
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $permissions,
            ]);
        }
        return $this->failValidationError();
    }


    public function trafficReport(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'adminTrafficReport')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }

            $trafficLogModel = new TrafficLogModel();
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $trafficLogModel->getReport($input['type'], $input),
            ]);
        }
        return $this->failValidationError();
    }
    public function actionReport(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'adminActionReport')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }

            $actionLogModel = new ActionLogModel();
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $actionLogModel->getReport($input['type'], $input),
            ]);
        }
        return $this->failValidationError();
    }
    public function userRegistrationReport(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'adminNewRegistrationReport')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $this->userModel->getRegistrationReport($input['type'], $input),
            ]);
        }
        return $this->failValidationError();
    }

}
