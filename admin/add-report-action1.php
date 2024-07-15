<?php

require_once("classes/cls-report.php");
require_once("classes/cls-category.php");
include_once('classes/easyphpthumbnail.class.php');

$obj_report = new Report();
$obj_category = new Category();
$conn = $obj_report->getConnectionObj();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}

$uploadDir = "images/gallery/";
$uploadThumbDir = "images/gallery/thumb/";
$uploadLightboxDir = "images/gallery/lightbox/";
$uploadReportDir = "../uploads";

if ($_POST['category_id'] == NULL) {
    $_SESSION['error'] = "Please select the Category";
    header("Location:" . $_SERVER['HTTP_REFERER']);
}

if ($_POST['title'] == NULL) {
    $_SESSION['error'] = "Please enter the Title";
    header("Location:" . $_SERVER['HTTP_REFERER']);
}

if ($_POST['description'] == NULL) {
    $_SESSION['error'] = "Please enter the Description";
    header("Location:" . $_SERVER['HTTP_REFERER']);
}
$condition = "`category_id` = '".$_POST['category_id']."'";
$shortcode_details = $obj_category->getCategoryDetails("`shortcode`", $condition, '', 1, 0);
$shortcode_detail = end($shortcode_details);
$shortcode = $shortcode_detail['shortcode'];

$title = $obj_report->cleanOutput($_POST['title']);
$description = $obj_report->cleanOutput($_POST['description']);
$meta_title = $obj_report->cleanOutput($_POST['meta_title']);
$meta_keyword = $obj_report->cleanOutput($_POST['meta_keyword']);
$meta_description = $obj_report->cleanOutput($_POST['meta_description']);
$toc = $obj_report->cleanOutput($_POST['toc']);
$tnf = $obj_report->cleanOutput($_POST['tnf']);

if ($_POST['update_type'] == "add") {
    //Generate SKU
    $report_details = $obj_report->getReportDetails('MAX(`report_id`) as report_id', '','',1,0);
    $report_detail = end($report_details);
    $report_id = $report_detail['report_id'];
    $report_id += 1;
    $sku = $obj_report->generateSKU($report_id, $shortcode);
    $keywords = $obj_report->removeSpace($_POST['keywords']);
    $keywords_slug = $obj_report->removeSpace($_POST['keywords']."-Global");
                    
    $slug = $obj_report->removeSpace($_POST['title']);
    $report_link = SITEPATH . "report/" . $report_id . "/" . $keywords_slug;
    //Report Image
    if (isset($_FILES['picture']['name']) && $_FILES['picture']['error'] == 0) {
        $image_tmp_name = $_FILES['picture']['tmp_name'];
        $path_parts = pathinfo($_FILES['picture']['name']);
        $extension = $path_parts['extension'];
        if ($extension == "png" || $extension == "jpg" || $extension == "jpeg") {
            $profilepic = "project" . uniqid() . ".$extension";
            $filePath = $uploadDir . $profilepic;
            $upload_path = SITEADMIN . $filePath;
            $result = move_uploaded_file($image_tmp_name, $filePath);

            //Generate Thumbnail Image
            $obj_report->resize_crop_image(400, 300, $filePath, $uploadThumbDir . $profilepic);

            //Generate Lightbox Image
            $obj_report->resize_crop_image(600, 450, $filePath, $uploadLightboxDir . $profilepic);

            //save file name
            $insert_data['picture'] = $upload_path;
        } else {
            $insert_data['picture'] = SITEADMIN . "upload/default.png";
        }
    } else {
        $insert_data['picture'] = SITEADMIN . "upload/default.png";
    }
    
    //Sample Report
    if (isset($_FILES['sample']['name']) && $_FILES['sample']['error'] == 0) {
        $report_tmp_name = $_FILES['sample']['tmp_name'];
        $path_parts = pathinfo($_FILES['sample']['name']);
        $extension = $path_parts['extension'];
        if ($extension == "pdf") {
            $report_name = "report-" . strtolower($sku) . ".$extension";
            if(!is_dir($uploadReportDir)){
                mkdir($uploadReportDir);
            }
            $report_path = $uploadReportDir . $report_name;
            $report_url = SITEPATH . $report_path;
            $result = move_uploaded_file($report_tmp_name, $report_path);
            $insert_data['sample'] = $report_url;
        } 
    } 

    $insert_data['sku'] = mysqli_real_escape_string($conn, $sku);
    $insert_data['slug'] = mysqli_real_escape_string($conn, $slug);
    $insert_data['title'] = mysqli_real_escape_string($conn, $title);
    $insert_data['keywords'] = mysqli_real_escape_string($conn, $keywords);
    $insert_data['description'] = mysqli_real_escape_string($conn, $description);
    $insert_data['toc'] = mysqli_real_escape_string($conn, $toc);
    $insert_data['tnf'] = mysqli_real_escape_string($conn, $tnf);
    $insert_data['price'] = mysqli_real_escape_string($conn, $_POST['price']);
    $insert_data['eprice'] = mysqli_real_escape_string($conn, $_POST['eprice']);
    $insert_data['category_id'] = mysqli_real_escape_string($conn, $_POST['category_id']);
    $insert_data['author_id'] = mysqli_real_escape_string($conn, $_POST['author_id']);
    $insert_data['pages'] = mysqli_real_escape_string($conn, $_POST['pages']);
    $insert_data['published_date'] = mysqli_real_escape_string($conn, $_POST['published_date']);
    $insert_data['report_link'] = mysqli_real_escape_string($conn, $report_link);
    $insert_data['copies'] = trim($_POST['copies']);
    $insert_data['meta_title'] = mysqli_real_escape_string($conn, $meta_title);
    $insert_data['meta_keyword'] = mysqli_real_escape_string($conn, $meta_keyword);
    $insert_data['meta_description'] = mysqli_real_escape_string($conn, $meta_description);
    $insert_data['featured'] = $_POST['featured'];
    $insert_data['status'] = $_POST['status'];
    $insert_data['created_at'] = date("Y-m-d H:i:s");
    $insert_data['updated_at'] = date("Y-m-d H:i:s");
    $obj_report->insertReport($insert_data, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Report information has been inserted successfully";
} else {
    //Generate SKU
    $report_id = base64_decode($_POST['report_id']);
    $sku = $obj_report->generateSKU($report_id, $shortcode);
    
    $keywords = $obj_report->removeSpace($_POST['keywords']);
    $keywords_slug = $obj_report->removeSpace($_POST['keywords']."-Global");
    
    $slug = $obj_report->removeSpace($_POST['title']);
    $condition = "`report_id` = '" . $report_id . "'";
    $report_link = SITEPATH . "report/" . $report_id . "/" . $keywords_slug;
    //Report Image
    if (isset($_FILES['picture']['name']) && $_FILES['picture']['error'] == 0) {
        $image_tmp_name = $_FILES['picture']['tmp_name'];
        $path_parts = pathinfo($_FILES['picture']['name']);
        $extension = $path_parts['extension'];
        if ($extension == "png" || $extension == "jpg" || $extension == "jpeg") {
            $profilepic = "project" . uniqid() . ".$extension";
            $filePath = $uploadDir . $profilepic;
            $upload_path = SITEADMIN . $filePath;
            $result = move_uploaded_file($image_tmp_name, $filePath);

            //Generate Thumbnail Image
            $obj_report->resize_crop_image(400, 300, $filePath, $uploadThumbDir . $profilepic);

            //Generate Lightbox Image
            $obj_report->resize_crop_image(600, 450, $filePath, $uploadLightboxDir . $profilepic);

            //save file name
            $update_data['picture'] = $upload_path;
        }
    }
    
    //Sample Report
    if (isset($_FILES['sample']['name']) && $_FILES['sample']['error'] == 0) {
        $report_tmp_name = $_FILES['sample']['tmp_name'];
        $path_parts = pathinfo($_FILES['sample']['name']);
        $extension = $path_parts['extension'];
        if ($extension == "pdf") {
            $report_name = "report-" . strtolower($sku) . ".$extension";
            if(!is_dir($uploadReportDir)){
                mkdir($uploadReportDir, 0777);
            }
            $report_path = $uploadReportDir . '/' . $report_name;
            $result = move_uploaded_file($report_tmp_name, $report_path);
            $report_url = str_replace('../', '', SITEPATH . $report_path);
            $update_data['sample'] = $report_url;
        } 
    } 
    
    $update_data['sku'] = mysqli_real_escape_string($conn, $sku);
    $update_data['slug'] = mysqli_real_escape_string($conn, $slug);
    $update_data['title'] = mysqli_real_escape_string($conn, $title);
    $update_data['keywords'] = mysqli_real_escape_string($conn, $keywords);
    $update_data['description'] = mysqli_real_escape_string($conn, $description);
    $update_data['toc'] = mysqli_real_escape_string($conn, $toc);
    $update_data['tnf'] = mysqli_real_escape_string($conn, $tnf);
    $update_data['price'] = mysqli_real_escape_string($conn, $_POST['price']);
    $update_data['eprice'] = mysqli_real_escape_string($conn, $_POST['eprice']);
    $update_data['category_id'] = mysqli_real_escape_string($conn, $_POST['category_id']);
    $update_data['author_id'] = mysqli_real_escape_string($conn, $_POST['author_id']);
    $update_data['pages'] = mysqli_real_escape_string($conn, $_POST['pages']);
    $update_data['published_date'] = mysqli_real_escape_string($conn, $_POST['published_date']);
    $update_data['report_link'] = mysqli_real_escape_string($conn, $report_link);
    $update_data['copies'] = trim($_POST['copies']);
    $update_data['meta_title'] = mysqli_real_escape_string($conn, $meta_title);
    $update_data['meta_keyword'] = mysqli_real_escape_string($conn, $meta_keyword);
    $update_data['meta_description'] = mysqli_real_escape_string($conn, $meta_description);
    $update_data['featured'] = $_POST['featured'];
    $update_data['status'] = $_POST['status'];
    $update_data['updated_at'] = date("Y-m-d H:i:s");
    $obj_report->updateReport($update_data, $condition, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Report information has been updated successfully.";
}
header("Location:manage-report.php");
exit(0);
?>
