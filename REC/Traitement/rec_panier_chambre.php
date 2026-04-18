<?php 
include 'php/connection.php';
include '../bdd/connexion.php';
include 'php/panier.php';
$panier=new Panier();
?>

<?php

$requete_chambre = $bdd->prepare("SELECT * FROM t_chambre AS ch
                                WHERE id_ch NOT IN (SELECT c.id_ch
                                FROM t_reservation AS a, t_reserve_chambre AS b, t_chambre AS c
                                WHERE b.idreserv = a.id_res
                                AND b.idchambre = c.id_ch
                                AND b.statut !='libre'
                                AND a.dte_a >=:dte_a
                                AND a.dte_s <=:dte_s
                                AND c.id_hotel=:id_hotel)AND ch.id_hotel=:id_hotel");

$requete_chambre->BindParam(':dte_a', $_SESSION['date_a']);
$requete_chambre->BindParam(':dte_s', $_SESSION['date_s']);
$requete_chambre->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete_chambre->execute();

$chambres = $requete_chambre->fetchAll(PDO::FETCH_OBJ);
?>
