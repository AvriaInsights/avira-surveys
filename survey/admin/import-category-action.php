<?php

require_once("classes/cls-category.php");
$obj_category = new Category();
$conn = $obj_category->getConnectionObj();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_FILES['csv_file']) && !empty($_FILES['csv_file'])) {
    $type = $_FILES['csv_file']['type'];
    if ($type == "application/vnd.ms-excel" || $type == "text/csv") {
        $file = $_FILES['csv_file']['tmp_name'];
        $handle = fopen($file, "r");
        $name = $_FILES['csv_file']['name'];
        $flag = true;
        $loop = $inserted = $updated = $count = 0;
        do {
            if ($loop > 1) {
                $title = addslashes(trim($data[2], '"'));
                if (isset($title) && $title != "") {
                    $condition = "`title` = '" . $title . "'";
                    $category_details = $obj_category->getCategoryDetails('*', $condition, '', '', 0);
                    if (!empty($category_details) && count($category_details) > 0) {
                        $update_data['title'] = mysqli_real_escape_string($conn, $title);
                        $update_data['shortcode'] = mysqli_real_escape_string($conn, addslashes(trim($data[1], '"')));
                        $update_data['status'] = mysqli_real_escape_string($conn, addslashes(trim($data[3], '"')));
                        $update_data['updated_at'] = date("Y-m-d h:i:s");
                        $category_status = $obj_category->updateCategory($update_data, $condition, 0);
                        $updated++;
                    } else {
                        $insert_data['title'] = mysqli_real_escape_string($conn, $title);
                        $insert_data['shortcode'] = mysqli_real_escape_string($conn, addslashes(trim($data[1], '"')));
                        $insert_data['status'] = mysqli_real_escape_string($conn, addslashes(trim($data[3], '"')));
                        $insert_data['created_at'] = date("Y-m-d h:i:s");
                        $insert_data['updated_at'] = date("Y-m-d h:i:s");
                        $category_status = $obj_category->insertCategory($insert_data, $condition, 0);
                        $inserted++;
                    }
                }
            }
            $loop++;
        } while ($data = fgetcsv($handle, 1000, ",", "'"));
        $_SESSION['success'] = "<strong>Congratulations</strong> Category : " . $inserted . " records Inserted and " . $updated . " records Updated successfully";
        header("Location:manage-category.php");
    } else {
        $_SESSION['error'] = "<strong>Sorry</strong> Please select the valid CSV file";
        header("Location:manage-category.php");
    }
} else {
    $_SESSION['error'] = "<strong>Sorry</strong> Please select the CSV file";
    header("Location:manage-category.php");
}
?>