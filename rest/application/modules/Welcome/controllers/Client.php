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
		
       echo 'REST API';
	   
       echo '<hr>';
       $Call=base_url('Call');
	   echo 'Call => <a href="'.$Call.'" target="_blank">'.$Call.'</a>';
	   echo '<Br>';
	   
	   $jsonfile=base_url('json');
	   echo 'Json File Directory=> <a href="'.$jsonfile.'" target="_blank">'.$jsonfile.'</a>';
	   echo '<Br>';
	   $readfilejson=base_url('Call/readfilejson');
	   echo 'Read file json => <a href="'.$readfilejson.'" target="_blank">'.$readfilejson.'</a>';
	   echo '<Br>';
	 
	   
	   
	   $dbcache=base_url('dbcache');
	   echo 'Cache Directory=> <a href="'.$dbcache.'" target="_blank">'.$dbcache.'</a>';
	   echo '<Br>';
	   
	   $Cache_delete_all=base_url('Cache_delete_all/all/?format=json');
	   echo 'Db Cache delete => <a href="'.$Cache_delete_all.'" target="_blank">'.$Cache_delete_all.'</a>';
	   echo '<Br>';
	   
	   
	   $logs=base_url('True/Mul_leveltb_code/data/?format=json');
	   echo 'Tb_code => <a href="'.$logs.'" target="_blank">'.$logs.'</a>';
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

				
				
				
				
				
				
				
 