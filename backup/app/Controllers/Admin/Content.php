<?php 
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
class Content extends BaseController {

	public function __construct() {   
        helper(['form', 'url']);
        $this->session = \Config\Services::session();
        
        $this->check_login();
    } 
    public function check_login()
    {
      if (!$this->session->has('admin_id')) {
          header('Location: '.base_url('admin'));
          return ; 
      }
       
    }

  	public function index()
    {
        $data['data'] = $this->common_model->GetAllData('content_management','','id','desc');
        return view('admin/content-list', $data);
    }

    public function editContent()
    {
    	
         $this->validation->setRule('content','Content','trim|required');
        
     if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['validation']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
        else
        {
        	$id = $_POST['id'];
			$update['content'] = $_POST['content'];
			
			$run = $this->common_model->UpdateData('content_management',array('id' =>$id), $update);
			if($run)
			{
				
					$this->session->setFlashdata('msg', '<div class="alert alert-success">Content has been Updated successfully.</div>');
					$output['status']=1;
					$output['message']="Content has been Updated successfully.";
			}else{
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Something Went Wrong.</div>');
                    $output['status']=1;
                    $output['message']="Something Went Wrong.";
            }
	    }
		echo json_encode($output);
    }

    

   
}