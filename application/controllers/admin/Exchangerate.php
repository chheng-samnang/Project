<?php
class Exchangerate extends CI_Controller
{
	var $pageHeader,$page_redirect;	
	public function __construct()
	{
		parent::__construct();
		$this->pageHeader='Exchangerate';
		$this->page_redirect="admin/Exchangerate";								
		$this->load->model("Exchangerate_m");		
	}
	public function index()
	{		
		$this->load->view('template/header');
		$this->load->view('template/left');		
		$data['pageHeader'] = $this->pageHeader;
		$data["action_url"]=array(0=>"{$this->page_redirect}/add",1=>"{$this->page_redirect}/edit",2=>"{$this->page_redirect}/delete"/*,"{$this->page_redirect}/change_password"*/);							
		$data["tbl_hdr"]=array("Rate From","Currency From","Rate To","Currency To","Issue Date","User create","Date create","User update","Date update");		
		$row=$this->Exchangerate_m->index();		
		$i=0;
		if($row==TRUE)
		{
			foreach($row as $value):
			$data["tbl_body"][$i]=array(
										$value->ex_rate_from,										
										$value->ex_currency_from,
										$value->ex_rate_to,										
										$value->ex_currency_to,
										$value->issue_date,																																													
										$value->user_crea,
										date("d-m-Y",strtotime($value->date_crea)),							
										$value->user_updt,
										$value->date_updt==NULL?NULL:date("d-m-Y",strtotime($value->date_updt)),
										$value->ex_id
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
		$this->form_validation->set_rules('txtExRateFrom','Rate from','trim|required');
		$this->form_validation->set_rules('txtExCurrencyFrom','Currency from','trim|required');
		$this->form_validation->set_rules('txtExRateTo','Rate To','trim|required');
		$this->form_validation->set_rules('txtExCurrencyTo','Currency To','trim|required');	
		$this->form_validation->set_rules('txtIssueDate','Issue Date','trim|required');									
		if($this->form_validation->run()==TRUE){return TRUE;}
		else{return FALSE;}
	}	
	public function add()
	{					
		$data['ctrl'] = $this->createCtrl($row="");		
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
	                if($this->Exchangerate_m->add()==TRUE)
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
			$row=$this->Exchangerate_m->index($id);				
			if($row==TRUE)
			{																															
				$data['ctrl'] = $this->createCtrl($row);			
				$data['action'] = "{$this->page_redirect}/edit_value/{$id}";
				$data['pageHeader'] = $this->pageHeader;		
				$data['cancel'] = $this->page_redirect;
				$this->load->view('template/header');
				$this->load->view('template/left');
				$this->load->view("admin/page_edit",$data);
				$this->load->view('template/footer');
			}	
		else{return FALSE;}
	}
	public function edit_value($id="")
	{		
		if(isset($_POST["btnSubmit"]))
		{						
			if($this->validation()==TRUE)
			{	
				$row=$this->Exchangerate_m->edit($id);	
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
			$row=$this->Exchangerate_m->delete($id);
			if($row==TRUE){redirect("{$this->page_redirect}/");exit;}
		}
		else{return FALSE;}
	}
	public function createCtrl($row="")
		{	
			if($row!="")
			{		
					$row1=$row->ex_rate_from;						
					$row2=$row->ex_currency_from;
					$row3=$row->ex_rate_to;						
					$row4=$row->ex_currency_to;
					$row5=$row->issue_date;																															
			}											
			//$ctrl = array();
			$ctrl = array(		
							array(
									'type'=>'text',
									'name'=>'txtExRateFrom',
									'id'=>'txtExRateFrom',									
									'value'=>$row==""? set_value("txtExRateFrom") : $row1,					
									'placeholder'=>'Enter Exchange rate from',									
									'class'=>'form-control',
									'label'=>'Exchange rate from'																								
								),
								array(
									'type'=>'text',
									'name'=>'txtExCurrencyFrom',
									'id'=>'txtExCurrencyFrom',									
									'value'=>$row==""? set_value("txtExCurrencyFrom") : $row2,					
									'placeholder'=>'Enter Exchange Currency from',									
									'class'=>'form-control',
									'label'=>'Exchange Currency from'																								
								),
								array(
									'type'=>'text',
									'name'=>'txtExRateTo',
									'id'=>'txtExRateTo',									
									'value'=>$row==""? set_value("txtExRateTo") : $row3,					
									'placeholder'=>'Enter Exchange rate to',									
									'class'=>'form-control',
									'label'=>'Exchange rate to'																								
								),
								array(
									'type'=>'text',
									'name'=>'txtExCurrencyTo',
									'id'=>'txtExCurrencyTo',									
									'value'=>$row==""? set_value("txtExCurrencyTo") : $row4,					
									'placeholder'=>'Enter Exchange Currency to',									
									'class'=>'form-control',
									'label'=>'Exchange Currency to'																								
								),
														
								array(
									'type'=>'text',
									'name'=>'txtIssueDate',
									'id'=>'txtDepart',
									'value'=>$row==""? set_value("txtIssueDate") : $row5,
									'placeholder'=>'Enter Depart',																																																			
									'class'=>'form-control datetimepicker',
									'label'=>'Issue Date',									
								),																																																		
							);
			return $ctrl;
		}
}
?>