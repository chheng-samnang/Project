<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Main extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('main_m');
	}
	function index()
	{		
		$this->load->view('template/header');
		$this->load->view('template/left');
		$this->load->view('admin/main');
		$this->load->view('template/footer');
	}
}
?>