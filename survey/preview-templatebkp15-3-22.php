<?php 
require_once("classes/cls-request.php");
require_once("classes/cls-template.php");

$obj_request = new Request();
$obj_template= new Template();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

if(isset($_GET['id'])){
    $fields = "template_id, category_id, template_name,template_description, image_url, status";
    $condition = "`template_id` = '" . base64_decode($_GET['id']) . "'";
    $template_details = $obj_template->getTemplateDetail($fields, $condition, '', '', 0);
}else{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


/**********Get All Dummy Questions Record***************/

$temp_id = base64_decode($_GET['id']);
$fields_questions = "tbl_dummy_questionBank.*";
$condition_questions = "`tbl_dummy_questionBank`.`template_id` = '$temp_id'";
$all_dummy_questions= $obj_template->getDummyQuestions($fields_questions, $condition_questions, '', '', 0);
//print_r($all_dummy_questions);
//echo count($all_dummy_questions);
//exit();

$count_que = count($all_dummy_questions);

//print_r(array_count_values($all_dummy_questions['']));

?>
<link rel="stylesheet" href="css/template.css">

<div class="wrapper">
   <?php include("sidebarmenu.php")?>
        <?php include("dashboard-header-menu.php")?>
         <?php foreach ($template_details as $template_detail) { ?>
           <section class="space-padding-top">
            <div class="conatiner-fluid pse-2">
                <div class="row">
                   <div class="col-md-9 temp-img">
                         <div class="br-25 bannar" style="background-image:url('<?php echo SITEPATH; ?><?php echo $template_detail['image_url']?>')">
                           <div class="row">
                            
                            <div class="col-md-8 que_section offset-md-2" id="divQstn">
                                
                                <input type="hidden" id="progress_count" class="progress_count" value="<?php echo count($all_dummy_questions); ?>">
                                
                             <?php $per_c = 1;
                                 foreach($all_dummy_questions as $all_dummy_question)
                                 {
                                 ?>
                                    <!-- Text Q type -->
                                   <? if ($all_dummy_question['quest_type_id'] == "4") { ?> 
                                    <div id="que_1" style="display:none" class="item mt-4 mb-5"  data-id='1' isAttempted="0">
                                             <h1>Question 1</h1>
                                             <p><?php echo $all_dummy_question['question_title'];?></p>
                                               <div class="form__group field">
                                                 <input type="text" class="form__field effect-2 perc_val1" placeholder="Please Enter Your Response" name="que_res" id='que_res' value="" onchange="SetAttempted(this)"/>
                                               </div>
                                               <div class="button action-btn-disabled" id="button_next">
                                                 <div id="slide" class="slide"></div>
                                                  <a id="btn_next">NEXT &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                                               </div>
                                    </div>
                                    <?php } ?>  
                                 
                                 <!-- Boolean Q type-->
                                 <?php if($all_dummy_question['quest_type_id'] == "1") {  ?> 
                                    <div id="que_2" style="display:none" class="que_scroll item mt-4 mb-5"  data-id='2' isAttempted="0">
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
                                             
                    						<input class="checkbox-tools perc_val2" type="radio" name="boolean_qType" id="tool-5" value="<?php echo $sub_questions['question_subtitle']; ?>" onchange="SetAttempted(this)">
                    						<label class="for-checkbox-tools" for="tool-5">
                    							<?php if($sub_questions['question_subtitle'] == "yes"){ ?> <i class='fa fa-thumbs-up'></i><?php } ?>
                    							<?php if($sub_questions['question_subtitle'] == "no"){ ?> <i class='fa fa-thumbs-down'></i><?php } ?>
                    	                      
                    							<p><?php echo $sub_questions['question_subtitle'];?></p>
                    						</label>
                    				    <?php } ?>	
            				        	</div>
    				                </div>
    				            <?php } ?>
    				            
    				            <!-- Radio Q type -->
    				            
                                <?php if($all_dummy_question['quest_type_id'] == "2") {  ?> 
                                   <div id="que_3" style="display:none" class="que_scroll item mt-4 mb-5" data-id='3' isAttempted="0">
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
                    						<input class="checkbox-tools perc_val3" type="radio" name="radio_qType" id="<?php echo $radios['question_subtitle'];?>" value="<?php echo $radios['question_subtitle'];?>" onchange="SetAttempted(this)" onclick="other_rdo_val();">
                    						<label class="for-checkbox-tools" for="<?php echo $radios['question_subtitle'];?>">
                    							<i class='fa fa-briefcase'></i>
                    							<p><?php echo $radios['question_subtitle'];?></p>
                    						</label>
                    					<?php } ?>
                    						<div class="" style="display:none" id="other_text_field">
                    						<div class="form__group field">
                                                 <input type="text" class="form__field effect-2" placeholder="Please Enter Your Response" name="other_text" id='other_text' value="" />
                                               </div>
                                               <div class="button" id="button">
                                                 <div id="slide" class="slide"></div>
                                                  <a id="btn_next_other">NEXT &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                                               </div>
                                            </div>  
                					    </div>
                					   </div>
                			       <?php  } ?>
                	
                	        	<!-- Dropdown Q type -->
                						
                			   <?php if ($all_dummy_question['quest_type_id'] == "6") { ?> 
                                  <div id="que_4" style="display:none" class="que_scroll item mt-4" data-id='4' isAttempted="0">
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
                                             <input class="checkbox-tools1 perc_val4" type="radio" name="mul_rdo" id="mul-1" value="" onchange="SetAttempted(this)">
                    						    <label class="for-checkbox-tools" for="mul-1">
                    							<?php echo $dropdowns['question_subtitle'];?> 
                    							<span class="float-end text-dark span"><?php echo $counter; ?></span>
                						    </label>
                                          </div>
                                         <?php } ?>
                                        
        				        	</div>
				                </div>
				                
				                <?php } ?>
        				        
        				        <!-- Rating Q type -->
        				        
                                <?php if ($all_dummy_question['quest_type_id'] == "5") {  ?> 
				                 <div id="que_5" style="display:none" class="item mt-4" data-id='5' isAttempted="0">
                                         <h1>Question 5</h1>
                                         <p><?php echo $all_dummy_question['question_title'];?></p>
                                            <div class="stars">
                                              
                                                <input class="star star-5 perc_val5" onchange="SetAttempted(this)" id="star-5" type="radio" name="star"/>
                                                <label class="star star-5" for="star-5"></label>
                                                <input class="star star-4 perc_val5" onchange="SetAttempted(this)" id="star-4" type="radio" name="star"/>
                                                <label class="star star-4" for="star-4"></label>
                                                <input class="star star-3 perc_val5" onchange="SetAttempted(this)" id="star-3" type="radio" name="star"/>
                                                <label class="star star-3" for="star-3"></label>
                                                <input class="star star-2 perc_val5" onchange="SetAttempted(this)" id="star-2" type="radio" name="star"/>
                                                <label class="star star-2" for="star-2"></label>
                                                <input class="star star-1 perc_val5" onchange="SetAttempted(this)" id="star-1" type="radio" name="star" value=""/>
                                                <label class="star star-1" for="star-1"></label>
                                             
                                            </div>
                                     </div>
				                <?php } ?>
                               
                               <!-- Checkbox Q type -->
                               
    				            <?php if ($all_dummy_question['quest_type_id'] == "3") { ?>
				                 <div id="que_6" style="display:none" class="que_scroll item mt-1" data-id='6' isAttempted="0">
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
                                                          <input id="<?php echo $chk_boxes['question_subtitle'];?>" type="checkbox" name="chk_box" value="<?php echo $chk_boxes['question_subtitle'];?>" onchange="SetAttempted(this)" class="perc_val6">
                                                            <label for="<?php echo $chk_boxes['question_subtitle'];?>"><?php echo $chk_boxes['question_subtitle'];?> <span class="float-end text-dark span" id="<?php echo $chk_boxes['question_subtitle'];?>">
                                                              <?php echo $counter ?></span>
                                                            </label>
                                                     </div>
                                                     <?php }  ?>
                                                     <div class="col-md-12 mt-5">
                                                        <div class="button" id="btn_next_check">
                                                         <div id="slide" class="slide"></div>
                                                          <a >NEXT &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
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
                                     
                                     
                
                              <?php 
                              $per_c++; } ?>
                                
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-12 end" data-id='8'>
                                    <div class="end success-content text-center mt-5" >
                                        <p class="mt-10">We really appreciate your time and feedback.</p>
                                        <p><i class="fa fa-smile-o text-amber-200" aria-hidden="true"></i></p>
                                        <p class="mt-5"><img class="logo-dash-temp" src="<?php echo SITEPATH; ?>survey/images/logo-dark.png"></p>
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
                                <style>
.progress {
        position: absolute;   
    height: 197px;
    width: 202px;
        background-color: #ebfafe00;;
        cursor: pointer;
        left: 44%;
        margin: -80px 0 0 -80px;
    }
    
    .progress-circle {
      transform: rotate(-90deg);
    	margin-top: -20px;
    }
    
    .progress-circle-back {
    	fill: none; 
    	stroke: #9586865e;
    	stroke-width:5px;
    }
    
    .progress-circle-prog {
    	fill: none; 
    	stroke: #fff;
    	stroke-width: 5px;  
    	stroke-dasharray: 0 999;    
    	stroke-dashoffset: 0px;
        transition: stroke-dasharray 0.7s linear 0s;
    }
    
    .progress-text {
    width: 100%;
    position: absolute;
    top: 82px;
    text-align: center;
    font-size: 2em;
    margin-left: -18px;
    }
    .scale{border-width: 1px;
    border-style: solid;
    position: relative;
    cursor: pointer;
    text-decoration: none;
    border-radius: 0px;
   /* border-right-width: 0px;*/
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 60px;
    height: 60px;
    font-weight:600;
    font-size: 16px;
    border-color: rgba(255, 255, 255, 0.5);
    background-color: rgba(255, 255, 255, 0.1);
    margin-left: 0px;
    color: rgb(255, 255, 255);
}
     .scale:checked + label{
       background-color: #fffefdcc;font-weight:700;color:#000;
        font-weight: 700;
        border: 1px solid #ddd;
        text-align: center !important;
        font-size:17px;
    }
    .scale:hover{background-color: rgba(255, 255, 255, 0.2);
    z-index: 1;}
.scales{display: flex;}
.scale_txt{position: absolute;
    margin-top: 64px;
    font-weight: 600;
    color: #fefefe87;
    text-align:left;
    font-size:12px;
}
                                </style>     
                                    
                                   
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
                                                <p><img class="logo-dash-temp img-fluid" src="/survey/images/logo-dark.png"></p>
                                             </div>
                                        </div>
                                    </div>
                                 </div>
                                 </div>
                             </div>
                         </div>
                       
                        <div class="col-md-3">
                        <div class="back-cusor-link">
                            <a href="template-list.php"style="color:black;font-size:15px;">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> 
                                 back to template
                            </a>
                        </div>
                        <div class="bg-white box-shadow p-4">
                            <div class="back-cursor">
                                <h4 class="pb-4"><strong><?php echo $template_detail['template_name'];?></strong></h4>
                                <p class="temp_desc p-3"><?php echo $template_detail['template_description'];?></p>
                            </div>
                            <div class="view-button-template">
                                <a class="btn btn-primary submit_btn" href="add-survey.php?templateid=<?php echo base64_decode($_GET['id']); ?>">Choose Template &nbsp;&nbsp;<i class="fa fa-check-circle"></i></a>
                            </div>
                            <div class="view-button-template text-center mt-20">
                                <span>Have your own ideas in mind?</span>
                                <span class="d-block"></span>
                                <a class="" href="<?php echo SITEPATH;?>add-survey.php">
                                    Start Blank Survey <i class="fa fa-arrow-circle-right"></i></a>
                                    <span class="d-block"></span>
                                <img src="<?php echo SITEPATH; ?>/images/rocket.png" class="card-img pt-4" alt="rocket" style="width:50px;margin-left: 38%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      <?php } ?>
</div>

<?php include("footer.php")?>

<script>
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
        //  var average1 = Math.round(average1);
          //var average1 = average1.toFixed(0);
           // alert(average1);
          if(average1*attemptedCount>=100){
          progressBar(100,100);
          }else{
              progressBar(parseInt(average1*attemptedCount),100);
          }
}

</script>

<script>
   $(document).ready(function(){
            $('.wrapper').addClass("toggled"); 
        
            $("#btn_get_started").click(function(){
                $('#temp_section').slideUp('slow');
                $('#que_1').slideDown('slow');
                $("#btn_slider").slideDown('slow');
                setup(); 
            });
          
            // disable button (Button Validation)            
             $("#que_res").keyup(function() {
            
                if($(this).val() != ''){
                    $('#button_next').removeClass("action-btn-disabled");
                } 
            });
            
            
            $("#btn_next").click(function(){
                 if($('#que_res').val() != ''){
               $('#que_1').slideUp('slow');
               $('#que_2').slideDown('slow');
                 }
            });
            
            $("#que_2 input:radio").click(function() {
               $('#que_2').slideUp('slow');
               $('#que_3').slideDown('slow');
             setup(); 
            });
            
            $("#que_3 input:radio").click(function() {
               $('#que_3').slideUp('slow');
               $('#que_4').slideDown('slow');
               setup(); 
            });
            
            $("#que_4 input:radio").click(function() {
               $('#que_4').slideUp('fast');
               $('#que_5').slideDown('fast');
            });
            
            $("#que_5 input:radio").click(function() {
               $('#que_5').slideUp('slow');
               $('#que_6').slideDown('slow');
            });
            
            $("#btn_next_check").click(function() {
               $('#que_6').slideUp(200);
               $('#que_7').slideDown(200);
              
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
		$('.end').slideDown('slow');
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

$('body').on('click', '.end', function() { 
	$('.end').hide();
    $('.que_section').show();
    $('#que-7').show();
});
</script>