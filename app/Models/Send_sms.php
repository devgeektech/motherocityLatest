<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

namespace App\Models;

use CodeIgniter\Model;

use Exception;


include APPPATH . 'ThirdParty/Twilio/autoload.php';
use Twilio\Rest\Client;

class Send_sms extends Model {
	
	public function send($phones,$msg){
		//$sid = 'AC2d74b96c3bf305a01bb353143ec7857f';
		//$token = '4dfef0dc3e6129918822ef1a23e66323'; 
	//	$token =rand(100000,999999);

		
		$sid = 'AC2f2f008dda60ef2ddf1235391045d8e3';
		$token = 'c66d9dcd925789fe9ff3c081c901857d';
		
		$client = new Client($sid, $token);
		
		$status = true;
		//echo $phones;
		$encoded = rawurlencode("$phones");
		
		try {
			$run = $client->messages->create(
				$phones,
				array(
					//'from' => '+14693363784',
					'from' => '+17179833873',
					'body' => $msg
				)
			);
    } catch (Twilio\Exceptions\RestException $e) {
			//echo '<pre>'; print_r($phones); echo '</pre>';
		   //echo '<pre>'; print_r($e); echo '</pre>';
			$status = false;
			
    }
		
		return $status;
	}

	
	
}