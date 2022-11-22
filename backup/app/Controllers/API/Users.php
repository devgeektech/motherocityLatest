<?php namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\ContentModel;
use App\Models\Common_model;
use App\Controllers\API\CommonTrait;
use CodeIgniter\HTTP\RequestInterface;
class Users extends ResourceController
{
    use ResponseTrait;
    use CommonTrait;
    protected $req;
    // get all product
    protected $validation = null;
    public function __construct()
    {
        $this->common_model = new Common_model();
        $this->format = 'json';
        $this->validation = \Config\Services::validation();
        $this->db      = \Config\Database::connect();
        $this->req = \Config\Services::request()->getVar();
    }
    public function index()
    {
        return $this->failNotFound('API not serviceable');
    }

    // get content product
    public function getContent($page)
    {
        $model = new ContentModel();
        $data = $model->where(['page' => $page])->first();
        if($data){
            $res['status'] = 200;
            $res['data'] = $data;
            return $this->respond($res , 200);
        }else{
            return $this->failNotFound('No Data Found with page '.$page);
        }
    }
   
    public function GetTaxonomies($table)
    {
        
        if (isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id']) ) 
        {
            $where = "user_id=0 OR user_id=".$_REQUEST['user_id'];
            $data = $this->db->table($table)->where($where)->get()->getResult();
            if($data){
                $res['status'] = 200;
                $res['data'] = $data;
                return $this->respond($res , 200);
            }
            else
            {
                return $this->failNotFound('No '.$table.' Found ');
            }
        }
        else
        {
            return $this->failNotFound('Invalid parameter ');
        }
    }
    public function GetStates()
    {
        
        $data = $this->db->table('states')->get()->getResult();
        if($data){
            $res['status'] = 200;
            $res['data'] = $data;
            return $this->respond($res , 200);
        }
        else
        {
            return $this->failNotFound('No States Found ');
        }
    }
    public function GetCities()
    {
        if (isset($_REQUEST['state_id']) && !empty($_REQUEST['state_id']) ) 
        {
            $data = $this->db->table('cities')->where(['state_id' => $_REQUEST['state_id']])->get()->getResult();
            if($data){
                $res['status'] = 200;
                $res['data'] = $data;
                return $this->respond($res , 200);
            }
            else
            {
                return $this->failNotFound('No Cities Found ');
            }
        } 
        else
        {
            return $this->failNotFound('Invalid parameter ');
        }
    }
    public function getUserById()
    {
        $data = [];
        if (isset($_REQUEST['id']) && !empty($_REQUEST['id']) ) {
         
            $data = $this->GetUserDetails($_REQUEST['id']);
            if($data){
            $res['status'] = 200;
            $res['data'] = $data;
            return $this->respond($res , 200);
        }else{
            return $this->failNotFound('No user Found ');
        }
        }
        else
        {
            return $this->failNotFound('Invalid parameter ');
        }
        
    }
    public function login()
    {
         if($this->validatedRegularLogin()) 
         {
            $model = new UserModel();
            $req = $this->request->getVar();
            $linkedin_id = $req['linkedin_id'];
            $check = $model->where(['linkedin_id' => $linkedin_id])->first();
            $insert['first_name'] = $req['first_name'];
            $insert['last_name'] = $req['last_name'];
            $insert['token'] = $req['token'];
            
            
            if (!$check) 
            {
                
                $insert['email'] = $req['email'];
                $insert['linkedin_id'] = $req['linkedin_id'];
                $insert['created_at'] = date('Y-m-d h:i');
                $insert['updated_at'] = date('Y-m-d h:i');
                $id = $model->insert($insert);
                if ($req['image'] != 'null') 
                {
                    $insertImg['image'] = $req['image'] ;
                    $insertImg['user_id'] = $id;
                    $this->db->table('user_images')->insert($insertImg);
                }
                
            }
            else
            {
                $id = $check['id'];
                $model->update($check['id'] , $insert);
                
            }
            $data = $this->GetUserDetails($id);
            $response = parent::buildResponse(200 , 'success', $data, 'Successfully Login.');
            return $this->respond($response, 200);
         }
         else 
         {
            $errors = join(',', $this->validation->getErrors());
            return $this->failValidationError($errors);
        }
    }
    public function updateUser()
    { 
        $model = new UserModel();
        $this->req = $this->request->getVar();
        if (!isset($this->req['token']) || !isset($this->req['user_id']) || empty($this->req['token'])) 
        {
            return $this->failNotFound('Access token and user_id is required');
        }

        $token = $this->req['token'];
        $user = $model->where('token', $token)->where('id', $this->req['user_id'])->first();
        if ($user) 
        {
           
            if (isset( $this->req['first_name'])) 
            {
                $insert['first_name'] = $this->req['first_name'];
            }
            if (isset( $this->req['last_name'])) 
            {
                $insert['last_name'] = $this->req['last_name'];
            }
            if (isset( $this->req['state'])) 
            {
                $insert['state'] = $this->req['state'];
            }
            if (isset( $this->req['city'])) 
            {
                $insert['city'] = $this->req['city'];
            }
            if (isset( $this->req['headline'])) 
            {
                $insert['headline'] = $this->req['headline'];
            }
            if (isset( $this->req['email'])) 
            {
                $insert['email'] = $this->req['email'];
            }
            if (isset( $this->req['about_me'])) 
            {
                $insert['about_me'] = $this->req['about_me'];
            }
            
            if (isset( $this->req['my_skills'])) 
            {
                $insert['my_skills'] = $this->req['my_skills'];
            }
            if (isset( $this->req['free_time_act'])) 
            {
                $insert['free_time_act'] = $this->req['free_time_act'];
            }
            if (isset( $this->req['dumbest_act'])) 
            {
                $insert['dumbest_act'] = $this->req['dumbest_act'];
            }
            
            if (isset( $this->req['category'])) {
                $insert['category'] = $this->req['category'];
            }
            if (isset( $this->req['interest'])) {
                $insert['interest'] = $this->req['interest'];
            }
            if (isset( $this->req['career_goals'])) {
                $insert['career_goals'] = $this->req['career_goals'];
            }
            if (isset( $this->req['privacy_status'])) {
                $insert['privacy_status'] = $this->req['privacy_status'];
            }

            if ($this->request->getFileMultiple('images')) {
                foreach ($this->request->getFileMultiple('images') as $key => $file) 
                { 
                    if(! $file->isValid())
                    {
                        continue;
                    }

                    $newName = explode('.',$file->getName());
                    $ext = end($newName);
                    $fileName = 'assets/upload/'.rand().time().'.'.$ext;
                    move_uploaded_file($file->getTempName() , $fileName);
                    $insertImg['image']= base_url().'/'.$fileName ; 
                    $insertImg['user_id'] = $user['id'];
                    $this->db->table('user_images')->insert($insertImg);

                }
                
            }
            $model->update($user['id'] , $insert);
            $data = $this->GetUserDetails($user['id']);
            $response = parent::buildResponse(200 , 'success', $data, 'Successfully Updated.');
            return $this->respond($response, 200);
        } 
        else 
        {
            return $this->failNotFound('Access token or user id is invalid');
        }
    }
    public function addTaxonomy($table)
    { 
        $model = new UserModel();
        
        if (!isset($this->req['token']) || !isset($this->req['user_id']) || empty($this->req['token'])) 
        {
            return $this->failNotFound('Access token and user_id is required');
        }

        $token = $this->req['token'];
        $user = $model->where('token', $token)->where('id', $this->req['user_id'])->first();
        if ($user) 
        {
            $insert['title'] = $this->req['title'];
            $insert['user_id'] = $user['id'];
            $id = $this->db->table($table)->insert($insert);
            $data = $this->db->table($table)->where('id' , $id)->first();
            $response = parent::buildResponse(200 , 'success', $data, 'Successfully added.');
            return $this->respond($response, 200);
        } 
        else 
        {
            return $this->failNotFound('Access token or user id is invalid');
        }
    }
    

    private function validatedRegularLogin() {
        $this->validation->setRules([
            'first_name' => ['label' => 'First Name', 'rules' => 'required|max_length[50]'],
            'linkedin_id' => ['label' => 'linkedin_id', 'rules' => 'required'],
            'image' => ['label' => 'image', 'rules' => 'required'],
            'token' => ['label' => 'token', 'rules' => 'required'],
            'last_name' => ['label' => 'Last Name', 'rules' => 'required|max_length[50]'],
            'email' => ['label' => 'Email','rules' => 'required|max_length[250]|valid_email'],
        ]);
        if ($this->validation->withRequest($this->request)->run()) {
            return true;
        } else {
            return false;
        }
    }
   
    

}