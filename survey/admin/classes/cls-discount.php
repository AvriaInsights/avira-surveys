<?php

require_once("cls-connection.php");

class Discount extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleDiscountDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_discount', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getDiscountDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_discount', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getFullDiscountDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_discount` LEFT JOIN `tbl_report` ON `tbl_discount`.`report_id` = `tbl_report`.`report_id`', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertDiscount($insert_data, $debug = 0) {
        return $this->insertRow("tbl_discount", $insert_data, $debug);
    }

    public function deleteDiscount($condition = '', $debug = 0) {
        $this->deleteRow("tbl_discount", $condition, $debug);
    }

    public function updateDiscount($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_discount", $update_data, $condition, $debug);
    }

}

?>