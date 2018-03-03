  <style>
    .foo {
        float: left;
        width: 20px;
        height: 20px;
        margin: 5px;
        border: 1px solid rgba(0, 0, 0, .2);
    }

    .blue {
        background: #b7f5b7;
    }
    .green {
        background: #f0e7b5;
    }
</style>
<script>
$(document).ready( function () {
 
    $('#demoPostTable').addClass( 'nowrap' ).DataTable( {
                    responsive: true
                });
     $('#demoPostTable1').addClass( 'nowrap' ).DataTable( {
                    responsive: true
                });
 


} );
$(document).ready(function(){
    $('#myTable').DataTable();
});
      </script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
   List of Requirements
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
              <h3 class="box-title">Search </h3>
            </div>
             
            <!-- /.box-header -->
         
              <div class="box-body">
                <div class="row">
                <div class="col-md-12">
                 
                <div class="col-md-2">
                  <div class="form-group">
                  <label>From Date</label>
                 
               
                     <input  class="form-control"  type="text" name="from_date" id="datepicker" placeholder="From Date" required> 
           
                </div>
              </div>
              
              <div class="col-md-2">
                  <div class="form-group">
                    <label>TO Date</label>
                 
                   <input  class="form-control"  type="text" name="to_date" id="datepicker1" placeholder="From Date" >    
           
                </div>
              </div>
                 <div class="col-md-2"> 
                 <div class="form-group">
                  <label>Select Type</label>
                     <select name="Type" class="form-control" id="Type" >
                        <option value="" >Select Type</option>
                        <option value="Project" >Project</option>
                        <option value="Resource" >Resource</option>
                        
                      </select>       
                  </div>              
                </div>
                <div class="col-md-2"> 
                 <div class="form-group">
                  <label>Select Status</label>
                     <select name="Status" class="form-control" id="Status" >
                        <option value="" >Select Status</option>
                       
                      </select>       
                  </div>              
                </div>
              
           

              <div class="col-md-3">
              <div class="form-group">
              
              <button type="button"  class="btn btn-info" onclick="search_Data()" >Search</button>
                <button type="button"  class="btn btn-success" id="reset"  onclick="get_rest()" >Reset</button>
             
              </div>
              </div>
          
          </div>
          </div>
         <div class="row">
          <div class="col-md-4" style="margin: 20px auto;">
       <p style="width: auto; display: inline-block; margin-right: 20px;"><span style="width: 20px; height: 20px; background-color: #b7f5b7; display: inline-block; vertical-align: bottom;"></span> Good</p>
      <p style="width: auto; display: inline-block;"><span style="width: 20px; height: 20px; vertical-align: bottom; background-color: #f0e7b5; display: inline-block;"></span> Above Average</p>
   </div>
        
   </div>

 <div id="old">
 <table id="demoPostTable"  data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead>
                <th>#</th> 
                <th>Company Name</th>
                <th>Country</th>
                <th>Type</th>
                <th>Project Title</th>
                <th>Platform</th>
                <th>Team Lead</th>
                <th>Received on</th>
                <th>Need on</th>
                <th>Possible TAT</th>
                <th>Status</th>

                 
                </thead>
                <tbody>
                <?php 
                $i=1;
                foreach ($requirement as $key )
                {

                   if($key['Marketing_Prospect_Type'] == 'Good')
                   {
                    ?>
                        <tr style="background-color:#b7f5b7;">
                        <td><?php echo $i; ?></td>
                        <td><a  href='select_Requirement/<?php echo $key['Requirement_Icode'] ?>/<?php echo $key['Requirement_Status']; ?>/<?php echo $key['Requirement_Type'] ?>'><?php echo $key['Company_Name']; ?></a></td>
                        <td><?php echo $key['Country']; ?></td>
                        <td><?php echo $key['Requirement_Type']; ?></td>
                        <td><?php echo $key['Project_Title']; ?></td>
                        <td><?php echo $key['Tech_Name']; ?></td>
                        <td><?php echo $key['User_Name']; ?></td>
                        <td><?php echo $key['Req_Received_Date']; ?></td>
                        <?php 
                          if($key['Requirement_Type'] == 'Project')
                          {
                            ?>
                             <td><?php echo $key['Estimation_Date']; ?></td>
                             <?php
                               if( date('Y/m/d', strtotime($key['Estimation_Date'])) < date('Y/m/d', strtotime($key['Tech_Team_Date'])) )
                               {

                                ?>
                                  <td style="color: red"><?php echo $key['Tech_Team_Date']; ?></td>
                               <?php
                               }
                               else
                               {
                                ?>
                                <td><?php echo $key['Tech_Team_Date']; ?></td>
                                <?php
                               }
                     
                         }
                         else
                         {
                          ?>
                          <td><?php echo $key['Resource_Exp_Start_Date']; ?></td>
                          <?php
                               if( date('Y/m/d', strtotime($key['Resource_Exp_Start_Date'])) < date('Y/m/d', strtotime($key['Tech_Team_Date'])) )
                               {

                                ?>
                                  <td style="color: red"><?php echo $key['Tech_Team_Date']; ?></td>
                               <?php
                               }
                               else
                               {
                                ?>
                                <td><?php echo $key['Tech_Team_Date']; ?></td>
                                <?php
                               }
                      
                         }
                         ?>
                   
                          <td><?php echo $key['Req_Name']; ?></td>

                        </tr>
                  <?php
                   }
                   else if($key['Marketing_Prospect_Type'] == 'Above Average')
                   {
                    ?>
                          <tr  style="background-color:#f0e7b5;">
                          <td><?php echo $i; ?></td>
                            <td><a href='select_Requirement/<?php echo $key['Requirement_Icode'] ?>/<?php echo $key['Requirement_Status']; ?>/<?php echo $key['Requirement_Type'] ?>'><?php echo $key['Company_Name']; ?></a></td>
                            <td><?php echo $key['Country']; ?></td>
                            <td><?php echo $key['Requirement_Type']; ?></td>
                            <td><?php echo $key['Project_Title']; ?></td>
                            <td><?php echo $key['Tech_Name']; ?></td>
                            <td><?php echo $key['User_Name']; ?></td>
                            <td><?php echo $key['Req_Received_Date']; ?></td>
                            <?php 
                            if($key['Requirement_Type'] == 'Project')
                            {
                              ?>
                               <td><?php echo $key['Estimation_Date']; ?></td>
                               <?php
                               if( date('Y/m/d', strtotime($key['Estimation_Date'])) < date('Y/m/d', strtotime($key['Tech_Team_Date'])) )
                               {

                                ?>
                                  <td style="color: red"><?php echo $key['Tech_Team_Date']; ?></td>
                               <?php
                               }
                               else
                               {
                                ?>
                                <td><?php echo $key['Tech_Team_Date']; ?></td>
                                <?php
                               }
                            
                           }
                           else
                           {
                            ?>
                            <td><?php echo $key['Resource_Exp_Start_Date']; ?></td>
                            <?php
                               if( date('Y/m/d', strtotime($key['Resource_Exp_Start_Date'])) < date('Y/m/d', strtotime($key['Tech_Team_Date'])) )
                               {

                                ?>
                                  <td style="color: red"><?php echo $key['Tech_Team_Date']; ?></td>
                               <?php
                               }
                               else
                               {
                                ?>
                                <td><?php echo $key['Tech_Team_Date']; ?></td>
                                <?php
                               }
                        
                           }
                           ?>
                         
                            <td><?php echo $key['Req_Name']; ?></td>

                          </tr>
                  <?php        
                   }
                   else
                   {
                    ?>
                          <tr>
                          <td><?php echo $i; ?></td>
                            <td><a href='select_Requirement/<?php echo $key['Requirement_Icode'] ?>/<?php echo $key['Requirement_Status']; ?>/<?php echo $key['Requirement_Type'] ?>'><?php echo $key['Company_Name']; ?></a></td>
                            <td><?php echo $key['Country']; ?></td>
                            <td><?php echo $key['Requirement_Type']; ?></td>
                            <td><?php echo $key['Project_Title']; ?></td>
                            <td><?php echo $key['Tech_Name']; ?></td>
                            <td><?php echo $key['User_Name']; ?></td>
                            <td><?php echo $key['Req_Received_Date']; ?></td>
                            <?php 
                            if($key['Requirement_Type'] == 'Project')
                            {

                              ?>
                               <td><?php echo $key['Estimation_Date']; ?></td>

                               <?php
                               if( date('Y/m/d', strtotime($key['Estimation_Date'])) < date('Y/m/d', strtotime($key['Tech_Team_Date'])) )
                               {

                                ?>
                                  <td style="color: red"><?php echo $key['Tech_Team_Date']; ?></td>
                               <?php
                               }
                               else
                               {
                                ?>
                                <td><?php echo $key['Tech_Team_Date']; ?></td>
                                <?php
                               }
                           }
                           else
                           {
                            ?>
                            <td><?php echo $key['Resource_Exp_Start_Date']; ?></td>
                        <?php
                               if( date('Y/m/d', strtotime($key['Resource_Exp_Start_Date'])) < date('Y/m/d', strtotime($key['Tech_Team_Date'])) )
                               {

                                ?>
                                  <td style="color: red"><?php echo $key['Tech_Team_Date']; ?></td>
                               <?php
                               }
                               else
                               {
                                ?>
                                <td><?php echo $key['Tech_Team_Date']; ?></td>
                                <?php
                               }
                         
                           }
                           ?>


                          
                            <td><?php echo $key['Req_Name']; ?></td>

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
 <div class="box box-primary" id="fulldata" style="display:none">
            
              <div class="box-body">

                <div class="row">
                <div class="col-md-12">
                <table id="demoPostTable1"  data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead>
                 <th>#</th>
                <th>Company Name</th>
                <th>Country</th>
                <th>Type</th>
                <th>Project Title</th>
                <th>Platform</th>
                <th>Team Lead</th>
                <th>Received on</th>
                <th>Need on</th>
                <th>Possible TAT</th>
                <th>Status</th>
                

                 
                </thead>
                <tbody id="comments1">
               
                
                </tbody>
                
              </table>
                
              </div>
          </div>
          </div>
</div>


 

</div>



      
</div>
</section>
 </div>
 <div class="control-sidebar-bg"></div>
  </div>
  </body>
</html>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
   $("#mydate").datepicker().datepicker("setDate", new Date());
   $("#mydate1").datepicker().datepicker("setDate", new Date());


   Date.prototype.addDays = function(days) {
    this.setDate(this.getDate() + days);
    return this;
};
$(function() {

var currentDate = new Date();
 $('#datepicker').datepicker();
    $('#datepicker').datepicker('setDate', currentDate);

    $('#datepicker1').datepicker();
    $('#datepicker1').datepicker('setDate', currentDate);

});

</script>



<script>

    $(document).ready(function() {  
             $("#Type").change(function(){  
            //  alert("hiiii");
             /*dropdown post *///  
             $.ajax({  
                url:"<?php echo site_url('User/get_Requirement_Status'); ?>",  
                data: {id:  
                   $(this).val()},  
                type: "POST",  
                success:function(data){  
                $("#Status").html(data);  
             }  
          });  
       });  

});  

    function get_rest()
     {
      location.reload();

     }
    function search_Data()
    {
  //alert("dsfdfd");
        var from_date = document.getElementById('datepicker').value;
        //alert(from_date);
        var to_date = document.getElementById('datepicker1').value;
        var Type = document.getElementById('Type').value;
        var Status = document.getElementById('Status').value;

        if( from_date == "" && to_date == "")
        {
          alert("Please Select Date");
        }
        else
        {
           $.ajax({  
                  url:"<?php echo site_url('User/Search_Requirement'); ?>",  
                  data: {fdate: from_date,tdate: to_date,type: Type,Status: Status },  
                  type: "POST",  
                  success:function(data){ 
                  //alert(data);
                  $('#old').hide();
                  $('#fulldata').show();
                  $('#comments1').html(data);
                  $('#demoPostTable1').DataTable();

               }  
            }); 
        }

    }


  



</script>




          