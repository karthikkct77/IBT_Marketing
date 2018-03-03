
<script>
$(document).ready( function () {
 
    $('#demoPostTable').addClass( 'nowrap' ).DataTable( {
                    responsive: false
                });
} );

</script>

<style>
    .foo {
        float: left;
        width: 20px;
        height: 20px;
        margin: 5px;
        border: 1px solid rgba(0, 0, 0, .2);
    }

    .blue {
        background: #F85B5B;
    }
    .green {
        background: #256C0A;
    }
</style>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    Cold Calling - <?php echo $total_count['count(*)'] ?>
        <small></small>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> </h3>
            </div>
             
            <!-- /.box-header -->
         
              <div class="box-body">
           <div class="panel-group" id="accordion">
 
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
       
       <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
             <span class="glyphicon glyphicon-plus"></span>
         Fresh Data - <?php echo $new_call_count['COUNT(Prospect_Icode)'] ?>
           
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
       
                <form method="post" role="form" action="<?php echo site_url('User/Prospect_Data_Call'); ?>" name="data_register">
                 <div class="col-md-12">
                <div class="col-md-3">
                 <div class="form-group">
                  <label>Select Country</label>
               
                  <select name="Company_country" class="form-control" id="country" required >
                     <option value="" >Select Country</option>
           <?php foreach ($user_data as $row):
            { 

                echo "<option value= " .$row['Country'].">" . $row['Country'] ."(". $row['counts'] .") </option>";

           } 
           endforeach; ?>
           </select> 
                </div>
             
              </div>
              <div class="col-md-3">
                 <div class="form-group">
                  <label>Select State</label>


                     <select name="state" id="state" class="form-control">
          
           </select> 
           
              
             
              </div>
              </div>
               <div class="col-md-3">
                 <div class="form-group">
                 <label>Select City</label>


                     <select name="City" id="city" class="form-control">
          
           </select> 
           
              
             
              </div>
              </div>
               <div class="col-md-3">
                <div class="form-group">
             <label>select Category</label>
               
                  <select name="Ptype" class="form-control" id="Ptype"  >
               
                       
           
           </select> 
                </div>
              </div>
              </div>
              <div class="col-md-12">
              <div class="col-md-3"> 
 <div class="form-group">
 <label>Select Company Type</label>
         
                  <select name="company_type" class="form-control" id="CType" >
                   <option value="" >Select Company Type</option>
                   <option value="Custom_Development" >Custom_Development</option>
                     <option value="Web_Development" >Web_Development</option>
                      <option value="Mobile_Development" >Mobile_Development</option>
                       <option value="Ecommerce_Development" >Ecommerce_Development</option>
                        
           
           </select> 
                </div>

              </div>
                <div class="col-md-3"> 
                <label>Technical Skill</label>
                  <div class="form-group">
            <input type="text" class="form-control" name="skill"  id="skill" value="" placeholder="Enter Technical Skill"> 
            </div>
               

                </div>
               <div class="col-md-3">
              <div class="form-group">
              
              <button type="submit"  class="btn btn-info" id="test" >Search</button>
             
              </div>
              </div>
              </div>
              </form>
              

             
             
             
     </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          <span class="glyphicon glyphicon-plus"></span>
          Cold Data- <?php echo $called_count['COUNT(Prospect_Icode)'] ?>
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">

      <div class="row">
      <div class="col-md-3">
       <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="" onclick="show_our_date()">
          <span class="glyphicon glyphicon-plus"></span>
          Cold Followup - <?php echo $ourdate_count['COUNT(Prospect_Icode)'] ?>
        </a>
      </h4>
    </div>

      
      </div>
       <div class="col-md-3">
         <div class="panel-heading">
      <h4 class="panel-title">
         <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="" onclick="show_Client_date()">
          <span class="glyphicon glyphicon-plus"></span>
          Client Scheduled Cold Call/Missed Call - <?php echo $clientdate_count['COUNT(Prospect_Icode)'] ?>
        </a>
      </h4>
    </div>
    
       
      </div>
      </div>

       
       
      </div>
    </div>
  </div>


      
</div>
</div>
</div>

          


</div>
</div>

<!-- OUR DATE DISPLAY -->

<div class="row" id="collapse_our" style="display: none;">
 <div class="col-md-12">
 <div class="box box-primary">
 <div class="box-body">
  <table id="demoPostTable2" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
  <h4>Our Date</h4>
 
 <thead>
    <tr>
    
        <th>Counter</th>
        <th>Data Count</th>
      
       
    </tr>
    </thead>
 
 
 <tbody>
 

<?php 
foreach($ourdate_details as $r) 
{
?>
<tr>
 <td><?php echo $r['Country']; ?></td>  
 <td><a href='get_country_wise_called_data/<?php echo $r['Country']; ?>'><?php echo $r['our_count']; ?></a></td>  
</td>            
                  
                          

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

<div class="row" id="collapse_client" style="display: none;">
<div class="col-md-12">
<div class="box box-primary">

 <div class="box-body">
 <table id="demoPostTable" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
  <h4>Client Date</h4>


   <div class="row">
   <div class="col-md-4">
   <div class="modal-body" ><div class="foo blue"> </div>  <p>Missed Call</p></div>
   </div>
   <div class="col-md-4">
      <div class="modal-body" ><div class="foo green"> </div>  <p>Today's Call</p></div>
   </div>
     
    

 
 <thead>
    <tr>
        <th>#</th>
        <th>Company Name</th>
        
        <th>Phone Number</th>
        <th>Country</th>
        <th>Category</th>
        <th>Client Date/Time</th>
        <th>Our Date/Time</th>
       
        <th></th>
       
    </tr>
    </thead>
 
         
 <tbody>
  <?php
                   $i=1;
                                 
                                    foreach($clientdate_details as $r)
                                    {
                                       

                                        if( $r['datee'] == date('Y-m-d'))
                                        {
                                          ?>
                                          <tr style="padding-left: 5px;
                   padding-bottom:3px;
                   color:#256C0A;
                   font-weight:bold">
    <td><?php echo $i; ?></td>

 <td><?php echo $r['Company_Name']; ?><br><?php echo $r['WebURL']; ?></td>  
        
                    <td><?php echo $r['Company_Contact']; ?></td>
                       <td><?php echo $r['Country']; ?></td>
                       <td><?php echo $r['Marketing_Prospect_Type']; ?></td>     
                       <td><?php echo $r['Next_Call_Date']; ?></td>
                        <td><?php echo $r['Equiv_our_date']; ?></td>
                      
                          <td> <a class="btn btn-success" href="<?php echo site_url('User/Prospect_Data_Call_Client_date/'. $r['Prospect_Icode'].''); ?>" > <i class="glyphicon glyphicon-zoom-in icon-white"></i> Call
            </a>


            </td>
            </tr>
            <?php
            

                                        }
                                        else if($r['datee'] <= date('Y-m-d'))
                                        {
                                          ?>
                                           <tr style="padding-left: 5px;
                   padding-bottom:3px;
                   color:#F85B5B;
                   font-weight:bold">
    <td><?php echo $i; ?></td>

 <td><?php echo $r['Company_Name']; ?><br><?php echo $r['WebURL']; ?></td>  
        
                    <td><?php echo $r['Company_Contact']; ?></td>
                       <td><?php echo $r['Country']; ?></td>
                       <td><?php echo $r['Marketing_Prospect_Type']; ?></td>     
                       <td><?php echo $r['Next_Call_Date']; ?></td>
                        <td><?php echo $r['Equiv_our_date']; ?></td>
                      
                          <td> <a class="btn btn-success" href="<?php echo site_url('User/Prospect_Data_Call_Client_date/'. $r['Prospect_Icode'].''); ?>" > <i class="glyphicon glyphicon-zoom-in icon-white"></i> Call
            </a>


            </td>
            </tr>
            <?php

                                        }
                                        else
                                        {
                                          ?>
                                            <tr>
    <td><?php echo $i; ?></td>

 <td><?php echo $r['Company_Name']; ?><br><?php echo $r['WebURL']; ?></td>  
        
                    <td><?php echo $r['Company_Contact']; ?></td>
                       <td><?php echo $r['Country']; ?></td>
                       <td><?php echo $r['Marketing_Prospect_Type']; ?></td>     
                       <td><?php echo $r['Next_Call_Date']; ?></td>
                        <td><?php echo $r['Equiv_our_date']; ?></td>
                      
                          <td> <a class="btn btn-success" href="<?php echo site_url('User/Prospect_Data_Call_Client_date/'. $r['Prospect_Icode'].''); ?>" > <i class="glyphicon glyphicon-zoom-in icon-white"></i> Call
            </a>


            </td>
            </tr>
            <?php

                                        }

 

                                        $i++;
                                    }
                                    ?>
                               

 
  
 
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
                     $("#country").change(function(){  
                    //  alert("hiiii");
                     /*dropdown post *///  
                     $.ajax({  
                        url:"<?php echo site_url('User/get_country_category'); ?>",  
                        data: {id:  
                           $(this).val()},  
                        type: "POST",  
                        success:function(data){  
                        $("#Ptype").html(data);  
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

          