<?php
class Model_memcached extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database('api'); // load database name api
	}
        
    public function getTbCode($fieldName = '') {
        if (!isset($fieldName))
            return false;
        $sql = "SELECT * FROM tb_code WHERE fieldName = '$fieldName';";
        //echo $sql."<BR>--";
        $DBSelect = $this->db;
        $query = $DBSelect->query($sql);
        if (!$query) {
            return false;
        }
        return $query->result_array();
    }
    
    //////////////////////
    
    public function read_where_id($id){ 
		$this->db->select('*');
		$this->db->from('cvs_admissions_article');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
        }
        
    public function status_data($id,$enable){
                $data['status'] = $enable;
                $result_data=$this->db->where('id',$id);
                $result_data=$this->db->update('cvs_admissions_article',$data);  
                //debug($result_data);die();
                if($result_data==1){
                         $result_data=1;
                    }else{
                         $result_data=0;
                    }
                return $result_data;    
        }
        
     public function update_status($data,$id){
        #echo '<pre>';print_r($id); echo '<pre>';print_r($data); echo '</pre>'; Die();	
       $result_data=$this->db->where('id',$id);
       $result_data=$this->db->update('cvs_admissions_article',$data);  
       //debug($result_data);die();
       if($result_data=='1'){
	   	$result_data='0';
	   }else{
	   	$result_data='1';
	   }
       return $result_data;    
    }
    
     public function tbcode(){ 
		$this->db->select('*');
		$this->db->from('tb_code');
		$query = $this->db->get();
		//echo '<pre> $query=>'; print_r($query); echo '</pre>'; Die();
		return $query->result_array(); 
        }   
}


