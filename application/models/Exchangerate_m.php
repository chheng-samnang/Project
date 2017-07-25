<?php
class Exchangerate_m extends CI_Model
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
			$query=$this->db->query("SELECT * FROM tbl_exchange_rate ORDER BY ex_id DESC");			 							
			if($query->num_rows()>0){return $query->result();}			
		}
		else
		{
			$query=$this->db->query("SELECT * FROM tbl_exchange_rate WHERE ex_id='{$id}'");						
			if($query->num_rows()>0){return $query->row();}
		}
	}	
	public function add()
	{
		$data= array(						
						"ex_rate_from" => $this->input->post("txtExRateFrom"),
						"ex_currency_from" => $this->input->post("txtExCurrencyFrom"),
						"ex_rate_to" => $this->input->post("txtExRateTo"),
						"ex_currency_to" => $this->input->post("txtExCurrencyTo"),						
						"issue_date" => $this->input->post("txtIssueDate"),																										
						"user_crea" => $this->userCrea,
						"date_crea" => date('Y-m-d')
						 );
		$query=$this->db->insert("tbl_exchange_rate",$data);		
		if($query==TURE){return TRUE;}
	}
	public function edit($id)
	{
		if($id==TRUE)
		{			
			
			$data= array(					
					"ex_rate_from" => $this->input->post("txtExRateFrom"),
					"ex_currency_from" => $this->input->post("txtExCurrencyFrom"),
					"ex_rate_to" => $this->input->post("txtExRateTo"),
					"ex_currency_to" => $this->input->post("txtExCurrencyTo"),						
					"issue_date" => $this->input->post("txtIssueDate"),								
					"user_updt" => $this->userCrea,
					"date_updt" => date('Y-m-d')
					 );				
			$this->db->where("ex_id",$id);
			$query=$this->db->update("tbl_exchange_rate",$data);
			if($query==TRUE){return TURE;}
		}				
	}
	public function delete($id)
	{
		if($id==TRUE)
		{						
			$this->db->where("ex_id",$id);
			$query=$this->db->delete("tbl_exchange_rate");
			if($query==TRUE){return $query;}
		}
	}
	
}
?>