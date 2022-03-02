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
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
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
            <h2 class="h5 mb-0">Dashboard</h2>
          </div>
        </div>
        <div style="border:1px solid;">
          <div id="scatterChart" style="width:35%;display: inline-block;"></div>
          <div id="barChart" style="width:35%;display: inline-block;"></div>
          <div id="pieChart" style="width:25%;display: inline-block;"></div>
        </div>

        <script>
        // Bar Chart start here
        var xArray = ["TP", "VP", "PC", "DV", "RB","CS","CH","HM","JF","TG","RH","DC","AR","ER"];

        var data = [
          {
            x: xArray,
            y: [5, 4, 4, -2, 1,5, 4, 4, -1, 5,5, 9, 4, -2],
            type:"bar",
            name: "Worst Score",
            marker: {
              color: 'white'
            }
          }
          ,{
            x: xArray,
            y: [55, 49, 44, -2, 15,55, 49, 44, -1, 15,55, 49, 44, -2],
            type: "bar",
            name: "Best Score",
            marker: {
              color: 'yellow'
            }
          }
        ];
        const config = {
          displayModeBar: false, // this is the line that hides the bar.
        };
        var layout = {
          title:"Course Comparison",
          plot_bgcolor:"#22252a",
          paper_bgcolor:"#22252a",
          font: {
            color: '#fff'
          },
          // height : '100px'
          // width: 500,
          // height: 300,
        };
        Plotly.newPlot("barChart", data, layout,config);

        // Pie chart Start Here
        var xArray = ["TP", "VP", "PC", "DV", "RB","CS","CH","HM","JF","TG","RH","DC","AR","ER"];
        var yArray = [55, 49, 44, -2, 15,55, 49, 44, -1, 15,55, 49, 44, -2];
        var data = [{
          labels: xArray,
          values: yArray,
          type: "pie"
        }];
        var layout = {
          title:"Course Selection",
          plot_bgcolor:"#22252a",
          paper_bgcolor:"#22252a",
          font: {
            color: '#fff'
          }
        };
        Plotly.newPlot("pieChart", data, layout,config);

        // Scatter Chart
        var xArray = [2,1.5,0,3,90,100,110,120,130,140,150];
        var yArray = [1,0.2,1,2,9,9,10,11,14,14,15];
        // Define Data
        var data = [{
          x: xArray,
          y: yArray,
          mode:"markers",
          type:"scatter",
          marker: { size: 14 }
        }];
        var layout = {
          xaxis: {range: [0, 3], title: "Front 9 GT Par"},
          yaxis: {range: [-2, 6], title: "Back 9 GT Par"},
          title: "Course Averages",
          plot_bgcolor:"#22252a",
          paper_bgcolor:"#22252a",
          font: {
            color: '#fff'
          }
        };
        Plotly.newPlot("scatterChart", data, layout,config);
        </script>
     
        
        
        <!-- Page Footer-->
        <?php $this->load->view('includes/footer'); ?>
      </div>
    </div>
    <!-- JavaScript files-->
    
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