<?php

require_once("cls-connection.php");

class White extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleReportDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_white', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getReportDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_white', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getFullReportDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_white`', $fields, $condition, $order_by, $limit, $debug);
    }
    public function getFullReportDetailsByBindParam($fields = '', $condition = '',$parameters_array, $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecordsByBindParam('`tbl_white`', $fields, $condition,$parameters_array, $order_by, $limit, $debug);
    }

    public function getCategoryReportDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_white`', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getCatReportDetails($fields = '', $condition = '', $group_by = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getFullRecords('`tbl_white`', $fields, $condition, $group_by, $order_by, $limit, $debug);
    }

    public function insertReport($insert_data, $debug = 0) {
        return $this->insertRow("tbl_white", $insert_data, $debug);
    }

    public function deleteReport($condition = '', $debug = 0) {
        $this->deleteRow("tbl_white", $condition, $debug);
    }

    public function updateReport($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_white", $update_data, $condition, $debug);
    }

}

?>