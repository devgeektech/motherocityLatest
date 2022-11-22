<?php 
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
class Content_Management extends BaseController {

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

  	public function privacy_list()
    {
        $data['privacy'] = $this->common_model->GetSingleData('content_management',array('id'=>1));
        $data['term_list'] = $this->common_model->GetSingleData('content_management',array('id'=>3));
        $data['cookie_list'] = $this->common_model->GetSingleData('content_management',array('id'=>7));
        return view('admin/privacy-list', $data);
    }

    public function edit_privacy()
    {
    	
        $this->validation->setRule('tab1_title','Tab1 Title','trim|required');
        $this->validation->setRule('tab1_description','Tab1 Description','trim|required');
       
       if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            //$id = $this->request->getVar('id');
            $update['page_name']= 'privacy';
            $update['tab1_title']= $this->request->getVar('tab1_title');
            $update['tab1_description']= $this->request->getVar('tab1_description');
            
            $update['updated_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->UpdateData('content_management', array('id'=>1) ,$update);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Privacy has been updated successfully</div>');
                $output['message']='Privacy has been updated successfully' ;
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


    public function edit_cookie()
    {    	
        $this->validation->setRule('tab1_title','Tab1 Title','trim|required');
        $this->validation->setRule('tab1_description','Tab1 Description','trim|required');
       
       if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            //$id = $this->request->getVar('id');
            $update['page_name']= 'cookie';
            $update['tab1_title']= $this->request->getVar('tab1_title');
            $update['tab1_description']= $this->request->getVar('tab1_description');
            
            $update['updated_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->UpdateData('content_management', array('id'=>7) ,$update);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Cookie has been updated successfully</div>');
                $output['message']='Cookie has been updated successfully' ;
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

    public function term_list()
    {
        $data['term_list'] = $this->common_model->GetSingleData('content_management',array('id'=>3));
        return view('admin/term-list', $data);
    }

    public function edit_term()
    {
        
        $this->validation->setRule('tab1_title','Title','trim|required');
        $this->validation->setRule('tab1_description','Description','trim|required');
       
        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            //$id = $this->request->getVar('id');
            $update['page_name']= 'Terms';
            $update['tab1_title']= $this->request->getVar('tab1_title');
            $update['tab1_description']= $this->request->getVar('tab1_description');
            $update['updated_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->UpdateData('content_management', array('id'=>3) ,$update);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Terms has been updated successfully</div>');
                $output['message']='Terms has been updated successfully' ;
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

  public function about()
    {
        $data['what'] = $this->common_model->GetSingleData('content_management',array('id'=>5));
        $data['who'] = $this->common_model->GetSingleData('content_management',array('id'=>6));
        $data['why'] = $this->common_model->GetSingleData('content_management',array('id'=>4));
        return view('admin/about', $data);
    }

  public function edit_about()
    {
      
        $this->validation->setRule('tab1_title','Tab1 Title','trim|required');
        $this->validation->setRule('tab1_description','Tab1 Description','trim|required');
       
       

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            //$id = $this->request->getVar('id');
            $update['page_name']= 'about';
            $update['tab1_title']= $this->request->getVar('tab1_title');
            $update['tab1_description']= $this->request->getVar('tab1_description');
           

            $update['updated_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->UpdateData('content_management', array('id'=>2) ,$update);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">About has been updated successfully</div>');
                $output['message']='About has been updated successfully' ;
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


    public function edit_what()
    {
      
        $this->validation->setRule('tab1_title','Tab1 Title','trim|required');
        $this->validation->setRule('tab1_description','Tab1 Description','trim|required');
       
       

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            //$id = $this->request->getVar('id');
            $update['page_name']= 'what';
            $update['tab1_title']= $this->request->getVar('tab1_title');
            $update['tab1_description']= $this->request->getVar('tab1_description');
           

            $update['updated_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->UpdateData('content_management', array('id'=>5) ,$update);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">About has been updated successfully</div>');
                $output['message']='About has been updated successfully' ;
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
    public function edit_who()
    {
      
        $this->validation->setRule('tab1_title','Tab1 Title','trim|required');
        $this->validation->setRule('tab1_description','Tab1 Description','trim|required');
       
       

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            //$id = $this->request->getVar('id');
            $update['page_name']= 'who';
            $update['tab1_title']= $this->request->getVar('tab1_title');
            $update['tab1_description']= $this->request->getVar('tab1_description');
           

            $update['updated_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->UpdateData('content_management', array('id'=>6) ,$update);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">About has been updated successfully</div>');
                $output['message']='About has been updated successfully' ;
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

    public function edit_why()
    {
      
        $this->validation->setRule('tab1_title','Tab1 Title','trim|required');
        $this->validation->setRule('tab1_description','Tab1 Description','trim|required');
       
       

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            //$id = $this->request->getVar('id');
            $update['page_name']= 'why';
            $update['tab1_title']= $this->request->getVar('tab1_title');
            $update['tab1_description']= $this->request->getVar('tab1_description');
           

            $update['updated_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->UpdateData('content_management', array('id'=>4) ,$update);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">About has been updated successfully</div>');
                $output['message']='About has been updated successfully' ;
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
   public function report_list()
    {
        $data['report_list'] = $this->common_model->GetAllData('report_bug','','id','desc');
        return view('admin/report-list', $data);
    }

    public function reportcategory_list()
    {
        $data['category_list'] = $this->common_model->GetAllData('report_category','','id','desc');
        return view('admin/report-category', $data);
    }

  public function add_report_category()
    {
        //echo "hello";
        $this->validation->setRule('title','Title','trim|required|is_unique[report_category.title]',array('is_unique' =>'This category already exit'));
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
            
             $run = $this->common_model->InsertData('report_category', $insert);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Report Category has been added successfully</div>');
                $output['message']='Report Category has been added successfully' ;
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

  public function edit_reportCategory()
    {
        //echo "hello";
        $this->validation->setRule('title','Category Name','trim|required');
        $this->validation->setRule('description','Description','trim|required');

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $id = $this->request->getVar('id');
            $check = $this->common_model->GetSingleData('report_category', array('title'=> $_POST['title'], 'id!='=>$id));
            if($check)
            {
                 $output['message']='<div class="alert alert-danger">category already exist</div>' ;
                $output['status']= 0 ; 
            }
         else
        {
            $id = $this->request->getVar('id');
            $update['title'] = $this->request->getVar('title'); 

            $update['description']= $this->request->getVar('description');
                  
            $update['updated_at']= date('Y-m-d H:i:s');
            
            $run = $this->common_model->UpdateData('report_category',array('id'=>$id), $update);

            if($run)
            {  
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Report Category has been Updated successfully</div>');
             
                $output['message']='Report Category has been Updated successfully' ;
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

  public function delete_report_category()
    {
        //echo "hello";
            $id = $this->request->getVar('id'); 
                  
            $run = $this->common_model->DeleteData('report_category',array('id'=>$id));
            if($run)
            {  
                $output['message']='Report Category has been Deleted successfully' ;
                $output['status']= 1 ;  
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Report Category has been Deleted successfully</div>');
                                            

            }
            else             {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ; 
            
            }
         
         echo json_encode($output);
      
    }

  public function help_list()
    {
        $data['help_list'] = $this->common_model->GetAllData('help_list','','id','desc');
        return view('admin/help-list', $data);
    }


  public function helpcategory_list()
    {
        $data['category_list'] = $this->common_model->GetAllData('help_category','','id','desc');
        return view('admin/help-category', $data);
    }

    public function add_help_category()
    {
        //echo "hello";
        $this->validation->setRule('title','Title','trim|required|is_unique[help_category.title]',array('is_unique' =>'This category already exit'));
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
            
             $run = $this->common_model->InsertData('help_category', $insert);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Help Category has been added successfully</div>');
                $output['message']='Help Category has been added successfully' ;
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

  public function edit_helpCategory()
    {
        //echo "hello";
        $this->validation->setRule('title','Category Name','trim|required');
        $this->validation->setRule('description','Description','trim|required');

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $id = $this->request->getVar('id');
            $check = $this->common_model->GetSingleData('help_category', array('title'=> $_POST['title'], 'id!='=>$id));
            if($check)
            {
                 $output['message']='<div class="alert alert-danger">category already exist</div>' ;
                $output['status']= 0 ; 
            }
         else
        {
            $id = $this->request->getVar('id');
            $update['title'] = $this->request->getVar('title'); 

            $update['description']= $this->request->getVar('description');
                  
            $update['updated_at']= date('Y-m-d H:i:s');
            
            $run = $this->common_model->UpdateData('help_category',array('id'=>$id), $update);

            if($run)
            {  
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Help Category has been Updated successfully</div>');
             
                $output['message']='Help Category has been Updated successfully' ;
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

  public function delete_help_category()
    {
        //echo "hello";
            $id = $this->request->getVar('id'); 
                  
            $run = $this->common_model->DeleteData('help_category',array('id'=>$id));
            if($run)
            {  
                $output['message']='Report Category has been Deleted successfully' ;
                $output['status']= 1 ;  
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Help Category has been Deleted successfully</div>');
                                            

            }
            else             {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ; 
            
            }
         
         echo json_encode($output);
      
    }

}