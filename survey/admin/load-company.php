<?php
require_once("classes/cls-company.php");

$obj_company = new Company();

$conn = $obj_company->getConnectionObj();

if (!isset($_SESSION['ifg_admin']) && ($_SESSION['ifg_admin']['role'] != "superadmin" || $_SESSION['ifg_admin']['role'] != "admin")) {
    header("Location:login.php");
}

$fields = "cmp_id, company, email, website, status";
$condition = "";


$company_details = $obj_company->getCompanyDetails($fields, $condition, '', '', 0);
$company_info['data'] = array();

foreach ($company_details as $company_detail) {
    $company_data = array();
    $cid=$company_detail['cmp_id'];
    $company_data['cmp_id'] = htmlspecialchars($company_detail['cmp_id']);
    $company_data['company'] = htmlspecialchars(stripslashes($company_detail['company']));
   // $company_data['address'] = htmlspecialchars($company_detail['address']);
    $company_data['email'] =  htmlspecialchars($company_detail['email']);
    //$company_data['phone'] =  htmlspecialchars($company_detail['phone']);
    $company_data['website'] = htmlspecialchars($company_detail['website']);
    $company_data['status'] = htmlspecialchars($company_detail['status']);
    $company_data['action'] = '<a class="btn btn-success btn-circle" title="View Company Detail" id="myBtn" onclick="myFunction('.$cid.')"><i class="fa fa-list"></i></a>
    <a class="btn btn-success btn-circle" title="View Company Financial Detail" id="myBtnfinancial" onclick="financialFunction('.$cid.')"><i class="fa fa-list"></i></a>';
                             
   /* if($_SESSION['ifg_admin']['role'] == "superadmin") {
        $company_data['action'] .= '&nbsp;<a class="btn btn-danger btn-circle"  data-toggle="confirmation" data-placement="top" data-original-title="" title="" data-href="delete-report.php?company_id='. base64_encode($company_detail['cmp_id']).'"><i class="fa fa-trash"></i></a>';
        
    }*/

    $company_data = array_values($company_data);
    $company_info['data'][] = $company_data;
}

echo json_encode($company_info);


?>
