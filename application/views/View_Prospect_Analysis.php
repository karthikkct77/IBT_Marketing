
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

<script>
$(document).ready(function(){
    $('#myTable').dataTable();
});
</script>
<div class="content-wrapper">
  <section class="content-header">
      <h1>
  Prospect Analysis
        <small></small>
      </h1>
     
    </section>
    <section class="content">
 
      <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="<?php echo site_url('User/Prospect_Analysis_Data'); ?>">Entry</a></li>
    <li><a data-toggle="tab" href="<?php echo site_url('User/View_Prospect_Analysis_Data'); ?>">List/Update</a></li>
   <!--  <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
    <li><a data-toggle="tab" href="#menu3">Menu 3</a></li> -->
  </ul>


 <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
  <div class="box">
            <div class="box-header">
                  <div class="modal-body" ><p></p></div>
             
              <h3 class="box-title"></h3>
              
            <!-- /.box-header -->
            <div class="box-body">
            <table id="myTable" class="display table" width="100%" >

<thead>
    <tr>
        <th>#</th>
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
 <td><?php echo $i; ?></td>
 <td ><?php echo $r['Company_Name']; ?><br><a target="_blank" href="<?php echo $r['WebURL']; ?>"><?php echo $r['WebURL']; ?></a><br><?php echo $r['Country']; ?></td>  
 
 <td id="category_val<?php echo $r['Prospect_Icode']; ?>"><?php echo $r['prospect_Category']; ?></td>          
                    <td  id="type_val<?php echo $r['Prospect_Icode']; ?>" ><?php echo $r['Marketing_Prospect_Type']; ?> </td>
                       <td  id="name_val<?php echo $r['Prospect_Icode']; ?>"><?php echo $r['Marketing_Services']; ?></td>
                       <td   id="age_val<?php echo $r['Prospect_Icode']; ?>"><?php echo $r['Marketing_Approch']; ?></td>
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
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Data Details</h4>

            </div>
             <div class="modal-body" >
                <table id="demoPostTable3" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead>
  <tr>
    <th>Product</th>
    <th>No.of Product</th>
    <th>Domain</th>
    <th>Custom</th>
     <th>Web</th>
      <th>Mobile</th>
       <th>E-Commerce</th>
        
  </tr>
  </thead>
  <tbody id="comments">
    
  </tbody>
  
 
</table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             
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

</div>
  <div class="control-sidebar-bg"></div>
  </div>

</body>
</html>

<script>

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
                     
                     }  
                  }); 

}



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
                             location.reload();
                          }
                          else
                          {

                          }
                     }  
                  }); 
      
  }


  function cancel(id)
  {
   /** var services=document.getElementById("name_text"+id).value;
 var approch=document.getElementById("age_text"+id).value;
 var indus=document.getElementById("indus_text"+id).value;
 var type=document.getElementById("type_text"+id).value;
document.getElementById("name_val"+id).innerHTML=services;
    document.getElementById("age_val"+id).innerHTML=approch;
      document.getElementById("indus_val"+id).innerHTML=indus;
    document.getElementById("type_val"+id).innerHTML=type;

    document.getElementById("edit_button"+id).style.display="block";
    document.getElementById("save_button"+id).style.display="block";
     document.getElementById("cancel"+id).style.display="none";**/
     location.reload();


  }

  </script>
 <!--  <script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="modify_records.js"></script>
 -->
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
  url:'<?php echo site_url('User/Update_Prospect_Analysis'); ?>',
  data:{
   edit_row:'edit_row',
   row_id:id,
   services:services,
   approch:approch,
   Industry:induss,
    type:type,
    category:category,
    Domain:domain

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

  




