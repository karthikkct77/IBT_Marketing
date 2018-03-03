<script>
$(document).ready( function () {
 
    $('#demoPostTable').addClass( 'nowrap' ).DataTable( {
                    responsive: true
                });
} );
$(document).ready(function(){
    $('#myTable').DataTable();
});
      </script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
   Prospect Client Search
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
             
            <!-- /.box-header -->
         
              <div class="box-body">
                <div class="row">
                <div class="col-md-12">
       <div class="col-md-3"> 
                <label>Company Name</label>
                  <div class="form-group">
            <input type="text" class="form-control" name="company"  id="company" value="" placeholder="Enter Company Name"> 
            </div>
               

                </div>
                    <div class="col-md-3"> 
                <label>URL</label>
                  <div class="form-group">
            <input type="text" class="form-control" name="url"  id="url" value="" placeholder="Enter Company Url"> 
            </div>
               

                </div>
                 <div class="col-md-3"> 
                <label>Contact Number</label>
                  <div class="form-group">
            <input type="text" class="form-control" name="phone"  id="phone" value="" placeholder="Enter Company Phone"> 
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
                <table id="demoPostTable"  data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead>
            
                <th>Company Name</th>
                <th>Company URL</th>
                <th>Contact Number</th>
                <th>Country</th>
                <th></th>

                 
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
 <div class="control-sidebar-bg"></div>
  </div>
  </body>
</html>
<script>


function search_Data()
{
 
 

var company = document.getElementById('company').value;
var url = document.getElementById('url').value;
var phone = document.getElementById('phone').value;


     $.ajax({  
                        url:"<?php echo site_url('User/search_Company'); ?>",  
                        data: {company1: company,url1: url,phone1: phone },  
                        type: "POST",  
                        success:function(data){ 

                        $('#fulldata').show();
                        $('#comments1').html(data);

                     }  
                  }); 
  

 
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




          