<?php

require_once("cls-connection.php");

class Order extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleOrderDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_order', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getOrderDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_order', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertOrder($insert_data, $debug = 0) {
        return $this->insertRow("tbl_order", $insert_data, $debug);
    }

    public function deleteOrder($condition = '', $debug = 0) {
        $this->deleteRow("tbl_order", $condition, $debug);
    }

    public function updateOrder($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_order", $update_data, $condition, $debug);
    }

}

?>