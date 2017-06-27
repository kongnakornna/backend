<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH."/third_party/Requests/Requests.php";
class Dir extends CI_Controller {
	 
    function __construct() {
        parent::__construct();  
                    $this->load->helper('directory');
		    Requests::register_autoloader();
			/*
			$this->load->library('rest', array('server' => 'http://localhost/api/',
							'api_key'         => 'REST API',
							'api_name'        => 'X-API-KEY',
							'http_user'       => 'admin',
							'http_pass'       => '1234',
							'http_auth'       => 'basic',
						   )); 
		   */
						   
    }
    public function index() {
	
	 $this->load->directory_map();
   }
    public function directory_map() { 
        $directory_map=$this->load->helper('directory');
        $dir=base_url('/json/');
        //echo '<pre>'; print_r($dir); echo '</pre>';  Die();
         $directory_map = directory_map('../json/', FALSE, TRUE);
        //$files = directory_map('./json/', 1);
        echo '<pre>'; print_r($directory_map); echo '</pre>';  Die();
        asort($files);
            foreach($files as $file){
                if(is_string($file)){
                    echo $file[1];
                }
            }
    }
public function info() { 
		phpinfo();  
	}
}
 
?> 

				
				
				
				
				
				
				
 