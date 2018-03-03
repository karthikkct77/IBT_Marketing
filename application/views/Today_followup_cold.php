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
      <h1>
  Todays Client Scheduled Cold Call
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


         <table id="demoPostTable" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">



   <div class="row">
  
     
    

 
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
                                           
            <?php

                                        }
                                        else
                                        {
                                          ?>
                                           
            <?php

                                        }

 

                                        $i++;
                                    }
                                    ?>
                               

 
  
 
  </tbody>


  </table>
              </div>

           
        
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
