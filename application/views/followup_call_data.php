
<script>
    $(document).ready( function () {

        $('#demoPostTable').addClass( 'nowrap' ).DataTable( {
            responsive: false
        });
        $('#demoPostTable1').addClass( 'nowrap' ).DataTable( {
            responsive: false
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
           Other Followup Call 
            <small></small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <ul class="nav nav-tabs" role="tablist" id="myTab">
            <li role="presentation" ><a href="<?php echo site_url('User/Today_FollowUp_Data'); ?>" >Today Follow up</a></li>
            <li role="presentation" class="active" ><a href="<?php echo site_url('User/View_FollowUp_Data'); ?>" aria-controls="profile" role="tab" data-toggle="tab">Other Followup </a></li>
              

        </ul>

 
  

 

 <div class="row" id="collapse_our" >
 <div class="col-md-12">
 <div class="box box-primary">
 <div class="box-body">
  <table id="demoPostTable2" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
  <h3 style="color: red">HOT</h3>
 
 <tr>
<?php
foreach ($user_data as $key ) {
    ?>

    <th><?php echo $key['Country']; ?></th>

    <?php
   
}
?>
</tr>
<tr>

<?php
foreach ($user_data as $key ) {
    ?>


    <th><a href='get_country_wise_called_data_Hot/<?php echo $key['Country']; ?>'><?php echo $key['counts']; ?></a></th>

    <?php
   
}
?>
</tr>
 </table>
 </div>
 </div>
 </div>
 </div>




 <div class="row" id="collapse_our" >
 <div class="col-md-12">
 <div class="box box-primary">
 <div class="box-body">
  <table id="demoPostTable2" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
 <h3 style="color: #0bc829">Warm</h3>
 
 <tr>
<?php
foreach ($user_data_warm as $key ) {
    ?>

    <th><?php echo $key['Country']; ?></th>

    <?php
   
}
?>
</tr>
<tr>

<?php
foreach ($user_data_warm as $key ) {
    ?>


    <th><a href='get_country_wise_called_data_Warm/<?php echo $key['Country']; ?>'><?php echo $key['counts']; ?></a></th>

    <?php
   
}
?>
</tr>
 </table>
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


