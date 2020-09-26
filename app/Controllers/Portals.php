<?php namespace App\Controllers;

use App\Models\UserModel;

class Portals extends BaseController{
	private $userModel;

    public function __construct(){
		$this->userModel = new UserModel();
	}
	
	
	public function index(){
		$data = $this->commonData();
		echo view('templates/header', $data);
		echo view('portals/index');
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
