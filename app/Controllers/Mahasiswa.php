<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Mahasiswa extends ResourceController
{
    protected $modelName = 'App\Models\Modelmahasiswa';
	protected $format = 'json';

	public function index(){
		$posts = $this->model->orderBy('id', "DESC")->findAll();
		return $this->respond($posts);
	}
    
    public function create(){
		helper(['form']);

		$rules = [
			'nim' => 'required|min_length[5]|is_unique[mahasiswa.nim]',
			'nama' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
		];

		if(!$this->validate($rules)){
			return $this->fail(implode('<br>', $this->validator->getErrors()));
		}else{
			$data = [
				'nim' => $this->request->getVar('nim'),
				'nama' => $this->request->getVar('nama'),
                'alamat' => $this->request->getVar('alamat'),
                'nohp' => $this->request->getVar('nohp'),
                'email' => $this->request->getVar('email'),
                'indeks' => $this->request->getVar('indeks'),
			];

			$id = $this->model->insert($data);
			$data['id'] = $id;
			return $this->respondCreated($data);
		}
	}

	public function show($id = null){
		$data = $this->model->find($id);
		return $this->respond($data);
	}

	public function update($id = null){
		helper(['form']);

		$rules = [
			'nim' => 'required|min_length[5]',
			'nama' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
		];
		if(!$this->validate($rules)){
			return $this->fail(implode('<br>', $this->validator->getErrors()));
		}else{
			$input = $this->request->getRawInput();
			$data = [
				'id' => $id,
				'nim' => $this->request->getVar('nim'),
				'nama' => $this->request->getVar('nama'),
                'alamat' => $this->request->getVar('alamat'),
                'nohp' => $this->request->getVar('nohp'),
                'email' => $this->request->getVar('email'),
                'indeks' => $this->request->getVar('indeks'),
			];
			
			$this->model->save($data);
			return $this->respond($data);
		}
	}

	public function delete($id = null){
		$data = $this->model->find($id);
		if($data){
			$this->model->delete($id);
			return $this->respondDeleted($data);
		}else{
			return $this->failNotFound('Mahasiswa tidak ditemukan');
		}
	}

}
