<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Memcached extends REST_Controller{
    public function __construct() {
        parent::__construct();
		// Load library
        $this->load->library('memcached_library');
		$this->load->model('Model_memcached'); 
    } 
	public function index_get(){
                       ob_end_clean();
                       // Memcached?format=xml
                       $this->load->helper('url');
                       $data = 'Memcached Modules HMVC API';
                       $type = 'GET';
                       $baseurl=base_url();
                       $this->set_response([
	            	'code' => 200,
	                'status' => TRUE,
	                'Message' => 'REST Done',
	                'remarks' => 'HTTP GET',
                    'type' =>$type, 
	                'data' => $data,
                    'apilist'  => $baseurl.'Memcached/list',
	            ],REST_Controller::HTTP_OK); 
	} 
        public function info_get() { 
		phpinfo();  
	}
        public function list_get(){
                       ob_end_clean();
                       $this->load->helper('url');
                        $baseurl=base_url();
                        $data = array(
                        "api_name" => 'Memcached',
                        "info" => $baseurl.'Memcached/info',
						"list" => 'แสดงข้อมูล  Memcached  GET,'.$baseurl.'Memcached/listmem?format=json',
						"listmemststus" => 'แสดงข้อมูล  Memcached Ststus  GET,'.$baseurl.'Memcached/listmemststus?format=json',);
                    # echo '<pre> $data=>'; print_r($data); echo '</pre>'; Die();
                        
                        $type = 'GET';
                        $this->set_response([
						'code' => 200,
						'status' => TRUE,
						'Message' => 'REST Done',
						'remarks' => 'HTTP GET',
                        'type' =>$type, 
	                'data' => $data,
	            ],REST_Controller::HTTP_OK); 
	} 
        
///////////////////////
        
        public function listmem_get(){
            ob_end_clean();		   
		 // Load library
				$this->load->library('memcached_library');

				// Lets try to get the key
				$results = $this->memcached_library->get('test');

				// If the key does not exist it could mean the key was never set or expired
				if (!$results) {
					// Modify this Query to your liking!
					$query = $this->db->get('knowledge_context', 7000);

					// Lets store the results
					$this->memcached_library->add('test', $query->result());

					// Output a basic msg
					//echo 'Alright! Stored some results from the Query... Refresh Your Browser';
					$results = array(
						"datamemcached" => 'Alright! Stored some results from the Query... Refresh Your Browser',
					); 
				} else {
					// Output
					#var_dump($results);

					// Now let us delete the key for demonstration sake!
					$this->memcached_library->delete('test');
				}
                       $this->load->helper('url');
                        $baseurl=base_url();
                        $type = 'GET';
                        $this->set_response([
						'code' => 200,
						'status' => TRUE,
						'Message' => 'REST Done',
						'remarks' => 'HTTP GET Memcached',
                        'type' =>$type, 
						'datamemcached' => $results,
	            ],REST_Controller::HTTP_OK); 
	} 
        public function listmemststus_get(){
            ob_end_clean();		   
		 $this->load->library('memcached_library');

        //echo $this->memcached_library->getversion();
        //echo '<br/>';
		$memdata=$this->memcached_library->getversion();
        // We can use any of the following "reset, malloc, maps, cachedump, slabs, items, sizes"
        $p = $this->memcached_library->getstats('sizes');
		$results=$p;
       // var_dump($p);
                       $this->load->helper('url');
                        $baseurl=base_url();
                        $type = 'GET';
                        $this->set_response([
						'code' => 200,
						'status' => TRUE,
						'Message' => 'REST Done',
						'remarks' => 'HTTP GET Memcached',
                        'type' =>$type, 
						'memdata' => $memdata,
						'datamemcached' => $results,
	            ],REST_Controller::HTTP_OK); 
	} 
		
   public function test_get(){
             ob_end_clean();		   
		 // Load library
				$this->load->library('memcached_library');

				// Lets try to get the key
				$results = $this->memcached_library->get('test');

				// If the key does not exist it could mean the key was never set or expired
				if (!$results) {
					// Modify this Query to your liking!
					$query = $this->db->get('logs', 7000);

					// Lets store the results
					$this->memcached_library->add('test', $query->result());

					// Output a basic msg
					//echo 'Alright! Stored some results from the Query... Refresh Your Browser';
					$results = array(
						"datamemcached" => 'Alright! Stored some results from the Query... Refresh Your Browser',
					); 
				} else {
					// Output
					#var_dump($results);

					// Now let us delete the key for demonstration sake!
					$this->memcached_library->delete('test');
				}
                       $this->load->helper('url');
                        $baseurl=base_url();
                        $type = 'GET';
                        $this->set_response([
						'code' => 200,
						'status' => TRUE,
						'Message' => 'REST Done',
						'remarks' => 'HTTP GET Memcached',
                        'type' =>$type, 
						'datamemcached' => $results,
	            ],REST_Controller::HTTP_OK); 
    }

    public function stats_get(){
        $this->load->library('memcached_library');

        echo $this->memcached_library->getversion();
        echo '<br/>';

        // We can use any of the following "reset, malloc, maps, cachedump, slabs, items, sizes"
        $p = $this->memcached_library->getstats('sizes');

        var_dump($p);
    }
        
	
}
 
?> 

				
				
				
				
				
				
				
 