<?php
 require_once("survey/classes/cls-user.php");
 $obj_user = new User();
 $conn = $obj_user->getConnectionObj();
 require_once("survey/classes/phpmailer.php");
/*
$token = $obj_user->getCode();*/



if($_GET['fname'] == NULL || $_GET['fname'] == "") {
    $_SESSION['error'] = "Please enter First Name";
    header("Location:register.php");
} 
else
{
    $fname = $_GET['fname'];
}

if($_GET['lname'] == NULL || $_GET['lname'] == "") {
    $_SESSION['error'] = "Please enter Last Name";
    header("Location:register.php");
} 
else
{
    $lname = $_GET['lname'];
}

if($_GET['phone'] == NULL || $_GET['phone'] == "") {
    $_SESSION['error'] = "Please enter Phone Number";
    header("Location:register.php");
} 
else
{
    $phone = $_GET['phone'];
}

if($_GET['email'] == NULL || $_GET['email'] == "") {
    $_SESSION['error'] = "Please enter Email Id";
    header("Location:register.php");
} 
else
{
    $email = $_GET['email'];
}

if($_GET['country'] == NULL || $_GET['country'] == "") {
    $_SESSION['error'] = "Please Select Country";
    header("Location:register.php");
} 
else
{
    $country = $_GET['country'];
}

if($_GET['company'] == NULL || $_GET['company'] == "") {
    $_SESSION['error'] = "Please enter Company Name";
    header("Location:register.php");
} 
else
{
    $company = $_GET['company'];
}

if($_GET['password'] == NULL || $_GET['password'] == "") {
    $_SESSION['error'] = "Please enter Password";
    header("Location:register.php");
} 
else
{
    $password = $_GET['password'];
}
/*if($_GET['username'] == NULL || $_GET['username'] == "") {
    $_SESSION['error'] = "Please enter username";
    header("Location:register.php");
} 
else
{
    $username = $_GET['username'];
}*/

//echo "uname".$_GET['username']."lname=".$lname;exit;

if (($fname != "NULL" || $fname != '') &&($email != "NULL" || $email != '')) {
    $insert_data['fname'] = mysqli_real_escape_string($conn, ucfirst($fname));
    $insert_data['lname'] = mysqli_real_escape_string($conn, ucfirst($lname));
     $insert_data['phone'] = mysqli_real_escape_string($conn, $_GET['phone']);
    $insert_data['email'] = mysqli_real_escape_string($conn, $_GET['email']);
    $insert_data['company'] = mysqli_real_escape_string($conn, $_GET['company']);
    $insert_data['country_id'] = mysqli_real_escape_string($conn, $_GET['country']);
    $insert_data['role'] = "client";
   // $insert_data['uname'] = mysqli_real_escape_string($conn, $username);
    $enc_password = base64_encode($_GET['password']);
    $insert_data['password'] = $enc_password;
    /*$insert_data['token'] = $token;*/
    $insert_data['status'] = "Inactive";
    $insert_data['created_at'] = date("Y-m-d H:i:s");
    $insert_data['updated_at'] = date("Y-m-d H:i:s");
    $user_id = $obj_user->insertAdminUser($insert_data, 0);
    
        if(isset($user_id)){
        $activation_link = ''.SITEPATHFRONT.'/activate-account.php';
     /*                 * ***Registration User Mail **** */
        $content = "<html>";
        $content .= "<head>";
        $content .= "<title> Account Activation - AviraSurveys</title>";
        $content .= "</head>";
        $content .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
        $content .= '<p>Dear ' .$_GET['fname']. ',</p>';
        $content .= '<p>Thank you for registering with AviraSurveys.</p>';
        $content .= '<p>Click on the below Button to activate your Account.</p>';
        $content.= '<br>';
        $content .= '<a href='. $activation_link .'?uname='.$_GET['email'].' style="color:#fff;font-size:12px;text-decoration:none;background-color:#00cfff;padding:10px;border-radius:7px;">Activate Account</a>';
        $content.= '<br>';
        $content .= '<p>About us: <br>Avira Surveys is a one of its kind survey Software that integrates the best of Market Research,  Marketing ability, Robust database and cutting-edge Technologies to deliver actionable insights.</p>';
        $content .= '<p>Contact Us,<br> Viswanath G. <br> Phone: +1 (407) 768-2028 <br>Email: contactus@avirasurveys.com </p>';            
        $content .= "</body>";
        $content .= "</html>";

        $subject = "Account Activation - AviraSurveys";

        $sent_reciept = sendUserRegistrationMail($email, $subject, $content);
         if ($sent_reciept) {
                echo "Mail Send";
            } 
            else {
               echo "Prblem in mail sending";
            }
        }
    }
    else
    {
        $response["message_code"] = 0;
        $response["message"] = "<strong>Sorry</strong> Error Processing your request. Please try again later";
     //header("Location:" . SITEPATH . "contact/");
    }
    
//echo json_encode($response);
//die();

 
?>


