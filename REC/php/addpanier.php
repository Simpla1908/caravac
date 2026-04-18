<?php
require 'connection.php';
require 'panier.php';
$panier = new Panier();
$json=array('error'=>true);
if (isset($_GET['id'])) {
	$json['error']="false";
	$id=$_GET['id'];
	$req = $bd -> prepare("SELECT * FROM t_chambre WHERE id_ch='$id'");
	$req -> execute();
	$chambre = $req -> fetchAll(PDO::FETCH_OBJ);
	if(empty($chambre)){
		$json['message']="chambre n'existe pas";
	}
	$panier->add($chambre[0]->id_ch);
	$json['message']="la chambre est bien ajouté au panier";
} else {
	$json['message']="vous n'avais rien selection!";
}
echo json_encode($json);

?>