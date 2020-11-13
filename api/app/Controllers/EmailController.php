<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Models\UserModel;

class EmailController extends ResourceController{
    protected $format = 'json';

    public function __construct(){ }


}
