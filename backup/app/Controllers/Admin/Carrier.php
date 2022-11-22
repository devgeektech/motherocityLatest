<?php 
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
class Carrier extends BaseController {

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
        $data['data'] = $this->common_model->GetAllData('carrier_management','','id','desc');
        return view('admin/carrierlist', $data);
    }

  	public function addcarrier()
    {
        helper(['form']);
	    if ($this->request->getMethod() == "post") {
	        $validation =  \Config\Services::validation();

	        $rules = [
	            "title" => [
	                "label" => "Title", 
	                "rules" => "required|trim|is_unique[carrier_management.title]"
	            ],
	            
	        ];

	        if ($this->validate($rules)) {
				$insert['title'] = $_POST['title'];
				$insert['user_id'] = 0;
				$insert['created_at'] = date('Y-m-d');
				
				$run = $this->common_model->InsertData('carrier_management', $insert);
				
		       if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">Carrier has been Added successfully.</div>');
						$output['status']=1;
						$output['message']="Carrier has been Added successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

  	public function editcarrier()
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
                 $check = $this->common_model->GetSingleData('carrier_management', array('title'=> $_POST['title'], 'id!='=>$id));

		       if($check)
		        {
		             $output['message']='<div class="label alert-danger">carrier already exist</div>' ;
		            $output['status']= 0 ; 
		        }else
		        {
		        	$id = $_POST['id'];
				    $update['title'] = $_POST['title'];
				    $update['updated_at'] = date('Y-m-d');
						
				    $run = $this->common_model->UpdateData('carrier_management',array('id'=>$id), $update);
				
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">Carrier has been Updated successfully.</div>');
						$output['status']=1;
						$output['message']="Carrier has been Updated successfully.";
				}

		        }
				
				
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

    
    public function deletecarrier() {        
        
        $id = $_POST['id'];
        $run = $this->common_model->DeleteData('carrier_management', array('id'=> $id));
        if ($run) {
            $json['message'] = 'Success! Carrier has been Deleted successfully';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }

   
}