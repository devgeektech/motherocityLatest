<?php
namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\Common_model;

class userDietChart extends ResourceController { 

    public function __construct()
    { 
    
        $this->common_model = new Common_model();
        $this->format = 'json';
        $this->validation = \Config\Services::validation();
        $this->db      = \Config\Database::connect();
        $this->req = \Config\Services::request()->getVar();
    }

   public function userEmotions(){ 

        $this->validation->setRule('user_id','userID','trim|required');
        $this->validation->setRule('userEmotions','user Emotions','trim|required');
    
        if($this->validation->withRequest($this->request)->run()==false) {     
            $output['errors']=$this->validation->getErrors();
            $output['message']='paramerters are missing'; 
            return $this->respond($output);
        } 
        try{  
            $insertData['user_id'] = $this->request->getVar('user_id');     
            $insertData['userEmotions'] = $this->request->getVar('userEmotions');       
            $emotionsSaved = $this->common_model->insertData('tracking_emotions', $insertData);

        if($emotionsSaved) {
            $output['data'] = $emotionsSaved;
            $output['message'] = 'Data saved successfully!'; 
            $output['code'] = 200; 
        } else {
            $output['message'] = 'something went wrong'; 
        } 
        return $this->respond($output); 
    }
    catch (\Exception $e) {
          return $e->getMessage(); 
        }  
  } 

  public function logYourNutrition(){ 

      // $this->validation->setRule('user_id','user_id','trim|required'); 
      // if($this->validation->withRequest($this->request)->run()==false) {      
      //     $output['errors']=$this->validation->getErrors();
      //     $output['message']='paramerters are missing'; 
      //     return $this->respond($output);
      // } 
      try{   
          $hydrationData = $this->request->getVar("hydration"); 
          $hydrationData = isset($hydrationData) ?  $hydrationData : [];  
          if ($hydrationData) {
              foreach ($hydrationData as $hydrationvalue) {   
                  $insertData['user_id']=  $hydrationvalue->user_id;
                  $insertData['selectType']=  $hydrationvalue->selectType;
                  $insertData['typeDetail']=  $hydrationvalue->typeDetail;
                  $insertData['volume']=  $hydrationvalue->volume;
                  $insertData['time']=  $hydrationvalue->time; 
                  $hydrationSaved = $this->common_model->insertData('tracking_hydration', $insertData);
              } 
          } 
          $mealsSnacksData = $this->request->getVar("meals_snacks"); 
          $mealsSnacksData = isset($mealsSnacksData) ?  $mealsSnacksData : [];  
          if ($mealsSnacksData) {
              foreach ($mealsSnacksData as $value) {   
                  $mealsSnacksData = array(
                      'user_id' => $value->user_id,
                      'selectType' => $value->selectType,
                      'addMeal' =>  $value->addMeal,
                      'time' => $value->time,  
                  );  
                  $mealsSnacksSaved = $this->common_model->insertData('tracking_meal_snacks', $mealsSnacksData);
              } 
          }   
          if($mealsSnacksSaved  && $hydrationData ) {
              $output['data'] = $mealsSnacksSaved;
              $output['message'] = 'Data saved successfully!'; 
              $output['code'] = 200; 
          } else {
              $output['message'] = 'something went wrong'; 
          } 
          return $this->respond($output); 
      } 
      catch (\Exception $e) {
        return $e->getMessage(); 
      }  
  } 


  public function logBabyDetail(){ 

      // $this->validation->setRule('user_id','user_id','trim|required'); 
      // if($this->validation->withRequest($this->request)->run()==false) {      
      //     $output['errors']=$this->validation->getErrors();
      //     $output['message']='paramerters are missing'; 
      //     return $this->respond($output);
      // } 
      try{   
          $feedingData = $this->request->getVar("feeding");
          
          $feedingData = isset($feedingData) ?  $feedingData : [];  
          if (($feedingData)) { 
              foreach ($feedingData as  $key =>$value) {  
                  $insertData['user_id']=  $value->user_id;
                  $insertData['selectType']=  $value->selectType;
                  $insertData['volume']=  $value->volume; 
                  $insertData['time']=  $value->time; 
                  $feedingSaved = $this->common_model->insertData('tracking_feeding', $insertData); 
              }  
          }    
          $wetDiapersData = $this->request->getVar("wet_diapers");  
          $wetDiapersData = isset($wetDiapersData) ?  $wetDiapersData : [];  
          if ($wetDiapersData) { 
              foreach ($wetDiapersData as  $key => $value) {   
                  $wetDiapersData = array(
                      'user_id' => $value->user_id,
                      'selectType' => $value->selectType,
                      'diaper_number' =>  $value->diaper_number,
                      'time' => $value->time, 
                      'color' => $value->color,
                      'smell' => $value->smell,
                      'texture' => $value->texture, 
                  ); 
                  $wetDiapersSaved = $this->common_model->insertData('tracking_wet_diaper', $wetDiapersData); 
              }  
          }    
        
          if($feedingSaved && $wetDiapersSaved ) {
              $output['data'] = $feedingSaved;
              $output['message'] = 'Data saved successfully!'; 
              $output['code'] = 200; 
          } else {
              $output['message'] = 'something went wrong'; 
          } 
          return $this->respond($output); 
      } 
      catch (\Exception $e) {
        return $e->getMessage(); 
      }  
  } 


  public function logYourActivity(){ 

      // $this->validation->setRule('user_id','user_id','trim|required'); 

      // if($this->validation->withRequest($this->request)->run()==false) {      
      //     $output['errors']=$this->validation->getErrors();
      //     $output['message']='paramerters are missing'; 
      //     return $this->respond($output);
      // } 
      try{   
          $healthData = $this->request->getVar("health");
          
          $healthData = isset($healthData) ?  $healthData : [];  
          if ($healthData) {
              foreach ($healthData as $value) {   
                  $insertData['user_id']=  $value->user_id;
                  $insertData['current_weight']=  $value->current_weight;
                  $insertData['current_weight_type']=  $value->current_weight_type;
                  $insertData['measurement_type']=  $value->measurement_type;
                  $insertData['waist']=  $value->waist;
                  $insertData['neck']=  $value->neck;
                  $insertData['arms']=  $value->arms;
                  $insertData['breast']=  $value->breast;
                  $insertData['hips']=  $value->hips;
                  $insertData['thighs']=  $value->thighs; 
                  $insertData['wrist']=  $value->wrist; 
                  $insertData['calves']=  $value->calves; 
                  $healthDataSaved = $this->common_model->insertData('tracking_log_your_activity', $insertData); 
              }  
          }   
          if($healthDataSaved) {
              $output['data'] = $healthDataSaved;
              $output['message'] = 'Data saved successfully!'; 
              $output['code'] = 200; 
          } else {
              $output['message'] = 'something went wrong'; 
          } 
          return $this->respond($output); 
      } 
      catch (\Exception $e) {
        return $e->getMessage(); 
      }  
  } 


 
  
  public function getEmotions(){   
    return $this->GetAllData("tracking_emotions", "Emotion Details");
  }
  public function getHydration(){  
    return $this->GetAllData("tracking_hydration", "Hydration Details");
  }
  public function getMealsSnacks(){  
    return $this->GetAllData("tracking_meal_snacks", "Meals & Snacks Detail");
  }
  public function getFeeding(){  
    return $this->GetAllData("tracking_feeding", "Feeding Detail");
  }
  public function getWetDiapers(){  
    return $this->GetAllData("tracking_wet_diaper", "Wet Diapers Detail");
  }
  public function getHealth(){  
    return $this->GetAllData("tracking_log_your_activity", "Health Details");
  } 

  public function GetAllData($table_name = '', $msg = 'success'){  
    if(empty($table_name)){ 
      return $this->respond(["Table Name required"]);  
    }
    try{    
      $userID = $this->request->getVar('user_id');
      $key = $this->request->getVar('key');
      if(empty($userID)){
        return $this->respond(["user id required"]); 
      }
      if(empty($key)){
        return $this->respond(["key required"]); 
      }
      $builder = $this->db->table("users as twd");
      $builder->select('delivery_date')->where('twd.id', $userID);
      $delivery_date = $builder->get()->getResult(); 
      
      $yeardstartdate = isset($delivery_date[0]->delivery_date)? $delivery_date[0]->delivery_date : date("Y-m-d"); 

      $today_date = date('Y-m-d');
      $monday = date('Y-m-d', strtotime("last monday", strtotime($today_date)));
      $sunday = date('Y-m-d', strtotime("next sunday", strtotime($today_date))); 

      $diff = strtotime($today_date) - strtotime($yeardstartdate); 
      $dayCount= ( intval( (abs(round($diff / 86400)))) ); 
      $weekCount= abs(ceil($dayCount / 7 )); 

      if($key== "today"){ 
        $day_data =  $this->common_model->GetDayData($userID, $today_date, $table_name);  
         
        $output["data"][0]["weekly"][0]['weekNumber'] = "Week ".$weekCount;
        $output["data"][0]["weekly"][0]['days'] = $day_data;
      } 
      if($key== "week"){
        $getWetDiapersData =  $this->common_model->GetWeeklyData($userID, $monday, $sunday, $table_name); 
      
        $dateCheck = $dayData = [];  
        $i_n = 0;
        foreach($getWetDiapersData as $value)
        { 
          $dayDate = date('Y-m-d',strtotime($value->created_at));
        
          if (!in_array($dayDate, $dateCheck))
          { 
            $day_data =  $this->common_model->GetDayData($userID, $dayDate, $table_name); 
            $dayData[$i_n]["date"] = $dayDate;
            
            foreach($day_data as $value)
            { 
              $dayData[$i_n]["data"][] = $value;
            }
            $dateCheck[]=$dayDate;
            $i_n++;
          }
        }
        
        $output["data"][0]["weekly"][0]['weekNumber'] = "Week ".$weekCount;
        $output["data"][0]["weekly"][0]['weekStartData'] = $monday;
        $output["data"][0]["weekly"][0]['weekEndDate'] = $sunday;  
        $output["data"][0]["weekly"][0]['days'] = $dayData;  
      }
      if($key== "year"){   
        
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
            
              $get_week_data =  $this->common_model->GetWeeklyData($userID, $delivery_date, $lastDate, $table_name); 
              
              $dateCheck = $dayData = [];  
              $i_n = 0;
              foreach($get_week_data as $value)
              { 
                $dayDate = date('Y-m-d',strtotime($value->created_at));
            // print_r($dayDate);die;
                if (!in_array($dayDate, $dateCheck))
                {
                  $day_data =  $this->common_model->GetDayData($userID, $dayDate, $table_name); 
                  $dayData[$i_n]["date"] = $dayDate;
                  
                  foreach($day_data as $value)
                  { 
                    $dayData[$i_n]["data"][] = $value;
                  }
                  $dateCheck[]=$dayDate;
                  $i_n++;
                }
              }
              if(!empty($dayData)){
                $newWeekData = array();
                $newWeekData[0]["weekNumber"] = "Week ".$i;
                $newWeekData[0]["weekStartDate"] = $delivery_date;
                $newWeekData[0]["weekEndDate"] = $lastDate;
                $newWeekData[0]["days"] = $dayData;
                $weekData[]["weekly"] = $newWeekData;
              } 
            
              $i++;
    
              $delivery_date = date("Y-m-d", strtotime("+1 day", strtotime($lastDate)));
              $totalWeek--;
          }
          $output['data'] = $weekData; 
        } 
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