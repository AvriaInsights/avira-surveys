<?php
if(isset($_POST['description']))
{
           /*header("Content-type: application/vnd.ms-word");  
           header("Content-Disposition: attachment;Filename=".rand().".doc");  
           header("Pragma: no-cache");  
           header("Expires: 0");  
           echo $_POST["description"]; */ 
           
            $myfile = fopen("images/newfile.doc", "w") or die("Unable to open file!");
            $txt = $_POST["description"];
            fwrite($myfile, $txt);
            fclose($myfile);
            
            move_uploaded_file($myfile, "images/".$myfile);
}
?>