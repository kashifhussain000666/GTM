<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerUser extends CI_Controller {

	public function __construct() {
	    parent::__construct();
	    $this->load->library('session');
	       
	    $this->load->helper("url");

	    date_default_timezone_set('Asia/Karachi');
	    
	    $this->load->model('model_admin');
	    $this->load->model('model_user');
    
    }
    public function index()
  	{
	    if($this->session->userdata('user_id') == '' || $this->session->userdata('user_id') == 0){
	      header('Location:'. base_url().'login');
	    }
	    else
	    {
	    	header('Location:'. base_url().'home');
	    }
  	}
	
	public function home()
	{
		if($this->session->userdata('user_id') == '' || $this->session->userdata('user_id') == 0){
	      header('Location:'. base_url().'login');
	    }
 		$data['divisionlist']           = $this->model_user->getAllDivisions();
	    $data['Leaderboards']			= $this->model_user->GetLeaderboardDetails();
	    $data['RecentDivisionResults'] 	= $this->model_user->GetLeagueScheduleDetails();
	    $data['Get5BestMatches'] 		= $this->model_user->Get5BestMatches();
	    $data['Get5BestMatchesAverage'] =  $this->model_user->Get5BestMatchesAverage();

	    $data['ChartData_CourceAverage'] = $this->model_user->getChartData_CourceAverage();
	    $data['ChartData_CourceComparison'] = $this->model_user->getChartData_CourceComparison();
	    $data['eventdetails']            = $this->model_user->geteventdetails();
		$this->load->view('user/home',$data);
	}

	public function login()
	{
		if($this->session->userdata('user_id') != '' || $this->session->userdata('user_id') != 0){
         header('Location:'. base_url().'home');
        }

		$data['error'] = '';
		if(isset($_POST['btn_login']))
		{
			$txt_email              = $this->input->post('txt_email');
			$txt_password 			= $this->input->post('txt_password');

			if(trim($txt_email) == '')
			{
				$data['error'] = 'Email is required.';
			}
			elseif(trim($txt_password) == '')
			{
				$data['error'] = 'Password is required.';
			}
			else
			{
				$user = $this->model_user->VerifyUser();

				if(count($user) > 0)
				{

					$this->session->set_userdata('user_id', $user[0]['id']);
					$this->session->set_userdata('playerid', $user[0]['playerid']);
					$this->session->set_userdata('firstname', $user[0]['firstname']);
					$this->session->set_userdata('lastname', $user[0]['lastname']);
					$this->session->set_userdata('user_name', $user[0]['lastname'].' '.$user[0]['lastname']);
					$this->session->set_userdata('email', $user[0]['email']);
					header('Location:'. $this->config->base_url().'home');

				}
				else
				{
					$data['error'] = 'Email or password is incorrect.';
				}
			}
		}

		$this->load->view('auth/login', $data);
		
	}

	public function signup()
	{

		$sel_country		        = $this->input->post('sel_country');
		$where                      = " AND country_id  = 0";

		if($sel_country != 0)
		{
			$where                      = " AND country_id  = $sel_country";
		}
		$data['Countries']			= $this->model_admin->GetAllCountries();
		$data['States']				= $this->model_admin->GetAllStates($where);
		$data['PaymentProviders']	= $this->model_admin->GetAllPaymentProviders();
		$data['error'] = '';
		if(isset($_REQUEST['hdn_btn_signup'])=="")
	    {
	    }
	    else
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

			$data['error']      = $this->ValidateUserReuqest($issignup='1');
			if($data['error'] == '')
			{
				$payerData = $this->model_user->getPlayerIDFromUserAndPlayerTable(trim($txt_playerid), trim($txt_email));
				$isPlayerExist 					= $payerData[0]['isPlayerExist'];
				$isPlayerexistButNotInUser		= $payerData[0]['isPlayerexistButNotInUser'];
				$isPlayerExistInUser 			= $payerData[0]['isPlayerExistInUser'];
				$isPlayerExistInUserSameEmail 	= $payerData[0]['isPlayerExistInUserSameEmail'];
				
				if($data['error'] == '')
				{
					if($this->model_user->AddEditUser( $isPlayerExist,
													   $isPlayerexistButNotInUser,
													   $isPlayerExistInUser,
													   $isPlayerExistInUserSameEmail,
													   $isUpdate =0
													))
					{
						$this->session->set_userdata('success_account', 'Acccount create successfully.');
						header('Location:'. $this->config->base_url().'login');
					}
				}
				
	
			}
		}
		$this->load->view('auth/register', $data);
	}

	public function ValidateUserReuqest($issignup='1')
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
		$is_change_password = $this->input->post('is_change_password');
		$data['error']      = '';
		$user_id           = '';
		if($issignup != 1)
		{
			$user_id           = $this->session->userdata('user_id');
		}

		

		if(trim($txt_playerid) == '' && $issignup == 1)
		{
			$data['error']  = 'PlayerID is required.';
		}
		elseif(strlen(trim($txt_playerid)) != 10 && $issignup == 1)
		{
			$data['error']  = 'PlayerID should be 10 character.';
		}
		elseif (!preg_match('/^[a-zA-Z0-9._]+$/', $txt_playerid) && $issignup == 1)
		{
			$data['error']  = 'PlayerID should be alphanumeric.';
		}
		else if (!filter_var($txt_email, FILTER_VALIDATE_EMAIL))
		{
			$data['error'] = 'Invalid email address.';
		}
		elseif(trim($txt_fname) == '')
		{
			$data['error'] = 'First name is required.';
		}
		elseif(trim($txt_lname) == '')
		{
			$data['error'] = 'Last name is required.';
		}
		elseif($sel_payment_platform == 0 ||  $sel_payment_platform == '' )
		{
			$data['error'] = 'Preffered Payment Platform is required.';
		}
		elseif(trim($txt_payment_username) == ''  )
		{
			$data['error'] = 'Payment Platform Username is required.';
		}
		elseif($sel_country == 0 ||  $sel_country == '' )
		{
			$data['error'] = 'Country is required.';
		}
		elseif($sel_state == 0 ||  $sel_state == '' )
		{
			$data['error'] = 'State is required.';
		}
		elseif(trim($txt_city) == ''  )
		{
			$data['error'] = 'City is required.';
		}
		elseif(trim($txt_password) == '' && (($is_change_password == 1 && $issignup == 0) || $issignup == 1) )
		{
			$data['error'] = 'Password is required.';
		}
		elseif(trim($txt_cpassword) != trim($txt_password)  && (($is_change_password == 1 && $issignup == 0) || $issignup == 1) )
		{
			$data['error'] = 'Confirm passowd not match.';
		}

		$playerData = $this->model_user->getPlayerIDFromUserAndPlayerTable(trim($txt_playerid), trim($txt_email));
		print_r($playerData);
		$isPlayerExist 					= $playerData[0]['isPlayerExist'];
		$isPlayerexistButNotInUser		= $playerData[0]['isPlayerexistButNotInUser'];
		$isPlayerExistInUser 			= $playerData[0]['isPlayerExistInUser'];
		$isPlayerExistInUserSameEmail 	= $playerData[0]['isPlayerExistInUserSameEmail'];
		if(($isPlayerExistInUser == 0 || $isPlayerExist == 0) || ($issignup == '0'))
		{
			if(trim($txt_email) !='' &&  count($this->model_admin->IsEmailAlreadyExist($user_id)) > 0)
			{
				$data['error'] = 'Email already exist.';
			}
		}
		else if($isPlayerExistInUser > 0 && $isPlayerExistInUserSameEmail == 0 )
		{
			$data['error'] = 'PlayerID already exist, use the email already in the system';
		}
		
		return $data['error'];
	}
	public function UpdateUser()
	{
		if($this->session->userdata('user_id') == '' || $this->session->userdata('user_id') == 0){
         header('Location:'. base_url().'login');
        }
        $data["userid"] = $this->session->userdata('user_id');
		$data['error'] = '';
		
		
		if(isset($_REQUEST['txt_Email']))
		{
			$txt_email		= $this->input->post('txt_Email');
			/*if(trim($txt_email) !='' &&  count($this->model_admin->IsEmailAlreadyExist($this->session->userdata('user_id'))) > 0)
			{
				$data['error'] = 'Email already exist.';
			}*/

			//$data['error']      = $this->ValidateUserReuqest($issignup='0');
			//print_r($data['error']);// die();
			if($data['error'] == '')
			{
				/*
				1- IF playerid does not exist insert records as usual
				2- IF playerid exists in player table but not user table, insert new record to user table.
				3- IF playerid exists in user table then ensure e-mail matches before creating new user.
				   If email does not match, provide validation error to user that they must use the email
				   already in the system
				*/
				//$this->model_user->getPlayerIDFromUserAndPlayerTable(trim($txt_playerid), trim($txt_email));			 
				if($this->model_user->AddEditUser(0,0,0,0, $isUpdate =1))
				{
					$this->session->set_userdata('success_update', 'Acccount updated successfully.');
					
					//header('Location:'. $this->config->base_url().'update');
				}
				else
				{

				}
	
			}
		}

		$data['Countries']			= $this->model_admin->GetAllCountries();
		$data['States']				= $this->model_admin->GetAllStates();
		$data['PaymentProviders']	= $this->model_admin->GetAllPaymentProviders();
		$data['user_data']	        =  $this->model_admin->getUserdata($this->session->userdata('user_id'));
		$this->load->view('user/updateuser', $data);
	}

	public function Logout()
	{
		if(!$this->session->userdata('user_id'))
		{
       		header('Location:'. base_url().'login');
    	}
	    $this->session->unset_userdata('user_id');
	    $this->session->unset_userdata('playerid');
	    $this->session->unset_userdata('firstname');
	    $this->session->unset_userdata('lastname');
	    $this->session->unset_userdata('user_name');
	    $this->session->unset_userdata('email');

	    
	    $this->session->sess_destroy();
	    header('Location:'. base_url().'login');
	}
	public function Leaderboard()
	{
		if($this->session->userdata('user_id') == '' || $this->session->userdata('user_id') == 0){
	      header('Location:'. base_url().'login');
	    }
	    //$filter = " and  divisionname	 in ('Bronze', 'Gold', 'Noonan', 'Purple', 'Silver', 'Spackler', 'Webb')";
	    $data['divisionlist']           = $this->model_user->getAllDivisions($filter='');
	    $data['Leaderboards']			= $this->model_user->GetLeaderboardDetails();
	    $data['RecentDivisionResults'] 	= $this->model_user->GetLeagueScheduleDetails();
		$this->load->view('user/Leaderboard', $data);
	}
	public function LeagueSchedule()
	{
		if($this->session->userdata('user_id') == '' || $this->session->userdata('user_id') == 0){
	      header('Location:'. base_url().'login');
	    }
	    $data['LeagueSchedules']			= $this->model_user->GetLeagueScheduleDetails();
		$this->load->view('user/LeagueSchedule', $data);
	}

	public function GetDivisionRecentResultAjax()
	{
		$divisionID = $this->input->post('divisionID');	
		$WhereCondition = '';
		if(trim($divisionID) != '')
		{
			$WhereCondition = ' AND Division in ( '.$divisionID.')';
		}
		$data['RecentDivisionResults'] 	= $this->model_user->GetLeagueScheduleDetails($WhereCondition );
		$data['Leaderboards']           =  $this->model_user->GetLeaderboardDetails($WhereCondition);
		$data_array['Leaderboards']     = $this->LeaderboardGrid($data['Leaderboards'] );
		$data_array['RecentDivisionResults'] = $result = $this->GetRecentDivisionResultGrid($data['RecentDivisionResults'] , $isAjax = '1');
		echo json_encode($data_array, TRUE);
	}


	public function GetRecentDivisionResultGrid($DivisionResult, $isAjax = '0')
	{

		ob_start();
			$RecordNo = 0;
		    foreach($DivisionResult as $DivisionRes)
		    {
		       $RecordNo++;
		      ?>
		      	<tr>
		          <th scope="row"><?=$RecordNo ?></th>
		          <td><?=$DivisionRes['contesttime'] ?></td>
		          <td><?=$DivisionRes['divisionname'] ?></td>
		          <td><?=$DivisionRes['home'] ?></td>
		          <td><?=$DivisionRes['away'] ?></td>
		          <td><?=$DivisionRes['course'] ?></td>
		          <td><?=$DivisionRes['winner'] ?></td>
		          <td><?=$DivisionRes['id'] ?></td>
		          <td><?=$DivisionRes['ParHme'] ?></td>
		          <td><?=$DivisionRes['GSPHme'] ?></td>
		          <td><?=$DivisionRes['ParAwy'] ?></td>
		          <td><?=$DivisionRes['GSPAwy'] ?></td>
		          <td><?=$DivisionRes['pointsadded'] ?></td>
		        </tr>
		      <?php
		    }
		    if($RecordNo == 0)
		    {
		    	?>0<?php 
		    }
		$output = ob_get_clean();  

		
		return $output;
	   

	   
	}

	public function Get5BestMatchesGrid($MatchesData, $isAjax='0')
	{
		ob_start();
			$RecordNo = 0;
		    foreach($MatchesData as $Data)
		    {
		       $RecordNo++;
		      ?>
		      	<tr>
		          <th scope="row"><?=$RecordNo ?></th>
		          <td><?=$Data['name'] ?></td>
		          <td><?=$Data['opponent'] ?></td>
		           <td><?=$Data['course'] ?></td>
		          <td><?=$Data['frontgtpar'] ?></td>
		          <td><?=$Data['backgtpar'] ?></td>
		          <td><?=number_format($Data['GSP']) ?></td>
		          <td><?=$Data['holeouts']?></td>
		        </tr>
		      <?php
		    }
		    if($RecordNo == 0)
		    {
		       ?> 0 <?php
		    /*	?><tr> <td class='text-center' colspan='15'>No Record Found!</td></tr><?php */
		    }
		$output = ob_get_clean();  

		
		return $output;
	   
	}

	public function Get5BestMatchesAverageGrid($Get5BestMatchesAverage, $isAjax='0')
	{
        ob_start();
			$RecordNo = 0;
		    foreach($Get5BestMatchesAverage as $Data)
		    {
		       $RecordNo++;
		      ?>
		      	<tr>
		          <th scope="row"><?=$RecordNo ?></th>
		          <td><?=$Data['eventname'] ?></td>
		          <td><?=$Data['18gtpar'] ?></td>
		          <td><?=$Data['18gsp'] ?></td>
		          <td><?=$Data['backgtpar'] ?></td>
		          <td><?=$Data['backgtpar'] ?></td>
		          <td><?=$Data['frontgtpar'] ?></td>
		          <td><?=$Data['differential']?></td>
		        </tr>
		      <?php
		    }
		    if($RecordNo == 0)
		    {
		    	 ?> 0 <?php
		    	/*?><tr> <td class='text-center' colspan='15'>No Record Found!</td></tr><?php */
		    }
		$output = ob_get_clean();  
		return $output;
	}

	public function GetStateResultOnAjax()
	{
		$division_list = $this->input->post('divisionID');
		$eventID       = $this->input->post('eventID');
		$user_name     = $this->input->post('user_name');

		$CourceAverageFilter = '';
		$CourceComparisonFilter = '';
		$filter = '';
		if($division_list !='')
		{
			$filter = " AND Divisionid in ( ".$division_list.")";
			$CourceAverageFilter .= " AND Divisionid in ( ".$division_list.")";
			$CourceComparisonFilter .= " AND Divisionid in ( ".$division_list.")";
		}

		if($eventID !='')
		{
			$filter .= " AND eventdetailsid in ( ".$eventID.")";
			$CourceAverageFilter .= " AND eventdetailsid in ( ".$eventID.")";
			$CourceComparisonFilter .= " AND eventdetailsid in ( ".$eventID.")";
		}

		if(trim($user_name) !='')
		{
			$filter .= " AND name like '%".$user_name."%' ";
			$CourceAverageFilter .= " AND name like '%".$user_name."%' ";
			$CourceComparisonFilter .= " AND name like '%".$user_name."%' ";
		}


		$Get5BestMatches	= $this->model_user->Get5BestMatches($filter);
	    $Get5BestMatchesAverage =  $this->model_user->Get5BestMatchesAverage($filter);

	    $data['Get5BestMatchesGrid'] = $this->Get5BestMatchesGrid($Get5BestMatches , $isAjax='0');
	    $data['Get5BestMatchesAverageGrid'] =$this->Get5BestMatchesAverageGrid($Get5BestMatchesAverage, $isAjax='0');
		

		$data['ChartData_CourceAverage'] = $this->model_user->getChartData_CourceAverage($CourceAverageFilter);
	    $data['ChartData_CourceComparison'] = $this->model_user->getChartData_CourceComparison($CourceComparisonFilter);

		echo json_encode($data, TRUE);
	}

	public function LoadStatesHTML()
	{
		$county_id = $this->input->post('county_id');
		$States = $this->model_user->GetCountryStates($county_id);
		echo '<option value="0">Select State</option>';
		foreach($States as $State)
        { ?>
        <option value="<?=$State['id'] ?>"><?php echo $State['name']; ?></option>
        <?php 
        }
	}

	public function LeaderboardGrid($Leaderboards)
	{
		ob_start();
			$RecordNo = 0;
	      	foreach($Leaderboards as $Leaderboard)
	      	{
	        $RecordNo++;
	      	?>
	      	  <tr>
	          <th scope="row"><?=$RecordNo ?></th>
	          <td><?=$Leaderboard['rosterid'] ?></td>
	          <td><?=$Leaderboard['playername'] ?></td>
	          <td><?=$Leaderboard['divisionname'] ?></td>
	          <td><?=$Leaderboard['avgpoints'] ?></td>
	          <td><?=$Leaderboard['wins'] ?></td>
	          <td><?=$Leaderboard['losses'] ?></td>
	          <td><?=$Leaderboard['gamesplayed'] ?></td>
	          <td><?=$Leaderboard['points'] ?></td>
	          <td><?=$Leaderboard['avgscore'] ?></td>
	          <td><?=$Leaderboard['opponentavgscore'] ?></td>
	          <td><?=$Leaderboard['gamesremaining'] ?></td>
	          <td><?=$Leaderboard['potentialpoints'] ?></td>
	        </tr>
	      	<?php
	      	}
	      	if($RecordNo == 0)
		    {
		    	 ?> 0 <?php
		    	/*?><tr> <td class='text-center' colspan='15'>No Record Found!</td></tr><?php */
		    }
	    $output = ob_get_clean();  
		return $output;
	}

	

}

