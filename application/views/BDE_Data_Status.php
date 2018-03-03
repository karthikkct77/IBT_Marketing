

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
     Data Status
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
            
            </div>
             
              <div class="box-body">
            
                <div class="row">
                 <div class="col-md-12">
                  <div class="col-md-3">
                   <div class="form-group">
                     <select name="BDE" class="form-control" id="BDE" required >
                        <option value="No" >Select BDE</option>
                        <?php foreach ($BDE as $row):
                        { 
                        echo "<option value= " .$row['User_Icode'].">" . $row['User_Name'] . "</option>";
                        } 
                        endforeach; ?>
                    </select> 
                  </div>
                 </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <button type="button"  class="btn btn-info" id="search" onclick="search_Data()" >Search</button>
                         <button type="button"  class="btn btn-success" id="reset" style="display: none;" onclick="get_rest()" >Reset</button>
                    </div>
                  </div>
               </div>
          </div>

          <div  id="status" style="display: none;">

          <div class="row">
          <div class="col-md-6">
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Status</h3>
            </div>
           <table id="demoPostTable1" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
                <th>Country</th>
                <th>New</th>
                <th>Cold</th>
                <th>Warm</th>
                <th>Hot</th>
                <th>Total</th>
                </thead>
            <tbody id="data_status">
              
            </tbody>
          </table>
            

          </div>
          </div>

          <div class="col-md-6">
           <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Followup Status</h3>
            </div>
             <table id="demoPostTable" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
                <th>Data Type</th>
                <th>Frequency</th>
                <th>Count</th>
               
                </thead>
            <tbody>
            <tr>
            <td>Cold</td>
            <td>Not called for 2 weeks</td>
            <td id="cold"></td>
            </tr>
            <tr>
            <td>Cold</td>
            <td>Not called for 1 month and more</td>
            <td id="cold1"></td>
            </tr>
            <tr>
            <td>Warm</td>
            <td>Not called for 2 weeks</td>
            <td id="Warm"></td>
            </tr>
            <tr>
            <td>Warm</td>
            <td>Not called for 1 month and more</td>
            <td id="Warm1"></td>
            </tr>
            <tr>
            <td>Hot</td>
            <td>Not called for 2 weeks</td>
            <td id="Hot"></td>
            </tr>
            <tr>
            <td>Hot</td>
            <td>Not called for 1 month and more</td>
            <td id="Hot1"></td>
            </tr>
              
            </tbody>
          </table>

            </div>
          </div>

          </div>


           <div class="row">
              <div class="col-md-6">
             <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Total Call for Month -- 
              <span id="total_month" style="color: #ff001b;font-size: 25px;"></span></h3>

            </div>
             <table id="demoPostTable1" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
                <th>Country</th>
                <th>New</th>
                <th>Cold</th>
                <th>Warm</th>
                <th>Hot</th>
               
                </thead>
            <tbody id="month">
              
            </tbody>
          </table>

            </div>
          </div>

          <div class="col-md-6">
           <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Decision Makers Reached (this month) --
              <span id="dm_month" style="color: #ff001b;font-size: 25px;"></span></h3>
            </div>
             <table id="demoPostTable1" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
                <th>Country</th>
                <th>Cold</th>
                <th>Warm</th>
                <th>Hot</th>
               
                </thead>
            <tbody id="DM">
              
            </tbody>
          </table>

            </div>
          </div>

          </div>

           <div class="row">
 
          <div class="col-md-6">
             <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Conversions (for the month) --
               <span id="conv_month" style="color: #ff001b;font-size: 25px;"></span></h3>
            </div>
             <table id="demoPostTable1" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
                <th>Country</th>
                
                <th>Cold -> Warm</th>
                <th>Warm -> Hot</th>
                
               
                </thead>
            <tbody id="conversion">
              
            </tbody>
          </table>

            </div>
          </div>

          <div class="col-md-6">
           <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Meetings Organized</h3>
            </div>
             <table id="demoPostTable1" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
                <th>Country</th>
                <th>Count</th>
               
                </thead>
            <tbody id="meeting">
              
            </tbody>
          </table>

            </div>
          </div>

          </div>
         

            
          </div>





                   </div>
                  </div>
                  </div>
                  </div>

              
          
          </div>
          </div>
</div>
</section>






<script>

function get_rest()
 {
  location.reload();

 }
function search_Data()
{
var BDE = document.getElementById('BDE').value;
if(BDE == 'No')
{
  alert("Please Select BDE..");
}
 else
  {
     $.ajax({  
                        url:"<?php echo site_url('User/search_Data_Status'); ?>",  
                        data: {bde: BDE},  
                        type: "POST",  
                        success:function(server_response){ 

                        var data = $.parseJSON(server_response);

                        var count = Object.keys(data.data_status).length;
                        $("#status").show();
                        $("#search").hide();
                        $("#reset").show();


                              $("#cold").append(data.Followup['Cold']);
                           $("#cold1").append(data.Followup['Cold1']);
                           $("#Warm").append(data.Followup['Warm']);
                           $("#Warm1").append(data.Followup['Warm1']);
                           $("#Hot").append(data.Followup['Hot']);
                           $("#Hot1").append(data.Followup['Hot1']);
                            $("#conv_month").append(data.Conversion_month['counts']);
                              $("#total_month").append(data.total_month['counts']);
                              $("#dm_month").append(data.Dm_count['counts']);

                           var count_tot = Object.keys(data.total_month).length;
                           //alert(count_tot);

                         


                        for(var i = 0; i < count; i++)
                        {
                              week = data.data_status[i];
                              $("#data_status").append("<tr><td>" + week.Country + "</td><td>" + week.New+ "</td><td>" + week.Cold+ "</td><td>" + week.Warm+ "</td><td>" + week.Hot+ "</td><td>" + week.Total+ "</td><td>");
                          }

                          var count_month = Object.keys(data.Month).length;

                           for(var i = 0; i < count_month; i++)
                        {
                              week = data.Month[i];
                               if(week.Country == null) 
                               {

                               }
                               else
                               {
                                 $("#month").append("<tr><td>" + week.Country + "</td><td>" + week.New+ "</td><td>" + week.Cold+ "</td><td>" + week.Warm+ "</td><td>" + week.Hot+ "</td><td>");
                               }

                             
                          }

                          var count_dm = Object.keys(data.DM).length;

                           for(var i = 0; i < count_dm; i++)
                          {
                                week = data.DM[i];
                                 if(week.Country == null) 
                                 {

                                 }
                                 else
                                 {
                                   $("#DM").append("<tr><td>" + week.Country + "</td><td>" + week.Cold+ "</td><td>" + week.Warm+ "</td><td>" + week.Hot+ "</td><td>");
                                 }

                               
                            }


                          var count_conv = Object.keys(data.Conversion).length;

                         // alert("count_jjjjjjconv");

                           for(var i = 0; i < count_conv; i++)
                        {
                              week = data.Conversion[i];
                               if(week.Country == null) 
                               {

                               }
                               else
                               {
                                 $("#conversion").append("<tr><td>" + week.Country + "</td><td>" + week.Warm+ "</td><td>" + week.Hot+ "</td><td>");
                               }

                             
                          }

                           var count_meeting = Object.keys(data.Meeting).length;

                          //alert("aaaaaaaaaa");

                           for(var i = 0; i < count_meeting; i++)
                        {
                              week = data.Meeting[i];
                               if(week.Country == null) 
                               {
                               // alert("0");

                               }
                               else
                               {
                               // alert("1");
                                 $("#meeting").append("<tr><td>" + week.Country + "</td><td>" + week.counts+ "</td><td>");
                               }

                             
                          }

                          //alert("fffff");
                        }

                   
                  }); 
  }

 
}




</script>





 </body>
</html>

          