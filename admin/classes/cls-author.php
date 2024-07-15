<?php

require_once("cls-connection.php");

class Author extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleAuthorDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_author', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getAuthorDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_author', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertAuthor($insert_data, $debug = 0) {
        return $this->insertRow("tbl_author", $insert_data, $debug);
    }

    public function deleteAuthor($condition = '', $debug = 0) {
        $this->deleteRow("tbl_author", $condition, $debug);
    }

    public function updateAuthor($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_author", $update_data, $condition, $debug);
    }

}

?>