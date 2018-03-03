
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
     Data Review
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
            
<table id="demoPostTable" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">

<thead>
    <tr>
         
        <th>User Name</th>
        <th></th>
      
   
    </tr>
    </thead>
 
            <tbody id="newtab">
                 
               
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
</section>






<script>


$(document).ready(function(){
$.ajax({ url: "<?php echo site_url('User/get_Review_Data'); ?>",
        context: document.body,
        success: function(data){
            $("#newtab").html(data);  
        }});
});





</script>





 </body>
</html>

          