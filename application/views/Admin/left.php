
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('img/male.png'); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>ADMIN :<?php echo("{$_SESSION['fname']}");?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
         <li>
          <a href="<?php echo site_url('welcome/Admin_dashboard'); ?>">
            <i class="fa fa-th"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            
            </span>
          </a>
        </li>
         <li>
          <a href="<?php echo site_url('welcome/Data_Import'); ?>">
            <i class="fa fa-th"></i> <span>Data Import</span>
            <span class="pull-right-container">
            
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Data Allocate</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="<?php echo site_url('welcome/BDE_Status'); ?>"><i class="fa fa-circle-o"></i>BDE Status</a></li>
            <li><a href="<?php echo site_url('welcome/new_allocate'); ?>"><i class="fa fa-circle-o"></i>New Allocate</a></li>
            <li><a href="<?php echo site_url('welcome/Re_allocate'); ?>"><i class="fa fa-circle-o"></i> Re-Allocate</a></li>
          </ul>
        </li>
         <!--  <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>BDE Allocate</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
        
            <li><a href="<?php echo site_url('welcome/BDE_Allocate'); ?>"><i class="fa fa-circle-o"></i>BDE Allocate</a></li>
            <li><a href="<?php echo site_url('welcome/Re_allocate'); ?>"><i class="fa fa-circle-o"></i> Re-Allocate</a></li>
          </ul>
        </li> -->
     
         <li>
          <a href="<?php echo site_url('welcome/Review'); ?>">
            <i class="fa fa-th"></i> <span>Data Analysis Review</span>
            <span class="pull-right-container">
            
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('welcome/DNDReview'); ?>">
            <i class="fa fa-th"></i> <span>DND&CNE Review</span>
            <span class="pull-right-container">
            
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('welcome/Data_Correction_Review'); ?>">
            <i class="fa fa-th"></i> <span>Data Correction Review</span>
            <span class="pull-right-container">
            
            </span>
          </a>
        </li>
       
       
    
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>