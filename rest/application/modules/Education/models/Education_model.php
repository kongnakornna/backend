<?php
class Education_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database('api'); // load database name api
	}
        

    public function _get_mul_content($arrFilter = array(), $order = '', $limit = 0, $offset = 0,$isCount = false)
{
		if($isCount){
			$fieldOut = "count(*) as numRows";
		}else{
			$fieldOut = "*";
		}
		 //var_dump($arrFilter);
		$filter_contenttype = $arrFilter['type'];
		$filter_status = $arrFilter['status'];
		$filter_level = $arrFilter['level'];
		$filter_superid = $arrFilter['subject'];
		$filter_search = $arrFilter['search'];
		
		$criteria_in = "";
		$filter_moreSQLCriteria = "";
		
		if($filter_contenttype && $filter_contenttype!=''){
			$filter_moreSQLCriteria .= " and content_type='".$filter_contenttype."'";
		}
		
		if($filter_status && $filter_status!=''){
			if($filter_status=="ON"){
				$filter_moreSQLCriteria .= " and content_status='ON'";
			}else{
				$filter_moreSQLCriteria .= " and content_status='OFF'";
			}
		}
				
		if($filter_superid != null && $filter_superid != '' && $filter_superid>0){
			if($filter_superid==9999){
				$criteria_in .= " and (mc.mul_content_id in (select content_id from knowledge_context_2014_map where table_id=1 and context_id in (select knowledge_context_id from knowledge_context_2014 where mul_category_id<1000 and mul_category_id>9000)) or (mc.mul_category_id<1000 or mc.mul_category_id>9000))";
			}else{
				$criteria_in .= " and (c.mul_content_id in (select content_id from knowledge_context_2014_map where table_id=1 and context_id in (select knowledge_context_id from knowledge_context_2014 where mul_category_id=".$filter_superid." or TRUNCATE(mul_category_id,-3)=".$filter_superid.")) or (mc.mul_category_id=".$filter_superid." or TRUNCATE(mc.mul_category_id,-3)=".$filter_superid."))";
			}
		}
		if($filter_level != null && $filter_level != '' && $filter_level>0){
			$criteria_in .= "and (mc.mul_content_id in (select content_id from knowledge_context_2014_map where table_id=1 and context_id in (select knowledge_context_id from knowledge_context_2014 where mul_level_id=".$filter_level."))  or mc.mul_level_id=".$filter_level.")";
		}
		
		$orderby = " order by content_id desc,content_id_child desc";
		
		$sql = "SELECT  ".$fieldOut."
from (


select
 'mul_content' tb_name
 ,mc.mul_content_id as content_id
 ,'' as content_id_child
 
 ,'' cat_super_id
 ,'' cat_super_name
 ,'' cat_sub_id
 ,'' cat_sub_name
 ,'' cat_level_id
 ,'' cat_level_name
 
 ,TRUNCATE(mc.mul_category_id,-3) v1_cat_super_id
 ,(select mul_category_name from mul_category where mul_category_id=TRUNCATE(mc.mul_category_id,-3)) v1_cat_super_name
 ,mc.mul_category_id v1_cat_sub_id
 ,mcat.mul_category_name v1_cat_sub_name
 ,mc.mul_level_id v1_cat_level_id
 ,ml.mul_level_name v1_cat_level_name
 
 , mc.mul_content_subject as content_subject
 , '' as content_type
 ,concat('http://www.trueplookpanya.com/knowledge/detail/', mc.mul_content_id) AS content_url
 ,mc.content_stage as content_stage
 ,if(mc.mul_content_status!=1,'OFF','ON') as content_status
from mul_content mc
 left join `users_account` acc on mc.member_id = acc.member_id
 left join `mul_level` ml on mc.mul_level_id=ml.mul_level_id
 left join `mul_category` mcat on mc.mul_category_id=mcat.mul_category_id
where 1=1
 ".$criteria_in."
 
) AA where 1=1 
 and (`content_subject` like concat('%',COALESCE(nullif(@content_subject,'0'), `content_subject`),'%') or `content_subject`= COALESCE(nullif(@content_subject,'0'), `content_subject`))
".$filter_moreSQLCriteria.$orderby;

		$arrWhere = array(
		 '@content_subject'=>$filter_search
		);
		
		if(!$isCount)
		{
			if($offset>0 && $limit>0)
				$sql .= " limit ".$offset.",".$limit;
			else
				$sql .= " limit ".$limit;		
		}
		
		$DBSelect = $this->db;
		$query = $DBSelect->query($sql, $arrWhere);
		//print_r($DBSelect->queries); echo '<br><br>----<br>'; //exit();
		return $query;
	}
        
        /*
        $sql = "SELECT member.member_usrname as  usrname,mul_category.mul_category_name as category_name,mul_level.mul_level_name as levelname,mul_content.* FROM mul_content INNER JOIN mul_level ON mul_level.mul_level_id = mul_content.mul_level_id INNER JOIN mul_category ON mul_category.mul_category_id = mul_content.mul_category_id  INNER JOIN member ON member.member_id = mul_content.member_id WHERE mul_content.mul_content_id= $content_id";
        */
       // INNER JOIN member ON member.member_id = mul_content.member_id 
        public function getContent($content_id = 0) {
            #$sql = "SELECT * FROM mul_content WHERE mul_content_id = $content_id";
            $sql = "SELECT member.member_usrname as  usrname,mul_category.mul_category_name as category_name,mul_level.mul_level_name as levelname,mul_content.* FROM mul_content INNER JOIN mul_level ON mul_level.mul_level_id = mul_content.mul_level_id INNER JOIN mul_category ON mul_category.mul_category_id = mul_content.mul_category_id  INNER JOIN member ON member.member_id = mul_content.member_id WHERE mul_content.mul_content_id=$content_id";
            $data = $this->db->query($sql)->result_array()[0];
            return $data;
        }
        
        
        public function getSourcecontent($content_id = 0) {
            $sql = "SELECT * FROM mul_source WHERE mul_content_id = $content_id";
            $data = $this->db->query($sql)->result_array();
            return $data;
        }

		public function getSource($content_id = 0, $filter = array()) {
            $sql = "SELECT * FROM mul_source WHERE mul_content_id = $content_id";
			if($filter['status']=="active"){ $sql .= " and mul_source_status!=5";}
			if($filter['source_id']>0){ $sql .= " and mul_source_id=".$filter["source_id"];}
			//echo $sql;
            $data = $this->db->query($sql)->result_array();
            return $data;
        }
        
        
        public function getLevel() {
            $sql = "SELECT mul_level_id, mul_level_name FROM mul_level WHERE mul_level_id !=100";
            $data = $this->db->query($sql)->result_array();
            return $data;
        }
        
        public function getSubject($level = 0) {
            $sql = "SELECT mul_category_id, mul_category_name FROM mul_category WHERE mul_category_id = mul_parent_id ";
            if($level < '10' && $level != 99){
                $sql .= "AND (mul_category_id < '1000' or  mul_category_id='9300')";
            }else{
                $sql .= "AND mul_category_id >= '1000'";
            }
            $data = $this->db->query($sql)->result_array();
            //$data = $sql;
            return $data;
        }
        
        
        ////////// mul_source
        public function read_where_id($id){ 
		$this->db->select('*');
		$this->db->from('mul_source');
		$this->db->where('mul_source_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
        }
        
    public function status_data($id,$enable){
                $data['mul_source_status'] = $enable;
                $result_data=$this->db->where('mul_source_id',$id);
                $result_data=$this->db->update('mul_source',$data);  
                 //echo '<pre> $result_data=>'; print_r($result_data); echo '</pre>'; Die();
                if($result_data==1){
                         $result_data=1;
                    }else{
                         $result_data=0;
                    }
                return $result_data;    
        }
        
     public function update_status($data,$id){
        #echo '<pre>';print_r($id); echo '<pre>';print_r($data); echo '</pre>'; Die();	
       $result_data=$this->db->where('mul_source_id',$id);
       $result_data=$this->db->update('mul_source',$data);  
       //debug($result_data);die();
       if($result_data=='1'){
	   	$result_data='0';
	   }else{
	   	$result_data='1';
	   }
       return $result_data;    
    }
    
        
}


