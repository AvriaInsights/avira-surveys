<?php

require_once("cls-connection.php");

class Image extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleImageDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_image', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getImageDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_image', $fields, $condition, $order_by, $limit, $debug);
    }


    public function insertImage($insert_data, $debug = 0) {
        return $this->insertRow("tbl_image", $insert_data, $debug);
    }

    public function deleteImage($condition = '', $debug = 0) {
        $this->deleteRow("tbl_image", $condition, $debug);
    }

    public function updateImage($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_image", $update_data, $condition, $debug);
    }

}

?>