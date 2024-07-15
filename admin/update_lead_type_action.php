<?php
require_once("classes/cls-request.php");
require_once("classes/phpmailer.php");

$obj_request = new Request();
$conn = $obj_request->getConnectionObj();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

$reqid=$_POST['reqid'];
/************************Points Code***************/
$tier = $_POST['tier'];
$designation = $_POST['designation'];
//$interest = $_POST['interest'];
$fields_request = "`tbl_request`.*";
$condition_request = "`tbl_request`.`request_id` = '" . $reqid . "'";
$req_details = $obj_request->getRequestDetails($fields_request, $condition_request, '', '', 0);
foreach($req_details as $req_detail)
{
    $propercent = $req_detail['priority_percent'];
    $prowise = $req_detail['priority_wise'];
    $specfinterest = $req_detail['comment'];
    $cmpname = $req_detail['company'];
    $desgname = $req_detail['job_title'];
}

if($designation!=0)
{
    $fields_designation = "`tbl_designation`.*";
    $condition_designation = "`tbl_designation`.`designation_name` = '" . $desgname . "'";
    $designation_details = $obj_request->getDesignation($fields_designation, $condition_designation, '', '', 0);
    
    if(count($designation_details)==0)
    {
       $insert_data12['designation_name'] = mysqli_real_escape_string($conn, $desgname);
       $insert_data12['created_at'] = date("Y-m-d H:i:s");
       $insert_data12['updated_at'] = date("Y-m-d H:i:s");
       $designation_details12 = $obj_request->insertDesignation($insert_data12, 0);
       $desgpoints=$designation;
    }
    else
    {
        $propercent=$propercent-$designation;
        $desgpoints=$designation;
    }
    
}
else
{
    $desgpoints=$designation;
}


if($tier!="")
{
   
   $fields_company = "`tbl_company`.*";
   $condition_company = "`tbl_company`.`cmp_name` = '" . $cmpname . "'";
   $company_details = $obj_request->getCompany($fields_company, $condition_company, '', '', 0);
    
   if(count($company_details)==0)
   {
       $insert_data11['cmp_name'] = mysqli_real_escape_string($conn, $cmpname);
       $insert_data11['created_at'] = date("Y-m-d H:i:s");
       $insert_data11['updated_at'] = date("Y-m-d H:i:s");
       $company_details11 = $obj_request->insertCompany($insert_data11, 0);
       $tierpoints=$tier; 
   }
   else
   {
       $propercent=$propercent-$tier;
       $tierpoints=$tier;
   }
   
   
}
else
{
    $tierpoints=$tier;
}


/*if($interest!=0)
{
    if($specfinterest=="")
    {
        $interestpoints=$interest;
    }
    else
    {
        $comment_array=array('Interested','required','interest','require','requirement','purchase','need','looking','call back','call','provide','provided');
        if (in_array($specfinterest, $comment_array))
        {
          $score_specific_interest=3;
          $propercent=$propercent-$score_specific_interest;
          $interestpoints=3;
        }
        else
        {
          if(str_word_count($specfinterest)>=5)
          {
            $score_specific_interest=2;
            $propercent=$propercent-$score_specific_interest;
            $interestpoints=2; 
          }
          if(str_word_count($specfinterest)>=1 && str_word_count($specfinterest)<5)
          {
            $score_specific_interest=1;
            $propercent=$propercent-$score_specific_interest;
            $interestpoints=1;
          }
          if(str_word_count($specfinterest)==0)
          {
            $score_specific_interest=0;
            $propercent=$propercent-$score_specific_interest;
            $interestpoints=0;
          }
        }
    }
    
    
}
else
{
    $interestpoints=$interest;
}*/



$totalpoints=$propercent+$desgpoints+$tierpoints;
//die();
if($totalpoints==0)
{
    $priority_wise="Junk Leads";
}
elseif($totalpoints>=1 && $totalpoints<=3)
{
    $priority_wise="LOW";
}
elseif($totalpoints>=4 && $totalpoints<=6)
{
    $priority_wise="MID";
}
elseif($totalpoints>=7 && $totalpoints<=10)
{
    $priority_wise="HIGH";
}
/*************************************************/

$condition= "`request_id` = '" . $reqid . "'";
$insert_data['priority_percent'] = mysqli_real_escape_string($conn, $totalpoints);
$insert_data['priority_wise'] = mysqli_real_escape_string($conn, $priority_wise);
$resultleadsc = $obj_request->updateLeadsRequest($insert_data,$condition, 0);
//$_SESSION['success'] = "Congratulations lead score updated successfully".$totalpoints. " ".$priority_wise;
if($resultleadsc)
{
    echo "Congratulations lead score updated successfully";
}
else
{
    echo "Error in processing update";
}

$condition1="`tbl_request`.`request_id`='". $reqid ."'";
$fields1 = "`tbl_request`.*,`tbl_admin`.f_name,lname,email_id,admin_id";
$request_details = $obj_request->getFullRequestLeadsDetails($fields1, $condition1, '', '', 0);

/*if(!empty($request_details))
{
    foreach($request_details as $request_detail)
    {
        if($request_detail['website']=="Researchcmfe")
        {
            $contact_email="contactus@researchcmfe.com";
        }
        if($request_detail['website']=="AllTheResearch")
        {
            $contact_email="contactus@alltheresearch.com";
        }
        
            $content = "<html>";
            $content .= "<head>";
            $content .= "<title>". $request_detail['website'] . " - " . $request_detail['request_from_page'] ." for report id ". $request_detail['report_id'] ." assigned you</title>";
            $content .= "</head>";
            $content .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
            $content .= '<p>Dear <b>' .$request_detail['f_name'].' '.$request_detail['lname'].'</b>,</p>';
            $content .= '<p>Leads assign to you for <strong>' . $request_detail['report_title'] . '</strong> report.</p>
                             <p>Warm Regards,<br> Anuprit O. <br>' . SITETITLE . '</p>';
            $content .= "</body>";
            $content .= "</html>";

            $subject = $request_detail['website'] . " - " . $request_detail['request_from_page'] ."for report id". $request_detail['report_id'] ."assigned you";
            $sent_reciept = sendUserMail($request_detail['email_id'], $subject, $content);
    }        
}*/
?>