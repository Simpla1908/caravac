<?php
include '../../bdd/connexion.php';
include '../traitement/fonctionalites.php';
include '../../FUNCTION/hebergement.php';
$idpackcomp=$_GET['idpackcomp'];
$souscrip=$_GET['souscrip'];
if($_GET['test']==1) {
    $dateecheance=$_GET['dateecheance'];
    activationPack($idpackcomp,1,$souscrip,$dateecheance,$bdd);
}else if($_GET['test']==0){
    activationPack($idpackcomp,0,$souscrip,'',$bdd);
}

