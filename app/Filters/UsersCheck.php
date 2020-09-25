<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;


class UsersCheck implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null){
        $uri = service('uri');

        // If segment(1) == users, then
        // If segment(2) == '', go to /
        // If not, go to segment(2)
        if($uri->getSegment(1) == 'users'){
            if($uri->getSegment(2) == ''){
                $segment = '/';
            }else {
                $segment = '/'.$uri->getSegment(2);
            }
            return redirect()->to($segment);
        }

    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null ){


    }
}

   



?>