<?php

// Initialisation de la session
session_start();
include '../bdd/connexion.php';
include '../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../REC/Amelioration/reglage/recuperer_idmonnaie.php';
include '../FUNCTION/hebergement.php';
include '../FUNCTION/paiement.php';
$json = array();
$json['url'] = '';
if (!empty($_POST)) {
    $id_res = $_POST['id_res'];
    $id_fact = $_POST['id_fact'];
    $idres_ch = $_POST['idres_ch'];
    $montant_fact = $_POST['montant_fact'];
    $montant_tot = $_POST['montant_tot'];
    $montant_paye=$_POST['montant_paye'];
    $montantusd = $_POST['montantusd'];
    $montantcdf = $_POST['montantcdf'];
    $mode = $_POST['modepaiement'];
    $justification = $_POST['justification'];
    $etat_fact = $_POST['etat_fact'];
    $type_client=$_POST['type_client'];
    $monnaie_fact = getsymbole_devise();
    $dte = $_POST['dte'];
    $service=$_POST['s'];
    $dtereglement = dateToformatBdd($_POST['dtereglement']);
    $numero = '';
    $remise = 0;
    $lib_mode=$_POST['lib_mode'];
    $etat_f=1;
    $taux_fact=$_POST['taux_fact'];
    $rendu=0;
	$motif_fact='Paiement facture hébergement';
    if($service=='restaurant'){
        $tauxdollar=$taux_op;
		$motif_fact='Paiement facture restaurant';
    }
    $montant =$montantusd*$tauxdollar+$montantcdf;
    $allmontant=$montant;
    $montant_pay=$montant;
    $montant_pay1=$montant;
    if (arrondir($montant) >=arrondir($montant_fact)){
        $rendu=$montant-$montant_fact;
        $montant = $montant_fact;
        $etat_f=2;
    }
    //Incrémentation  de la garantie
    if ($etat_fact == 'credit') {
            //Liberation
            $statut = 'libre';
            $requete = $bdd->prepare("UPDATE t_reserve_chambre  SET statut=:statut,date_lib=:date_lib WHERE id=:id");
            $requete->BindParam(':statut', $statut);
            $requete->BindParam(':date_lib', $dte);
            $requete->BindParam(':id', $idres_ch);
            $requete->execute();
            //Update t_chambre_histo
            $requete = $bdd->prepare("UPDATE t_chambre_histo SET statut=:statut,date_lib=:date_lib WHERE idres_ch=:id AND statut='occupe' ");
            $requete->BindParam(':statut', $statut);
            $requete->BindParam(':date_lib', $dte);
            $requete->BindParam(':id', $idres_ch);
            $requete->execute();
            $json['url'] = '../REC/rec_situation_clients_loges.php';
            $json['liberation'] = True;
        
    } elseif ($etat_fact == 'liberer') {
        //Liberation
        $statut = 'libre';
        $requete = $bdd->prepare("UPDATE t_reserve_chambre  SET statut=:statut,date_lib=:date_lib WHERE id=:id");
        $requete->BindParam(':statut', $statut);
        $requete->BindParam(':date_lib', $dte);
        $requete->BindParam(':id', $idres_ch);
        $requete->execute();
        //Update t_chambre_histo
        $requete = $bdd->prepare("UPDATE t_chambre_histo SET statut=:statut,date_lib=:date_lib WHERE idres_ch=:id AND statut='occupe' ");
        $requete->BindParam(':statut', $statut);
        $requete->BindParam(':date_lib', $dte);
        $requete->BindParam(':id', $idres_ch);
        $requete->execute();
        $json['url'] = '../REC/rec_situation_clients_loges.php';
    } elseif ($etat_fact == 'regler'){
        $totalnuite= getTotalNuite($bdd,$id_res);
        if($montant_paye==0 && $montant<$totalnuite && $service=='hebergement'){
            $json['montant_nuite'] =afficheMontant($m_affiche, montant_equivalent_bdd(getsymbole_local(),$m_affiche,$tauxdollar,$totalnuite));
            $json['error'] =True;
        }  else {
            //Paiement
//        $paie_id=paiement($id_fact,$numero,$dtereglement,$_SESSION['id_user'],$_SESSION['id_hotel'],$_SESSION['company_id'], $montant,$montantusd,$montantcdf,$tauxdollar,$rendu,$remise, $mode, $justification, $id_monnaie, $bdd);
            $dtereglhr=date("Y-m-d H:i:s");
            $libelle1='HEBR';
            $num_cmd = getnumerotation($_SESSION['id_hotel'], $libelle1, $bdd);
            $numero = str_pad($num_cmd,5,"0", STR_PAD_LEFT);
            $requete = $bdd->prepare("INSERT INTO  t_reglement (numero,id_fact,date_regl,dte,id_user,id_hotel)
                                    VALUES(:numero,:id_fact,:date_regl,:dte,:id_user,:id_hotel)");
            $requete->BindParam(':numero',$numero);
            $requete->BindParam(':id_fact', $id_fact);
            $requete->BindParam(':date_regl',$dtereglhr);
            $requete->BindParam(':dte', $dtereglement);
            $requete->BindParam(':id_user', $_SESSION['id_user']);
            $requete->BindParam(':id_hotel',$_SESSION['id_hotel']);
            $requete->execute();
            $regl_id = $bdd->lastInsertId();
            $num_cmd+=1;
            setnumerotation($_SESSION['id_hotel'], $libelle1, $num_cmd, $bdd);
            /* Fin d'Insertion dans t_reglement */
            /* Insertion dans paiement */
            $requete = $bdd->prepare("INSERT INTO  paiement (montant,remise,justification,id_mode_regl,id_monnaie,regl_id,site_id,company_id,montantusd,montantcdf,taux,rendu)
                                    VALUES(:montant,:remise,:justification,:id_mode_regl,:id_monnaie,:regl_id,:id_hotel,:company_id,:montantusd,:montantcdf,:taux,:rendu)");
            $requete->BindParam(':montant',$montant);
            $requete->BindParam(':remise', $remise);
            $requete->BindParam(':justification', $justification);
            $requete->BindParam(':id_mode_regl', $mode);
            $requete->BindParam(':id_monnaie', $id_monnaie);
            $requete->BindParam(':regl_id', $regl_id);
            $requete->BindParam(':id_hotel',$_SESSION['id_hotel']);
            $requete->BindParam(':company_id',$_SESSION['company_id']);
            $requete->BindParam(':montantusd',$montantusd);
            $requete->BindParam(':montantcdf',$montantcdf);
            $requete->BindParam(':taux',$tauxdollar);
            $requete->BindParam(':rendu',$rendu);
            $requete->execute();
            $paie_id = $bdd->lastInsertId();

            //Update etat t_facture
            $requete = $bdd->prepare("UPDATE t_facture  SET etat=:etat WHERE id_fact=:id_fact");
            $requete->BindParam(':etat',$etat_f);
            $requete->BindParam(':id_fact',$id_fact);
            $requete->execute();
            if($lib_mode=='Cash'){
                $type_vers='hergement';
                $motif=$service;
                $monaie_vers=$m_affiche;
                insertmontantVersement($_SESSION['id_user'],$dtereglement,$montantcdf,$montantusd,$monaie_vers,$type_vers,$tauxdollar,$motif,$paie_id,$_SESSION['id_hotel'],$bdd);

            }
            $json['reglement'] = True;
        }

    }elseif ($etat_fact == 'regler2'){
        if(empty($id_fact)){
            $json['error2'] =True;
            $json['error2_msg'] ='Veuillez sélectionner une facture!';
        }else if(empty($montantusd)&&empty($montantcdf)){
            $json['error2'] =True;
            $json['error2_msg'] ='Veuillez entrer le(s) montant(s)!';
        }
        else{
            $totalnuite= getTotalNuite($bdd,$id_res);
            if($montant_paye==0 && $montant<$totalnuite && $service=='hebergement'){
                $json['montant_nuite'] =afficheMontant($m_affiche, montant_equivalent_bdd(getsymbole_local(),$m_affiche,$tauxdollar,$totalnuite));
                $json['error'] =True;
            }  else {
                //Paiement
//        $paie_id=paiement($id_fact,$numero,$dtereglement,$_SESSION['id_user'],$_SESSION['id_hotel'],$_SESSION['company_id'], $montant,$montantusd,$montantcdf,$tauxdollar,$rendu,$remise, $mode, $justification, $id_monnaie, $bdd);
                $dtereglhr=date("Y-m-d H:i:s");
                $libelle1='HEBR';
                $num_cmd = getnumerotation($_SESSION['id_hotel'], $libelle1, $bdd);
                $numero = str_pad($num_cmd,5,"0", STR_PAD_LEFT);
                $requete = $bdd->prepare("INSERT INTO  t_reglement (numero,id_fact,date_regl,dte,id_user,id_hotel)
                                    VALUES(:numero,:id_fact,:date_regl,:dte,:id_user,:id_hotel)");
                $requete->BindParam(':numero',$numero);
                $requete->BindParam(':id_fact', $id_fact);
                $requete->BindParam(':date_regl',$dtereglhr);
                $requete->BindParam(':dte', $dtereglement);
                $requete->BindParam(':id_user', $_SESSION['id_user']);
                $requete->BindParam(':id_hotel',$_SESSION['id_hotel']);
                $requete->execute();
                $regl_id = $bdd->lastInsertId();
                $num_cmd+=1;
                setnumerotation($_SESSION['id_hotel'], $libelle1, $num_cmd, $bdd);
                /* Fin d'Insertion dans t_reglement */
                /* Insertion dans paiement */
                $requete = $bdd->prepare("INSERT INTO  paiement (montant,remise,justification,id_mode_regl,id_monnaie,regl_id,site_id,company_id,montantusd,montantcdf,taux,rendu)
                                    VALUES(:montant,:remise,:justification,:id_mode_regl,:id_monnaie,:regl_id,:id_hotel,:company_id,:montantusd,:montantcdf,:taux,:rendu)");
                $requete->BindParam(':montant',$montant);
                $requete->BindParam(':remise', $remise);
                $requete->BindParam(':justification', $justification);
                $requete->BindParam(':id_mode_regl', $mode);
                $requete->BindParam(':id_monnaie', $id_monnaie);
                $requete->BindParam(':regl_id', $regl_id);
                $requete->BindParam(':id_hotel',$_SESSION['id_hotel']);
                $requete->BindParam(':company_id',$_SESSION['company_id']);
                $requete->BindParam(':montantusd',$montantusd);
                $requete->BindParam(':montantcdf',$montantcdf);
                $requete->BindParam(':taux',$tauxdollar);
                $requete->BindParam(':rendu',$rendu);
                $requete->execute();
                $paie_id = $bdd->lastInsertId();

                //Update etat t_facture
                $requete = $bdd->prepare("UPDATE t_facture  SET etat=:etat WHERE id_fact=:id_fact");
                $requete->BindParam(':etat',$etat_f);
                $requete->BindParam(':id_fact',$id_fact);
                $requete->execute();
                if($lib_mode=='Cash'){
                    $type_vers='hergement';
                    $motif=$service;
                    $monaie_vers=$m_affiche;
                    insertmontantVersement($_SESSION['id_user'],$dtereglement,$montantcdf,$montantusd,$monaie_vers,$type_vers,$tauxdollar,$motif,$paie_id,$_SESSION['id_hotel'],$bdd);

                }
                //Mise en session des données
                $_SESSION['num_recu']=$numero;
                $_SESSION['mon_aff']=$m_affiche;
                if($m_affiche==getsymbole_devise()){
                    $montant=$montant/$tauxdollar;
                }
                $_SESSION['montant_paye']=$montant;
                $_SESSION['nom_client']=$_POST['nom_cl'];
				$_SESSION['motif_fact']=$motif_fact;
              //fin mise en session
                $json['reglement'] = True;
        }
        
        }

    }
}

echo json_encode($json);
