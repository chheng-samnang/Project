<?php
class Airline extends CI_Controller
{
	var $pageHeader,$page_redirect;	
	public function __construct()
	{
		parent::__construct();
		$this->pageHeader='Airline';
		$this->page_redirect="admin/Airline";								
		$this->load->model("Airline_m");
		$this->load->model("Company_m");
		$this->load->model("Destination_m");
	}
	public function index()
	{		
		$this->load->view('template/header');
		$this->load->view('template/left');		
		$data['pageHeader'] = $this->pageHeader;
		$data["action_url"]=array(0=>"{$this->page_redirect}/add",1=>"{$this->page_redirect}/edit",2=>"{$this->page_redirect}/delete"/*,"{$this->page_redirect}/change_password"*/);							
		$data["tbl_hdr"]=array("Company name","From","To","Depart","Return","Price","User create","Date create","User update","Date update");		
		$row=$this->Airline_m->index();		
		$i=0;
		if($row==TRUE)
		{
			foreach($row as $value):
			$data["tbl_body"][$i]=array(
										$value->com_name,										
										$value->from1,
										$value->to1,
										$value->depart,
										$value->return,
										$value->price,																																						
										$value->user_crea,
										date("d-m-Y",strtotime($value->date_crea)),							
										$value->user_updt,
										$value->date_updt==NULL?NULL:date("d-m-Y",strtotime($value->date_updt)),
										$value->air_id
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
		$this->form_validation->set_rules('txtComId','Company name','trim|required');
		$this->form_validation->set_rules('txtFrom','From','trim|required');
		$this->form_validation->set_rules('txtTo','To','trim|required');
		$this->form_validation->set_rules('txtDepart','Depart','trim|required');
		$this->form_validation->set_rules('txtReturn','Return','trim|required');
		$this->form_validation->set_rules('txtPrice','Price','trim|required');									
		if($this->form_validation->run()==TRUE){return TRUE;}
		else{return FALSE;}
	}	
	public function add()
	{		//call from file company model
			$row=$this->Company_m->index();					
			if($row==TRUE)
			{
			$option[NULL]	=	"Choose One";
			foreach($row as $value):						
				$option[$value->com_id]=$value->com_name;								
			endforeach;
			}
			else{$option[NULL]=NULL;}

			//call from file Destinaton model
			$row1=$this->Destination_m->index();					
			if($row1==TRUE)
			{
			$option1[NULL]	=	"Choose One";
			foreach($row1 as $value1):						
				$option1[$value1->des_id]=$value1->des_name;								
			endforeach;
			}
			else{$option1[NULL]=NULL;}					
		$data['ctrl'] = $this->createCtrl($row="",$option,$option1);		
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
	                if($this->Airline_m->add()==TRUE)
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
		{	//call from file company model
			$row=$this->Company_m->index();					
			if($row==TRUE)
			{
			$option[NULL]	=	"Choose One";
			foreach($row as $value):						
				$option[$value->com_id]=$value->com_name;								
			endforeach;
			}
			else{$option[NULL]=NULL;}

			//call from file Destinaton model
			$row1=$this->Destination_m->index();					
			if($row1==TRUE)
			{
			$option1[NULL]	=	"Choose One";
			foreach($row1 as $value1):						
				$option1[$value1->des_id]=$value1->des_name;								
			endforeach;
			}
			else{$option1[NULL]=NULL;}	
			$row=$this->Airline_m->index($id);				
			if($row==TRUE)
			{																															
				$data['ctrl'] = $this->createCtrl($row,$option,$option1);			
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
				$row=$this->Airline_m->edit($id);	
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
			$row=$this->Airline_m->delete($id);
			if($row==TRUE){redirect("{$this->page_redirect}/");exit;}
		}
		else{return FALSE;}
	}
	public function createCtrl($row="",$option="",$option1="")
		{	
			if($row!="")
			{		
					$row1=$row->com_id;						
					$row2=$row->from;
					$row3=$row->to;
					$row4=$row->depart;					
					$row5=$row->return;					
					$row6=$row->price;																												
			}											
			//$ctrl = array();
			$ctrl = array(	
							array(
									'type'=>'dropdown',
									'name'=>'txtComId',
									'option'=>$option,
									'selected'=>$row==""? set_value("txtComId") : $row1,
									'class'=>'class="form-control"',
									'label'=>'Company name'
								),
								array(
									'type'=>'dropdown',
									'name'=>'txtFrom',
									'option'=>$option1,
									'selected'=>$row==""? set_value("txtFrom") : $row2,
									'class'=>'class="form-control"',
									'label'=>'From'
								),
								array(
									'type'=>'dropdown',
									'name'=>'txtTo',
									'option'=>$option1,
									'selected'=>$row==""? set_value("txtTo") : $row3,
									'class'=>'class="form-control"',
									'label'=>'To'
								),
								array(
									'type'=>'text',
									'name'=>'txtDepart',
									'id'=>'txtDepart',
									'value'=>$row==""? set_value("txtDepart") : $row4,
									'placeholder'=>'Enter Depart',																																																			
									'class'=>'form-control datetimepicker',
									'label'=>'Depart',									
								),														
								array(
									'type'=>'text',
									'name'=>'txtReturn',
									'id'=>'txtReturn',
									'value'=>$row==""? set_value("txtReturn") : $row5,
									'placeholder'=>'Enter Return',																																																			
									'class'=>'form-control datetimepicker',
									'label'=>'Return',									
								),	
							array(
									'type'=>'text',
									'name'=>'txtPrice',
									'id'=>'txtPrice',									
									'value'=>$row==""? set_value("txtPrice") : $row6,					
									'placeholder'=>'Enter Price',									
									'class'=>'form-control',
									'label'=>'Price'																								
								)																				
							);
			return $ctrl;
		}
}
?>