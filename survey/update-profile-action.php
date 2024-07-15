<?php
require_once("classes/cls-admin.php");
require_once("classes/easyphpthumbnail.class.php");

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}
$obj_admin = new Admin();

if($_POST['fname'] == NULL || $_POST['fname'] == "") {
    $_SESSION['error'] = "Please enter First Name";
    header("Location:user-profile.php");
} 
else
{
    $fname = $_POST['fname'];
}

if($_POST['lname'] == NULL || $_POST['lname'] == "") {
    $_SESSION['error'] = "Please enter Last Name";
    header("Location:user-profile.php");
} 
else
{
    $lname = $_POST['lname'];
}
if($_POST['client_pass'] == NULL || $_POST['client_pass'] == "") {
    $_SESSION['error'] = "Please enter Password";
    header("Location:user-profile.php");
} 
else
{
    $pass = base64_decode($_POST['client_pass']);
}
if ($fname != "" && $lname != "") {
    if (isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != "") {
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
              $_SESSION['error'] = "Check your Password";
              header("Location:user-profile.php");
              exit();
        }
    }
    
    $condition = "`tbl_client_user`.`client_id` = '" . $_POST['client_id'] . "'";
    $update_data['fname'] = htmlspecialchars($_POST['fname']);
    $update_data['lname'] = htmlspecialchars($_POST['lname']);
    $update_data['email'] = htmlspecialchars($_POST['email']);
    $update_data['uname'] = htmlspecialchars($_POST['username']);
    $update_data['phone'] = htmlspecialchars($_POST['phone']);
    $update_data['company'] = htmlspecialchars($_POST['company']);
    //$enc_password = base64_encode($_POST['password']);
    //$update_data['password'] = $enc_password;
   $update_data = $obj_admin->updateAdmin($update_data, $condition, 0);
   if($update_data){
      $_SESSION['success'] = "<strong>Congratulations</strong> Your Profile has been updated successfully.";
    header("Location:user-profile.php");
   }
   
}
else{
       echo "in esle action"; exit;
}


?>