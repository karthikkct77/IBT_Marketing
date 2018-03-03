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
   Data Correction Review
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
           <?php foreach ($data_country as $row):
            { 

                echo "<option value= " .$row['Country'].">" . $row['Country'] . "</option>";

           } 
           endforeach; ?>
           </select> 
                </div>
             
              </div>
              
           

              <div class="col-md-3">
              <div class="form-group">
              
              <button type="button"  class="btn btn-info" onclick="search_Data()" >Search</button>
             
              </div>
              </div>
          
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
                <th>Edit</th>

                 
                </thead>
                <tbody id="comments1">
               
                
                </tbody>
                
              </table>
                
              </div>
          </div>
          </div>
</div>



 

</div>



      
</div>
</section>
 </div>


<script>


function search_Data()
{
 
 

var country = document.getElementById('country').value;

if(country == 'No')
{
  alert("Please Select Country..");
}
 else
  {
     $.ajax({  
                        url:"<?php echo site_url('welcome/search_Data_Correction'); ?>",  
                        data: {country: country},  
                        type: "POST",  
                        success:function(data){ 

                        $('#fulldata').show();
                        $('#comments1').html(data);

                     }  
                  }); 
  }

 
}


// function view_data(id)
// {
//  $("#a"+id).addClass('open');
//  $("#a"+id).slideToggle();
//  var $this = "#a"+id;
//   $("#a"+id).not($this).close();
//  //if ("#a"+id.style.display == 'none') "#a"+id.style.display = 'block';
// }


</script>




 </body>
</html>

          