
    <!-- CSS imports -->
    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
 

    <!-- datatable css -->
    <link href="http://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet">
    
    <!-- datatable responsive css -->
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/responsive/1.0.0/css/dataTables.responsive.css">

    
 
 <!-- JS imports -->
 
    <!-- jQuery JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

     <!-- bootstrap JS -->
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

    <!-- data table js -->
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    
    <!-- data table responsive js -->
    <script type="text/javascript" src="http://cdn.datatables.net/responsive/1.0.0/js/dataTables.responsive.min.js"></script>
    


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>

<script>
$(document).ready( function () {
 
    $('#demoPostTable').addClass( 'nowrap' ).DataTable( {
                    responsive: true
                });
 


} );

</script>


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
         
              <div class="box-body">
                <div class="row">
                 <img src="<?php echo base_url('img/ajax-loader.gif'); ?>" id="gif" style="display: block; margin: 0 auto; width: 200px; visibility: hidden;">
                   <!-- form start -->
           <form method="post" role="form" id="login_form" action="<?php echo site_url('welcome/ExcelDataAdd'); ?>" enctype="multipart/form-data" name="data_register">
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
                   </form>
                <div class="col-md-4">
                <?php

                if($status == '0') 
                {
                  ?>
                  <h3>No empty Rows </h3>
                  <?php

                }
                else
                {
                 ?>
                   <button name="client_id" class="btn btn-success btn-sm"   data-toggle="modal" data-target="#myModal" 
                         onclick=""
                         ><i class="glyphicon glyphicon-eye-open"></i>View Empty Rows</button>
                         <?php

                }

                 ?>
              
                </div>


               
              </div>
              </div>
              <!-- /.box-body -->

         
          </div>
          <!-- /.box -->

        </div>
        </div>

            <!-- form start -->
          

    



            <div class="box">
            <div class="box-header">
            
            <div class="box-body" id="mainhead">
              <div class="modal-body" ><p></p></div>
              <h3 class="box-title">TOTAL Records: <?php echo $total ?> </h3>
              <h3 class="box-title"></h3>
              <h3 class="box-title" >
               <img src="<?php echo base_url('img/ajax-loader.gif'); ?>" id="gif" style="display: block; margin: 0 auto; width: 200px; visibility: hidden;">

<button name="client_id2" class="btn btn-default btn-sm"   data-toggle="modal" data-target="#myModal1" 
                         id="comments" style="display:none" onclick="getVal()" 
                         ></button></h3>
                         <h3 class="box-title">  <button type="button" id="import" style="display:none" class="btn btn-success" onclick="import_new()" >Import</button></h3>

            <!--  <a href="<?php echo site_url('welcome/view_duplicate'); ?>"  id="comments"> </a> </h3> -->
               <h3 class="box-title" ><a href=""  style="display:'noneid="no"> </a> </h3>


              <?php

              if($filename == 'empty')
              {

              }
              else
              {
                ?>
                  <h3 class="box-title">
                   <img src="<?php echo base_url('img/ajax-loader.gif'); ?>" id="gif" style="display: block; margin: 0 auto; width: 200px; visibility: hidden;">
                  <form method="post" id="add_form" role="form" action="<?php echo site_url('welcome/Check_Duplicate'); ?>" enctype="multipart/form-data" name="data_register">
  <input type="hidden" name="filename" value="<?php echo $filename ?> " id="register_form1">

                 <button id='register_submit' type="submit" class="btn btn-primary" >Check Duplicate</button>

                 </form>
                 </h3>
             
            <?php

              }
              ?>
          
             <table id="demoPostTable" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead>
      <th>Sno</th>
                <th>Company Name</th>
                <th>Company URL</th>
                 <th>Address</th>
                 <th>City</th>
                 <th>State</th>
                 <th>Country</th>
                  <th>Contact Number</th>
                   <th>Email</th>
                   <th>Employee Count</th>
               
                </thead>
                <tbody>
                 <?php
                if(isset($datas) && is_array($datas) && count($datas)): $i=1;
                $a = $this->uri->segment(3);

                foreach ($datas as $key => $data) { 
                  $a++;
                ?>
                <tr <?php if($i%2==0){echo 'class="even"';}else{echo'class="odd"';}?>>
                 <td><?php echo $i; ?></td>
              
                    <td><?php echo $data['Company_Name']; ?></td>            
                    <td><?php echo $data['WebURL']; ?></td>
                    <td><?php echo $data['Address']; ?></td>
                    <td><?php echo $data['City']; ?></td>
                    <td><?php echo $data['State']; ?></td>
                    <td><?php echo $data['Country']; ?></td>
                    <td><?php echo $data['Company_Contact']; ?></td>
                    <td><?php echo $data['Company_Email']; ?></td>
                    <td><?php echo $data['Emp_Count']; ?></td>
                   
                </tr>
                <?php
                    $i++;
                      }
                    else:
                ?>
                <tr>
                    <td colspan="7" align="center" >No Record Found Please Upload File</td>
                </tr>
                <?php
                    endif;
                ?>

                
                </tbody>
                
              </table>
              </div>
     








                      <div id="mewdiv" style="display:none">
                      <div class="modal-body" ><p></p></div>
                      <div class="box-title" >Total Records: <h2 id="length" ></h2></h3></div>
                        <button type="button" class="btn btn-success" onclick="import_duplicate()" >Import</button>
             

                    <table id="demoPostTable" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead>
              
                <th>Company Name</th>
                <th>Company URL</th>
                <th>Contact Number</th>
                <th>Country</th>
                 <th>State</th>
                 
                 <th>City</th>
               
                   <th>Employee Count</th>
               
                </thead>
                <tbody id="newtab">
                 
               
                </tbody>

                
              </table>
            
              </div>






             
              </div>


               <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Empty Rows Details</h4>

            </div>
            <div class="modal-body" id="comments">
              

    <div>

         <?php
                if(isset($first) && is_array($first) && count($first)): $i=1;
                foreach ($first as $key ) { 
                   if($key == '0')
                  {
                    echo "";
                  }
                  else
                  {

                ?>
                 <h4>Row <?php echo $key ?>  Column 1 Empty</h4>


  <?php
}
}
 else:
?>
<h4>No Empty Rows</h4>
<?php
endif;
?>




         <?php
                if(isset($second) && is_array($second) && count($second)): $i=1;
                foreach ($second as $key ) { 
                   if($key == '0')
                  {
                    echo "";
                  }
                  else
                  {

                ?>
                 <h4>Row : <?php echo $key ?> Column 2 Empty</h4>


  <?php
}
}
 else:
?>
<h4>No Empty Rows</h4>
<?php
endif;
?>
<?php
                if(isset($third) && is_array($third) && count($third)): $i=1;
                foreach ($third as $key ) { 
                  if($key == '0')
                  {
                    echo "";
                  }
                  else
                  {


                ?>

                 <h4>Row : <?php echo $key ?> Column 11 (Contact_Number) is Empty</h4>


  <?php
   }
}
 else:
?>
<h4>No Empty Rows</h4>
<?php
endif;
?>


        </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             
        </div>
    </div>
</div>
</div>



<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Duplicate Record Details</h4>

            </div>
            <div class="modal-body">



             <table id="demoPostTable1" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead>
                <th><input type="checkbox" id="selectall"/></th>
             
                <th>Company Name</th>
                <th>Company URL</th>
                <th>Contact Number</th>
                 
                </thead>
                <tbody id="comments1">
                <tr>

                </tr>
                
                </tbody>
                
              </table>
                <button type="button" class="btn btn-danger" onclick="Remove_duplicate()" data-dismiss="modal">Delete</button>
              



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             
        </div>
    </div>
</div>






              </div>

           
        
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  


  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

<script>
  
  $(document).ready(function(){
                $('#add_form').on('submit', function(e){
                    //Stop the form from submitting itself to the server.
                    e.preventDefault();
    var first_name = $('#register_form1').val();


    $.ajax({
        type: "POST", 
       
        url: "<?php echo site_url('welcome/Check_Duplicate'); ?>",   
        data: "filename="+first_name,
        success: function(response){
          if(response == 1)
          {

            alert("No Duplicate");
            $('#gif').css('visibility', 'hidden');

             $("#import").toggle();

            
          }
          else
          {
            $('#gif').css('visibility', 'hidden');
             $("#comments").toggle();
              $("#import").toggle();
              $("#comments").html(response);  
            
          }
         
        },
        
    });     
});
                   });

 

$('#login_form').submit(function() {
    $('#gif').css('visibility', 'visible');
});
$('#import').submit(function() {
    $('#gif').css('visibility', 'visible');
});
$('#add_form').submit(function() {
    $('#gif').css('visibility', 'visible');
});


 

</script>

<script>
 function getVal()
  {


      $.ajax({  
                         url:"<?php echo site_url('welcome/view_duplicate'); ?>",  
                        data: {id: '1'},  
                        type: "POST",  
                        success:function(data){   
                       $("#comments1").html(data);  
                      $('#myModal1').modal('show');
                     }  
                  }); 
  }


  function import_new()
  {
     $('#gif').css('visibility', 'visible');
     $.ajax({  
                         url:"<?php echo site_url('welcome/ExcelDataImport'); ?>",  
                        data: {id: '1'},  
                        type: "POST",  
                        success:function(data){  
                       if(data == 1)
                       {
                        alert("Import Success");
                        location.reload();
                       }
                       else
                       {
                        alert("Import Failed");
                       }
                     }  
                  }); 

  }

  function import_duplicate()
  {
      $.ajax({  
                         url:"<?php echo site_url('welcome/ExcelDataImport_update'); ?>",  
                        data: {id: '1'},  
                        type: "POST",  
                        success:function(data){  
                       if(data == 1)
                       {
                        alert("Import Success");
                        location.reload();
                       }
                       else
                       {
                        alert("Import Failed");
                       }
                     }  
                  }); 
  } 
 
  
   
</script>


<SCRIPT language="javascript">
$(function(){

  // add multiple select / deselect functionality
  $("#selectall").click(function () {
      $('.case').attr('checked', this.checked);
  });

  // if all checkbox are selected, check the selectall checkbox
  // and viceversa
  $(".case").click(function(){

    if($(".case").length == $(".case:checked").length) {
      $("#selectall").attr("checked", "checked");
    } else {
      $("#selectall").removeAttr("checked");
    }

  });
});



function Remove_duplicate()
{

  var checkboxes = document.getElementsByName('case');
var vals = "";
for (var i=0, n=checkboxes.length;i<n;i++) 
{
    if (checkboxes[i].checked) 
    {
        vals += ","+checkboxes[i].value;
    }
}
 var tbldata=vals;//need to pass
$.ajax({  
                         url:"<?php echo site_url('welcome/remove_duplicate'); ?>",  
                        data: {"tbldata" : tbldata},  
                        type: "POST",  
                        success:function(server_response){ 
                         var data = $.parseJSON(server_response);

                        
                         var length = data.length;
                         $("#mewdiv").toggle();
                          $("#mainhead").hide();
                          $("#length").html(length);

                            for(var i = 0; i < data.length; i++){
                week = data[i];
                $("#newtab").append("<tr><td>" + week.Company_Name + "</td><td>" + week.WebURL+ "</td><td>" + week.Company_Contact+ "</td><td>" + week.Country+ "</td><td>" + week.State+ "</td><td>" + week.City+ "</td><td>" + week.Emp_Count + "</td></tr>");
            };


                     }  
                  }); 

}
</SCRIPT>



        





</body>
</html>
