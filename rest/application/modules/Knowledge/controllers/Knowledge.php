<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Knowledge extends REST_Controller{
    public function __construct() {
        parent::__construct();
            $this->load->model('Model_knowledge');
            $this->load->model('Model_education');
    } 
	public function index_get(){
                       ob_end_clean();
                       // Knowledge?format=xml
                       $this->load->helper('url');
                       $data = 'Knowledge Modules HMVC API';
                       $type = 'GET';
                       $baseurl=base_url();
                       $this->set_response([
	            	'code' => 200,
	                'status' => TRUE,
	                'Message' => 'REST Done',
	                'remarks' => 'HTTP GET',
                        'type' =>$type, 
	                'data' => $data,
                        'apilist'  => $baseurl.'Knowledge/list',
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
                        "api_name" => 'Knowledge',
                        "info" => $baseurl.'Knowledge/info',
			"all_get" => 'แสดงข้อมูล ทังหมด รับค่าแบบ GET,'.$baseurl.'Knowledge/all?format=json',
                        "id_get"=> 'แสดงข้อมูลด้วย ID รับค่าแบบ GET,'.$baseurl.'Knowledge/id/1?format=json',
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
		#  /restapi/Knowledge/all?format=xml
		#  /restapi/Knowledge/all?format=json
                $order_by = $this->input->get('orderby');
                $limit = $this->input->get('limit');
                
                if($order_by==''){ 
                $order_by=$this->uri->segment(3);
                    if($order_by==''){ $order_by='desc'; }
                }
                if($limit==''){ 
                $limit=$this->uri->segment(4);
                    if($limit==''){$limit='1000';}
                }
                
		   $data = $this->Model_knowledge->list_all_data($order_by,$limit);
                   $resultCount = $this->Model_education->_get_mul_content($filter='' , $order = '', $limit = 0, $offset = 0, $isCount = true);
                   echo '<pre> $resultCount=>'; print_r($resultCount); echo '</pre>'; Die();
                 
                   
                   
                   
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
		#  /restapi/Knowledge/id/1?format=xml
		#  /restapi/Knowledge/id/1?format=json
                $id = $this->input->get('orderby');
                if($id==''){ 
                    $id=$this->uri->segment(3);
                        if($id==''){ $id=''; }
                }
		$data = $this->Model_knowledge->read_where($id);
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

				
				
				
				
				
				
				
 