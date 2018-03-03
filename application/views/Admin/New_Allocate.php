<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      New Data Allocation
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
              <?php if($this->session->flashdata('message')){?>
          <div class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } ?>
            <!-- /.box-header -->
         
              <div class="box-body">
                <div class="row">
                <div class="col-md-12">
                 <form id="search_form">
                <div class="col-md-3">
                 <div class="form-group">
               
                  <select name="Company_country" class="form-control" id="country" required >
                     <option value="" >Select Country</option>
           <?php foreach ($data_country as $row):
            { 

              // echo "<input type='text' value=".$row['Country']."/>";

                echo "<option value= '" .$row['Country']."'>" . $row['Country'] . "</option>";

           } 
           endforeach; ?>
           </select> 
                </div>
             
              </div>
              <div class="col-md-3">
                 <div class="form-group">


                     <select name="state" id="state" class="form-control">
          
           </select> 
           
              
             
              </div>
              </div>
               <div class="col-md-3">
                 <div class="form-group">


                     <select name="City" id="city" class="form-control">
          
           </select> 
           
              
             
              </div>
              </div>
             
              <div class="col-md-3">
                 <div class="form-group">
               
                  <select name="Company_Time" class="form-control" id="Time"  >
                     <option value="" >Select Time_Zone</option>
           <?php foreach ($Data_Timezone as $row):
            { 

               // echo "<option value= " .$row['Time_Zone'].">" . $row['Time_Zone'] . "</option>";
                echo '<option value="'.$row['Time_Zone'].'">'.$row['Time_Zone'].'</option>';


           } 
           endforeach; ?>
           </select> 
                </div>
             
              </div>
              <div class="col-md-3">
                 <div class="form-group">
               
                  <select name="Company_Count" class="form-control" id="Count"  >
                     <option value="" >Select Emp_Count</option>
           <?php foreach ($Data_Emp_count as $row):
            { 

                //echo "<option value= " .$row['Emp_Count'].">" . $row['Emp_Count'] . "</option>";
                echo '<option value="'.$row['Emp_Count'].'">'.$row['Emp_Count'].'</option>';

           } 
           endforeach; ?>
           </select> 
                </div>
             
              </div>
              <div class="col-md-3">
                 <div class="form-group">
               
                  <select name="Company_PType" class="form-control" id="Type"  >
                     <option value="" >Select Prospect Type</option>
           <?php foreach ($Data_pros_type as $row):
            { 

                //echo "<option value= " .$row['Prospect_Type'].">" . $row['Prospect_Type'] . "</option>";
                echo '<option value="'.$row['Prospect_Type'].'">'.$row['Prospect_Type'].'</option>';

           } 
           endforeach; ?>
           </select> 
                </div>
             
              </div>
              <div class="col-md-3">
                 <div class="form-group">
              
                  <select name="Company_Product" class="form-control" id="Product" >
                     <option value="" >Select Product</option>
           <?php foreach ($Data_product as $row):
            { 

               // echo "<option value= " .$row['Product_Development'].">" . $row['Product_Development'] . "</option>";
                echo '<option value="'.$row['Product_Development'].'">'.$row['Product_Development'].'</option>';

           } 
           endforeach; ?>
           </select> 
                </div>
             
              </div>
              <div class="col-md-3">
                 <div class="form-group">
              
                  <select name="Company_custom" class="form-control" id="Custom" >
                     <option value="" >Select Custom</option>
           <?php foreach ($Data_custom as $row):
            { 

               // echo "<option value= " .$row['Custom_Development'].">" . $row['Custom_Development'] . "</option>";
                echo '<option value="'.$row['Custom_Development'].'">'.$row['Custom_Development'].'</option>';

           } 
           endforeach; ?>
           </select> 
                </div>
             
              </div>
              <div class="col-md-3">
                 <div class="form-group">
              
                  <select name="Company_Web" class="form-control" id="Web" >
                     <option value="" >Select Web Development</option>
           <?php foreach ($Data_web as $row):
            { 

                //echo "<option value= " .$row['Web_Development'].">" . $row['Web_Development'] . "</option>";
                echo '<option value="'.$row['Web_Development'].'">'.$row['Web_Development'].'</option>';

           } 
           endforeach; ?>
           </select> 
                </div>
             
              </div>
              <div class="col-md-3">
                 <div class="form-group">
              
                  <select name="Company_Mobile" class="form-control" id="Mobile" >
                     <option value="" >Select Mobile</option>
           <?php foreach ($Data_mobile as $row):
            { 

               // echo "<option value= " .$row['Mobile_Development'].">" . $row['Mobile_Development'] . "</option>";
                echo '<option value="'.$row['Mobile_Development'].'">'.$row['Mobile_Development'].'</option>';

           } 
           endforeach; ?>
           </select> 
                </div>
             
              </div>
              <div class="col-md-3">
                 <div class="form-group">
              
                  <select name="Company_Commerce" class="form-control" id="Commerce" >
                     <option value="">Select E-Commerce</option>
           <?php foreach ($Data_Ecomm as $row):
            { 

                //echo "<option value= " .$row['Ecommerce_Development'].">" . $row['Ecommerce_Development'] . "</option>";
                echo '<option value="'.$row['Ecommerce_Development'].'">'.$row['Ecommerce_Development'].'</option>';

           } 
           endforeach; ?>
           </select> 
                </div>
             
              </div>

              <div class="col-md-3">
              <div class="form-group">
              
              <button type="button"  class="btn btn-info" id="test" >Search</button>
               <button type="button"  class="btn btn-info" onclick="get_rest()" >Reset</button>
              </div>
              </div>
              </form>
          </div>
          </div>
</div>
</div>

          <div class="box box-primary" id="fulldata" style="display:none">
            
              <div class="box-body">
              <div class="row">
              <div class="col-md-3">
             <button name="client_id2" class="btn btn-default btn-sm"   data-toggle="modal" data-target="#myModal1" 
                         onclick="getcurrent_data()"> View Current Data</button>
              </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                <div class="form-group">
                <h4>Total Records<h3 id="length"></h3></h4>
                </div>
                </div>
                <form method="post" role="form" action="<?php echo site_url('welcome/Allocate_BDE'); ?>"  onsubmit="return check_record()" enctype="multipart/form-data" name="data_register">
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
                <input type="hidden" name="tot_length" id="tot_length">
                <input type="text" name="Assign_record_count"  id="record_count" class="form-control" placeholder="Enter Number of Record" required >
                </div>
                </div>
                <div class="col-md-3">
                <div class="form-group">
                <label></label>
                 <button type="submit" class="btn btn-success"  >Allot</button>
                </div>
                </div>
                </form>
              </div>
                <div class="row">
                <div class="col-md-12">
                 <table id="demoPostTable1" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead>
                <!--<th><input type="checkbox" id="selectall"/></th>-->
             
                <th>Company Name</th>
                <th>Company URL</th>
                <th>Contact Number</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Employee Count</th>

                 
                </thead>
                <tbody id="comments1">
               
                
                </tbody>
                
              </table>
                
              </div>
          </div>
          </div>
</div>


<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Current Data Details</h4>

            </div>
            <div class="modal-body">



             <table id="demoPostTable2" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
               
                
              </table>
             
              



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             
        </div>
    </div>
</div>
</div>



</div>
</div>
</section>
 </div>


<script>
$("#test").click(function() {

  

  var cc = $('#country :selected').val();

  var  aa    = cc.replace(' ','');

  alert(aa);



    var form_data = {
       country: $('#country :selected').val(),
                                state:$('#state :selected').val(), 
                              City:$('#city :selected').val(),
                            Time:$('#Time :selected').val(),
                            Count:$('#Count :selected').val(),
                            Type:$('#Type :selected').val(),
                            Product:$('#Product :selected').val(),
                            Custom:$('#Custom :selected').val(),
                            Web:$('#Web :selected').val(),
                            Mobile:$('#Mobile :selected').val(),
                            Commerce:$('#Commerce :selected').val() ,
        ajax: '1'
    };

    $.ajax({
        url: "<?php echo site_url('welcome/get_data'); ?>",
        type: 'POST',
        data: form_data,
        cache: false,
        success: function(server_response) {


            var data = $.parseJSON(server_response);

            if(data == '')
            {
              alert("Record Not Found...");
            }
            else
            {
                var length = data.length;
           document.getElementById('tot_length').value = length;
            $("#length").html(length);

            
            $("#fulldata").toggle();

            for(var i = 0; i < data.length; i++){
                week = data[i];
                $("#comments1").append("<tr><td>" + week.Company_Name + "</td><td>" + week.WebURL+ "</td><td>" + week.Company_Contact+ "</td><td>" + week.Country+ "</td><td>" + week.State+ "</td><td>" + week.City+ "</td><td>" + week.Emp_Count + "</td></tr>");
            };

            }


          
        },
        error: function(thrownError) {
            alert(thrownError);
        }
    });

    return false;
})
</script>


<script>
 function getcurrent_data()
  {


      $.ajax({  
                         url:"<?php echo site_url('welcome/view_current_data'); ?>",  
                        data: {id: '1'},  
                        type: "POST",  
                        success:function(data){ 

                         
                       $("#demoPostTable2").html(data);  
                      $('#myModal1').modal('show');
                     }  
                  }); 
  }

function get_rest()
 {
  location.reload();

 }


 function check_record()
 {
  var data_length = parseInt(document.getElementById("tot_length").value);

  var  allocate_count = parseInt(document.getElementById("record_count").value);
  //alert(data_length);
 // alert(allocate_count);

  if(data_length >= allocate_count)
  {
    return true;
  }
  else
  {
    alert("count failed");
    return false;
  }

 }


  </script>

  <script type="text/javascript">  
                  $(document).ready(function() {  
                     $("#country").change(function(){  
                    //  alert("hiiii");
                     /*dropdown post *///  
                     $.ajax({  
                        url:"<?php echo site_url('welcome/get_country_state'); ?>",  
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
                        url:"<?php echo site_url('welcome/get_state_city'); ?>",  
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

          