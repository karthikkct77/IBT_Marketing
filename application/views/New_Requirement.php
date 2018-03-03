<script>
    $(document).ready( function () {

        $('#tblCustomers').addClass( 'nowrap' ).DataTable( {
            responsive: true
        });
    } );

</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
           New Requirement
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
              <h3 class="box-title"> </h3>
            </div>
               <div class="box-body">
               <div class="col-md-12">
                 
              <div class="col-md-6">
               <div class="form-group">
                   <label>Requirement Type</label><br>
                      <input type="radio" name="Rtype" id="Project" value="Project" checked  onclick="show_project()" /> <label style="margin-right: 20px; font-weight: normal;">Project</label>
                      <input type="radio" name="Rtype" id="Resource" value="Resource" onclick="show_Resource()" /> <label style="font-weight: normal;">Resource</label>

                </div>

                <div  id="project">
                 <div class="form-group">
                  <label>Select Client</label>
                     <select name="Company_code" class="form-control" id="company" required >
                        <option value="" >Select Company</option>
           <?php foreach ($Client as $row):
            { 

                echo "<option value= " .$row['Prospect_Icode'].">" . $row['Company_Name'] . "</option>";

           } 
           endforeach; ?>
           </select> 
           
                </div>
                 <div class="row" id="details" style="display: none;">  
                 <div class="col-md-6"> 
                   <div class="form-group">
                   <label>Web URL</label>
                      <input type="text" class="form-control" name="url" id="url" readonly="">
                  </div>
                </div>
                  <div class="col-md-6">
                    <div class="form-group">
                    <label>Country</label>
                     <input type="text" class="form-control" name="country" id="country" readonly="">
                     </div>
                  </div>
               </div>
               
                  <div class="form-group">
                    <label>Project Title</label>
                    <input type="text" class="form-control" name="project_title" id="project_title" placeholder="Enter Project Title" />
                  </div>
                  <div class="form-group">
                  <label>Technical Platform</label>
                     <select name="Technical" class="form-control" id="Technical"  >
                        <option value="" >Select Technical Platform</option>
                             <?php foreach ($technical as $row):
                              { 

                                  echo "<option value= " .$row['Tech_Icode'].">" . $row['Tech_Name'] . "</option>";

                             } 
                             endforeach; ?>
                     </select> 
           
                </div>
                          <div class="form-group">
                    <label>Technical Skills</label>
                    <textarea name="skill" id="skill" class="form-control"></textarea>
                  </div>
                <div class="form-group">
                  <label>Domain</label>
                     <select name="Technical" class="form-control" id="domain"  >
                        <option value="" >Select Domain</option>
                             <?php foreach ($Domain as $row):
                              { 

                                  echo "<option value= " .$row['Domain_Icode'].">" . $row['Domain_Name'] . "</option>";

                             } 
                             endforeach; ?>
                     </select> 
           
                </div>
                 <div class="form-group">
                  <label>Industry</label>
                     <select name="Technical" class="form-control" id="Industry"  >
                        <option value="" >Select Industries</option>
                             <?php foreach ($Industry as $row):
                              { 

                                  echo "<option value= " .$row['Industries_Icode'].">" . $row['Industries_Name'] . "</option>";

                             } 
                             endforeach; ?>
                     </select> 
           
                </div>
       
                         
                 <div class="form-group">
               <label>Estimate Requirement Date</label>
            <div class="input-group date" id="datetimepicker3">
                <input type="text" id="equal_our_date"  name="equal_our_date" class="form-control"  />  <span class="input-group-addon"><span class="glyphicon-calendar glyphicon" ></span></span>
           
        </div>
            </div>
              <button type="button" class="btn btn-success pull-right"  onclick="Save_Project()" >Save</button>
                
                </div>
                </div>
                </div>
              
                <div  id="resource" style="display: none;">
                 <form method="post" id="login_form" role="form" action="<?php echo site_url('User/Save_Resource'); ?>" name="data_register">

                 <input type="hidden" name="type" value="Resource">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Select Client</label>
                     <select name="Company_code" class="form-control" id="company_resource" required >
                        <option value="" >Select Company</option>
           <?php foreach ($Client as $row):
            { 

                echo "<option value= " .$row['Prospect_Icode'].">" . $row['Company_Name'] . "</option>";

           } 
           endforeach; ?>
           </select> 
            </div>
                </div>
                 <div class="" id="details1" style="display: none;">  
                 <div class="col-md-4"> 
                   <div class="form-group">
                   <label>Web URL</label>
                      <input type="text" class="form-control" name="url" id="url1" readonly="">
                  </div>
                </div>
                  <div class="col-md-4">
                    <div class="form-group">
                    <label>Country</label>
                     <input type="text" class="form-control" name="country" id="country1" readonly="">
                     </div>
                  </div>
               </div>
<!-- 
                 <table id="tblCustomers" cellpadding="0" cellspacing="0" border="1"> -->
                 <table id="tblCustomers"  data-page-length='25' class="table  table-bordered bootstrap-datatable datatable responsive">
 <thead>
                        <tr>
                            <th>Technical Platform</th>
                            <th>Technical Skills</th>
                            <th>Minimum Experience</th>
                            <th>Interview Timeline</th>
                            <th>Expected Start Date</th>
                            <th>Contract Duration</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                          <td>  
                            <div class="form-group">
                             <select name="STechnical[]" class="form-control" id="STechnical" required >
                                <option value="" >Select Technical Platform</option>
                                     <?php foreach ($technical as $row):
                                      { 

                                          echo '<option value= "'.$row['Tech_Icode'].'">' . $row['Tech_Name'] . '</option>';

                                     } 
                                     endforeach; ?>
                             </select> 
               
                            </div>
                          </td>

                          <td>
                            <div class="form-group">
                            <textarea id="myTextArea" name="myTextArea[]"  cols="50" rows="3" required ></textarea>
                            </div>
                          </td>

                          <td>
                            <div class="form-group">
                              <input type="number" class="form-control" name="experience[]" id="experience" placeholder="Min Exp in Year"  required />
                            </div>
                          </td>

                           <td>
                            <div class="form-group">
                             <select name="timeline[]" class="form-control" id="timeline"  required >
                                <option value="" >Select Interview Timeline</option>
                                <option value="1Week" >With in 1 Week</option>
                                <option value="2Week" >With in 2 Week</option>
                                <option value="3Week" >With in 3 Week</option>  
                             </select> 
                   
                            </div>
                          </td>

                           <td>
                            <div class="form-group">
                              <div class="input-group date" id="datetimepicker2">
                                  <input type="text" id="equal_our_date1"  name="equal_our_date1[]" class="form-control" required  />  <span class="input-group-addon"><span class="glyphicon-calendar glyphicon" ></span></span>
                               </div>
                            </div>
                          </td>

                           <td>
                            <div class="form-group">
                              <input type="text" class="form-control" name="Duration[]" id="Duration" placeholder="Enter Minimum Duration in Month" required />
                            </div>
                          </td>

                          <td><input type="button" onclick="Add()" value="Add" /></td>
                        </tr>
                        
                    </tfoot>
    </table>
                <button type="submit" class="btn btn-info pull-right" >Save</button>

                  </form>
                         
                </div>











                 </div>




               </div>
          </div>
        </div>    
      </div>
      </div>


</section>
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
</script>

          <script type="text/javascript">  
                  $(document).ready(function() {  
                     $("#company").change(function(){  
                    //  alert("hiiii");
                     /*dropdown post *///  
                     $.ajax({  
                        url:"<?php echo site_url('User/get_Company_Details'); ?>",  
                        data: {id:  
                           $(this).val()},  
                        type: "POST",  
                        success:function(server_response){  
                                    $('#details').show();

                                    var data = $.parseJSON(server_response);
                                    var url = data[0]['WebURL'];
                                    document.getElementById('url').value = url;
                                    var country = data[0]['Country'];
                                    document.getElementById('country').value = country;
                                         }  
                  });  
               });  
                $("#company_resource").change(function(){  
                    //  alert("hiiii");
                     /*dropdown post *///  
                     $.ajax({  
                        url:"<?php echo site_url('User/get_Company_Details'); ?>",  
                        data: {id:  
                           $(this).val()},  
                        type: "POST",  
                        success:function(server_response){  
                                    $('#details1').show();
                                   
                                    var data = $.parseJSON(server_response);
                                    var url = data[0]['WebURL'];
                                    document.getElementById('url1').value = url;
                                    var country = data[0]['Country'];
                                    document.getElementById('country1').value = country;
                                         }  
                  });  
               }); 
            });  

         </script>  

         <script>
           
            function show_project()
              {   
                   $('#project').show();
                  $('#resource').hide();
              }
              function show_Resource()
              {
                  $('#project').hide();
                  $('#resource').show();
              }

              function Save_Project()
              {

                var company = document.getElementById('company').value;

                if(company == "")
                {
                  alert("Please Select Company...");
                }
                else
                {
                  var type = $('input[name=Rtype]:checked').val(); 
                  var title = document.getElementById('project_title').value;
                  var Technical = document.getElementById('Technical').value;
                   var domain = document.getElementById('domain').value;
                    var Industry = document.getElementById('Industry').value;
                     var skill = document.getElementById('skill').value;
                     var our_date = document.getElementById('equal_our_date').value;

                     $.ajax({  
                         url:"<?php echo site_url('User/Save_project'); ?>",  
                        data: {company: company,type: type,Title: title,equal_our_date: our_date,tech: Technical,Industry:Industry,domain: domain,Skill: skill   },  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                          if(data == 1)
                          {
                             alert("Success");
                          //window.location.href = "<?php //echo site_url('User/cold_calling'); ?>";
                      // window.location.href = document.referrer;
                      location.reload();
                          }
                          else
                          {
                            alert("failed");
                          }
             
                     }  
                  }); 
                }


                
              }



              function Save_Resource()
              {

                   var company = document.getElementById('company').value;

                    if(company == "")
                    {
                       alert("Please Select Company...");
                    }
                    else
                    {

                       var type = $('input[name=Rtype]:checked').val();

                       var Technical = document.getElementById('STechnical').value;
                       alert(Technical);

                       // var skill = document.getElementById('Resource_skill').value;
                       var experience = document.getElementById('experience').value;
                       var timeline = document.getElementById('timeline').value;
                       var duration = document.getElementById('Duration').value;
                        var our_date = document.getElementById('equal_our_date1').value;
                        // var nor = document.getElementById('nor').value;
                  //       $.ajax({  
                  //        url:"<?php echo site_url('User/Save_Resource'); ?>",  
                  //       data: {company: company,type: type,Experience: experience,equal_our_date: our_date,tech: Technical,Duration:duration,Timeline: timeline   },  
                  //       type: "POST",  
                  //       cache: false,
                  //       success:function(data){ 
                  //         if(data == 1)
                  //         {
                  //            alert("Success");
                  //            location.reload();
                  //         }
                  //         else
                  //         {
                  //           alert("failed");
                  //         }
                         
                       

                  //    }  
                  // }); 


                    }


              }

         </script>


          <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        // $(function () {
        //     //Build an array containing Customer records.
        //     var customers = new Array();
         
        //     //Add the data rows.
        //     for (var i = 0; i < customers.length; i++) {
        //         AddRow(customers[i][0], customers[i][1]);
        //     }
        // });
 
        function Add() {

          if($('#STechnical').val() == "")
          {
            alert("Please Select technical Platform...");
          }
          else if($("#myTextArea").val() == "")
          {
            alert("Please Type Techical Skill...");
          }
          else if($("#experience").val() == "")
          {
            alert("Please Enter Minimum Experience...");
          }
          else if($("#timeline").val() == "")
          {
            alert("Please Select Interview Timeline..");
          }
          else if($("#equal_our_date1").val() == "")
          {
            alert("Please Select Date...");
          }
          else if($("#Duration").val() == "")
          {
            alert("Please Select Duration..");
          }
          else
          {
             AddRow($('#STechnical').val(), $("#myTextArea").val(),$("#experience").val(),$("#timeline").val(),$("#equal_our_date1").val(),$("#Duration").val());
            $("#STechnical").val("");
            $("#myTextArea").val("");
             $("#timeline").val("");
              $("#experience").val("");
               $("#equal_our_date1").val("");
                $("#Duration").val("");
          }

           
        };
 
        function AddRow(Technical, myTextArea,experience,timeline,equal_our_date1,Duration) {
            //Get the reference of the Table's TBODY element.

       
            var tBody = $("#tblCustomers > TBODY")[0];
 
            //Add Row.
            row = tBody.insertRow(-1);
 
            //Add Name cell.
            var cell = $(row.insertCell(-1));

             var tech = $("<input />");
            tech.attr("type", "text");
            tech.attr("name", "STechnical[]");
            tech.val(Technical);
           cell.append(tech); 
 
            //Add Country cell.
            cell = $(row.insertCell(-1));

             var Area = $("<input />");
            Area.attr("type", "text");
            Area.attr("name", "myTextArea[]");
            Area.val(myTextArea);
           cell.append(Area); 
           
        

             cell = $(row.insertCell(-1));
              var expr = $("<input />");
            expr.attr("type", "text");
            expr.attr("name", "experience[]");
            expr.val(experience);
           cell.append(expr); 

     
             cell = $(row.insertCell(-1));

                 var time = $("<input />");
            time.attr("type", "text");
            time.attr("name", "timeline[]");
            time.val(timeline);
           cell.append(time); 
           
           
             cell = $(row.insertCell(-1));
              var edate = $("<input />");
            edate.attr("type", "text");
            edate.attr("name", "equal_our_date1[]");
            edate.val(equal_our_date1);
           cell.append(edate); 


         




               cell = $(row.insertCell(-1));
                var a = $("<input />");
            a.attr("type", "text");
            a.attr("name", "Duration[]");
            a.val(Duration);

            cell.append(a);
 
            //Add Button cell.
            cell = $(row.insertCell(-1));
            var btnRemove = $("<input />");
            btnRemove.attr("type", "button");
            btnRemove.attr("onclick", "Remove(this);");
            btnRemove.val("Remove");
            cell.append(btnRemove);
        };
 
        function Remove(button) {
            //Determine the reference of the Row using the Button.
            var row = $(button).closest("TR");
            var name = $("TD", row).eq(0).html();
            if (confirm("Do you want to delete: ")) {
 
                //Get the reference of the Table.
                var table = $("#tblCustomers")[0];
 
                //Delete the Table row using it's Index.
                table.deleteRow(row[0].rowIndex);
            }
        };



</script>
 </body>
</html>

          