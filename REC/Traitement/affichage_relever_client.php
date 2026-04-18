<?php
/**
 * Created by PhpStorm.
 * User: cardprinter
 * Date: 10/01/2017
 * Time: 16:29
 */

// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
include('../bdd/connexion.php');
$requete = $bdd->prepare("SELECT r.tva,r.remise,c.code, c.designation, b.qte AS qte, b.prix AS pu,b.dte_h,b.monnaie
                        FROM t_reservation AS a, lignes_commandes AS b, stk_produit AS c,t_reservation r
                        WHERE b.produit_id = c.idprod AND a.id_res=b.commande_id
                        AND b.hotel_id =:id_hotel AND a.id_client = :client_id AND a.chambr_id=:chambr_id
                        AND r.id_res=b.commande_id
                        AND r.type='commande'
                        GROUP BY b.produit_id");
$requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete->BindParam(':client_id', $client_id);
$requete->BindParam(':chambr_id',$idch);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);