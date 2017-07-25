<?php
class Phone_m extends CI_Model
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
			$query=$this->db->query("SELECT ph.*,cat_name FROM tbl_phone AS ph INNER JOIN tbl_category AS cat ON ph.cat_id=cat.cat_id WHERE cat_type='ph' ORDER BY ph.ph_id DESC");						
			if($query->num_rows()>0){return $query->result();}			
		}
		else
		{
			$query=$this->db->query("SELECT ph.*,cat_name FROM tbl_phone AS ph INNER JOIN tbl_category AS cat ON ph.cat_id=cat.cat_id WHERE ph_id='{$id}' AND cat_type='ph'");						
			if($query->num_rows()>0){return $query->row();}
		}
	}
	public function category()
	{
		$this->db->where('cat_type','ph');
		$query=$this->db->get('tbl_category');
		if($query->num_rows()>0){return $query->result();}
	}
	public function add()
	{
		$data= array(						
						"cat_id" => $this->input->post("txtCatId"),
						"ph_code" => $this->input->post("txtPhCode"),
						"ph_name" => $this->input->post("txtPhName"),
						"ph_name_kh" => $this->input->post("txtPhNameKh"),						
						"price" => $this->input->post("txtPrice"),
						"ph_status" => $this->input->post("ddlStatus"),
						"ph_img" =>!empty($this->input->post('txtImgName'))?$this->input->post('txtImgName'):"",											
						"ph_desc" => $this->input->post("txtDesc"),						
						"user_crea" => $this->userCrea,
						"date_crea" => date('Y-m-d')
						 );
		$query=$this->db->insert("tbl_Phone",$data);		
		if($query==TURE){return TRUE;}
	}
	public function edit($id)
	{
		if($id==TRUE)
		{	
		if(!empty($this->input->post('txtImgName')))
			{
				$row=$this->index($id);						
				unlink("assets/uploads/".$row->ph_img);				
				$data= array(					
					"cat_id" => $this->input->post("txtCatId"),
					"ph_code" => $this->input->post("txtPhCode"),
					"ph_name" => $this->input->post("txtPhName"),
					"ph_name_kh" => $this->input->post("txtPhNameKh"),						
					"price" => $this->input->post("txtPrice"),
					"ph_status" => $this->input->post("ddlStatus"),
					"ph_img" =>!empty($this->input->post('txtImgName'))?$this->input->post('txtImgName'):"",																						
					"ph_desc" => $this->input->post("txtDesc"),								
					"user_updt" => $this->userCrea,
					"date_updt" => date('Y-m-d')
					 );
			}
			else
			{
				$data= array(					
					"cat_id" => $this->input->post("txtCatId"),
					"ph_code" => $this->input->post("txtPhCode"),
					"ph_name" => $this->input->post("txtPhName"),
					"ph_name_kh" => $this->input->post("txtPhNameKh"),						
					"price" => $this->input->post("txtPrice"),
					"ph_status" => $this->input->post("ddlStatus"),					
					"ph_desc" => $this->input->post("txtDesc"),								
					"user_updt" => $this->userCrea,
					"date_updt" => date('Y-m-d')
					 );
			}  											
			$this->db->where("ph_id",$id);
			$query=$this->db->update("tbl_phone",$data);
			if($query==TRUE){return TURE;}
		}				
	}
	public function delete($id)
	{
		if($id==TRUE)
		{	
			$row=$this->index($id);			
			unlink("assets/uploads/".$row->ph_img);					
			$this->db->where("ph_id",$id);
			$query=$this->db->delete("tbl_phone");
			if($query==TRUE){return $query;}
		}
	}
	
}
?>