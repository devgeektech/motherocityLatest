<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Blog extends BaseController {

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

 public function blog_category()
    {
        //echo "hello";
        $data['blog_category'] = $this->common_model->GetAllData('content_blog',array('parent'=>0),'id','desc');
        return view('admin/blog-category',$data);
    }

    public function blog_subcategory()
    {
        //echo "hello";
        $data['blog_subcategory'] = $this->common_model->GetAllData('content_blog',array('parent!='=>0),'id','desc');
        $data['blog_category'] = $this->common_model->GetAllData('content_blog',array('parent'=>0),'id','desc');
        return view('admin/blog-subcategory',$data);
    }

    public function add_Blogcategory()
    {
        //echo "hello";
        $this->validation->setRule('title','Title','trim|required|is_unique[content_blog.title]',array('is_unique' =>'This category already exit'));
       

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $insert['title']= $this->request->getVar('title');
            $insert['created_at']= date('Y-m-d H:i:s');
            $insert['parent'] = 0;
             $run = $this->common_model->InsertData('content_blog', $insert);

            if($run)
            {  
             
             	$this->session->setFlashdata('msg', '<div class="alert alert-success">Blog Category has been added successfully</div>');
                $output['message']='Blog Category has been added successfully' ;
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
    public function edit_BlogCategory()
    {
        //echo "hello";
        $this->validation->setRule('title','Category Name','trim|required');
       

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $id = $this->request->getVar('id');
            $check = $this->common_model->GetSingleData('content_blog', array('title'=> $_POST['title'], 'id!='=>$id));
            if($check)
            {
                 $output['status']= 0 ; 
                 $output['message']='<div class="alert alert-danger">category already exist</div>' ;
            }
         else
        {
            $id = $this->request->getVar('id');
            $update['title'] = $this->request->getVar('title');            
            $update['updated_at']= date('Y-m-d H:i:s');
            
            $run = $this->common_model->UpdateData('content_blog',array('id'=>$id), $update);

            if($run)
            {  
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Blog Category has been Updated successfully</div>');
             
                $output['message']='Blog Category has been Updated successfully' ;
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

     public function delete_Blogcategory()
    {
        //echo "hello";
            $id = $this->request->getVar('id'); 
                  
            $run = $this->common_model->DeleteData('content_blog',array('id'=>$id));
            if($run)
            {  
                $output['message']='Blog Category has been Deleted successfully' ;
                $output['status']= 1 ;  
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Blog Category has been Deleted successfully</div>');
                                            

            }
            else             {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ; 
            
            }
         
         echo json_encode($output);
      
    }

    public function add_BlogSubcategory()
    {
        //echo "hello";
        $this->validation->setRule('title','Title','trim|required');
        $this->validation->setRule('category','Category','trim|required');
        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $check = $this->common_model->GetSingleData('content_blog', array('title'=> $_POST['title'], 'parent'=>$this->request->getVar('category')));
            if($check)
            {
                $output['message']='<div class="alert alert-danger">Subcategory already exist</div>' ;
                $output['status']= 0 ;  
            } else {
                $insert['title'] = $this->request->getVar('title');            
                $insert['parent'] = $this->request->getVar('category');
                $insert['created_at']= date('Y-m-d H:i:s');
               

                $run = $this->common_model->InsertData('content_blog', $insert );

                if($run)
                {  
                 
                    $this->session->setFlashdata('msg', '<div class="alert alert-success">Blog SubCategory has been added successfully</div>');
                    $output['message']='Blog SubCategory has been added successfully' ;
                    $output['status']= 1 ;                               

                }
                else 
                {
                
                    $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                    $output['status']= 0 ;  
                
                }
                $output['status']= 1; 
            }
            
         }
         echo json_encode($output);
      
    }

     public function edit_BlogSubcategory()
      {
        //echo "hello";die;
        $this->validation->setRule('title','Title','trim|required');
        $this->validation->setRule('category','Category','trim|required');
        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $id = $this->request->getVar('id');
            $check = $this->common_model->GetSingleData('content_blog', array('title'=> $_POST['title'], 'id!='=>$id ,'parent'=>$this->request->getVar('category')));
            if($check)
            {
                $output['message']='<div class="alert alert-danger">Subcategory already exist</div>' ;
                $output['status']= 0 ;  
            } else {
                $id = $this->request->getVar('id');
                $update['title'] = $this->request->getVar('title');            
                $update['parent'] = $this->request->getVar('category');
                $update['updated_at']= date('Y-m-d H:i:s');
               

               $run = $this->common_model->UpdateData('content_blog',array('id'=>$id), $update);

                if($run)
                {  
                 
                    $this->session->setFlashdata('msg', '<div class="alert alert-success">SubCategory has been Updated successfully</div>');
                    $output['message']='SubCategory has been Updated successfully' ;
                    $output['status']= 1 ;                               

                }
                else 
                {
                
                    $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                    $output['status']= 0 ;  
                
                }
                $output['status']= 1; 
            }
             //echo json_encode($output);
         }
        echo json_encode($output);
      
    }

 public function delete_Blogsubcategory()
    {
        //echo "hello";
            $id = $this->request->getVar('id'); 
                  
            $run = $this->common_model->DeleteData('content_blog',array('id'=>$id));
            if($run)
            {  
                $output['message']='Blog SubCategory has been Deleted successfully' ;
                $output['status']= 1 ;  
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Blog SubCategory has been Deleted successfully</div>');
                                            

            }
            else             {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ; 
            
            }
         
         echo json_encode($output);
      
    }
  public function blog_list()
    {
        //echo "hello";
        $data['blog_list'] = $this->common_model->GetAllData('blog_management','','id','desc');
        $data['blog_category'] = $this->common_model->GetAllData('content_blog',array('parent'=>0),'id','desc');
        $data['blog_subcategory'] = $this->common_model->GetAllData('content_blog',"parent!=0",'id','desc');
        return view('admin/blog-list',$data);
    }

   public function add_Blog()
    {
        //echo "hello";
        $this->validation->setRule('title','Title','trim|required|is_unique[blog_management.title]',array('is_unique' =>'This title already exit'));
        $this->validation->setRule('description','Description','trim|required');
        $this->validation->setRule('category','Category','trim|required');
        // $this->validation->setRule('featured_image','featured_image','required');
        // $this->validation->setRule('status','Status','trim|required');

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $insert['title']= $this->request->getVar('title');
            $insert['description']= $this->request->getVar('description');
            $insert['summary']= $this->request->getVar('summary');
            $insert['category']= $this->request->getVar('category');
            $insert['subcategory']= $this->request->getVar('subcategory');
            $insert['related_content'] = !empty( $this->request->getVar('related_content') ) ? implode(',',$this->request->getVar('related_content')) : '';
            // $insert['status']= $this->request->getVar('status');
            
            // print_r($_FILES);
            // exit;
            if(!empty($_FILES['featured_image']['name'])) {
                $newName = explode('.',$_FILES['featured_image']['name']);
                $ext = end($newName);
                $fileName = 'assets/post_image/'.rand().time().'.'.$ext;
                move_uploaded_file($_FILES['featured_image']['tmp_name'], $fileName);
                $insert['featured_image']= $fileName ; 
           } else {
               $insert['featured_image'] = $this->request->getVar('featured_image');
           }

            if($this->request->getVar('price'))
            {
                $insert['price']= $this->request->getVar('price');
            }else{
                $insert['price']= 0;
            }
            //$insert['blog_type']= $this->request->getVar('blog_type');
            $insert['created_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->InsertData('blog_management', $insert);

            if($run)
            {  
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Blog  has been added successfully</div>');
                $output['message']='Blog  has been added successfully' ;
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

    public function fetch_subcat()
    {
        //echo "hello";die;
        $category_id = $_POST["category_id"];
        $subcat = $this->common_model->GetAllData('content_blog',array('parent'=>$category_id),'id','desc');
        ?>
        <option value="">Select SubCategory</option>
        <?php
        foreach($subcat as $value) {
        ?>
          <option value="<?php echo $value["id"];?>"><?php echo $value["title"];?></option>
        <?php
        }
    }

    public function fetch_editsubcat()
    {
        //echo "hello";die;
        
        $category_id = $_POST["category_id"];
        $subcat = $this->common_model->GetAllData('content_blog',array('parent'=>$category_id),'id','desc');
        ?>
        <option value="">Select SubCategory</option>
        <?php
        foreach($subcat as $value) {
        ?>
          <option value="<?php echo $value["id"];?>"><?php echo $value["title"];?></option>
        <?php
        }
    }

    public function edit_Blog()
    {
        //echo "hello";
        $this->validation->setRule('title','Title','trim|required|');
        $this->validation->setRule('description','Description','trim|required');
        $this->validation->setRule('category','Category','trim|required');
        //$this->validation->setRule('subcategory','SubCategory','trim|required');
        // $this->validation->setRule('status','Status','trim|required');
       

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $id = $this->request->getVar('id');
            $check = $this->common_model->GetSingleData('blog_management', array('title'=>$_POST['title'], 'id !='=>$id));
            if($check)
            {
                $output['message']='<div class="alert alert-danger">Title Already exist</div>';
                $output['status']= 0 ; 
            } else {
                $update['title']= $this->request->getVar('title');
                $update['description']= $this->request->getVar('description');
                $update['category']= $this->request->getVar('category');
                $update['subcategory']= $this->request->getVar('subcategory');
                $update['summary']= $this->request->getVar('summary');
                $update['related_content']= !empty($this->request->getVar('related_content') ) ? implode(',',$this->request->getVar('related_content')) : '';
                $update['status']= $this->request->getVar('status');
                
                if(!empty($_FILES['featured_image']['name'])) {
                    $newName = explode('.',$_FILES['featured_image']['name']);
                    $ext = end($newName);
                    $fileName = 'assets/post_image/'.rand().time().'.'.$ext;
                    move_uploaded_file($_FILES['featured_image']['tmp_name'], $fileName);
                    $update['featured_image']= $fileName ; 
                }

                if($update['status'] == 1){
                    $update['price']= $this->request->getVar('price');    
                }elseif($update['status'] == 0){
                    $update['price']= 0;
                }
                //$update['blog_type']= $this->request->getVar('blog_type');
                $update['created_at']= date('Y-m-d H:i:s');
                
                 $run = $this->common_model->UpdateData('blog_management', array('id'=>$id) ,$update);

                if($run)
                {  
                 
                    $this->session->setFlashdata('msg', '<div class="alert alert-success">Blog  has been updated successfully</div>');
                    $output['message']='Blog  has been updated successfully' ;
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

    public function delete_Blog()
    {
        //echo "hello";
            $id = $this->request->getVar('id'); 
                  
            $run = $this->common_model->DeleteData('blog_management',array('id'=>$id));
            if($run)
            {  
                $output['message']='Blog has been Deleted successfully' ;
                $output['status']= 1 ;  
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Blog has been Deleted successfully</div>');
                                            

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