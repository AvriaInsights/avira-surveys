<?php
require_once("classes/cls-admin.php");
require_once("classes/easyphpthumbnail.class.php");

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}
$obj_admin = new Admin();

if (isset($_POST) && !empty($_POST)) {
    $condition = "`admin_id` = '" . base64_decode($_POST['admin_id']) . "'";
    if (isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != "") {
        if ($_FILES['picture']['error'] == UPLOAD_ERR_OK) {
            $upload_file = "upload/" . time() . $_FILES['picture']['name'];
            $upload_path = SITEADMIN . $upload_file;
            $status = move_uploaded_file($_FILES['picture']['tmp_name'], $upload_file);
            if ($status) {
                $update_data['profile_image'] = $upload_path;
            } else {
                $update_data['profile_image'] = SITEADMIN . "upload/default.png";
            }
        }
    }
    $update_data['fname'] = htmlspecialchars($_POST['fname']);
    $update_data['lname'] = htmlspecialchars($_POST['lname']);
    $update_data['email'] = htmlspecialchars($_POST['email']);
    $update_data['uname'] = htmlspecialchars($_POST['uname']);
    $enc_password = base64_encode($_POST['password']);
    $update_data['password'] = $enc_password;
    $obj_admin->updateAdmin($update_data, $condition, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Your Profile has been updated successfully.";
}
header("Location:view-profile.php");
exit(0);
?>