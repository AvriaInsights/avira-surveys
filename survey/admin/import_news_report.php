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
             
                $news = trim($line[0]);
                    $category_detail = $obj_category->getSingleNewsDetail('bundle_name', "bundle_name = '" . $news . "'", '', 1, 0);
                    if (isset($category_detail) && !empty($category_detail)) {
                        $bundle_name = $category_detail['bundle_name'];
                    } 
                    else{
                        $bundle_name = "";
                    }

                $title  = $line[1];
                $description  = $line[2];
                //$category  = $line[3];
                //$insert_data['topic_id'] = mysqli_real_escape_string($conn, $_POST['topic']);
                $insert_data['bundle_name'] = mysqli_real_escape_string($conn, $bundle_name);
                $insert_data['title'] = mysqli_real_escape_string($conn, $title);
                $insert_data['description'] = mysqli_real_escape_string($conn, $description);
                $insert_data['created_at'] = date("Y-m-d h:i:s");
                $insert_data['updated_at'] = date("Y-m-d h:i:s");
                
                $obj_category->insertnewsReport($insert_data, 0);
                $_SESSION['success'] = "<strong>Congratulations</strong> Company records inserted successfully";
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
            echo "<script> alert('News Record Added succesfully....'); </script>";
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page

header("Location:manage-news-reports.php");

?>