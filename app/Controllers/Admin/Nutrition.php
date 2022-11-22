<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Nutrition extends BaseController {

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

 public function nutrition_category()
    {
        //echo "hello";
        $data['nutrition_category'] = $this->common_model->GetAllData('nutrition_category',array('price'=>0),'id','desc');
        return view('admin/nutrition-category',$data);
    }

    public function nutrition_subcategory()
    {
        //echo "hello";
        $data['nutrition_subcategory'] = $this->common_model->GetAllData('nutrition_category',array('parent!='=>0),'id','desc');
        $data['nutrition_category'] = $this->common_model->GetAllData('nutrition_category',array('parent'=>0),'id','desc');
        return view('admin/nutrition-subcategory',$data);
    }

    public function add_nutrition_category()
    {
        //echo "hello";
        $this->validation->setRule('title','Title','trim|required|is_unique[nutrition_category.title]',array('is_unique' =>'This category already exit'));
        $this->validation->setRule('description','Description','trim|required');
        $this->validation->setRule('content_type','content_type','trim|required');
        // $this->validation->setRule('status','Status','trim|required');
       // $this->validation->setRule('preview','preview','trim|required');
       

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
            $insert['parent']= $this->request->getVar('parent');
         //   $insert['preview']= $this->request->getVar('preview');

            
            if($this->request->getVar('related_content')){

              $insert['related_content']= implode(',',$this->request->getVar('related_content'));
            }
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
                    $fileName = 'assets/nutrition_catimage/'.rand().time().'.'.$ext;
                    move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
                    $insert['image']= $fileName ; 
               }
            $insert['created_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->InsertData('nutrition_category', $insert);

            if($run)
            {  
             
             	$this->session->setFlashdata('msg', '<div class="alert alert-success">Nutrition Category has been added successfully</div>');
                $output['message']='Nutrition Category has been added successfully' ;
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
    public function edit_Nutritioncategory()
    {
        //echo "hello";
        $this->validation->setRule('title','Category Name','trim|required');
             $this->validation->setRule('description','Description','trim|required');
        $this->validation->setRule('content_type','content_type','trim|required');
        // $this->validation->setRule('status','Status','trim|required');
      //  $this->validation->setRule('preview','preview','trim|required');
       

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $id = $this->request->getVar('id');
            $check = $this->common_model->GetSingleData('nutrition_category', array('title'=> $_POST['title'], 'id!='=>$id));
            if($check)
            {
                 $output['status']= 0 ; 
                 $output['message']='<div class="alert alert-danger">category already exist</div>' ;
            }
         else
        {
            $id = $this->request->getVar('id');
            $update['title'] = $this->request->getVar('title');     
            $update['description']= $this->request->getVar('description');
            $update['content_type']= $this->request->getVar('content_type');
            $update['parent']= $this->request->getVar('parent');
         //   $update['preview']= $this->request->getVar('preview');
            if($this->request->getVar('related_content'))
            {

             $update['related_content']= implode(',',$this->request->getVar('related_content'));
            }
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
                    $fileName = 'assets/nutrition_catimage/'.rand().time().'.'.$ext;
                    move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
                    $update['image']= $fileName ; 
               }            
            $update['updated_at']= date('Y-m-d H:i:s');
            
             
           
            $run = $this->common_model->UpdateData('nutrition_category',array('id'=>$id), $update);

            if($run)
            {  
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Nutrition Category has been Updated successfully</div>');
             
                $output['message']='Nutrition Category has been Updated successfully' ;
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

     public function delete_nutrition_category()
    {
        //echo "hello";
            $id = $this->request->getVar('id'); 
                  
            $run = $this->common_model->DeleteData('nutrition_category',array('id'=>$id));
            if($run)
            {  
                $output['message']='Nutrition Category has been Deleted successfully' ;
                $output['status']= 1 ;  
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Nutrition Category has been Deleted successfully</div>');
                                            

            }
            else             {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ; 
            
            }
         
         echo json_encode($output);
      
    }

    public function add_nutrition_subcategory()
    {
        //echo "hello";
        $this->validation->setRule('title','Title','trim|required');
        $this->validation->setRule('category','Category','trim|required');
        $this->validation->setRule('description','Description','trim|required');
        $this->validation->setRule('content_type','content_type','trim|required');
        $this->validation->setRule('status','Status','trim|required');
     //   $this->validation->setRule('preview','preview','trim|required');
        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $check = $this->common_model->GetSingleData('nutrition_category', array('title'=> $_POST['title'], 'parent'=>$this->request->getVar('category')));
            if($check)
            {
                $output['message']='<div class="alert alert-danger">Subcategory already exist</div>' ;
                $output['status']= 0 ;  
            } else {
                $insert['title'] = $this->request->getVar('title'); 
                $insert['description']= $this->request->getVar('description');
                $insert['content_type']= $this->request->getVar('content_type');
                $insert['status']= $this->request->getVar('status');
           //     $insert['preview']= $this->request->getVar('preview');
                $insert['related_content']= implode(',',$this->request->getVar('related_content'));
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
                        $fileName = 'assets/nutrition_catimage/'.rand().time().'.'.$ext;
                        move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
                        $insert['image']= $fileName ; 
                   }             
                $insert['parent'] = $this->request->getVar('category');
                $insert['created_at']= date('Y-m-d H:i:s');
               

                $run = $this->common_model->InsertData('nutrition_category', $insert );

                if($run)
                {  
                 
                    $this->session->setFlashdata('msg', '<div class="alert alert-success">Nutrition SubCategory has been added successfully</div>');
                    $output['message']='Nutrition SubCategory has been added successfully' ;
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

     public function edit_Nutritionsubcategory()
      {
        //echo "hello";die;
        $this->validation->setRule('title','Title','trim|required');
        $this->validation->setRule('description','Description','trim|required');
        $this->validation->setRule('content_type','content_type','trim|required');
        $this->validation->setRule('status','Status','trim|required');
      //  $this->validation->setRule('preview','preview','trim|required');
        $this->validation->setRule('category','Category','trim|required');
        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $id = $this->request->getVar('id');
            $check = $this->common_model->GetSingleData('nutrition_category', array('title'=> $_POST['title'], 'id!='=>$id ,'parent'=>$this->request->getVar('category')));
            if($check)
            {
                $output['message']='<div class="alert alert-danger">Subcategory already exist</div>' ;
                $output['status']= 0 ;  
            } else {
                $id = $this->request->getVar('id');
                $update['title'] = $this->request->getVar('title');  
                $update['description']= $this->request->getVar('description');
                $update['content_type']= $this->request->getVar('content_type');
                $update['status']= $this->request->getVar('status');
               // $update['preview']= $this->request->getVar('preview');
                $update['related_content']= implode(',',$this->request->getVar('related_content'));
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
                        $fileName = 'assets/nutrition_catimage/'.rand().time().'.'.$ext;
                        move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
                        $update['image']= $fileName ; 
                   }            
                $update['parent'] = $this->request->getVar('category');
                $update['updated_at']= date('Y-m-d H:i:s');
               

               $run = $this->common_model->UpdateData('nutrition_category',array('id'=>$id), $update);

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

 public function delete_nutritionsubcategory()
    {
        //echo "hello";
            $id = $this->request->getVar('id'); 
                  
            $run = $this->common_model->DeleteData('nutrition_category',array('id'=>$id));
            if($run)
            {  
                $output['message']='Nutrition SubCategory has been Deleted successfully' ;
                $output['status']= 1 ;  
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Nutrition SubCategory has been Deleted successfully</div>');
                                            

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
        $run = $this->common_model->UpdateData('nutrition_category',array('id'=>$content_id),$update);
         
         //$output['status']=1;
         echo json_encode($output); 
        
    }  	
}