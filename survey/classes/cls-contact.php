<?php 
require_once("survey/classes/cls-connection.php");
class Contact extends Connection {

    public function __construct() {
        parent::__construct();
    }
    
    public function insertContact($insert_data, $debug = 0) {
        return $this->insertRow("tbl_contact", $insert_data, $debug);
    }
}
?>