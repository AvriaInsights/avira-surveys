<?php

require_once("classes/cls-client-logo.php");
include_once('classes/easyphpthumbnail.class.php');

$obj_logo = new Logo();
$conn = $obj_logo->getConnectionObj();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}

$uploadDir = "../images/client/";
$uploadPath = "images/client/";
$uploadReportDir = "../uploads";


if ($_POST['client_name'] == NULL) {
    $_SESSION['error'] = "Please enter the Client Name";
    header("Location:" . $_SERVER['HTTP_REFERER']);
}

$client_name = $obj_logo->cleanOutput($_POST['client_name']);

if ($_POST['update_type'] == "add") {

    //Report Image
    if (isset($_FILES['logo']['name']) && $_FILES['logo']['error'] == 0) {
        $logo_tmp_name = $_FILES['logo']['tmp_name'];
        $path_parts = pathinfo($_FILES['logo']['name']);
        $extension = $path_parts['extension'];
        if ($extension == "png" || $extension == "jpg" || $extension == "jpeg") {
            $profilepic = "project" . uniqid() . ".$extension";
            $filePath = $uploadDir . $profilepic;
            $fileImagePath = $uploadPath . $profilepic;
            $upload_path = SITEPATH . $fileImagePath;
            $result = move_uploaded_file($logo_tmp_name, $filePath);


            //save file name
            $insert_data['logo'] = $upload_path;
        } else {
            $insert_data['logo'] = SITEPATH . "upload/default.png";
        }
    } else {
        $insert_data['logo'] = SITEPATH . "upload/default.png";
    }
    

    $insert_data['client_name'] = mysqli_real_escape_string($conn, $client_name);
    $obj_logo->insertLogo($insert_data, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Client Logo has been inserted successfully";
} else {
  
    //Report Image
    if (isset($_FILES['logo']['name']) && $_FILES['logo']['error'] == 0) {
        $logo_tmp_name = $_FILES['logo']['tmp_name'];
        $path_parts = pathinfo($_FILES['logo']['name']);
        $extension = $path_parts['extension'];
        if ($extension == "png" || $extension == "jpg" || $extension == "jpeg") {
            $profilepic = "project" . uniqid() . ".$extension";
            $filePath = $uploadPath . $profilepic;
            $fileImagePath = $uploadPath . $profilepic;
            $upload_path = SITEPATH . $fileImagePath;
            $result = move_uploaded_file($logo_tmp_name, $filePath);


            //save file name
            $update_data['logo'] = $upload_path;
        }
    }
    
    $update_data['client_name'] = mysqli_real_escape_string($conn, $client_name);
    $obj_logo->updateLogo($update_data, $condition, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Client Logo has been updated successfully.";
}
header("Location:manage-client-logo.php");
exit(0);
?>
