
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    Cold Followup - <?php echo $country ?> - <?php echo $data_total_count['COUNT(Prospect_Icode)'] ?>
        <small></small>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">By TimeLine</h3>
            </div>
             
            <!-- /.box-header -->
         
              <div class="box-body">
          
          <table id="demoPostTable2" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
           <thead>
           <tr>
           <th width="50%">Weeks</th>
           <th>Count</th>
           </tr>
            
              
           </thead>
           <tbody>
           <tr>
           
             <td>Called This Week:</td>
             <?php 
             if($thisweek['tisweek'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
               <td><h4><a href='<?php echo site_url('User/get_thisweek_data/'.$thisweek['Country'].''); ?>'><?php echo $thisweek['tisweek']; ?></a></h4></td>
               <?php
             }
             ?>
            
             </tr>
             <tr>
           
             <td>Called Last Week:</td>
              <?php 
             if($lastweek['lastweek'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h4><a href='<?php echo site_url('User/get_lastweek_data/'.$lastweek['Country'].''); ?>'><?php echo $lastweek['lastweek']; ?></a></h4></td>
               <?php
             }
             ?>
             </tr>
           
             <tr>
           
             <td>Called Two Week ago:</td>
              <?php 
             if($twoweek['twoweek'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h4><a href='<?php echo site_url('User/get_twoweek_data/'.$twoweek['Country'].''); ?>'><?php echo $twoweek['twoweek']; ?></a></h4></td>
               <?php
             }
             ?>
             </tr>
             <tr>
           
             <td>Called Three Week ago:</td>
              <?php 
             if($threeweek['threeweek'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h4><a href='<?php echo site_url('User/get_threeweek_data/'.$threeweek['Country'].''); ?>'><?php echo $threeweek['threeweek']; ?></a></h4></td>
               <?php
             }
             ?>
             </tr>
             <tr>
           
             <td>Called a Month ago:</td>
              <?php 
             if($month['month'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h4><a href='<?php echo site_url('User/get_month_data/'.$month['Country'].''); ?>'><?php echo $month['month']; ?></a></h4></td>
              <?php
             }
             ?>
             </tr>
             <tr>
           
             <td>Called Two Months ago (or Earlier) </td>
              <?php 
             if($twomonth['twomonth'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h4><a href='<?php echo site_url('User/get_twomonth_data/'.$twomonth['Country'].''); ?>'><?php echo $twomonth['twomonth']; ?></a></h4></td>
             <?php
             }
             ?>
             </tr>
           
           </tbody>

           </table>
          

</div>
</div>

          


</div>


<!-- BASED ON RESULT-->
  <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">By Type</h3>
            </div>
             
            <!-- /.box-header -->
         
              <div class="box-body">
          
          <table id="demoPostTable3" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
           <thead>
           <tr>
           <th width="50%">#</th>
           <th>Count</th>
           </tr>
            
              
           </thead>
           <tbody>
           <tr>
           
             <td>Below Average</td>
             <?php 
             if($BA['BA'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h4><a href='<?php echo site_url('User/get_BA_data/'.$BA['Country'].''); ?>'><?php echo $BA['BA']; ?></a></h4></td>
              <?php
             }
             ?>
             </tr>
             <tr>
           
             <td>Average</td>
              <?php 
             if($Avg['Avg'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h4><a href='<?php echo site_url('User/get_Avg_data/'.$Avg['Country'].''); ?>'><?php echo $Avg['Avg']; ?></a></h4></td>
             <?php
             }
             ?>
             </tr>
             <tr>
           
             <td>Above Average</td>
              <?php 
             if($AboveAvg['AAvg'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h4><a href='<?php echo site_url('User/get_AAvg_data/'.$AboveAvg['Country'].''); ?>'><?php echo $AboveAvg['AAvg']; ?></a></h4></td>
             <?php
             }
             ?>
             </tr>
             <tr>
           
             <td>Good</td>
              <?php 
             if($Good['Good'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h4><a href='<?php echo site_url('User/get_Good_data/'.$Good['Country'].''); ?>'><?php echo $Good['Good']; ?></a></h4></td>
              <?php
             }
             ?>
             </tr>
             </tbody>

           </table>
          

</div>
</div>

          


</div>
      
      
</div>




<!-- BASED ON CATEGORY-->
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
        <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">By Category</h3>
            </div>
             
            <!-- /.box-header -->
         
              <div class="box-body">
          
          <table id="demoPostTable3" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
           <thead>
           <tr>
           <th width="50%">#</th>
           <th>Count</th>
           </tr>
            
              
           </thead>
           <tbody>
           <tr>
           
             <td>Product</td>
              <?php 
             if($product['product'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h4><a href='<?php echo site_url('User/get_Product_data/'.$product['Country'].''); ?>'><?php echo $product['product']; ?></a></h4></td>
              <?php
             }
             ?>
             </tr>
             <tr>
           
             <td>Service</td>
               <?php 
             if($services['services'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h4><a href='<?php echo site_url('User/get_Service_data/'.$services['Country'].''); ?>'><?php echo $services['services']; ?></a></h4></td>
              <?php
             }
             ?>
             </tr>
             </tbody>

           </table>
          

</div>
</div>

          


</div>
<div class="col-md-12">

     <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">By Hit Rate</h3>
            </div>
             
            <!-- /.box-header -->
         
              <div class="box-body">
          
          <table id="demoPostTable3" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
           <thead>
           <tr>
           <th width="50%"></th>
           <th>Count</th>
           </tr>
            
              
           </thead>
           <tbody>
           <tr>
           
             <td>Spock With Decision Maker</td>
              <?php 
             if($DM['DM'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h4><a href='<?php echo site_url('User/get_DM_data/'.$DM['Country'].''); ?>'><?php echo $DM['DM']; ?></a></h4></td>
              <?php
             }
             ?>
             </tr>
             <tr>
           
             <td>Spock With Others</td>
               <?php 
             if($others['Other'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h4><a href='<?php echo site_url('User/get_Other_data/'.$others['Country'].''); ?>'><?php echo $others['Other']; ?></a></h4></td>
              <?php
             }
             ?>
             </tr>
             </tbody>

           </table>
          

</div>
</div>


</div>
</div>




</div>
<div class="col-md-6">

  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">By Service</h3>
            </div>
             
            <!-- /.box-header -->
         
              <div class="box-body">
          
          <table id="demoPostTable3" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
           <thead>
           <tr>
           <th width="50%"></th>
           <th>Count</th>
           </tr>
            
              
           </thead>
           <tbody>
           <tr>
           
             <td>Custom_Development</td>
              <?php 
             if($custom['custom'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h4><a href='<?php echo site_url('User/get_custom_data/'.$custom['Country'].''); ?>'><?php echo $custom['custom']; ?></a></h4></td>
              <?php
             }
             ?>
             </tr>
             <tr>
           
             <td>Web_Development</td>
               <?php 
             if($web['web'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h4><a href='<?php echo site_url('User/get_web_data/'.$web['Country'].''); ?>'><?php echo $web['web']; ?></a></h4></td>
              <?php
             }
             ?>
             </tr>
              <tr>
           
             <td>Mobile_Development</td>
               <?php 
             if($mobile['mobile'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h4><a href='<?php echo site_url('User/get_mobile_data/'.$mobile['Country'].''); ?>'><?php echo $mobile['mobile']; ?></a></h4></td>
              <?php
             }
             ?>
             </tr>
              <tr>
           
             <td>Ecommerce_Development</td>
               <?php 
             if($ec['ec'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h4><a href='<?php echo site_url('User/get_ec_data/'.$ec['Country'].''); ?>'><?php echo $ec['ec']; ?></a></h4></td>
              <?php
             }
             ?>
             </tr>
             </tbody>

           </table>
          

</div>
</div>


</div>

</div>


</section>
 </div>




  <script type="text/javascript">  
              function show_our_date() {
            $('#collapse_our').show();
             $('#collapse_client').hide();
              }


               function show_Client_date() {
                   $('#collapse_client').show();
             $('#collapse_our').hide();
          
              }


              function client_data_call(id)
              {
                $.ajax({  
                         url:"<?php echo site_url('User/Prospect_Data_Call_Client_date'); ?>",  
                        data: {id: id},  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                            $("#edit_code").html(data);  
                      $('#myModal1').modal('show');
                     }  
                  }); 

              }
 
         </script>  

          <script type="text/javascript">  
                  $(document).ready(function() {  
                     $("#country").change(function(){  
                    //  alert("hiiii");
                     /*dropdown post *///  
                     $.ajax({  
                        url:"<?php echo site_url('User/get_country_state'); ?>",  
                        data: {id:  
                           $(this).val()},  
                        type: "POST",  
                        success:function(data){  
                        $("#state").html(data);  
                     }  
                  });  
               });  
            });  



 $(document).ready(function() {  
                     $("#state").change(function(){  
                    //  alert("hiiii");
                     /*dropdown post *///  
                     $.ajax({  
                        url:"<?php echo site_url('User/get_state_city'); ?>",  
                        data: {id:  
                           $(this).val()},  
                        type: "POST",  
                        success:function(data){  
                        $("#city").html(data);  
                     }  
                  });  
               });  
            });  

 
         </script>  
       

       



 </body>
</html>

          