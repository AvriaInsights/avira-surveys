<?php
require_once("classes/cls-blog.php");

$obj_blog = new Blog();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "blog_id, slug, created_at, title, status";
$condition = "";
$blog_details = $obj_blog->getBlogDetails($fields, $condition, '', '', 0);
//print_r($blog_details);
$blog_info = array();

foreach ($blog_details as $blog_detail) {
    $blog_data['blog_id'] = htmlspecialchars($blog_detail['blog_id']);
    $blog_data['title'] = htmlspecialchars($blog_detail['title']);
    $blog_data['created_at'] = htmlspecialchars(date("M j, Y H:i A", strtotime($blog_detail['created_at'])));
    $blog_data['status'] = htmlspecialchars($blog_detail['status']);
    $blog_data['action'] = '<a class="btn btn-success btn-circle" title="View Blog" target="_blank" href="'.SITEPATH.'/blog/'.$blog_detail['slug'].'"><i class="fa fa-list"></i></a>
                             <a class="btn btn-default btn-circle" title="Edit Blog" href="add-blog.php?blog_id='. base64_encode($blog_detail['blog_id']).'"><i class="fa fa-edit"></i></a>
                             <a class="btn btn-danger btn-circle"  data-toggle="confirmation" data-placement="top" data-original-title="" title="" data-href="delete-blog.php?blog_id='. base64_encode($blog_detail['blog_id']).'"><i class="fa fa-trash"></i></a>';
    
    $blog_info[] = $blog_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($blog_info),
    "iTotalDisplayRecords" => count($blog_info),
    "aaData" => $blog_info);

echo json_encode($results);


?>