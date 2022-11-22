<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Faqs extends BaseController {

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

    public function faqCategory() {
       $data['faqs_category'] = $this->common_model->GetAllData('faq_category',array('is_delete'=>0),'id','desc');
        return view('admin/faq-category',$data);
    }

  public function faqs_list()
    {
        //echo "hello";
        $data['faqs_list'] = $this->common_model->GetAllData('faqs_management','','id','desc');
        $data['category'] = $this->common_model->GetAllData("faq_category", array("is_delete"=>0), "id", "desc");
        return view('admin/faqs-list',$data);
    }

   public function add_faqs()
    {
        //echo "hello";
        $this->validation->setRule('title','Title','trim|required');
        $this->validation->setRule('description','Description','trim|required');
        $this->validation->setRule('category','FAQ Category','trim|required');
        $this->validation->setRule('faq_about','FAQ For','trim|required');
        $this->validation->setRule('category','category','trim|required');
        $this->validation->setRule('screen','screen','trim|required');

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {  
            $insert['title']= $this->request->getVar('title');
            $insert['description']= $this->request->getVar('description');
            $insert['category']= $this->request->getVar('category');
            $insert['faq_about']= $this->request->getVar('faq_about');
            $insert['screen']= $this->request->getVar('screen');
            $insert['created_at']= date('Y-m-d H:i:s');
            
            
             $run = $this->common_model->InsertData('faqs_management', $insert);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Faqs  has been added successfully</div>');
                $output['message']='Faqs  has been added successfully' ;
                $output['status']= 1 ;                               

            }
            else 
            {
                $this->session->setFlashdata('msg', '<div class="alert alert-danger">Something went wrong</div>');
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ;  
            
            }
         }
         echo json_encode($output);
      
    }


    public function edit_faqs()
    {
        //echo "hello";
        $this->validation->setRule('title','Title','trim|required');
        $this->validation->setRule('description','Description','trim|required');
        $this->validation->setRule('category','FAQ Category','trim|required');
        $this->validation->setRule('faq_about','FAQ For','trim|required');
        $this->validation->setRule('screen','screen','trim|required');

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
            $update['category']= $this->request->getVar('category');
            $update['faq_about']= $this->request->getVar('faq_about');
            $insert['screen']= $this->request->getVar('screen');
            
            $update['updated_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->UpdateData('faqs_management', array('id'=>$id) ,$update);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Faqs  has been updated successfully</div>');
                $output['message']='Faqs  has been updated successfully' ;
                $output['status']= 1 ;                               

            }
            else 
            {
                $this->session->setFlashdata('msg', '<div class="alert alert-danger">Something went wrong</div>');
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ;  
            
            }
         }
         echo json_encode($output);
      
    }

    public function delete_faqs()
    {
        //echo "hello";
            $id = $this->request->getVar('id'); 
                  
            $run = $this->common_model->DeleteData('faqs_management',array('id'=>$id));
            if($run)
            {  
                $output['message']='Faqs has been Deleted successfully' ;
                $output['status']= 1 ;  
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Faqs has been Deleted successfully</div>');
                                            

            }
            else {
                $this->session->setFlashdata('msg', '<div class="alert alert-danger">Something went wrong</div>');
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ; 
            
            }
         
         echo json_encode($output);
      
    }

    public function accountfaqs_list()
    {
        //echo "hello";
        $data['faqs_list'] = $this->common_model->GetAllData('account_faqs','','id','desc');
        return view('admin/accountfaqs-list',$data);
    }

    public function add_accountfaqs()
    {
        //echo "hello";
        $this->validation->setRule('title','Title','trim|required');
        $this->validation->setRule('description','Description','trim|required');
      
       

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {  
            $insert['title']= $this->request->getVar('title');
            $insert['description']= $this->request->getVar('description');
            $insert['created_at']= date('Y-m-d H:i:s');
            $insert['updated_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->InsertData('account_faqs', $insert);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Account Faqs  has been added successfully</div>');
                $output['message']='Account Faqs  has been added successfully' ;
                $output['status']= 1 ;                               

            }
            else 
            {
                $this->session->setFlashdata('msg', '<div class="alert alert-danger">Something went wrong</div>');
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ;  
            
            }
         }
         echo json_encode($output);
      
    }
    public function edit_accountfaqs()
    {
        //echo "hello";
        $this->validation->setRule('title','Title','trim|required');
        $this->validation->setRule('description','Description','trim|required');
       

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
            $update['updated_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->UpdateData('account_faqs', array('id'=>$id) ,$update);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Account Faqs  has been updated successfully</div>');
                $output['message']='Account Faqs  has been updated successfully' ;
                $output['status']= 1 ;                               

            }
            else 
            {
                $this->session->setFlashdata('msg', '<div class="alert alert-danger">Something went wrong</div>');
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ;  
            
            }
         }
         echo json_encode($output);
      
    }
   public function delete_accountfaqs()
    {
        //echo "hello";
            $id = $this->request->getVar('id'); 
                  
            $run = $this->common_model->DeleteData('account_faqs',array('id'=>$id));
            if($run)
            {  
                $output['message']='Account Faqs has been Deleted successfully' ;
                $output['status']= 1 ;  
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Account Faqs has been Deleted successfully</div>');
                                            

            }
            else {
                $this->session->setFlashdata('msg', '<div class="alert alert-danger">Something went wrong</div>');
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ; 
            
            }
         
         echo json_encode($output);
      
    }

    public function add_Faqscategory() {
       $this->validation->setRule('name','name','trim|required|is_unique[faq_category.name]',array('is_unique' =>'This category already exit'));
       

        if($this->validation->withRequest($this->request)->run()==false) {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        } else {
            $insert['name']= $this->request->getVar('name');
            $insert['created_at']= date('Y-m-d H:i:s'); 
            $run = $this->common_model->InsertData('faq_category', $insert);

            if($run) {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Faq category has been added successfully</div>');
                $output['status']= 1 ;                               

            } else {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ;  
            
            }
         }
         echo json_encode($output);
    }


    public function edit_FaqsCategory() {
        $this->validation->setRule('name','category Name','trim|required');       

        if($this->validation->withRequest($this->request)->run()==false) {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0;       
        } else {
                    $id = $this->request->getVar('id');
                    $check = $this->common_model->GetSingleData('faq_category', array('name'=> $_POST['name'], 'id!='=>$id));
                    if($check) {
                         $output['status']= 2; 
                         $output['message']='<div class="alert alert-danger">category already exist</div>' ;
                    } else {
                    $id = $this->request->getVar('id');
                    $update['name'] = $this->request->getVar('name');            
                    $update['updated_at']= date('Y-m-d H:i:s');
                    
                    $run = $this->common_model->UpdateData('faq_category',array('id'=>$id), $update);

                        if($run) {  
                            $this->session->setFlashdata('msg', '<div class="alert alert-success">Faq Category has been updated successfully</div>');            
                            $output['status']= 1 ;                               
                        } else  {            
                            $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                            $output['status']= 0 ;              
                        }
                    }
        }
         echo json_encode($output);
    }

    public function FaqsCategoryDelete() {

        $id = $_REQUEST['id'];

        $run = $this->common_model->UpdateData("faq_category", array("id"=>$id), array("is_delete"=>1));
        if ($run) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success">Faq Category has been deleted successfully</div>'); 
         } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger">Something went wrong</div>'); 
        }

        header('Location: '.base_url('admin/faq-category'));
    }
  	
}