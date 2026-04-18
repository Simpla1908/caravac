<?php

// Initialisation de la session
include('../bdd/connexion.php');
session_start();
$ingred_id = $_POST['ingred_id'];
$requete = $bdd->prepare("SELECT unite FROM  stk_produit AS p"
    . " WHERE p.hotel_id=:hotel_id AND p.idprod=:idprod");
//session à enlever
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':idprod', $ingred_id);
$requete->execute();
$unite = $requete->fetchAll(PDO::FETCH_OBJ);
echo '<option>  </option>';
foreach ($unite  as $u) :
    echo '<option value=' . $u->unite . ' selected>' . ucfirst($u->unite) . '</option>';
endforeach;
