<?php namespace App\Controllers;

use App\Models\UserModel;

class AdminController extends BaseController {

    private $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }


    public function index(){
        $data = $this->commonData();
        $data['bodyClass'] = 'app';
        $data['pageActive'] = 'Dashboard';
        $data['breadcrumb'][] = [ 'url' => getenv('app.title'), 'display' => 'หน้าสรุปผล' ];
        
        echo view('admins/templates/header', $data);
        echo view('admins/pages/index');
        echo view('admins/templates/footer');
    }


    public function myAccounts(){
        $data = $this->commonData();
        $data['bodyClass'] = 'app';
        $data['pageActive'] = 'My Accounts';
        $data['breadcrumb'][] = [ 'url' => getenv('app.title').'admin/my-accounts', 'display' => 'ผู้ใช้ของฉัน' ];
        
        echo view('admins/templates/header', $data);
        echo view('admins/pages/my-accounts');
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
