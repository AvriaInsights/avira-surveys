<?php
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$editqid=$_POST['editqid'];
/*********Fetch skip data*************/
$fields_skip_data = "`tbl_questionSub`.*";
$condition_skip_data = "`tbl_questionSub`.`question_id`='".$editqid."'";
$orderby_skip_data = "`tbl_questionSub`.`question_subid` asc";
$skip_data_lists=$obj_survey->getSubQuestionPoints($fields_skip_data, $condition_skip_data, $orderby_skip_data, '', 0);

/*********Fetch skip data Question Table*************/
$fields_skip_data_que = "`tbl_questionBank`.*";
$condition_skip_data_que = "`tbl_questionBank`.`question_id`='".$editqid."'";
$skip_que_data_lists=$obj_survey->getQuestionBank($fields_skip_data_que, $condition_skip_data_que, '', '', 0);
foreach($skip_que_data_lists as $skip_que_data_list)
{
    $que_type_id = $skip_que_data_list['quest_type_id'];
    $que_title = $skip_que_data_list['question_title'];
    $que_skip_to = $skip_que_data_list['skip_question_where_to'];
}
?>

<?php
if($que_type_id == "4" || $que_type_id == "3" || $que_type_id == "8" || $que_type_id == "6" || $que_type_id == "9" || $que_type_id == "10"){ ?>

<table>
        <tr>
            <th>Question Title</th>
            <th>Skip To Question</th>
        </tr>
        <?php if($que_skip_to!=""){?>
        <tr>
            <td><?php echo $que_title;?></td>
            <td>Question <?php echo $que_skip_to;?></td>
        </tr>
        <?php }?>
</table>

<?php } else { ?>

<table>
        <tr>
            <th>Options</th>
            <th>Skip To Question</th>
        </tr>
        <?php foreach($skip_data_lists as $skip_data_list){ if($skip_data_list['skip_question']!=""){?>
        <tr>
            <td><?php echo $skip_data_list['question_subtitle'];?></td>
            <td>Question <?php echo $skip_data_list['skip_question'];?></td>
        </tr>
        <?php }}?>
</table>
<?php } ?>
    