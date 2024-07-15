<?php 
require_once("classes/cls-report.php");
require_once("classes/cls-category.php");
include_once('classes/easyphpthumbnail.class.php');

$obj_report = new Report();
$obj_category = new Category();
$conn = $obj_report->getConnectionObj();


if(isset($_POST['importSubmit'])){
     
    //  echo $_POST['importSubmit'];
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/xls', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

            // Skip the first line
            fgetcsv($csvFile);
            
                   
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
             //get category_id
             
                   
               
                  $bundle = trim($line[0]);
                    $category_detail = $obj_category->getSingleNewsDetail('bundle_name', "bundle_name = '" . $bundle . "'", '', 1, 0);
                    if (isset($category_detail) && !empty($category_detail)) {
                        $bundle_name = $category_detail['bundle_name'];
                    } 
                    else{
                        $bundle_name = 0;
                    }
                    
                  $market_name  = $line[1];  
                $report_url  = $line[2];
                $current_mark_size  = $line[3];
                $current_year  = $line[4];
                $forecast_size  = $line[5];
                $forecast_year  = $line[6];
                 $cagr  = $line[7];
                $segment_1  = $line[8];
                $segment_2  = $line[9];
                $segment_3 = $line[10];
                $segment_4  = $line[11];
                $segment_5  = $line[12];
                $sub_segment_1  = $line[13];
                $sub_segment_2  = $line[14];
                $sub_segment_3  = $line[15];
                $sub_segment_4  = $line[16];
                $sub_segment_5  = $line[17];
                $companis_list  = $line[18];
               
                //$insert_data['topic_id'] = mysqli_real_escape_string($conn, $_POST['topic']);
                $insert_data['bundle_name'] = mysqli_real_escape_string($conn, $bundle_name);
                 $insert_data['market_name'] = mysqli_real_escape_string($conn, $market_name);
                $insert_data['report_url'] = mysqli_real_escape_string($conn, $report_url);
                $insert_data['current_mark_size'] = mysqli_real_escape_string($conn, $current_mark_size);
                $insert_data['current_year'] = mysqli_real_escape_string($conn, $current_year);
                $insert_data['forecast_size'] = mysqli_real_escape_string($conn, $forecast_size);
                $insert_data['forecast_year'] = mysqli_real_escape_string($conn, $forecast_year);
                $insert_data['cagr'] = mysqli_real_escape_string($conn, $cagr);
                $insert_data['segment_1'] = mysqli_real_escape_string($conn, $segment_1);
                 $insert_data['segment_2'] = mysqli_real_escape_string($conn, $segment_2);
                $insert_data['segment_3'] = mysqli_real_escape_string($conn, $segment_3);
                $insert_data['segment_4'] = mysqli_real_escape_string($conn, $segment_4);
                $insert_data['segment_5'] = mysqli_real_escape_string($conn, $segment_5);
                $insert_data['sub_segment_1'] = mysqli_real_escape_string($conn, $sub_segment_1);
                $insert_data['sub_segment_2'] = mysqli_real_escape_string($conn, $sub_segment_2);
                $insert_data['sub_segment_3'] = mysqli_real_escape_string($conn, $sub_segment_3);
                 $insert_data['sub_segment_4'] = mysqli_real_escape_string($conn, $sub_segment_4);
                $insert_data['sub_segment_5'] = mysqli_real_escape_string($conn, $sub_segment_5);
                $insert_data['companis_list'] = mysqli_real_escape_string($conn, $companis_list);
                $insert_data['created_at'] = date("Y-m-d h:i:s");
                $insert_data['updated_at'] = date("Y-m-d h:i:s");
               
                $obj_category->insertBundleReport($insert_data, 0);
                $_SESSION['success'] = "<strong>Congratulations</strong> Company records inserted successfully";
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
            echo "<script> alert('bundle Report Added succesfully....'); </script>";
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page

header("Location: manage-bundle-report.php");

?>