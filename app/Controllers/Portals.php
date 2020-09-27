<?php namespace App\Controllers;

use App\Models\UserModel;

class Portals extends BaseController{
	private $userModel;

    public function __construct(){
		$this->userModel = new UserModel();
	}
	
	
	public function index(){
		$data = $this->commonData();
		$data['pageActive'] = 'Slip Report';

		echo view('templates/header', $data);
		echo view('portals/index');
		echo view('templates/footer');
		echo view('modals/upload-modal');
	}

	public function monthlyRecords($year, $month){
		echo $year.' - '.$month; exit;

		$data = $this->commonData();
		$data['pageActive'] = 'Slip Report';

		echo view('templates/header', $data);
		echo view('portals/index');
		echo view('templates/footer');
		echo view('modals/upload-modal');
	}

	
	public function report(){
		$data = $this->commonData();
		$data['pageActive'] = 'Report';
		
		echo view('templates/header', $data);
		echo view('portals/report');
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
