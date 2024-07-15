<?php

require_once("cls-connection.php");

class Payment extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSinglePaymentDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_payment', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getPaymentDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_payment', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getFullPaymentDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_payment` LEFT JOIN `tbl_report` ON `tbl_payment`.`report_id` = `tbl_report`.`report_id`', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertPayment($insert_data, $debug = 0) {
        return $this->insertRow("tbl_payment", $insert_data, $debug);
    }

    public function deletePayment($condition = '', $debug = 0) {
        $this->deleteRow("tbl_payment", $condition, $debug);
    }

    public function updatePayment($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_payment", $update_data, $condition, $debug);
    }

}

?>