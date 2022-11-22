<?php
namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\Common_model;

class Specialist extends ResourceController { 

    public function __construct()
	{ 
        $this->common_model = new Common_model();
		$this->format = 'json';
		$this->validation = \Config\Services::validation();
		$this->db      = \Config\Database::connect();
		$this->req = \Config\Services::request()->getVar();
	}
 
    public function saveLaterSpecialist() {
        $this->validation->setRule('user_id','user_id','trim|required');
		$this->validation->setRule('specialist_id','specialist_id','trim|required');
        
		if($this->validation->withRequest($this->request)->run()==false) {	   
			$output['errors']=$this->validation->getErrors();
			$output['message']='paramerters are missing'; 
			return $this->respond($output);
		}

        try{
            $isExists =  $this->common_model->GetSingleData(
                "saved_specialists",
                ['specialist_id' => $this->request->getVar('user_id')]
            );

            if($isExists){
                $output['data'] = [];
                $output['message'] = 'You already saved the specialist'; 
                $output['code'] = 200; 
                return $this->respond($output);
            }
            
            $insertData['user_id'] = $this->request->getVar('user_id');		
            $insertData['specialist_id'] = $this->request->getVar('specialist_id');		
            $run = $this->common_model->insertData('saved_specialists', $insertData);

            if($run) {
                $output['data'] = $run;
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
 
    public function getSaveLaterSpecialists() {
        $getSpecialistDetailsArr=[];
        $totalReviews = 0;
		$avgRating = 0;

        $this->validation->setRule('user_id','user_id','required');	
        if($this->validation->withRequest($this->request)->run()==false) {   
            $output['errors']=$this->validation->getErrors();
            $output['message']='check parameters';    
            return $this->respond($output);
        }

        try{
            $userId = $this->request->getVar('user_id');
            $savelaterData =  $this->common_model->GetAllData("saved_specialists", array('user_id' => $userId), "id", "desc"); 
            if($savelaterData){
                foreach ($savelaterData as $bd) {
                    $specialistIds[] = $bd['specialist_id'];                       
                }
                $getSpecialistDetails = $this->common_model->getspecialistByIds($specialistIds);   
            }
        
            if($getSpecialistDetails) { 
                $userCurrentLocation = $this->common_model->getUserLocation($userId);
                if($userCurrentLocation){ 
                    $LatFrom= $userCurrentLocation->lat;
                    $LngFrom= $userCurrentLocation->lng;
                }
                
                foreach($getSpecialistDetails as $sp){ 
                    $reviewData = $this->common_model->getAverageReviews($sp->id);
                    if($reviewData){
                        $totalReviews = $reviewData->total_reviews;
                        $avgRating = round($reviewData->avg_rating,2);  
                    } 
                    $latTo = $sp->lat;
                    $lngTo = $sp->lng;
                    $specialistsLatLongDiff = $this->common_model->getDistanceMiles($latTo,$lngTo, $LatFrom, $LngFrom); 
                    $getSpecialistDetailsArr[] = array( 
                        'id' => $sp->id,
                        'name' => $sp->name,
                        'email' => $sp->email,
                        'phone' => $sp->phone,
                        'few_word' => $sp->few_word,
                        'country' => $sp->country,
                        'speciality'=>$sp->your_expertise,
                        'profile_image' => base_url().'/'.$sp->profile_image, 
                        'office_area' => $sp->office_area,
                        'distance' =>  round($specialistsLatLongDiff,2) .' Miles', 
                        'total_reviews' => $totalReviews,
                        'avg_rating' => $avgRating,
                    );
                } 
                $output['data'] = $getSpecialistDetailsArr;
                $output['message'] = 'specialist data';
                $output['code'] = 200; 
            } else {
                $output['message'] = 'No data found';                
            }
            
            return $this->respond($output);
        }
        catch (\Exception $e) {
            return $e->getMessage();            
        }
    }
    
}