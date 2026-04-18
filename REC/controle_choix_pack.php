<?php
session_start();
$json = array();
$id_pack=$_GET['id_pack'];
$message ='existepas';
if (in_array($id_pack,$_SESSION['pack_site']['id_pack'])) {
    $message = 'existe';            
}
$json['message'] =$message;
echo json_encode($json);
