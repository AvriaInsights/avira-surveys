<?php

require_once("cls-connection.php");

class Report extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleReportDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_report', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getReportDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_report', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getFullReportDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_report` LEFT JOIN `tbl_category` USING (`category_id`) LEFT JOIN `tbl_author` USING (`author_id`)', $fields, $condition, $order_by, $limit, $debug);
    }
    public function getFullReportDetailsByBindParam($fields = '', $condition = '',$parameters_array, $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecordsByBindParam('`tbl_report` LEFT JOIN `tbl_category` USING (`category_id`) LEFT JOIN `tbl_author` USING (`author_id`)', $fields, $condition,$parameters_array, $order_by, $limit, $debug);
    }

    public function getCategoryReportDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_report` LEFT JOIN `tbl_category` USING (`category_id`)', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getCatReportDetails($fields = '', $condition = '', $group_by = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getFullRecords('`tbl_report` LEFT JOIN `tbl_category` USING (`category_id`)', $fields, $condition, $group_by, $order_by, $limit, $debug);
    }

    public function insertReport($insert_data, $debug = 0) {
        return $this->insertRow("tbl_report", $insert_data, $debug);
    }

    public function deleteReport($condition = '', $debug = 0) {
        $this->deleteRow("tbl_report", $condition, $debug);
    }

    public function updateReport($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_report", $update_data, $condition, $debug);
    }
    
      public function insertReportFAQ($insert_data, $debug = 0) {
        return $this->insertRow("tbl_faq", $insert_data, $debug);
    }
    
    
        public function getFullReportDetailsFAQ($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_faq` LEFT JOIN `tbl_report` USING (`report_id`) LEFT JOIN `tbl_author` USING (`author_id`)', $fields, $condition, $order_by, $limit, $debug);
    }

}

?>