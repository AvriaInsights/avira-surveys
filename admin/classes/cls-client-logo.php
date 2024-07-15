<?php

require_once("cls-connection.php");

class Logo extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleLogoDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_client_logo', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getLogoDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_client_logo', $fields, $condition, $order_by, $limit, $debug);
    }


    public function insertLogo($insert_data, $debug = 0) {
        return $this->insertRow("tbl_client_logo", $insert_data, $debug);
    }

    public function deleteLogo($condition = '', $debug = 0) {
        $this->deleteRow("tbl_client_logo", $condition, $debug);
    }

    public function updateLogo($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_client_logo", $update_data, $condition, $debug);
    }

}

?>