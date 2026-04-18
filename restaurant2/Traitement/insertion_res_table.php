<?php
session_start();
include '../bdd/connexion.php';

    $date_res=$_POST['dateres'];
    $statut="reserve";
    $table_id=$_POST['table_id'];
    $client_nom=$_POST['nomclient'];
    $telclient=$_POST['telclient'];
    $emailclient=$_POST['emailclient'];

    
    /* Conversion $date_res */
    $transpostion_date1 = explode(' ', $date_res);
    $date = $transpostion_date1[0];
    $heure = $transpostion_date1[1];
    /* Conversion date2 */
    $transpostion_date2 = explode('/', $date);
    $jour = $transpostion_date2[0];
    $mois = $transpostion_date2[1];
    $annee = $transpostion_date2[2];
    $date_bd = $annee . '-' . $mois . '-' . $jour;
    $date_hr_bd = $annee . '-' . $mois . '-' . $jour.' '.$heure.':00';

// Insertion dans reservation_table
$requete = $bdd->prepare("INSERT INTO reservation_table (date_res_tbl,date_hr_res_tbl,client_nom,telclient ,emailclient,table_id,hotel_id)
                        VALUES(:date_res_tbl,:date_hr_res_tbl,:client_nom,:telclient,:emailclient,:table_id,:hotel_id)");

$requete->BindParam(':date_res_tbl', $date_bd);
$requete->BindParam(':date_hr_res_tbl', $date_hr_bd);
$requete->BindParam(':client_nom', $client_nom);
$requete->BindParam(':telclient', $telclient);
$requete->BindParam(':emailclient', $emailclient);
$requete->BindParam(':table_id', $table_id);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();

//Update du num_com
$requete = $bdd->prepare("UPDATE  t_client  SET statut =:statut WHERE id_client=:id_client");
$requete->BindParam(':statut', $statut);
$requete->BindParam(':id_client', $table_id);
$requete->execute();

echo 'ok';
