<?php
class Airline_m extends CI_Model
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
			$query=$this->db->query("SELECT al.*,com_name,des.des_name AS from1,des1.des_name AS to1 FROM tbl_airline AS al 
				INNER JOIN tbl_company AS com ON al.com_id=com.com_id 
				INNER JOIN tbl_destination AS des ON al.from=des.des_id
				INNER JOIN tbl_destination AS des1 ON al.to=des1.des_id
			 	ORDER BY air_id DESC");						
			if($query->num_rows()>0){return $query->result();}			
		}
		else
		{
			$query=$this->db->query("SELECT * FROM tbl_airline WHERE air_id='{$id}'");						
			if($query->num_rows()>0){return $query->row();}
		}
	}	
	public function add()
	{
		$data= array(						
						"com_id" => $this->input->post("txtComId"),
						"from" => $this->input->post("txtFrom"),
						"to" => $this->input->post("txtTo"),
						"depart" => $this->input->post("txtDepart"),						
						"return" => $this->input->post("txtReturn"),
						"price" => $this->input->post("txtPrice"),																					
						"user_crea" => $this->userCrea,
						"date_crea" => date('Y-m-d')
						 );
		$query=$this->db->insert("tbl_airline",$data);		
		if($query==TURE){return TRUE;}
	}
	public function edit($id)
	{
		if($id==TRUE)
		{			
			
			$data= array(					
					"com_id" => $this->input->post("txtComId"),
					"from" => $this->input->post("txtFrom"),
					"to" => $this->input->post("txtTo"),
					"depart" => $this->input->post("txtDepart"),						
					"return" => $this->input->post("txtReturn"),
					"price" => $this->input->post("txtPrice"),								
					"user_updt" => $this->userCrea,
					"date_updt" => date('Y-m-d')
					 );				
			$this->db->where("air_id",$id);
			$query=$this->db->update("tbl_airline",$data);
			if($query==TRUE){return TURE;}
		}				
	}
	public function delete($id)
	{
		if($id==TRUE)
		{						
			$this->db->where("air_id",$id);
			$query=$this->db->delete("tbl_airline");
			if($query==TRUE){return $query;}
		}
	}
	
}
?>