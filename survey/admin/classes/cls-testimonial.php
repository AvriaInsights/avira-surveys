<?php

require_once("cls-connection.php");

class Testimonial extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleTestimonialDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_testimonial', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getTestimonialDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_testimonial', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getFullTestimonialDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_testimonial` LEFT JOIN `tbl_report` ON `tbl_testimonial`.`report_id` = `tbl_report`.`report_id`', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertTestimonial($insert_data, $debug = 0) {
        return $this->insertRow("tbl_testimonial", $insert_data, $debug);
    }

    public function deleteTestimonial($condition = '', $debug = 0) {
        $this->deleteRow("tbl_testimonial", $condition, $debug);
    }

    public function updateTestimonial($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_testimonial", $update_data, $condition, $debug);
    }

}

?>