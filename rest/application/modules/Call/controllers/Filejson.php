<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/Requests/Requests.php";
class Filejson extends CI_Controller {
    public function __construct()    {
        parent::__construct();
			 $this->load->helper('url'); 
			 $this->load->helper('file'); 
			//$this->load->helper("debug");
        // include Requests
	 	Requests::register_autoloader(); 
         //$this->load->library('session'); 
		 
    }
    public function index(){  
			$this->readfilejson();
    }  
    
 	   public function tr(){  
			$apiurl=$this->config->config['restapi'];
			$url=$apiurl.'Mulcontent/tr/?format=json';
			#echo $url;Die();
			$request = Requests::get($url, array('Accept' => 'application/json'));
			$search=" ";
			$replace="";
			$string=$request;
			//$request =str_replace($search,$replace,$string);
			// Check what we received
			#var_dump($request);  Die();
			$request=$request->body;
			$json_data = json_decode($request, true);
			$items_data2=$json_data;
			/*
			echo '<pre>'; print_r($json_data); echo '</pre>'; Die();
			$status_code=$json_data['code'];
			$status=$json_data['status'];
			if($status_code<>200){echo ' Code '.$status_code.' Status '.$status.' Can not call API => '; ?><a href="<?php echo  $url;?>"target="_blank"><?php echo $url;?> </a><?php Die();}
             $MassageMassage=$json_data['Massage'];
			 $remarks=$json_data['remarks'];
			 $items_data=$json_data['data'];
			 */
             $count = count($items_data2);
			$data = array(
						"urlapi" => $url,
						"tb" => 'tb_code',
                        "Title"=> 'Api',
                        "count" => $count,
						"data" => $items_data2,	
                        "content_view" => 'Tb/Mul_leveltb_code',
			); 
           echo '<pre>'; print_r($data); echo '</pre>';  Die();
    } 
	
	public function get_contents(){  
		$apiurl=$this->config->config['restapi'];
		$url=$apiurl.'Mulcontent/tr/?format=json';
		$filejson=file_get_contents($url);
		//echo '<pre>'; print_r($filejson); echo '</pre>';  Die();
		$items_data2= json_decode($filejson);
		$count = count($items_data2);
		$data = array(
						"urlapi" => $url,
						"tb" => 'tb_code',
                        "Title"=> 'Api',
                        "count" => $count,
						"data" => $items_data2,	
                        "content_view" => 'Tb/Mul_leveltb_code',
			); 
           echo '<pre>'; print_r($data); echo '</pre>';  Die();
    } 
	public function readfilejson(){
			 $this->load->helper('url'); 
			 $this->load->helper('file');  
			 $file_name='tb_code';
			 $dir='./json/';
			 $filename=$dir.$file_name.'.json';  
			 //echo '<pre>'; print_r($filename); echo '</pre>';  Die();
			 if ($filename!==''){
				 $string = read_file($filename);
				 $json_data = json_decode($string, true);
				 echo '<pre>'; print_r($json_data); echo '</pre>';  Die();
				 $items_data=$json_data['data'];
				 //echo '<pre>'; print_r($items_data); echo '</pre>';  Die();
			 }else{ echo 'Not Have File';}
		  }
	    
    
    
} 