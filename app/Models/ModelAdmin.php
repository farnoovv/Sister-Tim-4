<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class ModelAdmin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'password'];

    function getEmail($email){
        $builder = $this->table("admin");
        $data = $builder->where("email", $email)->first();
        if (!$data){
            throw new Exception("Authentication Data not found");
        }
    return  $data;
    }
}