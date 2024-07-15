<?php 
    // for($k=1;$k<=5;$k++)
    // {
    //     $allrating.=$k.",";
    // }
    // echo $rating = trim($allrating,",");
    
    $skipid="7";
    $skipval="2";
    $subtitle="1,2,3,4,5";
    $skip_question="0,0,0,0,0";
    
    $valarray=explode(",",$subtitle);
    $skipvalarray=explode(",",$skip_question);
    $skippostition = array_search($skipval,$valarray);
    $skipvalarray[$skippostition]=$skipid;
    
    print_r($valarray);
    print_r($skipvalarray);
    implode(",",$skipvalarray);
    
    for($k=1;$k<=5;$k++)
    {
        $allrating.= $k.",";
        $allskipval.="0".",";
    }
    echo $rating12 = trim($allrating,",");
    echo "/n".$skipval12=trim($allskipval,",");
?>