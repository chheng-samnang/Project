<?php
class Company extends CI_Controller
{
	var $pageHeader,$page_redirect;	
	public function __construct()
	{
		parent::__construct();
		$this->pageHeader='Company';
		$this->page_redirect="admin/Company";								
		$this->load->model("Company_m");
	}
	public function index()
	{		
		$this->load->view('template/header');
		$this->load->view('template/left');		
		$data['pageHeader'] = $this->pageHeader;
		$data["action_url"]=array(0=>"{$this->page_redirect}/add",1=>"{$this->page_redirect}/edit",2=>"{$this->page_redirect}/delete"/*,"{$this->page_redirect}/change_password"*/);							
		$data["tbl_hdr"]=array("Company code","Company name","Company type","Status","Description","User create","Date create","User update","Date update");		
		$row=$this->Company_m->index();		
		$i=0;
		if($row==TRUE)
		{
			foreach($row as $value):
			$data["tbl_body"][$i]=array(
										$value->com_code,										
										$value->com_name,
										$value->com_type,
										$value->com_status==1?'Enable':'Disable',
										$value->com_desc,																				
										$value->user_crea,
										date("d-m-Y",strtotime($value->date_crea)),							
										$value->user_updt,
										$value->date_updt==NULL?NULL:date("d-m-Y",strtotime($value->date_updt)),
										$value->com_id
									);
			$i=$i+1;
		endforeach;
		}	
		if(!empty($this->session->flashdata('msg'))){$data['msg']=$this->message->success_msg($this->session->flashdata('msg'));}																		
		$this->load->view('admin/page_view',$data);
		$this->load->view('template/footer');
	}
	public function validation()
	{				
		$this->form_validation->set_rules('txtComCode','Company code','trim|required');
		$this->form_validation->set_rules('txtComName',' Company name','trim|required');					
		if($this->form_validation->run()==TRUE){return TRUE;}
		else{return FALSE;}
	}	
	public function add()
	{		
		$option= array('1'=>'Enable','0'=>'Disable');			
		$data['ctrl'] = $this->createCtrl($row="",$option);		
		$data['action'] = "{$this->page_redirect}/add_value";
		$data['pageHeader'] = $this->pageHeader;		
		$data['cancel'] = $this->page_redirect;
		$this->load->view('template/header');
		$this->load->view('template/left');
		$this->load->view('admin/page_add',$data);
		$this->load->view('template/footer');		
	}
	public function add_value()
	{
		if(isset($_POST["btnSubmit"]))
		{			
			if($this->validation()==TRUE)
				{																													             
	                if($this->Company_m->add()==TRUE)
	                {	       
	                	$this->session->set_flashdata('msg','Save successfully !');       	
						redirect("{$this->page_redirect}/");
						exit;	
	                }	                                																			
				}
			else{$this->add();}		
		}
	}
	public function edit($id="")
	{		
		if($id!="")
		{		
			$option= array('1'=>'Enable','0'=>'Disable');
			$row=$this->Company_m->index($id);				
			if($row==TRUE)
			{																															
				$data['ctrl'] = $this->createCtrl($row,$option);			
				$data['action'] = "{$this->page_redirect}/edit_value/{$id}";
				$data['pageHeader'] = $this->pageHeader;		
				$data['cancel'] = $this->page_redirect;
				$this->load->view('template/header');
				$this->load->view('template/left');
				$this->load->view("admin/page_edit",$data);
				$this->load->view('template/footer');
			}
		}
		else{return FALSE;}
	}
	public function edit_value($id="")
	{		
		if(isset($_POST["btnSubmit"]))
		{						
			if($this->validation()==TRUE)
			{	
				$row=$this->Company_m->edit($id);	
				if($row==TRUE)
	            {	
	            	$this->session->set_flashdata('msg','Change successfully !');                		                	
					redirect("{$this->page_redirect}/");
					exit;	
	            }																												 																				            	                	                                												
			}
			else 
			{	
				$this->edit($id);													
			}			
		}
	}	

	public function delete($id="")
	{
		if($id!="")
		{
			$row=$this->Company_m->delete($id);
			if($row==TRUE){redirect("{$this->page_redirect}/");exit;}
		}
		else{return FALSE;}
	}
	public function createCtrl($row="",$option="")
		{	
			if($row!="")
			{		
					$row1=$row->com_code;						
					$row2=$row->com_name;
					$row3=$row->com_type;
					$row4=$row->com_status;
					$row5=$row->com_desc;																												
			}											
			//$ctrl = array();
			$ctrl = array(							
							array(
									'type'=>'text',
									'name'=>'txtComCode',
									'id'=>'txtComCode',									
									'value'=>$row==""? set_value("txtComCode") : $row1,					
									'placeholder'=>'Enter Company code',									
									'class'=>'form-control',
									'label'=>'Company code'																								
								),
							array(
									'type'=>'text',
									'name'=>'txtComName',
									'id'=>'txtComName',									
									'value'=>$row==""? set_value("txtComName") : $row2,					
									'placeholder'=>'Enter Company name',									
									'class'=>'form-control',
									'label'=>'Company name'																								
								),
								array(
									'type'=>'text',
									'name'=>'txtComType',
									'id'=>'txtComType',									
									'value'=>$row==""? set_value("txtComType") : $row3,					
									'placeholder'=>'Enter Company type',									
									'class'=>'form-control',
									'label'=>'Company type'																								
								),
								array(
									'type'=>'dropdown',
									'name'=>'txtComStatus',
									'option'=>$option,
									'selected'=>$row==""? set_value("txtComStatus") : $row4,
									'class'=>'class="form-control"',
									'label'=>'Company status'
								),							
							array(
									'type'=>'textarea',
									'name'=>'txtDesc',
									'value'=>$row==""? set_value("textarea") : $row5,
									'label'=>'Description'
								),
							);
			return $ctrl;
		}
}
?>