<?php
if (!isset($_SESSION)) {
session_start();
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$_SESSION['tabtransfert1']=$_GET['tabtransfert1'];
$_SESSION['tabtransfertid_fact']=$_GET['id_fact'];
/* var_dump($_SESSION['tabtransfertid_fact']); */
$_SESSION['transfertnbrcouvert']=$_GET['nbrcouvert'];
/* $json['test']=$_SESSION['tabtransfertid_fact'];
echo json_encode($json); */