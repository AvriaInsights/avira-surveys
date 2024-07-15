<?php

require_once("cls-connection.php");

class Career extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSinglePageDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_career', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getPageDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_career', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertPage($insert_data, $debug = 0) {
        return $this->insertRow("tbl_career", $insert_data, $debug);
    }

    public function deletePage($condition = '', $debug = 0) {
        $this->deleteRow("tbl_career", $condition, $debug);
    }

    public function updatePage($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_career", $update_data, $condition, $debug);
    }

}

?>