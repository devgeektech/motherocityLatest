<?php
use App\Models\Common_model;

global $common_model;
global $session;
global $db;
$session = \Config\Services::session();
$common_model = new App\Models\Common_model();

$db = \Config\Database::connect(); 


if(!function_exists('categoryName')){
    function categoryName($id)
    {
      
        $cat = $GLOBALS["common_model"]->GetSingleData('categories' , array('id'=> $id));
         return $cat['title'];      
      
    }
}
if(!function_exists('getUserById')){
    function getUserById($id)
    {
      
        $user = $GLOBALS["common_model"]->GetSingleData('users' , array('id'=> $id));
         return $user;      
      
    }
}
if(!function_exists('getDatabyId')){
    function getDatabyId($table , $id)
    {
      
        $data = $GLOBALS["common_model"]->GetSingleData($table , array('id'=> $id));
         return $data;      
      
    }
}
function getAllNotifications($id)
{
   

    $data = $GLOBALS["common_model"]->GetAllData('notification' , array('user_id' => $id) , 'id' , 'desc' , 10);
    return $data;

}
function getUnreadNotifications($id)
{

    $data = $GLOBALS["common_model"]->GetAllData('notification' , array('user_id' => $id , 'is_read' => 0));
    return $data;

}

  function slugify($text, string $divider = '-')
  {
  // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, $divider);

    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
      return 'n-a';
    }

    return $text;
  }
  
function greeting_msg() {
   date_default_timezone_set('Asia/Calcutta');

// 24-hour format of an hour without leading zeros (0 through 23)
    $Hour = date('G');

    if ( $Hour >= 5 && $Hour <= 11 ) {
        $greeting = "Good Morning";
    } else if ( $Hour >= 12 && $Hour <= 18 ) {
        $greeting = "Good Afternoon";
    } else if ( $Hour >= 19 || $Hour <= 4 ) {
        $greeting = "Good Evening";
    }
        return $greeting;
}
function humanDate($date) {
   
   return date('d M, Y' , strtotime($date));
        
}

if (! function_exists('CheckRoleAndPermission')) {
    function CheckRoleAndPermission($check_role)
    {
      $login_id = $GLOBALS["session"]->get('admin_id');
      $user = $GLOBALS["common_model"]->GetSingleData('admin',array('id'=>$login_id));
      $role_id = $user['role_id'];
      $user_id = $login_id;
      if($user_id==1){
        return true;
      }
      $result = $GLOBALS["common_model"]->GetSingleData('roles',array('id'=>$role_id));
      $rol = explode(',',$result['role_id']);
      if(in_array($check_role, $rol))
      {
        return true;
      } else {
         return false;
      }
      // $roles = $GLOBALS["db"]->table('roles')->select('*')->where('id',$role_id)->where('FIND_IN_SET('.$check_role.',role_id)')->get();
      
      
      // if($rows > 0){
      //   return true;
      // } else {
      //   return false;
      // } 
    }
}
