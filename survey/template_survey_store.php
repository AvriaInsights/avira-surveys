<?php 
require_once("classes/cls-request.php");
require_once("classes/cls-template.php");
require_once("classes/cls-survey.php");

$obj_request = new Request();
$obj_template= new Template(); 
$obj_survey= new Survey(); 

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

if(!empty($_POST['template_id'])){
// print_r($_POST);exit;
    $condition = "`template_id` = '" . base64_decode($_POST['template_id']) . "'";        

    // create a survey with template heading and data
    $template_data = $obj_template->getTemplateDetail('',$condition,'','');
    $input  = array();
    foreach($template_data  as $template){
        $input['category_id'] = (!empty($_POST['category']))?$_POST['category']:$template['category_id']; 
        $input['template_id'] = $template['template_id']; 
        $input['survey_title'] = (!empty($_POST['survey-title']))?$_POST['survey-title']:$template['template_name']; 
        $input['survey_description'] = (!empty($_POST['survey-description']))?$_POST['survey-description']:''; 
        $input['status'] = 'Active'; 
        $input['created_at'] =date("Y-m-d h:i:s");
        $input['updated_at'] = date("Y-m-d h:i:s");
        $last_survey_id = $obj_survey->insertSurveyTitle($input);
        // $_SESSION['survey_id']= $last_survey_id;
        $input  = array(); 
        if(empty($last_survey_id)){
            // print_r($_POST);exit;
            echo "<script>alert('Something went wrong survey could not be created please try again!!');</script>";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
    $input  = array();
    $question_bank = $obj_template->getDummyQuestionBank('', $condition, '', '', 0);
    // print_r($question_bank);exit;
    //Copy all questions to questionsbank table
        foreach($question_bank as $qs_data){
            $input['quest_type_id'] =$qs_data['quest_type_id'];
            $input['survey_id'] = $last_survey_id;
            $input['question_title'] =$qs_data['dummy_question_title'];
            $input['is_required'] =$qs_data['is_required'];
            $input['status'] ='Active';
            $input['created_at'] =date("Y-m-d h:i:s");
            $input['updated_at'] = date("Y-m-d h:i:s");
            $last_question_id = $obj_survey->insertSurveyQuestion($input);
            $input  = array();
            if(empty($last_question_id)){
                // print_r($_SERVER);exit;
                // print_r($_POST);exit;
                echo "<script>alert('Something went wrong questions could not be created please try again!!');</script>";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }else{
                $input  = array();
                $condition = "`dummy_question_id` = '" .$qs_data['dummy_question_id'] . "'";
                $question_dummy_bank = $obj_template->getDummySubQuestionBank('', $condition, '', '', 0);
                if(!empty($question_dummy_bank) || $question_dummy_bank!=''){
                    foreach($question_dummy_bank as $qdb){
                        // $input['quest_type_id'] = $qdb['quest_type_id'];
                        $input['question_id'] = $last_question_id;
                        $input['question_subtitle'] = $qdb['dummy_subquestion_Subtitle'];
                        $input['status'] = 'Active';
                        $input['created_at'] =date("Y-m-d h:i:s");
                        $input['updated_at'] = date("Y-m-d h:i:s");
                        $last_dummy_qs_id = $obj_survey->insertSurveyQuestionSubPoints($input);
                        $input  = array();
                        if(empty($last_dummy_qs_id)){
                            // print_r($_POST);exit;
                            echo "<script>alert('Something went wrong sub questions could not be created please try again!!');</script>";
                            header('Location: ' . $_SERVER['HTTP_REFERER']);
                            exit;
                        }
                    }
                }
                // print_r($_POST);exit;
            }
            }
            $_SESSION['survey_id'] = $last_survey_id ;
           
     //$last_survey_id
     
    }
    header("Location: show_questions.php");
    exit(0);

    // echo "<script>window.location ='show_questions.php'</script>";
?>
