<?php namespace App\Controllers;

use App\Models\UserModel;

class Dashboard extends BaseController
{
	public function index()
	{
		$model = new UserModel();
		$data = [];
		$userRole = $model->getRoleById(session()->get('id'));
		$data['user_role'] = $userRole;
		echo view('templates/header', $data);
		echo view('users/dashboard');
	}

	//--------------------------------------------------------------------

}
