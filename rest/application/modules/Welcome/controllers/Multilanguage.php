<?php

class Multilanguage extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

	public function index() 
	{
		$this->load->view('Multilanguage');
	}

	public function language() 
	{
		$lang = $this->input->get('lang');
		$uri = $this->input->get('uri');
		
		if($lang == 'english' || $lang == 'thai'){
			$this->session->set_userdata('language', $lang);
			redirect($uri);
		} else {
			redirect('/');
		}
	}

}