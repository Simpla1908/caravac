<?php
$bloc_page='';
$tva=16;
$monnaie='$';
$montant_rem=0;
$bool=FALSE;
$path='';
$json = array();
$json['succes'] =False;
$json['message'] ='';
if (!empty($_GET['ajx'])){
    $bool=TRUE;
    $path='../production/';
    include '../../FUNCTION/hebergement.php';
    include '../traitement/fonctionalites.php';
    include '../../bdd/connexion.php';
}
$action = get('action');  
if ($action == 'souscription') {
    $result = getRowsSouscription($bdd);
    $bloc_page = $action;
}elseif ($action == 'detailssouscription') {
    $souscription_id = get('id');  
    $inf = InfoSouscription($souscription_id, $bdd);
    $libelle = $inf->libelle;
    $nom_c = $inf->nom_c;
    $site_id = $inf->site_id;
    $nom_hotel = $inf->nom_hotel;
    $statut = $inf->statut;
    $etat = $inf->etat;
    $date_sous = $inf->date_sous;
    $type_souscription = $inf->type_souscription;
    $nom_user = $inf->nom_user;
    $adresse_mail = $inf->adresse_mail;
    $telephone_user = $inf->telephone_user;
    $dte_echeance = $inf->dte_echeance;
    $dte_blocage = $inf->dte_blocage;
    $date_activ = $inf->date_activ;
    $date_sous = $inf->date_sous;
    $lib_etat = getEtatSouscription($etat);
    //Lignes
    $lignes = LigneSouscription($souscription_id,$bdd);
    $bloc_page = $action;
}elseif ($action == 'facture'){
    $result=ListeFactScpt($bdd);
    $bloc_page = $action; 
}elseif ($action == 'detailsfacture'){
    $id_fact=get('id');
    $t=get('type');
    if($t=='s'){
       $facture=InfoFactScpt($id_fact,$bdd); 
       $num_scrpt= $facture->libelle;
       $etat_scrpt=$facture->etat_scrpt;
        $type_souscription=$facture->type_souscription;
        $souscription_id=$facture->souscription_id;
    }  else {
        $facture=InfoFactScpt2($id_fact,$bdd);
        $num_scrpt= ' ';
        $etat_scrpt=-1;
        $type_souscription=' ';
        $souscription_id=' ';
    }
    
    $type_fact=$facture->type;
    
    $id_hotel=$facture->id_hotel;
    $company_id=$facture->company_id;
    $num_fact= $facture->num_fact;
    
    $dte_edition=$facture->date_edition;
    $date_echeance=$facture->date_echeance;
    $nom_c=$facture->nom_c;
    $nom_hotel=$facture->nom_hotel;
    $phone=$facture->phone;
    $adresse_hotel=$facture->adresse_hotel;
    $mail=$facture->mail;
    $adresse_hotel=$facture->adresse_hotel;
    $totpayefact=MontpayeFactScpt($id_fact,$bdd);
    $recu=InfoRecuScpt($id_fact,$bdd);
    $num_recu=$recu->numero;
    $dte_reglmt=$recu->dte;
    $modepaie=$recu->id_mode_regl;
    $libmode=getMode($modepaie);
    $lignes=LigneFactScpt($id_fact,$bdd);
    $modes=getModepaiement($bdd);
    $bloc_page = $action;
}
elseif($action == 'reactiver'||$action == 'bloquer'){
    $bloc_page='detailssouscription';
    $souscript_id=post('souscript_id');
    $type_souscription=post('type_souscription');
    $etat=post('etat');
    $site_id=post('site_id');
    $souscription_id=$souscript_id;
    if($action == 'reactiver'){
        ActivationSouscription($souscript_id,$type_souscription,$site_id,$bdd);
//        $idcompany=195;
//        GenererFactCompany($idcompany, $bdd);
    }  else {
       DesactivationSouscription($souscript_id,$type_souscription,$site_id,$bdd); 
    }
   
    $inf = InfoSouscription($souscript_id,$bdd);
    $libelle = $inf->libelle;
    $nom_c = $inf->nom_c;
    $site_id = $inf->site_id;
    $nom_hotel = $inf->nom_hotel;
    $statut = $inf->statut;
    $etat = $inf->etat;
    $date_sous = $inf->date_sous;
    $type_souscription = $inf->type_souscription;
    $nom_user = $inf->nom_user;
    $adresse_mail = $inf->adresse_mail;
    $telephone_user = $inf->telephone_user;
    $dte_echeance = $inf->dte_echeance;
    $dte_blocage = $inf->dte_blocage;
    $date_activ = $inf->date_activ;
    $date_sous = $inf->date_sous;
    $lib_etat = getEtatSouscription($etat);
    //Lignes
    $lignes = LigneSouscription($souscript_id,$bdd);
    $contenu =$path. $bloc_page . '.php';
    include($contenu);
}
//Paiement facture
elseif($action == 'payer'){
   $msg='';
   $id_fact=post('id_fact');
   $type_fact=post('type_fact');
   $nbre_user=post('nbre_user');
   $etat_scrpt=post('etat_scrpt');
   $type_souscription=post('type_souscription');
   $souscription_id=post('souscription_id');
   $company_id=post('company_id');
   $id_hotel=post('id_hotel');
   $totfact=post('totfact');
   $mode=post('modepaiement');
   $montant=post('montant');
   $json['id_fact'] =$id_fact; 
   $dte_souscription_h = date('Y-m-d H:i:s');
   $dte = date('Y-m-d');
   $justification='';
   if($montant!=$totfact){
       $json['message']='Le montant payé doit être égal au total de la facture.'; 
   }else{
        $lib='scrptrecu';
        $systeme_id_sous = getIdSystem($bdd);
        $num_cmd=getnumerotation($systeme_id_sous,$lib,$bdd);
        $num_cmd_format = format_numero($num_cmd);
        paiement_souscription($id_fact,$num_cmd_format,$dte,$id_hotel, $company_id, $montant, $mode, $justification, $bdd);
        setnumerotation($systeme_id_sous,$lib,$num_cmd+1,$bdd);
        if($etat_scrpt==0){
            ActivationSouscription($souscription_id,$type_souscription,$id_hotel,$bdd); 
        }elseif ($type_fact=='adduser') {
            $nbre_user_add=0;
            $result=getNbreUser($id_hotel,$bdd);
            foreach ($result as $op) {
                $nbre_user_default = $op->nbre_user;
            }
            $nbre_user = $nbre_user + $nbre_user_default;
            setNbreUser($nbre_user,$nbre_user_add,$id_hotel,$bdd);
        }
        $libmode=getMode($mode);
        $json['dtepaie'] = dateAffiche($dte);   
        $json['num_recu'] =$num_cmd_format;
        $json['mode'] =$libmode;  
        $json['succes'] =True;   
   }
   echo json_encode($json);
}
if (!$bool){
    $contenu = './' . $bloc_page . '.php';
    include($contenu);
}
   

