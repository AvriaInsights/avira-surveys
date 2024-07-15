<?php

require_once("cls-connection.php");

class Analyst extends Connection {

    public function __construct() {
        parent::__construct();
    }

     // build with analyst data insert
    
    public function insertBuildAnalyst($insert_data, $debug = 0) {
        return $this->insertRow("tbl_buildAnalyst", $insert_data, $debug);
    }
    
     public function getSurveyCategory($fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        return $this->getRecords('tbl_category', $fields, $condition, $order_by, $limit, $debug);
    }

}

?>