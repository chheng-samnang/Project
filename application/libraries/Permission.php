<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Permission
{	
	public function __construct()
	{		
		$CI = & get_instance();		
		if(isset($CI->session->userType))
		{
			$this->check_page('add',$CI->session->userType);
			$this->check_page('edit',$CI->session->userType);
			$this->check_page('delete',$CI->session->userType);
		}		
	}
	public function check_page($page='',$type='')
	{
		for($i=0;$i<3;$i++)
			{
				if($this->get_data($i,'type')==$type)
				{					
					if(strpos(current_url(),$page)==TRUE)
					{
						if($this->get_data($i,$page)==0)
						{													
							redirect(base_url('admin/Permissionmsg'));														
						}
					}					
				}				
			}			
	}
	public function get_data($index='',$type='')
	{
		return $this->data()[$index][$type];	
	}
	public function data()
	{
		return array(
						array('type'=>'administrator','select'=>1,'add'=>1,'edit'=>1,'delete'=>1),
						array('type'=>'editor','select'=>1,'add'=>0,'edit'=>1,'delete'=>0),
						array('type'=>'inputer','select'=>1,'add'=>1,'edit'=>0,'delete'=>0)
					);		
	}
}