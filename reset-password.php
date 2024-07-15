<?php
$page_title = "Avira Surveys : Reset Password";
$meta_title = "";
$meta_description = "";
$meta_keywords = "";
$uid=$_GET['uid'];
include('common-header.php');
?>
<style>
    .error{color:red;}
    .form-control{
    padding:1.175rem .75rem;
}
</style>
<section class="part-2 d-flex mt-5 align-items-center justify-content-center">
    <div class="container">
        <div class="row row d-flex align-items-center">
            <div class="col-md-12">
                <div class="text-end">
                    <img src="../images/pattern-top.png" class="img-fluid pattern-img-right">
                </div>
            </div>
            
            <div class="col-lg-4 offset-lg-4 col-md-6 col-md-3 mb-5">
                 <div class="card-password">
                     <h1 class="fw-bold">Reset Password</h1>
                 </div>
                    <div class="reg-form-password bg-white box-shadow">
                      <form role="form" id="resetForm" name="resetForm" method="POST" action="">
                           <input type="hidden" value="<?php echo SITEPATHFRONT; ?>" id="websitepath" name="websitepath">
                           <input type="hidden" value="<?php echo $uid; ?>" id="uid" name="uid">
                           <div>
                                <h4 class="text-center fw-bold">Reset Your Password here</h4>
                           </div>
                         <!--  <label class="form-password-label  mt-5">Enter OTP</label>
                            <div class="col-md-12 d-flex">
                                   <input type="text" class="form-control captch-box" name="text" id="text">
                                   <button class="btn text-light  verify-btn mt-0 shadow-md">
                                   <img class="sm-vbtn me-2" src="/images/verify-icon.png">Verified</button>
                            </div>-->
                            <div class="col-md-12 mt-4">
                                <label class="form-password-label">Enter New Password<span>*</span></label>
                                <input type="password" class="form-control email-box"  name="password" id="password">
                                <span class="form-password-icon  float-end">
                                    <i class="fa fa-lock mt-2 me-3"></i>
                                </span>
                            </div>
                            <div class="col-md-12 mt-1">
                                <label class="form-password-label">Confirm Password<span>*</span></label>
                                <input type="password" class="form-control email-box"  name="conpassword" id="conpassword">
                                <span class="form-password-icon float-end">
                                     <i class="fa fa-lock mt-2 me-3"></i>
                                </span>
                            </div>
                            <div class="text-center mt-4">
                                <input type="submit" class="col-12 btn  btn-lg cta-btn s-button mt-2 shadow-md " value="Reset">
                                 <span class="spinner-border text-info spinner-border-md mt-2" role="status" aria-hidden="true" id="span_loader" style="display:none"></span>
                                </div>
                        </form>
                    </div>
                <div class="text-center pt-4">
                    <a href="<?php echo SITEPATHFRONT ?>privacy-policy.php" class="text-dark regpr border-end pe-3">Privacy Policy</a>
                    <a href="<?php echo SITEPATHFRONT ?>terms-and-conditions.php" class="text-dark regpr ps-3">Terms & Conditions</a>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="">
                    <img src="../images/pattern-bottom.png" class="img-fluid pattern-bottom-img">
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php'); ?>
 <!-- jQuery -->
    <script src="<?php echo SITEPATH;?>bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo SITEPATH;?>bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="<?php echo SITEPATH;?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="<?php echo SITEPATH;?>bower_components/chosen/chosen.jquery.js" type="text/javascript"></script>
    <script src="<?php echo SITEPATH;?>tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="<?php echo SITEPATH;?>dist/js/sb-admin-2.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Base64/1.1.0/base64.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="<?php echo SITEPATHFRONT ?>js/jquery.validate.js"></script>
        <script>
        $(document).ready(function () {
                $("#resetForm").validate({
                    rules: {
                        password: {required: true, minlength: 6},
                        conpassword: {
                            required: true,
                            minlength: 6,
                            equalTo: "#password",
                        }
            
                    },
                    messages: {
                        password: {
                            required: "Password is required", 
                            minlength: "Enter atleast 6 Characters"
                        },
                        conpassword: {
                            required: "Confirm Password is required",
                            minlength: "Enter atleast 6 Characters",
                            equalTo: "Password Not Matched",
                        }
                    },
                    errorElement: "span",
                    submitHandler: function(form) {
                            var formData = new FormData(form);
                            saveFormDatas(form);
                    }
                });
                	
                	
               // e.preventDefault();
            	function saveFormDatas(form) {
            	    $('#span_loader').show();
                    var password =$('#password').val();
                    var sitepathfront = $("#websitepath").val();
                    var sitepath = sitepathfront+"survey/login";
                    var uid = $('#uid').val();
                    var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
                    var duid =Base64.decode(uid);
                    $.ajax({
                        type : 'POST',
                        data : {password:password,duid:duid},
                        url  : '<?php echo SITEPATHFRONT; ?>reset-password-action.php',
                        datatype:'json',
                        cache:false,
                        success: function(response){
                           // alert(response);
                             $('#span_loader').hide();
                             swal({
                                text: "Your Password has been Reset Successfully..!",
                                icon: "success",
                                showConfirmButton: true,
                                confirmButtonColor: '#04AA26',
                                position: "center",
                            }).then(function() {
                                window.location = sitepath;
                            });
                        },
                         error: function (textStatus, errorThrown) {
                    }
                    });
                    
                	}
                	
            });    	
        </script>
