<?php
require 'connection.php';
require 'panier.php';
$panier = new Panier();
$hebergement=$_SESSION['hebergement'];
if (isset($_POST['multi'])) {
	$NBR = count($_POST['multi']);
	for ($i = 0; $i <$NBR; $i++) {
		$id = $_POST['multi'][$i];
		$req = $bd -> prepare("SELECT * FROM t_chambre WHERE id_ch='$id'");
		$req -> execute();
		$chambre = $req -> fetchAll(PDO::FETCH_OBJ);
		if (empty($chambre)) {
			echo "chambre n'existe pas";
		}
		$panier -> add($chambre[0] -> id_ch);
	}
	header("Location:../rec_reservation_client_chambre_paiement.php?hebergement=$hebergement#panier_ch");
	}

?>