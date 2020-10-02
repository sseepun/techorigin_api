<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SlipImportModel;

class Apis extends BaseController{
	private $userModel;

    public function __construct(){
		$this->userModel = new UserModel();
	}
	
	public function ajaxUploadTextFiles(){
		helper(['form', 'url', 'date']);
 
        $response = [
            'success' => false,
            'data' => [],
            'msg' => 'Text file has been uploaded.'
		];
		
		$file = $_FILES['txt_file'];
		if($this->request->getMethod()=='post' && $file){
			$name = $file['name'];
            $temp = $file['tmp_name'];
			$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
			if(in_array($ext, ['txt'])){
				$newName = now().'-'.str_replace(' ', '', str_replace('0.', '', microtime())).'.'.$ext;
                if(move_uploaded_file($temp, WRITEPATH.'uploads/slips/'.$newName)){
					$response = [
						'success' => true,
						'data' => [
							'file_name' => $newName,
							'ext' => $ext
						],
						'msg' => 'Text file has been uploaded successfully.'
					];

				}
			}
		}
 
       	return $this->response->setJSON($response);
	}
	public function uploadSlips(){
		if($this->request->getMethod()=='post'){
			$slipImportModel = new SlipImportModel();
			$slipImportModel->save([
				'user_id' => $this->userModel->getUserId(),
				'name'  => $this->request->getVar('name'),
				'files'  => implode(',', $this->request->getVar('file_names')),
			]);
			$slipImportId = $slipImportModel->insertID();

			foreach($this->request->getVar('file_names') as $slip){
				$slipPath = WRITEPATH.'uploads/slips/'.$slip;
				$slipImportModel->importSlip($slipImportId, $slipPath);
			}
			session()->set([
				getenv('app.sessionCookieName').'FLASH' => 'success',
				getenv('app.sessionCookieName').'FLASH_MSG' => 'Slips have been imported successfully.',
			]);
		}
		return redirect()->to('/portals');
	}


	protected function commonData(){
		return [
			'userModel' => $this->userModel,
			'user' => $this->userModel->getInfo(),
			'userRole' => $this->userModel->getRole(),
		];
	}

}
