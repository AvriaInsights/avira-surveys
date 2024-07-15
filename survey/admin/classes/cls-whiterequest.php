<?php

require_once("cls-connection.php");

class Whiterequest extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleRequestDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_whiterequest', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getRequestDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_whiterequest', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getFullRequestDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_whiterequest` LEFT JOIN `tbl_white` ON `tbl_whiterequest`.`paper_id` = `tbl_white`.`paper_id`', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertRequest($insert_data, $debug = 0) {
        return $this->insertRow("tbl_whiterequest", $insert_data, $debug);
    }

    public function deleteRequest($condition = '', $debug = 0) {
        $this->deleteRow("tbl_whiterequest", $condition, $debug);
    }

    public function updateRequest($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_whiterequest", $update_data, $condition, $debug);
    }

}

?>