<?php 
require_once("classes/cls-survey.php");

$obj_survey = new Survey();

$conn = $obj_survey->getConnectionObj();

if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            
            $sub_no = 1;
            
            
            while(($line = fgetcsv($csvFile)) !== FALSE){
                
                // Get row data
                $userid=$_SESSION['ifg_admin']['client_id'];
                $email   = $line[0];
                $company = $line[1];
                $industry = $line[2];
                
                /**********Check contact already exist***************/
                $fields_contact = "contact_id";
                $condition_contact = "`tbl_client_contacts`.`email` ='".$email."' and `tbl_client_contacts`.`company` ='".$company."' and `tbl_client_contacts`.`industry` ='".$industry."' and `tbl_client_contacts`.`user_id` ='".$userid."'";
                $all_contacts=$obj_survey->getImportContacts($fields_contact, $condition_contact, '', '', 0);
                
                if(count($all_contacts)==0)
                {
                    $insert_dataa['user_id'] = mysqli_real_escape_string($conn, $userid);
                    $insert_dataa['email'] = mysqli_real_escape_string($conn, $email);
                    $insert_dataa['company'] = mysqli_real_escape_string($conn, $company);
                    $insert_dataa['industry'] = mysqli_real_escape_string($conn, $industry);
                    $insert_dataa['status'] = "Active";
                    $insert_dataa['created_at'] = date("Y-m-d H:i:s");
                    $insert_dataa['updated_at'] = date("Y-m-d H:i:s");
                    $obj_survey->insertImportContacts($insert_dataa, 0);
                }
                        
             $sub_no++;       
                           
            }
            
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
            //echo "<script> alert('Record does not Added succesfully....'); </script>";
            $msg="<strong>Congratulations</strong> Contacts has been added successfully";
            header("Location: import-contacts.php?msg=".$msg);
        }else{
           // $qstring = '?status=err';
           $msg="Error";
           header("Location: import-contacts.php?msg=".$msg);
        }
    }else{
        $qstring = '?status=invalid_file';
        $msg="Invalid File";
        header("Location: import-contacts.php?msg=".$msg);
    }
}

// Redirect to the listing page

header("Location: import-contacts.php?msg=".$msg);

?>