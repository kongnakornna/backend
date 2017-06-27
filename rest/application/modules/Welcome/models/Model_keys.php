<?php
class Model_keys extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database('api'); // load database name api
	}
    // Show data all
	public function list_all_data(){ 
		$sql = "SELECT * FROM keysapi order by id desc ";
		$query = $this->db->query($sql);
		$data = $query->result();
		if($data) {
		    return $data;
		} else {
		     return false;
		}
	}

}


