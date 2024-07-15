<?php
require_once("classes/cls-testimonial.php");

$obj_testimonial = new Testimonial();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}
$fields = "testimonial_id, content, name, picture, place, status";
$condition = "";
$testimonial_details = $obj_testimonial->getTestimonialDetails($fields, $condition, '', '', 0);
$testimonial_info = array();

foreach ($testimonial_details as $testimonial_detail) {
    $testimonial_data['testimonial_id'] = htmlspecialchars($testimonial_detail['testimonial_id']);
    $testimonial_data['name'] = htmlspecialchars($testimonial_detail['name']);
    $testimonial_data['picture'] =  '<img src="'. htmlspecialchars($testimonial_detail['picture']).'" height="150" width="150" class="img-thumbnail" >';
    $testimonial_data['place'] = htmlspecialchars($testimonial_detail['place']);
    $testimonial_data['content'] = htmlspecialchars(substr($testimonial_detail['content'],0,30)) . "...";
    $testimonial_data['action'] = '<a class="btn btn-default btn-circle" title="Edit Testimonial" href="add-testimonial.php?testimonial_id='. base64_encode($testimonial_detail['testimonial_id']).'"><i class="fa fa-edit"></i></a>'
            . '                    <a class="btn btn-success btn-circle" title="View Testimonial" href="view-testimonial.php?testimonial_id='. base64_encode($testimonial_detail['testimonial_id']).'"><i class="fa fa-list"></i></a>
                                   <a class="btn btn-danger btn-circle"  data-toggle="confirmation" data-placement="top" data-original-title="" title="" data-href="delete-testimonial.php?testimonial_id='. base64_encode($testimonial_detail['testimonial_id']).'"><i class="fa fa-trash"></i></a>';
    $testimonial_info[] = $testimonial_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($testimonial_info),
    "iTotalDisplayRecords" => count($testimonial_info),
    "aaData" => $testimonial_info);

echo json_encode($results);


?>