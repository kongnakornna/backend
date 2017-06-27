<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Education extends REST_Controller{
    public function __construct() {
        parent::__construct();
			$this->load->model('Education_model'); 
    } 
	public function index_get(){
                       ob_end_clean();
                       // Education?format=xml
                       $this->load->helper('url');
                       $data = 'Education Modules HMVC API';
                       $type = 'GET';
                       $baseurl=base_url();
                       $this->set_response([
	            	'code' => 200,
	                'status' => TRUE,
	                'Message' => 'REST Done',
	                'remarks' => 'HTTP GET',
                        'type' =>$type, 
	                'data' => $data,
                        'apilist'  => $baseurl.'Education/list',
	            ],REST_Controller::HTTP_OK); 
	} 
        public function info_get() { 
		phpinfo();  
	}
         public function all_get( ){
		ob_end_clean(); 
		#  /restapi/Education/all?format=xml
		#  /restapi/Education/all?format=json
                 $filter = $this->input->get('filter');
                 $offset  = $this->input->get('offset ');
                 $isCount= $this->input->get('isCount ');
                $order = $this->input->get('$order');
                $limit = $this->input->get('limit');
                
                if($order==''){ 
                $order=$this->uri->segment(3);
                    if($order==''){ $order='desc'; }
                }
                if($limit==''){ 
                $limit=$this->uri->segment(4);
                    if($limit==''){$limit='1000';}
                }
                
		   $data = $this->Education_model->_get_mul_content($filter='' , $order = '', $limit = 0, $offset = 0, $isCount = true);
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
        public function id_get($id) { 
                ob_end_clean(); 
		#  http://adm.trueplookpanya.local/V3/
                #  /restapi/Education/id/30249/?format=json
                 $id = $this->input->get('id');
                if($id==''){ 
                    $id=$this->uri->segment(3);
                        if($id==''){ $id=''; }
                }
		$data = $this->Education_model->read_where_id($id);
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
    public function delcontent_get($id) { 
                ob_end_clean(); 
		#  http://adm.trueplookpanya.local/V3/
                #  /restapi/Education/delcontent/30249/?format=json
                $id = $this->input->get('id');
                if($id==''){ 
                    $id=$this->uri->segment(3);
                        if($id==''){ $id=''; }
                }
		$data = $this->Education_model->read_where_id($id);
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
			#  /Education/update_status/30249?format=html
			#  /Education/update_status/30249?format=xml
			#  /Education/update_status/30249?format=json 
			$limit='10000';
			$lang='th';
			$id = $this->uri->segment(3); 
			if($id==''){
			 	$id=$this->get('id');	
			}
			$data_read_where_id = $this->Education_model->read_where_id($id);
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
			 	        $data_read_where_id = $this->Education_model->read_where_id($id);
					  #echo '<pre> $data_read_where_id=>'; print_r($data_read_where_id); echo '</pre>'; Die();
						$id=$data_read_where_id['0']['mul_source_id'];
						$enable=$data_read_where_id['0']['mul_source_status'];
						#debug($id);debug($enable);Die();
						if($enable==1){
							$enable=0;
							$data_enable='Disable';
						//}else if($enable==0){
						}else{
							$enable=1;
							$data_enable='Enable';
						}
						$result = $this->Education_model->status_data($id,$enable);
								if($result==1){
								    $this->set_response([
						            	'code' => 200,
						                'status' => TRUE,
						                'enable'=>$enable,
						                'error' => 'REST Done',
						                'remarks' => 'mul_content  Update Status Done',
						                'message' =>$data_enable." Complete ID ".$id,
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

				
				
				
				
				
				
				
 