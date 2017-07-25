<?php
class Destination_m extends CI_Model
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
			$this->db->order_by('des_id', 'DESC');
			$query=$this->db->get("tbl_destination");
			if($query->num_rows()>0){return $query->result();}			
		}
		else
		{
			$this->db->where("des_id",$id);
			$query=$this->db->get("tbl_destination");
			if($query->num_rows()>0){return $query->row();}
		}
	}
	public function add()
	{
		$data= array(						
						"des_name" => $this->input->post("txtDestination"),						
						"des_desc" => $this->input->post("txtDesc"),						
						"user_crea" => $this->userCrea,
						"date_crea" => date('Y-m-d')
						 );
		$query=$this->db->insert("tbl_destination",$data);		
		if($query==TURE){return TRUE;}
	}
	public function edit($id)
	{
		if($id==TRUE)
		{			
			
			$data= array(					
					"des_name" => $this->input->post("txtDestination"),						
					"des_desc" => $this->input->post("txtDesc"),					
					"user_updt" => $this->userCrea,
					"date_updt" => date('Y-m-d')
					 );				
			$this->db->where("des_id",$id);
			$query=$this->db->update("tbl_destination",$data);
			if($query==TRUE){return TURE;}
		}				
	}
	public function delete($id)
	{
		if($id==TRUE)
		{						
			$this->db->where("des_id",$id);
			$query=$this->db->delete("tbl_destination");
			if($query==TRUE){return $query;}
		}
	}
	
}
?>