<?php
// Initialisation de la session
session_start();
$json = array();
$modif=false;
$idcpt = $_GET['idcpt'];
if (!in_array($idcpt, $_SESSION['Modif2Clic']['idcpt'])) {
$_SESSION['Modif2Clic'] = array();
$_SESSION['Modif2Clic']['idcpt'] = array();
$_SESSION['Modif2Clic']['compteur'] = array();   
array_push($_SESSION['Modif2Clic']['idcpt'], $idcpt);
$_SESSION['Modif2Clic']['compteur'][$idcpt]=0;
}else{
$_SESSION['Modif2Clic']['compteur'][$idcpt]=$_SESSION['Modif2Clic']['compteur'][$idcpt]+1;
}
if($_SESSION['Modif2Clic']['compteur'][$idcpt]>0){   
$modif=true;
}
$json['modif'] = $modif;
echo json_encode($json);
