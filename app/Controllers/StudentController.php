<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
use App\Models\Student;

class StudentController extends ResourceController
{
    use ResponseTrait;
    public function index()
    {
        $model = new Student();
        $data['student'] = $model->orderBy('id', 'DESC')->findAll();
        return $this->respond($data);
    }
     // create
     public function create() {
        helper('date');
        $rules = [
			"username" => "required",
			"email" => "required|valid_email|is_unique[students.email]",
			"password" => "required",
		];
		$messages = [
			"username" => [
				"required" => "Username Field is required"
			],
			"email" => [
				"required" => "Email Field required",
				"valid_email" => "Email address is not in format",
				"is_unique" => "Email address already exists"
			],
			"password" => [
				"required" => "password Field is required"
			],
		];
        if (!$this->validate($rules, $messages)) {

			$response = [
				'status' => 500,
				'error' => true,
				'message' => $this->validator->getErrors(),
				'data' => []
			];
		} else {
                    $model = new Student();
                    $data = [
                        'username' => $this->request->getVar('username'),
                        'email'  => $this->request->getVar('email'),
                        'password' => md5($this->request->getVar('password')),
                        'created_at'  => Time::now(),
                        'updated_at' => Time::now(),
                    ];
                    $model->insert($data);
                    $response = [
                    'status'   => 201,
                    'error'    => null,
                    'data' => $data,
                    'messages' => [
                        'success' => 'Student created successfully'
                    ]
                ];
  
             }
             return $this->respondCreated($response);
            }

    public function show($id = null){
        $model = new Student();
        $data = $model->where('id', $id)->first();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No employee found');
        }
    }
    // update
    public function update($id = null){
        helper('date');
        $rules = [
			"username" => "required",
			"email" => "required|valid_email|is_unique[students.email]",
			"password" => "required",
		];
		$messages = [
			"username" => [
				"required" => "Username Field is required"
			],
			"email" => [
				"required" => "Email Field required",
				"valid_email" => "Email address is not in format",
				"is_unique" => "Email address already exists"
			],
			"password" => [
				"required" => "password Field is required"
			],
		];
        if (!$this->validate($rules, $messages)) {

			$response = [
				'status' => 500,
				'error' => true,
				'message' => $this->validator->getErrors(),
				'data' => []
			];
		} else {
        $model = new Student();
        $data = [
            'username' => $this->request->getVar('username'),
            'email'  => $this->request->getVar('email'),
            'password'  => md5($this->request->getVar('password')),
            'created_at'  => Time::now(),
            'updated_at' => Time::now(),
        ];
        $save= $model->update($id,$data);
    //    $save= $model->where('id',$id)->update($data);
        $response = [
          'status'   => 200,
          'error'    => null,
          'data' => $save,
          'messages' => [
              'success' => 'Employee updated successfully'
          ]
      ];
    }
      return $this->respond($response);
    }
    // delete
    public function delete($id = null){
        $model = new Student();
        $data = $model->where('id', $id)->delete($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Employee successfully deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No employee found');
        }
    }
}
