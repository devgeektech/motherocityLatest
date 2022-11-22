<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Content extends BaseController {

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

  public function content_category()
    {
        //echo "hello";
        $data['content_cat'] = $this->common_model->GetAllData('content',array('parent'=>0),'id','desc');
        
        return view('admin/content-category',$data);
    }

    public function add_Content_Category()
    {
        //echo "hello";
        $this->validation->setRule('title','Title','trim|required|is_unique[content.title]',array('is_unique' =>'This title already exit'));
        $this->validation->setRule('description','Description','trim|required');
        $this->validation->setRule('content_type','content_type','trim|required');
        $this->validation->setRule('hand_picked','hand_picked','trim|required');
        $this->validation->setRule('status','Status','trim|required');
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
            $insert['content_type']= $this->request->getVar('content_type');
            $insert['hand_picked']= $this->request->getVar('hand_picked');
            $insert['status']= $this->request->getVar('status');
            $insert['preview']= $this->request->getVar('preview');
            $insert['related_content']= $this->request->getVar('related_content');
            if($this->request->getVar('price'))
            {
                $insert['price']= $this->request->getVar('price');
            }else{
                $insert['price']= 0;
            }
            //$insert['blog_type']= $this->request->getVar('blog_type');
            if(!empty($_FILES['image']['name']))
               {
                    $newName = explode('.',$_FILES['image']['name']);
                    $ext = end($newName);
                    $fileName = 'assets/content_image/'.rand().time().'.'.$ext;
                    move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
                    $insert['image']= $fileName ; 
               }
            $insert['parent'] = 0;
            $insert['created_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->InsertData('content', $insert);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Content Category  has been added successfully</div>');
                $output['message']='Content Category  has been added successfully' ;
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

    public function edit_ContentCat()
    {

        //echo "hello";
        $this->validation->setRule('title','Title','trim|required');
        $this->validation->setRule('description','Description','trim|required');
        $this->validation->setRule('content_type','content_type','trim|required');
        $this->validation->setRule('hand_picked','hand_picked','trim|required');
        $this->validation->setRule('status','Status','trim|required');
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
            $check = $this->common_model->GetSingleData('content', array('title'=> $_POST['title'], 'id!='=>$id));
            if($check)
            {
                 $output['status']= 0 ; 
                 $output['message']='<div class="alert alert-danger">Content category already exist</div>' ;
            }else{
                 $id = $this->request->getVar('id');
                $update['title']= $this->request->getVar('title');
                $update['description']= $this->request->getVar('description');
                $update['content_type']= $this->request->getVar('content_type');
                $update['hand_picked']= $this->request->getVar('hand_picked');
                $update['status']= $this->request->getVar('status');
                $update['preview']= $this->request->getVar('preview');
                $update['related_content']= $this->request->getVar('related_content');
                if($this->request->getVar('price'))
                {
                    $update['price']= $this->request->getVar('price');
                }else{
                    $update['price']= 0;
                }
                //$update['blog_type']= $this->request->getVar('blog_type');
                if(!empty($_FILES['image']['name']))
                   {
                        $newName = explode('.',$_FILES['image']['name']);
                        $ext = end($newName);
                        $fileName = 'assets/content_image/'.rand().time().'.'.$ext;
                        move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
                        $update['image']= $fileName ; 
                   }
                $update['parent'] = 0;
                $update['updated_at']= date('Y-m-d H:i:s');
                
                $run = $this->common_model->UpdateData('content', array('id'=>$id) ,$update);

                if($run)
                {  
                 
                    $this->session->setFlashdata('msg', '<div class="alert alert-success">Content Category  has been updated successfully</div>');
                    $output['message']='Content Category  has been updated successfully' ;
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

    public function delete_ContentCat()
    {
        //echo "hello";
            $id = $this->request->getVar('id'); 
                  
            $run = $this->common_model->DeleteData('content',array('id'=>$id));
            if($run)
            {  
                $output['message']='Content Category has been Deleted successfully' ;
                $output['status']= 1 ;  
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Content Category has been Deleted successfully</div>');
                                            

            }
            else             {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ; 
            
            }
         
         echo json_encode($output);
      
    }
  public function content_subcategory()
    {
        //echo "hello";
        $data['content_subcat'] = $this->common_model->GetAllData('content',"parent != 0",'id','desc');
        $data['content_category'] = $this->common_model->GetAllData('content',array('parent'=>0),'id','desc');
        
        return view('admin/content-subcategory',$data);
    }
 
  public function add_Content_SubCategory()
    {
        //echo "hello";
        $this->validation->setRule('title','Title','trim|required|is_unique[content.title]',array('is_unique' =>'This title already exit'));
        $this->validation->setRule('description','Description','trim|required');
        $this->validation->setRule('content_type','content_type','trim|required');
        $this->validation->setRule('hand_picked','hand_picked','trim|required');
        $this->validation->setRule('status','Status','trim|required');
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
            $insert['content_type']= $this->request->getVar('content_type');
            $insert['hand_picked']= $this->request->getVar('hand_picked');
            $insert['status']= $this->request->getVar('status');
            $insert['preview']= $this->request->getVar('preview');
            $insert['related_content']= $this->request->getVar('related_content');
            if($this->request->getVar('price'))
            {
                $insert['price']= $this->request->getVar('price');
            }else{
                $insert['price']= 0;
            }
            //$insert['blog_type']= $this->request->getVar('blog_type');
            if(!empty($_FILES['image']['name']))
               {
                    $newName = explode('.',$_FILES['image']['name']);
                    $ext = end($newName);
                    $fileName = 'assets/content_image/'.rand().time().'.'.$ext;
                    move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
                    $insert['image']= $fileName ; 
               }
            $insert['parent'] = $this->request->getVar('category');
            $insert['created_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->InsertData('content', $insert);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Content SubCategory  has been added successfully</div>');
                $output['message']='Content SubCategory  has been added successfully' ;
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

    public function edit_ContentsubCat()
    {

        //echo "hello";
        $this->validation->setRule('title','Title','trim|required');
        $this->validation->setRule('description','Description','trim|required');
        $this->validation->setRule('content_type','content_type','trim|required');
        $this->validation->setRule('hand_picked','hand_picked','trim|required');
        $this->validation->setRule('status','Status','trim|required');
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
            $check = $this->common_model->GetSingleData('content', array('title'=> $_POST['title'], 'id!='=>$id));
            if($check)
            {
                 $output['status']= 0 ; 
                 $output['message']='<div class="alert alert-danger">Content category already exist</div>' ;
            }else{
                 $id = $this->request->getVar('id');
                $update['title']= $this->request->getVar('title');
                $update['description']= $this->request->getVar('description');
                $update['content_type']= $this->request->getVar('content_type');
                $update['hand_picked']= $this->request->getVar('hand_picked');
                $update['status']= $this->request->getVar('status');
                $update['preview']= $this->request->getVar('preview');
                $update['related_content']= $this->request->getVar('related_content');
                if($this->request->getVar('price'))
                {
                    $update['price']= $this->request->getVar('price');
                }else{
                    $update['price']= 0;
                }
                //$update['blog_type']= $this->request->getVar('blog_type');
                if(!empty($_FILES['image']['name']))
                   {
                        $newName = explode('.',$_FILES['image']['name']);
                        $ext = end($newName);
                        $fileName = 'assets/content_image/'.rand().time().'.'.$ext;
                        move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
                        $update['image']= $fileName ; 
                   }
                $update['parent'] = $this->request->getVar('category');
                $update['updated_at']= date('Y-m-d H:i:s');
                
                $run = $this->common_model->UpdateData('content', array('id'=>$id) ,$update);

                if($run)
                {  
                 
                    $this->session->setFlashdata('msg', '<div class="alert alert-success">Content SubSubcategory  has been updated successfully</div>');
                    $output['message']='Content SubSubcategory  has been updated successfully' ;
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

    public function delete_ContentsubCat()
    {
        //echo "hello";
            $id = $this->request->getVar('id'); 
                  
            $run = $this->common_model->DeleteData('content',array('id'=>$id));
            if($run)
            {  
                $output['message']='Content SubCategory has been Deleted successfully' ;
                $output['status']= 1 ;  
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Content SubCategory has been Deleted successfully</div>');
                                            

            }
            else             {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ; 
            
            }
         
         echo json_encode($output);
      
    }

    public function change_Contenttype()
    {
        $content_id = $_POST["content_id"];
        $update['content_type'] = $_POST["content_val"];
        $run = $this->common_model->UpdateData('content',array('id'=>$content_id),$update);
         
         //$output['status']=1;
         echo json_encode($output); 
        
    }
  	
}