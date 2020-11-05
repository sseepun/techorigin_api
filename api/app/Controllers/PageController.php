<?php namespace App\Controllers;

use App\Models\UserModel;

class PageController extends BaseController {

    private $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }


    public function index(){
        return redirect()->to(getenv('app.baseURL').'signin');
    }

}
