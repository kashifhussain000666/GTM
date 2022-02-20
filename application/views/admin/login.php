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
  <!-- Heder here  -->
  	
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      
      <div class="page-content">
        
            <!-- Page Header-->
           <div class="container-fluid">
            <div class="col-lg-6" style=" margin: 50px auto auto auto;">
              <div class="card">
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
                <div class="card-header">
                  <h3 class="h4 mb-0">Login</h3>

                </div>
                <div class="card-body pt-0">
                  
                  <form action="" method="post" id="form_login">
                    <div class="mb-3">
                      <label class="form-label" for="exampleInputEmail1">Email address</label>
                      <input class="form-control" id="txt_usename" name="txt_usename" type="email" aria-describedby="emailHelp"  placeholder="Email" value="<?php echo $this->input->post('txt_usename'); ?>">
                      <span id="Error_usename" class="spanError"></span>
                      <div class="form-text" id="emailHelp">We'll never share your email with anyone else.</div>
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
        <!-- Page Footer-->
        <?php
        $this->load->view('includes/footer');
        ?>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="<?=$this->config->base_url()?>asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=$this->config->base_url()?>asset/vendor/just-validate/js/just-validate.min.js"></script>
    <script src="<?=$this->config->base_url()?>asset/vendor/chart.js/Chart.min.js"></script>
    <script src="<?=$this->config->base_url()?>asset/vendor/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="<?=$this->config->base_url()?>asset/js/charts-home.js"></script>
    <!-- Main File-->
    <script src="<?=$this->config->base_url()?>asset/js/front.js"></script>
    <script>
      // ------------------------------------------------------- //
      //   Inject SVG Sprite - 
      //   see more here 
      //   https://css-tricks.com/ajaxing-svg-sprite/
      // ------------------------------------------------------ //
      function injectSvgSprite(path) {
      
          var ajax = new XMLHttpRequest();
          ajax.open("GET", path, true);
          ajax.send();
          ajax.onload = function(e) {
          var div = document.createElement("div");
          div.className = 'd-none';
          div.innerHTML = ajax.responseText;
          document.body.insertBefore(div, document.body.childNodes[0]);
          }
      }
      // this is set to BootstrapTemple website as you cannot 
      // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
      // while using file:// protocol
      // pls don't forget to change to your domain :)
      injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg'); 
      
      
    </script>

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
      return false;
    }
    
    if(txt_password == '')
    {
      
      $("#Error_password").html("Please enter password");
      $("#txt_password").addClass( "Errorborderclass" );
      return false;
    }
   
    else
    {
      
    }
    $("#form_login").submit();
  });
</script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>