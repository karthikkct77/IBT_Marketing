<link href ="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
<link href ="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js">
<link href ="https://cdn.datatables.net/responsive/2.2.0/js/dataTables.responsive.min.js">
<link href ="https://cdn.datatables.net/responsive/2.2.0/js/responsive.bootstrap.min.js">
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );

$(document).ready(function() {
    $('#example1').DataTable();
} );
</script>
<div class="content-wrapper">

    <section class="content-header">
      <h1>
       View Requirement
        <small></small>
      </h1>
     
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
       <!-- left column --><div class="col-md-12">
       <div class="col-md-8">
          <?php foreach ($Prospect_details as $new) { ?>
       <h3><?php echo $new['Company_Name']; ?> |<span><a href="<?php echo $new['WebURL']; ?>" target="_blank"><?php echo $new['WebURL']; ?></a> |<?php echo $new['Requirement_Type']; ?> |<?php echo $new['Project_Title']; ?> | <?php echo $new['Req_Name']; ?> </span></h3>

     
       </div>
       <div class="col-md-4">
        <h4><a href='<?php echo site_url('User/List_Requirement'); ?>' >Back</a></h4>
        </div>
       </div>
        <div class="col-md-12">

          <?php
            if($new['Requirement_Status'] == '7')
            {
              ?> 
                <div class="col-md-6">
                <div class="box box-primary">
                <div class="box-body custom">
                  <h4 style="font-weight: 600;">Estimated Hours</h4>
                 <p style="margin-left: 12%;  font-size: 20px;"><?php echo $Won_details['Estimate_Hour']; ?> </p>
                 <h4 style="font-weight: 600;">Project Type</h4>
                 <p style="margin-left: 12%;  font-size: 20px;"><?php echo $Won_details['WorkCategory_Name']; ?> </p>
                 <h4 style="font-weight: 600;">Contract Type</h4>
                 <p style="margin-left: 12%;  font-size: 20px;"><?php echo $Won_details['Contracttype_Name']; ?> </p>
                 <h4 style="font-weight: 600;">Project Value</h4>
                 <p style="margin-left: 12%;  font-size: 20px;"><?php echo $Won_details['Project_Price']; ?><?php echo $Won_details['Price_Code']; ?> </p>
                   <h4 style="font-weight: 600;">Date</h4>
                      <p style="margin-left: 12%;  font-size: 20px;"><?php echo $Won_details['Project_Get_Date']; ?> </p>
                </div>
                </div>
                </div>
            <?php    
            }
            else if($new['Requirement_Status'] == '8')
            {
              ?>
               <div class="col-md-6">
                <div class="box box-primary">
                <div class="box-body custom">
                 <h4 style="font-weight: 600;">Lost Type</h4>
                 <p style="margin-left: 12%;  font-size: 20px;"><?php echo $Lost_details['Lost_Type']; ?> </p>
                  <div>
                    <h4 style="font-weight: 600;">Lost Reason</h4>
                    <ul style="margin-left: 10%;  font-size: 20px; list-style: binary; " >
                     <?php 
                     $i=0;
                     foreach($lost_reason as $lost => $val )
                     {
                      ?>
                       <li><?php echo $val[$i]['Reason']; ?></li>
                       <?php

                     }
                     ?>
                     
                     
                    </ul>
                  </div>
                   <h4 style="font-weight: 600;">Comments</h4>
                      <p style="margin-left: 12%;  font-size: 20px;"><?php echo $Lost_details['Lost_Comments']; ?> </p>
                      <h4 style="font-weight: 600;">Date</h4>
                      <p style="margin-left: 12%;  font-size: 20px;"><?php echo $Lost_details['Lost_Date']; ?> </p>

               
                </div>
                </div>
                </div>
            <?php  
            }
            else
            {
              ?>
            

        <div class="col-md-6">
         <?php
          foreach ($requirement as $key ) 
          {
            ?> 
         <div class="box box-primary">
        <div class="box-body custom">
         <?php
           if($key['Requirement_Status'] >= '4' && $key['Requirement_Type'] == 'Project')
           {
            ?>
            <div class="row" style="padding: 0 15px;" id="show_Status">
                   <div class="form-group">
                    <label>Post Comments</label>
                  <input type="hidden" name="Requirement_id" id="Requirement_id1" value="<?php echo $key['Requirement_Icode']; ?>">
                  <input type="hidden" name="Req_status" id="Req_status1" value="<?php echo $key['Requirement_Status']; ?>">
                  <input type="hidden" name="Pros_code" id="Pros_code1" value="<?php echo $key['Prospect_Icode']; ?>">
                  <input type="hidden" name="Leader_Code1" id="Leader_Code1" value="<?php echo $key['Tech_Leader_Code']; ?>">

                    <textarea name="pcmd1" id="pcmd1" class="form-control"></textarea>
                  </div>
                       <div class="form-group">
                  <label>Select Status</label>
                     <select name="mySelect" class="form-control" id="mySelect"  >
                     <option value="<?php echo $key['Requirement_Status']; ?>">Select Status</option>

                      <?php
                      foreach ($Req_Status as $val) 
                      {

                         echo "<option value= " .$val['Req_Id']." >" . $val['Req_Name'] . "</option>";
                      }
                      ?>
                     </select> 
           
                 </div>
                  <button type="button"  id="Save_Comments1" style="float: right;" class="btn btn-success"  onclick="Save_status_cmd()" >Save</button>
                  </div>
           <?php       
           }
           else if($key['Requirement_Status'] < '4' && $key['Requirement_Type'] == 'Project')
           {
            ?>
                 <div class="row" style="padding: 0 15px;" id="post_cmd">
                   <div class="form-group">
                    <label>Post Comments</label>
                    <input type="hidden" name="Requirement_id" id="Requirement_id" value="<?php echo $key['Requirement_Icode']; ?>">
                    <input type="hidden" name="Req_status" id="Req_status" value="<?php echo $key['Requirement_Status']; ?>">
                    <input type="hidden" name="Pros_code" id="Pros_code" value="<?php echo $key['Prospect_Icode']; ?>">
                      <input type="hidden" name="Leader_Code" id="Leader_Code" value="<?php echo $key['Tech_Leader_Code']; ?>">
                    <textarea name="pcmd" id="pcmd" class="form-control"></textarea>
                   </div>
                  <button type="button" id="Save_Comments" style="float: right;" class="btn btn-success"  onclick="Save_Comments()" >Save</button>
                  </div>

           <?php       
           }
           elseif($key['Requirement_Status'] >= '13' && $key['Requirement_Type'] == 'Resource')
           {
            ?>
              <div class="row" style="padding: 0 15px;" id="show_Status">
                   <div class="form-group">
                    <label>Post Comments</label>
                  <input type="hidden" name="Requirement_id" id="Requirement_id1" value="<?php echo $key['Requirement_Icode']; ?>">
                  <input type="hidden" name="Req_status" id="Req_status1" value="<?php echo $key['Requirement_Status']; ?>">
                  <input type="hidden" name="Pros_code" id="Pros_code1" value="<?php echo $key['Prospect_Icode']; ?>">
                  <input type="hidden" name="Leader_Code1" id="Leader_Code1" value="<?php echo $key['Tech_Leader_Code']; ?>">

                    <textarea name="pcmd1" id="pcmd1" class="form-control"></textarea>
                  </div>
                       <div class="form-group">
                  <label>Select Status</label>
                     <select name="mySelect" class="form-control" id="mySelect"  >
                     <option value="">Select Status</option>
                      <?php
                      foreach ($Req_Status as $val) 
                      {

                         echo "<option value= " .$val['Req_Id']." >" . $val['Req_Name'] . "</option>";
                      }
                      ?>
                     </select> 
           
                 </div>
                  <button type="button"  id="Save_Comments1" style="float: right;" class="btn btn-success"  onclick="Save_status_cmd()" >Save</button>
                  </div>
           <?php       
           }
           else
           {
            ?>
            <div class="row" style="padding: 0 15px;" id="post_cmd">
                   <div class="form-group">
                    <label>Post Comments</label>
                    <input type="hidden" name="Requirement_id" id="Requirement_id" value="<?php echo $key['Requirement_Icode']; ?>">
                    <input type="hidden" name="Req_status" id="Req_status" value="<?php echo $key['Requirement_Status']; ?>">
                    <input type="hidden" name="Pros_code" id="Pros_code" value="<?php echo $key['Prospect_Icode']; ?>">
                      <input type="hidden" name="Leader_Code" id="Leader_Code" value="<?php echo $key['Tech_Leader_Code']; ?>">
                    <textarea name="pcmd" id="pcmd" class="form-control"></textarea>
                   </div>
                  <button type="button" id="Save_Comments" style="float: right;" class="btn btn-success"  onclick="Save_Comments()" >Save</button>
                  </div>
           <?php       

           }
           
     


           ?>
           <div id="Project_Won" style="display: none;">
           <h3>Project Won</h3>
             <div class="col-md-12">
            
            <div class="form-group">
                   <label>Estimated Hours</label>
                    <input type="text" class="form-control" name="Hours" id="Hours" placeholder="Enter Estimation Hours">
            </div>
            <div class="form-group">
            <label>Project Type</label>
                   <select name="Project_Type" class="form-control" id="Project_Type"  >
                        <option value="" >Select Project_Type</option>
                             <?php foreach ($Project_Type as $row):
                              { 

                                  echo "<option value= " .$row['WorkCategory_Icode'].">" . $row['WorkCategory_Name'] . "</option>";

                             } 
                             endforeach; ?>
                     </select> 
           
                </div>
                <div class="form-group">
                <label>Contract Type</label>
                   <select name="Contract_Type" class="form-control" id="Contract_Type"  >
                        <option value="" >Contract Type</option>
                             <?php foreach ($Contract_Type as $row):
                              { 

                                  echo "<option value= " .$row['Contracttype_Icode'].">" . $row['Contracttype_Name'] . "</option>";

                             } 
                             endforeach; ?>
                     </select> 
           
                </div>
                 <div class="form-group">
                   <label style="display: block;">Project Value</label>
                    <input type="text" class="form-control" name="price" id="price" placeholder="Enter Project Value" style="width: 30%; display: inline-block; margin-right: 2%;">
                    <select name="symbol" class="form-control"  id="symbol" style="width: 30%; display: inline-block;">
                        <option value="">Select Currency Type</option>
                        <option value="AUD" >AUD</option>
                        <option value="CAD" >CAD</option>
                        <option value="EUR" >EUR</option>
                        <option value="ZAR" >ZAR</option>
                        <option value="USD" >USD</option>
                        <option value="GBP" >GBP</option>    
                     </select> 
                     
                 </div>
                </div>
                  <button type="button" style="float: right;" class="btn btn-success"  onclick="Save_Project_Won()" >Save</button>
            </div>

            <div id="Project_Loss" style="display: none;">
           <h3>Project Loss</h3>
             <div class="col-md-12">
              <div class="form-group">
                  
                      <input type="radio" name="Rtype" id="Project" value="Client"   onclick="show_Client()" /> <label style="margin-right: 20px; font-weight: normal;">Client Reason</label>
                      <input type="radio" name="Rtype" id="Resource" value="Our" onclick="show_Our()" /> <label style="font-weight: normal;">Our Reason</label>

                </div>
           
                
                </div>
             </div>

             <div id="Client_reason" style="display: none;">
             <h3>Client Reason</h3>
             <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
             <thead>
                <th><input type="checkbox" id="selectall"/></th>
                
                <th>Reason</th>
                </thead>
                <tbody>
                <?php foreach ($Client_Reason as $key ) { ?>
                 <tr>
                 <td><input type='checkbox' class='case' name='case' value="<?php echo $key['Project_Loss_Client_Icode']; ?>"></td>

                 <td><?php echo $key['Reason']; ?> </td>
                 </tr>
                 <?php
                  
                }
                ?>
                </tbody>

             </table>

             <button type="button" style="float: right;" class="btn btn-success"  onclick="Save_Client_Loss()" >Save</button>


             </div>
                <div id="Our_reason" style="display: none;">
             <h3>Our Reason</h3>
             <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
             <thead>
                <th><input type="checkbox" id="selectall_our"/></th>
                
                <th>Reason</th>
                </thead>
                <tbody>
                <?php foreach ($Our_Reason as $key ) { ?>
                 <tr>
                 <td><input type='checkbox' class='case_our' name='case_our' value="<?php echo $key['Project_Loss_Our_Icode']; ?>"></td>

                 <td><?php echo $key['Reason']; ?> </td>
                 </tr>
                 <?php
                  
                }
                ?>
                </tbody>

             </table>

             <button type="button" style="float: right;" class="btn btn-success"  onclick="Save_Our_Loss()" >Save</button>


             </div>




            </div>

           
            </div>
              <?php
          }

          ?>
            </div>


            <?php
            }
          }    // first foreach 
          ?>
           


          
         <div class="col-md-6">

         <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Comments</h3>

                 
                </div>
                <!-- /.box-header -->
                <div class="box-body" >
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages" >
                    <!-- Message. Default to the left -->
                    <?php 
                      if(isset($leader_cmd) && is_array($leader_cmd) && count($leader_cmd)): $i=1;
                        foreach ($leader_cmd as $key ) {
                          ?>
                    <div class="direct-chat-msg">
                     <?php
                       if($key['Req_Comments'] != "")
                       {
                        ?>
                         <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left"><?php echo $key['Bde'] ?></span>
                        <span class="direct-chat-timestamp pull-right"><?php echo $key['Modified_Date'] ?></span>
                      </div>
                      <!-- /.direct-chat-info -
                      <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                      <?php echo $key['Req_Comments'] ?>
                      </div>
                      <!-- /.direct-chat-text -->
                      <?php
                       }
                       else
                       {

                       }
                       ?>
                     
                    </div>
                    <div class="direct-chat-msg right">
                      
                      <?php
                      if($key['Tech_Leader_Cmd'] != "")
                      {
                        ?>
                          <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-right"><?php echo $key['Leader'] ?></span>
                        <span class="direct-chat-timestamp pull-left"><?php echo $key['Modified_Date'] ?></span>
                      </div>
                        <div class="direct-chat-text">
                        <?php echo $key['Tech_Leader_Cmd'] ?>
                      </div>
                      <?php
                      }
                      else
                      {

                      }
                      ?>

                        
                      <!-- /.direct-chat-info -->
                     
                      <!-- /.direct-chat-img -->

                      
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
                
    
              </div>
        </div>
        </div>
        </div>
        </div>
        </section>
        </div>

</div>

<script>
 function Save_Comments()   // Save Comments
      {

            var req_id = document.getElementById('Requirement_id').value;
            var req_status = document.getElementById('Req_status').value;
            var pcode = document.getElementById('Pros_code').value;
            var pcmd = document.getElementById('pcmd').value;
            var leader_code = document.getElementById('Leader_Code').value;

            if(pcmd == "")
            {
              alert("Please put Comments");
            }
            else
            {
                $.ajax({  
                  url:"<?php echo site_url('User/save_Comments'); ?>",  
                  data: {Req_id: req_id,Req_status: req_status,Pcmd: pcmd,Pros_code: pcode,Leader_Code: leader_code },  
                  type: "POST",  
                  success:function(data){ 
                    alert("successfully Comment Posted..");
                    window.location.href = document.referrer;
                   }  
                 }); 

            }


      }

      function Save_status_cmd()    // save status cmd
      {

            var req_id = document.getElementById('Requirement_id1').value;
            var req_status = document.getElementById('Req_status1').value;
            var pcode = document.getElementById('Pros_code1').value;
            var pcmd = document.getElementById('pcmd1').value;
            var leader_code = document.getElementById('Leader_Code1').value;
            var next_status = document.getElementById('mySelect').value;

            if(pcmd == "")
            {
              alert("Please put Comments");
            }
            else
            {
                $.ajax({  
                  url:"<?php echo site_url('User/save_Status_Comments'); ?>",  
                  data: {Req_id: req_id,Req_status: req_status,Pcmd: pcmd,Pros_code: pcode,Nstatus: next_status,Leader_Code: leader_code  },  
                  type: "POST",  
                  success:function(data){ 
                    alert("successfully Comment Posted and Change Status..");
                    window.location.href = document.referrer;
                   }  
                 }); 

            }

      }

      function Save_Project_Won()
      {

            var req_id = document.getElementById('Requirement_id1').value;
            var req_status = document.getElementById('Req_status1').value;

            var pcode = document.getElementById('Pros_code1').value;

            var pcmd = document.getElementById('pcmd1').value;
            var leader_code = document.getElementById('Leader_Code1').value;

            var next_status = document.getElementById('mySelect').value;

            var Hours = document.getElementById('Hours').value;

            var Project_Type = document.getElementById('Project_Type').value;

            var Contract_Type = document.getElementById('Contract_Type').value;
           // alert(Contract_Type);
            var price = document.getElementById('price').value;
            var symbol = document.getElementById('symbol').value;
            


            if(Hours =="" )
            {
              alert("Please Fill Hours...");
            }
            else if(Project_Type =="")
            {
              alert("Please Select Project Type");
            }
            else if(Contract_Type =="")
            {
              alert("Please Select Contract Type");
            }
            else if(price =="")
            {
              alert("Please Enter Price..");
            }
            else if(symbol =="") 
            {
              alert("Please Select Symbol");
            }
            else
            {
                $.ajax({  
                  url:"<?php echo site_url('User/Save_Project_Won'); ?>",  
                  data: {Req_id: req_id,Req_status: req_status,Pcmd: pcmd,Pros_code: pcode,Nstatus: next_status,Leader_Code: leader_code,Project_Hours: Hours,Ptype: Project_Type,CType: Contract_Type,Project_price: price, symbol: symbol     },  
                  type: "POST",  
                  success:function(data){ 
                    alert("success..");
                    window.location.href = document.referrer;
                   }  
                 }); 

            }

      }

      function show_Client()
      {
           $('#Client_reason').show();
           $('#Our_reason').hide();
      }
      function show_Our()
      {
           $('#Client_reason').hide();
           $('#Our_reason').show();
      }

      function Save_Client_Loss()
      {
            var req_id = document.getElementById('Requirement_id1').value;
            var req_status = document.getElementById('Req_status1').value;
            var pcode = document.getElementById('Pros_code1').value;
            var pcmd = document.getElementById('pcmd1').value;
            var type = $('input[name=Rtype]:checked').val(); 
            var next_status = document.getElementById('mySelect').value;
            var leader_code = document.getElementById('Leader_Code1').value;

            var checkboxes = document.getElementsByName('case');
         
            var vals = "";
              for (var i=0, n=checkboxes.length;i<n;i++) 
              {
                  if (checkboxes[i].checked) 
                  {
                      vals += ","+checkboxes[i].value;
                  }
              }
             var tbldata=vals;


             if(pcmd =="" )
            {
              alert("Please Type Comments for Reason...");
            }
            else if(tbldata =="")
            {
              alert("Please SelectReason");
            }
            else
            {
              $.ajax({  
                  url:"<?php echo site_url('User/Save_Project_Client_Lost'); ?>",  
                  data: {Req_id: req_id,Req_status: req_status,Pcmd: pcmd,Pros_code: pcode,Nstatus: next_status,Leader_Code: leader_code,Type: type,Reason: tbldata   },  
                  type: "POST",  
                  success:function(data){ 
                    alert("success..");
                    window.location.href = document.referrer;
                   }  
                 }); 
            }           
      }
      function Save_Our_Loss()
      {
            var req_id = document.getElementById('Requirement_id1').value;
            var req_status = document.getElementById('Req_status1').value;
            var pcode = document.getElementById('Pros_code1').value;
            var pcmd = document.getElementById('pcmd1').value;
            var type = $('input[name=Rtype]:checked').val(); 
            var next_status = document.getElementById('mySelect').value;
            var leader_code = document.getElementById('Leader_Code1').value;

            var checkboxes = document.getElementsByName('case_our');
         
            var vals = "";
              for (var i=0, n=checkboxes.length;i<n;i++) 
              {
                  if (checkboxes[i].checked) 
                  {
                      vals += ","+checkboxes[i].value;
                  }
              }
             var tbldata=vals;


             if(pcmd =="" )
            {
              alert("Please Type Comments for Reason...");
            }
            else if(tbldata =="")
            {
              alert("Please SelectReason");
            }
            else
            {
              $.ajax({  
                  url:"<?php echo site_url('User/Save_Project_Our_Lost'); ?>",  
                  data: {Req_id: req_id,Req_status: req_status,Pcmd: pcmd,Pros_code: pcode,Nstatus: next_status,Leader_Code: leader_code,Type: type,Reason: tbldata   },  
                  type: "POST",  
                  success:function(data){ 
                    alert("success..");
                    window.location.href = document.referrer;
                   }  
                 }); 
            }           
      }



          

</script>

<script type="text/javascript">  
                          $(document).ready(function()
                           {  
                             $("#mySelect").change(function()
                             {  
                                var val = $(this).val();
                                if(val =='7')
                                {
                                  $('#Project_Won').show();
                                  $('#Save_Comments').hide();
                                  $('#Save_Comments1').hide();
                                  $('#Project_Loss').hide();

                                }
                                else if(val =='8')
                                {
                                  $('#Project_Loss').show();
                                  $('#Project_Won').hide();
                                   $('#Save_Comments').hide();
                                  $('#Save_Comments1').hide();
                                }
                                else
                                {

                                }               
                          });       
                      });  

          $(function(){
            // add multiple select / deselect functionality
            $("#selectall").click(function () {
                $('.case').attr('checked', this.checked);
            });
            // if all checkbox are selected, check the selectall checkbox
            // and viceversa
            $(".case").click(function(){

              if($(".case").length == $(".case:checked").length) {
                $("#selectall").attr("checked", "checked");
              } else {
                $("#selectall").removeAttr("checked");
              }

            });
             // add multiple select / deselect functionality
            $("#selectall_our").click(function () {
                $('.case_our').attr('checked', this.checked);
            });
                $(".case_our").click(function(){

              if($(".case_our").length == $(".case_our:checked").length) {
                $("#selectall_our").attr("checked", "checked");
              } else {
                $("#selectall_our").removeAttr("checked");
              }

            });
          });
</script>

 </body>
</html>

          