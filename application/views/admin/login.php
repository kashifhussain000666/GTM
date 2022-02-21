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
    <link rel="shortcut icon" href="<?=$this->config->base_url()?>asset/img/favicon.ico">
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
  <!-- Heder here  -->
    
     <div class="login-page">
      <div class="container d-flex align-items-center position-relative py-5">
        <div class="card shadow-sm w-100 rounded overflow-hidden bg-none">
          <div class="card-body p-0">
            <div class="row gx-0 align-items-stretch">
              <!-- Logo & Information Panel-->
              <div class="col-lg-6">
                <div class="info d-flex justify-content-center flex-column p-4 h-100 logo-div-back">
                  <div class="">
                    <img src="<?=$this->config->base_url()?>asset/img/GTM.png" class="img-fluid">
                  </div>
                </div>
              </div>
              <!-- Form Panel    -->
              <div class="col-lg-6 colo">

                <div class=" align-items-center px-4 px-lg-5 h-100 bg-dash-dark-2">

                  <form action="" method="post" id="form_login">
                    <div class="login-div">
                      <h2 class="color-white">Admin Login</h2>
                    </div>
                    <?php 
                    if($error != "")
                    {
                      ?>
                      <div class="card-header">
                        <div class="alert alert-danger">
                        <strong>Error!</strong> <?=$error?>
                        </div>
                      </div>
                    <?php 
                    }
                    if($success != "")
                    {
                      ?>
                      <div class="card-header">
                        <div class="alert alert-success">
                          <strong>Success!</strong> <?=$success?>
                        </div>
                      </div>
                      <?php
                    }
                    ?>
                    <!-- <div>Login</div> -->
                    <div class="mb-3 mt-5">
                      <label class="form-label" for="exampleInputEmail1">Email address</label>
                      <input class="form-control" id="txt_usename" name="txt_usename" type="email" aria-describedby="emailHelp"  placeholder="Email" value="<?php echo $this->input->post('txt_usename'); ?>">
                      <span id="Error_usename" class="spanError"></span>
                     <!--  <div class="form-text" id="emailHelp">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="exampleInputPassword1">Password</label>
                      <input class="form-control" id="txt_password" name="txt_password" type="password" value="<?php echo $this->input->post('txt_password'); ?>">
                      <span id="Error_password" class="spanError"></span>
                    </div>
                    <button class="btn btn-primary" id="btn_loginUser" name="btn_loginUser">Sign In
                      </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="position-absolute bottom-0 bg-dash-dark-2 text-white text-center py-3 w-100 text-xs" id="footer">
          <div class="container-fluid text-center">
            <p class="mb-0 text-dash-gray">2021 &copy; GTM The League Season.</p>
          </div>
        </footer>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/just-validate/js/just-validate.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="js/charts-home.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
    <script src="<?=$this->config->base_url()?>asset/vendor/bootstrap/js/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  
  //function ValidateLogin()
  $("#btn_loginUser").click(function()
  {
    var txt_usename        = $("#txt_usename").val();
    var txt_password        = $("#txt_password").val();

    $(".spanError").html("");
    $(".form-control").removeClass( "Errorborderclass" );

    if(txt_usename == '')
    {
      
      $("#Error_usename").html("Please enter email");
      $("#txt_usename").addClass( "Errorborderclass" );
      $("#txt_usename").focus();
      
      return false;
    }
    
    if(txt_password == '')
    {
      
      $("#Error_password").html("Please enter password");
      $("#txt_password").addClass( "Errorborderclass" );
      $("#txt_password").focus();
      return false;
    }
    else
    {
      $("#form_login").submit();
    }
    
  });
</script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>