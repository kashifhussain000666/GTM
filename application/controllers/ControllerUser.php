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
		$this->load->view('user/home');
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

		$data['Countries']			= $this->model_admin->GetAllCountries();
		$data['States']				= $this->model_admin->GetAllStates();
		$data['PaymentProviders']	= $this->model_admin->GetAllPaymentProviders();
		$data['error'] = '';
		if(isset($_POST['signup']))
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
	    $data['Leaderboards']			= $this->model_user->GetLeaderboardDetails();
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

}
