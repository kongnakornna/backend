<?php
class Model_mapping extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database('api'); // load database name api
	}
        


    public function _getMappedContent_supercategory($tableid = null, $content_id = null) {
        if (!isset($tableid))
            return false;
        if (!isset($content_id))
            return false;

        $sql = "select AA.id, (select mul_category_name from mul_category_2014 where mul_category_id=AA.id) name from (
					select distinct TRUNCATE(A.id,-3) as id from (
					select mul_category_id id , mul_category_name name 
					from mul_category_2014
					where mul_category_id in (select mul_category_id from knowledge_context_2014 where knowledge_context_id in (select context_id from knowledge_context_2014_map where table_id=" . $tableid . " and content_id=" . $content_id . "))
					) A ) AA";
        //echo $sql."<BR>--";
        $DBSelect = $this->db;
        $query = $DBSelect->query($sql);
        if (!$query) {
            return false;
        }

        return $query->result_array();
    }

    public function _getMappedContent_category($tableid = null, $content_id = null) {
        if (!isset($tableid))
            return false;
        if (!isset($content_id))
            return false;

        $sql = "select mul_category_id id , mul_category_name name 
					from mul_category_2014
					where mul_category_id in (select mul_category_id from knowledge_context_2014 where knowledge_context_id in (select context_id from knowledge_context_2014_map where table_id=" . $tableid . " and content_id=" . $content_id . "))
				";
        //echo $sql."<BR>--";
        $DBSelect = $this->db;
        $query = $DBSelect->query($sql);
        if (!$query) {
            return false;
        }

        return $query->result_array();
    }

    public function _getMappedContent_level($tableid = null, $content_id = null) {
        if (!isset($tableid))
            return false;
        if (!isset($content_id))
            return false;

        $sql = "select mul_level_id id , mul_level_name name 
					from mul_level
					where mul_level_id in (select mul_level_id from knowledge_context_2014 where knowledge_context_id in (select context_id from knowledge_context_2014_map where table_id=" . $tableid . " and content_id=" . $content_id . "))
				";
        //echo $sql."<BR>--";
        $DBSelect = $this->db;
        $query = $DBSelect->query($sql);
        if (!$query) {
            return false;
        }

        return $query->result_array();
    }

    public function _getAllKnowledge($arrFilter = array(), $order = '', $limit = 0, $offset = 0, $isCount = false) {
        if ($isCount) {
            $fieldOut = "count(*) as numRows";
        } else {
            $fieldOut = "*";
        }
        //var_dump($arrFilter);
        $filter_contenttype = $arrFilter['type'];
        $filter_status = $arrFilter['status'];
        $filter_level = $arrFilter['level'];
        $filter_superid = $arrFilter['subject'];
        $filter_search = $arrFilter['search'];
        $filter_mapType = $arrFilter['mapType'];

        $criteria_in = "";
        $filter_moreSQLCriteria = "";

        if ($filter_contenttype && $filter_contenttype != '') {
            $filter_moreSQLCriteria .= " and content_type='" . $filter_contenttype . "'";
        }

        if ($filter_status && $filter_status != '') {
            if ($filter_status == "ON") {
                //$criteria_in .= " and (if(nullif(ms.mul_source_id,'')!='',ms.mul_source_status!=5,mc.mul_content_status=1)) and mc.mul_content_status=1";
                $filter_moreSQLCriteria .= " and content_status='ON'";
            } else {
                //$criteria_in .= " and (if(ms.mul_source_id is not null,ms.mul_source_status=5,mc.mul_content_status!=1)) and mc.mul_content_status!=1";
                //$criteria_in .= " and (ms.mul_source_status=5 or mc.mul_content_status!=1)";
                $filter_moreSQLCriteria .= " and content_status='OFF'";
            }
        }

        if ($filter_mapType == "mapped") {
            $criteria_in = " and (if(ms.mul_source_id is not null,ms.mul_source_id in (select content_id from knowledge_context_2014_map where table_id=2),mc.mul_content_id in (select content_id from knowledge_context_2014_map where table_id=1)))";
        } elseif ($filter_mapType == "wait") {
            $criteria_in = " and (if(ms.mul_source_id is not null,ms.mul_source_id not in (select content_id from knowledge_context_2014_map where table_id=2),mc.mul_content_id not in (select content_id from knowledge_context_2014_map where table_id=1)))";
        }

        if ($filter_superid != null && $filter_superid != '' && $filter_superid > 0) {
            if ($filter_superid == 9999) {
                $criteria_in .= " and ((if(ms.mul_source_id is not null,ms.mul_source_id in (select content_id from knowledge_context_2014_map where table_id=2 and context_id in (select knowledge_context_id from knowledge_context_2014 where mul_category_id<1000 and mul_category_id>9000)),mc.mul_content_id in (select content_id from knowledge_context_2014_map where table_id=1 and context_id in (select knowledge_context_id from knowledge_context_2014 where mul_category_id<1000 and mul_category_id>9000)))) or (mc.mul_category_id<1000 or mc.mul_category_id>9000))";
            } else {
                $criteria_in .= " and ((if(ms.mul_source_id is not null,ms.mul_source_id in (select content_id from knowledge_context_2014_map where table_id=2 and context_id in (select knowledge_context_id from knowledge_context_2014 where mul_category_id=" . $filter_superid . " or TRUNCATE(mul_category_id,-3)=" . $filter_superid . ")),mc.mul_content_id in (select content_id from knowledge_context_2014_map where table_id=1 and context_id in (select knowledge_context_id from knowledge_context_2014 where mul_category_id=" . $filter_superid . " or TRUNCATE(mul_category_id,-3)=" . $filter_superid . ")))) or (mc.mul_category_id=" . $filter_superid . " or TRUNCATE(mc.mul_category_id,-3)=" . $filter_superid . "))";
            }
        }
        if ($filter_level != null && $filter_level != '' && $filter_level > 0) {
            $criteria_in .= "and ((if(ms.mul_source_id is not null,ms.mul_source_id in (select content_id from knowledge_context_2014_map where table_id=2 and context_id in (select knowledge_context_id from knowledge_context_2014 where  mul_level_id=" . $filter_level . ")),mc.mul_content_id in (select content_id from knowledge_context_2014_map where table_id=1 and context_id in (select knowledge_context_id from knowledge_context_2014 where mul_level_id=" . $filter_level . ")))  or mc.mul_level_id=" . $filter_level . "))";
        }

        //z ---
        $filter_z = $arrFilter['z'];
        if ($filter_z) {
            $criteria_in .= " and (mc.mul_content_id in (select content_id from z_content_list where table_id=1) or (ms.mul_source_id in (select content_id from z_content_list where table_id=2)))";
        }
        //z ---

        $orderby = " order by content_id desc,content_id_child desc";

        $sql = "SELECT  " . $fieldOut . "
from (


select
 'mul_content' tb_name
 ,mc.mul_content_id as content_id
 ,ms.mul_source_id as content_id_child
 
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
 
 , concat(mc.mul_content_subject,if(ifnull(ms.mul_title,'')!='',concat(' : ',ms.mul_title),'')) as content_subject
 , if(ifnull(mul_type_id,'')='','text',if(mul_type_id='v','vdo',if(mul_type_id='a','audio','doc'))) as content_type
 ,concat('http://www.trueplookpanya.com/knowledge/detail/', mc.mul_content_id,if(ms.mul_source_id is not null,concat( '-',ms.mul_source_id),'')) AS content_url
 ,if(ifnull(ms.mul_source_id,'')='',mc.content_stage,ms.content_stage) as content_stage
 ,if(ifnull(ms.mul_source_id,'')='',if(mc.mul_content_status!=1,'OFF','ON'),if(mc.mul_content_status!=1,'OFF',if(ms.mul_source_status=5,'OFF','ON'))) as content_status
from mul_content mc
 left join `mul_source` ms on mc.mul_content_id=ms.mul_content_id
 left join `users_account` acc on mc.member_id = acc.member_id
 left join `mul_level` ml on mc.mul_level_id=ml.mul_level_id
 left join `mul_category` mcat on mc.mul_category_id=mcat.mul_category_id
where 1=1
 " . $criteria_in . "
 
) AA where 1=1 
 and (`content_subject` like concat('%',COALESCE(nullif(@content_subject,'0'), `content_subject`),'%') or `content_subject`= COALESCE(nullif(@content_subject,'0'), `content_subject`))
" . $filter_moreSQLCriteria . $orderby;

        $arrWhere = array(
                '@content_subject' => $filter_search
        );

        if (!$isCount) {
            if ($offset > 0 && $limit > 0)
                $sql .= " limit " . $offset . "," . $limit;
            else
                $sql .= " limit " . $limit;
        }

        $DBSelect = $this->db;
        $query = $DBSelect->query($sql, $arrWhere);
        //print_r($DBSelect->queries); echo '<br><br>----<br>'; //exit();
        return $query;
    }

    public function _getAllTV($arrFilter = array(), $order = '', $limit = 0, $offset = 0, $isCount = false) {
        if ($isCount) {
            $fieldOut = "count(*) as numRows";
        } else {
            $fieldOut = "*";
        }

        $filter_contenttype = $arrFilter['type'];
        $filter_status = $arrFilter['status'];
        $filter_level = $arrFilter['level'];
        $filter_superid = $arrFilter['subject'];
        $filter_search = $arrFilter['search'];
        $filter_moreSQLCriteria = $arrFilter['moreSQLCriteria'];
        $filter_mapType = $arrFilter['mapType'];


        $orderby = "";

        $criteria_in = "";
        if ($filter_mapType == "mapped") {
            $criteria_in = " and tve.tv_episode_id in (select content_id from knowledge_context_2014_map where table_id=4)";
        } elseif ($filter_mapType == "wait") {
            $criteria_in = " and tve.tv_episode_id not in (select content_id from knowledge_context_2014_map where table_id=4)";
        }
        if ($filter_superid != null && $filter_superid != '' && $filter_superid > 0) {
            $criteria_in .= " and tve.tv_episode_id in (select content_id from knowledge_context_2014_map where table_id=4 and context_id in (select knowledge_context_id from knowledge_context_2014 where mul_category_id=" . $filter_superid . " or TRUNCATE(mul_category_id,-3)=" . $filter_superid . "))";
        }
        if ($filter_level != null && $filter_level != '' && $filter_level > 0) {
            $criteria_in .= " and tve.tv_episode_id in (select content_id from knowledge_context_2014_map where table_id=4 and context_id in (select knowledge_context_id from knowledge_context_2014 where mul_level_id=" . $filter_level . "))";
        }

        //z ---
        $filter_z = $arrFilter['ztv'];
        if ($filter_z) {
            $criteria_in .= " and tve.tv_episode_id in (select content_id from z_content_list where table_id=4)";
        }
        //z ---


        $sql = "SELECT  " . $fieldOut . "
from (

select
 'tv_prg_ep' tb_name
 ,tv.tv_id AS content_id
 ,tve.tv_episode_id AS content_id_child
 ,cat1.menu_id as menu1_id
 ,cat1.menu_name as menu1_name
 ,cat2.menu_id as menu2_id
 ,cat2.menu_name as menu2_name
 ,concat(tv.tv_name,' : ',tve.tv_episode_name) as content_subject
 ,'TV' AS content_type
 ,concat('http://www.trueplookpanya.com/new/tv_program_detail/',tv.tv_id,'/',tve.tv_episode_id) AS content_url
 ,tve.content_stage AS content_stage
from  `tv_program` tv
 inner join `tv_program_episode` tve on tv.tv_id = tve.tv_id and tve.record_status=1
 left join `tv_category` cat1 on tv.menu_level1_id=cat1.menu_id and cat1.menu_type='level1' and cat1.record_status=1
 left join `tv_category` cat2 on tv.menu_level2_id=cat2.menu_id and cat2.menu_type='level2' and cat2.record_status=1
where tv.record_status=1
 " . $criteria_in . "
) AA where 1=1 
 and (`content_subject` like concat('%',COALESCE(nullif(@content_subject,'0'), `content_subject`),'%') or `content_subject`= COALESCE(nullif(@content_subject,'0'), `content_subject`))
 and `content_type`= COALESCE(nullif(@content_type,'0'), `content_type`)
" . $filter_moreSQLCriteria . $orderby;

        $arrWhere = array(
                '@content_subject' => $filter_search
                , '@content_type' => $filter_contenttype
        );

        if (!$isCount) {
            if ($offset > 0 && $limit > 0)
                $sql .= " limit " . $offset . "," . $limit;
            else
                $sql .= " limit " . $limit;
        }

        $DBSelect = $this->db;
        $query = $DBSelect->query($sql, $arrWhere);
        //print_r($DBSelect->queries); echo '<br><br>----<br>'; //exit();
        return $query;
    }

    public function _getMappedKnowledge($filter_contenttype = null, $filter_level = null, $filter_superid = null, $filter_search = null, $filter_moreSQLCriteria = null, $order = '', $limit = 0, $offset = 0, $isCount = false) {
        if ($isCount) {
            $fieldOut = "count(*) as numRows";
        } else {
            $fieldOut = "*";
        }

        $orderby = "";

        $criteria_in = "";
        if ($filter_superid != null && $filter_superid != '' && $filter_superid > 0) {
            $criteria_in .= "and (if(ms.mul_source_id is not null,ms.mul_source_id in(select content_id from knowledge_context_2014_map where table_id=2 and context_id in (select knowledge_context_id from knowledge_context_2014 where mul_category_id=" . $filter_superid . " or TRUNCATE(mul_category_id,-3)=" . $filter_superid . ")),mc.mul_content_id in (select content_id from knowledge_context_2014_map where table_id=1 and context_id in (select knowledge_context_id from knowledge_context_2014 where mul_category_id=" . $filter_superid . " or TRUNCATE(mul_category_id,-3)=" . $filter_superid . "))))";
        }
        if ($filter_level != null && $filter_level != '' && $filter_level > 0) {
            $criteria_in .= "and (if(ms.mul_source_id is not null,ms.mul_source_id in(select content_id from knowledge_context_2014_map where table_id=2 and context_id in (select knowledge_context_id from knowledge_context_2014 where  mul_level_id=" . $filter_level . ")),mc.mul_content_id in (select content_id from knowledge_context_2014_map where table_id=1 and context_id in (select knowledge_context_id from knowledge_context_2014 where mul_level_id=" . $filter_level . "))))";
        }


        $sql = "SELECT  " . $fieldOut . "
from (


select
 'mul_content' tb_name
 ,mc.mul_content_id as content_id
 ,ms.mul_source_id as content_id_child
 ,'' cat_super_id
 ,'' cat_super_name
 ,'' cat_sub_id
 ,'' cat_sub_name
 ,'' cat_level_id
 ,'' cat_level_name
 , mc.mul_content_subject as content_subject
 , if(ifnull(mul_type_id,'')='','text',if(mul_type_id='v','vdo',if(mul_type_id='a','audio','doc'))) as content_type
 ,concat('http://www.trueplookpanya.com/knowledge/detail/', mc.mul_content_id,if(ms.mul_source_id is not null,concat( '-',ms.mul_source_id),'')) AS content_url
 ,if(ifnull(ms.mul_source_id,'')='',mc.content_stage,ms.content_stage) as content_stage
from mul_content mc
 left join `mul_source` ms on mc.mul_content_id=ms.mul_content_id and ms.mul_source_status != 5		
 left join `users_account` acc on mc.member_id = acc.member_id
where mc.mul_content_status=1 
 and (if(ms.mul_source_id is not null,ms.mul_source_id in(select content_id from knowledge_context_2014_map where table_id=2),mc.mul_content_id in (select content_id from knowledge_context_2014_map where table_id=1)))
 " . $criteria_in . "
 
) AA where 1=1 
 and (`content_subject` like concat('%',COALESCE(nullif(@content_subject,'0'), `content_subject`),'%') or `content_subject`= COALESCE(nullif(@content_subject,'0'), `content_subject`))
 and `content_type`= COALESCE(nullif(@content_type,'0'), `content_type`)
" . $filter_moreSQLCriteria . $orderby;

        $arrWhere = array(
                '@content_subject' => $filter_search
                , '@content_type' => $filter_contenttype
        );

        if (!$isCount) {
            if ($offset > 0 && $limit > 0)
                $sql .= " limit " . $offset . "," . $limit;
            else
                $sql .= " limit " . $limit;
        }

        $DBSelect = $this->db;
        $query = $DBSelect->query($sql, $arrWhere);
        //print_r($DBSelect->queries); echo '<br><br>----<br>'; //exit();
        return $query;
    }

    public function _getMappedTV($filter_contenttype = null, $filter_level = null, $filter_superid = null, $filter_search = null, $filter_moreSQLCriteria = null, $order = '', $limit = 0, $offset = 0, $isCount = false) {
        if ($isCount) {
            $fieldOut = "count(*) as numRows";
        } else {
            $fieldOut = "*";
        }

        $orderby = "";

        $criteria_in = "";
        if ($filter_superid != null && $filter_superid != '' && $filter_superid > 0) {
            $criteria_in .= " and tve.tv_episode_id in (select content_id from knowledge_context_2014_map where table_id=4 and context_id in (select knowledge_context_id from knowledge_context_2014 where mul_category_id=" . $filter_superid . " or TRUNCATE(mul_category_id,-3)=" . $filter_superid . "))";
        }
        if ($filter_level != null && $filter_level != '' && $filter_level > 0) {
            $criteria_in .= " and tve.tv_episode_id in (select content_id from knowledge_context_2014_map where table_id=4 and context_id in (select knowledge_context_id from knowledge_context_2014 where mul_level_id=" . $filter_level . "))";
        }


        $sql = "SELECT  " . $fieldOut . "
from (

select
 'tv_prg_ep' tb_name
 ,tv.tv_id AS content_id
 ,tve.tv_episode_id AS content_id_child
 ,cat1.menu_id as menu1_id
 ,cat1.menu_name as menu1_name
 ,cat2.menu_id as menu2_id
 ,cat2.menu_name as menu2_name
 ,concat(tv.tv_name,' : ',tve.tv_episode_name) as content_subject
 ,'รายการทีวี' AS content_type
 ,concat('http://www.trueplookpanya.com/new/tv_program_detail/',tv.tv_id,'/',tve.tv_episode_id) AS content_url
 ,tve.content_stage AS content_stage
from  `tv_program` tv
 inner join `tv_program_episode` tve on tv.tv_id = tve.tv_id and tve.record_status=1
 left join `tv_category` cat1 on tv.menu_level1_id=cat1.menu_id and cat1.menu_type='level1' and cat1.record_status=1
 left join `tv_category` cat2 on tv.menu_level2_id=cat2.menu_id and cat2.menu_type='level2' and cat2.record_status=1
where tv.record_status=1
 and tve.tv_episode_id in (select content_id from knowledge_context_2014_map where table_id=4)
 " . $criteria_in . "
) AA where 1=1 
 and (`content_subject` like concat('%',COALESCE(nullif(@content_subject,'0'), `content_subject`),'%') or `content_subject`= COALESCE(nullif(@content_subject,'0'), `content_subject`))
 and `content_type`= COALESCE(nullif(@content_type,'0'), `content_type`)
" . $filter_moreSQLCriteria . $orderby;

        $arrWhere = array(
                '@content_subject' => $filter_search
                , '@content_type' => $filter_contenttype
        );

        if (!$isCount) {
            if ($offset > 0 && $limit > 0)
                $sql .= " limit " . $offset . "," . $limit;
            else
                $sql .= " limit " . $limit;
        }

        $DBSelect = $this->db;
        $query = $DBSelect->query($sql, $arrWhere);
        //print_r($DBSelect->queries); echo '<br><br>----<br>'; //exit();
        return $query;
    }

    public function _getWaitKnowledge($level = null, $superid = null, $search = null, $order = '', $limit = 0, $offset = 0, $isCount = false) {
        if ($isCount) {
            $fieldOut = "count(*) as numRows";
        } else {
            $fieldOut = "*";
        }

        $orderby = "";


        $sql = "SELECT  " . $fieldOut . "
from (

select
 'mul_content' tb_name
 ,mc.mul_content_id as content_id
 ,ms.mul_source_id as content_id_child
 ,(select TRUNCATE(mc.mul_category_id,-3)) cat_super_id
 ,(select mul_category_name from mul_category where mul_category_id=(select TRUNCATE(mc.mul_category_id,-3))) cat_super_name
 , mc.mul_category_id as cat_sub_id
 , mcat.mul_category_name as cat_sub_name
 , mc.mul_level_id as cat_level_id
 , ml.mul_level_name as cat_level_name
 , mc.mul_content_subject as content_subject
 , if(ifnull(mul_type_id,'')='','text',if(mul_type_id='v','vdo',if(mul_type_id='a','audio','doc'))) as content_type
 ,CONCAT('http://www.trueplookpanya.com/knowledge/detail/', mc.mul_content_id,if(ms.mul_source_id is not null,concat( '/',ms.mul_source_id),'')) AS content_url
 /*,concat('http://www.trueplookpanya.com/new/cms_detail/knowledge/', mc.mul_content_id,if(ms.mul_source_id is not null,concat( '-',ms.mul_source_id),'')) AS content_url*/
 ,if(ms.mul_source_id=null,mc.content_stage,ms.content_stage) as content_stage
from mul_content mc
 left join `mul_source` ms on mc.mul_content_id=ms.mul_content_id and ms.mul_source_status != 5		
 left join `users_account` acc on mc.member_id = acc.member_id
 left join `mul_level` ml on mc.mul_level_id=ml.mul_level_id
 left join `mul_category` mcat on mc.mul_category_id=mcat.mul_category_id
where mc.mul_content_status=1 
 and (if(ms.mul_source_id is not null,ms.mul_source_id not in(select content_id from knowledge_context_2014_map where table_id=2),mc.mul_content_id not in (select content_id from knowledge_context_2014_map where table_id=1)))

) AA where 1=1 
 and `content_id`= COALESCE(nullif(@content_id,'0'), `content_id`)
 and `cat_level_id`= COALESCE(nullif(@cat_level_id,'0'), `cat_level_id`)
 and `cat_super_id`= COALESCE(nullif(@cat_super_id,'0'), `cat_super_id`)
 and (`content_subject` like concat('%',COALESCE(nullif(@content_subject,'0'), `content_subject`),'%') or `content_subject`= COALESCE(nullif(@content_subject,'0'), `content_subject`))
" . $orderby;

        $arrWhere = array(
                '@content_id' => $content_id
                , '@cat_level_id' => $level
                , '@cat_super_id' => $superid
                , '@content_subject' => $search
        );

        if (!$isCount) {
            if ($offset > 0 && $limit > 0)
                $sql .= " limit " . $offset . "," . $limit;
            else
                $sql .= " limit " . $limit;
        }

        $DBSelect = $this->db;
        $query = $DBSelect->query($sql, $arrWhere);
        //print_r($DBSelect->queries); echo '<br><br>----<br>'; //exit();
        return $query;
    }

    public function _getWaitTV($menu1 = null, $menu2 = null, $search = null, $order = '', $limit = 0, $offset = 0, $isCount = false) {
        if ($isCount) {
            $fieldOut = "count(*) as numRows";
        } else {
            $fieldOut = "*";
        }

        $orderby = "";


        $sql = "SELECT  " . $fieldOut . "
from (

select
 'tv_prg_ep' tb_name
 ,tv.tv_id AS content_id
 ,tve.tv_episode_id AS content_id_child
 ,cat1.menu_id as menu1_id
 ,cat1.menu_name as menu1_name
 ,cat2.menu_id as menu2_id
 ,cat2.menu_name as menu2_name
 ,concat(tv.tv_name,' : ',tve.tv_episode_name) as content_subject
 ,'รายการทีวี' AS content_type
 ,concat('http://www.trueplookpanya.com/new/tv_program_detail/',tv.tv_id,'/',tve.tv_episode_id) AS content_url
 ,tve.content_stage AS content_stage
from  `tv_program` tv
 inner join `tv_program_episode` tve on tv.tv_id = tve.tv_id and tve.record_status=1
 left join `tv_category` cat1 on tv.menu_level1_id=cat1.menu_id and cat1.menu_type='level1' and cat1.record_status=1
 left join `tv_category` cat2 on tv.menu_level2_id=cat2.menu_id and cat2.menu_type='level2' and cat2.record_status=1
where tv.record_status=1
 and tve.tv_episode_id not in (select content_id from knowledge_context_2014_map where table_id=4)
) AA where 1=1 
 and `content_id`= COALESCE(nullif(@content_id,'0'), `content_id`)
 and `menu1_id`= COALESCE(nullif(@menu1,'0'), `menu1_id`)
 and `menu2_id`= COALESCE(nullif(@menu2,'0'), `menu2_id`)
 and (`content_subject` like concat('%',COALESCE(nullif(@content_subject,'0'), `content_subject`),'%') or `content_subject`= COALESCE(nullif(@content_subject,'0'), `content_subject`))
" . $orderby;

        $arrWhere = array(
                '@content_id' => $content_id
                , '@menu1' => $menu1
                , '@menu2' => $menu2
                , '@content_subject' => $search
        );

        if (!$isCount) {
            if ($offset > 0 && $limit > 0)
                $sql .= " limit " . $offset . "," . $limit;
            else
                $sql .= " limit " . $limit;
        }

        $DBSelect = $this->db;
        $query = $DBSelect->query($sql, $arrWhere);
        //print_r($DBSelect->queries); echo '<br><br>----<br>'; //exit();
        return $query;
    }

    public function getTVCategory($level1 = null, $level2 = null, $menu_id = null, $menu_type = null) {
        $criteria = "";
        if (!is_null($menu_type)) {
            $criteria .= " and menu_type='" . $menu_type . "'";
        }
        if (!is_null($level1)) {
            $criteria .= " and menu_level1_id=" . $level1;
        }
        if (!is_null($level2)) {
            $criteria .= " and menu_level2_id=" . $level2;
        }
        if (!is_null($menu_id)) {
            $criteria .= " and menu_id=" . $menu_id;
        }

        $sql = "	select menu_id as rID, menu_name as rValue
					from tv_category cat
					where 1=1" . $criteria;


        $DBSelect = null;
        $DBSelect = $this->db;
        $query = $DBSelect->query($sql);
        //print_r($DBSelect->queries);

        $r = $query->result_array();
        return $r;
    }

    // --------------------------
    public function getContextDropDown($level = null, $superid = null, $contextid = null, $catname = null) {
        /* $sql = "select knowledge_context_id as rID,knowledge_context_name as rValue from knowledge_context_2014
          where 1=1
          and `knowledge_context_id`= COALESCE(nullif(@knowledge_context_id,'0'), `knowledge_context_id`)
          and `mul_level_id` like concat(COALESCE(nullif(@mul_level_id,'0'), `mul_level_id`),'%')
          and `mul_category_id` like concat(COALESCE(nullif(@mul_category_id,'0'), `mul_category_id`),'%')
          "; */

        $sql = "select kc.knowledge_context_id as rID,kc.knowledge_context_name as rValue , mc.mul_category_name cat_name
				from knowledge_context_2014 kc
				 left join mul_category_2014 mc on kc.mul_category_id = mc.mul_category_id
				where 1=1
				 and knowledge_context_id= COALESCE(nullif(@knowledge_context_id,'0'), knowledge_context_id)
				 /*and mul_level_id like concat(COALESCE(nullif(@mul_level_id,'0'), mul_level_id),'%')*/
				 and kc.mul_category_id like concat(COALESCE(nullif(@mul_category_id,'0'), kc.mul_category_id),'%')
				 and (mul_category_name=COALESCE(nullif(@cat_name,''), mul_category_name))";

        //check isParent Level eg มัธยมต้น
        $filterLevel = $level;
        if (($level % 10) == 0 || substr($level, 0, 1) == '4') {
            $filterLevel = substr($level, 0, 1);
        }
        if ($filterLevel == 1) {
            $sql .= " and mul_level_id=0";
        } elseif ($filterLevel > 0) {
            $sql .= " and mul_level_id like '%$filterLevel%'";
        }

        $arrWhere = array(
                '@knowledge_context_id' => $contextid
                //, '@mul_level_id'=>$filterLevel
                , '@mul_category_id' => substr($superid, 0, 1)
                , '@cat_name' => $catname
        );

        $DBSelect = null;
        $DBSelect = $this->db;
        $query = $DBSelect->query($sql, $arrWhere);
        //print_r($DBSelect->queries);

        $r = $query->result_array();
        return $r;
    }

    public function getKnowledgeSubDropDown($level = null, $superid = null) {
        /* $sql = "select knowledge_context_id as rID,knowledge_context_name as rValue from knowledge_context_2014
          where 1=1
          and `knowledge_context_id`= COALESCE(nullif(@knowledge_context_id,'0'), `knowledge_context_id`)
          and `mul_level_id` like concat(COALESCE(nullif(@mul_level_id,'0'), `mul_level_id`),'%')
          and `mul_category_id` like concat(COALESCE(nullif(@mul_category_id,'0'), `mul_category_id`),'%')
          "; */

        $sql = "select distinct mc.mul_category_name cat_name
				from knowledge_context_2014 kc
				 left join mul_category_2014 mc on kc.mul_category_id = mc.mul_category_id
				where 1=1";
        // and mul_level_id like concat(COALESCE(nullif(@mul_level_id,'0'), mul_level_id),'%')
        // and kc.mul_category_id like concat(COALESCE(nullif(@mul_category_id,'0'), kc.mul_category_id),'%')";
        //check isParent Level eg มัธยมต้น
        $filterLevel = $level;
        if (($level % 10) == 0 || substr($level, 0, 1) == '4') {
            $filterLevel = substr($level, 0, 1);
        }
        if ($filterLevel == 1) {
            $sql .= " and mul_level_id=0";
        } elseif ($filterLevel > 0) {
            $sql .= " and mul_level_id like '%$filterLevel%'";
        }

        $catid = substr($superid, 0, 1);
        if ($catid > 0) {
            $sql .= " and kc.mul_category_id like '%$catid%'";
        }

        // $arrWhere = array(
        // '@mul_level_id'=>$filterLevel
        // , '@mul_category_id'=>substr($superid,0,1)
        // );



        $DBSelect = null;
        $DBSelect = $this->db;
        $query = $DBSelect->query($sql);
        //print_r($DBSelect->last_query());

        $r = $query->result_array();
        return $r;
    }

    // Zone : Context Map
    public function isReadyMapp_content($content_id, $source_id = 0) {
        if (intval($source_id > 0)) {
            $table_id = 2;
            $id = $source_id;
        } else {
            $table_id = 1;
            $id = $content_id;
        }
        $sql = "select count(*) cnt from knowledge_context_2014_map where table_id=" . $table_id . " and content_id=" . $id;

        $DBSelect = null;
        $DBSelect = $this->db;
        $query = $DBSelect->query($sql);
        //print_r($DBSelect->queries);

        $r = $query->row()->cnt;
        if ($r > 0)
            return true;
        else
            return false;
    }

    private function _getTableMapName($table_id) {
        if ($table_id == 7) {
            return "cvs_course_question_context_2014_map";
        } elseif ($table_id == 9) {
            return "cmsblog_detail_context_2014_map";
        } else {
            return "knowledge_context_2014_map";
        }
    }

    public function getContextMap($tableid = null, $content_id = null, $context_id = null) {
        $tbName = $this->_getTableMapName($tableid);

        $sql = "select * from " . $tbName . " kmap 
				  left join knowledge_context_2014 kc on kmap.context_id=kc.knowledge_context_id
				where table_id=" . $tableid . " and content_id=" . $content_id . "
					and context_id= COALESCE(nullif(@context_id,'0'), context_id)";
        $arrWhere = array(
                '@context_id' => $context_id
        );
        $DBSelect = null;
        $DBSelect = $this->db;
        $query = $DBSelect->query($sql, $arrWhere);
        //print_r($DBSelect->queries);

        $r = $query->result_array();
        return $r;
    }

    public function setContextMap($tableid = null, $content_id = null, $context_id = null) {
        if (!isset($tableid))
            return false;
        if (!isset($content_id))
            return false;
        if (!isset($context_id) || $context_id == '0')
            return false;
        $tbName = $this->_getTableMapName($tableid);

        $DBSelect = $this->db;
        $sql = "delete from " . $tbName . " where table_id=" . $tableid . " and content_id=" . $content_id;
        $query = $DBSelect->query($sql);

        $sql = "insert into " . $tbName . " (table_id,content_id,context_id) values ('" . $tableid . "','" . $content_id . "','" . $context_id . "');";
        $query = $DBSelect->query($sql);

        //log
        $this->load->library('Trueplook');
        $mem = $this->trueplook->check_member_online();
        $postby = $mem['user_id'];
        $detail = "table=" . $tableid . " , content=" . $content_id . " , context=" . $context_id;
        $this->trueplook->userlog($postby, "set map", "KnowledgeMap", date('Y-m-d H:i:s'), $content_id, $DBSelect, $detail);

        return true;
    }

    public function setContextMapArray($tableid = null, $content_id = null, $arrContext_id = null) {
        if (!isset($tableid))
            return false;
        if (!isset($content_id))
            return false;
        if (!isset($arrContext_id) || $arrContext_id == '0')
            return false;
        $tbName = $this->_getTableMapName($tableid);

        $DBSelect = $this->db;
        if (is_array($arrContext_id)) {
            foreach ($arrContext_id as $k => $v) {
                $context_id = $v;
                $sql = "insert into " . $tbName . " (table_id,content_id,context_id) values ('" . $tableid . "','" . $content_id . "','" . $context_id . "');";
                $query = $DBSelect->query($sql);
            }
        } else {
            $context_id = $arrContext_id;
            $sql = "insert into " . $tbName . " (table_id,content_id,context_id) values ('" . $tableid . "','" . $content_id . "','" . $context_id . "');";
            $query = $DBSelect->query($sql);
        }

        //log
        $this->load->library('Trueplook');
        $mem = $this->trueplook->check_member_online();
        $postby = $mem['user_id'];
        $detail = "table=" . $tableid . " , content=" . $content_id . " , context=" . $context_id;
        $this->trueplook->userlog($postby, "set map", "KnowledgeMap", date('Y-m-d H:i:s'), $content_id, $DBSelect, $detail);

        return true;
    }

    public function delContextMap($idx = null, $tableid = 0) {
        if (!isset($idx))
            return false;
        $tbName = $this->_getTableMapName($tableid);

        $DBSelect = $this->db;

        // reset Stage
        $sql = "select * from " . $tbName . " where idx=" . $idx;
        $query = $DBSelect->query($sql);
        if ($query) {
            $dat = $query->result_array();
            foreach ($dat as $v) {
                $tableid = $v['table_id'];
                $content_id = $v['content_id'];
            }
            $this->setContentStage($tableid, $content_id, null);

            // delete
            $sql = "delete from " . $tbName . " where idx=" . $idx;
            $query = $DBSelect->query($sql);
            return true;
        }
        return false;
    }

    // Zone : Remark
    public function getRemark($tableid = null, $content_id = null) {
        $arrData = array(
                '@tableid' => $tableid
                , '@content_id' => $content_id
        );

        $sql = "select * from tb_remark_center where table_id=@tableid and content_id=@content_id";
        $DBSelect = null;
        $DBSelect = $this->db;
        $query = $DBSelect->query($sql, $arrData);
        //print_r($DBSelect->queries);
        if (!$query) {
            return false;
        }

        $r = $query->result_array();
        return $r;
    }

    public function setRemark($tableid = null, $content_id = null, $remarkText = null) {
        if (!isset($tableid))
            return false;
        if (!isset($content_id))
            return false;

        $arrData = array(
                '@tableid' => $tableid
                , '@content_id' => $content_id
                , '@remarkText' => $remarkText
        );

        $DBSelect = $this->db;

        $sql = "delete from tb_remark_center where table_id=@tableid and content_id=@content_id";
        $query = $DBSelect->query($sql, $arrData);

        if ($remarkText != "") {
            $sql = "insert into tb_remark_center (table_id,content_id,remarkText) values (@tableid,@content_id,@remarkText);";
            $query = $DBSelect->query($sql, $arrData);
            //print_r($DBSelect->queries);
        }
        return true;
    }

    // zone : Edit Content
    public function setEditContent($tableid = null, $content_id = null, $editLevel = null, $editSubject = null) {
        if (!isset($tableid))
            return false;
        if (!isset($content_id))
            return false;

        $arrData = array(
                '@tableid' => $tableid
                , '@content_id' => $content_id
                , '@level' => $editLevel
                , '@subject' => $editSubject  // ไม่สามารถให้เปลี่ยนรายวิชาได้ เนื่องจากมันขึ้นกับ ตัวชี้วัด -> สาระเรียนรู้ -> วิชา
        );

        if ($tableid == 1 || $tableid == 2) {
            // edit table mul_content
            $sql = "update mul_content set mul_level_id=@level where mul_content_id=@content_id";
        } elseif ($tableid == 3) {
            // edit table youtube
            $sql = "update youtube set mul_level_id=@level where youtube_id=@content_id";
        }
        /* elseif($tableid==4)
          {
          // edit table youtube
          $sql = "update tv_program_episode set cms_level_id=@level where tv_episode_id=@content_id";
          } */ else {
            return false;
        }

        $DBSelect = $this->db;
        $query = $DBSelect->query($sql, $arrData);
        //print_r($DBSelect->queries);
        //log
        $this->load->library('Trueplook');
        $mem = $this->trueplook->check_member_online();
        $postby = $mem['user_id'];
        $detail = "table=" . $tableid . " , content=" . $content_id . " , Level=" . $editLevel . " , subject=" . $editSubject;
        $this->trueplook->userlog($postby, "edit content", "KnowledgeMap", date('Y-m-d H:i:s'), $content_id, $DBSelect, $detail);

        return true;
    }

    public function setDeleteContent($tableid = null, $content_id = null, $currentStatus = "ON") {
        if (!isset($tableid))
            return false;
        if (!isset($content_id))
            return false;

        if ($tableid == 1) {
            if ($currentStatus == "ON")
                $valStatus = 2;
            else
                $valStatus = 1;

            $sql = "UPDATE mul_content SET mul_content_status=" . $valStatus . ", mul_update_date=now() where mul_content_id=" . $content_id;
        }elseif ($tableid == 2) {
            if ($currentStatus == "ON")
                $valStatus = 5;
            else
                $valStatus = 0;

            $sql = "update mul_source set mul_source_status=" . $valStatus . " where mul_source_id=" . $content_id;
        }
        else {
            return false;
        }

        $DBSelect = $this->db;
        $query = $DBSelect->query($sql);
        //print_r($DBSelect->queries);
        //log
        $this->load->library('Trueplook');
        $mem = $this->trueplook->check_member_online();
        $postby = $mem['user_id'];
        $detail = "table=" . $tableid . " , content=" . $content_id . " , status=" . $valStatus;
        $this->trueplook->userlog($postby, "delete content [" . $currentStatus . "]", "KnowledgeMap", date('Y-m-d H:i:s'), $content_id, $DBSelect, $detail);

        return true;
    }

    // Zone : Stage
    public function getContentStage($tableid = null, $content_id = null) {
        if (!isset($tableid))
            return false;
        if (!isset($content_id))
            return false;

        $arrData = array(
                '@tableid' => $tableid
                , '@content_id' => $content_id
        );

        if ($tableid == 1) {
            // edit table mul_content
            $sql = "select content_stage as stageData from mul_content where mul_content_id=@content_id";
        } elseif ($tableid == 2) {
            // edit table mul_source
            $sql = "select content_stage as stageData from mul_source where mul_source_id=@content_id";
        } elseif ($tableid == 3) {
            // edit table youtube
            $sql = "select content_stage as stageData from youtube where youtube_id=@content_id";
        } elseif ($tableid == 4) {
            // edit table tv_program
            $sql = "select content_stage as stageData from tv_program_episode where tv_episode_id=@content_id";
        } else {
            return false;
        }

        $DBSelect = null;
        $DBSelect = $this->db;
        $query = $DBSelect->query($sql, $arrData);

        if (!$query) {
            return false;
        }

        $r = $query->result_array();
        return $r;
    }

    public function setContentStage($tableid = null, $content_id = null, $stage = null) {
        if (!isset($tableid))
            return false;
        if (!isset($content_id))
            return false;

        $arrData = array(
                '@content_id' => $content_id
                , '@content_stage' => urldecode($stage)
        );

        if ($tableid == 1) {
            // edit table mul_content
            $sql = "update mul_content set content_stage=@content_stage where mul_content_id=@content_id";
        } elseif ($tableid == 2) {
            // edit table mul_source
            $sql = "update mul_source set content_stage=@content_stage where mul_source_id=@content_id";
        } elseif ($tableid == 3) {
            // edit table youtube
            $sql = "update youtube set content_stage=@content_stage where youtube_id=@content_id";
        } elseif ($tableid == 4) {
            // edit table tv_program
            $sql = "update tv_program_episode set content_stage=@content_stage where tv_episode_id=@content_id";
        } else {
            return false;
        }

        $DBSelect = $this->db;
        $query = $DBSelect->query($sql, $arrData);
        //print_r($DBSelect->queries);
        //log
        $this->load->library('Trueplook');
        $mem = $this->trueplook->check_member_online();
        $postby = $mem['user_id'];
        $detail = "table=" . $tableid . " , content=" . $content_id . " , stage=" . $stage;
        $this->trueplook->userlog($postby, "edit stage", "KnowledgeMap", date('Y-m-d H:i:s'), $content_id, $DBSelect, $detail);

        return true;
    }

    // Zone : Z ( white list for PhaseII )
    public function isZList($tableid = null, $content_id = null) {
        $sql = "select count(*) cnt from z_content_list z 
				where table_id=" . $tableid . " and content_id=" . $content_id;

        $DBSelect = null;
        $DBSelect = $this->db;
        $query = $DBSelect->query($sql);
        //print_r($DBSelect->queries);

        $r = $query->row()->cnt;
        if ($r > 0)
            return true;
        else
            return false;
    }

    public function setZ($tableid = null, $content_id = null, $currentStatus = "ON") {
        if (!isset($tableid))
            return false;
        if (!isset($content_id))
            return false;


        if ($currentStatus == "Y")
            $sql = "delete from z_content_list where table_id=" . $tableid . " and content_id=" . $content_id;
        else
            $sql = "insert into z_content_list (table_id,content_id) values (" . $tableid . "," . $content_id . ")";




        $DBSelect = $this->db;
        $query = $DBSelect->query($sql);
        //print_r($DBSelect->queries);
        //var_dump($query);
        //log
        // $this->load->library('Trueplook');
        // $mem = $this->trueplook->check_member_online();
        // $postby = $mem['user_id'];
        // $detail = "table=".$tableid." , content=".$content_id." , status=".$valStatus;
        // $this->trueplook->userlog($postby, "delete content [".$currentStatus."]", "KnowledgeMap", date('Y-m-d H:i:s'), $content_id, $DBSelect,$detail);

        if ($query)
            return true;
        else
            return false;
    }

    public function _getLabelTags($label_key = 0) {
        if (!isset($label_key))
            return false;
        $sql = "SELECT * FROM label_tag WHERE label_key = $label_key;";
        //echo $sql."<BR>--";
        $DBSelect = $this->db;
        $query = $DBSelect->query($sql);
        if (!$query) {
            return false;
        }
        return $query->result_array();
    }
    
    public function _getLabelMap($product_id = 0,$content_id = 0) {
        if (!isset($product_id))
            return false;
        if (!isset($content_id))
            return false;
        $sql = "SELECT label_tag_id FROM `label_tag_map` WHERE project_id = $product_id AND content_id = $content_id ;";
        //echo $sql."<BR>--";
        $DBSelect = $this->db;
        $query = $DBSelect->query($sql);
        if (!$query) {
            return false;
        }
        return $query->result_array();
    }
    
    
    public function _getTbCode($fieldName = '') {
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
		$this->db->from('mul_content');
		$this->db->where('mul_content_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
        }
        
    public function status_data($id,$enable){
                $data['mul_content_status'] = $enable;
                $result_data=$this->db->where('mul_content_id',$id);
                $result_data=$this->db->update('mul_content',$data);  
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
       $result_data=$this->db->where('mul_content_id',$id);
       $result_data=$this->db->update('mul_content',$data);  
       //debug($result_data);die();
       if($result_data=='ON'){
	   	$result_data='OFF';
	   }else{
	   	$result_data='ON';
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


