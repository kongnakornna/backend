<?php
class Model_logs extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database('api'); // load database name api
	}
        
    public function getlog($limit='100') {
         $sql = "SELECT * FROM logs order by id desc limit $limit ";
        $DBSelect = $this->db;
        $query = $DBSelect->query($sql);
        if (!$query) {
            return false;
        }
        return $query->result_array();
    }
    
    //////////////////////
    
    public function read_where_id1($id){ 
	    //echo 'id=>'.$id ; die();
		$this->db->select('*');
		$this->db->from('logs');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
        }
        
    public function read_where_id($id){ 
            $sql = "SELECT *  FROM logs  where id=$id";
            $data = $this->db->query($sql)->result_array();
            return $data;
        }
    
     public function tblogs(){ 
		$this->db->select('*');
		$this->db->from('logs');
		$query = $this->db->get();
		//echo '<pre> $query=>'; print_r($query); echo '</pre>'; Die();
		return $query->result_array(); 
        }   
}


