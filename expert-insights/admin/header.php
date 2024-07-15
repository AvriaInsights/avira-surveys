<?php
require_once("classes/cls-admin.php");
$obj_admin = new Admin();
$conn = $obj_admin->getConnectionObj();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>Lead CRM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="icon" href="images/favicon.ico">
    <meta name="robots" content="noindex, nofollow">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">
    <link rel="stylesheet" href="<?php echo SITEPATH; ?>css/custom.css">
    <link rel="stylesheet" href="<?php echo SITEPATH; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo SITEPATH; ?>css/responsive.css">
    </head>
    <body>
 
    <header>
        <nav class="navbar navbar-expand-lg p-0">
            <section class="home-section">
                <div class="container-fluid pe-5 bg-purple">
                 
                </div>
            </section>
        </nav>
    </header>