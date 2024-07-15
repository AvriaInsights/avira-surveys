<?php
require_once("classes/cls-analyst.php");
require_once("classes/phpmailer.php");
require_once("classes/cls-user.php");
$obj_user = new User();

if (!isset($_SESSION['ifg_admin']) || !isset($_SESSION['ifg_admin']['client_id'])) {
    header("Location:login.php");
}
$fields_user = "*";
$condition = "`tbl_client_user`.`client_id` = '".$_SESSION['ifg_admin']['client_id']."'";
$user_details = $obj_user->getUserclientDetails($fields_user, $condition,'','', 0);
 foreach($user_details as $user){
     $fname = $user['fname'];
     $lname = $user['lname'];
 }
 $name = "$fname" ." ". "$lname";
 
 $obj_analyst = new Analyst();

$conn = $obj_analyst->getConnectionObj();
$userid=$_SESSION['ifg_admin']['client_id'];

if($_POST['s_title'] == NULL || $_POST['s_title'] == "") {
    $_SESSION['error'] = "Please enter Survey Title";
    header("Location:build-with-analyst.php");
} 
else
{
    $s_title = $_POST['s_title'];
}

if($_POST['s_subject'] == NULL || $_POST['s_subject'] == "") {
    $_SESSION['error'] = "Please enter Survey Subject";
    header("Location:build-with-analyst.php");
} 
else
{
    $s_subject = $_POST['s_subject'];
}

if($_POST['s_category'] == NULL || $_POST['s_category'] == "") {
    $_SESSION['error'] = "Please Select Survey Category";
    header("Location:build-with-analyst.php");
} 
else
{
 $s_category = $_POST['s_category'];   
}

if($_POST['s_desc'] == NULL || $_POST['s_desc'] == "") {
    $_SESSION['error'] = "Please enter Description";
    header("Location:build-with-analyst.php");
} 
else
{
   $s_desc = $_POST['s_desc']; 
}

if($s_title != NULL || $s_subject != NULL || $s_category != NULL){
    $insert_data['survey_title'] = mysqli_real_escape_string($conn, $s_title);
    $insert_data['survey_subject'] = mysqli_real_escape_string($conn, $s_subject);
    $insert_data['survey_category'] = mysqli_real_escape_string($conn, $s_category);
    $insert_data['survey_description'] = mysqli_real_escape_string($conn, $s_desc);
    $insert_data['status'] = mysqli_real_escape_string($conn, "Active");
    $insert_data['created_at'] = date("Y-m-d H:i:s");
    $insert_data['updated_at'] = date("Y-m-d H:i:s");
    $insert_data['user_id'] = mysqli_real_escape_string($conn , $userid);
    $lastinsertid=$obj_analyst->insertBuildAnalyst($insert_data, 0);
}

$message = "<html>";
    $message .= "<head>";
    $message .= "<title> Build With Analyst for  - ". $s_title."</title>";
    $message .= "</head>";
    $message .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
    $message .= '<p>Dear Team,<br><br> 
    
                    ' .$name . ' has sent Build With Analyst request. Please find the below details</p>
                
				 <table style="border-collapse:collapse;" width="100%">  <tr> 
    			<th style="background-color:#00cfff;color:#fff;border:0.3px solid #0000000d;text-align:left;padding:8px;width:20%;">Item </th>
    			<th style="background-color:#00cfff;color:#fff;border:0.3px solid #0000000d;text-align:left;padding:8px;width:80%;">Details </th>
    			</tr>
    			
    			<tr>   
    			    <th style="border:0.3px solid #0000000d;text-align:left;padding:8px">
                   Customer Name </th><td style="border:0.3px solid #0000000d;text-align:left;padding:8px"> ' .$name . ' 
                </td>
                </tr>
    			
    			<tr>   <th style="border:0.3px solid #0000000d;text-align:left;padding:8px">
                    Survey Title  </th><td style="border:0.3px solid #0000000d;text-align:left;padding:8px"> ' .$s_title . ' 
                </td>
            </tr>
            
            <tr>   <th style="border:0.3px solid #0000000d;text-align:left;padding:8px">
                    Survey Subject  </th><td style="border:0.3px solid #0000000d;text-align:left;padding:8px"> ' . $s_subject . ' 
                </td>
            </tr>
            <tr>
               <th style="border:0.3px solid #0000000d;text-align:left;padding:8px">
                    Survey Category </th><td style="border:0.3px solid #0000000d;text-align:left;padding:8px"> ' . $s_category . '    </td>
            </tr>
            <tr>
               <th style="border:0.3px solid #0000000d;text-align:left;padding:8px">
                    Description </th><td style="border:0.3px solid #0000000d;text-align:left;padding:8px"> ' . $s_desc . '    </td>
            </tr>
            <tr>
               <th style="border:0.3px solid #0000000d;text-align:left;padding:8px">
                    IP Address </th><td style="border:0.3px solid #0000000d;text-align:left;padding:8px">' . $obj_analyst->get_client_ip() . '</b>
                </td>
            </tr> 
            </table>';
    $message .= "</body>";
    $message .= "</html>";
    //echo $message;die();exit();
    $subject = "Build With Analyst - " .$s_title;
    $mailsent = sendBuildAnalystMail("$subject", "$message");
    
    if($mailsent){
        echo "Success..";
    }else{
        echo "Failed...";
    }
    
   // header("Location:" . SITEPATH . "build-with-analyst.php?analystid=".$lastinsertid);

 /* Contact Us */
            
   
?>
