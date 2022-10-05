<?php

namespace App\Models;
use CodeIgniter\Model;

class ModelPekerjaan extends Model
{
    protected $table = "tweb_penduduk_pekerjaan";
    protected $primaryKey = "id";
    protected $allowedFields = ['nama'];

    protected $validationRules = [
        'nama' => 'required'
    ];

    protected $validationMessages = [
        'nama'=>[
            'required' => 'Silakan masukkan nama pekerjaan'
        ]
    ];
}