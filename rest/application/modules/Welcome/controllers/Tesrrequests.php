<?php  defined('BASEPATH') OR exit('No direct script access allowed');  
	// First, include Requests
	require_once APPPATH."/third_party/Requests/Requests.php";
class Tesrrequests extends CI_Controller {  
  
    public function __construct() {  
        	   Requests::register_autoloader();
    } 
  
    public function index(){  
     		ob_end_clean();
			$restapi='http://localhost/api/';
			$data_url=$restapi.'Contact/content/data/?format=json';
			$url = $data_url.'?format=json'; 
			$request = Requests::get($url, array('Accept' => 'application/json'));
			$search=" ";
			$replace="";
			$string=$request;
			//$request =str_replace($search,$replace,$string);
			// Check what we received
			#var_dump($request); 
			$request=$request->body;
			$json_data = json_decode($request, true);
			//echo '<pre>'; print_r($json_data); echo '</pre>'; //Die();
			$status_code=$json_data['code'];
			$status=$json_data['status'];
			$error=$json_data['error'];
			$remarks=$json_data['remarks'];
			$items_data=$json_data['data'];
			echo '<hr>'; 
			echo 'code=>'.$status_code; echo '<Br>'; 
			echo 'status=>'.$status; echo '<Br>'; 
			echo 'error=>'.$error; echo '<Br>'; 
			echo 'remarks=>'.$remarks; echo '<Br>'; 
			echo '<hr>'; 
			$count = count($items_data);
			// In case there are multiple 'items'
			echo 'data=>'; echo 'count='.$count;
			echo '<hr>'; 
			$i=1;
			foreach ($items_data as $item){
				echo $i.') | id :'.$item['contact_event_id']; 
				echo ' | contact_name :'.$item['contact_name'];
				echo ' | contact_lastname :'.$item['contact_lastname'];
				echo ' | contact_email :'.$item['contact_email'];
				echo ' | mobile :'.$item['mobile'];
				echo ' | line :'.$item['line'];
				echo ' | date:'.$item['date']; echo ' | <br>';
			$i++;
			}
			echo '<hr>'; 
		
    }
	public function logs(){  
     		ob_end_clean();
			$restapi='http://localhost/api/';
			$data_url=$restapi.'Logs/all_get';
			$url = $data_url.'?format=json'; 
			$request = Requests::get($url, array('Accept' => 'application/json'));
			$search=" ";
			$replace="";
			$string=$request;
			//$request =str_replace($search,$replace,$string);
			// Check what we received
			#var_dump($request); 
			$request=$request->body;
			$json_data = json_decode($request, true);
			echo '<pre>'; print_r($json_data); echo '</pre>'; Die();
			$status_code=$json_data['code'];
			$status=$json_data['status'];
			$error=$json_data['error'];
			$remarks=$json_data['remarks'];
			$items_data=$json_data['data'];
			echo '<hr>'; 
			echo 'code=>'.$status_code; echo '<Br>'; 
			echo 'status=>'.$status; echo '<Br>'; 
			echo 'error=>'.$error; echo '<Br>'; 
			echo 'remarks=>'.$remarks; echo '<Br>'; 
			echo '<hr>'; 
			$count = count($items_data);
			// In case there are multiple 'items'
			echo 'data=>'; echo 'count='.$count;
			echo '<hr>'; 
			$i=1;
			foreach ($items_data as $item){
				echo $i.') | id :'.$item['contact_event_id']; 
				echo ' | contact_name :'.$item['contact_name'];
				echo ' | contact_lastname :'.$item['contact_lastname'];
				echo ' | contact_email :'.$item['contact_email'];
				echo ' | mobile :'.$item['mobile'];
				echo ' | line :'.$item['line'];
				echo ' | date:'.$item['date']; echo ' | <br>';
			$i++;
			}
			echo '<hr>'; 
		
    }
	
    
} 