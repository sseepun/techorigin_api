<?php namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController {

    private $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }


    public function index(){
        return redirect()->to(getenv('app.baseURL').'signin');
    }


	public function signin(){
        helper(['form']);
        $data = $this->commonData();
        $data['bodyClass'] = 'login';

        if($this->request->getMethod()=='post' && empty($this->request->getVar('killbot')) 
        && $this->request->getVar(getenv('app.CSRFTokenName'))){
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
                $user = $this->userModel->authUserByUsernameOrEmail(
                    $this->request->getVar('username'), $this->request->getVar('password')
                );
                if($user){
                    $this->userModel->setUserSession($user, $this->request->getVar('remember'));
                    return redirect()->to(getenv('app.baseURL').'signin');
                }else{
                    $data['validation'] = $this->validator; 
                }
            }
        }

        echo view('templates/header', $data);
        echo view('auths/signin');
        echo view('templates/footer');
    }

    public function signup(){
        helper(['form']);
        $data = $this->commonData();
        $data['bodyClass'] = 'login';

        if($this->request->getMethod()=='post' && empty($this->request->getVar('killbot')) 
        && $this->request->getVar(getenv('app.CSRFTokenName'))){
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
                $this->userModel->insert([
                    'role_id' => $this->userModel->getDefaultRoleId(),
                    'firstname' => $this->request->getPost('firstname'),
                    'lastname' => $this->request->getPost('lastname'),
                    'email' => $this->request->getPost('email'),
                    'username' => $this->request->getPost('username'),
                    'password' => $this->request->getPost('password'),
                    'last_ip' => $this->request->getIPAddress(),
                ]);

                
                $emailTemplate = view('emails/signup');
                $emailTemplate = str_replace('{appTitle}', $data['appTitle'], $emailTemplate);
                $emailTemplate = str_replace('{appLogo}', $data['appUrl'].'public/logo.png', $emailTemplate);
                $emailTemplate = str_replace('{appUrl}', $data['appUrl'], $emailTemplate);
                
                $email = \Config\Services::email();
                $email->setTo($this->request->getPost('email'));
                $email->setFrom('sarun.seepun@gmail.com', getenv('app.title').' Team');
                $email->setSubject('ยืนยันการสมัครสมาชิกในระบบ '.getenv('app.title'));
                $email->setMessage($emailTemplate);
                $email->send();


                echo view('templates/header', $data);
                echo view('auths/signup-success');
                echo view('templates/footer');
                return true;
            }
        }

        echo view('templates/header', $data);
        echo view('auths/signup');
        echo view('templates/footer');
    }

    public function forgetPassword(){
        helper(['form']);
        $data = $this->commonData();
        $data['bodyClass'] = 'login';

        if($this->request->getMethod()=='post' && empty($this->request->getVar('killbot')) 
        && $this->request->getVar(getenv('app.CSRFTokenName'))){
            $rules = [
                'username' => [
                    'rules' => 'required|max_length[64]|validateForgetPassword[username]',
                    'errors' => [
                        'required' => 'ใส่ชื่อผู้ใช้หรืออีเมล',
                        'max_length' => 'ชื่อผู้ใช้สูงสุด 64 ตัวอักษร',
                        'validateForgetPassword' => 'ไม่พบผู้ใช้ในระบบ',
                    ]
                ],
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
                $result = $this->userModel->generateUserTemp(
                    $action = 'RESET PASSWORD', $username = $this->request->getVar('username')
                );


                $emailTemplate = view('emails/reset-password');
                $emailTemplate = str_replace('{appTitle}', $data['appTitle'], $emailTemplate);
                $emailTemplate = str_replace('{appLogo}', $data['appUrl'].'public/logo.png', $emailTemplate);
                $emailTemplate = str_replace('{appUrl}', $data['appUrl'], $emailTemplate);
                $emailTemplate = str_replace('{salt}', $result['salt'], $emailTemplate);
                
                $email = \Config\Services::email();
                $email->setTo($result['email']);
                $email->setFrom('sarun.seepun@gmail.com', getenv('app.title').' Team');
                $email->setSubject('ตั้งรหัสผ่านใหม่ในระบบ '.getenv('app.title'));
                $email->setMessage($emailTemplate);
                $email->send();


                echo view('templates/header', $data);
                echo view('auths/forget-password-success');
                echo view('templates/footer');
                return true;
            }
        }

        echo view('templates/header', $data);
        echo view('auths/forget-password');
        echo view('templates/footer');
    }

    public function resetPassword($salt=''){
        if(empty($salt)){
            return redirect()->to(getenv('app.baseURL').'forget-password');
        }

        helper(['form']);
        $data = $this->commonData();
        $data['bodyClass'] = 'login';

        $data['user_temp'] = $this->userModel->getUserTemp($action = 'RESET PASSWORD', $salt = $salt);
        if(!$data['user_temp']){
            return redirect()->to(getenv('app.baseURL').'forget-password');
        }
        
        if($this->request->getMethod()=='post' && empty($this->request->getVar('killbot')) 
        && $this->request->getVar(getenv('app.CSRFTokenName'))){
            $rules = [
                'password_new' => [
                    'rules' => 'required|min_length[6]|max_length[64]',
                    'errors' => [
                        'required' => 'ใส่รหัสผ่านใหม่',
                        'min_length' => 'รหัสผ่านใหม่ขั้นต่ำ 6 ตัวอักษร',
                        'max_length' => 'รหัสผ่านใหม่สูงสุด 64 ตัวอักษร',
                    ]
                ],
                'password_confirm' => [
                    'rules' => 'required|matches[password_new]',
                    'errors' => [
                        'required' => 'ใส่ยืนยันรหัสผ่าน',
                        'matches' => 'ยืนยันรหัสผ่านไม่ตรงกับรหัสผ่านใหม่',
                    ]
                ],
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
                $user = $this->userModel->useUserTemp($action = 'RESET PASSWORD', $salt = $salt);
                $this->userModel->update($user['id'], [ 'password' => $this->request->getVar('password_new') ]);
                
                echo view('templates/header', $data);
                echo view('auths/reset-password-success');
                echo view('templates/footer');
                return true;
            }
        }

        echo view('templates/header', $data);
        echo view('auths/reset-password');
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
            'userModel' => $this->userModel,
        ];
    }

}
