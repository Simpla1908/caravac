<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../bdd/connexion.php';
include '../../FUNCTION/hebergement.php';
include '../../FUNCTION/stock.php';
include '../../FUNCTION/restaurant.php';
include './Panier.php';
$id_cmd = $_GET['id_cmd'];
$statut = 'annule';
$nbArticles = count($_SESSION['panier']['id_article']);
$json = array();
$json['succes'] = False;
$json['bc'] = false;
$json['bar'] = false;
$cuisine = 0;
$bar = 0;
if ($nbArticles > 0) {
    if ($id_cmd == 0) {
        //Au cas ou il n ya pas rappel de la commande   
        $panier = new Panier();
   /*      $_SESSION['panier'] = array();
        $_SESSION['panier']['cpt'] = array();
        $_SESSION['panier']['id_article'] = array();
        $_SESSION['panier']['nom'] = array();
        $_SESSION['panier']['qte'] = array();
        $_SESSION['panier']['qteoffert'] = array();
        $_SESSION['panier']['pa'] = array();
        $_SESSION['panier']['description'] = array();
        $_SESSION['panier']['prix'] = array();
        $_SESSION['panier']['prix2'] = array();
        $_SESSION['panier']['repas'] = array();
        $_SESSION['panier']['offre'] = array();
        $_SESSION['panier']['id_client'] = 0;
        $_SESSION['panier']['remise'] = 0;
        $_SESSION['panier']['mont_tva'] = 0;
        $_SESSION['panier']['mont_ttc'] = 0;
        $_SESSION['panier']['mont_ttc_remise'] = 0;
        $_SESSION['panier']['verrouille'] = false;
        $_SESSION['cptpanier'] = 0;
        $_SESSION['panier']['genre'] = array(); */
        ReinitialiserPanier();
        $_SESSION['platdetail'] = array();
        $_SESSION['platdetail']['accomp_id'] = array();
        $_SESSION['platdetail']['accomp_nom'] = array();
        $_SESSION['platdetail']['cpt'] = array();
        $_SESSION['platdetail']['cpt2'] = array();
        $_SESSION['platdetail']['cuisson_id'] = array();
        $_SESSION['platdetail']['cuisson_nom'] = array();
        $_SESSION['platdetail']['idprod'] = array();
        $_SESSION['platdetail']['sauce_id'] = array();
        $_SESSION['platdetail']['sauce_nom'] = array();
        $_SESSION['platdetail']['sel_id'] = array();
        $_SESSION['platdetail']['sel_nom'] = array();
        $_SESSION['platdetail']['keyprods'] = array();      
        $nbArticles = -1;
        $json['message'] ='';
    } else {
        //Au cas ou il ya rappel de la commande 
        $id_client=$_GET['id_client'];
        $id_fact=$_GET['id_fact'];
        $reservechambre_id=$_GET['reservechambre_id'];
        //Procedure annulation
        ReimprimerPOS2($id_fact, $bdd);
        $nbArticles = count($_SESSION['panier1']['id_article']);
        for ($i = 0; $i <= $nbArticles - 1; $i++) {
            $repas = $_SESSION['panier1']['repas'][$i];
            if ($repas == 1) {
                $cuisine = 1;
            }
            if ($repas == 0) {
                $bar = 1;
            }
        }
        //Procedure annulation
        
        $etatfact = 3; //Signifie annulé
        if ($reservechambre_id != '') {
            $requete = $bdd->prepare("UPDATE t_facture SET etat_cmd=:etat WHERE id_fact=:id");
            $requete->BindParam(':etat', $etatfact);
            $requete->BindParam(':id', $id_fact);
            $requete->execute();
        } else {
            $requete = $bdd->prepare("UPDATE t_facture SET etat_cmd=:etat WHERE id_fact=:id");
            $requete->BindParam(':etat', $etatfact);
            $requete->BindParam(':id', $id_fact);
            $requete->execute();
        }
        /* Rendre la table libre apres paiement de la facture */
        $statut = 'libre';
        $en_attente=0;
        $user_attente=NULL;
        $requete = $bdd->prepare("UPDATE  t_client  SET statut =:statut,en_attente =:en_attente,user_attente =:user_attente  WHERE id_client=:id_client");
        $requete->BindParam(':statut',$statut);
        $requete->BindParam(':en_attente',$en_attente);
        $requete->BindParam(':user_attente',$user_attente);
        $requete->BindParam(':id_client',$id_client);
        $requete->execute();
        /* Fin */
        $panier = new Panier();
        $_SESSION['panier'] = array();
        $_SESSION['panier']['cpt'] = array();
        $_SESSION['panier']['id_article'] = array();
        $_SESSION['panier']['nom'] = array();
        $_SESSION['panier']['qte'] = array();
        $_SESSION['panier']['qteoffert'] = array();
        $_SESSION['panier']['pa'] = array();
        $_SESSION['panier']['description'] = array();
        $_SESSION['panier']['prix'] = array();
        $_SESSION['panier']['prix2'] = array();
        $_SESSION['panier']['repas'] = array();
        $_SESSION['panier']['offre'] = array();
        $_SESSION['panier']['id_client'] = 0;
        $_SESSION['panier']['remise'] = 0;
        $_SESSION['panier']['mont_tva'] = 0;
        $_SESSION['panier']['mont_ttc'] = 0;
        $_SESSION['panier']['mont_ttc_remise'] = 0;
        $_SESSION['panier']['verrouille'] = false;
        $_SESSION['cptpanier'] = 0;
        $_SESSION['panier']['genre'] = array();
        $_SESSION['platdetail'] = array();
        $_SESSION['platdetail']['accomp_id'] = array();
        $_SESSION['platdetail']['accomp_nom'] = array();
        $_SESSION['platdetail']['cpt'] = array();
        $_SESSION['platdetail']['cpt2'] = array();
        $_SESSION['platdetail']['cuisson_id'] = array();
        $_SESSION['platdetail']['cuisson_nom'] = array();
        $_SESSION['platdetail']['idprod'] = array();
        $_SESSION['platdetail']['sauce_id'] = array();
        $_SESSION['platdetail']['sauce_nom'] = array();
        $_SESSION['platdetail']['sel_id'] = array();
        $_SESSION['platdetail']['sel_nom'] = array();
        $_SESSION['platdetail']['keyprods'] = array();      
        $nbArticles = -1;
        if ($cuisine == 1) {
            $json['bc'] = true;
        }
       if ($bar == 1) {
            $json['bar'] = true;
        }
        $json['idcommande'] = $id_fact;
        $json['succes'] = true;
    }
        

} else {
    $nbArticles = -1;
    $json['message'] = '<div class="alert alert-danger text-center msg_alert1">Veuillez sélectionner une table ou un client</div>';

}

   
echo json_encode($json);