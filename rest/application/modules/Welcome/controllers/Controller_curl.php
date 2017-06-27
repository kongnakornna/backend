<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_curl extends CI_Controller {
	 public function __construct() {
        parent::__construct();
         $this->load->library('parser');
         $this->load->helper('html');
         $this->load->helper('string');
        }
    
        public function index(){
        	echo 'curl';

        }
        
	 public function demo(){
	        	echo 'curl';
	        	
	        $this->load->library('curl');
	        $this->curl->create('https://www.formget.com/');
	        $this->curl->option('buffersize', 10); 
	        $this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');      
	        $this->curl->option('returntransfer', 1);
	        $this->curl->option('followlocation', 1);
	        $this->curl->option('HEADER', true);
	        $this->curl->option('connecttimeout', 600);
	        $this->curl->option('SSL_VERIFYPEER', false); // for ssl
	        $this->curl->option('SSL_VERIFYHOST', false);
	        $this->curl->option('SSLVERSION', 3);        // end ssl
	        $data = $this->curl->execute();
	  
	        echo $data; 
	        
	        }
        
		public function demo_http(){
           //http://localhost/api/Controller_curl/demo_http
		   $base_url=base_url();
		   $data_url=$base_url.'talentonline/wallet_type/type/desc/100/th?format=json';
			//  Calling cURL Library
			
			//$string = file_get_contents($data_url);
			//$json_a = json_decode($string, true);
			//echo $json_a;die();
				
			$this->load->library('curl');
			//  Setting URL To Fetch Data From
			$this->curl->create($data_url);
			//$data = $this->curl->execute();
			//  To Display Returned Data
			//$data =str_replace(' {','{',$data);
			//$data =str_replace('     ','',$data);
			//echo $data;die();
			
			
			//  To Temporarily Store Data Received From Server
			$this->curl->option('buffersize', 10);
			//  To support Different Browsers
			$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
			//  To Receive Data Returned From Server
			$this->curl->option('returntransfer', 1);
			//  To follow The URL Provided For Website
			$this->curl->option('followlocation', 1);
			//  To Retrieve Server Related Data
			//$this->curl->option('HEADER', true);
			//  To Set Time For Process Timeout
			$this->curl->option('connecttimeout', 600);
			//  To Execute 'option' Array Into cURL Library & Store Returned Data Into $data
			$data = $this->curl->execute();
			//  To Display Returned Data
			Debug($data);die();
			//echo $data;  die();
		}
        
		public function demo_https(){
			
					$base_url=base_url();
		            $data_url=$base_url.'talentonline/wallet_type/type/desc/100/th?format=json';
				    $this->curl->create($data_url);
					//  Rest Of The Code As In controller_curl.php
					$this->curl->option('connecttimeout', 600);

					// For SSL Sites. Check whether the Host Name you are connecting to is valid
					$this->curl->option('SSL_VERIFYPEER', false);

					//  Ensure that the server is the server you mean to be talking to
					$this->curl->option('SSL_VERIFYHOST', false);

					// Defines the SSL Version to be Used
					$this->curl->option('SSLVERSION', 3);
					$data = $this->curl->execute();
					echo $data;
	    
	    }		
        
        
}
?>

