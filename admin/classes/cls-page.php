<?php

require_once("cls-connection.php");

class Page extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSinglePageDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_page', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getPageDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_page', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getCategoryPageDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_page` LEFT JOIN `tbl_category` USING (`category_id`)', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertPage($insert_data, $debug = 0) {
        return $this->insertRow("tbl_page", $insert_data, $debug);
    }

    public function deletePage($condition = '', $debug = 0) {
        $this->deleteRow("tbl_page", $condition, $debug);
    }

    public function updatePage($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_page", $update_data, $condition, $debug);
    }

}

?>