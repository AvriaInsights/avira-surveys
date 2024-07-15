<?php 

require_once("classes/cls-report.php");
require_once("classes/cls-category.php");
include_once('classes/easyphpthumbnail.class.php');

$obj_report = new Report();
$obj_category = new Category();
$conn = $obj_report->getConnectionObj();


if(isset($_POST['importSubmit'])){
     
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

                $report_id  = $line[0];
                $report_title  = $line[1];

            
                $insert_data['scroll_line'] = mysqli_real_escape_string($conn, "Scroll");
                $obj_report->updateReport($insert_data, $report_id, 0);
                $_SESSION['success'] = "<strong>Congratulations</strong> Company records inserted successfully";
                    
                    
                    
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
            echo "<script> alert('Record Added succesfully....'); </script>";
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page

header("Location: manage-report.php");

?>