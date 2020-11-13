<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Models\UserModel;

class AuthController extends ResourceController{
    protected $format = 'json';

    public function __construct(){ }

	public function signin(){
        if($this->request->getMethod()=='post'){
            helper(['input', 'jwt']);
            $input = stdClassToArray($this->request->getJSON());

            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'signin')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }

            $userModel = new UserModel();
            $user = $userModel->authUserByUsernameOrEmail(
                $input['username'], $input['password']
            );
            
            if(!empty($input['ip'])){
                $userModel->update($user['id'], [ 'last_ip' => $input['ip'] ]);
            }

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'คุณได้เข้าสู่ระบบสำเร็จแล้ว' ],
                'jwt' => jwtGenerateUserToken($user),
            ]);
        } 
        return $this->failValidationError();
    }

    public function signup(){
        if($this->request->getMethod()=='post'){
            helper(['input']);
            $input = stdClassToArray($this->request->getJSON());

            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'signup')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            
            $userModel = new UserModel();
            $userModel->insert([
                'role_id' => $userModel->getDefaultRoleId(),
                'firstname' => $input['firstname'],
                'lastname' => $input['lastname'],
                'email' => $input['email'],
                'username' => $input['username'],
                'password' => $input['password'],
                'last_ip' => $input['ip'],
            ]);
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'คุณได้สมัครสมาชิกสำเร็จแล้ว' ],
            ]);
        }
        return $this->failValidationError();
    }

    public function forgetPassword(){
        if($this->request->getMethod()=='post'){
            helper(['input']);
            $input = stdClassToArray($this->request->getJSON());

            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'forgetPassword')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            
            $userModel = new UserModel();
            $data = $userModel->generateUserTemp(
                $action = 'RESET PASSWORD', 
                $email = $input['email'],
                $userId = false,
                $ip = $input['ip'],
            );
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'ทำตามขั้นตอนต่อไปเพื่อตั้งรหัสผ่านใหม่' ],
                'data' => $data,
            ]);
        }
        return $this->failValidationError();
    }

    public function resetPasswordExists($salt=''){
        if($this->request->getMethod()=='get' && !empty($salt)){
            $userModel = new UserModel();
            $userTemp = $userModel->getUserTemp(
                $action = 'RESET PASSWORD', $salt = $salt
            );
            if(!$userTemp) return $this->failValidationError();

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'คุณสามารถตั้งรหัสผ่านใหม่ได้' ],
                'data' => $userTemp,
            ]);
        }
        return $this->failValidationError();
    }

    public function resetPassword(){
        if($this->request->getMethod()=='post'){
            helper(['input']);
            $input = stdClassToArray($this->request->getJSON());

            $userModel = new UserModel();
            $userTemp = $userModel->getUserTemp(
                $action = 'RESET PASSWORD', $salt = $input['salt']
            );
            if(!$userTemp) return $this->failValidationError();
            
            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'setNewPassword')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            
            $user = $userModel->useUserTemp(
                $action = 'RESET PASSWORD', $salt = $input['salt'], $ip = $input['ip']
            );
            $userModel->update($user['id'], [ 'password' => $input['password_new'] ]);
            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'คุณตั้งรหัสผ่านใหม่ได้สำเร็จแล้ว' ],
                'data' => $user,
            ]);
        }
        return $this->failValidationError();
    }

    public function signout(){
        return $this->respond([
            'status' => 200,
            'messages' => [ 'success' => 'คุณได้ออกจากระบบสำเร็จแล้ว' ],
            'jwt' => null,
        ]);
    }
    
}
