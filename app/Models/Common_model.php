<?php

namespace App\Models;

use CodeIgniter\Model;

class Common_model extends Model {

  public function __construct() {
    //parent::__construct();
    $this->db = \Config\Database::connect(); 
    $this->email = \Config\Services::email();     
  }


  public function GetAllData($table,$where=null,$ob=null,$obc='DESC',$limit=null,$offset=null,$select=null){
  //echo "hello2";
    try {
        $builder = $this->db->table($table);
          if($select) {
          $builder->select($select);
        }
        if($where) {
          $builder->where($where);
        }

        if($ob) {
          $builder->orderBy($ob,$obc);
        }
        if($limit) {
          $builder->limit($limit,$offset);
        }
        $query = $builder->get();
          //echo $this->db->getLastQuery();
        if ($query->getRow()) {
            // code...
            return $query->getResultArray();
        }
        
    } catch (\Exception $e) {
        return $e->getMessage();
        
    }
  }
  public function GetCountData($table,$where=null){
    //echo "hello2";
        try {
            $builder = $this->db->table($table);
            if($where) {
              $builder->where($where);
            }

           return $query = $builder->countAllResults();
              //echo $this->db->getLastQuery();
            
            
        } catch (\Exception $e) {
            return $e->getMessage();
            
        }
  }

  public function GetDataByOrderLimit($table,$where,$odf=NULL,$odc=NULL,$limit=NULL,$start=0) {

                    $builder = $this->db->table($table);
                    if($where) {
                      $builder->where($where);
                    }        

                    if($odf && $odc){
                      $builder->orderBy($odf,$odc);
                    }
                       
                    if($limit){
                      $builder->limit($limit, $start);
                    }

                    //$sql=$builder->get($table);
                    $query = $builder->get();
                    if ($query->getRow()) {
                        // code...
                       return $query->getResultArray();
                    }
    }

    public function GetDataById($table,$value) {
        //echo $table. $value;
         try {                
                $builder = $this->db->table($table);
                $builder->where('id', $value);
                $query = $builder->get();
                if ($query->getRow()) {
                    // code...
                   return $query->getRowArray();
                } else {
                    return array();
                }
            } catch (\Exception $e) {
                    echo $e->getMessage();
            
        }

  }


  public function GetSpecialDataById($table,$value) {
    //echo $table. $value;
     try {                
            $builder = $this->db->table($table);
            $builder->where('specialist_id', $value);
            $query = $builder->get();

           
            if ($query->getRow()) {
                // code...
               return $query->getRowArray();
            } else {
                return array();
            }
        } catch (\Exception $e) {
                echo $e->getMessage();
        
    }

  }

  public function InsertData($table,$data) {

    //echo $table; print_r($data); /*
    $builder = $this->db->table($table);
     if($builder->insert($data)){
      return $this->db->insertID();
    } else {
      return false;
    }
  }

  public function GetSingleData($table,$where=null,$ob=null,$obc='desc' , $select=null){
    $builder = $this->db->table($table);
     if($select) {
      $builder->select($select);
    }
    if($where) {
      $builder->where($where);
    }
    if($ob) {
      $builder->orderBy($ob,$obc);
    }
    $query = $builder->get();
        if ($query->getRow()) {
                        // code...
           return $query->getRowArray();
        } else {
            return array();
        }
  }

  public function UpdateData($table, $where, $data) {
         
    $builder = $this->db->table($table);
    $builder->where($where);
    $builder->update($data);
   // echo $builder->last_query();die;
    return ($this->db->affectedRows() > 0)?true:true;
  } 

  public function UpdateFCM($table, $where, $data) { 
    // print_r($where);
    // die;

   $builder->where('id', $id);
   $builder->update($table, $data);

    return ($this->db->affectedRows() > 0)?true:true;
  }
  
  public function DeleteData($table, $where) {
    $builder = $this->db->table($table);
    $builder->where($where);
    $builder->delete();
    
    return ($this->db->affectedRows() > 0)?true:false;     
  }

  public function GetColumnName($table,$where=null,$name=null,$double=null,$order_by=null,$order_col=null,$group_by=null) {     
    $builder = $this->db->table($table);
    if($name){
      $builder->select(implode(',',$name));
    } else {
      $builder->select('*');
    }
    
    if($where){
      $builder->where($where);
    }
        
    if($group_by) {
      $builder->groupBy($group_by);
    }
    
    if($order_by && $order_col){
      $builder->orderBy($order_by,$order_col);
    }
    
    $query = $builder->get();
    if($double){
      $data = array();
    } else {
      $data = false;
    }

    if($query->getRow()){
      if($double){
        $data = $query->getResult();
      } else {
        $data = $query->getRow();
      } 
      
    }
    return $data;
  }
   public function SendMail($toz,$sub,$body) {

    //  $to =$toz;  
    //  $from ='';
    // $headers ="From: ".$admin[0]['mail_from_title']." <".$from."> \n";
    // $headers .= "MIME-Version: 1.0\n";
    // $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
    // $subject =$sub;

    $config = array();
    $config['mailType'] = "html";
    $config['charset'] = "utf-8";
    $config['newline'] = "\r\n";
    $config['CRLF'] = "\r\n";
    $config['wordwrap'] = TRUE;
    $config['validate'] = FALSE;

    $this->email->initialize($config);
    $this->email->setFrom(Email, Project);
    $this->email->setTo($toz);
    //$this->email->setMailtype("html"); 
    $this->email->setSubject($sub);
    $msg = view('mail/common' ,['subject' =>$sub ,'body' =>$body ]);
    $this->email->setMessage($msg);
    $run  = $this->email->send();
    if($run) {
      return 1;
    } else {
      return 0;
    }

  }

  public function getBlogsData($type = 0, $limit = 50, $catId = null, $exclude = null, $whereInArr = null){
    $builder = $this->db->table("blog_management as blog");
    $builder->select('blog.id, blog.title, blog.category as category_id, blog.description, CONCAT ("'.base_url().'/" , blog.featured_image ) as featured_image  , blog.summary, blog.blog_type, blog.created_at, cb.title as category_title');
    $builder->join('content_blog as cb', 'blog.category = cb.id', "left");
    $builder->orderBy('created_at DESC');
    $builder->where('blog_type', $type);

    if($catId != null){
      $builder->where('category', $catId);
    }

    if($exclude != null){
      $builder->whereNotIn('blog.id', $exclude);
    }

    if($whereInArr != null){
      $builder->whereIn('blog.id', $whereInArr);
    }

    $builder->limit($limit);

    $data = $builder->get()->getResult();

    if($data){
      return $data;
    }
    return [];
  }

  public function homePickedBlogs(){
    $builder = $this->db->table("blog_management as blog");
    $builder->select('blog.id, blog.title, blog.description, blog.featured_image, blog.summary, blog.blog_type, blog.created_at, cb.title as category_title');
    $builder->join('content_blog as cb', 'blog.category = cb.id', "left");
    $builder->where('blog.blog_type', 3);
    $builder->orderBy('created_at DESC');
    $data = $builder->get()->getResult();
    if($data){
      return $data;
    }
    return [];
  }

  //get tip of the day with related content
  public function getTipWithContent(){
    $builder = $this->db->table("tips_management as tips");
    $builder->select('tips.id, tips.title, tips.is_free, tips.price, tips.week_no, tips.days, tips.preview, tips.tips_date, tips.created_at, blog.featured_image, blog.summary, blog.blog_type, blog.created_at, cb.title as category_title');
    $builder->join('content_blog as cb', 'blog.category = cb.id', "left");
    $builder->join('content_blog as cb', 'blog.category = cb.id', "left");
    $builder->orderBy('created_at DESC');
    $builder->limit(50);
    $data = $builder->get()->getResult();
    if($data){
      return $data;
    }
    return [];
  }

  public function getBlogById($id){
    $builder = $this->db->table("blog_management as blog");
    $builder->select('blog.id, blog.title, blog.description, blog.featured_image, blog.summary, blog.blog_type, blog.created_at, cb.title as category_title');
    $builder->join('content_blog as cb', 'blog.category = cb.id', "left");
    $builder->where('blog.id', $id);
    $builder->orderBy('created_at DESC');
    $data = $builder->get()->getResult();
    if($data){
      return $data;
    }
    return [];
  }

    //get tip of the day with related content
    public function getToolkitCategory(){
      $builder = $this->db->table("nutrition_category");
      $builder->orderBy('created_at ASC');
      $builder->where('parent',0);
      $query = $builder->get();
      if ($query->getRow()) {
        // code...
        return $query->getResultArray();
      }
      else{
        return [];
      }
    }
    //get all reminders
    public function getAllReminders($user_id){
      $builder = $this->db->table("reminders");
      $builder->orderBy('created_at DESC');
      $builder->where('user_id',$user_id);
      $query = $builder->get();
      if ($query->getRow()) {
        // code...
        return $query->getResultArray();
      }
      else{
        return [];
      }
    }

    //get all reminders
    public function getTipOfTheDay($weekNo, $weekDay){
     // echo $weekNo. ' '. $weekDay;
     
      $builder = $this->db->table("tips_management");
      $builder->orderBy('created_at DESC');
      $builder->where('week_no',$weekNo);
      $builder->where('days',$weekDay);      
      $query = $builder->get();  
      if ($query->getRow()) {        
        $r = $query->getResultArray();
        return $r[0];
      }
      else{ 
       // echo $weekNo. ' '. $weekDay;
        $builder->where('week_no',$weekNo);
        $builder->where('days',$weekDay - 1);
        $query = $builder->get();  
        if ($query->getRow()) {
          $r = $query->getResultArray();
          return $r[0];
        }
        else{
          return [];
        }
      }
    }

    //Get blogs whereIn
    public function getBlogsByIds($whereIn){
      // return $whereIn;
      $builder = $this->db->table("blog_management as blog");
      $builder->select('blog.id, blog.title, blog.category as category_id, blog.description, CONCAT ("'.base_url().'/" , blog.featured_image ) as featured_image  , blog.summary, blog.blog_type, blog.created_at, cb.title as category_title');
      $builder->join('content_blog as cb', 'blog.category = cb.id', "left");
      $builder->orderBy('created_at DESC');

      if($whereIn != null){
        $builder->whereIn('blog.id',$whereIn);
      }

      $data = $builder->get()->getResult();

      if($data){
        return $data;
      }
      return [];
  }

 

  public function getspecialistByIds($whereIn){
    
    $builder = $this->db->table("users as sp");    
    $builder->select('sp.id, sp.name, sp.email, sp.country, sp.phone, sp.lat, sp.lng, sp.user_type, sp.office_area, CONCAT ("'.base_url().'/" , sp.profile_image ) as profile_image, sp.your_speciality, sp.few_word,sc.title as your_expertise'); 
    $builder->join('specialist_category as sc', 'sp.id = sc.id', "left");   
    if($whereIn != null){
      $builder->whereIn('sp.id', $whereIn);
    } 
    $data = $builder->get()->getResult(); 
    if($data){
      return $data;
    }
    return [];
  }

  //Check specialist already saved or not
  
  public function getSpecialistSave($specialistID,$userID){
    $builder = $this->db->table("saved_specialists as ss");
    $builder->select('ss.specialist_id');
    $builder->where('ss.specialist_id', $specialistID);
    $builder->where('ss.user_id', $userID);
    $data = $builder->get()->getResult();
    if($data){
      return $data[0];
    }
    return [];
  }



  //Get specialist detail
  public function getSpecialistDetail($id){
    $builder = $this->db->table("users as sp");
    $builder->select('sp.id, sp.name, sp.email, sp.phone, sp.country, sp.few_word, CONCAT ("'.base_url().'/" , sp.profile_image ) as profile_image, sp.office_area, COUNT(sr.id) as total_reviews');
    $builder->join('specialist_reviews as sr', 'sp.id = sr.specialist_id', "left");
    $builder->where('sp.id', $id);
    $builder->where('sp.user_type', 1);
    $data = $builder->get()->getResult();

    if($data){
      return $data;
    }
    return [];
  }


  //Get hydration today
  public function gethydration($id){

    $curr_date= date('Y-m-d'); 
    $builder = $this->db->table("tracking_hydration as th");
    $builder->select('*'); 
    $builder->where('th.user_id', $id); 
    $builder->where('DATE(created_at)', $curr_date); 
    $data = $builder->get()->getResult(); 
    if($data){
      return $data;
    }
    return [];
  }
  //Get hydration week
  public function gethydrationweek($id){ 
    $getCurrentDateLastMonday = date('Y-m-d',strtotime('last monday')); 
    $builder = $this->db->table("tracking_hydration as th");
    $builder->select('*'); 
    $builder->where('th.user_id', $id); 
    $builder->where("DATE(created_at) >=",$getCurrentDateLastMonday); 
    $data = $builder->get()->getResult(); 
    if($data){
      return $data;
    }
    return [];
  }

    //Get hydration year
    public function gethydrationyear($id){ 
      $getCurrentDateLastYear =  date('Y-m-d', strtotime('-1 year')); 
      $builder = $this->db->table("tracking_hydration as th");
      $builder->select('*'); 
      $builder->where('th.user_id', $id); 
      $builder->where("DATE(created_at) >=",$getCurrentDateLastYear); 
      $data = $builder->get()->getResult(); 
      if($data){
        return $data;
      }
      return [];
    }


     //Get MealsSnacks today
  public function getMealsSnacks($id){

    $curr_date= date('Y-m-d'); 
    $builder = $this->db->table("tracking_meal_snacks as tms");
    $builder->select('*'); 
    $builder->where('tms.user_id', $id); 
    $builder->where('DATE(created_at)', $curr_date); 
    $data = $builder->get()->getResult(); 
    if($data){
      return $data;
    }
    return [];
  }
  //Get MealsSnacks week
  public function getMealsSnacksweek($id){ 
    $getCurrentDateLastMonday = date('Y-m-d',strtotime('last monday')); 
    $builder = $this->db->table("tracking_meal_snacks as tms");
    $builder->select('*'); 
    $builder->where('tms.user_id', $id); 
    $builder->where("DATE(created_at) >=",$getCurrentDateLastMonday); 
    $data = $builder->get()->getResult(); 
    if($data){
      return $data;
    }
    return [];
  }

    //Get MealsSnacks year
    public function getMealsSnacksyear($id){ 
      $getCurrentDateLastYear =  date('Y-m-d', strtotime('-1 year'));
      $builder = $this->db->table("tracking_meal_snacks as tms");
      $builder->select('*'); 
      $builder->where('tms.user_id', $id); 
      $builder->where("DATE(created_at) >=",$getCurrentDateLastYear); 
      $data = $builder->get()->getResult(); 
      if($data){
        return $data;
      }
      return [];
    }


     //Get Feeding today
  public function getFeeding($id){

    $curr_date= date('Y-m-d'); 
    $builder = $this->db->table("tracking_feeding as tf");
    $builder->select('*'); 
    $builder->where('tf.user_id', $id); 
    $builder->where('DATE(created_at)', $curr_date); 
    $data = $builder->get()->getResult(); 
    if($data){
      return $data;
    }
    return [];
  }
  //Get Feeding week
  public function getFeedingweek($id){ 
    $getCurrentDateLastMonday = date('Y-m-d',strtotime('last monday')); 
    $builder = $this->db->table("tracking_feeding as tf");
    $builder->select('*'); 
    $builder->where('tf.user_id', $id); 
    $builder->where("DATE(created_at) >=",$getCurrentDateLastMonday); 
    $data = $builder->get()->getResult(); 
    if($data){
      return $data;
    }
    return [];
  }

    //Get Feeding year
    public function getFeedingyear($id){ 
      $getCurrentDateLastYear =  date('Y-m-d', strtotime('-1 year'));
      $builder = $this->db->table("tracking_feeding as tf");
      $builder->select('*'); 
      $builder->where('tf.user_id', $id); 
      $builder->where("DATE(created_at) >=",$getCurrentDateLastYear); 
      $data = $builder->get()->getResult(); 
      if($data){
        return $data;
      }
      return [];
    }

    //Get wet diapers today
  public function getWetDiapers($id){

    $curr_date= date('Y-m-d'); 
    $builder = $this->db->table("tracking_wet_diaper as twd");
    $builder->select('*'); 
    $builder->where('twd.user_id', $id); 
    $builder->where('DATE(created_at)', $curr_date); 
    $data = $builder->get()->getResult(); 
    if($data){
      return $data;
    }
    return [];
  }
  //Get wet diapers week
  public function getWetDiapersweek($id){ 
    $getCurrentDateLastMonday = date('Y-m-d',strtotime('last monday')); 
    $builder = $this->db->table("tracking_wet_diaper as twd");
    $builder->select('*'); 
    $builder->where('twd.user_id', $id); 
    $builder->where("DATE(created_at) >=",$getCurrentDateLastMonday); 
    $data = $builder->get()->getResult(); 
    if($data){
      return $data;
    }
    return [];
  }

    //Get wet diapers year
    public function getWetDiapersyear($id){ 
      $getCurrentDateLastYear =  date('Y-m-d', strtotime('-1 year'));
      $builder = $this->db->table("tracking_wet_diaper as twd");
      $builder->select('*'); 
      $builder->where('twd.user_id', $id); 
      $builder->where("DATE(created_at) >=",$getCurrentDateLastYear); 
      $data = $builder->get()->getResult(); 
      if($data){
        return $data;
      }
      return [];
    }

     //Get Health today
  public function getHealthToday($id){

    $curr_date= date('Y-m-d'); 
    $builder = $this->db->table("tracking_log_your_activity as tlya");
    $builder->select('*'); 
    $builder->where('tlya.user_id', $id); 
    $builder->where('DATE(created_at)', $curr_date); 
    $data = $builder->get()->getResult(); 
    if($data){
      return $data;
    }
    return [];
  }
  //Get Health week
  public function getHealthweek($id){ 
    $getCurrentDateLastMonday = date('Y-m-d',strtotime('last monday')); 
    $builder = $this->db->table("tracking_log_your_activity as tlya");
    $builder->select('*'); 
    $builder->where('tlya.user_id', $id); 
    $builder->where("DATE(created_at) >=",$getCurrentDateLastMonday); 
    $data = $builder->get()->getResult(); 
    if($data){
      return $data;
    }
    return [];
  }

    //Get Health year
    public function getHealthyear($id,$deliveryDate,$getDeliveryDateOneYear){ 
     
      $builder = $this->db->table("tracking_log_your_activity as tlya");
      $builder->select('tlya.*');  
      $builder->where('tlya.user_id', $id); 
      $builder->join('users as us', 'tlya.user_id = us.id', "left");
      $builder->where("us.delivery_date >=",date("Y-m-d",strtotime($deliveryDate)));  
      $builder->where("tlya.created_at <=",date("Y-m-d",strtotime($getDeliveryDateOneYear)));  
      $data = $builder->get()->getResult();   
      if($data){
        return $data;
      }
      return [];
    }

 //Get all reviews of an Specialist
  public function getSpecialistReview($id){
    $response = [];
    $builder = $this->db->table("specialist_reviews as sr");
    $builder->select('sr.id, sr.specialist_id, sr.rating, sr.comment, sr.files, sr.created_at, us.id as user_id, us.name as username, CONCAT ("'.base_url().'/" , us.profile_image ) as user_profile_image');
    $builder->join('users as us', 'sr.user_id = us.id', "left");
    $builder->where('sr.specialist_id', $id);
    $builder->orderBy('created_at DESC');
    $data = $builder->get()->getResult();

    if($data){
      foreach ($data as $d) {
        $response[] = array(
          'id' => $d->id,
          'specialist_id' => $d->specialist_id,
          'rating' => $d->rating,
          'comment' => $d->comment,
          'files' => json_decode( $d->files ),
          'user_id' => $d->user_id,
          'username' => $d->username,
          'user_profile_image' => $d->user_profile_image,
          'created_at' => $d->created_at,
        );
      }
      return $response;
    }

    return [];
  }

  public function getUserLocation($id){
    $builder = $this->db->table("users as sr");
    $builder->select('sr.id, sr.lat, sr.lng');
    $builder->where('sr.id', $id);
    $data = $builder->get()->getResult();
    if($data){
      return $data[0];
    }
    return [];
  }

  //Get distance bw lat long
  public function getDistance($lat,$lng,$categoryId = null){
    if($categoryId == null){
      $catCondition = '';
    }
    else{
      $catCondition = 'AND your_expertise =  '.$categoryId;
    }

    $builder = $this->db->table("users");
    $query = "select * FROM (SELECT *, ((( acos(sin(($lat * pi() / 180))* sin(( `lat` * pi() / 180)) + cos(($lat * pi() /180 )) * cos(( `lat` * pi() / 180)) * cos((( $lng - `lng`) * pi()/180))) ) * 180/pi()) * 60 * 1.1515)as distance FROM `users`
    ) users WHERE distance <= 100 AND user_type = 1 AND is_verified = 1 $catCondition  LIMIT 50";


    $data = $this->db->query($query)->getResultArray();
    if($data){
      return $data;
    }
    return [];
  }

  function getDistanceMiles($latTo,$lngTo, $LatFrom, $LngFrom)
  {    
    $theta = $lngTo - $LngFrom;
    $miles = (sin(deg2rad($latTo)) * sin(deg2rad($LatFrom))) + (cos(deg2rad($latTo)) * cos(deg2rad($LatFrom)) * cos(deg2rad($theta)));
    return $miles = rad2deg($miles);
  }



  //Get average review and count of specialists
  public function getAverageReviews($id){
    $builder = $this->db->table("specialist_reviews as sr");
    $builder->select('COUNT(sr.id) as total_reviews, AVG(sr.rating) as avg_rating');
    $builder->join('users as us', 'sr.user_id = us.id', "left");
    $builder->where('sr.specialist_id', $id);
    $data = $builder->get()->getResult();

    if($data){
      return $data[0];
    }
    return [];
  }

  //Get average review and count of specialists
  public function getSpecialityById($id){
    $builder = $this->db->table("specialist_category");
    $builder->select('title');
    $builder->where('id', $id);
    $data = $builder->get()->getResult();

    if($data){
      return $data[0];
    }
    return [];
  }
  
  //Get all reminders for firebase notification
  public function getFcmReminders(){
    $builder = $this->db->table("reminders as rm");
    $builder->select('rm.*, us.device_token');
    $builder->join('users as us', 'rm.user_id = us.id', "left"); 
    $builder->where('rm.date', date('Y-m-d'));
    $data = $builder->get()->getResult();

    if($data){
      return $data;
    }
    return [];
  }
  public function deleteUsers($table, $id)
 { 
  $builder = $this->db->table($table);
  $builder->whereIn('users.id',$id);  
  $builder->delete();
    
  return ($this->db->affectedRows() > 0)?true:false;     
 }

  // Get today reminder for home screen api

  public function getReminders($user_id){
    $builder = $this->db->table("reminders as rm");
    $builder->select('rm.*');
    $builder->where('rm.user_id', $user_id); 
    $builder->where('rm.date >=', date('Y-m-d')); 
    $data = $builder->get()->getResult(); 
    if($data){
      return $data;
    }
    return [];
  }
  // Get latest 5 Primary blogs

  public function getPrimaryBlogs(){
    $builder = $this->db->table("blog_management as bm");
    $builder->select('bm.*'); 
    $builder->orderBy('created_at DESC');
    $builder->where('blog_type', 1);
    $builder->limit(5);
    $data = $builder->get()->getResult(); 
    if($data){
      return $data;
    }
    return [];
  }

  // Get latest 2 secondry blogs  
  public function getSecondryBlogs(){
    $builder = $this->db->table("blog_management as bm");
    $builder->select('bm.*'); 
    $builder->orderBy('created_at DESC');
    $builder->where('blog_type', 2);
    $builder->limit(2);
    $data = $builder->get()->getResult(); 
    if($data){
      return $data;
    }
    return [];
  }

  public function GetDayData($userid = 0, $startdate = '', $table = '' )
  { 
    $builder = $this->db->table($table);
    $builder->select('*');
    if(!empty($startdate)){
      $builder->where("DATE(created_at) =",$startdate); 
    }
    if(!empty($userid)){
      $builder->where("user_id =",$userid); 
    }
    $data = $builder->get()->getResult();  
    
    if(count($data)){
      return $data;
    }
    return [];
  }

  public function GetWeeklyData($userid = 0, $startdate = '', $enddate = '', $table = '' )
  { 
    $builder = $this->db->table($table);
    $builder->select('*');
    if(!empty($startdate)){
      $builder->where("DATE(created_at) >=",$startdate); 
    }
    if(!empty($enddate)){
      $builder->where("DATE(created_at) <=",$enddate); 
    }
    if(!empty($userid)){
      $builder->where("user_id =",$userid); 
    }
    $data = $builder->get()->getResult();  
    if(count($data)){
      return $data;
    }
    return [];
  }
 
 
  public function UpdatePassword($table,$token,$Password) { 
    $builder = $this->db->table($table);
    $builder->where($token);
    $builder->update($Password);  
    return ($this->db->affectedRows() > 0)?true:true;
  } 


  public function GetDayDataTipsJournals($startdate = '', $table = '' )
  { 
    $builder = $this->db->table($table);
    $builder->select('*');
    if(!empty($startdate)){
      $builder->where("DATE(created_at) =",$startdate); 
    } 
    $data = $builder->get()->getResult();  
    
    if(count($data)){
      return $data;
    }
    return [];
  }

  public function GetWeeklyDataTipsJournals($week = '', $days = '', $table = '' )
  { 
    
    $builder = $this->db->table($table);
    $builder->select('*');
    if(!empty($week)){
      $builder->where("week_no =",$week); 
    }
    if(!empty($days)){
      $builder->where("days =",$days); 
    } 
    $data = $builder->get()->getResult();  
    if(count($data)){
      return $data;
    }
    return [];
  }
}