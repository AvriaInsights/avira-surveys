<?php
require_once("classes/cls-testimonial.php");
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$obj_testimonial = new Testimonial();

$conn = $obj_testimonial->getConnectionObj();


$uploadDir = "../images/testimonial/";
$uploadPath = "images/testimonial/";
$uploadReportDir = "../uploads";
// Validations
if ($_POST['name'] == "") {
    $_SESSION['error'] = "Please enter the Testimonial";
    header("Location:manage-testimonial.php");
}
if ($_POST['picture'] == NULL) {
    $_SESSION['error'] = "Please enter the Image Name";
    header("Location:" . $_SERVER['HTTP_REFERER']);
}

if ($_POST['update_type'] == "add") {
    
    
    //Testimonial Image
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


            //save file name
            $insert_data['picture'] = $upload_path;
        } else {
            $insert_data['picture'] = SITEPATH . "images/testimonial/default.png";
        }
    } else {
        $insert_data['picture'] = SITEPATH . "images/testimonial/default.png";
    }
    
    
    $insert_data['name'] = mysqli_real_escape_string($conn, ucfirst($_POST['name']));
    $insert_data['place'] = mysqli_real_escape_string($conn, $_POST['place']);
    $insert_data['content'] = mysqli_real_escape_string($conn, $_POST['content']);
    $insert_data['status'] = $_POST['status'];
    $insert_data['created_at'] = date("Y-m-d H:i:s");
    $insert_data['updated_at'] = date("Y-m-d H:i:s");
    $obj_testimonial->insertTestimonial($insert_data, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Testimonial information has been inserted successfully";
} else {
    

      //Testimonial Image
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


            //save file name
            $update_data['picture'] = $upload_path;
        } 
    } 
    
    $condition = "`testimonial_id` = '" . base64_decode($_POST['testimonial_id']) . "'";
    $update_data['name'] = mysqli_real_escape_string($conn, ucfirst($_POST['name']));
    $update_data['place'] = mysqli_real_escape_string($conn, $_POST['place']);
    $update_data['content'] = mysqli_real_escape_string($conn, $_POST['content']);
    $update_data['status'] = $_POST['status'];
    $update_data['updated_at'] = date("Y-m-d H:i:s");
    $obj_testimonial->updateTestimonial($update_data, $condition, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Testimonial information has been updated successfully.";
}
header("Location:manage-testimonial.php");
exit(0);
?>
