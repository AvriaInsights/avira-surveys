<?php
require_once("classes/cls-leads.php");
//print_r($_SESSION);die();
if($_SESSION['ifg_admin']['admin_id']=="") {
    header("Location:login");
}
else
{
    header("Location:dashboard");
}
?>