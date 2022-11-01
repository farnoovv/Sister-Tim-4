<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelPekerjaan;

class Pekerjaan extends BaseController
{
    use ResponseTrait;
    function __construct(){
        $this->model = new ModelUmur();
    }
    public function index()
    {
        $data = $this->model->orderBy('nama', 'asc')->findAll();
        return $this->respond($data,200);
    }

    public function show($id = null){
        $data = $this->model->where('id', $id)->findAll();
        if($data){
            return $this->respond($data,200);
        }else{
            return $this-> failNotFound("Data dengan id $id tidak ditemukan");
        }
    }

    public function create(){
        // $data = [
        //     'nama'=>$this->request->getVar('nama'),
        // ];
        $data = $this->request->getPost();
        //$this->model->save($data);
        if(!$this->model->save($data)){
            return $this->fail($this->model->errors());
        }

        $response = [
            'status' => 201,
            'errors' => null,
            'messages' => [
                'success' => 'Data pekerjaan berhasil masuk'
            ]
            ];
            return $this->respond($response);
    }

    public function update($id = null){
        $data = $this->request->getRawInput();
        $data['id'] = $id;

        $isExist = $this->model->where('id', $id)->findAll();
        if(!$isExist){
            return $this->failNotFound("Data dengan id $id tidak ditemukan");
        }

        if(!$this->model->save($data)){
            return $this->fail($this->model->errors());
        }

        $response = [
            'status' => 201,
            'errors' => null,
            'messages' => [
                'success' => 'Berhasil update data pekerjaan'
            ]
            ];
            return $this->respond($response);
    }
    public function delete($id = null){
        $data = $this->model->where('id', $id)->findAll();
        if($data){
            $this->model->delete($id);
            $response = [
                'status' => 201,
                'errors' => null,
                'messages' => [
                    'success' => 'Data pekerjaan berhasil dihapus'
                ]
                ];
                return $this->respondDeleted($response);
        }else{
            return $this->failNotFound("Data dengan id $id tidak ditemukan");
        }
    }

}
