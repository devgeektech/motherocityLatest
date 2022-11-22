<?php
namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Common_model;
use App\Models\Send_sms;
use CodeIgniter\HTTP\RequestInterface;
// use App\Controllers\API\User_detail;
header("Access-Control-Allow-Origin: *");

class Users extends ResourceController {
	
	use ResponseTrait;
	protected $req;
	// get all product
	protected $validation = null;
	
	public function __construct()
	{
		$this->common_model = new Common_model();
		$this->common_model = new Common_model();
		$this->Send_sms = new Send_sms();
		$this->format = 'json';
		$this->validation = \Config\Services::validation();
		$this->db      = \Config\Database::connect();
		$this->req = \Config\Services::request()->getVar();
	}

	public function getExperties() {
		//https://www.webwiders.com/WEB01/Motherocity/api/get-experties
		$row = $this->common_model->GetAllData('specialist_category','','id','desc');
			if($row){
				$result = array();
					foreach($row as $key => $value){
						array_push($result, $value);
					}
					$output['status']= 1; 
					$output['message']='success';
					$output['data']=$result;
			}else{
				    $output['message']='Something Went wrong';
					$output['status']= 0; 
			}
		
		return $this->respond($output);
	}
	public function get_nutrition_category() {
		//https://www.webwiders.com/WEB01/Motherocity/api/get-nutrition-category
		$row = $this->common_model->GetAllData('nutrition_category','','id','desc');
			if($row){
				$result = array();
					foreach($row as $key => $value){
						array_push($result, $value);
					}
					$output['status']= 1; 
					$output['message']='success';
					$output['data']=$result;
			}else{
				    $output['message']='Something Went wrong';
					$output['status']= 0; 
			}
		
		return $this->respond($output);
	}
	public function get_contentBlog_category() {
		//https://www.webwiders.com/WEB01/Motherocity/api/get-contentblog-category
		$row = $this->common_model->GetAllData('content_blog','','id','desc');
			if($row){
				$result = array();
					foreach($row as $key => $value){
						array_push($result, $value);
					}
					$output['status']= 1; 
					$output['message']='success';
					$output['data']=$result;
			}else{
				    $output['message']='Something Went wrong';
					$output['status']= 0; 
			}
		
		return $this->respond($output);
	}

	public function get_toolkit_category() {
		//https://www.webwiders.com/WEB01/Motherocity/api/get-toolkit-category
		$row = $this->common_model->GetAllData('toolkit','','id','desc');
			if($row){
				$result = array();
					foreach($row as $key => $value){
						array_push($result, $value);
					}
					$output['status']= 1; 
					$output['message']='success';
					$output['data']=$result;
			}else{
				    $output['message']='Something Went wrong';
					$output['status']= 0; 
			}
		
		return $this->respond($output);
	}

	public function get_content_category() {
		//https://www.webwiders.com/WEB01/Motherocity/api/get-content-category
		$row = $this->common_model->GetAllData('content','','id','desc');
			if($row){
				$result = array();
					foreach($row as $key => $value){
						$value['image'] = base_url().'/'.$value['image'] ;

						 array_push($result, $value);
				   }
					$output['status']= 1; 
					$output['message']='success';
					$output['data']=$result;
			}else{
				    $output['message']='Something Went wrong';
					$output['status']= 0; 
			}
		
		return $this->respond($output);
	}

	public function oldsignup() { 
		//https://www.webwiders.com/WEB01/Motherocity/api/signup
		$this->validation->setRule('first_name','First name','trim|required');
		$this->validation->setRule('last_name','Last name','trim|required');
		$this->validation->setRule('email','Email','trim|required|is_unique[users.email]');
		$this->validation->setRule('password','Password','trim|required');
		$this->validation->setRule('phone','Phone number','trim|required|is_unique[users.phone]');
		$this->validation->setRule('phone_withcode','Phone with code','trim|required|is_unique[users.phone_withcode]');
		$this->validation->setRule('user_type','User Type','trim|required');
		$this->validation->setRule('country','Country','trim|required');
		

		if($this->validation->withRequest($this->request)->run()==false) {
	   
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}
		
		$insertData['first_name']=$this->request->getVar('first_name');
		$insertData['last_name']=$this->request->getVar('last_name');
		$insertData['email']=$this->request->getVar('email');
		$insertData['password']=$this->request->getVar('password');
		$insertData['country']=$this->request->getVar('country');
		$insertData['phone'] = $this->request->getVar('phone');
		$phone = $insertData['phone_withcode'] = $this->request->getVar('phone_withcode');
		$user_type = $insertData['user_type'] = $this->request->getVar('user_type');
		$insertData['is_phone_verified'] = 0;
		$insertData['is_verified'] = 0;
		$insertData['token'] = md5(rand());
		$update['otp'] = $otp = rand(1000, 9999);
		$insertData['created_at'] = date('Y-m-d H:i:s');

		if($user_type == 1){

			$this->validation->setRule('your_expertise','your_expertise','trim|required');
			$this->validation->setRule('your_speciality','your_speciality','trim|required');
			$this->validation->setRule('year_experience','year_experience','trim|required');
			$this->validation->setRule('office_hours','office_hours','trim|required');
			$this->validation->setRule('fees','fees','trim|required');
			$this->validation->setRule('insurance','insurance','trim|required');

			if($this->validation->withRequest($this->request)->run()==false) {
	   
				$output['errors']=$this->validation->getErrors();
				$output['message']='check parameters';
				$output['status']= 2;     
				return $this->respond($output);
		  	}else{
		  	//$insertData['office_area'] = $this->request->getVar('office_area');
				$insertData['your_expertise'] = $this->request->getVar('your_expertise');
				$insertData['your_speciality'] = $this->request->getVar('your_speciality');
				$insertData['year_experience'] = $this->request->getVar('year_experience');
				$insertData['office_hours'] = $this->request->getVar('office_hours');
				$insertData['fees'] = $this->request->getVar('fees');
				$insertData['insurance'] = $this->request->getVar('insurance');
		  	}
		}elseif($user_type == 2){
		  	//$insertData['office_area'] = $this->request->getVar('office_area');
			$insertData['birth_type_id'] = $this->request->getVar('birth_type_id');
		}
		
		
		/*if(isset($_POST['content_ids'])){
			$insertData['content_ids'] = $this->request->getVar('content_ids');
		}*/
		
		$run = $this->common_model->insertData('users', $insertData);
		if($run) {
			
			$msg = $otp.' is your One Time Motherocity code. Do not share the otp with anyone. ';
			$send = $this->Send_sms->send($phone,$msg);
			
			$this->common_model->UpdateData('users',array('id'=>$run),$update);
			
			$output['data'] = $this->UserData($run);
			$output['message']='Your account hass been created successfully.';
			$output['status']= 1 ;
		} else {
			$output['message']='something went wrong';
			$output['status']= 0 ;
		}
	    
		return $this->respond($output);
	}

	/*private function generatePIN($digits = 4){
		$pin =random_string('numeric', $digits);
        return $pin;
	}
	*/

	public function signup_otp() { 
		//https://www.webwiders.com/WEB01/Motherocity/api/signup_otp
		/*
	email:ameen.webwiders@gmail.com
password:123456
phonecode:+91
phone:9200293078
user_type:2
lang:en
		*/
		$this->validation->setRule('email','Email','trim|required');
		$this->validation->setRule('password','Password','trim|required');
		$this->validation->setRule('phonecode','phonecode','trim|required');
		$this->validation->setRule('phone','Phone number','trim|required');
		$this->validation->setRule('user_type','User type','trim|required');
		$this->validation->setRule('lang','lang','trim|required');
		
		if($this->validation->withRequest($this->request)->run()==false) {
	   
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
			exit();
		}
		$insertData['email'] = $email = $this->request->getVar('email');
	    $phonecode = $this->request->getVar('phonecode');
		$phone = $phonecode.$insertData['phone'] = $this->request->getVar('phone');

		$run = $this->common_model->GetSingleData('users', "phone = $phone or email = '".$email."'");
		
		if ($run && $run["is_profile_complete"] == 1) {
			$output['message']='email or phone already exist';
			$output['status']= 0;     
			return $this->respond($output);
			exit();
		}
		$insertData['phone_withcode'] = $phone;
		$insertData['user_type']=$this->request->getVar('user_type');
		$insertData['password']=$this->request->getVar('password');
		$insertData['lang'] = $this->request->getVar('lang');
		$insertData['otp'] = $otp = rand(1000, 9999);
		//$insertData['otp'] = $otp = 1234;
		$msg = $otp.' is your One Time Motherocity code. Do not share the otp with anyone. ';

		$phone = "+917901893457";
		$send = $this->Send_sms->send($phone,$msg);
		
		$run = $this->common_model->InsertData('users', $insertData);

		if($run) {
			//$send = $this->Send_sms->send($phone,$otp);			
			$output['data'] = $this->UserData($run);
			$output['status']= 1;
			$output['message']= 'Otp send successfully';
		} else {
			$output['status']= 0;
			$output['message']= 'something went wrong';
		} 
			return $this->respond($output);
			exit();
   }
  

  public function signup() { 
		//https://www.webwiders.com/WEB01/Motherocity/api/signup
  	/*your_website:m  k
few_word:jbj
primary_contact:Whatsap
name:Manih
user_type:1
lat:3.081826
lng:101.676613
your_expertise:1
your_speciality:4
user_id:66
fees:85
certification:hvk
insurance:Ye
year_experience:3
office_hours:jyvvu*/
		
		$this->validation->setRule('user_id','User Id','trim|required');
		
		if($this->validation->withRequest($this->request)->run()==false) {
	   
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}

		$user_id = $this->request->getVar('user_id');
		$check = $this->common_model->GetSingleData('users',array('id'=>$user_id),'id','desc');
        //print_r($check);die;

		if($check){
					$insertData['lat'] = $this->request->getVar('lat');
					$insertData['lng'] = $this->request->getVar('lng');
			  		$insertData['name'] = $this->request->getVar('name');
           if($check['user_type'] == 1){
				/*$this->validation->setRule('name','name','trim|required');
				$this->validation->setRule('office_area','office_area','trim|required');
				$this->validation->setRule('your_expertise','your_expertise','trim|required');
				$this->validation->setRule('your_speciality','your_speciality','trim|required');
				$this->validation->setRule('year_experience','year_experience','trim|required');
				$this->validation->setRule('office_hours','office_hours','trim|required');
				$this->validation->setRule('fees','fees','trim|required');
				$this->validation->setRule('insurance','insurance','trim|required');
				$this->validation->setRule('your_website','your_website','trim|required');
				$this->validation->setRule('primary_contact','primary_contact','trim|required');
				$this->validation->setRule('few_word','few_word','trim|required');*/

				 
			  		$insertData['office_area'] = $this->request->getVar('office_area');
					$insertData['your_expertise'] = $this->request->getVar('your_expertise');
					$insertData['your_speciality'] = $this->request->getVar('your_speciality');
					$insertData['year_experience'] = $this->request->getVar('year_experience');
					$insertData['office_hours'] = $this->request->getVar('office_hours');
					$insertData['fees'] = $this->request->getVar('fees');
					$insertData['insurance'] = $this->request->getVar('insurance');
					$insertData['your_website'] = $this->request->getVar('your_website');
					$insertData['primary_contact'] = $this->request->getVar('primary_contact');
					$insertData['few_word'] = $this->request->getVar('few_word');
					$insertData['office_days'] = $this->request->getVar('office_days');
					$insertData['certification'] = $this->request->getVar('certification');
					$insertData['is_phone_verified'] = 1;
		            $insertData['token'] = md5(rand());
		            if(!empty($_FILES['profile_image']['name'])) {
		                    $newName = explode('.',$_FILES['profile_image']['name']);
		                    $ext = end($newName);
		                    $fileName = 'assets/profile_image/'.rand().time().'.'.$ext;
		                    move_uploaded_file($_FILES['profile_image']['tmp_name'], $fileName);
		                    $insertData['profile_image']= $fileName ; 
		               } else {
		               	$insertData['profile_image'] = $this->request->getVar('profile_image');
		               }
			  	 
			} elseif ($check['user_type'] == 2){ 

					$insertData['why_should_call'] = $this->request->getVar('why_should_call');
					$insertData['profile_type'] = $this->request->getVar('profile_type');
					$insertData['is_phone_verified'] = 1;
		            $insertData['is_verified'] = 1;								
			  		$insertData['residency'] = $this->request->getVar('residency');
					$insertData['delivery_date'] = $this->request->getVar('delivery_date');
					$insertData['was_your_birth'] = $this->request->getVar('was_your_birth');
					$insertData['via_baby_born'] = $this->request->getVar('via_baby_born');
 					$insertData['week_start_date'] = date('Y-m-d');
 					if(!empty($_FILES['profile_image']['name'])) {
		                    $newName = explode('.',$_FILES['profile_image']['name']);
		                    $ext = end($newName);
		                    $fileName = 'assets/profile_image/'.rand().time().'.'.$ext;
		                    move_uploaded_file($_FILES['profile_image']['tmp_name'], $fileName);
		                    $insertData['profile_image']= $fileName ; 
		               } else {
		               	$insertData['profile_image'] = $this->request->getVar('profile_image');
		               }
 			}
					$insertData['is_profile_complete'] = 1;
					$insertData['created_at'] = date('Y-m-d H:i:s');
					//echo "<pre>";
					//print_r($insertData);
				$run = $this->common_model->UpdateData('users',array('id'=>$user_id), $insertData);
				
			      if($run) {
						
						$output['data'] =  $this->UserData($user_id);
						$output['message']='Your account hass been created successfully.';
						$output['status']= 1 ;
					} else {
						$output['message']='something went wrong';
						$output['status']= 0 ;
					}

		} else{
			$output['message']='user detail not available';
			$output['status']= 0 ;
        }
		
		  return $this->respond($output);
	}

	public function isVerified() {
		//https://www.webwiders.com/WEB01/Motherocity/api/is-verified
		$this->validation->setRule('user_id','User ID','trim|required');
		$this->validation->setRule('otp','Otp','trim|required');

		if($this->validation->withRequest($this->request)->run()==false) {
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
			exit();
		}
		
		$user_id = $this->request->getVar('user_id');
		$otp = $this->request->getVar('otp');
		
		$data = $this->common_model->GetColumnName('users', array('id'=>$user_id,'otp'=>$otp),array('id','otp'));
		//echo $this->db->GetLastQuery();
		//print_r($data);die;
		if($data->otp==$otp){
				
					$update['is_phone_verified'] = 1;
					$update['otp'] = NULL;
					$this->common_model->UpdateData('users',array('id'=>$user_id),$update);
					//$output['data'] = $this->UserData($data->id);
					$output['message']='Verified successfully';
					$output['status']= 1 ;
			
			
		 } else {
			$output['message']='Invalid Otp';
			$output['status']= 0 ;
		}
	    
		return $this->respond($output);
	}

	public function resetPassword() {
		 //https://www.webwiders.com/WEB01/Motherocity/api/reset-password
		$this->validation->setRule('user_id','User ID','trim|required');
		$this->validation->setRule('otp','Otp','trim|required');
		$this->validation->setRule('confirm_password','confirm_password','trim|required');
		$this->validation->setRule('new_password','new_password','trim|required');

		if($this->validation->withRequest($this->request)->run()==false) {
			//$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
			exit();
		}
		$new_password = $this->request->getVar('new_password');
		$confirm_password = $this->request->getVar('confirm_password');

		if ($new_password != $confirm_password) {
			$output['message']='confirm and new password are not same';
			$output['status']= 2;     
			return $this->respond($output);
			exit(); 
		}
		
		$user_id = $this->request->getVar('user_id');
		$otp = $this->request->getVar('otp');
		
		$data = $this->common_model->GetColumnName('users', array('id'=>$user_id,'otp'=>$otp),array('id','otp'));
		//echo $this->db->GetLastQuery();
		//print_r($data);die;
		if($data->otp==$otp){

					$update['otp'] = NULL;
					$update['password'] = $new_password;
					$this->common_model->UpdateData('users',array('id'=>$user_id),$update);
					//$output['data'] = $this->UserData($data->id);
					$output['message']='success';
					$output['status']= 1 ;
			
			
		 } else {
			$output['message']='Invalid Otp';
			$output['status']= 0 ;
		}
	    
		return $this->respond($output);
	}

	public function check_email() {
		//https://www.webwiders.com/WEB01/Motherocity/api/check-email
		$this->validation->setRule('email', 'Email', 'required|valid_email');
					
		if($this->validation->withRequest($this->request)->run()==false) {
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}
				
		$email = $this->request->getVar('email');
		$run = $this->common_model->GetSingleData('users', array('email' => $email));
		
		if ($run) {
			$response['status'] = 0;
			$response['message'] = 'Email already exist.';
		} else {
			$response['status'] = 1;
			$response['message'] = 'Email Does not exist.';
		} 
		 
		return $this->respond($response);
	}

	public function check_phone() {
		//https://www.webwiders.com/WEB01/Motherocity/api/check-phone
		$this->validation->setRule('phone', 'Phone', 'required');
					
		if($this->validation->withRequest($this->request)->run()==false) {
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}
				
		$phone = $this->request->getVar('phone');
		$run = $this->common_model->GetSingleData('users', array('phone' => $phone));
		
		if ($run && !empty($run["name"])) {
			$response['status'] = 0;
			$response['message'] = 'Phone already exist.';
		} else {
			$response['status'] = 1;
			$response['message'] = 'Phone Does not exist.';
		} 
		 
		return $this->respond($response);
	}
	
	public function edit_profile() { 
		//https://www.webwiders.com/WEB01/Motherocity/api/edit-profile
		$this->validation->setRule('user_id','user_id','trim|required');

		if($this->validation->withRequest($this->request)->run()==false) {
	   
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}
		
		$user_id = $this->request->getVar('user_id');
		if(isset($_POST['name'])){
			
			$insertData['name'] = $this->request->getVar('name');
		} 

		if(isset($_POST['email'])){
			$insertData['email'] = $this->request->getVar('email');
		}
		
		if(isset($_POST['phone'])){
			$insertData['phone'] = $this->request->getVar('phone');
		}
		if(isset($_POST['phone_withcode'])){
			$insertData['phone_withcode'] = $this->request->getVar('phone_withcode');
		}

		if(isset($_POST['is_deactive'])){
			$insertData['is_deactive'] = $this->request->getVar('is_deactive');
		}
		if(isset($_POST['is_delete'])){
			$insertData['is_delete'] = $this->request->getVar('is_delete');
		}

		if(isset($_POST['office_days'])){
			$insertData['office_days'] = $this->request->getVar('office_days');
		}

	   	if(isset($_POST['country'])){
			$insertData['country'] = $this->request->getVar('country');
		}
		if(isset($_POST['your_expertise'])){
			$insertData['your_expertise'] = $this->request->getVar('your_expertise');
		}
		if(isset($_POST['your_speciality'])){
			$insertData['your_speciality'] = $this->request->getVar('your_speciality');
		}
		if(isset($_POST['year_experience'])){
			$insertData['year_experience'] = $this->request->getVar('year_experience');
		}
		if(isset($_POST['office_hours'])){
			$insertData['office_hours'] = $this->request->getVar('office_hours');
		}
		if(isset($_POST['fees'])){
			$insertData['fees'] = $this->request->getVar('fees');
		}
		if(isset($_POST['insurance'])){
			$insertData['insurance'] = $this->request->getVar('insurance');
		}

		if(isset($_POST['residency'])){
			$insertData['residency'] = $this->request->getVar('residency');
		}
		
		if(isset($_POST['profile_type'])){
			$insertData['profile_type'] = $this->request->getVar('profile_type');
		}

		if(isset($_POST['delivery_date'])){
			$insertData['delivery_date'] = $this->request->getVar('delivery_date');
		} 

		if(isset($_POST['was_your_birth'])){
			$insertData['was_your_birth'] = $this->request->getVar('was_your_birth');
		} 

		if(isset($_POST['via_baby_born'])){
			$insertData['via_baby_born'] = $this->request->getVar('via_baby_born');
		}

		if(isset($_POST['why_should_call'])){
			$insertData['why_should_call'] = $this->request->getVar('why_should_call');
		}  
		  
		$insertData['updated_at'] = date('Y-m-d H:i:s');

		$run = $this->common_model->UpdateData('users',array('id'=>$user_id), $insertData);
		if($run) {
			$output['data'] = $this->UserData($user_id);
			$output['message']='Profile updated';
			$output['status']= 1 ;
		} else {
			$output['message']='something went wrong';
			$output['status']= 0 ;
		}
	    
		return $this->respond($output);
	}
	
	public function login() {
		//https://www.webwiders.com/WEB01/Motherocity/api/login
		$this->validation->setRule('email','Email','trim|required');
		$this->validation->setRule('password','Password','trim|required');

		if($this->validation->withRequest($this->request)->run()==false) {
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}
		
		$where['password']=$this->request->getVar('password');
		$where['email'] = $this->request->getVar('email');
		

		$data = $this->common_model->GetColumnName('users', $where,array('id','is_phone_verified, is_verified, is_delete'));
		//print_r($data);
		if($data) {
				if($data->is_phone_verified==1 && $data->is_delete==0 && $data->is_verified==1){
					$output['data'] = $this->UserData($data->id);
					$output['message']='login successfully';
					$output['status']= 1 ;
				  } else if ($data->is_delete==1) {
				  		$output['message']='Your account has been deleted';
						$output['status']= 0;
				  } else if ($data->is_verified==0) {
				  		$output['data'] = $this->UserData($data->id);
				  		$output['message']='Your account pending for approval';
						$output['status']= 1;
				  } else {
						$output['message']='Your account has been blocked by admin';
						$output['status']= 0;
				  }
			
		} else {
			$output['message']='Invalid login details';
			$output['status']= 0 ;
		}
	    
		return $this->respond($output);
	}
	
	public function contact_us_category(){ 
		//https://www.webwiders.com/WEB01/Motherocity/api/contact-us-category
		$run = $this->common_model->GetAllData("contact_us_category");
		$output['data']= $run;
		$output['message']='success';
		$output['status']=1;
		return $this->respond($output);

	}
	public function get_user_by_id() {
		//https://www.webwiders.com/WEB01/Motherocity/api/get-user-by-id?user_id=8
		$this->validation->setRule('user_id','User ID','trim|required');		
		if($this->validation->withRequest($this->request)->run()==false) {
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;
			return $this->respond($output);
			exit();
		}
		
		$user_id = $this->request->getVar('user_id');
		
		$data = $this->common_model->GetColumnName('users', array('id'=>$user_id),array('id','birth_type_id','created_at','user_type'));
		//print_r($data);
		if($data) {
			   
			    $output['data'] = $this->UserData($data->id);		
			
			/*if($data->user_type == 2){	

			 $milestone_data = array();			
			 $birth_type = $this->common_model->GetSingleData('birth_type', array('id'=>$data->birth_type_id));
		   
		     $current_date = date('d-M-Y');			
		     $milestone_data['birth_type'] = $birth_type['title'];			
		     $stage_1_complete =  date('d-M-Y',strtotime('+30 days',strtotime($data->created_at)));
	         $stage_2_complete =  date('d-M-Y',strtotime('+90 days',strtotime($data->created_at)));
	         $stage_3_complete =  date('d-M-Y',strtotime('+180 days',strtotime($data->created_at)));
	         $stage_4_complete =  date('d-M-Y',strtotime('+270 days',strtotime($data->created_at)));	         $milestone_data['delivery_date'] = date('d-M-Y',strtotime($data->created_at));
	        
	         if(strtotime($current_date)>=strtotime($stage_1_complete))
	         {
	          $milestone_data['stage_1'] =  $stage_1_complete;
	         }
	         if(strtotime($current_date)>=strtotime($stage_2_complete))
	         {
	           $milestone_data['stage_2'] =  $stage_2_complete;
	         }
	         if(strtotime($current_date)>=strtotime($stage_3_complete))
	         {
	           $milestone_data['stage_3'] =  $stage_3_complete;
	         }
	         if(strtotime($current_date)>=strtotime($stage_3_complete))
	         {
	           $milestone_data['stage_4'] = $stage_4_complete;

	         }	  
	                $output['data']['milestone'] = $milestone_data;
	    }*/
	    		$output['message']='Success';
				$output['status']= 1 ;
		} else {
			$output['message']='Invalid User ID';
			$output['status']= 0 ;
		}
	   
		return $this->respond($output);
	}

	public function homeScreenContent() {
	 //https://www.webwiders.com/WEB01/Motherocity/api/home-screen?user_id=3
		if (isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])) {
			 $user_id = $_REQUEST['user_id'];
			$run = $this->common_model->GetSingleData("users", array("id"=>$user_id, "user_type"=>2));
			if ($run) {
				$current_date = date('Y-m-d');
				$val["current_week"] = $run["current_week"];
				$val["week_start_date"] = $run["week_start_date"];
				$val["week_end_date"] =  date('Y-m-d', strtotime($val["week_start_date"]. '+ 6 days'));

				if ($current_date >= date('Y-m-d', strtotime($val["week_end_date"]. '+ 1 days'))) {
					 $update['current_week'] = $val["current_week"]+1;
					 $update['week_start_date'] = $current_date;
					 $this->common_model->UpdateData("users", array("id"=>$user_id), $update);
					$run = $this->common_model->GetSingleData("users", array("id"=>$user_id, "user_type"=>2));
					$val["current_week"] = $run["current_week"];
					$val["week_start_date"] = $run["week_start_date"];
					$val["week_end_date"] =  date('Y-m-d', strtotime($val["week_start_date"]. '+ 6 days'));
				}

				$where = "1=1";
				if (isset($_REQUEST['tip_date']) && !empty($_REQUEST['tip_date'])) {
					$tip_date = $_REQUEST['tip_date']; 
					$where .= " and tips_date = '".$tip_date."'";
				}  
				$tip = $this->common_model->GetSingleData("tips_management", $where, "id", "desc");
				if ($tip) {
				 	$val["tip_of_the_day"] = $tip;
				 } else {
				 	$val["tip_of_the_day"] = array();					 	
				 }

 				$output['data']= $val;
				$output['message']='success';
				$output['status']= 1;				 
			} else {
				$output['message']='No record';
				$output['status']= 0;
			}


		} else {
			$output['message']='check parameters';
			$output['status']= 0;
		}
	   
		return $this->respond($output);
	}

	public function getAllTips() {
		//https://www.webwiders.com/WEB01/Motherocity/api/get-all-tips
		$run = $this->common_model->GetAllData("tips_management", array(), "id", "desc");

		if ($run) {

			 $output['data']= $run;
			 $output['message']='No record';
			 $output['status']= 0;
		} else {
			$output['message']='No record';
			$output['status']= 0;
		}
	   
		return $this->respond($output);
	}


	public function getBlogsForHome() {
		//https://www.webwiders.com/WEB01/Motherocity/api/get-blogs-for-home
		//normal blog
		$normal_blog = $this->common_model->GetAllData("blog_management", array("blog_type"=>0), "id", "desc");
		$primary_blog = $this->common_model->GetAllData("blog_management", array("blog_type"=>1), "id", "desc");
		$secondary_blog = $this->common_model->GetAllData("blog_management", array("blog_type"=>2), "id", "desc");
		$home_picked_blog = $this->common_model->GetAllData("blog_management", array("blog_type"=>3), "id", "desc");
		$result = array();
		$result1 = array();
		$result2 = array();
		$result3 = array();
		$result4 = array();

		if ($normal_blog) {
			foreach ($normal_blog as $key => $value) {
				$value["category"] = $this->common_model->GetSingleData("content_blog", array("id"=>$value["category"]));
				$value["sub_category"] = $this->common_model->GetSingleData("content_blog", array("id"=>$value["subcategory"]));
				$result1[$key] = $value;
				 
			}
		} 


		if ($primary_blog) {
			foreach ($primary_blog as $key1 => $value1) {
				$value1["category"] = $this->common_model->GetSingleData("content_blog", array("id"=>$value1["category"]));
				$value1["sub_category"] = $this->common_model->GetSingleData("content_blog", array("id"=>$value1["subcategory"]));
				$result2[$key1] = $value1;				 
			}
		} 


		if ($secondary_blog) {
			foreach ($secondary_blog as $key2 => $value2) {
				$value2["category"] = $this->common_model->GetSingleData("content_blog", array("id"=>$value2["category"]));
				$value2["sub_category"] = $this->common_model->GetSingleData("content_blog", array("id"=>$value2["subcategory"]));
				$result3[$key2] = $value2;
				 
			}
		} 

		if ($home_picked_blog) {
			foreach ($home_picked_blog as $key3 => $value3) {
				$value3["category"] = $this->common_model->GetSingleData("content_blog", array("id"=>$value3["category"]));
				$value3["sub_category"] = $this->common_model->GetSingleData("content_blog", array("id"=>$value3["subcategory"]));
				$result4[$key3] = $value3;				 
			}
		} 
	   		$result["normal_blog"] = $result1;
	   		$result["primary_blog"] = $result2;
	   		$result["secondary_blog"] = $result3;
	   		$result["home_picked_blog"] = $result4;
	   		 $output['data']= $result;
			 $output['message']='success';
			 $output['status']= 1;
		return $this->respond($output);
	}
	
	public function interval_api() {
		//https://www.webwiders.com/WEB01/Motherocity/api/interval
		$this->validation->setRule('user_id','User ID','trim|required');

		if($this->validation->withRequest($this->request)->run()==false) {
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}
		
		$user_id = $this->request->getVar('user_id');
		
		$data = $this->common_model->GetColumnName('users', array('id'=>$user_id),array('id','is_phone_verified','is_verified'));
		//print_r($data);
		if($data) {
			$output['data'] = $data;
			$output['message']='Success';
			$output['status']= 1 ;
		} else {
			$output['message']='Invalid User ID';
			$output['status']= 0 ;
		}
	    
		return $this->respond($output);
	}
	
	private function UserData($id) {
    	$run = $this->common_model->GetSingleData('users', array('id'=>$id));
    	if($run) {
    		$user['id'] = $run['id'];
    		$user['name'] = $run['name'];
    		$user['email'] = $run['email'];
    		//$user['password'] = $run['password'];
    		$user['country'] = $run['country'];
    		$user['phone'] = $run['phone'];
    		//echo $run['profile_image'];
    		//echo strpos($run['profile_image'], "dummyimage");
				if(strpos($run['profile_image'], "dummyimage")){
					$user['profile_image'] = $run['profile_image'];					
				} else {
					$user['profile_image'] = base_url('assets/profile_image/dummy-profile-pic.png');
					if ($run['image']) {
						$user['profile_image'] = base_url($run['profile_image']);
					}
				}  
    		$user['status'] = $run['status'];
    		$user['phone_withcode'] = $run['phone_withcode'];
    		$user['is_phone_verified'] = $run['is_phone_verified'];
    		$user['is_verified'] = $run['is_verified'];
    		$user['user_type'] = $run['user_type'];
    		$user['token'] = $run['token'];
    		$user['otp'] = $run['otp'];
    		$user['is_deactive'] = $run['is_deactive'];
    		$user['is_delete'] = $run['is_delete'];
 			
 			$user['plan_id'] = $run['plan_id'];
				if ($user['plan_id'] != 0) {
					$user['plan_data'] = $this->common_model->GetSingleData("transaction", array("user_id"=>$id, "plan_id"=>$run['plan_id']), "id", "desc");
				}
				
     		if($user['user_type'] == 1){
    			$user['primary_contact'] = $run['primary_contact'];
    			$user['office_area'] = $run['office_area'];
				$user['your_expertise'] = $run['your_expertise'];
				$user['your_speciality'] = $run['your_speciality'];
				$user['certification'] = $run['certification'];

    			$your_expertise = $this->common_model->GetSingleData("specialist_category", array("id"=>$run['your_expertise']));
    			if ($your_expertise) {
    				$user['your_expertise'] = $your_expertise;
    			}
				 $your_speciality = $this->common_model->GetSingleData("specialist_category", array("id"=>$run['your_speciality']));
				if ($your_speciality) {
					 $user['your_speciality'] = $your_speciality;
				}


				$user['year_experience'] = $run['year_experience'];
    			$user['your_website'] = $run['your_website'];
				$user['office_hours'] = $run['office_hours'];
				$user['fees'] = $run['fees'];
				$user['insurance'] = $run['insurance'];
				$user['few_word'] = $run['few_word'];
				$user['lat'] = $run['lat'];
				$user['lng'] = $run['lng'];
				$user['office_days'] = $run['office_days'];							
    		} else {
				$user['why_should_call'] = $run['why_should_call'];
				$user['residency'] = $run['residency'];
				$user['delivery_date'] = $run['delivery_date'];    			    		
				$user['was_your_birth'] = $run['was_your_birth'];    			    		
				$user['via_baby_born'] = $run['via_baby_born'];    			    		
				$user['created_at'] = $run['created_at'];    			    		
    		}
    		
    	}
    	return $user;
    }

    public function privacyPolicy() { 
    	//https://www.webwiders.com/WEB01/Motherocity/api/privacy-policy
    	$run = $this->common_model->GetSingleData("content_management", array("id"=>1));
    	$response['data'] = $run;
    	$response['status'] = 1;
		$response['message'] = "success"; 		 
		return $this->respond($response);
    }

    public function termsConditions() { 
    	//https://www.webwiders.com/WEB01/Motherocity/api/terms-conditions
    	$run = $this->common_model->GetSingleData("content_management", array("id"=>3));
    	$response['data'] = $run;
    	$response['status'] = 1;
		$response['message'] = "success"; 		 
		return $this->respond($response);
    }

    public function aboutUs() { 
    	//https://www.webwiders.com/WEB01/Motherocity/api/about
    	$run = $this->common_model->GetSingleData("content_management", array("id"=>2));
    	$response['data'] = $run;
    	$response['status'] = 1;
		$response['message'] = "success"; 		 
		return $this->respond($response);
    }


    public function why() { 
    	//https://www.webwiders.com/WEB01/Motherocity/api/why
    	$run = $this->common_model->GetSingleData("content_management", array("id"=>4));
    	$response['data'] = $run;
    	$response['status'] = 1;
		$response['message'] = "success"; 		 
		return $this->respond($response);
    }


    public function what() { 
    	//https://www.webwiders.com/WEB01/Motherocity/api/what
    	$run = $this->common_model->GetSingleData("content_management", array("id"=>5));
    	$response['data'] = $run;
    	$response['status'] = 1;
		$response['message'] = "success"; 		 
		return $this->respond($response);
    }

    public function who() { 
    	//https://www.webwiders.com/WEB01/Motherocity/api/who
    	$run = $this->common_model->GetSingleData("content_management", array("id"=>6));
    	$response['data'] = $run;
    	$response['status'] = 1;
		$response['message'] = "success"; 		 
		return $this->respond($response);
    }

    public function faq_category() {
    	//https://www.webwiders.com/WEB01/Motherocity/api/faq-category-list
    	$run = $this->common_model->GetAllData("faq_category", array(), "id", "desc");
    	$response['data'] = $run;
    	$response['status'] = 1;
		$response['message'] = "success"; 		 
		return $this->respond($response);
    }

    public function faqsManagement() {
    	//https://www.webwiders.com/WEB01/Motherocity/api/faq
    	 if (isset($_REQUEST['user_type']) && !empty($_REQUEST['user_type'])) {
				$user_type = $_REQUEST['user_type'];

			$where = "1=1";
			if (isset($_REQUEST['category_id']) && !empty($_REQUEST['category_id'])) {
				$category_id = $_REQUEST['category_id'];
 				$where .= " and category = '".$category_id."'"; 
			}
    	 	if ($user_type == 1) {
    	 		$where .= " and (faq_about = 'Specialist' or faq_about = 'Both')"; 	 	
    	 	} else if ($user_type == 2) {
    	 		$where .= " and (faq_about = 'Mom' or faq_about = 'Both')";
    	 	}  
    	 	
    	 	$run = $this->common_model->GetAllData("faqs_management", $where, "id", "desc");
    	 	if ($run) {
    	 		$run1 = $this->common_model->GetSingleData("faq_category", array("id"=>$category_id));

				$response['data'] = $run;
				$response['category_data'] = $run1;
				$response['status'] = 1;
				$response['message'] = "success";     	 	 
    	 	} else {
    	 		$response['status'] = 0;
				$response['message'] = "No record";
    	 	}
    	 } else {
			$response['status'] = 0;
			$response['message'] = "Check parameter"; 
    	 }
		return $this->respond($response);

    }

    public function addtoFavorite() {
    	 //https://www.webwiders.com/WEB01/Motherocity/api/addto-favorite
    	 if (isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])
    	 	&& isset($_REQUEST['type']) && !empty($_REQUEST['type'])
    	 	&& isset($_REQUEST['item_id']) && !empty($_REQUEST['item_id'])) {
			
			$insert["user_id"] = $_REQUEST['user_id'];
			$insert["type"] = $_REQUEST['type'];
			$insert["item_id"] = $_REQUEST['item_id']; 
    	 	$insert["created_at"] = date("Y-m-d H:s:i");
    	 	$run = $this->common_model->InsertData("my_favorite", $insert);
    	 	if ($run) {
				$response['status'] = 1;
				$response['message'] = "success";     	 	 
    	 	} else {
    	 		$response['status'] = 0;
				$response['message'] = "No record";
    	 	}
    	 } else {
			$response['status'] = 0;
			$response['message'] = "Check parameter"; 
    	 }
		return $this->respond($response);
    }



     public function myFavoriteList() {
    	 //https://www.webwiders.com/WEB01/Motherocity/api/myfavorite-list
    	 if (isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])
    	 	&& isset($_REQUEST['type']) && !empty($_REQUEST['type'])) {
			
			$user_id = $_REQUEST['user_id'];
			$type = $_REQUEST['type'];
    	 	$run = $this->common_model->GetAllData("my_favorite", array("user_id"=>$user_id, "type"=>$type));
    	 	$result = array();
    	 	if ($run) {

    	 		foreach ($run as $key => $value) {
		    	 		if ($type == 2) {
							$result[$key] = $this->ShortUserData($value["item_id"]);    	 			 
		    	 		} else if ($type == 1) {
		    	 			//$value["image"] = base_url($value["image"]);
							$result[$key] = $this->blogData($value["item_id"]); 
		    	 		} 
      	 		}
     	 		$response['data'] = $result;
				$response['status'] = 1;
				$response['message'] = "success";     	 	 
    	 	} else {
    	 		$response['status'] = 0;
				$response['message'] = "No record";
    	 	}
    	 } else {
			$response['status'] = 0;
			$response['message'] = "Check parameter"; 
    	 }
		return $this->respond($response);
    }


    private function blogData($id) {
    	 $run = $this->common_model->GetSingleData("blog_management", array("id"=>$id));
    	 if ($run) {
    	 	$run["category"] = $this->common_model->GetSingleData("content_blog", array("id"=>$run["category"]));
			$run["sub_category"] = $this->common_model->GetSingleData("content_blog", array("id"=>$run["subcategory"]));
    	 	return $run;
    	 } else {
    	 	return array();
    	 }
    }




    private function ShortUserData($id) {
    	$run = $this->common_model->GetSingleData('users', array('id'=>$id));
    	if($run) 	{
    		$user['id'] = $run['id'];
    		$user['name'] = $run['name'];
    		$user['email'] = $run['email'];
    		//$user['password'] = $run['password'];
    		$user['country'] = $run['country'];
    		$user['phone'] = $run['phone'];

    		/*if($run['image']){
					$user['profile_image'] = base_url($run['profile_image']);
				} else {
					$user['profile_image'] = base_url('assets/profile_image/dummy-profile-pic.png');
				}*/ 

				if(strpos($run['profile_image'], "dummyimage")){
					$user['profile_image'] = $run['profile_image'];					
				} else {
					$user['profile_image'] = base_url('assets/profile_image/dummy-profile-pic.png');
					if ($run['image']) {
						$user['profile_image'] = base_url($run['profile_image']);
					}
				}
    		
    		$user['phone_withcode'] = $run['phone_withcode'];
    		$user['user_type'] = $run['user_type'];
    		if($user['user_type'] == 1){
    			$user['your_expertise'] = $run['your_expertise'];
				$user['your_speciality'] = $run['your_speciality'];
				$user['year_experience'] = $run['year_experience'];
				$user['office_hours'] = $run['office_hours'];
				$user['fees'] = $run['fees'];
				$user['insurance'] = $run['insurance'];
    		}
    	}
    	return $user;
    }
	
	public function forget_password() {
		//https://www.webwiders.com/WEB01/Motherocity/api/forget-password
		$this->validation->setRule('email', 'Email', 'required|valid_email');
					
		if($this->validation->withRequest($this->request)->run()==false) {
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
			edit();
		}
				
		$email = $this->request->getVar('email');
		$run = $this->common_model->GetSingleData('users', array('email' => $email));
		
		if ($run) {
			/*$subject = "Forgot Password";
			$body = '<p>Hello ' . $run['firt_name']. ',</p><p>This is an automated message. If you did not recently initiate the Forgot Password process,please disgard this email.</p><p style="text-align: left;color: black">Password:' . $run['password'] . '</p>';
			$send = $this->common_model->SendMail($email, $subject, $body);*/
			//$update['otp'] = $otp = rand(1000, 9999);
			$update['otp'] = $otp = 1234;
			$run1 = $this->common_model->UpdateData('users', array('id' => $run["id"]), $update);
			if($run1) {
				//$send = $this->Send_sms->send($run["phone_withcode"],$otp);			
				$response['status'] = 1;
				$response['data'] = $run["id"];
				$response['message'] = 'Success! OTP sent to your registered mobile number to reset password';
			} else {
				$response['status'] = 0;
				$response['message'] = 'something went wrong';
			}
		} else {
			$response['status'] = 0;
			$response['message'] = 'Email Does not exist.';
		} 
		 
		return $this->respond($response);
	}

	public function change_password() {
    	
			//https://www.webwiders.com/WEB01/Motherocity/api/change-password
		$this->validation->setRule('user_id', 'user_id', 'required');
		$this->validation->setRule('current_password', 'Current password', 'required');
		$this->validation->setRule('new_password', 'New password', 'required');
		$this->validation->setRule('confirm_password', 'Confirm password', 'required|matches[new_password]');
			
		if($this->validation->withRequest($this->request)->run()==false) {
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}
		
			
		$id = $this->request->getVar('user_id');
		$userdata = $this->common_model->GetSingleData('users', array('id' => $id));
							
		$user_pass = $this->request->getVar('current_password');
		$New_Password['password'] = $this->request->getVar('new_password');
		
		if ($userdata['password'] == $user_pass) {
			$run = $this->common_model->UpdateData('users', array('id' => $id), $New_Password);
			if ($run) {
				$response['status'] = 1;
				$response['message'] = 'Your password has been changed successfully.';
			} else {
				$response['status'] = 0;
				$response['message'] = 'Something went to wrong.';
			}
		} else {
			$response['status'] = 0;
			$response['message'] = 'User Current Password does not matched.';
		}
		return $this->respond($response);
	}

	public function MembershipList() {
		//https://www.webwiders.com/WEB01/Motherocity/api/membership-list
		$row = $this->common_model->GetAllData('plan_management',array(),'id','asc');
			if($row){
				
					$output['data']=$row;
					$output['status']= 1; 
					$output['message']='success';
			}else{
				    $output['message']='Something Went wrong';
					$output['status']= 0; 
			}
		
		return $this->respond($output);
	}

	public function birthType() {
        $row = $this->common_model->GetAllData('birth_type','','id','desc');
			if($row){
				$result = array();
					foreach($row as $key => $value){
						array_push($result, $value);
					}
					$output['status']= 1;
					$output['message']='success';
					$output['data']=$result;
			}else{
				    $output['message']='Something Went wrong';
					$output['status']= 0;
			}
		
		return $this->respond($output);
	}

	public function BuyMembership() {
    	
		//https://www.webwiders.com/WEB01/Motherocity/api/BuyMembership
		$this->validation->setRule('user_id', 'user_id', 'required');
		$this->validation->setRule('plan_id', 'plan_id', 'required');
		$this->validation->setRule('amount', 'amount', 'required');
		$this->validation->setRule('transaction_id', 'transaction_id', 'required');
		
		if($this->validation->withRequest($this->request)->run()==false) {
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		} else { 
				$user_id = $insert['user_id'] = $this->request->getVar('user_id');
				$insert1['plan_id'] = $this->request->getVar('plan_id');
				$insert['plan_id'] = $this->request->getVar('plan_id');
				$insert['amount'] = $this->request->getVar('amount');
				$insert['transaction_id'] = $this->request->getVar('transaction_id');
				$insert["start_date"] = date('Y-m-d H:i:s');
				if ($insert['plan_id'] == 1) {
					$insert["end_date"] = date('Y-m-d H:i:s', strtotime($insert['start_date']. '+30 days'));
				} else {
					$insert["end_date"] = date('Y-m-d H:i:s', strtotime($insert['start_date']. '+365 days'));
				}
				$insert['created_at'] = date('Y-m-d H:i:s');
				 $this->common_model->UpdateData('users', array('id' => $user_id),$insert1);
				$run = $this->common_model->InsertData('transaction',$insert);
				if ($run) {
					
						$response['status'] = 1;
						$response['message'] = 'Membership plan purchased successfully.';
					
				} else {
					$response['status'] = 0;
					$response['message'] = 'something went wrong';
				}
 		}
		
		
		return $this->respond($response);
	}

	private function GetUniqueUserID() {
        $postpartum_code = rand(100000, 999999);
        $check = $this->common_model->GetSingleData('postpartum',array('postpartum_code'=>$postpartum_code));
        if ($check) {
            $this->GetUniqueUserID();
        } else {
            return $postpartum_code;
        }
    }

	public function AddPostpartum()
	{
		
		$insert['postpartum_code'] = $this->GetUniqueUserID();
		$insert['maternity_start'] = $this->request->getVar('maternity_start');
		$insert['maternity_end'] = $this->request->getVar('maternity_end');
		$insert['is_maternity_private '] = $this->request->getVar('is_maternity_private');
		$insert['first_weeks '] = $this->request->getVar('first_weeks');
		$insert['patient_name '] = $this->request->getVar('patient_name');
		$insert['is_name_private'] = $this->request->getVar('is_name_private');
		$insert['created_at'] = date('Y-m-d H:i:s');

		$run = $this->common_model->InsertData('postpartum',$insert);

		$support_person_status = 0;
		if(isset($_POST['supporter_name']) && !empty($_POST['supporter_name']))
		{
			$support_person_status = 1;
		}
		if(isset($_POST['supporter_relation']) && !empty($_POST['supporter_relation']))
		{
			$support_person_status = 1;
		}
		if(isset($_POST['supporter_number']) && !empty($_POST['supporter_number']))
		{
			$support_person_status = 1;
		}
		if(isset($_POST['supporter_email']) && !empty($_POST['supporter_email']))
		{
			$support_person_status = 1;
		}
		if(isset($_POST['supporter_note']) && !empty($_POST['supporter_note']))
		{
			$support_person_status = 1;
		}
		if(isset($_POST['supporter_permission']) && !empty($_POST['supporter_permission']))
		{
			$support_person_status = 1;
		}
		if($support_person_status == 1)
		{
			$count1 = count($_POST['supporter_name']);
			for($i=0; $i<$count1; $i++)
			{
				$insert1['postpartum_id'] = $run;
				$insert1['postpartum_code'] = $insert['postpartum_code'];
				$insert1['supporter_name'] = $_POST['supporter_name'][$i];
				$insert1['supporter_relation'] = $_POST['supporter_relation'][$i];
				$insert1['supporter_number '] = $_POST['supporter_number'][$i];
				$insert1['supporter_email '] = $_POST['supporter_email'][$i];
				$insert1['supporter_note '] = $_POST['supporter_note'][$i];
				$insert1['supporter_permission '] = $_POST['supporter_permission'][$i];
				$insert1['is_supporter_note_private'] = $_POST['is_supporter_note_private'][$i];
				$insert1['created_at'] = date('Y-m-d H:i:s');

				$run1 = $this->common_model->InsertData('support_person',$insert1);
			}
		}
		
		
		$guest_status = 0;
		if(isset($_POST['guest_require']) && !empty($_POST['guest_require']))
		{
			$guest_status = 1;
		}
		if(isset($_POST['before_enter']) && !empty($_POST['before_enter']))
		{
			$guest_status = 1;
		}
		if(isset($_POST['for_holding_baby']) && !empty($_POST['for_holding_baby']))
		{
			$guest_status = 1;
		}
		if(isset($_POST['code_work']) && !empty($_POST['code_work']))
		{
			$guest_status = 1;
		}
		if(isset($_POST['guest_helping_things']) && !empty($_POST['guest_helping_things']))
		{
			$guest_status = 1;
		}
		if(isset($_POST['not_visit_person']) && !empty($_POST['not_visit_person']))
		{
			$guest_status = 1;
		}
		if($guest_status == 1)
		{
			$insert2['postpartum_id'] = $run;
			$insert2['postpartum_code'] = $insert['postpartum_code'];
			$insert2['guest_require'] = implode(',',$this->request->getVar('guest_require'));
			$insert2['before_enter'] = implode(',',$this->request->getVar('before_enter'));
			$insert2['for_holding_baby'] = implode(',',$this->request->getVar('for_holding_baby'));
			$insert2['code_work'] = $this->request->getVar('code_work');
			$insert2['guest_helping_things'] = implode(',',$this->request->getVar('guest_helping_things'));
			$insert2['not_visit_person'] = implode(',',$this->request->getVar('not_visit_person'));
			$insert2['created_at'] = date('Y-m-d H:i:s');

			$run2 = $this->common_model->InsertData('precautions',$insert2);
		}
		
		$caretaker_status = 0;
		if(isset($_POST['caretaker_name']) && !empty($_POST['caretaker_name']))
		{
			$caretaker_status = 1;
		}
		if(isset($_POST['caretaker_relation']) && !empty($_POST['caretaker_relation']))
		{
			$caretaker_status = 1;
		}
		if(isset($_POST['caretaker_permission']) && !empty($_POST['caretaker_permission']))
		{
			$caretaker_status = 1;
		}
		if(isset($_POST['caretaker_number']) && !empty($_POST['caretaker_number']))
		{
			$caretaker_status = 1;
		}
		if(isset($_POST['caretaker_email']) && !empty($_POST['caretaker_email']))
		{
			$caretaker_status = 1;
		}
		if(isset($_POST['caretaker_note']) && !empty($_POST['caretaker_note']))
		{
			$caretaker_status = 1;
		}
		if($caretaker_status == 1)
		{
			$count2 = count($_POST['caretaker_name']);
			for($i=0; $i<$count2; $i++)
			{
				$insert3['postpartum_id'] = $run;
				$insert3['postpartum_code'] = $insert['postpartum_code'];
				$insert3['caretaker_name'] = $_POST['caretaker_name'][$i];
				$insert3['caretaker_relation'] = $_POST['caretaker_relation'][$i];
				$insert3['caretaker_permission '] = $_POST['caretaker_permission'][$i];
				$insert3['caretaker_number '] = $_POST['caretaker_number'][$i];
				$insert3['caretaker_email '] = $_POST['caretaker_email'][$i];
				$insert3['caretaker_note '] = $_POST['caretaker_note'][$i];
				$insert3['is_caretaker_note_private'] = $_POST['is_caretaker_note_private'][$i];
				$insert3['created_at'] = date('Y-m-d H:i:s');

				$run3 = $this->common_model->InsertData('caretaker',$insert3);
			}
		}
		
		$rest_recovery_status = 0;
		if(isset($_POST['name']) && !empty($_POST['name']))
		{
			$rest_recovery_status = 1;
		}
		if(isset($_POST['room']) && !empty($_POST['room']))
		{
			$rest_recovery_status = 1;
		}
		if(isset($_POST['sleep_type']) && !empty($_POST['sleep_type']))
		{
			$rest_recovery_status = 1;
		}
		if(isset($_POST['sleep_place']) && !empty($_POST['sleep_place']))
		{
			$rest_recovery_status = 1;
		}
		if(isset($_POST['sleep_start']) && !empty($_POST['sleep_start']))
		{
			$rest_recovery_status = 1;
		}
		if(isset($_POST['sleep_end']) && !empty($_POST['sleep_end']))
		{
			$rest_recovery_status = 1;
		}

		if($rest_recovery_status == 1)
		{
			$count3 = count($_POST['name']);
			for($i=0; $i<$count3; $i++)
			{
				$insert4['postpartum_id'] = $run;
				$insert4['postpartum_code'] = $insert['postpartum_code'];
				$insert4['name'] = $_POST['name'][$i];
				$insert4['room'] = $_POST['room'][$i];
				$insert4['sleep_type '] = $_POST['sleep_type'][$i];
				$insert4['sleep_place '] = $_POST['sleep_place'][$i];
				$insert4['type '] = $_POST['type'][$i];
				$insert4['sleep_start '] = date('Y-m-d H:i:s',strtotime($_POST['sleep_start'][$i]));
				$insert4['sleep_end '] = date('Y-m-d H:i:s',strtotime($_POST['sleep_end'][$i]));
				$insert4['created_at'] = date('Y-m-d H:i:s');

				$run4 = $this->common_model->InsertData('rest_recovery',$insert4);
			}
		}
		
		$food_status = 0;
		if(isset($_POST['food_preference']) && !empty($_POST['food_preference']))
		{
			$food_status = 1;
		}
		if(isset($_POST['menu_preference']) && !empty($_POST['menu_preference']))
		{
			$food_status = 1;
		}
		if(isset($_POST['food_allergies']) && !empty($_POST['food_allergies']))
		{
			$food_status = 1;
		}
		if(isset($_POST['food_locations']) && !empty($_POST['food_locations']))
		{
			$food_status = 1;
		}
		if(isset($_POST['food_notes']) && !empty($_POST['food_notes']))
		{
			$food_status = 1;
		}

		if($food_status == 1)
		{
			$count4 = count($_POST['food_preference']);
			for($i=0; $i<$count4; $i++)
			{
				$insert5['postpartum_id'] = $run;
				$insert5['postpartum_code'] = $insert['postpartum_code'];
				$insert5['food_preference'] = $_POST['food_preference'][$i];
				$insert5['menu_preference'] = $_POST['menu_preference'][$i];
				$insert5['food_allergies '] = $_POST['food_allergies'][$i];
				$insert5['food_locations '] = $_POST['food_locations'][$i];
				$insert5['food_notes '] = $_POST['food_notes'][$i];
				$insert5['created_at'] = date('Y-m-d H:i:s');

				$run5 = $this->common_model->InsertData('nutrition_food',$insert5);
			}
		}


		$hydration_status = 0;
		if(isset($_POST['hydration_type']) && !empty($_POST['hydration_type']))
		{
			$hydration_status = 1;
		}
		if(isset($_POST['hydration_preference']) && !empty($_POST['hydration_preference']))
		{
			$hydration_status = 1;
		}
		if(isset($_POST['hydration_allergies']) && !empty($_POST['hydration_allergies']))
		{
			$hydration_status = 1;
		}
		if(isset($_POST['hydration_locations']) && !empty($_POST['hydration_locations']))
		{
			$hydration_status = 1;
		}
		if(isset($_POST['hydration_notes']) && !empty($_POST['hydration_notes']))
		{
			$hydration_status = 1;
		}

		if($hydration_status == 1)
		{
			$count5 = count($_POST['hydration_type']);
			for($i=0; $i<$count5; $i++)
			{
				$insert6['postpartum_id'] = $run;
				$insert6['postpartum_code'] = $insert['postpartum_code'];
				$insert6['hydration_type'] = $_POST['hydration_type'][$i];
				$insert6['hydration_preference'] = $_POST['hydration_preference'][$i];
				$insert6['hydration_allergies '] = $_POST['hydration_allergies'][$i];
				$insert6['hydration_locations '] = $_POST['hydration_locations'][$i];
				$insert6['hydration_notes '] = $_POST['hydration_notes'][$i];
				$insert6['created_at'] = date('Y-m-d H:i:s');

				$run6 = $this->common_model->InsertData('nutrition_hydration',$insert6);
			}
		}

		$supplement_status = 0;
		if(isset($_POST['supplement_name']) && !empty($_POST['supplement_name']))
		{
			$supplement_status = 1;
		}
		if(isset($_POST['supplement_type']) && !empty($_POST['supplement_type']))
		{
			$supplement_status = 1;
		}
		if(isset($_POST['supplement_freequency']) && !empty($_POST['supplement_freequency']))
		{
			$supplement_status = 1;
		}
		if(isset($_POST['supplement_directions']) && !empty($_POST['supplement_directions']))
		{
			$supplement_status = 1;
		}
		if(isset($_POST['supplement_take_with']) && !empty($_POST['supplement_take_with']))
		{
			$supplement_status = 1;
		}
		if(isset($_POST['supplement_notes']) && !empty($_POST['supplement_notes']))
		{
			$supplement_status = 1;
		}

		if($supplement_status == 1)
		{
			$count6 = count($_POST['supplement_name']);
			for($i=0; $i<$count6; $i++)
			{
				$insert7['postpartum_id'] = $run;
				$insert7['postpartum_code'] = $insert['postpartum_code'];
				$insert7['supplement_name'] = $_POST['supplement_name'][$i];
				$insert7['supplement_type'] = $_POST['supplement_type'][$i];
				$insert7['supplement_freequency '] = $_POST['supplement_freequency'][$i];
				$insert7['supplement_directions '] = $_POST['supplement_directions'][$i];
				$insert7['supplement_take_with '] = implode(',',$_POST['supplement_take_with'][$i]);
				$insert7['supplement_notes '] = $_POST['supplement_notes'][$i];
				$insert7['created_at'] = date('Y-m-d H:i:s');

				$run7 = $this->common_model->InsertData('nutrition_supplements',$insert7);
			}
		}


		$medical_contact_status = 0;
		if(isset($_POST['specialist_type']) && !empty($_POST['specialist_type']))
		{
			$medical_contact_status = 1;
		}
		if(isset($_POST['specialist_name']) && !empty($_POST['specialist_name']))
		{
			$medical_contact_status = 1;
		}
		if(isset($_POST['specialist_contact']) && !empty($_POST['specialist_contact']))
		{
			$medical_contact_status = 1;
		}
		if(isset($_POST['specialist_email']) && !empty($_POST['specialist_email']))
		{
			$medical_contact_status = 1;
		}
		if(isset($_POST['specialist_preference']) && !empty($_POST['specialist_preference']))
		{
			$medical_contact_status = 1;
		}
		if(isset($_POST['specialist_notes']) && !empty($_POST['specialist_notes']))
		{
			$medical_contact_status = 1;
		}

		if($medical_contact_status == 1)
		{
			$count7 = count($_POST['specialist_name']);
			for($i=0; $i<$count7; $i++)
			{
				$insert8['postpartum_id'] = $run;
				$insert8['postpartum_code'] = $insert['postpartum_code'];
				$insert8['specialist_type'] = $_POST['specialist_type'][$i];
				$insert8['specialist_name'] = $_POST['specialist_name'][$i];
				$insert8['specialist_contact '] = $_POST['specialist_contact'][$i];
				$insert8['specialist_email '] = $_POST['specialist_email'][$i];
				$insert8['specialist_preference '] = implode(',',$_POST['specialist_preference'][$i]);
				$insert8['specialist_notes '] = $_POST['specialist_notes'][$i];
				$insert8['created_at'] = date('Y-m-d H:i:s');

				$run8 = $this->common_model->InsertData('medical_contact',$insert8);
			}
		}

		$phrase_status = 0;
		if(isset($_POST['phrase']) && !empty($_POST['phrase']))
		{
			$phrase_status = 1;
		}
		if(isset($_POST['meaning']) && !empty($_POST['meaning']))
		{
			$phrase_status = 1;
		}
		if(isset($_POST['timeline']) && !empty($_POST['timeline']))
		{
			$phrase_status = 1;
		}
		if(isset($_POST['frequency']) && !empty($_POST['frequency']))
		{
			$phrase_status = 1;
		}

		if($phrase_status == 1)
		{
			$count8 = count($_POST['phrase']);
			for($i=0; $i<$count8; $i++)
			{
				$insert9['postpartum_id'] = $run;
				$insert9['postpartum_code'] = $insert['postpartum_code'];
				$insert9['phrase'] = $_POST['phrase'][$i];
				$insert9['meaning'] = $_POST['meaning'][$i];
				$insert9['timeline '] = $_POST['timeline'][$i];
				$insert9['frequency '] = $_POST['frequency'][$i];
				$insert9['created_at'] = date('Y-m-d H:i:s');

				$run9 = $this->common_model->InsertData('code_phrases',$insert9);
			}
		}

		$share_status = 0;
		if(isset($_POST['share_person_name']) && !empty($_POST['share_person_name']))
		{
			$share_status = 1;
		}
		if(isset($_POST['share_person_email']) && !empty($_POST['share_person_email']))
		{
			$share_status = 1;
		}

		if($share_status == 1)
		{
			$count9 = count($_POST['share_person_name']);
			for($i=0; $i<$count9; $i++)
			{
				$insert10['postpartum_id'] = $run;
				$insert10['postpartum_code'] = $insert['postpartum_code'];
				$insert10['share_person_name'] = $_POST['share_person_name'][$i];
				$insert10['share_person_email'] = $_POST['share_person_email'][$i];
				$insert10['share_type'] = $_POST['share_type'][$i];
				$insert10['created_at'] = date('Y-m-d H:i:s');

				$run10 = $this->common_model->InsertData('share_postpartum_plan',$insert10);
			}
		}
		

		if ($run || $run1 || $run2 || $run3 || $run4 || $run5 || $run6 || $run7 || $run8 || $run9 || $run10) 
		{
			$response['data'] = $this->get_postpartum($run);		
			$response['status'] = 1;
			$response['message'] = 'Postpartum Added successfully.';
		
		} else {
			$response['status'] = 0;
			$response['message'] = 'something went wrong';
		}
		return $this->respond($response);
	}

	

	public function get_postpartum_detail()
	{
		if(isset($_REQUEST['postpartum_id']) && !empty($_REQUEST['postpartum_id']))
		{
			$id = $_REQUEST['postpartum_id'];
			$data['postpartum_detail'] = $this->get_postpartum($id);
			$data['support_person'] = $this->support_person($id);
			$data['support_person_precautions'] = $this->support_person_precautions($id);
			$data['caretaker_detail'] = $this->caretaker_detail($id);
			$data['medical_contact'] = $this->medical_contact($id);
			$data['code_phrases'] = $this->code_phrases($id);
			$data['shar_plan'] = $this->shar_plan($id);
			$data['rest_recovery'] = $this->rest_recovery($id);
			$data['nutrition_detail'] = $this->nutrition($id);

			$response['data'] = $data;
			$response['status'] = 1;
			$response['message'] = 'Success';

		} else {
			$response['status'] = 0;
			$response['message'] = 'check parameter';
		}
		return $this->respond($response);
	}

	private function get_postpartum($id)
	{
		$postpartum = $this->common_model->GetSingleData('postpartum',array('id'=>$id));
		if($postpartum)
		{
			$post['id'] = $postpartum['id'];	
			$post['postpartum_code'] = $postpartum['postpartum_code'];	
			$post['maternity_start'] = $postpartum['maternity_start'];	
			$post['maternity_end'] = $postpartum['maternity_end'];
			if($postpartum['is_maternity_private'] == 1)
			{
				$post['is_maternity_private'] = 'Yes';
			} else {
				$post['is_maternity_private'] = 'No';
			}
			$post['first_weeks'] = $postpartum['first_weeks'];	
			$post['patient_name'] = $postpartum['patient_name'];
			if($postpartum['is_name_private'] == 1)
			{
				$post['is_name_private'] = 'Yes';
			} else {
				$post['is_name_private'] = 'No';
			}	
					
		} else {
			$post = "";
		}
		return $post;
	}

	private function support_person($id)
	{
		$support = $this->common_model->GetAllData('support_person',array('postpartum_id'=>$id));
		if($support)
		{
			$new_arr = [];
			foreach($support as $sup)
			{
				$post['id'] = $sup['id'];	
				$post['postpartum_code'] = $sup['postpartum_code'];	
				$post['supporter_name'] = $sup['supporter_name'];	
				$post['supporter_relation'] = $sup['supporter_relation'];
				$post['supporter_number'] = $sup['supporter_number'];	
				$post['supporter_email'] = $sup['supporter_email'];
				$post['supporter_note'] = $sup['supporter_note'];
				if($sup['is_supporter_note_private'] == 1)
				{
					$post['is_supporter_note_private'] = 'Yes';
				} else {
					$post['is_supporter_note_private'] = 'No';
				}
				array_push($new_arr,$post);
			}
				
					
		} else {
			$new_arr = [];
		}
		return $new_arr;
	}
	private function shar_plan($id)
	{
		$share = $this->common_model->GetAllData('share_postpartum_plan',array('postpartum_id'=>$id));
		if($share)
		{
			$new_arr = [];
			foreach($share as $shr)
			{
				$post['id'] = $shr['id'];	
				$post['postpartum_code'] = $shr['postpartum_code'];	
				$post['share_person_name'] = $shr['share_person_name'];	
				$post['share_person_email'] = $shr['share_person_email'];
				if($shr['share_type'] == 1)
				{
					$post['share_type'] = 'With Public Details';
				} else {
					$post['share_type'] = 'With Private Details';
				}
				array_push($new_arr,$post);
			}
				
					
		} else {
			$new_arr = [];
		}
		return $new_arr;
	}
	private function support_person_precautions($id)
	{
		$precap = $this->common_model->GetSingleData('precautions',array('postpartum_id'=>$id));
		if($precap)
		{
			$post['id'] = $precap['id'];	
			$post['postpartum_code'] = $precap['postpartum_code'];	
			$post['guest_require'] = $precap['guest_require'];	
			$post['before_enter'] = $precap['before_enter'];
			$post['for_holding_baby'] = $precap['for_holding_baby'];
			$post['code_work'] = $precap['code_work'];
			$post['guest_helping_things'] = $precap['guest_helping_things'];
			$post['not_visit_person'] = $precap['not_visit_person'];	
					
		} else {
			$post = "";
		}
		return $post;
	}
	private function caretaker_detail($id)
	{
		$caretaker = $this->common_model->GetAllData('caretaker',array('postpartum_id'=>$id));
		if($caretaker)
		{
			$new_arr = [];
			foreach($caretaker as $care)
			{
				$post['id'] = $care['id'];	
				$post['postpartum_code'] = $care['postpartum_code'];	
				$post['caretaker_name'] = $care['caretaker_name'];	
				$post['caretaker_relation'] = $care['caretaker_relation'];
				$post['caretaker_permission'] = $care['caretaker_permission'];
				$post['caretaker_number'] = $care['caretaker_number'];
				$post['caretaker_email'] = $care['caretaker_email'];
				$post['caretaker_note'] = $care['caretaker_note'];
				if($care['is_caretaker_note_private'] == 1)
				{
					$post['is_caretaker_note_private'] = 'Yes';
				} else {
					$post['is_caretaker_note_private'] = 'No';
				}
				array_push($new_arr,$post);
			}
				
					
		} else {
			$new_arr = [];
		}
		return $new_arr;
	}
	private function medical_contact($id)
	{
		$medical = $this->common_model->GetAllData('medical_contact',array('postpartum_id'=>$id));
		if($medical)
		{
			$new_arr = [];
			foreach($medical as $med)
			{
				$post['id'] = $med['id'];	
				$post['postpartum_code'] = $med['postpartum_code'];	
				$post['specialist_type'] = $med['specialist_type'];	
				$post['specialist_name'] = $med['specialist_name'];
				$post['specialist_contact'] = $med['specialist_contact'];
				$post['specialist_email'] = $med['specialist_email'];
				$post['specialist_preference'] = $med['specialist_preference'];
				$post['specialist_notes'] = $med['specialist_notes'];

				array_push($new_arr,$post);
			}
				
					
		} else {
			$new_arr = [];
		}
		return $new_arr;
	}
	private function code_phrases($id)
	{
		$phrase = $this->common_model->GetAllData('code_phrases',array('postpartum_id'=>$id));
		if($phrase)
		{
			$new_arr = [];
			foreach($phrase as $phrs)
			{
				$post['id'] = $phrs['id'];	
				$post['postpartum_code'] = $phrs['postpartum_code'];	
				$post['phrase'] = $phrs['phrase'];	
				$post['meaning'] = $phrs['meaning'];
				$post['timeline'] = $phrs['timeline'];
				$post['frequency'] = $phrs['frequency'];
				array_push($new_arr,$post);
			}
				
					
		} else {
			$new_arr = [];
		}
		return $new_arr;
	}
	private function rest_recovery($id)
	{
		$person = $this->common_model->GetAllData('rest_recovery',array('postpartum_id'=>$id));
		if($person)
		{
			$new_arr = [];
			foreach($person as $per)
			{
				$post['id'] = $per['id'];	
				$post['postpartum_code'] = $per['postpartum_code'];	
				$post['name'] = $per['name'];	
				$post['room'] = $per['room'];
				$post['sleep_type'] = $per['sleep_type'];
				$post['sleep_place'] = $per['sleep_place'];	
				$post['sleep_start'] = $per['sleep_start'];	
				$post['sleep_end'] = $per['sleep_end'];	
				$post['sleep_person'] = $per['type'];	
				array_push($new_arr,$post);
			}
					
		} else {
			$new_arr = [];
		}
		return $new_arr;
	}
	private function nutrition($id)
	{
		$food = $this->common_model->GetAllData('nutrition_food',array('postpartum_id'=>$id));
		if($food)
		{
			$new_arr = [];
			foreach($food as $fod)
			{
				$foods['id'] = $fod['id'];	
				$foods['postpartum_code'] = $fod['postpartum_code'];	
				$foods['food_preference'] = $fod['food_preference'];	
				$foods['menu_preference'] = $fod['menu_preference'];
				$foods['food_allergies'] = $fod['food_allergies'];
				$foods['food_locations'] = $fod['food_locations'];	
				$foods['food_notes'] = $fod['food_notes'];
				array_push($new_arr,$foods);
			}
				
					
		} else {
			$new_arr = [];
		}
		$hydration = $this->common_model->GetAllData('nutrition_hydration',array('postpartum_id'=>$id));
		if($hydration)
		{
			$new_arr1 = [];
			foreach($hydration as $hydra)
			{
				$hydrations['id'] = $hydra['id'];	
				$hydrations['postpartum_code'] = $hydra['postpartum_code'];		
				$hydrations['hydration_type'] = $hydra['hydration_type'];
				$hydrations['hydration_preference'] = $hydra['hydration_preference'];
				$hydrations['hydration_allergies'] = $hydra['hydration_allergies'];
				$hydrations['hydration_locations'] = $hydra['hydration_locations'];	
				$hydrations['hydration_notes'] = $hydra['hydration_notes'];
				array_push($new_arr1,$hydrations);
			}	
					
		} else {
			$new_arr1 = [];
		}
		$supplement = $this->common_model->GetAllData('nutrition_supplements',array('postpartum_id'=>$id));
		if($supplement)
		{
			$new_arr2 = [];
			foreach($supplement as $suppl)
			{
				$supplements['id'] = $suppl['id'];	
				$supplements['postpartum_code'] = $suppl['postpartum_code'];		
				$supplements['supplement_type'] = $suppl['supplement_type'];
				$supplements['supplement_name'] = $suppl['supplement_name'];
				$supplements['supplement_freequency'] = $suppl['supplement_freequency'];
				$supplements['supplement_directions'] = $suppl['supplement_directions'];	
				$supplements['supplement_take_with'] = $suppl['supplement_take_with'];	
				$supplements['supplement_notes'] = $suppl['supplement_notes'];	
				array_push($new_arr2,$supplements);
			}
					
		} else {
			$new_arr2 = [];
		}
		$return['food'] = $new_arr;
		$return['hydrations'] = $new_arr1;
		$return['supplements'] = $new_arr2;

		return $return;
		
	}

	public function GetNotification(){

		//https://www.webwiders.com/WEB01/Motherocity/api/get-notification		
		if(isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])){

			$user_id = $_REQUEST['user_id'];
			$notification = $this->common_model->GetDataByOrderLimit('notification',array('user_id'=>$user_id),'id','desc',0,100);
			$unread = $this->common_model->GetColumnName('notification',array('user_id'=>$user_id,'is_read'=>0),array('count(id) as total'));

			$result = array();

			if(!empty($notification)){
						
				foreach($notification as $key => $value){

					$result[$key] = $value;
					$result[$key]['other'] = unserialize($value['other']);
					$result[$key]['create_date'] = $this->time_ago($value['create_date']);
				
					$profile = site_url().'upload/no.png';

					$title = '-';

					if($value['behalf_of']){

						$user = $this->common_model->GetColumnName('users',array('id'=>$value['behalf_of']),array('first_name'));
						
						if($user){
							$title = $user->first_name;
							/*if($user->image){
								$profile = base_url($user->image);
							}*/
						}				
					}
					
					//$result[$key]['profile'] = $profile;
					$result[$key]['title'] = $title;

				}				

				$output['unread'] = ($unread) ? $unread->total : 0;
				$output['data'] = $result;
				$output['status'] = 1;
				$output['message'] = 'Success!';

			} else {

				$output['data'] = $result;
				$output['status'] = 0;
				$output['message'] = 'We did not find any records.';
			}

		} else {

			$output['status'] = 0;
			$output['message'] = 'Check parameter.';

		}
			return $this->respond($output);
	}

   public function GetUnreadNotification() {

   		//https://www.webwiders.com/WEB01/Motherocity/api/unread-notification

		if(empty($_REQUEST['user_id'])) {
			$output['status'] = "0";
			$output['message'] = "Please check parameter";

		} else  {

			$user_id=$_REQUEST['user_id'];					

			$unreadNoti = $this->common_model->GetColumnName('notification',array('user_id'=>$user_id,'is_read'=>0),array('count(id) as total'));

			$unreadNoti = ($unreadNoti) ? $unreadNoti->total : 0;
			$output['unreadNotification'] =$unreadNoti;
			$output['status'] =1;

		}

		return $this->respond($output);

	}

	public function MarkAsReadNotification(){

		//https://www.webwiders.com/WEB01/Motherocity/api/mark-readnotification	

		if(isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])){

			$user_id = $_REQUEST['user_id'];			
			
			$where = "user_id = $user_id";

			if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])){
				$where .= " and id in (".$_REQUEST['id'].")";
			}

			$this->common_model->UpdateData('notification',$where,array('is_read'=>1));
			$output['status'] = 1;
			$output['message'] = 'Success!';

		} else {

			$output['status'] = 0;
			$output['message'] = 'Check parameter.';

		}

		return $this->respond($output);

	}

	 public function ClearNotification() {

			//https://www.webwiders.com/WEB01/Motherocity/api/clear-notification

		if(isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])) {
			
			$user_id = $_REQUEST['user_id'];					

			$run  = $this->common_model->DeleteData('notification',array('user_id'=>$user_id));

			$output['status'] =1;
			$output['message'] = "Clear notification successfully";

		} else  {


			$output['status'] = "0";
			$output['message'] = "Please check parameter";

		}

		return $this->respond($output);

	}
	 public function ClearSingleNotification() {

			//https://www.webwiders.com/WEB01/Motherocity/api/clear-singlenotification

		if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
			
			$id = $_REQUEST['id'];					

			$run  = $this->common_model->DeleteData('notification',array('id'=>$id));

			$output['status'] =1;
			$output['message'] = "Clear notification successfully";

		} else  {


			$output['status'] = "0";
			$output['message'] = "Please check parameter";

		}

		return $this->respond($output);

	}

   private function time_ago($timestamp){  
		$time_ago = strtotime($timestamp);  
		$current_time = time();  
		$time_difference = $current_time - $time_ago;  
		$seconds = $time_difference;  
		$minutes = round($seconds / 60) ;// value 60 is seconds
		$hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
		$days    = round($seconds / 86400); //86400 = 24 * 60 * 60;
		$weeks   = round($seconds / 604800);// 7*24*60*60;
		$months  = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60
		$years   = round($seconds / 31553280);//(365+365+365+365+366)/5 * 24 * 60 * 60  
		if($seconds <= 60) { 
		
			return "Just Now";
			
		} else if($minutes <=60) { 
		
			if($minutes==1) {  
				return "one minute ago";  
			} else {  
				return "$minutes minutes ago";  
			}  
			
		} else if($hours <=24) {  
			
			if($hours==1) {  
				return "an hour ago";  
			} else  {  
				return "$hours hrs ago";  
			}  
			
		} else if($days <= 7) {  
			if($days==1) {  
				return "yesterday";  
			} else  {  
				return "$days days ago";  
			}  
		} else if($weeks <= 4.3) {  
			
			if($weeks==1) {  
				return "a week ago";  
			}  else  {  
				return "$weeks weeks ago";  
			}  
		}  else if($months <=12) { 
		
			if($months==1) {  
				return "a month ago";  
			} else {  
				return "$months months ago";  
			}  
		}  else {  
			if($years==1) {  
				return "one year ago";  
			} else  {  
				return "$years years ago";  
			}  
		}  
	}

	public function get_report_category() {
		//https://www.webwiders.com/WEB01/Motherocity/api/get-report-category
		$row = $this->common_model->GetAllData('report_category','','id','desc');
			if($row){
				$result = array();
					foreach($row as $key => $value){
						array_push($result, $value);
					}
					$output['status']= 1; 
					$output['message']='success';
					$output['data']=$result;
			}else{
				    $output['message']='Something Went wrong';
					$output['status']= 0; 
			}
		
		return $this->respond($output);
	}

	public function get_help_category() {
		//https://www.webwiders.com/WEB01/Motherocity/api/get-help-category
		$row = $this->common_model->GetAllData('help_category','','id','desc');
			if($row){
				$result = array();
					foreach($row as $key => $value){
						array_push($result, $value);
					}
					$output['status']= 1; 
					$output['message']='success';
					$output['data']=$result;
			}else{
				    $output['message']='Something Went wrong';
					$output['status']= 0; 
			}
		
		return $this->respond($output);
	}

	public function addHelp() {
    	
		//https://www.webwiders.com/WEB01/Motherocity/api/addHelp
		$this->validation->setRule('user_id', 'user_id', 'required');
		$this->validation->setRule('name', 'name', 'required');
		$this->validation->setRule('email', 'email', 'required');
		$this->validation->setRule('subject', 'subject', 'required');
		$this->validation->setRule('message', 'message', 'required');
		$this->validation->setRule('category', 'category', 'required');
		
		if($this->validation->withRequest($this->request)->run()==false) {
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}else{

			
            $user_id = $insert['user_id'] = $this->request->getVar('user_id');
			$insert['name'] = $this->request->getVar('name');
			$insert['email'] = $this->request->getVar('email');
			$insert['subject'] = $this->request->getVar('subject');
			$insert['message'] = $this->request->getVar('message');
			$insert['category'] = $this->request->getVar('category');
			$insert['created_at'] = date('Y-m-d H:i:s');
			 
			$run = $this->common_model->InsertData('help_list',$insert);

			if ($run) {
				
					$response['status'] = 1;
					$response['message'] = 'Add help successfully.';
				
			} else {
				$response['status'] = 0;
				$response['message'] = 'something went wrong';
			}
			
		}
		
		
		return $this->respond($response);
	}

	public function contact_us() {
		//https://www.webwiders.com/WEB01/Motherocity/api/contact-us

		$this->validation->setRule('sender_id', 'sender_id', 'required');
		$this->validation->setRule('subject', 'subject', 'required');
		$this->validation->setRule('message', 'message', 'required');
		$this->validation->setRule('category_id', 'category_id', 'required');
		 if($this->validation->withRequest($this->request)->run()==false) {
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		} else {
			$insert['sender_id'] = $this->request->getVar('sender_id');
			$insert['subject'] = $this->request->getVar('subject');
			$insert['message'] = $this->request->getVar('message');
			$insert['category_id'] = $this->request->getVar('category_id');
			$insert['created_at'] = date('Y-m-d H:i:s');
			$run = $this->common_model->InsertData("contact_us", $insert);
			if ($run) {
				
				$response['status'] = 1;
				$response['message'] = 'Success';
				
			} else {
				$response['status'] = 0;
				$response['message'] = 'something went wrong';
			}
			
		}
		
		
		return $this->respond($response);
	}


  public function addReport() {
    	
		//https://www.webwiders.com/WEB01/Motherocity/api/addReport
		$this->validation->setRule('sender_id', 'sender_id', 'required');
		$this->validation->setRule('subject', 'subject', 'required');
		$this->validation->setRule('message', 'message', 'required');
		$this->validation->setRule('category_id', 'category_id', 'required');
		
		if($this->validation->withRequest($this->request)->run()==false) {
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}else{

			
            $user_id = $insert['user_id'] = $this->request->getVar('sender_id');
			$insert['subject'] = $this->request->getVar('subject');
			$insert['message'] = $this->request->getVar('message');
			$insert['category'] = $this->request->getVar('category_id');
			$insert['created_at'] = date('Y-m-d H:i:s');
			 
			$run = $this->common_model->InsertData('report_bug',$insert);

  /*multiple image upload */
      if(isset($_FILES['image']['name'])  && is_array($_FILES['image']['name']) && count($_FILES['image']['name']) > 0){
          
          $image_arr = $_FILES['image']['name'];
          
          foreach($image_arr as $key => $row){
            $insert2 = array();
            $name_array = explode('.',$_FILES['image']['name'][$key]);
            $ext = end($name_array);
            $new_name = rand().time().'.'.$ext;
            
            $tmp_name = $_FILES["image"]["tmp_name"][$key];
            $path = 'assets/report_image/'.$new_name;
            
            if(move_uploaded_file($tmp_name,$path)){
              $insert2['image']=$new_name;
              $insert2['report_id']=$run;
              $insert2['created_at'] = date('Y-m-d H:i:s');
              $res = $this->common_model->InsertData('report_image',$insert2);
            }
          }
        } 

			if ($run) {
				
					$response['status'] = 1;
					$response['message'] = 'Add report successfully.';
				
			} else {
				$response['status'] = 0;
				$response['message'] = 'something went wrong';
			}
			
		}
		
		
		return $this->respond($response);
	}

	public function sendOpt() {
		//https://www.webwiders.com/WEB01/Motherocity/api/send-otp
		$phone = "+447878773709";
		$msg = 'this message form developer test team 123456';
		$send = $this->Send_sms->send($phone,$msg);
		if ($send) {
			echo "success";
		} else {
			echo "un success";
		}
		exit();
 	}

 }
