<?php

require_once("cls-connection.php");

class Blog extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleBlogDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_blog', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getBlogDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_blog', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getCategoryBlogDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_blog` LEFT JOIN `tbl_category` USING (`category_id`)', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getCategoryBlogDetailsByBindParam($fields = '', $condition = '',$parameters_array, $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecordsByBindParam('`tbl_blog` LEFT JOIN `tbl_category` USING (`category_id`)', $fields, $condition,$parameters_array, $order_by, $limit, $debug);
    }

    public function insertBlog($insert_data, $debug = 0) {
        return $this->insertRow("tbl_blog", $insert_data, $debug);
    }

    public function deleteBlog($condition = '', $debug = 0) {
        $this->deleteRow("tbl_blog", $condition, $debug);
    }

    public function updateBlog($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_blog", $update_data, $condition, $debug);
    }

}

?>