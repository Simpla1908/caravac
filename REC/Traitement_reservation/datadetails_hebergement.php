<?php
if (!isset($_SESSION)) {
    session_start();
}
require '../bdd/connexion.php';
require '../FUNCTION/hebergement.php';
include_once './Amelioration/reglage/recuperer_valeurs_reglages.php'; 
$id_res=0;
$id_client=0;
if (isset($_GET['id_res'])) {
    $id_res=$_GET['id_res'];
    $requete = $bdd->prepare
    ("SELECT *, a.type
    FROM t_reservation AS a, t_client AS b, t_responsable AS c
    WHERE  a.id_client=b.id_client
    AND b.id_respo=c.id_respo
    AND a.id_hotel=:id_hotel
    AND a.id_res=:id_res");
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $id_client = $r->id_client;
        $nom_client= $r->nom_client;
        $adresse = $r->adresse_provenance_client;
        $provenance = $r->provenance_client;
        $phone = $r->telephone_client;
        $email = $r->email_client;
        $type_cl = $r->type_cl;
        $responsable = $r->entreprise;
        $id_res = $r->id_res;
        $num_reserv= $r->num_reserv;
        $type_res= $r->type;
        $etat_res= $r->etat;
        $date_res= $r->dte;
        $date_arrive= $r->dte_a;
        $date_sortie= $r->dte_s;
        $mont_nuite=$r->mont_nuite;
        $mont_total_res=$r->mont_total_res;
        $mode_paiement= $r->etat_credit;
    }
    $montant_paye = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar, $mont_nuite);
    $montant_total = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar, $mont_total_res);
    $_SESSION['date_arrive']=$date_arrive;
    $_SESSION['date_sortie']=$date_sortie;
    $_SESSION['id_client']=$id_client;
    
} 

?>
