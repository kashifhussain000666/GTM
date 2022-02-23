
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
  	<?php
  		foreach($user_data as $user_info)
        {
          $txt_PlayerID         = $user_info['playerid'];
          $txt_Email            = $user_info['email'];
          $txt_FirstName        = $user_info['firstname'];
          $txt_LastName         = $user_info['lastname'];
          $sel_paymentprovider  = $user_info['paymentproviderid'];
          $txt_PaymentPlatformUserName  = $user_info['paymentusername'];
          $sel_Country         = $user_info['country'];
          $sel_State           = $user_info['state'];
          $txt_City            = $user_info['city'];
        }
  		$this->load->view('includes/header');
  	?>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      	<?php
  		$this->load->view('includes/sidebar');
  	    ?> 
      <div class="page-content">
            <!-- Page Header-->
            <div class="bg-dash-dark-2 py-4">
              <div class="container-fluid">
                <h2 class="h5 mb-0">Update Account</h2>
              </div>
            </div>
             <!-- Form Panel    -->
              <div class="col-lg-10 colo">

                <div class=" align-items-center px-4 px-lg-5 h-100">

                  <form class="login-form  w-100" method="post" action="<?=$this->config->base_url()?>user/update">
                    <div class="login-div row">
                    <!--   <h2 class="color-white">Your Account</h2> -->
                    </div>
                    <?php  //  echo $this->session->userdata('success_update');
                     if(trim($this->session->userdata('success_update') != ''))
                    { ?>
                    <div class="row alert alert-success mt-3"><?=$this->session->userdata('success_update') ?></div>
                    <?php  $this->session->set_userdata('success_update', '');
                    } ?>
                    
                    <?php if(trim($error) != ''){ ?>
                    <div class="row alert alert-danger"><?=$error?></div>
                    <?php 
                    } ?>
                    <!-- <div>Login</div> -->
                    <div class="row mt-3">
                      <div class="col-md-6 ">
                        <label class="form-label  mb-0" for="txt_playerid">Golden Tee PlayerID *</label>
                        <input class="form-control" maxlength='10' minlength='8' id="txt_playerid" name="txt_playerid" disabled type="text" aria-describedby="emailHelp"  placeholder="" value="<?=$txt_PlayerID?>">
                        <span id="Error_playerid" class="spanError"></span>
                     <!--  <div class="form-text" id="emailHelp">We'll never share your email with anyone else.</div> -->
                      </div>
                      <div class=" col-md-6 ">
                        <label class="form-label  mb-0" for="txt_Email">Email address *</label>
                        <input class="form-control" id="txt_Email" name="txt_Email" type="email" value="<?=$txt_Email?>">
                        <span id="Error_email" class="spanError"></span>
                      </div>
                    </div>
                    <div class="row ">
                      <div class="col-md-6  ">
                        <label class="form-label  mb-0" for="txt_fname">First Name *</label>
                        <input class="form-control" id="txt_fname" name="txt_fname" type="text" aria-describedby="emailHelp"  placeholder="" value="<?=$txt_FirstName?>">
                        <span id="Error_fusename" class="spanError"></span>
                     <!--  <div class="form-text" id="emailHelp">We'll never share your email with anyone else.</div> -->
                      </div>
                      <div class=" col-md-6 ">
                        <label class="form-label  mb-0" for="txt_lname">Last Name *</label>
                        <input class="form-control" id="txt_lname" name="txt_lname" type="text" value="<?=$txt_LastName?>">
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
                            <option value="<?=$PaymentProvider['id'] ?>" <?php if($sel_paymentprovider == $PaymentProvider['id']){ echo "selected" ;} ?>><?php echo $PaymentProvider['name']; ?></option>
                          <?php 
                          }
                          ?>
                        </select>
                        <span id="Error_payment_platform" class="spanError"></span>
                     <!--  <div class="form-text" id="emailHelp">We'll never share your email with anyone else.</div> -->
                      </div>
                      <div class=" col-md-6">
                        <label class="form-label  mb-0" for="txt_payment_username">Payment Platform Username *</label>
                        <input class="form-control" id="txt_payment_username" name="txt_payment_username" type="text" value="<?=$txt_PaymentPlatformUserName ?>">
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
                            <option value="<?=$Country['id'] ?>" <?php if($sel_Country  == $Country['id']){ echo "selected" ;} ?>><?php echo $Country['name']; ?></option>
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
                            <option value="<?=$State['id'] ?>" <?php if($sel_State  == $State['id']){ echo "selected" ;} ?>><?php echo $State['name']; ?></option>
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
                        <input class="form-control" id="txt_city" name="txt_city" type="text" aria-describedby="emailHelp"  placeholder="" value="<?=$txt_City?>">
                        <span id="Error_city" class="spanError"></span>
                     <!--  <div class="form-text" id="emailHelp">We'll never share your email with anyone else.</div> -->
                      </div>
                    </div>
                    <div class="row ">
                    	<div class="row mb-2">
                    		<div class="col-md-12">
                    			<input type="checkbox" name="is_change_password" id="is_change_password" value="1"> Change Password?
                   			</div>
                    	</div>
                      <div class="col-md-6  password_filed">
                        <label class="form-label  mb-0" for="txt_password">Password *</label>
                        <input class="form-control" id="txt_password" name="txt_password" type="password" aria-describedby="emailHelp"  placeholder="" value="">
                        <span id="Error_password" class="spanError"></span>
                     <!--  <div class="form-text" id="emailHelp">We'll never share your email with anyone else.</div> -->
                      </div>
                      <div class=" col-md-6 password_filed">
                        <label class="form-label  mb-0" for="txt_cpassword">Confirm Password *</label>
                        <input class="form-control" id="txt_cpassword" name="txt_cpassword" type="password" value="">
                        <span id="Error_cpassword" class="spanError"></span>
                      </div>
                    </div>
                    

                    <button class="btn btn-primary mb-3" id="updateaccount" name="updateaccount" type="submit">Update Account</button>
                    
                    </form>
                </div>
              </div>
     
        
        
        <!-- Page Footer-->
        <?php $this->load->view('includes/footer'); ?>
      </div>
    </div>
    <!-- JavaScript files-->
    
    <script>

      $("#is_change_password").change(function(){

      		if($("#is_change_password").is(":checked") == true)
      		{
      			$(".password_filed").show();
      		}
      		else
      		{
      			$(".password_filed").hide();
      		}
      });
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