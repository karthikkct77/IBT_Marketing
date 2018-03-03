<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Change Password
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
              <h3 class="box-title">Change Password</h3>
            </div>
              <?php if($this->session->flashdata('message')){?>
          <div class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } ?>
            <!-- /.box-header -->
            <!-- form start -->
         
              <div class="box-body">
              <div class="row">
              <div class="col-md-6">
               <form method="post" role="form" action="<?php echo site_url('User/save_password'); ?>" onSubmit="return validatePassword()" name="data_register">
                
                
                  <div class="form-group">
                     <label>Current Password</label>
                <input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Current Password" required >
           
                </div>
                 
                   <div class="form-group">
                     <label>New Password</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password" required>
           
                </div>

                   <div class="form-group">
                     <label>Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="New Password" required>
           
                </div>
                   
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
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
