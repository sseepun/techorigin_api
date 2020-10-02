<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SlipModel;

class Portals extends BaseController{
	private $userModel;

    public function __construct(){
		$this->userModel = new UserModel();
	}
	
	
	public function index(){
		$data = $this->commonData();
		$data['pageActive'] = 'Slip Report';

		$slipModel = new SlipModel();
		$data['tablePaginate'] = $slipModel->getMonthlyPaginate();

		echo view('templates/header', $data);
		echo view('portals/index');
		echo view('templates/footer');
		echo view('modals/upload-modal');
	}

	public function monthlySlips($year, $month){
		$data = $this->commonData();
		$data['pageActive'] = 'Slip Report';
		
		$slipModel = new SlipModel();
		$data['tablePaginate'] = $slipModel->getMonthlyReportPaginate($year, $month);

		echo view('templates/header', $data);
		echo view('portals/monthly-slips');
		echo view('templates/footer');
	}

	public function slipView($id){
		if(empty($id)) return redirect()->to('/portals');

		$data = $this->commonData();
		$data['pageActive'] = 'Slip Report';
		
		$slipModel = new SlipModel();
		$data['slip'] = $slipModel->find($id);
		if(empty($data['slip'])) return redirect()->to('/portals');
		
		$slipModel
			->set('view_count', $data['slip']['view_count'] + 1)
			->where('id', $id)
			->update();

		echo view('templates/header', $data);
		echo view('portals/slip-view');
		echo view('templates/footer');
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
