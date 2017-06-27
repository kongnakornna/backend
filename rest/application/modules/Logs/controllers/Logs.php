<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Logs extends REST_Controller{
    public function __construct() {
        parent::__construct();
			$this->load->Model('Model_logs'); 
    } 
	public function index_get(){
                       ob_end_clean();
                       // Logs?format=xml
                       $this->load->helper('url');
                       $data = 'Logs Modules HMVC API';
                       $type = 'GET';
                       $baseurl=base_url();
                       $this->set_response([
	            	'code' => 200,
	                'status' => TRUE,
	                'Message' => 'REST Done',
	                'remarks' => 'HTTP GET',
                        'type' =>$type, 
	                'data' => $data,
                        'apilist'  => $baseurl.'Logs/list',
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
                        "api_name" => 'Logs',
                        "info" => $baseurl.'Logs/info',
						"all_get" => 'แสดงข้อมูล รับค่าแบบ GET,'.$baseurl.'Logs/limit?limit=5',
                        
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
	public function limit_get( ){
		ob_end_clean(); 
		#   /rest/Logs/limit?limit=100
		
					$post=$this -> input->post(); 
					$get=$this -> input->get(); 
					$limit=$get['limit'];
					if($limit==''){$limit='100';}
                 $data = $this->Model_logs->getlog($limit); 
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
		#  /rest/Logs/id/69?format=xml
		#  /rest/Logs/id/?id=69
		
					
					$id=(int)$this->uri->segment(3);
					if($id==''){$id=(int)$this->uri->segment(4); }
					if($id==''){$id=(int)$this->uri->segment(5); }
					if($id==''){ 
					$post=$this -> input->post(); 
					$get=$this -> input->get(); 
					$id =$get['id']; 
					}
					//echo 'id=>'.$id ; die();
					$data = $this->Model_logs->read_where_id($id);
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
               
        
	
}
 
?> 

				
				
				
				
				
				
				
 