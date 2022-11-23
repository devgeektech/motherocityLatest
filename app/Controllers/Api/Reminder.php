<?php
namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Common_model;
use CodeIgniter\HTTP\RequestInterface;

header("Access-Control-Allow-Origin: *");

class Reminder extends ResourceController {
	
	use ResponseTrait;
	protected $req;
	// get all product
	protected $validation = null;
	
	public function __construct()
	{

		$this->common_model = new Common_model();
		$this->common_model = new Common_model();
		$this->format = 'json';
		$this->validation = \Config\Services::validation();
		$this->db      = \Config\Database::connect();
		$this->req = \Config\Services::request()->getVar();
		
	}

	//Add reminder
	public function add() {
		$this->validation->setRule('user_id','user_id','trim|required');
		$this->validation->setRule('category','Category','trim|required');
		$this->validation->setRule('time','Time','required');
		$this->validation->setRule('date','Date','required');
		$this->validation->setRule('hour','hour','required');
		$this->validation->setRule('minute','hour','required');
		$this->validation->setRule('meridiem','meridiem','required');

		if($this->validation->withRequest($this->request)->run()==false) {	   
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}
		
		$insertData['user_id'] = $this->request->getVar('user_id');		
		$insertData['category'] = $this->request->getVar('category');		
		$insertData['heading'] = $this->request->getVar('heading');
		$insertData['time'] = $this->request->getVar('time');
		$insertData['hour'] = $this->request->getVar('hour');
		$insertData['minute'] = $this->request->getVar('minute');
		$insertData['meridiem'] = $this->request->getVar('meridiem');
		$insertData['date'] = $this->request->getVar('date');
		$insertData['repeat_type'] = $this->request->getVar('repeat');
		$insertData['notes'] = $this->request->getVar('notes');

		$run = $this->common_model->insertData('reminders', $insertData);

		if($run) {
			$output['data'] = $this->common_model->GetDataById('reminders',$run);
			$output['message'] = 'Reminder added successfully!';
			$output['status'] = 1 ;
		} else {
			$output['message'] = 'something went wrong';
			$output['status'] = 0 ;
		}
	    
		return $this->respond($output);
	}

	//Add reminder
	public function get() {
		$this->validation->setRule('user_id','user_id','required');		
		if($this->validation->withRequest($this->request)->run()==false) {	   
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}
		
		$run = $this->common_model->getAllReminders($this->request->getVar('user_id'));

		if($run) {
			$output['data'] = $run;
			$output['message'] = 'Reminders found';
			$output['status'] = 1 ;
		} else {
			$output['message'] = 'No reminder found';
			$output['status'] = 0 ;
		}
	    
		return $this->respond($output);
	}

	//Delete Reminder
	public function deleteReminder() {
		$this->validation->setRule('id','id','required');		
		$this->validation->setRule('user_id','user_id','required');

		if($this->validation->withRequest($this->request)->run()==false) {	   
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}
		try{
			$run = $this->common_model->DeleteData(
				'reminders',
				[
					'id' => $this->request->getVar('id'),
					'user_id' => $this->request->getVar('user_id'),
				]
			);
			if($run) {
				$output['data'] = $run;
				$output['message'] = 'Reminders deleted successfully!';
				$output['status'] = 1 ;
			} else {
				$output['message'] = 'No reminder found';
				$output['status'] = 0 ;
			}
			
			return $this->respond($output);
		}
		catch (\Exception $e) {
			return $e->getMessage();
			
		}		
	}

	//Edit Reminder
	public function editReminder() {
		$this->validation->setRule('id','id','required');		
		$this->validation->setRule('user_id','user_id','required');

		if($this->validation->withRequest($this->request)->run()==false) {	   
			$output['errors']=$this->validation->getErrors();
			$output['message']='check parameters';
			$output['status']= 2;     
			return $this->respond($output);
		}
		try{	
			$insertData['category'] = $this->request->getVar('category');		
			$insertData['heading'] = $this->request->getVar('heading');
			$insertData['time'] = $this->request->getVar('time');
			$insertData['hour'] = $this->request->getVar('hour');
			$insertData['minute'] = $this->request->getVar('minute');
			$insertData['meridiem'] = $this->request->getVar('meridiem');
			$insertData['date'] = $this->request->getVar('date');
			$insertData['repeat_type'] = $this->request->getVar('repeat');
			$insertData['notes'] = $this->request->getVar('notes');

			$run = $this->common_model->UpdateData(
				'reminders',
				[
					'id' => $this->request->getVar('id'),
					'user_id' => $this->request->getVar('user_id'),
				],
				$insertData
			);

			if($run) {
				$output['data'] = $this->common_model->GetDataById('reminders',$this->request->getVar('id'));;
				$output['message'] = 'Reminders edited successfully!';
				$output['status'] = 1 ;
			} else {
				$output['message'] = 'No reminder found';
				$output['status'] = 0 ;
			}
			
			return $this->respond($output);
		}
		catch (\Exception $e) {
			return $e->getMessage();
			
		}		
	}
// get all reminders for notifications

	public function getReminderFcm() {
		$run = $this->common_model->getFcmReminders();
		$currentTime = gmdate('H:i');
		if( !empty($run) ){
		
			foreach ($run as $rn){		
				$device_Token =  $rn->device_token; 
				$reminderCat =  isset($rn->category) ? $rn->category : 'Reminder';
				$reminderHeading =  isset($rn->heading) ? $rn->heading : 'Reminder for Motherocity';
				$reminderTime = date('H:i',  strtotime($rn->time) ); 
				
				if($reminderTime == $currentTime){
					$serverkey = 'AAAAS1yxLE0:APA91bELa0qeSeRefVeMqLri2dTlQSAgg04x5SINhkvVW5wAUniTTjJZWDmDROEdAzWfoJ-VsktwUNRCAhFNjc2TJ34p7_Gx2AmseURyC5zQvB38IrOKkeRM4KfUZDB1TtuHyIRNMolH';// this is a Firebase server key
					
					$data = array(
					'registration_ids' => [$device_Token],
					 "priority"  => "high",
                     "collapse_key" => "type_a",
					'notification' => 
						array(
							'body' => $reminderHeading,
							'title'=> $reminderCat,
							
						),
						"data" =>array(
							'body' => $reminderHeading,
							'title'=> $reminderCat,
							
						),
					);  
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,"https://fcm.googleapis.com/fcm/send");
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));  //Post Fields
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: key='.$serverkey));
					$output = json_decode(curl_exec($ch),true); 
					// $output = curl_exec ($ch);
					// curl_close ($ch);
					 print_r ($output);
					
					//run logs when notification sent
					$insertData['date'] = date('Y-m-d H:i:s');		
					$insertData['type'] = "Reminder Notification";	
					$insertData['data'] = $output ;		
					$runs = $this->common_model->insertData('cron_logs', $insertData);
				
				}
			}
		}
		else{
		    die('No data found');
		}
		
	}

	public function tipsJournal( $msg = 'success'){ 
	
		$table_name= 'tips_management';
		$userID = $this->request->getVar('user_id'); 
		if(empty($userID)){
			return $this->respond(["user id required"]); 
		} 
		try{    
			$builder = $this->db->table("users as twd");
			$builder->select('delivery_date')->where('twd.id', $userID);
			$delivery_date = $builder->get()->getResult();  
			$yeardstartdate = isset($delivery_date[0]->delivery_date)? $delivery_date[0]->delivery_date : date("Y-m-d"); 
				
			$today_date = date('Y-m-d');  
			$monday = date('Y-m-d', strtotime("last monday", strtotime($yeardstartdate)));
			$sunday = date('Y-m-d', strtotime("next sunday", strtotime($yeardstartdate)));  
			
			
			$i = 1;
			$j = 0;
			$k = 0;
			$count = 0;
			$weekData = [];
			$dayData = [];
			$totalWeek = 53; 
			 
			$delivery_date = $yeardstartdate; 
			
			if($delivery_date){
				while($totalWeek > 0){ 
					$lastDate = date('Y-m-d', strtotime("next sunday", strtotime($delivery_date))); 
					// echo $difference_btween_strtandend = $lastDate - $delivery_date;
					$diff = abs(strtotime($lastDate) - strtotime($delivery_date));
					$years = floor($diff / (365*60*60*24));
					$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
					$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
					$days = $days + 1;

					$newWeekArray = $dayData = [];  
					$day_i = 0; 
					$delivery_date_day = $delivery_date; 
					for($day=1; $day <= $days; $day++){
						
						$get_week_data =  $this->common_model->GetWeeklyDataTipsJournals($i, $day, $table_name);  
 
						if($day > 1){
							$delivery_date_day = date("Y-m-d", strtotime("+1 day", strtotime($delivery_date_day)));
						}
						
						$dayData["date"] = $delivery_date_day;
						$dayData["week"] = $i;
						$dayData["day"] = $day;
						$dayData["data"] = $get_week_data;
						
						$newWeekArray[] = $dayData; 
					}
					    
				
					if(strtotime($today_date) >= strtotime($delivery_date) && strtotime($today_date) <= strtotime($lastDate)){
						$currentDay = true;
					}else{
						$currentDay = false;
					}
			 
					if(!empty($newWeekArray)){
						$newWeekData = array();
						$newWeekData[0]["weekNumber"] = "Week ".$i;
						$newWeekData[0]["weekStartDate"] = $delivery_date;
						$newWeekData[0]["weekEndDate"] = $lastDate;
						$newWeekData[0]["currentWeek"] = $currentDay;
						$newWeekData[0]["days"] = $newWeekArray;
						$weekData[] = $newWeekData;
					}  
					$i++; 
					$delivery_date = date("Y-m-d", strtotime("+1 day", strtotime($lastDate)));
					$totalWeek--;
				}
				$output['data'] = $weekData; 
			} 

			$output['message'] = $msg; 
			$output['code'] = 200; 
			return $this->respond($output); 
		}
		catch (\Exception $e) {
			return $e->getMessage(); 
		}  
	}
}
