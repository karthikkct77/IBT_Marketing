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
  background: #FF0000;
}
</style>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
  Meeting Status
        <small></small>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
      <ul class="nav nav-tabs" role="tablist" id="myTab">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Entry</a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">View</a></li>
       
    </ul>


    <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
  <div class="box">
            <div class="box-header">
           
             
              <h3 class="box-title"></h3>
              
            <!-- /.box-header -->
            <div class="box-body">

            <table id="demoPostTable" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
 
 <thead>
    <tr>
    <th>#</th>
        <th>Company Name/Web URL</th>
        <th>Meeting Type</th>
        <th>Date/Time</th>
        <th>Comments</th>
        <th>Next Call Date</th>
        <th>Meeting Type</th>
        <th></th>
       
    </tr>
    </thead>
 
       
 <tbody>

 <?php 
 if(isset($meeting) && is_array($meeting) && count($meeting)): $i=1;
    $a = $this->uri->segment(3);
foreach($meeting as $r) 
{
   $a++;
  
?>
 

<tr>
<td><?php echo $i; ?></td>
 <td><?php echo $r['Company_Name']; ?><br><?php echo $r['WebURL']; ?></td>  
   <td><?php echo $r['Meeting_Type']; ?></td>
    <?php
   if($r['Next_Call_Date_Client'] == 'Yes')
   {
    ?>
     <td style="padding-left: 5px; 
                   padding-bottom:3px; 
                   color:#FF0000; 
                   font-weight:bold"><?php echo $r['Meeting_Date']; ?></td>
    <?php
       }
       else
       {
        ?>
           <td><?php echo $r['Meeting_Date']; ?></td>
           <?php
       }
       ?>
  <td><div class="form-group">
                    
                <textarea class="form-control" style="height: 100px; " id="mcomment<?php echo $r['Meeting_Status_Icode']; ?>" name="mcomment" placeholder="Enter Services"  ></textarea>

              
           
                </div></td>   
                <td> <div class="form-group"  >
                <div class='input-group date' id="datetimepicker<?php echo $r['Meeting_Status_Icode']; ?>">
                    <input type='text' class="form-control" id="our_date<?php echo $r['Meeting_Status_Icode']; ?>" onclick="getdata('<?php echo $r['Meeting_Status_Icode']; ?>')" value="" name="our_date" placeholder="Select Date & Time" />
                    <span class="input-group-addon">
                        <span onclick="getdata('<?php echo $r['Meeting_Status_Icode']; ?>')" class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div></td>   
            <td> <div class="form-group">
               
                  <select name="mtype" class="form-control" id="mtype<?php echo $r['Meeting_Status_Icode']; ?>"  >
                     <option value="" >Select Meeting Type</option>
           <?php foreach ($Mtype as $row):
            { 

                echo "<option value= " .$row['Meeting_Icode'].">" . $row['Meeting_Type'] . "</option>";

           } 
           endforeach; ?>
           </select> 
                </div></td>
            <td>  <input type="hidden" id="prospect_Icode<?php echo $r['Meeting_Status_Icode']; ?>" name="prospect_Icode" value="<?php echo $r['Prospect_Icode'];  ?>"><button id="myBtn" class="btn btn-success" value="<?php echo $r['Meeting_Status_Icode']; ?>" 
                          onclick="save_Meeting_Status(this.value)" >Save</button>
                          

            </td>
                
                  
                      
                      

                       
                      
                          

    </tr>
<?php
                    $i++;
                      }
                    else:
                ?>
               <tr>
                    <td colspan="7" align="center" >No Record Found </td>
                </tr>
                <?php
                    endif;
                ?>
  
 
  </tbody>


  </table>
              </div>
              </div>
              </div>
              </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
  <div class="box">
            <div class="box-header">
                  <div class="modal-body" ><p></p></div>
                   <div class="modal-body" ><div class="foo blue"> </div>  <p>Client Date</p></div>
             
              <h3 class="box-title"></h3>
              
            <!-- /.box-header -->
            <div class="box-body">
                        <table id="demoPostTable1" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
 
 <thead>
    <tr>
    
        <th>Company Name</th>
        <th>Web URL</th>
        <th>Phone Number</th>
        <th>Country</th>
        <th>Date/Time</th>
        <th>Meeting Type</th>
       
        <th></th>
       
    </tr>
    </thead>
 
 
 <tbody>
 

<?php 
foreach($followup_other as $r) 
{
?>
<tr>
 <td><?php echo $r['Company_Name']; ?></td>  
 <td><?php echo $r['WebURL']; ?></td>            
                    <td><?php echo $r['Company_Contact']; ?></td>
                       <td><?php echo $r['Country']; ?></td>
                          <td><?php echo $r['Meeting_Type']; ?></td>
                      

   <?php
   if($r['Next_Call_Date_Client'] == 'Yes')
   {
    ?>
     <td style="padding-left: 5px; 
                   padding-bottom:3px; 
                   color:#FF0000; 
                   font-weight:bold"><?php echo $r['Next_Call_Date']; ?></td>
    <?php
       }
       else
       {
        ?>
           <td><?php echo $r['Next_Call_Date']; ?></td>
           <?php
       }
       ?>

                       
                      
                          <td> <form method="post" role="form" action="<?php echo site_url('User/Prospect_followup_Call'); ?>"   enctype="multipart/form-data" name="data_register">

                        
             
            <input type="hidden" id="prospect_Icode" name="prospect_Icode" value="<?php echo $r['Prospect_Icode'];  ?>">
             <button id="myBtn" class="btn btn-info btn-sm" value="<?php echo $r['Prospect_Icode']; ?>" > <i class="glyphicon glyphicon-earphone"></i>Call</button>
          
            </form> 


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
              </div>
              </div>
           
               </section>

</div>
  <div class="control-sidebar-bg"></div>
  </div>


  

</body>
</html>

  <link rel="stylesheet" href="<?php echo base_url('bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css'); ?>">
<script src="<?php echo base_url('bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js'); ?>"></script>
 <script type="text/javascript">

 function getdata(id)
 {
   $(function () {
                $('#datetimepicker'+id).datetimepicker();
            });
 }
   
       </script>
        <script>
        function  save_Meeting_Status(id)
        {
         
          var mcomment = document.getElementById("mcomment"+id).value;
      var our_date = document.getElementById("our_date"+id).value;
      var prospect_Icode = document.getElementById("prospect_Icode"+id).value;
       var mtype = document.getElementById("mtype"+id).value;
      //alert(prospect_Icode);

     var pcode = id;
  

     if(mcomment == "")
     {
      alert("Please Type Comments and Next Call Date");
     }
     else
     {


        

     
        $.ajax({  
                         url:"<?php echo site_url('User/Insert_Meeting_Status'); ?>",  
                        data: {id: pcode,Mcomments: mcomment, mdate: our_date,pros: prospect_Icode,Mtype: mtype },  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                         
                         
                          if(data == 1)
                          {
                            //$("#example").load(" #example");
                             location.reload();
                          }
                          else
                          {

                          }
                     }  
                  }); 
        }
        }
      
        </script>
