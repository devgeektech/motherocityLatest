<?php 
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
class City_Management extends BaseController {

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
        $data['data'] = $this->common_model->GetAllData('states','','id','desc');
        return view('admin/statelist', $data);
    }

  	public function addState()
    {
        helper(['form']);
	    if ($this->request->getMethod() == "post") {
	        $validation =  \Config\Services::validation();

	        $rules = [
	            "title" => [
	                "label" => "Title", 
	                "rules" => "required|trim|is_unique[states.title]"
	            ],
	            
	        ];

	        if ($this->validate($rules)) {
				$insert['title'] = $_POST['title'];
				$insert['created_at'] = date('Y-m-d');
				
				$run = $this->common_model->InsertData('states', $insert);
				
		       if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">State has been Added successfully.</div>');
						$output['status']=1;
						$output['message']="State has been Added successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

  	public function editState()
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
                 $check = $this->common_model->GetSingleData('states', array('title'=> $_POST['title'], 'id!='=>$id));

		       if($check)
		        {
		             $output['message']='<div class="label alert-danger">State already exist</div>' ;
		            $output['status']= 0 ; 
		        }else
		        {
		        	$id = $_POST['id'];
				    $update['title'] = $_POST['title'];
				    $update['updated_at'] = date('Y-m-d');
						
				    $run = $this->common_model->UpdateData('states',array('id'=>$id), $update);
				
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">States has been Updated successfully.</div>');
						$output['status']=1;
						$output['message']="States has been Updated successfully.";
				}

		        }
				
				
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

    
    public function deleteState() {        
        
        $id = $_POST['id'];
        $run = $this->common_model->DeleteData('states', array('id'=> $id));
        $run1 = $this->common_model->DeleteData('cities', array('state_id'=> $id));
        if ($run) {
            $json['message'] = 'Success! States has been Deleted successfully';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }


   public function city_list()
    {
        $data['data'] = $this->common_model->GetAllData('cities','','id','desc');

        return view('admin/citylist', $data);
    }
   
   public function addCity()
    {
        helper(['form']);
	    if ($this->request->getMethod() == "post") {
	        $validation =  \Config\Services::validation();

	        $rules = [
	            "title" => [
	                "label" => "Title", 
	                "rules" => "required|trim|is_unique[cities.title]"
	            ],
	            "state" => [
                  "label" => "State", 
                  "rules" => "required|trim"
              ],
	            
	        ];

	        if ($this->validate($rules)) {
				$insert['title'] = $_POST['title'];
				$insert['state_id'] = $_POST['state'];
				$insert['created_at'] = date('Y-m-d');
				
				$run = $this->common_model->InsertData('cities', $insert);
				
		       if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">Cities has been Added successfully.</div>');
						$output['status']=1;
						$output['message']="Cities has been Added successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

  public function editCity()
    {
        helper(['form']);
	    if ($this->request->getMethod() == "post") {
	        $validation =  \Config\Services::validation();

	        $rules = [
	            "title" => [
	                "label" => "Title", 
	                "rules" => "required|trim"
	            ],
	           "state" => [
                  "label" => "State", 
                  "rules" => "required|trim"
              ],
	            
	            
	        ];

	        if ($this->validate($rules)) {

	        	 $id = $_POST['id'];
                 $check = $this->common_model->GetSingleData('cities', array('title'=> $_POST['title'], 'id!='=>$id));

		       if($check)
		        {
		             $output['message']='<div class="label alert-danger">City already exist</div>' ;
		            $output['status']= 0 ; 
		        }else
		        {
		        	$id = $_POST['id'];
				    $update['title'] = $_POST['title'];
				    $update['state_id'] = $_POST['state'];
				    $update['updated_at'] = date('Y-m-d');
						
				    $run = $this->common_model->UpdateData('cities',array('id'=>$id), $update);
				
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">Cities has been Updated successfully.</div>');
						$output['status']=1;
						$output['message']="Cities has been Updated successfully.";
				}

		        }
				
				
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

     public function deleteCity() {        
        
        $id = $_POST['id'];
        $run = $this->common_model->DeleteData('cities', array('id'=> $id));
       
        if ($run) {
            $json['message'] = 'Success! Cities has been Deleted successfully';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }
}