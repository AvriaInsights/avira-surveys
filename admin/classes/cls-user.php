<?php

require_once("cls-connection.php");

class User extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleUserDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_user', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getUserDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_user', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertUser($insert_data, $debug = 0) {
        return $this->insertRow("tbl_user", $insert_data, $debug);
    }

    public function deleteUser($condition = '', $debug = 0) {
        $this->deleteRow("tbl_user", $condition, $debug);
    }

    public function updateUser($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_user", $update_data, $condition, $debug);
    }

}

?>