<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Models\UserModel;

use App\Models\ExternalAppModel;
use App\Models\ActionLogModel;
use App\Models\TrafficLogModel;

class AuthController extends ResourceController{
    protected $format = 'json';

    public function __construct(){
        helper(['input', 'jwt']);
        $request = \Config\Services::request();
        
        $input = stdClassToArray($request->getJSON());
        if($request->getMethod()!='get'){
            if(empty($input['app_id']) || $input['app_id']!=getenv('app.id')){
                echo '404'; exit;
            }
        }
    }


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
            $user = $userModel->authUserByUsernameOrEmail($input['username'], $input['password']);
            if($user['status'] == 0){
                return $this->respond([
                    'status' => 400,
                    'messages' => [ 'username' => 'บัญชีผู้ใช้ของคุณยังไม่ได้เปิดใช้งาน' ]
                ]);
            }else if($user['status'] == -1){
                return $this->respond([
                    'status' => 400,
                    'messages' => [ 'username' => 'บัญชีผู้ใช้ของคุณกำลังถูกลบออกจากระบบภายใน 24 ชั่วโมง' ]
                ]);
            }else if(!empty($input['ip'])){
                $userModel->update($user['id'], [ 'last_ip' => $input['ip'] ]);
            }

            $actionLogModel = new ActionLogModel();
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                'user_id' => $user['id'],
                'action' => 'Sign In',
                'ip' => !empty($input['ip'])? $input['ip']: null,
                'url' => !empty($input['url'])? $input['url']: null,
            ]);

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
            $insertedID = $userModel->getInsertID();

            $actionLogModel = new ActionLogModel();
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                'user_id' => $insertedID,
                'action' => 'Sign Up',
                'ip' => !empty($input['ip'])? $input['ip']: null,
                'url' => !empty($input['url'])? $input['url']: null,
            ]);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'คุณได้สมัครสมาชิกสำเร็จแล้ว' ],
                'data' => [ 'id' => $insertedID ]
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
            
            $actionLogModel = new ActionLogModel();
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                'user_id' => $data['user_id'],
                'action' => 'Forget Password',
                'ip' => !empty($input['ip'])? $input['ip']: null,
                'url' => !empty($input['url'])? $input['url']: null,
            ]);

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

            $actionLogModel = new ActionLogModel();
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                'user_id' => $user['id'],
                'action' => 'Reset Password',
                'ip' => !empty($input['ip'])? $input['ip']: null,
                'url' => !empty($input['url'])? $input['url']: null,
            ]);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'คุณตั้งรหัสผ่านใหม่ได้สำเร็จแล้ว' ],
                'data' => $user,
            ]);
        }
        return $this->failValidationError();
    }


    public function trafficCreate(){
        if($this->request->getMethod()=='post'){
            helper(['input']);
            $input = stdClassToArray($this->request->getJSON());

            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'trafficCreate')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }
            
            $trafficLogModel = new TrafficLogModel();
            $trafficLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                'ip' => $input['ip'],
                'url' => $input['url'],
            ]);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => 'เพิ่มการเข้าชมสำเร็จแล้ว' ],
                'data' => true,
            ]);
        }
        return $this->failValidationError();
    }


    public function signinWithFacebook(){
        if($this->request->getMethod()=='post'){
            helper(['input', 'jwt', 'api']);
            $input = stdClassToArray($this->request->getJSON());

            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'signinWithFacebook')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }

            $facebookURL = "https://graph.facebook.com/".$input['facebook_id']."?access_token=".$input['access_token'];
            $facebookResult = callAPI('GET', $facebookURL);
            if(!$facebookResult || !empty($facebookResult['error']) || empty($facebookResult['id']) 
            || ($facebookResult['id']!=$input['facebook_id'])){
                return $this->respond([
                    'status' => 400,
                    'messages' => $facebookResult,
                ]);
            }

            $userModel = new UserModel();
            $actionLogModel = new ActionLogModel();

            $user = $userModel->authUserByFacebookId($input['email'], $input['facebook_id']);
            $action = 'Sign In with Facebook';
            $message = 'คุณได้เข้าสู่ระบบด้วย Facebook Account สำเร็จแล้ว';
            if(!$user){
                $action = 'Sign Up with Facebook';
                $message = 'คุณสมัครสมาชิกด้วย Facebook Account สำเร็จแล้ว';
                $insertData = [
                    'facebook_id' => $input['facebook_id'],
                    'role_id' => $userModel->getDefaultRoleId(),
                    'firstname' => $input['firstname'],
                    'lastname' => $input['lastname'],
                    'email' => empty($input['email'])? null: $input['email'],
                    'username' => 'User'.$userModel->getNewestUserId(),
                    'password' => randomAlphanum(12),
                    'is_password_set' => 0,
                    'last_ip' => !empty($input['ip'])? $input['ip']: null,
                ];
                if(!empty($input['profile'])){
                    $insertData['profile'] = $input['profile'];
                }
                $userModel->insert($insertData);
                $user = $userModel->authUserByFacebookId($input['email'], $input['facebook_id']);
            }else{
                if($user['status'] == 0){
                    return $this->respond([
                        'status' => 400,
                        'messages' => [ 'username' => 'บัญชีผู้ใช้ของคุณยังไม่ได้เปิดใช้งาน' ]
                    ]);
                }else if($user['status'] == -1){
                    return $this->respond([
                        'status' => 400,
                        'messages' => [ 'username' => 'บัญชีผู้ใช้ของคุณกำลังถูกลบออกจากระบบภายใน 24 ชั่วโมง' ]
                    ]);
                }

                $updateData = [
                    'facebook_id' => $input['facebook_id'],
                    'last_ip' => !empty($input['ip'])? $input['ip']: null,
                ];
                if(empty($user['profile']) && !empty($input['profile'])){
                    $updateData['profile'] = $input['profile'];
                }
                $userModel->update($user['id'], $updateData);
            }
            
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                'user_id' => $user['id'],
                'action' => $action,
                'ip' => !empty($input['ip'])? $input['ip']: null,
                'url' => !empty($input['url'])? $input['url']: null,
            ]);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => $message ],
                'jwt' => jwtGenerateUserToken($user),
            ]);
        } 
        return $this->failValidationError();
    }
    public function signinWithGoogle(){
        if($this->request->getMethod()=='post'){
            helper(['input', 'jwt', 'api']);
            $input = stdClassToArray($this->request->getJSON());

            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'signinWithGoogle')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }

            $googleURL = "https://oauth2.googleapis.com/tokeninfo?id_token=".$input['id_token'];
            $googleResult = callAPI('GET', $googleURL);
            if(!$googleResult || !empty($googleResult['error']) || empty($googleResult['sub']) 
            || ($googleResult['sub']!=$input['google_id'])){
                return $this->respond([
                    'status' => 400,
                    'messages' => $googleResult,
                ]);
            }

            $userModel = new UserModel();
            $actionLogModel = new ActionLogModel();

            $user = $userModel->authUserByGoogleId($input['email'], $input['google_id']);
            $action = 'Sign In with Google';
            $message = 'คุณได้เข้าสู่ระบบด้วย Google Account สำเร็จแล้ว';
            if(!$user){
                $action = 'Sign Up with Google';
                $message = 'คุณสมัครสมาชิกด้วย Google Account สำเร็จแล้ว';
                $insertData = [
                    'google_id' => $input['google_id'],
                    'role_id' => $userModel->getDefaultRoleId(),
                    'firstname' => $input['firstname'],
                    'lastname' => $input['lastname'],
                    'email' => $input['email'],
                    'username' => 'User'.$userModel->getNewestUserId(),
                    'password' => randomAlphanum(12),
                    'is_password_set' => 0,
                    'last_ip' => !empty($input['ip'])? $input['ip']: null,
                ];
                if(!empty($input['profile'])){
                    $insertData['profile'] = $input['profile'];
                }
                $userModel->insert($insertData);
                $user = $userModel->authUserByGoogleId($input['email'], $input['google_id']);
            }else{
                if($user['status'] == 0){
                    return $this->respond([
                        'status' => 400,
                        'messages' => [ 'username' => 'บัญชีผู้ใช้ของคุณยังไม่ได้เปิดใช้งาน' ]
                    ]);
                }else if($user['status'] == -1){
                    return $this->respond([
                        'status' => 400,
                        'messages' => [ 'username' => 'บัญชีผู้ใช้ของคุณกำลังถูกลบออกจากระบบภายใน 24 ชั่วโมง' ]
                    ]);
                }

                $updateData = [
                    'google_id' => $input['google_id'],
                    'last_ip' => !empty($input['ip'])? $input['ip']: null,
                ];
                if(empty($user['profile']) && !empty($input['profile'])){
                    $updateData['profile'] = $input['profile'];
                }
                $userModel->update($user['id'], $updateData);
            }
            
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                'user_id' => $user['id'],
                'action' => $action,
                'ip' => !empty($input['ip'])? $input['ip']: null,
                'url' => !empty($input['url'])? $input['url']: null,
            ]);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => $message ],
                'jwt' => jwtGenerateUserToken($user),
            ]);
        } 
        return $this->failValidationError();
    }
    public function signinWithLIFF(){
        if($this->request->getMethod()=='post'){
            helper(['input', 'jwt', 'api']);
            $input = stdClassToArray($this->request->getJSON());

            $validation = \Config\Services::validation();
            if(!$validation->run($input, 'signinWithLIFF')){
                return $this->respond([
                    'status' => 400,
                    'messages' => $validation->getErrors()
                ]);
            }

            $userModel = new UserModel();
            $actionLogModel = new ActionLogModel();

            $user = $userModel->authUserByLIFFId($input['liff_id']);
            $action = 'Sign In with LIFF';
            $message = 'คุณได้เข้าสู่ระบบด้วย LIFF Account สำเร็จแล้ว';
            if(!$user){
                $action = 'Sign Up with LIFF';
                $message = 'คุณสมัครสมาชิกด้วย LIFF Account สำเร็จแล้ว';
                $newId = $userModel->getNewestUserId();
                $insertData = [
                    'liff_id' => $input['liff_id'],
                    'role_id' => $userModel->getDefaultRoleId(),
                    'firstname' => $input['firstname'],
                    'lastname' => $input['lastname'],
                    'email' => 'liff-'.$newId.'@liff.com',
                    'username' => 'User'.$newId,
                    'password' => randomAlphanum(12),
                    'is_password_set' => 0,
                    'last_ip' => !empty($input['ip'])? $input['ip']: null,
                ];
                if(!empty($input['profile'])){
                    $insertData['profile'] = $input['profile'];
                }
                $userModel->insert($insertData);
                $user = $userModel->authUserByLIFFId($input['liff_id']);
            }else{
                if($user['status'] == 0){
                    return $this->respond([
                        'status' => 400,
                        'messages' => [ 'username' => 'บัญชีผู้ใช้ของคุณยังไม่ได้เปิดใช้งาน' ]
                    ]);
                }else if($user['status'] == -1){
                    return $this->respond([
                        'status' => 400,
                        'messages' => [ 'username' => 'บัญชีผู้ใช้ของคุณกำลังถูกลบออกจากระบบภายใน 24 ชั่วโมง' ]
                    ]);
                }
                
                $updateData = [
                    'liff_id' => $input['liff_id'],
                    'last_ip' => !empty($input['ip'])? $input['ip']: null,
                ];
                if(empty($user['profile']) && !empty($input['profile'])){
                    $updateData['profile'] = $input['profile'];
                }
                $userModel->update($user['id'], $updateData);
            }
            
            $actionLogModel->saveLog([
                'external_app_id' => !empty($input['external_app_id'])? $input['external_app_id']: null,
                'user_id' => $user['id'],
                'action' => $action,
                'ip' => !empty($input['ip'])? $input['ip']: null,
                'url' => !empty($input['url'])? $input['url']: null,
            ]);

            return $this->respond([
                'status' => 200,
                'messages' => [ 'success' => $message ],
                'jwt' => jwtGenerateUserToken($user),
            ]);
        } 
        return $this->failValidationError();
    }
    
}
