<?php

require_once("cls-connection.php");

class Request extends Connection {

    public function __construct() {
        parent::__construct();
    }

    public function getSingleRequestDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getSingleRecord('tbl_request', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getRequestDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_request', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getFullRequestDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_request` LEFT JOIN `tbl_report` ON `tbl_request`.`report_id` = `tbl_report`.`report_id`', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertRequest($insert_data, $debug = 0) {
        return $this->insertRow("tbl_request", $insert_data, $debug);
    }

    public function deleteRequest($condition = '', $debug = 0) {
        $this->deleteRow("tbl_request", $condition, $debug);
    }

    public function updateRequest($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_request", $update_data, $condition, $debug);
    }
    
    public function insertEnquiry($insert_data, $debug = 0) {
        return $this->insertRow("tbl_enquiry", $insert_data, $debug);
    }
    
     public function insertContact($insert_data, $debug = 0) {
        return $this->insertRow("tbl_contact", $insert_data, $debug);
    }
    
    public function insertResellerEnquiry($insert_data, $debug = 0) {
        return $this->insertRow("tbl_reseller", $insert_data, $debug);
    }
    
    public function insertPressEnquiry($insert_data, $debug = 0) {
        return $this->insertRow("tbl_press_enquiry", $insert_data, $debug);
    }
    
    public function getFullPressDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_press_enquiry` LEFT JOIN `tbl_press` ON `tbl_press_enquiry`.`press_id` = `tbl_press`.`press_id`', $fields, $condition, $order_by, $limit, $debug);
    }
    
     public function insertBlogEnquiry($insert_data, $debug = 0) {
        return $this->insertRow("tbl_blog_enquiry", $insert_data, $debug);
    }
    
    public function getFullBlogDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_blog_enquiry` LEFT JOIN `tbl_blog` ON `tbl_blog_enquiry`.`blog_id` = `tbl_blog`.`blog_id`', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function insertReportEnquiry($insert_data, $debug = 0) {
        return $this->insertRow("tbl_enquiry", $insert_data, $debug);
    }
    
    public function getFullReportDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_enquiry` LEFT JOIN `tbl_report` ON `tbl_enquiry`.`report_id` = `tbl_report`.`report_id`', $fields, $condition, $order_by, $limit, $debug);
    }

    public function insertServiceEnquiry($insert_data, $debug = 0) {
        return $this->insertRow("tbl_services_enquiry", $insert_data, $debug);
    }
    
    public function getFullServiceDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_services_enquiry', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function insertHelpEnquiry($insert_data, $debug = 0) {
        return $this->insertRow("tbl_analyst_user", $insert_data, $debug);
    }
    
    public function getHelpDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_analyst_user', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getLeadsDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_admin', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function updateLeadsRequest($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_request", $update_data, $condition, $debug);
    }
    
    public function updateAdminRequest($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_admin", $update_data, $condition, $debug);
    }
    
    public function getFullRequestLeadsDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_request` LEFT JOIN `tbl_admin` ON `tbl_request`.`assigned_leads` = `tbl_admin`.`admin_id`', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getRequestCategoryDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_category', $fields, $condition, $order_by, $limit, $debug);
    }

    public function getRequestClusterDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_cluster_head', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getCompany($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_company', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getDesignation($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_designation', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function getRelevanceMapping($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_relevance_mapping', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function insertComment($insert_data, $debug = 0) {
        return $this->insertRow("tbl_comment", $insert_data, $debug);
    }
    
    public function getCommentDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_comment', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function insertCompany($insert_data, $debug = 0) {
        return $this->insertRow("tbl_company", $insert_data, $debug);
    }
    
    public function insertDesignation($insert_data, $debug = 0) {
        return $this->insertRow("tbl_designation", $insert_data, $debug);
    }
    
    public function insertLeadsTask($insert_data, $debug = 0) {
        return $this->insertRow("tbl_task", $insert_data, $debug);
    }
    
    public function getTask($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_task', $fields, $condition, $order_by, $limit, $debug);
    }
    
    public function updateTask($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_task", $update_data, $condition, $debug);
    }
   
    public function deleteTask($condition = '', $debug = 0) {
        $this->deleteRow("tbl_task", $condition, $debug);
    }
 
    public function getFullTaskDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('`tbl_task` INNER JOIN `tbl_admin` ON `tbl_task`.`task_assigned_to` = `tbl_admin`.`admin_id` INNER JOIN `tbl_request` ON `tbl_task`.`request_id` = `tbl_request`.`request_id`', $fields, $condition, $order_by, $limit, $debug);
    }
}

?>