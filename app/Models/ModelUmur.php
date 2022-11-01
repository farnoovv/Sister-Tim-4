<?php

namespace App\Models;
use CodeIgniter\Model;

class ModelPekerjaan extends Model
{
    protected $table = "tweb_penduduk_umur";
    protected $primaryKey = "id";
    protected $allowedFields = ['nama','dari','sampai','status'];

    protected $validationRules = [
        'nama' => 'required',
        'dari' => 'required',
        'sampai' => 'required',
        'status' => 'required'
    ];

    protected $validationMessages = [
        'nama'=>[
            'required' => 'Silakan masukkan umur'
        ]
    ];
}