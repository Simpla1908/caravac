<?php
session_start();
include('../../bdd/connexion.php');
include '../../FUNCTION/hebergement.php';

$json = array();
$json['succes'] = False;
if (isset($_POST['nbre_user']) && isset($_POST['mont_payer'])) {
    $nbre_user=$_POST['nbre_user'];
    $mont_payer = $_POST['mont_payer'];
    
    //recuperation nbre_user par defaut
//    $requete = $bdd->prepare("SELECT nbre_user FROM  t_hotel  WHERE id_hotel=:id_hotel");
//    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
//    $requete->execute();
//    $hotel = $requete->fetchAll(PDO::FETCH_OBJ);
//    foreach ($hotel as $h) $nbre_user_default = $h->nbre_user;
    
    //mise a jour table nombre des users
    
    $nbre_user_update = $nbre_user;
    
    $requete = $bdd->prepare("UPDATE t_hotel SET nbre_user_add=:nbre_user_add WHERE id_hotel=:id_hotel");
    $requete->BindParam(':nbre_user_add', $nbre_user_update);
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->execute();
    
    
    //Création de la facture
    //recuperation tva dans table reglage_systeme
    $req_tva = $bdd->prepare("SELECT tva FROM reglage_systeme");
    $req_tva->execute();
    $d = $req_tva->fetch(PDO::FETCH_OBJ);
    $tva = $d->tva;
    
    $type = 'adduser';
    $companie_id = $_SESSION['company_id'];
    $hotel_id = $_SESSION['id_hotel'];
//    $souscription_id = $data1['souscription_id'][$i];
    $mont_ttc = $mont_payer;
    $systeme_id_sous = getIdSystem($bdd);
    $num_cmd = getnumerotation($systeme_id_sous, $type, $bdd);
    $num_cmd_format = format_numero($num_cmd);
    $monnaie = getsymbole_devise();
    $montant_tva = montant_tva($mont_ttc, 0, $tva);
    $total_fact = $mont_ttc ;
    $montant_remise = 0;
    $remise_pourcent = 0;
    $etat = 0;
    $date_edition = date('Y-m-d');
    $date_echeance = $date_edition;
    $mode = 3; //Credit
    $requete = $bdd->prepare("INSERT INTO t_facture (type,num_fact,tva,monnaie,date_edition,date_echeance,id_hotel,company_id,mont_tva,remise,mont_ttc_remise,mont_ttc,etat,mode)
                                                  VALUES(:type,:num_fact,:tva,:monnaie,:date_edition,:date_echeance,:id_hotel,:company_id,:mont_tva,:remise,:mont_ttc_remise,:mont_ttc,:etat,:mode)");
    $requete->BindParam(':type', $type);
    $requete->BindParam(':num_fact', $num_cmd_format);
    $requete->BindParam(':tva', $tva);
    $requete->BindParam(':monnaie', $monnaie);
    $requete->BindParam(':date_edition', $date_edition);
    $requete->BindParam(':date_echeance', $date_echeance);
    $requete->BindParam(':id_hotel', $hotel_id);
    $requete->BindParam(':company_id', $companie_id);
    $requete->BindParam(':mont_tva', $montant_tva);
    $requete->BindParam(':remise', $montant_remise);
    $requete->BindParam(':mont_ttc_remise', $remise_pourcent);
    $requete->BindParam(':mont_ttc', $total_fact);
    $requete->BindParam(':etat', $etat);
    $requete->BindParam(':mode', $mode);
    $requete->execute();
    $id_fact = $bdd->lastInsertId();
    //Maj compteur
    setnumerotation($systeme_id_sous, $type, $num_cmd + 1, $bdd);
    
    //id de la pack ajout utilisateur
    $id=31;
    
    $requete = $bdd->prepare("
        SELECT b.id,c.prix_user
	FROM t_pack AS b,prix AS c
        WHERE b.id=c.module_id
              AND b.id=:id");
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    
    foreach ($result as $l) {
        $pack_id = $l->id;
        $montant = $l->prix_user;
        $requete = $bdd->prepare("INSERT INTO t_lignesfact_pack(montant,pack_id,fact_id,qte)
                                 VALUES(:montant,:pack_id,:fact_id,:qte)");
        $requete->BindParam(':montant', $montant);
        $requete->BindParam(':pack_id', $pack_id);
        $requete->BindParam(':fact_id', $id_fact);
        $requete->BindParam(':qte', $nbre_user_update);
        $requete->execute();
    }
    
   $json['succes'] = True;
        $json['message'] = 'Cette opération vient de se réaliser avec succès!';
} else {
    $json['message'] = 'Veuillez sélectionner un client';
}

echo json_encode($json);


