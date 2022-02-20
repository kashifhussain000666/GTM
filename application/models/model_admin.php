<?php 
date_default_timezone_set('Asia/Karachi');
class model_admin extends CI_Model {

	

	public function __construct()	

	{
		  $this->load->database();
	}

	public function LoginUser()
	{
		$txt_usename              = $this->input->post('txt_usename');
		$txt_password             = $this->input->post('txt_password');

		$ecryptedPassword = md5($txt_password); // Apply encryption;
	  	$query  = $this->db->query(" 	
	  									SELECT *
										FROM tbl_admin  ta
										WHERE ta.admin_email = '$txt_usename'
										AND ta.admin_pass = '$ecryptedPassword'
									");
		
		$result = $query->result_array();			
		return $result;
	}

	public function getAllUsers()
	{
		$WhereCondition = "";
		$query  = $this->db->query(" 	
									SELECT `id`,
									`playerid`,
									(
									    SELECT p.nickname
									    from player p
									    Where p.id = u.playerid
									) as nickname,
									`firstname`,
									`lastname`,
									`email`,
									`paymentproviderid`,
									(
									    SELECT pp.name
									    from paymentprovider pp
									    Where pp.id = u.paymentproviderid
									) as payment,
									`paymentusername`,
									`state`,
									(
									    SELECT s.name
									    from state s
									    Where s.id = u.state
									) as statename,
									`country`,
									(
									    SELECT c.name
									    from country c
									    Where c.id = u.country
									) as countryname,
									`city`,
									`updated_at`,
									`created_at`,
									`discordid`
									FROM user u
									ORDER BY firstname ASC,lastname ASC
									");
		
		// $query  = $this->db->query(" 	
		// 								SELECT *
		// 								FROM `tbl_users` tu 
		// 								WHERE 1= 1 
		// 								AND tu.user_type = 1
		// 								AND tu.user_is_active = 1
		// 								$WhereCondition
		// 								ORDER BY user_fname , user_lname
		// 							");
		
		$result = $query->result_array();			
		return $result;
	}

	public function getUserdata($userid)
	{
		$WhereCondition = "";
		$query  = $this->db->query(" 	
									SELECT `id`,
									`playerid`,
									(
									    SELECT p.nickname
									    from player p
									    Where p.id = u.playerid
									) as nickname,
									`firstname`,
									`lastname`,
									`email`,
									`paymentproviderid`,
									(
									    SELECT pp.name
									    from paymentprovider pp
									    Where pp.id = u.paymentproviderid
									) as payment,
									`paymentusername`,
									`state`,
									(
									    SELECT s.name
									    from state s
									    Where s.id = u.state
									) as statename,
									`country`,
									(
									    SELECT c.name
									    from country c
									    Where c.id = u.country
									) as countryname,
									`city`,
									`updated_at`,
									`created_at`,
									`discordid`
									FROM user u
									WHERE u.id = $userid
									ORDER BY firstname ASC,lastname ASC
									");
		
		// $query  = $this->db->query(" 	
		// 								SELECT *
		// 								FROM `tbl_users` tu 
		// 								WHERE 1= 1 
		// 								AND tu.user_type = 1
		// 								AND tu.user_is_active = 1
		// 								$WhereCondition
		// 								ORDER BY user_fname , user_lname
		// 							");
		
		$result = $query->result_array();			
		return $result;
	}
  	public function GetAllCountries()
	{
	  	$query  = $this->db->query(" 	
	  								SELECT *
    								from country c
								");
		
		$result = $query->result_array();			
		return $result;
	}
	public function GetAllStates()
	{
	  	$query  = $this->db->query(" 	
	  								SELECT *
    								from state s
								");
		
		$result = $query->result_array();			
		return $result;
	}
	public function GetAllPaymentProviders()
	{
	  	$query  = $this->db->query(" 	
	  								SELECT *
    								from paymentprovider pp
								");
		
		$result = $query->result_array();			
		return $result;
	}
	
}