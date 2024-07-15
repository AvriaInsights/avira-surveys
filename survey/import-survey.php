<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

$conn = $obj_survey->getConnectionObj();
$surveyid = $_POST['surveyid'];
if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            
            $sub_no = 1;
            
            
            while(($line = fgetcsv($csvFile)) !== FALSE){
                
                // Get row data
                $questions_title   = $line[0];
                $questiontype = $line[1];
                $question_level = $line[2];
                $question_tooltip = $line[3];
                $question_required = $line[4];
                    
                if($question_level=="Header")
                {
                        $fields_type="`tbl_question_type`.`quest_type_id`";
                        $condition_type="`tbl_question_type`.`quest_type`='".$questiontype."'";
                        $type_results = $obj_survey->getQuestionType($fields_type,$condition_type,'',1,0);
                        $type_results = end($type_results);
                        $questid = $type_results['quest_type_id'];
                        
                        if($question_required=="")
                        {
                            $question_required="No";
                        }
                        $insert_dataa['quest_type_id'] = mysqli_real_escape_string($conn, $questid);
                        $insert_dataa['survey_id'] = mysqli_real_escape_string($conn, $surveyid);
                        $insert_dataa['question_title'] = mysqli_real_escape_string($conn, $questions_title);
                        $insert_dataa['tooltip'] = mysqli_real_escape_string($conn, $question_tooltip);
                        $insert_dataa['is_required'] = mysqli_real_escape_string($conn, $question_required);
                        $insert_dataa['status'] = "Active";
                        $insert_dataa['created_at'] = date("Y-m-d H:i:s");
                        $insert_dataa['updated_at'] = date("Y-m-d H:i:s");
                        $obj_survey->insertSurveyQuestion($insert_dataa, 0);
                        
                        $question_details = $obj_survey->getQuestionBank('MAX(`question_id`) as question_id', '','',1,0);
                        $question_details = end($question_details);
                        $question_id = $question_details['question_id'];
                        
                        if($questiontype=="Boolean" || $questiontype=="boolean")
                        {
                            $questions_title="Yes";
                            $insert_dataas['question_id'] = mysqli_real_escape_string($conn, $question_id); 
                            $insert_dataas['question_subtitle'] = mysqli_real_escape_string($conn, $questions_title);
                            $insert_dataas['status'] = "Active";
                            $insert_dataas['created_at'] = date("Y-m-d H:i:s");
                            $insert_dataas['updated_at'] = date("Y-m-d H:i:s");
                            $obj_survey->insertSurveyQuestionSubPoints($insert_dataas, 0);
                            
                            $questions_title="No";
                            $insert_dataas['question_id'] = mysqli_real_escape_string($conn, $question_id); 
                            $insert_dataas['question_subtitle'] = mysqli_real_escape_string($conn, $questions_title);
                            $insert_dataas['status'] = "Active";
                            $insert_dataas['created_at'] = date("Y-m-d H:i:s");
                            $insert_dataas['updated_at'] = date("Y-m-d H:i:s");
                            $obj_survey->insertSurveyQuestionSubPoints($insert_dataas, 0);
                        }
                        
                        if($questiontype=="Text" || $questiontype=="text")
                        {
                            $questions_title="Text";
                            $insert_dataas['question_id'] = mysqli_real_escape_string($conn, $question_id); 
                            $insert_dataas['question_subtitle'] = mysqli_real_escape_string($conn, $questions_title);
                            $insert_dataas['status'] = "Active";
                            $insert_dataas['created_at'] = date("Y-m-d H:i:s");
                            $insert_dataas['updated_at'] = date("Y-m-d H:i:s");
                            $obj_survey->insertSurveyQuestionSubPoints($insert_dataas, 0);
                        }
                        
                        if($questiontype=="Rating" || $questiontype=="rating")
                        {
                            $questions_title="Rating";
                            $insert_dataas['question_id'] = mysqli_real_escape_string($conn, $question_id); 
                            $insert_dataas['question_subtitle'] = mysqli_real_escape_string($conn, $questions_title);
                            $insert_dataas['status'] = "Active";
                            $insert_dataas['created_at'] = date("Y-m-d H:i:s");
                            $insert_dataas['updated_at'] = date("Y-m-d H:i:s");
                            $obj_survey->insertSurveyQuestionSubPoints($insert_dataas, 0);
                        }
                }
                else
                {
                        $question_details = $obj_survey->getQuestionBank('MAX(`question_id`) as question_id', '','',1,0);
                        $question_details = end($question_details);
                        $question_id = $question_details['question_id'];
                        
                        $insert_dataas['question_id'] = mysqli_real_escape_string($conn, $question_id); 
                        $insert_dataas['question_subtitle'] = mysqli_real_escape_string($conn, $questions_title);
                        $insert_dataas['status'] = "Active";
                        $insert_dataas['created_at'] = date("Y-m-d H:i:s");
                        $insert_dataas['updated_at'] = date("Y-m-d H:i:s");
                        $obj_survey->insertSurveyQuestionSubPoints($insert_dataas, 0);
                        
                        
                }
    
                    
                    
             $sub_no++;       
                           
            }
            
            echo "Empty file";
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
            //echo "<script> alert('Record does not Added succesfully....'); </script>";
            $_SESSION['msg']="<strong>Congratulations</strong> Survey information has been inserted successfully";
            header("Location: bulk-survey.php?surveyid=".$surveyid);
        }else{
           // $qstring = '?status=err';
           $_SESSION['msg']="Error";
           header("Location: bulk-survey.php?surveyid=".$surveyid);
        }
    }else{
        $qstring = '?status=invalid_file';
        $_SESSION['msg']="Invalid File";
        header("Location: bulk-survey.php?surveyid=".$surveyid);
    }
}

// Redirect to the listing page

header("Location: bulk-survey.php?surveyid=".$surveyid);

?>