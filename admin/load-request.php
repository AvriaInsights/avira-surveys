<?php
require_once("classes/cls-request.php");

$obj_request = new Request();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

if(!empty($_POST['priority']) && empty($_POST['frm_type']) && empty($_POST['cluster_type']) && empty($_POST['websitename']) && empty($_POST['fullname']) && empty($_POST['emailid']) && empty($_POST['contactno']) && empty($_POST['companyname']) && empty($_POST['datepicker']) && empty($_POST['relevancemap']))
{
    $condition = "`tbl_request`.`priority_wise`='".$_POST['priority']."'";
}
elseif(!empty($_POST['frm_type']) && empty($_POST['priority']))
{
    $splitfrm = explode("-",$_POST['frm_type']);
    $condition = "`tbl_request`.`website`='".$splitfrm[0]."' and `request_from_page`='".$splitfrm[1]."'";
}
elseif(!empty($_POST['frm_type']) && !empty($_POST['priority']))
{
    $splitfrm = explode("-",$_POST['frm_type']);
    $condition = "`tbl_request`.`priority_wise`='".$_POST['priority']."' and `tbl_request`.`website`='".$splitfrm[0]."' and `tbl_request`.`request_from_page`='".$splitfrm[1]."'";
}
elseif(!empty($_POST['cluster_type']) && empty($_POST['priority']))
{
    $condition = "`tbl_request`.`cluster_head_id`='".$_POST['cluster_type']."'";
}
elseif(!empty($_POST['cluster_type']) && !empty($_POST['priority']))
{
    $condition = "`tbl_request`.`priority_wise`='".$_POST['priority']."' and `tbl_request`.`cluster_head_id`='".$_POST['cluster_type']."'";
}
elseif(!empty($_POST['websitename']) && empty($_POST['priority']))
{
    $condition = "`tbl_request`.`website`='".$_POST['websitename']."'";
}
elseif(!empty($_POST['websitename']) && !empty($_POST['priority']))
{
    $condition = "`tbl_request`.`priority_wise`='".$_POST['priority']."' and `tbl_request`.`website`='".$_POST['websitename']."'";
}
elseif(!empty($_POST['fullname']) && empty($_POST['priority']))
{
    $condition = "`tbl_request`.`fname` like '".$_POST['fullname']."%'";
}
elseif(!empty($_POST['fullname']) && !empty($_POST['priority']))
{
    $condition = "`tbl_request`.`priority_wise`='".$_POST['priority']."' and `tbl_request`.`fname` like '".$_POST['fullname']."%'";
}
elseif(!empty($_POST['emailid']) && empty($_POST['priority']))
{
    $condition = "`tbl_request`.`email` like '".$_POST['emailid']."%'";
}
elseif(!empty($_POST['emailid']) && !empty($_POST['priority']))
{
    $condition = "`tbl_request`.`priority_wise`='".$_POST['priority']."' and `tbl_request`.`email` like '".$_POST['emailid']."%'";
}
elseif(!empty($_POST['contactno']) && empty($_POST['priority']))
{
    $condition = "`tbl_request`.`phone` like '".$_POST['contactno']."%' or `tbl_request`.`phone` like '%".$_POST['contactno']."'";
}
elseif(!empty($_POST['contactno']) && !empty($_POST['priority']))
{
    $condition = "`tbl_request`.`priority_wise`='".$_POST['priority']."' and `tbl_request`.`phone` like '".$_POST['contactno']."%' or `tbl_request`.`phone` like '%".$_POST['contactno']."'";
}
elseif(!empty($_POST['companyname']) && empty($_POST['priority']))
{
    $condition = "`tbl_request`.`company` like '".$_POST['companyname']."%'";
}
elseif(!empty($_POST['companyname']) && !empty($_POST['priority']))
{
    $condition = "`tbl_request`.`priority_wise`='".$_POST['priority']."' and `tbl_request`.`company` like '".$_POST['companyname']."%'";
}
elseif(!empty($_POST['datepicker']) && empty($_POST['priority']))
{
    $condition = "`tbl_request`.`created_at` like '".$_POST['datepicker']."%'";
}
elseif(!empty($_POST['datepicker']) && !empty($_POST['priority']))
{
    $condition = "`tbl_request`.`priority_wise`='".$_POST['priority']."' and `tbl_request`.`created_at` like '".$_POST['datepicker']."%'";
}
elseif(!empty($_POST['leadstagename']) && empty($_POST['priority']))
{
    $condition = "`tbl_request`.`lead_stage`='".$_POST['leadstagename']."'";
}
elseif(!empty($_POST['leadstagename']) && !empty($_POST['priority']))
{
    $condition = "`tbl_request`.`priority_wise`='".$_POST['priority']."' and `tbl_request`.`lead_stage`='".$_POST['leadstagename']."'";
}
elseif(!empty($_POST['relevancemap']) && empty($_POST['priority']))
{
    $condition = "`tbl_request`.`relevance_ids` like '%".$_POST['relevancemap']."%'";
}
elseif(!empty($_POST['relevancemap']) && !empty($_POST['priority']))
{
    $condition = "`tbl_request`.`priority_wise`='".$_POST['priority']."' and `tbl_request`.`relevance_ids` like '%".$_POST['relevancemap']."%'";
}
else
{
    $condition = "";
}



$fields = "`tbl_request`.*,`tbl_admin`.f_name,lname,email_id,admin_id";
$sort_by = "`tbl_request`.`created_at` DESC";
$request_details = $obj_request->getFullRequestLeadsDetails($fields, $condition,$sort_by, '', 0);
$request_info = array();

foreach ($request_details as $request_detail) {
    $request_data['created_at'] = htmlspecialchars($request_detail['created_at']);
    $request_data['fname'] = '<a href="javascript:void(0)" onclick="openNav();sendid('.$request_detail['request_id'].')">'.htmlspecialchars($request_detail['fname']).'</a>';
    $request_data['lead_owner'] = htmlspecialchars($request_detail['f_name']." ".$request_detail['lname']);
    $request_data['form_type'] = htmlspecialchars($request_detail['website'])." - ".htmlspecialchars($request_detail['request_from_page']);
    $request_data['lead_score'] = '<div class="text-center">'.htmlspecialchars($request_detail['priority_percent']).'</div>';
    $request_data['lead_type'] = '<div class="text-center">'.htmlspecialchars($request_detail['priority_wise']).'</div>';
    $request_info[] = $request_data;
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($request_info),
    "iTotalDisplayRecords" => count($request_info),
    "aaData" => $request_info);

echo json_encode($results);


?>
