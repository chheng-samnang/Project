<?php
	class User_m extends CI_Model{
		public function __construct() {
						parent::__construct();
						$this->load->helper("security");
						}
		public function index($user_id){
					if($user_id==""){
					   $query = $this->db->get('tbl_user');
					   $result = $query->result();	
					   return $result;	
					}else{
						$this->db->where('user_id',$user_id);
						$query = $this->db->get('tbl_user');
						$result = $query->result();	
					    return $result; 	
					}
		}
		public function user_udate($user_id){
						if($user_id!==""){
							    $data = array(
								'user_code'=>$this->input->post('txtUserCode'),
								'user_type'=>$this->input->post('txtUsertype'),
								'user_name'=>$this->input->post('txtUsername'),
								'user_desc'=>$this->input->post('txtDesc'),
								'user_status'=>$this->input->post('ddlStatus'),
								'user_updt'=>$this->session->userLogin,
								'date_updt'=>date('Y-m-d')
							);
					       $this->db->where('user_id',$user_id);
						   $query=$this->db->update('tbl_user',$data);
						   if($query==TRUE){return TRUE;}
						}
				}
			   //select all user to view
		 function user_login($user,$password)
					{    
						$this->db->where('userName', $user);
						$this->db->where('password',$password);
						return $this->db->get('tbl_user')->result_array();
					}//_______________User_login____________
		 function check($user_code)
		 			{
						$this->db->where('userCode' , $user_code);
						$result = $this->db->get('tbl_user');
						return $result->result_array(); 	
		 			}
		public function check_user($user_id)
		 			{
						$this->db->where('user_id', $user_id);
						$result = $this->db->get('tbl_user');
						return $result->result_array(); 	
		 			}
		public function user_create()
					{
		 			    $userLogin = isset($this->session->userLogin)?$this->session->userLogin:"N/A";
		 				    $data = array(
		 						'user_code'=>$this->input->post('txtUserCode'),
		 						'user_name'=>$this->input->post('txtUsername'),
		 						'user_pass'=>do_hash($this->input->post('txtPassword')),
		 						'user_desc'=>$this->input->post('txtDesc'),
		 						'user_type'=>$this->input->post('txtUsertype'),
		 						'user_status'=>$this->input->post('ddlStatus'),
		 						'user_crea'=>$userLogin,
		 						'date_crea'=>date('Y-m-d')
		 					);
		 				    if($data!==""){
		 				    	$query=$this->db->insert('tbl_user',$data);
		 				    	if($query==TRUE){return TRUE;}
		 				    }
					}
	    public function delete($user_id){
						$this->db->where('user_id',$user_id);
						$result = $this->db->delete('tbl_user');
	    }
				 //create new user.............
		public function updatePassword($id)
            {
               if($id!==""){
				   if($this->input->post('txtNewPassword')==$this->input->post('txtConfirm')){
					$this->db->where('user_id',$id);
					$data = array('user_pass'=>do_hash($this->input->post('txtNewPassword')));
					$query=$this->db->update('tbl_user',$data);
					if($query==TRUE){return TRUE;}
				   }
            }
		}
		public function user_edit($user_id)
		 		{
					$this->db->where('user_id',$user_id);
					$data = array(
									'user_code'=>$this->input->post('txtUsercode'),
									'user_name'=>$this->input->post('txtUsername'),
									'user_desc'=>$this->input->post('txtDesc'),
									'user_status'=>$this->input->post('ddlStatus'),
									'user_updt'=>$this->session->userLogin,
									'date_updtd'=>date('Y-m-d')
						);
					$result = $this->db->update('tbl_user',$data);
			    }
			    
	}
?>
