<?php
require_once("classes/cls-survey.php");
$obj_survey = new Survey();?>
<?php include('../header.php');?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo SITEPATH; ?>css/responsive.css">
<header class="common-header-main" id="myHeader">
    <div class="top-header pt-4 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6">
                    <ul class="list-unstyled justify-content-end d-flex mb-0 pe-6 mob-top-menu">
                        <li>
                            <a href="tel:1 (407) 768-2028">
                                <i class="fa fa-phone"></i>
                                  +1 (407) 768-2028
                            </a>
                        </li>
                        <li>
                            <a href="mailto:<?php echo SITEEMAIL; ?>">
                                <i class="fa fa-envelope"></i>
                                <?php echo SITEEMAIL; ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7"></div>
                <div class="col-md-5">
                    <ul class="list-unstyled d-flex top-list justify-content-end tab-view mt-3 mb-0">
                         <li>
                            <a href="<?php echo SITEPATHFRONT; ?>survey/login" class="btn-login">Login</a>
                        </li>
                        <li>
                             <a href="<?php echo SITEPATHFRONT; ?>register" class="btn ms-0 me-0 btn-signup">Sign Up</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="<?php echo SITEPATHFRONT; ?>">
                    <img src="<?php echo SITEPATHFRONT; ?>images/logo-dark.png" alt="survey-logo" class="img-fluid company-logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="ms-auto d-flex">
                        <!--<form class="d-flex">-->
                        <!--    <input class="form-control search-holder" type="search" placeholder="Search" aria-label="Search">-->
                        <!--    <button class="btn search-btn" type="submit">-->
                        <!--        <i class="fa fa-search"></i>-->
                        <!--    </button>-->
                        <!--</form>-->
                        
                        <div class="">
                            <div class="site-mobile-menu-header">
                                <div class="site-mobile-menu-close mt-3">
                                    <span class="icon-close2 js-menu-toggle">
                                    </span>
                                </div>
                            </div>
                        </div>
                            <ul class="list-unstyled d-flex top-list align-items-center mb-0 mob-menu">
                                
                                <li class="nav-menu2 first-menu" id="survey-list">
                                    <a href="<?php echo SITEPATHFRONT; ?>survey-list">Survey List</a>
                                </li>
                                
                                 <li class="nav-menu2" id="contact-us">
                                    <a href="<?php echo SITEPATHFRONT; ?>contact-us">Contact Us</a>
                                </li>
                                
                                <li>
                                    <a href="<?php echo SITEPATHFRONT; ?>survey/login" class="btn-login desk-top-btn">Login</a>
                                </li>
                                <li>
                                     <a href="<?php echo SITEPATHFRONT; ?>register" class="btn ms-0 me-0 btn-signup desk-top-btn">Sign Up</a>
                                </li>
                                <li>
                                    <div class="search-menu toggled " style="display:none">
                                    <div class="site-mobile-menu-close mt-3">
                                        <span class="icon-close2 js-menu-toggle text-white search-bar-close"></span>
                                    </div>
                                    <div class="wrapper">
                                        <div class="text-center pb-5">
                                           <img src="images/logo-dark.png" alt="survey-logo" class="img-fluid company-logo">
                                        </div>
                                        <div id="form">
                                            <input class="popup-search" type="text" placeholder="Find Market Research Report"
                                            id="popupsearch" name="popupsearch">
                                            <div class="">
                                                <div class="searchrow">
                                                    <div class="col-md-12">
                                                    <div id="searchpopup" style="display: none;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <button class="popup-search-button" type="button" id="header_search">
                                                <i class="fa fa-search search-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                  </div>
                                     <i class="fa fa-search search-icon" style="display: none;"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                </nav>
            </div>
 
</header>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function MakeMenuActive(Item)
{
    $("#menu .menu-active").removeClass("menu-active");
    $("#" + Item).addClass("menu-active");
}
 $('.js-menu-toggle').click(function(){
            $(".navbar-collapse").hide();
       });
       
       $('.navbar-toggler').click(function(){
          $(".navbar-collapse").show(); 
       });
</script>