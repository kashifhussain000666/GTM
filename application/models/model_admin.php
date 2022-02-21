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
	//Function check if email already exist
	public function IsEmailAlreadyExist()
	{
		$txt_Email		= $this->input->post('txt_Email');
		$Userid        = $this->input->post('Userid');
		$WhereCondition = "";
		if($Userid != '' && $Userid != 0)
		{
			$WhereCondition = " AND u.id != $Userid ";
		}
	  	$query  = $this->db->query(" 	
  									SELECT u.id as user_id
  									FROM user u
									WHERE u.email = '$txt_Email'
									$WhereCondition
								");
		$result = $query->result_array();		
		return $result;
	}

	// Function Add employee
	public function AddEditUser()
	{
		$Userid              		  = $this->input->post('Userid');
		$txt_Email                    = $this->input->post('txt_Email');
      	$txt_FirstName                = $this->input->post('txt_FirstName');
      	$txt_LastName                 = $this->input->post('txt_LastName');
      	$sel_paymentprovider          = $this->input->post('sel_paymentprovider');
      	$txt_PaymentPlatformUserName  = $this->input->post('txt_PaymentPlatformUserName');
      	$sel_Country                  = $this->input->post('sel_Country');
      	$sel_State                    = $this->input->post('sel_State');
     	$txt_City                     = $this->input->post('txt_City');

	     // UPDATE CASE
	    if( $Userid != '')
        {
        	$query = $this->db->query("
									UPDATE user
									SET 
									`email` = '$txt_Email',
									`firstname`= '$txt_FirstName',
									`lastname`= '$txt_LastName',
									`paymentproviderid` = '$sel_paymentprovider',
									`paymentusername` = '$txt_PaymentPlatformUserName',
									`country` = '$sel_Country',
									`state` = '$sel_State',
									`City` = '$txt_City'
									WHERE id = $Userid
								");
        }
        // else //ADD CASE
        // {
        // 	$query = $this->db->query("
								// 	INSERT iNTO tbl_user
								// 	(
								// 		user_name,
								// 		user_email,
								// 		user_phone,
								// 		user_password,
								// 		user_department_id,
								// 		user_salaryPerHour,
								// 		user_city,
								// 		user_state,
								// 		user_zip,
								// 		user_country,
								// 		user_designation_id,
								// 		CreatedBY
								// 	)
								// 	VALUES 
								// 	(
								// 		'$txt_user_name',
								// 		'$txt_user_email',
								// 		'$txt_user_phone',
								// 		'$txt_user_password',
								// 		'1 '/*Requested*/,
								// 		'$txt_user_salaryPerHour',
								// 		'$txt_user_city',
								// 		'$txt_user_state',
								// 		'$txt_user_zip',
								// 		'$txt_user_country',
								// 		'3',
								// 		'$user_id'
								// 	)	
								// ");
        // }
		
	}
	
}