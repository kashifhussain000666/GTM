<?php 
date_default_timezone_set('Asia/Karachi');
class model_user extends CI_Model {

	

	public function __construct()	

	{
		  $this->load->database();
	}

	public function AddEditUser()
	{
		$txt_playerid       = $this->input->post('txt_playerid');
		$txt_email 			= $this->input->post('txt_Email');
		$txt_fname 			= $this->input->post('txt_fname');
		$txt_lname 			= $this->input->post('txt_lname');
		$sel_payment_platform = $this->input->post('sel_payment_platform');
		$txt_payment_username = $this->input->post('txt_payment_username');
		$sel_country		= $this->input->post('sel_country');
		$sel_state 			= $this->input->post('sel_state');
		$txt_city 			= $this->input->post('txt_city');
		$txt_password 		= $this->input->post('txt_password');
		$txt_cpassword 		= $this->input->post('txt_cpassword');

		$data['id']         	=  $this->GetLastUserID() > 0 ? $this->GetLastUserID() + 1 : 1; // $a > 15 ? 20 : 5;
		    	    
		$data['playerid']       = $txt_playerid ;
		$data['firstname']      = $txt_fname ;
		$data['lastname']       = $txt_lname;
		$data['email']          = $txt_email;
		$data['paymentproviderid'] = $sel_payment_platform;
		$data['paymentusername']   = $txt_payment_username ;

		$data['state']         = $sel_state;
		$data['country']       = $sel_country;
		$data['city']          = $txt_city ;
		$data['password']      = md5($txt_password);
		if($this->db->insert('user',$data)){

			return true;
		}
		else
		{
			return false;
		}
		
	}

	public function GetLastUserID()
	{
		$query  = $this->db->query(" 	
  									SELECT MAX(u.id) as last_id
  									FROM user u
								");
		$result = $query->result_array();		
		
		return $result[0]['last_id'];
	}

	public function VerifyUser()
	{
		$txt_email              = $this->input->post('txt_email');
		$txt_password 			= $this->input->post('txt_password');

		

		$query = "
					SELECT *
					FROM user u
					where email = ".$this->db->escape($txt_email)."  
					AND password = ".$this->db->escape(md5($txt_password)) 
				;
		;
		$result = $this->db->query($query)->result_array();		
		
		return $result;

	}
    
    public function getPlayerIDFromUserAndPlayerTable($txt_playerid, $txt_email)
    {
    	$query = "
    				select 
					(
					    select COUNT(*)
					    from player p
					    where p.id = '$txt_playerid'
					)as isPlayerExist,
					(
					    select COUNT(*)
					    from player p
					    where p.id = '$txt_playerid'
					    AND 
					    (
					        SELECT COUNT(*)
					        from user u 
					        where u.playerid = p.id
					    )=0
					) as isPlayerexistButNotInUser,
					(
					    select count(*)
					    from user u 
					    where u.playerid = '$txt_playerid'
					  
					) as isPlayerExistInUser,
					(
					    select count(*)
					    from user u 
					    where u.playerid = '$txt_playerid'
					    and u.email = '$txt_email'
					  
					) as isPlayerExistInUserSameEmail

    			";
    	$result = $this->db->query($query)->result_array();		
		
		return $result;
    }
	
}