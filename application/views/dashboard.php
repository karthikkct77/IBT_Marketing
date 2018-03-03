

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      <div class="col-lg-2 col-xs-6">
 
          <div class="small-box bg-green" style="background-color: #e18460 !important; ">
            <div class="inner">
              <h3><?php echo $new_call_count['COUNT(Prospect_Icode)'] ?></h3>

              <p>FRESH DATA</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
          </div>
        </div>
   
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $Cold_count['COUNT(Prospect_Icode)'] ?></h3>

              <p>COLD DATA</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
          </div>
        </div>
        <!-- ./col -->
       
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $Warm_count['COUNT(Prospect_Icode)'] ?></h3>

              <p>WARM DATA</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red" style="background-color: #f9325c  !important ">
            <div class="inner">
              <h3><?php echo $Hot_count['COUNT(Prospect_Icode)'] ?></h3>

              <p>HOT DATA</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
          </div>
        </div>
         <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red" style="background-color: #18191b  !important ">
            <div class="inner">
              <h3><?php echo $DND_count['COUNT(Prospect_Icode)'] ?></h3>

              <p>DND&CNE</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
          </div>
        </div>
         <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green"  style="background-color: #979b0e !important ">
            <div class="inner">
              <h3><?php echo $Total_count['COUNT(Prospect_Icode)'] ?></h3>

              <p>TOTAL DATA</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
          </div>
        </div>
        
        <!-- ./col -->
      </div>
     
      <div class="row">

       <?php 
                                    if($_SESSION['active'] == 'Yes')
                                    {
                                        ?>
                                         <div class="col-lg-6 col-md-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua" style="background-color: #165f0b !important">
            <div class="inner">
              
              <h4>Today's Schedule</h4>
               <div class="calls">
                <h4>Calls</h4>
               

                 <table class="table table-bordered">
                  <tr>
                    <th>Cold</th>
                    <th>Warm</th>
                  </tr>
                  <tr>
                    <td><a href="<?php echo site_url('User/Todays_Cold_Call'); ?>"><h3><?php echo $today_followup_cold['COUNT(Prospect_Icode)'] ?></h3></a></td>
                    <td><a href="<?php echo site_url('User/Today_FollowUp_Data'); ?>"><h3><?php echo $today_followup['COUNT(Prospect_Icode)'] ?></h3></a></td>
                  </tr>
                </table>
              </div>
              <div class="meeting">
                <h4>Meetings</h4>
              
                 <table class="table table-bordered">
                  <tr>
                    <th>Warm</th>
                    <th>Hot</th>
                  </tr>
                  <tr>
                    <td><a href="<?php echo site_url('User/Today_FollowUp_Data'); ?>"><h3><?php echo $Todays_Meeting_Warm['warm'] ?></h3></a></td>
                    <td><a href="<?php echo site_url('User/Today_FollowUp_Data'); ?>"><h3><?php echo $Todays_Meeting_Hot['hot'] ?></h3></a></td>
                  </tr>
                </table>

              </div>
              <div class="missed">
                <h4>Missed</h4>
                
                  <table class="table table-bordered">
                  <tr>
                    <th>Cold</th>
                    <th>Warm</th>
                    <th>Hot</th>
                  </tr>
                  <tr>
                    <td><a href="<?php echo site_url('User/Missed_call'); ?>"><h3><?php echo $Missed_call_Cold['cold'] ?></h3></a></td>
                    <td><a href="<?php echo site_url('User/Missed_call'); ?>"><h3><?php echo $Missed_call_Warm['warm'] ?></h3></a></td>
                    <td><a href="<?php echo site_url('User/Missed_call'); ?>"><h3><?php echo $Missed_call_Hot['hot'] ?></h3></a></td>
                  </tr>
                </table>

              </div>
            </div>
          
            <style type="text/css">
              .calls, .meeting, .missed{
                width: 29.5%;
                display: inline-block;
                padding: 0 15px;
              }
             
            </style>

          </div>
        </div>
         <div class="col-lg-6 col-md-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua" style="background-color: #450b01 !important;">
            <div class="inner">
              
              <h4>Today's Team Schedule</h4>
               <div class="calls">
                <h4>Calls</h4>
               

                 <table class="table table-bordered">
                  <tr>
                    <th>Cold</th>
                    <th>Warm</th>
                  </tr>
                  <tr>
                    <td><a href="<?php echo site_url('User/Today_Team_Followup'); ?>"><h3><?php echo $team_today_call_cold['COUNTS'] ?></h3></a></td>
                    <td><a href="<?php echo site_url('User/Today_Team_Followup'); ?>"><h3><?php echo $team_today_call_Warm['COUNTS'] ?></h3></a></td>
                  </tr>
                </table>
              </div>
              <div class="meeting">
                <h4>Meetings</h4>
              
                 <table class="table table-bordered">
                  <tr>
                    <th>Warm</th>
                    <th>Hot</th>
                  </tr>
                  <tr>
                    <td><a href="<?php echo site_url('User/Today_Team_Followup'); ?>"><h3><?php echo $Todays_Team_Meeting_Warm['warm'] ?></h3></a></td>
                    <td><a href="<?php echo site_url('User/Today_Team_Followup'); ?>"><h3><?php echo $Todays_Team_Meeting_Hot['hot'] ?></h3></a></td>
                  </tr>
                </table>

              </div>
              <div class="missed">
                <h4>Missed</h4>
                
                  <table class="table table-bordered">
                  <tr>
                    <th>Cold</th>
                    <th>Warm</th>
                    <th>Hot</th>
                  </tr>
                  <tr>
                    <td><a href="<?php echo site_url('User/Missed_call_Team'); ?>"><h3><?php echo $Team_Missed_call_Cold['cold'] ?></h3></a></td>
                    <td><a href="<?php echo site_url('User/Missed_call_Team'); ?>"><h3><?php echo $Team_Missed_call_Warm['warm'] ?></h3></a></td>
                    <td><a href="<?php echo site_url('User/Missed_call_Team'); ?>"><h3><?php echo $Team_Missed_call_Hot['hot'] ?></h3></a></td>
                  </tr>
                </table>

              </div>
            </div>
          
            <style type="text/css">
              .calls, .meeting, .missed{
                width: 29.5%;
                display: inline-block;
                padding: 0 15px;
              }
             
            </style>

          </div>
        </div>
        </div>
        
        <?php
      }
      else
      {
        ?>
        <div class="col-lg-4 col-md-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-aqua" style="background-color: #1f4819 !important">
            <div class="inner">
              <!-- <a href="<?php //echo site_url('User/Today_FollowUp_Data'); ?>"><h3><?php //echo $today_followup['COUNT(Prospect_Icode)'] ?></h3></a> -->

              <h4>Today Scheduled Calls</h4>
               <div class="cold">
                <h5>Cold</h5>
                <a href="<?php echo site_url('User/Todays_Cold_Call'); ?>"><h3><?php echo $today_followup_cold['COUNT(Prospect_Icode)'] ?></h3></a>
              </div>
              <div class="warm">
                <h5>Warm</h5>
                  <a href="<?php echo site_url('User/Today_FollowUp_Data'); ?>"><h3><?php echo $today_followup['COUNT(Prospect_Icode)'] ?></h3></a> 
              </div>
            </div>
          
            <style type="text/css">
              .cold, .warm{
                width: 49.5%;
                display: inline-block;
                padding: 0 15px;
              }
             
            </style>

            <!-- <div class="icon">
              <i class="ion ion-bag"></i>
            </div> -->
            <!-- <a href="<?php //echo site_url('User/Today_FollowUp_Data'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
         <div class="col-lg-4 col-md-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-aqua" style="background-color: #97979e !important;">
            <div class="inner">
              <!-- <a href="<?php //echo site_url('User/Today_FollowUp_Data'); ?>"><h3><?php //echo $today_followup['COUNT(Prospect_Icode)'] ?></h3></a> -->

              <h4>Today Scheduled Meeting</h4>
               <div class="cold">
                <h5>Hot</h5>
               <a href="<?php echo site_url('User/Today_FollowUp_Data'); ?>"><h3><?php echo $Todays_Meeting_Hot['hot'] ?></h3></a>
              </div>
              <div class="warm">
                <h5>Warm</h5>
               <a href="<?php echo site_url('User/Today_FollowUp_Data'); ?>"><h3><?php echo $Todays_Meeting_Warm['warm'] ?></h3></a>
              </div>
            </div>
          
        
          </div>
        </div>

         <div class="col-lg-4 col-md-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-aqua" style="background-color: #450b01 !important">
            <div class="inner">
              <!-- <a href="<?php //echo site_url('User/Today_FollowUp_Data'); ?>"><h3><?php //echo $today_followup['COUNT(Prospect_Icode)'] ?></h3></a> -->

              <h4>Missed Call/Meeting</h4>
               <div class="cold1">
                <h5>Cold</h5>
              <a href="<?php echo site_url('User/Missed_call'); ?>"><h3><?php echo $Missed_call_Cold['cold'] ?></h3></a>
              </div>
              <div class="warm1">
                <h5>Warm</h5>
               <a href="<?php echo site_url('User/Missed_call'); ?>"><h3><?php echo $Missed_call_Warm['warm'] ?></h3></a>
              </div>
              <div class="Hot1">
                <h5>Hot</h5>
               <a href="<?php echo site_url('User/Missed_call'); ?>"><h3><?php echo $Missed_call_Hot['hot'] ?></h3></a>
              </div>
            </div>

              <style type="text/css">
              .cold1, .warm1, .Hot1{
                width: 29.5%;
                display: inline-block;
                padding: 0 15px;
              }
             
            </style>

          
        
          </div>
        </div>
</div>
       
                                         
        <?php
      }
      ?>

      <div class="row">
      <div class="col-lg-6 col-md-6 col-xs-12">
       <div id="line_chart" style="width: 100%;"></div>
      </div>
     <!--  <div class="col-lg-1 col-xs-1">
      </div> -->
    
      <div class="col-lg-6 col-md-6 col-xs-12">
       <div id="line_chart1" style="width: 100%;"></div>
      </div>
      </div>
       <div class="row">
        <div class="col-lg-12 col-xs-12" style="margin-bottom: 10px;">
        </div>
       </div>

      <div class="row">
      <div class="col-lg-6 col-xs-12 col-md-6">
       <div id="line_chart2" style="width: 100%;"></div>
      </div>
      <!-- <div class="col-lg-1 col-xs-1">
      </div> -->
    
      <div class="col-lg-6 col-xs-12 col-md-6">
       <div id="line_chart3" style="width: 100%;"></div>
      </div>
      </div>
       <div class="row">
        <div class="col-lg-12 col-xs-12" style="margin-bottom: 10px;">
        </div>
       </div>

      <div class="row">
        <div class="col-lg-6 col-xs-12 col-md-6">
          <div id="line_chart4" style="width: 100%;"></div>
        </div>
      </div>
      
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; 2017-2018:  IBT <a href="http://192.168.10.55/WP/#team" target="_blank">Karthik</a>.</strong> All rights
    reserved.
  </footer>
  
  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 
    <script type="text/javascript">
      // Load the Visualization API and the line package.
      google.charts.load('current', {'packages':['line']});
      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChart1);
       google.charts.setOnLoadCallback(drawChart2);
        google.charts.setOnLoadCallback(drawChart_hot);
        google.charts.setOnLoadCallback(drawChart_hit_rate);
  
    function drawChart() {
  
        $.ajax({
        type: 'POST',
        url: '<?php echo site_url('User/total_chart'); ?>',
          
        success: function (data1) {
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable();
  
      data.addColumn('string', 'Date');
      data.addColumn('number', 'count');
    
        
      var jsonData = $.parseJSON(data1);

      //alert(jsonData);
      
      for (var i = 0; i < jsonData.length; i++) {
            data.addRow([jsonData[i]. Date, parseInt(jsonData[i].count)]);
      }
      var options = {
        chart: {
          title: 'Total Calls',
          subtitle: ''
        },
       
        height: 300,
        axes: {
          x: {
            0: {side: 'bottom'} 
          }
        },
          colors: ['green', 'red']
         
      };
      var chart = new google.charts.Line(document.getElementById('line_chart'));
      chart.draw(data, options);
       }
     });
    }

     function drawChart1() {
  
        $.ajax({
        type: 'POST',
        url: '<?php echo site_url('User/total_Cold_chart'); ?>',
          
        success: function (data1) {
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable();
  
      data.addColumn('string', 'Date');
      data.addColumn('number', 'count');
    
        
      var jsonData = $.parseJSON(data1);

      //alert(jsonData);
      
      for (var i = 0; i < jsonData.length; i++) {
            data.addRow([jsonData[i].Date, parseInt(jsonData[i].count)]);
      }
      var options = {
        chart: {
          title: 'Cold Calls',
          subtitle: ''
        },
        
        height: 300,
        axes: {
          x: {
            0: {side: 'bottom'} 
          }
        },
          colors: ['#00c0ef']
         
      };
      var chart = new google.charts.Line(document.getElementById('line_chart1'));
      chart.draw(data, options);
       }
     });
    }

function drawChart2() {
  
        $.ajax({
        type: 'POST',
        url: '<?php echo site_url('User/total_Warm_chart'); ?>',
          
        success: function (data1) {
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable();
  
      data.addColumn('string', 'Date');
      data.addColumn('number', 'count');
    
        
      var jsonData = $.parseJSON(data1);

      //alert(jsonData);
      
      for (var i = 0; i < jsonData.length; i++) {
            data.addRow([jsonData[i].Date, parseInt(jsonData[i].count)]);
      }
      var options = {
        chart: {
          title: 'Warm Calls',
          subtitle: ''
        },
        
         height: 300,
        axes: {
          x: {
            0: {side: 'bottom'} 
          }
        },
          colors: ['#f39c12']
         
      };
      var chart = new google.charts.Line(document.getElementById('line_chart2'));
      chart.draw(data, options);
       }
     });
    }


        function drawChart_hot() {
  
        $.ajax({
        type: 'POST',
        url: '<?php echo site_url('User/total_Hot_chart'); ?>',
          
        success: function (data1) {
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable();
  
      data.addColumn('string', 'Date');
      data.addColumn('number', 'count');
    
        
      var jsonData = $.parseJSON(data1);

      //alert(jsonData);
      
      for (var i = 0; i < jsonData.length; i++) {
            data.addRow([jsonData[i].Date, parseInt(jsonData[i].count)]);
      }
      var options = {
        chart: {
          title: 'HOT Calls',
          subtitle: ''
        },
       
         height: 300,
        axes: {
          x: {
            0: {side: 'bottom'} 
          }
        },
          colors: ['#f9325c']
         
      };
      var chart = new google.charts.Line(document.getElementById('line_chart3'));
      chart.draw(data, options);
       }
     });
    }


     function drawChart_hit_rate() {
  
        $.ajax({
        type: 'POST',
        url: '<?php echo site_url('User/total_HitRate_chart'); ?>',
          
        success: function (data1) {
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable();
  
      data.addColumn('string', 'date');
                 data.addColumn('number', 'DM');
                 data.addColumn('number', 'Other');
        
      var jsonData = $.parseJSON(data1);

      //alert(jsonData);
      
      for (var i = 0; i < jsonData.length; i++) {
             data.addRow([jsonData[i].date, parseInt(jsonData[i].DM), parseInt(jsonData[i].Other)]);
      }
      var options = {
        chart: {
          title: 'HIT RATE',
          subtitle: ''
        },
      
        height: 300,
        axes: {
          x: {
            0: {side: 'bottom'} 
          }
        },
          colors: ['green', 'red']
         
      };
      var chart = new google.charts.Line(document.getElementById('line_chart4'));
      chart.draw(data, options);
       }
     });
    }


  </script>
 
</body>
</html>
