<?php
require_once("classes/cls-survey.php");
$obj_survey = new Survey();
$userrole=$_SESSION['ifg_admin']['role'];
$userid=$_SESSION['ifg_admin']['client_id'];
require_once("classes/cls-user.php");
$obj_user = new User();
$fields_user = "*";
$condition = "`tbl_client_user`.`client_id` = '".$userid."'";
$user_details = $obj_user->getUserclientDetails($fields_user, $condition,'','', 0);
 foreach($user_details as $user){
     $fname = $user['fname'];
     $lname = $user['lname'];
     $profile_img = $user['profile_image'];
 }
 ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>Avira Survey</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo SITEPATH; ?>bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo SITEPATH; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo SITEPATH; ?>css/responsive.css">
    <link rel="icon" href="<?php echo SITEPATHFRONT; ?>images/Avira-Survey-Logo_Favicon.png">
</head>
<body>
    
<div id="overlayer_f"></div>
<span class="loader">
 <img src="<?php echo SITEPATH; ?>images/page-loading.gif">
</span> 
    
    <header>
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <div class="container-fluid ps-5 pe-5">
                    <a class="navbar-brand" href="<?php echo SITEPATH;?>"> <img class="logo-dash" src="<?php echo SITEPATH; ?>/images/dash-logo.png"> </a>
                    <div class="collapse navbar-collapse d-nav-menu">
                      <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <li class="nav-item">
                          <a class="nav-link" href="<?php echo SITEPATH;?>dashboard">Dashboard</a>
                        </li>
                        <?php if($userrole == "superadmin"){ ?>
                        <li class="nav-item">
                          <a class="nav-link" href="<?php echo SITEPATH;?>survey-client-list">Client List</a>
                        </li>
                        <?php }?>
                        <!--<li class="nav-item">-->
                        <!--  <a class="nav-link" href="#">Contacts</a>-->
                        <!--</li>-->
                        <li class="nav-item">
                          <a class="nav-link" href="<?php echo SITEPATH;?>template-list">Templates</a>
                        </li>
                        <!--<li class="nav-item">-->
                        <!--  <a class="nav-link" href="#">Settings</a>-->
                        <!--</li>-->
                        <li class="nav-item">
                          <a class="nav-link" href="<?php echo SITEPATHFRONT ?>contact-us" target="_blank">Help</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="survey-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="fa fa-plus"></i>
                            New Survey</a>
                        </li>
                        <li>
                            <div class="header-rigth">
                                <ul class="list-unstyled right-nav-menu">
                                    <li class="dropdown" style="float:right;">
                                        <div class="user-profile">
                                            <a href="" data-bs-toggle="dropdown" aria-expanded="false" class="dropdown-toggle p-0" id="dropdownMenuButton2">
                                                <?php if ($profile_img == ""){ ?>
                                                            <img src="<?php echo SITEPATH; ?>upload/default.png" class="img-fluid"></img>
                                                            <?php } else { ?>
                                                            <img src="<?php echo $profile_img; ?>" class="img-fluid"></img>
                                                            <?php } ?>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                <li><a class="dropdown-item" href="<?php echo SITEPATH; ?>user-profile">Edit</a></li>
                                                <li><a class="dropdown-item" href="<?php echo SITEPATH; ?>logout">Logout</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                             </div>
                        </li>
                      </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="padding-top:65px;">
  <div class="modal-dialog new-survey-popup modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header modal-c-btn border-0 p-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ps-0">
          <div class="row">
              <div class="col-md-3 pe-0 border-end">
                  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-manual-tab" data-bs-toggle="pill" data-bs-target="#v-pills-manual" 
                    type="button" role="tab" aria-controls="v-pills-manual" aria-selected="true">
                        <i class="fa fa-folder"></i>Start Manual</button>
                    <!--<button class="nav-link" id="v-pills-bulk-upload-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bulk-upload" type="button" -->
                    <!--role="tab" aria-controls="v-pills-bulk-upload" aria-selected="false">-->
                    <!--    <i class="fa fa-upload"></i>-->
                    <!--    Bulk Upload</button>-->
                    <!--<button class="nav-link" id="v-pills-copy-paste-tab" data-bs-toggle="pill" data-bs-target="#v-pills-copy-paste" type="button" -->
                    <!--role="tab" aria-controls="v-pills-copy-paste" aria-selected="false">-->
                    <!--    <i class="fa fa-copy"></i>Copy Paste</button>-->
                    <button class="nav-link" id="v-pills-analyst-tab" data-bs-toggle="pill" data-bs-target="#v-pills-analyst" type="button" 
                    role="tab" aria-controls="v-pills-analyst" aria-selected="false">
                        <i class="fa fa-file"></i>Send to Analyst
                    </button>
                   
                  </div>
              </div>
              <div class="col-md-9 ps-0">
                  <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-manual" role="tabpanel" aria-labelledby="v-pills-manual-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tab-details-content">
                                    <h2 class="text-center">Manual Survey</h2>
                                    <img src="<?php echo SITEPATH; ?>images/Manual.png" class="img-fluid" >
                                    <div class="survey-cta-btn text-center">
                                        <a href="<?php echo SITEPATH;?>add-survey" class="start-survey-btn">Start Survey</a>
                                        <p class="mb-0">Or</p>
                                        <a href="<?php echo SITEPATH;?>template-list" class="browse-btn">Browse Templates</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-bulk-upload" role="tabpanel" aria-labelledby="v-pills-bulk-upload-tab">
                         <div class="row">
                            <div class="col-md-12">
                                <div class="tab-details-content">
                                    <h2 class="text-center">Bulk Upload</h2>
                                    <img src="<?php echo SITEPATH; ?>images/bulk upload.png" class="img-fluid" >
                                    <div class="survey-cta-btn text-center">
                                        <a href="<?php echo SITEPATH;?>bulk-survey.php" class="start-survey-btn">Bulk Upload</a>
                                        <!--<p class="mb-0">Or</p>-->
                                        <!--<a href="#" class="browse-btn">Browse Templates</a>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-copy-paste" role="tabpanel" aria-labelledby="v-pills-copy-paste-tab">
                         <div class="row">
                            <div class="col-md-12">
                                <div class="tab-details-content">
                                    <h2 class="text-center">Copy Paste</h2>
                                    <img src="<?php echo SITEPATH; ?>images/Copy Paste.png" class="img-fluid" >
                                    <div class="survey-cta-btn text-center">
                                        <a href="<?php echo SITEPATH;?>copy-paste-survey.php" class="start-survey-btn">Copy Paste</a>
                                        <!--<p class="mb-0">Or</p>-->
                                        <!--<a href="#" class="browse-btn">Browse Templates</a>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-analyst" role="tabpanel" aria-labelledby="v-pills-analyst-tab">
                         <div class="row">
                            <div class="col-md-12">
                                <div class="tab-details-content">
                                    <h2 class="text-center">Analyst</h2>
                                    <img src="<?php echo SITEPATH; ?>images/Analyst.png" class="img-fluid" >
                                    <div class="survey-cta-btn text-center">
                                        <a href="<?php echo SITEPATH;?>build-with-analyst.php" class="start-survey-btn">Build With Analyst</a>
                                        <!--<p class="mb-0">Or</p>-->
                                        <!--<a href="#" class="browse-btn">Browse Templates</a>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
          </div>
      </div>
      
    </div>
  </div>
</div>