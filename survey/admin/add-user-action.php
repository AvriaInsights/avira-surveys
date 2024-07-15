<?php
require_once("classes/cls-user.php");
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$obj_user = new User();

$conn = $obj_user->getConnectionObj();

if(!$obj_user->isValidEmail($_POST['email'])) {
    $_SESSION['error'] = "Please enter valid email id";
    header("Location:manage-user.php");
}

if($_POST['fname'] == NULL) {
    $_SESSION['error'] = "Please enter First Name";
    header("Location:manage-user.php");
} 

if($_POST['lname'] == NULL) {
    $_SESSION['error'] = "Please enter Last Name";
    header("Location:manage-user.php");
} 

if ($_POST['update_type'] == "add") {
    if (isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != "") {
        if ($_FILES['picture']['error'] == UPLOAD_ERR_OK) {
            $upload_file = "upload/" . time() . $_FILES['picture']['name'];
            $upload_path = SITEADMIN . $upload_file;
            $status = move_uploaded_file($_FILES['picture']['tmp_name'], $upload_file);
            if ($status) {
                $insert_data['profile_image'] = $upload_path;
            }
        }
    }
    $insert_data['fname'] = mysqli_real_escape_string($conn, ucfirst($_POST['fname']));
    $insert_data['lname'] = mysqli_real_escape_string($conn, ucfirst($_POST['lname']));
    $insert_data['email'] = mysqli_real_escape_string($conn, $_POST['email']);
    $insert_data['phone'] = mysqli_real_escape_string($conn, $_POST['phone']);
    $insert_data['country_id'] = mysqli_real_escape_string($conn, $_POST['country_id']);
    $insert_data['state_id'] = mysqli_real_escape_string($conn, $_POST['state_id']);
    $insert_data['city_id'] = mysqli_real_escape_string($conn, $_POST['city_id']);
    $insert_data['zipcode'] = mysqli_real_escape_string($conn, $_POST['zipcode']);
    $insert_data['address'] = mysqli_real_escape_string($conn, $_POST['address']);
    $enc_password = base64_encode($_POST['password']);
    $insert_data['password'] = $enc_password;
    $insert_data['status'] = $_POST['status'];
    $insert_data['created_at'] = date("Y-m-d H:i:s");
    $insert_data['updated_at'] = date("Y-m-d H:i:s");
    $obj_user->insertUser($insert_data, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> User information has been inserted successfully";
} else {
    $condition = "`user_id` = '" . base64_decode($_POST['user_id']) . "'";
    if (isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != "") {
        if ($_FILES['picture']['error'] == UPLOAD_ERR_OK) {
            $upload_file = "upload/" . time() . $_FILES['picture']['name'];
            $upload_path = SITEADMIN . $upload_file;
            $status = move_uploaded_file($_FILES['picture']['tmp_name'], $upload_file);
            if ($status) {
                $update_data['profile_image'] = $upload_path;
            }
        }
    }
    $update_data['fname'] = mysqli_real_escape_string($conn, ucfirst($_POST['fname']));
    $update_data['lname'] = mysqli_real_escape_string($conn, ucfirst($_POST['lname']));
    if (isset($_POST['email']) && $_POST['email'] != "") {
        if($obj_user->isValidEmail($_POST['email'])) {
            $update_data['email'] = mysqli_real_escape_string($conn, $_POST['email']);
        } else {
            $_SESSION['success'] = "<strong>Sorry</strong> Invalid Email Id";
            header("Location:manage-user.php");
        }
    }
    $update_data['phone'] = mysqli_real_escape_string($conn, $_POST['phone']);
    $update_data['country_id'] = mysqli_real_escape_string($conn, $_POST['country_id']);
    $update_data['state_id'] = mysqli_real_escape_string($conn, $_POST['state_id']);
    $update_data['city_id'] = mysqli_real_escape_string($conn, $_POST['city_id']);
    $update_data['zipcode'] = mysqli_real_escape_string($conn, $_POST['zipcode']);
    $update_data['address'] = mysqli_real_escape_string($conn, $_POST['address']);
    $enc_password = base64_encode($_POST['password']);
    $update_data['password'] = $enc_password;
    $update_data['status'] = $_POST['status'];
    $obj_user->updateUser($update_data, $condition, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> User information has been updated successfully.";
}
header("Location:manage-user.php");
exit(0);
?>
