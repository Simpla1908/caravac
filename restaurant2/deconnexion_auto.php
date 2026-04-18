<?php
session_start();
$json = array();
$json['bool']= FALSE;
    $limiteInatif=1800;
    
    if(time()- $_SESSION['lastload'] > $limiteInatif){
        $json['bool']= TRUE;
    }  else {
//        $_SESSION['lastload'] = time();
    
}
    
    echo json_encode($json);
?>
