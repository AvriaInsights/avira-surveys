<?php

require_once("classes/cls-image.php");
include_once('classes/easyphpthumbnail.class.php');

$obj_image = new Image();
$conn = $obj_image->getConnectionObj();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}

$uploadDir = "../images/gallery/";
$uploadPath = "images/gallery/";
$uploadThumbDir = "../images/gallery/thumb/";
$uploadLightboxDir = "../images/gallery/lightbox/";
$uploadReportDir = "../uploads";


if ($_POST['img_name'] == NULL) {
    $_SESSION['error'] = "Please enter the Image Name";
    header("Location:" . $_SERVER['HTTP_REFERER']);
}

$img_name = $obj_image->cleanOutput($_POST['img_name']);

if ($_POST['update_type'] == "add") {

    //Report Image
    if (isset($_FILES['picture']['name']) && $_FILES['picture']['error'] == 0) {
        $image_tmp_name = $_FILES['picture']['tmp_name'];
        $path_parts = pathinfo($_FILES['picture']['name']);
        $extension = $path_parts['extension'];
        if ($extension == "png" || $extension == "jpg" || $extension == "jpeg") {
            $profilepic = "project" . uniqid() . ".$extension";
            $filePath = $uploadDir . $profilepic;
            $fileImagePath = $uploadPath . $profilepic;
            $upload_path = SITEPATH . $fileImagePath;
            $result = move_uploaded_file($image_tmp_name, $filePath);

            //Generate Thumbnail Image
            $obj_image->resize_crop_image(400, 300, $filePath, $uploadThumbDir . $profilepic);

            //Generate Lightbox Image
            $obj_image->resize_crop_image(600, 450, $filePath, $uploadLightboxDir . $profilepic);

            //save file name
            $insert_data['picture'] = $upload_path;
            $insert_data['source'] = $upload_path;
        } else {
            $insert_data['picture'] = SITEPATH . "upload/default.png";
             $insert_data['source'] = SITEPATH . "upload/default.png";
        }
    } else {
        $insert_data['picture'] = SITEPATH . "upload/default.png";
        $insert_data['source'] = SITEPATH . "upload/default.png";
    }
    

    $insert_data['img_name'] = mysqli_real_escape_string($conn, $img_name);
    $obj_image->insertImage($insert_data, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Image has been inserted successfully";
} else {
  
    //Report Image
    if (isset($_FILES['picture']['name']) && $_FILES['picture']['error'] == 0) {
        $image_tmp_name = $_FILES['picture']['tmp_name'];
        $path_parts = pathinfo($_FILES['picture']['name']);
        $extension = $path_parts['extension'];
        if ($extension == "png" || $extension == "jpg" || $extension == "jpeg") {
            $profilepic = "project" . uniqid() . ".$extension";
            $filePath = $uploadPath . $profilepic;
            $fileImagePath = $uploadPath . $profilepic;
            $upload_path = SITEPATH . $fileImagePath;
            $result = move_uploaded_file($image_tmp_name, $filePath);

            //Generate Thumbnail Image
            $obj_image->resize_crop_image(400, 300, $filePath, $uploadThumbDir . $profilepic);

            //Generate Lightbox Image
            $obj_image->resize_crop_image(600, 450, $filePath, $uploadLightboxDir . $profilepic);

            //save file name
            $update_data['picture'] = $upload_path;
            $update_data['source'] = $upload_path;
        }
    }
    
    $update_data['img_name'] = mysqli_real_escape_string($conn, $img_name);
    $obj_image->updateImage($update_data, $condition, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Image has been updated successfully.";
}
header("Location:manage-image.php");
exit(0);
?>
