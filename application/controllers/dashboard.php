<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	public function index()
	{
		$data['title'] = "DASHBOARD";
		$data['layout'] = "dashboard";
		
		$this->load->view('template',$data);
	}
}
