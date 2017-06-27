<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Tv extends REST_Controller{
    public function __construct() {
        parent::__construct();
			$this->load->Model('Model_tv'); 
    } 
	public function index_get(){
                       ob_end_clean();
                       // Tv?format=xml
                       $this->load->helper('url');
                       $data = 'Tv Modules HMVC API';
                       $type = 'GET';
                       $baseurl=base_url();
                       $this->set_response([
	            	'code' => 200,
	                'status' => TRUE,
	                'Message' => 'REST Done',
	                'remarks' => 'HTTP GET',
                        'type' =>$type, 
	                'data' => $data,
                        'apilist'  => $baseurl.'Tv/list',
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
                        "api_name" => 'Tv',
                        "info" => $baseurl.'Tv/info',
						"all_get" => 'แสดงข้อมูล ทังหมด รับค่าแบบ GET,'.$baseurl.'Tv/all?format=json',
                        
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
		#  /rest/Tv/all/10?format=xml
		#  /rest/Tv/all/10?format=json
		
					$limit=(int)$this->uri->segment(3);
					if($limit==''){$limit=(int)$this->uri->segment(4); }
					if($limit==''){$limit=(int)$this->uri->segment(5); }
					if($limit==''){ 
					$post=$this -> input->post(); 
					$get=$this -> input->get(); 
					$limit =$get['limit']; 
					}if($limit==''){$limit=100; }
                 $data = $this->Model_tv->tbcode($limit);
                #echo '<pre> $resultCount=>'; print_r($resultCount); echo '</pre>'; Die();
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
		#  /rest/Tv/id/1?format=xml
		#  /rest/Tv/id/2901?format=json
                $id = $this->input->get('orderby');
                if($id==''){ 
                    $id=$this->uri->segment(3);
                        if($id==''){ $id=''; }
                }
				$data = $this->Model_tv->read_where1($id);
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
         // Model_tv->setDeleteContent($tableid, $content_id, $currentStatus);
        
                ob_end_clean(); 
		#  /rest/Tv/delcontent/1/295/OFF?format=xml
		#  /rest/Tv/delcontent/1/295/OFF?format=json
                $id = $this->input->get('orderby');
                if($id==''){ 
                    $id=$this->uri->segment(3);
                        if($id==''){ $id=''; }
                }
		$data = $this->Model_tv->read_where($id);
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
			#  /Tv/update_status/2?format=html
			#  /Tv/update_status/2?format=xml
			#  /Tv/update_status/2?format=json 
			$limit='10000';
			$lang='th';
			$id = $this->uri->segment(3); 
			if($id==''){
			 	$id=$this->get('id');	
			}
			$data_read_where_id = $this->Model_tv->read_where_id($id);
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
			 	        $data_read_where_id = $this->Model_tv->read_where_id($id);
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
						$result = $this->Model_tv->status_data($id,$enable);
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
        
        
        
	
}
 
?> 

				
				
				
				
				
				
				
 