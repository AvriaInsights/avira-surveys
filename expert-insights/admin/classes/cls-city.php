<?php

require_once("cls-connection.php");

class City extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleCityDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_city', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getCityDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_city', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getCityStateCountryDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_city, tbl_state, tbl_country', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertCity($insert_data, $debug = 0) {
        return $this->insertRow("tbl_city", $insert_data, $debug);
    }

    public function deleteCity($condition = '', $debug = 0) {
        $this->deleteRow("tbl_city", $condition, $debug);
    }

    public function updateCity($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_city", $update_data, $condition, $debug);
    }

}

?>