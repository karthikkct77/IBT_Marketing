<link href ="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
<link href ="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js">
<link href ="https://cdn.datatables.net/responsive/2.2.0/js/dataTables.responsive.min.js">
<link href ="https://cdn.datatables.net/responsive/2.2.0/js/responsive.bootstrap.min.js">
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );

$(document).ready(function() {
    $('#example1').DataTable();
} );
</script>
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">   
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
    $('#myTable').dataTable();
});

$(document).ready(function(){
    $('#myTable1').dataTable();
});
</script>
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
            <table id="myTable" class="display table" width="100%" >
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
                        <td>    <input type='button' class="btn btn-info" id="edit_button<?php echo $r['Prospect_Icode'];?>" value="edit" onclick="edit_row('<?php echo $r['Prospect_Icode']; ?>');">
                        <input id="bde_id<?php echo $r['Prospect_Icode']; ?>" type="hidden" value="<?php echo $r['Prospect_Analysis_BDE_Code']; ?>">
                        <input type='button' class="btn btn-success" id="save_button<?php echo $r['Prospect_Icode'];?>" style="display: none;" value="save" onclick="save_row('<?php echo $r['Prospect_Icode'];?>');">
                        <button class="btn btn-default"  id="cancel<?php echo $r['Prospect_Icode'];?>"  style="display: none;" name="cancel" onclick="cancel('<?php echo $r['Prospect_Icode'];?>')">Cancel</button>                
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
    </section>
  </div>
  <div class="control-sidebar-bg"></div>
</div>
<script>
  function save_prospect_analysis(id)
  {
      var fld = document.getElementById('languages'+id);   
var values = [];
for (var i = 0; i < fld.options.length; i++) {
  if (fld.options[i].selected) {
    values.push(fld.options[i].value);
  }
}
var val = document.getElementById('languages1'+id);
var Domain = [];
for (var i = 0; i < val.options.length; i++) {
  if (val.options[i].selected) {
    Domain.push(val.options[i].value);
  }
}
    var pcode = id;
    var type = document.getElementById("Ptype"+id).value;


     var Services = document.getElementById("Services"+id).value;
      var Approch = document.getElementById("Approch"+id).value;
         var cat = document.getElementById("category"+id).value;
        

     
        $.ajax({  
                         url:"<?php echo site_url('User/Insert_Prospect_Analysis'); ?>",  
                        data: {id: pcode,ptype: type, pservice: Services, papproch: Approch,Domain: Domain,industry:values,category: cat},  
                        type: "POST",  
                        cache: false,
                        success:function(data){ 
                         
                         
                          if(data == 1)
                          {
                            //$("#example").load(" #example");
                             window.location.href = document.referrer;
                          }
                          else
                          {

                          }
                     }  
                  }); 
      
  }


  function cancel(id)
  {
     location.reload();
  }

  </script>
  <script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="modify_records.js"></script>

  <script>

 function edit_row(id)
{
    var name=document.getElementById("name_val"+id).innerHTML;
    var age=document.getElementById("age_val"+id).innerHTML;
    var type=document.getElementById("type_val"+id).innerHTML;
    var type_value=document.getElementById("type_val"+id).value;
    var indus_value=document.getElementById("indus_val"+id).innerHTML;
    var Domain_value=document.getElementById("domain_val"+id).innerHTML;
    var domain_value=document.getElementById("dom_id"+id).value;
    var d_value=document.getElementById("domval_id"+id).value;
    var ind_value=document.getElementById("indus_id"+id).value;
    var strarray = ind_value.split(',');
    var i_value=document.getElementById("indval_id"+id).value;
    var cat=document.getElementById("category_val"+id).innerHTML;
    var bde=document.getElementById("bde_id"+id).value;
    var one = 'Below Average';
    var two = 'Average';
    var three = 'Above Average';
    var four = 'Good';
    var PS = 'Product&Services';
    var Ser = 'Services';
    document.getElementById("name_val"+id).innerHTML="<textarea   id='name_text"+id+"' style='height: 100px; width: 400px' class='form-control' name='service' value='"+name+"'>"+name+"</textarea>";
    document.getElementById("age_val"+id).innerHTML="<textarea id='age_text"+id+"' style='height: 100px; width: 100px' class='form-control' name='approch' value='"+age+"'>"+age+"</textarea>";
    document.getElementById("type_val"+id).innerHTML="<select  class='form-group' id='type_text"+id+"' name='ptype' ><option value='"+type+"'>"+type+"</option><option value='"+one+"'>"+one+"</option><option value='"+two+"'>"+two+"</option><option value='"+three+"'>"+three+"</option><option value='"+four+"'>"+four+"</option></select>";
    document.getElementById("category_val"+id).innerHTML="<select   class='form-group' id='cat_text"+id+"' name='category' ><option value='"+cat+"'>"+cat+"</option><option value='"+PS+"'>"+PS+"</option><option value='"+Ser+"'>"+Ser+"</option></select>";
    document.getElementById("indus_val"+id).innerHTML="<select  style='height: 100px; width: 150px' id='indus_text"+id+"' name='indus[]'  multiple ><option style='background-color: #bacdef;'  >"+i_value+"</option>  <?php foreach ($Industry as $row):
    { 
    echo "<option value= " .$row['Industries_Icode'].">" . $row['Industries_Name'] . "</option>";
    } endforeach; ?> </select> ";
    document.getElementById("domain_val"+id).innerHTML="<select style='height: 100px; width: 150px' id='domain_text"+id+"' name='domain[]' multiple ><option style='background-color: #bacdef;' >"+d_value+"</option>  <?php foreach ($Domain as $row):
    { 
    echo "<option value= " .$row['Domain_Icode'].">" . $row['Domain_Name'] . "</option>";
    } endforeach; ?> </select> ";
    document.getElementById("edit_button"+id).style.display="none";
    document.getElementById("save_button"+id).style.display="block";
    document.getElementById("cancel"+id).style.display="block";

}

function save_row(id)
{
    var services=document.getElementById("name_text"+id).value;
    var category=document.getElementById("cat_text"+id).value;
    var approch=document.getElementById("age_text"+id).value;
    var indus=document.getElementById("indus_text"+id).value;
    var type=document.getElementById("type_text"+id).value; 
    var val = document.getElementById("domain_text"+id);
    var bde=document.getElementById("bde_id"+id).value;

    var domain = [];
    for (var i = 0; i < val.options.length; i++) {
      if (val.options[i].selected) {
        domain.push(val.options[i].value);
      }
    }
    var val1 = document.getElementById("indus_text"+id);
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
window.location.href = document.referrer;
                      
                     }  
                  }); 

}
</SCRIPT>




</body>
</html>


