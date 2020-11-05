<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use App\Models\UserModel;

class AuthAdmin implements FilterInterface {
    private $userModel;

    public function before(RequestInterface $request, $arguments=null){
        $this->userModel = new UserModel();
        if(!$this->userModel->isSignedIn() || !$this->userModel->isAdmin()){
            return redirect()->to(getenv('app.baseURL').'signin');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments=null){

    }
}
