<?php
/******************API Code For CRM*****************/
    		
    		$url='https://www.researchandtrends.com/ABMi-miniCRM/apii.php';
            $ch = curl_init($url);
            
    		$fname="Amrita Prasad";
            $email="amrita.prasad@gmail.com";
            //$msg=$message;
            
            $data = array(
              "fname" => $fname,
              "email" => $email
              
            );
        
            $dataEncoded = json_encode($data);
            
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.2; en-US; rv:1.8.1.7) Gecko/20070914 Firefox/2.0.0.7');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataEncoded);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Access-Control-Allow-Origin: *'));
            $result = curl_exec($ch);
    		/******************End API Code For CRM*****************/
?>