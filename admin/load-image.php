<?php
require_once("classes/cls-image.php");

$obj_image = new Image();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "image_id, picture, source, img_name";
$condition = "";
$image_details = $obj_image->getImageDetails($fields, $condition, '', '', 0);
$image_info = array();

foreach ($image_details as $image_detail) {
    $image_data['image_id'] = htmlspecialchars($image_detail['image_id']);
    $image_data['picture'] =  '<img src="'. htmlspecialchars($image_detail['picture']).'" height="150" width="150" class="img-thumbnail" >';
    $image_data['source'] =  htmlspecialchars($image_detail['source']);
    $image_data['img_name'] =  htmlspecialchars($image_detail['img_name']);
    $image_data['action'] = '<a class="btn btn-success btn-circle" title="View Image" href="view-image.php?image_id='. base64_encode($image_detail['image_id']).'"><i class="fa fa-list"></i></a>
	<a class="btn btn-danger btn-circle"  data-toggle="confirmation" data-placement="top" data-original-title="" title="" data-href="delete-image.php?image_id='. base64_encode($image_detail['image_id']).'"><i class="fa fa-trash"></i></a>';
    $image_info[] = $image_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($image_info),
    "iTotalDisplayRecords" => count($image_info),
    "aaData" => $image_info);

echo json_encode($results);


?>