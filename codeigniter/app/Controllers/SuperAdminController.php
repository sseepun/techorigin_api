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

        $data['targetUser'] = $this->userModel->getUserById(ssDecrypt($string));
        if(!$data['targetUser']){
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
    public function userRoleRead($string=''){
        if(empty($string)){
            return redirect()->to(getenv('app.baseURL').'admin/user-roles');
        }
        
        helper(['security']);
        $data = $this->commonData();
        $data['bodyClass'] = 'app';
        $data['pageActive'] = 'User Roles';
        $data['breadcrumb'][] = [ 'url' => getenv('app.title').'admin/user-roles', 'display' => 'ตำแหน่งผู้ใช้' ];
        $data['breadcrumb'][] = [ 'url' => '#', 'display' => 'ดูข้อมูลตำแหน่งผู้ใช้' ];

        $userRoleModel = new UserRoleModel();
        $data['targetUserRole'] = $userRoleModel->getUserRoleById(ssDecrypt($string, 'User Role'));
        if(!$data['targetUserRole']){
            return redirect()->to(getenv('app.baseURL').'admin/user-roles');
        }

        print_r($data['targetUserRole']); exit;
        
        echo view('admins/templates/header', $data);
        echo view('admins/pages/user-role-read');
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
