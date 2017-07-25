<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Message
{
	public function __construct(){}
	public function success_msg($msg="")
	{
		if($msg!="")
		{
			return "<div class='alert alert-success' role='alert'>"."<button type='button' class='close' data-dismiss='alert' aria-label='Close'>"."<span aria-hidden='true'>&times;</span>"."</button>"."<strong>Congratulate!</strong>".$msg."</div>";							
		}
	}
}