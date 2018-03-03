<?php 
class User_Marketing_model extends CI_Model
{     
    public function __construct()
    {
        parent::__construct();
    }


     public function Data_Country()
   {
     $query=$this->db->query("SELECT DISTINCT(Country) FROM ibt_prospect_data ");
     return $query->result_array();

   }

   /*** update user Password **/
   public function insert_user_password($data)
    {
      $current_pwd = $this->input->post('currentPassword');
      $query =$this->db->query("SELECT * from ibt_marketing_user WHERE User_Icode='" . $_SESSION["userid"] . "'");
      return $query->result_array();
    }

   public function get_User_country_data($id)
   {
   	$query=$this->db->query("SELECT Country ,COUNT(*) as counts  FROM ibt_prospect_data WHERE Prospect_Status ='New' and prospectData_Blocked_Type = 'No' and Current_BDE_User_Code ='$id' and Prospect_Analysis_BDE_Code !='0'  GROUP BY Country ");
   
   	  return $query->result_array();
   }

     public function get_User_country_data_hot($id)
   {
    $query=$this->db->query("SELECT Country ,COUNT(*) as counts  FROM ibt_prospect_data WHERE Prospect_Status ='Hot' and prospectData_Blocked_Type = 'No' and Current_BDE_User_Code ='$id'  GROUP BY Country ");
   
      return $query->result_array();
   }

      public function get_User_country_data_Warm($id)
   {
     $query=$this->db->query("SELECT Country ,COUNT(*) as counts  FROM ibt_prospect_data WHERE Prospect_Status ='Warm' and prospectData_Blocked_Type = 'No' and Current_BDE_User_Code ='$id'  GROUP BY Country ");
   
      return $query->result_array();
   }

   public function company_details($key,$id)
   {

     $country = $key['country'];
     $state = $key['state'];
     $City = $key['City'];
     $Category = $key['Category'];
     $ctype = $key['Ctype'];
     $skill = $key['skill'];

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
      if(!empty($Category))
      {
          $data4 = "Marketing_Prospect_Type = '$Category' AND ";
      }else{
          $data4 = "";
      }
      if(!empty($ctype))
      {
          $data5 = "$ctype = '1' AND ";
      }else{
          $data5 = "";
      }
      if(!empty($skill))
      {
          $data6 = "Tech_Skills LIKE '%$skill%' ";
      }else{
          $data6 = "";
      }

      $main_string = " AND $data1 $data2 $data3 $data4 $data5 $data6"; //All details
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
          $main_string = " AND $data1 $data2 $data3 $data4 $data5 $data6";
      }

      if($main_string == ""){ //Doesn't show all the products

      }else
      {

       $query=$this->db->query("SELECT COUNT(*) FROM ibt_prospect_data WHERE Prospect_Status ='New' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' $main_string ");
       //echo $this->db->last_query();
        if ($res = $query->num_rows()) 
        {
            /* Check the number of rows that match the SELECT statement */
            if ($res > 0) 
            {
              // $query=$this->db->query("SELECT * FROM ibt_prospect_data WHERE Prospect_Status ='Cold' and Current_BDE_User_Code = '$id' and Prospect_DND = 'No' and Prospect_CNE='No' $main_string LIMIT 0,1");

               $query=$this->db->query("SELECT Prospect_Icode FROM ibt_prospect_data  WHERE Prospect_Status ='New' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' $main_string  LIMIT 0,1 ");
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


public function Get_Company_Details($icode)
{
  $query=$this->db->query("SELECT  *, GROUP_CONCAT(DISTINCT C.Domain_Name) as domain,GROUP_CONCAT(DISTINCT F.Industries_Name) as Industry_Name FROM ibt_prospect_data A INNER JOIN ibt_prospect_domain B on A.Prospect_Icode=B.prospect_prospect_icode INNER JOIN domain_data C on B.prospect_Domain_Icode = C.Domain_Icode INNER JOIN ibt_prospect_industry E on A.Prospect_Icode=E.prospect_prospect_icode INNER JOIN industries_data F on E.prospect_Industry_Icode= F.Industries_Icode WHERE  A.Prospect_Icode = '$icode' ");
                   return $query->result_array();

}


   public function company_details_total($key,$id)
   {
      $country = $key['country'];
      $state = $key['state'];
      $City = $key['City'];
      $Category = $key['Category'];
      $ctype = $key['Ctype'];
      $skill = $key['skill'];

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
      if(!empty($Category))
      {
          $data4 = "Marketing_Prospect_Type = '$Category' AND ";
      }else{
          $data4 = "";
      }
      if(!empty($ctype))
      {
          $data5 = "$ctype = '1' AND ";
      }else{
          $data5 = "";
      }
      if(!empty($skill))
      {
          $data6 = "Tech_Skills LIKE '%$skill%' ";
      }else{
          $data6 = "";
      }
      $main_string = " AND $data1 $data2 $data3 $data4 $data5 $data6"; //All details
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
          $main_string = " AND $data1 $data2 $data3 $data4 $data5 $data6";;
      }

      if($main_string == "")
      { //Doesn't show all the products

      }
      else
      {

         $query=$this->db->query("SELECT COUNT(*) FROM ibt_prospect_data WHERE Prospect_Status ='New' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' $main_string ");

        if ($res = $query->num_rows()) 
        {

            /* Check the number of rows that match the SELECT statement */
            if ($res > 0) 
            {
               $query=$this->db->query("SELECT * FROM ibt_prospect_data WHERE Prospect_Status ='New' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Analysis_BDE_Code !='0' $main_string ");
               $rowcount = $query->num_rows();
                return $rowcount;       
            }    /* No rows matched -- do something else */
            else 
            {
                    return 0;         
             }
         }
      }
       $res = null;
    }


    public function company_details_next($key,$id,$next)
    {

             $country = $key['country'];
            $state = $key['state'];
            $City = $key['City'];
            $Category = $key['Category'];
             $ctype = $key['Ctype'];
             $skill = $key['skill'];

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
              if(!empty($Category))
              {
                  $data4 = "Marketing_Prospect_Type = '$Category' AND ";
              }else{
                  $data4 = "";
              }
              if(!empty($ctype))
              {
                  $data5 = "$ctype = '1' AND ";
              }else{
                  $data5 = "";
              }
              if(!empty($skill))
              {
                  $data6 = "Tech_Skills LIKE '%$skill%' ";
              }else{
                  $data6 = "";
              }

                $main_string = " AND $data1 $data2 $data3 $data4 $data5 $data6";; //All details

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
                  $main_string = " AND $data1 $data2 $data3 $data4 $data5 $data6";;
              }

              if($main_string == ""){ //Doesn't show all the products

              }else{

               $query=$this->db->query("SELECT COUNT(*) FROM ibt_prospect_data WHERE Prospect_Status ='New' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' $main_string ");

              if ($res = $query->num_rows()) {

              /* Check the number of rows that match the SELECT statement */
              if ($res > 0) {

                 $query=$this->db->query("SELECT Prospect_Icode FROM ibt_prospect_data  WHERE Prospect_Status ='New' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' $main_string LIMIT $next,1 ");
                   return $query->result_array();
                //  $query=$this->db->query("SELECT *, GROUP_CONCAT(DISTINCT C.Domain_Name) as domain,GROUP_CONCAT(DISTINCT F.Industries_Name) as Industry_Name FROM ibt_prospect_data A INNER JOIN ibt_prospect_domain B on A.Prospect_Icode=B.prospect_prospect_icode INNER JOIN domain_data C on B.prospect_Domain_Icode = C.Domain_Icode INNER JOIN ibt_prospect_industry E on A.Prospect_Icode=E.prospect_prospect_icode INNER JOIN industries_data F on E.prospect_Industry_Icode= F.Industries_Icode WHERE Prospect_Status ='New' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' $main_string GROUP BY B.prospect_prospect_icode,E.prospect_prospect_icode  LIMIT $next,1 ");
                // return $query->result_array();

              }    /* No rows matched -- do something else */
                  else {
                      return 0;
                     
                      }
                  }
              }

              $res = null;
      }


      public function Company_History($id)
      {
        $query=$this->db->query("SELECT * FROM prospect_call_status A INNER JOIN ibt_marketing_user B on A.Prospect_BDE_Icode = B.User_Icode WHERE Prospect_Icode = '$id' ORDER BY Call_Date DESC ");
         return $query->result_array();
      }
         public function get_country_state($country,$uid)
      {
           $query=$this->db->query("SELECT DISTINCT(State) FROM ibt_prospect_data where Country ='$country' and Current_BDE_User_Code ='$uid' ");
            return $query->result();  
      }

       public function get_country_category($country,$uid)
      {
           $query=$this->db->query("SELECT Marketing_Prospect_Type ,COUNT(*) as count FROM ibt_prospect_data where Country ='$country' and Current_BDE_User_Code ='$uid' and Prospect_Analysis_BDE_Code !='0' and prospect_Status='New' GROUP By Marketing_prospect_type ");
           echo $this->db->last_query();
            return $query->result();  
      }

      /** State based City **/
      public function get_state_city($id,$uid)
      {
           $query=$this->db->query("SELECT DISTINCT(City) FROM ibt_prospect_data where State = '$id' and Current_BDE_User_Code ='$uid' "); 
              return $query->result();  
      }

      /** INSERT PROSPECT CALL STATUS **/
      public function Add_Prospect_call_status($data)
      {
       $this->db->insert('prospect_call_status', $data); 
              return 1;
      }

      /** Edit Data **/
      public function Edit_Prospect_Data($id)
      {
         $query=$this->db->query("SELECT * FROM ibt_prospect_data WHERE Prospect_Icode = '$id' ");
         return $query->result_array();
      }
      public function get_prospect_data($id)
      {
        $query=$this->db->query("SELECT Has_Branches,Has_Office_In_India,Building_Type,Address,City,State,Company_Email,FB_URL,LinkedIn_URL,Time_Zone,PC_Name,PC_Desig,PC_Email,PC_Phone,SC_Name,SC_Desig,SC_Email,SC_Phone,Career_Section,Emp_Count,Prospect_Type,Product_Development,Products_Count,Domain,Custom_Development,Web_Development,Mobile_Development,Ecommerce_Development,Tech_Skills FROM ibt_prospect_data where Prospect_Icode = '$id' "); 
              return $query->result_array();
      }
      public function insert_data_update_log($data)
      {
       $this->db->insert('prospect_dataupdate_log', $data); 
         return 1;
      }
      /** COUNT OF HOT<WARM<COLD<TOTAL **/
      public function Total_count($bcode)
      {

          $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code = '$bcode'  ");
          return $query->row_array(0);

      }
      public function Cold_count($bcode)
      {
      $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE Current_BDE_User_Code = '$bcode' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' ");
          return $query->row_array(0);

      }
      public function Warm_count($bcode)
      {
      $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code = '$bcode' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' ");
          return $query->row_array(0);

      }
      public function Hot_count($bcode)
      {
      $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code = '$bcode'  and prospectData_Blocked_Type != 'No' and Prospect_Status = 'Hot' ");
          return $query->row_array(0);

      }

      public function DND_count($bcode)
      {
      $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code = '$bcode'  and prospectData_Blocked_Type != 'No' ");
          return $query->row_array(0);

      }

      /** GRt FOLLOWUP CALL **/
      public function followup_call($id)
      {
        $date = date('Y-m-d');
        // $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE prospectData_Blocked_Type = 'No' and Current_BDE_User_Code ='8' and Prospect_Status !='Cold'  and date(Next_Call_Date) != '$date' ");
         $query=$this->db->query("SELECT * from ibt_prospect_data A LEFT OUTER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode WHERE A.prospectData_Blocked_Type ='No' and A.Current_BDE_User_Code = '$id'  and A.Prospect_Status IN ('Warm', 'Hot') and STR_TO_DATE(A.Equiv_our_date,'%d/%m/%Y') != '$date'");
         //echo $this->db->last_query();
         return $query->result_array();
      }

      /** Today Followup Call **/

      public function Today_Followup_call_count($id)
      {
        $date = date('Y-m-d');
         $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE prospectData_Blocked_Type = 'No' and Current_BDE_User_Code ='$id' and STR_TO_DATE(Equiv_our_date,'%d/%m/%Y') = '$date' and Prospect_Status = 'Warm' ");
          return $query->row_array(0);
      }
      public function Today_Followup_Cold_call_count($id)
      {
        $date = date('Y-m-d');
         $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE prospectData_Blocked_Type = 'No' and Current_BDE_User_Code ='$id' and STR_TO_DATE(Equiv_our_date,'%d/%m/%Y') = '$date' and Prospect_Status = 'Cold' ");
         return $query->row_array(0);
      }

      /** Start:  Missed Call **/
      public function Missed_call_Cold($id)     //Cold Missed Call
      {
        $date = date('Y-m-d');
         $query=$this->db->query("SELECT COUNT(Prospect_Icode) as cold FROM `ibt_prospect_data` WHERE Prospect_Status = 'Cold' and prospectData_Blocked_Type = 'No' and Current_BDE_User_Code ='$id' and STR_TO_DATE(Equiv_our_date,'%d/%m/%Y') < '$date' and Equiv_our_date !='' ");
        // echo $this->db->last_query();
         return $query->row_array(0);

      }
      public function Missed_call_Cold_details($id)     //Cold Missed Call
      {
        $date = date('Y-m-d');
         $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE Prospect_Status = 'Cold' and prospectData_Blocked_Type = 'No' and Current_BDE_User_Code ='$id' and STR_TO_DATE(Equiv_our_date,'%d/%m/%Y') < '$date' and Equiv_our_date !='' ");
        // echo $this->db->last_query();
         return $query->result_array();
      }
      public function Missed_call_Warm($id)     //Warm Missed Call
      {
        $date = date('Y-m-d');
         $query=$this->db->query("SELECT COUNT(Prospect_Icode) as warm FROM `ibt_prospect_data` WHERE Prospect_Status = 'Warm' and prospectData_Blocked_Type = 'No' and Current_BDE_User_Code ='$id' and STR_TO_DATE(Equiv_our_date,'%d/%m/%Y') < '$date' and Equiv_our_date !='' ");
         return $query->row_array(0);

      }
      public function Missed_call_Warm_details($id)     //Warm Missed Call
      {
        $date = date('Y-m-d');
         $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE Prospect_Status = 'Warm' and prospectData_Blocked_Type = 'No' and Current_BDE_User_Code ='$id' and STR_TO_DATE(Equiv_our_date,'%d/%m/%Y') < '$date' and Equiv_our_date !='' ");
        return $query->result_array();

      }
      public function Missed_call_Hot($id)     //Hot Missed Call
      {
        $date = date('Y-m-d');
         $query=$this->db->query("SELECT COUNT(Prospect_Icode) as hot FROM `ibt_prospect_data` WHERE Prospect_Status = 'Hot' and prospectData_Blocked_Type = 'No' and Current_BDE_User_Code ='$id' and STR_TO_DATE(Equiv_our_date,'%d/%m/%Y') < '$date' and Equiv_our_date !='' ");
         return $query->row_array(0);

      }
      public function Missed_call_Hot_details($id)     //Hot Missed Call
      {
        $date = date('Y-m-d');
         $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE Prospect_Status = 'Hot' and prospectData_Blocked_Type = 'No' and Current_BDE_User_Code ='$id' and STR_TO_DATE(Equiv_our_date,'%d/%m/%Y') < '$date' and Equiv_our_date !='' ");
        return $query->result_array();

      }

      public function Missed_call_full($id)
      {
        $date = date('Y-m-d');
         $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE Prospect_Status != 'cold' and prospectData_Blocked_Type = 'No' and Current_BDE_User_Code ='$id' and STR_TO_DATE(Equiv_our_date,'%d/%m/%Y') < '$date' ");
        return $query->result_array();

      }

      /** Start:  Missed Call **/
      public function Today_Followup_call_warm($id)
      {
        $date = date('Y-m-d');
        // $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE  prospectData_Blocked_Type = 'No' and Current_BDE_User_Code ='$id' and date(Next_Call_Date) = '$date' ");
         $query=$this->db->query("SELECT * from ibt_prospect_data A LEFT OUTER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode WHERE A.prospectData_Blocked_Type ='No' and A.Current_BDE_User_Code = '$id'  and A.Prospect_Status = 'Warm' and STR_TO_DATE(A.Equiv_our_date,'%d/%m/%Y') = '$date'  ");
         // echo $this->db->last_query();
         return $query->result_array();
      }
      public function Today_Followup_call_hot($id)
      {
        $date = date('Y-m-d');
        // $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE  prospectData_Blocked_Type = 'No' and Current_BDE_User_Code ='$id' and date(Next_Call_Date) = '$date' ");
         $query=$this->db->query("SELECT * from ibt_prospect_data A LEFT OUTER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode WHERE A.prospectData_Blocked_Type ='No' and A.Current_BDE_User_Code = '$id'  and A.Prospect_Status ='Hot'  and STR_TO_DATE(A.Equiv_our_date,'%d/%m/%Y') = '$date'  ");
         // echo $this->db->last_query();
         return $query->result_array();
      }

    public function total_BDE_data($id)
    {

       $query=$this->db->query("SELECT Date(Last_Called_Date) as Date ,COUNT(*) as count FROM ibt_prospect_data WHERE Current_BDE_User_Code ='$id' and prospectData_Blocked_Type = 'No' and Last_Called_Date != '' and  MONTH(Last_Called_Date) = MONTH(CURRENT_DATE())
          AND YEAR(Last_Called_Date) = YEAR(CURRENT_DATE())  GROUP BY Date(Last_Called_Date)  ");

       return $query->result_array();

    }

    public function total_Cold_chart($id)
    {

      $query=$this->db->query("SELECT Date(Last_Called_Date) as Date ,COUNT(*) as count FROM ibt_prospect_data WHERE Current_BDE_User_Code ='$id' and prospectData_Blocked_Type = 'No' and Prospect_Status ='Cold' and Last_Called_Date != '' and  MONTH(Last_Called_Date) = MONTH(CURRENT_DATE())
        AND YEAR(Last_Called_Date) = YEAR(CURRENT_DATE())   GROUP BY Date(Last_Called_Date) ORDER BY Last_Called_Date ASC ");

       return $query->result_array();

    }
    public function total_Warm_chart($id)
    {

       $query=$this->db->query("SELECT Date(Last_Called_Date) as Date ,COUNT(*) as count FROM ibt_prospect_data WHERE Current_BDE_User_Code ='$id' and prospectData_Blocked_Type = 'No' and Prospect_Status ='Warm' and Last_Called_Date != ''  and  MONTH(Last_Called_Date) = MONTH(CURRENT_DATE())
         AND YEAR(Last_Called_Date) = YEAR(CURRENT_DATE())  GROUP BY Date(Last_Called_Date) ORDER BY Last_Called_Date ASC ");

       return $query->result_array();

    }

    public function total_Hot_chart($id)
    {

       $query=$this->db->query("SELECT Date(Last_Called_Date) as Date,COUNT(*) as count FROM ibt_prospect_data WHERE Current_BDE_User_Code ='$id' and prospectData_Blocked_Type = 'No' and Prospect_Status ='Hot' and Last_Called_Date != '' and  MONTH(Last_Called_Date) = MONTH(CURRENT_DATE())
         AND YEAR(Last_Called_Date) = YEAR(CURRENT_DATE())   GROUP BY Date(Last_Called_Date) ORDER BY Last_Called_Date ASC ");

       return $query->result_array();

    }
    public function total_HitRate_chart($id)
    {

       $query=$this->db->query("SELECT date(Call_Date) as date, sum(Prospect_Call_Result = 'Spock with DM') DM, sum(Prospect_Call_Result = 'Other') Other from prospect_call_status WHERE Prospect_BDE_Icode ='$id' and  MONTH(Call_Date) = MONTH(CURRENT_DATE())
        AND YEAR(Call_Date) = YEAR(CURRENT_DATE())  group by date(Call_Date) ORDER BY date(Call_Date) ASC ");

       return $query->result_array();

    }


    public function Prospect_Analysis_Data($id)
    {

      $query=$this->db->query("SELECT * FROM ibt_prospect_data WHERE  Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Marketing_Prospect_Type = '0' and   Review_Status = 'No' ");
      return $query->result_array();


    }
    public function Prospect_Update_Analysis_Data($id)
    {

      $query=$this->db->query("SELECT B.prospect_prospect_icode , GROUP_CONCAT(DISTINCT B.prospect_Domain_Icode) as Domain_Icode,GROUP_CONCAT(DISTINCT D.prospect_Industry_Icode) as industry_icode ,GROUP_CONCAT(DISTINCT C.Domain_Name) as domain,GROUP_CONCAT(DISTINCT E.Industries_Name) as Industry_Name ,A.Prospect_Icode,A.Company_Name,A.WebURL,A.Country,A.Marketing_Prospect_Type,A.prospect_Category,A.Marketing_Services,A.Marketing_Approch FROM ibt_prospect_data A INNER JOIN ibt_prospect_domain B on A.Prospect_Icode = B.prospect_prospect_icode  inner JOIN domain_data C on C.Domain_Icode = B.prospect_Domain_Icode INNER JOIN ibt_prospect_industry D on B.prospect_prospect_icode = D.prospect_prospect_icode INNER JOIN industries_data E on D.prospect_Industry_Icode=E.Industries_Icode  WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Marketing_Prospect_Type != '0' and   A.Review_Status = 'No'   GROUP BY B.prospect_prospect_icode,D.prospect_prospect_icode");
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

    public function company_details_followup($picode,$uicode)
    {
      $query=$this->db->query("SELECT *, GROUP_CONCAT(DISTINCT C.Domain_Name) as domain,GROUP_CONCAT(DISTINCT F.Industries_Name) as Industry_Name FROM ibt_prospect_data A INNER JOIN ibt_prospect_domain B on A.Prospect_Icode=B.prospect_prospect_icode INNER JOIN domain_data C on B.prospect_Domain_Icode = C.Domain_Icode INNER JOIN ibt_prospect_industry E on A.Prospect_Icode=E.prospect_prospect_icode INNER JOIN industries_data F on E.prospect_Industry_Icode= F.Industries_Icode WHERE  A.Prospect_Icode = '$picode' GROUP BY B.prospect_prospect_icode,E.prospect_prospect_icode  ");
     return $query->result_array();

    }

    /** GET ALL MEETING TYPE **/

    public function Meeting_type()
    {
      $query=$this->db->query("SELECT * FROM Call_Purpose_Meeting where Meeting_Type !='' ");
      return $query->result_array();

    }

    public function Add_Meeting_call_status($data)
    {

      //print_r($data);
       $this->db->insert('ibt_Meeting_Status', $data); 
            return 1;
    }

    public function Get_All_Meeting_Data($id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A  LEFT OUTER JOIN call_purpose_meeting C on A.Meeting_Type_Icode=C.Meeting_Icode WHERE A.Prospect_Icode = '$id' ");
      return $query->result_array();

    }

    public function Meeting_History($id)
    {

      $query=$this->db->query("SELECT * FROM ibt_meeting_status A INNER JOIN ibt_marketing_user B on A.Meeting_BDE_Icode = B.User_Icode INNER JOIN call_purpose_meeting C on A.Meeting_Type=C.Meeting_Icode WHERE Prospect_Icode = '$id' ORDER BY Meeting_BDE_Date DESC  ");
      //echo $this->db->last_query();
       return $query->result_array();
    }

    public function Meeting_status_History($id)
    {
      $query=$this->db->query("SELECT * FROM ibt_meeting_status A INNER JOIN call_purpose_meeting C on A.Meeting_Type=C.Meeting_Icode WHERE Meeting_Status_Icode = '$id'   ");
      //echo $this->db->last_query();
       return $query->result_array();
    }

    /** MEETING COUNT 

    public function Get_Meeting_count($id)
    {
      $date = date('Y-m-d');
       $query=$this->db->query("SELECT count(*) FROM ibt_meeting_status A LEFT OUTER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode LEFT OUTER JOIN call_purpose_meeting C on A.Meeting_Type_Icode=C.Meeting_Icode WHERE A.Meeting_BDE_Icode = '0' and B.Current_BDE_User_Code='$id' and date(A.Meeting_Date) = '$date' ");
       return $query->row_array(0);

    }**/

    /** GET NEW CALL COUNT**/

    public function get_new_call_count($id)
    {
       $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'New' and Prospect_Analysis_BDE_Code !='0' ");
        return $query->row_array(0);
    }

    /** GET CALLED COUNT **/
    public function get_called_count($id)
    {
       $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' ");
        return $query->row_array(0);
    }

    public function get_ourdate_count($id)
    {
       $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Next_Call_Date_Client !='Yes'  ");
        return $query->row_array(0);
    }

    public function get_ourdate_details($id)
    {
       $query=$this->db->query("SELECT Country ,COUNT(*) as our_count FROM ibt_prospect_data WHERE Current_BDE_User_Code ='$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Next_Call_Date_Client !='Yes'   GROUP BY Country ");
        return $query->result_array();
    }

    public function get_clientdate_count($id)
    {
       $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Next_Call_Date_Client ='Yes'   ");
        return $query->row_array(0);
    }

    public function Get_Todays_Meeting_Hot_count($id)
    {

      $date = date('Y-m-d');
      // $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE  prospectData_Blocked_Type = 'No' and Current_BDE_User_Code ='$id' and date(Next_Call_Date) = '$date' ");
       $query=$this->db->query("SELECT COUNT(A.Prospect_Icode) as hot from ibt_prospect_data A LEFT OUTER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode WHERE A.prospectData_Blocked_Type ='No' and A.Current_BDE_User_Code = '$id'  and A.Prospect_Status ='Hot'  and STR_TO_DATE(A.Equiv_our_date,'%d/%m/%Y') = '$date' and A.Meeting_Type_Icode !='0'  ");
       // echo $this->db->last_query();
      return $query->row_array(0);

    }

    public function Get_Todays_Meeting_Warm_count($id)
    {

      $date = date('Y-m-d');
      // $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE  prospectData_Blocked_Type = 'No' and Current_BDE_User_Code ='$id' and date(Next_Call_Date) = '$date' ");
       $query=$this->db->query("SELECT COUNT(A.Prospect_Icode) as warm from ibt_prospect_data A LEFT OUTER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode WHERE A.prospectData_Blocked_Type ='No' and A.Current_BDE_User_Code = '$id'  and A.Prospect_Status ='Warm'  and STR_TO_DATE(A.Equiv_our_date,'%d/%m/%Y') = '$date' and A.Meeting_Type_Icode !='0'  ");
       // echo $this->db->last_query();
      return $query->row_array(0);

    }

    //** TODAYS TEAM CALL COUNT **/
    public function Get_Todays_Team_call_count($id)
    {
    $date = date('Y-m-d');
       $query=$this->db->query("SELECT COUNT(*) AS COUNTS from ibt_marketing_user A INNER JOIN ibt_prospect_data B on A.User_Icode=B.Current_BDE_User_Code WHERE A.Reporting_User_Icode='$id' and STR_TO_DATE(Equiv_our_date,'%d/%m/%Y') = '$date'");

      return $query->row_array(0);

    }
    public function Get_Todays_Team_call_details($id)
    {
    $date = date('Y-m-d');
       $query=$this->db->query("SELECT * from ibt_marketing_user A INNER JOIN ibt_prospect_data B on A.User_Icode=B.Current_BDE_User_Code WHERE A.Reporting_User_Icode='$id' and STR_TO_DATE(Equiv_our_date,'%d/%m/%Y') = '$date'");

     return $query->result_array();


    }

    //** Start:  Team Todays Call COLD **//
    public function Get_Todays_Team_call_Cold_count($id)
    {
    $date = date('Y-m-d');
       $query=$this->db->query("SELECT COUNT(*) AS COUNTS from ibt_marketing_user A INNER JOIN ibt_prospect_data B on A.User_Icode=B.Current_BDE_User_Code WHERE A.Reporting_User_Icode='$id' and B.prospect_Status = 'Cold' and STR_TO_DATE(Equiv_our_date,'%d/%m/%Y') = '$date'");

      return $query->row_array(0);

    }
    public function Get_Todays_Team_call_Cold_count_details($id)
    {
    $date = date('Y-m-d');
       $query=$this->db->query("SELECT * from ibt_marketing_user A INNER JOIN ibt_prospect_data B on A.User_Icode=B.Current_BDE_User_Code WHERE A.Reporting_User_Icode='$id' and B.prospect_Status = 'Cold' and STR_TO_DATE(Equiv_our_date,'%d/%m/%Y') = '$date'");

     return $query->result_array();
    }
    //** End:  Team Todays Call COLD **//

    //** Start:  Team Todays Call Warm **//
    public function Get_Todays_Team_call_Warm_count($id)
    {
    $date = date('Y-m-d');
       $query=$this->db->query("SELECT COUNT(*) AS COUNTS from ibt_marketing_user A INNER JOIN ibt_prospect_data B on A.User_Icode=B.Current_BDE_User_Code WHERE A.Reporting_User_Icode='$id' and B.prospect_Status = 'Warm' and STR_TO_DATE(Equiv_our_date,'%d/%m/%Y') = '$date'");

      return $query->row_array(0);

    }
    public function Get_Todays_Team_call_Warm_count_details($id)
    {
    $date = date('Y-m-d');
       $query=$this->db->query("SELECT * from ibt_marketing_user A INNER JOIN ibt_prospect_data B on A.User_Icode=B.Current_BDE_User_Code WHERE A.Reporting_User_Icode='$id' and B.prospect_Status = 'Warm' and STR_TO_DATE(Equiv_our_date,'%d/%m/%Y') = '$date'");

     return $query->result_array();
    }
    //** End:  Team Todays Call Warm **//

    //** Start: Team Todays Meeting Call HOT**//
    public function Get_Todays_Team_Meeting_Hot_count($id)
    {

      $date = date('Y-m-d');
     
       $query=$this->db->query("SELECT COUNT(A.Prospect_Icode) as hot from ibt_prospect_data A INNER JOIN ibt_marketing_user C on A.Current_BDE_User_Code=C.User_Icode LEFT OUTER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode WHERE A.prospectData_Blocked_Type ='No' and C.Reporting_User_Icode = '$id' and A.Prospect_Status ='Hot' and STR_TO_DATE(A.Equiv_our_date,'%d/%m/%Y') = '$date' and A.Meeting_Type_Icode !='0'   ");
        //echo $this->db->last_query();
      return $query->row_array(0);

    }
    //** End: Team Todays Meeting Call HOT**//

    //** Start: Team Todays Meeting Call Warm**//
    public function Get_Todays_Team_Meeting_Warm_count($id)
    {

      $date = date('Y-m-d');
     
       $query=$this->db->query("SELECT COUNT(A.Prospect_Icode) as warm from ibt_prospect_data A INNER JOIN ibt_marketing_user C on A.Current_BDE_User_Code=C.User_Icode LEFT OUTER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode WHERE A.prospectData_Blocked_Type ='No' and C.Reporting_User_Icode = '$id' and A.Prospect_Status ='Warm' and STR_TO_DATE(A.Equiv_our_date,'%d/%m/%Y') = '$date' and A.Meeting_Type_Icode !='0'   ");
        //echo $this->db->last_query();
      return $query->row_array(0);

    }
    //** End: Team Todays Meeting Call Warm**//

    public function get_clientdate_details($id)
    {
      // $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Next_Call_Date_Client ='Yes'  ");
         $query=$this->db->query("SELECT STR_TO_DATE(Equiv_our_date,'%d/%m/%Y') as datee,Company_Name,Company_Contact,Prospect_Icode,Country,Marketing_Prospect_Type,Next_Call_Date_Client,Next_Call_Date,WebURL,Equiv_our_date FROM ibt_prospect_data WHERE  Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Next_Call_Date_Client ='Yes'  ");
       return $query->result_array();
    }


    /** GET COMPANY DETAILS ON CLINET BASED DATE **/
    public function company_details_client_date($icode)

    {
     $query=$this->db->query("SELECT *, GROUP_CONCAT(DISTINCT C.Domain_Name) as domain,GROUP_CONCAT(DISTINCT F.Industries_Name) as Industry_Name FROM ibt_prospect_data A INNER JOIN ibt_prospect_domain B on A.Prospect_Icode=B.prospect_prospect_icode INNER JOIN domain_data C on B.prospect_Domain_Icode = C.Domain_Icode INNER JOIN ibt_prospect_industry E on A.Prospect_Icode=E.prospect_prospect_icode INNER JOIN industries_data F on E.prospect_Industry_Icode= F.Industries_Icode WHERE Prospect_Icode = '$icode' GROUP BY B.prospect_prospect_icode,E.prospect_prospect_icode  ");
       return $query->result_array();
    }

    public function get_total_count($id)
    {
       $query=$this->db->query("SELECT count(*) FROM `ibt_prospect_data` WHERE Current_BDE_User_Code = '$id' AND Prospect_Status IN ('New', 'Cold') and prospectData_Blocked_Type = 'No' and Prospect_Analysis_BDE_Code !='0' ");
        return $query->row_array(0);
    }

    /** GET COUNTRY WISE CALLED DATA **/

    public function get_country_Data_count($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Next_Call_Date_Client !='Yes' and Country ='$country'  ");
      
        return $query->row_array(0);
    }

    public function get_thisweek_count($country,$id)
    {
       $query=$this->db->query("SELECT count(*) as tisweek,Country FROM ibt_prospect_data WHERE yearweek(DATE(Last_Called_Date), 1) = yearweek(curdate(), 1) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country' and Next_Call_Date_Client !='Yes'  ");
     //  echo $this->db->last_query();
          return $query->row_array(0);
    }

    public function get_thisweek_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data WHERE yearweek(DATE(Last_Called_Date), 1) = yearweek(curdate(), 1) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country' and Next_Call_Date_Client !='Yes'  ");
      return $query->result_array();
    }

    public function get_Lastweek_count($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as lastweek,Country FROM `ibt_prospect_data` WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 1 WEEK, 1) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country' and Next_Call_Date_Client !='Yes'  ");
      // echo $this->db->last_query(); 
        return $query->row_array(0);
    }
    public function get_Lastweek_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 1 WEEK, 1) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country' and Next_Call_Date_Client !='Yes'  ");
    return $query->result_array();
    }


    public function get_twoweek_ago_count($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as twoweek,Country FROM `ibt_prospect_data` WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 2 WEEK, 2) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country' and Next_Call_Date_Client !='Yes'  ");
      // echo $this->db->last_query()  
        return $query->row_array(0);
    }
    public function get_twoweek_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 2 WEEK, 2) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country' and Next_Call_Date_Client !='Yes'  ");
      return $query->result_array();
    }

    public function get_threeweek_ago_count($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as threeweek,Country FROM `ibt_prospect_data` WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 3 WEEK, 3) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country' and Next_Call_Date_Client !='Yes'  ");

        return $query->row_array(0);
    }

    public function get_threeweek_details($country,$id)
    {
       $query=$this->db->query("SELECT *  FROM `ibt_prospect_data` WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 3 WEEK, 3) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country' and Next_Call_Date_Client !='Yes'  ");
    return $query->result_array();
    }

    public function get_month_ago_count($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as month,Country FROM `ibt_prospect_data` WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 4 WEEK, 4) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country' and Next_Call_Date_Client !='Yes'  ");
      // echo $this->db->last_query(); 
        return $query->row_array(0);
    }


    public function get_month_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 4 WEEK, 4) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country' and Next_Call_Date_Client !='Yes'  ");
     return $query->result_array();
    }

    public function get_twomonth_ago_count($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as twomonth,Country FROM `ibt_prospect_data` WHERE  Last_Called_Date <= DATE_SUB(NOW(), INTERVAL 2 MONTH) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country'  and Next_Call_Date_Client !='Yes' ");
       //echo $this->db->last_query();
        return $query->row_array(0);
    }

    public function get_twomonth_details($country,$id)
    {
       $query=$this->db->query("SELECT *  FROM `ibt_prospect_data` WHERE  Last_Called_Date <= DATE_SUB(NOW(), INTERVAL 2 MONTH) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country'  and Next_Call_Date_Client !='Yes' ");
        return $query->result_array();
    }

    public function get_Below_Avg_count($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as BA,Country FROM `ibt_prospect_data` WHERE  Marketing_Prospect_Type ='Below Average' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country'  and Next_Call_Date_Client !='Yes' ");
       //echo $this->db->last_query(); 
        return $query->row_array(0);
    }
    public function get_Below_Avg_details($country,$id)
    {
       $query=$this->db->query("SELECT *  FROM `ibt_prospect_data` WHERE  Marketing_Prospect_Type ='Below Average' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country'  and Next_Call_Date_Client !='Yes' ");
      return $query->result_array();
    }
    public function get_Avg_count($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as Avg,Country FROM `ibt_prospect_data` WHERE  Marketing_Prospect_Type ='Average' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country'  and Next_Call_Date_Client !='Yes' ");
       //echo $this->db->last_query();
          return $query->row_array(0);
    }
    public function get_Avg_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE  Marketing_Prospect_Type ='Average' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country'  and Next_Call_Date_Client !='Yes' ");
       return $query->result_array();
    }
    public function get_AboveAvg_count($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as AAvg,Country FROM `ibt_prospect_data` WHERE  Marketing_Prospect_Type ='Above Average' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country'  and Next_Call_Date_Client !='Yes' ");
     
        return $query->row_array(0);
    }
    public function get_AboveAvg_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE  Marketing_Prospect_Type ='Above Average' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country'  and Next_Call_Date_Client !='Yes' ");
     return $query->result_array();
    }
    public function get_Good_count($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as Good,Country FROM `ibt_prospect_data` WHERE  Marketing_Prospect_Type ='Good' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country'  and Next_Call_Date_Client !='Yes' ");
      // echo $this->db->last_query();
        return $query->row_array(0);
    }
    public function get_Good_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE  Marketing_Prospect_Type ='Good' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country'  and Next_Call_Date_Client !='Yes' ");
      return $query->result_array();
    }

    public function get_product_count($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as product,Country FROM `ibt_prospect_data` WHERE  prospect_Category ='Product&Services' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country'  and Next_Call_Date_Client !='Yes' ");
      // echo $this->db->last_query();
        return $query->row_array(0);
    }
    public function get_product_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE  prospect_Category ='Product&Services' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country'  and Next_Call_Date_Client !='Yes' ");
       return $query->result_array();
    }
    public function get_services_count($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as services,Country FROM `ibt_prospect_data` WHERE  prospect_Category ='Services' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country'  and Next_Call_Date_Client !='Yes' ");
      // echo $this->db->last_query();
        return $query->row_array(0);
    }
    public function get_service_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE  prospect_Category ='Services' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Cold' and Country ='$country'  and Next_Call_Date_Client !='Yes' ");
      return $query->result_array();
    }
    public function get_DM_count($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as DM,Country FROM ibt_prospect_data A INNER JOIN  prospect_call_status  B on A.Prospect_Icode = B.Prospect_Icode WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Cold' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and B.Prospect_Call_Result ='Spock with DM' ");
      // echo $this->db->last_query()
       
        return $query->row_array(0);
    }
    public function get_DM_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN  prospect_call_status  B on A.Prospect_Icode = B.Prospect_Icode WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Cold' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and B.Prospect_Call_Result ='Spock with DM' ");
      return $query->result_array();
    }
    public function get_Others_count($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as Other,Country FROM ibt_prospect_data A INNER JOIN  prospect_call_status  B on A.Prospect_Icode = B.Prospect_Icode WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Cold' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and B.Prospect_Call_Result ='Other' ");
      // echo $this->db->last_query()
       
        return $query->row_array(0);
    }
    public function get_Other_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Cold' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and B.Prospect_Call_Result ='Other' ");
     return $query->result_array();
    }
    public function get_custom_count($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as custom,Country FROM ibt_prospect_data A  WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Cold' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Custom_Development ='1' ");
      // echo $this->db->last_query()
        return $query->row_array(0);
    }
    public function get_custom_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A  WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Cold' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Custom_Development ='1' ");
     return $query->result_array();
    }


    public function get_web_count($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as web,Country FROM ibt_prospect_data A  WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Cold' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Web_Development ='1' ");
      // echo $this->db->last_query();
        return $query->row_array(0);
    }
    public function get_web_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Cold' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Web_Development ='1' ");
      return $query->result_array();
    }

    public function get_mobile_count($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as mobile,Country FROM ibt_prospect_data A  WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Cold' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Mobile_Development ='1' ");
      // echo $this->db->last_query();
        return $query->row_array(0);
    }

    public function get_mobile_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Cold' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Mobile_Development ='1' ");
    return $query->result_array();
    }

    public function get_ec_count($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as ec,Country FROM ibt_prospect_data A  WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Cold' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Ecommerce_Development ='1' ");
      // echo $this->db->last_query();
     return $query->row_array(0);
    }
    public function get_ec_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN  prospect_call_status  B on A.Prospect_Icode = B.Prospect_Icode WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Cold' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Ecommerce_Development ='1' ");
     return $query->result_array();
    }

    //** FOLLOW UP GET COUNTRY WISE HOT DATA **//
    public function get_country_Data_count_Hot($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot'  and Country ='$country'  ");
        return $query->row_array(0);
    }

    public function get_thisweek_count_Hot($country,$id)
    {
       $query=$this->db->query("SELECT count(*) as tisweek,Country FROM ibt_prospect_data WHERE yearweek(DATE(Last_Called_Date), 1) = yearweek(curdate(), 1) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'   ");
     //  echo $this->db->last_query();  
        return $query->row_array(0);
    }


    public function get_thisweek_details_Hot($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE yearweek(DATE(Last_Called_Date), 1) = yearweek(curdate(), 1) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'  ");
      return $query->result_array();
    }

    public function get_Lastweek_count_Hot($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as lastweek,Country FROM `ibt_prospect_data` WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 1 WEEK, 1) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'  ");
      // echo $this->db->last_query();
        return $query->row_array(0);
    }
    public function get_Lastweek_details_Hot($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 1 WEEK, 1) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'  ");
    return $query->result_array();
    }


    public function get_twoweek_ago_count_Hot($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as twoweek,Country FROM `ibt_prospect_data` WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 2 WEEK, 2) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'   ");
      // echo $this->db->last_query();
        return $query->row_array(0);
    }
    public function get_twoweek_details_Hot($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 2 WEEK, 2) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'   ");
      return $query->result_array();
    }



    public function get_threeweek_ago_count_Hot($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as threeweek,Country FROM `ibt_prospect_data` WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 3 WEEK, 3) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'   ");

        return $query->row_array(0);
    }

    public function get_threeweek_details_Hot($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 3 WEEK, 3) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'   ");
    return $query->result_array();
    }


    public function get_month_ago_count_Hot($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as month,Country FROM `ibt_prospect_data` WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 4 WEEK, 4) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'   ");
      // echo $this->db->last_query();
        return $query->row_array(0);
    }


    public function get_month_details_Hot($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 4 WEEK, 4) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'  ");
     return $query->result_array();
    }


    public function get_twomonth_ago_count_Hot($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as twomonth,Country FROM `ibt_prospect_data` WHERE  Last_Called_Date <= DATE_SUB(NOW(), INTERVAL 2 MONTH) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'   ");
       //echo $this->db->last_query();
        return $query->row_array(0);
    }

    public function get_twomonth_details_Hot($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE  Last_Called_Date <= DATE_SUB(NOW(), INTERVAL 2 MONTH) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'   ");
        return $query->result_array();
      
    }


    public function get_Below_Avg_count_Hot($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as BA,Country FROM `ibt_prospect_data` WHERE  Marketing_Prospect_Type ='Below Average' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'   ");
       //echo $this->db->last_query();
        return $query->row_array(0);
    }
    public function get_Below_Avg_details_Hot($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE  Marketing_Prospect_Type ='Below Average' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'   ");
      return $query->result_array();
    }
    public function get_Avg_count_Hot($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as Avg,Country FROM `ibt_prospect_data` WHERE  Marketing_Prospect_Type ='Average' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'   ");
       //echo $this->db->last_query();
        return $query->row_array(0);
    }
    public function get_Avg_details_Hot($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE  Marketing_Prospect_Type ='Average' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'   ");
       return $query->result_array();
    }
    public function get_AboveAvg_count_Hot($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as AAvg,Country FROM `ibt_prospect_data` WHERE  Marketing_Prospect_Type ='Above Average' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'   ");
        return $query->row_array(0);
    }
    public function get_AboveAvg_details_Hot($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE  Marketing_Prospect_Type ='Above Average' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'   ");
     return $query->result_array();
    }
    public function get_Good_count_Hot($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as Good,Country FROM `ibt_prospect_data` WHERE  Marketing_Prospect_Type ='Good' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'   ");
      // echo $this->db->last_query()
       
        return $query->row_array(0);
    }
    public function get_Good_details_Hot($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE  Marketing_Prospect_Type ='Good' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'   ");
      return $query->result_array();
    }

    public function get_product_count_Hot($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as product,Country FROM `ibt_prospect_data` WHERE  prospect_Category ='Product&Services' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'   ");
      // echo $this->db->last_query();

        return $query->row_array(0);
    }
    public function get_product_details_Hot($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE  prospect_Category ='Product&Services' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'   ");
       return $query->result_array();
    }
    public function get_services_count_Hot($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as services,Country FROM `ibt_prospect_data` WHERE  prospect_Category ='Services' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'   ");
      // echo $this->db->last_query();
        return $query->row_array(0);
    }
    public function get_service_details_Hot($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE  prospect_Category ='Services' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Hot' and Country ='$country'  ");
      return $query->result_array();
    }
    public function get_DM_count_Hot($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as DM,Country FROM ibt_prospect_data A INNER JOIN  prospect_call_status  B on A.Prospect_Icode = B.Prospect_Icode WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Hot' and A.Country ='$country'   and B.Prospect_Call_Result ='Spock with DM' group By B.Prospect_Icode ");
      // echo $this->db->last_query()
        return $query->row_array(0);
    }
    public function get_DM_details_Hot($country,$id)
    {
       //$query=$this->db->query("SELECT MAX(B.Prospect_Call_Status_Icode),A.Prospect_Icode,A.Company_Name,A.Country,A.WebURL,A.Company_Contact,A.Marketing_Prospect_Type,A.Next_Call_Date,A.Equiv_our_date FROM ibt_prospect_data A INNER JOIN  prospect_call_status  B on A.Prospect_Icode = B.Prospect_Icode WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Hot' and A.Country ='$country'   and B.Prospect_Call_Result ='Spock with DM' GROUP BY B.Prospect_Icode   ");
        $query=$this->db->query("SELECT MAX(B.Prospect_Call_Status_Icode),A.Prospect_Icode,A.Company_Name,A.Country,A.WebURL,A.Company_Contact,A.Marketing_Prospect_Type,A.Next_Call_Date,A.Equiv_our_date,A.Meeting_Type_Icode,C.Meeting_Type FROM ibt_prospect_data A INNER JOIN  prospect_call_status  B on A.Prospect_Icode = B.Prospect_Icode INNER JOIN call_purpose_meeting C on A.Meeting_Type_Icode=C.Meeting_Icode WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Hot' and A.Country ='$country'   and B.Prospect_Call_Result ='Spock with DM' GROUP BY B.Prospect_Icode   ");
      return $query->result_array();
    }
    public function get_Others_count_Hot($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as Other,Country FROM ibt_prospect_data A INNER JOIN  prospect_call_status  B on A.Prospect_Icode = B.Prospect_Icode WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Hot' and A.Country ='$country'   and B.Prospect_Call_Result ='Other' group By B.Prospect_Icode ");
      // echo $this->db->last_query();
       
        return $query->row_array(0);
    }
    public function get_Other_details_Hot($country,$id)
    {
       $query=$this->db->query("SELECT MAX(B.Prospect_Call_Status_Icode),A.Prospect_Icode,A.Company_Name,A.Country,A.WebURL,A.Company_Contact,A.Marketing_Prospect_Type,A.Next_Call_Date,A.Equiv_our_date,A.Meeting_Type_Icode,C.Meeting_Type FROM ibt_prospect_data A INNER JOIN  prospect_call_status  B on A.Prospect_Icode = B.Prospect_Icode INNER JOIN call_purpose_meeting C on A.Meeting_Type_Icode=C.Meeting_Icode WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Hot' and A.Country ='$country' and B.Prospect_Call_Result ='Other' ");
     return $query->result_array();
    }
    public function get_General_count_Hot($country,$id)
    {

    $query=$this->db->query("SELECT count(*) as General,Country from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date   < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='1' and B.Prospect_Status='Hot' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
    //echo $this->db->last_query();
        return $query->row_array(0);
    }

    public function get_General_Details_Hot($country,$id)
    {

    $query=$this->db->query("SELECT * from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date   < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='1' and B.Prospect_Status='Hot' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");

     return $query->result_array();

    }

    public function get_Sales_count_Hot($country,$id)
    {
     // $query=$this->db->query("SELECT count(*) as counts from ibt_meeting_status A INNER JOIN prospect_call_status B on A.Prospect_Icode=B.Prospect_Icode INNER JOIN call_purpose_meeting C on A.Meeting_Type=C.Meeting_Icode INNER JOIN ibt_prospect_data D on A.Prospect_Icode=D.Prospect_Icode WHERE YEARWEEK(B.Call_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 3 WEEK, 3) and  A.Next_Meeting_Type='0' and A.Meeting_Type='2' and B.Prospect_Status='Warm' and D.Country='$country' and D.Current_BDE_User_Code='$id' ORDER by B.Call_Date DESC  ");
      // echo $this->db->last_query();
    $query=$this->db->query("SELECT count(*) as sales,Country from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date  < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='2' and B.Prospect_Status='Hot' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");

        return $query->row_array(0);
    }


    public function get_Sales_Details_Hot($country,$id)
    {

    $query=$this->db->query("SELECT * from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode INNER JOIN call_purpose_meeting C on B.Meeting_Type_Icode=C.Meeting_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date  < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='2' and B.Prospect_Status='Hot' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
      return $query->result_array();
    }

    public function get_Technical_count_Hot($country,$id)
    {

    $query=$this->db->query("SELECT count(*) as Technical,Country from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date  < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='3' and B.Prospect_Status='Hot' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
        return $query->row_array(0);
    }

    public function get_Technical_data_Hot_details($country,$id)
    {

    $query=$this->db->query("SELECT * from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode INNER JOIN call_purpose_meeting C on B.Meeting_Type_Icode=C.Meeting_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date < NOW() - INTERVAL 2 WEEK and A.Meeting_Type='3' and B.Prospect_Status='Hot' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
       return $query->result_array();
    }

    public function get_RFP_count_Hot($country,$id)
    {

    $query=$this->db->query("SELECT count(*) as RFP,Country from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date < NOW() - INTERVAL 2 WEEK and A.Meeting_Type='4' and B.Prospect_Status='Hot' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
        return $query->row_array(0);
    }


    public function get_RFP_data_Hot_details($country,$id)
    {

    $query=$this->db->query("SELECT * from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode INNER JOIN call_purpose_meeting C on B.Meeting_Type_Icode=C.Meeting_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date < NOW() - INTERVAL 2 WEEK and A.Meeting_Type='4' and B.Prospect_Status='Hot' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
     return $query->result_array();

    }
    public function get_Review_count_Hot($country,$id)
    {

    $query=$this->db->query("SELECT count(*) as Review,Country from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date  < NOW() - INTERVAL 2 WEEK and A.Meeting_Type='5' and B.Prospect_Status='Hot' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");

        return $query->row_array(0);

    }
    public function get_Review_data_Hot_details($country,$id)
    {

    $query=$this->db->query("SELECT * from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode INNER JOIN call_purpose_meeting C on B.Meeting_Type_Icode=C.Meeting_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='5' and B.Prospect_Status='Hot' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
     return $query->result_array();

    }

    public function get_Commercial_count_Hot($country,$id)
    {

    $query=$this->db->query("SELECT count(*) as Commercial,Country from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date  < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='6' and B.Prospect_Status='Hot' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
        return $query->row_array(0);

    }
    public function get_Commercial_data_Hot_details($country,$id)
    {
    $query=$this->db->query("SELECT * from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode  INNER JOIN call_purpose_meeting C on B.Meeting_Type_Icode=C.Meeting_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date  < NOW() - INTERVAL 2 WEEK and A.Meeting_Type='6' and B.Prospect_Status='Hot' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
        return $query->result_array();

    }
    public function get_Interview_count_Hot($country,$id)
    {

    $query=$this->db->query("SELECT count(*) as Interview,Country from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date  < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='7' and B.Prospect_Status='Hot' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");

        return $query->row_array(0);

    }
    public function get_Interview_data_Hot_details($country,$id)
    {

    $query=$this->db->query("SELECT * from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode INNER JOIN call_purpose_meeting C on B.Meeting_Type_Icode=C.Meeting_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date  < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='7' and B.Prospect_Status='Hot' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
       return $query->result_array();
    }

    public function get_Escalation_count_Hot($country,$id)
    {
    $query=$this->db->query("SELECT count(*) as Escalation,Country from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='8' and B.Prospect_Status='Hot' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
        return $query->row_array(0);
    }
    public function get_Escalation_data_Hot_details($country,$id)
    {
    $query=$this->db->query("SELECT *  from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode  INNER JOIN call_purpose_meeting C on B.Meeting_Type_Icode=C.Meeting_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date  < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='8' and B.Prospect_Status='Hot' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
        return $query->result_array();
    }

    public function get_FeedBack_count_Hot($country,$id)
    {
    $query=$this->db->query("SELECT count(*) as FeedBack,Country from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date < NOW() - INTERVAL 2 WEEK and A.Meeting_Type='9' and B.Prospect_Status='Hot' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
        return $query->row_array(0);
    }

    public function get_FeedBack_data_Hot_details($country,$id)
    {
    $query=$this->db->query("SELECT *  from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode  INNER JOIN call_purpose_meeting C on B.Meeting_Type_Icode=C.Meeting_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='9' and B.Prospect_Status='Hot' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
      return $query->result_array();
    }

    //** SERVICE TYPE **//
    public function get_custom_count_Hot($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as custom,Country FROM ibt_prospect_data A   WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Hot' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Custom_Development ='1' ");
        return $query->row_array(0);
    }
    public function get_custom_data_Hot_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Hot' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Custom_Development ='1' ");
     return $query->result_array();
    }

    public function get_web_count_Hot($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as web,Country FROM ibt_prospect_data A  WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Hot' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Web_Development ='1' ");
      // echo $this->db->last_query();
     return $query->row_array(0);
    }
    public function get_web_data_Hot_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Hot' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Web_Development ='1' ");
      return $query->result_array();
    }

    public function get_mobile_count_Hot($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as mobile,Country FROM ibt_prospect_data A  WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Hot' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Mobile_Development ='1' ");
         return $query->row_array(0);
    }

    public function get_mobile_data_Hot_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Hot' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Mobile_Development ='1' ");
    return $query->result_array();
    }

    public function get_ec_count_Hot($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as ec,Country FROM ibt_prospect_data A  WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Hot' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Ecommerce_Development ='1' ");
         return $query->row_array(0);
    }
    public function get_ec_data_Hot_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A  INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode INNER JOIN  prospect_call_status  B on A.Prospect_Icode = B.Prospect_Icode WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Hot' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Ecommerce_Development ='1' ");
     return $query->result_array();
    }

    //** SERVICE TYPE **//

    //** HOT END **/

    //** FOLLOW UP GET COUNTRY WISE Warm DATA **//
    public function get_country_Data_count_Warm($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(Prospect_Icode) FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm'  and Country ='$country'  ");
           return $query->row_array(0);
    }

    public function get_thisweek_count_Warm($country,$id)
    {
       $query=$this->db->query("SELECT count(*) as tisweek,Country FROM ibt_prospect_data WHERE yearweek(DATE(Last_Called_Date), 1) = yearweek(curdate(), 1) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'   ");
         return $query->row_array(0);
    }


    public function get_thisweek_details_Warm($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode WHERE yearweek(DATE(Last_Called_Date), 1) = yearweek(curdate(), 1) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'  ");
      return $query->result_array();
    }


    public function get_Lastweek_count_Warm($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as lastweek,Country FROM `ibt_prospect_data` WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 1 WEEK, 1) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'  ");
         return $query->row_array(0);
    }
    public function get_Lastweek_details_Warm($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 1 WEEK, 1) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'  ");
    return $query->result_array();
    }


    public function get_twoweek_ago_count_Warm($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as twoweek,Country FROM `ibt_prospect_data` WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 2 WEEK, 2) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'   ");
          return $query->row_array(0);
    }
    public function get_twoweek_details_Warm($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 2 WEEK, 2) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'   ");
      return $query->result_array();
    }



    public function get_threeweek_ago_count_Warm($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as threeweek,Country FROM `ibt_prospect_data` WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 3 WEEK, 3) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'   ");
        return $query->row_array(0);
    }

    public function get_threeweek_details_Warm($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 3 WEEK, 3) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'   ");
    return $query->result_array();
    }


    public function get_month_ago_count_Warm($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as month,Country FROM `ibt_prospect_data` WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 4 WEEK, 4) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'   ");
          return $query->row_array(0);
    }


    public function get_month_details_Warm($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE YEARWEEK(Last_Called_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 4 WEEK, 4) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'  ");
     return $query->result_array();
    }


    public function get_twomonth_ago_count_Warm($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as twomonth,Country FROM `ibt_prospect_data` WHERE  Last_Called_Date <= DATE_SUB(NOW(), INTERVAL 2 MONTH) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'   ");
          return $query->row_array(0);
    }

    public function get_twomonth_details_Warm($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE  Last_Called_Date <= DATE_SUB(NOW(), INTERVAL 2 MONTH) and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'   ");
        return $query->result_array();
      }


    public function get_Below_Avg_count_Warm($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as BA,Country FROM `ibt_prospect_data` WHERE  Marketing_Prospect_Type ='Below Average' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'   ");
          return $query->row_array(0);
    }
    public function get_Below_Avg_details_Warm($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE  Marketing_Prospect_Type ='Below Average' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'   ");
      return $query->result_array();
    }
    public function get_Avg_count_Warm($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as Avg,Country FROM `ibt_prospect_data` WHERE  Marketing_Prospect_Type ='Average' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'   ");
           return $query->row_array(0);
    }
    public function get_Avg_details_Warm($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE  Marketing_Prospect_Type ='Average' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'   ");
       return $query->result_array();
    }
    public function get_AboveAvg_count_Warm($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as AAvg,Country FROM `ibt_prospect_data` WHERE  Marketing_Prospect_Type ='Above Average' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'   ");
         return $query->row_array(0);
    }
    public function get_AboveAvg_details_Warm($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE  Marketing_Prospect_Type ='Above Average' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'   ");
     return $query->result_array();
    }
    public function get_Good_count_Warm($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as Good,Country FROM `ibt_prospect_data` WHERE  Marketing_Prospect_Type ='Good' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'   ");
          return $query->row_array(0);
    }
    public function get_Good_details_Warm($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE  Marketing_Prospect_Type ='Good' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'   ");
      return $query->result_array();
    }

    public function get_product_count_Warm($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as product,Country FROM `ibt_prospect_data` WHERE  prospect_Category ='Product&Services' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'   ");
          return $query->row_array(0);
    }
    public function get_product_details_Warm($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE  prospect_Category ='Product&Services' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'   ");
       return $query->result_array();
    }
    public function get_services_count_Warm($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as services,Country FROM `ibt_prospect_data` WHERE  prospect_Category ='Services' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'   ");
     
        return $query->row_array(0);
    }
    public function get_service_details_Warm($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE  prospect_Category ='Services' and Current_BDE_User_Code = '$id' and prospectData_Blocked_Type = 'No' and Prospect_Status = 'Warm' and Country ='$country'  ");
      return $query->result_array();
    }
    public function get_DM_count_Warm($country,$id)
    {
       $query=$this->db->query("SELECT  COUNT(*) as DM,Country FROM ibt_prospect_data A INNER JOIN  prospect_call_status  B on A.Prospect_Icode = B.Prospect_Icode INNER JOIN call_purpose_meeting C on A.Meeting_Type_Icode=C.Meeting_Icode WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Warm' and A.Country ='$country'  and B.Prospect_Call_Result ='Spock with DM'  ");
         return $query->row_array(0);
    }
    public function get_DM_details_Warm($country,$id)
    {
       $query=$this->db->query("SELECT MAX(B.Prospect_Call_Status_Icode),A.Prospect_Icode,A.Company_Name,A.Country,A.WebURL,A.Company_Contact,A.Marketing_Prospect_Type,A.Next_Call_Date,A.Equiv_our_date,A.Meeting_Type_Icode,C.Meeting_Type FROM ibt_prospect_data A INNER JOIN  prospect_call_status  B on A.Prospect_Icode = B.Prospect_Icode INNER JOIN call_purpose_meeting C on A.Meeting_Type_Icode=C.Meeting_Icode WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Warm' and A.Country ='$country'   and B.Prospect_Call_Result ='Spock with DM' GROUP BY B.Prospect_Icode ");
      return $query->result_array();
    }
    public function get_Others_count_Warm($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as Other,Country FROM ibt_prospect_data A INNER JOIN  prospect_call_status  B on A.Prospect_Icode = B.Prospect_Icode INNER JOIN call_purpose_meeting C on A.Meeting_Type_Icode=C.Meeting_Icode WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Warm' and A.Country ='$country'   and B.Prospect_Call_Result ='Other' ");
          return $query->row_array(0);
    }
    public function get_Other_details_Warm($country,$id)
    {
       $query=$this->db->query("SELECT MAX(B.Prospect_Call_Status_Icode),A.Prospect_Icode,A.Company_Name,A.Country,A.WebURL,A.Company_Contact,A.Marketing_Prospect_Type,A.Next_Call_Date,A.Equiv_our_date,A.Meeting_Type_Icode,C.Meeting_Type FROM ibt_prospect_data A INNER JOIN  prospect_call_status  B on A.Prospect_Icode = B.Prospect_Icode INNER JOIN call_purpose_meeting C on A.Meeting_Type_Icode=C.Meeting_Icode WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Warm' and A.Country ='$country'   and B.Prospect_Call_Result ='Other' ");
     return $query->result_array();
    }

    /** update meeting status **/
    public function Update_Meeting_Status($id,$data)
    {
      $this->db->where('Meeting_Status_Icode',$id);
        $this->db->update('ibt_meeting_status',$data);
        return 1;
    }

    /** MEETING STATUS COUNT WARM LAST 15 Days**/
    public function get_General_count_Warm($country,$id)
    {

    $query=$this->db->query("SELECT count(*) as General,Country from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date   < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='1' and B.Prospect_Status='Warm' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");

        return $query->row_array(0);

    }

    public function get_General_Details_Warm($country,$id)
    {

    $query=$this->db->query("SELECT * from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date   < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='1' and B.Prospect_Status='Warm' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");

     return $query->result_array();

    }

    public function get_Sales_count_Warm($country,$id)
    {
     // $query=$this->db->query("SELECT count(*) as counts from ibt_meeting_status A INNER JOIN prospect_call_status B on A.Prospect_Icode=B.Prospect_Icode INNER JOIN call_purpose_meeting C on A.Meeting_Type=C.Meeting_Icode INNER JOIN ibt_prospect_data D on A.Prospect_Icode=D.Prospect_Icode WHERE YEARWEEK(B.Call_Date, 1) = YEARWEEK( CURDATE() - INTERVAL 3 WEEK, 3) and  A.Next_Meeting_Type='0' and A.Meeting_Type='2' and B.Prospect_Status='Warm' and D.Country='$country' and D.Current_BDE_User_Code='$id' ORDER by B.Call_Date DESC  ");
      $query=$this->db->query("SELECT count(*) as sales,Country from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date  < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='2' and B.Prospect_Status='Warm' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
     //echo $this->db->last_query();
        return $query->row_array(0);

    }

    public function get_Sales_Details_Warm($country,$id)
    {

    $query=$this->db->query("SELECT * from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode INNER JOIN call_purpose_meeting C on B.Meeting_Type_Icode=C.Meeting_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date  < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='2' and B.Prospect_Status='Warm' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
      return $query->result_array();
    }
    /** Start : TECHINCAL ***/

    public function get_Technical_count_Warm($country,$id)
    {

    $query=$this->db->query("SELECT count(*) as Technical,Country from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date < NOW() - INTERVAL 2 WEEK and A.Meeting_Type='3' and B.Prospect_Status='Warm' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");

        return $query->row_array(0);

    }
    public function get_Technical_data_Warm_details($country,$id)
    {

    $query=$this->db->query("SELECT * from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode INNER JOIN call_purpose_meeting C on B.Meeting_Type_Icode=C.Meeting_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date < NOW() - INTERVAL 2 WEEK and A.Meeting_Type='3' and B.Prospect_Status='Warm' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");

       return $query->result_array();

    }
    /** End : TECHINCAL ***/


    /** Start : RFP ***/
    public function get_RFP_count_Warm($country,$id)
    {
    $query=$this->db->query("SELECT count(*) as RFP,Country from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date < NOW() - INTERVAL 2 WEEK and A.Meeting_Type='4' and B.Prospect_Status='Warm' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
        return $query->row_array(0);
    }

    public function get_RFP_data_Warm_details($country,$id)
    {

    $query=$this->db->query("SELECT * from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode INNER JOIN call_purpose_meeting C on B.Meeting_Type_Icode=C.Meeting_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date < NOW() - INTERVAL 2 WEEK and A.Meeting_Type='4' and B.Prospect_Status='Warm' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
     return $query->result_array();

    }
    /** End : RFP ***/

    /** Start : Review ***/
    public function get_Review_count_Warm($country,$id)
    {
    $query=$this->db->query("SELECT count(*) as Review,Country from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='5' and B.Prospect_Status='Warm' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
       return $query->row_array(0);
    }
    public function get_Review_data_Warm_details($country,$id)
    {

    $query=$this->db->query("SELECT * from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode INNER JOIN call_purpose_meeting C on B.Meeting_Type_Icode=C.Meeting_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='5' and B.Prospect_Status='Warm' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");
     return $query->result_array();
    }

    /** End  : Review ***/

    /** Start : Commerical ***/
    public function get_Commercial_count_Warm($country,$id)
    {

    $query=$this->db->query("SELECT count(*) as Commercial,Country from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date  < NOW() - INTERVAL 2 WEEK and A.Meeting_Type='6' and B.Prospect_Status='Warm' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");

        return $query->row_array(0);

    }

    public function get_Commercial_data_Warm_details($country,$id)
    {

    $query=$this->db->query("SELECT * from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode  INNER JOIN call_purpose_meeting C on B.Meeting_Type_Icode=C.Meeting_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date  < NOW() - INTERVAL 2 WEEK and A.Meeting_Type='6' and B.Prospect_Status='Warm' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");

        return $query->result_array();

    }
    /** End : Commercial ***/

    /** start : Interview ***/

    public function get_Interview_count_Warm($country,$id)
    {

    $query=$this->db->query("SELECT count(*) as Interview,Country from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date  < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='7' and B.Prospect_Status='Warm' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");

        return $query->row_array(0);

    }
    public function get_Interview_data_Warm_details($country,$id)
    {

    $query=$this->db->query("SELECT * from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode INNER JOIN call_purpose_meeting C on B.Meeting_Type_Icode=C.Meeting_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date  < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='7' and B.Prospect_Status='Warm' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");

       return $query->result_array();

    }

    /** End : Interview ***/


    /** start : Escalation ***/

    public function get_Escalation_count_Warm($country,$id)
    {

    $query=$this->db->query("SELECT count(*) as Escalation,Country from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date  < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='8' and B.Prospect_Status='Warm' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");

        return $query->row_array(0);

    }
    public function get_Escalation_data_Warm_details($country,$id)
    {

    $query=$this->db->query("SELECT *  from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode  INNER JOIN call_purpose_meeting C on B.Meeting_Type_Icode=C.Meeting_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date  < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='8' and B.Prospect_Status='Warm' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");

        return $query->result_array();

    }
    /** End : Escalation ***/



    /** start : feedback ***/

    public function get_FeedBack_count_Warm($country,$id)
    {

    $query=$this->db->query("SELECT count(*) as FeedBack,Country from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='9' and B.Prospect_Status='Warm' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");

        return $query->row_array(0);

    }
    public function get_FeedBack_data_Warm_details($country,$id)
    {

    $query=$this->db->query("SELECT *  from ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode  INNER JOIN call_purpose_meeting C on B.Meeting_Type_Icode=C.Meeting_Icode WHERE A.Next_Meeting_Type='0' and B.Last_Called_Date < NOW() - INTERVAL 2 WEEK  and A.Meeting_Type='9' and B.Prospect_Status='Warm' and B.Country='$country' and B.Current_BDE_User_Code='$id'   ");

      return $query->result_array();

    }

    /** End : feedback ***/


    public function get_custom_count_Warm($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as custom,Country FROM ibt_prospect_data A   WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Warm' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Custom_Development ='1' ");
      // echo $this->db->last_query();

       
        return $query->row_array(0);
    }
    public function get_custom_data_Warm_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode  WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Warm' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Custom_Development ='1' ");
     return $query->result_array();
    }


    public function get_web_count_Warm($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as web,Country FROM ibt_prospect_data A  WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Warm' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Web_Development ='1' ");
      // echo $this->db->last_query();

       
        return $query->row_array(0);
    }
    public function get_web_data_Warm_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Warm' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Web_Development ='1' ");
      return $query->result_array();
    }


    public function get_mobile_count_Warm($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as mobile,Country FROM ibt_prospect_data A  WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Warm' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Mobile_Development ='1' ");
      // echo $this->db->last_query();

       
        return $query->row_array(0);
    }

    public function get_mobile_data_Warm_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Warm' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Mobile_Development ='1' ");
    return $query->result_array();
    }

    public function get_ec_count_Warm($country,$id)
    {
       $query=$this->db->query("SELECT COUNT(*) as ec,Country FROM ibt_prospect_data A  WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Warm' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Ecommerce_Development ='1' ");
      // echo $this->db->last_query();
           return $query->row_array(0);
    }
    public function get_ec_data_Warm_details($country,$id)
    {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data A  INNER JOIN call_purpose_meeting B on A.Meeting_Type_Icode=B.Meeting_Icode INNER JOIN  prospect_call_status  B on A.Prospect_Icode = B.Prospect_Icode WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Status = 'Warm' and A.Country ='$country'  and A.Next_Call_Date_Client !='Yes' and A.Ecommerce_Development ='1' ");
     return $query->result_array();
    }

    //** WARM END **/

    //** SEARCH COMPANY DETAILS**/
    public function Search_company_details($data)
    {
        $company = $data['Company_Name'];
        $url = $data['WebURL'];
        $phone = $data['Company_Contact'];
      
    if(!empty($company))
    {
        $data1 = "Company_Name  LIKE  '%$company%' AND ";
    }else{
        $data1 = "";
    }
    if(!empty($url))
    {
        $data2 = "WebURL  LIKE  '%$url%' AND ";
    }else{
        $data2 = "";
    }
    if(!empty($phone))
    {
        $data3 = "Company_Contact  LIKE  '%$phone%' ";
    }else{
        $data3 = "";
    }

      $main_string = " $data1 $data2 $data3 "; //All details

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
        $main_string = "  $data1 $data2 $data3 ";;
    }

    if($main_string == ""){ //Doesn't show all the products

    }else{   

     $query=$this->db->query("SELECT count(*) FROM `ibt_prospect_data` WHERE $main_string  ");



    if ($res = $query->num_rows()) {

    /* Check the number of rows that match the SELECT statement */
    if ($res > 0) {
       $query=$this->db->query("SELECT * FROM ibt_prospect_data WHERE $main_string ");
       

     return $query->result_array();

    }    /* No rows matched -- do something else */
        else {
            return 0;
           
            }
        }
    }

    $res = null;


    }

    //** GET BDE BASED LEADER **/

    public function get_all_BDE($id)
    {
         $query=$this->db->query("SELECT * FROM ibt_marketing_user where Reporting_User_Icode = '$id' ");
     return $query->result_array();
    }


     public function BDE_data_Analysis_Count($id)
   {


    $query=$this->db->query("SELECT Country ,COUNT(*) FROM ibt_prospect_data WHERE Current_BDE_User_Code ='$id' and Prospect_Analysis_BDE_Code ='$id' and Review_Status = 'No' GROUP BY Country");


    echo $this->db->last_query();

  return $query->result_array();
   }
    
      public function get_All_Analysis_Data($c,$id)
   {

$query=$this->db->query("SELECT B.prospect_prospect_icode , GROUP_CONCAT(DISTINCT B.prospect_Domain_Icode) as Domain_Icode,GROUP_CONCAT(DISTINCT D.prospect_Industry_Icode) as industry_icode ,GROUP_CONCAT(DISTINCT C.Domain_Name) as domain,GROUP_CONCAT(DISTINCT E.Industries_Name) as Industry_Name ,A.Prospect_Icode,A.Company_Name,A.WebURL,A.Country,A.Marketing_Prospect_Type,A.prospect_Category,A.Marketing_Services,A.Marketing_Approch,A.Prospect_Analysis_BDE_Code FROM ibt_prospect_data A INNER JOIN ibt_prospect_domain B on A.Prospect_Icode = B.prospect_prospect_icode  inner JOIN domain_data C on C.Domain_Icode = B.prospect_Domain_Icode INNER JOIN ibt_prospect_industry D on B.prospect_prospect_icode = D.prospect_prospect_icode INNER JOIN industries_data E on D.prospect_Industry_Icode=E.Industries_Icode  WHERE  A.Current_BDE_User_Code = '$id' and A.prospectData_Blocked_Type = 'No' and A.Prospect_Analysis_BDE_Code ='$id' and A.Marketing_Prospect_Type != '0' and A.Country ='$c' and  A.Review_Status = 'No' and B.User_Icode = '$id' and D.User_Icode ='$id'  GROUP BY B.prospect_prospect_icode,D.prospect_prospect_icode");
  return $query->result_array();
    
   }

/** Start:  Team Missed Call **/
public function Team_Missed_call_Cold($id)     //Cold Missed Call
{
  $date = date('Y-m-d');
   $query=$this->db->query("SELECT COUNT(Prospect_Icode) as cold FROM ibt_prospect_data A INNER JOIN ibt_marketing_user B ON A.Current_BDE_User_Code=B.User_Icode WHERE A.Prospect_Status = 'Cold' and A.prospectData_Blocked_Type = 'No' and B.Reporting_User_Icode ='$id' and STR_TO_DATE(A.Equiv_our_date,'%d/%m/%Y') < '$date' and A.Equiv_our_date !='' ");
  // echo $this->db->last_query();
   return $query->row_array(0);

}
public function Team_Missed_call_Cold_details($id)     //Cold Missed Call
{
  $date = date('Y-m-d');
   $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN ibt_marketing_user B ON A.Current_BDE_User_Code=B.User_Icode WHERE A.Prospect_Status = 'Cold' and A.prospectData_Blocked_Type = 'No' and B.Reporting_User_Icode ='$id' and STR_TO_DATE(A.Equiv_our_date,'%d/%m/%Y') < '$date' and A.Equiv_our_date !='' ");
  return $query->result_array();

}
public function Team_Missed_call_Warm($id)     //Warm Missed Call
{
  $date = date('Y-m-d');
   $query=$this->db->query("SELECT COUNT(Prospect_Icode) as warm FROM ibt_prospect_data A INNER JOIN ibt_marketing_user B ON A.Current_BDE_User_Code=B.User_Icode WHERE A.Prospect_Status = 'Warm' and A.prospectData_Blocked_Type = 'No' and B.Reporting_User_Icode ='$id' and STR_TO_DATE(A.Equiv_our_date,'%d/%m/%Y') < '$date' and A.Equiv_our_date !='' ");
   return $query->row_array(0);

}
public function Team_Missed_call_Warm_details($id)     //Warm Missed Call
{
  $date = date('Y-m-d');
   $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN ibt_marketing_user B ON A.Current_BDE_User_Code=B.User_Icode WHERE A.Prospect_Status = 'Warm' and A.prospectData_Blocked_Type = 'No' and B.Reporting_User_Icode ='$id' and STR_TO_DATE(A.Equiv_our_date,'%d/%m/%Y') < '$date' and A.Equiv_our_date !='' ");
  return $query->result_array();


}
public function Team_Missed_call_Hot($id)     //Hot Missed Call
{
  $date = date('Y-m-d');
   $query=$this->db->query("SELECT COUNT(Prospect_Icode) as hot FROM ibt_prospect_data A INNER JOIN ibt_marketing_user B ON A.Current_BDE_User_Code=B.User_Icode WHERE A.Prospect_Status = 'Hot' and A.prospectData_Blocked_Type = 'No' and B.Reporting_User_Icode ='$id' and STR_TO_DATE(A.Equiv_our_date,'%d/%m/%Y') < '$date' and A.Equiv_our_date !='' ");
   return $query->row_array(0);

}
public function Team_Missed_call_Hot_details($id)     //Hot Missed Call
{
  $date = date('Y-m-d');
   $query=$this->db->query("SELECT * FROM ibt_prospect_data A INNER JOIN ibt_marketing_user B ON A.Current_BDE_User_Code=B.User_Icode WHERE A.Prospect_Status = 'Hot' and A.prospectData_Blocked_Type = 'No' and B.Reporting_User_Icode ='$id' and STR_TO_DATE(A.Equiv_our_date,'%d/%m/%Y') < '$date' and A.Equiv_our_date !='' ");
    return $query->result_array();

}

//** End: Team Missed Call **/

//** Get BDE **/
public function get_all_BDE_leader($id)
    {
         $query=$this->db->query("SELECT * FROM ibt_marketing_user where Reporting_User_Icode ='$id'   ");
         echo $this->db->last_query();
     return $query->result_array();
    }

    //** GET Individual BDE Country **/

    public function get_BDE_Country($bde_code)
    {
      $query=$this->db->query("SELECT DISTINCT(Country) FROM ibt_prospect_data where Current_BDE_User_Code='$bde_code' ");
     return $query->result_array();
    }

    //** GET NEW,COLD,WARM,HOT data Status Count**/
    public function get_data_status_count($country,$bde)
    {
      $query=$this->db->query("SELECT  DISTINCT(Country) as Country,
                              COUNT(Prospect_Icode) as Total,
                              COUNT(CASE WHEN Prospect_Status = 'New'  THEN 1 END) AS New,
                              COUNT(CASE WHEN Prospect_Status = 'Cold'  THEN 1 END) AS Cold,
                              COUNT(CASE WHEN Prospect_Status = 'Warm'  THEN 1 END) AS Warm,
                              COUNT(CASE WHEN Prospect_Status = 'Hot'  THEN 1 END) AS Hot
                              FROM `ibt_prospect_data` WHERE Country='$country' and Current_BDE_User_Code='$bde' ");
       return $query->row_array(0);
    }

    //** GET NEW,COLD,WARM,HOT This Month Total Call Count**/
    public function get_total_call_Month_count($country,$bde)
    {
      $query=$this->db->query("SELECT  DISTINCT(Country) as Country,
                              COUNT(Prospect_Icode) as Total,
                              COUNT(CASE WHEN Prospect_Status = 'New'  THEN 1 END) AS New,
                              COUNT(CASE WHEN Prospect_Status = 'Cold'  THEN 1 END) AS Cold,
                              COUNT(CASE WHEN Prospect_Status = 'Warm'  THEN 1 END) AS Warm,
                              COUNT(CASE WHEN Prospect_Status = 'Hot'  THEN 1 END) AS Hot
                              FROM `ibt_prospect_data` WHERE Country='$country' and Current_BDE_User_Code='$bde' and MONTH(Last_Called_Date) = MONTH(CURRENT_DATE()) AND YEAR(Last_Called_Date) = YEAR(CURRENT_DATE()) ");
       return $query->row_array(0);
    }

    //** GET Current Month Reached DM Based Count**/
    public function get_DM_Reached_Count($country,$bde)
    {
      $query=$this->db->query("SELECT DISTINCT(A.Country) as Country,
                              COUNT(A.Prospect_Icode) as Total,
                              COUNT(CASE WHEN A.Prospect_Status = 'Cold'  THEN 1 END) AS Cold,
                              COUNT(CASE WHEN A.Prospect_Status = 'Warm'  THEN 1 END) AS Warm,
                              COUNT(CASE WHEN A.Prospect_Status = 'Hot'  THEN 1 END) AS Hot
                              FROM ibt_prospect_data A INNER JOIN prospect_call_status B on A.Prospect_Icode=B.Prospect_Icode WHERE Country='$country' and A.Current_BDE_User_Code='$bde' and MONTH(A.Last_Called_Date) = MONTH(CURRENT_DATE())AND YEAR(A.Last_Called_Date) = YEAR(CURRENT_DATE()) and B.Prospect_Call_Result ='Spock with DM' ");
     return $query->row_array(0);
    }

    //** GET Current Month Meeting Count**/
    public function get_Month_Meeting_Count($country,$bde)
    {
      $query=$this->db->query("SELECT  COUNT(DISTINCT(A.Prospect_Icode)) as counts, B.Country FROM ibt_meeting_status A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode WHERE MONTH(A.Meeting_BDE_Date) = MONTH(CURRENT_DATE())AND YEAR(A.Meeting_BDE_Date) = YEAR(CURRENT_DATE()) and B.Current_BDE_User_Code='$bde' and B.Country='$country'  GROUP by A.Prospect_Icode");
     return $query->row_array(0);
    }

     //** GET NEW,COLD,WARM,HOT This Month Total Conversion Count**/
    public function get_Month_Conversion_Count($country,$bde)
    {
      $query=$this->db->query("SELECT    DISTINCT(Country) as Country,
                                        COUNT(Prospect_Icode) as Total,
                                       COUNT(CASE WHEN Prospect_Status = 'Warm'  THEN 1 END) AS Warm, COUNT(CASE WHEN Prospect_Status = 'Hot'  THEN 1 END) AS Hot
                              FROM `ibt_prospect_data` WHERE Country='$country' and Current_BDE_User_Code='$bde' and MONTH(Last_Called_Date) = MONTH(CURRENT_DATE()) AND YEAR(Last_Called_Date) = YEAR(CURRENT_DATE()) ");
       return $query->row_array(0);
    }

    /** Get Followup Count **/
    public function get_Followup_Count($bde)
    {
      $query=$this->db->query("SELECT   
       COUNT(CASE WHEN Prospect_Status = 'Cold' and Last_Called_Date < NOW() - INTERVAL 2 WEEK   THEN 1 END) AS Cold,
        COUNT(CASE WHEN Prospect_Status = 'Cold' and Last_Called_Date < NOW() - INTERVAL 1 MONTH   THEN 1 END) AS Cold1,
        COUNT(CASE WHEN Prospect_Status = 'Warm' and Last_Called_Date < NOW() - INTERVAL 2 WEEK   THEN 1 END) AS Warm,
        COUNT(CASE WHEN Prospect_Status = 'Warm' and Last_Called_Date < NOW() - INTERVAL 4 WEEK   THEN 1 END) AS Warm1,
        COUNT(CASE WHEN Prospect_Status = 'Hot' and Last_Called_Date < NOW() - INTERVAL 2 WEEK   THEN 1 END) AS Hot,
        COUNT(CASE WHEN Prospect_Status = 'Hot' and Last_Called_Date < NOW() - INTERVAL 4 WEEK   THEN 1 END) AS Hot1 FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code='$bde' ");
       return $query->row_array(0);
    }

    /** Get total call for month**/
    public function get_Total_Month_Count($bde)
    {
      $query=$this->db->query("SELECT Count(Prospect_Icode) as counts
                              FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code='$bde' and MONTH(Last_Called_Date) = MONTH(CURRENT_DATE()) AND YEAR(Last_Called_Date) = YEAR(CURRENT_DATE()) ");
       return $query->row_array(0);

    }

    /** Get total Conversion Month **/
    public function get_Conversion_Month_Count($bde)
    {
      $query=$this->db->query("SELECT   Count(Prospect_Icode) as counts
                              FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code='$bde' and `Prospect_Status` IN ('Warm', 'Hot') and MONTH(Last_Called_Date) = MONTH(CURRENT_DATE()) AND YEAR(Last_Called_Date) = YEAR(CURRENT_DATE()) ");
       return $query->row_array(0);
    }

    /** TOTAl DM month Count **/
    public function get_total_DM_Month_Count($bde)
    {
      $query=$this->db->query("SELECT Count(A.Prospect_Icode) as counts
                              FROM ibt_prospect_data A INNER JOIN prospect_call_status B on A.Prospect_Icode=B.Prospect_Icode WHERE  A.Current_BDE_User_Code='$bde' and MONTH(A.Last_Called_Date) = MONTH(CURRENT_DATE())AND YEAR(A.Last_Called_Date) = YEAR(CURRENT_DATE()) and B.Prospect_Call_Result ='Spock with DM' ");
      return $query->row_array(0);

    }

    //Get HOT Client //

    public function Select_Client($bde)
    {
          $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE  Current_BDE_User_Code='$bde' and Prospect_Status = 'Hot' ORDER by Company_Name ASC  ");
           return $query->result_array();

    }

    //Get Perticular Company//
    public function Select_Company_Details($pcode)
    {
           $query=$this->db->query("SELECT * FROM `ibt_prospect_data` WHERE  Prospect_Icode ='$pcode' ");
           return $query->result_array();
    }

    //** Get Technical Platform*8/

    public function get_Technical_Platform()
    {
          $query=$this->db->query("SELECT * FROM Technical_Platform  ");
           return $query->result_array();
    }

    //** Insert Requirement Master **//

    public function Save_Requirement($data)
    {
          $this->db->insert('ibt_requirement_master', $data); 
          return $this->db->insert_id();

    }

    //**  GEt All Requirement **//

    public function Get_All_Requirement($id)
    {
           $query=$this->db->query("SELECT * FROM ibt_requirement_master A INNER JOIN requirement_status_types B on A.Requirement_Status=B.Req_Id  LEFT OUTER JOIN ibt_marketing_user C on A.Leader_Code=C.User_Icode  INNER JOIN ibt_prospect_data D on A.Prospect_Icode= D.Prospect_Icode INNER JOIN technical_platform E on A.Tech_Platform=E.Tech_Icode INNER JOIN requirement_status_types F on A.Requirement_Status=F.Req_Id LEFT OUTER JOIN ibt_technical_user G on A.Tech_Leader_Code = G.User_Icode WHERE MONTH(A.Req_Received_Date) = MONTH(CURRENT_DATE()) AND YEAR(A.Req_Received_Date) = YEAR(CURRENT_DATE()) and A.BDE_Code='$id'  ");
           return $query->result_array();

    }

    //** GEt Requirement Status *8*/
    public function Get_Requirement_Status($type)
    {
           $query=$this->db->query("SELECT * FROM requirement_status_types where Req_Type = '$type'  ");
           return $query->result_array();
    }

   //** Search Requirement **/
   public function Search_Requirement($fdate,$tdate,$type,$status,$id)
   {

          if(!empty($type))
          {
              $data3 = "Requirement_Type = '$type' AND";
          }else{
              $data3 = "";
          }
          if(!empty($status))
          {
              $data4 = "Requirement_Status = '$status' ";
          }else{
              $data4 = "";
          }

            $main_string = " AND $data3 $data4"; //All details

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
              $main_string = " AND  $data3 $data4";
          }
          $query=$this->db->query("SELECT count(*) FROM ibt_requirement_master A INNER JOIN requirement_status_types B on A.Requirement_Status=B.Req_Id  LEFT OUTER JOIN ibt_marketing_user C on A.Leader_Code=C.User_Icode  INNER JOIN ibt_prospect_data D on A.Prospect_Icode= D.Prospect_Icode INNER JOIN technical_platform E on A.Tech_Platform=E.Tech_Icode INNER JOIN requirement_status_types F on A.Requirement_Status=F.Req_Id LEFT OUTER JOIN ibt_technical_user G on A.Tech_Leader_Code = G.User_Icode  WHERE A.Req_Received_Date >= '$fdate' and A.Req_Received_Date <= '$tdate' and  A.BDE_Code='$id'   $main_string ");

           //echo $this->db->last_query();
          if ($res = $query->num_rows()) {
          /* Check the number of rows that match the SELECT statement */
          if ($res > 0) 
          {
                $query=$this->db->query("SELECT * FROM ibt_requirement_master A INNER JOIN requirement_status_types B on A.Requirement_Status=B.Req_Id  LEFT OUTER JOIN ibt_marketing_user C on A.Leader_Code=C.User_Icode  INNER JOIN ibt_prospect_data D on A.Prospect_Icode= D.Prospect_Icode INNER JOIN technical_platform E on A.Tech_Platform=E.Tech_Icode INNER JOIN requirement_status_types F on A.Requirement_Status=F.Req_Id LEFT OUTER JOIN ibt_technical_user G on A.Tech_Leader_Code = G.User_Icode  WHERE A.Req_Received_Date >= '$fdate' and A.Req_Received_Date <= '$tdate' and  A.BDE_Code='$id'   $main_string ");
       
              return $query->result_array();
           
          }    /* No rows matched -- do something else */
              else {
                  return 0;
                 
                  }
              }
          $res = null;
    }

    //** Select Perticular Requirement **//

    public function Select_Requirement($Req_id)
    {
           $query=$this->db->query("SELECT * FROM ibt_requirement_master where Requirement_Icode = '$Req_id'  ");
           return $query->result_array();

    }

    //** Select Requirement based Compnay **/

    public function Select_Req_company($req_id)
    {
           $query=$this->db->query("SELECT * FROM ibt_requirement_master A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode INNER JOIN requirement_status_types C on A.Requirement_Status = C.Req_Id where Requirement_Icode = '$req_id'  ");
           return $query->result_array();
    }

    //** Select Perticular Status **//

    public function Select_Requirement_Status($type,$status)
    {
           $query=$this->db->query("SELECT * FROM `requirement_status_types` WHERE Req_Type='$type' and Req_Id > '$status'  ");
           return $query->result_array();
    }

    //** Select Leaders Comments **/

    public function Select_Leader_Comments($req_id)
    {
          $query=$this->db->query("SELECT A.Req_Comments,A.Tech_Leader_Cmd,A.Modified_Date,B.User_Name as Leader,C.User_Name as Bde FROM ibt_requirement_status A LEFT OUTER JOIN ibt_technical_user B on A.Tech_Leader_Code = B.User_Icode LEFT OUTER JOIN ibt_marketing_user C on A.BDE_Code=C.User_Icode WHERE A.Requirement_Icode='$req_id' ORDER by A.Modified_Date DESC   ");
           return $query->result_array();
    }

    //** Get All Project Type **//

    public function Select_Project_Type()
    {
        $query=$this->db->query("SELECT * FROM ibt_workcategory  ");
        return $query->result_array();
    }

    //** Get All Contract **//

    public function Select_Contract_Type()
    {
         $query=$this->db->query("SELECT * FROM ibt_contractcategory  ");
         return $query->result_array();
    }

    //** Save Status **/

    public function Save_Status($data)
    {
      $this->db->insert('ibt_requirement_status', $data); 
      return 1;
    }

    //** Save Project Won **/
    public function Save_Project_Won($data)
    {
         $this->db->insert('Project_Won', $data); 
         return 1;

    }

    //** Client Reason **//
    public function Select_Client_Reason()
    {
         $query=$this->db->query("SELECT * FROM project_loss_client_side  ");
         return $query->result_array();
    }

     //** Our Reason **//
    public function Select_Our_Reason()
    {
         $query=$this->db->query("SELECT * FROM Project_Loss_Our_Side  ");
         return $query->result_array();
    }

    //** Client Side Lost Project **/
    public function Save_Project_Lost($data)
    {
         $this->db->insert('Project_Lost', $data); 
         return 1;
    }

    //** Select lost Details **/
    public function Select_Lost_Details($req_id)
    {
         $query=$this->db->query("SELECT * FROM project_lost where Requirement_Icode = '$req_id'  ");
         return $query->row_array(0);
    }

    //** Select lost Reason Details **/
    public function Select_Lost_Reason_Client($lid)
    {
         $query=$this->db->query("SELECT * FROM project_loss_client_side where Project_Loss_Client_Icode = '$lid'  ");
         return $query->result_array();
    }

    //** Select lost Reason OUR Details **/
    public function Select_Lost_Reason_Our($lid)
    {
         $query=$this->db->query("SELECT * FROM project_loss_our_side where Project_Loss_Our_Icode = '$lid'  ");
         return $query->result_array();
    }

    //** poroject won details **//
    public function Select_Won_Details($req_id)
    {
         $query=$this->db->query("SELECT * FROM Project_Won A INNER JOIN ibt_workcategory B on A.Project_Type = B.WorkCategory_Icode INNER JOIN ibt_contractcategory C on A.Contract_Type=C.Contracttype_Icode where Requirement_Icode = '$req_id'  ");
         return $query->row_array(0);
    }



}