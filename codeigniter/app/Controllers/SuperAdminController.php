<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserRoleModel;

class SuperAdminController extends BaseController {

    private $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }


    public function users(){
        helper(['security']);
        $data = $this->commonData();
        $data['bodyClass'] = 'app';
        $data['pageActive'] = 'Users';
        $data['breadcrumb'][] = [ 'url' => getenv('app.title').'admin/users', 'display' => 'บัญชีผู้ใช้' ];

        $data['tableObject'] = $this->userModel->getTableObject(
            $page = empty($_GET['page'])? 1: (int) $_GET['page'],
            $pp = empty($_GET['pp'])? 10: (int) $_GET['pp'],
            $keyword = empty($_GET['keyword'])? '': $_GET['keyword'],
        );
        
        echo view('admins/templates/header', $data);
        echo view('admins/pages/users');
        echo view('admins/templates/footer');
    }
    public function userRead($string=''){
        if(empty($string)){
            return redirect()->to(getenv('app.baseURL').'admin/users');
        }
        
        helper(['security']);
        $data = $this->commonData();
        $data['bodyClass'] = 'app';
        $data['pageActive'] = 'Users';
        $data['breadcrumb'][] = [ 'url' => getenv('app.title').'admin/users', 'display' => 'บัญชีผู้ใช้' ];
        $data['breadcrumb'][] = [ 'url' => '#', 'display' => 'ดูข้อมูลผู้ใช้' ];

        $data['target'] = $this->userModel->getUserById(ssDecrypt($string));
        if(!$data['target']){
            return redirect()->to(getenv('app.baseURL').'admin/users');
        }
        
        echo view('admins/templates/header', $data);
        echo view('admins/pages/user-read');
        echo view('admins/templates/footer');
    }


    public function userRoles(){
        helper(['security']);
        $data = $this->commonData();
        $data['bodyClass'] = 'app';
        $data['pageActive'] = 'User Roles';
        $data['breadcrumb'][] = [ 'url' => getenv('app.title').'admin/user-roles', 'display' => 'ตำแหน่งผู้ใช้' ];

        $userRoleModel = new UserRoleModel();
        $data['tableObject'] = $userRoleModel->getTableObject(
            $page = empty($_GET['page'])? 1: (int) $_GET['page'],
            $pp = empty($_GET['pp'])? 10: (int) $_GET['pp'],
            $keyword = empty($_GET['keyword'])? '': $_GET['keyword'],
        );
        
        echo view('admins/templates/header', $data);
        echo view('admins/pages/user-roles');
        echo view('admins/templates/footer');
    }
    public function userRole($process, $string=''){
        if(empty($process) || !in_array($process, ['create', 'read', 'update', 'delete'])){
            return redirect()->to(getenv('app.baseURL').'admin/user-roles');
        }else if($process!='create' && empty($string)){
            return redirect()->to(getenv('app.baseURL').'admin/user-roles');
        }
        
        helper(['form', 'security', 'input', 'cookie']);
        $data = $this->commonData();
        $data['bodyClass'] = 'app';
        $data['pageActive'] = 'User Roles';
        $data['process'] = $process;
        $data['breadcrumb'][] = [ 'url' => getenv('app.title').'admin/user-roles', 'display' => 'ตำแหน่งผู้ใช้' ];
        if($process=='create') $data['breadcrumb'][] = [ 'url' => '#', 'display' => 'สร้างตำแหน่งผู้ใช้' ];
        else if($process=='read') $data['breadcrumb'][] = [ 'url' => '#', 'display' => 'ดูตำแหน่งผู้ใช้' ];
        else if($process=='update') $data['breadcrumb'][] = [ 'url' => '#', 'display' => 'แก้ไขตำแหน่งผู้ใช้' ];
        else $data['breadcrumb'][] = [ 'url' => '#', 'display' => 'ลบตำแหน่งผู้ใช้' ];

        $userRoleModel = new UserRoleModel();
        if($process!='create'){
            $data['target'] = $userRoleModel->getUserRoleById(ssDecrypt($string, 'User Role'));
            if(!$data['target']){
                return redirect()->to(getenv('app.baseURL').'admin/user-roles');
            }else if($process!='read' && $data['target']['id']<=2){
                return redirect()->to(getenv('app.baseURL').'admin/user-roles');
            }
        }
        
        if($this->request->getMethod()=='post' && empty($this->request->getVar('killbot')) 
        && $this->request->getVar('process') && $this->request->getVar(getenv('app.CSRFTokenName'))){
            $rules = [
                'name' => [
                    'rules' => 'required|max_length[128]|is_unique[user_roles.name,id,'.$this->request->getPost('id').']',
                    'errors' => [
                        'required' => 'ใส่ชื่อตำเเหน่ง',
                        'max_length' => 'ชื่อตำเเหน่งสูงสุด 128 ตัวอักษร',
                        'is_unique' => 'ชื่อตำเเหน่งซ้ำในระบบ',
                    ]
                ],
                'rank' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'ใส่ลำดับ',
                    ]
                ],
            ];

            if($this->request->getVar('process')=='create'){
                if(!$this->validate($rules)){
                    $data['validation'] = $this->validator;
                }else{
                    $userRoleModel->insert([
                        'name' => $this->request->getPost('name'),
                        'is_admin' => $this->request->getPost('is_admin'),
                        'is_super_admin' => $this->request->getPost('is_super_admin'),
                        'is_default' => $this->request->getPost('is_default'),
                        'rank' => $this->request->getPost('rank'),
                        'status' => $this->request->getPost('status'),
                    ]);
                    session()->set([
                        getenv('app.sessionCookieName').'_FLASH' => 'success',
                        getenv('app.sessionCookieName').'_FLASH_MSG' => 'คุณได้ทำการเพิ่มตำแหน่งผู้ใช้เรียบร้อยแล้ว',
                    ]);
                    return redirect()->to(getenv('app.baseURL').'admin/user-roles');
                }
            }else if($this->request->getVar('process')=='update'){
                if(!$this->validate($rules)){
                    $data['validation'] = $this->validator;
                }else{
                    $userRoleModel->update($this->request->getPost('id'), [
                        'name' => $this->request->getPost('name'),
                        'is_admin' => $this->request->getPost('is_admin'),
                        'is_super_admin' => $this->request->getPost('is_super_admin'),
                        'is_default' => $this->request->getPost('is_default'),
                        'rank' => $this->request->getPost('rank'),
                        'status' => $this->request->getPost('status'),
                    ]);
                    session()->set([
                        getenv('app.sessionCookieName').'_FLASH' => 'success',
                        getenv('app.sessionCookieName').'_FLASH_MSG' => 'คุณได้ทำการแก้ไขตำแหน่งผู้ใช้เรียบร้อยแล้ว',
                    ]);
                }
            }else if($this->request->getVar('process')=='delete'){
                $userRoleModel->delete([ 'id' => $this->request->getVar('id') ]);
                session()->set([
                    getenv('app.sessionCookieName').'_FLASH' => 'danger',
                    getenv('app.sessionCookieName').'_FLASH_MSG' => 'คุณได้ทำการลบตำแหน่งผู้ใช้เรียบร้อยแล้ว',
                ]);
                return redirect()->to(getenv('app.baseURL').'admin/user-roles');
            }

        }

        echo view('admins/templates/header', $data);
        echo view('admins/pages/user-role-process');
        echo view('admins/templates/footer');
    }


    public function accounts(){
        $data = $this->commonData();
        $data['bodyClass'] = 'app';
        $data['pageActive'] = 'Accounts';
        $data['breadcrumb'][] = [ 'url' => getenv('app.title').'admin/accounts', 'display' => 'บัญชีผู้ใช้ย่อย' ];
        
        echo view('admins/templates/header', $data);
        echo view('admins/pages/accounts');
        echo view('admins/templates/footer');
    }


    private function commonData(){
        return [
            'appTitle' => getenv('app.title'),
            'pageName' => 'Admin Portal',
            'appUrl' => getenv('app.baseURL'),
            'userModel' => $this->userModel,
            'breadcrumb' => [
                [ 'url' => getenv('app.title'), 'display' => 'ผู้ดูแลระบบ' ],
            ]
        ];
    }

}
