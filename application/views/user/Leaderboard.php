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
    <link rel="stylesheet" type="text/css" href="<?=$this->config->base_url()?>asset/css/DataTables/datatables.min.css"/>
 

    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
  <!-- Heder here  -->
  	<?php
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
                <h2 class="h5 mb-0">Leader board</h2>
              </div>
            </div>
             <div class="container-fluid py-2">
             <!--  <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 py-3 px-0">
                  <li class="breadcrumb-item"><a href="<?=$this->config->base_url()?>Leaderboard">Leader board</a></li>
                </ol>
              </nav> -->
            </div>
            <section class=" py-0">
              <div class="container-fluid">
                <div class="row table-responsive gy-4">
                  
                    <table id="TableData" class="table mb-0 table-striped table-responsive table-bordered">
                        <thead>
                          <tr style="font-size: 12px;">
                            <th>#</th>
                            <th>rosterid</th>
                            <th>Name</th>
                            <th>Division</th>
                            <th>Average point</th>
                            <th>Wins</th>
                            <th>Losses</th>
                            <th>Games Played</th>
                            <th>Points</th>
                            <th>GT per AVG</th>
                            <th>Opponent GT per AVG</th>
                            <th>Games Remaining</th>
                            <th>Most Possible Points</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $RecordNo = 0;
                          foreach($Leaderboards as $Leaderboard)
                          {
                            $RecordNo++;
                          ?>
                              <th scope="row"><?=$RecordNo ?></th>
                              <td><?=$Leaderboard['rosterid'] ?></td>
                              <td><?=$Leaderboard['playername'] ?></td>
                              <td><?=$Leaderboard['divisionname'] ?></td>
                              <td><?=$Leaderboard['avgpoints'] ?></td>
                              <td><?=$Leaderboard['wins'] ?></td>
                              <td><?=$Leaderboard['losses'] ?></td>
                              <td><?=$Leaderboard['gamesplayed'] ?></td>
                              <td><?=$Leaderboard['points'] ?></td>
                              <td><?=$Leaderboard['avgscore'] ?></td>
                              <td><?=$Leaderboard['opponentavgscore'] ?></td>
                              <td><?=$Leaderboard['gamesremaining'] ?></td>
                              <td><?=$Leaderboard['potentialpoints'] ?></td>
                            </tr>
                          <?php
                          }
                          ?>
                      </tbody>
                    </table>
                </div>
              </div>
            </section>
        
        
        <!-- Page Footer-->
        <?php $this->load->view('includes/footer'); ?>
      </div>
    </div>
    <!-- JavaScript files-->
    
    <script>
      $(document).ready( function () {
          $('#TableData').DataTable();
      } );
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
    <script type="text/javascript" src="<?=$this->config->base_url()?>asset/js/DataTables/datatables.min.js"></script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>