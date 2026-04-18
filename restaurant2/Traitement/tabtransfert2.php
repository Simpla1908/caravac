<?php
if (!isset($_SESSION)) {
session_start();
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$_SESSION['tabtransfert2']=$_GET['tabtransfert2'];
$_SESSION['tabtransfert2designat']=$_GET['tabtransfert1des'];
$json['test'] = $_SESSION['tabtransfert2'];
$json['succes'] = true;

echo json_encode($json);