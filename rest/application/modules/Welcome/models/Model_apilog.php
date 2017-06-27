<?php
class Model_apilog extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database('api'); // load database name api
	}
    // Show data all
	public function list_all_data($order_by,$limit='100'){ 
		$sql = "SELECT * FROM logs order by id $order_by limit $limit";
		$query = $this->db->query($sql);
		$data = $query->result();
		if($data) {
		    return $data;
		} else {
		     return false;
		}
	}

}


