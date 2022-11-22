<?php 
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
class Users extends BaseController {

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

  	public function index()
    {
        $data['data'] = $this->common_model->GetAllData('users','','id','desc');
        return view('admin/users', $data);
    }

  	
  	

  	public function specialist_profile($id)
    {
        //echo $id;die;
        $data['view'] = $this->common_model->GetSingleData('users',array('id'=>$id));
       // $data['user_image'] = $this->common_model->GetAllData('user_images',array('user_id'=>$id));
       return view('admin/specialist_profile', $data);
    }

    public function mom_profile($id)
    {
        //echo $id;die;
        $data['view'] = $this->common_model->GetSingleData('users',array('id'=>$id));
       return view('admin/mom_profile', $data);
    }
    
  	public function user_edit($id)
    {
        $data['edit'] = $this->common_model->GetSingleData('users',array('id'=>$id));
        return view('admin/useredit', $data);
    }

  	
    public function update_user()
    {
         $this->validation->setRule('title','Title','trim|required');
    	   $this->validation->setRule('fname','First Name','trim|required');
         $this->validation->setRule('lname','Last Name','trim|required');
         $this->validation->setRule('email','Email','trim|required');
         $this->validation->setRule('username','User Name','trim|required');
         
         $this->validation->setRule('prononous','Prononous','trim|required');
         $this->validation->setRule('state','State','trim|required');
         $this->validation->setRule('city','City','trim|required');
         $this->validation->setRule('street_address','Address','trim|required');
         $this->validation->setRule('about_me','Aboout Me','trim|required');
         $this->validation->setRule('my_skill','My Skils','trim|required');
         
         if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['validation']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
        else
        {
        	$id = $_POST['id'];
            $update['title'] = $_POST['title'];
			$update['first_name'] = $_POST['fname'];
			$update['last_name'] = $_POST['lname'];
            $update['email'] = $_POST['email'];
            $update['username'] = $_POST['username'];
            
            $update['prononus'] = $_POST['prononous'];
            $update['state'] = $_POST['state'];
            $update['city'] = $_POST['city'];
            $update['street_address'] = $_POST['street_address'];
            $update['about_me'] = $_POST['about_me'];
            $update['my_skills'] = $_POST['my_skill'];
            if(!empty($_FILES['image']['name']))
               {
                    $newName = explode('.',$_FILES['image']['name']);
                    $ext = end($newName);
                    $fileName = 'assets/upload/'.rand().time().'.'.$ext;
                    move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
                    $update['image']= base_url().'/'.$fileName ; 
               }
			
			$run = $this->common_model->UpdateData('users',array('id' =>$id), $update);
			if($run)
			{
				
					$this->session->setFlashdata('msg', '<div class="alert alert-success">User has been Updated successfully.</div>');
					$output['status']=1;
					$output['message']="User has been Updated successfully.";
			}else
            {
                      $this->session->setFlashdata('msg', '<div class="alert alert-success">Something Went Wrong.</div>');
                    $output['status']=1;
                    $output['message']="Something Went Wrong.";
            }
	    }
		echo json_encode($output);
    }

    public function update_verify()
    {
    	$id = $_POST['id'];
    	
        $update['doc_verified'] = 1;        
	        
	    $run = $this->common_model->UpdateData('users',array('id' =>$id), $update);
	    $run1 = $this->common_model->GetSingleData('users',array('id' =>$id));
	    $email = $run1['email'];
	    if($run)
        {
          $subject="Document Verification Details!";    
        	$body = '<p>Hello '. $run1['first_name'].' '. $run1['last_name'].'</p>';
        	$body .= '<p>The following email is to inform you that your documents verification was successful.</p>';
            $send = $this->common_model->SendMail($email,$subject,$body);
            if($send)
            {
            	$output['status']=1;
            }   
                            

        }
		echo json_encode($output);	
				
    }

    public function update_reject()
    {
    	helper(['form']);
	    if ($this->request->getMethod() == "post") {
	        $validation =  \Config\Services::validation();

	        $rules = [
	            "reason" => [
	                "label" => "Reason", 
	                "rules" => "required|trim"
	            ]
	        ];
	        if ($this->validate($rules)) {
		    	$id = $_POST['id'];
		    	
		        $update['doc_verified'] = 3;        
		        $update['reason'] = $_POST['reason'];        
			        
			    $run = $this->common_model->UpdateData('users',array('id' =>$id), $update);
			    $run1 = $this->common_model->GetSingleData('users',array('id' =>$id));
			    $email = $run1['email'];
				if($run)
		        {
		            $subject="Document Verification Details!";    
		        	$body = '<p>Hello '. $run1['first_name'].' '. $run1['last_name'].'</p>';
		        	$body .= '<p>The following email is to inform you that your documents verification is not succeed please reupload them.</p>';
		        	$body .= '<p><strong>Reject Reason : </strong></p>';
		        	$body .= '<p>'.$run1['reason'].'</p>';
		            $send = $this->common_model->SendMail($email,$subject,$body); 
		            if($send)
		            {
		            	$output['status']=1;  
		            }  
		                          

		        }
		    } else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
				
    }

    public function enableUser()
    {
      		$id = $_POST['id'];
          $checkuser = $this->common_model->GetSingleData('users',array('id'=>$id));
          if(!empty($checkuser)){
            if($checkuser['status']==1){
                $update['status']=0;
                $this->session->setFlashdata('msg','<div class="alert alert-success">User has been blocked successfully</div>');
            }else{
                $update['status']=1;
                $this->session->setFlashdata('msg','<div class="alert alert-success">User has been active successfully</div>');

            }   
            $run = $this->common_model->UpdateData('users',['id'=>$id], $update);
            if($run){
                $output['status']=1;   
            }
          } else {
            $output['msg']='<div class="alert alert-danger">Somthing wrong</div>';
            $output['status']=0;
        }

        echo json_encode($output);
    }
    public function enableMom()
    {
      		$id = $_POST['id'];
          $checkuser = $this->common_model->GetSingleData('users',array('id'=>$id));
          if(!empty($checkuser)){
            if($checkuser['status']==1){
                $update['status']=0;
                $this->session->setFlashdata('msg','<div class="alert alert-success">User has been blocked successfully</div>');
            }else{
                $update['status']=1;
                $this->session->setFlashdata('msg','<div class="alert alert-success">User has been active successfully</div>');

            }   
            $run = $this->common_model->UpdateData('users',['id'=>$id], $update);
            if($run){
                $output['status']=1;   
            }
          } else {
            $output['msg']='<div class="alert alert-danger">Somthing wrong</div>';
            $output['status']=0;
        }

        echo json_encode($output);
    }

    public function deleteUser() {        
        
        $id = $_POST['id'];
        $run = $this->common_model->DeleteData('users', array('id'=> $id));
        if ($run) {
            $this->session->setFlashdata('msg','<div class="alert alert-success">User has been deleted successfully</div>');
            $json['message'] = 'Success! User has been Deleted successfully';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }

    public function reported_user()
    {
        //echo $id;die;
        $data['reported_user'] = $this->common_model->GetAllData('reported_user','','id','desc');
        return view('admin/reported_userlist', $data);
    }

    public function incoming_user()
    {
        //echo $id;die;
        $data['incoming_user'] = $this->common_model->GetAllData('users',array('is_verified'=>0,'user_type'=>1),'id','desc');
        $data['specialist_category'] = $this->common_model->GetAllData('specialist_category',array('parent'=>0),'id','desc');
        return view('admin/incoming_users_list', $data);
    }

    public function moms()
    {
        //echo $id;die;
       $data['moms'] = $this->common_model->GetAllData('users',array('user_type'=>2),'id','desc');
       $data['birth_type'] = $this->common_model->GetAllData('birth_type','','id','desc');
        return view('admin/moms-list', $data);
    }

    public function verified_user()
    {
        //echo $id;die;
        $data['verified_user'] = $this->common_model->GetAllData('users',array('is_verified'=>1,'user_type'=>1),'id','desc');
        return view('admin/verified_users_list', $data);
    }

     //verification accept
     public function verifyAccept()
     {
         $id = $_POST['id'];
         
         $update['is_verified'] = 1;        
             
         $run = $this->common_model->UpdateData('users',array('id' =>$id), $update);
         $run1 = $this->common_model->GetSingleData('users',array('id' =>$id));
         $email = $run1['email'];
        // print_r($run1);die;

         if($run)
         {
             $subject="Specialist verification";    
             $body = '<p>Hello '. $run1['first_name'].' '.$run1['last_name'].'</p>';
             $body .= '<p>Greetings '. $run1['first_name'].' '.$run1['last_name'].' Your application to become a specialist has been verified successfully.</p>';
             $send = $this->common_model->SendMail($email,$subject,$body);
        // print_r($send);die;

             if($send)
             {
                 $output['status']=1;
                 $this->session->setFlashdata('msg', '<div class="alert alert-success">User has been Verified successfully</div>');

             }   
                             
 
         }
         echo json_encode($output);	
                 
     }

     //verification reject
    public function verifyReject()
    {
    	$id = $_POST['id'];
        $reason = $_POST['reason'];          
	        
	    $run1 = $this->common_model->GetSingleData('users',array('id' =>$id));
	    $email = $run1['email'];
        // print_r($run1);die;
	    if($run1)

        {
            $subject="Specialist verification rejected";    
        	$body = '<p>Hello '. $run1['first_name'].' '.$run1['last_name'].'</p>';
        	$body .= '<p>Unfortunately, we were unable to verify your document due to </p>';
        	$body .= '<p>Reason :'. $reason.'.</p>';
            $send = $this->common_model->SendMail($email,$subject,$body);
            // print_r($send);die;
            if($send)
            {
            	$output['status']=1;
                $this->session->setFlashdata('msg', '<div class="alert alert-success">User has been rejected successfully</div>');

            }   
                            

        }
	    $run = $this->common_model->DeleteData('users',array('id' =>$id));

		echo json_encode($output);	
				
    }

    public function addUser()
    {
        //echo "hello";
        $this->validation->setRule('first_name','first_name','trim|required');
        $this->validation->setRule('last_name','last_name','trim|required');
        $this->validation->setRule('email','email','trim|required');
        $this->validation->setRule('password','password','trim|required');
        $this->validation->setRule('phone_code','phone_code','trim|required');
        $this->validation->setRule('phone','phone','trim|required');
        $this->validation->setRule('country','country','trim|required');
        $this->validation->setRule('category','Specialist Caegory','trim|required');
        $this->validation->setRule('subcategory','Specialist SubCategory','trim|required');
       

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $insert['first_name']= $this->request->getVar('first_name');
            $insert['last_name']= $this->request->getVar('last_name');
           
            $insert['email']= $this->request->getVar('email');
            $insert['password']= $this->request->getVar('password');
            $phoneCode = $this->request->getVar('phone_code');
            $phone = $insert['phone']= $this->request->getVar('phone');
            $insert['phone_withcode']= $phoneCode.$phone;
            $insert['country']= $this->request->getVar('country');
            $insert['user_type']= 1;
            $insert['is_verified']= 1;
            $insert['specialist_category']= $this->request->getVar('category');
            $insert['specialist_subcategory']= $this->request->getVar('subcategory');
            $insert['created_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->InsertData('users', $insert);
             $userData = $this->common_model->GetSingleData('users',array('id'=>$run));

            if($run)
            {  

              $subject="You are add as specialist by admin";    
              $body = '<p>Hello '. $userData['first_name'].' '. $userData['last_name'].'</p>';
              $body .= '<p>The following email is to inform you that your account has been added as a specialist.</p>';
              $body .= '<p>Login Detail: </p>';
              $body .= '<p>Email :'.$userData['email'].'</p>';
              $body .= '<p>Password :'.$userData['password'].'</p>';
              $send = $this->common_model->SendMail($userData['email'],$subject,$body);
            
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Specialist has been added successfully</div>');
                $output['message']='Specialist has been added successfully' ;
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
        $subcat = $this->common_model->GetAllData('specialist_category',array('parent'=>$category_id),'id','desc');
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
        $subcat = $this->common_model->GetAllData('specialist_category',array('parent'=>$category_id),'id','desc');
        ?>
        <option value="">Select SubCategory</option>
        <?php
        foreach($subcat as $value) {
        ?>
          <option value="<?php echo $value["id"];?>"><?php echo $value["title"];?></option>
        <?php
        }
    }

    public function editUser()
    {

        //echo "hello";
        $this->validation->setRule('first_name','first_name','trim|required');
        $this->validation->setRule('last_name','last_name','trim|required');
        $this->validation->setRule('email','email','trim|required');
        $this->validation->setRule('password','password','trim|required');
        $this->validation->setRule('phone_withcode','phone_withcode','trim|required');
        $this->validation->setRule('phone','phone','trim|required');
        $this->validation->setRule('country','country','trim|required');
        $this->validation->setRule('category','Specialist Caegory','trim|required');
        $this->validation->setRule('subcategory','Specialist SubCategory','trim|required');
       

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {

                $id = $this->request->getVar('id');
                $update['first_name']= $this->request->getVar('first_name');
                $update['last_name']= $this->request->getVar('last_name');
           
                $update['email']= $this->request->getVar('email');
                $update['password']= $this->request->getVar('password');
                $update['phone']= $this->request->getVar('phone');
                $update['phone_withcode']= $this->request->getVar('phone_withcode');
                $update['country']= $this->request->getVar('country');
                $update['specialist_category']= $this->request->getVar('category');
                $update['specialist_subcategory']= $this->request->getVar('subcategory');
                $update['updated_at']= date('Y-m-d H:i:s');
                
                $run = $this->common_model->UpdateData('users', array('id'=>$id) ,$update);

                if($run)
                {  
                 
                    $this->session->setFlashdata('msg', '<div class="alert alert-success">Specialist has been updated successfully</div>');
                    $output['message']='Specialist has been updated successfully' ;
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

    public function addMom()
    {
        //echo "hello";
        $this->validation->setRule('first_name','first_name','trim|required');
        $this->validation->setRule('last_name','last_name','trim|required');
        $this->validation->setRule('email','email','trim|required');
        $this->validation->setRule('password','password','trim|required');
        $this->validation->setRule('phone_code','phone_code','trim|required');
        $this->validation->setRule('phone','phone','trim|required');
        $this->validation->setRule('country','country','trim|required');
        $this->validation->setRule('birth_type','birth_type','trim|required');
       

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $insert['first_name']= $this->request->getVar('first_name');
            $insert['last_name']= $this->request->getVar('last_name');
           
            $insert['email']= $this->request->getVar('email');
            $insert['password']= $this->request->getVar('password');
            $phoneCode = $this->request->getVar('phone_code');
            $phone = $insert['phone']= $this->request->getVar('phone');
            $insert['phone_withcode']= $phoneCode.$phone;
            $insert['country']= $this->request->getVar('country');
            $insert['user_type']= 2;
            $insert['is_verified']= 1;
            $insert['birth_type_id']=$this->request->getVar('birth_type');
            $insert['created_at']= date('Y-m-d H:i:s');
            
             $run = $this->common_model->InsertData('users', $insert);
             //$userData = $this->common_model->GetSingleData('users',array('id'=>$run));

            if($run)
            {  

              $subject="Your account added as mom by admin";    
              $body = '<p>Hello '. $userData['first_name'].' '. $userData['last_name'].'</p>';
              $body .= '<p>The following email is to inform you that your account has been added as mom.</p>';
              $body .= '<p>Login Detail: </p>';
              $body .= '<p>Email :'.$userData['email'].'</p>';
              $body .= '<p>Password :'.$userData['password'].'</p>';
              $send = $this->common_model->SendMail($userData['email'],$subject,$body);
            
             
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Mom has been added successfully</div>');
                $output['message']='Mom has been added successfully' ;
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

    public function editMom()
    {

        //echo "hello";
        $this->validation->setRule('first_name','first_name','trim|required');
        $this->validation->setRule('last_name','last_name','trim|required');
        $this->validation->setRule('email','email','trim|required');
        $this->validation->setRule('password','password','trim|required');
        $this->validation->setRule('phone_withcode','phone_withcode','trim|required');
        $this->validation->setRule('phone','phone','trim|required');
        $this->validation->setRule('country','country','trim|required');
        $this->validation->setRule('birth_type','birth_type','trim|required');
       

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {

                $id = $this->request->getVar('id');
                $update['first_name']= $this->request->getVar('first_name');
                $update['last_name']= $this->request->getVar('last_name');
           
                $update['email']= $this->request->getVar('email');
                $update['password']= $this->request->getVar('password');
                $update['phone']= $this->request->getVar('phone');
                $update['phone_withcode']= $this->request->getVar('phone_withcode');
                $update['country']= $this->request->getVar('country');
                $update['birth_type_id']=$this->request->getVar('birth_type');
                $update['updated_at']= date('Y-m-d H:i:s');
                
                $run = $this->common_model->UpdateData('users', array('id'=>$id) ,$update);

                if($run)
                {  
                 
                    $this->session->setFlashdata('msg', '<div class="alert alert-success">Mom has been updated successfully</div>');
                    $output['message']='Mom has been updated successfully' ;
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

public function contact_list()
    {
        //echo $id;die;
        $data['contact_list'] = $this->common_model->GetAllData('contact_us','','id','desc');
        return view('admin/contact_list', $data);
    }
   
}