<?php namespace App\Controllers;

use App\Models\UserModel;

class Pages extends BaseController{
    private $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }

    public function index(){
        return redirect()->to('signin');
    }


	public function signin(){
        if($this->userModel->isSignedIn()){
            return redirect()->to('admins');
        }

        helper(['form']);

        $data = $this->commonData();
        $data['bodyClass'] = 'login';

        if($this->request->getMethod()=='post' && empty($this->request->getVar('killbot'))){
            $rules = [
                'username' => [
                    'rules' => 'required|max_length[64]',
                    'errors' => [
                        'required' => 'ใส่ชื่อผู้ใช้หรืออีเมล',
                        'max_length' => 'ชื่อผู้ใช้สูงสุด 64 ตัวอักษร',
                    ]
                ],
                'password' => [
                    'rules' => 'required|max_length[64]|validateUser[username, password]',
                    'errors' => [
                        'required' => 'ใส่รหัสผ่าน',
                        'max_length' => 'รหัสผ่านสูงสุด 64 ตัวอักษร',
                        'validateUser' => 'ไม่พบผู้ใช้ในระบบ',
                    ]
                ],
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
                $user = $this->userModel->authUserByUsernameOrEmain(
                    $this->request->getVar('username'), $this->request->getVar('password')
                );
                if($user){
                    $this->userModel->setUserSession(
                        $user, $this->request->getVar('remember')
                    );
                    return redirect()->to('admins');
                }else{
                    $data['validation'] = $this->validator; 
                }
            }
        }

        echo view('templates/header', $data);
        echo view('pages/signin');
        echo view('templates/footer');
    }

    public function signup(){
        if($this->userModel->isSignedIn()){
            return redirect()->to('admins');
        }

        helper(['form']);

        $data = $this->commonData();
        $data['bodyClass'] = 'login';

        if($this->request->getMethod()=='post' && empty($this->request->getVar('killbot'))){
            $rules = [
                'password' => 'required|min_length[6]|max_length[50]',
                'password_confirm' => 'matches[password]'
            ];
            $rules = [
                'firstname' => [
                    'rules' => 'required|min_length[3]|max_length[64]',
                    'errors' => [
                        'required' => 'ใส่ชื่อจริง',
                        'min_length' => 'ชื่อจริงขั้นต่ำ 3 ตัวอักษร',
                        'max_length' => 'ชื่อจริงสูงสุด 64 ตัวอักษร',
                    ]
                ],
                'lastname' => [
                    'rules' => 'required|min_length[3]|max_length[64]',
                    'errors' => [
                        'required' => 'ใส่นามสกุล',
                        'min_length' => 'นามสกุลขั้นต่ำ 3 ตัวอักษร',
                        'max_length' => 'นามสกุลสูงสุด 64 ตัวอักษร',
                    ]
                ],
                'email' => [
                    'rules' => 'required|min_length[6]|max_length[64]|valid_email|isUniqureEmail[email]',
                    'errors' => [
                        'required' => 'ใส่อีเมล',
                        'min_length' => 'อีเมลขั้นต่ำ 6 ตัวอักษร',
                        'max_length' => 'อีเมลสูงสุด 64 ตัวอักษร',
                        'valid_email' => 'ใส่อีเมลที่ถูกต้อง',
                        'isUniqureEmail' => 'อีเมลนี้ถูกใช้งานแล้ว',
                    ]
                ],
                'username' => [
                    'rules' => 'required|min_length[6]|max_length[64]|isUniqureUsername[username]',
                    'errors' => [
                        'required' => 'ใส่ชื่อผู้ใช้',
                        'min_length' => 'ชื่อผู้ใช้ขั้นต่ำ 6 ตัวอักษร',
                        'max_length' => 'ชื่อผู้ใช้สูงสุด 64 ตัวอักษร',
                        'isUniqureUsername' => 'ชื่อผู้ใช้นี้ถูกใช้งานแล้ว',
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[6]|max_length[64]',
                    'errors' => [
                        'required' => 'ใส่รหัสผ่าน',
                        'min_length' => 'รหัสผ่านขั้นต่ำ 6 ตัวอักษร',
                        'max_length' => 'รหัสผ่านสูงสุด 64 ตัวอักษร',
                    ]
                ],
                'password_confirm' => [
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => 'ใส่ยืนยันรหัสผ่าน',
                        'matches' => 'ยืนยันรหัสผ่านไม่ตรงกับรหัสผ่าน',
                    ]
                ],
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
                $this->userModel->save([
                    'firstname' => $this->request->getPost('firstname'),
                    'lastname' => $this->request->getPost('lastname'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password')
                ]);
                $session = session();
                $session->setFlashData('success', 'สมัครสมาชิกสำเร็จแล้ว');
                return redirect()->to(getenv('app.baseURL'));
            }
        }

        echo view('templates/header', $data);
        echo view('pages/signup');
        echo view('templates/footer');
    }

    public function signout(){
        $this->userModel->signout();
        return redirect()->to(getenv('app.baseURL'));
    }

    private function commonData(){
        return [
            'appTitle' => getenv('app.title'),
            'appUrl' => getenv('app.baseURL'),
        ];
    }

}
