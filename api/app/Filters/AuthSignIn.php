<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use App\Models\UserModel;

class AuthSignIn implements FilterInterface {
    private $userModel;

    public function before(RequestInterface $request, $arguments=null){
        $this->userModel = new UserModel();
        if($this->userModel->isSignedIn()){
            if($this->userModel->isAdmin()){
                return redirect()->to(getenv('app.baseURL').'admin');
            }else{
                return redirect()->to(getenv('app.baseURL').'member');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments=null){

    }
}
