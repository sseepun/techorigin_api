<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use \Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Exception;

class AuthApi implements FilterInterface{
    public function before(RequestInterface $request, $arguments=null){
        $jwtSecretKey = getenv('jwt.secretKey');
        list(, $jwt) = explode(' ', $request->getHeaderLine('Authorization'));

        try{
            $decoded = JWT::decode($jwt, $jwtSecretKey, array('HS256'));

            $response = service('response');
            return $response->setStatusCode(401)->setJSON($decoded);  
        }catch(ExpiredException $e){
            $data = [
                "status" => 401,
                "error" => 401,
                "messages" => [
                    "error"  => "Token expired"
                ]
            ];
            $response = service('response');
            return $response->setStatusCode(401)->setJSON($data);             
        }catch(Exception $e){
            $data = [
                "status" => 401,
                "error" => 401,
                "messages" => [
                    "error"  => "Unauthorized"
                ]
            ];
            $response = service('response');
            return $response->setStatusCode(401)->setJSON($data);     
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments=null){

    }
}
