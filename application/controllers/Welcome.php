<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
           
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

public function __construct()
{
      parent::__construct();
      $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
      $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
      $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
      $this->output->set_header('Pragma: no-cache');
      $this->load->helper('url');   /***** LOADING HELPER TO AVOID PHP ERROR ****/
      $this->load->model('Marketing_model','marketing_model'); /* LOADING MODEL * Welcome_model as welcome */
      $this->load->library('session');
      $this->load->library('excel');

} 
public function index()
{
      $this->load->view('header');
      $this->load->view('login');
} 

/** Login */

public function login()
{
      $data = array('user_name'   => $this->input->post('Username'),
                    'password'    => $this->input->post('Password') );

      $uname =  $this->input->post('Username');
      $insert = $this->marketing_model->login($data);
      if($insert == 1)
      {
           redirect('User/dashboard');

      }        
      else if($insert == 2)
      {
          redirect('welcome/Admin_dashboard');

      }
     else
      {
          $this->session->set_flashdata('message', 'Username or Password Wrong..');
          redirect('welcome/index');
      }
}

//**LOGOUT**/

public function logout()
{
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) 
        {
              if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') 
              {
                 $this->session->unset_userdata($key);
              }
        }
       $this->session->sess_destroy();
       redirect('welcome');
}
/** DASHBOADR **/
public function dashboard()
{
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('dashboard');

}
/** ADMIN DASHBOARD **/
public function Admin_dashboard()
{
      $this->load->view('Admin/header');
      $this->load->view('Admin/top');
      $this->load->view('Admin/left');
      $this->load->view('Admin/dashboard');

}
/** DATA IMPORT **/
public function Data_Import()
{
    $this->load->view('Admin/header');
    $this->load->view('Admin/top');
    $this->load->view('Admin/left');
    $this->load->view('Admin/Data_Import');

}


public  function ExcelDataAdd() 
{  
//Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)  
         $configUpload['upload_path'] = FCPATH.'uploads/excel/';
         $configUpload['allowed_types'] = 'xls|xlsx|csv';
         $configUpload['max_size'] = '5000';
         $this->load->library('upload', $configUpload);
         $this->upload->do_upload('userfile');  
         $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
         $file_name = $upload_data['file_name']; //uploded file name
         $extension=$upload_data['file_ext'];    // uploded file extension
    
         //$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
         $objReader= PHPExcel_IOFactory::createReader('Excel2007'); // For excel 2007     
          //Set to read only
         $objReader->setReadDataOnly(true);      
        //Load excel file
         $objPHPExcel=$objReader->load(FCPATH.'uploads/excel/'.$file_name);    
         $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel         
         $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
          //loop from first data untill last data
        for($i=2;$i<=$totalrows;$i++)
          {
            //echo $sno; exit;
              $companyname= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); 
              if($companyname == NULL || $companyname == '')
                {
                  $row[] = $i - 1;
                }
                else
                {

                }
        $Branches= $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(); 
        $HasOfficeinIndia= $objWorksheet->getCellByColumnAndRow(3,$i)->getValue(); 
        $BuildingType= $objWorksheet->getCellByColumnAndRow(4,$i)->getValue(); 
        $URL= $objWorksheet->getCellByColumnAndRow(5,$i)->getValue(); //Excel Column 1
        if($URL == NULL || $URL == '')
        {
              $row1[] = $i - 1;
        }
        else
        {

        }
        $Address= $objWorksheet->getCellByColumnAndRow(6,$i)->getValue(); //Excel Column 2
        $City= $objWorksheet->getCellByColumnAndRow(7,$i)->getValue(); 
        $State= $objWorksheet->getCellByColumnAndRow(8,$i)->getValue(); 
        $Country= $objWorksheet->getCellByColumnAndRow(9,$i)->getValue(); 
        $CompanyContact=$objWorksheet->getCellByColumnAndRow(10,$i)->getValue(); //Excel Column 3

        if($CompanyContact == NULL || $CompanyContact == '')
                {
                  $row2[] = $i - 1;
                }
                else
                {
                  
                }
                $CompanyEmail=$objWorksheet->getCellByColumnAndRow(11,$i)->getValue(); //Excel Column 3

       
                  $FBURL= $objWorksheet->getCellByColumnAndRow(12,$i)->getValue(); 
                   $LinkedInURL= $objWorksheet->getCellByColumnAndRow(13,$i)->getValue(); 
                    $TimeZone= $objWorksheet->getCellByColumnAndRow(14,$i)->getValue(); 
                     $PCName= $objWorksheet->getCellByColumnAndRow(15,$i)->getValue(); 
                      $PcDesig= $objWorksheet->getCellByColumnAndRow(16,$i)->getValue(); 
                       $PCEmail= $objWorksheet->getCellByColumnAndRow(17,$i)->getValue(); 
                        $PCPhNo= $objWorksheet->getCellByColumnAndRow(18,$i)->getValue(); 
                         $SCName= $objWorksheet->getCellByColumnAndRow(19,$i)->getValue(); 
                          $ScDesig= $objWorksheet->getCellByColumnAndRow(20,$i)->getValue(); 
                           $SCEmail= $objWorksheet->getCellByColumnAndRow(21,$i)->getValue(); 
                            $SCPhNo= $objWorksheet->getCellByColumnAndRow(22,$i)->getValue(); 
                             $Career= $objWorksheet->getCellByColumnAndRow(23,$i)->getValue(); 
                              $EmpCount= $objWorksheet->getCellByColumnAndRow(24,$i)->getValue(); 
                               $ProspectType= $objWorksheet->getCellByColumnAndRow(25,$i)->getValue(); 
                                $Product= $objWorksheet->getCellByColumnAndRow(26,$i)->getValue(); 
                                 $NoofProducts= $objWorksheet->getCellByColumnAndRow(27,$i)->getValue(); 
                                  $Domain= $objWorksheet->getCellByColumnAndRow(28,$i)->getValue(); 
                                   $Custom= $objWorksheet->getCellByColumnAndRow(29,$i)->getValue(); 
                                    $Web= $objWorksheet->getCellByColumnAndRow(30,$i)->getValue(); 
                                     $Mobile= $objWorksheet->getCellByColumnAndRow(31,$i)->getValue(); 
                                      $Commerce= $objWorksheet->getCellByColumnAndRow(32,$i)->getValue(); 
                                       $TechnologyInfo= $objWorksheet->getCellByColumnAndRow(33,$i)->getValue(); 
                                       

       
       
        $data_user[]=array(
                              'Company_Name'=>$companyname,
                              'WebURL'=>$URL ,
                              'Address'=>$Address , 
                              'Company_Contact'=>$CompanyContact ,
                              'Company_Email' => $CompanyEmail,
                              'Has_Branches' => $Branches,
                              'Has_Office_In_India' => $HasOfficeinIndia,
                              'Building_Type' => $BuildingType,
                              'City' => $City,
                              'State' => $State,
                              'Country' => $Country,
                              'FB_URL' => $FBURL,
                              'LinkedIn_URL' => $LinkedInURL,
                              'Time_Zone' => $TimeZone,
                              'PC_Name' => $PCName,

                              'PC_Desig' => $PcDesig,
                              'PC_Email' => $PCEmail,
                              'PC_Phone' => $PCPhNo,
                              'SC_Name' => $SCName,
                              'SC_Desig' => $ScDesig,
                              'SC_Email' => $SCEmail,
                              'SC_Phone' => $SCPhNo,
                              'Career_Section' => $Career,
                              'Emp_Count' => $EmpCount,
                              'Prospect_Type' => $ProspectType,
                              'Product_Development' => $Product,
                              'Products_Count' => $NoofProducts,
                              'Domain' => $Domain,
                              'Custom_Development' => $Custom,
                              'Web_Development' => $Web,
                              'Mobile_Development' => $Mobile,
                              'Ecommerce_Development' => $Commerce,
                              'Tech_Skills' => $TechnologyInfo);
        
          }
          
          if(empty($row) and empty($row1) and empty($row2))
          {
                $_SESSION['Full_data'] = $data_user;
                $data['total'] = $totalrows - 1; 
                $data['datas'] =  $data_user;
                $data['filename'] =  $file_name;
                $data['status'] = '0';

              // print_r($data);

                $this->load->view('Admin/header');
                $this->load->view('Admin/top');
                $this->load->view('Admin/left');
                $this->load->view('Admin/Data_Import_view',$data, FALSE);
            }
          else if(!empty($row) and empty($row1) and empty($row2))
          {
                $data['status'] = '1';
                $data['total'] = $totalrows - 1; 
                $data['datas'] =  $data_user;
                $data['filename'] = 'empty';
                $data['first'] = $row;
                $data['third'] = array('0' => '0');
                $data['second'] = array('0' => '0');
                $this->load->view('Admin/header');
                $this->load->view('Admin/top');
                $this->load->view('Admin/left');
                $this->load->view('Admin/Data_Import_view',$data, FALSE);

          }
          else if(!empty($row1) and empty($row) and empty($row2))
          {
                $data['status'] = '1';
                $data['total'] = $totalrows - 1; 
                $data['datas'] =  $data_user;
                $data['filename'] = 'empty';
                $data['second'] = $row1;
                $data['first'] = array('0' => '0');
                $data['third'] = array('0' => '0');
                $this->load->view('Admin/header');
                $this->load->view('Admin/top');
                $this->load->view('Admin/left');
                $this->load->view('Admin/Data_Import_view',$data, FALSE);

          }
          else if(!empty($row2) and empty($row) and empty($row1))
          {
                $data['status'] = '1';
                $data['total'] = $totalrows - 1; 
                $data['datas'] =  $data_user;
                $data['filename'] = 'empty';
                $data['third'] = $row2;
                $data['first'] = array('0' => '0');
                $data['second'] = array('0' => '0');
                $this->load->view('Admin/header');
                $this->load->view('Admin/top');
                $this->load->view('Admin/left');
                $this->load->view('Admin/Data_Import_view',$data, FALSE);

          }
          else if(!empty($row) and !empty($row1) and empty($row2))
          {
                $data['status'] = '1';
                $data['total'] = $totalrows - 1; 
                $data['datas'] =  $data_user;
                $data['filename'] = 'empty';
                $data['first'] = $row;
                $data['second'] = $row1;
                $data['third'] = array('0' => '0');
                /// print_r($data); exit;

                $this->load->view('Admin/header');
                $this->load->view('Admin/top');
                $this->load->view('Admin/left');
                $this->load->view('Admin/Data_Import_view',$data, FALSE);

          }
          else if(!empty($row) and empty($row2) and empty($row1))
          {
                $data['status'] = '1';
                $data['total'] = $totalrows - 1; 
                $data['datas'] =  $data_user;
                $data['filename'] = 'empty';
                $data['first'] = $row;
                $data['third'] = $row2;
                $data['second'] = array('0' => '0');
                $this->load->view('Admin/header');
                $this->load->view('Admin/top');
                $this->load->view('Admin/left');
                $this->load->view('Admin/Data_Import_view',$data, FALSE);

          }
          else if(!empty($row2) and !empty($row1) and empty($row))
          {
                $data['status'] = '1';
                $data['total'] = $totalrows - 1; 
                $data['datas'] =  $data_user;
                $data['filename'] = 'empty';
                $data['second'] = $row1;
                $data['third'] = $row2;
                $data['first'] = array('0' => '0');
                $this->load->view('Admin/header');
                $this->load->view('Admin/top');
                $this->load->view('Admin/left');
                $this->load->view('Admin/Data_Import_view',$data, FALSE);
          }
          else
          {
                $data['status'] = '1';
                $data['total'] = $totalrows - 1; 
                $data['datas'] =  $data_user;
                $data['filename'] = 'empty';
                $data['first'] = $row;
                $data['second'] = $row1;
                $data['third'] = $row2;

                $this->load->view('Admin/header');
                $this->load->view('Admin/top');
                $this->load->view('Admin/left');
                $this->load->view('Admin/Data_Import_view',$data, FALSE);
          }
}

//** EXCEL IMPORT **/
public  function ExcelDataImport() 
{  

        $file_name =  $this->session->userdata['cuttentfile']; 
        $objReader= PHPExcel_IOFactory::createReader('Excel2007'); // For excel 2007     
        //Set to read only
        $objReader->setReadDataOnly(true);      
        //Load excel file
        $objPHPExcel=$objReader->load(FCPATH.'uploads/excel/'.$file_name);    
        $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel         
        $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
        //loop from first data untill last data
        for($i=2;$i<=$totalrows;$i++)
        {
      
              $companyname1= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); 
              $companyname = preg_replace('/[^A-Za-z0-9\-]/', '', $companyname1);
              $Branches= $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(); 
              $HasOfficeinIndia= $objWorksheet->getCellByColumnAndRow(3,$i)->getValue(); 
              $BuildingType= $objWorksheet->getCellByColumnAndRow(4,$i)->getValue(); 
              $URL= $objWorksheet->getCellByColumnAndRow(5,$i)->getValue(); 
              $Address= $objWorksheet->getCellByColumnAndRow(6,$i)->getValue(); 
              $City= $objWorksheet->getCellByColumnAndRow(7,$i)->getValue(); 
              $State= $objWorksheet->getCellByColumnAndRow(8,$i)->getValue(); 
              $Country= $objWorksheet->getCellByColumnAndRow(9,$i)->getValue(); 
              $CompanyContact=$objWorksheet->getCellByColumnAndRow(10,$i)->getValue(); 
              $CompanyEmail=$objWorksheet->getCellByColumnAndRow(11,$i)->getValue(); 
              $FBURL= $objWorksheet->getCellByColumnAndRow(12,$i)->getValue(); 
              $LinkedInURL= $objWorksheet->getCellByColumnAndRow(13,$i)->getValue(); 
              $TimeZone= $objWorksheet->getCellByColumnAndRow(14,$i)->getValue(); 
              $PCName= $objWorksheet->getCellByColumnAndRow(15,$i)->getValue(); 
              $PcDesig= $objWorksheet->getCellByColumnAndRow(16,$i)->getValue(); 
              $PCEmail= $objWorksheet->getCellByColumnAndRow(17,$i)->getValue(); 
              $PCPhNo= $objWorksheet->getCellByColumnAndRow(18,$i)->getValue(); 
              $SCName= $objWorksheet->getCellByColumnAndRow(19,$i)->getValue(); 
              $ScDesig= $objWorksheet->getCellByColumnAndRow(20,$i)->getValue(); 
              $SCEmail= $objWorksheet->getCellByColumnAndRow(21,$i)->getValue(); 
              $SCPhNo= $objWorksheet->getCellByColumnAndRow(22,$i)->getValue(); 
              $Career= $objWorksheet->getCellByColumnAndRow(23,$i)->getValue(); 
              $EmpCount= $objWorksheet->getCellByColumnAndRow(24,$i)->getValue(); 
              $ProspectType= $objWorksheet->getCellByColumnAndRow(25,$i)->getValue(); 
              $Product= $objWorksheet->getCellByColumnAndRow(26,$i)->getValue(); 
              $NoofProducts= $objWorksheet->getCellByColumnAndRow(27,$i)->getValue(); 
              $Domain= $objWorksheet->getCellByColumnAndRow(28,$i)->getValue(); 
              $Custom= $objWorksheet->getCellByColumnAndRow(29,$i)->getValue(); 
              $Web= $objWorksheet->getCellByColumnAndRow(30,$i)->getValue(); 
              $Mobile= $objWorksheet->getCellByColumnAndRow(31,$i)->getValue(); 
              $Commerce= $objWorksheet->getCellByColumnAndRow(32,$i)->getValue(); 
              $Cloud= $objWorksheet->getCellByColumnAndRow(33,$i)->getValue(); 
              $Data_Analyst= $objWorksheet->getCellByColumnAndRow(34,$i)->getValue(); 
              $AI= $objWorksheet->getCellByColumnAndRow(35,$i)->getValue(); 
              $TechnologyInfo= $objWorksheet->getCellByColumnAndRow(36,$i)->getValue(); 
              $Reference= $objWorksheet->getCellByColumnAndRow(39,$i)->getValue(); 
                                       
              $data_user=array( 
                              'Company_Name'=>$companyname,
                              'WebURL'=>$URL ,
                              'Address'=>$Address , 
                              'Company_Contact'=>$CompanyContact ,
                              'Company_Email' => $CompanyEmail, 
                              'Has_Branches' => $Branches,
                              'Has_Office_In_India' => $HasOfficeinIndia,
                              'Building_Type' => $BuildingType,
                              'City' => $City,
                              'State' => $State,
                              'Country' => $Country,
                              'FB_URL' => $FBURL,
                              'LinkedIn_URL' => $LinkedInURL,
                              'Time_Zone' => $TimeZone,
                              'PC_Name' => $PCName,
                              'PC_Desig' => $PcDesig,
                              'PC_Email' => $PCEmail,
                              'PC_Phone' => $PCPhNo,
                              'SC_Name' => $SCName,
                              'SC_Desig' => $ScDesig,
                              'SC_Email' => $SCEmail,
                              'SC_Phone' => $SCPhNo,
                              'Career_Section' => $Career,
                              'Emp_Count' => $EmpCount,
                              'Prospect_Type' => $ProspectType,
                              'Product_Development' => $Product,
                              'Products_Count' => $NoofProducts,
                              'Domain' => $Domain,
                              'Custom_Development' => $Custom,
                              'Web_Development' => $Web,
                              'Mobile_Development' => $Mobile,
                              'Ecommerce_Development' => $Commerce,
                              'Cloud'=> $Cloud,
                              'Data_Analyst'=> $Data_Analyst,
                              'AI'=> $AI,
                              'Tech_Skills' => $TechnologyInfo,
                              'Reference'=> $Reference,
                              'Data_Loaded_By' => $this->session->userdata['fname']);

                              $this->marketing_model->Add_excel($data_user);
         }
         echo 1;
}

//** Check Duplicate Data **/
public function Check_Duplicate()
{
      $file_name = $this->input->post('filename',TRUE);  
      $this->session->set_userdata('cuttentfile',$file_name);
      $objReader= PHPExcel_IOFactory::createReader('Excel2007'); // For excel 2007     
      //Set to read only
      $objReader->setReadDataOnly(true);      
      //Load excel file
      $objPHPExcel=$objReader->load(FCPATH.'uploads/excel/'.$file_name);    
      $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel         
      $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
      //loop from first data untill last data
      for($i=2;$i<=$totalrows;$i++)
      {
              $sno = $objWorksheet->getCellByColumnAndRow(0,$i)->getValue(); 
              $companyname1= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); 
              $companyname = preg_replace('/[^A-Za-z0-9\-]/', '', $companyname1);
              $URL= $objWorksheet->getCellByColumnAndRow(5,$i)->getValue(); //Excel Column 1
              $CompanyContact=$objWorksheet->getCellByColumnAndRow(10,$i)->getValue(); //Excel Column 3
              $data_user=array( 'Company_Name'=>$companyname,
                                'Sno'=>$sno, 
                                'WebURL'=>$URL ,
                                'Company_Contact'=>$CompanyContact );
              $checkval=  $this->marketing_model->check_excel($data_user);
              $totalval[] = $checkval;
      }

      $_SESSION['test'] = $totalval;
      $count = count(array_filter($totalval));
      if($count == 0)
      {
          echo 1;
      }
      else
      {
          $output = null;  
          $output .= "<h4>Duplicate Records:".$count ."<h4>";  
          echo $output;  
      }
}

//** VIEW Duplicate **/
public function view_duplicate()
{
      $totalval['duplicate'] = $this->session->userdata['test'];
      $array1 = $this->session->userdata['Full_data']; 
      $output = null;  
      foreach ($totalval['duplicate'] as $row)  
      {  

          if(empty($row))
          {

          }
          else
          {
              $output .= "<tr>";
              $output .="<td><input type='checkbox' class='case' name='case' value=".$row['Prospect_Icode']."</td>";
              $output .= "<td>".$row['Company_Name']."</td>";  
              $output .= "<td>".$row['WebURL']."</td>";  
              $output .= "<td>".$row['Company_Contact']."</td>";  
              $output .= "</tr>";
          }  
     }
     echo $output;  
}

/** Remove Duplicate**/
public function remove_duplicate()
{

      $array1= $this->session->userdata['Full_data']; 
      $totcount = count($array1);
      $data= $this->input->post('tbldata');
      $categories = '';
      $cats = explode(",", $data);
      $count = count($cats) - 1;
      foreach($cats as $cat) 
      {
          $cat = trim($cat);
          $checkval=  $this->marketing_model->get_duplicate($cat);
          $array2[] = $checkval;
      }
      $duplica = $array2;
      $dupli_count = count($duplica) -1;
      $this->session->set_userdata('duplicate',$dupli_count);


      function myArrayDiff($array1, $array2)
       {
            // loop through each item on the first array
            foreach ($array1 as $key => $row) 
            {
                  // loop through array 2 and compare
                  foreach ($array2 as $key2 => $row2)
                   {
                        if ($row['Company_Name'] == $row2['Company_Name'] OR $row['WebURL'] == $row2['WebURL'] OR $row['Company_Contact'] == $row2['Company_Contact'] ) 
                        {
                            // if we found a match unset and break out of the loop
                            unset($array1[$key]);
                            break;
                        }
                  }
            }
            return array_values($array1);
      }

      $array3= myArrayDiff($array1, $array2);
      echo  json_encode($array3);
}

//** UPDATE EXCEL DATA**/
public function ExcelDataImport_update()
{
      $datauser = $this->session->userdata['modified_data']; 
      $insert =  $this->marketing_model->Add_excel_update($datauser);

      if($insert == 0)
      {
          echo 1;
      }
      else
      {
          echo 0;
      }
}

/** NEW ALLOCATE DATA **/
public function new_allocate()
{
      $this->data['data_country']= $this->marketing_model->Data_Country();
      $this->data['data_Staet']= $this->marketing_model->Data_State();
      $this->data['Data_City']= $this->marketing_model->Data_City();
      $this->data['Data_Timezone']= $this->marketing_model->Data_Timezone();
      $this->data['Data_Emp_count']= $this->marketing_model->Data_Emp_count();
      $this->data['Data_Emp_count']= $this->marketing_model->Data_Emp_count();
      $this->data['Data_pros_type']= $this->marketing_model->Data_pros_type();
      $this->data['Data_product']= $this->marketing_model->Data_product();
      $this->data['Data_custom']= $this->marketing_model->Data_custom();
      $this->data['Data_web']= $this->marketing_model->Data_web();
      $this->data['Data_Ecomm']= $this->marketing_model->Data_Ecomm();
      $this->data['Data_mobile']= $this->marketing_model->Data_mobile();
      $this->data['BDE']= $this->marketing_model->get_all_BDE();
      $this->load->view('Admin/header');
      $this->load->view('Admin/top');
      $this->load->view('Admin/left');
      $this->load->view('Admin/New_Allocate',$this->data, FALSE);
}

/**GET CURRENT DATA**/
public function get_data()
{
        $data = array('country' =>$this->input->post('country',TRUE),
                      'state' =>$this->input->post('state',TRUE),
                      'City' =>$this->input->post('City',TRUE),
                      'Time' =>$this->input->post('Time',TRUE),
                      'Count' =>$this->input->post('Count',TRUE),
                      'Type' =>$this->input->post('Type',TRUE),
                      'Product' =>$this->input->post('Product',TRUE),
                      'Custom' =>$this->input->post('Custom',TRUE),
                      'Web' =>$this->input->post('Web',TRUE),
                      'Mobile' =>$this->input->post('Mobile',TRUE),
                      'Commerce' =>$this->input->post('Commerce',TRUE));

      $data_user= $this->marketing_model->get_country_data($data);
      $_SESSION['Current_data'] = $data_user;
      $count = count($data_user);
      $this->session->set_userdata('Allot_count',$count);
      echo  json_encode($data_user);
}

/**VIEW CURRENT DATA**/
public function view_current_data()
{
        $data['data_country']= $this->marketing_model->Data_Country();
        $data['BDE']= $this->marketing_model->get_all_BDE();
        $name = 'NAME';
        $tot = 'Total';
        echo"<thead>";
        $output = "<th>".$name."</th>";
        foreach ($data['data_country'] as $row)  
        {  
              if(empty($row))
              {

              }
              else
              {
                  $countery_name[] = $row['Country'];
                  $output .= "<th>".$row['Country']. "</br>C|W|H</th>";     
              }  
        }
        $output .= "<th>".$tot."</br>C|W|H</th>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($data['BDE'] as $row)  
        {  
              if(empty($row))
              {

              }
              else
              {
                  $Bde_code = $row['User_Icode'];
                  $output .= "<tr><td>".$row['User_Name']."</td>";
                  foreach ($countery_name as $key) 
                  {
                        $cname = $key;
                        $data['count']= $this->marketing_model->get_BDE_data_count($cname,$Bde_code);
                        foreach ($data['count'] as  $value) 
                        {
                            $da= $this->marketing_model->get_BDE_cold_count($cname,$Bde_code);
                            $warm = $this->marketing_model->get_BDE_warm_count($cname,$Bde_code);
                            $hot = $this->marketing_model->get_BDE_hot_count($cname,$Bde_code);

                            $output .= "<td>".$value['COUNT(Prospect_Icode)']. "</br>" .
                            $da['COUNT(Prospect_Icode)']."|" .$warm['COUNT(Prospect_Icode)']."|".$hot['COUNT(Prospect_Icode)']."</td>";
                        }
                  }
                  $total_bde_count = $this->marketing_model->total_BDE_data_count($Bde_code);
                  $total_cold = $this->marketing_model->total_BDE_cold_count($Bde_code);
                  $total_warm = $this->marketing_model->total_BDE_warm_count($Bde_code);
                  $total_hot = $this->marketing_model->total_BDE_hot_count($Bde_code);
                  $output .= "<td>".$total_bde_count['COUNT(Prospect_Icode)']."</br>" .
                  $total_cold['COUNT(Prospect_Icode)']."|" .$total_warm['COUNT(Prospect_Icode)']."|".$total_hot['COUNT(Prospect_Icode)']."</td>";
                  $output .= "</tr>";  
              }  
        }
        echo "</tbody>";
        echo $output;
}

//** Allocate Data to BDE **/
public function Allocate_BDE()
{
      $date = date('d/m/Y');
      $array1= $this->session->userdata['Current_data']; 
      $BDE = $this->input->post('BDE');
      $Assign_record_count = $this->input->post('Assign_record_count');
      $output = array_slice($array1, 0, $Assign_record_count, true);
      foreach ($output as $key) 
      {
          $data = array('Data_Assigned_Date' => $date,
                        'Current_BDE_User_Code' => $BDE );
          $data_Icode = $key['Prospect_Icode'];
          $this->db->where('Prospect_Icode',$data_Icode);
          $this->db->update('ibt_prospect_data', $data);
      }
      $this->session->set_flashdata('message', 'Data Allotment updated Successfully..');
      redirect('welcome/new_allocate');
}

//Get Country Wise State**//
public function get_country_state()
{
      $country_code = $this->input->post('id',TRUE);  
      $data['state'] = $this->marketing_model->get_country_state($country_code);
      $name = 'Select Sate';
      $output = null;  
      $output = "<option value=''>".$name."</option>";  
      foreach ( $data['state'] as $row)  
      {  
          $output .= "<option value='".$row->State."'>".$row->State."</option>";  
      }  
      echo $output;  
}

/** Stete based City */
public function get_state_city()
{
      $state_code = $this->input->post('id',TRUE);  
      $data['city'] = $this->marketing_model->get_state_city($state_code);
      $name = 'Select City';
      $output = null;  
      $output = "<option value=''>".$name."</option>"; 
      foreach ( $data['city'] as $row)  
      {  
          $output .= "<option value='".$row->City."'>".$row->City."</option>";  
      }  
      echo $output;  

}
 public  function ExcelDataAdd_new() {  
//Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)  
         $configUpload['upload_path'] = FCPATH.'uploads/excel/';
         $configUpload['allowed_types'] = 'xls|xlsx|csv';
         $configUpload['max_size'] = '5000';
         $this->load->library('upload', $configUpload);
         $this->upload->do_upload('userfile');  
         $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
         $file_name = $upload_data['file_name']; //uploded file name
     $extension=$upload_data['file_ext'];    // uploded file extension
    
//$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
    $objReader= PHPExcel_IOFactory::createReader('Excel2007'); // For excel 2007     
          //Set to read only
    $objReader->setReadDataOnly(true);      
        //Load excel file
    $objPHPExcel=$objReader->load(FCPATH.'uploads/excel/'.$file_name);    
         $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel         
         $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
          //loop from first data untill last data
          for($i=2;$i<=$totalrows;$i++)
          {
            $cname= $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();  
             $URL= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue();   
              $phone= $objWorksheet->getCellByColumnAndRow(2,$i)->getValue();   
             
              $country= $objWorksheet->getCellByColumnAndRow(3,$i)->getValue(); //Excel Column 1
            $ref= $objWorksheet->getCellByColumnAndRow(4,$i)->getValue(); //Excel Column 2

              $data_user=array( 'Company_Name'=>$cname,
                                'Country'=>$country, 
                                'WebURL'=>$URL ,
                                'Company_Contact'=>$phone,
                                'Reference' =>$ref);
              $checkval=  $this->marketing_model->check_excel_reference($data_user);
        
            
            // $data_user=array('Company_Name'=>$sno2 ,'URL'=>$sno ,'category'=>$cname,'Type'=>$url,'Services'=>$category);
            // $this->marketing_model->Add_excel1($data_user);
 
          }


             
       
    
             // unlink('././uploads/excel/'.$file_name);
             //   $this->session->set_flashdata('message', 'Import Successfully..'); //File Deleted After uploading in database .       
             //  redirect('home/excel');
}
/** REVIEW **/
public function Review()
{
      $this->load->view('Admin/header');
      $this->load->view('Admin/top');
      $this->load->view('Admin/left');
      $this->load->view('Admin/ReviewAnalysis');
}

/** Get Review Data **/
public function get_Review_Data()
{
      $data['BDE']= $this->marketing_model->get_all_BDE();
      $output = null; 
      foreach ($data['BDE'] as $row)  
      {  
            $I_code = $row['User_Icode'];
            $output .= "<tr>";
            $output .= "<td>".$row['User_Name']."</td>";  
            $data['analysis'] = $this->marketing_model->BDE_data_Analysis_Count($I_code);
            foreach ($data['analysis'] as $key ) 
            {
                    $country = $key['Country'];
                    $output .= "<td><a href='get_all_review_data/$country/$I_code'>".$key['Country']. "|" .$key['COUNT(*)']. "</a></td>";  
            }
            $output .= "</tr>";
      }
      echo $output; 
}

/**Get Prospect Analysis Data*/
public function get_ProspectAnalysis_data()
{
        $id =$this->input->post('BDE',TRUE);
        $data['Analysis']= $this->marketing_model->get_prospect_Analysis_Data($id);
        $output = null;  
        foreach ($data['Analysis'] as $row)  
        {  
              if(empty($row))
              {

              }
              else
              {
                    $output .= "<tr>";
                    $output .="<td><input type='checkbox' class='case' name='case' value=".$row['Prospect_Icode']."</td>";
                    $output .= "<td>".$row['Company_Name']."</td>";  
                    $output .= "<td>".$row['prospect_Category']."</td>";  
                    $output .= "<td>".$row['Marketing_Prospect_Type']."</td>";  
                    $output .= "<td>".$row['Marketing_Services']."</td>";
                    $output .= "<td>".$row['Marketing_Approch']."</td>";
                    $output .= "<td>".$row['domain']."</td>";
                    $output .= "<td>".$row['domain']."</td>";
                    $output .= "</tr>";
              }  
        }
        echo $output;  

}

/** Get All Reviewed Data**/
public function get_all_review_data($country,$id)
{
      $country =  $this->uri->segment(3);
      $Icode =  $this->uri->segment(4);
      $data['Update_Analysis']= $this->marketing_model->get_All_Analysis_Data($country,$Icode);
      $data['Industry'] = $this->marketing_model->Get_Industry_Details();
      $data['Domain'] = $this->marketing_model->Get_Domain_Details();
      $this->load->view('Admin/header');
      $this->load->view('Admin/top');
      $this->load->view('Admin/left');
      $this->load->view('Admin/BDE_Analysis_Data',$data,FALSE);
}

//**Update Prospect Analysis Data**/
public function Update_Prospect_Analysis()
{
      $date = date('Y-m-d');
      $User_Icode = $this->input->post('BDE',TRUE);
      $P_code = $this->input->post('row_id',TRUE);
      $domain = $this->input->post('Domain',TRUE);
      $industry = $this->input->post('Industry',TRUE);
      if($industry == "")
      {

      }
      else
      {
          $query = $this->db->query("DELETE from ibt_prospect_industry where prospect_prospect_icode = '$P_code' and  User_Icode ='$User_Icode' ");
          foreach ($industry as $key ) 
          {
              $domainval = array( 'prospect_prospect_icode' => $P_code,
                                  'prospect_Industry_Icode' =>$key ,
                                  'User_Icode' => $User_Icode);
              $insert = $this->marketing_model->insert_Industry_Data($domainval);
          }
      }


      if($domain == "")
      {

      }
      else
      {
          $query = $this->db->query("DELETE from ibt_prospect_domain where prospect_prospect_icode = '$P_code' and  User_Icode ='$User_Icode' ");
          foreach ($domain as $key ) 
          {
              $domainval = array( 'prospect_prospect_icode' => $P_code,
                                  'prospect_Domain_Icode' =>$key,
                                  'User_Icode' => $User_Icode);
              $insert = $this->marketing_model->insert_Domain_Data($domainval);
          }
      }

      $idd = $this->session->userdata['fname'];
      $status = 'Yes';

      if($idd == 'admin')
      {
           $leader_code = '000';
      }
      else
      {
            $leader_code = $this->session->userdata['userid']; 
      }
      $data = array('Marketing_Prospect_Type' =>  $this->input->post('type',TRUE),
                    'Marketing_Services' =>  $this->input->post('services',TRUE),
                    'Marketing_Approch' =>  $this->input->post('approch',TRUE),
                    'prospect_Category' =>  $this->input->post('category',TRUE),
                    'Review_Leader_Code' => $leader_code,
                    'Review_Date' =>$date,
                    'Review_Status' =>$status );
      $this->db->where('Prospect_Icode',$P_code);
      $this->db->update('ibt_prospect_data', $data);
      echo 'success';
}
//**Update Prospect Analysis Data**/
public function reviewed_Data()
{
    $date = date('Y-m-d');
    $idd = $this->session->userdata['fname'];
    $status = 'Yes';

    if($idd == 'admin')
    {

        $leader_code = '00';
    }
    else
    {
         $leader_code = $this->session->userdata['userid']; 
    }
    $data= $this->input->post('tbldata');
    $categories = '';
    $cats = explode(",", $data);
    foreach ($cats as $key ) 
    {
          $data = array(
                        'Review_Leader_Code' =>$leader_code,
                        'Review_Date' =>$date,
                        'Review_Status' =>$status
                        );

          $this->db->where('Prospect_Icode',$key);
          $this->db->update('ibt_prospect_data', $data);
    }
    echo 1;


}
//**BDE Status**/

public function BDE_Status()
{
      $this->load->view('Admin/header');
      $this->load->view('Admin/top');
      $this->load->view('Admin/left');
      $this->load->view('Admin/BDE_Status');
}
//** View BDE Status **/
public function View_BDE_Status()
{
      $data['data_country']= $this->marketing_model->Data_Country();
      $data['BDE']= $this->marketing_model->get_all_BDE();
      $name = 'NAME';
      $tot = 'Total';
      echo"<thead>";
      $output = "<th>".$name."</th>";
      foreach ($data['data_country'] as $row)  
      {  
          if(empty($row))
          {

          }
          else
          {
              $countery_name[] = $row['Country'];
              $output .= "<th>".$row['Country']. "</br>Y|C|W|H</th>";     
          }  
      }

      $output .= "<th>".$tot."</br>Y|C|W|H</th>";
      echo "</thead>";
      echo "<tbody>";
      foreach ($data['BDE'] as $row)  
      {  
            if(empty($row))
            {

            }
            else
            {
                $Bde_code = $row['User_Icode'];
                $output .= "<tr><td>".$row['User_Name']."</td>";
                foreach ($countery_name as $key) 
                {
                      $cname = $key; //Cname: CountryName
                      $data['count']= $this->marketing_model->get_BDE_data_count($cname,$Bde_code);
                      foreach ($data['count'] as  $value) 
                      {
                          $yet = $this->marketing_model->get_BDE_New_count($cname,$Bde_code);
                          $da= $this->marketing_model->get_BDE_cold_count($cname,$Bde_code);
                          $warm = $this->marketing_model->get_BDE_warm_count($cname,$Bde_code);
                          $hot = $this->marketing_model->get_BDE_hot_count($cname,$Bde_code);

                          $output .= "<td><h4 style='color:#0698b7;  font-size: 18px; margin:0;'>".$value['COUNT(Prospect_Icode)']. "</h4></br><h5 style='background:#ccc; padding: 10px; font-size: 18px; margin:0; letter-spacing: 1px;'>" .
                          $yet['COUNT(Prospect_Icode)']. "-"  .$da['COUNT(Prospect_Icode)']. "-" .$warm['COUNT(Prospect_Icode)']. "-" .$hot['COUNT(Prospect_Icode)']."</h5></td>";
                      }
                }
                $total_bde_count = $this->marketing_model->total_BDE_data_count($Bde_code);
                $total_New = $this->marketing_model->total_BDE_New_count($Bde_code);
                $total_cold = $this->marketing_model->total_BDE_cold_count($Bde_code);
                $total_warm = $this->marketing_model->total_BDE_warm_count($Bde_code);
                $total_hot = $this->marketing_model->total_BDE_hot_count($Bde_code);
                $output .= "<td><h4 style='color:red;  font-size: 18px; margin:0;'>".$total_bde_count['COUNT(Prospect_Icode)']."</h4></br><h5 style='background: #367fa9; color:#fff; margin:0; padding: 10px; font-size: 18px;letter-spacing: 1px;'>" .
                $total_New['COUNT(Prospect_Icode)']."|" .$total_cold['COUNT(Prospect_Icode)']."|" .$total_warm['COUNT(Prospect_Icode)']."|".$total_hot['COUNT(Prospect_Icode)']."</h5></td>";
                $output .= "</tr>";  
            }  
      }
      echo "</tbody>";
      echo $output;
}

/** RE-ALLOCATE**/
public function Re_allocate()
{
      $this->load->view('Admin/header');
      $this->load->view('Admin/top');
      $this->load->view('Admin/left');
      $this->load->view('Admin/Re_Allocate');
}

/** VIew Re-allocate **/
public function View_Re_Allocate()
{
      $data['data_country']= $this->marketing_model->Data_Country();
      $data['BDE']= $this->marketing_model->get_all_BDE();
      $name = 'NAME';
      $tot = 'Total';
      echo"<thead>";
      $output = "<th>".$name."</th>";
      foreach ($data['data_country'] as $row)  
      {  
          if(empty($row))
          {

          }
          else
          {
              $countery_name[] = $row['Country'];
              $output .= "<th>".$row['Country']. "</br>Y|C|W|H</th>";     
          }  
      }
      $output .= "<th>".$tot."</br>Y|C|W|H</th>";
      echo "</thead>";
      echo "<tbody>";
      foreach ($data['BDE'] as $row)  
      {  
            if(empty($row))
            {

            }
            else
            {
                  $Bde_code = $row['User_Icode'];
                  $output .= "<tr><td>".$row['User_Name']."</td>";
                  foreach ($countery_name as $key)
                  {
                        $cname = $key;
                        $data['count']= $this->marketing_model->get_BDE_data_count_Reallocate($cname,$Bde_code);
                        foreach ($data['count'] as  $value)
                        {
                              $yet = $this->marketing_model->get_BDE_New_count_Reallocate($cname,$Bde_code);
                              $da= $this->marketing_model->get_BDE_cold_count_Reallocate($cname,$Bde_code);
                              $warm = $this->marketing_model->get_BDE_warm_count_Reallocate($cname,$Bde_code);
                              $hot = $this->marketing_model->get_BDE_hot_count_Reallocate($cname,$Bde_code);
                              $country = $yet['Country'];
                              $country1 = $da['Country'];
                              $country2 = $warm['Country'];
                              $country3 = $hot['Country'];
                              $output .= "<td><h4 style='color:#000;  font-size: 18px; margin:0;'>".$value['COUNT(Prospect_Icode)']. "</h4></br><h5 style='background:#ccc; padding: 10px; font-size: 18px; margin:0; letter-spacing: 1px;'><a href='get_all_Yet_data/$country/$Bde_code'>" .
                              $yet['COUNT(Prospect_Icode)']. "</a> -  <a href='get_all_Cold_data/$country1/$Bde_code'>"  .$da['COUNT(Prospect_Icode)']. "</a>  -  <a href='get_all_Warm_data/$country2/$Bde_code'>" .$warm['COUNT(Prospect_Icode)']. "</a>  -   <a href='get_all_Hot_data/$country3/$Bde_code'>" .$hot['COUNT(Prospect_Icode)']."</a></h5></td>";
                        }
                  }
                  $total_bde_count = $this->marketing_model->total_BDE_data_count_Reallocate($Bde_code);
                  $total_New = $this->marketing_model->total_BDE_New_count_Reallocate($Bde_code);
                  $total_cold = $this->marketing_model->total_BDE_cold_count_Reallocate($Bde_code);
                  $total_warm = $this->marketing_model->total_BDE_warm_count_Reallocate($Bde_code);
                  $total_hot = $this->marketing_model->total_BDE_hot_count_Reallocate($Bde_code);
                  $output .= "<td><h4 style='color:red;  font-size: 18px; margin:0;'>".$total_bde_count['COUNT(Prospect_Icode)']."</h4></br><h5 style='background: #367fa9; color:#fff; margin:0; padding: 10px; font-size: 18px;letter-spacing: 1px;'>" .
                  $total_New['COUNT(Prospect_Icode)']."|" .$total_cold['COUNT(Prospect_Icode)']."|" .$total_warm['COUNT(Prospect_Icode)']."|".$total_hot['COUNT(Prospect_Icode)']."</h5></td>";
                  $output .= "</tr>";  
             }  
      }
      echo "</tbody>";
      echo $output;

}

/** Get All New Data**/
public function get_all_Yet_data($country,$id)
{
      $country =  $this->uri->segment(3);
      $Icode =  $this->uri->segment(4);

      $data= $this->marketing_model->get_BDE_New_count($country,$Icode);
      $data_user= $this->marketing_model->get_BDE_New_details($country,$Icode);
      $_SESSION['old_data'] = $data_user; 

      $data['product']= $this->marketing_model->get_All_Yet_Data_New_Product($country,$Icode);
      $product_data = $this->marketing_model->get_All_Yet_Data_New_Product_details($country,$Icode);
      $_SESSION['product_data'] = $product_data;

      $data['services']= $this->marketing_model->get_All_Yet_Data_New_Service($country,$Icode);
      $service_data = $this->marketing_model->get_All_Yet_Data_New_Service_details($country,$Icode);
      $_SESSION['service_data'] = $service_data;

      $data['custom']= $this->marketing_model->get_All_Yet_Data_New_custom($country,$Icode);
      $service_data = $this->marketing_model->get_All_Yet_Data_New_custom_details($country,$Icode);
      $_SESSION['custom_data'] = $service_data;

      $data['web']= $this->marketing_model->get_All_Yet_Data_New_web($country,$Icode);
      $service_data = $this->marketing_model->get_All_Yet_Data_New_web_details($country,$Icode);
      $_SESSION['web_data'] = $service_data;

      $data['mobile']= $this->marketing_model->get_All_Yet_Data_New_mobile($country,$Icode);
      $service_data = $this->marketing_model->get_All_Yet_Data_New_mobile_details($country,$Icode);
      $_SESSION['mobile_data'] = $service_data;

      $data['ec']= $this->marketing_model->get_All_Yet_Data_New_ec($country,$Icode);
      $service_data = $this->marketing_model->get_All_Yet_Data_New_ec_details($country,$Icode);
      $_SESSION['ec_data'] = $service_data;

      $data['BDE']= $this->marketing_model->get_all_BDE_ReAllote($Icode);
      $data['country']=$country;
      $data['count'] = $data['COUNT(Prospect_Icode)'];
      $data['show'] = $country .'- Yet to Call -';
      $this->load->view('Admin/header');
      $this->load->view('Admin/top');
      $this->load->view('Admin/left');
      $this->load->view('Admin/Re_Allocate_view',$data,FALSE);
}


/** Get All Cold Data**/
public function get_all_Cold_data($country,$id)
{
        $country =  $this->uri->segment(3);
        $Icode =  $this->uri->segment(4);

        $data= $this->marketing_model->get_BDE_cold_count($country,$Icode);
        $data_user= $this->marketing_model->get_BDE_cold_details($country,$Icode);
        $_SESSION['old_data'] = $data_user;
        $data['product']= $this->marketing_model->get_All_Cold_Product($country,$Icode);
        $data['services']= $this->marketing_model->get_All_Cold_Service($country,$Icode);
        $data['custom']= $this->marketing_model->get_All_Cold_custom($country,$Icode);
        $data['web']= $this->marketing_model->get_All_Cold_web($country,$Icode);
        $data['mobile']= $this->marketing_model->get_Cold_mobile($country,$Icode);
        $data['ec']= $this->marketing_model->get_Cold_ec($country,$Icode);
        $data['BDE']= $this->marketing_model->get_all_BDE_ReAllote($Icode);
        $data['country']=$country;
        $data['count'] = $data['COUNT(Prospect_Icode)'];
        $data['show'] = $country .'- Cold Data -';
        $this->load->view('Admin/header');
        $this->load->view('Admin/top');
        $this->load->view('Admin/left');
        $this->load->view('Admin/Re_Allocate_Cold_view',$data,FALSE);
}


/** Get All Warm Data**/
public function get_all_Warm_data($country,$id)
{
      $country =  $this->uri->segment(3);
      $Icode =  $this->uri->segment(4);
      $data= $this->marketing_model->get_BDE_warm_count($country,$Icode);
      $data_user= $this->marketing_model->get_BDE_warm_details($country,$Icode);
      $_SESSION['old_data'] = $data_user;

      $data['product']= $this->marketing_model->get_All_warm_Product($country,$Icode);
      $data['services']= $this->marketing_model->get_All_warm_Service($country,$Icode);
      $data['custom']= $this->marketing_model->get_All_warm_custom($country,$Icode);
      $data['web']= $this->marketing_model->get_All_warm_web($country,$Icode);
      $data['mobile']= $this->marketing_model->get_warm_mobile($country,$Icode);
      $data['ec']= $this->marketing_model->get_warm_ec($country,$Icode);
      $data['BDE']= $this->marketing_model->get_all_BDE_ReAllote($Icode);
      $data['country']=$country;
      $data['count'] = $data['COUNT(Prospect_Icode)'];
      $data['show'] = $country .'- Warm Data -';
      $this->load->view('Admin/header');
      $this->load->view('Admin/top');
      $this->load->view('Admin/left');
      $this->load->view('Admin/Re_Allocate_Warm_view',$data,FALSE);

}
/** Get All HOT Data**/
public function get_all_Hot_data($country,$id)
{
      $country =  $this->uri->segment(3);
      $Icode =  $this->uri->segment(4);
      $data= $this->marketing_model->get_BDE_hot_count($country,$Icode);
      $data_user= $this->marketing_model->get_BDE_hot_details($country,$Icode);

      $_SESSION['old_data'] = $data_user;
      $data['product']= $this->marketing_model->get_All_hot_Product($country,$Icode);
      $data['services']= $this->marketing_model->get_All_hot_Service($country,$Icode);
      $data['custom']= $this->marketing_model->get_All_hot_custom($country,$Icode);
      $data['web']= $this->marketing_model->get_All_hot_web($country,$Icode);
      $data['mobile']= $this->marketing_model->get_hot_mobile($country,$Icode);
      $data['ec']= $this->marketing_model->get_hot_ec($country,$Icode);
      $data['BDE']= $this->marketing_model->get_all_BDE_ReAllote($Icode);
      $data['country']=$country;
      $data['count'] = $data['COUNT(Prospect_Icode)'];
      $data['show'] = $country .'- Hot Data -';

      $this->load->view('Admin/header');
      $this->load->view('Admin/top');
      $this->load->view('Admin/left');
      $this->load->view('Admin/Re_Allocate_Hot_view',$data,FALSE);

}

//** RE_ALOLOCATE **//
 public function Allocate_BDE_Re_Allocate()
{

        $date = date('d/m/Y');
        $array1= $this->session->userdata['old_data']; 
        $bdecode = $this->input->post('BDE',true);
        $Assign_record_count = $this->input->post('tot_count',true);
        $output = array_slice($array1, 0, $Assign_record_count, true);
        foreach ($output as $key)
        {
            $data = array('Data_Assigned_Date' => $date,
                          'Current_BDE_User_Code' => $bdecode );
            $data_Icode = $key['Prospect_Icode'];
            $this->db->where('Prospect_Icode',$data_Icode);
            $this->db->update('ibt_prospect_data', $data);
        }
        echo 1;

}


//** Category Wise Re-allocate **/
public function BDE_Re_Allocate()
{
      $type = $this->input->post('Type',true);
      if($type == 'Product')
      {
          $date = date('d/m/Y');
          $array1= $this->session->userdata['product_data']; 
          $bdecode = $this->input->post('BDE',true);
          $Assign_record_count = $this->input->post('tot_count',true);
          $output = array_slice($array1, 0, $Assign_record_count, true);
          foreach ($output as $key)
          {
              $data = array('Data_Assigned_Date' => $date,
                            'Current_BDE_User_Code' => $bdecode );
              $data_Icode = $key['Prospect_Icode'];
              $this->db->where('Prospect_Icode',$data_Icode);
              $this->db->update('ibt_prospect_data', $data);
          }
          echo 1;
      }
      else if($type == 'service')
      {
          $date = date('d/m/Y');
          $array1= $this->session->userdata['service_data']; 
          $bdecode = $this->input->post('BDE',true);
          $Assign_record_count = $this->input->post('tot_count',true);
          $output = array_slice($array1, 0, $Assign_record_count, true);
          foreach ($output as $key) 
          {
              $data = array('Data_Assigned_Date' => $date,
                            'Current_BDE_User_Code' => $bdecode );
              $data_Icode = $key['Prospect_Icode'];
              $this->db->where('Prospect_Icode',$data_Icode);
              $this->db->update('ibt_prospect_data', $data);
          }
          echo 1;
      }
      else if($type == 'custom')
      {
          $date = date('d/m/Y');
          $array1= $this->session->userdata['custom_data']; 
          $bdecode = $this->input->post('BDE',true);
          $Assign_record_count = $this->input->post('tot_count',true);
          $output = array_slice($array1, 0, $Assign_record_count, true);
          foreach ($output as $key) 
          {
              $data = array('Data_Assigned_Date' => $date,
                            'Current_BDE_User_Code' => $bdecode );
              $data_Icode = $key['Prospect_Icode'];
              $this->db->where('Prospect_Icode',$data_Icode);
              $this->db->update('ibt_prospect_data', $data);
          }
          echo 1;
      }
      else if($type == 'mobile')
      {
          $date = date('d/m/Y');
          $array1= $this->session->userdata['mobile_data']; 
          $bdecode = $this->input->post('BDE',true);
          $Assign_record_count = $this->input->post('tot_count',true);
          $output = array_slice($array1, 0, $Assign_record_count, true);
          foreach ($output as $key) 
          {
              $data = array('Data_Assigned_Date' => $date,
                            'Current_BDE_User_Code' => $bdecode );
              $data_Icode = $key['Prospect_Icode'];
              $this->db->where('Prospect_Icode',$data_Icode);
              $this->db->update('ibt_prospect_data', $data);
          }
          echo 1;
      }
      else if($type == 'web')
      {
          $date = date('d/m/Y');
          $array1= $this->session->userdata['web_data']; 
          $bdecode = $this->input->post('BDE',true);
          $Assign_record_count = $this->input->post('tot_count',true);
          $output = array_slice($array1, 0, $Assign_record_count, true);
          foreach ($output as $key) 
          {
              $data = array('Data_Assigned_Date' => $date,
                            'Current_BDE_User_Code' => $bdecode );
              $data_Icode = $key['Prospect_Icode'];
              $this->db->where('Prospect_Icode',$data_Icode);
              $this->db->update('ibt_prospect_data', $data);
          }
          echo 1;
      }
      else if($type == 'Ec')
      {
          $date = date('d/m/Y');
          $array1= $this->session->userdata['ec_data']; 
          $bdecode = $this->input->post('BDE',true);
          $Assign_record_count = $this->input->post('tot_count',true);
          $output = array_slice($array1, 0, $Assign_record_count, true);
          foreach ($output as $key) 
          {
              $data = array('Data_Assigned_Date' => $date,
                            'Current_BDE_User_Code' => $bdecode );
              $data_Icode = $key['Prospect_Icode'];
              $this->db->where('Prospect_Icode',$data_Icode);
              $this->db->update('ibt_prospect_data', $data);
          }
          echo 1;
      }
      else
      {
      echo 0;
      }
}                     

//** DND & CNE REVIEW **/

public function DNDReview()
{
      $data['data_country_DND']= $this->marketing_model->Data_Country_DND();
      $data['data_DND']= $this->marketing_model->Get_DND();

      $this->load->view('Admin/header');
      $this->load->view('Admin/top');
      $this->load->view('Admin/left');
      $this->load->view('Admin/DND_CNE_Review',$data,false);
}

//** Review DND CNE **/
public function Review_DND_CNE()
{
      $date = date('Y-m-d H:i:s');
      $P_code = $this->input->post('id',true);
      $idd = $this->session->userdata['fname'];
      $status = 'Yes';
      if($idd == 'admin')
      {
          $leader_code = '01';
      }
      else
      {
          $leader_code = $this->session->userdata['userid']; 
      }
      $data = array(
      'Blocked_Review_Leader_Code' =>$leader_code,
      'Blocked_Review_Date' =>$date,
      'Blocked_Review_Status' =>$status
      );
      $this->db->where('Prospect_Icode',$P_code);
      $this->db->update('ibt_prospect_data', $data);
      echo '1';

}

//** Search DND CNE **/
public function search_DND()
{
      $data_search = array('country'                   => $this->input->post('country',true),
                           'prospectData_Blocked_Type'                      =>$this->input->post('type',true));
      $prospect_data['Block_details']= $this->marketing_model->Search_DND_CNE_details($data_search);
      $status = "Confirm";
      $status1 = "Please Review";
      $a = "";
      $output = null;
      $i = 1;
      foreach ($prospect_data['Block_details'] as $key ) 
      {
            $output .="<tr>";
            $output .="<td>" .$i. "</td>";
            $output .="<td>" .$key['Company_Name']. "</td>";
            $output .="<td><a href='".$key['WebURL']."'' target='_blank'>" .$key['WebURL']. "</td>";
            $output .="<td>" .$key['Country']. "</td>";
            $output .="<td>" .$key['prospectData_Blocked_Type']. "</td>";
            $output .="<td>" .$key['User_Name']. "</td>";
            if($key['prospectData_Blocked_Type'] == 'DND')
            {
                  if( $key['Blocked_Review_Status'] == 'Yes')
                  {
                      $output .="<td>" .$status. " " .$key['prospectData_Blocked_Type']. "</td>";
                      $output .="<td>" .$a. "</td>";
                  }
                  else
                  {
                      $output .="<td>" .$status1. "</td>";
                      $output .="<td> <button id='myBtn' class='btn btn-success' value='". $key['Prospect_Icode']."' 
                      onclick='Review_Data(this.value)'' >Confirm</button>
                      </td>";
                  }
            }
            else
            {
                  if( $key['Blocked_Review_Status'] == 'Yes')
                  {
                        $output .="<td>" .$status. " " .$key['prospectData_Blocked_Type']. "</td>";
                        $output .="<td>" .$a. "</td>";
                  }
                  else
                  {
                        $output .="<td>" .$status1. "</td>";
                        $output .="<td> <button id='myBtn' class='btn btn-success' value='". $key['Prospect_Icode']."' 
                        onclick='Review_Data(this.value)'' >Confirm</button>
                        <button name='client_id2' class='btn btn-info'   data-toggle='modal' data-target='#myModal1' 
                        value='". $key['Prospect_Icode']."'  onclick='getcurrent_data(this.value)'>Change</button></td>";
                  }
            }
            $output .="</tr>";
            $i++;
      }
      echo $output;
}

/** GET CHANGED DND CNE DATA **/
public function get_DND_CNE_Change_data()
{
      $P_code = $this->input->post('id',TRUE); 
      $data['edit'] = $this->marketing_model->Edit_Prospect_Data($P_code);
      $one = "1";
      $zero ="0";
      $output = null;  
      foreach ($data['edit'] as $row)  
      { 
          $output .= "<h4>USERNAME :" .$row['User_Name']. "</h4>";
          $output .="<div class='row'>";
          $output .="<div class='col-md-4'>";
          $output .= "<input type='hidden' class='form-control' id='pcode' name='pcode' value='".$row['Prospect_Icode']."'> </br>";  
          $output .= "Branch : <input type='text' class='form-control' id='Branch' name='Branch' value='".$row['Has_Branches']."'> </br>";  

          if($row['Has_Office_In_India'] == $one)
          {
              $output .= "Has Office in India :  <input   id='office' value='".$one."' type='radio' name='office' checked='checked' />  Yes
              <input  type='radio' name='office' value='".$zero."' /> No </br>";
          }
          else
          {
              $output .= "Has Office in India :  <input  id='office'  value='".$one."' type='radio' name='office'  />  Yes
              <input  type='radio' name='office' value='".$zero."' checked='checked' /> No </br>";
          }
          $output .= "Building Type : <input type='text' id='Building_Type' class='form-control' name='Building_Type' value='".$row['Building_Type']."'> </br>"; 
          $output .= "Address : <input type='text' name='Address' id='Address' class='form-control' value='".$row['Address']."'> </br>"; 
          $output .= "City : <input type='text' name='City' id='City' class='form-control' value='".$row['City']."'> </br>"; 
          $output .= "State : <input type='text' name='State'  id='State' class='form-control' value='".$row['State']."'> </br>"; 
          $output .= "Company Email : <input type='text' id='Email' name='Email' class='form-control' value='".$row['Company_Email']."'> </br>"; 

          $output .= "FB URL : <input type='text' name='FB' id='FB' class='form-control' value='".$row['FB_URL']."'> </br>"; 
          $output .= "LinkedIn URL : <input type='text' id='LinkedIn' class='form-control' name='LinkedIn' value='".$row['LinkedIn_URL']."'> </br>"; 
          $output .="</div>";
          $output .="<div class='col-md-4'>";
          $output .= "Time Zone : <input type='text' id='Time_Zone' class='form-control' name='Time_Zone' value='".$row['Time_Zone']."'> </br>"; 

          $output .= "PC Name : <input type='text' id='PC_Name' class='form-control' name='PC_Name' value='".$row['PC_Name']."'> </br>"; 
          $output .= "Pc Desig : <input type='text' id='Pc_Desig' class='form-control' name='Pc_Desig' value='".$row['PC_Desig']."'> </br>"; 
          $output .= "PC Email : <input type='text'  id='PC_Email' class='form-control' name='PC_Email' value='".$row['PC_Email']."'> </br>"; 
          $output .= "PC Ph.No : <input type='text'  id='Ph_No'  class='form-control' name='Ph_No' value='".$row['PC_Phone']."'> </br>"; 

          $output .= "SC Name : <input type='text'  id='SC_Name' class='form-control' name='SC_Name' value='".$row['SC_Name']."'> </br>"; 
          $output .= "Sc Desig : <input type='text'  id='Sc_Desig' class='form-control' name='Sc_Desig' value='".$row['SC_Desig']."'> </br>"; 
          $output .= "SC Email : <input type='text'  id='SC_Email'  class='form-control' name='SC_Email' value='".$row['SC_Email']."'> </br>"; 
          $output .= "SC Ph.No: <input type='text'  id='SC_Ph_No' class='form-control' name='SC_Ph_No' value='".$row['SC_Phone']."'> </br>"; 
          $output .="</div>";
          $output .="<div class='col-md-4'>";

          if($row['Career_Section'] == $one)
           {
              $output .= "Career :  <input  id='Career'   type='radio' name='Career'  value=".$one." checked='checked'  />Yes
             <input  type='radio' name='Career'  value=".$zero." /> No </br> "; 

           }
           else
           {
               $output .= "Career :  <input  id='Career'  type='radio' name='Career'  value=".$one."   />Yes
             <input  type='radio' name='Career'  value=".$zero." checked='checked' /> No </br> "; 
           }
          $output .= "Emp Count: <input type='text' id='Emp_Count'  class='form-control' name='Emp_Count' value='".$row['Emp_Count']."'> </br>"; 
          $output .= "Prospect Type : <input type='text' id='Prospect_Type'  class='form-control' name='Prospect_Type' value='".$row['Prospect_Type']."'> </br>";

          if($row['Product_Development'] == $one)
          {
              $output .= "Product :  <input   type='radio'  id='Product'  name='Product'  value=".$one." checked='checked' />Yes
              <input  type='radio' name='Product'  id='Product' value=".$zero." />No </br> "; 
          }
          else
          {
              $output .= "Product :  <input   type='radio' id='Product'  name='Product'  value=".$one."  />Yes
              <input  type='radio' name='Product' id='Product' value=".$zero." checked='checked' />No </br> "; 
          }
          $output .= "No.of Products : <input type='text' id='No_Products'  class='form-control' name='No_Products' value='".$row['Products_Count']."'> </br>"; 


          if($row['Domain'] == $one)
          {
              $output .= "Domain :  <input   type='radio' id='Domain'  name='Domain' value=".$one." checked='checked' />Yes
              <input  type='radio' name='Domain' id='Domain'   value=".$zero." />No </br> "; 
          }
          else
          {
              $output .= "Domain :  <input   type='radio' id='Domain'  name='Domain'  value=".$one."  />Yes
              <input  type='radio' name='Domain' id='Domain'  value=".$zero." checked='checked' />No </br> "; 
          }
          if($row['Custom_Development'] == $one)
          {
              $output .= "Custom :  <input  id='Custom'   type='radio' name='Custom' value=".$one." checked='checked' />Yes
              <input  type='radio' name='Custom' id='Custom'   value=".$zero." />No </br> "; 
          }
          else
          {
              $output .= "Custom :  <input  id='Custom' type='radio' name='Custom'  value=".$one."  />Yes
              <input  type='radio' name='Custom' id='Custom' value=".$zero." checked='checked' />No </br> "; 
          }



         if($row['Web_Development'] == $one)
         {
          $output .= "Web_Development :  <input  id='Web' type='radio' name='Web' value=".$one." checked='checked' />Yes
           <input  type='radio' name='Web'  id='Web' value=".$zero." />No </br> "; 
         }
         else
         {
          $output .= "Web_Development :  <input id='Web'   type='radio' name='Web'  value=".$one."  />Yes
         <input  type='radio' name='Web' id='Web' value=".$zero." checked='checked' />No </br> "; 
         }

         if($row['Mobile_Development'] == $one)
         {
          $output .= "Mobile :  <input   type='radio' id='Mobile' name='Mobile' value=".$one." checked='checked' />Yes
           <input  type='radio' name='Mobile' id='Mobile'  value=".$zero." />No </br> "; 
         }
         else
         {
          $output .= "Mobile :  <input   type='radio' id='Mobile' name='Mobile'  value=".$one."  />Yes
         <input  type='radio' name='Mobile' id='Mobile' value=".$zero." checked='checked' />No </br> "; 
         }

          if($row['Ecommerce_Development'] == $one)
         {
          $output .= "E-Commerce :  <input   type='radio' id='E-Commerce' name='E-Commerce' value=".$one." checked='checked' />Yes
           <input  type='radio' name='E-Commerce' id='E-Commerce'  value=".$zero." />No </br> "; 
         }
         else
         {
          $output .= "E-Commerce :  <input   type='radio' id='E-Commerce' name='E-Commerce'  value=".$one."  />Yes
         <input  type='radio' name='E-Commerce' id='E-Commerce' value=".$zero." checked='checked' />No </br> "; 
         }

         $output .= "Technology Info : <input type='text' id='Technology_Info' class='form-control' name='Technology_Info' value='".$row['Tech_Skills']."'>";  
          $output .="</div>";
           $output .="</div>";

      }


      $output .="</div>";
      $output .="</div>";
      $output .="<div class='modal-footer'>"; 
      $output .=" <div class='col-md-6'>";
      $output .="</div>";
      $output .=" <div class='col-md-3'>";
      $output .="<div class='form-group'>";
      $output .="<select name='BDE' class='form-control' id='BDE'  required >";
      $output .="<option value=".$row['prospectData_Blocked_BDE_Code'].">" .$row['User_Name']. "</option>";
      $data['BDE']= $this->marketing_model->get_all_BDE();
      foreach ($data['BDE'] as $key ) 
      {
          $output .= "<option value='".$key['User_Icode']."'>".$key['User_Name']."</option>";
      }
      $output .="</select>";
      $output .="</div>";
      $output .="</div>";
      $output .= "<button type='button' onclick='update_data()'' class='btn btn-success' >Load to Pool</button>";
      $output .= "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>";

      echo $output;
 
}


/** UPDATE REVIEW DND **/
public function Review_DND_CNE_Update()
{
      $P_code = $this->input->post('id',TRUE); 
      $oldvalue = $this->marketing_model->get_prospect_data($P_code);
      $Has_Branches = $this->input->post('Branch',TRUE);
      $office = $this->input->post('office',TRUE);
      $Building_Type = $this->input->post('Building_Type',TRUE);
      $Address = $this->input->post('Address',TRUE);
      $City = $this->input->post('City',TRUE);
      $State = $this->input->post('State',TRUE);
      $Email = $this->input->post('Email',TRUE);
      $FB = $this->input->post('FB',TRUE);
      $LinkedIn = $this->input->post('LinkedIn',TRUE);
      $Time_Zone = $this->input->post('Time_Zone',TRUE);
      $PC_Name = $this->input->post('PC_Name',TRUE);
      $Pc_Desig = $this->input->post('Pc_Desig',TRUE);
      $PC_Email = $this->input->post('PC_Email',TRUE);
      $Ph_No = $this->input->post('Ph_No',TRUE);
      $SC_Name = $this->input->post('SC_Name',TRUE);
      $Sc_Desig = $this->input->post('Sc_Desig',TRUE);
      $SC_Email = $this->input->post('SC_Email',TRUE);
      $SC_Ph_No = $this->input->post('SC_Ph_No',TRUE);
      $Career = $this->input->post('Career',TRUE);
      $Emp_Count = $this->input->post('Emp_Count',TRUE);
      $Prospect_Type = $this->input->post('Prospect_Type',TRUE);
      $Product = $this->input->post('Product',TRUE);
      $No_Products = $this->input->post('No_Products',TRUE);
      $Domain = $this->input->post('Domain',TRUE);
      $Custom = $this->input->post('custom',TRUE);
      $Web = $this->input->post('Web',TRUE);
      $Mobile = $this->input->post('Mobile',TRUE);
      $ECommerce = $this->input->post('ECommerce',TRUE);
      $Technology_Info = $this->input->post('Technology_Info',TRUE);

      if($oldvalue[0]['Has_Branches'] == $Has_Branches)
      {
          $field = "";
          $old_value = "";
          $new_value = "";
      }
      else
      {
          $field = "Has_Branches";
          $old_value = $oldvalue[0]['Has_Branches'];
          $new_value = $Has_Branches;
      }

      if($oldvalue[0]['Has_Office_In_India'] == $office)
      {
          $field1 = "";
          $old_value1 = "";
          $new_value1 = "";
      }
      else
      {
          $field1 = "Has_Office_In_India";
          $old_value1 = $oldvalue[0]['Has_Office_In_India'];
          $new_value1 = $office;
      }

      if($oldvalue[0]['Building_Type'] == $Building_Type)
      {
          $field2 = "";
          $old_value2 = "";
          $new_value2 = "";
      }
      else
      {
          $field2 = "Building_Type";
          $old_value2 = $oldvalue[0]['Building_Type'];
          $new_value2 = $Building_Type;
      }

      if($oldvalue[0]['Address'] == $Address)
      {
          $field3 = "";
          $old_value3 = "";
          $new_value3 = "";
      }
      else
      {
          $field3 = "Address";
          $old_value3 = $oldvalue[0]['Address'];
          $new_value3 = $Address;
      }

      if($oldvalue[0]['City'] == $City)
      {
          $field4 = "";
          $old_value4 = "";
          $new_value4 = "";
      }
      else
      {
          $field4 = "City";
          $old_value4 = $oldvalue[0]['City'];
          $new_value4 = $City;
      }

      if($oldvalue[0]['State'] == $State)
      {
          $field5 = "";
          $old_value5 = "";
          $new_value5 = "";
      }
      else
      {
          $field5 = "State";
          $old_value5 = $oldvalue[0]['State'];
          $new_value5 = $State;
      }

      if($oldvalue[0]['Company_Email'] == $Email)
      {
          $field6 = "";
          $old_value6 = "";
          $new_value6 = "";
      }
      else
      {
          $field6 = "Company_Email";
          $old_value6 = $oldvalue[0]['Company_Email'];
          $new_value6 = $Email;
      }
      if($oldvalue[0]['FB_URL'] == $FB)
      {
          $field7 = "";
          $old_value7 = "";
          $new_value7 = "";
      }
      else
      {
          $field7 = "FB_URL";
          $old_value7 = $oldvalue[0]['FB_URL'];
          $new_value7 = $FB;
      }

      if($oldvalue[0]['LinkedIn_URL'] == $LinkedIn)
      {
          $field8 = "";
          $old_value8 = "";
          $new_value8 = "";
      }
      else
      {
          $field8 = "LinkedIn_URL";
          $old_value8 = $oldvalue[0]['LinkedIn_URL'];
          $new_value8 = $LinkedIn;
      }

      if($oldvalue[0]['Time_Zone'] == $Time_Zone)
      {
          $field9 = "";
          $old_value9 = "";
          $new_value9 = "";
      }
      else
      {
          $field9 = "Time_Zone";
          $old_value9 = $oldvalue[0]['Time_Zone'];
          $new_value9 = $Time_Zone;
      }

      if($oldvalue[0]['PC_Name'] == $PC_Name)
      {
          $field10 = "";
          $old_value10 = "";
          $new_value10 = "";
      }
      else
      {
          $field10 = "PC_Name";
          $old_value10 = $oldvalue[0]['PC_Name'];
          $new_value10 = $PC_Name;
      }

      if($oldvalue[0]['PC_Desig'] == $Pc_Desig)
      {
          $field11 = "";
          $old_value11 = "";
          $new_value11 = "";
      }
      else
      {
          $field11 = "PC_Desig";
          $old_value11 = $oldvalue[0]['PC_Desig'];
          $new_value11 = $Pc_Desig;
      }

      if($oldvalue[0]['PC_Email'] == $PC_Email)
      {
          $field12 = "";
          $old_value12 = "";
          $new_value12 = "";
      }
      else
      {
          $field12 = "PC_Email";
          $old_value12 = $oldvalue[0]['PC_Email'];
          $new_value12 = $PC_Email;
      }

      if($oldvalue[0]['PC_Phone'] == $Ph_No)
      {
          $field13 = "";
          $old_value13 = "";
          $new_value13 = "";
      }
      else
      {
          $field13 = "PC_Phone";
          $old_value13 = $oldvalue[0]['PC_Phone'];
          $new_value13 = $Ph_No;
      }

      if($oldvalue[0]['SC_Name'] == $SC_Name)
      {
          $field14 = "";
          $old_value14 = "";
          $new_value14 = "";
      }
      else
      {
          $field14 = "SC_Name";
          $old_value14 = $oldvalue[0]['SC_Name'];
          $new_value14 = $SC_Name;
      }

      if($oldvalue[0]['SC_Desig'] == $Sc_Desig)
      {
          $field15 = "";
          $old_value15 = "";
          $new_value15 = "";
      }
      else
      {
          $field15 = "SC_Desig";
          $old_value15 = $oldvalue[0]['SC_Desig'];
          $new_value15 = $Sc_Desig;
      }

      if($oldvalue[0]['SC_Email'] == $SC_Email)
      {
          $field16 = "";
          $old_value16 = "";
          $new_value16 = "";
      }
      else
      {
          $field16 = "SC_Email";
          $old_value16 = $oldvalue[0]['SC_Email'];
          $new_value16 = $SC_Email;
      }

      if($oldvalue[0]['SC_Phone'] == $SC_Ph_No)
      {
          $field17  = "";
          $old_value17  = "";
          $new_value17  = "";
      }
      else
      {
          $field17 = "SC_Phone";
          $old_value17 = $oldvalue[0]['SC_Phone'];
          $new_value17 = $SC_Ph_No;
      }

      if($oldvalue[0]['Career_Section'] == $Career)
      {
          $field18 = "";
          $old_value18 = "";
          $new_value18 = "";
      }
      else
      {
          $field18 = "Career_Section";
          $old_value18 = $oldvalue[0]['Career_Section'];
          $new_value18 = $Career;
      }


      if($oldvalue[0]['Emp_Count'] == $Emp_Count)
      {
          $field19 = "";
          $old_value19 = "";
          $new_value19 = "";
      }
      else
      {
          $field19 = "Emp_Count";
          $old_value19 = $oldvalue[0]['Emp_Count'];
          $new_value19 = $Emp_Count;
      }

      if($oldvalue[0]['Prospect_Type'] == $Prospect_Type)
      {
          $field20 = "";
          $old_value20 = "";
          $new_value20 = "";
      }
      else
      {
          $field20 = "Prospect_Type";
          $old_value20 = $oldvalue[0]['Prospect_Type'];
          $new_value20 = $Prospect_Type;
      }

      if($oldvalue[0]['Product_Development'] == $Product)
      {
          $field21 = "";
          $old_value21 = "";
          $new_value21 = "";
      }
      else
      {
          $field21 = "Product_Development";
          $old_value21 = $oldvalue[0]['Product_Development'];
          $new_value21 = $Product;
      }


      if($oldvalue[0]['Products_Count'] == $No_Products)
      {
          $field22 = "";
          $old_value22 = "";
          $new_value22 = "";
      }
      else
      {
          $field22 = "Products_Count";
          $old_value22 = $oldvalue[0]['Products_Count'];
          $new_value22 = $No_Products;
      }

      if($oldvalue[0]['Domain'] == $Domain)
      {
          $field23 = "";
          $old_value23 = "";
          $new_value23 = "";
      }
      else
      {
          $field23 = "Domain";
          $old_value23 = $oldvalue[0]['Domain'];
          $new_value23 = $Domain;
      }

      if($oldvalue[0]['Custom_Development'] == $Custom)
      {
          $field24 = "";
          $old_value24 = "";
          $new_value24 = "";
      }
      else
      {
          $field24 = "Custom_Development";
          $old_value24 = $oldvalue[0]['Custom_Development'];
          $new_value24 = $Custom;
      }

      if($oldvalue[0]['Web_Development'] == $Web)
      {
          $field25 = "";
          $old_value25 = "";
          $new_value25 = "";
      }
      else
      {
          $field25 = "Web_Development";
          $old_value25 = $oldvalue[0]['Web_Development'];
          $new_value25 = $Web;
      }

      if($oldvalue[0]['Mobile_Development'] == $Mobile)
      {
          $field26 = "";
          $old_value26 = "";
          $new_value26 = "";
      }
      else
      {
          $field26 = "Mobile_Development";
          $old_value26 = $oldvalue[0]['Mobile_Development'];
          $new_value26 = $Mobile;
      }

      if($oldvalue[0]['Ecommerce_Development'] == $ECommerce)
      {
          $field27 = "";
          $old_value27 = "";
          $new_value27 = "";
      }
      else
      {
          $field27 = "Ecommerce_Development";
          $old_value27 = $oldvalue[0]['Ecommerce_Development'];
          $new_value27 = $ECommerce;
      }

      if($oldvalue[0]['Tech_Skills'] == $Technology_Info)
      {
          $field28 = "";
          $old_value28 = "";
          $new_value28 = "";
      }
      else
      {
          $field28 = "Tech_Skills";
          $old_value28 = $oldvalue[0]['Tech_Skills'];
          $new_value28 = $Technology_Info;
      }
      $db_field = $field.','.$field1.','.$field2.','.$field3.','.$field4.','.$field5.','.$field6.','.$field7.','.$field8.','.$field9.','.$field10.','.$field11.','.$field12.','.$field13.','.$field14.','.$field15.','.$field16.','.$field17.','.$field18.','.$field19.','.$field20.','.$field21.','.$field22.','.$field23.','.$field24.','.$field25.','.$field26.','.$field27.','.$field28 ;

      $arr=explode(",",$db_field);
      $filter=array_filter($arr); // see here, i didn't add another array()
      $comma_separated_Field = implode(",", $filter);
      $db_old_Value = $old_value.','.$old_value1.','.$old_value2.','.$old_value3.','.$old_value4.','.$old_value5.','.$old_value6.','.$old_value7.','.$old_value8.','.$old_value9.','.$old_value10.','.$old_value11.','.$old_value12.','.$old_value13.','.$old_value14.','.$old_value15.','.$old_value16.','.$old_value17.','.$old_value18.','.$old_value19.','.$old_value20.','.$old_value21.','.$old_value22.','.$old_value23.','.$old_value24.','.$old_value25.','.$old_value26.','.$old_value27.','.$old_value28 ;

      $arr_old=explode(",",$db_old_Value);

      $filter_old=array_filter($arr_old); // see here, i didn't add another array()
      $comma_separated_Old_Value = implode(",", $filter_old);


      $db_New_Value = $new_value.','.$new_value1.','.$new_value2.','.$new_value3.','.$new_value4.','.$new_value5.','.$new_value6.','.$new_value7.','.$new_value8.','.$new_value9.','.$new_value10.','.$new_value11.','.$new_value12.','.$new_value13.','.$new_value14.','.$new_value15.','.$new_value16.','.$new_value17.','.$new_value18.','.$new_value19.','.$new_value20.','.$new_value21.','.$new_value22.','.$new_value23.','.$new_value24.','.$new_value25.','.$new_value26.','.$new_value27.','.$new_value28 ;

      $arr_new=explode(",",$db_New_Value);

      $filter_new=array_filter($arr_new); // see here, i didn't add another array()
      $comma_separated_New_Value = implode(",", $filter_new);
      $date = date("Y-m-d h:i:sa");

      $data = array('Prospect_Icode' => $P_code,
                    'Prospect_DU_BDE_Icode' => $this->session->userdata['userid'], 
                    'Prospect_DU_Date_Time' => $date,
                    'Prospect_DU_Field' => $comma_separated_Field,
                    'Prospect_DU_OldValue' =>$comma_separated_Old_Value,
                    'Prospect_DU_CurrentValue' =>$comma_separated_New_Value);

      $insert = $this->marketing_model->insert_data_update_log($data);

      if($insert == 1)
      {
          $data = array(
          'Prospect_Status' =>"New",
          'prospectData_Blocked_Type' =>"No",
          'prospectData_Blocked_Date' =>"",
          'prospectData_Blocked_BDE_Code' => "0",
          'Current_BDE_User_Code' =>$this->input->post('bde',TRUE));
          $this->db->where('Prospect_Icode',$P_code);
          $this->db->update('ibt_prospect_data', $data);
          echo '1';
      }
      else
      {

      }
}


/** DATA CORRECTIOn REVIEW **/

public function Data_Correction_Review()
{
      $data['data_country']= $this->marketing_model->Data_Country_Correction();
      $this->load->view('Admin/header');
      $this->load->view('Admin/top');
      $this->load->view('Admin/left');
      $this->load->view('Admin/Data_Correction_Review',$data,false);
}

//** Search Data Correction**/
public function search_Data_Correction()
{

      $country = $this->input->post('country',true);
      $data['data_country_Corrextion']= $this->marketing_model->Country_Based_Data($country);
      $output = null;
      $i = 1;
      foreach ($data['data_country_Corrextion'] as $key) 
      {
          $DUid = $key['Prospect_DU_Icode'];
          $pid = $key['Prospect_Icode'];
          $output .="<tr id='".$i."'>";
          $output .="<td>".$i. "</td>";
          $output .="<td>".$key['Company_Name']. "</td>";
          $output .="<td>".$key['WebURL']. "</td>";
          $output .="<td>".$key['Country']. "</td>";
          $output .="<td><a href='get_all_Data_correction/$DUid/$pid'>VIEW</a>
          </td>";
          $output .="</tr>";
          $i++;
      }
      echo  $output;

}


public function get_all_Data_correction($did,$pid)
{


   $did =  $this->uri->segment(3);
   $pid =  $this->uri->segment(4);

   $data1= $this->marketing_model->Correction_ID_Based_Data($did,$pid);


   $data['name'] = $db_field = $data1[0]['User_Name'];
   $data['pcode'] = $db_field = $data1[0]['Prospect_Icode'];

   //print_r($data['pcode']);
    $data['Dcode'] = $db_field = $data1[0]['Prospect_DU_Icode'];


   $db_field = $data1[0]['Prospect_DU_Field'];
 

   $data['field']=explode(",",$db_field);

   $db_old_Value = $data1[0]['Prospect_DU_OldValue'];

    $data['old']=explode(",",$db_old_Value);

    $db_new_Value = $data1[0]['Prospect_DU_CurrentValue'];

    $data['new']=explode(",",$db_new_Value);

    //$new['data'] = $data[];



  
     $this->load->view('Admin/header');
      $this->load->view('Admin/top');
      $this->load->view('Admin/left');
      $this->load->view('Admin/View_Data_Correction_Review',$data,false);


}


public function Approve_Correction()
{
  $pcode = $this->input->post('pcode',true);
  $dcode = $this->input->post('dcode',true);

  $date = date('Y-m-d H:i:s');
 


 $idd = $this->session->userdata['fname'];


  $status = 'Yes';

 if($idd == 'admin')
 {

  $leader_code = '01';
 }
 else
 {
  $leader_code = $this->session->userdata['userid']; 
 }



  $data = array(
  
  'Prospect_Data_Edit_Approved' =>"Yes",
  'Prospect_Edit_Approved_BY' =>$leader_code,
  'Prospect_Edit_Approved_Date' =>$date

  );


   $this->db->where('Prospect_DU_Icode',$dcode);
    $this->db->update('prospect_dataupdate_log', $data);

}




 public function Edit_Data_Correction()
 {

   $pcode = $this->input->post('pcode',true);
  $dcode = $this->input->post('dcode',true);

      $data['edit'] = $this->marketing_model->Edit_Prospect_Data_correction($pcode);

     // print_r( $data['edit']);
      $one = "1";
      $zero ="0";
       $output = null;  
      

       foreach ($data['edit'] as $row)  
      {  
         //here we build a dropdown item line for each  
        // query result  
         $output .="<div class='row'>";
         $output .="<div class='col-md-4'>";
         $output .= "Branch : <input type='text' class='form-control' id='Branch' name='Branch' value='".$row['Has_Branches']."'> </br>";  

         if($row['Has_Office_In_India'] == $one)
         {
          $output .= "Has Office in India :  <input   id='office' value='".$row['Has_Office_In_India']."' type='radio' name='office' checked='checked' />  Yes
         <input id='office'  type='radio' name='office' value='".$zero."' /> No </br>";

         }
         else
         {
          $output .= "Has Office in India :  <input  id='office'  value='".$one."' type='radio' name='office'  />  Yes
         <input id='office' type='radio' name='office' value='".$row['Has_Office_In_India']."' checked='checked' /> No </br>";
         }


          
         $output .= "Building Type : <input type='text' id='Building_Type' class='form-control' name='Building_Type' value='".$row['Building_Type']."'> </br>"; 
         $output .= "Address : <input type='text' name='Address' id='Address' class='form-control' value='".$row['Address']."'> </br>"; 
         $output .= "City : <input type='text' name='City' id='City' class='form-control' value='".$row['City']."'> </br>"; 
         $output .= "State : <input type='text' name='State'  id='State' class='form-control' value='".$row['State']."'> </br>"; 
         $output .= "Company Email : <input type='text' id='Email' name='Email' class='form-control' value='".$row['Company_Email']."'> </br>"; 
        
         $output .= "FB URL : <input type='text' name='FB' id='FB' class='form-control' value='".$row['FB_URL']."'> </br>"; 
         $output .= "LinkedIn URL : <input type='text' id='LinkedIn' class='form-control' name='LinkedIn' value='".$row['LinkedIn_URL']."'> </br>"; 
          $output .="</div>";
           $output .="<div class='col-md-4'>";
         $output .= "Time Zone : <input type='text' id='Time_Zone' class='form-control' name='Time_Zone' value='".$row['Time_Zone']."'> </br>"; 
          
         $output .= "PC Name : <input type='text' id='PC_Name' class='form-control' name='PC_Name' value='".$row['PC_Name']."'> </br>"; 
         $output .= "Pc Desig : <input type='text' id='Pc_Desig' class='form-control' name='Pc_Desig' value='".$row['PC_Desig']."'> </br>"; 
         $output .= "PC Email : <input type='text'  id='PC_Email' class='form-control' name='PC_Email' value='".$row['PC_Email']."'> </br>"; 
         $output .= "PC Ph.No : <input type='text'  id='Ph_No'  class='form-control' name='Ph_No' value='".$row['PC_Phone']."'> </br>"; 
         
         $output .= "SC Name : <input type='text'  id='SC_Name' class='form-control' name='SC_Name' value='".$row['SC_Name']."'> </br>"; 
         $output .= "Sc Desig : <input type='text'  id='Sc_Desig' class='form-control' name='Sc_Desig' value='".$row['SC_Desig']."'> </br>"; 
         $output .= "SC Email : <input type='text'  id='SC_Email'  class='form-control' name='SC_Email' value='".$row['SC_Email']."'> </br>"; 
         $output .= "SC Ph.No: <input type='text'  id='SC_Ph_No' class='form-control' name='SC_Ph_No' value='".$row['SC_Phone']."'> </br>"; 
          $output .="</div>";
           $output .="<div class='col-md-4'>";

if($row['Career_Section'] == $one)
         {
          $output .= "Career :  <input  id='Career'   type='radio' name='Career'  value=".$one." checked='checked'  />Yes
         <input  type='radio' name='Career'  value=".$zero." /> No </br> "; 

         }
         else
         {
           $output .= "Career :  <input  id='Career'  type='radio' name='Career'  value=".$one."   />Yes
         <input  type='radio' name='Career'  value=".$zero." checked='checked' /> No </br> "; 
         }




         $output .= "Emp Count: <input type='text' id='Emp_Count'  class='form-control' name='Emp_Count' value='".$row['Emp_Count']."'> </br>"; 

         $output .= "Prospect Type : <input type='text' id='Prospect_Type'  class='form-control' name='Prospect_Type' value='".$row['Prospect_Type']."'> </br>";


         if($row['Product_Development'] == $one)
         {
          $output .= "Product :  <input   type='radio'  id='Product'  name='Product'  value=".$one." checked='checked' />Yes
         <input  type='radio' name='Product'  id='Product' value=".$zero." />No </br> "; 
         }
         else
         {
          $output .= "Product :  <input   type='radio' id='Product'  name='Product'  value=".$one."  />Yes
         <input  type='radio' name='Product' id='Product' value=".$zero." checked='checked' />No </br> "; 
         }



         


         $output .= "No.of Products : <input type='text' id='No_Products'  class='form-control' name='No_Products' value='".$row['Products_Count']."'> </br>"; 


         if($row['Domain'] == '')
         {
          $output .= "Domain :  <input   type='radio' id='Domain'  name='Domain' value=".$one." checked='checked' />Yes
           <input  type='radio' name='Domain' id='Domain'   value=".$zero." />No </br> "; 
         }
         else
         {
          $output .= "Domain :  <input   type='radio' id='Domain'  name='Domain'  value=".$one."  />Yes
         <input  type='radio' name='Domain' id='Domain'  value=".$zero." checked='checked' />No </br> "; 
         }

          if($row['Custom_Development'] == $one)
         {
          $output .= "Custom :  <input  id='Custom'   type='radio' name='Custom' value=".$one." checked='checked' />Yes
           <input  type='radio' name='Custom' id='Custom'   value=".$zero." />No </br> "; 
         }
         else
         {
          $output .= "Custom :  <input  id='Custom' type='radio' name='Custom'  value=".$one."  />Yes
         <input  type='radio' name='Custom' id='Custom' value=".$zero." checked='checked' />No </br> "; 
         }



         if($row['Web_Development'] == $one)
         {
          $output .= "Web_Development :  <input  id='Web' type='radio' name='Web' value=".$one." checked='checked' />Yes
           <input  type='radio' name='Web'  id='Web' value=".$zero." />No </br> "; 
         }
         else
         {
          $output .= "Web_Development :  <input id='Web'   type='radio' name='Web'  value=".$one."  />Yes
         <input  type='radio' name='Web' id='Web' value=".$zero." checked='checked' />No </br> "; 
         }

         if($row['Mobile_Development'] == $one)
         {
          $output .= "Mobile :  <input   type='radio' id='Mobile' name='Mobile' value=".$one." checked='checked' />Yes
           <input  type='radio' name='Mobile' id='Mobile'  value=".$zero." />No </br> "; 
         }
         else
         {
          $output .= "Mobile :  <input   type='radio' id='Mobile' name='Mobile'  value=".$one."  />Yes
         <input  type='radio' name='Mobile' id='Mobile' value=".$zero." checked='checked' />No </br> "; 
         }

          if($row['Ecommerce_Development'] == $one)
         {
          $output .= "E-Commerce :  <input   type='radio' id='E-Commerce' name='E-Commerce' value=".$one." checked='checked' />Yes
           <input  type='radio' name='E-Commerce' id='E-Commerce'  value=".$zero." />No </br> "; 
         }
         else
         {
          $output .= "E-Commerce :  <input   type='radio' id='E-Commerce' name='E-Commerce'  value=".$one."  />Yes
         <input  type='radio' name='E-Commerce' id='E-Commerce' value=".$zero." checked='checked' />No </br> "; 
         }

         $output .= "Technology Info : <input type='text' id='Technology_Info' class='form-control' name='Technology_Info' value='".$row['Tech_Skills']."'>";  
          $output .="</div>";
           $output .="</div>";

      } 

      echo $output;

      
   

 }

//** Update Data Correction **/


 public function Update_Data_Correction()
 {
        $dcode = $this->input->post('dcode',true);
        $P_code = $this->input->post('prospect_Icode',TRUE); 
        $oldvalue = $this->marketing_model->get_prospect_data($P_code);
        $Has_Branches = $this->input->post('Branch',TRUE);
        $office = $this->input->post('office',TRUE);
        $Building_Type = $this->input->post('Building_Type',TRUE);
        $Address = $this->input->post('Address',TRUE);
        $City = $this->input->post('City',TRUE);
        $State = $this->input->post('State',TRUE);
        $Email = $this->input->post('Email',TRUE);
        $FB = $this->input->post('FB',TRUE);
        $LinkedIn = $this->input->post('LinkedIn',TRUE);
        $Time_Zone = $this->input->post('Time_Zone',TRUE);
        $PC_Name = $this->input->post('PC_Name',TRUE);
        $Pc_Desig = $this->input->post('Pc_Desig',TRUE);
        $PC_Email = $this->input->post('PC_Email',TRUE);
        $Ph_No = $this->input->post('Ph_No',TRUE);
        $SC_Name = $this->input->post('SC_Name',TRUE);
        $Sc_Desig = $this->input->post('Sc_Desig',TRUE);
        $SC_Email = $this->input->post('SC_Email',TRUE);
        $SC_Ph_No = $this->input->post('SC_Ph_No',TRUE);
        $Career = $this->input->post('Career',TRUE);
        $Emp_Count = $this->input->post('Emp_Count',TRUE);
        $Prospect_Type = $this->input->post('Prospect_Type',TRUE);
        $Product = $this->input->post('Product',TRUE);
        $No_Products = $this->input->post('No_Products',TRUE);
        $Domain = $this->input->post('Domain',TRUE);
        $Custom = $this->input->post('custom',TRUE);
        $Web = $this->input->post('Web',TRUE);
        $Mobile = $this->input->post('Mobile',TRUE);
        $ECommerce = $this->input->post('ECommerce',TRUE);
        $Technology_Info = $this->input->post('Technology_Info',TRUE);

   if($oldvalue[0]['Has_Branches'] == $Has_Branches)
   {
       $field = "";
     $old_value = "";
     $new_value = "";
   }
   else
   {
     $field = "Has_Branches";
     $old_value = $oldvalue[0]['Has_Branches'];
     $new_value = $Has_Branches;
   }


   if($oldvalue[0]['Has_Office_In_India'] == $office)
   {
 $field1 = "";
     $old_value1 = "";
     $new_value1 = "";
   }
   else
   {
     $field1 = "Has_Office_In_India";
     $old_value1 = $oldvalue[0]['Has_Office_In_India'];
     $new_value1 = $office;
   }
    if($oldvalue[0]['Building_Type'] == $Building_Type)
   {
 $field2 = "";
     $old_value2 = "";
     $new_value2 = "";
   }
   else
   {
     $field2 = "Building_Type";
     $old_value2 = $oldvalue[0]['Building_Type'];
     $new_value2 = $Building_Type;
   }

    if($oldvalue[0]['Address'] == $Address)
   {
 $field3 = "";
     $old_value3 = "";
     $new_value3 = "";
   }
   else
   {
     $field3 = "Address";
     $old_value3 = $oldvalue[0]['Address'];
     $new_value3 = $Address;
   }

 if($oldvalue[0]['City'] == $City)
   {
 $field4 = "";
     $old_value4 = "";
     $new_value4 = "";
   }
   else
   {
     $field4 = "City";
     $old_value4 = $oldvalue[0]['City'];
     $new_value4 = $City;
   }

   if($oldvalue[0]['State'] == $State)
   {
 $field5 = "";
     $old_value5 = "";
     $new_value5 = "";
   }
   else
   {
     $field5 = "State";
     $old_value5 = $oldvalue[0]['State'];
     $new_value5 = $State;
   }

   if($oldvalue[0]['Company_Email'] == $Email)
   {
 $field6 = "";
     $old_value6 = "";
     $new_value6 = "";
   }
   else
   {
     $field6 = "Company_Email";
     $old_value6 = $oldvalue[0]['Company_Email'];
     $new_value6 = $Email;
   }
   if($oldvalue[0]['FB_URL'] == $FB)
   {
 $field7 = "";
     $old_value7 = "";
     $new_value7 = "";
   }
   else
   {
     $field7 = "FB_URL";
     $old_value7 = $oldvalue[0]['FB_URL'];
     $new_value7 = $FB;
   }

    if($oldvalue[0]['LinkedIn_URL'] == $LinkedIn)
   {
 $field8 = "";
     $old_value8 = "";
     $new_value8 = "";
   }
   else
   {
     $field8 = "LinkedIn_URL";
     $old_value8 = $oldvalue[0]['LinkedIn_URL'];
     $new_value8 = $LinkedIn;
   }

 if($oldvalue[0]['Time_Zone'] == $Time_Zone)
   {
 $field9 = "";
     $old_value9 = "";
     $new_value9 = "";
   }
   else
   {
     $field9 = "Time_Zone";
     $old_value9 = $oldvalue[0]['Time_Zone'];
     $new_value9 = $Time_Zone;
   }

    if($oldvalue[0]['PC_Name'] == $PC_Name)
   {
 $field10 = "";
     $old_value10 = "";
     $new_value10 = "";
   }
   else
   {
     $field10 = "PC_Name";
     $old_value10 = $oldvalue[0]['PC_Name'];
     $new_value10 = $PC_Name;
   }

     if($oldvalue[0]['PC_Desig'] == $Pc_Desig)
   {
 $field11 = "";
     $old_value11 = "";
     $new_value11 = "";
   }
   else
   {
     $field11 = "PC_Desig";
     $old_value11 = $oldvalue[0]['PC_Desig'];
     $new_value11 = $Pc_Desig;
   }

if($oldvalue[0]['PC_Email'] == $PC_Email)
   {
 $field12 = "";
     $old_value12 = "";
     $new_value12 = "";
   }
   else
   {
     $field12 = "PC_Email";
     $old_value12 = $oldvalue[0]['PC_Email'];
     $new_value12 = $PC_Email;
   }

   if($oldvalue[0]['PC_Phone'] == $Ph_No)
   {
 $field13 = "";
     $old_value13 = "";
     $new_value13 = "";
   }
   else
   {
     $field13 = "PC_Phone";
     $old_value13 = $oldvalue[0]['PC_Phone'];
     $new_value13 = $Ph_No;
   }

   if($oldvalue[0]['SC_Name'] == $SC_Name)
   {
 $field14 = "";
     $old_value14 = "";
     $new_value14 = "";
   }
   else
   {
     $field14 = "SC_Name";
     $old_value14 = $oldvalue[0]['SC_Name'];
     $new_value14 = $SC_Name;
   }

    if($oldvalue[0]['SC_Desig'] == $Sc_Desig)
   {
 $field15 = "";
     $old_value15 = "";
     $new_value15 = "";
   }
   else
   {
     $field15 = "SC_Desig";
     $old_value15 = $oldvalue[0]['SC_Desig'];
     $new_value15 = $Sc_Desig;
   }

   if($oldvalue[0]['SC_Email'] == $SC_Email)
   {
 $field16 = "";
     $old_value16 = "";
     $new_value16 = "";
   }
   else
   {
     $field16 = "SC_Email";
     $old_value16 = $oldvalue[0]['SC_Email'];
     $new_value16 = $SC_Email;
   }


   if($oldvalue[0]['SC_Phone'] == $SC_Ph_No)
   {
 $field17  = "";
     $old_value17  = "";
     $new_value17  = "";
   }
   else
   {
     $field17 = "SC_Phone";
     $old_value17 = $oldvalue[0]['SC_Phone'];
     $new_value17 = $SC_Ph_No;
   }


if($oldvalue[0]['Career_Section'] == $Career)
   {
 $field18 = "";
     $old_value18 = "";
     $new_value18 = "";
   }
   else
   {
     $field18 = "Career_Section";
     $old_value18 = $oldvalue[0]['Career_Section'];
     $new_value18 = $Career;
   }


   if($oldvalue[0]['Emp_Count'] == $Emp_Count)
   {
 $field19 = "";
     $old_value19 = "";
     $new_value19 = "";
   }
   else
   {
     $field19 = "Emp_Count";
     $old_value19 = $oldvalue[0]['Emp_Count'];
     $new_value19 = $Emp_Count;
   }


     if($oldvalue[0]['Prospect_Type'] == $Prospect_Type)
   {
 $field20 = "";
     $old_value20 = "";
     $new_value20 = "";
   }
   else
   {
     $field20 = "Prospect_Type";
     $old_value20 = $oldvalue[0]['Prospect_Type'];
     $new_value20 = $Prospect_Type;
   }

 if($oldvalue[0]['Product_Development'] == $Product)
   {
 $field21 = "";
     $old_value21 = "";
     $new_value21 = "";
   }
   else
   {
     $field21 = "Product_Development";
     $old_value21 = $oldvalue[0]['Product_Development'];
     $new_value21 = $Product;
   }

   if($oldvalue[0]['Products_Count'] == $No_Products)
   {
 $field22 = "";
     $old_value22 = "";
     $new_value22 = "";
   }
   else
   {
     $field22 = "Products_Count";
     $old_value22 = $oldvalue[0]['Products_Count'];
     $new_value22 = $No_Products;
   }

   if($oldvalue[0]['Domain'] == $Domain)
   {
 $field23 = "";
     $old_value23 = "";
     $new_value23 = "";
   }
   else
   {
     $field23 = "Domain";
     $old_value23 = $oldvalue[0]['Domain'];
     $new_value23 = $Domain;
   }

    if($oldvalue[0]['Custom_Development'] == $Custom)
   {
 $field24 = "";
     $old_value24 = "";
     $new_value24 = "";
   }
   else
   {
     $field24 = "Custom_Development";
     $old_value24 = $oldvalue[0]['Custom_Development'];
     $new_value24 = $Custom;
   }

 if($oldvalue[0]['Web_Development'] == $Web)
   {
 $field25 = "";
     $old_value25 = "";
     $new_value25 = "";
   }
   else
   {
     $field25 = "Web_Development";
     $old_value25 = $oldvalue[0]['Web_Development'];
     $new_value25 = $Web;
   }

 if($oldvalue[0]['Mobile_Development'] == $Mobile)
   {
 $field26 = "";
     $old_value26 = "";
     $new_value26 = "";
   }
   else
   {
     $field26 = "Mobile_Development";
     $old_value26 = $oldvalue[0]['Mobile_Development'];
     $new_value26 = $Mobile;
   }

   if($oldvalue[0]['Ecommerce_Development'] == $ECommerce)
   {
 $field27 = "";
     $old_value27 = "";
     $new_value27 = "";
   }
   else
   {
     $field27 = "Ecommerce_Development";
     $old_value27 = $oldvalue[0]['Ecommerce_Development'];
     $new_value27 = $ECommerce;
   }

   if($oldvalue[0]['Tech_Skills'] == $Technology_Info)
   {
 $field28 = "";
     $old_value28 = "";
     $new_value28 = "";
   }
   else
   {
     $field28 = "Tech_Skills";
     $old_value28 = $oldvalue[0]['Tech_Skills'];
     $new_value28 = $Technology_Info;
   }
   $db_field = $field.','.$field1.','.$field2.','.$field3.','.$field4.','.$field5.','.$field6.','.$field7.','.$field8.','.$field9.','.$field10.','.$field11.','.$field12.','.$field13.','.$field14.','.$field15.','.$field16.','.$field17.','.$field18.','.$field19.','.$field20.','.$field21.','.$field22.','.$field23.','.$field24.','.$field25.','.$field26.','.$field27.','.$field28 ;

  $arr=explode(",",$db_field);

  $filter=array_filter($arr); // see here, i didn't add another array()
  $comma_separated_Field = implode(",", $filter);



  $db_old_Value = $old_value.','.$old_value1.','.$old_value2.','.$old_value3.','.$old_value4.','.$old_value5.','.$old_value6.','.$old_value7.','.$old_value8.','.$old_value9.','.$old_value10.','.$old_value11.','.$old_value12.','.$old_value13.','.$old_value14.','.$old_value15.','.$old_value16.','.$old_value17.','.$old_value18.','.$old_value19.','.$old_value20.','.$old_value21.','.$old_value22.','.$old_value23.','.$old_value24.','.$old_value25.','.$old_value26.','.$old_value27.','.$old_value28 ;

  $arr_old=explode(",",$db_old_Value);

  $filter_old=array_filter($arr_old); // see here, i didn't add another array()
  $comma_separated_Old_Value = implode(",", $filter_old);


  $db_New_Value = $new_value.','.$new_value1.','.$new_value2.','.$new_value3.','.$new_value4.','.$new_value5.','.$new_value6.','.$new_value7.','.$new_value8.','.$new_value9.','.$new_value10.','.$new_value11.','.$new_value12.','.$new_value13.','.$new_value14.','.$new_value15.','.$new_value16.','.$new_value17.','.$new_value18.','.$new_value19.','.$new_value20.','.$new_value21.','.$new_value22.','.$new_value23.','.$new_value24.','.$new_value25.','.$new_value26.','.$new_value27.','.$new_value28 ;

  $arr_new=explode(",",$db_New_Value);

  $filter_new=array_filter($arr_new); // see here, i didn't add another array()
  $comma_separated_New_Value = implode(",", $filter_new);
  $date = date("Y-m-d h:i:sa");
  $idd = $this->session->userdata['fname'];
  $status = 'Yes';

 if($idd == 'admin')
 {

  $leader_code = '01';
 }
 else
 {
  $leader_code = $this->session->userdata['userid']; 
 }

  $data = array('Prospect_Icode' => $P_code,
                'Prospect_DU_BDE_Icode' => $this->session->userdata['userid'], 
                'Prospect_DU_Date_Time' => $date,
                'Prospect_DU_Field' => $comma_separated_Field,
                'Prospect_DU_OldValue' =>$comma_separated_Old_Value,
                'Prospect_DU_CurrentValue' =>$comma_separated_New_Value,
                'Prospect_Data_Edit_Approved' =>"Yes",
                'Prospect_Edit_Approved_BY' =>$leader_code,
                'Prospect_Edit_Approved_Date' =>$date);

  $insert = $this->marketing_model->update_data_update_log($data,$dcode);

  if($insert == 1)
  {
  $upda_data = array('Has_Branches' =>$this->input->post('Branch',TRUE) , 
                     'Has_Office_In_India' => $this->input->post('office',TRUE),
                     'Building_Type' => $this->input->post('Building_Type',TRUE) ,
                     'Address' => $this->input->post('Address',TRUE),
                     'City' => $this->input->post('City',TRUE),
                     'State' => $this->input->post('State',TRUE),
                     'Company_Email' => $this->input->post('Email',TRUE),
                     'FB_URL' => $this->input->post('FB',TRUE),
                     'LinkedIn_URL' =>$this->input->post('LinkedIn',TRUE) ,
                     'Time_Zone' => $this->input->post('Time_Zone',TRUE),
                     'PC_Name' => $this->input->post('PC_Name',TRUE),
                     'PC_Desig' => $this->input->post('Pc_Desig',TRUE),
                     'PC_Email' => $this->input->post('PC_Email',TRUE),
                     'PC_Phone' =>$this->input->post('Ph_No',TRUE),
                     'SC_Name' => $this->input->post('SC_Name',TRUE),
                     'SC_Desig' => $this->input->post('Sc_Desig',TRUE),
                     'SC_Email' => $this->input->post('SC_Email',TRUE),
                     'SC_Phone' => $this->input->post('SC_Ph_No',TRUE),
                     'Career_Section' => $this->input->post('Career',TRUE) ,
                     'Emp_Count' => $this->input->post('Emp_Count',TRUE) ,
                     'Prospect_Type' => $this->input->post('Prospect_Type',TRUE),
                     'Product_Development' => $this->input->post('Product',TRUE) ,
                     'Products_Count' => $this->input->post('No_Products',TRUE),
                     'Domain' => $this->input->post('Domain',TRUE),
                     'Custom_Development' => $this->input->post('Custom',TRUE),
                     'Web_Development' =>$this->input->post('Web',TRUE) ,
                     'Mobile_Development' => $this->input->post('Mobile',TRUE),
                     'Ecommerce_Development' => $this->input->post('ECommerce',TRUE) ,
                     'Tech_Skills' =>$this->input->post('Technology_Info',TRUE) );


        $this->db->where('Prospect_Icode',$P_code);
       $this->db->update('ibt_prospect_data', $upda_data);
       echo 1;
}
else
{

}
}

 //** Allocate BDE to Leader **/

 public function BDE_Allocate()
 {

       $data['BDE']= $this->marketing_model->get_BDE();
       $data['Leader']= $this->marketing_model->Get_Leader();

      $this->load->view('Admin/header');
      $this->load->view('Admin/top');
      $this->load->view('Admin/left');
      $this->load->view('Admin/BDE_Allocate',$data,false);

 }
 
}
