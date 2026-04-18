<?php
include '../bdd/connexion.php';
include '../FUNCTION/hebergement.php';
$default_pack = $_POST['default_pack'];
$pack =$_POST['pack'];
$verif=ComparePacks($default_pack,$pack,$bdd);
echo $verif;
