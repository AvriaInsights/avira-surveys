<?php

require_once("cls-connection.php");

class State extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleStateDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_state', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getStateDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_state', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getStateCountryDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_state, tbl_country', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertState($insert_data, $debug = 0) {
        return $this->insertRow("tbl_state", $insert_data, $debug);
    }

    public function deleteState($condition = '', $debug = 0) {
        $this->deleteRow("tbl_state", $condition, $debug);
    }

    public function updateState($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_state", $update_data, $condition, $debug);
    }

}

?>