<?php

$type_souscription = 'souscription';

function affiche_bloc_menu($action) {
    $actions = array('detais_souscription', 'facture_client',
        'facture_global_client', 'detail_facture',
        'details_facture_global', 'desactivation',
        'facture', 'detailsfacture', 'reglement',
        'paiement', 'souscription', 'detailssouscription',
        'activation', 'test', 'tarifs', 'mailbox', 'readmail'
    );
    if (!empty($_GET['action']) && in_array($_GET['action'], $actions)) {
        $contenu = './' . $_GET['action'] . '.php';
    } else {
        $contenu = './listecompany.php';
    }
    return $contenu;
}

function affiche_numFact($numero) {
    return 'FAC' . $numero;
}

function getAllFactureByType($type, $bdd) {
    $req = 'SELECT a.*,a.type AS type_fact,SUM(a.montant_paye) AS mont_paye,c.nom_hotel,d.nom_c
             FROM v_paiement AS a,t_hotel AS c,t_company AS d
                WHERE  a.id_hotel=c.id_hotel
                      AND c.company_id=d.id_c
                      AND a.type=:type
                GROUP BY id_fact';
    $requete = $bdd->prepare($req);
    $requete->BindParam(':type', $type);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function getLigneFacture($idfact, $bdd){
    $req = '
        SELECT a.id_hotel,a.fact1,a.company_id,a.id_fact,a.num_fact,a.monnaie,a.dte_blocage AS dte_arret,b.id AS lfp_id,b.pack_id,b.montant,
               b.mont_paye,b.pack_company_id,b.active,b.type,c.libelle,e.id_user,e.nom_user,e.prenom_user,e.adresse_mail AS mail_company
            FROM t_facture AS a,t_lignesfact_pack AS b, t_pack AS c,t_company AS d,t_utilisateur AS e
                WHERE a.id_fact=b.fact_id AND b.pack_id=c.id 
                    AND a.company_id=d.id_c 
                    AND d.id_c=e.company_id
                    AND e.type=1 
                    AND b.fact_id=:id_fact';
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id_fact', $idfact);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getModepaiement($bdd) {
    $req = 'SELECT * FROM t_mode_reglement ORDER BY lib';
    $requete = $bdd->prepare($req);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}


function incrementeMontPayePack($id, $montant, $bdd) {
    //Incrémente Montant payé pack
    $requete = $bdd->prepare("UPDATE t_lignesfact_pack SET mont_paye=mont_paye+:mont_paye WHERE id=:id");
    $requete->BindParam(':mont_paye', $montant);
    $requete->BindParam(':id', $id);
    $requete->execute();
}


function getListeReglement($type, $bdd) {
    $req = 'SELECT g.nom_hotel,e.montant,e.idpaie,f.lib,d.dte,b.num_fact,b.monnaie
        FROM  t_facture AS b, t_reglement AS d, paiement AS e,t_mode_reglement AS f,t_hotel AS g
        WHERE b.id_fact=d.id_fact
	AND b.id_hotel=g.id_hotel
        AND d.id_regl=e.regl_id 
        AND e.id_mode_regl=f.id_mode_regl 
        AND f.lib!="Credit"
	AND b.type=:type';
    $requete = $bdd->prepare($req);
    $requete->BindParam(':type', $type);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getDateEcheance($dte, $type) {
    if ($type == 'mensuel') {
        $duree = 1;
    } else {
        $duree = 12;
    }
    $datedepartT = strtotime($dte);
    $date_echeance = date('Y-m-d', strtotime('+' . $duree . 'month', $datedepartT));
    return $date_echeance;
}

function AjouterJour($dte) {
    $nbre = 7;
    $date_echeance_oldT = strtotime($dte);
    $date_edition = date('Y-m-d', strtotime('+' . $nbre . 'days', $date_echeance_oldT));
    return $date_edition;
}

function EnleverJour($dte) {
    $nbre = 3;
    $date_echeance_oldT = strtotime($dte);
    $date_edition = date('Y-m-d', strtotime('-' . $nbre . 'days', $date_echeance_oldT));
    return $date_edition;
}

function activationPack($id, $etat, $type_s, $date, $bdd) {
    //Activation des packs
    $requete = $bdd->prepare("UPDATE t_lignesfact_pack  SET active=:etat WHERE pack_company_id=:id");
    $requete->BindParam(':etat', $etat);
    $requete->BindParam(':id', $id);
    $requete->execute();

    $requete = $bdd->prepare("UPDATE t_pack_company  SET etat=:etat WHERE id=:id");
    $requete->BindParam(':etat', $etat);
    $requete->BindParam(':id', $id);
    $requete->execute();
    if ($etat == 0) {
        $requete = $bdd->prepare("UPDATE t_modulecompany  SET etat_module=:etat WHERE pack_id=:id");
        $requete->BindParam(':etat', $etat);
        $requete->BindParam(':id', $id);
        $requete->execute();
    } else {
        $date_activ = $date;
        $date_echeance = getDateEcheance($date_activ, $type_s);
        $dte_blocage = AjouterJour($date_echeance);
        $requete = $bdd->prepare("UPDATE t_modulecompany  SET etat_module=:etat,date_activ=:date_activ,date_echeance=:date_echeance,dte_blocage=:dte_blocage WHERE pack_id=:id");
        $requete->BindParam(':etat', $etat);
        $requete->BindParam(':date_activ', $date_activ);
        $requete->BindParam(':date_echeance', $date_echeance);
        $requete->BindParam(':dte_blocage', $dte_blocage);
        $requete->BindParam(':id', $id);
        $requete->execute();
    }
}

function changerEtatPayePack($pack_id_comp, $bdd) {
    $paye = 1;
    $requete = $bdd->prepare("UPDATE t_modulecompany  SET paye=:paye WHERE pack_id=:pack_id_comp");
    $requete->BindParam(':paye', $paye);
    $requete->BindParam(':pack_id_comp', $pack_id_comp);
    $requete->execute();
}

function UpdateDateEcheanceFacture($id_fact, $dte, $bdd) {
    $requete = $bdd->prepare("UPDATE t_facture  SET date_echeance=:date_echeance WHERE id_fact=:id_fact");
    $requete->BindParam(':date_echeance', $dte);
    $requete->BindParam(':id_fact', $id_fact);
    $requete->execute();
}

function getRowsSouscriptionDetails($site_id, $bdd) {
    $requete = $bdd->prepare("SELECT d.id_hotel,d.nom_hotel,a.id,a.libelle,b.id AS idpackcomp,b.etat,c.date_sous,c.date_activ,c.date_echeance,c.dte_blocage,c.paye,e.souscription,e.prix_user,e.prix_par_user
    FROM t_pack AS a,t_pack_company AS b, t_modulecompany AS c,t_hotel AS d,prix AS e
    WHERE a.id=b.pack_id 
    AND c.pack_id=b.id
    AND c.site_id=d.id_hotel 
    AND c.prix_id=e.id 
    AND d.id_hotel=:site_id
    GROUP BY b.id
    ORDER BY d.nom_hotel");
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getRowsHotel($company_id, $bdd) {
    $requete = $bdd->prepare("SELECT id_hotel,nom_hotel FROM t_hotel WHERE company_id=:company_id");
    $requete->BindParam(':company_id', $company_id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getRowsActivation($bdd) {
    $requete = $bdd->prepare("SELECT d.id_hotel,d.nom_hotel,a.id,a.libelle,b.id AS idpackcomp,b.etat,c.date_sous,c.date_activ,c.date_echeance,c.dte_blocage,e.souscription
    FROM t_pack AS a,t_pack_company AS b, t_modulecompany AS c,t_hotel AS d,prix AS e
    WHERE a.id=b.pack_id 
    AND c.pack_id=b.id
    AND c.site_id=d.id_hotel 
    AND c.prix_id=e.id 
    AND c.paye=1
    GROUP BY b.id
    ORDER BY d.nom_hotel");
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}



function ActivationSiteCompany($idsite, $idcompany, $bdd) {
    $etat = 1;
    //MAJ ETAT SITE
    $requete = $bdd->prepare("UPDATE t_hotel SET etat=:etat WHERE id_hotel=:id_site");
    $requete->BindParam(':etat', $etat);
    $requete->BindParam(':id_site', $idsite);
    $requete->execute();
    //MAJ ETAT COMPANY
    $requete = $bdd->prepare("UPDATE t_company SET etat=:etat WHERE id_c=:id_c");
    $requete->BindParam(':etat', $etat);
    $requete->BindParam(':id_c', $idcompany);
    $requete->execute();
}

function date_formatee1($dte) {
    $date = new DateTime($dte);
    $date_format = $date->format('d/m/Y H:i:s');
    return $date_format;
}

//$requete = $bdd->prepare("SELECT * FROM accuse_reception ORDER BY date DESC ");
//$requete->execute();
//$msg= $requete->fetchAll(PDO::FETCH_OBJ);
//$nbr=count($msg);
$nbr = 0;

//SOUSCRIPTION
function InfoSouscription($id, $bdd) {
    $requete = $bdd->prepare("
        SELECT a.nom_c,b.nom_hotel,c.*,d.nom_user,d.prenom_user,d.adresse_mail,d.telephone_user,c.site_id
        FROM t_company AS a, t_hotel AS b,souscription AS c, t_utilisateur AS d
        WHERE a.id_c=b.company_id 
        AND b.id_hotel=c.site_id
        AND b.id_hotel=d.id_hotel
        AND d.type=1
        AND c.id=:id");
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result;
}

//LIGNES SOUSCRIPTIONS
function LigneSouscription($id, $bdd) {
    $requete = $bdd->prepare("
        SELECT b.id,b.libelle,c.prix_user
	FROM t_pack_company AS a,t_pack AS b,prix AS c
        WHERE a.pack_id=b.id
              AND a.prix_id=c.id
              AND a.souscript_id=:id");
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

//LISTE DES SOUSCRIPTIONS
function getRowsSouscription($bdd) {
    $req = 'SELECT x.*,c.id_c,c.nom_c,d.id_hotel,d.nom_hotel,x.etat AS etat_sous
            FROM souscription AS x,t_company AS c,t_hotel AS d
            WHERE 	x.site_id=d.id_hotel
                    AND d.company_id=c.id_c';
    $requete = $bdd->prepare($req);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function ActivationSouscription($souscription_id, $type, $idsite, $bdd){
    $etat = 1;
    $date_activ = date('Y-m-d');
    if ($type=='mensuel') {
        $duree = 1;
    } elseif ($type=='annuel'){
        $duree = 12;
    }
    $dte_echeance = AddMonthToDate($date_activ, $duree);
    $prolongation = 7; //Delai de grace en jr
    $dte_blocage = AddDaysToDate($dte_echeance, $prolongation);
    $generer=0;
    $bloquer=0;
    $requete = $bdd->prepare("UPDATE souscription SET etat=:etat,date_activ=:date_activ,dte_blocage=:dte_blocage,dte_echeance =:dte_echeance,generer =:generer WHERE id=:id");
    $requete->BindParam(':etat', $etat);
    $requete->BindParam(':date_activ', $date_activ);
    $requete->BindParam(':dte_blocage', $dte_blocage);
    $requete->BindParam(':dte_echeance', $dte_echeance);
    $requete->BindParam(':id', $souscription_id);
    $requete->BindParam(':generer',$generer);
    $requete->execute();

    $requete = $bdd->prepare("UPDATE t_modulecompany  SET etat_module =:etat_module WHERE  souscription_id=:souscription_id");
    $requete->BindParam(':etat_module', $etat);
    $requete->BindParam(':souscription_id', $souscription_id);
    $requete->execute();

    $requete = $bdd->prepare("UPDATE t_hotel SET etat =:etat WHERE id_hotel=:id_hotel");
    $requete->BindParam(':etat', $etat);
    $requete->BindParam(':id_hotel', $idsite);
    $requete->execute();
}

function DesactivationSouscription($souscription_id, $type, $idsite, $bdd) {
    $etat = 0;
    $requete = $bdd->prepare("UPDATE souscription SET etat=:etat WHERE id=:id");
    $requete->BindParam(':etat', $etat);
    $requete->BindParam(':id', $souscription_id);
    $requete->execute();
    
    $requete = $bdd->prepare("UPDATE t_modulecompany  SET etat_module =:etat_module WHERE  souscription_id=:souscription_id");
    $requete->BindParam(':etat_module', $etat);
    $requete->BindParam(':souscription_id', $souscription_id);
    $requete->execute();
    //site
    $req = 'SELECT COUNT(*) AS nbre
            FROM souscription AS x
            WHERE x.etat=1
                  AND x.site_id=:id';
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $idsite);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    $nbre=$result->nbre ;
    if ($nbre==0) {
        $requete = $bdd->prepare("UPDATE t_hotel SET etat =:etat WHERE id_hotel=:id_hotel");
        $requete->BindParam(':etat',$etat);
        $requete->BindParam(':id_hotel',$idsite);
        $requete->execute();
    }
}

//Blocage des souscriptions des company
function BlocageScrptCompany($idcompany, $bdd) {
    $dte=date('Y-m-d');
    $req = 'SELECT * 
            FROM souscription AS x
            WHERE x.etat=1 
                  AND x.compagny_id=:id';
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $idcompany);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $souscription_id = $r->id;
        $type_souscription = $r->type_souscription;
        $site_id = $r->site_id;
        $dte_blocage = $r->dte_blocage;
        if($dte >=$dte_blocage){
            DesactivationSouscription($souscription_id,$type_souscription, $site_id, $bdd);
        }
    }
}

//Génération des factures de company
function GenererFactCompany($idcompany, $bdd) {
    $dte = date('Y-m-d');
    $dte_old =$dte;
    $nbrejr = 7;
    $statut = "abonne";
    //recuperation tva dans table reglage_systeme
    $req_tva = $bdd->prepare("SELECT tva FROM reglage_systeme");
    $req_tva->execute();
    $d = $req_tva->fetch(PDO::FETCH_OBJ);
    $tva = $d->tva;
    $dte_edit = AddDaysToDate($dte, $nbrejr);
    //Liste des souscriptions actives de la company
    $req = 'SELECT * 
            FROM souscription AS x
            WHERE x.etat=1 AND x.statut=:statut AND x.generer=0
                  AND x.compagny_id=:id';
    $requete = $bdd->prepare($req);
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':id', $idcompany);
    $requete->execute();
    $souscriptions = $requete->fetchAll(PDO::FETCH_OBJ);
   
    foreach ($souscriptions as $s) {
        $souscript_id = $s->id;
        $site_id = $s->site_id;
        $dte_echeance = $s->dte_echeance;
        //$ht = ht($totfact, $tva, $montant_rem);
        if ($dte_edit >= $dte_echeance) {
            $total_fact= $s->montant_tot_sous ;
            $montant_rem = 0;
            $montant_tva= montant_tva($total_fact,$montant_rem,$tva);
                //Insertion Facture 
                $type = 'souscription';
                $companie_id = $idcompany;
                $hotel_id = $site_id;
                $souscription_id = $souscript_id;
                $mont_ttc = 0;
                $systeme_id_sous = getIdSystem($bdd);
                $num_cmd = getnumerotation($systeme_id_sous, $type, $bdd);
                $num_cmd_format = format_numero($num_cmd);
                $monnaie = getsymbole_devise();
                $montant_remise = 0;
                $remise_pourcent = 0;
                $etat = 0;
                $date_sous = $dte_old;
                $date_echeance = $dte_echeance;
                $mode = 3; //Credit
                $requete = $bdd->prepare("INSERT INTO t_facture (type,num_fact,tva,monnaie,date_edition,date_echeance,id_hotel,company_id,mont_tva,remise,mont_ttc_remise,mont_ttc,etat,souscription_id,mode)
                                                      VALUES(:type,:num_fact,:tva,:monnaie,:date_edition,:date_echeance,:id_hotel,:company_id,:mont_tva,:remise,:mont_ttc_remise,:mont_ttc,:etat,:souscription_id,:mode)");
                $requete->BindParam(':type', $type);
                $requete->BindParam(':num_fact', $num_cmd_format);
                $requete->BindParam(':tva', $tva);
                $requete->BindParam(':monnaie', $monnaie);
                $requete->BindParam(':date_edition', $date_sous);
                $requete->BindParam(':date_echeance', $date_echeance);
                $requete->BindParam(':id_hotel', $hotel_id);
                $requete->BindParam(':company_id', $companie_id);
                $requete->BindParam(':mont_tva', $montant_tva);
                $requete->BindParam(':remise', $montant_remise);
                $requete->BindParam(':mont_ttc_remise', $remise_pourcent);
                $requete->BindParam(':mont_ttc', $total_fact);
                $requete->BindParam(':etat', $etat);
                $requete->BindParam(':souscription_id', $souscription_id);
                $requete->BindParam(':mode', $mode);
                $requete->execute();
                $id_fact = $bdd->lastInsertId();

                //Lignes factures
                $lignes = LigneSouscription($souscript_id, $bdd);
                foreach ($lignes as $l) {
                    $pack_id = $l->id;
                    $montant = $l->prix_user;
                    $requete = $bdd->prepare("INSERT INTO t_lignesfact_pack(montant,pack_id,fact_id)
                                             VALUES(:montant,:pack_id,:fact_id)");
                    $requete->BindParam(':montant', $montant);
                    $requete->BindParam(':pack_id', $pack_id);
                    $requete->BindParam(':fact_id', $id_fact);
                    $requete->execute();
                }
               
                $generer=1;
                $requete = $bdd->prepare("UPDATE souscription SET generer=:generer WHERE id=:id");
                $requete->BindParam(':generer',$generer);
                $requete->BindParam(':id',$souscription_id);
                $requete->execute();
                //Maj compteur
                setnumerotation($systeme_id_sous, $type, $num_cmd + 1, $bdd);
        }
    }
}


//LISTE FACT SOUSCRIPTION
function ListeFactScpt($bdd){
    $req = "SELECT a.*,c.nom_c,b.nom_hotel
             FROM t_facture AS a,t_hotel AS b,t_company AS c
                WHERE  a.id_hotel=b.id_hotel
                      AND b.company_id=c.id_c
                      AND a.type IN('souscription' ,'adduser')";
    $requete = $bdd->prepare($req);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function ListeFactScpt2($id,$bdd){
    $req = "SELECT a.*,c.nom_c,b.nom_hotel,d.libelle
             FROM t_facture AS a,t_hotel AS b,t_company AS c, souscription AS d
                WHERE  a.id_hotel=b.id_hotel
                      AND a.company_id=c.id_c
		      AND a.souscription_id=d.id
                      AND a.type='souscription' 
                      AND a.id_hotel=:id_hotel";
    
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id_hotel',$id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
//INFOS FACT SOUSCRIPTION
function InfoFactScpt($idfact,$bdd) {
    $req = 'SELECT a.type,a.id_fact,a.num_fact,a.date_edition ,a.date_echeance,a.mont_ttc,b.*,c.nom_c,d.libelle,d.etat AS etat_scrpt,d.type_souscription,d.id AS souscription_id
             FROM t_facture AS a,t_hotel AS b,t_company AS c, souscription AS d
                WHERE  a.id_hotel=b.id_hotel
                      AND a.company_id=c.id_c
		      AND a.souscription_id=d.id
                      AND a.id_fact=:id_fact';
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id_fact', $idfact);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result;
}
function InfoFactScpt2($idfact,$bdd) {
    $req = 'SELECT a.type,a.id_fact,a.num_fact,a.date_edition ,a.date_echeance,a.mont_ttc,b.*,c.nom_c
             FROM t_facture AS a,t_hotel AS b,t_company AS c
                WHERE  a.id_hotel=b.id_hotel
                      AND a.company_id=c.id_c
                      AND a.id_fact=:id_fact';
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id_fact', $idfact);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result;
}
//INFOS FACT SOUSCRIPTION
function InfoRecuScpt($idfact,$bdd){
    $req = 'SELECT COUNT(*) AS nbre,a.* FROM t_reglement AS a WHERE a.id_fact=:id_fact';
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id_fact',$idfact);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result;
}
//LIGNES FACT SOUSCRIPTION
function LigneFactScpt($idfact,$bdd) {
    $req = 'SELECT  b.id,b.pack_id,b.montant,c.libelle,b.qte
            FROM t_lignesfact_pack AS b, t_pack AS c
                WHERE b.pack_id=c.id 
                    AND b.fact_id=:id_fact';
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id_fact', $idfact);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
//MONTANT PAYE FACT SOUSCRIPTION
function MontpayeFactScpt($idfact,$bdd) {
    $requete = $bdd->prepare("SELECT SUM(c.montantusd) AS montantpaye
                                FROM t_facture AS a, t_reglement AS b, paiement AS c
                                WHERE a.id_fact=b.id_fact AND b.id_regl=c.regl_id
                                 AND c.id_mode_regl IN(1,2)
                                AND a.id_fact=:id  
                                GROUP BY a.id_fact");
    $requete->BindParam(':id',$idfact);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    $montantpaye=0;
     foreach ($result as $r) {
        $montantpaye=$r->montantpaye;
     }
    return $montantpaye;
}
function paiement_souscription($id_fact,$num_cmd_format,$dte,$id_hotel, $company_id, $montant, $mode, $justification, $bdd) {
    /* Insertion dans t_reglement */
    
    $requete = $bdd->prepare("INSERT INTO  t_reglement (id_fact,id_mode_regl,numero,dte,id_hotel)
                                    VALUES(:id_fact,:id_mode_regl,:numero,:dte,:id_hotel)");
    $requete->BindParam(':id_fact', $id_fact);
    $requete->BindParam(':id_mode_regl',$mode);
    $requete->BindParam(':numero',$num_cmd_format);
    $requete->BindParam(':dte', $dte);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->execute();
    $regl_id = $bdd->lastInsertId();
    /* Fin d'Insertion dans t_reglement */
    /* Insertion dans paiement */
    $requete = $bdd->prepare("INSERT INTO  paiement (montantusd,justification,id_mode_regl,regl_id,site_id,company_id)
                                    VALUES(:montant,:justification,:id_mode_regl,:regl_id,:id_hotel,:company_id)");
    $requete->BindParam(':montant', $montant);
    $requete->BindParam(':justification', $justification);
    $requete->BindParam(':id_mode_regl', $mode);
    $requete->BindParam(':regl_id', $regl_id);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->BindParam(':company_id', $company_id);
    $requete->execute();
    
}
function AddMonthToDate($dte, $nbrejr) {
    $addjr = '+' . $nbrejr . 'month';
    $date_collect = date("Y-m-d", strtotime($dte . $addjr));
    $new_date_collect = $date_collect;
    return $new_date_collect;
}

function AddDaysToDate($dte, $nbrejr) {
    $addjr = '+' . $nbrejr . 'days';
    $date_collect = date("Y-m-d", strtotime($dte . $addjr));
    $new_date_collect = $date_collect;
    return $new_date_collect;
}

function SubDaysToDate($dte, $nbrejr) {
    $addjr = '-' . $nbrejr . 'days';
    $date_collect = date("Y-m-d", strtotime($dte . $addjr));
    $new_date_collect = $date_collect;
    return $new_date_collect;
}

function getEtatSouscription($etat) {
    $nom = '';
    if ($etat == 0) {
        $nom = 'inactif';
    } elseif ($etat == 1) {
        $nom = 'actif';
    }
    return $nom;
}
function getMode($etat){
    $nom = '';
    if ($etat ==1) {
        $nom = 'Don';
    } elseif ($etat == 2) {
        $nom = 'Cash';
    }elseif ($etat ==3) {
         $nom = 'Crédit';
    }
    return $nom;
}

//post
function post($var) {
    if (isset($_POST[$var]))
        return $_POST[$var];
}

//get
function get($var) {
    if (isset($_GET[$var]))
        return $_GET[$var];
}
function LigneSouscription2($id,$type,$bdd) {
    $requete = $bdd->prepare("
        SELECT b.id,b.libelle,c.prix_user
    FROM t_pack_company AS a,t_pack AS b,prix AS c
        WHERE a.pack_id=b.id
              AND a.prix_id=c.id
              AND a.souscript_id=:id
              AND c.souscription=:type");
    $requete->BindParam(':id', $id);
    $requete->BindParam(':type', $type);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function ReturnPrixPack($id_pack,$type_souscription,$bdd){
    $data=array();
    $data['id'] = 0;
    $data['prix_user'] = 0;
    $data['prix_par_user'] = 0;
    $requete=$bdd->prepare("SELECT id,prix_user,prix_par_user FROM  prix WHERE module_id=:module  AND souscription=:souscription");
    $requete->BindParam(':module',$id_pack);
    $requete->BindParam(':souscription',$type_souscription);
    $requete->execute();
    $result= $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r):
        $data['id']=$r->id;
        $data['prix_user']=$r->prix_user;
        $data['prix_par_user']=$r->prix_par_user;
    endforeach;
    return $data;
}

function PackSite($id_site,$bdd){
    $_SESSION['pack_site'] = array();
    $_SESSION['pack_site']['id_pack'] = array();

    //recuperation de tous les modules du site
    $requete = $bdd->prepare("SELECT pack_id FROM  t_pack_company WHERE site_id=:id_site");
    $requete->BindParam(':id_site',$id_site);
    $requete->execute();
    $pack = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($pack as $p) {
         if (!in_array($p->pack_id, $_SESSION['pack_site']['id_pack'])) {
                array_push($_SESSION['pack_site']['id_pack'], $p->pack_id);
    }
    }

}