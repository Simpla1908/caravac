<?php
if (!isset($_SESSION)) {
session_start();
}
$idp=$_GET['idp'];
$pq=$_GET['pq'];
$idlgcmd=$_GET['idlgcmd'];
 if (!in_array($idlgcmd, $_SESSION['ProduitsSelectiones']['id_produit'])) {
 array_push($_SESSION['ProduitsSelectiones']['id_produit'],$idlgcmd);
  $_SESSION['ProduitsSelectiones']['qte_modif'][$idlgcmd]=$pq;

 }
var_dump($_SESSION['ProduitsSelectiones']);