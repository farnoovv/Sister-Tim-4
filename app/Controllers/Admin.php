<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelAdmin;
use CodeIgniter\Commands\Database\CreateDatabase;

class Admin extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $validation = \Config\Services::validation();
        $aturan = [
            'email' => [
                'rules' =>'required|valid_email',
                'errors' =>[
                    'required' => 'The email field is required.',
                    'valid_email' => 'The email field must be a valid email address.',
                ]
            ],
            'password' => [
                'rules' =>'required',
                'errors' =>[
                    'required' => 'The password field is required.',
                ]
            ],
        ];
        $validation->setRules($aturan);
        if(!$validation->withRequest($this->request)->run()){
            return $this->fail($validation->getErrors());

        }

        $model = new ModelAdmin();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $model->getEmail($email);
        if($data['password'] != md5($password)){
            return $this->fail('The password is incorrect.');
        }
        
        helper('jwt');
        $response = [
            'message' => 'Authentication Success',
            'data' => $data,
            'access_token' => createJWT($email)
        ];
        return $this->respond($response);
    }
}