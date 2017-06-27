<?php

class Redis extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('Redis');
		$this->load->model('Medel_redis','',TRUE);
	}


	function index()
	{
		if ($this->Medel_redis->checkDB()){ // check connection to Redis
			$fields = $this->Medel_redis->getFields();
			if ($fields['orange_click'] == ''){// no fields created so create
				$this->Medel_redis->resetDB();
				$fields = $this->Medel_redis->getFields();
			}
			$data = array(
				'fields' => $fields
			);
			$rand = rand(0,9);
			if ($rand < 1){ // choose random button
				$col_rand = rand(1,3);
				if ($col_rand == '1') $method = 'orange';
				if ($col_rand == '2') $method = 'green';
				if ($col_rand == '3') $method = 'white';
				$data['method_val'] = $method;
				$data['method'] = 'Random: '.ucfirst($data['method_val']);
			} else { // calculate best button to show
				$percents = array();
				$percents['orange'] = $fields['orange_click']/$fields['orange_show']*100;
				$percents['green'] = $fields['green_click']/$fields['green_show']*100;
				$percents['white'] = $fields['white_click']/$fields['white_show']*100;
				arsort($percents); // order array with height percent first
				$data['method_val'] = key($percents);
				$data['method'] = 'Best Choice: '.ucfirst($data['method_val']);
			}
			$this->Medel_redis->increaseShow($data['method_val']);
			$this->load->view('redis', $data);
		} else {
			echo 'Your Redis Server does not appear to be switched on.';
		}
	}
	
	function set($colour=0)
	{ // value increase on provided colour
		$this->Medel_redis->increaseClick($colour);
		redirect('/', 'refresh');
	}
	
	function skip()
	{ // no value increase
		redirect('/', 'refresh');
	}
	
	function reset_db(){
		$this->Medel_redis->resetDB();
		redirect('/', 'refresh');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */