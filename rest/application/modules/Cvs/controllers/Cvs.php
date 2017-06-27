<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Cvs extends REST_Controller{
    public function __construct() {
        parent::__construct();
		// Load library
		$this->load->library('Memcached_library');
		// Load  Model
		$this->load->Model('Model_cvs'); 

    } 
	public function index_get(){
                       ob_end_clean();
                       // Cvs?format=xml
                       $this->load->helper('url');
                       $data = 'Cvs Modules HMVC API';
                       $type = 'GET';
                       $baseurl=base_url();
                       $this->set_response([
	            	'code' => 200,
	                'status' => TRUE,
	                'Message' => 'REST Done',
	                'remarks' => 'HTTP GET',
                        'type' =>$type, 
	                'data' => $data,
                        'apilist'  => $baseurl.'Cvs/list',
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
                        "api_name" => 'Cvs',
                        "info" => $baseurl.'Cvs/info',
						"all_get" => 'แสดงข้อมูล ทังหมด รับค่าแบบ GET,'.$baseurl.'Cvs/all?format=json',
                        
                       );
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
        public function all_get( ){
		ob_end_clean(); 
		#  /restapi/Cvs/all?format=xml
		#  /restapi/Cvs/all?format=json
                 $data = $this->Model_cvs->tbcode();#echo '<pre> $resultCount=>'; print_r($resultCount); echo '</pre>'; Die();
                    if($data){
                       $count=count($data);
                       $this->set_response([
	            	'code' => 200,
	                'status' => TRUE,
	                'Message' => 'REST Done',
	                'remarks' => 'API REST Database Done',
                        'Count' => $count,
	                'data' => $data,
	            ],REST_Controller::HTTP_OK); 
                    }else{
                        $this->set_response([
	            	'code' => 404,
	                'status' => TRUE,
	                'Message' => 'REST Error',
	                'remarks' => 'Data Not Found',
                        'Count' => 0,
	                'data' => 0,
	            ], REST_Controller::HTTP_NOT_FOUND); 
	           } 
		 
	} 
        public function id_get( ){
		ob_end_clean(); 
		#  /restapi/Cvs/id/1?format=xml
		#  /restapi/Cvs/id/1?format=json
                $id = $this->input->get('orderby');
                if($id==''){ 
                    $id=$this->uri->segment(3);
                        if($id==''){ $id=''; }
                }
		$data = $this->Model_cvs->read_where($id);
                    if($data){
                       $count=count($data);
                       $this->set_response([
	            	'code' => 200,
	                'status' => TRUE,
	                'Message' => 'REST Done',
	                'remarks' => 'API REST Database Done',
                        'Count' => $count,
	                'data' => $data,
	            ],REST_Controller::HTTP_OK); 
                    }else{
                        $this->set_response([
	            	'code' => 404,
	                'status' => TRUE,
	                'Message' => 'The requested resource could not be found',
	                'remarks' => 'Data Not Found',
                        'Count' => 0,
	                'data' => 0,
	            ], REST_Controller::HTTP_NOT_FOUND); 
	           } 
		 
	}
        
///////////////////////
 
   // zone : DELETE
    public function delcontent_get($tableid = null, $content_id = null, $currentStatus = "ON") {
         // Model_cvs->setDeleteContent($tableid, $content_id, $currentStatus);
        
                ob_end_clean(); 
		#  /restapi/Cvs/delcontent/1/295/OFF?format=xml
		#  /restapi/Cvs/delcontent/1/295/OFF?format=json
                $id = $this->input->get('orderby');
                if($id==''){ 
                    $id=$this->uri->segment(3);
                        if($id==''){ $id=''; }
                }
		$data = $this->Model_cvs->read_where($id);
                    if($data){
                       $count=count($data);
                       $this->set_response([
	            	'code' => 200,
	                'status' => TRUE,
	                'Message' => 'REST Done',
	                'remarks' => 'API REST Database Done',
                        'Count' => $count,
	                'data' => $data,
	            ],REST_Controller::HTTP_OK); 
                    }else{
                        $this->set_response([
	            	'code' => 404,
	                'status' => TRUE,
	                'Message' => 'The requested resource could not be found',
	                'remarks' => 'Data Not Found',
                        'Count' => 0,
	                'data' => 0,
	            ], REST_Controller::HTTP_NOT_FOUND); 
	           }
    }
    
    public function update_status_get(){
		 ob_end_clean();
		// respond with information about a user
			#  /Cvs/update_status/2?format=html
			#  /Cvs/update_status/2?format=xml
			#  /Cvs/update_status/2?format=json 
			$limit='10000';
			$lang='th';
			$id = $this->uri->segment(3); 
			if($id==''){
			 	$id=$this->get('id');	
			}
			$data_read_where_id = $this->Model_cvs->read_where_id($id);
			$count=count($data_read_where_id);
			//echo '<pre> $data_read_where_id=>'; print_r($data_read_where_id); echo '</pre>'; Die();
			  if($count==''||$count==0){
			        $this->set_response([
			            	'code' => 404,
			                'status' => FALSE,
			                'error' => 'Error update status found',
			                'remarks' => 'Record could can not be update status',
                                        'message' => 'Not have data ID '.$id,
			                'data' => 0,
			            ], REST_Controller::HTTP_NOT_FOUND); 
			 }else{
			 	 
                       #echo '<pre> id=>'; print_r($id); echo '</pre>'; Die();
			 	        $data_read_where_id = $this->Model_cvs->read_where_id($id);
					  #echo '<pre> $data_read_where_id=>'; print_r($data_read_where_id); echo '</pre>'; Die();
						$id=$data_read_where_id['0']['id'];
						$enable=$data_read_where_id['0']['status'];
						#debug($id);debug($enable);Die();
						if($enable==1){
							$enable=0;
							$data_enable='Disable';
						}else if($enable==0){
							$enable=1;
							$data_enable='Enable';
						}
						$result = $this->Model_cvs->status_data($id,$enable);
								if($result==1){
								    $this->set_response([
						            	'code' => 200,
						                'status' => TRUE,
						                'enable'=>$enable,
						                'error' => 'REST Done',
						                'remarks' => 'mul_content  Update Status Done',
						                'message' =>$data_enable." Complete ",
						                'data' => $data_enable,
						            ],REST_Controller::HTTP_OK); 
								}else{
						            $this->set_response([
						            	'code' => 404,
						                'status' => FALSE,
						                'error' => 'Error update status found',
                                                                'message' => 'mul_content',
						                'remarks' => 'Record could can not be update status',
						                'data' => 0,
						            ], REST_Controller::HTTP_NOT_FOUND); 
						        }
 
			 	
			 }
		}
///////////////////////
        
        
        public function listmem_get(){
            ob_end_clean();		   
		 // Load library
				$this->load->library('Memcached_library');

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

        //echo $this->Memcached_library->getversion();
        //echo '<br/>';
		$memdata=$this->Memcached_library->getversion();
        // We can use any of the following "reset, malloc, maps, cachedump, slabs, items, sizes"
        $p = $this->Memcached_library->getstats('sizes');
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
        
	
}
 
?> 

				
				
				
				
				
				
				
 