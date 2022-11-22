<?php 
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
class Category extends BaseController {

	public function __construct() {   
        helper(['form', 'url']);
        $this->session = \Config\Services::session();
        return $this->check_login();
    } 
    public function check_login()
    {
      if (!$this->session->has('admin_id')) {
          header('Location: '.base_url('admin'));
      }
       
    }

  	public function index()
    {
        $data['data'] = $this->common_model->GetAllData('category','','id','desc');
        return view('admin/categorylist', $data);
    }

  	public function addCategory()
    {
        helper(['form']);
	    if ($this->request->getMethod() == "post") {
	        $validation =  \Config\Services::validation();

	        $rules = [
	            "title" => [
	                "label" => "Title", 
	                "rules" => "required|trim|is_unique[category.title]"
	            ],
	            
	        ];

	        if ($this->validate($rules)) {
				$insert['title'] = $_POST['title'];
				$insert['user_id'] = 0;
				$insert['created_at'] = date('Y-m-d');
				
				$run = $this->common_model->InsertData('category', $insert);
				
		       if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">Category has been Added successfully.</div>');
						$output['status']=1;
						$output['message']="Category has been Added successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

  	public function editCategory()
    {
        helper(['form']);
	    if ($this->request->getMethod() == "post") {
	        $validation =  \Config\Services::validation();

	        $rules = [
	            "title" => [
	                "label" => "Title", 
	                "rules" => "required|trim"
	            ],
	            
	        ];

	        if ($this->validate($rules)) {

	        	$id = $_POST['id'];
                 $check = $this->common_model->GetSingleData('category', array('title'=> $_POST['title'], 'id!='=>$id));

		       if($check)
		        {
		             $output['message']='<div class="label alert-danger">category already exist</div>' ;
		            $output['status']= 0 ; 
		        }else
		        {
		        	$id = $_POST['id'];
				    $update['title'] = $_POST['title'];
				    $update['updated_at'] = date('Y-m-d');
						
				    $run = $this->common_model->UpdateData('category',array('id'=>$id), $update);
				
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">Category has been Updated successfully.</div>');
						$output['status']=1;
						$output['message']="Category has been Updated successfully.";
				}

		        }
				
				
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

    
    public function deleteCategory() {        
        
        $id = $_POST['id'];
        $run = $this->common_model->DeleteData('category', array('id'=> $id));
        if ($run) {
            $json['message'] = 'Success! Category has been Deleted successfully';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }

   
}