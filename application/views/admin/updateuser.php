<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GTM The League</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Choices.js-->
    <link rel="stylesheet" href="<?=$this->config->base_url()?>asset/vendor/choices.js/public/assets/styles/choices.min.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?=$this->config->base_url()?>asset/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?=$this->config->base_url()?>asset/css/custom.css">
    <!-- Favicon-->
    <!-- <link rel="shortcut icon" href="<?=$this->config->base_url()?>asset/img/favicon.ico"> -->
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <style type="text/css">
      .spanError{
        color: #ff0000;
      }
      .Errorborderclass{
        border-color: #ff0000;
      }
    </style>
  </head>
  <body>

  <?php
  if(empty($user_infos)){
   //user exists
    die("Oops! Something went wrong please contact site administrator.");
  }

    $txt_PlayerID = '' ;
    $txt_Email = '' ;
    $txt_FirstName = '' ;
    $txt_LastName = '' ;
    $sel_paymentprovider = '' ;
    $txt_PaymentPlatformUserName = '' ;
    $sel_Country = '' ;
    $sel_State = '' ;
    $txt_City = '' ;
    
    if(isset($_POST['hdn_btn_UpdateUser'])=="")
    {
      if(isset($userid) && $userid != '')
      {
        foreach($user_infos as $user_info)
        {
          $txt_PlayerID         = $user_info['playerid'];
          $txt_Email            = $user_info['email'];
          $txt_FirstName        = $user_info['firstname'];
          $txt_LastName         = $user_info['lastname'];
          $sel_paymentprovider         = $user_info['paymentproviderid'];
          $txt_PaymentPlatformUserName         = $user_info['paymentusername'];
          $sel_Country         = $user_info['country'];
          $sel_State         = $user_info['state'];
          $txt_City         = $user_info['city'];
        }
      }
    }
    else
    {
      $txt_PlayerID                   = $this->input->post('txt_PlayerID');
      $txt_Email                      = $this->input->post('txt_Email');
      $txt_FirstName                  = $this->input->post('txt_FirstName');
      $txt_LastName                   = $this->input->post('txt_LastName');
      $sel_paymentprovider            = $this->input->post('sel_paymentprovider');
      $txt_PaymentPlatformUserName            = $this->input->post('txt_PaymentPlatformUserName');
      $sel_Country                    = $this->input->post('sel_Country');
      $sel_State                      = $this->input->post('sel_State');
      $txt_City                      = $this->input->post('txt_City');
      
    }
    ?>

    <div class="login-page" >
      <div class="container d-flex align-items-center position-relative py-5">
        <div class="card shadow-sm w-100 rounded overflow-hidden bg-none">
          <div class="card-body p-0">

            <div class="row gx-0 align-items-stretch">
              <!-- Logo & Information Panel-->
              <div class="col-lg-6">
                <div class="info d-flex justify-content-center flex-column p-4 h-100" style="background-color: #e6e6e6">
                  <div class="py-5">
                    <img src="https://gtmtheleague.com/images/logo.png" style="width: 100%;">
                  </div>
                </div>
              </div>
              <!-- Form Panel    -->
              <div class="col-lg-6 bg-white">
                <div class="d-flex align-items-center px-4 px-lg-5 h-100 bg-dash-dark-2" style="background:#0e1b3f !important ">
                  <form  action="" method="post" id="form_updateuser">
                    <div class="row">
                      <div class="login-div">
                        <h2 class="color-white">Edit User</h2>
                      </div>
                    </div>
                    <div class="row">
                      <?php 
                        if($error != "")
                        {
                          ?>
                            <div class="alert alert-danger">
                            <strong>Error!</strong> <?=$error?>
                            </div>
                        <?php 
                        }
                        if($success != "")
                        {
                          ?>
                            <div class="alert alert-success">
                              <strong>Success!</strong> <?=$success?>
                            </div>
                          <?php
                        }
                        ?>
                    </div>
                    <?php 
                    if(isset($userid) && $userid != '')
                    { ?>
                      <input type="hidden" name="Userid" value="<?=$userid ?>">
                    <?php
                    }
                    ?>
                    <div class="row">
                      <div class="col-sm-6">
                        <label class="form-label" for="exampleInputEmail1">Golden Tee PlayerID</label>
                        <input class="form-control" id="txt_PlayerID" name="txt_PlayerID" type="email"  placeholder="PlayerID" value="<?=$txt_PlayerID ?>" disabled>
                        <span id="Error_PlayerID" class="spanError"></span>
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="exampleInputEmail1">Email </label>
                        <input class="form-control" id="txt_Email" name="txt_Email" type="email" aria-describedby="emailHelp"  placeholder="Email" value="<?=$txt_Email ?>">
                        <span id="Error_Email" class="spanError"></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <label class="form-label" for="exampleInputEmail1">First Name</label>
                        <input class="form-control" id="txt_FirstName" name="txt_FirstName" type="text"  placeholder="First Name" value="<?=$txt_FirstName ?>">
                        <span id="Error_FirstName" class="spanError"></span>
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="exampleInputEmail1">Last Name</label>
                        <input class="form-control" id="txt_LastName" name="txt_LastName" type="text"  placeholder="Last Name" value="<?=$txt_LastName ?>">
                        <span id="Error_LastName" class="spanError"></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <label class="form-label" for="exampleInputEmail1">Preferred Payment Platform</label>
                        <select class="form-select mb-3" name="sel_paymentprovider" id="sel_paymentprovider" >
                          <option value="">Select</option>
                          <?php 
                          foreach($PaymentProviders as $PaymentProvider)
                          {
                          ?>
                            <option value="<?=$PaymentProvider['id'] ?>" <?php if($sel_paymentprovider == $PaymentProvider['id']){ echo "selected" ;} ?>><?php echo $PaymentProvider['name']; ?></option>
                          <?php 
                          }
                          ?>
                          </select>
                        <span id="Error_paymentprovider" class="spanError"></span>
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="exampleInputEmail1">Payment Platform UserName</label>
                        <input class="form-control" id="txt_PaymentPlatformUserName" name="txt_PaymentPlatformUserName" type="text"  placeholder="Payment Platform UserName" value="<?=$txt_PaymentPlatformUserName ?>">
                        <span id="Error_PaymentPlatformUserName" class="spanError"></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <label class="form-label" for="exampleInputEmail1">Country</label>
                        <select class="form-select mb-3" name="sel_Country" id="sel_Country">
                          <option value="">Select</option>
                          <?php 
                          foreach($Countries as $Country)
                          {
                          ?>
                            <option value="<?=$Country['id'] ?>" <?php if($sel_Country == $Country['id']){ echo "selected" ;} ?>><?php echo $Country['name']; ?></option>
                          <?php 
                          }
                          ?>
                          </select>
                        <span id="Error_Country" class="spanError"></span>
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="exampleInputEmail1">State</label>
                        <select class="form-select mb-3" name="sel_State" id="sel_State">
                          <option value="">Select</option>
                          <?php 
                          foreach($States as $State)
                          {
                          ?>
                            <option value="<?=$State['id'] ?>" <?php if($sel_State == $State['id']){ echo "selected" ;} ?>><?php echo $State['name']; ?></option>
                          <?php 
                          }
                          ?>
                          </select>
                        <span id="Error_State" class="spanError"></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <label class="form-label" for="exampleInputEmail1">City</label>
                        <input class="form-control" id="txt_City" name="txt_City" type="text"  placeholder="City" value="<?=$txt_City ?>">
                        <span id="Error_City" class="spanError"></span>
                      </div>
                    </div>
                    <input type="hidden" name="hdn_btn_UpdateUser" value="hdn_btn_UpdateUser">
                    <button class="btn btn-primary" id="btn_UpdateUser" name="btn_UpdateUser">Update user
                      </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="register-footer text-center position-absolute bottom-0 start-0 w-100">
        <!-- <p class="text-white">Design by <a class="external" href="https://bootstrapious.com/p/admin-template">Bootstrapious</a> -->
          <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
        </p>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="<?=$this->config->base_url()?>asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=$this->config->base_url()?>asset/vendor/just-validate/js/just-validate.min.js"></script>
    <script src="<?=$this->config->base_url()?>asset/vendor/chart.js/Chart.min.js"></script>
    <script src="<?=$this->config->base_url()?>asset/vendor/choices.js/public/assets/scripts/choices.min.js"></script>
    <!-- Main File-->
    <script src="<?=$this->config->base_url()?>asset/js/front.js"></script>

    <script src="<?=$this->config->base_url()?>asset/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
      var BaseUrlSite = '<?php echo base_url(); ?>';
    </script>
    <script type="text/javascript">
      
      //function ValidateLogin()
    $("#btn_UpdateUser").click(function()
    {
      $("#form_updateuser").submit();
      return false;
        var txt_Email             = $.trim($("#txt_Email").val());

        $(".spanError").html("");
        $(".form-control").removeClass( "Errorborderclass" );

        var validations ={
          email: [/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/, 'Please enter a valid email address']
            };
        validation = new RegExp(validations['email'][0]);

        if(txt_Email == "" )
        {
          $("#Error_Email").html("Invalid Email");
          $("#txt_Email").addClass( "Errorborderclass" );
          $("#txt_Email").focus();
          return false;
        }
        if (!validation.test(txt_Email)){
              $("#Error_Email").html("Invalid Email Format");
              $("#txt_Email").addClass( "Errorborderclass" );
              $("#txt_Email").focus();
              return false;
        }
      if( txt_Email != '')
      {
        $.ajax({
          url:BaseUrlSite+'admin/IsEmailAlreadyExist',
          data:{
              txt_Email: txt_Email,
              Isajaxcall : 1,
              Userid : 
              <?php 
              if(isset($userid) && $userid != '')
              { ?>
              <?=$userid ?>
              <?php
              }
              else
              {
                echo 0;
              } ?>
            },
            type:'POST',
            success:function(data)
            {
              if(data=='Already Exist')
              {
                $("#Error_Email").html("This email already exist");
                $("#txt_Email").addClass( "Errorborderclass" );
                $("#txt_Email").focus();
                return false;
              }
              else
              {
                ValidateOnSuccessfunction();

              }
              
            } 
        });
      }
      return false;
       
      });

    function ValidateOnSuccessfunction()
    {
      var txt_FirstName         = $.trim($("#txt_FirstName").val());
      var txt_LastName          = $.trim($("#txt_LastName").val());
      var sel_paymentprovider   = $.trim($("#sel_paymentprovider").val());
      var txt_PaymentPlatformUserName        = $.trim($("#txt_PaymentPlatformUserName").val());
      var sel_Country           = $.trim($("#sel_Country").val());
      var sel_State             = $.trim($("#sel_State").val());
      var txt_City              = $.trim($("#txt_City").val());

      if(txt_FirstName == "" )
      {
        $("#Error_FirstName").html("Please enter First Name");
        $("#txt_FirstName").addClass( "Errorborderclass" );
        $("#txt_FirstName").focus();
        return false;
      }
      if(txt_LastName == "" )
      {
        $("#Error_LastName").html("Please enter Last Name");
        $("#txt_LastName").addClass( "Errorborderclass" );
        $("#txt_LastName").focus();
        return false;
      }
      if(sel_paymentprovider == "" )
      {
        $("#Error_paymentprovider").html("Please enter Payment Provider");
        $("#sel_paymentprovider").addClass( "Errorborderclass" );
        $("#sel_paymentprovider").focus();
        return false;
      }
      if(txt_PaymentPlatformUserName == "" )
      {
        $("#Error_PaymentPlatformUserName").html("Please enter Payment Provider");
        $("#txt_PaymentPlatformUserName").addClass( "Errorborderclass" );
        $("#txt_PaymentPlatformUserName").focus();
        return false;
      }
      if(sel_Country == "" )
      {
        $("#Error_Country").html("Please select Country");
        $("#sel_Country").addClass( "Errorborderclass" );
        $("#sel_Country").focus();
        return false;
      }
      if(sel_State == "" )
      {
        $("#Error_State").html("Please select State");
        $("#sel_State").addClass( "Errorborderclass" );
        $("#sel_State").focus();
        return false;
      }
      if(txt_City == "" )
      {
        $("#Error_City").html("Please select City");
        $("#txt_City").addClass( "Errorborderclass" );
        $("#txt_City").focus();
        return false;
      }
      else
      {
        $("#form_updateuser").submit();
        
      }
    }
    </script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>