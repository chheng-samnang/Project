<?php
class Voipcard_m extends CI_Model
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
			$this->db->order_by('vp_id', 'DESC');
			$query=$this->db->get("tbl_voip_card");
			if($query->num_rows()>0){return $query->result();}			
		}
		else
		{
			$this->db->where("vp_id",$id);
			$query=$this->db->get("tbl_voip_card");
			if($query->num_rows()>0){return $query->row();}
		}
	}
	public function add()
	{
		$data= array(						
						"vp_credit_amount" => $this->input->post("txtVoIPCardAmount"),
						"vp_price" => $this->input->post("txtPrice"),
						"vp_desc" => $this->input->post("txtDesc"),												
						"user_crea" => $this->userCrea,
						"date_crea" => date('Y-m-d')
						 );
		$query=$this->db->insert("tbl_voip_card",$data);		
		if($query==TURE){return TRUE;}
	}
	public function edit($id)
	{
		if($id==TRUE)
		{			
			
			$data= array(					
										
					"vp_credit_amount" => $this->input->post("txtVoIPCardAmount"),
					"vp_price" => $this->input->post("txtPrice"),
					"vp_desc" => $this->input->post("txtDesc"),							
					"user_updt" => $this->userCrea,
					"date_updt" => date('Y-m-d')
					 );				
			$this->db->where("vp_id",$id);
			$query=$this->db->update("tbl_voip_card",$data);
			if($query==TRUE){return TURE;}
		}				
	}
	public function delete($id)
	{
		if($id==TRUE)
		{						
			$this->db->where("vp_id",$id);
			$query=$this->db->delete("tbl_voip_card");
			if($query==TRUE){return $query;}
		}
	}
	
}
?>