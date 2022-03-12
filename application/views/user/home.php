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
    <link rel="stylesheet" type="text/css" href="<?=$this->config->base_url()?>asset/css/DataTables/datatables.min.css"/>
 
  </head>
  <body>
  <!-- Heder here  -->
  	<?php
  		$this->load->view('includes/header');
      $controllObj =& get_instance();
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
          <div id="scatterChart" style="width:40%;display: inline-block;"></div>
          <div id="barChart" style="width:40%;display: inline-block;"></div>
          <div id="pieChart" style="width:18%;display: inline-block;"></div>
        </div>
        <div class="row">
         <!--  <div class="col-md-3">
            <section class=" pt-2 ">
              <div class="row table-responsive">
                  <div class="col-md-12"><hr>
                  </div>
              </div>
               <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-check  ">
                           <label class="form-check-label" for="chk_division_0"><b>Filter By User</b></label>
                        </div>
                        <div class="form-check"> 
                         <input type="text" value="" class="form-control" name="user_name" id="user_name" onkeyup="CheckAllDivision(this)"> 
                      </div>
                    </div>
                  </div>
                </div>
              </div><br><br>
              <div class="row ">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-check  ">
                            <input class="devision_chk_box" onclick="CheckAllDivision(this)" divisionID='0'  value='0' class="form-check-input" id="chk_division_0" type="checkbox" >
                            <label class="form-check-label" for="chk_division_0"><h4>Divisions</h4></label>
                        </div>
                        <div class="home-division-filter-div"> 
                         
                          
                        <?php
                        foreach($divisionlist as $division)
                        {
                        ?>
                        <div class="form-check  mt-2">
                         
                            <input class="devision_chk_box" onclick="GetDevisionFilterResult(this)" divisionID='<?=$division['id']?>'  value='<?=$division['id']?>' class="form-check-input" id="chk_division_<?=$division['id']?>" type="checkbox" >
                            <label class="form-check-label" for="chk_division_<?=$division['id']?>"><?=$division['divisionname']?></label>
                          
                        </div>
                        <?php 
                        } ?> 
                      </div>
                    </div>
                  </div>
                </div>
              </div><br><br>
               <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-check  ">
                            <input class="event_chk_box" onclick="CheckAllEvent(this)" divisionID='0'  value='0' class="form-check-input" id="chk_event_0" type="checkbox" >
                            <label class="form-check-label" for="chk_division_0"><h4>All Events</h4></label>
                          </div>
                        <div class="home-division-filter-div"> 
                          
                          
                        <?php
                        foreach($eventdetails as $event)
                        {
                        ?>
                        <div class="form-check  mt-2">
                         
                            <input class="event_chk_box" onclick="GetEventResult(this)" divisionID='<?=$event['id']?>'  value='<?=$event['id']?>' class="form-check-input" id="chk_event_<?=$event['id']?>" type="checkbox" >
                            <label class="form-check-label" for="chk_event_<?=$event['id']?>"><?=$event['eventname']?></label>
                          
                        </div>
                        <?php 
                        } ?> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div> -->
          <div class="col-md-12 p-5">
            <section class=" pt-2 ">
                <div class="row table-responsive">
                  <div class="col-md-12"><hr>
                  </div>
                </div>
                <div class="container-fluid p-0">
                  <div class="row ">
                    <div class="col-lg-12">
                      <h3>Best 5 Matches</h3>
                    </div>
                  </div>
                 <!--  <div class="row ">
                    <div class="col-md-12">
                       <b>Filters: </b>
                      <?php
                      foreach($divisionlist as $division)
                      {
                      ?>
                      <div class="form-check d-inline-block m-2">
                       
                          <input class="devision_chk_box" onchange="GetDevisionResult(this)" divisionID='<?=$division['id']?>'  value='<?=$division['id']?>' class="form-check-input" id="chk_division_<?=$division['id']?>" type="checkbox" >
                          <label class="form-check-label" for="chk_division_<?=$division['id']?>"><?=$division['divisionname']?></label>
                        
                      </div>
                      <?php 
                      } ?> 
                    </div>
                  </div> -->
                  <div class="row DivisionDataTableBorder" style="padding-top: 11px;" >
                   
                    <div class="col-md-12">
                      <table id="TableDataBestMatches" class="table mb-0 table-striped table-responsive table-bordered">
                          <thead>
                            <tr style="font-size: 12px;">
                              <th>#</th>
                              <th>Name</th>
                              <th>Opponent</th>
                              <th>Cours</th>
                              <th>F9 GTPar</th>
                              <th>B9 GTPar</th>
                              <th>GSP</th>
                              <th>Holeouts</th>
                              
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                            echo $controllObj->Get5BestMatchesGrid($Get5BestMatches, $isAjax='0');
                          
                            ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </section>

                      <section class=" pt-2 ">
                <div class="row table-responsive">
                  <div class="col-md-12"><hr>
                  </div>
                </div>
                <div class="container-fluid p-0">
                  <div class="row ">
                    <div class="col-lg-12">
                      <h3>Best 5 Matches Average</h3>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="col-md-12">
                     <!--  <b>Filters: </b> -->
                     <!--  <?php
                      foreach($divisionlist as $division)
                      {
                      ?>
                      <div class="form-check d-inline-block m-2">
                       
                          <input class="devision_chk_box" onchange="GetDevisionResult(this)" divisionID='<?=$division['id']?>'  value='<?=$division['id']?>' class="form-check-input" id="chk_division_<?=$division['id']?>" type="checkbox" >
                          <label class="form-check-label" for="chk_division_<?=$division['id']?>"><?=$division['divisionname']?></label>
                        
                      </div>
                      <?php 
                      } ?> -->
                    </div>
                  </div>
                  <div class="row DivisionDataTableBorder" style="padding-top: 11px;" >
                    
                    <div class="col-md-12">
                      <table id="TableDataBestMatchesAverage" class="table mb-0 table-striped table-responsive table-bordered">
                          <thead>
                            <tr style="font-size: 12px;">
                              <th>#</th>
                              <th>Event Name</th>
                              <th>18 GT Par</th>
                              <th>18 GSP</th>
                              <th>18 Holeouts</th>
                              <th>backgtpar</th>
                              <th>frontgtpar</th>
                              <th>Differential</th>
                              
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                            echo $controllObj->Get5BestMatchesAverageGrid($Get5BestMatchesAverage, $isAjax='0');
                          
                            ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </section>
          </div>
        </div>

        <script>
        // Bar Chart start here
       /* var ChartData_CourceComparison = <?=json_encode($ChartData_CourceComparison)?>;
        var xArray = [];
        var yArrayBest = [];
        var yArrayWorst = [];
        for( let i = 0; i < ChartData_CourceComparison.length; i++ ){
          xArray.push( ChartData_CourceComparison[i]['course'] );
          yArrayBest.push( ChartData_CourceComparison[i]['maxscore'] );
          yArrayWorst.push( ChartData_CourceComparison[i]['minscore'] );
        }
        var data = [
          {
            x: xArray,
            y: yArrayWorst,
            type:"bar",
            name: "Worst Score",
            marker: {
              color: 'white'
            }
          }
          ,{
            x: xArray,
            y: yArrayBest,
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
          }
        };
        Plotly.newPlot("barChart", data, layout,config);*/

        // Pie chart Start Here
        /*var xArray = ["TP", "VP", "PC", "DV", "RB","CS","CH","HM","JF","TG","RH","DC","AR","ER"];
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
        Plotly.newPlot("pieChart", data, layout,config);*/

        // Scatter Chart
       /* var ChartData_CourceAverage = <?=json_encode($ChartData_CourceAverage)?>;
        data = [];
        for(let i = 0;i<ChartData_CourceAverage.length; i++ ){
          let x = {
            x: [ChartData_CourceAverage[i]['avg_frontgtpar']],
            y: [ChartData_CourceAverage[i]['avg_backgtpar']],
            name: ChartData_CourceAverage[i]['course'],
            text: ChartData_CourceAverage[i]['course'],
            mode:"markers",
            type:"scatter",
            marker: { size: 14 }
          };
          data.push(x);
        }
        var layout = {
          xaxis: {range: [0, 3], title: "Front 9 GT Par"},
          yaxis: {range: [0, 6], title: "Back 9 GT Par"},
          title: "Course Averages",
          plot_bgcolor:"#22252a",
          paper_bgcolor:"#22252a",
          font: {
            color: '#fff'
          }
        };
        Plotly.newPlot("scatterChart", data, layout,config);*/
        </script>
     
        
        
        <!-- Page Footer-->
        <?php $this->load->view('includes/footer'); ?>
      </div>
    </div>
    <div id="loader" class="">
    </div>
    <!-- JavaScript files-->
    
    <script>
       $(document).ready( function () {
          $('#TableDataBestMatches').DataTable();
          $('#TableDataBestMatchesAverage').DataTable();
          
          ChartData_CourceAverage = <?=json_encode($ChartData_CourceAverage)?>;
          Chart_CourceAverage(ChartData_CourceAverage);

          Chart_CourseSelection();

          ChartData_CourceComparison = <?=json_encode($ChartData_CourceComparison)?>;
          Chart_CourseComparison(ChartData_CourceComparison);
      
         
      } );
      

      function Chart_CourceAverage(chart_data)
      {
       
        //var ChartData_CourceAverage = <?=json_encode($ChartData_CourceAverage)?>;
        data = [];
        for(let i = 0;i<chart_data.length; i++ ){
          let x = {
            x: [chart_data[i]['avg_frontgtpar']],
            y: [chart_data[i]['avg_backgtpar']],
            name: chart_data[i]['course'],
            text: chart_data[i]['course'],
            mode:"markers",
            type:"scatter",
            marker: { size: 14 }
          };
          data.push(x);
        }
        const config = {
          displayModeBar: false, // this is the line that hides the bar.
        };
        var layout = {
          xaxis: {range: [0, 3], title: "Front 9 GT Par"},
          yaxis: {range: [0, 6], title: "Back 9 GT Par"},
          title: "Course Averages",
          plot_bgcolor:"#22252a",
          paper_bgcolor:"#22252a",
          font: {
            color: '#fff'
          }
        };
        Plotly.newPlot("scatterChart", data, layout,config);
      }


      function Chart_CourseSelection()
      {
        var xArray = ["TP", "VP", "PC", "DV", "RB","CS","CH","HM","JF","TG","RH","DC","AR","ER"];
        var yArray = [55, 49, 44, -2, 15,55, 49, 44, -1, 15,55, 49, 44, -2];
        var data = [{
          labels: xArray,
          values: yArray,
          type: "pie"
        }];
        const config = {
          displayModeBar: false, // this is the line that hides the bar.
        };
        var layout = {
          title:"Course Selection",
          plot_bgcolor:"#22252a",
          paper_bgcolor:"#22252a",
          font: {
            color: '#fff'
          }
        };
        Plotly.newPlot("pieChart", data, layout,config);
      }

      function Chart_CourseComparison(chart_data)
      {
        // Bar Chart start here
        //var ChartData_CourceComparison = <?=json_encode($ChartData_CourceComparison)?>;
        var xArray = [];
        var yArrayBest = [];
        var yArrayWorst = [];
        for( let i = 0; i < chart_data.length; i++ ){
          xArray.push( chart_data[i]['course'] );
          yArrayBest.push( chart_data[i]['maxscore'] );
          yArrayWorst.push( chart_data[i]['minscore'] );
        }
        var data = [
          {
            x: xArray,
            y: yArrayWorst,
            type:"bar",
            name: "Worst Score",
            marker: {
              color: 'white'
            }
          }
          ,{
            x: xArray,
            y: yArrayBest,
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
          }
        };
        Plotly.newPlot("barChart", data, layout,config);
      }
       
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
      

      function GetDevisionResult(obj='')
      {
        
        BaseUrl = '<?=$this->config->base_url()?>';
        user_name = $('#user_name').val();
        divisionID = $(obj).attr("divisionID");
        var checkedVals = $('.devision_chk_box:checkbox:checked').map(function() {
              return this.value;
          }).get();
        divisionID = checkedVals.join(",");

        var eventCheckedVals = $('.event_chk_box:checkbox:checked').map(function() {
              return this.value;
          }).get();
        eventID = eventCheckedVals.join(",");
        $('#loader').addClass('loader');
        $.ajax({
          url: BaseUrl+'ControllerUser/GetStateResultOnAjax',
          type: 'post',
          data :{
            divisionID : divisionID,
            eventID    : eventID,
            user_name  : user_name
          },
          success:function(response){
            
            res = JSON.parse(response);
            Get5BestMatchesGrid        = $.trim(res['Get5BestMatchesGrid']);
            Get5BestMatchesAverageGrid = $.trim(res['Get5BestMatchesAverageGrid']);
            ChartData_CourceAverage    = res['ChartData_CourceAverage'];
            ChartData_CourceComparison = res['ChartData_CourceComparison'];
            //d = ChartData_CourceAverage[0]['avg_backgtpar'];

            Chart_CourceAverage(ChartData_CourceAverage);
            Chart_CourseComparison(ChartData_CourceComparison);
            


            if($.trim(Get5BestMatchesGrid) !='')
            {

              $("#TableDataBestMatches > tbody").html("");
              $('#TableDataBestMatches').DataTable().clear().destroy();;
              
              if(Get5BestMatchesGrid != '0')
              $("#TableDataBestMatches > tbody").append(Get5BestMatchesGrid);
             
              $('#TableDataBestMatches').DataTable();
              $("#TableDataBestMatches_length select").trigger('change');
            }
            if($.trim(Get5BestMatchesAverageGrid) !='')
            {
              $("#TableDataBestMatchesAverage > tbody").html("");
              $('#TableDataBestMatchesAverage').DataTable().clear().destroy();
              //table2.clear().draw();
              if(Get5BestMatchesAverageGrid != '0')
              $("#TableDataBestMatchesAverage > tbody").append(Get5BestMatchesAverageGrid);
              $('#TableDataBestMatchesAverage').DataTable();

              $("#TableDataBestMatchesAverage_length select").trigger('change');
            }

            $('#loader').removeClass('loader');
            
          }
        });
        
      }

      function CheckAllDivision(obj)
      { 
        if($('#chk_division_0').is(':checked'))
        {
          $('.devision_chk_box').attr('checked', true);
        } 
        else
        {
          $('.devision_chk_box').attr('checked', false);
        }
        $('.devision_chk_box').trigger('change');
        // divisionID = $(obj).(":checked");
        GetDevisionResult(obj='', isall=1);
         
      }


      function CheckAllEvent(obj='')
      {

        if($('#chk_event_0').is(':checked'))
        {
          $('.event_chk_box').attr('checked', true);
        } 
        else
        {
          $('.event_chk_box').attr('checked', false);
        }
        //$('.event_chk_box').trigger('change');
        // divisionID = $(obj).(":checked");
       GetDevisionResult(obj='');
      }

      function GetEventResult(obj='')
      {

        $('#chk_event_0').prop('checked', false);
        GetDevisionResult(obj='');
      }

      function GetDevisionFilterResult(obj='')
      {
        $('#chk_division_0').prop('checked', false);
        GetDevisionResult(obj='');
      }

      
    </script>
    <script type="text/javascript" src="<?=$this->config->base_url()?>asset/js/DataTables/datatables.min.js"></script>
    
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>