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
        $builder->orWhere('days',$weekDay - 1);
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

  //Get specialist detail
  public function getSpecialistDetail($id){
    $builder = $this->db->table("users as sp");
    $builder->select('sp.id, sp.name, sp.email, sp.phone, sp.country, sp.year_experience, sp.certification as qualification, sp.fees, sp.insurance, sp.office_hours, sp.office_days, sp.your_website, sp.few_word, CONCAT ("'.base_url().'/" , sp.profile_image ) as profile_image, sp.office_area, COUNT(sr.id) as total_reviews, sc.title as speciality');
    $builder->join('specialist_reviews as sr', 'sp.id = sr.specialist_id', "left");
    $builder->join('specialist_category as sc', 'sp.your_expertise = sc.id', "left");
    $builder->where('sp.id', $id);
    $builder->where('sp.user_type', 1);
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

  //Get average review and count of specialists
  public function getAverageReviews($id){
    $builder = $this->db->table("specialist_reviews as sr");
    $builder->select('COUNT(sr.id) as total_reviews, AVG(sr.rating) as avg_rating');
    $builder->join('users as us', 'sr.user_id = us.id', "left");
    $builder->where('sr.specialist_id', $id);
    $builder->orderBy('sr.created_at DESC');
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

  //Get expertise category
  public function getExpertise(){
    $builder = $this->db->table("specialist_category");
    $builder->select('id, title, description');
    $data = $builder->get()->getResult();

    if($data){
      return $data;
    }
    return [];
  }
}