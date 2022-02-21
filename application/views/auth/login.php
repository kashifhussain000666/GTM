<!DOCTYPE html>
<html>
  <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dark Admin by Bootstrapious.com</title>
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

                  <form class="login-form  w-100" method="get" action="index.html">
                    <div class="login-div">
                      <h2 class="color-white">Login to Account</h2>
                    </div>
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
                    <button class="btn btn-primary mb-3" id="login" type="submit">Login</button>
                    <br><small class="text-gray-500">Do not have an account? </small>
                    <a class="text-sm text-paleBlue" href="<?=$this->config->base_url()?>user/signup">Signup</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="login-footer text-center position-absolute bottom-0 start-0 w-100">
        <p class="text-white">Design by <a class="external" href="https://bootstrapious.com/p/admin-template">Bootstrapious</a>
          <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
        </p>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/just-validate/js/just-validate.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="js/charts-home.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
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
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>