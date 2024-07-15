<?php

require_once("cls-connection.php");

class Enquiry extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleEnquiryDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_enquiry', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getEnquiryDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_enquiry', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getFullEnquiryDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_enquiry` LEFT JOIN `tbl_report` ON `tbl_enquiry`.`report_id` = `tbl_report`.`report_id`', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertEnquiry($insert_data, $debug = 0) {
        return $this->insertRow("tbl_enquiry", $insert_data, $debug);
    }

    public function deleteEnquiry($condition = '', $debug = 0) {
        $this->deleteRow("tbl_enquiry", $condition, $debug);
    }

    public function updateEnquiry($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_enquiry", $update_data, $condition, $debug);
    }

}

?>