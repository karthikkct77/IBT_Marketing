<script>
$(document).ready( function () {
 
    $('#demoPostTable').addClass( 'nowrap' ).DataTable( {
                    responsive: false
                });
} );

</script>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

     <div class="row">
    <div class="col-md-10">
   <h4>
    Warm Followup - <?php echo $country ?> - <?php echo $data_total_count['COUNT(Prospect_Icode)'] ?>
      
      </h4>
    </div>
    <div class="col-md-2">
     <a href="<?php echo site_url('User/View_FollowUp_Data'); ?>" >Back </a>
    </div>
    </div>
     
      
     
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
        <div class="row">
        <div class="col-md-12">
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
               <td><h5><a href='<?php echo site_url('User/get_thisweek_data_Warm/'.$thisweek['Country'].''); ?>'><?php echo $thisweek['tisweek']; ?></a></h5></td>
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
             <td><h5><a href='<?php echo site_url('User/get_lastweek_data_Warm/'.$lastweek['Country'].''); ?>'><?php echo $lastweek['lastweek']; ?></a></h5></td>
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
             <td><h5><a href='<?php echo site_url('User/get_twoweek_data_Warm/'.$twoweek['Country'].''); ?>'><?php echo $twoweek['twoweek']; ?></a></h5></td>
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
             <td><h5><a href='<?php echo site_url('User/get_threeweek_data_Warm/'.$threeweek['Country'].''); ?>'><?php echo $threeweek['threeweek']; ?></a></h5></td>
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
             <td><h5><a href='<?php echo site_url('User/get_month_data_Warm/'.$month['Country'].''); ?>'><?php echo $month['month']; ?></a></h5></td>
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
             <td><h5><a href='<?php echo site_url('User/get_twomonth_data_Warm/'.$twomonth['Country'].''); ?>'><?php echo $twomonth['twomonth']; ?></a></h5></td>
             <?php
             }
             ?>
             </tr>
           
           </tbody>

           </table>
          

</div>
</div>
</div>


        <!-- left column -->
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
             <td><h5><a href='<?php echo site_url('User/get_Product_data_Warm/'.$product['Country'].''); ?>'><?php echo $product['product']; ?></a></h5></td>
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
             <td><h5><a href='<?php echo site_url('User/get_Service_data_Warm/'.$services['Country'].''); ?>'><?php echo $services['services']; ?></a></h5></td>
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
             <td><h5><a href='<?php echo site_url('User/get_BA_data_Warm/'.$BA['Country'].''); ?>'><?php echo $BA['BA']; ?></a></h5></td>
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
             <td><h5><a href='<?php echo site_url('User/get_Avg_data_Warm/'.$Avg['Country'].''); ?>'><?php echo $Avg['Avg']; ?></a></h5></td>
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
             <td><h5><a href='<?php echo site_url('User/get_AAvg_data_Warm/'.$AboveAvg['Country'].''); ?>'><?php echo $AboveAvg['AAvg']; ?></a></h5></td>
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
             <td><h5><a href='<?php echo site_url('User/get_Good_data_Warm/'.$Good['Country'].''); ?>'><?php echo $Good['Good']; ?></a></h5></td>
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


          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">post Meeting Followup</h3>
              <small>(Not Followed up for Last 15 days</small>
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
           
             <td>General Call</td>
              <?php 
             if($General['General'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h5><a href='<?php echo site_url('User/get_General_data_Warm/'.$General['Country'].''); ?>'><?php echo $General['General']; ?></a></h5></td>
              <?php
             }
             ?>
             </tr>
           <tr>
           
             <td>Sales Presentation</td>
              <?php 
             if($Sales['sales'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h5><a href='<?php echo site_url('User/get_sales_data_Warm/'.$Sales['Country'].''); ?>'><?php echo $Sales['sales']; ?></a></h5></td>
              <?php
             }
             ?>
             </tr>
             <tr>
           
             <td>Technical Presentation</td>
               <?php 
             if($Technical['Technical'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h5><a href='<?php echo site_url('User/get_Technical_data_Warm/'.$Technical['Country'].''); ?>'><?php echo $Technical['Technical']; ?></a></h5></td>
              <?php
             }
             ?>
             </tr>
                   <tr>
           
             <td>RFP/Requirement Presentation</td>
               <?php 
             if($RFP['RFP'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h5><a href='<?php echo site_url('User/get_RFP_data_Warm/'.$RFP['Country'].''); ?>'><?php echo $RFP['RFP']; ?></a></h5></td>
              <?php
             }
             ?>
             </tr>
                   <tr>
           
             <td>Proposal Review</td>
               <?php 
             if($Review['Review'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h5><a href='<?php echo site_url('User/get_Review_data_Warm/'.$Review['Country'].''); ?>'><?php echo $Review['Review']; ?></a></h5></td>
              <?php
             }
             ?>
             </tr>
                   <tr>
           
             <td>Pricing/Commercial</td>
               <?php 
             if($Commercial['Commercial'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h5><a href='<?php echo site_url('User/get_Commercial_data_Warm/'.$Commercial['Country'].''); ?>'><?php echo $Commercial['Commercial']; ?></a></h5></td>
              <?php
             }
             ?>
             </tr>
                   <tr>
           
             <td>Interview</td>
               <?php 
             if($Interview['Interview'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h5><a href='<?php echo site_url('User/get_Interview_data_Warm/'.$Interview['Country'].''); ?>'><?php echo $Interview['Interview']; ?></a></h5></td>
              <?php
             }
             ?>
             </tr>
                   <tr>
           
             <td>Escalation/Issue</td>
               <?php 
             if($Escalation['Escalation'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h5><a href='<?php echo site_url('User/get_Escalation_data_Warm/'.$Escalation['Country'].''); ?>'><?php echo $Escalation['Escalation']; ?></a></h5></td>
              <?php
             }
             ?>
             </tr>
                   <tr>
           
             <td>FeedBack Call</td>
               <?php 
             if($FeedBack['FeedBack'] == 0)
             {
              ?>
              <td></td>
              <?php
             }
             else
             {
              ?>
             <td><h5><a href='<?php echo site_url('User/get_FeedBack_data_Warm/'.$FeedBack['Country'].''); ?>'><?php echo $FeedBack['FeedBack']; ?></a></h5></td>
              <?php
             }
             ?>
             </tr>
             </tbody>

           </table>
          

</div>
</div>


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
             <td><h4><a href='<?php echo site_url('User/get_custom_data_Warm/'.$custom['Country'].''); ?>'><?php echo $custom['custom']; ?></a></h4></td>
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
             <td><h4><a href='<?php echo site_url('User/get_web_data_Warm/'.$web['Country'].''); ?>'><?php echo $web['web']; ?></a></h4></td>
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
             <td><h4><a href='<?php echo site_url('User/get_mobile_data_Warm/'.$mobile['Country'].''); ?>'><?php echo $mobile['mobile']; ?></a></h4></td>
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
             <td><h4><a href='<?php echo site_url('User/get_ec_data_Warm/'.$ec['Country'].''); ?>'><?php echo $ec['ec']; ?></a></h4></td>
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

          