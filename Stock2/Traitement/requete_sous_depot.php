<?php

// Initialisation de la session
include('../bdd/connexion.php');
session_start();
$depot1_id= $_POST['depot1_id'];
$requete = $bdd->prepare("SELECT a.id_depot,a.libelle FROM t_depot AS a
                    WHERE a.hotel_id=:id_hotel AND a.id_depot<>:id_depot ORDER BY libelle");
//session à enlever
$requete->BindParam(':id_hotel',$_SESSION['id_hotel']);
$requete->BindParam(':id_depot',$depot1_id);
$requete->execute();
$s_depot = $requete-> fetchAll(PDO::FETCH_OBJ);
echo '<option>  </option>';
foreach ($s_depot  as $d):
echo '<option value=' . $d->id_depot.'>' . $d->libelle.'</option>';
endforeach;