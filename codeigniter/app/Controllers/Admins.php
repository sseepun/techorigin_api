<?php namespace App\Controllers;

use App\Models\UserModel;

class Admins extends BaseController{
	private $userModel;

    public function __construct(){
		$this->userModel = new UserModel();
	}
	
	
	public function index(){
		$data = $this->commonData();
		$data['pageActive'] = 'Admin Panel';

		echo view('templates/header', $data);
		echo view('admins/index');
		echo view('templates/footer');
	}


	protected function commonData(){
		return [
			'userModel' => $this->userModel,
			'user' => $this->userModel->getInfo(),
			'userRole' => $this->userModel->getRole(),
		];
	}

}
