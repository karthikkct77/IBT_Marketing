<?php
class Marketing_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /* * LOGIN**/       

    public function login($data)
    {
        $uname = $data['user_name'];
        $pwd = $data['password'];
        $query= $this->db->query("SELECT * FROM ibt_marketing_user  WHERE User_Login = '".$uname."'  AND User_Password = '".$pwd."' ");
      
         if($query->num_rows() == 1)
         {
            $row = $query->row();
            $data = array(
            'userid' => $row->User_Icode,
            'fname' => $row->User_Name,
            'username' => $row->User_Login,
            'active' =>$row->User_Leave_Approval_Rights,
            'gender' =>$row->User_Gender,
            'validated' => true
            );
            $this->session->set_userdata($data);
            return 1;
         }
         else
         {
          $result = $this->db->query("SELECT * FROM ibt_marketing_admin  WHERE Marketing_Admin = '".$uname."'  AND Marketing_Admin_pwd = '".$pwd."' ");

                if($result->num_rows() == 1)
                {
                    $row =  $result->row();
                    $data = array(  'Admin_userid' => $row->ibt_marketing_icode,
                                    'fname' => $row->Marketing_Admin,
                                    'validated' => true );
                    $this->session->set_userdata($data);
                    return 2;
                }
                else
                {
                    return 0;
                }
         }
    }

    /** Add Excel Data **/
    public function Add_excel($data_user)
    {
          $this->db->insert('ibt_prospect_data', $data_user);
    }

    public function check_excel($data_user)
    {
        $cname = $data_user['Company_Name'];
        $url = $data_user['WebURL'];
        $contact = $data_user['Company_Contact'];
        $query=$this->db->query("SELECT * FROM ibt_prospect_data WHERE Company_Name = '". $cname."' OR  WebURL = '". $url."' OR Company_Contact = '". $contact."' ");
        $row = $query->num_rows();
        if($row >= 1)
        {
        return $query->row_array(0);
        }
        else
        {

        }

   }

     public function check_excel_reference($data_user)
    {
        $cname = $data_user['Company_Name'];
        $url = $data_user['WebURL'];
        $contact = $data_user['Company_Contact'];
        $country = $data_user['Country'];
        $Ref = $data_user['Reference'];
        $query=$this->db->query("SELECT * FROM ibt_prospect_data WHERE Company_Name = '". $cname."' OR  WebURL = '". $url."' OR Company_Contact = '". $contact."' OR Country = '". $country." '  ");
        // echo $this->db->last_query();
        $row = $query->num_rows();
        if($row >= 1)
        {
            $sql = $this->db->query("UPDATE  ibt_prospect_data SET Reference = '$Ref'  WHERE Company_Name = '". $cname."' OR  WebURL = '". $url."' OR Company_Contact = '". $contact."' OR Country = '". $country." '  ");
            //echo $this->db->last_query();      
        }
        else
        {

        }

   }
    
    
    /** GET DUPLICATE DATA **/

   public function get_duplicate($duplicate_data)
   {
        $query=$this->db->query("SELECT * FROM ibt_prospect_data WHERE Prospect_Icode = '".$duplicate_data."' ");
        return $query->row_array(0);
   }
   
   /** Excel DATA Update **/
   public function Add_excel_update($arr_data)
   {
            foreach($arr_data as $a){
            $data = array(
            'Company_Name'=>$a['Company_Name'],
            'WebURL'=>$a['WebURL'] ,
            'Address'=>$a['Address'] , 
            'Company_Contact'=>$a['Company_Contact'] ,
            'Company_Email' => $a['Company_Email'],
            'Has_Branches' => $a['Has_Branches'],
            'Has_Office_In_India' => $a['Has_Office_In_India'],
            'Building_Type' => $a['Building_Type'],
            'City' => $a['City'],
            'State' => $a['State'],
            'Country' => $a['Country'],
            'FB_URL' => $a['FB_URL'],
            'LinkedIn_URL' => $a['LinkedIn_URL'],
            'Time_Zone' => $a['Time_Zone'],
            'PC_Name' => $a['PC_Name'],
            'PC_Desig' => $a['PC_Desig'],
            'PC_Email' => $a['PC_Email'],
            'PC_Phone' => $a['PC_Phone'],
            'SC_Name' => $a['SC_Name'],
            'SC_Desig' => $a['SC_Desig'],
            'SC_Email' => $a['SC_Email'],
            'SC_Phone' => $a['SC_Phone'],
            'Career_Section' => $a['Career_Section'],
            'Emp_Count' => $a['Emp_Count'],
            'Prospect_Type' => $a['Prospect_Type'],
            'Product_Development' => $a['Product_Development'],
            'Products_Count' => $a['Products_Count'],
            'Domain' => $a['Domain'],
            'Custom_Development' => $a['Custom_Development'],
            'Web_Development' => $a['Web_Development'],
            'Mobile_Development' => $a['Mobile_Development'],
            'Ecommerce_Development' => $a['Ecommerce_Development'],
            'Tech_Skills' => $a['Tech_Skills'],
            'Data_Loaded_By' => $this->session->userdata['fname']
            );
            $this->db->insert('ibt_prospect_data', $data); 
                }
                return 0;
   }

  /** Data Country **/
   public function Data_Country()
   {
     $query=$this->db->query("SELECT DISTINCT(Country) FROM ibt_prospect_data ");
     return $query->result_array();
   }
   /** Data Country DND **/
     public function Data_Country_DND()
   {
     $query=$this->db->query("SELECT DISTINCT(Country) FROM ibt_prospect_data  where prospectData_Blocked_Type !='No' ");
     return $query->result_array();
   }
   /** Data Country Correction **/
     public function Data_Country_Correction()
   {
     $query=$this->db->query("SELECT DISTINCT(B.Country)  FROM prospect_dataupdate_log A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Prospect_Data_Edit_Approved = 'No' ");
     return $query->result_array();
   }
   /** Country Based DATA **/
   public function Country_Based_Data($country)
   {
     $query=$this->db->query("SELECT *  FROM prospect_dataupdate_log A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Prospect_Data_Edit_Approved = 'No' and Country = '$country' ");
     return $query->result_array();
   }
    public function Data_State()
    {
         $query=$this->db->query("SELECT DISTINCT(State) FROM ibt_prospect_data ");
     return $query->result_array();
    }
     public function Data_City()
    {
         $query=$this->db->query("SELECT DISTINCT(City) FROM ibt_prospect_data ");
     return $query->result_array();
    }
     public function Data_Timezone()
    {
         $query=$this->db->query("SELECT DISTINCT(Time_Zone) FROM ibt_prospect_data ");
     return $query->result_array();
    }
     public function Data_Emp_count()
    {
         $query=$this->db->query("SELECT DISTINCT(Emp_Count) FROM ibt_prospect_data ");
     return $query->result_array();
    }
     public function Data_product()
    {
         $query=$this->db->query("SELECT DISTINCT(Product_Development) FROM ibt_prospect_data ");
     return $query->result_array();
    }
     public function Data_pros_type()
    {
         $query=$this->db->query("SELECT DISTINCT(Prospect_Type) FROM ibt_prospect_data ");
     return $query->result_array();
    }
     public function Data_custom()
    {
         $query=$this->db->query("SELECT DISTINCT(Custom_Development) FROM ibt_prospect_data ");
     return $query->result_array();
    }
     public function Data_web()
    {
         $query=$this->db->query("SELECT DISTINCT(Web_Development) FROM ibt_prospect_data ");
     return $query->result_array();
    }
     public function Data_Ecomm()
    {
         $query=$this->db->query("SELECT DISTINCT(Ecommerce_Development) FROM ibt_prospect_data ");
     return $query->result_array();
    }

     public function Data_mobile()
    {
         $query=$this->db->query("SELECT DISTINCT(Mobile_Development) FROM ibt_prospect_data ");
     return $query->result_array();
    }

    public function get_all_BDE()
    {
         $query=$this->db->query("SELECT * FROM ibt_marketing_user ");
     return $query->result_array();
    }

    /** Get BDE Count **/
    public function get_BDE_data_count($cname,$bcode)
    {
    $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE Country = '$cname' and Current_BDE_User_Code = '$bcode' ");
    return $query->result_array();
    }

    /** Get BDE Count  RE-Allocate**/
    public function get_BDE_data_count_Reallocate($cname,$bcode)
    {
        $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE Country = '$cname' and Current_BDE_User_Code = '$bcode' and Review_Status='Yes' ");
        return $query->result_array();
    }
    /** Get BDE Count  New Details**/
    public function get_BDE_New_details($cname,$bcode)
    {
    $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE Country = '$cname' and Current_BDE_User_Code = '$bcode' and Prospect_Status = 'New' and Review_Status='Yes' ");
        return $query->result_array();
    }
    /** Get BDE Count  New**/
    public function get_BDE_New_count($cname,$bcode)
    {
    $query=$this->db->query("SELECT COUNT(Prospect_Icode),Country FROM `ibt_prospect_data` WHERE Country = '$cname' and Current_BDE_User_Code = '$bcode' and Prospect_Status = 'New'  ");
        return $query->row_array(0);
    }
    /** Get BDE Count  New Count Details**/
    public function get_BDE_New_count_Reallocate($cname,$bcode)
    {
    $query=$this->db->query("SELECT COUNT(Prospect_Icode),Country FROM `ibt_prospect_data` WHERE Country = '$cname' and Current_BDE_User_Code = '$bcode' and Prospect_Status = 'New' and Review_Status='Yes' ");
        return $query->row_array(0);
    }

    //*  Start : COLD COUNT & DETAILS *//
    public function get_BDE_cold_count($cname,$bcode)
    {
    $query=$this->db->query("SELECT COUNT(Prospect_Icode),Country FROM `ibt_prospect_data` WHERE Country = '$cname' and Current_BDE_User_Code = '$bcode' and Prospect_Status = 'Cold'  ");
        return $query->row_array(0);
    }
    public function get_BDE_cold_count_Reallocate($cname,$bcode)
    {
    $query=$this->db->query("SELECT COUNT(Prospect_Icode),Country FROM `ibt_prospect_data` WHERE Country = '$cname' and Current_BDE_User_Code = '$bcode' and Prospect_Status = 'Cold' and Review_Status='Yes' ");
        return $query->row_array(0);
    }
    public function get_BDE_cold_details($cname,$bcode)
    {
    $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE Country = '$cname' and Current_BDE_User_Code = '$bcode' and Prospect_Status = 'Cold' and Review_Status='Yes' ");
        return $query->result_array();
    }
    //*  End : COLD COUNT & DETAILS *//

    /** Start:  BDE WARM **/
    public function get_BDE_warm_count($cname,$bcode)
    {
    $query=$this->db->query("SELECT COUNT(Prospect_Icode) ,Country FROM `ibt_prospect_data` WHERE Country = '$cname' and Current_BDE_User_Code = '$bcode' and Prospect_Status = 'Warm'  ");
        return $query->row_array(0);
    }
    public function get_BDE_warm_count_Reallocate($cname,$bcode)
    {
    $query=$this->db->query("SELECT COUNT(Prospect_Icode) ,Country FROM `ibt_prospect_data` WHERE Country = '$cname' and Current_BDE_User_Code = '$bcode' and Prospect_Status = 'Warm' and Review_Status='Yes' ");
        return $query->row_array(0);
    }
    public function get_BDE_warm_details($cname,$bcode)
    {
    $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE Country = '$cname' and Current_BDE_User_Code = '$bcode' and Prospect_Status = 'Warm' ");
        return $query->result_array();
    }
    //* END: BDE WARM *//

    //** Start: Get BDE HOT **/
    public function get_BDE_hot_count($cname,$bcode)
    {
    $query=$this->db->query("SELECT COUNT(Prospect_Icode),Country FROM `ibt_prospect_data` WHERE Country = '$cname' and Current_BDE_User_Code = '$bcode' and Prospect_Status = 'Hot' ");
        return $query->row_array(0);
    }
    public function get_BDE_hot_count_Reallocate($cname,$bcode)
    {
    $query=$this->db->query("SELECT COUNT(Prospect_Icode),Country FROM `ibt_prospect_data` WHERE Country = '$cname' and Current_BDE_User_Code = '$bcode' and Prospect_Status = 'Hot' and Review_Status='Yes' ");
        return $query->row_array(0);
    }
    public function get_BDE_hot_details($cname,$bcode)
    {
    $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE Country = '$cname' and Current_BDE_User_Code = '$bcode' and Prospect_Status = 'Hot' ");
      return $query->result_array();
    }
    //* END: Get BDE HOT  *//

    //** Total BDE Count **/
    public function total_BDE_data_count($bcode)
    {
        $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code = '$bcode' ");
        return $query->row_array(0);
    }

    public function total_BDE_data_count_Reallocate($bcode)
    {
        $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code = '$bcode' and Review_Status='Yes' ");
        return $query->row_array(0);
    }

    //** Start : total BDE New Count **/
    public function total_BDE_New_count($bcode)
    {
    $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE Current_BDE_User_Code = '$bcode' and Prospect_Status = 'New' ");
        return $query->row_array(0);
    }
    public function total_BDE_New_count_Reallocate($bcode)
    {
    $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE Current_BDE_User_Code = '$bcode' and Prospect_Status = 'New' and Review_Status='Yes' ");
        return $query->row_array(0);
    }
    //** End : total BDE New Count **/

    //** Start : total BDE Cold Count **/
    public function total_BDE_cold_count($bcode)
    {
    $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE Current_BDE_User_Code = '$bcode' and Prospect_Status = 'Cold' ");
        return $query->row_array(0);
    }
    public function total_BDE_cold_count_Reallocate($bcode)
    {
    $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE Current_BDE_User_Code = '$bcode' and Prospect_Status = 'Cold' and Review_Status='Yes' ");
        return $query->row_array(0);
    }
    //** End : total BDE Cold Count **/

    //** Start : total BDE Warm Count **/
    public function total_BDE_warm_count($bcode)
    {
    $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code = '$bcode' and Prospect_Status = 'Warm' ");
        return $query->row_array(0);
    }

    public function total_BDE_warm_count_Reallocate($bcode)
    {
    $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code = '$bcode' and Prospect_Status = 'Warm'  and Review_Status='Yes' ");
        return $query->row_array(0);
    }
    //** End : total BDE Warm Count **/

    //** Start : total BDE HOT Count **/
    public function total_BDE_hot_count($bcode)
    {
    $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code = '$bcode' and Prospect_Status = 'Hot' ");
        return $query->row_array(0);
    }
    public function total_BDE_hot_count_Reallocate($bcode)
    {
    $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code = '$bcode' and Prospect_Status = 'Hot'  and Review_Status='Yes'  ");
        return $query->row_array(0);
    }
     //** End : total BDE HOT Count **/

    public function get_country_state($id)
    {
         $query=$this->db->query("SELECT DISTINCT(State) FROM ibt_prospect_data where Country ='$id' ");
          return $query->result();  
    }

    /** State based City **/
    public function get_state_city($id)
    {
        $query=$this->db->query("SELECT DISTINCT(City) FROM ibt_prospect_data where State = '$id' "); 
        return $query->result();  
    }
    
    /** Search DATA **/
    public function get_country_data($key)
   {
        $country = $key['country'];
        $state = $key['state'];
        $City = $key['City'];
        $Time = $key['Time'];
        $Count = $key['Count'];
        $Type = $key['Type'];
        $Product = $key['Product'];
        $Custom = $key['Custom'];
        $Web = $key['Web'];
        $Mobile = $key['Mobile'];
        $Commerce = $key['Commerce'];

        if(!empty($country))
        {
            $data1 = "Country = '$country' AND";
        }else{
            $data1 = "";
        }
        if(!empty($state))
        {
            $data2 = "State = '$state' AND";
        }else{
            $data2 = "";
        }

        if(!empty($City))
        {
            $data3 = "City = '$City' AND";
        }else{
            $data3 = "";
        }
        if(!empty($Time))
        {
            $data4 = "Time_Zone = '$Time' AND";
        }else{
            $data4 = "";
        }
        if(!empty($Count))
        {
            $data5 = "Emp_Count = '$Count' AND";
        }else{
            $data5 = "";
        }
        if(!empty($Type))
        {
            $data6 = "Prospect_Type = '$Type' AND";
        }else{
            $data6 = "";
        }
        if(!empty($Product))
        {
            $data7 = "Product_Development = '$Product' AND";
        }else{
            $data7 = "";
        }
        if(!empty($Custom))
        {
            $data8 = "Custom_Development = '$Custom' AND";
        }else{
            $data8 = "";
        }
        if(!empty($Web))
        {
            $data9 = "Web_Development = '$Web' AND";
        }else{
            $data9 = "";
        }
        if(!empty($Mobile))
        {
            $data10 = "Mobile_Development = '$Mobile' AND";
        }else{
            $data10 = "";
        }
        if(!empty($Commerce))
        {
            $data11 = "Ecommerce_Development = '$Commerce' ";
        }else{
            $data11 = "";
        }

        $main_string = " AND $data1 $data2 $data3 $data4 $data5 $data6 $data7 $data8 $data9 $data10 $data11  "; //All details

        $stringAnd = "AND"; //And

        $main_string = trim($main_string); //Remove whitespaces from the beginning and end of the main string

        $endAnd = substr($main_string, -3); //Gets the AND at the end

        if($stringAnd == $endAnd)
        {
        $main_string = substr($main_string, 0, -3);
        }else if($main_string == "AND"){
            $main_string = "";
        }
        else{
            $main_string = " AND $data1 $data2 $data3 $data4 $data5 $data6 $data7 $data8 $data9 $data10 $data11 ";
        }

        if($main_string == ""){ //Doesn't show all the products

        }else
        {

             $query=$this->db->query("SELECT COUNT(*) FROM ibt_prospect_data WHERE Prospect_Status ='New' and Current_BDE_User_Code = '0' and prospectData_Blocked_Type = 'No' $main_string ");

            if ($res = $query->num_rows()) 
            {
                /* Check the number of rows that match the SELECT statement */
                if ($res > 0) 
                {
                    $query=$this->db->query("SELECT * FROM ibt_prospect_data WHERE Prospect_Status ='New' and Current_BDE_User_Code = '0' and prospectData_Blocked_Type = 'No' $main_string");
                    return $query->result_array();

                }    /* No rows matched -- do something else */
                else 
                {
                    return 0;
                }
             }
        }
        $res = null;
    }

    //*8 EXCEL DATA ADD **/
    public function Add_excel1($data_user)
    {
      $this->db->insert('ibt_test', $data_user);
    }

    /** GET ANALYSIS DATA **/
   public function get_prospect_Analysis_Data($id)
   {
      $query=$this->db->query("SELECT B.prospect_prospect_icode , GROUP_CONCAT(DISTINCT B.prospect_Domain_Icode) as Domain_Icode,GROUP_CONCAT(DISTINCT D.prospect_Industry_Icode) as industry_icode ,GROUP_CONCAT(DISTINCT C.Domain_Name) as domain,GROUP_CONCAT(DISTINCT E.Industries_Name) as Industry_Name ,A.Prospect_Icode,A.Company_Name,A.WebURL,A.Country,A.Marketing_Prospect_Type,A.prospect_Category,A.Marketing_Services,A.Marketing_Approch FROM ibt_prospect_data A INNER JOIN ibt_prospect_domain B on A.Prospect_Icode = B.prospect_prospect_icode  inner JOIN domain_data C on C.Domain_Icode = B.prospect_Domain_Icode INNER JOIN ibt_prospect_industry D on B.prospect_prospect_icode = D.prospect_prospect_icode INNER JOIN industries_data E on D.prospect_Industry_Icode=E.Industries_Icode  WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Marketing_Prospect_Type != '0' and   A.Review_Status = 'No' and B.User_Icode = '$id' and D.User_Icode ='$id'  GROUP BY B.prospect_prospect_icode,D.prospect_prospect_icode");
      return $query->result_array();
   }


   /** BDE Country Based  Count Analysis Data **/
   public function BDE_data_Analysis_Count($id)
   {
    $query=$this->db->query("SELECT Country ,COUNT(*) FROM ibt_prospect_data WHERE Current_BDE_User_Code ='$id' and Prospect_Analysis_BDE_Code ='$id' and Review_Status = 'No' and prospectData_Blocked_Type = 'No' GROUP BY Country");
    //echo $this->db->last_query();
     return $query->result_array();
   }

   public function get_All_Analysis_Data($c,$id)
   {

     $query=$this->db->query("SELECT B.prospect_prospect_icode , GROUP_CONCAT(DISTINCT B.prospect_Domain_Icode) as Domain_Icode,GROUP_CONCAT(DISTINCT D.prospect_Industry_Icode) as industry_icode ,GROUP_CONCAT(DISTINCT C.Domain_Name) as domain,GROUP_CONCAT(DISTINCT E.Industries_Name) as Industry_Name ,A.Prospect_Icode,A.Company_Name,A.WebURL,A.Country,A.Marketing_Prospect_Type,A.prospect_Category,A.Marketing_Services,A.Marketing_Approch,A.Prospect_Analysis_BDE_Code FROM ibt_prospect_data A INNER JOIN ibt_prospect_domain B on A.Prospect_Icode = B.prospect_prospect_icode  inner JOIN domain_data C on C.Domain_Icode = B.prospect_Domain_Icode INNER JOIN ibt_prospect_industry D on B.prospect_prospect_icode = D.prospect_prospect_icode INNER JOIN industries_data E on D.prospect_Industry_Icode=E.Industries_Icode  WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Analysis_BDE_Code ='$id' and A.Marketing_Prospect_Type != '0' and A.Country ='$c' and  A.Review_Status = 'No' and B.User_Icode = '$id' and D.User_Icode ='$id'  GROUP BY B.prospect_prospect_icode,D.prospect_prospect_icode");
       return $query->result_array();
    
   }


    public function Get_Industry_Details()
    {
        $query=$this->db->query("SELECT * FROM Industries_Data where Industries_Icode !='0' ");
        return $query->result_array();
    }

    public function Get_Domain_Details()
    {
      $query=$this->db->query("SELECT * FROM domain_data where Domain_Icode !='0' ");
      return $query->result_array();
    }
    public function insert_Domain_Data($data)
    {
      $this->db->insert('ibt_prospect_domain', $data); 
      return 1;
    }

    public function insert_Industry_Data($data)
    {
      $this->db->insert('ibt_prospect_industry', $data); 
      return 1;
    }

    //** RE-ALLOATE USER **/
    public function get_all_BDE_ReAllote($id)
    {
    $query=$this->db->query("SELECT * FROM ibt_marketing_user where User_Icode !='$id' ");
    return $query->result_array();
    }


    /** START:  GET ALL YET DATA TO RE_ALLOCATE **/

    public function get_All_Yet_Data_New($country,$id)
    {

     $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'New' ");
      return $query->result_array();
    }
    public function get_All_Yet_Data_New_Product($country,$id)
    {

     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as product  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'New' and prospect_Category='Product&Services' ");
       return $query->row_array(0);
    }
    public function get_All_Yet_Data_New_Product_details($country,$id)
    {

     $query=$this->db->query("SELECT *  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'New' and prospect_Category='Product&Services' ");
        return $query->result_array();
    }
    public function get_All_Yet_Data_New_Service($country,$id)
    {

     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as services  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'New' and prospect_Category='Services'  ");
       return $query->row_array(0);
    }
    public function get_All_Yet_Data_New_Service_details($country,$id)
    {

     $query=$this->db->query("SELECT *  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'New' and prospect_Category='Services'  ");
          return $query->result_array();
    }
    public function get_All_Yet_Data_New_custom($country,$id)
    {

     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as custom  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'New' and   Custom_Development ='1'  ");
       return $query->row_array(0);
    }
    public function get_All_Yet_Data_New_custom_details($country,$id)
    {

     $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'New' and   Custom_Development ='1'  ");
        return $query->result_array();
    }
    public function get_All_Yet_Data_New_web($country,$id)
    {

     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as web  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'New' and   Web_Development ='1'  ");
       return $query->row_array(0);
    }
    public function get_All_Yet_Data_New_web_details($country,$id)
    {

     $query=$this->db->query("SELECT *  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'New' and   Web_Development ='1'  ");
          return $query->result_array();
    }

    public function get_All_Yet_Data_New_mobile($country,$id)
    {

     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as mobile  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'New' and Mobile_Development ='1'   ");
       return $query->row_array(0);
    }
    public function get_All_Yet_Data_New_mobile_details($country,$id)
    {

     $query=$this->db->query("SELECT *  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'New' and Mobile_Development ='1'   ");
       return $query->result_array();
    }

    public function get_All_Yet_Data_New_ec($country,$id)
    {

     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as ec  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'New' and Ecommerce_Development ='1'   ");
       return $query->row_array(0);
    }
    public function get_All_Yet_Data_New_ec_details($country,$id)
    {

     $query=$this->db->query("SELECT *  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'New' and Ecommerce_Development ='1'   ");
       return $query->result_array();
    }
   /** END : GET ALL YET DATA TO RE_ALLOCATE  **/


    /**  Start : GET ALL Cold DATA TO RE_ALLOCATE **/
    public function get_All_Cold_Product($country,$id)
    {
     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as product  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'Cold' and prospect_Category='Product&Services' ");
       return $query->row_array(0);
    }
    public function get_All_Cold_Service($country,$id)
    {
     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as services  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'Cold' and prospect_Category='Services'  ");
       return $query->row_array(0);
    }

    public function get_All_Cold_custom($country,$id)
    {

     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as custom  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'Cold' and   Custom_Development ='1'  ");
       return $query->row_array(0);
    }
    public function get_All_Cold_web($country,$id)
    {

     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as web  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'Cold' and   Web_Development ='1'  ");
       return $query->row_array(0);
    }
    public function get_Cold_mobile($country,$id)
    {

     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as mobile  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'Cold' and Mobile_Development ='1'   ");
       return $query->row_array(0);
    }
    public function get_Cold_ec($country,$id)
    {

     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as ec  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'Cold' and Ecommerce_Development ='1'   ");
       return $query->row_array(0);
    }

   //** END: GET ALL Cold DATA TO RE_ALLOCATE **/

   /**  Start : GET ALL Warm DATA TO RE_ALLOCATE **/
    public function get_All_warm_Product($country,$id)
    {
     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as product  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'Warm' and prospect_Category='Product&Services' ");
       return $query->row_array(0);
    }
    public function get_All_warm_Service($country,$id)
    {
     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as services  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'Warm' and prospect_Category='Services'  ");
       return $query->row_array(0);
    }
    public function get_All_warm_custom($country,$id)
    {
     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as custom  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'Warm' and   Custom_Development ='1'  ");
       return $query->row_array(0);
    }
    public function get_All_warm_web($country,$id)
    {
     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as web  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'Warm' and   Web_Development ='1'  ");
       return $query->row_array(0);
    }
    public function get_warm_mobile($country,$id)
    {
     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as mobile  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'Warm' and Mobile_Development ='1'   ");
       return $query->row_array(0);
    }
    public function get_warm_ec($country,$id)
    {

     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as ec  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'Warm' and Ecommerce_Development ='1'   ");
       return $query->row_array(0);
    }

    //** END: GET ALL Warm DATA TO RE_ALLOCATE **/


    /**  Start : GET ALL HOT DATA TO RE_ALLOCATE **/

    public function get_All_hot_Product($country,$id)
    {

     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as product  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'Warm' and prospect_Category='Product&Services' ");
       return $query->row_array(0);
    }

    public function get_All_hot_Service($country,$id)
    {

     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as services  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'Warm' and prospect_Category='Services'  ");
       return $query->row_array(0);
    }

    public function get_All_hot_custom($country,$id)
    {

     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as custom  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'Warm' and   Custom_Development ='1'  ");
       return $query->row_array(0);
    }
    public function get_All_hot_web($country,$id)
    {

     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as web  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'Warm' and   Web_Development ='1'  ");
       return $query->row_array(0);
    }
    public function get_hot_mobile($country,$id)
    {

     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as mobile  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'Warm' and Mobile_Development ='1'   ");
       return $query->row_array(0);
    }
    public function get_hot_ec($country,$id)
    {

     $query=$this->db->query("SELECT COUNT(Prospect_Icode) as ec  FROM `ibt_prospect_data` WHERE Country = '$country' and Current_BDE_User_Code = '$id' and Prospect_Status = 'Warm' and Ecommerce_Development ='1'   ");
       return $query->row_array(0);
    }

    //** END : GET ALL HOT DATA TO RE_ALLOCATE**/

    //** GET DND *//
    public function Get_DND()
    {
        $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN ibt_marketing_user B on A.prospectData_Blocked_BDE_Code = B.User_Icode WHERE prospectData_Blocked_Type = 'DND'  ORDER by prospectData_Blocked_Date  DESC ");
       return $query->result_array();
    }

    //** SEARCH DND,CNE**/
    public function Search_DND_CNE_details($data)
    {

         $country = $data['country'];

         if($country == 'No')
         {
            $country1 = "";
         }
         else
         {
            $country1 = $country;
         }
        $type = $data['prospectData_Blocked_Type'];

        if(!empty($country1))
        {
            $data1 = "Country = '$country1' AND";
        }
        else
        {
            $data1 = "";
        }
        if(!empty($type))
        {
            $data2 = "prospectData_Blocked_Type = '$type' ";
        }
        else
        {
            $data2 = "";
        }

        $main_string = " AND $data1 $data2 "; //All details

        $stringAnd = "AND"; //And

        $main_string = trim($main_string); //Remove whitespaces from the beginning and end of the main string

        $endAnd = substr($main_string, -3); //Gets the AND at the end

        if($stringAnd == $endAnd)
        {
        $main_string = substr($main_string, 0, -3);
        }
        else if($main_string == "AND")
        {
            $main_string = "";
        }
        else
        {
            $main_string = " $data1 $data2 ";
        }

        if($main_string == ""){ //Doesn't show all the products

        }
        else
        {

             $query=$this->db->query("SELECT COUNT(*) FROM ibt_prospect_data WHERE  $main_string ORDER by prospectData_Blocked_Date  DESC ");
             //echo $this->db->last_query();
            if ($res = $query->num_rows())
             {

                /* Check the number of rows that match the SELECT statement */
                if ($res > 0) 
                {
                  // $query=$this->db->query("SELECT * FROM ibt_prospect_data WHERE Prospect_Status ='Cold' and Current_BDE_User_Code = '$id' and Prospect_DND = 'No' and Prospect_CNE='No' $main_string LIMIT 0,1");

                 $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN ibt_marketing_user B on A.prospectData_Blocked_BDE_Code = B.User_Icode WHERE $main_string  ORDER by prospectData_Blocked_Date  DESC ");
                    return $query->result_array();
                }    /* No rows matched -- do something else */
                else 
                {
                        return 0;
                       
                }
            }
        }

       $res = null;

    }

    //** GET CHANGE DND CNE DATA**/
    public function Edit_Prospect_Data($id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN ibt_marketing_user B  on A.prospectData_Blocked_BDE_Code = B.User_Icode WHERE Prospect_Icode = '$id' ");
      // echo $this->db->last_query();
       return $query->result_array();
    }

    public function Edit_Prospect_Data_correction($id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN ibt_marketing_user B  on A.Current_BDE_User_Code = B.User_Icode WHERE A.Prospect_Icode = '$id' ");
       //echo $this->db->last_query();
       return $query->result_array();
    }

    public function insert_data_update_log($data)
    {
        $this->db->insert('prospect_dataupdate_log', $data); 
        return 1;
    }

    public function update_data_update_log($data,$dcode)
    {
        $this->db->where('Prospect_DU_Icode',$dcode);
        $this->db->update('prospect_dataupdate_log', $data);
        return 1;
    }

    public function get_prospect_data($id)
    {
      $query=$this->db->query("SELECT Has_Branches,Has_Office_In_India,Building_Type,Address,City,State,Company_Email,FB_URL,LinkedIn_URL,Time_Zone,PC_Name,PC_Desig,PC_Email,PC_Phone,SC_Name,SC_Desig,SC_Email,SC_Phone,Career_Section,Emp_Count,Prospect_Type,Product_Development,Products_Count,Domain,Custom_Development,Web_Development,Mobile_Development,Ecommerce_Development,Tech_Skills FROM ibt_prospect_data where Prospect_Icode = '$id' "); 
            return $query->result_array();
    }


    public function Correction_ID_Based_Data($did,$pid)
    {
        $query=$this->db->query("SELECT *  FROM prospect_dataupdate_log A INNER JOIN ibt_marketing_user B on A.Prospect_DU_BDE_Icode=B.User_Icode WHERE A.Prospect_DU_Icode='$did' ");
       // echo $this->db->last_query();
         return $query->result_array();
    }

    //** GET Marketing Team Leaders **/

    public function Get_Leader()
    {
          $query=$this->db->query("SELECT *  FROM ibt_marketing_user WHERE User_Leave_Approval_Rights='Yes' ");
          return $query->result_array();

    }

    //get BDE //
    public function get_BDE()
    {
         $query=$this->db->query("SELECT * FROM ibt_marketing_user WHERE User_Leave_Approval_Rights='no' and Reporting_User_Icode = '0' ");
     return $query->result_array();
    }

}
?>