<?php
require_once("classes/cls-admin.php");
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

$obj_admin = new Admin();

$conn = $obj_admin->getConnectionObj();

if($_POST['uname'] == NULL) {
    $_SESSION['error'] = "Please enter the Username";
    header("Location:login");
} 

if($_POST['password'] == NULL) {
    $_SESSION['error'] = "Please enter the Password";
    header("Location:login");
} 

if ($_POST['btn_submit'] == 'Login') {
    $uname = mysqli_real_escape_string($conn, trim($_POST['uname']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    $enc_password = base64_encode($password);
    $condition = "email = '" . $uname . "' AND password ='" . $enc_password . "'";
    $admin_details = $obj_admin->getAdminDetails('', $condition, '', '', 0);
    if (count($admin_details) > 0) {
        $admin_detail = end($admin_details);
        
        if ($admin_detail['status'] == "Inactive") {
            $_SESSION['error'] = "Account is not activated, please activate your account and then login";
            header("location:login");
        } 
        else {
            if ($_POST['remember'] == "on") {
                setcookie("alxa_uname", $_POST['uname'], time() + 7200);
                setcookie("alxa_password", $_POST['password'], time() + 7200);
            }
            
            $_SESSION['ifg_admin'] = $admin_detail;
            
            /**********All Active Survey***************/
            $fields_survey = "*";
            $condition_survey = "`tbl_survey`.`status` = 'Active' and `tbl_survey`.`user_id` ='".$admin_detail['client_id']."'";
            $orderby="`tbl_survey`.`survey_id` desc";
            $all_active_surveys=$obj_survey->getSurveyDetail($fields_survey, $condition_survey, $orderby, '', 0);
            $total_records = count($all_active_surveys);  
             
            if($total_records != ""){
                header("location:dashboard");
            }
            else
            {
            header("location:https://www.avirasurveys.com/survey/");
            }
        }
    } else {
        $_SESSION['error'] = "<strong>Sorry</strong> Invalid username or password.";
        header("location:login");
    }
} else {
    $_SESSION['error'] = "<strong>Sorry</strong> Something went wrong. Please try again";
    header("location:login");
}
?>