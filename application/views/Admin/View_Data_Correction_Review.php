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
     DATA CORRECTION
        <small></small>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements --> 
          <div class="row">
          <div class="col-md-12">

             <h3>BDE Name: <span><?php echo $name; ?></span></h3>
             <input type="hidden" name="pcode" id="pcode" value="<?php echo $pcode; ?>">
             <input type="hidden" name="dcode"  id="dcode" value="<?php echo $Dcode; ?>">
          </div>
          </div>
         


 <div class="box box-primary" id="olddata" >
            
              <div class="box-body">
             
                <div class="row">
                <div class="col-md-12">
                 <table id="myTable" class="display table" width="100%" >
                <thead>
                <!--<th><input type="checkbox" id="selectall"/></th>-->
                
                <th>Field</th>
                <th>Old Value</th>
                <th>New Value</th>
               
                
                
               

                 
                </thead>
                <tbody>
                <tr>
               
           <td>
                
                  <ul style="padding: 0;">
                  <?php 
               
                foreach ($field as $key) {
                  ?>
                    <li style="list-style: none; border-bottom: 1px solid #ccc; padding: 10px 0;"><?php echo $key; ?></li>
                     <?php

              
                }
                ?>
                  </ul>
                  
                 
                </td>

                        <td>
                
                  <ul style="padding: 0;">
                  <?php 
               
                foreach ($old as $key) {
                  ?>
                    <li style="list-style: none; border-bottom: 1px solid #ccc; padding: 10px 0;"><?php echo $key; ?></li>
                     <?php

              
                }
                ?>
                  </ul>
                  
                 
                </td>
                <td>
                
                  <ul style="padding: 0;">
                  <?php 
               
                foreach ($new as $key) {
                  ?>
                    <li style="list-style: none; border-bottom: 1px solid #ccc; padding: 10px 0;"><?php echo $key; ?></li>
                     <?php

              
                }
                ?>
                  </ul>
                  
                 
                </td>
                </tr>

                
              

               
                
                </tbody>
                
              </table>
                
              </div>
          </div>
          </div>
          <div class="row">
          <div class="col-md-12">
          <div class="col-md-8">
          </div>
          <div class="col-md-4">

          <button type="button"  class="btn btn-info"  data-toggle="modal" data-target="#myModal1"  onclick="getcurrent_data()" >Edit</button>
          <button type="button"  class="btn btn-success" onclick="approve()" >Approve</button>
          </div>
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
            <div class="modal-footer">
                 <button type="Submit" onclick="update_data()" class="btn btn-success" >Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
       
    </div>
</div>
</div>

</div>
</section>
 </div>




  <script type="text/javascript">  
                

function approve()
{

 var pcode = document.getElementById('pcode').value;
 var Dcode = document.getElementById('dcode').value;

 var job = confirm("Are you sure you want to confirm ");
    if(job!=true)
    {
        return false;
    }
    else
    {

     $.ajax({  
                         url:"<?php echo site_url('welcome/Approve_Correction'); ?>",  
                        data: {pcode: pcode,dcode: Dcode },  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                         alert(" Success..");
                          window.location.href = document.referrer;

                     }  
                  }); 
    }





}




 function getcurrent_data()
  {
 var pcode = document.getElementById('pcode').value;
  var Dcode = document.getElementById('dcode').value;

      $.ajax({  
                         url:"<?php echo site_url('welcome/Edit_Data_Correction'); ?>",  
                       data: {pcode: pcode,dcode: Dcode },  
                        type: "POST",  
                        success:function(data){ 
 $("#edit_code").html(data);  
                     }  
                  }); 
  }



function update_data()
{



 
    var Dcode = document.getElementById('dcode').value;
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


var job = confirm("Are you sure you want to confirm ?");
    if(job!=true)
    {
        return false;
    }
    else
    {

     $.ajax({  
                         url:"<?php echo site_url('welcome/Update_Data_Correction'); ?>",  
                        data: {
                          prospect_Icode: pcode,Branch: Branch1, office: office1, Building_Type: Building_Type1,Address:Address1,City: City1,State: State1,Email: Email1,FB: FB1,LinkedIn: LinkedIn1,Time_Zone: Time_Zone1,PC_Name: PC_Name1,Pc_Desig: Pc_Desig1,PC_Email: PC_Email1,Ph_No: Ph_No1,SC_Name: SC_Name1,Sc_Desig: Sc_Desig1,SC_Email: SC_Email1,SC_Ph_No: SC_Ph_No1,Career: Career1,Emp_Count: Emp_Count1,Prospect_Type: Prospect_Type1,Product: Product1,No_Products: No_Products1,Domain: Domain1,Web: Web1,Mobile: Mobile1,custom: custom1,ECommerce: ECommerce1,Technology_Info: Technology_Info1,dcode: Dcode  },  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                         
                         alert("Data Update Success..");
                        window.location.href = document.referrer;

                     }  
                  }); 
    }

 
         
}
     
</script>  


 </body>
</html>

          