<?php 

require_once("classes/cls-report.php");
require_once("classes/cls-category.php");
include_once('classes/easyphpthumbnail.class.php');

$obj_report = new Report();
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
                $pages  = $line[1];
                $single_user  = $line[2];
                $enterprise_user = $line[3];
                $corporate_user  = $line[4];
                $published_date  = $line[5];
                $summary  = $line[6];
                $toc  = $line[7];
                $tof  = $line[8];
                $category  = $line[9];
                $meta_title  = $line[10];
                $meta_desc  = $line[11];
                $meta_keyword  = $line[12];
                $cust_url = $line[13];
                $is_bulk = $line[14];
                $copies = "0";
                $pictures = "https://www.alltheresearch.com/admin/upload/default.png";
                
                    // category ID
    
    $condition = "`category_id` = '".$category."'";
    $shortcode_details = $obj_category->getCategoryDetails("`shortcode`", $condition, '', 1, 0);
    $shortcode_detail = end($shortcode_details);
    $shortcode = $shortcode_detail['shortcode'];
                
                 //Generate SKU
    $report_details = $obj_report->getReportDetails('MAX(`report_id`) as report_id', '','',1,0);
    $report_detail = end($report_details);
    $report_id = $report_detail['report_id'];
    $report_id += 1;
    $sku = $obj_report->generateSKU($report_id, $shortcode);
    $keywords = $obj_report->removeSpace($cust_url);
    $keywords_slug = $obj_report->removeSpace($cust_url."");
    $slug = $obj_report->removeSpace($cust_url."-market");
    $report_link = SITEPATH . "report/" . $report_id . "/" . $keywords_slug;
    
    
    
                    // Insert member data in the database
                    
    $insert_data['sku'] = mysqli_real_escape_string($conn, $sku);
    $insert_data['slug'] = mysqli_real_escape_string($conn, $slug);
    $insert_data['title'] = mysqli_real_escape_string($conn, $product_title);
    $insert_data['url_keywords'] = mysqli_real_escape_string($conn, $cust_url);
    $insert_data['picture'] = mysqli_real_escape_string($conn, $pictures);
    $insert_data['keywords'] = mysqli_real_escape_string($conn, $keywords);
    $insert_data['description'] = mysqli_real_escape_string($conn, $summary);
    $insert_data['toc'] = mysqli_real_escape_string($conn, $toc);
    $insert_data['tnf'] = mysqli_real_escape_string($conn, $tof);
    $insert_data['price'] = mysqli_real_escape_string($conn, $single_user);
    $insert_data['eprice'] = mysqli_real_escape_string($conn, $enterprise_user);
    $insert_data['category_id'] = mysqli_real_escape_string($conn, $category);
    //$insert_data['category_Sub_id'] = mysqli_real_escape_string($conn, $sub_category);
    $insert_data['author_id'] = mysqli_real_escape_string($conn, "1");
    $insert_data['pages'] = mysqli_real_escape_string($conn, $pages);
    $insert_data['published_date'] = mysqli_real_escape_string($conn, $published_date);
    $insert_data['report_link'] = mysqli_real_escape_string($conn, $report_link);
    $insert_data['copies'] = trim($copies);
    $insert_data['meta_title'] = mysqli_real_escape_string($conn, $meta_title);
    $insert_data['meta_keyword'] = mysqli_real_escape_string($conn, $meta_keyword);
    $insert_data['meta_description'] = mysqli_real_escape_string($conn, $meta_desc);
    $insert_data['is_bulk'] = mysqli_real_escape_string($conn, $is_bulk);
    $insert_data['featured'] = "Yes";
    $insert_data['status'] = "Active";
    $insert_data['created_at'] = date("Y-m-d H:i:s");
    $insert_data['updated_at'] = date("Y-m-d H:i:s");
    $obj_report->insertReport($insert_data, 0);
    $_SESSION['success'] = "<strong>Congratulations</strong> Report information has been inserted successfully";
                    
                    
                    
                           
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