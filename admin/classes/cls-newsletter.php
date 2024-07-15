<?php
require_once("cls-connection.php");
class Newsletter extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleCategoryDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_category', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getNewsletterDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_newsletter_subscriber', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertNewsletterSubscription($insert_data, $debug = 0) {
        return $this->insertRow("tbl_newsletter_subscriber", $insert_data, $debug);
    }

    public function deleteCategory($condition = '', $debug = 0) {
        $this->deleteRow("tbl_category", $condition, $debug);
    }

    public function updateCategory($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_category", $update_data, $condition, $debug);
    }




    public function getSingleNewsletterDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_newsletter_subscriber', $fields, $condition, $order_by, $limit, $debug);
    }
    
    
    public function insertNewsletter($insert_data, $debug = 0) {
        return $this->insertRow("tbl_newsletter_subscriber", $insert_data, $debug);
    }

    public function deleteNewsletter($condition = '', $debug = 0) {
        $this->deleteRow("tbl_newsletter_subscriber", $condition, $debug);
    }

    public function updateNewsletter($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_newsletter_subscriber", $update_data, $condition, $debug);
    }
}

?>