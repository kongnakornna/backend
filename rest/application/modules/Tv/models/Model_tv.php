<?php
class Model_tv extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database('api'); // load database name api
	}
    public function tbcode($limit=100){ 
		$sql = "SELECT * FROM tv_program_episode limit ".$limit."";
		$query = $this->db->query($sql);
		$data = $query->result();
		if($data) {
		    return $data;
		} else {
		     return false;
		}
     } 
	 
     public function listlimit($limit=100){ 
		$sql = "SELECT * FROM tv_program_episode limit ".$limit."";
		$query = $this->db->query($sql);
		$data = $query->result();
		if($data) {
		    return $data;
		} else {
		     return false;
		}
     } 
	 
	public function read_where($id){ 
				$order_by='desc';
				$this->db->select('tv_program.tv_name as tv_name,tv_program.tv_tag as tv_tag,tv_program_episode.*');
                 $this->db->from('tv_program_episode'); 
                 $this->db->join('tv_program', 'tv_program_episode.tv_id = tv_program.tv_id', 'left');
                 $this->db->group_by('tv_program_episode.tv_episode_id');  
				 $this->db->where('tv_program_episode.tv_episode_id',$id);
                 $this->db->order_by("tv_program_episode.tv_episode_id",$order_by);
                 $query = $this->db->get();
                 $data = $query->result();
				 $data=$data['0'];
                 if($data){return $data;}else {return false;}
	}
	
	public function read_where1($id){ 
		$sql = "SELECT * FROM tv_program_episode where tv_episode_id=".$id."";
		$query = $this->db->query($sql);
		$data = $query->result();
		if($data) {
		    return $data;
		} else {
		     return false;
		}
	}
	

	 
}


