<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}

$qtype=$_GET['currquetype'];
$queid=$_GET['currqueid'];
$arr = array();
$alloption="";
$matrix_alloption = "";
$userid=$_SESSION['ifg_admin']['client_id'];

$fields_quest_bank = "`tbl_questionBank`.*,`tbl_questionSub`.*";
$condition_quest_bank = "`tbl_questionBank`.`status` = 'Active' and `tbl_questionBank`.`question_id`='".$queid."'";
$question_bank_lists=$obj_survey->getFullQuestionDetails($fields_quest_bank, $condition_quest_bank, '', '', 0);
foreach($question_bank_lists as $question_bank_list)
{
    $arr['qtitle'] = $question_bank_list['question_title'];
    $arr['qtooltip'] = $question_bank_list['tooltip'];
    $arr['qrequired'] = $question_bank_list['is_required'];
    if($qtype=="Text" || $qtype=="Rating")
    {
        $arr['qsubtitle'] = $question_bank_list['question_subtitle'];
    }
    elseif($qtype=="Opinion Scale")
    {
        $scalevalue = $question_bank_list['opinion_scale_text'];
    }
    elseif($qtype=="Matrix")
    {
        $matrix_alloption.=stripslashes($question_bank_list['question_subtitle']).":".$question_bank_list['question_subid'].":".$question_bank_list['question_id'].":".$question_bank_list['matrix_type'].":".$question_bank_list['matrix_input_type']."*";
    }
    else
    {
        $alloption.=$question_bank_list['question_subtitle']."*";
        
    }
}
//print_r($alloption); exit;
if($qtype=="Boolean" || $qtype=="Dropdown" || $qtype=="Checkbox" || $qtype=="Radio" || $qtype=="Order" || $qtype == "Mrating")
{
 
    $arr['qsubtitle'] = trim($alloption,"*");
   
}
if($qtype=="Matrix")
{
    $arr['qsubtitle'] = trim($matrix_alloption,"*");
}

if($qtype=="Opinion Scale")
{
    $arr['qsubtitle'] = $scalevalue;
    $alloppscalelabel = (explode(",",$scalevalue)); 
}
?>
<div class="row">
    <img src="<?php echo SITEPATHFRONT; ?>/images/pattern-bottom.png" class="img-fluid pattern-bottom-img" style="position: absolute;height: 100%;">
    <div class="col-md-12">
        <div class="">
            <div class="form-group">
                <p class=
                "que-type">Question Type : <span><?php if($qtype == "Mrating"){echo "Multiple Rating";} else{ echo $qtype;} ?></span></p>
            </div>
            <div class="form-group">
                  <p class="que-type">Question : <span><?php echo $arr['qtitle']?></span></p>
            </div>
                <?php if($qtype == "Boolean"){?>
                    <div class="row justify-content-center">
                        <div class="col-2 yesno_box__icon-wrap">
                            <i class="fa fa-thumbs-up" style="font-size:100px;"></i>
                        </div>
                        <div class="col-2 yesno_box__icon-wrap" style="margin-left:10px;">
                            <i class="fa fa-thumbs-down" style="font-size:100px;"></i>
                        </div>
                     </div>
                     <div class="row justify-content-center">
                        <div class="col-2 bollab">
                            <label>YES</label>
                        </div>
                        <div class="col-2 bollab" style="margin-left:10px;">
                            <label>NO</label>
                        </div>
                    </div>
                <?php } ?>
                 <?php if($qtype == "Radio"){ 
                         $allradiovalue = (explode("*",$arr['qsubtitle']));
                         foreach( $allradiovalue as $allradiovalues ){
                         echo "<div class='list-radio'>
                            <ul class='list-unstyled'>
                                <li>
                                    <label>
                                        <input type='radio' name='lang' value='$allradiovalues' /> $allradiovalues</label>
                                </li>
                            </ul>
                        </div>";
                         } } ?>
                    
                 <?php if($qtype == "Text"){?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-holder">
                                    <div class="textinput-box active">
                                        <input disabled="" placeholder="Text Input" class="disabltext col-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 <?php } ?>
                 
                 <?php if($qtype == "Rating"){?>
                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center star-size">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o starpad"></i>
                            <i class="fa fa-star-o starpad"></i>
                            <i class="fa fa-star-o starpad"></i>
                            <i class="fa fa-star-o starpad"></i>
                        </div>
                    </div>
                 <?php } ?>
                 
                  <?php if($qtype == "Opinion Scale"){?>
                  <div class="row justify-content-center ps-5">
                    
                       <?php for($t=0;$t<=10;$t++){?>
                           <div class="col-md-1 opcol">
                             <span class="opiniscal"><?php echo $t;?></span>
                               <?php if($t==0){?>
                                <span class="form-label checklabel"><div id="minlabel" class="m-3"><?php echo $alloppscalelabel[0]; ?></div></span>
                               <?php }?>
                               <?php if($t==5){?>
                               <span class="form-label checklabel"><div id="midlabel" class="m-3"><?php echo $alloppscalelabel[1]; ?></div></span>
                               <?php }?>
                               <?php if($t==10){?>
                              <span class="form-label checklabel"><div id="highlabel" class="m-3"><?php echo $alloppscalelabel[2]; ?></div></span>
                               <?php }?>
                            </div>
                           
                       <?php }?>
                              
                      </div>
                 <?php } ?>
                 
                  <?php if($qtype == "Checkbox"){ 
                         $allcheckboxvalue = (explode("*",$arr['qsubtitle']));
                         foreach( $allcheckboxvalue as $allcheckboxvalues ){
                         echo "<div class='list-radio'>
                                <ul class='list-unstyled'>
                                    <li>
                                        <label>
                                            <input type='Checkbox' name='check' value='$allcheckboxvalues' /> $allcheckboxvalues</label>
                                    </li>
                                </ul>
                            </div>";
                         } } ?>
                 
                  <?php if($qtype == "Dropdown"){ 
                         $alldropdownboxvalue = (explode("*",$arr['qsubtitle']));
                         ?>
                         <h5>Dropdown Options</h5>
                         <?php 
                         foreach( $alldropdownboxvalue as $alldropdownboxvalues ){
                         echo "
                          <div class='list-radio'>
                                <ul class='list-unstyled'>
                                    <li>$alldropdownboxvalues</li>
                                </ul>
                          </div>
                         ";
                         } } ?>
                         
                  <?php if($qtype == "Order"){ 
                         $allordervalue = (explode("*",$arr['qsubtitle']));
                         ?>
                         <h5>Rank Orders Options</h5>
                         <?php $counter = 0; 
                         foreach( $allordervalue as $allordervalues ){ $counter++;
                         echo "
                          <div class='list-radio'>
                            <ul class='list-unstyled'>
                                <li><span>$counter.</span> $allordervalues</li>
                            </ul>
                        </div>
                         ";
                         } } ?>
                         
                  <?php if($qtype == "Mrating"){ 
                         $allmratingvalue = (explode("*",$arr['qsubtitle']));
                         ?>
                         <h5>Multiple Rating Options</h5>
                         <?php $counter = 0; 
                         foreach( $allmratingvalue as $allmratingvalues ){ $counter++;
                         echo "
                          <div class='list-radio'>
                            <ul class='list-unstyled'>
                                <li><span>$counter.</span> $allmratingvalues</li>
                            </ul>
                        </div>
                         ";
                         } } ?>
                         
                         
                         <?php if($qtype == "Matrix"){ 
                         $allmatrixvalue = explode("*",$arr['qsubtitle']);
                         for($i=0;$i < count($allmatrixvalue);$i++)
                         {
                              $singlematrixval = explode(":",$allmatrixvalue[$i]);
                              
                         }
                         
                         $matrix_input_type = $singlematrixval[4];
                         
                         ?>
                         <h5>Matrix Rating Options</h5>
                        
                         <div class="chk_class matrix_tbl_view">
                                                <table class="responsive-table-input-matrix matrix_tbl matrixtable1">
                                                    <tbody>
                                                        <?php  
                                                        //$count_coulmn="0";
                                                        $arr=array();
                                                        $fields_subpoints_count = "*";
                                                        $condition_subpoints_count = "`tbl_questionSub`.`question_id` =".$queid;
                                                        $all_subpoints_matrixs=$obj_survey->getSubQuestionPoints($fields_subpoints_count, $condition_subpoints_count, '', '', 0); 
                                                        ?>
                                                            <tr class="tabbord">
                                                                <td></td>
                                                                <?php
                                                                   foreach($all_subpoints_matrixs as $all_subpoints_matrix){
                                                                     if($all_subpoints_matrix['matrix_type']=="column"){
                                                                         //$count_coulmn++;
                                                                         $col_id=$all_subpoints_matrix['question_subid'];
                                                                         array_push($arr,$col_id);
                                                                ?>
                                                                <td class="tabbord"><?php echo $all_subpoints_matrix['question_subtitle']; ?></td>
                                                                <?php } }?>
                                                    		</tr>
                                                            
                                                            <?php foreach($all_subpoints_matrixs as $all_subpoints_matrix){ if($all_subpoints_matrix['matrix_type']=="row"){ ?>
                                                    		<tr class="matrix_checkbox tabbord">
                                                    			<td class="tabbord"><?php echo $all_subpoints_matrix['question_subtitle'];  ?></td>
                                                    			<?php for($j=0;$j<count($arr);$j++) { ?>
                                                    			    <td class="tabbord"><input type="<?php echo $matrix_input_type;?>" name="matrixchk_<?php echo $all_subpoints_matrix['question_subid']; ?>" id="matrixchk_<?php echo $all_subpoints_matrix['question_subid'].$arr[$j]; ?>"></td>
                                                    			<?php } } ?>
                                                    		</tr>
                                                    		<?php } ?>
                                            		  </tbody>
                                            	</table>
            				              </div>
                         
                          <?php }  ?>
                
            <!--<div class="form-group mt-3">-->
            <!--     <?php if($arr['qtooltip'] != "") { ?> Tooltip <i class="fa fa-info-circle"></i> <?php echo $arr['qtooltip']; } ?>-->
            <!--      <span class="float-end"><input type="checkbox" <?php echo ($arr['qrequired']=="Yes" ? 'checked' : '');?>> Required </span>-->
            <!--  </div>-->
            </div>
        </div>
    </div>
</div>
