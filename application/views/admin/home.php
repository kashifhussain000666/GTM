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
  </head>
  <body>
    <header class="header">   
      <nav class="navbar navbar-expand-lg py-3 bg-dash-dark-2 border-bottom border-dash-dark-1 z-index-10">
        <div class="search-panel">
          <div class="search-inner d-flex align-items-center justify-content-center">
            <div class="close-btn d-flex align-items-center position-absolute top-0 end-0 me-4 mt-2 cursor-pointer"><span>Close </span>
                  <svg class="svg-icon svg-icon-md svg-icon-heavy text-gray-700 mt-1">
                    <use xlink:href="#close-1"> </use>
                  </svg>
            </div>
            <div class="row w-100">
              <div class="col-lg-8 mx-auto">
                <form class="px-4" id="searchForm" action="#">
                  <div class="input-group position-relative flex-column flex-lg-row flex-nowrap">
                    <input class="form-control shadow-0 bg-none px-0 w-100" type="search" name="search" placeholder="What are you searching for...">
                    <button class="btn btn-link text-gray-600 px-0 text-decoration-none fw-bold cursor-pointer text-center" type="submit">Search</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between py-1">
          <div class="navbar-header d-flex align-items-center"><a class="navbar-brand text-uppercase text-reset" href="index.html">
              <div class="brand-text brand-big"><strong class="text-primary">GTM</strong><strong> The League</strong></div>
              <div class="brand-text brand-sm"><strong class="text-primary">GTM</strong><strong></strong></div></a>
            <button class="sidebar-toggle">
                  <svg class="svg-icon svg-icon-sm svg-icon-heavy transform-none">
                    <use xlink:href="#arrow-left-1"> </use>
                  </svg>
            </button>
          </div>
          <ul class="list-inline mb-0">
            <li class="list-inline-item logout px-lg-2">                 <a class="nav-link text-sm text-reset px-1 px-lg-0" id="logout" href="<?php echo base_url().'admin/signout';?>"> <span class="d-none d-sm-inline-block">Logout </span>
                    <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                      <use xlink:href="#disable-1"> </use>
                    </svg></a></li>
          </ul>
        </div>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center p-4"><img class="avatar shadow-0 img-fluid rounded-circle" src="<?=$this->config->base_url()?>asset/img/avatar.jpg" alt="...">
          <div class="ms-3 title">
            <h1 class="h5 mb-1">Admin</h1>
            <p class="text-sm text-gray-700 mb-0 lh-1"></p>
          </div>
        </div><span class="text-uppercase text-gray-600 text-xs mx-3 px-2 heading mb-2">Main</span>
        <ul class="list-unstyled">
              <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url().'admin/Home'?>"> 
                      <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                        <use xlink:href="#real-estate-1"> </use>
                      </svg><span>Home </span></a></li>
        </ul>
      </nav>
      <div class="page-content form-page">
            <!-- Page Header-->
            <div class="bg-dash-dark-2 py-4">
              <div class="container-fluid">
                <h2 class="h5 mb-0">Tables</h2>
              </div>
            </div>
            <!-- Breadcrumb-->
            <div class="container-fluid py-2">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 py-3 px-0">
                  <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tables</li>
                </ol>
              </nav>
            </div>
        <section class="tables py-0">
          <div class="container-fluid">
            <div class="row gy-4">
              
              <div class="col-lg-12">
                <div class="card mb-0">
                  <div class="card-header">
                    <h3 class="h4 mb-0">All Users</h3>
                  </div>
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                      <table class="table mb-0 table-striped table-sm">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>playerid</th>
                            <th>Nickname</th>
                            <th>First</th>
                            <th>Last</th>
                            <th>email</th>
                            <th>Payment</th>
                            <th>state</th>
                            <th>country</th>
                            <th>city</th>
                            <th>discordid</th>
                            <th>Amount Owed</th>
                            <th>Action</th>
                            <tr>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $RecordNo = 0;
                          foreach($users as $user)
                          {
                            $RecordNo++;
                            /*
                            `id`
`playerid`
`firstname`
`lastname`
`email`
`paymentproviderid`
`paymentusername`
`state`
`country`
`city`
`updated_at`
`created_at`
`discordid`
                            */

                          ?>
                              <th scope="row"><?=$RecordNo ?></th>
                              <td><?=$user['playerid'] ?></td>
                              <td><?=$user['nickname'] ?></td>
                              <td><?=$user['firstname'] ?></td>
                              <td><?=$user['lastname'] ?></td>
                              <td><?=$user['email'] ?></td>
                              <td><?=$user['payment'] ?></td>
                              <td><?=$user['statename'] ?></td>
                              <td><?=$user['countryname'] ?></td>
                              <td><?=$user['city'] ?></td>
                              <td><?=$user['discordid'] ?></td>
                              <td><?=$user['amountowed'] ?></td>
                              <td><a href="<?php echo base_url().'admin/updateuser/'.$user['id'];?>" target="_blank">Update</a></td>
                            </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Page Footer-->
        <footer class="position-absolute bottom-0 bg-dash-dark-2 text-white text-center py-3 w-100 text-xs" id="footer">
          <div class="container-fluid text-center">
            <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
            <p class="mb-0 text-dash-gray">2021 &copy; </p>
          </div>
        </footer>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="<?=$this->config->base_url()?>asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=$this->config->base_url()?>asset/vendor/just-validate/js/just-validate.min.js"></script>
    <script src="<?=$this->config->base_url()?>asset/vendor/chart.js/Chart.min.js"></script>
    <script src="<?=$this->config->base_url()?>asset/vendor/choices.js/public/assets/scripts/choices.min.js"></script>
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
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>