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

  	
  	

  	public function user_view($id)
    {
        //echo $id;die;
        $data['view'] = $this->common_model->GetSingleData('users',array('id'=>$id));
        $data['user_image'] = $this->common_model->GetAllData('user_images',array('user_id'=>$id));
       return view('admin/userview', $data);
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
                $this->session->setFlashdata('msgs','<div class="alert alert-success">User has been Blocked!!</div>');
            }else{
                $update['status']=1;
                $this->session->setFlashdata('msgs','<div class="alert "User has been Unblocked!!</div>');
            }   
            $run = $this->common_model->UpdateData('users',['id'=>$id], $update);
            if($run){
                $output['status']=1;
            }
          } else {
            $output['msgs']='<div class="alert alert-danger">Somthing wrong</div>';
            $output['status']=0;
        }

        echo json_encode($output);
    }


    public function deleteUser() {        
        
        $id = $_POST['id'];
        $run = $this->common_model->DeleteData('users', array('id'=> $id));
        if ($run) {
            $json['message'] = 'Success! User has been Deleted successfully';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }

   
}