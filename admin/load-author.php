<?php
require_once("classes/cls-author.php");

$obj_author = new Author();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "author_id, fullname, created_at";
$condition = "";
$author_details = $obj_author->getAuthorDetails($fields, $condition, '', '', 0);
$author_info = array();

foreach ($author_details as $author_detail) {
    $author_data['author_id'] = htmlspecialchars($author_detail['author_id']);
    $author_data['fullname'] = htmlspecialchars($author_detail['fullname']);
    $author_data['created_at'] = date("F j, Y h:i A", strtotime($author_detail['created_at']));
    $author_data['action'] = '<a class="btn btn-default btn-circle" title="Edit Author" href="add-author.php?author_id='. base64_encode($author_detail['author_id']).'"><i class="fa fa-edit"></i></a>
                             <a class="btn btn-danger btn-circle"  data-toggle="confirmation" data-placement="top" data-original-title="" title="" data-href="delete-author.php?author_id='. base64_encode($author_detail['author_id']).'"><i class="fa fa-trash"></i></a>';
    
    $author_info[] = $author_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($author_info),
    "iTotalDisplayRecords" => count($author_info),
    "aaData" => $author_info);

echo json_encode($results);


?>