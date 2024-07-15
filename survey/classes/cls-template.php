<?php 
require_once("cls-connection.php");

class template extends Connection {

public function __construct() {
    parent::__construct();
}
public function insertTemplateTitle($insert_data, $debug = 0) {
    return $this->insertRow("tbl_template", $insert_data, $debug);
}

public function getSurveyCategory($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
    return $this->getRecords('tbl_category', $fields, $condition, $order_by, $limit, $debug);
}

public function getTemplateDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
    return $this->getRecords('tbl_template', $fields, $condition, $order_by, $limit, $debug);
}

public function getQuestionType($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
    return $this->getRecords('tbl_question_type', $fields, $condition, $order_by, $limit, $debug);
}

public function getDummyQuestionBank($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
    return $this->getRecords('tbl_dummy_questionBank', $fields, $condition, $order_by, $limit, $debug);
}
public function getDummySubQuestionBank($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
    return $this->getRecords('tbl_dummy_subQuestion', $fields, $condition, $order_by, $limit, $debug);
}
public function deleteQuestion($condition = '', $debug = 0) {
    $this->deleteRow("tbl_dummy_questionBank", $condition, $debug);
}

public function getDummyQuestions($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
    return $this->getRecords('tbl_dummy_questionBank', $fields, $condition, $order_by, $limit, $debug);
}

public function getSubQuestion($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
    return $this->getRecords('tbl_dummy_subQuestion', $fields, $condition, $order_by, $limit, $debug);
}


}
?>