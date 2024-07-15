<?php 
require_once("survey/classes/cls-request.php");
require_once("survey/classes/cls-template.php");
require_once("survey/classes/cls-survey.php");

$obj_request = new Request();
$obj_template= new Template();
$obj_survey = new Survey();
?>
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/intlTelInput.css">
  <link rel="stylesheet" href="<?php echo SITEPATH;?>css/demo.css">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
<script src="<?php echo SITEPATH; ?>bower_components/jquery/dist/jquery.min.js"></script>
 <div class="col-md-12 item mt-5" id="que" data-id="">
       <?php //if($_SESSION['response_user_id']==""){?>
       <div class="row">
         <div class="thanks-head">
            <h3>Thank you for your response, Please Submit your Survey.</h3>
        </div>
          <div class="col-md-12">
            <input type="text"  autocomplete = "off" class="form__field effect-2" placeholder="Enter Full Name" name="fname" id='fname' value="" />
            <div class="star" id="fname_error_message"></div>
        
          </div>
         <div class="col-md-12">
            <div class="mt-5">
                <input type="text" autocomplete = "off" class="form__field effect-2" placeholder="Enter Email" name="email" id='email' value="" />
                <div class="star" id="email_error_message"></div>
            </div>
          </div>
                    <div class="col-md-12">
            <div class="mt-5">
                <input id="cname" name="cname" type="hidden">
                <input id="ccode" name="ccode" type="hidden">
                <input type="tel" autocomplete = "off" class="form__field effect-2" placeholder="Enter Phone Number" name="phone" id='phone' value="" />
                
                                       
                <div class="star" id="phone_error_message"></div>
            </div>
          </div>
         
           <div class="button sub-btn" id="lastsubmit">
             <div id="slide" class="slide"></div>
              <a href="javascript:void(0);" id="lastsubmit">SUBMIT &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
            </div>
            <span class="spinner-border spinner-border-md mt-4 text-white" role="status" aria-hidden="true" id="span_loader" style="display:none"></span>
    	</div>
        
</div> 
                                    
<script src="<?php echo SITEPATHFRONT; ?>js/jquery.validate.js"></script>
<script src="<?php echo SITEPATHFRONT; ?>js/user-form.js"></script>

<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

<script>


   $(document).ready(function(){
      
                     //Instead of show() you can use slideDown(200); for hide you can use slideUp(200);
        
            
            
            $("#fname_error_message").hide();
            $("#email_error_message").hide();
            $("#phone_error_message").hide();
            
            var fname_error_message = false;
            var email_error_message = false;
            var phone_error_message = false;
            
            $("#fname").keypress(function(){
               check_fname(); 
            });
            
            $("#fname").focusout(function(){
               check_fname(); 
            });
            
            $("#email").keypress(function(){
               check_email(); 
            });
            
            $("#email").focusout(function(){
               check_email(); 
            });
            
            $("#phone").keypress(function(){
               check_phone(); 
            });
            
            $("#phone").focusout(function(){
               check_phone(); 
            });
            
            function check_fname(){
                var fname= $("#fname").val().trim();
                
                if(fname == '')
                {
                    $("#fname_error_message").show();
                    $("#fname_error_message").html("Please Enter Fullname");
                    $("#fname").css("border","2px solid #F90A0A");
                    fname_error_message = true;
                }
                else
                {
                    $("#fname_error_message").hide();
                    $("#fname").css("border","2px solid #34F458");
                    fname_error_message = false;
                } 
                
            }
            
            function check_email(){
                var pattern = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                var email= $("#email").val();
                if(email == '')
                {
                    $("#email_error_message").show();
                    $("#email_error_message").html("Please Enter Email");
                    $("#email").css("border","2px solid #F90A0A");
                    email_error_message = true;
                }
                else
                {
                    if(pattern.test(email))
                    {
                        $("#email_error_message").hide();
                        $("#email").css("border","2px solid #34F458");
                        email_error_message = false;
                        
                    } else {
                        $("#email_error_message").show();
                        $("#email_error_message").html("Invalid Email");
                        $("#email").css("border","2px solid #F90A0A");
                        email_error_message = true;
                    }
                }    
                
            }
            
             function check_phone(){
                var phonepattern = /^\+?([0-9]{1,2})\)?[-. ]?([0-9]{4,5})[-. ]?([0-9]{4,5})$/;
                var phone= $("#phone").val();
                if(phone == '')
                {
                    $("#phone_error_message").show();
                    $("#phone_error_message").html("Please Enter Phone Number");
                    $("#phone").css("border","2px solid #F90A0A");
                    phone_error_message = true;
                }
                else
                {
                    if(phonepattern.test(phone))
                    {
                        $("#phone_error_message").hide();
                        $("#phone").css("border","2px solid #34F458");
                        phone_error_message = false;
                        
                    } else {
                        $("#phone_error_message").show();
                        $("#phone_error_message").html("Invalid Phone Number");
                        $("#phone").css("border","2px solid #F90A0A");
                        phone_error_message = true;
                    }
                }    
                
            }
            
            
            $("input[name=fname]").keypress(function(event){
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    var pattern = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    if(keycode == '13')
                    {
                        check_fname();
                        check_email();
                        check_phone();
                        
                        var allquestionids =$("#all_question_id").val();
                        var allanswers = $("#all_answers").val();
                        var fname = $("#fname").val().trim();
                        var email = $("#email").val();
                        
                        var sessipaddrlastform = $("#sessipaddrlastform").val();
                        
                    }
            });
            
             $("input[name=email]").keypress(function(event){
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    var pattern = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    if(keycode == '13')
                    {
                        check_fname();
                        check_email();
                        check_phone();
                        var allquestionids =$("#all_question_id").val();
                        var allanswers = $("#all_answers").val();
                        var fname = $("#fname").val().trim();
                        var email = $("#email").val();
                         var sessipaddrlastform = $("#sessipaddrlastform").val();
                        
                    }
            });
                
                
            
            $("#lastsubmit").click(function(){
                //all_question_id all_answers
                check_fname();
                        check_email();
                        check_phone();
                var allquestionids =$("#all_question_id").val();
                var allanswers = $("#all_answers").val();
                var fname = $("#fname").val().trim();
                var email = $("#email").val();
                var sessipaddrlastform = $("#sessipaddrlastform").val();
                
            });
            
            
            
    });

</script>
<script src="<?php echo SITEPATH;?>js/intlTelInput.js"></script>
  <script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      // allowDropdown: false,
      // autoHideDialCode: false,
       autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
       separateDialCode: true,
      utilsScript: "<?php echo SITEPATH;?>js/utils.js",
    });
  </script>

