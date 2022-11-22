<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Collaborators extends BaseController {

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

  public function collaborators_list()
    {
        //echo "hello";
        if(!CheckRoleAndPermission(1)) {
            header('Location: '.base_url('admin/dashboard'));
        }
        $data['collaborators'] = $this->common_model->GetAllData('admin',array('id !='=>1),'id','desc');
        
        return view('admin/collaborators-list',$data);
    }

   

    public function addSubadmin()
    {

        //echo "hello";
        $this->validation->setRule('name','Name','trim|required');
        $this->validation->setRule('email','Email','trim|required|valid_email|is_unique[admin.email]');
        $this->validation->setRule('password','Password','trim|required');
        $this->validation->setRule('phone','Phone','trim|required|numeric');
        $this->validation->setRule('role_id','Role','required');
        
       if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {

            $insert['name']= $this->request->getVar('name');
            $insert['email']= $this->request->getVar('email');
            $insert['password']= $this->request->getVar('password');
            $insert['phone']= $this->request->getVar('phone');
            $insert['role_id'] = $this->request->getVar('role_id');            
            $run = $this->common_model->InsertData('admin', $insert);

            if($run)
            {  
                $role = $this->common_model->GetSingleData('roles', array('id'=>$insert['role_id']));
                $email = $insert['email'];
                $subject = 'Welcome Email';
                $body = "<p>Hello <strong>". $insert['name']."</strong></p>";
                $body .= "<p>The following email is to inform you that your account has been created For Role <strong>".$role['name']."</strong>.</p>";
                $body .= "<p>Login details :</p>";
                $body .= "<p>URL -  :<a href=".base_url()."/admin>Click Here</a></p>";
                $body .= "<p>Email -  : ".$insert['email']."</p>";
                $body .= "<p>Password -  : ".$insert['password']."</p>";

                $this->common_model->SendMail($email,$subject,$body);
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Collaborators has been Added successfully</div>');
                $output['message']='<div class="alert alert-success">Collaborators has been Added successfully</div>' ;
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

    public function editSubadmin()
    {

        //echo "hello";
        $this->validation->setRule('name','Name','trim|required');
        $this->validation->setRule('phone','Phone','trim|required|numeric');
        $this->validation->setRule('role_id','Role','required');
        
       if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $id = $this->request->getVar('id');
            $email = $this->request->getVar('email');
            $update['name']= $this->request->getVar('name');
            $update['phone']= $this->request->getVar('phone');
            $update['role_id'] = $this->request->getVar('role_id');            
            $run = $this->common_model->UpdateData('admin', array('id'=>$id),$update);

            if($run)
            {  
                $role = $this->common_model->GetSingleData('roles', array('id'=>$update['role_id']));
                $email = $email;
                $subject = 'Update Email';
                $body = "<p>Hello <strong>". $update['name']."</strong></p>";
                $body .= "<p>The following email is to inform you that your account has been updated For Role <strong>".$role['name']."</strong>.</p>";

                $this->common_model->SendMail($email,$subject,$body);
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Collaborators has been Updated successfully</div>');
                $output['message']='<div class="alert alert-success">Collaborators has been Updated successfully</div>' ;
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

    public function deleteSubadmin()
    {
        $id = $this->request->getVar('id');
        $run = $this->common_model->DeleteData('admin',array('id'=>$id));
         
        if($run)
        {  
         
            $this->session->setFlashdata('msg', '<div class="alert alert-success">Collaborators has been Deleted successfully</div>');
            $output['status']= 1 ;                               

        }
        else 
        {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger">Something went wrong</div>');
            $output['status']= 0 ;  
        
        };
        echo json_encode($output); 
        
    }

    public function changePassword()
    {
        $this->validation->setRule('password','New Password','trim|required');
        $this->validation->setRule('cnfm_password','Confirm Password','trim|required|matches[password]');
        
       if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $update['password'] = $this->request->getVar('password');
            $id = $this->request->getVar('id');
            $run = $this->common_model->UpdateData('admin', array('id'=>$id),$update);
            if($run)
            {  
                $data = $this->common_model->GetSingleData('admin', array('id'=>$id));
                $role = $this->common_model->GetSingleData('roles', array('id'=>$data['role_id']));
                $email = $data['email'];
                $subject = 'Password Changed';
                $body = "<p>Hello <strong>". $data['name']."</strong></p>";
                $body .= "<p>The following email is to inform you that your account Password has been changed For Role <strong>".$role['name']."</strong>.</p>";
                $body .= "<p>New Password : ".$update['password']."</p>";

                $this->common_model->SendMail($email,$subject,$body);
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Password has been Changed successfully</div>');
                $output['message']='<div class="alert alert-success">Password has been Changed successfully</div>' ;
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
  	
}