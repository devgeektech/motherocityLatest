<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Tips extends BaseController {

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

  public function tips_list()
    {
        //echo "hello";
        $data['tips_list'] = $this->common_model->GetAllData('tips_management','','id','desc');
        return view('admin/tips-list',$data);
    }

   public function add_Tips()
    {
        //echo "hello";
        $this->validation->setRule('title','Title','trim|required');
        //$this->validation->setRule('description','Description','trim|required');
        //$this->validation->setRule('is_free','Is Free','trim|required');
        $this->validation->setRule('days','days','trim|required');
        $this->validation->setRule('week_no','week_no','trim|required');
        $this->validation->setRule('preview','preview','trim|required');
       

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {  
            $insert['title']= $this->request->getVar('title');
            $insert['description']= $this->request->getVar('description');
           // $insert['blog_id']= $this->request->getVar('blog_id');
           // $insert['tips_date']= $this->request->getVar('tips_date');
           // $insert['is_free']= $this->request->getVar('is_free');
            /*if($this->request->getVar('price'))
            {
                $insert['price']= $this->request->getVar('price');
            }else{
                $insert['price']= 0;
            }*/
            $insert['days']= $this->request->getVar('days');
            $insert['week_no']= $this->request->getVar('week_no');
            $insert['preview']= $this->request->getVar('preview');

            if($this->request->getVar('related_content')){

              $insert['related_content']= implode(',',$this->request->getVar('related_content'));
            }

            $insert['created_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->InsertData('tips_management', $insert);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Tips  has been added successfully</div>');
                $output['message']='Tips  has been added successfully' ;
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


    public function edit_Tips()
    {
        //echo "hello";
        $this->validation->setRule('title','Title','trim|required');
        //$this->validation->setRule('description','Description','trim|required');
        //$this->validation->setRule('is_free','Is Free','trim|required');
        //$this->validation->setRule('tips_date','Date','trim|required');
        $this->validation->setRule('days','days','trim|required');
        $this->validation->setRule('week_no','week_no','trim|required');
        $this->validation->setRule('preview','preview','trim|required');

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
            /*$update['blog_id']= $this->request->getVar('blog_id');
            $update['tips_date']= $this->request->getVar('tips_date');
            $update['is_free']= $this->request->getVar('is_free');
            if($this->request->getVar('price')){
                $update['price']= $this->request->getVar('price');    
            }else{
                $update['price']= 0;
            }*/
            $update['days']= $this->request->getVar('days');
            $update['week_no']= $this->request->getVar('week_no');
            $update['preview']= $this->request->getVar('preview');
            if($this->request->getVar('related_content')){
                
            $update['related_content']= implode(',',$this->request->getVar('related_content'));
            }
            $update['updated_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->UpdateData('tips_management', array('id'=>$id) ,$update);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Tips  has been updated successfully</div>');
                $output['message']='Tips  has been updated successfully' ;
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

    public function delete_Tips()
    {
        //echo "hello";
            $id = $this->request->getVar('id'); 
                  
            $run = $this->common_model->DeleteData('tips_management',array('id'=>$id));
            if($run)
            {  
                $output['message']='Tips has been Deleted successfully' ;
                $output['status']= 1 ;  
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Tips has been Deleted successfully</div>');
                                            

            }
            else             {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ; 
            
            }
         
         echo json_encode($output);
      
    }
  	
}