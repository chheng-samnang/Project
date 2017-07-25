<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{		
		parent::__construct();
		$this->load->model('Login_m','lm');
		$this->load->helper('security');
	}
	public function index()
	{   
		$this->form_validation->set_rules('txtUsername','User Name','required');
		$this->form_validation->set_rules('txtPass','Password','required');
		if($this->form_validation->run()==false)
		{
			$data["msg"] = "";
			$this->load->view('template/login',$data);
		}else
		{
			$username = $this->input->post('txtUsername');
			$pass = $this->input->post('txtPass');
			$result = $this->lm->validateUser($username,$pass);
			if($result!=0)
			{
				$this->session->userLogin = $username;
				$this->session->userType = $result->user_type;
				redirect("admin/Main");
				exit;
			}else
			{
				$data['msg'] = "Username and Password incorrect !!!";
				$this->load->view("template/login",$data);
			}
		}			
	}
}
