
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
      Duplicate Datas
        <small></small>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
     

            <!-- form start -->
          

        <div>



            <div class="box">
            <div class="box-header">
                  <div class="modal-body" ><p></p></div>
             
              <h3 class="box-title"></h3>
              
            <!-- /.box-header -->
            <div class="box-body">
          
             <table id="demoPostTable" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead>
                <th><input type="checkbox" id="selectall"/></th>
                <th>Sno</th>
                <th>Company Name</th>
                <th>Company URL</th>
                 
                  <th>Contact Number</th>
                 
                </thead>
                <tbody>
                 <?php
                if(isset($duplicate) && is_array($duplicate) && count($duplicate)): $i=1;
                $a = $this->uri->segment(3);

                foreach ($duplicate as $key => $data) { 
                  $a++;
                  if(empty($data))
                  {

                  }
                  else
                  {
                ?>
                <tr <?php if($i%2==0){echo 'class="even"';}else{echo'class="odd"';}?>>
                <td align="center"><input type="checkbox" class="case" name="case" value="<?php echo $data['Company_Name']; ?>"/></td>
                 <td><?php echo $i; ?></td>
              
                    <td><?php echo $data['Company_Name']; ?></td>            
                    <td><?php echo $data['WebURL']; ?></td>
                   
                    <td><?php echo $data['Company_Contact']; ?></td>
                   
                   
                </tr>
                <?php
              }
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
              <button id="myBtn" type="submit"  class="btn btn-primary" onclick="Remove_duplicate()" >Remove</button>

             
              </div>




               <div class="box-body">
          
             <table id="demoPostTable1" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead>
                <th><input type="checkbox" id="selectall"/></th>
                <th>Sno</th>
                <th>Company Name</th>
                <th>Company URL</th>
                 
                  <th>Contact Number</th>
                 
                </thead>
                <tbody>
                 <?php
                if(isset($duplicate) && is_array($duplicate) && count($duplicate)): $i=1;
                $a = $this->uri->segment(3);

                foreach ($duplicate as $key => $data) { 
                  $a++;
                  if(empty($data))
                  {

                  }
                  else
                  {
                ?>
                <tr <?php if($i%2==0){echo 'class="even"';}else{echo'class="odd"';}?>>
                <td align="center"><input type="checkbox" class="case" name="case" value="<?php echo $data['Company_Name']; ?>"/></td>
                 <td><?php echo $i; ?></td>
              
                    <td><?php echo $data['Company_Name']; ?></td>            
                    <td><?php echo $data['WebURL']; ?></td>
                   
                    <td><?php echo $data['Company_Contact']; ?></td>
                   
                   
                </tr>
                <?php
              }
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
              <button id="myBtn" type="submit"  class="btn btn-primary" onclick="Remove_duplicate()" >Remove</button>

             
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
     $.post('<?php echo site_url('welcome/remove_duplicate'); ?>',{"tbldata" : tbldata},function(response) 
     {
      $("#demoPostTable").html(response);  
     });//preview click close


}
</SCRIPT>




        





</body>
</html>
