<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();
if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}
$userid=$_SESSION['ifg_admin']['client_id'];

?>
<link rel="icon" href="<?php echo SITEPATHFRONT; ?>images/Avira-Survey-Logo_Favicon.png">
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/modal-style.css">
<style>

.content-wrapper-share {
    /*background:#fff;*/
    top: 7rem;
    left: 22.7rem;
    right: 0;
    padding: 12rem 0;
}
.clipboard {
  position: relative;
}
/* You just need to get this field */
.copy-input {
  max-width: 500px;
  width: 100%;
  cursor: pointer;
  /*background-color: #eaeaeb;*/
  border:none;
  color:#6c6c6c;
  font-size: 14px;
  border-radius: 1px;
  padding: 10px 10px 10px 10px;
  border:1px solid #010B44;
  font-family: 'Montserrat', sans-serif;
  /*box-shadow: 0 3px 15px #b8c6db;*/
  /*-moz-box-shadow: 0 3px 15px #b8c6db;*/
  /*-webkit-box-shadow: 0 3px 15px #b8c6db;*/
}
.copy-input:focus {
  outline:none;
}

.copy-btn {
  /*width:40px;*/
  background-color: #010B44;
  font-size: 14px;
  padding: 6px 9px;
  border-radius: 0px;
  border:none;
  color:#fff;
  margin-left:-3px;
  height:43px;
  /*transition: all .4s;*/
}
.copy-btn:hover {
  /*transform: scale(1.3);*/
  color:#fff;
  cursor:pointer;
}

.copy-btn:focus {
  outline:none;
}

.copied {
  font-family: 'Montserrat', sans-serif;
  width: 75px;
  display: none;
  position:fixed;
  top: 199;
  left: 680;
  right: 0;
  margin: auto;
  color:#000;
  padding: 15px 15px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 3px 15px #b8c6db;
  -moz-box-shadow: 0 3px 15px #b8c6db;
  -webkit-box-shadow: 0 3px 15px #b8c6db;
}
/* You just need to get this field */

.modal-backdrop.show{
            opacity: .7;
    }
    .modal-title{
            font-size: 15px;
             color: #f30505;
    }
    .create-survey-modal .form-control{
        display: block;
    width: 100%;
     height: calc(3rem + .75rem + 2px); 
    padding: 0.8rem 1rem;
    font-size: 1.4rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5c5c5;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .popupmarbutton{
        font-size:18px;
    }
    label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
    font-size:13px;
    }
    .error {
    color: #FF0000;
    }
    .mt-25{margin-top:25rem;}
   
.right-user-menu li a {
    padding: 1rem 2.4rem;
    font-size: 1.4rem;
    color: #000 !important;
}
body{background:none !important;}
</style>
<script src="https://kit.fontawesome.com/d97b87339f.js" crossorigin="anonymous"></script>
<div class="wrapper">
   <?php //include("sidebarmenu.php")?>
        <?php include("header.php")?>
        <link rel="stylesheet" href="<?php echo SITEPATHFRONT; ?>css/style.css">
        <link rel="stylesheet" href="<?php echo SITEPATHFRONT; ?>css/responsive.css">
        
<section class="d-flex align-items-center justify-content-center">
    <div class="container mt-5">
        <div class="row d-flex align-items-center">
            <div class="col-md-12">
                <div class="text-end">
                    <img src="<?php echo SITEPATHFRONT ?>images/pattern-top.png" class="img-fluid pattern-img-right">
                </div>
            </div>
            <div class="container">
                <div class="row d-flex">
                    <div class="col-md-3 offset-md-1">
                        <img src="<?php echo SITEPATHFRONT?>/images/Character-for-reset-password.png" class="img-fluid fpassword-image">
                    </div>
                    <div class="col-md-7 text-center fpassword-content">
                        <img src="/images/verified.svg" class="img-fluid tick-icon">
                        <h1 class="succes-msg">You Have Successfully Sent your Mails!</h1>
                        
                        <div class="text-center mt-4">
                            <a class=" btn flogin-btn cta-btn mt-4 shadow-md" href="<?php echo SITEPATH ?>dashboard">Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="">
                    <img src="<?php echo SITEPATHFRONT ?>images/pattern-bottom.png" class="img-fluid pattern-bottom-img">
                </div>
            </div>
        </div>
    </div>
</section>
   </div>

<?php include("footer.php")?>
