<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Plan extends BaseController {

	public function __construct() {   
        helper(['form', 'url']);
        $this->session = \Config\Services::session();
        return $this->check_login();
        //$this->load->library("upload",$config);
    } 

    public function check_login()
    {
      if (!$this->session->has('admin_id')) {
          header('Location: '.base_url('admin'));
      }
       
    }

  public function plan_list()
    {
        //echo "hello";
        $data['plan_list'] = $this->common_model->GetAllData('plan_management','','id','desc');
        
        return view('admin/plan-list',$data);
    }

   

    public function edit_plan()
    {

        //echo "hello";
        $this->validation->setRule('title','Title','trim|required');
        $this->validation->setRule('description','Description','trim|required');
       
        $this->validation->setRule('price','price','trim|required');
        
       if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {

            $id = $this->request->getVar('id');
            $update['title']= $this->request->getVar('title');
            $update['description']= $this->request->getVar('description');
           
            $update['price']= $this->request->getVar('price');
            
            $update['updated_at']= date('Y-m-d H:i:s');
            
            $run = $this->common_model->UpdateData('plan_management', array('id'=>$id) ,$update);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Membership has been updated successfully</div>');
                $output['message']='Membership  has been updated successfully' ;
                $output['status']= 1 ;                               

            }
            else 
            {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ;  
            
            }
            
               
         }
         echo json_encode($output);
      
    }

    public function change_blogtype()
    {
        $blog_id = $_POST["blog_id"];
        $update['blog_type'] = $_POST["blog_val"];
        $run = $this->common_model->UpdateData('blog_management',array('id'=>$blog_id),$update);
         
         //$output['status']=1;
         echo json_encode($output); 
        
    }
  	
}