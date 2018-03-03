<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      BDE Allocation
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
             <h3 class="box-title">Allocate </h3>
            </div>
            
         
              <div class="box-body">
                <div class="row">
                <div class="col-md-12">
                 <form id="search_form">
                <div class="col-md-3">
                 <div class="form-group">
                 <label>Select Leader</label>
               
                  <select name="leader_name" class="form-control" id="leader_name" required >
                     <option value="" >Select Leader</option>
           <?php foreach ($Leader as $row):
            { 

                echo "<option value= " .$row['User_Icode'].">" . $row['User_Name'] . "</option>";

           } 
           endforeach; ?>
           </select> 
                </div>
             
              </div>
              <div class="col-md-3">
                 <div class="form-group">
                 <label>Select BDE</label>
                 <select name="leader_name" class="form-control" id="leader_name" required >
                     <option value="" >Select BDE</option>
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
              
              <button type="button"  class="btn btn-info" id="test" >Search</button>
              
              </div>
              </div>
              </form>
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

          