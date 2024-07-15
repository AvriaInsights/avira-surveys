<?php

require_once("cls-connection.php");

class Admin extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleAdminDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_client_user', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getAdminDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_client_user', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertAdmin($insert_data, $debug = 0) {
        return $this->insertRow("tbl_client_user", $insert_data, $debug);
    }

    public function deleteAdmin($condition = '', $debug = 0) {
        $this->deleteRow("tbl_client_user", $condition, $debug);
    }

    public function updateAdmin($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_client_user", $update_data, $condition, $debug);
    }

}

?>