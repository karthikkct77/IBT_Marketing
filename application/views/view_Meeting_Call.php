
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

.col-md-4 .meeting p
{
  color: #ab1233;
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




<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

<div class="content-wrapper">
  
    <!-- Content Header (Page header) -->
     <?php 
                      if(isset($meeting) && is_array($meeting) && count($meeting)): $i=1;
                        foreach ($meeting as $key ) {
                          ?>
  
    <div class="row">
    <div class="col-md-8">

    <?php
    if($key['Marketing_Prospect_Type'] == 'Above Average' || $key['Marketing_Prospect_Type'] == 'Good' )
    {
      ?>
        <h3 class="flash" style="text-align: center;"> <?php echo $key['Company_Name'];  ?> ( <a  class="flash"  target="_blank" href="<?php echo $key['WebURL']  ?>"><?php echo $key['WebURL'];  ?></a> )~<?php echo $key['Company_Contact'];  ?>~<?php echo $key['Country'];  ?> </h>
        <?php

    }
    else
    {
      ?>
      <h4 style="text-align: center;" > <?php echo $key['Company_Name'];  ?> ( <a  target="_blank" href="<?php echo $key['WebURL']  ?>"><?php echo $key['WebURL'];  ?></a> )~<?php echo $key['Company_Contact'];  ?>~<?php echo $key['Country'];  ?> </h4>
      <?php
    }
    ?>
   
    
    
    </div>
   
    </div>
    


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
        <div class="col-md-8">
         <div class="box box-primary">
            <div class="box-header with-border">
           <h4 style="background-color: #f5d4c2; text-align: center;"><?php echo $key['Meeting_Type']; ?>  </h4>
            
            </div>

            <input type="hidden" name="meetype" id="mmtype" value="<?php echo $key['Meeting_Type_Icode']; ?>">
            
            <div class="box-body">
            <div class="row">
            <div class="col-md-12">
            <div class="col-md-3">
           
               
               <h5>Email:<?php echo $key['Company_Email'];  ?></h5>

              </div>
              
           
             <div class="col-md-3">
             <h5> PC:<?php echo $key['PC_Name'];  ?>(<?php echo $key['PC_Desig'];  ?>)</h5>
            
            
           
             
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
          
          <!--  <div class="row">
            <div class="col-md-6">
             <h4 style="padding-left: 10px; "><a href="" data-toggle="modal" data-target="#myModal3" onclick="getdata_team('<?php echo $key['Prospect_Icode'];  ?>')"  >Data Team Assessment</a></h4>
             </div>
               <div class="col-md-6">
             <h4 style="padding-left: 10px; "><a href="" data-toggle="modal" data-target="#myModal4" onclick="getmarketing_team('<?php echo $key['Prospect_Icode'];  ?>')"  >Marketing Team Assessment</a></h4>
             </div>
            
            </div>-->





           
 <div class="row">
 <div class="col-md-12">
 <ul class="nav nav-tabs" role="tablist" id="myTab">
           <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Meeting Details</a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Change in Schedule</a></li>

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
               <input type="hidden" name="Scheduled_date" id="scheduled" value="<?php echo $key['Equiv_our_date']; ?>" disabled>
              <?php
            }
            ?>
            </div>
            <div class="col-md-4 meeting"><p style="color: #ab1233;"> </p></div>
              

        </ul>
        
 </div>
 </div>


 <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">

    <div class="row">
    <div class="col-md-6">
    <label>Client participant(s)</label>
     <div class="form-group">
                    
                <textarea class="form-control" id="client_participant" name="client_participant" placeholder="List participant(s)" ></textarea>

                 
           
                </div>
      
    </div>
      <div class="col-md-6">
       <label>IBT participant(s)</label>
       <div class="form-group">
                    
                <textarea class="form-control" id="ibt_participant" name="ibt_participant" placeholder="List participant(s)"></textarea>

                 
           
                </div>
        
      </div>

   
<div class="col-md-12">
<label>Meeting Minutes</label>
<div class="form-group">
 <input type="hidden" name="prospect_Icode" id="pcode" value="<?php echo $key['Prospect_Icode'];  ?>">



<textarea class="form-control" id="mcmmd" name="MComment" placeholder="Meeting Minutes"  ></textarea>

</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
           <h4 style="background-color: #f5d4c2;">Next Step</h4>
            
            </div>

            <div class="col-md-3">
            <div class="form-group">
            <input type="checkbox" name="Check"  id="checkbox1" value="Yes" /> Schedule Another Meeting
            </div>
                </div>
              
            <div class="col-md-9" id="client" style="display: none;" >
            <div class="col-md-3" >
           <label>Client Date</label>
                 <div class="form-group">
                 
            <div class="input-group date" id="datetimepicker2">
                <input type="text" id="client_date" name="client_date" class="form-control"   />  <span class="input-group-addon"><span class="glyphicon-calendar glyphicon" ></span></span>
         
        </div>
            </div>
            </div>
             <div class="col-md-3" >
               <label>Equiv Our_Date/Time</label>
                 <div class="form-group">
              
            <div class="input-group date" id="datetimepicker3">
                <input type="text" id="equal_our_date"  name="equal_our_date" class="form-control"  />  <span class="input-group-addon"><span class="glyphicon-calendar glyphicon" ></span></span>
           
        </div>
            </div>
            </div>
             <div class="col-md-3">
  <label>Meeting Type</label>
        <div class="form-group">

               
                  <select name="mtype" class="form-control" id="mtype" required >
                     <option value="<?php echo $key['Meeting_Type_Icode']; ?>" ><?php echo $key['Meeting_Type']; ?> </option>
           <?php foreach ($Mtype as $row):
            { 

                echo "<option value= " .$row['Meeting_Icode'].">" . $row['Meeting_Type'] . "</option>";

           } 
           endforeach; ?>
           </select> 
                </div>
                </div>
            </div>

            </div>
                       <div class="row">
                       <div class="col-md-12">

            <label>Notes/Comment</label>
<div class="form-group">

<textarea class="form-control" id="Ncmmd" name="NComment" placeholder="Comment"  ></textarea>

</div>
</div>
</div>
<div class="row">
<div class="col-md-9">
</div>

             <div class="col-md-3">

                 <button type="button" class="btn btn-info"  onclick="save_client_based_call()" >Save</button>
                  <button type="button" class="btn btn-default"  onclick="Cancel()" >Cancel</button>
       
            
            </div>
            </div>



    </div>


     <div role="tabpanel" class="tab-pane" id="profile">
     <div class="row" style="margin-bottom: 15px;">
     <div class="col-md-12">
     </div>
       
     </div>

     <div class="row" style="margin-bottom: 15px;">
     <div class="col-md-12">
     <div class="col-md-4">
     <input type="radio" name="type" id="type" value="P" onclick="postponce()">Postpone Meeting 
     </div>
      <div class="col-md-4">
      <input type="radio" name="type" id="type" value="C" onclick="cancel_meeting()">Cancel Meeting 
     </div>

     
      
     </div>
     </div>

     <div class="col-md-12">


            <div  id="postponce" style="display: none;" >
            <div class="col-md-3" >
           <label>Re-scheduled Client Date/Time</label>
                 <div class="form-group">
                 
            <div class="input-group date" id="datetimepicker4">
                <input type="text" id="client_date1" name="client_date" class="form-control"   />  <span class="input-group-addon"><span class="glyphicon-calendar glyphicon" ></span></span>
         
        </div>
            </div>
            </div>
             <div class="col-md-3" >
               <label>Equiv Our Date/Time</label>
                 <div class="form-group">
              
            <div class="input-group date" id="datetimepicker5">
                <input type="text" id="equal_our_date1"  name="equal_our_date" class="form-control"  />  <span class="input-group-addon"><span class="glyphicon-calendar glyphicon" ></span></span>
           
        </div>
            </div>
            </div>
             <div class="col-md-3">
  <label>Meeting Type</label>
        <div class="form-group">

               
                  <select name="mtype" class="form-control" id="mtype" required >
                     <option value="<?php echo $key['Meeting_Type_Icode']; ?>" ><?php echo $key['Meeting_Type']; ?> </option>
           <?php foreach ($Mtype as $row):
            { 

                echo "<option value= " .$row['Meeting_Icode'].">" . $row['Meeting_Type'] . "</option>";

           } 
           endforeach; ?>
           </select> 
                </div>
                </div>
                 <div class="row">
                       <div class="col-md-12">

            <label>Notes/Comment</label>
<div class="form-group">

<textarea class="form-control" id="Pcmmd" name="PComment" placeholder="Comment"  ></textarea>

</div>
</div>
</div>
<div class="col-md-9">
</div>
 <div class="col-md-3">


                 <button type="button" class="btn btn-info"  onclick="meeting_postponce()" >Save</button>
                  <button type="button" class="btn btn-default"  onclick="Cancel()" >Cancel</button>
       
            
            </div>
            </div>

     </div>


<div class="col-md-12" id="cancel" style="display: none;">

                 <div class="row">
                       <div class="col-md-12">

            <label>Reason for cancellation</label>
<div class="form-group">

<textarea class="form-control" id="Cancelcmmd" name="cancelComment" placeholder="Reason for cancel"  ></textarea>

</div>
</div>
</div>
<div class="col-md-9">
</div>
 <div class="col-md-3">

                 <button type="button" class="btn btn-info"  onclick="save_meeting_Cancel()" >Save</button>
                  <button type="button" class="btn btn-default"  onclick="Cancel()" >Cancel</button>
       
            
            </div>

</div>



     </div>








    </div>







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



            
           
       
 
           
 
          
      
            </div>

            <?php
                  }
                   else:
                  ?>
                <tr>
                    <td colspan="7" align="center" >Please Search Again</td>
                    

                </tr>
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
                <div class="box-body" >
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages" >
                    <!-- Message. Default to the left -->
                    <?php 
                      if(isset($history) && is_array($history) && count($history)): $i=1;
                        foreach ($history as $key ) {
                          ?>

                           <input type="hidden" name="Prospect_Status" id="ptype" value="<?php echo $key['Prospect_Status'];  ?>">
   <input type="hidden" name="Result" id="country" value="<?php echo $key['Prospect_Call_Result'];  ?>">
  
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

         <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Meeting Status</h3>

                 
                </div>
                <!-- /.box-header -->
                <div class="box-body" >
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages" >
                    <!-- Message. Default to the left -->
                    <?php 
                      if(isset($Meeting_history) && is_array($Meeting_history) && count($Meeting_history)): $i=1;
                        foreach ($Meeting_history as $key ) {
                          ?>
                    <div class="direct-chat-msg">
                      <div class="direct-chat-info clearfix">

                        <span class="direct-chat-name pull-left"><?php echo $key['Meeting_Type'] ?></span>
                        <span class="direct-chat-timestamp pull-right"><?php echo $key['Meeting_BDE_Date'] ?></span>
                      </div>
                      <!-- /.direct-chat-info -
                      <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                      <a data-toggle="modal" data-target="#myModal5" onclick="meeting_history(<?php echo $key['Meeting_Status_Icode'] ?>)" > <i class="glyphicon glyphicon-eye-open"></i>...</a>
                      <p class="show-read-more"><?php echo $key['Meeting_Comment'] ?></p>
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



<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 60%;">
        <div class="modal-content" >
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Meeting Status</h4>

            </div>
          
       <div class="modal-body" id="meeting_his">
            
            </div>
            <div class="modal-footer">
            
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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




<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 60%;">
        <div class="modal-content" >
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Marketing Team Assessment</h4>

            </div>
          
            <div class="modal-body" id="dndid">
           
                    <table id="myTable" class="display table" border="2px" width="100%" >
 
 <thead>
    <tr>
    
        
        <th>Services</th>
        <th>Approch</th>
         <th>Industry</th>
         <th>Domain</th>
      
       
    </tr>
    </thead>
 
 
 <tbody id="marketingteam">


  </tbody>


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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
<script type="text/javascript">
  $('#datetimepicker1').datetimepicker({format : "DD/MM/YYYY hh:mm A"});
$('#datetimepicker2').datetimepicker({format : "DD/MM/YYYY hh:mm A"});
$('#datetimepicker3').datetimepicker({format : "DD/MM/YYYY hh:mm A"});
$('#datetimepicker4').datetimepicker({format : "DD/MM/YYYY hh:mm A"});
$('#datetimepicker5').datetimepicker({format : "DD/MM/YYYY hh:mm A"});



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

function Cancel()
{
   window.location.href = document.referrer;
}

function update_data()
{
  var pcode = document.getElementById('pcode').value;
   var Branch1 = document.getElementById('Branch').value;
    var office1 = document.getElementById('office').value;
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
                          var Career1 = document.getElementById('Career').value;
                       var Emp_Count1 = document.getElementById('Emp_Count').value;
                        var Prospect_Type1 = document.getElementById('Prospect_Type').value;
                       var Product1 = document.getElementById('Product').value;
                        var No_Products1 = document.getElementById('No_Products').value;
                           var Domain1 = document.getElementById('Domain').value;
                             var Web1 = document.getElementById('Web').value;
                              var Mobile1 = document.getElementById('Mobile').value;
                               var ECommerce1 = document.getElementById('E-Commerce').value;
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
                          prospect_Icode: pcode,Branch: Branch1,Building_Type: Building_Type1,Address:Address1,City: City1,State: State1,Email: Email1,FB: FB1,LinkedIn: LinkedIn1,Time_Zone: Time_Zone1,PC_Name: PC_Name1,Pc_Desig: Pc_Desig1,PC_Email: PC_Email1,Ph_No: Ph_No1,SC_Name: SC_Name1,Sc_Desig: Sc_Desig1,SC_Email: SC_Email1,SC_Ph_No: SC_Ph_No1,Career: Career1,Emp_Count: Emp_Count1,Prospect_Type: Prospect_Type1,Product: Product1,No_Products: No_Products1,Domain: Domain1,Web: Web1,Mobile: Mobile1,ECommerce: ECommerce1,Technology_Info: Technology_Info1  },  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                         
                         alert("Data Update Success..");
                         document.location.reload(true);

                     }  
                  }); 
    }


}

function getdata_team(id)
{
  var pcode = id;
 
   $.ajax({  
                         url:"<?php echo site_url('User/get_datateam'); ?>",  
                        data: {prospect_Icode: id },  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                       $("#datateam").html(data);  
                     
                     }  
                  }); 

}

function getmarketing_team(id)
{
  var pcode = id;
 
   $.ajax({  
                         url:"<?php echo site_url('User/get_marketingteam'); ?>",  
                        data: {prospect_Icode: id },  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                       $("#marketingteam").html(data);  
                     
                     }  
                  }); 

}


function save_client_based_call()
{

var type = document.getElementById('ptype').value;
var result = document.getElementById('country').value;
var scheduled = document.getElementById('scheduled').value;

var current_meeting=document.getElementById('mmtype').value;


     var pcode = document.getElementById('pcode').value;
   

     var cp = document.getElementById('client_participant').value;  mcmmd
     var ibtp = document.getElementById('ibt_participant').value;
     var mcmmd = document.getElementById('mcmmd').value;

     if(cp == "" || ibtp =="" || mcmmd == "")
     {
      alert("Please Fill participant and Meeting Comment")
     }
     else
     {


      var ncall2 = $('input[name=Check]:checked').val(); 

      if(ncall2 == 'Yes')
      {
      // alert("1");
         var ncall = 'Yes';    
         var client_date1 = document.getElementById('client_date').value;
         var our_date1 = document.getElementById('equal_our_date').value;
         var mtype = document.getElementById('mtype').value;

         if(client_date1 == "" || our_date1 == "" || mtype =="" )
         {
           // alert("2");
     
          alert("Please Select Date /Meeting Type");
         }
         else
         {
         // alert("3");
           var client_date = document.getElementById('client_date').value;
         var our_date = document.getElementById('equal_our_date').value;
         var mtype = document.getElementById('mtype').value;
         }
        
      }
      else
      {
        //  alert("4");
        var ncall = 'No';
         var client_date = '0';
         var our_date = '0';
     }
   
        
      

        var cmmd = document.getElementById('Ncmmd').value;
    
         
          $.ajax({  
                         url:"<?php echo site_url('User/Meeting_status'); ?>",  
                        data: {prospect_Icode: pcode,Client: cp,Ibt: ibtp,Check: ncall,equal_our_date: our_date,client_date: client_date,Next_meeting_Type: mtype,Meeting_cmd:mcmmd,Next_comment:cmmd,pststus:type,Result:result,scheduled_date:scheduled,cmeeting: current_meeting },  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                         if(data == 1)
                       {
                        alert("success");
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



function postponce()
{
$('#postponce').show();
$('#cancel').hide();
}

function cancel_meeting()
{
  $('#cancel').show();
  $('#postponce').hide();
}




function meeting_postponce()
{
var type = document.getElementById('ptype').value;
var result = document.getElementById('country').value;
var scheduled = document.getElementById('scheduled').value;
var current_meeting=document.getElementById('mmtype').value;


     var pcode = document.getElementById('pcode').value;
    var client_date1 = document.getElementById('client_date1').value;
         var our_date1 = document.getElementById('equal_our_date1').value;
         var mtype = document.getElementById('mtype').value;


         if(client_date1 == "" || our_date1 == "" || mtype == "")
         {
          alert("Please Select Date /Meeting Type");
         }
         else
         {
var client_date = document.getElementById('client_date1').value;
         var our_date = document.getElementById('equal_our_date1').value;
         var mtype = document.getElementById('mtype').value;
          var cmmd = document.getElementById('Pcmmd').value;

         $.ajax({  
                         url:"<?php echo site_url('User/Meeting_status_postponce'); ?>",  
                        data: {prospect_Icode: pcode,equal_our_date: our_date,client_date: client_date,Next_meeting_Type: mtype,Next_comment:cmmd,pststus:type,Result:result,scheduled_date:scheduled,cmeeting: current_meeting },  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                         if(data == 1)
                       {
                        alert("success");
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



function save_meeting_Cancel()
{

  var type = document.getElementById('ptype').value;
var result = document.getElementById('country').value;
var scheduled = document.getElementById('scheduled').value;
 var pcode = document.getElementById('pcode').value;
  var cmmd = document.getElementById('Cancelcmmd').value;
  var current_meeting=document.getElementById('mmtype').value;

  if(cmmd == "")
  {
    alert("Please fill Reason for Meeting Cancel..");
  }
  else
  {
      $.ajax({  
                         url:"<?php echo site_url('User/Meeting_status_Cancel'); ?>",  
                        data: {prospect_Icode: pcode,Next_comment:cmmd,pststus:type,Result:result,scheduled_date:scheduled,cmeeting: current_meeting },  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                         if(data == 1)
                       {
                        alert("success");
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


function meeting_history(id)
{
   $.ajax({  
                         url:"<?php echo site_url('User/Meeting_status_History'); ?>",  
                        data: {id:id },  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                          $("#meeting_his").html(data);  
                     // $('#myModal5').modal('show');

                     }  
                  });
}

  </script>


  <script type="text/javascript">
$(document).ready(function(){
  var maxLength = 100;
  $(".show-read-more").each(function(){
    var myStr = $(this).text();
    if($.trim(myStr).length > maxLength){
      var newStr = myStr.substring(0, maxLength);
      var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
      $(this).empty().html(newStr);
      $(this).append(' <a class="read-more" data-toggle="modal" data-target="#myModal5"  >...</a>');
     
    }
  });
 
});
</script>
<style type="text/css">
    .show-read-more .more-text{
        display: none;
    }
</style>
 </body>
</html>

          