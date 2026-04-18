<?php
//include '../../bdd/connexion.php';
// Initialisation de la session

$entree = 'entree';
$mois=date('m');
$annee=date('Y');
$sortie='sortie';
//    Situation mensuelle caisse entree normal
$mode_operation="normal";
$requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_entree_mois ,SUM(montantUSD) AS montantUSD_entree_mois"
        . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id AND  MONTH(op.date_bon)=:dte AND YEAR(op.date_bon)=:annee AND mode_operation=:mode_operation");
$requete->BindParam(':type',$entree);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':dte',$mois);
$requete->BindParam(':annee',$annee);
$requete->BindParam(':mode_operation',$mode_operation);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($operations as $op) {
    $montantFC_entree_mois_normal = $op->montantFC_entree_mois;
    $montantUSD_entree_mois_normal = $op->montantUSD_entree_mois;
}

//    Situation mensuelle caisse sortie normale

$requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_sortie_mois ,SUM(montantUSD) AS montantUSD_sortie_mois"
        . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id AND  MONTH(op.date_bon)=:dte AND YEAR(op.date_bon)=:annee AND mode_operation=:mode_operation");
$requete->BindParam(':type', $sortie);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':dte',$mois);
$requete->BindParam(':annee',$annee);
$requete->BindParam(':mode_operation',$mode_operation);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($operations as $op) {
    $montantFC_sortie_mois_normal = $op->montantFC_sortie_mois;
    $montantUSD_sortie_mois_normal = $op->montantUSD_sortie_mois;
}



//    Situation mensuelle caisse entree banque
$mode_operation="banque";
$requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_entree_mois ,SUM(montantUSD) AS montantUSD_entree_mois"
        . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id AND  MONTH(op.date_bon)=:dte AND YEAR(op.date_bon)=:annee AND mode_operation=:mode_operation");
$requete->BindParam(':type',$entree);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':dte',$mois);
$requete->BindParam(':annee',$annee);
$requete->BindParam(':mode_operation',$mode_operation);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($operations as $op) {
    $montantFC_entree_mois_bank = $op->montantFC_entree_mois;
    $montantUSD_entree_mois_bank = $op->montantUSD_entree_mois;
}

//    Situation mensuelle caisse sortie banque

$requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_sortie_mois ,SUM(montantUSD) AS montantUSD_sortie_mois"
        . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id AND  MONTH(op.date_bon)=:dte AND YEAR(op.date_bon)=:annee AND mode_operation=:mode_operation");
$requete->BindParam(':type', $sortie);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':dte',$mois);
$requete->BindParam(':annee',$annee);
$requete->BindParam(':mode_operation',$mode_operation);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($operations as $op) {
    $montantFC_sortie_mois_bank = $op->montantFC_sortie_mois;
    $montantUSD_sortie_mois_bank = $op->montantUSD_sortie_mois;
}




//    Situation Journalière caisse entree normale
$mode_operation="normal";
$jr=date('d');
$date_bon=date('Y-m-d');
$requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_entree_jr ,SUM(montantUSD) AS montantUSD_entree_jr"
        . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id AND DAY(op.date_bon)=:dte AND op.date_bon=:date_bon AND mode_operation=:mode_operation ");
$requete->BindParam(':type',$entree);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':dte',$jr);
$requete->BindParam(':date_bon',$date_bon);
$requete->BindParam(':mode_operation',$mode_operation);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($operations as $op) {
    $montantFC_entree_jr_normal = $op->montantFC_entree_jr;
    $montantUSD_entree_jr_normal = $op->montantUSD_entree_jr;
}

//    Situation Journalière caisse sortie normale
$jr=date('d');
$requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_sortie_jr ,SUM(montantUSD) AS montantUSD_sortie_jr"
        . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id AND DAY(op.date_bon)=:dte AND op.date_bon=:date_bon AND mode_operation=:mode_operation");
$requete->BindParam(':type',$sortie);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':dte',$jr);
$requete->BindParam(':date_bon',$date_bon);
$requete->BindParam(':mode_operation',$mode_operation);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($operations as $op) {
    $montantFC_sortie_jr_normal = $op->montantFC_sortie_jr;
    $montantUSD_sortie_jr_normal = $op->montantUSD_sortie_jr;
}

//    Solde initial journalier normal
$hier=date('Y-m-d',  time()-(24*3600));
$d1=new DateTime($hier);
$d1->format('N');
if($d1->format('N')==7){
   $jr=date('d')-2; 
}  else {
    $jr=date('d')-1;
}


//On recupère la somme des entrees d'hier normal
$requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_entree_h ,SUM(montantUSD) AS montantUSD_entree_h"
        . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id AND DAY(op.date_bon)=:dte  AND MONTH(op.date_bon)=:mois AND YEAR(op.date_bon)=:annee  AND mode_operation=:mode_operation");
$requete->BindParam(':type',$entree);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':dte',$jr);
$requete->BindParam(':mois',$mois);
$requete->BindParam(':annee',$annee);
$requete->BindParam(':mode_operation',$mode_operation);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($operations as $op) {
    $montantFC_entree_h_normal = $op->montantFC_entree_h;
    $montantUSD_entree_h_normal = $op->montantUSD_entree_h;
}

//On recupère la somme des sorties d'hier
$requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_sortie_h ,SUM(montantUSD) AS montantUSD_sortie_h"
        . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id AND DAY(op.date_bon)=:dte AND MONTH(op.date_bon)=:mois AND YEAR(op.date_bon)=:annee AND mode_operation=:mode_operation");
$requete->BindParam(':type',$sortie);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':dte',$jr);
$requete->BindParam(':mois',$mois);
$requete->BindParam(':annee',$annee);
$requete->BindParam(':mode_operation',$mode_operation);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($operations as $op) {
    $montantFC_sortie_h_normal= $op->montantFC_sortie_h;
    $montantUSD_sortie_h_normal= $op->montantUSD_sortie_h;
}



//On trouve le solde initial d'aujourd'hui
$solde_fc_initial_normal=$montantFC_entree_h_normal - $montantFC_sortie_h_normal;
$solde_usd_initial_normal=$montantUSD_entree_h_normal - $montantUSD_sortie_h_normal;

$balance_usd_normal =$montantUSD_entree_jr_normal - $montantUSD_sortie_jr_normal ;
$balance_fc_normal =$montantFC_entree_jr_normal - $montantFC_sortie_jr_normal ;

$solde_caisse_usd_normal=$solde_usd_initial_normal+$balance_usd_normal;
$solde_caisse_fc_normal=$solde_fc_initial_normal+$balance_fc_normal;




//++++++++++++++++++++++++++ BANK +++++++++++++++++++++++++++++++++++++++++++++


//    Situation Journalière caisse entree normale
$mode_operation="banque";
$jr=date('d');
$date_bon=date('Y-m-d');
$requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_entree_jr ,SUM(montantUSD) AS montantUSD_entree_jr"
        . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id AND DAY(op.date_bon)=:dte AND op.date_bon=:date_bon AND mode_operation=:mode_operation ");
$requete->BindParam(':type',$entree);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':dte',$jr);
$requete->BindParam(':date_bon',$date_bon);
$requete->BindParam(':mode_operation',$mode_operation);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($operations as $op) {
    $montantFC_entree_jr_bank = $op->montantFC_entree_jr;
    $montantUSD_entree_jr_bank = $op->montantUSD_entree_jr;
}

//    Situation Journalière caisse sortie normale
$jr=date('d');
$requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_sortie_jr ,SUM(montantUSD) AS montantUSD_sortie_jr"
        . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id AND DAY(op.date_bon)=:dte AND op.date_bon=:date_bon AND mode_operation=:mode_operation");
$requete->BindParam(':type',$sortie);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':dte',$jr);
$requete->BindParam(':date_bon',$date_bon);
$requete->BindParam(':mode_operation',$mode_operation);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($operations as $op) {
    $montantFC_sortie_jr_bank = $op->montantFC_sortie_jr;
    $montantUSD_sortie_jr_bank = $op->montantUSD_sortie_jr;
}

//    Solde initial journalier normal
$jr=date('d')-1;

//On recupère la somme des entrees d'hier normal
$requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_entree_h ,SUM(montantUSD) AS montantUSD_entree_h"
        . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id AND DAY(op.date_bon)=:dte  AND MONTH(op.date_bon)=:mois AND YEAR(op.date_bon)=:annee  AND mode_operation=:mode_operation");
$requete->BindParam(':type',$entree);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':dte',$jr);
$requete->BindParam(':mois',$mois);
$requete->BindParam(':annee',$annee);
$requete->BindParam(':mode_operation',$mode_operation);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($operations as $op) {
    $montantFC_entree_h_bank = $op->montantFC_entree_h;
    $montantUSD_entree_h_bank = $op->montantUSD_entree_h;
}

//On recupère la somme des sorties d'hier
$requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_sortie_h ,SUM(montantUSD) AS montantUSD_sortie_h"
        . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id AND DAY(op.date_bon)=:dte AND MONTH(op.date_bon)=:mois AND YEAR(op.date_bon)=:annee AND mode_operation=:mode_operation");
$requete->BindParam(':type',$sortie);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':dte',$jr);
$requete->BindParam(':mois',$mois);
$requete->BindParam(':annee',$annee);
$requete->BindParam(':mode_operation',$mode_operation);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($operations as $op) {
    $montantFC_sortie_h_bank= $op->montantFC_sortie_h;
    $montantUSD_sortie_h_bank= $op->montantUSD_sortie_h;
}



//On trouve le solde initial d'aujourd'hui
$solde_fc_initial_bank=$montantFC_entree_h_bank - $montantFC_sortie_h_bank;
$solde_usd_initial_bank=$montantUSD_entree_h_bank - $montantUSD_sortie_h_bank;

$balance_usd_bank =$montantUSD_entree_jr_bank - $montantUSD_sortie_jr_bank ;
$balance_fc_bank =$montantFC_entree_jr_bank - $montantFC_sortie_jr_bank ;

$solde_caisse_usd_bank=$solde_usd_initial_bank+$balance_usd_bank;
$solde_caisse_fc_bank=$solde_fc_initial_bank+$balance_fc_bank;


//Toutes les entrees caisse normale

$entree = 'entree';
$sortie='sortie';
//    Situation caisse entree normal
$mode_operation="normal";
$requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_entree_normal ,SUM(montantUSD) AS montantUSD_entree_normal"
        . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id  AND mode_operation=:mode_operation");
$requete->BindParam(':type',$entree);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':mode_operation',$mode_operation);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($operations as $op) {
    $montantFC_entree_normal = $op->montantFC_entree_normal;
    $montantUSD_entree_normal = $op->montantUSD_entree_normal;
}

//    Situation  caisse sortie normal
$mode_operation="normal";
$requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_sortie_normal ,SUM(montantUSD) AS montantUSD_sortie_normal"
        . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id  AND mode_operation=:mode_operation");
$requete->BindParam(':type',$sortie);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':mode_operation',$mode_operation);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($operations as $op) {
    $montantFC_sortie_normal = $op->montantFC_sortie_normal;
    $montantUSD_sortie_normal= $op->montantUSD_sortie_normal;
}
$solde_fc_normal_entree=$montantFC_entree_normal -$montantFC_sortie_normal;
$solde_usd_normal_entree=$montantUSD_entree_normal -$montantUSD_sortie_normal;


//Toutes les operations caisse banque

$entree = 'entree';
$sortie='sortie';
//    Situation caisse entree banque
$mode_operation="banque";
$requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_entree_bank ,SUM(montantUSD) AS montantUSD_entree_bank"
        . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id  AND mode_operation=:mode_operation");
$requete->BindParam(':type',$entree);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':mode_operation',$mode_operation);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($operations as $op) {
    $montantFC_entree_bank = $op->montantFC_entree_bank;
    $montantUSD_entree_bank = $op->montantUSD_entree_bank;
}

//    Situation  caisse sortie banque

$requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_sortie_bank ,SUM(montantUSD) AS montantUSD_sortie_bank"
        . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id  AND mode_operation=:mode_operation");
$requete->BindParam(':type',$sortie);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':mode_operation',$mode_operation);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($operations as $op) {
    $montantFC_sortie_bank = $op->montantFC_sortie_bank;
    $montantUSD_sortie_bank= $op->montantUSD_sortie_bank;
}
$solde_fc_bank_entree=$montantFC_entree_bank - $montantFC_sortie_bank;
$solde_usd_bank_entree=$montantUSD_entree_bank - $montantUSD_sortie_bank;

