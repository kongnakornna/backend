<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Logs extends REST_Controller{

    public function __construct() {
                parent::__construct();
                $this->load->model('Model_apilog');
    } 
	public function index()
	{
		$this->load->helper('url');
       echo 'Payasyougo  type';
	}

	function testconnect_get(){
		$id = $this->session->userdata('id');
		$id = $this->session->userdata('apikey');
		var_dump($id);
		echo $id == false;
		// echo 'Total Results: ' . $query->num_rows();
	}

	function get_get(){
		echo 123;
	}
//data_get
	public function all_get(){
	// respond with information about a user
		#  /api/talentonline/wallet_log/type/?format=html
		#  /api/talentonline/wallet_log/type/?format=xml
		#  /api/talentonline/wallet_log/type/?format=json
		$order_by='desc';
		$limit='10';
		$lang='th';
		$data = $this->Model_apilog->list_all_data($order_by,$limit);
		if($data){
			    $count=count($data);
			    $this->set_response([
	            	'code' => 200,
	                'status' => TRUE,
	                'error' => 'REST Done',
	                'remarks' => 'API REST  OK',
	                'count' => $count,
	                'data' => $data,
	            ],REST_Controller::HTTP_OK); 
			}else{
	            $this->set_response([
	            	'code' => 404,
	                'status' => FALSE,
	                'error' => 'Record could not be found',
	                'remarks' => 'Record could not be found',
	            ], REST_Controller::HTTP_NOT_FOUND); 
	        }
	}
		
}