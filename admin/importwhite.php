<?php

require_once("classes/cls-white.php");
require_once("classes/cls-category.php");
include_once('classes/easyphpthumbnail.class.php');

$obj_report = new White();
$obj_category = new Category();
$conn = $obj_report->getConnectionObj();


if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
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
                $product_title   = $line[0];
                $category_id  = $line[1];
                $description  = $line[2];
                $slug = $line[3];
                $content  = $line[4];
                $published_date  = $line[5];
                $author_name  = $line[6];
                $author_designation  = $line[7];
                
                
                    // category ID
                
    $keywords_slug = $obj_report->removeSpace($slug."");
    $slug = $obj_report->removeSpace($slug."");
   
   // $report_link = SITEPATH . "report/" . $report_id . "/" . $keywords_slug;
    
                    // Insert member data in the database

    $insert_data['slug'] = mysqli_real_escape_string($conn, $slug);
    $insert_data['title'] = mysqli_real_escape_string($conn, $product_title);
    $insert_data['description'] = mysqli_real_escape_string($conn, $description);
    $insert_data['paper_content'] = mysqli_real_escape_string($conn, $content);
    $insert_data['category_id'] = mysqli_real_escape_string($conn, $category_id);
    $insert_data['author_name'] = mysqli_real_escape_string($conn, $author_name);
    $insert_data['author_designation'] = mysqli_real_escape_string($conn, $author_designation);
    $insert_data['published_date'] = mysqli_real_escape_string($conn, $published_date);
    $insert_data['featured'] = "Yes";
    $insert_data['status'] = "Active";
    $insert_data['created_at'] = date("Y-m-d H:i:s");
    $insert_data['updated_at'] = date("Y-m-d H:i:s");
    $obj_report->insertReport($insert_data, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> White paper information has been inserted successfully";
                    
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

//header("Location: manage-white-paper.php");

?>