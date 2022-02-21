<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerUser extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('auth/login');
		
	}

	public function signup()
	{
		//$this->load->view('welcome_message');
		$this->load->view('auth/register');
	}

	public function create_account()
	{
		$data['error'] = '';
		if(isset($_POST['signup']))
		{

			$txt_playerid       = $this->input->post('txt_playerid');
			$txt_email 			= $this->input->post('txt_email');
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
				$data['error'] = 'Invalid email address';
			}
			/*elseif()
			{

			}*/
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
				$data['error'] = 'Payment platform is required.';
			}
			elseif(trim($txt_payment_username) == ''  )
			{
				$data['error'] = 'Payment username is required.';
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

			}

			print_r($data['error']);
		 

		}











	}
}
