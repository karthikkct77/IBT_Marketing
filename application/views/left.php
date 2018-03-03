             
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php
            if($_SESSION['gender'] == 'male')
            {
              ?>
               <img src="<?php echo base_url('img/male1.png'); ?>" class="img-circle" alt="User Image">
               <?php
            }
            else
            {
              ?>
               <img src="<?php echo base_url('img/female.png'); ?>" class="img-circle" alt="User Image">
               <?php

            }
            ?>

         
        </div>
        <div class="pull-left info">
          <p><?php echo("{$_SESSION['fname']}");?></p>
 
          <a href="<?php echo site_url('Welcome/logout'); ?>"><i class="glyphicon glyphicon-off"></i>Sign out</a>
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
         <li>
          <a href="<?php echo site_url('User/dashboard'); ?>">
            <i class="fa fa-th"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            
            </span>
          </a>
        </li>
         <li>
          <a href="<?php echo site_url('User/cold_calling'); ?>">
            <i class="fa fa-th"></i> <span>Cold Calling</span>
            <span class="pull-right-container">
            
            </span>
          </a>
        </li>
             <li class="treeview">
       <a href="<?php echo site_url('User/View_FollowUp_Data'); ?>">
             <i class="fa fa-th"></i> <span>Warm/Hot Leads</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="<?php echo site_url('User/Today_FollowUp_Data'); ?>"><i class="fa fa-circle-o"></i>Today's Followup </a></li>
            <li><a href="<?php echo site_url('User/View_FollowUp_Data'); ?>"><i class="fa fa-circle-o"></i>Other Followup</a></li>
           
          </ul>
        </li>
         <li class="treeview">
       <a href="">
             <i class="fa fa-th"></i> <span>Requirements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="<?php echo site_url('User/New_Requirement'); ?>"><i class="fa fa-circle-o"></i>New Requirements </a></li>
            <li><a href="<?php echo site_url('User/List_Requirement'); ?>"><i class="fa fa-circle-o"></i>List of Requirements</a></li>
           
          </ul>
        </li>
       
       <!--  <li>
          <a href="<?php echo site_url('User/View_Meeting_Status'); ?>">
            <i class="fa fa-th"></i> <span>Meeting Status</span>
            <span class="pull-right-container">
            
            </span>
          </a>
        </li>-->
         <li>
          <a href="<?php echo site_url('User/Prospect_Client_Search'); ?>">
            <i class="fa fa-th"></i> <span>Prospect/Client Search</span>
            <span class="pull-right-container">
            
            </span>
          </a>
        </li>
        <!--  <li>
          <a href="<?php echo site_url('User/Prospect_Analysis_Data'); ?>">
            <i class="fa fa-th"></i> <span>Prospect Analysis</span>
            <span class="pull-right-container">
            
            </span>
          </a>
        </li> -->

         <li class="treeview">
       <a href="">
             <i class="fa fa-th"></i> <span>Prospect Analysis</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="<?php echo site_url('User/Prospect_Analysis_Data'); ?>"><i class="fa fa-circle-o"></i>Add Analysis </a></li>
            <li><a href="<?php echo site_url('User/View_Prospect_Analysis_Data'); ?>"><i class="fa fa-circle-o"></i>View Analysis</a></li>
           
          </ul>
        </li>


         <?php 
         if($_SESSION['active'] == 'Yes')
         {
          ?>
         <li>
          <a href="<?php echo site_url('User/Review'); ?>">
            <i class="fa fa-th"></i> <span>Prospect Review</span>
            <span class="pull-right-container">
            
            </span>
          </a>
        </li>
          <li class="treeview">
               <a href="<?php echo site_url('User/View_FollowUp_Data'); ?>">
               <i class="fa fa-th"></i> <span>My Team</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
              </a>
          <ul class="treeview-menu">
           <li><a href="<?php echo site_url('User/BDE_Status'); ?>"><i class="fa fa-circle-o"></i>BDE Status </a></li>
           <li><a href="<?php echo site_url('User/Data_Status'); ?>"><i class="fa fa-circle-o"></i>Data Status </a></li>
            
           
          </ul>
        </li>

          <?php
      }
      else
      {
      
      }  
      ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>