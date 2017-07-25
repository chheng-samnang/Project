<?php
class Login_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}		
	public function validateUser($username="",$password="")
	{
		if($username!="" AND $password!="")
		{			
			$query = $this->db->get_where('tbl_user',array('user_pass'=>do_hash($password),'user_status'=>1,'user_name'=>$username));
			if($query->num_rows()>0){return $query->row();}
			else{return 0;}
		}			    
	}
	public function getUsercode($user)
	{
		$query = $this->db->get_where('tbl_user',array('user_name'=>$user));
		return $query->row();
	}
}
?>