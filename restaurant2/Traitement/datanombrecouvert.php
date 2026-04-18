<?php

// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
$json = array();
$json['nbrcouvert']=$_SESSION['nbrcouvert'];
echo json_encode($json);
?>
