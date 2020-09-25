<?php namespace App\Controllers;

use App\Models\UserModel;


class Users extends BaseController
{
	public function index()
	{
        helper(['form']);

        $data = [];


        if($this->request->getMethod() == 'post'){
            // form validator
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[8]|max_length[50]|validateUser[email, password]',
            ];
            $errors = [
                'password' => [
                    'validateUser' => 'Email or Password don\'t match'
                ]
            ];
            if(! $this->validate($rules, $errors)){
                $data['validation'] = $this->validator;
            }else {
                $model = new UserModel();
                // Load model and check matches email column
                $user  = $model->where('email', $this->request->getVar('email'))->first();
                $this->setUserSession($user);

                return redirect()->to('users/dashboard');

            }
        }


        // echo view('templates/header' , $data);
        echo view('users/login');
        // echo view('templates/footer');

    }
    private function setUserSession($user){
        $data = [
            'id' => $user['id'],
            'email' => $user['email'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname'],
            'isLoggedIn' => true,
        ];
        session()->set($data);

        return true;
    }
    public function register() {
        helper(['form']);

        $data = [];

        if($this->request->getMethod() == 'post'){
            // form validator
            $rules = [
                'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]|max_length[50]',
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
        echo view('users/register');
        echo view('templates/footer');

    }

    public function profile() {
        helper(['form']);

        $data = [];
        $model = new UserModel();
        if($this->request->getMethod() == 'post'){
            // form validator
            $rules = [
                'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
            ];

            if($this->request->getPost('password') != '') {
                $rules['password'] = 'required|min_length[8]|max_length[50]';
                $rules['password_confirm'] = 'matches[password]';
            }

            if(! $this->validate($rules)){
                $data['validation'] = $this->validator;
            }else {
                $newData = [
                    'id' => session()->get('id'),
                    'firstname' => $this->request->getPost('firstname'),
                    'lastname' => $this->request->getPost('lastname'),
                ];
                if($this->request->getPost('password') != ''){
                    $newData['password'] = $this->request->getPost('password');
                }
                $model->save($newData);
                session()->setFlashData('success', 'Successfully updated');

                return redirect()->to('/profile');
            }
        }

        $data['user'] = $model->where('id', session()->get('id'))->first();
        echo view('templates/header', $data);
        echo view('profile');
        echo view('templates/footer');
    }

    public function logout(){
        session()->destroy();
        return redirect()->to('/');
    }

	//--------------------------------------------------------------------

}
