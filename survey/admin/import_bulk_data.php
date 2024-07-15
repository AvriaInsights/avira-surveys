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
             
                   
                $bundle_name  = $line[0];

                $category_id = trim($line[1]);
                    /*$category_detail = $obj_category->getSingleCategoryDetail('category_id', "title = '" . $category . "'", '', 1, 0);
                    if (isset($category_detail) && !empty($category_detail)) {
                        $category_id = $category_detail['category_id'];
                    } 
                    else{
                        $category_id = 0;
                    }*/
                   
                $bundle_image  = $line[2];
                $bundle_overview  = $line[3];
                $bundle_overview2  = $line[4];
                $market_data  = $line[5];
                $market_image  = $line[6];
              
                $insert_data['category_id'] = mysqli_real_escape_string($conn, $category_id);
                $insert_data['bundle_name'] = mysqli_real_escape_string($conn, $bundle_name);
                $insert_data['bundle_image'] = mysqli_real_escape_string($conn, $bundle_image);
                $insert_data['bundle_overview'] = mysqli_real_escape_string($conn, $bundle_overview);
                $insert_data['bundle_overview2'] = mysqli_real_escape_string($conn, $bundle_overview2);
                $insert_data['market_data'] = mysqli_real_escape_string($conn, $market_data);
                $insert_data['market_image'] = mysqli_real_escape_string($conn, $market_image);
                $insert_data['status'] = 'Active';
                $insert_data['created_at'] = date("Y-m-d h:i:s");
                $insert_data['updated_at'] = date("Y-m-d h:i:s");
                $obj_report->insertTopic($insert_data, 0);
                $_SESSION['success'] = "<strong>Congratulations</strong> Company records inserted successfully";
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
            echo "<script> alert('Topic Record Added succesfully....'); </script>";
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page

 header("Location:manage-topic.php");

?>