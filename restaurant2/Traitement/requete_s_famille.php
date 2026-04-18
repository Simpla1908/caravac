<?php

// Initialisation de la session
include('../bdd/connexion.php');
session_start();
$famille_id= $_POST['idfamille'];
$requete = $bdd->prepare("SELECT * FROM  stk_sous_famille AS f"
                          . " WHERE f.hotel_id=:hotel_id AND f.famille=:famille_id AND pseudo_supp=0 ORDER BY des");
$requete->BindParam(':hotel_id',$_SESSION['id_hotel']);
$requete->BindParam(':famille_id',$famille_id);
$requete->execute();
$s_familles = $requete-> fetchAll(PDO::FETCH_OBJ);
foreach ($s_familles  as $f):
echo '<option value=' . $f->id_s_fam.'>' . $f->des.'</option>';
endforeach;