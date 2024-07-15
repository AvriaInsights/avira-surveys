<?php

require_once("cls-connection.php");

class Press extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSinglePressDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_press', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getPressDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_press', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getCategoryPressDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_press` LEFT JOIN `tbl_category` USING (`category_id`)', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getCategoryPressDetailsByBindParam($fields = '', $condition = '',$parameters_array, $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecordsByBindParam('`tbl_press` LEFT JOIN `tbl_category` USING (`category_id`)', $fields, $condition,$parameters_array, $order_by, $limit, $debug);
    }

    public function insertPress($insert_data, $debug = 0) {
        return $this->insertRow("tbl_press", $insert_data, $debug);
    }

    public function deletePress($condition = '', $debug = 0) {
        $this->deleteRow("tbl_press", $condition, $debug);
    }

    public function updatePress($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_press", $update_data, $condition, $debug);
    }

}

?>