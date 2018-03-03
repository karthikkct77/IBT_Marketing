<?php
defined('BASEPATH') OR exit('No direct script access allowed');
             
class User extends CI_Controller {
     
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
       if($this->session->fname == "")
        {
            redirect('Welcome');
        }
     // $this->output->enable_profiler(TRUE);
      $this->load->helper('url');   /***** LOADING HELPER TO AVOID PHP ERROR ****/
      $this->load->model('User_Marketing_model','User_marketing_model'); /* LOADING MODEL * Welcome_model as welcome */
      $this->load->model('Marketing_model','marketing_model');
      $this->load->library('session');
      $this->load->library('excel');

}

 //** CHANGE Password**/
public function change_password()
{
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('change_password');
}


/** Save Password */
public function save_password()
{
      $current_pwd = $this->input->post('currentPassword');
      $id = $this->session->userdata['userid']; 
      $data =  array('User_Password'=> $this->input->post('newPassword') );
      $insert = $this->User_marketing_model->insert_user_password($data);
      foreach ($insert as $key => $val) 
      {
      $check = $val['User_Password'];
      }

     if($current_pwd == $check) 
     {

              $this->db->where('User_Icode',$id);
              $this->db->update('ibt_marketing_user', $data);
              $this->session->set_flashdata('message', 'Update Password Successfully..');
              redirect('User/dashboard');

     }
    else
     {
              $this->session->set_flashdata('message', 'Current Password is not correct');
              redirect('User/change_password');

     }
}

    /** DASHBOADR **/
public function dashboard()
{
      $User_Icode =  $this->session->userdata['userid']; 
      $this->data['Total_count']= $this->User_marketing_model->Total_count($User_Icode);
      $this->data['Cold_count']= $this->User_marketing_model->Cold_count($User_Icode);
      $this->data['Warm_count']= $this->User_marketing_model->Warm_count($User_Icode);
      $this->data['Hot_count']= $this->User_marketing_model->Hot_count($User_Icode);
      $this->data['DND_count']= $this->User_marketing_model->DND_count($User_Icode);
      $this->data['today_followup']= $this->User_marketing_model->Today_Followup_call_count($User_Icode);
      $this->data['today_followup_cold']= $this->User_marketing_model->Today_Followup_Cold_call_count($User_Icode);
     
      $this->data['new_call_count']= $this->User_marketing_model->get_new_call_count($User_Icode);
      $this->data['Todays_Meeting_Hot']= $this->User_marketing_model->Get_Todays_Meeting_Hot_count($User_Icode);
      $this->data['Todays_Meeting_Warm']= $this->User_marketing_model->Get_Todays_Meeting_Warm_count($User_Icode);
     

       $this->data['Missed_call_Cold']= $this->User_marketing_model->Missed_call_Cold($User_Icode);
       $this->data['Missed_call_Warm']= $this->User_marketing_model->Missed_call_Warm($User_Icode);
       $this->data['Missed_call_Hot']= $this->User_marketing_model->Missed_call_Hot($User_Icode);


      $this->data['team_today_call_cold'] = $this->User_marketing_model->Get_Todays_Team_call_Cold_count($User_Icode);
      $this->data['team_today_call_Warm'] = $this->User_marketing_model->Get_Todays_Team_call_Warm_count($User_Icode);

      $this->data['Todays_Team_Meeting_Hot']= $this->User_marketing_model->Get_Todays_Team_Meeting_Hot_count($User_Icode);
      $this->data['Todays_Team_Meeting_Warm']= $this->User_marketing_model->Get_Todays_Team_Meeting_Warm_count($User_Icode);

       $this->data['Team_Missed_call_Cold']= $this->User_marketing_model->Team_Missed_call_Cold($User_Icode);
       $this->data['Team_Missed_call_Warm']= $this->User_marketing_model->Team_Missed_call_Warm($User_Icode);
       $this->data['Team_Missed_call_Hot']= $this->User_marketing_model->Team_Missed_call_Hot($User_Icode);
     

      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('dashboard', $this->data, FALSE);

}


//** TODAY COLD CALL FOLLOWUP**/

public function Todays_Cold_Call()
{
      $User_Icode =  $this->session->userdata['userid']; 
      $data_user['clientdate_details']= $this->User_marketing_model->get_clientdate_details($User_Icode);
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Today_followup_cold',$data_user, FALSE);
}

//** Start:  DASHBOARD CHART **/

public function total_chart()  /***** Total Chart ****/
{
      $User_Icode =  $this->session->userdata['userid']; 
      $data_count= $this->User_marketing_model->total_BDE_data($User_Icode);
      print_r(json_encode($data_count, true));

}


public function total_Cold_chart()    /***** Total Cold Chart ****/
{
      $User_Icode =  $this->session->userdata['userid']; 
      $data_count= $this->User_marketing_model->total_Cold_chart($User_Icode);
      print_r(json_encode($data_count, true));


}

public function total_Warm_chart()   /***** Total Warm Chart ****/
{
      $User_Icode =  $this->session->userdata['userid']; 
      $data_count= $this->User_marketing_model->total_Warm_chart($User_Icode);
      print_r(json_encode($data_count, true));
}

public function total_Hot_chart()  /***** Total Hot Chart ****/
{
      $User_Icode =  $this->session->userdata['userid']; 
      $data_count= $this->User_marketing_model->total_Hot_chart($User_Icode);
      print_r(json_encode($data_count, true));


}

public function total_HitRate_chart()  /***** Total HitRate Chart ****/
{
      $User_Icode =  $this->session->userdata['userid']; 
      $data_count= $this->User_marketing_model->total_HitRate_chart($User_Icode);
      print_r(json_encode($data_count, true));

}

 //** End:  DASHBOARD CHART **/


 //** TODAY TEAm FOLLOWUP**/

public function Today_Team_Followup()
{

      $User_Icode =  $this->session->userdata['userid']; 
      $data_user['team_followup']= $this->User_marketing_model->Get_Todays_Team_call_details($User_Icode);

      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Today_Team_followup',$data_user, FALSE);

}

/** VIew User Data **/

public function cold_calling()
{
      $User_Icode =  $this->session->userdata['userid']; 
      $data_user['user_data']= $this->User_marketing_model->get_User_country_data($User_Icode);
      $data_user['new_call_count']= $this->User_marketing_model->get_new_call_count($User_Icode);
      $data_user['called_count']= $this->User_marketing_model->get_called_count($User_Icode);
      $data_user['total_count']= $this->User_marketing_model->get_total_count($User_Icode);

      $data_user['ourdate_count']= $this->User_marketing_model->get_ourdate_count($User_Icode);
      $data_user['ourdate_details']= $this->User_marketing_model->get_ourdate_details($User_Icode);
      $data_user['clientdate_count']= $this->User_marketing_model->get_clientdate_count($User_Icode);
      $data_user['clientdate_details']= $this->User_marketing_model->get_clientdate_details($User_Icode);

      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Cold_Calling',$data_user, FALSE);

}

public function View_Data()
{
      $User_Icode =  $this->session->userdata['userid']; 
      $data_user['user_data']= $this->User_marketing_model->get_User_country_data($User_Icode);
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('view_user_data',$data_user, FALSE);
}

 /** Prospect Call Data **/      

public function Prospect_Data_Call()
{
      $a = '1';
      $User_Icode =  $this->session->userdata['userid']; 
      $data_search = array( 'country'      => $this->input->post('Company_country'),
                            'state'        => $this->input->post('state'),
                            'City'         => $this->input->post('City'),
                            'Category'     => $this->input->post('Ptype'),
                            'Ctype'        => $this->input->post('company_type'),
                            'skill'        => $this->input->post('skill')
                           );

      $_SESSION['search_data'] = $data_search;
      $prospect_data= $this->User_marketing_model->company_details($data_search,$User_Icode);
      $prospect_data['Total_data']= $this->User_marketing_model->company_details_total($data_search,$User_Icode);
      $_SESSION['Tota'] = $prospect_data['Total_data']; //** Total data Stored Session **/

       //print_r($prospect_data);



      if(empty($prospect_data))
      {
     
              $prospect_data['increment'] = 0;
              $this->load->view('header');
              $this->load->view('top');
              $this->load->view('left');
              $this->load->view('view_Call_Data',$prospect_data, FALSE);

      }
      else
      {
              // foreach ($prospect_data['company_details'] as $key )
              //  {
                   $Icode = $prospect_data[0]['Prospect_Icode'];
               // }  
                   //print_r($Icode);

              $prospect_data['increment'] = 0;
              $prospect_data['company_details'] = $this->User_marketing_model->Get_Company_Details($Icode); 
              $prospect_data['history']  = $this->User_marketing_model->Company_History($Icode); 

              $this->load->view('header');
              $this->load->view('top');
              $this->load->view('left');
              $this->load->view('view_Call_Data',$prospect_data, FALSE);

      }

}

//** Prospect Call Next **//

public function Prospect_Data_Call_Next()
{
      $next_value = $this->input->post('nextval',TRUE);
      $next = $next_value + 1;
      $User_Icode =  $this->session->userdata['userid']; 
      $data_search= $this->session->userdata['search_data']; 
      $prospect_data= $this->User_marketing_model->company_details_next($data_search,$User_Icode,$next);
       $Icode = $prospect_data[0]['Prospect_Icode'];
       $prospect_data['company_details'] = $this->User_marketing_model->Get_Company_Details($Icode); 
      $prospect_data['Total_data'] = $this->session->userdata['Tota']; 
      $prospect_data['increment'] = $next;

      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('view_Call_Data',$prospect_data, FALSE);
}

 /** Cold Call Client Date **/

public function Prospect_Data_Call_Client_date($id)
{
      // $next_value = $this->input->post('id',TRUE);
      $User_Icode =  $this->session->userdata['userid']; 
      $prospect_data['company_details']= $this->User_marketing_model->company_details_client_date($id);
      $prospect_data['history']  = $this->User_marketing_model->Company_History($id); 
      $prospect_data['increment'] = 0;
      $prospect_data['Total_data'] = 1;


      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('view_Call_Data',$prospect_data, FALSE);
}

// public function Prospect_Data_Call_Next_skip()
    // {
    //      $next_value = $this->input->post('nextval',TRUE);
    //      $next = $next_value + 1;


  
    //        $User_Icode =  $this->session->userdata['userid']; 
    //        $data_search= $this->session->userdata['search_data']; 
    //    $prospect_data['company_details']= $this->User_marketing_model->company_details_next($data_search,$User_Icode,$next);
    //   $prospect_data['Total_data'] = $this->session->userdata['Tota']; 
    //    $prospect_data['increment'] = $next;
     
    //    echo 1;
   
    // }

//** Get Country wise State **/

public function get_country_state()
{
      $User_Icode =  $this->session->userdata['userid']; 
      $country_code = $this->input->post('id',TRUE);  
      $data['state'] = $this->User_marketing_model->get_country_state($country_code,$User_Icode);
      $name = 'Select Sate';
      $output = null;  
      $output = "<option value=''>".$name."</option>";  

            foreach ( $data['state'] as $row)  
            {  
                  $output .= "<option value='".$row->State."'>".$row->State."</option>";  
            }  

      echo $output;  
}

//** Get Country Wise Category**/

public function get_country_category()
{
      $User_Icode =  $this->session->userdata['userid']; 
      $country_code = $this->input->post('id',TRUE);  
      $data['state'] = $this->User_marketing_model->get_country_category($country_code,$User_Icode);
      $name = 'Select Category';
      $output = null;  
      $output = "<option value=''>".$name."</option>";  

      foreach ( $data['state'] as $row)  
      {  
         // $output .= "<option value='".$row->Marketing_Prospect_Type."'>".$row->Marketing_Prospect_Type."(".$row->count.")</option>";  
         $output .= "<option value='".$row->Marketing_Prospect_Type."'>".$row->Marketing_Prospect_Type."</option>";  
      }  

      echo $output;  
}

/** Stete based City */
public function get_state_city()
{
      $User_Icode =  $this->session->userdata['userid']; 
      $state_code = $this->input->post('id',TRUE);  
      $data['city'] = $this->User_marketing_model->get_state_city($state_code,$User_Icode);
      $name = 'Select City';
      $output = null;  
      $output = "<option value=''>".$name."</option>"; 
      foreach ( $data['city'] as $row)  
      { 
            $output .= "<option value='".$row->City."'>".$row->City."</option>";  
      }  
      echo $output;  
}


 /** PROSPECT CALL STATUS **/

 public function Prospect_Data_Call_status()
 {

      $date = date("Y-m-d H:i:s");

      $data = array(    'Prospect_Icode' => $this->input->post('prospect_Icode'), 
                        'Prospect_Status' => $this->input->post('Prospect_Status'),
                        'Scheduled_Date' => $this->input->post('Scheduled_date'),
                        'Prospect_Call_Result' => $this->input->post('Result'),
                        'Prospect_Call_Comments' => $this->input->post('Comment'),
                        'Prospect_BDE_Icode' => $this->session->userdata['userid'] 
                   );

      $insert = $this->User_marketing_model->Add_Prospect_call_status($data);

      if($insert == 1)
      {
            $id = $this->input->post('prospect_Icode');
            $update_data = array(     'Prospect_Status' => $this->input->post('Prospect_Status'),
                                      'Last_Called_Date' => $date,
                                      'Next_Call_Date_Client' =>$this->input->post('Check'),
                                      'Next_Call_Date' => $this->input->post('client_date'),
                                      'Equiv_our_date' =>$this->input->post('equal_our_date') 
                                );

            $this->db->where('Prospect_Icode',$id);
            $this->db->update('ibt_prospect_data',$update_data);
            $this->session->set_flashdata('message', 'Successfully Saved, Click Next Button..');
            $next_value = $this->input->post('nextval1');
            $next = $next_value + 1;
            $User_Icode =  $this->session->userdata['userid']; 
            $data_search= $this->session->userdata['search_data']; 
            $prospect_data= $this->User_marketing_model->company_details_next($data_search,$User_Icode,$next);
            $Icode = $prospect_data[0]['Prospect_Icode'];
            $prospect_data['company_details'] = $this->User_marketing_model->Get_Company_Details($Icode); 
            $prospect_data['Total_data'] = $this->session->userdata['Tota']; 
            $prospect_data['increment'] = $next;
            $this->load->view('header');
            $this->load->view('top');
            $this->load->view('left');
            $this->load->view('view_Call_Data',$prospect_data, FALSE);
    }

    else
    {


    }
    
}

//**Prospect Call status Client Give Date **/

public function Prospect_Data_Call_status_client_date()
{

      $date = date("Y-m-d H:i:s");
      $check = $this->input->post('Check');

      $set_value = "Null";

      if($check == 'No')
      {
          $qual_date = $set_value;
          $next_date = "";
      }
      else
      {
          $next_date = $this->input->post('client_date',true);
          $qual_date = $this->input->post('equal_our_date',true);

      }

      $data = array('Prospect_Icode' => $this->input->post('prospect_Icode',true), 
                    'Prospect_Status' => $this->input->post('Prospect_Status',true),
                    'Scheduled_Date' => $this->input->post('Scheduled_date',true),
                    'Prospect_Call_Result' => $this->input->post('Result',true),
                    'Prospect_Call_Comments' => $this->input->post('Comment',true),
                    'Prospect_BDE_Icode' => $this->session->userdata['userid'] );

      $insert = $this->User_marketing_model->Add_Prospect_call_status($data);
      if($insert == 1)
      {
          $id = $this->input->post('prospect_Icode');
          $update_data = array('Prospect_Status' => $this->input->post('Prospect_Status',true),
                               'Last_Called_Date' => $date,
                               'Next_Call_Date_Client' =>$this->input->post('Check'),
                               'Next_Call_Date' => $next_date,
                               'Equiv_our_date' =>$qual_date);
          $this->db->where('Prospect_Icode',$id);
          $this->db->update('ibt_prospect_data',$update_data);
          echo 1;
     }
      else
      {


      }

}

/** DND & CNE **/
public function Prospect_Data_DND_CNE()
{
      $date = date('d/m/Y');
      $icode = $this->input->post('prospect_Icode',TRUE);

      $data = array('prospectData_Blocked_Type' => $this->input->post('Btype',TRUE),
                    'prospectData_Blocked_Date' => $date,
                    'prospectData_Blocked_BDE_Code' => $this->session->userdata['userid']);

      $this->db->where('Prospect_Icode',$icode);
      $this->db->update('ibt_prospect_data',$data);
      echo 1;
}


/** Update Prospect Data **/


 public function Update_prospect_data()
 {
        $P_code = $this->input->post('id',TRUE); 
        $data['edit'] = $this->User_marketing_model->Edit_Prospect_Data($P_code);
        $one = "1";
        $zero ="0";
        $output = null;  
      

       foreach ($data['edit'] as $row)  
      {  
         
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

/** Edit Prospect Data Updation **/

 public function Edit_data_updation()
 {
        $date = date("Y-m-d h:i:sa");
        $id = $this->input->post('prospect_Icode');
        $oldvalue = $this->User_marketing_model->get_prospect_data($id);
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


    $data = array('Prospect_Icode' => $id,
                  'Prospect_DU_BDE_Icode' => $this->session->userdata['userid'], 
                  'Prospect_DU_Date_Time' => $date,
                  'Prospect_DU_Field' => $comma_separated_Field,
                  'Prospect_DU_OldValue' =>$comma_separated_Old_Value,
                  'Prospect_DU_CurrentValue' =>$comma_separated_New_Value);

    $insert = $this->User_marketing_model->insert_data_update_log($data);

    if($insert == 1)
    {
          $id = $this->input->post('prospect_Icode');
          $upda_data = array( 'Has_Branches' =>$this->input->post('Branch',TRUE) , 
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

   
          $this->db->where('Prospect_Icode',$id);
          $this->db->update('ibt_prospect_data', $upda_data);
          echo 1;
    }
    else
    {

    }
}


/*** FOLLOWUP CALL **/

public function View_FollowUp_Data()
{
      $User_Icode =  $this->session->userdata['userid']; 

      $followup_data['user_data']= $this->User_marketing_model->get_User_country_data_hot($User_Icode);
      $followup_data['user_data_warm']= $this->User_marketing_model->get_User_country_data_Warm($User_Icode);
      $followup_data['followup_warm']= $this->User_marketing_model->Today_Followup_call_warm($User_Icode);
      $followup_data['followup_hot']= $this->User_marketing_model->Today_Followup_call_hot($User_Icode);
      $followup_data['followup_other']= $this->User_marketing_model->followup_call($User_Icode);
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('followup_call_data',$followup_data, FALSE);

}

/** Today Followup call **/
public function Today_FollowUp_Data()
{
      $User_Icode =  $this->session->userdata['userid']; 

      $followup_data['user_data']= $this->User_marketing_model->get_User_country_data_hot($User_Icode);
      $followup_data['user_data_warm']= $this->User_marketing_model->get_User_country_data_Warm($User_Icode);
      $followup_data['followup_warm']= $this->User_marketing_model->Today_Followup_call_warm($User_Icode);
      $followup_data['followup_hot']= $this->User_marketing_model->Today_Followup_call_hot($User_Icode);
      $followup_data['followup_other']= $this->User_marketing_model->followup_call($User_Icode);
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('today_followup_call_data',$followup_data, FALSE);

}


/** PROSPECT ANALYSIS DATA **/

public function Prospect_Analysis_Data()
{

      $User_Icode =  $this->session->userdata['userid']; 
      $prospect['Analysis'] = $this->User_marketing_model->Prospect_Analysis_Data($User_Icode);
     // $prospect['Update_Analysis'] = $this->User_marketing_model->Prospect_Update_Analysis_Data($User_Icode);
      $prospect['Industry'] = $this->User_marketing_model->Get_Industry_Details();
      $prospect['Domain'] = $this->User_marketing_model->Get_Domain_Details();
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Prospect_Analysis',$prospect, FALSE);

}
public function View_Prospect_Analysis_Data()
{
      $User_Icode =  $this->session->userdata['userid']; 
      $prospect['Update_Analysis'] = $this->User_marketing_model->Prospect_Update_Analysis_Data($User_Icode);
      $prospect['Industry'] = $this->User_marketing_model->Get_Industry_Details();
      $prospect['Domain'] = $this->User_marketing_model->Get_Domain_Details();
        $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('View_Prospect_Analysis',$prospect, FALSE);
}

/** INSERT PROSPECT ANALYSIS **/
public function Insert_Prospect_Analysis()
{
      $date = date('Y-m-d');
      $User_Icode =  $this->session->userdata['userid']; 
      $P_code = $this->input->post('id',TRUE);
      $domain = $this->input->post('Domain',TRUE);

      if($domain == "")
      {
          $domainval = array('prospect_prospect_icode' => $P_code,
                             'User_Icode' => $User_Icode);
          $insert = $this->User_marketing_model->insert_Domain_Data($domainval);
      }
      else
      {
          foreach ($domain as $key )
           {
              $domainval = array( 'prospect_prospect_icode' => $P_code,
                                  'prospect_Domain_Icode' =>$key,
                                  'User_Icode' => $User_Icode);
              $insert = $this->User_marketing_model->insert_Domain_Data($domainval);
           }
      }

      $value = $this->input->post('industry',TRUE);

      if($value == "")
      {
          $domainval = array('prospect_prospect_icode' => $P_code,
                             'User_Icode' => $User_Icode);
          $insert = $this->User_marketing_model->insert_Industry_Data($domainval);
      }
      else
      {
          foreach ($value as $key )
          {
              $domainval = array( 'prospect_prospect_icode' => $P_code,
                                  'prospect_Industry_Icode' =>$key ,
                                  'User_Icode' => $User_Icode);
              $insert = $this->User_marketing_model->insert_Industry_Data($domainval);
          }
      }

      $data = array('Marketing_Prospect_Type' =>  $this->input->post('ptype',TRUE),
                    'Marketing_Services' =>  $this->input->post('pservice',TRUE),
                    'Marketing_Approch' =>  $this->input->post('papproch',TRUE),
                    'prospect_Category' =>  $this->input->post('category',TRUE),
                    'Prospect_Analysis_BDE_Code' =>$User_Icode,
                    'Prospect_Analysis_BDE_Date' =>$date,
                    );
      $this->db->where('Prospect_Icode',$P_code);
      $this->db->update('ibt_prospect_data', $data);
      echo 1;

} 

//*Update Prospect Analysis**/
public function Update_Prospect_Analysis()
{
      $date = date('Y-m-d');
      $User_Icode =  $this->session->userdata['userid']; 
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
                  $insert = $this->User_marketing_model->insert_Industry_Data($domainval);
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
                $insert = $this->User_marketing_model->insert_Domain_Data($domainval);
        }
    }
 
    $data = array('Marketing_Prospect_Type' =>  $this->input->post('type',TRUE),
                  'Marketing_Services' =>  $this->input->post('services',TRUE),
                  'Marketing_Approch' =>  $this->input->post('approch',TRUE),
                  'prospect_Category' =>  $this->input->post('category',TRUE),
                  'Prospect_Analysis_BDE_Code' =>$User_Icode,
                  'Prospect_Analysis_BDE_Date' =>$date);
    $this->db->where('Prospect_Icode',$P_code);
    $this->db->update('ibt_prospect_data', $data);
    echo 'success';

}

//Prospect Data Infomation**/

public function get_prospect_data_Info()
{
      $P_code = $this->input->post('id',TRUE);
      $data['info'] = $this->User_marketing_model->Edit_Prospect_Data($P_code);
      $one = "yes";
      $zero = "No";
      $output = null;  
      foreach ($data['info'] as $row)  
      {  
        $output .  "<tr>";

        if($row['Product_Development'] == '1')
        {
            $output .= "<td>".$one."</td>";  
        }
        else
        {
            $output .= "<td>".$zero."</td>";  
        }

        $output .= "<td>".$row['Products_Count']."</td>";  


        if($row['Domain'] == '')
        {
            $output .= "<td>".$zero."</td>";  
        }
        else
        {
            $output .= "<td>".$one."</td>";  
        }
        if($row['Custom_Development'] == '0')
        {
            $output .= "<td>".$zero."</td>";  
        }
        else
        {
           $output .= "<td>".$one."</td>";  
        }
        if($row['Web_Development'] == '0')
        {
           $output .= "<td>".$zero."</td>";  
        }
        else
        {
           $output .= "<td>".$one."</td>";  
        }
        if($row['Mobile_Development'] == '0')
        {
           $output .= "<td>".$zero."</td>";  
        }
        else
        {
           $output .= "<td>".$one."</td>";  
        }
        if($row['Ecommerce_Development'] == '0')
        {
           $output .= "<td>".$zero."</td>";  
        }
        else
        {
           $output .= "<td>".$one."</td>";  
        }
           $output .  "</tr>";
      }  
      echo $output;  

}

public function Prospect_Data_Import()
{
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('prospect_data_Import');
}

/** FOLLOW UP CALL **/

public function Prospect_followup_Call()
{
      $icode =  $this->input->post('prospect_Icode');
      $User_Icode =  $this->session->userdata['userid']; 
      $prospect_data['company_details']= $this->User_marketing_model->company_details_followup($icode,$User_Icode);
      $prospect_data['history']  = $this->User_marketing_model->Company_History($icode); 
      $prospect_data['Mtype']  = $this->User_marketing_model->Meeting_type(); 
      $prospect_data['Meeting_history']  = $this->User_marketing_model->Meeting_History($icode); 

      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('view_Followup_Call',$prospect_data, FALSE);

}

//** GET DATA TEAM ASSESSMENT**/
 public function get_datateam()
 {
        $icode = $this->input->post('prospect_Icode',TRUE);
        $User_Icode =  $this->session->userdata['userid']; 
        $prospect_data['company_details']= $this->User_marketing_model->company_details_followup($icode,$User_Icode);
        $output = null;  
        $one = 'Yes';
        $zero = 'No';
       foreach ($prospect_data['company_details'] as $key)  
       {  

       $output .  "<tr>";
     
      if($key['Product_Development'] == '1')
      {
         $output .= "<td>".$one."</td>"; 
      }
      else
      {
         $output .= "<td>".$zero."</td>"; 
      }
      $output .= "<td>".$key['Products_Count']."</td>"; 
      if($key['Domain'] == '1')
      {
         $output .= "<td>".$one."</td>"; 
      }
      else
      {
         $output .= "<td>".$zero."</td>"; 
      }
      if($key['Custom_Development'] == '1')
      {
         $output .= "<td>".$one."</td>"; 
      }
      else
      {
         $output .= "<td>".$zero."</td>"; 
      }
      if($key['Web_Development'] == '1')
      {
        $output .= "<td>".$one."</td>"; 
      }
      else
      {
         $output .= "<td>".$zero."</td>"; 
      }
      if($key['Mobile_Development'] == '1')
      {
        $output .= "<td>".$one."</td>"; 
      }
      else
      {
        $output .= "<td>".$zero."</td>"; 
      }
      if($key['Ecommerce_Development'] == '1')
      {
        $output .= "<td>".$one."</td>"; 
      }
      else
      {
        $output .= "<td>".$zero."</td>"; 
      }
      $output .  "</tr>";
      }  
      echo $output;  
}

/** GET MARKETING TEAM ASSESSMENT**/
public function get_marketingteam()
{

      $icode = $this->input->post('prospect_Icode',TRUE);
      $User_Icode =  $this->session->userdata['userid']; 
      $prospect_data['company_details']= $this->User_marketing_model->company_details_followup($icode,$User_Icode);
      $output = null;  

      foreach ($prospect_data['company_details'] as $key)  
      {  

          $output .  "<tr>";
          $output .= "<td>".$key['Marketing_Services']."</td>"; 
          $output .= "<td>".$key['Marketing_Approch']."</td>"; 
          $output .= "<td>".$key['Industry_Name']."</td>"; 
          $output .= "<td>".$key['domain']."</td>"; 
          $output .  "</tr>";

      }
      echo $output;  

}

/*** MISSED CALL **/
public function Missed_call()
{
      $User_Icode =  $this->session->userdata['userid']; 
      $data['Missed_call_Cold']= $this->User_marketing_model->Missed_call_Cold_details($User_Icode);
      $data['Missed_call_Warm']= $this->User_marketing_model->Missed_call_Warm_details($User_Icode);
      $data['Missed_call_Hot']= $this->User_marketing_model->Missed_call_Hot_details($User_Icode);
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Missed_call_data',$data, FALSE);
}


/*** MISSED CALL  TEAM **/
public function Missed_call_Team()
{
      $User_Icode =  $this->session->userdata['userid']; 
      $data['Team_Missed_call_Cold']= $this->User_marketing_model->Team_Missed_call_Cold_details($User_Icode);
      $data['Team_Missed_call_Warm']= $this->User_marketing_model->Team_Missed_call_Warm_details($User_Icode);
      $data['Team_Missed_call_Hot']= $this->User_marketing_model->Team_Missed_call_Hot_details($User_Icode);
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Team_Missed_call_data',$data, FALSE);
}


/** MEETING CALL STATUS **/

public function Meeting_Call_status()
{

      $date = date("Y-m-d H:i:s");
      $check = $this->input->post('Check');
      if($check == 'No')
      {
          $qual_date = $this->input->post('our_date');
          $next_date = '0';
      }
      else
      {
          $next_date = $this->input->post('client_date');
          $qual_date = $this->input->post('equal_our_date');
      }

      $data = array('Prospect_Icode' => $this->input->post('prospect_Icode'), 
                    'Meeting_Type_Icode' => $this->input->post('mtype'),
                    'Meeting_Date' =>$next_date,
                    'Equiv_our_date' =>$qual_date );
      $insert = $this->User_marketing_model->Add_Meeting_call_status($data);
      if($insert == 1)
      {
          $id = $this->input->post('prospect_Icode');
          $update_data = array( 'Prospect_Status' => $this->input->post('Prospect_Status'),
                                'Last_Called_Date' => $date,
                                'Next_Call_Date_Client' =>$this->input->post('Check'),
                                'Meeting_Type_Icode' =>$this->input->post('mtype'),
                                'Next_Call_Date' => $next_date,
                                'Equiv_our_date' =>$qual_date  );
          $this->db->where('Prospect_Icode',$id);
          $this->db->update('ibt_prospect_data',$update_data);
          $this->session->set_flashdata('message', 'Successfully Saved');
          redirect('User/View_FollowUp_Data');
      }
      else
      {

      }
}

 /** VIEW MEETING STATUS 

 public function View_Meeting_Status()
 {
        $User_Icode =  $this->session->userdata['userid']; 
        $meeting_data['meeting']= $this->User_marketing_model->Get_All_Meeting_Data($User_Icode);
       $meeting_data['Mtype']  = $this->User_marketing_model->Meeting_type(); 
        $this->load->view('header');
        $this->load->view('top');
        $this->load->view('left');
        $this->load->view('View_Meeting_data',$meeting_data, FALSE);

 }**/


 /** INSERT MEETING STATUS **/
 public function Insert_Meeting_Status()
 {

        $date = date('Y-m-d');
        $User_Icode =  $this->session->userdata['userid']; 
        $P_code = $this->input->post('id',TRUE);
        $Prospect_Icode = $this->input->post('pros',TRUE);
        $Meeting_type = $this->input->post('Mtype',TRUE);
        $data = array('Meeting_Comment' =>  $this->input->post('Mcomments',TRUE),
                      'Meeting_BDE_Icode' =>$User_Icode,
                      'Meeting_BDE_Date' =>$date);
        $this->db->where('Meeting_Status_Icode',$P_code);
        $this->db->update('ibt_meeting_status', $data);

        $ndate= $this->input->post('mdate',TRUE);
        if($ndate == "" )
        {

        }
        else
        {
            $data = array('Next_Call_Date' =>  $this->input->post('mdate',TRUE),
                          'Meeting_Type_Icode' => $this->input->post('Mtype',TRUE));
            $this->db->where('Prospect_Icode',$Prospect_Icode);
            $this->db->update('ibt_prospect_data', $data);
        }
        echo 1;
}


 /** GET PROSPECT  DATA  ANALYSIS EDIT**/
public function Edit_Analysis_Data()
{
      $icode = $this->input->post('id',TRUE);
      $User_Icode =  $this->session->userdata['userid']; 
      $prospect_data['company_details']= $this->User_marketing_model->company_details_followup($icode,$User_Icode);
      $prospect['Industry'] = $this->User_marketing_model->Get_Industry_Details();
      $prospect['Domain'] = $this->User_marketing_model->Get_Domain_Details();

      $output = null;  

      $one = 'Below Average';
      $two = 'Average';
      $three = 'Above Average';
      $four = 'Good';
      $PS = 'Product&Services';
      $Ser = 'Services';
      foreach ($prospect_data['company_details'] as $row)  
      {  

            $output .="<div class='row'>";

            $output .= "<input type='hidden' id='pid'  class='form-control' name='pid' value='".$row['Prospect_Icode']."'> </br>"; 
            $output .= "<input type='hidden' id='bde_id'  class='form-control' name='bde_id' value='".$row['Prospect_Analysis_BDE_Code']."'> </br>"; 
            $output .= "<h4>" .$row['Company_Name']."( <a   target='_blank' href='".$row['WebURL']."'>".$row['WebURL']."</a> ) </h4></br>";  $output .="<div class='col-md-6'>";
            $output .="<div class='form-group'>";
            $output .= "Select Category: <select id='category' name='category' class='form-control' ><option value='".$row['prospect_Category']."'>".$row['prospect_Category']."</option><option value='".$PS."'>".$PS."</option><option value='".$Ser."'>".$Ser."</option></select> </br>"; 
            $output .="</div>";
            $output .="</div>";
            $output .="<div class='col-md-6'>";
            $output .="<div class='form-group'>";
            $output .= "Select Prospect Type: <select id='Ptype' name='Ptype' class='form-control' ><option value='".$row['Marketing_Prospect_Type']."'>".$row['Marketing_Prospect_Type']."</option><option value='".$one."'>".$one."</option><option value='".$two."'>".$two."</option><option value='".$three."'>".$three."</option><option value='".$four."'>".$four."</option></select> </br>"; 
            $output .="</div>";
            $output .="</div>";
            $output .="</div>";
            $output .="<div class='row'>";
            $output .="<div class='col-md-6'>";
            $output .="<div class='form-group'>";
            $output .= "Services: <textarea   id='name_text'  style='height: 100px; width: 500px'  class='form-control' name='name_text' value='".$row['Marketing_Services']."'>".$row['Marketing_Services']."</textarea> </br>"; 
            $output .="</div>";
            $output .="</div>";
            $output .="<div class='col-md-6'>";
            $output .="<div class='form-group'>";
            $output .= "Approch: <textarea   id='age_text' style='height: 100px; width: 500px'   class='form-control' name='age_text' value='".$row['Marketing_Approch']."'>".$row['Marketing_Approch']."</textarea> </br>"; 
            $output .="</div>";
            $output .="</div>";
            $output .="</div>";
            $output .="<div class='row'>";
            $output .="<div class='col-md-6'>";
            $output .="<div class='form-group'>";
            $output .= "Select Industry:<br> <select    id='indus_text' name='indus[]'  multiple >";
            foreach ($prospect['Industry'] as $row)
            {
                $output .= "<option value= '" .$row['Industries_Icode']."'> ". $row['Industries_Name'] ."</option>";
            }
            $output .="</select> </br>"; 
            $output .="</div>";
            $output .="</div>";
            $output .="<div class='col-md-6'>";
            $output .="<div class='form-group'>";
            $output .= "Select Domain:<br> <select   id='domain_text' name='domain[]' multiple >";
            foreach ($prospect['Domain'] as $row)
            {
                $output .= "<option value= '" .$row['Domain_Icode']."'> ". $row['Domain_Name'] ."</option>";
            }
            $output .="</select> </br>"; 
            $output .="</div>";
            $output .="</div>";
            $output .="</div>";
      }
      echo $output;  
}

//** START:  Get Country Wise Called Data  COLD**/

public function get_country_wise_called_data($country)
{
        $User_Icode =  $this->session->userdata['userid']; 
        $coun = $country;
        $data['country'] = $country;
        $data['data_total_count']= $this->User_marketing_model->get_country_Data_count($coun,$User_Icode);
        $data['thisweek']= $this->User_marketing_model->get_thisweek_count($coun,$User_Icode);
        $data['lastweek']= $this->User_marketing_model->get_Lastweek_count($coun,$User_Icode);
        $data['twoweek']= $this->User_marketing_model->get_twoweek_ago_count($coun,$User_Icode);
        $data['threeweek']= $this->User_marketing_model->get_threeweek_ago_count($coun,$User_Icode);
        $data['month']= $this->User_marketing_model->get_month_ago_count($coun,$User_Icode);
        $data['twomonth']= $this->User_marketing_model->get_twomonth_ago_count($coun,$User_Icode);
        $data['BA']= $this->User_marketing_model->get_Below_Avg_count($coun,$User_Icode);
        $data['Avg']= $this->User_marketing_model->get_Avg_count($coun,$User_Icode);
        $data['AboveAvg']= $this->User_marketing_model->get_AboveAvg_count($coun,$User_Icode);
        $data['Good']= $this->User_marketing_model->get_Good_count($coun,$User_Icode);
        $data['product']= $this->User_marketing_model->get_product_count($coun,$User_Icode);
        $data['services']= $this->User_marketing_model->get_services_count($coun,$User_Icode);
        $data['DM']= $this->User_marketing_model->get_DM_count($coun,$User_Icode);
        $data['others']= $this->User_marketing_model->get_Others_count($coun,$User_Icode);
        $data['custom']= $this->User_marketing_model->get_custom_count($coun,$User_Icode);
        $data['web']= $this->User_marketing_model->get_web_count($coun,$User_Icode);
        $data['mobile']= $this->User_marketing_model->get_mobile_count($coun,$User_Icode);
        $data['ec']= $this->User_marketing_model->get_ec_count($coun,$User_Icode);
        $this->load->view('header');
        $this->load->view('top');
        $this->load->view('left');
        $this->load->view('Cold_Followup',$data, FALSE);
}

//** GET THIS WEEk DATA**/
public function get_thisweek_data($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_thisweek_details($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By TimeLine - Called This Week';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Cold_Followup_view',$data, FALSE);
}

//** GET Last WEEk DATA**/
public function get_lastweek_data($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Lastweek_details($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By TimeLine - Called Last Week';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Cold_Followup_view',$data, FALSE);

}
//** GET two WEEk DATA**/
public function get_twoweek_data($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_twoweek_details($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By TimeLine - Called Two Week Ago';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Cold_Followup_view',$data, FALSE);

}
//** GET three WEEk DATA**/
public function get_threeweek_data($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_threeweek_details($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By TimeLine - Called Three Week Ago';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Cold_Followup_view',$data, FALSE);

}
//** GET month DATA**/
public function get_month_data($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_month_details($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By TimeLine - Called A Month Ago';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Cold_Followup_view',$data, FALSE);

}
//** GET two moth ago DATA**/
public function get_twomonth_data($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_twomonth_details($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By TimeLine - Called TWo Month Ago';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Cold_Followup_view',$data, FALSE);
}
//** GET Below Average DATA**/

public function get_BA_data($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Below_Avg_details($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Type - Below Average';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Cold_Followup_view',$data, FALSE);

}
//** GET Average DATA**/
public function get_Avg_data($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Avg_details($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Type -  Average';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Cold_Followup_view',$data, FALSE);

}
//** GET Above Average DATA**/
public function get_AAvg_data($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_AboveAvg_details($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Type - Above Average';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Cold_Followup_view',$data, FALSE);

}
//** GET Good DATA**/
public function get_Good_data($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['country'] = $coun;
      $data['details']= $this->User_marketing_model->get_Good_details($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Type - Good';
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Cold_Followup_view',$data, FALSE);

}
//** GET Product DATA**/
public function get_Product_data($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_product_details($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Category - Product';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Cold_Followup_view',$data, FALSE);

}
//** GET Service DATA**/
public function get_Service_data($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_service_details($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Category - Service';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Cold_Followup_view',$data, FALSE);

}
//** GET DM DATA**/
public function get_DM_data($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_DM_details($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Hit Rate - Spock with Decision Maker';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Cold_Followup_view',$data, FALSE);

}
//** GET other DATA**/
public function get_Other_data($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Other_details($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Hit Rate - Spock with Others';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Cold_Followup_view',$data, FALSE);

}
//** GET Custom DATA**/
public function get_custom_data($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_custom_details($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Service Type - Custom_Development';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Cold_Followup_view',$data, FALSE);

}

//** GET Web DATA**/

public function get_web_data($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_web_details($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Service Type - Web_Development';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Cold_Followup_view',$data, FALSE);

}
//** GET Mobile DATA**/
public function get_mobile_data($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_mobile_details($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Service Type - Mobile_Development';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Cold_Followup_view',$data, FALSE);

}
//** GET E-Commerce DATA**/
public function get_ec_data($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_ec_details($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Service Type - Ecommerce_Development';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Cold_Followup_view',$data, FALSE);

}

//** End:  Get Country Wise Called Data  COLD**/


//** START:  Get Country Wise Called Data  HOT**/
public function get_country_wise_called_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;

      $data['country'] = $country;
      $data['data_total_count']= $this->User_marketing_model->get_country_Data_count_Hot($coun,$User_Icode);
      $data['thisweek']= $this->User_marketing_model->get_thisweek_count_Hot($coun,$User_Icode);
      $data['lastweek']= $this->User_marketing_model->get_Lastweek_count_Hot($coun,$User_Icode);
      $data['twoweek']= $this->User_marketing_model->get_twoweek_ago_count_Hot($coun,$User_Icode);
      $data['threeweek']= $this->User_marketing_model->get_threeweek_ago_count_Hot($coun,$User_Icode);
      $data['month']= $this->User_marketing_model->get_month_ago_count_Hot($coun,$User_Icode);
      $data['twomonth']= $this->User_marketing_model->get_twomonth_ago_count_Hot($coun,$User_Icode);

      $data['BA']= $this->User_marketing_model->get_Below_Avg_count_Hot($coun,$User_Icode);
      $data['Avg']= $this->User_marketing_model->get_Avg_count_Hot($coun,$User_Icode);
      $data['AboveAvg']= $this->User_marketing_model->get_AboveAvg_count_Hot($coun,$User_Icode);
      $data['Good']= $this->User_marketing_model->get_Good_count_Hot($coun,$User_Icode);

      $data['product']= $this->User_marketing_model->get_product_count_Hot($coun,$User_Icode);
      $data['services']= $this->User_marketing_model->get_services_count_Hot($coun,$User_Icode);

      $data['DM']= $this->User_marketing_model->get_DM_count_Hot($coun,$User_Icode);
      $data['others']= $this->User_marketing_model->get_Others_count_Hot($coun,$User_Icode);

      $data['General']= $this->User_marketing_model->get_General_count_Hot($coun,$User_Icode);
      $data['Sales']= $this->User_marketing_model->get_Sales_count_Hot($coun,$User_Icode);
      $data['Technical']= $this->User_marketing_model->get_Technical_count_Hot($coun,$User_Icode);
      $data['RFP']= $this->User_marketing_model->get_RFP_count_Hot($coun,$User_Icode);
      $data['Review']= $this->User_marketing_model->get_Review_count_Hot($coun,$User_Icode);
      $data['Commercial']= $this->User_marketing_model->get_Commercial_count_Hot($coun,$User_Icode);
      $data['Interview']= $this->User_marketing_model->get_Interview_count_Hot($coun,$User_Icode);
      $data['Escalation']= $this->User_marketing_model->get_Escalation_count_Hot($coun,$User_Icode);
      $data['FeedBack']= $this->User_marketing_model->get_FeedBack_count_Hot($coun,$User_Icode);


      $data['custom']= $this->User_marketing_model->get_custom_count_Hot($coun,$User_Icode);
      $data['web']= $this->User_marketing_model->get_web_count_Hot($coun,$User_Icode);
      $data['mobile']= $this->User_marketing_model->get_mobile_count_Hot($coun,$User_Icode);
      $data['ec']= $this->User_marketing_model->get_ec_count_Hot($coun,$User_Icode);

      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup',$data, FALSE);
}

//** GET This Week HOT **//
public function get_thisweek_data_Hot($country)
{

        $User_Icode =  $this->session->userdata['userid']; 
        $coun = $country;
        $data['details']= $this->User_marketing_model->get_thisweek_details_Hot($coun,$User_Icode);
        //print_r($data['details']);
        $data['count'] = count($data['details']);
        $data['show'] = 'By TimeLine - Called This Week';
        $data['country'] = $coun;
        $this->load->view('header');
        $this->load->view('top');
        $this->load->view('left');
        $this->load->view('Hot_Followup_view',$data, FALSE);

}
//** GET last Week HOT **//
public function get_lastweek_data_Hot($country)
{
        $User_Icode =  $this->session->userdata['userid']; 
        $coun = $country;
        $data['details']= $this->User_marketing_model->get_Lastweek_details_Hot($coun,$User_Icode);
        $data['count'] = count($data['details']);
        $data['show'] = 'By TimeLine - Called Last Week';
        $data['country'] = $coun;
        $this->load->view('header');
        $this->load->view('top');
        $this->load->view('left');
        $this->load->view('Hot_Followup_view',$data, FALSE);

}
//** GET two Week HOT **//
public function get_twoweek_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_twoweek_details_Hot($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By TimeLine - Called Two Week Ago';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}
//** GET three Week HOT **//
public function get_threeweek_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_threeweek_details_Hot($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By TimeLine - Called Three Week Ago';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}
//** GET month HOT **//
public function get_month_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_month_details_Hot($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By TimeLine - Called A Month Ago';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}
//** GET two month HOT **//
public function get_twomonth_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_twomonth_details_Hot($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By TimeLine - Called TWo Month Ago';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}
//** GET Below Average HOT **//

public function get_BA_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Below_Avg_details_Hot($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Type - Below Average';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}
//** GET  Average HOT **//
public function get_Avg_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Avg_details_Hot($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Type -  Average';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}
//** GETAbove Average HOT **//
public function get_AAvg_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_AboveAvg_details_Hot($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Type - Above Average';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}
//** GET Good HOT **//
public function get_Good_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['country'] = $coun;
      $data['details']= $this->User_marketing_model->get_Good_details_Hot($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Type - Good';
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);
}
//** GET Product HOT **//
public function get_Product_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_product_details_Hot($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Category - Product';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}
//** GET Service HOT **//
public function get_Service_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_service_details_Hot($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Category - Service';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}
//** GET DM HOT **//
public function get_DM_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_DM_details_Hot($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Hit Rate - Spock with Decision Maker';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}
//** GET Other HOT **//
public function get_Other_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Other_details_Hot($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Hit Rate - Spock with Others';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}
//** GET General HOT **//

public function get_General_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_General_Details_Hot($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Category - Product';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);
}
 /** SALES **/
public function get_sales_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Sales_Details_Hot($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'Post Meeting Followup - Sales Presentation';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);
}
/** TECHNICAL**/
public function get_Technical_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Technical_data_Hot_details($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'Post Meeting Followup - Sales Presentation';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);
}

/** RFP**/
public function get_RFP_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_RFP_data_Hot_details($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'Post Meeting Followup - Sales Presentation';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}
/** Review**/
public function get_Review_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Review_data_Hot_details($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'Post Meeting Followup - Sales Presentation';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}
/** Commerical**/
public function get_Commercial_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Commercial_data_Hot_details($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'Post Meeting Followup - Sales Presentation';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}
/** Interview**/
public function get_Interview_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Interview_data_Hot_details($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'Post Meeting Followup - Sales Presentation';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}
/** Escalation**/
public function get_Escalation_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Escalation_data_Hot_details($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'Post Meeting Followup - Sales Presentation';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}

/** get_FeedBack_data_Warm**/
public function get_FeedBack_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_FeedBack_data_Hot_details($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'Post Meeting Followup - Sales Presentation';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}
//** GET Custom HOT **//
public function get_custom_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_custom_data_Hot_details($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Service Type - Custom_Development';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}
//** GET Web HOT **//
public function get_web_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_web_data_Hot_details($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Service Type - Web_Development';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}
//** GET mobile HOT **//
public function get_mobile_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_mobile_data_Hot_details($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Service Type - Mobile_Development';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}
//** GET E-Commerce HOT **//
public function get_ec_data_Hot($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_ec_data_Hot_details($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Service Type - Ecommerce_Development';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Hot_Followup_view',$data, FALSE);

}

//** End:  Get Country Wise Called Data  HOT**/


//**  START : GET Warm FOLLOW UP DATA **//
public function get_country_wise_called_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;

      $data['country'] = $country;
      $data['data_total_count']= $this->User_marketing_model->get_country_Data_count_Warm($coun,$User_Icode);
      $data['thisweek']= $this->User_marketing_model->get_thisweek_count_Warm($coun,$User_Icode);
      $data['lastweek']= $this->User_marketing_model->get_Lastweek_count_Warm($coun,$User_Icode);
      $data['twoweek']= $this->User_marketing_model->get_twoweek_ago_count_Warm($coun,$User_Icode);
      $data['threeweek']= $this->User_marketing_model->get_threeweek_ago_count_Warm($coun,$User_Icode);
      $data['month']= $this->User_marketing_model->get_month_ago_count_Warm($coun,$User_Icode);
      $data['twomonth']= $this->User_marketing_model->get_twomonth_ago_count_Warm($coun,$User_Icode);

      $data['BA']= $this->User_marketing_model->get_Below_Avg_count_Warm($coun,$User_Icode);
      $data['Avg']= $this->User_marketing_model->get_Avg_count_Warm($coun,$User_Icode);
      $data['AboveAvg']= $this->User_marketing_model->get_AboveAvg_count_Warm($coun,$User_Icode);
      $data['Good']= $this->User_marketing_model->get_Good_count_Warm($coun,$User_Icode);

      $data['product']= $this->User_marketing_model->get_product_count_Warm($coun,$User_Icode);
      $data['services']= $this->User_marketing_model->get_services_count_Warm($coun,$User_Icode);

      $data['DM']= $this->User_marketing_model->get_DM_count_Warm($coun,$User_Icode);
      $data['others']= $this->User_marketing_model->get_Others_count_Warm($coun,$User_Icode);

      $data['General']= $this->User_marketing_model->get_General_count_Warm($coun,$User_Icode);
      $data['Sales']= $this->User_marketing_model->get_Sales_count_Warm($coun,$User_Icode);
      $data['Technical']= $this->User_marketing_model->get_Technical_count_Warm($coun,$User_Icode);
      $data['RFP']= $this->User_marketing_model->get_RFP_count_Warm($coun,$User_Icode);
      $data['Review']= $this->User_marketing_model->get_Review_count_Warm($coun,$User_Icode);
      $data['Commercial']= $this->User_marketing_model->get_Commercial_count_Warm($coun,$User_Icode);
      $data['Interview']= $this->User_marketing_model->get_Interview_count_Warm($coun,$User_Icode);
      $data['Escalation']= $this->User_marketing_model->get_Escalation_count_Warm($coun,$User_Icode);
      $data['FeedBack']= $this->User_marketing_model->get_FeedBack_count_Warm($coun,$User_Icode);

      $data['custom']= $this->User_marketing_model->get_custom_count_Warm($coun,$User_Icode);
      $data['web']= $this->User_marketing_model->get_web_count_Warm($coun,$User_Icode);
      $data['mobile']= $this->User_marketing_model->get_mobile_count_Warm($coun,$User_Icode);
      $data['ec']= $this->User_marketing_model->get_ec_count_Warm($coun,$User_Icode);

      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup',$data, FALSE);
}

//** GET This Week DATA  WARM**//
public function get_thisweek_data_Warm($country)
{

      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_thisweek_details_Warm($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By TimeLine - Called This Week';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);
}

//** GET Last Week DATA  WARM**//

public function get_lastweek_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Lastweek_details_Warm($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By TimeLine - Called Last Week';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);
}

//** GET two Week DATA  WARM**//
public function get_twoweek_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_twoweek_details_Warm($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By TimeLine - Called Two Week Ago';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);
}
//** GET Three Week DATA  WARM**//
public function get_threeweek_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_threeweek_details_Warm($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By TimeLine - Called Three Week Ago';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);
}
//** GET Month DATA  WARM**//
public function get_month_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_month_details_Warm($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By TimeLine - Called A Month Ago';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);

}
//** GET Two Month DATA  WARM**//
public function get_twomonth_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_twomonth_details_Warm($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By TimeLine - Called TWo Month Ago';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);

}
//** GET Below Average DATA  WARM**//
public function get_BA_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Below_Avg_details_Warm($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Type - Below Average';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);

}
//** GET Average DATA  WARM**//
public function get_Avg_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Avg_details_Warm($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Type -  Average';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);

}
//** GET Above Average DATA  WARM**//
public function get_AAvg_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_AboveAvg_details_Warm($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Type - Above Average';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);

}
//** GET Good DATA  WARM**//
public function get_Good_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['country'] = $coun;
      $data['details']= $this->User_marketing_model->get_Good_details_Warm($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Type - Good';
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);

}
//** GET Product DATA  WARM**//
public function get_Product_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_product_details_Warm($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Category - Product';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);

}
//** GET Service DATA  WARM**//
public function get_Service_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_service_details_Warm($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Category - Service';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);

}
//** GET DM DATA  WARM**//
public function get_DM_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_DM_details_Warm($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Hit Rate - Spock with Decision Maker';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);

}
//** GET Other DATA  WARM**//
public function get_Other_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Other_details_Warm($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Hit Rate - Spock with Others';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);

}
//** GET General DATA  WARM**//
public function get_General_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_General_Details_Warm($coun,$User_Icode);
      $data['count'] = count($data['details']);
      $data['show'] = 'By Category - Product';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);
}
/** SALES **/

public function get_sales_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Sales_Details_Warm($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'Post Meeting Followup - Sales Presentation';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);


}

/** TECHNICAL**/
public function get_Technical_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Technical_data_Warm_details($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'Post Meeting Followup - Sales Presentation';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);


}

/** RFP**/
public function get_RFP_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_RFP_data_Warm_details($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'Post Meeting Followup - Sales Presentation';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);


}

/** Review**/
public function get_Review_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Review_data_Warm_details($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'Post Meeting Followup - Sales Presentation';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);


}
/** Commerical**/
public function get_Commercial_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Commercial_data_Warm_details($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'Post Meeting Followup - Sales Presentation';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);


}

/** Interview**/
public function get_Interview_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Interview_data_Warm_details($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'Post Meeting Followup - Sales Presentation';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);


}

/** Escalation**/
public function get_Escalation_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_Escalation_data_Warm_details($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'Post Meeting Followup - Sales Presentation';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);


}

/** get_FeedBack_data_Warm**/
public function get_FeedBack_data_Warm($country)
{
      $User_Icode =  $this->session->userdata['userid']; 
      $coun = $country;
      $data['details']= $this->User_marketing_model->get_FeedBack_data_Warm_details($coun,$User_Icode);
      //print_r($data['details']);
      $data['count'] = count($data['details']);
      $data['show'] = 'Post Meeting Followup - Sales Presentation';
      $data['country'] = $coun;
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('Warm_Followup_view',$data, FALSE);

}
/** get_custom_data_Warm**/
public function get_custom_data_Warm($country)
{
    $User_Icode =  $this->session->userdata['userid']; 
    $coun = $country;
    $data['details']= $this->User_marketing_model->get_custom_data_Warm_details($coun,$User_Icode);
    //print_r($data['details']);
    $data['count'] = count($data['details']);
    $data['show'] = 'Post Meeting Followup - Sales Presentation';
    $data['country'] = $coun;
    $this->load->view('header');
    $this->load->view('top');
    $this->load->view('left');
    $this->load->view('Warm_Followup_view',$data, FALSE);

}
  /** get_web_data_Warm**/
public function get_web_data_Warm($country)
{
    $User_Icode =  $this->session->userdata['userid']; 
    $coun = $country;
    $data['details']= $this->User_marketing_model->get_web_data_Warm_details($coun,$User_Icode);
    //print_r($data['details']);
    $data['count'] = count($data['details']);
    $data['show'] = 'Post Meeting Followup - Sales Presentation';
    $data['country'] = $coun;
    $this->load->view('header');
    $this->load->view('top');
    $this->load->view('left');
    $this->load->view('Warm_Followup_view',$data, FALSE);
}
  /** get_mobile_data_Warm**/
public function get_mobile_data_Warm($country)
{
    $User_Icode =  $this->session->userdata['userid']; 
    $coun = $country;
    $data['details']= $this->User_marketing_model->get_mobile_data_Warm_details($coun,$User_Icode);
    //print_r($data['details']);
    $data['count'] = count($data['details']);
    $data['show'] = 'Post Meeting Followup - Sales Presentation';
    $data['country'] = $coun;
    $this->load->view('header');
    $this->load->view('top');
    $this->load->view('left');
    $this->load->view('Warm_Followup_view',$data, FALSE);
}
  /** get_EC_data_Warm**/
public function get_ec_data_Warm($country)
{
    $User_Icode =  $this->session->userdata['userid']; 
    $coun = $country;
    $data['details']= $this->User_marketing_model->get_ec_data_Warm_details($coun,$User_Icode);
    //print_r($data['details']);
    $data['count'] = count($data['details']);
    $data['show'] = 'Post Meeting Followup - Sales Presentation';
    $data['country'] = $coun;
    $this->load->view('header');
    $this->load->view('top');
    $this->load->view('left');
    $this->load->view('Warm_Followup_view',$data, FALSE);

}

/** Start:  Hot  Follow up page **/

public function Hot_Data_Call_Client_date($id)
{

    $prospect_data['Mtype']  = $this->User_marketing_model->Meeting_type(); 
    $prospect_data['Meeting_history']  = $this->User_marketing_model->Meeting_History($id); 

    $User_Icode =  $this->session->userdata['userid']; 
    $prospect_data['company_details']= $this->User_marketing_model->company_details_client_date($id);
    $prospect_data['history']  = $this->User_marketing_model->Company_History($id); 
    $prospect_data['increment'] = 0;
    $prospect_data['Total_data'] = 1;


    $this->load->view('header');
    $this->load->view('top');
    $this->load->view('left');
    $this->load->view('view_Followup_Call',$prospect_data, FALSE);

}

/** End:  Hot  Follow up page **/



/** Start:  Warm Call Page **/

public function Warm_Data_Call_Client_date($id)
{

      $prospect_data['Mtype']  = $this->User_marketing_model->Meeting_type(); 
      $prospect_data['Meeting_history']  = $this->User_marketing_model->Meeting_History($id); 

      $User_Icode =  $this->session->userdata['userid']; 
      $prospect_data['company_details']= $this->User_marketing_model->company_details_client_date($id);
      $prospect_data['history']  = $this->User_marketing_model->Company_History($id); 
      $prospect_data['increment'] = 0;
      $prospect_data['Total_data'] = 1;


      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('view_Followup_Call',$prospect_data, FALSE);

}

/** End:  Warm Call Page **/


/** Start: Followup Data call Client Date **/

public function Followup_Data_Call_status_client_date()
{

      $date = date("Y-m-d H:i:s");

      $check = $this->input->post('Check');

      if($check == 'No')
      {
          $qual_date = "Null";
          $next_date = "";

      }
      else
      {
          $next_date = $this->input->post('client_date',true);
          $qual_date = $this->input->post('equal_our_date',true);

      }
// $data = array('Prospect_Icode' => $this->input->post('prospect_Icode',true), 
// 'Meeting_Type_Icode' => $this->input->post('Meeting',true),
/// 'Meeting_Date' =>$next_date,
// 'Equiv_our_date' =>$qual_date
// );
// $insert = $this->User_marketing_model->Add_Meeting_call_status($data);


// if($insert == 1)
// {

      $data = array('Prospect_Icode' => $this->input->post('prospect_Icode',true), 
                    'Prospect_Status' => $this->input->post('Prospect_Status',true),
                    'Scheduled_Date' => $this->input->post('Scheduled_date',true),
                    'Prospect_Call_Result' => $this->input->post('Result',true),
                    'Prospect_Call_Comments' => $this->input->post('Comment',true),
                    'Prospect_BDE_Icode' => $this->session->userdata['userid'] );
      $insert = $this->User_marketing_model->Add_Prospect_call_status($data);

      if($insert == 1)
      {
          $id = $this->input->post('prospect_Icode');
          $update_data = array( 'Prospect_Status' => $this->input->post('Prospect_Status',true),
                                'Last_Called_Date' => $date,
                                'Next_Call_Date_Client' =>$this->input->post('Check',true),
                                'Meeting_Type_Icode' =>$this->input->post('Meeting',true),
                                'Next_Call_Date' => $next_date,
                                'Equiv_our_date' =>$qual_date);
          $this->db->where('Prospect_Icode',$id);
          $this->db->update('ibt_prospect_data',$update_data);
          echo 1;
      

//   }
//else
//  {
// echo 0;
//  }
    }

      else
      {
      echo 0;

      }
}

/** Start:  Meeting  Follow up page **/

public function Meeting_Call($id)
{

    $meeting_data['Mtype']  = $this->User_marketing_model->Meeting_type(); 
    $meeting_data['Meeting_history']  = $this->User_marketing_model->Meeting_History($id); 
    $meeting_data['meeting']= $this->User_marketing_model->Get_All_Meeting_Data($id);
    $meeting_data['history']  = $this->User_marketing_model->Company_History($id); 
    $this->load->view('header');
    $this->load->view('top');
    $this->load->view('left');
    $this->load->view('view_Meeting_Call',$meeting_data, FALSE);

}
/** End:  Meeting  Follow up page **/


/** update meeting status**/
public function Meeting_status()
{
      $pcode= $this->input->post('prospect_Icode',true);
      $mcode= $this->input->post('meeting_code',true);
      $User_Icode =  $this->session->userdata['userid']; 
      $date = date("Y-m-d H:i:s");
      $check = $this->input->post('Check');

      if($check == 'No')
      {
          $qual_date = "Null";
          $next_date = "";
          $next_meeting_type = "0";

      }
      else
      {
          $next_date = $this->input->post('client_date',true);
          $qual_date = $this->input->post('equal_our_date',true);
          $next_meeting_type =  $this->input->post('Next_meeting_Type',true);

      }

     $data = array( 'Prospect_Icode' =>$pcode,
                    'Client_participant_Name' => $this->input->post('Client',true), 
                    'Ibt_participant_name' => $this->input->post('Ibt',true),
                    'Meeting_Type'=>$this->input->post('cmeeting',true),
                    'Meeting_Date' =>$next_date,
                    'Equiv_our_date' =>$qual_date,
                    'Next_Meeting_Type' =>$next_meeting_type,
                    'Meeting_Comment' =>$this->input->post('Meeting_cmd',true),
                    'Meeting_BDE_Icode' =>$User_Icode,
                    'Meeting_BDE_Date' =>$date );

     $update = $this->User_marketing_model->Add_Meeting_call_status($data); 

     if($update == 1)
     {

          $data2 = array( 'Prospect_Icode' =>$pcode,
                          'Prospect_BDE_Icode' => $User_Icode,
                          'Prospect_Status' =>$this->input->post('pststus',true),
                          'Prospect_Call_Result'=>$this->input->post('Result',true),
                          'Prospect_Call_Comments' =>$this->input->post('Next_comment',true),
                          'Scheduled_Date' =>$this->input->post('scheduled_date',true));

          $insert_status = $this->User_marketing_model->Add_Prospect_call_status($data2); 

      if($insert_status == 1)
      {
           $data1 = array('Last_Called_Date' =>$date,
                          'Next_Call_Date_Client' =>  $this->input->post('Check',true),
                          'Next_Call_Date' =>$next_date,
                          'Equiv_our_date' =>$qual_date,
                          'Meeting_Type_Icode'=>$next_meeting_type);
            $this->db->where('Prospect_Icode',$pcode);
            $this->db->update('ibt_prospect_data',$data1);
            echo 1;
      }
      else
      {
        echo 0;
      }

     }
     else
     {
      echo 0;
     }
}

/** Meeting_status_postponce **/
public function Meeting_status_postponce()
{

      $pcode= $this->input->post('prospect_Icode',true);
     //$mcode= $this->input->post('meeting_code',true);
      $User_Icode =  $this->session->userdata['userid']; 
      $date = date("Y-m-d H:i:s");
     //$check = $this->input->post('Check');
      $next_date = $this->input->post('client_date',true);
      $qual_date = $this->input->post('equal_our_date',true);
      $next_meeting_type =  $this->input->post('Next_meeting_Type',true);
      $data = array('Prospect_Icode' =>$pcode,
                    'Client_participant_Name' => "", 
                    'Ibt_participant_name' => "",
                    'Meeting_Type'=>$this->input->post('cmeeting',true),
                    'Meeting_Date' =>$next_date,
                    'Equiv_our_date' =>$qual_date,
                    'Next_Meeting_Type' =>$next_meeting_type,
                    'Meeting_Comment' =>$this->input->post('Next_comment',true),
                    'Meeting_BDE_Icode' =>$User_Icode,
                    'Meeting_BDE_Date' =>$date );

      $update = $this->User_marketing_model->Add_Meeting_call_status($data); 

      if($update == 1)
     {

      $data2 = array( 'Prospect_Icode' =>$pcode,
                      'Prospect_BDE_Icode' => $User_Icode,
                      'Prospect_Status' =>$this->input->post('pststus',true),
                      'Prospect_Call_Result'=>$this->input->post('Result',true),
                      'Prospect_Call_Comments' =>$this->input->post('Next_comment',true),
                      'Scheduled_Date' =>$this->input->post('scheduled_date',true));

      $insert_status = $this->User_marketing_model->Add_Prospect_call_status($data2); 

                if($insert_status == 1)
                {
                    $data1 = array( 'Last_Called_Date' =>$date,
                                    'Next_Call_Date' =>$next_date,
                                    'Equiv_our_date' =>$qual_date,
                                    'Meeting_Type_Icode'=>$next_meeting_type);
                                    $this->db->where('Prospect_Icode',$pcode);
                                    $this->db->update('ibt_prospect_data',$data1);
                                    echo 1;
                }
                else
                {
                  echo 0;
                }

     }
     else
     {
      echo 0;
     }


}


/** Meeting cancel**/
public function Meeting_status_Cancel()
{
 
      $pcode= $this->input->post('prospect_Icode',true);
//$mcode= $this->input->post('meeting_code',true);
      $User_Icode =  $this->session->userdata['userid']; 
      $date = date("Y-m-d H:i:s");
      $data = array('Prospect_Icode' =>$pcode,
                    'Client_participant_Name' => "", 
                    'Ibt_participant_name' => "",
                    'Meeting_Date' =>"",
                    'Equiv_our_date' =>"Null",
                    'Next_Meeting_Type' =>"",
                    'Meeting_Type'=>$this->input->post('cmeeting',true),
                    'Meeting_Comment' =>$this->input->post('Next_comment',true),
                    'Meeting_BDE_Icode' =>$User_Icode,
                    'Meeting_BDE_Date' =>$date);

     $update = $this->User_marketing_model->Add_Meeting_call_status($data); 
      if($update == 1)
     {

                $data2 = array( 'Prospect_Icode' =>$pcode,
                                'Prospect_BDE_Icode' => $User_Icode,
                                'Prospect_Status' =>$this->input->post('pststus',true),
                                'Prospect_Call_Result'=>$this->input->post('Result',true),
                                'Prospect_Call_Comments' =>$this->input->post('Next_comment',true),
                                'Scheduled_Date' =>$this->input->post('scheduled_date',true));

                 $insert_status = $this->User_marketing_model->Add_Prospect_call_status($data2); 

                if($insert_status == 1)
                {
                      $data1 = array('Last_Called_Date' =>$date,
                                      'Next_Call_Date' =>"",
                                      'Equiv_our_date' =>"Null",
                                      'Meeting_Type_Icode'=>'0');
                      $this->db->where('Prospect_Icode',$pcode);
                      $this->db->update('ibt_prospect_data',$data1);
                      echo 1;
                }
                else
                {
                     echo 0;
                }

     }
     else
     {
      echo 0;
     }


}


/** Meetring status history**/
public function Meeting_status_History()
{
        $id = $this->input->post('id',true);
        $data['status'] = $this->User_marketing_model->Meeting_status_History($id);
        $output = null;

        foreach ($data['status'] as $row ) 
        {
        
                $output .="<div class='row'>";
                $output .="<div class='col-md-12'>";
                $output .="<label>Meeting Type:".$row['Meeting_Type']. "</label>";
                $output .="<div class='form-group'>";

                $output .="<label>Client participant(s) </label>";
                $output .= "   <textarea class='form-control' >".$row['Client_participant_Name']."</textarea> </br>"; 
                $output .="</div>";

                $output .="<div class='form-group'>";

                $output .="<label>IBT participant(s) </label>";
                $output .= "  <textarea class='form-control' >".$row['Ibt_participant_name']."</textarea> </br>"; 
                $output .="</div>";

                $output .="<div class='form-group'>";

                $output .="<label>Meeting Minutes </label>";
                $output .= "  <textarea class='form-control' style='height:100px;' >".$row['Meeting_Comment']."</textarea> </br>"; 
                $output .="</div>";
                $output .="</div>";
                $output .="</div>";
      }

     echo  $output;

}


/** Search CLient **/
public function Prospect_Client_Search()
{
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('search_client');
}

/** Search_Company**/
public function search_Company()
{
      $company = $this->input->post('company1',true);
      $url = $this->input->post('url1',true);
      $phone = $this->input->post('phone1',true);
      $data_search = array( 'Company_Name'                   => $this->input->post('company1',true),
                            'WebURL'                         => $this->input->post('url1',true),
                            'Company_Contact'                => $this->input->post('phone1',true));

      $prospect_data['company_details']= $this->User_marketing_model->Search_company_details($data_search);
      $output = null;
      foreach ($prospect_data['company_details'] as $key ) 
      {

            $id = $key['Prospect_Icode'];

            $output .="<tr>";
            $output .="<td>" .$key['Company_Name'] . "</td>";
            $output .="<td>" .$key['WebURL'] . "</td>";
            $output .="<td>" .$key['Company_Contact'] . "</td>";
            $output .="<td>" .$key['Country'] . "</td>";

            if($key['Prospect_Status'] == 'Cold' || $key['Prospect_Status'] == 'New'   )
            {
                  $output .="<td><a class='btn btn-success' href='Prospect_Data_Call_Client_date/$id'><i class='glyphicon glyphicon-zoom-in icon-white'></i> Call
                  </a> </td>";
            }
            else
            {
                  $output .="<td><a class='btn btn-success' href='Warm_Data_Call_Client_date/$id'><i class='glyphicon glyphicon-zoom-in icon-white'></i> Call
                  </a></td>";
            }

            $output .="</tr>";
     
      }
      echo $output;
}

 /** REVIEW **/
public function Review()
{
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('ReviewAnalysis');
}

/** Get BDE with Data Count **/
public function get_Review_Data()
{
      $User_Icode =  $this->session->userdata['userid']; 
      $data['BDE']= $this->User_marketing_model->get_all_BDE($User_Icode);
      $output = null; 
      foreach ($data['BDE'] as $row)  
      {  
            $I_code = $row['User_Icode'];
            $output .= "<tr>";
            $output .= "<td>".$row['User_Name']."</td>";  
            $data['analysis'] = $this->User_marketing_model->BDE_data_Analysis_Count($I_code);
            foreach ($data['analysis'] as $key ) 
            {
                  $country = $key['Country'];
                  $output .= "<td><a href='get_all_review_data/$country/$I_code'>".$key['Country']. "|" .$key['COUNT(*)']. "</a></td>";  
            }
            $output .= "</tr>";
      }
      echo $output; 
}

/** Get All Data with Perticular BDE **/
public function get_all_review_data($country,$id)
{

      $country =  $this->uri->segment(3);
      $Icode =  $this->uri->segment(4);

      $data['Update_Analysis']= $this->User_marketing_model->get_All_Analysis_Data($country,$Icode);
      $data['Industry'] = $this->User_marketing_model->Get_Industry_Details();
      $data['Domain'] = $this->User_marketing_model->Get_Domain_Details();
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('BDE_Analysis_Data',$data,FALSE);

}
//**BDE Status**/
public function BDE_Status()
{
      $this->load->view('header');
      $this->load->view('top');
      $this->load->view('left');
      $this->load->view('BDE_Status');
}
//** View BDE Status **/
public function View_BDE_Status()
{
  $User_Icode =  $this->session->userdata['userid']; 
      $data['data_country']= $this->User_marketing_model->Data_Country();
      $data['BDE']= $this->User_marketing_model->get_all_BDE_leader($User_Icode);

     // print_r($data['BDE']);
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

  //** Individual BDE Data_Status **/
  public function Data_Status()
  {
        $User_Icode =  $this->session->userdata['userid']; 
        $data['BDE']= $this->User_marketing_model->get_all_BDE($User_Icode);
        $this->load->view('header');
        $this->load->view('top');
        $this->load->view('left');
        $this->load->view('BDE_Data_Status',$data, FALSE);
  }

  //** Search Data Status **/
  public function search_Data_Status()
  {
    $bde_code = $this->input->post('bde',true);

    $country = $this->User_marketing_model->get_BDE_Country($bde_code);

     $followup = $this->User_marketing_model->get_Followup_Count($bde_code);
     $tptal_month = $this->User_marketing_model->get_Total_Month_Count($bde_code);
     $conversion_month = $this->User_marketing_model->get_Conversion_Month_Count($bde_code);
     $dm_month = $this->User_marketing_model->get_total_DM_Month_Count($bde_code);


    foreach ($country as $key ) {
      $country_name[] = $key['Country'];
    }
  
     foreach ($country_name as $key)   // total Data Status
     {
      $cname = $key;
      $data_status[] = $this->User_marketing_model->get_data_status_count($cname,$bde_code);
     }


     foreach ($country_name as $key)   //Total Calls for month
     {
      $cname = $key;
      $data_month[] = $this->User_marketing_model->get_total_call_Month_count($cname,$bde_code);
     }

     foreach ($country_name as $key)   //Total Calls for Reached Decision Maker
     {
      $cname = $key;
      $data_DM[] = $this->User_marketing_model->get_DM_Reached_Count($cname,$bde_code);
     }

     foreach ($country_name as $key)   //Total Calls for Meeting in This MOnth
     {
      $cname = $key;
      $data_Meeting[] = $this->User_marketing_model->get_Month_Meeting_Count($cname,$bde_code);
     }

     foreach ($country_name as $key)   //Total Calls Conversion This MOnth
     {
      $cname = $key;
      $data_Conversion[] = $this->User_marketing_model->get_Month_Conversion_Count($cname,$bde_code);
     }

    
     $full_data = array('data_status' => $data_status,
                         'Month' => $data_month,
                         'DM' =>$data_DM,
                         'Meeting' => $data_Meeting,
                         'Conversion' =>$data_Conversion,
                         'Followup' => $followup,
                         'total_month' => $tptal_month,
                         'Conversion_month' => $conversion_month,
                         'Dm_count' => $dm_month );
     echo  json_encode($full_data);
  }

  //** New Requirement **/

  public function New_Requirement()
  {

        $User_Icode =  $this->session->userdata['userid']; 
        $data['Client']= $this->User_marketing_model->Select_Client($User_Icode);
        $data['technical']= $this->User_marketing_model->get_Technical_Platform();
        $data['Industry'] = $this->User_marketing_model->Get_Industry_Details();
        $data['Domain'] = $this->User_marketing_model->Get_Domain_Details();
        $this->load->view('header');
        $this->load->view('top');
        $this->load->view('left');
        $this->load->view('New_Requirement',$data, FALSE);

  }

  //** Get Company Details **/
  public function get_Company_Details()
  {
        $pcode = $this->input->post('id',true);
        $data= $this->User_marketing_model->Select_Company_Details($pcode);
         echo  json_encode($data);

  }

  //** Save Requirement Project **/

  public function Save_project()
  {
    $User_Icode =  $this->session->userdata['userid']; 

    $full_data = array(  'Prospect_Icode' => $this->input->post('company',true),
                         'Requirement_Type' => $this->input->post('type',true),
                         'Project_Title' =>$this->input->post('Title',true),
                         'Tech_Platform' => $this->input->post('tech',true),
                         'Tech_Skill' =>$this->input->post('Skill',true),
                         'Domain' => $this->input->post('domain',true),
                         'Industries' => $this->input->post('Industry',true),
                         'Estimation_Date' =>$this->input->post('equal_our_date',true),
                         'BDE_Code' => $User_Icode,
                         'Requirement_Status' => '1');

    $insert_Req = $this->User_marketing_model->Save_Requirement($full_data); 

   
    if($insert_Req != '0')
    {

      $data = array( 'Prospect_Icode' =>$this->input->post('company',true),
                     'Requirement_Icode' => $insert_Req,
                     'Requirement_Status' => '1',
                     'Req_Comments' => 'New Requirement',
                     'BDE_Code' =>$User_Icode
                      );
      $this->db->insert('ibt_requirement_status', $data); 
      echo 1;
    }
    else
    {
      echo 0;
    }

  }

  //** SAVE RESOURCE **//
  public function Save_Resource()
  {
    $User_Icode =  $this->session->userdata['userid']; 
    $tech =  $this->input->post('STechnical');
    $count = sizeof($tech);
    $area = $this->input->post('myTextArea');
    $experience =  $this->input->post('experience');
    $timeline = $this->input->post('timeline');
    $edate = $this->input->post('equal_our_date1');
    $duration =$this->input->post('Duration');
    $skill = $this->input->post('Skill');

    for($i=0; $i<$count; $i++)
    {
       $full_data = array('Prospect_Icode' => $this->input->post('Company_code'),
                         'Requirement_Type' => $this->input->post('type'),
                         'Min_Experience' =>$experience[$i],
                         'Tech_Platform' =>$tech[$i],
                         'Tech_Skill' =>$area[$i],
                         'Interview_Timeline' =>$timeline[$i],
                         'Resource_Exp_Start_Date' =>$edate[$i],
                         'Contract_Duration' =>$duration[$i],
                         // 'No_of_Resource' =>$this->input->post('NOR',true),
                         'BDE_Code' => $User_Icode,
                         'Requirement_Status' => '9');
       $insert_Req = $this->User_marketing_model->Save_Requirement($full_data);
       $data = array('Prospect_Icode' =>$this->input->post('Company_code',true),
                       'Requirement_Status' => '9',
                       'Requirement_Icode' => $insert_Req,
                       'Req_Comments' => 'New Resource',
                       'BDE_Code' => $User_Icode
                        );
        $this->db->insert('ibt_requirement_status', $data); 
    }
    redirect('User/List_Requirement');
  }

  //**LISt of Requirement **/

  public function List_Requirement()
  {

        $User_Icode =  $this->session->userdata['userid']; 
        $data['requirement']= $this->User_marketing_model->Get_All_Requirement($User_Icode);
        $this->load->view('header');
        $this->load->view('top');
        $this->load->view('left');
        $this->load->view('List_Requirement',$data, FALSE);

  }

  //** get_Requirement_Status **/

  public function get_Requirement_Status()
  {
    $type = $this->input->post('id',true);

    $data = $this->User_marketing_model->Get_Requirement_Status($type);

    $output = null;
    foreach ( $data as $row)  
            {  
                  $output .= "<option value='".$row['Req_Id']."'>".$row['Req_Name']."</option>";  
            }  

    echo $output;  
  }

  //** Search Requirements **//

  public function Search_Requirement()
  {
      $fdate = $this->input->post('fdate',true);
      $from_date = date("Y-m-d", strtotime($fdate));
      $tdate = $this->input->post('tdate',true);
      $to_date = date("Y-m-d", strtotime($tdate));
      $type = $this->input->post('type',true);
      $status = $this->input->post('Status',true);
      $User_Icode =  $this->session->userdata['userid'];
      $data = $this->User_marketing_model->Search_Requirement($from_date,$to_date,$type,$status,$User_Icode);
      //print_r($data);
      $output = null;
      $i=1;
      foreach ( $data as $row)  
        { 
          $requirement_id = $row['Requirement_Icode'];
          $req_Status = $row['Requirement_Status'];
          $rtype =$row['Requirement_Type'];

          

            if($row['Marketing_Prospect_Type'] == 'Good')
           {  

                $output .=  "<tr style='background-color:#b7f5b7;'>";
                $output .= "<td>".$i."</td>"; 
                $output .= "<td><a href='select_Requirement/$requirement_id/$req_Status/$rtype'>".$row['Company_Name']."</a></td>"; 
                $output .= "<td>".$row['Country']."</td>"; 
                $output .= "<td>".$row['Requirement_Type']."</td>"; 
                $output .= "<td>".$row['Project_Title']."</td>"; 
                $output .= "<td>".$row['Tech_Name']."</td>"; 
                $output .= "<td>".$row['User_Name']."</td>"; 
                $output .= "<td>".$row['Req_Received_Date']."</td>"; 

                if($row['Requirement_Type'] == 'Project')
                {
                   $output .= "<td>".$row['Estimation_Date']."</td>"; 
                     if( date('Y/m/d', strtotime($row['Estimation_Date'])) < date('Y/m/d', strtotime($row['Tech_Team_Date'])) )
                               {
                                  $output .= "<td style='color: red'>" .$row['Tech_Team_Date']. "</td>";
                            
                               }
                               else
                               {
                            
                                 $output .= "<td>".$row['Tech_Team_Date']."</td>";
                              
                               }
                }
                else
                {
                  $output .= "<td>".$row['Resource_Exp_Start_Date']."</td>"; 
                    if( date('Y/m/d', strtotime($row['Resource_Exp_Start_Date'])) < date('Y/m/d', strtotime($row['Tech_Team_Date'])) )
                               {
                                  $output .= "<td style='color: red'>" .$row['Tech_Team_Date']. "</td>";
                            
                               }
                               else
                               {
                            
                                 $output .= "<td>".$row['Tech_Team_Date']."</td>";
                              
                               }
                }
               
                $output .= "<td>".$row['Req_Name']."</td>";
                $output .=  "</tr>";
          }
          elseif ($row['Marketing_Prospect_Type'] == 'Above Average') 
          {
                $output .=  "<tr style='background-color:#f0e7b5;'>";
                $output .= "<td>".$i."</td>"; 
                $output .= "<td><a href='select_Requirement/$requirement_id/$req_Status/$rtype'>".$row['Company_Name']."</a></td>"; 
                $output .= "<td>".$row['Country']."</td>"; 
                $output .= "<td>".$row['Requirement_Type']."</td>"; 
                $output .= "<td>".$row['Project_Title']."</td>"; 
                $output .= "<td>".$row['Tech_Name']."</td>"; 
                $output .= "<td>".$row['User_Name']."</td>"; 
                $output .= "<td>".$row['Req_Received_Date']."</td>"; 

                if($row['Requirement_Type'] == 'Project')
                {
                   $output .= "<td>".$row['Estimation_Date']."</td>"; 
                    if( date('Y/m/d', strtotime($row['Estimation_Date'])) < date('Y/m/d', strtotime($row['Tech_Team_Date'])) )
                               {
                                  $output .= "<td style='color: red'>" .$row['Tech_Team_Date']. "</td>";
                            
                               }
                               else
                               {
                            
                                 $output .= "<td>".$row['Tech_Team_Date']."</td>";
                              
                               }
                }
                else
                {
                  $output .= "<td>".$row['Resource_Exp_Start_Date']."</td>"; 
                   if( date('Y/m/d', strtotime($row['Resource_Exp_Start_Date'])) < date('Y/m/d', strtotime($row['Tech_Team_Date'])) )
                               {
                                  $output .= "<td style='color: red'>" .$row['Tech_Team_Date']. "</td>";
                            
                               }
                               else
                               {
                            
                                 $output .= "<td>".$row['Tech_Team_Date']."</td>";
                              
                               }
                }
            
                $output .= "<td>".$row['Req_Name']."</td>";
                $output .=  "</tr>";
           
          }
          else
          {
              $output .=  "<tr>";
                $output .= "<td>".$i."</td>"; 
                $output .= "<td><a href='select_Requirement/$requirement_id/$req_Status/$rtype'>".$row['Company_Name']."</a></td>"; 
                $output .= "<td>".$row['Country']."</td>"; 
                $output .= "<td>".$row['Requirement_Type']."</td>"; 
                $output .= "<td>".$row['Project_Title']."</td>"; 
                $output .= "<td>".$row['Tech_Name']."</td>"; 
                $output .= "<td>".$row['User_Name']."</td>"; 
                $output .= "<td>".$row['Req_Received_Date']."</td>"; 

                if($row['Requirement_Type'] == 'Project')
                {
                   $output .= "<td>".$row['Estimation_Date']."</td>"; 

                               if( date('Y/m/d', strtotime($row['Estimation_Date'])) < date('Y/m/d', strtotime($row['Tech_Team_Date'])) )
                               {
                                  $output .= "<td style='color: red'>" .$row['Tech_Team_Date']. "</td>";
                            
                               }
                               else
                               {
                            
                                 $output .= "<td>".$row['Tech_Team_Date']."</td>";
                              
                               }
                }
                else
                {
                  $output .= "<td>".$row['Resource_Exp_Start_Date']."</td>"; 

                               if( date('Y/m/d', strtotime($row['Resource_Exp_Start_Date'])) < date('Y/m/d', strtotime($row['Tech_Team_Date'])) )
                               {
                                  $output .= "<td style='color: red'>" .$row['Tech_Team_Date']. "</td>";
                            
                               }
                               else
                               {
                            
                                 $output .= "<td>".$row['Tech_Team_Date']."</td>";
                              
                               }
                }
               
                $output .= "<td>".$row['Req_Name']."</td>";
                $output .=  "</tr>";
          }


          $i++;
        }

       echo $output; 

  }

  //** Select Perticular Client **//

  public function select_Requirement($reqid,$status,$type)
  {

       $Req_id = $reqid;
       $status = $status;
       $Type = $type;

       $data['Prospect_details'] = $this->User_marketing_model->Select_Req_company($Req_id);

       $data['requirement'] = $this->User_marketing_model->Select_Requirement($Req_id);
       
       $data['Req_Status'] = $this->User_marketing_model->Select_Requirement_Status($Type,$status);

       $data['leader_cmd'] = $this->User_marketing_model->Select_Leader_Comments($Req_id);

       $data['Project_Type'] = $this->User_marketing_model->Select_Project_Type();

       $data['Contract_Type'] = $this->User_marketing_model->Select_Contract_Type();

       $data['Client_Reason'] = $this->User_marketing_model->Select_Client_Reason();

       $data['Our_Reason'] = $this->User_marketing_model->Select_Our_Reason();

       $data['Lost_details'] = $this->User_marketing_model->Select_Lost_Details($Req_id);

       $data['Won_details'] = $this->User_marketing_model->Select_Won_Details($Req_id);
        //print_r($data['Lost_details']);

       if(empty($data['Lost_details']))
       {
        //print_r("empty");
       }
       else
       {
         if(!empty($data['Lost_details']))
       {
       $reason = $data['Lost_details']['Lost_Reason'];
       $type = $data['Lost_details']['Lost_Type'];
       $lost_Reason= trim($reason,",");
       $Lost = explode(',', $lost_Reason);
       $count = count($Lost);
        if($type == 'Client')
        {
             for($i=0; $i<$count;$i++)
             {
                $lost_id = $Lost[$i];
                $reasons[] = $this->User_marketing_model->Select_Lost_Reason_Client($lost_id);             }      
        }
        else
        {
             for($i=0; $i<$count;$i++)
             {
                $lost_id = $Lost[$i];
               $reasons[] = $this->User_marketing_model->Select_Lost_Reason_Our($lost_id);
             }   
          
        }  
       }
        $data['lost_reason'] = $reasons;
       }     

        $this->load->view('header');
        $this->load->view('top');
        $this->load->view('left');
        $this->load->view('View_Requirement',$data, FALSE);


       // $full_data = array('requirement' => $data,
       //                   'Status' => $status,
       //                    'leader_cmd' => $leader_cmd );
       // echo  json_encode($full_data);


  }  

   //**  Save Comments **/

  public function save_Comments()
  {
       $User_Icode =  $this->session->userdata['userid'];
       $data = array('Prospect_Icode' => $this->input->post('Pros_code',true),
                      'Requirement_Icode' => $this->input->post('Req_id',true),
                     'Requirement_Status' => $this->input->post('Req_status',true),
                     'Req_Comments' => $this->input->post('Pcmd',true),
                     'Tech_Leader_Code' => $this->input->post('Leader_Code',true),
                     'BDE_Code' => $User_Icode  );
       $this->db->insert('ibt_requirement_status', $data); 
       return 1;

  }

  //** Save Comments and Status **/

  public function save_Status_Comments()
  {
       $User_Icode =  $this->session->userdata['userid'];
       $req_id = $this->input->post('Req_id',true);
       $current_timestamp = date('Y-m-d H:i:s');
       $data = array('Prospect_Icode' => $this->input->post('Pros_code',true),
                      'Requirement_Icode' => $this->input->post('Req_id',true),
                     'Requirement_Status' => $this->input->post('Nstatus',true),
                     'Req_Comments' => $this->input->post('Pcmd',true),
                     'Tech_Leader_Code' => $this->input->post('Leader_Code',true),
                     'BDE_Code' => $User_Icode  );
       $this->db->insert('ibt_requirement_status', $data); 

        $data_update = array('Requirement_Status' => $this->input->post('Nstatus',true),
                             'Modified_On' => $current_timestamp );
         $this->db->where('Requirement_Icode',$req_id);
         $this->db->update('ibt_requirement_master', $data_update);
         echo 1;
        
  }

  //** Project Save **/

  public function Save_Project_Won()
  {
     $User_Icode =  $this->session->userdata['userid'];
     $req_id = $this->input->post('Req_id',true);
     $current_timestamp = date('Y-m-d H:i:s');
     $data = array(  'Prospect_Icode' => $this->input->post('Pros_code',true),
                     'Requirement_Icode' => $this->input->post('Req_id',true),
                     'Requirement_Status' => $this->input->post('Nstatus',true),
                     'Req_Comments' => $this->input->post('Pcmd',true),
                     'Tech_Leader_Code' => $this->input->post('Leader_Code',true),
                     'BDE_Code' => $User_Icode  );
     $insert_status = $this->User_marketing_model->Save_Status($data);

    // $this->db->insert('ibt_requirement_status', $data);

     if($insert_status == '1')
     {
        $data_update = array('Requirement_Status' => $this->input->post('Nstatus',true),
                            'Modified_On' => $current_timestamp );

         $this->db->where('Requirement_Icode',$req_id);
         $this->db->update('ibt_requirement_master', $data_update);
     }
     else
     {
      echo "0";
     }

     $data_won =  array(   'Prospect_Icode' => $this->input->post('Pros_code',true),
                           'Requirement_Icode' => $this->input->post('Req_id',true),
                           'Estimate_Hour' => $this->input->post('Project_Hours',true),
                           'Project_Type' => $this->input->post('Ptype',true),
                           'Tech_Leader_Code' => $this->input->post('Leader_Code',true),
                           'Contract_Type' => $this->input->post('CType',true),
                           'Project_Price' => $this->input->post('Project_price',true),
                           'Price_Code' => $this->input->post('symbol',true),
                           'BDE_Code' => $User_Icode  );
     $insert_Won = $this->User_marketing_model->Save_Project_Won($data_won);
     echo 1;
     


   }

   //** Save Project Client Lost **/
   public function Save_Project_Client_Lost()
   {
         $User_Icode =  $this->session->userdata['userid'];
         $req_id = $this->input->post('Req_id',true);
         $current_timestamp = date('Y-m-d H:i:s');

         $type = $this->input->post('Reason',true);
         $lost_Reason= trim($type,",");
         $data = array(  'Prospect_Icode' => $this->input->post('Pros_code',true),
                         'Requirement_Icode' => $this->input->post('Req_id',true),
                         'Requirement_Status' => $this->input->post('Nstatus',true),
                         'Req_Comments' => $this->input->post('Pcmd',true),
                         'Tech_Leader_Code' => $this->input->post('Leader_Code',true),
                         'BDE_Code' => $User_Icode  );
         $insert_status = $this->User_marketing_model->Save_Status($data);
                if($insert_status == '1')
           {
                $data_update = array('Requirement_Status' => $this->input->post('Nstatus',true),
                                    'Modified_On' => $current_timestamp );

                 $this->db->where('Requirement_Icode',$req_id);
                 $this->db->update('ibt_requirement_master', $data_update);
           }
           else
           {
                echo "0";
           }

           $data_lost =  array(   'Prospect_Icode' => $this->input->post('Pros_code',true),
                                 'Requirement_Icode' => $this->input->post('Req_id',true),
                                 'Lost_Type' => $this->input->post('Type',true),
                                 'Lost_Reason' => $lost_Reason,
                                 'Lost_Comments' =>$this->input->post('Pcmd',true),
                                
                                 'BDE_Code' => $User_Icode  );
           $insert_Won = $this->User_marketing_model->Save_Project_Lost($data_lost);
           echo 1;

    }

    //** Our Side Project LOss **/
    public function Save_Project_Our_Lost()
    {
         $User_Icode =  $this->session->userdata['userid'];
         $req_id = $this->input->post('Req_id',true);
         $current_timestamp = date('Y-m-d H:i:s');

         $type = $this->input->post('Reason',true);
         $lost_Reason= trim($type,",");
         $data = array(  'Prospect_Icode' => $this->input->post('Pros_code',true),
                         'Requirement_Icode' => $this->input->post('Req_id',true),
                         'Requirement_Status' => $this->input->post('Nstatus',true),
                         'Req_Comments' => $this->input->post('Pcmd',true),
                         'Tech_Leader_Code' => $this->input->post('Leader_Code',true),
                         'BDE_Code' => $User_Icode  );
         $insert_status = $this->User_marketing_model->Save_Status($data);
                if($insert_status == '1')
           {
                $data_update = array('Requirement_Status' => $this->input->post('Nstatus',true),
                                    'Modified_On' => $current_timestamp );

                 $this->db->where('Requirement_Icode',$req_id);
                 $this->db->update('ibt_requirement_master', $data_update);
           }
           else
           {
                echo "0";
           }

           $data_lost =  array(   'Prospect_Icode' => $this->input->post('Pros_code',true),
                                 'Requirement_Icode' => $this->input->post('Req_id',true),
                                 'Lost_Type' => $this->input->post('Type',true),
                                 'Lost_Reason' => $lost_Reason,
                                 'Lost_Comments' =>$this->input->post('Pcmd',true),
                                
                                 'BDE_Code' => $User_Icode  );
           $insert_Won = $this->User_marketing_model->Save_Project_Lost($data_lost);
           echo 1;
    }

        

}