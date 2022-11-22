<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Stage_management extends BaseController {

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

  public function stage_list()
    {
        //echo "hello";
        $data['stage_list'] = $this->common_model->GetAllData('stage_management','','id','desc');
        
        return view('admin/stage-list',$data);
    }

    public function addStage()
    {
        //echo "hello";
        $this->validation->setRule('title','Title','trim|required|is_unique[stage_management.title]',array('is_unique' =>'This Stage already exit'));
        $this->validation->setRule('short_title','short_title','trim|required');
        $this->validation->setRule('description','Description','trim|required');
        $this->validation->setRule('start_days','Start Days','trim|required');
        $this->validation->setRule('end_days','End Days','trim|required');
        
        
       if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $insert['title']= $this->request->getVar('title');
            $insert['short_title']= $this->request->getVar('short_title');
            $insert['description']= $this->request->getVar('description');
            $insert['start_days']= $this->request->getVar('start_days');
            $insert['end_days']= $this->request->getVar('end_days');
            $insert['created_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->InsertData('stage_management', $insert);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Stage has been added successfully</div>');
                $output['message']='Stage has been added successfully' ;
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

    public function edit_stage()
    {

        //echo "hello";
       $this->validation->setRule('title','Title','trim|required');
       $this->validation->setRule('short_title','Short Title','trim|required');
       $this->validation->setRule('description','Description','trim|required');
       $this->validation->setRule('start_days','Start Days','trim|required');
       $this->validation->setRule('end_days','End Days','trim|required');
       
        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {

            $id = $this->request->getVar('id');
            $check = $this->common_model->GetSingleData('stage_management', array('title'=> $_POST['title'], 'id!='=>$id));
            if($check)
            {
                 $output['status']= 0 ; 
                 $output['message']='<div class="alert alert-danger">Stage category already exist</div>' ;
            }else{
                 $id = $this->request->getVar('id');
                 $update['title']= $this->request->getVar('title');
                 $update['short_title']= $this->request->getVar('short_title');
                 $update['description']= $this->request->getVar('description');
                 $update['start_days']= $this->request->getVar('start_days');
                 $update['end_days']= $this->request->getVar('end_days');
                 
                $update['updated_at']= date('Y-m-d H:i:s');
                
                $run = $this->common_model->UpdateData('stage_management', array('id'=>$id) ,$update);

                if($run)
                {  
                 
                    $this->session->setFlashdata('msg', '<div class="alert alert-success">Stage has been updated successfully</div>');
                    $output['message']='Stage has been updated successfully' ;
                    $output['status']= 1 ;                               

                }
                else 
                {
                
                    $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                    $output['status']= 0 ;  
                
                }
            }
               
         }
         echo json_encode($output);
      
    }

    public function delete_Stage()
    {
        //echo "hello";
            $id = $this->request->getVar('id'); 
                  
            $run = $this->common_model->DeleteData('stage_management',array('id'=>$id));
            if($run)
            {  
                $output['message']='Stage has been Deleted successfully' ;
                $output['status']= 1 ;  
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Stage has been Deleted successfully</div>');
                                            

            }
            else             {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ; 
            
            }
         
         echo json_encode($output);
      
    }
  

   /* public function change_blogtype()
    {
        $blog_id = $_POST["blog_id"];
        $update['blog_type'] = $_POST["blog_val"];
        $run = $this->common_model->UpdateData('blog_management',array('id'=>$blog_id),$update);
         
         //$output['status']=1;
         echo json_encode($output); 
        
    }*/
  	
}