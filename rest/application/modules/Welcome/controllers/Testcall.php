<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Testcall extends CI_Controller {
	 
    public function __construct() {
                parent::__construct();
                $this->load->model('fontend/Model_wallet_typepackage');
    } 
	public function getdata_formapi($url,$args=false) { 
		global $session; 
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL,$url); 
		if($args) { 
		curl_setopt($ch, CURLOPT_POST, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS,$args); 
		} 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		//curl_setopt($ch, CURLOPT_PROXY, "127.0.0.1:8888"); 
		$result = curl_exec ($ch); 
		curl_close ($ch); 
		return $result; 
	} 
	
	public function index(){
		$id=1;
 
	   //set map api url
	    $base_url=base_url();
		$url_api = $base_url."talentonline/wallet_typepackage/wallet_typepackage_where/$id";
		//call api 
		$data_api=$this->getdata_formapi($url_api,$args=false);  //Debug($data_api);
		///Deocde Json
		$datajson = json_decode($url_api,true);
		Debug($datajson);
		
		//$wallet_typepackage_id=$data_api->wallet_typepackage_id;
		//Debug($wallet_typepackage_id);
		
		$this->load->view('read');
	}


	
	
}