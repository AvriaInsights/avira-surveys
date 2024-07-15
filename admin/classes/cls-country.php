<?php

require_once("cls-connection.php");

class Country extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleCountryDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_country', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getCountryDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_country', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertCountry($insert_data, $debug = 0) {
        return $this->insertRow("tbl_country", $insert_data, $debug);
    }

    public function deleteCountry($condition = '', $debug = 0) {
        $this->deleteRow("tbl_country", $condition, $debug);
    }

    public function updateCountry($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_country", $update_data, $condition, $debug);
    }

}

?>