<?php
require_once("./classes/cls-admin.php");
$obj_admin = new Admin();
$conn = $obj_admin->getConnectionObj();
    // recieved data 
    // create curl resource 
    
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    
    $array = json_decode(file_get_contents("php://input"), true);
    
    //     $ch = curl_init(); 

    //     // set url
    //   //  curl_setopt($ch, CURLOPT_URL, $url); 

    //     //return the transfer as a string 
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    //     // $output contains the output string 
    //     $output = curl_exec($ch);
        
    //     //$array = json_decode($output, true);
           
        print_r($array);
        
    $insert_data['CompanyName'] = mysqli_real_escape_string($conn, $array['CompanyName']);
    $insert_data['FullName'] = mysqli_real_escape_string($conn, $array['FullName']);
    $insert_data['Email'] = mysqli_real_escape_string($conn, $array['Email']);
    $insert_data['Source'] = mysqli_real_escape_string($conn, trim($array['Source']));
    $insert_data['GoodDesignation'] = mysqli_real_escape_string($conn, trim($array['GoodDesignation']));
    $insert_data['PhoneNo'] = mysqli_real_escape_string($conn, trim($array['PhoneNo']));
    $insert_data['JobTitle'] = mysqli_real_escape_string($conn, trim($array['JobTitle']));
    
    $obj_admin->insertApi($insert_data, 0);
        
    

?>