     
<style>
h2{
  background: #eef0f8;
  color:#ba0a0a;
  text-shadow:1px 1px 10px #181414, 1px 1px 10px #ccc;
  font-size:30px;
  text-align: center;
 
}

       

.flash {
   animation-name: flash;
    animation-duration: 0.5s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    animation-direction: alternate;
    animation-play-state: running;
}


.funkyradio div {
  clear: both;
  overflow: hidden;
}

.funkyradio label {
  width: 100%;
  border-radius: 3px;
  border: 1px solid #D1D3D4;
  font-weight: normal;
}

.funkyradio input[type="radio"]:empty,
.funkyradio input[type="checkbox"]:empty {
  display: none;
}

.funkyradio input[type="radio"]:empty ~ label,
.funkyradio input[type="checkbox"]:empty ~ label {
  position: relative;
  line-height: 2.5em;
  text-indent: 3.25em;
  margin-top: 2em;
  cursor: pointer;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}

.funkyradio input[type="radio"]:empty ~ label:before,
.funkyradio input[type="checkbox"]:empty ~ label:before {
  position: absolute;
  display: block;
  top: 0;
  bottom: 0;
  left: 0;
  content: '';
  width: 2.5em;
  background: #D1D3D4;
  border-radius: 3px 0 0 3px;
}

.funkyradio input[type="radio"]:hover:not(:checked) ~ label,
.funkyradio input[type="checkbox"]:hover:not(:checked) ~ label {
  color: #888;
}

.funkyradio input[type="radio"]:hover:not(:checked) ~ label:before,
.funkyradio input[type="checkbox"]:hover:not(:checked) ~ label:before {
  content: '\2714';
  text-indent: .9em;
  color: #C2C2C2;
}

.funkyradio input[type="radio"]:checked ~ label,
.funkyradio input[type="checkbox"]:checked ~ label {
  color: #777;
}

.funkyradio input[type="radio"]:checked ~ label:before,
.funkyradio input[type="checkbox"]:checked ~ label:before {
  content: '\2714';
  text-indent: .9em;
  color: #333;
  background-color: #ccc;
}

.funkyradio input[type="radio"]:focus ~ label:before,
.funkyradio input[type="checkbox"]:focus ~ label:before {
  box-shadow: 0 0 0 3px #999;
}

.funkyradio-default input[type="radio"]:checked ~ label:before,
.funkyradio-default input[type="checkbox"]:checked ~ label:before {
  color: #333;
  background-color: #ccc;
}

.funkyradio-primary input[type="radio"]:checked ~ label:before,
.funkyradio-primary input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #337ab7;
}

.has-error .form-control {
  border-color: #F00;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
}
.has-error .form-control:focus {
  border-color: #F00;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #c35e5e;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #c35e5e;
}
.box-body.custom h5, .box-body.custom table{
margin: 0;
}
.box-body.custom{
  padding: 0 10px;
}


@keyframes flash {
    from {color: #00ff0c;}
    to {color: #b1160a;}
}
</style>





<div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <?php 
                      if(isset($company_details) && is_array($company_details) && count($company_details)): $i=1;
                        foreach ($company_details as $key ) {


                          ?>
                          <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 60%;">
        <div class="modal-content" >
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Company Details</h4>

            </div>
          
            <div class="modal-body" id="dndid">
           
            <table id="demoPostTable" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
 
 <thead>
    <tr>
    
        <th>Address</th>
        <th>Social Media</th>
        
      
       
    </tr>
    </thead>
 
 
 <tbody>
 <tr>
   <td><?php echo $key['Address'];  ?><br>
   <?php echo $key['City'];  ?><br>
   <?php echo $key['State'];  ?></td>
   <td> <?php if($key['FB_URL'] == '')
            { ?>
               NIL | 
               
               <?php
            }
            else
            {?>
              <a target="_blank"  href="<?php echo $key['FB_URL']  ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a> | 
              
              <?php
            }
            ?>
             <?php if($key['LinkedIn_URL'] == '')
            { ?>
               NIL
               
               <?php
            }
            else
            {?>
              <a  target="_blank" href="<?php echo $key['LinkedIn_URL']  ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
              
              <?php
            }
            ?></td>
 </tr>
  </tbody>


  </table>

            
            </div>
            <div class="modal-footer">
            
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
      
    </div>
</div>
</div>

    <div class="row">
    <div class="col-md-8">

    <?php
    if($key['Marketing_Prospect_Type'] == 'Above Average' || $key['Marketing_Prospect_Type'] == 'Good' )
    {
      ?>
        <h4 class="flash" style="text-align: center;"> <?php echo $key['Company_Name'];  ?> ( <a  class="flash"  target="_blank" href="<?php echo $key['WebURL']  ?>"><?php echo $key['WebURL'];  ?></a> )~<?php echo $key['Company_Contact'];  ?>~<?php echo $key['Country'];  ?> </h4>
        <?php

    }
    else
    {
      ?>
      <h4 style="text-align: center;"> <?php echo $key['Company_Name'];  ?> ( <a  target="_blank" href="<?php echo $key['WebURL']  ?>"><?php echo $key['WebURL'];  ?></a> )~<?php echo $key['Company_Contact'];  ?>~<?php echo $key['Country'];  ?> </h4>
      <?php
    }
    ?>
   
    
    
    </div>
    <div class="col-md-4"> 
      <small><?php echo $increment + 1; ?>  out of  <?php echo $Total_data ?></small>
      </div>
    </div>
        


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
        <div class="col-md-8">
         <div class="box box-primary">
          
           <h4 style="background-color: #f5d4c2;">Prospect Details - <?php echo $key['prospect_Category'];  ?></h4>
           
            <div class="box-body custom">
            
            <div class="row">
            <div class="col-md-12">
            <div class="col-md-3">
           
               
               <h5>Email: <?php echo $key['Company_Email'];  ?></h5>

              </div>
              
           
             <div class="col-md-3">
             <h5> PC: <?php echo $key['PC_Name'];  ?>(<?php echo $key['PC_Desig'];  ?>)</h5>
            
            
           
             
            </div>
             <div class="col-md-2">
              <h5>SC:<?php echo $key['SC_Name'];  ?>(<?php echo $key['SC_Desig'];  ?>)</h5>

            </div>
           
            <div class="col-md-3">
             <h5>TS : <?php echo $key['Emp_Count'];  ?> | <?php if($key['Career_Section'] == 1)
            { ?>
               Career Page : YES
               
               <?php
            }
            else
            {?>
              Career Page : NO
              
              <?php
            }
            ?>
            </h5>
               
            
            
            

              
            </div>
              <div class="col-md-1">
            <a data-toggle="modal" data-target="#myModal3"    >Other</a>
            </div>
            </div>
            
            </div>
          
            <div class="row" id="DA" style="display: none;">

             <h4 style="padding-left: 10px;background-color: #f5d4c2; display: inline-block; width: 100%;"><p style="float: left; margin: 0;">Data Team Assessment</p> <a  onclick="Show_market()" style="float: right;">Marketing Team Assessment</a></h4>

            
            <table id="demoPostTable" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
 
 <thead>
    <tr>
    
        <th>Product</th>
        <th>No.of Product</th>
        <th>Domain</th>
        <th>Custom</th>
        <th>Web</th>
        <th>Mobile</th>
        <th>E-Commerce</th>
      
       
    </tr>
    </thead>
 
 
 <tbody>

<tr>
<?php
 if($key['Product_Development'] == '1')
          {
            ?>
              <td>Yes</td>  
              <?php
          }
          else
          {
            ?>
          <td>No</td>
          <?php 
          }
          ?>
          <td><?php echo $key['Products_Count'];  ?></td>
          <?php
          if($key['Domain'] == '1')
          {
            ?>
              <td>Yes</td>  
              <?php
          }
          else
          {
            ?>
          <td>No</td>
          <?php 
          }
          ?>
           <?php
          if($key['Custom_Development'] == '1')
          {
            ?>
              <td>Yes</td>  
              <?php
          }
          else
          {
            ?>
          <td>No</td>
          <?php 
          }
          ?>
           <?php
          if($key['Web_Development'] == '1')
          {
            ?>
              <td>Yes</td>  
              <?php
          }
          else
          {
            ?>
          <td>No</td>
          <?php 
          }
          ?>
           <?php
          if($key['Mobile_Development'] == '1')
          {
            ?>
              <td>Yes</td>  
              <?php
          }
          else
          {
            ?>
          <td>No</td>
          <?php 
          }
          ?>
           <?php
          if($key['Ecommerce_Development'] == '1')
          {
            ?>
              <td>Yes</td>  
              <?php
          }
          else
          {
            ?>
          <td>No</td>
          <?php 
          }
          ?>

 
                          

    </tr>

  </tbody>


  </table>
              
            </div>

            <div class="row" id="MA">
           
           

             <h4 style="padding-left: 10px;background-color: #f5d4c2; display: inline-block; width: 100%;"><p style="float: left; margin: 0;">Marketing Team Assessment</p> <a  onclick="Show()" style="float: right;">Data Team Assessment</a></h4>

         
          

            
            <table id="demoPostTable" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
 
 <thead>
    <tr>
    
        
        <th>Services</th>
        <th>Approch</th>
         <th>Industry</th>
         <th>Domain</th>
         <th>Type</th>
      
       
    </tr>
    </thead>
 
 
 <tbody>

<tr>


<td><?php echo $key['Marketing_Services'];  ?></td>
<td><?php echo $key['Marketing_Approch'];  ?></td>
<td><?php echo $key['Industry_Name'];  ?></td>
<td><?php echo $key['domain'];  ?></td>
<td style="background-color: #ea350f;
color: #f9f5ee;"><h4><?php echo $key['Marketing_Prospect_Type'];  ?></h4></td>

                          

    </tr>

  </tbody>


  </table>
              
            </div>

            <div class="row">
             <form method="post" id="login_form" role="form" action="<?php echo site_url('User/Prospect_Data_Call_status'); ?>" onSubmit="return checkSubmit()" name="data_register">
              <h4 style="padding-left: 10px;background-color: #f5d4c2;">Call Result</h4>
            
            <div class="col-md-4">
             <div class="form-group">
         
                  <select name="Result" class="form-control" id="country" required="" >
                   <option value="" >Select Call Result</option>
                   <option value="No Response" >No Response</option>
                     <option value="VM" >VM</option>
                      <option value="Spoke to FO & VM" > Spoke to FO & VM</option>
                       <option value="Spock with DM" >Spoke with DM</option>
                        <option value="Other" > Spoke with Others</option>
           
           </select> 
                </div>
            </div>
            <div class="col-md-4">

               <div class="form-group">
                <label>Prospect Type</label>
              
                <input type="hidden" name="prospect_Icode"  value="<?php echo $key['Prospect_Icode'];  ?>">
            
                 <input  type="radio" id="ptype" name="Prospect_Status" <?php echo ($key['Prospect_Status'] =='Cold')?'checked':'' ?> value="Cold" required="" > Cold
                 <input  type="radio" id="ptype" name="Prospect_Status" <?php echo ($key['Prospect_Status'] =='Warm')?'checked':'' ?> value="Warm" required=""> Warm
                 <input  type="radio" id="ptype"  name="Prospect_Status" <?php echo ($key['Prospect_Status'] =='Hot')?'checked':'' ?> value="Hot" required=""> Hot
                
            </div>  

            </div>

            <div class="col-md-4">
            <?php
            if($key['Next_Call_Date_Client'] == 'No')
            {
              ?>
              <input type="hidden" name="Scheduled_date" id="scheduled" value="0">
              <?php

            }
            else
            {
              ?>
              <input type="text" name="Scheduled_date" id="scheduled" value="<?php echo $key['Equiv_our_date']; ?>" disabled>
              <?php
            }
            ?>
            </div>
            </div>
            
            <div class="row">
            <div class="col-md-4">
            <div class="form-group">
            <input type="checkbox" name="Check"  id="checkbox1" value="Yes" /> Scheduled Client Call
            </div>
                </div>
              
            <div class="col-md-8" id="client" style="display: none;" >
            <div class="col-md-4" >
           <label>Client Date</label>
                 <div class="form-group">
                 
            <div class="input-group date" id="datetimepicker2">
                <input type="text" id="client_date" name="client_date" class="form-control"   />  <span class="input-group-addon"><span class="glyphicon-calendar glyphicon" ></span></span>
         
        </div>
            </div>
            </div>
             <div class="col-md-4" >
               <label>Equiv Our_Date/Time</label>
                 <div class="form-group">
              
            <div class="input-group date" id="datetimepicker3">
                <input type="text" id="equal_our_date"  name="equal_our_date" class="form-control"  />  <span class="input-group-addon"><span class="glyphicon-calendar glyphicon" ></span></span>
           
        </div>
            </div>
            </div>
            </div>
            </div>
       
            <div class="row">

                 <div class="form-group">
                    
                <textarea class="form-control" id="cmmd" name="Comment" placeholder="Call / Comments" required="" ></textarea>

                  <input type="hidden" id="next" name="nextval1" value="<?php echo $increment ?>">
           
                </div>
                </div>

                <div class="row">
              <div class="col-md-9">
               



              </div>
             <?php

             if($key['Next_Call_Date_Client'] != 'Yes')
             {
               if($key['Prospect_Status'] == 'New')
               {


              ?>

             <div class="col-md-3">
 <img src="<?php echo base_url('img/ajax-loader.gif'); ?>" id="gif" style="display: block; margin: 0 auto; width: 200px; visibility: hidden;">
                <button type="submit" class="btn btn-success"  >Save/Next</button>
       
            
            </div>

          </div>
          </form>
        


             <?php
           }else
           {
            ?>
              <div class="col-md-3">
              
            <input type="hidden" name="nextval" value="<?php echo $increment ?>">
             <img src="<?php echo base_url('img/ajax-loader.gif'); ?>" id="gif" style="display: block; margin: 0 auto; width: 200px; visibility: hidden;">
            <button type="button" class="btn btn-info"  onclick="save_client_based_call()" >Save</button>
           <button type="button" class="btn btn-default"  onclick="Cancel()" >Cancel</button>
            
             </div>
              </div>
              
             <?php
           }
             }
             else
             {

              ?>
  <div class="col-md-3">
              
            <input type="hidden" name="nextval" value="<?php echo $increment ?>">
             <img src="<?php echo base_url('img/ajax-loader.gif'); ?>" id="gif" style="display: block; margin: 0 auto; width: 200px; visibility: hidden;">
            <button type="button" class="btn btn-info"  onclick="save_client_based_call()" >Save</button>
            <button type="button" class="btn btn-default"  onclick="Cancel()" >Cancel</button>
            
             </div>
              </div>
              

             <?php
             }
             ?>
        
      
            </div>


            <div class="row">
            <div class="col-md-12">
              <div class="col-md-3">
             
           <input type="hidden" name="prospect_Icode" id="pcode" value="<?php echo $key['Prospect_Icode'];  ?>">
             <button  class="btn btn-default btn-sm"   data-toggle="modal" data-target="#myModal1" 
                         onclick="getcurrent_data()">Data Correction</button>

                        
             
            <input type="hidden" name="prospect_Icode" value="<?php echo $key['Prospect_Icode'];  ?>">
            <button  class="btn btn-default" data-toggle="modal" data-target="#myModal2"  >DND & CNE</button>
            </div>

            </div>

            </div>




            <?php } else: ?>
                <tr>
                    <td colspan="7" align="center" >Please Search Again</td>
                    <form method="post" role="form" action="<?php echo site_url('User/cold_calling'); ?>" name="data_register">
            <input type="hidden" name="nextval" value="<?php echo $increment ?>">
            <button type="submit" class="btn btn-info" >Search</button>
             </form>

          
                </tr>
                 </div>
         
                <?php
                    endif;
                ?>







              </div>
        </div>



       
         <div class="col-md-4">

         <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">History</h3>

                 
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="height: 425px">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages" style="height: 425px">
                    <!-- Message. Default to the left -->
                    <?php 
                      if(isset($history) && is_array($history) && count($history)): $i=1;
                        foreach ($history as $key ) {
                          ?>
                    <div class="direct-chat-msg">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left"><?php echo $key['User_Name'] ?></span>
                        <span class="direct-chat-timestamp pull-right"><?php echo $key['Call_Date'] ?></span>
                      </div>
                      <!-- /.direct-chat-info -
                      <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                      <?php echo $key['Prospect_Call_Comments'] ?>
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <?php
                  }
                   else:
                  ?>
                <tr>
                    <td colspan="7" align="center" >No Record Found</td>
                </tr>
                <?php
                    endif;
                ?>
                  
                  </div>
                  <!--/.direct-chat-messages-->

                  <!-- Contacts are loaded here -->
                  
                  <!-- /.direct-chat-pane -->
                </div>
                <!-- /.box-body -->
               
                <!-- /.box-footer-->
              </div>
        </div>
        </div>
        </section>
        </div>

        





        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 60%;">
        <div class="modal-content" >
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Edit Prospect Data</h4>

            </div>
          
            
              <input type="hidden" name="prospect_Icode" id="pcode" value="<?php echo $key['Prospect_Icode'];  ?>">
            <div class="modal-body" id="edit_code">
            
            </div>
            <div class="modal-footer">
                 <button type="Submit" onclick="update_data()" class="btn btn-success" >Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
       
    </div>
</div>
</div>
  
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 60%;">
        <div class="modal-content" >
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">DND/CNE</h4>

            </div>
          
            <div class="modal-body" id="dndid">
            <h4>Please Select Any one </h4>
         
            <input type="hidden" name="prospect_Icode" id="pcode" value="<?php echo $key['Prospect_Icode'];  ?>">
       
            <input type="radio" name="type_radio" id="radio1" value="DND" />Do Not Disturb [DND]  <br>
           
    
            <input type="radio" name="type_radio" id="radio" value="CNE" />Client Does Not Exit [No Company - May br Closed]
           
 
        </div>
              


            
            </div>
            <div class="modal-footer">
                <button type="Submit" class="btn btn-success" onclick="updatednd()">Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
      
    </div>
</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>

<script type="text/javascript">
  $('#datetimepicker1').datetimepicker({format : "DD/MM/YYYY hh:mm A"});
$('#datetimepicker2').datetimepicker({format : "DD/MM/YYYY hh:mm A"});
$('#datetimepicker3').datetimepicker({format : "DD/MM/YYYY hh:mm A"});



 $(document).ready(function() {

  $('#checkbox1').change(function(){
if(this.checked)
 $("#client").show();
else
 $("#client").hide();

});


   
});
</script>
        <script>
 function getcurrent_data()
  {

    var pcode = document.getElementById('pcode').value;


      $.ajax({  
                         url:"<?php echo site_url('User/Update_prospect_data'); ?>",  
                        data: {id: pcode},  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                            $("#edit_code").html(data);  
                      $('#myModal1').modal('show');
                     }  
                  }); 
  }


function check_record()
 {
  
  var job = confirm("Are you sure you want to move DND & CNE List ?");
    if(job!=true)
    {
        return false;
    }
    else
    {
      return true;
    }

 }

 function check_record_update()
 {
  
  var job = confirm("Are you sure you want to Update Data ?");
    if(job!=true)
    {
        return false;
    }
    else
    {

    
      return true;
    }

 }


function updatednd()
{


  BlockType = document.querySelector('input[name="type_radio"]:checked').value;



   var pcode = document.getElementById('pcode').value;
  
    
  

var job = confirm("Are you sure you want to confirm ?");
    if(job!=true)
    {
        return false;
    }
    else
    {

     $.ajax({  
                         url:"<?php echo site_url('User/Prospect_Data_DND_CNE'); ?>",  
                        data: {prospect_Icode: pcode,Btype: BlockType },  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                         alert("Data Blocked Success..");
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


var job = confirm("Are you sure you want to confirm ?");
    if(job!=true)
    {
        return false;
    }
    else
    {

     $.ajax({  
                         url:"<?php echo site_url('User/Edit_data_updation'); ?>",  
                        data: {
                          prospect_Icode: pcode,Branch: Branch1, office: office1, Building_Type: Building_Type1,Address:Address1,City: City1,State: State1,Email: Email1,FB: FB1,LinkedIn: LinkedIn1,Time_Zone: Time_Zone1,PC_Name: PC_Name1,Pc_Desig: Pc_Desig1,PC_Email: PC_Email1,Ph_No: Ph_No1,SC_Name: SC_Name1,Sc_Desig: Sc_Desig1,SC_Email: SC_Email1,SC_Ph_No: SC_Ph_No1,Career: Career1,Emp_Count: Emp_Count1,Prospect_Type: Prospect_Type1,Product: Product1,No_Products: No_Products1,Domain: Domain1,Web: Web1,Mobile: Mobile1,custom: custom1,ECommerce: ECommerce1,Technology_Info: Technology_Info1  },  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                         
                         alert("Data Update Success..");
                         document.location.reload(true);

                     }  
                  }); 
    }


}

function Cancel()
{
   window.location.href = document.referrer;
}



function save_client_based_call()
{

     var pcode = document.getElementById('pcode').value;

     var call = document.getElementById('country').value;

     var scheduled = document.getElementById('scheduled').value;



      var ncall2 = $('input[name=Check]:checked').val(); 

      if(ncall2 == 'Yes')
      {
         var ncall = 'Yes';    
         var client_date1 = document.getElementById('client_date').value;
         var our_date1 = document.getElementById('equal_our_date').value;

         if(client_date1 == "" || our_date1 == "")
         {
          alert("Please Select Date");
         }
         else
         {
           var client_date = document.getElementById('client_date').value;
         var our_date = document.getElementById('equal_our_date').value;
         }
        
      }
      else
      {
        var ncall = 'No';
         var client_date = '0';
         var our_date = '0';
      }
    
        var cmmd = document.getElementById('cmmd').value;
        var status = $('input[name=Prospect_Status]:checked').val(); 

        if(call == "" || cmmd == "")
        {
alert("Please Fill Result & Comments");
        }
        else
        {
          $.ajax({  
                         url:"<?php echo site_url('User/Prospect_Data_Call_status_client_date'); ?>",  
                        data: {prospect_Icode: pcode,Prospect_Status: status,Check: ncall,equal_our_date: our_date,Result: call,Comment: cmmd,client_date:client_date,Scheduled_date: scheduled   },  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                          if(data == 1)
                          {
                             alert("Success");
                          //window.location.href = "<?php echo site_url('User/cold_calling'); ?>";
                      window.location.href = document.referrer;
                          }
                          else
                          {
                            alert("failed");
                          }
                         
                       

                     }  
                  }); 

        }


         
     


}


function checkSubmit()
{

   var ncall2 = $('input[name=Check]:checked').val(); 

      if(ncall2 == 'Yes')
      {
         var ncall = 'Yes';    
         var client_date1 = document.getElementById('client_date').value;
         var our_date1 = document.getElementById('equal_our_date').value;

         if(client_date1 == "" || our_date1 == "")
         {
          alert("Please Select Date");
          return false;
         }
         else
         {
           return true;
         }
        
      }
      else
      {
        return true;
      }
    

}


function Show()
{
  $('#DA').show();
  $('#MA').hide();
}
function Show_market()
{
  $('#DA').hide();
  $('#MA').show();

}
  </script>


  <script>
$('#login_form').submit(function() {
    $('#gif').css('visibility', 'visible');
});
</script>


 </body>
</html>

          