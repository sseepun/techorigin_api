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
        if(!$this->userRole || !$this->userRole['is_super_admin']){ echo '404'; exit; }
    }
    

    public function userTypeCreate(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());

            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'sadminUserTypeCreate')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            if(!empty($input['parent_id']) && !$validation->run($input, 'sadminValidateUserType')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }

            $userTypeModel = new UserTypeModel();
            $userTypeModel->save($input);
            
            $actionLogModel = new ActionLogModel();
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                'user_id' => $this->user['id'],
                'action' => 'Super Admin - User Type Create',
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
    public function userTypeUpdate(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            unset($input['parent_id']);

            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'sadminUserRoleUpdate')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            
            $userTypeModel = new UserTypeModel();
            $userType = $userTypeModel->find($input['id']);
            if(!$userType) return $this->failValidationError();
            
            $userTypeModel->save($input);
            
            $actionLogModel = new ActionLogModel();
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                'user_id' => $this->user['id'],
                'action' => 'Super Admin - User Type Update',
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
    public function userTypeDelete(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'sadminUserTypeDelete')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            
            $userTypeModel = new UserTypeModel();
            $userType = $userTypeModel->find($input['id']);
            if(!$userType) return $this->failValidationError();
            
            $userTypeModel->where([ 'id' => $input['id'] ])->delete();
            $userTypeModel->where([ 'parent_id' => $input['id'] ])->delete();
            
            $actionLogModel = new ActionLogModel();
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                'user_id' => $this->user['id'],
                'action' => 'Super Admin - User Type Delete',
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
            
            $actionLogModel = new ActionLogModel();
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                'user_id' => $this->user['id'],
                'action' => 'Super Admin - User Role Create',
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
            
            $role = $this->userRoleModel->find($input['id']);
            if(!$role) return $this->failValidationError();

            $this->userRoleModel->save($input);
            
            $actionLogModel = new ActionLogModel();
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                'user_id' => $this->user['id'],
                'action' => 'Super Admin - User Role Update',
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
    public function userRoleDelete(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'sadminUserRoleDelete')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            if($input['id']<3) return $this->failValidationError();
            
            $role = $this->userRoleModel->find($input['id']);
            if(!$role) return $this->failValidationError();
            
            $this->userRoleModel->delete($input['id']);
            
            $actionLogModel = new ActionLogModel();
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                'user_id' => $this->user['id'],
                'action' => 'Super Admin - User Role Delete',
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
    public function userCustomColumnCreate(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            unset($input['column_id']);

            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'sadminUserCustomColumnCreate')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }

            $userCustomColumnModel = new UserCustomColumnModel();
            $columnId = $userCustomColumnModel->getNextColumnId();
            $input['column_id'] = $columnId;
            $userCustomColumnModel->save($input);
            
            if(false){
                $actionLogModel = new ActionLogModel();
                $actionLogModel->saveLog([
                    'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                    'user_id' => $this->user['id'],
                    'action' => 'Super Admin - User Custom Column Create',
                    'url' => !empty($input['url'])? $input['url']: null,
                    'ip' => !empty($input['ip'])? $input['ip']: null,
                ]);
            }

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'สร้างข้อมูลสำเร็จ' ],
                'data' => [
                    'column_id' => $input['column_id'],
                    'name' => $input['name'],
                    'status' => 1,
                ],
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
    public function userCustomColumnUpdate(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            unset($input['column_id']);

            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'sadminUserCustomColumnUpdate')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            
            $userCustomColumnModel = new UserCustomColumnModel();
            $userColumn = $userCustomColumnModel->find($input['id']);
            if(!$userColumn) return $this->failValidationError();

            $userCustomColumnModel->save($input);
            
            if(false){
                $actionLogModel = new ActionLogModel();
                $actionLogModel->saveLog([
                    'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                    'user_id' => $this->user['id'],
                    'action' => 'Super Admin - User Custom Column Update',
                    'url' => !empty($input['url'])? $input['url']: null,
                    'ip' => !empty($input['ip'])? $input['ip']: null,
                ]);
            }

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'แก้ไขข้อมูลสำเร็จ' ],
                'data' => $input,
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
    public function moduleCreate(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            unset($input['id']);

            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'sadminModuleCreate')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }

            $moduleModel = new ModuleModel();
            $moduleModel->save($input);
            
            $actionLogModel = new ActionLogModel();
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                'user_id' => $this->user['id'],
                'action' => 'Super Admin - Module Create',
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
    public function moduleUpdate(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            unset($input['code']);

            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'sadminModuleUpdate')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }

            $moduleModel = new ModuleModel();
            $module = $moduleModel->find($input['id']);
            if(!$module) return $this->failValidationError();

            $moduleModel->save($input);
            
            $actionLogModel = new ActionLogModel();
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                'user_id' => $this->user['id'],
                'action' => 'Super Admin - Module Update',
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
    public function moduleDelete(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'sadminModuleDelete')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            if($input['id']<2) return $this->failValidationError();

            $moduleModel = new ModuleModel();
            $module = $moduleModel->find($input['id']);
            if(!$module) return $this->failValidationError();
            
            $moduleModel->delete($input['id']);
            
            $actionLogModel = new ActionLogModel();
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                'user_id' => $this->user['id'],
                'action' => 'Super Admin - Module Delete',
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
    public function rolePermissionsUpdate(){
        if($this->request->getMethod()=='post'){
            $input = stdClassToArray($this->request->getJSON());
            unset($input['id']);

            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'sadminRolePermissionsUpdate')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }

            $role = $this->userRoleModel->find($input['role_id']);
            if(!$role) return $this->failValidationError();

            $moduleModel = new ModuleModel();
            $module = $moduleModel->find($input['module_id']);
            if(!$module) return $this->failValidationError();

            $pmoduleModel = new ModulePermissionModel();
            $pmodule = $pmoduleModel->where([
                'module_id' => $input['module_id'], 'role_id' => $input['role_id']
            ])->first();
            if($pmodule) $input['id'] = $pmodule['id'];

            $pmoduleModel->save($input);
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'แก้ไขข้อมูลสำเร็จ' ],
                'data' => $input,
            ]);
        }
        return $this->failValidationError();
    }


    public function userIntegrationIDs(){
        if($this->request->getMethod()=='get'){
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ดูข้อมูลสำเร็จ' ],
                'data' => $this->userModel->integrationIDs(),
            ]);
        }
        return $this->failValidationError();
    }

}
