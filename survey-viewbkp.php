<?php 
require_once("survey/classes/cls-request.php");
require_once("survey/classes/cls-template.php");
require_once("survey/classes/cls-survey.php");

$obj_request = new Request();
$obj_template= new Template();
$obj_survey = new Survey();

/*if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}*/

$surveyid=$_GET['surveyid'];

/**********All Questions***************/
$fields_questions = "*";
$condition_questions = "`tbl_questionBank`.`survey_id` =".$surveyid;
$orderby="`tbl_questionBank`.`sequence` ASC";
$all_questions=$obj_survey->getQuestionBank($fields_questions, $condition_questions, $orderby, '', 0);


$temp_id = '1';
if($temp_id != ''){
    $fields = "template_id, category_id, template_name,template_description, image_url, status";
    $condition = "`template_id` = '$temp_id'";
    $template_details = $obj_template->getTemplateDetail($fields, $condition, '', '', 0);
}else{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


/**********Get All Dummy Questions Record***************/

//$temp_id = base64_decode($_GET['id']);
$fields_questions = "*";
$condition_questions = "`tbl_dummy_questionBank`.`template_id` = '$temp_id'";
$all_dummy_questions= $obj_template->getDummyQuestions($fields_questions, $condition_questions, '', '', 0);
//print_r($all_dummy_questions);exit();
?>
<?php include('common-header.php')?>
<style>
.common-header-main{
display:none;
}
html {
  scroll-behavior: smooth;
}

</style>
<link rel="stylesheet" href="css/template.css">
<script src="survey/bower_components/jquery/dist/jquery.min.js"></script>

<div class="wrapper p-3">
         <?php foreach ($template_details as $template_detail) { ?>
           <section class="space-padding-top">
              <div class="conatiner-fluid pse-2">
                 <div class="row">
                    <div class="col-md-12 temp-img">
                         <div class="br-25 bannar" style="background-image:url('<?php echo SITEPATH; ?><?php echo $template_detail['image_url']?>')">
                           <div class="row">
                            
                            <div class="col-md-8 que_section offset-md-2" id="divQstn">
                                <input type="hidden" id="progress_count" class="progress_count" value="<?php echo count($all_dummy_questions); ?>">
                             <?php 
                                 foreach($all_dummy_questions as $all_dummy_question)
                                 {
                                 ?>
                        
                                   <? if ($all_dummy_question['quest_type_id'] == "4") { ?> 
                                    <div id="que_1" style="display:none" class="item mt-4 mb-5"  data-id='1'  isAttempted="0">
                                             <h1>Question 1</h1>
                                             <p><?php echo $all_dummy_question['question_title'];?></p>
                                               <div class="form__group field">
                                                 <input type="text" class="form__field effect-2" placeholder="Please Enter Your Response" name="que_res" id='que_res' value="" onchange="SetAttempted(this)"/>
                                               </div>
                                               <div class="button action-btn-disabled" id="button_next">
                                                 <div id="slide" class="slide"></div>
                                                  <a id="btn_next">NEXT &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                                               </div>
                                    </div>
                                    <?php } ?>  
                                 
                                 
                                 <?php if($all_dummy_question['quest_type_id'] == "1") {  ?> 
                                    <div id="que_2" style="display:none" class="que_scroll item mt-4 mb-5"  data-id='2'  isAttempted="0">
                                     <h1>Question 2</h1>
                                        <p><?php echo $all_dummy_question['question_title'];?></p>
                                          <div class="col-12 pb-5">
                                         <?php 
                                            $question_id = $all_dummy_question['question_id'];
                                            $fields_type = "*";
                                            $condition_type = "`tbl_dummy_subQuestion`.`question_id` =".$question_id;
                                            $sub_question=$obj_template->getSubQuestion($fields_type, $condition_type, '', '', 0);
                                            ?>  
                                        
                                            <?php foreach($sub_question as $sub_questions){ ?>    
                                             
                    						<input class="checkbox-tools" type="radio" name="rdo" id="tool-5" value="" onchange="SetAttempted(this)">
                    						<label class="for-checkbox-tools" for="tool-5">
                    							<?php if($sub_questions['question_subtitle'] == "yes"){ ?> <i class='fa fa-thumbs-up'></i><?php } ?>
                    							<?php if($sub_questions['question_subtitle'] == "no"){ ?> <i class='fa fa-thumbs-down'></i><?php } ?>
                    	                      
                    							<p><?php echo $sub_questions['question_subtitle'];?></p>
                    						</label>
                    				    <?php } ?>	
            				        	</div>
    				                </div>
    				            <?php } ?>
    				            
    				            
    				            
                                <?php if($all_dummy_question['quest_type_id'] == "2") {  ?> 
                                   <div id="que_3" style="display:none" class="que_scroll item mt-4 mb-5" data-id='3'  isAttempted="0">
                                   <h1>Question 3</h1>
                                    <p><?php echo $all_dummy_question['question_title'];?></p>
                                      <div class="col-12 pb-5">
                					  <?php 
                					    $question_id = $all_dummy_question['question_id'];
                                        $fields_type = "*";
                                        $condition_type = "`tbl_dummy_subQuestion`.`question_id` =".$question_id;
                                        $sub_questions=$obj_template->getSubQuestion($fields_type, $condition_type, '', '', 0);
                					    ?>
                    					<?php foreach($sub_questions as $radios){ ?>
                    						<input class="checkbox-tools" type="radio" name="tools" id="<?php echo $radios['question_subtitle'];?>" value="<?php echo $radios['question_subtitle'];?>" onchange="SetAttempted(this)" onclick="other_rdo_val();">
                    						<label class="for-checkbox-tools" for="<?php echo $radios['question_subtitle'];?>">
                    							<i class='fa fa-briefcase'></i>
                    							<p><?php echo $radios['question_subtitle'];?></p>
                    						</label>
                    					<?php } ?>
                    						<div class="" style="display:none" id="other_text_field">
                    						<div class="form__group field">
                                                 <input type="text" class="form__field effect-2" placeholder="Please Enter Your Response" name="other_text" id='other_text' value=""/>
                                               </div>
                                               <div class="button" id="button">
                                                 <div id="slide" class="slide"></div>
                                                  <a id="btn_next_other">NEXT &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                                               </div>
                                            </div>  
                					    </div>
                					   </div>
                			       <?php  } ?>
                		
                						
                			   <?php if ($all_dummy_question['quest_type_id'] == "6") { ?> 
                                  <div id="que_4" style="display:none" class="que_scroll item mt-4" data-id='4'  isAttempted="0">
                                    <h1>Question 4</h1>
                                    <p><?php echo $all_dummy_question['question_title'];?></p>
                                    <?php 
                					    $question_id = $all_dummy_question['question_id'];
                                        $fields_type = "*";
                                        $condition_type = "`tbl_dummy_subQuestion`.`question_id` =".$question_id;
                                        $sub_questions=$obj_template->getSubQuestion($fields_type, $condition_type, '', '', 0);
                					    ?>
                	
                                      <div class="row pb-5">
                                        <?php $counter = 0; foreach($sub_questions as $dropdowns){ $counter++;?>
                                          <div class="col-md-6">
                                             <input class="checkbox-tools1" type="radio" name="mul_rdo" id="mul-1" value="" onchange="SetAttempted(this)">
                    						    <label class="for-checkbox-tools" for="mul-1">
                    							<?php echo $dropdowns['question_subtitle'];?> 
                    							<span class="float-end text-dark span"><?php echo $counter; ?></span>
                						    </label>
                                          </div>
                                         <?php } ?>
                                        
        				        	</div>
				                </div>
				                
				                <?php } ?>
        				        
                                <?php if ($all_dummy_question['quest_type_id'] == "5") {  ?> 
				                 <div id="que_5" style="display:none" class="item mt-4" data-id='5'  isAttempted="0">
                                         <h1>Question 5</h1>
                                         <p><?php echo $all_dummy_question['question_title'];?></p>
                                            <div class="stars">
                                              <form action="">
                                                <input class="star star-5" onchange="SetAttempted(this)" id="star-5" type="radio" name="star"/>
                                                <label class="star star-5" for="star-5"></label>
                                                <input class="star star-4" onchange="SetAttempted(this)" id="star-4" type="radio" name="star"/>
                                                <label class="star star-4" for="star-4"></label>
                                                <input class="star star-3" onchange="SetAttempted(this)" id="star-3" type="radio" name="star"/>
                                                <label class="star star-3" for="star-3"></label>
                                                <input class="star star-2" onchange="SetAttempted(this)" id="star-2" type="radio" name="star"/>
                                                <label class="star star-2" for="star-2"></label>
                                                <input class="star star-1" onchange="SetAttempted(this)" id="star-1" type="radio" name="star" value=""/>
                                                <label class="star star-1" for="star-1"></label>
                                              </form>
                                            </div>
                                     </div>
				                <?php } ?>
                               
    				            <?php if ($all_dummy_question['quest_type_id'] == "3") { ?>
				                 <div id="que_6" style="display:none" class="que_scroll item mt-1" data-id='6'  isAttempted="0">
                                    <h1>Question 6</h1>
                                    <p><?php echo $all_dummy_question['question_title'];?></p>
                                    <?php 
                    					    $question_id = $all_dummy_question['question_id'];
                                            $fields_type = "*";
                                            $condition_type = "`tbl_dummy_subQuestion`.`question_id` =".$question_id;
                                            $sub_questions=$obj_template->getSubQuestion($fields_type, $condition_type, '', '', 0);
                					?>
                                       <div class="chk_class">
            				                     <div class="row pb-5">
            				                        <?php $counter = 0; foreach($sub_questions as $chk_boxes){ $counter++; ?>
                                                     <div class="col-md-6">
                                                          <input id="<?php echo $chk_boxes['question_subtitle'];?>" type="checkbox" name="chk_box" value="<?php echo $chk_boxes['question_subtitle'];?>" onchange="SetAttempted(this)">
                                                            <label for="<?php echo $chk_boxes['question_subtitle'];?>"><?php echo $chk_boxes['question_subtitle'];?> <span class="float-end text-dark span" id="<?php echo $chk_boxes['question_subtitle'];?>">
                                                              <?php echo $counter ?></span>
                                                            </label>
                                                     </div>
                                                     <?php }  ?>
                                                    <div class="col-md-12 mt-5">
                                                        <div class="button" id="btn_next_check">
                                                         <div id="slide" class="slide"></div>
                                                          <a >Next &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                                                        </div>
                                                     </div>
                                                 </div>
                                           </div>
                
                                     </div>
                                     <?php } ?>
                                     
                                      <?php if ($all_dummy_question['quest_type_id'] == "7") { ?>
                                        <div id="que_7" style="display:none" class="item mt-4" data-id='7'  isAttempted="0">
                                         <h1>Question 7</h1>
                                         <p><?php echo $all_dummy_question['question_title'];?></p>
                                          <?php 
                    					    $question_id = $all_dummy_question['question_id'];
                                            $fields_type = "*";
                                            $condition_type = "`tbl_dummy_subQuestion`.`question_id` =".$question_id;
                                            $scale_questions=$obj_template->getSubQuestion($fields_type, $condition_type, '', '', 0);
                					      ?>
                                           
                                              <?php foreach($scale_questions as $scale)
                                                    { 
                                                        $scale_str =  $scale['question_subtitle'];
                                                        $scale_str_exp = explode("-",$scale_str); 
                                                        $min = $scale_str_exp[0]; 
                                                        $max=$scale_str_exp[1];  
                                                        $avg = intval(($min+$max)/2);   
                                                        $opinion_scale= $scale['opinion_scale_text'];
                                                        $opinion_scale_text = explode(",",$opinion_scale); 
                                                        
                                                        $left_text = $opinion_scale_text[0];
                                                        $middle_text = $opinion_scale_text[1];
                                                        $right_text = $opinion_scale_text[2];
                                                            
                                                        
                                               ?>
                                               <div class="col-md-12">
                                                <div class="scales d-flex">
                                                     <?php for($sc=0;$sc<=$max;$sc++){ ?>
                                                       
                                                          <?php if($sc==$min){?>
                                                                <div cass="row">
                                                                    <div class="col-md-1">
                                                                        <span class="scale_txt"><?php echo $left_text;?></span> 
                                                                    </div>
                                                                </div>
                                                            <?php }?>
                                                           
                                                           <?php if($sc==$avg){?>
                                                                <div cass="row">
                                                                    <div class="col-md-1">
                                                                         <span class="scale_txt"><?php echo $middle_text;?></span>
                                                                    </div>
                                                                </div>
                                                           <?php }?>
                                                           
                                                           <?php if($sc==$max){?>
                                                               <div cass="row">
                                                                    <div class="col-md-1">
                                                                        <span class="scale_txt float-end"><?php echo $right_text;?></span>
                                                                    </div>
                                                                </div>
                                                           <?php }?>
                                                         <input class="scale" id="<?php echo $sc;?>" type="radio" name="scale" onchange="SetAttempted(this)"/>
                                                         <label class="scale" for="<?php echo $sc;?>"><?php echo $sc;?></label>
                                                     <?php  }  ?>
                                                 </div>
                                            </div>
                                              <div class="col-md-12 mt-5">
                                                        <div class="button" id="button">
                                                         <div id="slide" class="slide"></div>
                                                          <a >SUBMIT &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                                                        </div>
                                                     </div>
                                            <?php } ?>
                                              
                                             
                                     </div>
                                    
                                    <?php } ?>
                
                              <?php } ?>
                                
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-12" data-id='8'>
                                    <div class="end success-content text-center mt-5" >
                                        <p class="mt-10">We really appreciate your time and feedback.</p>
                                        <p><i class="fa fa-smile-o text-amber-200" aria-hidden="true"></i></p>
                                        <p class="mt-5"><img class="logo-dash" src="/survey/images/dash-logo.png"></p>
                                    </div>
                                </div>    
                              </div> 
                              <div class="row">
                                    <div class="col-md-12 text-center mt-5 mb-5 p-5" id="temp_section">
                                       <h1 class="text-white mt-5"><strong><?php echo $template_detail['template_name'];?></strong></h1>
                                       <h3 class="text-white"><i><?php echo $template_detail['template_description'];?></i></h3>
                                        <div class="button get-started mb-5" id="button">
                                            <div id="slide" class="slide"></div>
                                                <a id="btn_get_started">OF COURSE, YES :) &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                                            </div>
                                    </div>
                            </div>
                                 <div class="row">
                                    <div class="row mt-3 btn_slider btn_slider_fixed" id="btn_slider" style="display:none">
                                        <div class="col-md-6">
                                             <div class="progress">
                                            <svg class="progress-circle" width="200px" height="200px" xmlns="http://www.w3.org/2000/svg">
                                        	    <circle class="progress-circle-back"
                                        		        cx="80" cy="80" r="74"></circle>
                                                <circle class="progress-circle-prog"
                                                        cx="80" cy="80" r="74"></circle>
                                            </svg>
                                    	     <div class="progress-text" data-progress="0">0%</div>
                                         </div>	
                                        </div>
                                         <div class="col-md-6">
                                            <div class="col-md-12">
                                             <a id="next" class="next btn_slider btn_slider_dir br-25"><i class="fa fa-angle-down"></i></a>
                                             <a id="prev" class="back btn_slider btn_slider_dir br-25"><i class="fa fa-angle-up"></i></a>
                                            </div>
                                             <div class="text-right cmp_logo_text">
                                                 <i class="text-white">made with</i>
                                                <p><img class="logo-dash-temp img-fluid" src="/survey/images/dash-logo.png"></p>
                                             </div>
                                        </div>
                                    </div>
                                 </div>
                             </div>
                         </div>
                    </div>
                </section>
      <?php } ?>
</div>

<?php include('footer.php')?>
<style>
    .common-footer-main{display:none !important;}
</style>
<script>
   $(document).ready(function(){
       
            $('.wrapper').addClass("toggled"); 
            
            //Instead of show() you can use slideDown(200); for hide you can use slideUp(200);
        
            $("#btn_get_started").click(function(){
                $('#temp_section').slideUp(200);
                $('#que_1').slideDown(200);
                $("#btn_slider").slideDown(200);
                setup(); 
            });
            
            $("#button_next").click(function(){
                 if($('#que_res').val() != ''){
               $('#que_1').slideUp(200);
               $('#que_2').slideDown(200);
                 }
            });
            
            $("#que_2 input:radio").click(function() {
               $('#que_2').slideUp(200);
               $('#que_3').slideDown(200);
             
            });
            
            $("#que_3 input:radio").click(function() {
              var radioValue = $("input[name='tools']:checked").val();
              if(radioValue == 'Other'){
                  $('#que_3').slideDown(200);
                   $('#other_text').focus(); 
                }
                else
                {
                   $('#que_3').slideUp(200);
                   $('#que_4').slideDown(200);
                }
            });
            
            $("#que_4 input:radio").click(function() {
               $('#que_4').slideUp('fast');
               $('#que_5').slideDown('fast');
              
            });
            
            $("#que_5 input:radio").click(function() {
               $('#que_5').slideUp(200);
               $('#que_6').slideDown(200);
              
            });
            
             $("#btn_next_check").click(function() {
               $('#que_6').slideUp(200);
               $('#que_7').slideDown(200);
              
            });
            
            // disable button (Button Validation)            
             $("#que_res").keyup(function() {
                if($(this).val() != ''){
                    $('#button_next').removeClass("action-btn-disabled");
                } 
            });
    });

//====== Next & Prev Button Click =======
$('body').on('click', '.next', function() { 
    var id = $('.item:visible').data('id');
    var nextId = $('.item:visible').data('id')+1;
    $('[data-id="'+id+'"]').hide();
    $('[data-id="'+nextId+'"]').show();
    
    if($('.back:hidden').length == 1){
        $('.back').show();
    }
    if(nextId == 8){
		$('.que_section').hide();
		$('.end').slideDown(200);
    }
});
$('body').on('click', '.back', function() { 
    var id = $('.item:visible').data('id');
    var prevId = $('.item:visible').data('id')-1;
    $('[data-id="'+id+'"]').hide();
    $('[data-id="'+prevId+'"]').show();
    if(prevId == 1){
        $('.back').hide();
    }    
});
$('body').on('click', '.edit-previous', function() { 
	$('.end').hide();
    $('.que_section').show();
    $('#que-7').show();
});

//other filed show

function other_rdo_val()
{
var radioValue = $("input[name='tools']:checked").val();
if(radioValue == 'Other')
{
     $('#other_text_field').show();
}
else
{  
   $('#other_text_field').hide(); 
}
}



//percentage

function progressBar(progressVal,totalPercentageVal = 100) {
    var strokeVal = (4.64 * 100) /  totalPercentageVal;
	var x = document.querySelector('.progress-circle-prog');
    x.style.strokeDasharray = progressVal * (strokeVal) + ' 999';
	var el = document.querySelector('.progress-text'); 
	var from = $('.progress-text').data('progress');
	$('.progress-text').data('progress', Math.round(progressVal));
	var start = new Date().getTime();
  
	setTimeout(function() {
	    var now = (new Date().getTime()) - start;
	    var progress = now / 700;
	    el.innerHTML = progressVal / totalPercentageVal * 100 + '%';
	    if (progress < 1) setTimeout(arguments.callee, 10);
	}, 10);

}

progressBar(0,100);

var total_ques = $('#progress_count').val();

// $('.perc_val2').change(function(){
//   var average1 = 100/total_ques;
//   var average1 = parseInt(average1);
//   alert(average1);
//   progressBar(average1,100);
// });

// $('input[type=radio][name=boolean_qType]').change(function() {
//   var average2 = 100/total_ques;
//   var average2 = parseInt(average2);
//     if (this.value == 'yes') {
//         alert("Allot Thai Gayo Bhai");
//     }
//   progressBar(average2,100);
// });

function SetAttempted(div) {
$(div).parent().parent().attr("isAttempted", "1");
checkAttempt();
}

function checkAttempt(){
    
    var attemptedCount = 0;
    $('#divQstn div').each(function (i, ele) {
        // var qId = $(this).attr("qId");
         var isAttempted = $(this).attr("isAttempted");
         //alert(i);
         var c = 1;
         
         if(isAttempted=="1"){
            attemptedCount ++;
         }
    });
          var average1 = 100/total_ques;
          //var average1 = Math.round(average1);
           //var average1 = average1.toFixed(0);
           // alert(average1);
            if(average1*attemptedCount>=100){
              progressBar(100,100);
              }else{
                  progressBar(parseInt(average1*attemptedCount),100);
              }
}

</script>