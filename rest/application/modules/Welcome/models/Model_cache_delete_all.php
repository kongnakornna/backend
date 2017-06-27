<?php
class Model_cache_delete_all extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database('api'); // load database name api
	}
    // Show data all
        
        public function cache_delete_all(){ 
             $this->db->cache_delete_all(); 
              
	} 
}


