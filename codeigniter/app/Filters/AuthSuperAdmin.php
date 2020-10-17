<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use App\Models\UserModel;

class AuthSuperAdmin implements FilterInterface {
    private $userModel;

    public function before(RequestInterface $request, $arguments=null){
        $this->userModel = new UserModel();
        if(!$this->userModel->isSignedIn() || !$this->userModel->isSuperAdmin()){
            return redirect()->to(getenv('app.baseURL').'admin');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments=null){

    }
}
