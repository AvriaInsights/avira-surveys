<?php
require_once("cls-connection.php");
class OrderItem extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleOrderItemDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_order_item', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getFullOrderItemDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_order_item` LEFT JOIN `tbl_report` ON `tbl_order_item`.`report_id` = `tbl_report`.`report_id`', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getOrderItemDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_order_item', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertOrderItem($insert_data, $debug = 0) {
        return $this->insertRow("tbl_order_item", $insert_data, $debug);
    }

    public function deleteOrderItem($condition = '', $debug = 0) {
        $this->deleteRow("tbl_order_item", $condition, $debug);
    }

    public function updateOrderItem($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_order_item", $update_data, $condition, $debug);
    }

}

?>