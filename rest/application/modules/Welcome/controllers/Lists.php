<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Lists extends CI_Controller {
	 
    function __construct() {
        parent::__construct();    
			$base_url=base_url();
			$this->load->model('fontend/Model_wallet');		
			$this->load->library('rest', array('server' => $base_url,
							'api_key'         => 'REST API',
							'api_name'        => 'X-API-KEY',
							'http_user'       => 'admin',
							'http_pass'       => '1234',
							'http_auth'       => 'basic',
						   ));  
						   
    }
	public function index()
	{
		$this->load->helper('url');
       echo 'List';
	}
	public function demo(){
	   $id=1;
	   $url=base_url('talentonline/wallet_typepackage/wallet_typepackage_where/');
	   $url=$url.$id;
	   $this->load->view('list');
	######################
	/*
	// Alternative JSON version
    // $url = 'http://twitter.com/statuses/update.json';
    // Set up and execute the curl process
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $url.'/format/json');
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_handle, CURLOPT_POST, 1);
    $buffer = curl_exec($curl_handle);
    curl_close($curl_handle);
    $result = json_decode($buffer);
    if(isset($result->status) && $result->status == 'success')
    {
        echo 'User has been updated.';
    }else{
        echo 'Something has gone wrong';
    }
	*/
	######################
	   #$wallet_typepackage_name=$json_decode_data->wallet_typepackage_name;
	   #echo $wallet_typepackage_name;
		
	}
    function put(){          
        $id = $this->uri->segment(3);
        $this->rest->format('application/json');
        $params = array(
            'wallet_typepackage_name' => $this->input->post('wallet_typepackage_name'),
        );
        $wallet_typepackage_name = $this->rest->put('talentonline/wallet_typepackage/wallet_typepackage_update/'.$id, $params,'');
        $this->rest->debug_json();
		//redirect('client/na/'.$id );
    }
	
    function post(){
        $id = $this->uri->segment(3);
        $this->rest->format('application/json');
        $params = $this->input->post(NULL,TRUE);
        $user = $this->rest->post('talentonline/wallet_typepackage/wallet_typepackage_update/'.$id, $params,'');
        $this->rest->debug_json();
		redirect('client/na/'.$id );
    }
	function post_add(){
					$data = array(
							'wallet_typepackage_name' => $this->post('wallet_typepackage_name'),
							'date' => $this->post('date')
					);
					$data_string = json_encode($data);
					$url3=base_url('talentonline/wallet_typepackage/wallet_typepackage_add_post/');
					$curl = curl_init($url3);
					curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($curl, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'Content-Length: ' . strlen($data_string))
					);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data
					// Send the request
					$result = curl_exec($curl);
					// Free up the resources $curl is using
					curl_close($curl);
					echo $result;
    }
    function post_insert(){
        //$this->rest->format('application/json');
        $params = $this->input->post();
		#debug($params); die();
		 $wallet_typepackage_name=$params['wallet_typepackage_name'];
		#debug($wallet_typepackage_name); die();
		$date=date('Y-m-d H:i:s');
        $data = array(
                    //'wallet_typepackage_id' => null,
                    'wallet_typepackage_name' => $wallet_typepackage_name,
                    'date' => $date
                );
		 #debug($data); die();
        $result = $this->Model_wallet->store_insert($data);
		#Debug($data);
		 $message = [
					'name' => $wallet_typepackage_name,
					'message' =>"Insert Database Complete !!",
					'code' => "200",
				];
		Debug($message); 
		//$this->rest->debug_json();
		//redirect('client/na/'.$id );
    }
	
    function get($id=0){
	//http://localhost/api/client/get/1
        if($id==0){
            $this->load->view('read');
        }
        $id = $this->uri->segment(3);
        $this->rest->format('application/json');
        $params = $this->input->get('id');
        $user = $this->rest->get('talentonline/wallet_typepackage/wallet_typepackage_where/'.$id);
        $this->rest->debug();
    }
    function delete($id=0){
        if($id==0){
            $this->load->view('read');
       }
       $id = $this->uri->segment(3); //echo '$id =>'.$id; die();
       $this->rest->format('application/json');
	   $user = $this->rest->get('talentonline/wallet_typepackage/wallet_typepackage_delete/'.$id);
       //$user = $this->rest->delete('talentonline/wallet_typepackage/wallet_typepackage_delete/'.$id);
       //$this->rest->debug();
	   $this->rest->debug_json();
    }
}