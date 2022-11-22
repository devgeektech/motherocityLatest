<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Roles extends BaseController {

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

  public function roles_list()
    {
        //echo "hello";
        $data['roles_list'] = $this->common_model->GetAllData('roles','','id','desc');
        
        return view('admin/roles-list',$data);
    }

   

    public function addRole()
    {

        //echo "hello";
        $this->validation->setRule('name','Title','trim|required');
        
       if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {

            $insert['name']= $this->request->getVar('name');
            $roles = $this->request->getVar('role_id');
            $insert['role_id'] = implode(',',$roles);
            $insert['created_at']= date('Y-m-d H:i:s');            
            $run = $this->common_model->InsertData('roles', $insert);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Role has been Added successfully</div>');
                $output['message']='<div class="alert alert-success">Role has been Added successfully</div>' ;
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

    public function editRole()
    {

        //echo "hello";
        $this->validation->setRule('name','Title','trim|required');
        
       if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $id = $this->request->getVar('id');
            $update['name']= $this->request->getVar('name');
            $roles = $this->request->getVar('role_id');
            $update['role_id'] = implode(',',$roles);
            $update['updated_at']= date('Y-m-d H:i:s');            
            $run = $this->common_model->UpdateData('roles', array('id'=>$id),$update);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Role has been Updated successfully</div>');
                $output['message']='<div class="alert alert-success">Role has been Updated] successfully</div>' ;
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

    public function deleteRole()
    {
        $id = $this->request->getVar('id');
        $run = $this->common_model->DeleteData('roles',array('id'=>$id));
         
        if($run)
        {  
         
            $this->session->setFlashdata('msg', '<div class="alert alert-success">Role has been Deleted successfully</div>');
            $output['status']= 1 ;                               

        }
        else 
        {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger">Something went wrong</div>');
            $output['status']= 0 ;  
        
        };
        echo json_encode($output); 
        
    }
  	
}