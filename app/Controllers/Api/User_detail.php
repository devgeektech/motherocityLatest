<?php

namespace App\Controllers\Api;

use Config\Services;
use App\Models\Common_model;

trait  CommonTrait 
{
	
   private function UserDetail($id) {

   		$this->common_model = new Common_model;
        $this->db      = \Config\Database::connect();

	 	$userData = $this->common_model->GetSingleData('users', array('id'=>$id),'id','desc');

    	if($userData)
    	{
    		$user['id'] = $userData['id'];
    		$user['first_name'] = $userData['first_name'];
    		$user['last_name'] = $userData['last_name'];
    		$user['email'] = $userData['email'];
    		$user['country'] = $userData['country'];
    		$user['phone'] = $userData['phone'];
			$user['phone_withcode'] = $userData['phone_withcode'];
    		$user['is_phone_verified'] = $userData['is_phone_verified'];
    		$user['is_verified'] = $userData['is_phone_verified'];
    		$user['user_type'] = $userData['user_type'];
    		$user['token'] = $userData['token'];
    		$user['otp'] = $userData['otp'];

    		if($user['user_type'] == 1){
    			$user['your_expertise'] = $userData['your_expertise'];
				$user['your_speciality'] = $userData['your_speciality'];
				$user['year_experience'] = $userData['year_experience'];
				$user['office_hours'] = $userData['office_hours'];
				$user['fees'] = $userData['fees'];
				$user['insurance'] = $userData['insurance'];
    		}
    		if($user['user_type'] == 2){
    			$birth_type = $this->common_model->GetSingleData('birth_type', array('id'=>$userData['birth_type_id']));
    			 $user['birth_type'] = $birth_type;

    			 $stage_1_complete =  date('d-M-Y',strtotime('+30 days',strtotime($userData['created_at'])));
                 $stage_2_complete =  date('d-M-Y',strtotime('+90 days',strtotime($userData['created_at'])));
                 $stage_3_complete =  date('d-M-Y',strtotime('+180 days',strtotime($userData['created_at'])));
                 $stage_4_complete =  date('d-M-Y',strtotime('+270 days',strtotime($userData['created_at'])));


                 $milestone_data = array();

                 $milestone_data[] = echo "Delivery : ". date('d-M-Y',strtotime($userData['created_at']));echo "<br>";
                 
                 if($stage_1_complete)
                 {
                  $milestone_data[] =  echo "Homecoming "." - ". $stage_1_complete; echo "<br>";
                 }
                 if($stage_2_complete)
                 {
                   $milestone_data[] =  echo "Connection "." - ".$stage_2_complete; echo "<br>";
                 }
                 if($stage_3_complete)
                 {
                   $milestone_data[] =  echo "Acceptance "." - ".$stage_3_complete; echo "<br>";
                 }
                 if($stage_3_complete)
                 {
                   $milestone_data[] = echo "Discovery "." - ".$stage_4_complete; echo "<br>";
                 }

               $user['milestone'] = $milestone_data;
    		}
    		return $user;
    	}else{
    		return false;
    	}
    	
    }

 }
