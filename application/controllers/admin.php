<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
       
    $this->load->helper("url");

    date_default_timezone_set('Asia/Karachi');
    global $objControllerCommon;

    $objControllerCommon =& get_instance();
      //$objControllerCommon = new common();
    /*if($this->session->userdata('admin_id') == '' || $this->session->userdata('admin_id') == 0){
      header('Location:'. base_url().'admin/login');
    }*/
   }

  public function index()
  {
     if($this->session->userdata('admin_id') != '' && $this->session->userdata('admin_id') != 0)
     {
       header('Location:'. base_url().'admin/home');
      }
      else
      {
       header('Location:'. base_url().'admin/login');
      }
  }

  public function login()
  { 
    $this->load->model('model_admin');

    $data['error']="";
    $data['success']="";
    $txt_usename             = $this->input->post('txt_usename');
    $txt_password            = $this->input->post('txt_password');

    if($this->session->userdata('admin_id') != '' && $this->session->userdata('admin_id') != 0){
      header('Location:'. base_url().'admin/home');
    }


    if(isset($_REQUEST['btn_loginUser'])=="")
    {
    }
    else
    {
       if($txt_usename == "")
        {
          $data['error'] = "Invalid Admin Name";
        }
        elseif($txt_password == "")
        {
          $data['error'] = "Invalid Password";
        }
        else
        {
        }
        if($data['error'] == "")
        { 
          $user_id = 0;
          $user_infos = $this->model_admin->LoginUser(); //Call the model function to Add new user

          foreach($user_infos as $user_info)
          {
            $user_id = $user_info['admin_id'];
          }

          if($user_id != 0 && $user_id != '')
          {
            foreach($user_infos as $user_info)
            {
              $admin_id = $user_info['admin_id'];
              $admin_created_date = $user_info['created_at'];
              $Formated_admin_created_date = date('M, Y', strtotime($admin_created_date));
              $admin_name = $user_info['admin_name'];
              
              $user_data = array(
                'admin_id' => $admin_id,
                'admin_name' => $user_name,
                'Formated_user_created_date' => $Formated_admin_created_date,
              );
              $this->session->set_userdata($user_data);
            }

            $data['success'] = "You have succesfully signup";
            header('Location:'. base_url().'admin/home');
          }
          else
          {
            $data['error'] = "Invalid email or Password";
          }

        }
        else
        {

        }

    }
    $this->load->view('admin/login', $data);
  }

  public function signout()
  {
    if(!$this->session->userdata('admin_id')){
       header('Location:'. base_url().'admin/login');
    }
    $this->session->unset_userdata('admin_id');
    $this->session->unset_userdata('admin_name');
    $this->session->unset_userdata('Formated_user_created_date');
    
    $this->session->sess_destroy();

    header('Location:'. base_url().'admin/login');
  }

  public function home()
  {
    $data[] = "";
    if($this->session->userdata('admin_id') == '' || $this->session->userdata('admin_id') == 0){
      header('Location:'. base_url().'admin/login');
    }

    $this->load->model('model_admin');
    $data["users"] = $this->model_admin->getAllUsers();
    $this->load->view('admin/home',$data);

  }

  public function updateuser()
  {

    $this->load->model('model_admin');
    $data['error']="";
    $data['success']="";
    if($this->session->userdata('admin_id') == '' || $this->session->userdata('admin_id') == 0){
      header('Location:'. base_url().'admin/login');
    }

    $userid = $this->uri->segment(3) ;

    $data["userid"] = $userid;
    if($userid == '' || $userid == 0){
      header('Location:'. base_url().'admin/home');
    }

    if(isset($_POST['hdn_btn_UpdateUser'])=="")
    {
    }
    else
    {

      $txt_Email                    = $this->input->post('txt_Email');
      $txt_FirstName                = $this->input->post('txt_FirstName');
      $txt_LastName                 = $this->input->post('txt_LastName');
      $sel_paymentprovider          = $this->input->post('sel_paymentprovider');
      $txt_PaymentPlatformUserName  = $this->input->post('txt_PaymentPlatformUserName');
      $sel_Country                  = $this->input->post('sel_Country');
      $sel_State                    = $this->input->post('sel_State');
      $txt_City                     = $this->input->post('txt_City');

      if($txt_Email == "")
      {
        $data['error'] = "Invalid Email";
      }
      elseif($txt_Email != "")
      {
        $user_id =  $this->IsEmailAlreadyExist(); // Validate if the user email already exist.
        if($user_id == 0)
        {}
        else
        {
          $data['error'] = "This user name already exist. Try another one";
        }
      }
      if($txt_FirstName == "")
      {
        $data['error'] = "Invalid First Name";
      }
      elseif($txt_LastName == "")
      {
        $data['error'] = "Invalid Last Name";
      }
      elseif($sel_paymentprovider == "")
      {
        $data['error'] = "Invalid Payment Provider";
      }
      elseif($txt_PaymentPlatformUserName == "")
      {
        $data['error'] = "Invalid Payment Platform User Name";
      }
      elseif($sel_Country == "")
      {
        $data['error'] = "Invalid Country";
      }
      elseif($sel_State == "")
      {
        $data['error'] = "Invalid State";
      }
      elseif($txt_City == "")
      {
        $data['error'] = "Invalid City";
      }
      else{}
      
      if($data['error'] == "")
      {
        $this->model_admin->AddEditUser(); //Call the model function to Add new user
        header('Location:'. base_url().'admin/home');
      }
    }

    $data["user_infos"] = $this->model_admin->getUserdata($userid);
    $data["Countries"] = $this->model_admin->GetAllCountries();
   // $data["States"] = $this->model_admin->GetAllStates();
    $data["PaymentProviders"] = $this->model_admin->GetAllPaymentProviders();
    $this->load->view('admin/updateuser',$data);

  }

  public function IsEmailAlreadyExist($Isajaxcall='')
  {
    
    $this->load->model('model_admin');
    $Isajaxcall               = $this->input->post('Isajaxcall');
    $Userid               = $this->input->post('Userid');
    $user_id= 0;
    $user_infos = $this->model_admin->IsEmailAlreadyExist();  
    foreach($user_infos as $user_info)
    {
      $user_id = $user_info['user_id'];
    }
    if($user_id != 0 && $user_id != '')
    {
      if($Isajaxcall == 1)
      {
        echo "Already Exist";
      }
      else
      {
        return $user_id;
      }
    }
    else
    {
      if($Isajaxcall == 1)
      {
        echo "Already Not Exist";
      }
      else
      {
        return 0;
      }
      
    }
  }

  public function GetAllStates($sel_country=0)
  {
    if($sel_country != 0 && $sel_country !='')
    {

      
    }
    else
    {
      $sel_country = 0;
    }
    $where                      = " AND country_id  = $sel_country";
  
    return $this->model_admin->GetAllStates($where);
   }
}
