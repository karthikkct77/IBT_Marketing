<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
   Data Review
        <small></small>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
      <div>
          <div class="box">
            <div class="box-header">
                  <div class="modal-body" ><p></p></div>
                   <button type="button" class="btn btn-info" onclick="Remove_duplicate()" data-dismiss="modal">Reviewed</button>
             
              <h3 class="box-title"></h3>
              
            <!-- /.box-header -->
            <div class="box-body">
     <table id="demoPostTable" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
 

<thead>
    <tr>
        <th><input type="checkbox" id="selectall"/></th>
        <th>Company Name</th>
      
        <th>Category</th>
        <th>Prospect Type</th>
        <th>Services</th>
        <th>Approch</th>
        <th>Domain</th>
        <th>Industry</th>
        <th>Action</th>
       
      
       
    </tr>
    </thead>
 
 
 <tbody>
 

<?php 
 $i=1;
    $a = $this->uri->segment(3);
foreach($Update_Analysis as $r) 
{
   $a++;
  
?>
<tr id="row<?php echo $r['Prospect_Icode']; ?>">
 <td><input type='checkbox' class='case' name='case' value="<?php echo $r['Prospect_Icode'];?>"</td>
 <td ><?php echo $r['Company_Name']; ?><br><a target="_blank" href="<?php echo $r['WebURL']; ?>"><?php echo $r['WebURL']; ?></a><br><?php echo $r['Country']; ?></td>  
 
 <td id="category_val<?php echo $r['Prospect_Icode']; ?>"><?php echo $r['prospect_Category']; ?></td>          
                    <td  id="type_val<?php echo $r['Prospect_Icode']; ?>" ><?php echo $r['Marketing_Prospect_Type']; ?> </td>
                       <td style="width: 50%;" id="name_val<?php echo $r['Prospect_Icode']; ?>"><?php echo $r['Marketing_Services']; ?></td>
                       <td  style="width: 50%;" id="age_val<?php echo $r['Prospect_Icode']; ?>"><?php echo $r['Marketing_Approch']; ?></td>
                       <td id="domain_val<?php echo $r['Prospect_Icode']; ?>"><?php echo $r['domain']; ?><input id="dom_id<?php echo $r['Prospect_Icode']; ?>" type="hidden" value="<?php echo $r['Domain_Icode']; ?>"><input id="domval_id<?php echo $r['Prospect_Icode']; ?>" type="hidden" value="<?php echo $r['domain']; ?>"></td>
                        <td id="indus_val<?php echo $r['Prospect_Icode']; ?>"><?php echo $r['Industry_Name']; ?> <input id="indus_id<?php echo $r['Prospect_Icode']; ?>" type="hidden" value="<?php echo $r['industry_icode']; ?>"><input id="indval_id<?php echo $r['Prospect_Icode']; ?>" type="hidden" value="<?php echo $r['Industry_Name']; ?>"></td>
 
                      
                         
                          <td>    <input type='button' class="btn btn-info" id="edit_button<?php echo $r['Prospect_Icode'];?>"  data-toggle="modal" data-target="#myModal2"  value="edit" onclick="edit_row1('<?php echo $r['Prospect_Icode']; ?>');">

                           

            </td>
                          

    </tr>
 <?php
                    $i++;
                      }
                    
                ?>
             
 
  
 
  </tbody>


</table>
              </div>
              </div>
              </div>
              </div>

               <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 60%;" >
        <div class="modal-content" >
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Edit Prospect Data Analysis</h4>

            </div>
             
            
             
            <div class="modal-body" id="edit_code">
            
            </div>
            <div class="modal-footer">
                <button type="Submit" onclick="save_row1()" class="btn btn-success" >Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
     
    </div>
</div>
</div>                
    </section>
    <!-- /.content -->
  </div>

  <div class="control-sidebar-bg"></div>
</div>
 <script>


function save_row1()
{

   var id=document.getElementById("pid").value;


 var category=document.getElementById("category").value;


 var approch=document.getElementById("age_text").value;
  var services=document.getElementById("name_text").value;


 var indus=document.getElementById("indus_text").value;
  //var domain=document.getElementById("domain_text"+id).value;
 var type=document.getElementById("Ptype").value; 

var val = document.getElementById("domain_text");

 var bde=document.getElementById("bde_id").value;


var domain = [];
for (var i = 0; i < val.options.length; i++) {
  if (val.options[i].selected) {
    domain.push(val.options[i].value);
  }
}


var val1 = document.getElementById("indus_text");


var induss = [];
for (var i = 0; i < val1.options.length; i++) {
  if (val1.options[i].selected) {
    induss.push(val1.options[i].value);
  }
}

 $.ajax
 ({
  type:'post',
  url:'<?php echo site_url('Welcome/Update_Prospect_Analysis'); ?>',
  data:{
   edit_row:'edit_row',
   row_id:id,
   services:services,
   approch:approch,
   Industry:induss,
    type:type,
    category:category,
    Domain:domain,
     BDE: bde

  },
  success:function(response) {
   if(response=="success")
   {
         location.reload();

   }
  }
 });
}

function getcurrent_data(id)
{
 $.ajax({  
                         url:"<?php echo site_url('User/get_prospect_data_Info'); ?>",  
                        data: {id: id},  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                           $("#comments").html(data);  
                      $('#myModal1').modal('show');
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
                         url:"<?php echo site_url('welcome/reviewed_Data'); ?>",  
                        data: {"tbldata" : tbldata},  
                        type: "POST",  
                        success:function(data){  
 location.reload();
                      
                     }  
                  }); 

}


function edit_row1(id)
{

 var domain_value=document.getElementById("dom_id"+id).value;
 var ind_value=document.getElementById("indus_id"+id).value;
 var strarray = ind_value.split(',');
 var domainarray = domain_value.split(',');

      $.ajax({  
                         url:"<?php echo site_url('User/Edit_Analysis_Data'); ?>",  
                        data: {id: id},  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                            $("#edit_code").html(data); 
                             $("#indus_text").val(strarray);
                         $("#domain_text").val(domainarray); 
                      $('#myModal1').modal('show');
                     }  
                  }); 

}
</SCRIPT>
</body>
</html>


