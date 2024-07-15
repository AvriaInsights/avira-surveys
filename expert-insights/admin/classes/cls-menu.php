<?php

require_once("cls-connection.php");

class Menu extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleMenuDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_menu', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getMenuDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_menu', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getAdminDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_admin', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getRegionDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_region', $fields, $condition, $order_by, $limit, $debug);
    }
    
}

?>