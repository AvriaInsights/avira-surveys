<?php
error_reporting(E_ALL);
ini_set("display_errors", true);
ini_set('max_execution_time', 9000);
ini_set('memory_limit', '2048M');
ini_set('max_user_connections', 500);
ini_set('max_connections', 1000);
@ob_start();
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_DATABASE', 'rechtgma_leads');
    define('SITETITLE', 'Researchandtrends');
    define('SITEPATH', 'http://www.localhost/atr/');
    define('SITEADMIN', 'http://www.localhost/atr/admin/');
    define('SITEEMAIL', 'info@alltheresearch.com');
    date_default_timezone_set("Asia/Kolkata");
    define('LISTPERPAGE', 20);
}


else {
    define('DB_SERVER', '127.0.0.1');
    define('DB_USERNAME', 'rechtgma_leads');
    define('DB_PASSWORD', '(kEGYWelJ4i2');
    define('DB_DATABASE', 'rechtgma_leads');
    define('SITETITLE', 'Researchandtrends');
    define('SITEPATH', 'https://www.researchandtrends.com/');
    define('SITEADMIN','https://www.researchandtrends.com/admin/');
    define('SITEEMAIL', 'contactus@alltheresearch.com');
    date_default_timezone_set("Asia/Kolkata");
    define('LISTPERPAGE', 20);
}

define("PATH_CLASSES", dirname(__FILE__) . "/");
define('PATH_WEBSITE', str_replace(substr("admin/classes/", 0, -1), "", dirname(__FILE__)));
define('PATH_ADMIN', str_replace(substr("classes/", 0, -1), "", dirname(__FILE__)));

// MailChimp Credentials

define('MC_APIKEY', '184e5524caa7a1438d90c06e8c6a404a-us20');
define('MC_LISTID', 'f3026592e3');

// RazorPay Credentials
$sandbox = TRUE;

if ($sandbox) {
    define('RAZORPARY_KEY_ID', 'rzp_test_H0DHEjabGMVW10');
    define('RAZORPARY_KEY_SECRET', 'PWcgOA72CwLOJRL1J2cJl3bw');
} else {
    define('RAZORPARY_KEY_ID', 'rzp_live_d9qHc9eRcXZxma');
    define('RAZORPARY_KEY_SECRET', 'iGzoYBZCL3aoIrj3DIwN1g6m');
}

clearstatcache();

abstract class Connection {

    private $conn;
    public $row, $result;

    public function __construct() {
        // Create connection
        $this->conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function __destruct() {
        $this->conn->close();
    }

    public function getConnectionObj() {
        return $this->conn;
    }

    public function sqlQuery($sql, $debug = 0) {
        if ($debug == 1) {
            echo $sql;
            die;
        }

        return $this->result = $this->conn->query($sql);
    }

    public function getRow() {
        if ($this->row = $this->result->fetch_assoc()) {
            return $this->row;
        }
        return false;
    }

    public function getRecords($table, $fields_string = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        if ($fields_string == '') {
            $fields_string = '*';
        }
        $sql = "";
        $sql .= "select " . $fields_string . " from " . $table;

        if ($condition != "") {
            $sql .= " where " . $condition;
        }

        if ($order_by != "") {
            $sql .= " order by " . $order_by;
        }

        if ($limit != "") {
            $sql .= " limit " . $limit;
        }
         //print_r($sql);
         //echo $sql;
        $result_array = array();
        $this->result = $this->sqlQuery($sql, $debug);

        while ($row = $this->getRow()) {
            $result_array[] = $row;
        }

        if ($debug == 2) {
            echo "<pre>";
            print_r($result_array);
            echo "</pre>";
            die;
        }

        return $result_array;
    }

     public function getRecordsByBindParam($table, $fields_string = '', $condition = '',$parameters_array, $order_by = '', $limit = '', $debug = 0) {
        if ($fields_string == '') {
            $fields_string = '*';
        }
        $sql = "";
        //$status='Active';
        $sql .= "select " . $fields_string . " from " . $table;

        if ($condition != "") {
            $sql .= " where " . $condition;
        }

        if ($order_by != "") {
            $sql .= " order by " . $order_by;
        }

        if ($limit != "") {
            $sql .= " limit " . $limit;
        }
        $stmt = $this->conn->prepare($sql);
        $count=count($parameters_array); 
        //print_r($count);
        //print_r($sql);
        //print_r(array_values($parameters_array));
        if($count==1)  
        {
            //print_r(array_values($parameters_array));
            $stmt->bind_param('s',array_values($parameters_array)[0]);
        }  
        else if($count==2)
        {
            //print_r(array_values($parameters_array));
            $stmt->bind_param('ss', array_values($parameters_array)[0],array_values($parameters_array)[1]);
        }
        else if($count==3)
        {
            //print_r(array_values($parameters_array));
            $stmt->bind_param('sss', array_values($parameters_array)[0],array_values($parameters_array)[1],array_values($parameters_array)[2]);
        }
        else if($count==4)
        {
            $stmt->bind_param('ssss', array_values($parameters_array)[0],array_values($parameters_array)[1],array_values($parameters_array)[2],array_values($parameters_array)[3]);
        }
        else if($count==5)
        {
            $stmt->bind_param('sssss', array_values($parameters_array)[0],array_values($parameters_array)[1],array_values($parameters_array)[2],array_values($parameters_array)[3],array_values($parameters_array)[4]);
        }
        else if($count==6)
        {
            $stmt->bind_param('ssssss', array_values($parameters_array)[0],array_values($parameters_array)[1],array_values($parameters_array)[2],array_values($parameters_array)[3],array_values($parameters_array)[4],array_values($parameters_array)[5]);
        }
        else if($count==7)
        {
            $stmt->bind_param('sssssss', array_values($parameters_array)[0],array_values($parameters_array)[1],array_values($parameters_array)[2],array_values($parameters_array)[3],array_values($parameters_array)[4],array_values($parameters_array)[5],array_values($parameters_array)[6]);
        }
        else
        {
           
        }
        //$status='Active';
        $result_array = array();
        $stmt->execute();
     
        $this->result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        //print_r($this->result);
        // while ($row = $this->getRow()) {
        //     $result_array[] = $row;
        // }

        if ($debug == 2) {
            echo "<pre>";
            print_r($result_array);
            echo "</pre>";
            die;
        }

        //$stmt->close();
        return $this->result;
    }

    public function getFullRecords($table, $fields_string = '', $condition = '', $group_by = '', $order_by = '', $limit = '', $debug = 0) {
        if ($fields_string == '') {
            $fields_string = '*';
        }
        $sql = "";
        $sql .= "select " . $fields_string . " from " . $table;

        if ($condition != "") {
            $sql .= " where " . $condition;
        }

        if ($group_by != "") {
            $sql .= " group by " . $group_by;
        }

        if ($order_by != "") {
            $sql .= " order by " . $order_by;
        }

        if ($limit != "") {
            $sql .= " limit " . $limit;
        }
        
        $result_array = array();
        $this->result = $this->sqlQuery($sql, $debug);

        while ($row = $this->getRow()) {
            $result_array[] = $row;
        }

        if ($debug == 2) {
            echo "<pre>";
            print_r($result_array);
            echo "</pre>";
            die;
        }

        return $result_array;
    }

    public function getSingleRecord($table, $fields_string = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        if ($fields_string == '') {
            $fields_string = '*';
        }
        $sql = "";
        $sql .= "select " . $fields_string . " from " . $table;

        if ($condition != "") {
            $sql .= " where " . $condition;
        }

        if ($order_by != "") {
            $sql .= " order by " . $order_by;
        }

        if ($limit != "") {
            $sql .= " limit " . $limit;
        }
        $result_array = array();
        $this->result = $this->sqlQuery($sql, $debug);

        while ($row = $this->getRow()) {
            $result_array[] = $row;
        }

        $result_array = end($result_array);

        if ($debug == 2) {
            echo "<pre>";
            print_r($result_array);
            echo "</pre>";
            die;
        }

        return $result_array;
    }

    public function insertRow($table, $insert_data, $debug) {
        $value_string = '';
        $field_string = '';
        $sql = '';
        if (count($insert_data) > 0) {
            foreach ($insert_data as $field => $value) {
                if ($field_string == "") {
                    $field_string .= "`" . $field . "`";
                } else {
                    $field_string .= ",`" . $field . "`";
                }

                if ($value_string == "") {
                    $value_string .= "'" . $value . "'";
                } else {
                    $value_string .= ",'" . $value . "'";
                }
            }

            $sql .= "insert into " . $table . " (" . $field_string . ") values(" . $value_string . ")";

            $this->sqlQuery($sql, $debug) or die(mysqli_error($this->conn));
            return $this->lastInsertId();
        }
    }

    public function lastInsertId() {
        return mysqli_insert_id($this->conn);
    }

    public function updateRow($table, $update_data, $condition = '', $debug = 0) {
        $set_string = '';
        $sql = '';
        if (count($update_data) > 0) {
            foreach ($update_data as $key => $value) {
                if ($set_string == '') {
                    $set_string .= "`" . $key . "`='" . $value . "'";
                } else {
                    $set_string .= ",`" . $key . "`='" . $value . "'";
                }
            }

            $sql .= "update " . $table . " set " . $set_string;

            if ($condition != "") {
                $sql .= " where " . $condition;
            }

            $this->sqlQuery($sql, $debug) or die(mysqli_error($this->conn));
            return 1;
        } else {
            return 0;
        }
    }

    public function deleteRow($table, $condition = '', $debug = 0) {
        $sql = '';
        $sql .= "delete from " . $table;

        if ($condition != "") {
            $sql .= " where " . $condition;
        }

        return $this->sqlQuery($sql, $debug) or die(mysqli_error($this->conn));
    }

    public function getCode() {
        $char = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 16);
        $str = rand(2, 9) . $char . rand(2, 9);
        return $str;
    }

    public function isEmpty($string) {
        if ($string != '' && trim($string) != "" && strlen($string) != 0) {
            return true;
        } else {
            return false;
        }
    }

    public function isNumeric($string) {
        if (is_numeric($string)) {
            return true;
        } else {
            return false;
        }
    }

    public function isValidEmail($string) {
        if (!filter_var($string, FILTER_VALIDATE_EMAIL) === false) {
            return true;
        } else {
            return false;
        }
    }

    function checkURL($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($code == 200) {
            $status = true;
        } else {
            $status = false;
        }
        curl_close($ch);
        return $status;
    }

    function removeSpace($string) {
        $string = str_replace(' ', '-', $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        $string = strtolower($string);

        return preg_replace('/-+/', '-', $string);
    }

    function sanitizeOutput($to_clean) {
        if (is_array($to_clean)) {
            $cleaned = array();
            foreach ($to_clean as $key => $value) {
                if (is_array($value)) {
                    $cleaned[$key] = sanitizeOutput($value);
                } else {
                    $cleaned[$key] = nl2br(htmlentities(stripslashes($value), ENT_QUOTES, 'UTF-8'));
                }
            }
        } else {
            $cleaned = nl2br(htmlentities(stripslashes($to_clean), ENT_QUOTES, 'UTF-8'));
        }
        return $cleaned;
    }
    
    function cleanOutput($to_clean) {
        $cleaned = trim($to_clean);
        return $cleaned;
    }

    function getAcronym($string) {
        $words = explode(" ", $string);
        $letters = "";
        foreach ($words as $value) {
            $letters .= substr($value, 0, 1);
        }
        return $letters;
    }

    function generateSKU($report_id, $category) {
        $report_id = str_pad($report_id, 4, '0', STR_PAD_LEFT);
        $sku = "BIR-" . $category . "-" . $report_id;
        return $sku;
    }

    // Function to convert NTP string to an array
    function NVPToArray($NVPString) {
        $proArray = array();
        while (strlen($NVPString)) {
            // name
            $keypos = strpos($NVPString, '=');
            $keyval = substr($NVPString, 0, $keypos);
            // value
            $valuepos = strpos($NVPString, '&') ? strpos($NVPString, '&') : strlen($NVPString);
            $valval = substr($NVPString, $keypos + 1, $valuepos - $keypos - 1);
            // decoding the respose
            $proArray[$keyval] = urldecode($valval);
            $NVPString = substr($NVPString, $valuepos + 1, strlen($NVPString));
        }
        return $proArray;
    }

    public function timesAgo($pdate) {
        $ptime = strtotime($pdate);
        $etime = time() - $ptime;
        if ($etime < 1) {
            return '0 seconds';
        }

        $a = array(365 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
        );
        $a_plural = array('year' => 'years',
            'month' => 'months',
            'day' => 'days',
            'hour' => 'hours',
            'minute' => 'minutes',
            'second' => 'seconds'
        );

        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
            }
        }
    }

    function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;
    }

    //resize and crop image by center
    function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80) {
        $imgsize = getimagesize($source_file);
        $width = $imgsize[0];
        $height = $imgsize[1];
        $mime = $imgsize['mime'];

        switch ($mime) {
            case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image = "imagegif";
                break;

            case 'image/png':
                $image_create = "imagecreatefrompng";
                $image = "imagepng";
                $quality = 7;
                break;

            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image = "imagejpeg";
                $quality = 80;
                break;

            default:
                return false;
                break;
        }

        $dst_img = imagecreatetruecolor($max_width, $max_height);
        $src_img = $image_create($source_file);

        $width_new = $height * $max_width / $max_height;
        $height_new = $width * $max_height / $max_width;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if ($width_new > $width) {
            //cut point by height
            $h_point = (($height - $height_new) / 2);
            //copy image
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
        } else {
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
        }

        $image($dst_img, $dst_dir, $quality);

        if ($dst_img)
            imagedestroy($dst_img);
        if ($src_img)
            imagedestroy($src_img);
    }

}

?>