<?php
class Permissionmsg extends CI_Controller
{
	var $pageHeader,$page_redirect;	
	public function __construct()
	{
		parent::__construct();		
	}
	public function index()
	{		
		$this->load->view('template/header');
		$this->load->view('template/left');
		$this->load->view('admin/permission_msg');
		$this->load->view('template/footer');
	}									
}
