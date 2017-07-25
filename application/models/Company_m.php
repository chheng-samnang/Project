<?php
class Company_m extends CI_Model
{			
	var $userCrea;		
	public function __construct()
	{
		parent::__construct();
		$this->userCrea = isset($this->session->userLogin)?$this->session->userLogin:"N/A";				
	}
	public function index($id="")
	{
		if($id=="")
		{
			$this->db->order_by('com_id', 'DESC');
			$query=$this->db->get("tbl_company");
			if($query->num_rows()>0){return $query->result();}			
		}
		else
		{
			$this->db->where("com_id",$id);
			$query=$this->db->get("tbl_company");
			if($query->num_rows()>0){return $query->row();}
		}
	}
	public function add()
	{
		$data= array(						
						"com_code" => $this->input->post("txtComCode"),
						"com_name" => $this->input->post("txtComName"),
						"com_type" => $this->input->post("txtComType"),						
						"com_status" => $this->input->post("txtComStatus"),						
						"com_desc" => $this->input->post("txtDesc"),						
						"user_crea" => $this->userCrea,
						"date_crea" => date('Y-m-d')
						 );
		$query=$this->db->insert("tbl_company",$data);		
		if($query==TURE){return TRUE;}
	}
	public function edit($id)
	{
		if($id==TRUE)
		{			
			
			$data= array(					
					"com_code" => $this->input->post("txtComCode"),
					"com_name" => $this->input->post("txtComName"),
					"com_type" => $this->input->post("txtComType"),						
					"com_status" => $this->input->post("txtComStatus"),						
					"com_desc" => $this->input->post("txtDesc"),						
					"user_updt" => $this->userCrea,
					"date_updt" => date('Y-m-d')
					 );				
			$this->db->where("com_id",$id);
			$query=$this->db->update("tbl_company",$data);
			if($query==TRUE){return TURE;}
		}				
	}
	public function delete($id)
	{
		if($id==TRUE)
		{						
			$this->db->where("com_id",$id);
			$query=$this->db->delete("tbl_company");
			if($query==TRUE){return $query;}
		}
	}
	
}
?>