
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
   Cold Followup Data
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
                  <div class="row">
                  <div class="col-md-6">
                    <h3 class="box-title"><?php echo $show ?>- [<?php echo $count ?>]</h3>
                  </div>
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-2">
                  <input type="hidden" name="country" value="<?php echo $country; ?>">
                 <a href='<?php echo site_url('User/get_country_wise_called_data/'.$country.''); ?>'>Back</a>
                  </div>
             
            

              
              </div>
              
            <!-- /.box-header -->
            <div class="box-body">


            <table id="demoPostTable" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
 
 <thead>
    <tr>
        <th>#</th>
        <th>Company Name</th>
        <th>Web URL</th>
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
 $a=1;
foreach($details as $r) 
{
 
?>
<tr>
<td><?php echo $a; ?></td>
 <td><?php echo $r['Company_Name']; ?></td>  
 <td><?php echo $r['WebURL']; ?></td>            
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
$a++;
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

<script>function Cancel()
{
   window.location.href = document.referrer;
}</script>

</body>
</html>
