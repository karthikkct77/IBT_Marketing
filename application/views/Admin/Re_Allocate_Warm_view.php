
    <!-- CSS imports -->
    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
 

    <!-- datatable css -->
    <link href="http://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet">
    
    <!-- datatable responsive css -->
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/responsive/1.0.0/css/dataTables.responsive.css">

    
 
 <!-- JS imports -->
 
    <!-- jQuery JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

     <!-- bootstrap JS -->
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

    <!-- data table js -->
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    
    <!-- data table responsive js -->
    <script type="text/javascript" src="http://cdn.datatables.net/responsive/1.0.0/js/dataTables.responsive.min.js"></script>
    


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>

<script>
$(document).ready( function () {
 
    $('#demoPostTable').addClass( 'nowrap' ).DataTable( {
                    responsive: true
                });
 


} );

</script>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Re- Allocate Data

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
                    <h3 class="box-title"><?php echo $show ?> [<?php echo $count ?>]</h3>
                  </div>
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-2">
                  <input type="hidden" name="country" value="<?php echo $country; ?>">
                 <a href='<?php echo site_url('welcome/Re_allocate'); ?>'>Back</a>
                  </div>
             
            

              
              </div>

              
              <div class="row">
              <hr>

              </div>

               <div class="row">
               <div class="col-md-12">
            <div class="col-md-4">
            <div class="form-group">
           <input type="checkbox" id="chkPassport" />   Further Filtering
            </div>
                </div>
                </div>
                </div>

           


               <div class="row">

              
           
              
            <div class="col-md-12" id="client" style="display: none;" >
            <div class="col-md-6">


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
           <th>#</th>
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
             <td><h5><a href='<?php echo site_url('welcome/get_Re_Allocate_Product/'.$product['Country'].''); ?>'><?php echo $product['product']; ?></a></h5></td>
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

          
            </div>


            <div class="row" id="oldd">

             <div class="col-md-12">
              <h4> Selected  Count : <?php echo $count ?> </h4>

              </div>
            <div class="col-md-12" >

                        
                <div class="col-md-3">
                <div class="form-group">
                <label>Allot To</label>
                 
                  <select name="BDE" class="form-control" id="BDE"  required >
                     <option value="" >Select BDE</option>
           <?php foreach ($BDE as $row):
            { 

               // echo "<option value= " .$row['Mobile_Development'].">" . $row['Mobile_Development'] . "</option>";
                echo '<option value="'.$row['User_Icode'].'">'.$row['User_Name'].'</option>';

           } 
           endforeach; ?>
           </select> 
           </div>
              
                
                </div>
                <div class="col-md-3">
                <div class="form-group">

                <label>Allot</label>
                <input type="hidden" name="tot_length" id="tot_length" value="<?php echo $count; ?>">
                 
                <input type="text" name="Assign_record_count"  id="record_count" class="form-control" placeholder="Enter Number of Record" required >
                </div>
                </div>
                <div class="col-md-3">
                <div class="form-group">
                <label></label>
                 <button class="btn btn-success"  onclick="check_record()"  >Re Allot</button>
                </div>
                </div>
               

            </div>


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


<script type="text/javascript">
    $(function () {
        $("#chkPassport").click(function () {
            if ($(this).is(":checked")) {
                $("#client").show();
                $("#oldd").hide();

            } else {
                $("#client").hide();
                 $("#oldd").show();
            }
        });
    });
</script>








<script type="text/javascript">



 function check_record()
 {
  var data_length = parseInt(document.getElementById("tot_length").value);

  var  allocate_count = parseInt(document.getElementById("record_count").value);

  var bde = document.getElementById("BDE").value;


  //alert(data_length);
 // alert(allocate_count);


 if( bde != "")
 {


if(data_length >= allocate_count  )
  {
    
    $.ajax({  
                         url:"<?php echo site_url('welcome/Allocate_BDE_Re_Allocate'); ?>",  
                        data: {BDE: bde,tot_count: allocate_count },  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                         
                         
                          if(data == 1)
                          {
                            //$("#example").load(" #example");
                            alert("Update Success");
                             location.reload();
                          }
                          else
                          {

                          }
                     }  
                  }); 

  }
  else
  {
    alert("count failed");
    return false;
  }

 }
 else
 {
  alert("Please Select BDE");
 }

 }

</script>

</body>
</html>
