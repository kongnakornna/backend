<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH."/third_party/Requests/Requests.php";
class Client extends CI_Controller {
	 
    function __construct() {
        parent::__construct();     
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
	
	 $this->load->helper('url');
		
       echo 'CodeIgniter V.3 HMVC REST FULL API';
	   
            echo '<hr>';
            $Call=base_url('Call');
	    echo 'Call => <a href="'.$Call.'" target="_blank">'.$Call.'</a>';
	    echo '<Br>';
	   
           $readjson=base_url('Mulcontent/data/?format=json');
	   echo 'Read ApI => <a href="'.$readjson.'" target="_blank">'.$readjson.'</a>';
	   echo '<Br>';
          
	  $Dbcache=base_url('Dbcache/all?format=json');
	   echo 'Delete Cache => <a href="'.$Dbcache.'" target="_blank">'.$Dbcache.'</a>';
	   echo '<Br>';
	   
          $readfilejson=base_url('Call/Filejson/?format=json');
	   echo 'Read File => <a href="'.$readfilejson.'" target="_blank">'.$readfilejson.'</a>';
	   echo '<Br>';
           
	  $get_contents=base_url('Call/Filejson/get_contents/?format=json');
	   echo 'Read File => <a href="'.$get_contents.'" target="_blank">'.$get_contents.'</a>';
	   echo '<Br>';
	   
           
           
	   $jsonfile=base_url('/json/');
	   echo 'Json File Directory=> <a href="'.$jsonfile.'" target="_blank">'.$jsonfile.'</a>';
	   echo '<Br>';
           
           $dbcache=base_url('/dbcache/');
	   echo 'dbcache File Directory=> <a href="'.$dbcache.'" target="_blank">'.$dbcache.'</a>';
	   echo '<Br>';
  
           
 
	}
   
	public function redis_test() { 
		$this->load->library('Redis', array('connection_group' => 'slave'), 'redis_slave');
		$this->redis->set('foo', 'bar');
	}
	public function info() { 
		phpinfo();  
	}
}
 
?> 

				
				
				
				
				
				
				
 