<?php

require_once("cls-connection.php");

class Survey extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleRequestDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_request', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getRequestDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_request', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getFullRequestDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_request` LEFT JOIN `tbl_report` ON `tbl_request`.`report_id` = `tbl_report`.`report_id`', $fields, $condition, $order_by, $limit, $debug);
    }

    public function deleteRequest($condition = '', $debug = 0) {
        $this->deleteRow("tbl_request", $condition, $debug);
    }

    public function updateRequest($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_request", $update_data, $condition, $debug);
    }
    
    /******************/
    public function updateSurveyTitle($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_survey", $update_data, $condition, $debug);
    }
    
    public function insertSurveyTitle($insert_data, $debug = 0) {
        return $this->insertRow("tbl_survey", $insert_data, $debug);
    }
    
    public function getSurveyCategory($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_category', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getSurveyDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_survey', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getQuestionType($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_question_type', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getQuestionBank($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_questionBank', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getSubQuestionPoints($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_questionSub', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function deleteQuestion($condition = '', $debug = 0) {
        $this->deleteRow("tbl_questionBank", $condition, $debug);
    }
    
    public function insertSurveyQuestion($insert_data, $debug = 0) {
        return $this->insertRow("tbl_questionBank", $insert_data, $debug);
    }
    
    public function updateSurveyQuestion($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_questionBank", $update_data, $condition, $debug);
    }
    
    public function insertSurveyQuestionSubPoints($insert_data, $debug = 0) {
        return $this->insertRow("tbl_questionSub", $insert_data, $debug);
    }
    
    public function deleteSubQuestionPoints($condition = '', $debug = 0) {
        $this->deleteRow("tbl_questionSub", $condition, $debug);
    }
    
    public function updateSurveyQuestionPoints($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_questionSub", $update_data, $condition, $debug);
    }
    
    public function getFullQuestionDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_questionBank` LEFT JOIN `tbl_questionSub` ON `tbl_questionBank`.`question_id` = `tbl_questionSub`.`question_id`', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function insertSurveyCopyPaste($insert_data, $debug = 0) {
        return $this->insertRow("tbl_copy_paste", $insert_data, $debug);
    }
    
    public function getDummyQuestions($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_dummy_questionBank', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getDummySubQuestionPoint($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_dummy_subQuestion', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function updateSurvey($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_survey", $update_data, $condition, $debug);
    }
    
    public function getAnalystDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_buildAnalyst', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function insertImportContacts($insert_data, $debug = 0) {
        return $this->insertRow("tbl_client_contacts", $insert_data, $debug);
    }
    
    public function getImportContacts($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_client_contacts', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function insertShareData($insert_data, $debug = 0) {
        return $this->insertRow("tbl_share_content", $insert_data, $debug);
    }
    
    public function getUserDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_client_user', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function insertShareTempData($insert_data, $debug = 0) {
        return $this->insertRow("tbl_temp_share", $insert_data, $debug);
    }
    
    public function insertShareRecTempData($insert_data, $debug = 0) {
        return $this->insertRow("tbl_share_recipient", $insert_data, $debug);
    }
    
    public function updateShareData($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_share_content", $update_data, $condition, $debug);
    }
    
    public function getTempShareEmail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_temp_share', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getShareContent($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_share_content', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function deleteTempShareEmail($condition = '', $debug = 0) {
        $this->deleteRow("tbl_temp_share", $condition, $debug);
    }
    
    public function insertResponseUser($insert_data, $debug = 0) {
        return $this->insertRow("tbl_response_user", $insert_data, $debug);
    }
    
    public function insertResponseResult($insert_data, $debug = 0) {
        return $this->insertRow("tbl_response_result", $insert_data, $debug);
    }
    
    public function getSurveyUser($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_response_user', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function deleteSurveyResult($condition = '', $debug = 0) {
        $this->deleteRow("tbl_response_result", $condition, $debug);
    }
    
    public function getSurveyResult($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_response_result', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getFullSurveyUser($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_response_user` LEFT JOIN `tbl_survey` ON `tbl_response_user`.`survey_id` = `tbl_survey`.`survey_id`', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function updateSubQuestionranksequnce($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_questionSub", $update_data, $condition, $debug);
    }
    
     public function UpdateSurveyQuestionskip($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_questionBank", $update_data, $condition, $debug);
    }
    
    public function UpdateResponseUser($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_response_user", $update_data, $condition, $debug);
    }
    
    public function getFullQuestionType($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_questionBank` LEFT JOIN `tbl_question_type` ON `tbl_questionBank`.`quest_type_id` = `tbl_question_type`.`quest_type_id`', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getFullResponseUserResult($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_response_user` LEFT JOIN `tbl_response_result` ON `tbl_response_user`.`response_user_id` = `tbl_response_result`.`response_user_id`', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function insertCampaignSurvey($insert_data, $debug = 0) {
        return $this->insertRow("tbl_campaign_user", $insert_data, $debug);
    }
    
    public function updateCampaignSurvey($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_campaign_user", $update_data, $condition, $debug);
    }
    
    public function getCampaignSurveyDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_campaign_user', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getFeedbackDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_feedback', $fields, $condition, $order_by, $limit, $debug);
    }
}

?>