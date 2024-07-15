<?php

require_once("cls-connection.php");

class Surveyclient extends Connection {

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

    public function deleteRequest($condition = '', $debug = 0) {
        $this->deleteRow("tbl_request", $condition, $debug);
    }

    public function updateRequest($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_request", $update_data, $condition, $debug);
    }
    
    /******************/
    
    public function getSurveyUserDetail($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_client_user', $fields, $condition, $order_by, $limit, $debug);
    }
   
   
   /*******************/
    
    
    public function updateSurveyuser($update_data, $condition = '', $debug = 0) {
        return $this->updateRow("tbl_client_user", $update_data, $condition, $debug);
    }
    
    public function updateSurveyuseractive($update_data_active, $condition_active = '', $debug = 0) {
        return $this->updateRow("tbl_client_user", $update_data_active, $condition_active, $debug);
    }
    

    public function getUserDetails($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_client_user', $fields, $condition, $order_by, $limit, $debug);
    }
    
  
}

?>