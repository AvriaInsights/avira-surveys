<?php

require_once("../lib/csv/vendor/autoload.php");
require_once("classes/cls-report.php");
require_once("classes/cls-category.php");
require_once("classes/cls-author.php");

use ParseCsv\Csv;

$obj_csv = new Csv();
$obj_report = new Report();
$obj_category = new Category();
$obj_author = new Author();

$inserted = $updated = 0;

$conn = $obj_report->getConnectionObj();
if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
if (isset($_FILES['csv_file']) && !empty($_FILES['csv_file'])) {
    $type = $_FILES['csv_file']['type'];
    if ($type == "application/vnd.ms-excel" || $type == "text/csv") {
        $file = $_FILES['csv_file']['tmp_name'];
        $obj_csv->auto($file);
        $csv_data = $obj_csv->data;
        if (isset($csv_data) && !empty($csv_data)) {
            foreach ($csv_data as $key => $data) {
                
                $coloumn_count = count($data);
                if ($coloumn_count) {
                    $sku = addslashes(trim($data['SKU'], '"'));
                    //get category_id
                    $category = addslashes(trim($data['Category'], '"'));
                    $category_detail = $obj_category->getSingleCategoryDetail('category_id, shortcode', "title LIKE '%" . $category . "%'", '', 1, 0);
                    if (isset($category_detail) && !empty($category_detail)) {
                        $category_id = $category_detail['category_id'];
                        $shortcode = $category_detail['shortcode'];
                    } else {
                        $category_id = 1;
                        $shortcode = "AD";
                    }

                    if (isset($data['Author']) && $data['Author'] != "") {
                        $author = addslashes(trim($data['Author'], '"'));
                        $author_detail = $obj_author->getSingleAuthorDetail('author_id', "fullname = '" . $author . "'", '', 1, 0);
                        if (isset($author_detail) && !empty($author_detail)) {
                            $author_id = $author_detail['author_id'];
                        } else {
                            $author_id = 1;
                        }
                    } else {
                        $author_id = 1;
                    }

                    $title = strip_tags($data['Title']);
                    $url_keywords = strip_tags($data['Url_Keywords']);
                    if (isset($title) && $title != "") {
                        $description = nl2br(($data['Description']),false); 
						
                        $meta_title = $obj_report->sanitizeOutput($title);
                        $meta_keywords = "";
                        $meta_description = "";
						$toc = nl2br(($data['TOC']),false); 
						$tnf = nl2br(($data['TNF']),false); 

                        $slug = $obj_report->removeSpace(($url_keywords)."-market");
                        $condition = "`slug` = '" . $slug . "'";
                        $report_details = $obj_report->getReportDetails('*', $condition, '', '', 0);
                        if (!empty($report_details) && count($report_details) > 0) {
                            $report_detail = end($report_details);

                            $report_id = $report_detail['report_id'];
                            $report_link = SITEPATH . "report/" . $report_detail['report_id'] . "/" . $slug;
                            $sku_code = $obj_report->generateSKU($report_id, $shortcode);

                            $update_data['sku'] = mysqli_real_escape_string($conn, $sku_code);
                            $update_data['slug'] = mysqli_real_escape_string($conn, $slug);
                            $update_data['report_link'] = mysqli_real_escape_string($conn, $report_link);
                            $update_data['title'] = mysqli_real_escape_string($conn, $title);
                            $update_data['keywords'] = mysqli_real_escape_string($conn, $keywords);
                            $update_data['price'] = mysqli_real_escape_string($conn, addslashes(trim(preg_replace("/([^0-9\\.])/i", "", $data['Single User Price']), '"')));
                            $update_data['eprice'] = mysqli_real_escape_string($conn, addslashes(trim(preg_replace("/([^0-9\\.])/i", "", $data['Enterprise User Price']), '"')));
                            $update_data['published_date'] = date("Y-m-d", strtotime(mysqli_real_escape_string($conn, addslashes(trim($data['Published Date'], '"')))));
                            $update_data['pages'] = mysqli_real_escape_string($conn, addslashes(trim($data['Pages'], '"')));
                            $update_data['copies'] = 0;
                            $update_data['meta_title'] = mysqli_real_escape_string($conn, $meta_title);
                            $update_data['meta_keyword'] = mysqli_real_escape_string($conn, $meta_keywords);
                            $update_data['meta_description'] = mysqli_real_escape_string($conn, $meta_description);
                            $update_data['status'] = "Active";
                            $update_data['category_id'] = mysqli_real_escape_string($conn, $category_id);
                            $update_data['author_id'] = mysqli_real_escape_string($conn, $author_id);
                            $update_data['description'] = mysqli_real_escape_string($conn, $description);
                            $update_data['url_keywords'] = mysqli_real_escape_string($conn, $url_keywords);
                            $update_data['toc'] = mysqli_real_escape_string($conn, $toc);
                            $update_data['tnf'] = mysqli_real_escape_string($conn, $tnf);
                            $update_data['updated_at'] = date("Y-m-d h:i:s");
                            $report_status = $obj_report->updateReport($update_data, $condition, 0);
                            $updated++;
                        } else {
                            $report_detail = $obj_report->getSingleReportDetail('MAX(`report_id`) as report_id', '', '', 1, 0);
                            $report_id = $report_detail['report_id'];
                            $report_id = $report_id ? $report_id + 1 : 1;
                            $report_link = SITEPATH . "report/" . $report_id . "/" . $slug;
                            $sku_code = $obj_report->generateSKU($report_id, $shortcode);
                            $insert_data['sku'] = mysqli_real_escape_string($conn, $sku_code);
                            $insert_data['slug'] = mysqli_real_escape_string($conn, $slug);
                            $insert_data['report_link'] = mysqli_real_escape_string($conn, $report_link);
                            $insert_data['title'] = mysqli_real_escape_string($conn, $title);
                            $insert_data['price'] = mysqli_real_escape_string($conn, addslashes(trim(preg_replace("/([^0-9\\.])/i", "", $data['Single User Price']), '"')));
                            $insert_data['eprice'] = mysqli_real_escape_string($conn, addslashes(trim(preg_replace("/([^0-9\\.])/i", "", $data['Enterprise User Price']), '"')));
                            $insert_data['published_date'] = date("Y-m-d", strtotime(mysqli_real_escape_string($conn, addslashes(trim($data['Published Date'], '"')))));
                            $insert_data['pages'] = mysqli_real_escape_string($conn, addslashes(trim($data['Pages'], '"')));
                            $insert_data['copies'] = 0;
                            $insert_data['meta_title'] = mysqli_real_escape_string($conn, $meta_title);
                            $insert_data['meta_keyword'] = mysqli_real_escape_string($conn, $meta_keywords);
                            $insert_data['meta_description'] = mysqli_real_escape_string($conn, $meta_description);
                            $insert_data['status'] = "Active";
                            $insert_data['category_id'] = mysqli_real_escape_string($conn, $category_id);
                            $insert_data['author_id'] = mysqli_real_escape_string($conn, $author_id);
                            $insert_data['description'] = mysqli_real_escape_string($conn, $description);
                            $insert_data['url_keywords'] = mysqli_real_escape_string($conn, $url_keywords);
                            $insert_data['toc'] = mysqli_real_escape_string($conn, $toc);
                            $insert_data['tnf'] = mysqli_real_escape_string($conn, $tnf);
                            $insert_data['created_at'] = date("Y-m-d h:i:s");
                            $insert_data['updated_at'] = date("Y-m-d h:i:s");
                            $report_status = $obj_report->insertReport($insert_data, 0);
                            $inserted++;
                        }
                    }
                } else {
                    $_SESSION['error'] = "<strong>Sorry</strong> Cannot read the records from CSV file.";
                    header("Location:manage-report.php");
                    exit();
                }
            }
            $_SESSION['success'] = "<strong>Congratulations</strong> Report has been Imported successfully";
            header("Location:manage-report.php");
        } else {
            
        }
    } else {
        $_SESSION['error'] = "<strong>Sorry</strong> Please select the valid CSV file";
        header("Location:manage-report.php");
    }
} else {
    $_SESSION['error'] = "<strong>Sorry</strong> Please select the CSV file";
    header("Location:manage-report.php");
}
?>