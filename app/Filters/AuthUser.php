<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use App\Models\UserModel;

class AuthUser implements FilterInterface {
    private $userModel;

    public function before(RequestInterface $request, $arguments=null){
        $this->userModel = new UserModel();
        if(!$this->userModel->isSignedIn()){
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments=null){

    }
}


?>