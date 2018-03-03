
<script>
    $(document).ready( function () {

        $('#demoPostTable').addClass( 'nowrap' ).DataTable( {
            responsive: true
        });
        $('#demoPostTable1').addClass( 'nowrap' ).DataTable( {
            responsive: true
        });
         $('#demoPostTable2').addClass( 'nowrap' ).DataTable( {
            responsive: true
        });



    } );

</script>

<style>
    .foo {
        float: left;
        width: 20px;
        height: 20px;
        margin: 5px;
        border: 1px solid rgba(0, 0, 0, .2);
    }

    .blue {
        background: #F85B5B;
    }
</style>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Missed Call
            <small></small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <ul class="nav nav-tabs" role="tablist" id="myTab">
           <!--  <li role="presentation" class="active"><a href="<?php echo site_url('User/Today_FollowUp_Data'); ?>" aria-controls="home" role="tab" data-toggle="tab">Missed Call</a></li> -->
            <!-- <li role="presentation"><a href="<?php echo site_url('User/View_FollowUp_Data'); ?>" >Other Followup </a></li> -->
              

        </ul>

 <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
        <div class="row" id="collapse_our" >
 <div class="col-md-12">
 <div class="box box-primary">
 <div class="box-body">
  <table id="demoPostTable2" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
  <h3 style="color: red">HOT</h3>
  <thead>
      <tr>
            <th>Company Name</th>
            <th>Phone Number</th>
            <th>Client Date/Time</th>
            <th>Our Date/Time</th>
           
            <th></th>
      </tr>
  </thead>
 
 <tbody>
 

<?php 
foreach($Missed_call_Hot as $r) 
{
?>
<tr>
 <td><?php echo $r['Company_Name']; ?><br><?php echo $r['WebURL']; ?><br><?php echo $r['Country']; ?></td>
 <td><?php echo $r['Company_Contact']; ?></td>
  <td ><?php echo $r['Next_Call_Date']; ?></td>
  <td ><?php echo $r['Equiv_our_date']; ?></td>
  
  <td>
           <?php 
        if( $r['Meeting_Type_Icode'] != "")
        {
        ?>
                <a class="btn btn-primary" href="<?php echo site_url('User/Meeting_Call/'. $r['Prospect_Icode'].''); ?>" > <i class="glyphicon glyphicon-zoom-in icon-white"></i> Meeting
                </a>
        <?php
        }
        else
        {
        ?>
                <form method="post" role="form" action="<?php echo site_url('User/Prospect_followup_Call'); ?>"   enctype="multipart/form-data" name="data_register">
                <input type="hidden" name="prospect_Icode" value="<?php echo $r['Prospect_Icode'];  ?>">
                <button id="myBtn" class="btn btn-success btn-sm" value="<?php echo $r['Prospect_Icode']; ?>" > <i class="glyphicon glyphicon-earphone"></i>Call</button>

                </form>
        <?php
        }
        ?>
</td>
    </tr>
<?php
}
 ?>

 </tbody>
 </table>
 </div>
 </div>
 </div>
 </div>




 <div class="row" id="collapse_our" >
 <div class="col-md-12">
 <div class="box box-primary">
 <div class="box-body">
  <table id="demoPostTable1" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
 <h3 style="color: #0bc829">Warm</h3>
<thead>
        <tr>
                <th>Company Name</th>
                <th>Phone Number</th>
                <th>Client Date/Time</th>
                <th>Our Date/Time</th>
                
                <th></th>
        </tr>
</thead>
 <tbody>
 

<?php 
foreach($Missed_call_Warm as $r) 
{
?>
<tr>
                <td><?php echo $r['Company_Name']; ?><br><?php echo $r['WebURL']; ?><br><?php echo $r['Country']; ?></td>
                <td><?php echo $r['Company_Contact']; ?></td>
                <td ><?php echo $r['Next_Call_Date']; ?></td>
                <td ><?php echo $r['Equiv_our_date']; ?></td>
                 
              
                <?php 
                if( $r['Meeting_Type_Icode'] != "0")
                {
                ?>
                    <td>
                    <a class="btn btn-primary" href="<?php echo site_url('User/Meeting_Call/'. $r['Prospect_Icode'].''); ?>" > <i class="glyphicon glyphicon-zoom-in icon-white"></i> Meeting
                    </a></td>
                <?php
                }
                else
                {
                if($r['Prospect_Status'] == 'Cold')
                {
                ?>
                        <td>
                        <a class="btn btn-success" href="<?php echo site_url('User/Prospect_Data_Call_Client_date/'. $r['Prospect_Icode'].''); ?>" > <i class="glyphicon glyphicon-zoom-in icon-white"></i> Call
                        </a></td>
                <?php
                }
                else
                {
                ?>
                        <td>  <a class="btn btn-success" href="<?php echo site_url('User/Warm_Data_Call_Client_date/'. $r['Prospect_Icode'].''); ?>" > <i class="glyphicon glyphicon-zoom-in icon-white"></i> Call
                        </a></td>
                <?php
                }
                }
                ?>
          </tr>
<?php
}
 ?>

 </tbody>
 </table>
 </div>
 </div>
 </div>
 </div>



  <div class="row" id="collapse_our" >
 <div class="col-md-12">
 <div class="box box-primary">
 <div class="box-body">
  <table id="demoPostTable" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
 <h3 style="color: #0fc5f6">Cold</h3>
 <thead>
        <tr>
                <th>Company Name</th>
                <th>Phone Number</th>
                <th>Client Date/Time</th>
                <th>Our Date/Time</th>
               
                <th></th>
        </tr>
</thead>
 <tbody>
 

<?php 
foreach($Missed_call_Cold as $r) 
{
?>

        <tr>
                <td><?php echo $r['Company_Name']; ?><br><?php echo $r['WebURL']; ?><br><?php echo $r['Country']; ?></td>
                <td><?php echo $r['Company_Contact']; ?></td>
                <td ><?php echo $r['Next_Call_Date']; ?></td>
                <td ><?php echo $r['Equiv_our_date']; ?></td>
                
              
                <?php 
                if( $r['Meeting_Type_Icode'] != "0")
                {
                ?>
                        <td>
                        <a class="btn btn-primary" href="<?php echo site_url('User/Meeting_Call/'. $r['Prospect_Icode'].''); ?>" > <i class="glyphicon glyphicon-zoom-in icon-white"></i> Meeting
                        </a></td>
                <?php
                }
                else
                {
                if($r['Prospect_Status'] == 'Cold')
                {
                ?>
                        <td>
                        <a class="btn btn-success" href="<?php echo site_url('User/Prospect_Data_Call_Client_date/'. $r['Prospect_Icode'].''); ?>" > <i class="glyphicon glyphicon-zoom-in icon-white"></i> Call
                        </a></td>
                <?php
                }
                else
                {
                ?>
                        <td>  <a class="btn btn-success" href="<?php echo site_url('User/Warm_Data_Call_Client_date/'. $r['Prospect_Icode'].''); ?>" > <i class="glyphicon glyphicon-zoom-in icon-white"></i> Call
                        </a></td>
                <?php
                }
                }
                ?>
        </tr>
<?php
}
 ?>

 </tbody>
 </table>
 </div>
 </div>
 </div>
 </div>
 </div>

 </section>

</div>
<div class="control-sidebar-bg"></div>
</div>


<script type="text/javascript">



    $(function() {
        $('a[data-toggle="tab"]').on('click', function(e) {
            window.localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = window.localStorage.getItem('activeTab');

        
        if (activeTab) {
            $('#myTab a[href="' + activeTab + '"]').tab('show');
            window.localStorage.removeItem("activeTab");
        }
    });
</script>


</body>
</html>


