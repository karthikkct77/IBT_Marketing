<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>



<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">   
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
    $('#myTable').dataTable();
});

$(document).ready(function(){
    $('#myTable1').dataTable();
});
</script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      DND & CNE Review
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
               
                <div class="col-md-3">
                 <div class="form-group">
               
                  <select name="Company_country" class="form-control" id="country" required >
                    
                      <option value="No" >All Country</option>
           <?php foreach ($data_country_DND as $row):
            { 

                echo "<option value= " .$row['Country'].">" . $row['Country'] . "</option>";

           } 
           endforeach; ?>
           </select> 
                </div>
             
              </div>
              <div class="col-md-3">
                

               <div class="form-group">
              
                 <input  type="radio" id="ptype" name="type_radio"  value="DND"  checked="checked" > DND
                 <input  type="radio" id="ptype" name="type_radio"  value="CNE" > CNE
                 
                
            </div>  


           
              
             
             
              </div>
              
           

              <div class="col-md-3">
              <div class="form-group">
              
              <button type="button"  class="btn btn-info" onclick="search_dnd()" >Search</button>
             
              </div>
              </div>
          
          </div>
          </div>
</div>
</div>



 <div class="box box-primary" id="olddata" >
            
              <div class="box-body">
             
                <div class="row">
                <div class="col-md-12">
                 <table id="myTable" class="display table" width="100%" >
                <thead>
                <!--<th><input type="checkbox" id="selectall"/></th>-->
                <th>#</th>
                <th>Company Name</th>
                <th>Company URL</th>
                
                <th>Country</th>
                <th>Type</th>
                 <th>UserName</th>
                 <th>Status</th>
                <th>Edit</th>
               

                 
                </thead>
                <tbody>
                <?php 
                $i=1;
                foreach ($data_DND as $key) {
                  ?>
                  <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $key['Company_Name']; ?></td>
                  <td><a href="<?php echo $key['WebURL']; ?>" target="_blank"><?php echo $key['WebURL']; ?></a></td>
                  <td><?php echo $key['Country']; ?></td>
                  <td><?php echo $key['prospectData_Blocked_Type']; ?></td>
                  <td><?php echo $key['User_Name']; ?></td>





<?php 

if($key['prospectData_Blocked_Type'] == 'DND')
{
  if( $key['Blocked_Review_Status'] == 'Yes')
{

  ?>
  <td>Confirm  <?php echo $key['prospectData_Blocked_Type']; ?></td>
  <td></td>

  <?php
}
else
{
  ?>
   <td>Please Review</td>
    <td> <button id="myBtn" class="btn btn-success" value="<?php echo $key['Prospect_Icode']; ?>" 
                          onclick="Review_Data(this.value)" >Confirm</button>
                        
            </td>
   <?php
}
}
else
{
  if( $key['Blocked_Review_Status'] == 'Yes')
{

  ?>
  <td>Confirm  <?php echo $key['prospectData_Blocked_Type']; ?></td>
  <td></td>

  <?php
}
else
{
  ?>
   <td>Please Review</td>
    <td> <button id="myBtn" class="btn btn-success" value="<?php echo $key['Prospect_Icode']; ?>" 
                          onclick="Review_Data(this.value)" >Confirm</button>
                           <button name="client_id2" class="btn btn-info"   data-toggle="modal" data-target="#myModal1" 
                         onclick="getcurrent_data('<?php echo $key['Prospect_Icode'];?>')">Change</button>

            </td>
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
                
              </div>
          </div>
          </div>

</div>


          <div class="box box-primary" id="fulldata" style="display:none">
            
              <div class="box-body">

                <div class="row">
                <div class="col-md-12">
                 <table id="myTable1" class="display table" width="100%" >
                <thead>
              <th>#</th>
                <th>Company Name</th>
                <th>Company URL</th>
                
                <th>Country</th>
                <th>Type</th>
                 <th>UserName</th>
                 <th>Status</th>
                <th>Edit</th>

                 
                </thead>
                <tbody id="comments1">
               
                
                </tbody>
                
              </table>
                
              </div>
          </div>
          </div>
</div>


<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 60%;">
        <div class="modal-content" >
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Edit Prospect Data</h4>

            </div>
          
            
              
            <div class="modal-body" id="edit_code">
            
                 </div>
       
    </div>
</div>
</div>


</div>
</div>
</section>
 </div>





<script>

function search_dnd()
{

  var country = document.getElementById('country').value;

 
 var  type = document.querySelector('input[name="type_radio"]:checked').value;

 $.ajax({  
                         url:"<?php echo site_url('welcome/search_DND'); ?>",  
                        data: {country: country, type: type},  
                        type: "POST",  
                        success:function(data){ 

                         
                     $('#olddata').hide();
                      $('#fulldata').show();
                      $('#comments1').html(data)
                   

                     }  
                  }); 

  


}




 function getcurrent_data(id)
  {


      $.ajax({  
                         url:"<?php echo site_url('welcome/get_DND_CNE_Change_data'); ?>",  
                        data: {id: id},  
                        type: "POST",  
                        success:function(data){ 
 $("#edit_code").html(data);  
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




function Review_Data(id)
{

 var job = confirm("Are you sure you want to confirm This Data is DND/CNE ?");
    if(job!=true)
    {
        return false;
    }
    else
    {

     $.ajax({  
                         url:"<?php echo site_url('welcome/Review_DND_CNE'); ?>",  
                        data: {id: id},  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                         alert(" Success..");
                         document.location.reload(true);

                     }  
                  }); 
    }





}


function update_data()
{


   var pcode = document.getElementById('pcode').value;
   var Branch1 = document.getElementById('Branch').value;

    var  office1 = document.querySelector('input[name="office"]:checked').value;

    



   // var office1 = document.getElementById('office').value;
       var Building_Type1 = document.getElementById('Building_Type').value;
     var Address1 = document.getElementById('Address').value;
   var City1 = document.getElementById('City').value;
     var State1 = document.getElementById('State').value;
       var Email1 = document.getElementById('Email').value;
        var FB1 = document.getElementById('FB').value;
           var LinkedIn1 = document.getElementById('LinkedIn').value;
             var Time_Zone1 = document.getElementById('Time_Zone').value;
              var PC_Name1 = document.getElementById('PC_Name').value;
                 var Pc_Desig1 = document.getElementById('Pc_Desig').value;
                   var PC_Email1 = document.getElementById('PC_Email').value;
                     var Ph_No1 = document.getElementById('Ph_No').value;
                       var SC_Name1 = document.getElementById('SC_Name').value;
                        var Sc_Desig1 = document.getElementById('Sc_Desig').value;
                       var SC_Email1 = document.getElementById('SC_Email').value;
                       var SC_Ph_No1 = document.getElementById('SC_Ph_No').value;
                         // var Career1 = document.getElementById('Career').value;
                          var  Career1 = document.querySelector('input[name="Career"]:checked').value;



                       var Emp_Count1 = document.getElementById('Emp_Count').value;
                        var Prospect_Type1 = document.getElementById('Prospect_Type').value;
                      // var Product1 = document.getElementById('Product').value;
                        var  Product1 = document.querySelector('input[name="Product"]:checked').value;


                        var No_Products1 = document.getElementById('No_Products').value;
                          // var Domain1 = document.getElementById('Domain').value;
                           var  Domain1 = document.querySelector('input[name="Domain"]:checked').value;
                          //   var Web1 = document.getElementById('Web').value;
                              var  Web1 = document.querySelector('input[name="Web"]:checked').value;
                                var  custom1 = document.querySelector('input[name="Custom"]:checked').value;
                            //  var Mobile1 = document.getElementById('Mobile').value;
                               var  Mobile1 = document.querySelector('input[name="Mobile"]:checked').value;
                              // var ECommerce1 = document.getElementById('E-Commerce').value;
                                   var  ECommerce1 = document.querySelector('input[name="E-Commerce"]:checked').value;
                               var Technology_Info1 = document.getElementById('Technology_Info').value;


var bde = document.getElementById('BDE').value;

if(bde == "")
{
 alert("Please Select BDE");
}
else
{

  var pcode = document.getElementById('pcode').value;

   $.ajax({  
                         url:"<?php echo site_url('welcome/Review_DND_CNE_Update'); ?>",  
                        data: {id: pcode,bde: bde ,Branch: Branch1, office: office1, Building_Type: Building_Type1,Address:Address1,City: City1,State: State1,Email: Email1,FB: FB1,LinkedIn: LinkedIn1,Time_Zone: Time_Zone1,PC_Name: PC_Name1,Pc_Desig: Pc_Desig1,PC_Email: PC_Email1,Ph_No: Ph_No1,SC_Name: SC_Name1,Sc_Desig: Sc_Desig1,SC_Email: SC_Email1,SC_Ph_No: SC_Ph_No1,Career: Career1,Emp_Count: Emp_Count1,Prospect_Type: Prospect_Type1,Product: Product1,No_Products: No_Products1,Domain: Domain1,Web: Web1,Mobile: Mobile1,custom: custom1,ECommerce: ECommerce1,Technology_Info: Technology_Info1  },  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                         alert(" Success..");
                         document.location.reload(true);

                     }  
                  }); 
  


}
 
         
}
     
</script>  


 </body>
</html>

          