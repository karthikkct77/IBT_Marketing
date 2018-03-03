

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
            
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

<thead>
    <tr>
         
        <th>User Name</th>
      
   
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
$.ajax({ url: "<?php echo site_url('welcome/get_Review_Data'); ?>",
        context: document.body,
        success: function(data){
            $("#newtab").html(data);  
        }});
});





</script>





 </body>
</html>

          