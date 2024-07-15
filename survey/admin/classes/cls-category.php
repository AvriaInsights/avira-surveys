<?php
require_once("cls-connection.php");
class Category extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleCategoryDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_category', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getCategoryDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_category', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertCategory($insert_data, $debug = 0) {
        return $this->insertRow("tbl_category", $insert_data, $debug);
    }

    public function deleteCategory($condition = '', $debug = 0) {
        $this->deleteRow("tbl_category", $condition, $debug);
    }

    public function updateCategory($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_category", $update_data, $condition, $debug);
    }

}

?>