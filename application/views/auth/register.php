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
  </head>
  <body>
  <!-- Heder here  -->
    
     <div class="login-page">
      <div class="container d-flex align-items-center position-relative py-5">
        <div class="card shadow-sm w-100 rounded overflow-hidden bg-none">
          <div class="card-body p-0">
            <div class="row gx-0 align-items-stretch">
              <!-- Logo & Information Panel-->
              <div class="col-lg-5">
                <div class="info d-flex justify-content-center flex-column p-4 h-100 logo-div-back">
                  <div class="">
                    <img src="<?=$this->config->base_url()?>asset/img/GTM.png" class="img-fluid">
                  </div>
                </div>
              </div>
              <!-- Form Panel    -->
              <div class="col-lg-7 colo">

                <div class=" align-items-center px-4 px-lg-5 h-100 bg-dash-dark-2">

                  <form class="login-form  w-100" method="post" action="<?=$this->config->base_url()?>signup">
                    <div class="login-div row">
                      <h2 class="color-white">Your Account</h2>
                    </div>
                    <?php if(trim($error) != ''){ ?>
                    <div class="row alert alert-danger"><?=$error?></div>
                    <?php 
                    } ?>
                    <!-- <div>Login</div> -->
                    <div class="row mt-3">
                      <div class="col-md-6 ">
                        <label class="form-label  mb-0" for="txt_playerid">Golden Tee PlayerID *</label>
                        <input class="form-control" id="txt_playerid" name="txt_playerid" type="text"  maxlength="10"  placeholder="PlayerID" value="<?=$this->input->post('txt_playerid')?>">
                        <span id="Error_playerid" class="spanError"></span>
                     <!--  <div class="form-text" id="emailHelp">We'll never share your email with anyone else.</div> -->
                      </div>
                      <div class=" col-md-6 ">
                        <label class="form-label  mb-0" for="txt_Email">Email address *</label>
                        <input class="form-control" id="txt_Email" name="txt_Email" type="email" value="<?=$this->input->post('txt_Email')?>">
                        <span id="Error_email" class="spanError"></span>
                      </div>
                    </div>
                    <div class="row ">
                      <div class="col-md-6  ">
                        <label class="form-label  mb-0" for="txt_fname">First Name *</label>
                        <input class="form-control" id="txt_fname" name="txt_fname" type="text" aria-describedby="emailHelp"  placeholder="" value="<?=$this->input->post('txt_fname')?>">
                        <span id="Error_fusename" class="spanError"></span>
                     <!--  <div class="form-text" id="emailHelp">We'll never share your email with anyone else.</div> -->
                      </div>
                      <div class=" col-md-6 ">
                        <label class="form-label  mb-0" for="txt_lname">Last Name *</label>
                        <input class="form-control" id="txt_lname" name="txt_lname" type="text" value="<?=$this->input->post('txt_lname')?>">
                        <span id="Error_lname" class="spanError"></span>
                      </div>
                    </div>
                    <div class="row ">
                      <div class="col-md-6  ">
                        <label class="form-label  mb-0" for="sel_payment_platform">Preffered Payment Platform *</label>
                        <select class="form-select" id="sel_payment_platform" name="sel_payment_platform" aria-label="Default select example">
                          <option value="0">Select Payment Platform</option>
                           <?php 
                          foreach($PaymentProviders as $PaymentProvider)
                          {
                          ?>
                            <option value="<?=$PaymentProvider['id'] ?>" <?php if($this->input->post('sel_payment_platform') == $PaymentProvider['id']){ echo "selected" ;} ?>><?php echo $PaymentProvider['name']; ?></option>
                          <?php 
                          }
                          ?>
                        </select>
                        <span id="Error_payment_platform" class="spanError"></span>
                     <!--  <div class="form-text" id="emailHelp">We'll never share your email with anyone else.</div> -->
                      </div>
                      <div class=" col-md-6">
                        <label class="form-label  mb-0" for="txt_payment_username">Payment Platform Username *</label>
                        <input class="form-control" id="txt_payment_username" name="txt_payment_username" type="text" value="<?=$this->input->post('txt_payment_username')?>">
                        <span id="Error_payment_username" class="spanError"></span>
                      </div>
                    </div>
                    <div class="row ">
                      <div class="col-md-6  ">
                        <label class="form-label  mb-0" for="sel_country">Conutry *</label>
                        <select class="form-select" id="sel_country" name="sel_country" aria-label="Default select example">
                          <option value="0">Select Country</option>
                          <?php 
                          foreach($Countries as $Country)
                          {
                          ?>
                            <option value="<?=$Country['id'] ?>" <?php if($this->input->post('sel_country') == $Country['id']){ echo "selected" ;} ?>><?php echo $Country['name']; ?></option>
                          <?php 
                          }?>
                        </select>
                        <span id="Error_country" class="spanError"></span>
                     <!--  <div class="form-text" id="emailHelp">We'll never share your email with anyone else.</div> -->
                      </div>
                      <div class=" col-md-6 ">
                        <label class="form-label  mb-0" for="sel_state">State *</label>
                        <select class="form-select" id="sel_state" name="sel_state" aria-label="Default select example">
                          <option value="0">Select State</option>
                          <?php 
                          foreach($States as $State)
                          {
                          ?>
                            <option value="<?=$State['id'] ?>" <?php if($this->input->post('sel_state') == $State['id']){ echo "selected" ;} ?>><?php echo $State['name']; ?></option>
                          <?php 
                          }
                          ?>
                        </select>
                        <span id="Error_state" class="spanError"></span>
                      </div>
                    </div>
                    <div class="row ">
                      <div class="col  ">
                        <label class="form-label  mb-0" for="txt_city">City</label>
                        <input class="form-control" id="txt_city" name="txt_city" type="text" aria-describedby="emailHelp"  placeholder="" value="<?=$this->input->post('txt_city')?>">
                        <span id="Error_city" class="spanError"></span>
                     <!--  <div class="form-text" id="emailHelp">We'll never share your email with anyone else.</div> -->
                      </div>
                    </div>
                    <div class="row ">
                      <div class="col-md-6  ">
                        <label class="form-label  mb-0" for="txt_password">Password *</label>
                        <input class="form-control" id="txt_password" name="txt_password" type="password" aria-describedby="emailHelp"  placeholder="" value="">
                        <span id="Error_password" class="spanError"></span>
                     <!--  <div class="form-text" id="emailHelp">We'll never share your email with anyone else.</div> -->
                      </div>
                      <div class=" col-md-6 ">
                        <label class="form-label  mb-0" for="txt_cpassword">Confirm Password *</label>
                        <input class="form-control" id="txt_cpassword" name="txt_cpassword" type="password" value="">
                        <span id="Error_cpassword" class="spanError"></span>
                      </div>
                    </div>
                    

                    
                    <button class="btn btn-primary mb-3" id="signup" name="signup" type="submit">Create Account</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="login-footer text-center position-absolute bottom-0 start-0 w-100">
        <p class="mb-0 text-dash-gray">2021 &copy; GTM The League Season.</p>
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
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>