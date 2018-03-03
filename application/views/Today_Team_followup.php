<script>
$(document).ready( function () {
 
    $('#demoPostTable').addClass( 'nowrap' ).DataTable( {
                    responsive: true
                });
 


} );
$(document).ready(function(){
    $('#myTable').DataTable();
});
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
  Todays Team Followup 
        <small></small>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
     

            <!-- form start -->
          

        <div>



            <div class="box">
            <div class="box-header">
                  <div class="modal-body" ><p></p></div>
             
              <h3 class="box-title"></h3>
              
            <!-- /.box-header -->
            <div class="box-body">
<table id="demoPostTable"  data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
 <thead>
    <tr>
        <th>#</th>
        <th>Company Name</th>
        <th>Phone Number</th>
        <th>Client Date/Time</th>
        <th>Our Date/Time</th>
        <th>Prospect_Status</th>
       
        <th>BDE Name</th>
        <th></th>
       
    </tr>
    </thead>
 
         
 <tbody>
  <?php
                   $i=1;
                                 
                                    foreach($team_followup as $r)
                                    {
                                      ?>
                                       

                                       
                                          <tr >
    <td><?php echo $i; ?></td>

 <td><?php echo $r['Company_Name']; ?><br><?php echo $r['WebURL']; ?><br><?php echo $r['Country']; ?></td>  
        
                    <td><?php echo $r['Company_Contact']; ?></td>
                       
                         
                       <td><?php echo $r['Next_Call_Date']; ?></td>
                        <td><?php echo $r['Equiv_our_date']; ?></td>
                         <td><?php echo $r['Prospect_Status']; ?></td>  
                           <td><?php echo $r['User_Name']; ?></td>  


                         


                                           
                                            <?php 
                                            if( $r['Meeting_Type_Icode'] != "0")
                                            {
                                                ?>
                                                 <td>
                                                <a class="btn btn-primary" href="<?php echo site_url('User/Meeting_Call/'. $r['Prospect_Icode'].''); ?>" > <i class="glyphicon glyphicon-zoom-in icon-white"></i> Meeting
            </a></td>
                                               
                                                <?php

                                            }
                                            else
                                            {

                                              if($r['Prospect_Status'] == 'Cold')
                                              {
                                                ?>
                                                <td>
                                                <a class="btn btn-success" href="<?php echo site_url('User/Prospect_Data_Call_Client_date/'. $r['Prospect_Icode'].''); ?>" > <i class="glyphicon glyphicon-zoom-in icon-white"></i> Call
            </a></td>
            <?php
          }
          else
          {
            ?>
         



                                             
                                              <td>  <a class="btn btn-success" href="<?php echo site_url('User/Warm_Data_Call_Client_date/'. $r['Prospect_Icode'].''); ?>" > <i class="glyphicon glyphicon-zoom-in icon-white"></i> Call
            </a></td>
                                               
                                                <?php
                                              }


                                            }
                                            ?>

            </tr>
            <?php
            
                                        $i++;
                                    }
                                    ?>
                               

 
  
 
  </tbody>


  </table>
   
           
        
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  


  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

</body>
</html>
