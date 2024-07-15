<?php
require_once("cls-connection.php");
class FAQ extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleFAQDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_faq', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getFAQDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_faq', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertFAQ($insert_data, $debug = 0) {
        return $this->insertRow("tbl_faq", $insert_data, $debug);
    }

    public function deleteFAQ($condition = '', $debug = 0) {
        $this->deleteRow("tbl_faq", $condition, $debug);
    }

    public function updateFAQ($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_faq", $update_data, $condition, $debug);
    }

}

?>