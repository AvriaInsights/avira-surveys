<?php
require_once("classes/cls-admin.php");
$obj_admin = new Admin();
if($_POST['fname'] == NULL || $_POST['fname'] == "") {
    header("Location:update-user-profile.php");
} 
else
{
    $fname = $_POST['fname'];
}
if($_POST['lname'] == NULL || $_POST['lname'] == "") {
    $_SESSION['error'] = "Please enter Last Name";
    header("Location:update-user-profile.php");
} 
else
{
    $lname = $_POST['lname'];
}
if($_POST['email'] == NULL || $_POST['email'] == "") {
    $_SESSION['error'] = "Please enter Email Id";
    header("Location:update-user-profile.php");
} 
else
{
    $email = $_POST['email'];
}
if($_POST['client_pass'] == NULL || $_POST['client_pass'] == "") {
    $_SESSION['error'] = "Please enter Password";
    header("Location:update-user-profile.php");
} 
else
{
    $pass = base64_decode($_POST['client_pass']);
}
if ($fname != "" && $lname != "") {
    if (isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != "") {
        echo "picture";
        if ($_FILES['picture']['error'] == UPLOAD_ERR_OK) {
            $upload_file = "upload/" . time() . $_FILES['picture']['name'];
            $upload_path = SITEPATH . $upload_file;
            $status = move_uploaded_file($_FILES['picture']['tmp_name'], $upload_file);
            if ($status) {
                $update_data['profile_image'] = $upload_path;
            } else {
                $update_data['profile_image'] = SITEPATH . "upload/default.png";
            }
        }
    }
    
    if(($_POST['password'] != "") && ($_POST['npassword'] != "")){
        if($pass == $_POST['password'])
        {
            $update_data['password'] = base64_encode($_POST['npassword']);
        }
        else
        {
              echo 1;
              /*$_SESSION['error'] = "Check your Password";
              header("Location:update-user-profile.php");*/
              exit();
        }
    }
   
    $condition = "`tbl_admin`.`admin_id` = '" . $_POST['user_id'] . "'";
    $update_data['f_name'] = htmlspecialchars($_POST['fname']);
    $update_data['lname'] = htmlspecialchars($_POST['lname']);
    //$update_data['email_id'] = htmlspecialchars($_POST['email']);
    /*$update_data['uname'] = htmlspecialchars($_POST['username']);
    $update_data['phone'] = htmlspecialchars($_POST['phone']);
    $update_data['company'] = htmlspecialchars($_POST['company']);*/
    $update_data = $obj_admin->updateAdmin($update_data, $condition, 0);
}
else{
       echo "in esle action"; 
       exit;
}
?>