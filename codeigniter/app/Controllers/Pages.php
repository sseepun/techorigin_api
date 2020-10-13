<?php namespace App\Controllers;

use App\Models\UserModel;

class Pages extends BaseController{
    private $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }


	public function index(){
        if($this->userModel->isSignedIn()){
            return redirect()->to('admins');
        }

        helper(['form']);

        $data = $this->commonData();
        $data['bodyClass'] = 'login';

        if($this->request->getMethod()=='post'){
            $rules = [
                'username' => 'required|min_length[6]|max_length[256]',
                'password' => 'required|min_length[6]|max_length[128]|validateUser[username, password]',
            ];
            $errors = [
                'password' => [
                    'validateUser' => 'Username, Email or Password don\'t match'
                ]
            ];

            if(!$this->validate($rules, $errors)){
                $data['validation'] = $this->validator;
            }else {
                $user = $this->userModel->authUserByUsernameOrEmain(
                    $this->request->getVar('username'), $this->request->getVar('password')
                );
                $this->userModel->setUserSession($user);
                return redirect()->to('portals');
            }
        }

        echo view('templates/header', $data);
        echo view('pages/signin');
        echo view('templates/footer');
    }

    public function signup(){
        if($this->userModel->isSignedIn()){
            return redirect()->to('portals');
        }

        helper(['form']);
        $data = [];

        if($this->request->getMethod() == 'post'){
            // form validator
            $rules = [
                'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]|max_length[50]',
                'password_confirm' => 'matches[password]'
            ];

            if(! $this->validate($rules)){
                $data['validation'] = $this->validator;
            }else {
                // Store information in database
                $model = new UserModel();
                $newData = [
                    'firstname' => $this->request->getPost('firstname'),
                    'lastname' => $this->request->getPost('lastname'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password')
                ];
                $model->save($newData);

                $session = session();
                $session->setFlashData('success', 'Successful Registration');

                return redirect()->to('/');
            }
        }

        echo view('templates/header', $data);
        echo view('pages/signup');
        echo view('templates/footer');
    }

    public function signout(){
        $this->userModel->signout();
        return redirect()->to('/');
    }

    private function commonData(){
        return [
            'appTitle' => getenv('app.title'),
        ];
    }

}
