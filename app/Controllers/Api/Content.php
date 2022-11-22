<?php
namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Common_model;
use CodeIgniter\HTTP\RequestInterface;
header("Access-Control-Allow-Origin: *");

class Content extends ResourceController {
	
	use ResponseTrait;
	protected $req;
	// get all product
	protected $validation = null;
	
	public function __construct()
	{
		$this->common_model = new Common_model();
		$this->format = 'json';
		$this->validation = \Config\Services::validation();
		$this->db      = \Config\Database::connect();
		$this->req = \Config\Services::request()->getVar();
	}

	//Save for later a post
	public function saveForlater() {
		$this->validation->setRule('blog_id','blog_id','trim|required');
		$this->validation->setRule('user_id','user_id','trim|required');
		if($this->validation->withRequest($this->request)->run()==false) {	   
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}

		try{
			$blogId = $this->request->getVar('blog_id');
			$userId = $this->request->getVar('user_id');
			// check if already exists
			$checkBlog = $this->common_model->GetSingleData(
				'saved_blogs',
				['user_id' => $userId, 'blog_id' => $blogId]
			);

			if($checkBlog){
				$output['message'] = 'The blog already saved';
				$output['status'] = 0 ;
				return $this->respond($output);
			}

			$insertData['blog_id'] = $this->request->getVar('blog_id');		
			$insertData['user_id'] = $this->request->getVar('user_id');		
			$run = $this->common_model->insertData('saved_blogs', $insertData);

			if($run) {
				$output['data'] = $run;
				$output['message'] = 'Blog saved successfully!';
				$output['status'] = 1 ;
			} else {
				$output['message'] = 'something went wrong';
				$output['status'] = 0 ;
			}
		    
			return $this->respond($output);
		}
		catch (\Exception $e) {
			return $e->getMessage();
			
		}
	}

	//Add reminder
	public function getSavedBlogs() {
		$blogIds = [];
		$getBlogDetails = [];
		$this->validation->setRule('user_id','user_id','required');		
		if($this->validation->withRequest($this->request)->run()==false) {	   
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}
		
		try{
			$userId = $this->request->getVar('user_id');
			$blogData =  $this->common_model->GetAllData("saved_blogs", array('user_id' => $userId), "id", "desc");

			if($blogData){
				foreach ($blogData as $bd) {
					$blogIds[] = $bd['blog_id'];
				}

				$getBlogDetails = $this->common_model->getBlogsByIds($blogIds);
			}

			if($blogData) {
				$output['data'] = $getBlogDetails;
				$output['message'] = 'Saved blogs';
				$output['status'] = 1 ;
			} else {
				$output['message'] = 'No blogs found';
				$output['status'] = 0 ;
			}
		    
			return $this->respond($output);
		}
		catch (\Exception $e) {
			return $e->getMessage();
			
		}
	}

	//file upload
	public function uploadFile() {
		try{

		 	if(!empty($_FILES['image']['name'])) {
                $newName = explode('.',$_FILES['image']['name']);
                $ext = end($newName);
                $fileName = 'assets/images/'.rand().time().'.'.$ext;

                if( move_uploaded_file($_FILES['image']['tmp_name'], $fileName) ){
                	$fileName = base_url().'/'.$fileName;
                	$output['data'] = $fileName;
					$output['message'] = 'File uploaded successfully!';
					$output['status'] = 1 ;
                }
             	else{
	            	$output['data'] = [];
					$output['message'] = 'File not uploaded';
					$output['status'] = 0 ;
            	}
            }
            else{
            	$output['data'] = [];
				$output['message'] = 'Please upload an image';
				$output['status'] = 0 ;
            }

			return $this->respond($output);
			exit;
		}
		catch (\Exception $e) {
			return $e->getMessage();
			
		}
	}
}
