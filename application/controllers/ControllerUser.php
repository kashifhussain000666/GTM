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
	
	public function home()
	{
		if($this->session->userdata('user_id') == '' || $this->session->userdata('user_id') == 0){
	      header('Location:'. base_url().'user/login');
	    }
		$this->load->view('user/home');
	}

	public function login()
	{
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
					header('Location:'. $this->config->base_url().'user/home');

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

			if (!filter_var($txt_email, FILTER_VALIDATE_EMAIL))
			{
				$data['error'] = 'Invalid email address.';
			}
			elseif(trim($txt_email) !='' and count($this->model_admin->IsEmailAlreadyExist()) > 0)
			{
				$data['error'] = 'Email already exist.';
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
			elseif(trim($txt_password) == ''  )
			{
				$data['error'] = 'Password is required.';
			}
			elseif(trim($txt_cpassword) != trim($txt_password)  )
			{
				$data['error'] = 'Confirm passowd not match.';
			}
			else
			{
				if($this->model_user->AddEditUser())
				{
					$this->session->set_userdata('success_account', 'Acccount create successfully.');
					header('Location:'. $this->config->base_url().'user/login');
				}
				else
				{

				}
	
			}
		}
		$this->load->view('auth/register', $data);
	}

	public function UpdateUser()
	{
		if($this->session->userdata('user_id') == '' || $this->session->userdata('user_id') == 0){
         header('Location:'. base_url().'user/login');
        }
		$data['error'] = '';
		$data['Countries']			= $this->model_admin->GetAllCountries();
		$data['States']				= $this->model_admin->GetAllStates();
		$data['PaymentProviders']	= $this->model_admin->GetAllPaymentProviders();
		$data['user_data']	        =  $this->model_admin->getUserdata($this->session->userdata('user_id'));
		
		if(isset($_POST['update']))
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

			if(trim($txt_playerid))
			{
				$data['error'] = 'PlayerID is required.';
			}
			else if (!filter_var($txt_email, FILTER_VALIDATE_EMAIL))
			{
				$data['error'] = 'Invalid email address.';
			}
			elseif(trim($txt_email) !='' and count($this->model_admin->IsEmailAlreadyExist()) > 0)
			{
				$data['error'] = 'Email already exist.';
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
			elseif(trim($txt_password) == ''  )
			{
				$data['error'] = 'Password is required.';
			}
			elseif(trim($txt_cpassword) != trim($txt_password)  )
			{
				$data['error'] = 'Confirm passowd not match.';
			}
			else
			{
				/*
				1- IF playerid does not exist insert records as usual
				2- IF playerid exists in player table but not user table, insert new record to user table.
				3- IF playerid exists in user table then ensure e-mail matches before creating new user.
				   If email does not match, provide validation error to user that they must use the email
				   already in the system
				*/
				$this->model_user->getPlayerIDFromUserAndPlayerTable((trim($txt_playerid), trim($txt_email));			 
				if($this->model_user->AddEditUser())
				{
					$this->session->set_userdata('success_account', 'Acccount create successfully.');
					header('Location:'. $this->config->base_url().'user/login');
				}
				else
				{

				}
	
			}
		}
		$this->load->view('user/updateuser', $data);
	}
}
