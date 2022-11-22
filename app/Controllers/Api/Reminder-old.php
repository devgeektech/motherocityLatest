<?php
namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Common_model;
use CodeIgniter\HTTP\RequestInterface;
header("Access-Control-Allow-Origin: *");

class Reminder extends ResourceController {
	
	use ResponseTrait;
	protected $req;
	// get all product
	protected $validation = null;
	
	public function __construct()
	{
		$this->common_model = new Common_model();
		$this->common_model = new Common_model();
		$this->format = 'json';
		$this->validation = \Config\Services::validation();
		$this->db      = \Config\Database::connect();
		$this->req = \Config\Services::request()->getVar();
	}

	//Add reminder
	public function add() {
		$this->validation->setRule('user_id','user_id','trim|required');
		$this->validation->setRule('category','Category','trim|required');
		$this->validation->setRule('time','Time','required');
		$this->validation->setRule('date','Date','required');

		if($this->validation->withRequest($this->request)->run()==false) {	   
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}
		
		$insertData['user_id'] = $this->request->getVar('user_id');		
		$insertData['category'] = $this->request->getVar('category');		
		$insertData['heading'] = $this->request->getVar('heading');
		$insertData['time'] = $this->request->getVar('time');
		$insertData['date'] = $this->request->getVar('date');
		$insertData['repeat_type'] = $this->request->getVar('repeat');
		$insertData['notes'] = $this->request->getVar('notes');

		$run = $this->common_model->insertData('reminders', $insertData);

		if($run) {
			$output['data'] = $this->common_model->GetDataById('reminders',$run);
			$output['message'] = 'Reminder added successfully!';
			$output['status'] = 1 ;
		} else {
			$output['message'] = 'something went wrong';
			$output['status'] = 0 ;
		}
	    
		return $this->respond($output);
	}

	//Add reminder
	public function get() {
		$this->validation->setRule('user_id','user_id','required');		
		if($this->validation->withRequest($this->request)->run()==false) {	   
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}
		
		$run = $this->common_model->getAllReminders($this->request->getVar('user_id'));

		if($run) {
			$output['data'] = $run;
			$output['message'] = 'Reminders found';
			$output['status'] = 1 ;
		} else {
			$output['message'] = 'No reminder found';
			$output['status'] = 0 ;
		}
	    
		return $this->respond($output);
	}

	//Delete Reminder
	public function deleteReminder() {
		$this->validation->setRule('id','id','required');		
		$this->validation->setRule('user_id','user_id','required');

		if($this->validation->withRequest($this->request)->run()==false) {	   
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}
		try{
			$run = $this->common_model->DeleteData(
				'reminders',
				[
					'id' => $this->request->getVar('id'),
					'user_id' => $this->request->getVar('user_id'),
				]
			);
			if($run) {
				$output['data'] = $run;
				$output['message'] = 'Reminders deleted successfully!';
				$output['status'] = 1 ;
			} else {
				$output['message'] = 'No reminder found';
				$output['status'] = 0 ;
			}
			
			return $this->respond($output);
		}
		catch (\Exception $e) {
			return $e->getMessage();
			
		}		
	}

	//Edit Reminder
	public function editReminder() {
		$this->validation->setRule('id','id','required');		
		$this->validation->setRule('user_id','user_id','required');

		if($this->validation->withRequest($this->request)->run()==false) {	   
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}
		try{	
			$insertData['category'] = $this->request->getVar('category');		
			$insertData['heading'] = $this->request->getVar('heading');
			$insertData['time'] = $this->request->getVar('time');
			$insertData['date'] = $this->request->getVar('date');
			$insertData['repeat_type'] = $this->request->getVar('repeat');
			$insertData['notes'] = $this->request->getVar('notes');

			$run = $this->common_model->UpdateData(
				'reminders',
				[
					'id' => $this->request->getVar('id'),
					'user_id' => $this->request->getVar('user_id'),
				],
				$insertData
			);

			if($run) {
				$output['data'] = $this->common_model->GetDataById('reminders',$this->request->getVar('id'));;
				$output['message'] = 'Reminders edited successfully!';
				$output['status'] = 1 ;
			} else {
				$output['message'] = 'No reminder found';
				$output['status'] = 0 ;
			}
			
			return $this->respond($output);
		}
		catch (\Exception $e) {
			return $e->getMessage();
			
		}		
	}
}
