<?php
class Category extends CI_Controller
{
	var $pageHeader,$page_redirect;	
	public function __construct()
	{
		parent::__construct();
		$this->pageHeader='Category';
		$this->page_redirect="admin/Category";								
		$this->load->model("Category_m");
	}
	public function index()
	{		
		$this->load->view('template/header');
		$this->load->view('template/left');		
		$data['pageHeader'] = $this->pageHeader;
		$data["action_url"]=array(0=>"{$this->page_redirect}/add",1=>"{$this->page_redirect}/edit",2=>"{$this->page_redirect}/delete"/*,"{$this->page_redirect}/change_password"*/);							
		$data["tbl_hdr"]=array("Name","Name khmer","Category type","Description","User create","Date create","User update","Date update");		
		$row=$this->Category_m->index();		
		$i=0;
		if($row==TRUE)
		{
			foreach($row as $value):
			$data["tbl_body"][$i]=array(										
										$value->cat_name,
										$value->cat_name_kh,
										$value->cat_type=='al'?'Air Line':($value->cat_type=='ph'?'Phone':'VoIPCard'),
										$value->cat_desc,																				
										$value->user_crea,
										date("d-m-Y",strtotime($value->date_crea)),							
										$value->user_updt,
										$value->date_updt==NULL?NULL:date("d-m-Y",strtotime($value->date_updt)),
										$value->cat_id
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
		$this->form_validation->set_rules('ddlCatType','Category type','trim|required');		
		$this->form_validation->set_rules('txtCategoryName','Category Name','trim|required');
		if($this->form_validation->run()==TRUE){return TRUE;}
		else{return FALSE;}
	}	
	public function add()
	{				
		$option=array(''=>'Category Type','ph'=>'Phone','al'=>'Air Line','vc'=>'VoIPCard');	
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
	                if($this->Category_m->add()==TRUE)
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
			$row=$this->Category_m->index($id);				
			if($row==TRUE)
			{	
				$option=array(''=>'Category Type','ph'=>'Phone','al'=>'Air Line','vc'=>'VoIPCard');																															
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
				$row=$this->Category_m->edit($id);	
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
			$row=$this->Category_m->delete($id);
			if($row==TRUE){redirect("{$this->page_redirect}/");exit;}
		}
		else{return FALSE;}
	}
	public function createCtrl($row="",$option)
		{	
			if($row!="")
			{		
					$row1=$row->cat_type;
					$row2=$row->cat_name;
					$row3=$row->cat_name_kh;
					$row4=$row->cat_desc;																												
			}											
			//$ctrl = array();
			$ctrl = array(							
							array(
									'type'=>'text',
									'name'=>'txtCategoryName',
									'id'=>'txtCategoryName',									
									'value'=>$row==""? set_value("txtCategoryName") : $row2,					
									'placeholder'=>'Enter Category name',									
									'class'=>'form-control',
									'label'=>'Category name'																								
								),
							array(
									'type'=>'text',
									'name'=>'txtCategoryNameKh',
									'id'=>'txtCategoryNameKh',									
									'value'=>$row==""? set_value("txtCategoryNameKh") : $row3,					
									'placeholder'=>'Enter Category name khmer',									
									'class'=>'form-control',
									'label'=>'Category name khmer'																								
								),
								array(
									'type'=>'dropdown',
									'name'=>'ddlCatType',
									'option'=>$option,
									'selected'=>$row==""? set_value("ddlCatType") : $row1,
									'class'=>'class="form-control"',
									'label'=>'Category type'
								),							
							array(
									'type'=>'textarea',
									'name'=>'txtDesc',
									'value'=>$row==""? set_value("textarea") : $row4,
									'label'=>'Description'
								),
							);
			return $ctrl;
		}
}
?>