<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Data Import
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
              <h3 class="box-title">Data Import</h3>
            </div>
              <?php if($this->session->flashdata('message')){?>
          <div class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } ?>
            <!-- /.box-header -->
            <!-- form start -->
                <img src="<?php echo base_url('img/ajax-loader.gif'); ?>" id="gif" style="display: block; margin: 0 auto; width: 200px; visibility: hidden;">

           <form method="post" id="login_form" role="form" action="<?php echo site_url('welcome/ExcelDataAdd'); ?>" enctype="multipart/form-data" name="data_register">
              <div class="box-body">
              <div class="row">
              <div class="col-md-2">
               <div class="form-group">
                
                  <input type="file" id="exampleInputFile" name="userfile" required>
                  

                </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                 <button id="myBtn" type="submit" class="btn btn-primary">Upload</button>
                 </div>
                </div>
                <div class="col-md-4">
                <?php 

                 ?>
              
                </div>


               
              </div>
              </div>
               
              </div>
              <!-- /.box-body -->

            </form>
          </div>
          <!-- /.box -->

        </div>
        </div>

        <div>

         <?php
                if(isset($first) && is_array($first) && count($first)): $i=1;
                foreach ($first as $key ) { 
                ?>
                 <h4>Row : <?php echo $key ?> Column 2  (Company Name) is Empty</h4>


  <?php
}
 else:
?>
<h4></h4>
<?php
endif;
?>




         <?php
                if(isset($second) && is_array($second) && count($second)): $i=1;
                foreach ($second as $key ) { 
                ?>
                 <h4>Row : <?php echo $key ?> Column 6 (Web URL) is Empty</h4>


  <?php
}
 else:
?>
<h4></h4>
<?php
endif;
?>

 <?php
                if(isset($third) && is_array($third) && count($third)): $i=1;
                foreach ($third as $key ) { 
                ?>
                 <h4>Row : <?php echo $key ?> Column 11 (Contact_Number) is Empty</h4>


  <?php
}
 else:
?>
<h4></h4>
<?php
endif;
?>




 </div>
</div>


 </section>
  </div>
 <div class="control-sidebar-bg"></div>
</div>

<script>
$('#login_form').submit(function() {
    $('#gif').css('visibility', 'visible');
});
</script>
</body>
</html>
 