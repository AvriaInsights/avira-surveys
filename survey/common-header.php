<?php
require_once("classes/cls-survey.php");
$obj_survey = new Survey();?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>Avira Survey</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
        <link href="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
        <link href="bower_components/chosen/bootstrap-chosen.css" rel="stylesheet" type="text/css">
        <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" >
        <link rel="stylesheet" href="<?php echo SITEPATH; ?>css/style.css">
        <link rel="stylesheet" href="<?php echo SITEPATH; ?>dist/css/sb-admin-2.css">
        <link rel="stylesheet" href="<?php echo SITEPATH; ?>css/responsive.css">
        <link rel="icon" href="<?php echo SITEPATHFRONT; ?>images/Avira-Survey-Logo_Favicon.png">
  </head>
  <body>