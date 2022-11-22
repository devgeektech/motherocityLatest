<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Toolkit extends BaseController {

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

  public function toolkit_category()
    {
        //echo "hello";
        $data['toolkit_cat'] = $this->common_model->GetAllData('toolkit',array('parent'=>0),'id','desc');
        
        return view('admin/toolkit-category',$data);
    }

    public function add_Toolkit_Category()
    {
        //echo "hello";
        $this->validation->setRule('title','Title','trim|required|is_unique[toolkit.title]',array('is_unique' =>'This title already exit'));
        $this->validation->setRule('description','Description','trim|required');
        $this->validation->setRule('preview','preview','trim|required');
        $this->validation->setRule('related_content','related_content','trim|required');
       

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $insert['title']= $this->request->getVar('title');
            $insert['description']= $this->request->getVar('description');
           
            $insert['preview']= $this->request->getVar('preview');
            $insert['related_content']= $this->request->getVar('related_content');
           
            $insert['parent'] = 0;
            $insert['created_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->InsertData('toolkit', $insert);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Toolkit Category  has been added successfully</div>');
                $output['message']='Toolkit Category  has been added successfully' ;
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

    public function edit_toolCat()
    {

        //echo "hello";
        $this->validation->setRule('title','Title','trim|required');
        $this->validation->setRule('description','Description','trim|required');
       
        $this->validation->setRule('preview','preview','trim|required');
        $this->validation->setRule('related_content','related_content','trim|required');
       
       

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {

            $id = $this->request->getVar('id');
            $check = $this->common_model->GetSingleData('toolkit', array('title'=> $_POST['title'], 'id!='=>$id));
            if($check)
            {
                 $output['status']= 0 ; 
                 $output['message']='<div class="alert alert-danger">Toolkit category already exist</div>' ;
            }else{
                 $id = $this->request->getVar('id');
                $update['title']= $this->request->getVar('title');
                $update['description']= $this->request->getVar('description');
               
                $update['preview']= $this->request->getVar('preview');
                $update['related_content']= $this->request->getVar('related_content');
                
                $update['parent'] = 0;
                $update['updated_at']= date('Y-m-d H:i:s');
                
                $run = $this->common_model->UpdateData('toolkit', array('id'=>$id) ,$update);

                if($run)
                {  
                 
                    $this->session->setFlashdata('msg', '<div class="alert alert-success">Toolkit Category  has been updated successfully</div>');
                    $output['message']='Toolkit Category  has been updated successfully' ;
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

    public function delete_ToolkitCat()
    {
        //echo "hello";
            $id = $this->request->getVar('id'); 
                  
            $run = $this->common_model->DeleteData('toolkit',array('id'=>$id));
            if($run)
            {  
                $output['message']='Toolkit Category has been Deleted successfully' ;
                $output['status']= 1 ;  
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Toolkit Category has been Deleted successfully</div>');
                                            

            }
            else             {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ; 
            
            }
         
         echo json_encode($output);
      
    }
  public function toolkit_subcategory()
    {
        //echo "hello";
        $data['toolkit_subcat'] = $this->common_model->GetAllData('toolkit',"parent != 0",'id','desc');
        $data['toolkit_category'] = $this->common_model->GetAllData('toolkit',array('parent'=>0),'id','desc');
        
        return view('admin/toolkit-subcategory',$data);
    }
 
  public function add_toolkit_SubCategory()
    {
        //echo "hello";
        $this->validation->setRule('title','Title','trim|required|is_unique[toolkit.title]',array('is_unique' =>'This title already exit'));
        $this->validation->setRule('description','Description','trim|required');
        $this->validation->setRule('preview','preview','trim|required');
        $this->validation->setRule('related_content','related_content','trim|required');
        $this->validation->setRule('category','category','trim|required');
       

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $insert['title']= $this->request->getVar('title');
            $insert['description']= $this->request->getVar('description');
            $insert['preview']= $this->request->getVar('preview');
            $insert['related_content']= $this->request->getVar('related_content');
            $insert['parent'] = $this->request->getVar('category');
            $insert['created_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->InsertData('toolkit', $insert);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Toolkit SubCategory  has been added successfully</div>');
                $output['message']='Toolkit SubCategory  has been added successfully' ;
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

    public function edit_ToolkitsubCat()
    {

        //echo "hello";
        $this->validation->setRule('title','Title','trim|required');
        $this->validation->setRule('description','Description','trim|required');
 
        $this->validation->setRule('preview','preview','trim|required');
        $this->validation->setRule('related_content','related_content','trim|required');
       
       

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {

            $id = $this->request->getVar('id');
            $check = $this->common_model->GetSingleData('toolkit', array('title'=> $_POST['title'], 'id!='=>$id));
            if($check)
            {
                 $output['status']= 0 ; 
                 $output['message']='<div class="alert alert-danger">Toolkit category already exist</div>' ;
            }else{
                 $id = $this->request->getVar('id');
                $update['title']= $this->request->getVar('title');
                $update['description']= $this->request->getVar('description');
               
                $update['preview']= $this->request->getVar('preview');
                $update['related_content']= $this->request->getVar('related_content');
                
                $update['parent'] = $this->request->getVar('category');
                $update['updated_at']= date('Y-m-d H:i:s');
                
                $run = $this->common_model->UpdateData('toolkit', array('id'=>$id) ,$update);

                if($run)
                {  
                 
                    $this->session->setFlashdata('msg', '<div class="alert alert-success">Toolkit SubSubcategory  has been updated successfully</div>');
                    $output['message']='Toolkit SubSubcategory  has been updated successfully' ;
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

    public function delete_toolkitsubCat()
    {
        //echo "hello";
            $id = $this->request->getVar('id'); 
                  
            $run = $this->common_model->DeleteData('toolkit',array('id'=>$id));
            if($run)
            {  
                $output['message']='Toolkit SubCategory has been Deleted successfully' ;
                $output['status']= 1 ;  
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Toolkit SubCategory has been Deleted successfully</div>');
                                            

            }
            else             {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ; 
            
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