<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
     Prospect Call
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
                <form method="post" role="form" action="<?php echo site_url('User/Prospect_Data_Call'); ?>" name="data_register">
                <div class="col-md-3">
                 <div class="form-group">
               
                  <select name="Company_country" class="form-control" id="country" required >
                     <option value="" >Select Country</option>
           <?php foreach ($user_data as $row):
            { 

                echo "<option value= " .$row['Country'].">" . $row['Country'] . "</option>";

           } 
           endforeach; ?>
           </select> 
                </div>
             
              </div>
              <div class="col-md-3">
                 <div class="form-group">


                     <select name="state" id="state" class="form-control">
          
           </select> 
           
              
             
              </div>
              </div>
               <div class="col-md-3">
                 <div class="form-group">


                     <select name="City" id="city" class="form-control">
          
           </select> 
           
              
             
              </div>
              </div>
             
             
              <div class="col-md-3">
              <div class="form-group">
              
              <button type="submit"  class="btn btn-info" id="test" >Search</button>
             
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




  <script type="text/javascript">  
                  $(document).ready(function() {  
                     $("#country").change(function(){  
                    //  alert("hiiii");
                     /*dropdown post *///  
                     $.ajax({  
                        url:"<?php echo site_url('User/get_country_state'); ?>",  
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
                        url:"<?php echo site_url('User/get_state_city'); ?>",  
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

          