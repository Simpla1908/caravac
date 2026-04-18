<?php

session_start();
$json = array();
include('../../bdd/connexion.php');
include '../../FUNCTION/hebergement.php';
include '../../FUNCTION/reference.php';
include '../../admin/traitement/fonctionalites.php';
// require_once '../PHPMailer/class.phpmailer.php';
// include '../FUNCTION/envoi_mail.php';
    if (isset($_POST["packs"])){
        $companie_id=$_SESSION['company_id'];
        $id_hotel=$_SESSION['id_hotel'];
        //creation souscription
        $requete = $bdd->prepare("INSERT INTO souscription(compagny_id,libelle,date_sous,date_activ,dte_echeance,dte_blocage,dte_upgrade,mode_paie,montant_tot_sous,statut,etat,type_souscription,site_id)
                                VALUES(:compagny_id,:libelle,:date_sous,:date_activ,:dte_echeance,:dte_blocage,:dte_upgrade,:mode_paie,:montant_tot_sous,:statut,:etat,:type_souscription,:site_id)");
        $libelle = 'SCT' . reference();
        $date_sous = date('Y-m-d');
        $date_activ = date('Y-m-d');
        $montant_tot_sous = 0;
        $mode_paie='';
        $statut='demo';
        $etat=1;
        $type_souscription='mensuel';
        $dte_upgrade=date('Y-m-d');
        $nbrejr=7;
        $month=1;
        $dte_echeance=AddMonthToDate($dte_upgrade,$month);
        $dte_blocage=AddDaysToDate($dte_echeance, $nbrejr);
        $requete->BindParam(':compagny_id',$companie_id);
        $requete->BindParam(':libelle', $libelle);
        $requete->BindParam(':date_sous', $date_sous);
        $requete->BindParam(':date_activ', $date_activ);
        $requete->BindParam(':dte_echeance', $dte_echeance);
        $requete->BindParam(':dte_blocage', $dte_blocage);
        $requete->BindParam(':dte_upgrade', $dte_upgrade);
        $requete->BindParam(':mode_paie', $mode_paie);
        $requete->BindParam(':montant_tot_sous', $montant_tot_sous);
        $requete->BindParam(':statut', $statut);
        $requete->BindParam(':etat', $etat);
        $requete->BindParam(':type_souscription', $type_souscription);
        $requete->BindParam(':site_id',$id_hotel);
        $requete->execute();
        $souscription = $bdd->lastInsertId();
        //creation pack company & module company
       //$nb = count($_SESSION['souscri']['module']);
            $N = count($_POST["packs"]);
            for ($i = 0; $i < $N; $i++) {
            $pack_id = $_POST["packs"][$i];
            $etat_pack = 0;
            $licence="mensuel";
            $data = PrixPack($pack_id,$licence,$bdd);
            $prix_id = $data['id'];
            $requete = $bdd->prepare("INSERT INTO t_pack_company(pack_id,company_id,etat,prix_id,souscript_id,site_id)
                             VALUES(:pack_id,:company_id,:etat,:prix_id,:souscript_id,:site_id)");
            $requete->BindParam(':pack_id', $pack_id);
            $requete->BindParam(':company_id', $companie_id);
            $requete->BindParam(':etat', $etat_pack);
            $requete->BindParam(':prix_id', $prix_id);
            $requete->BindParam(':souscript_id', $souscription);
            $requete->BindParam(':site_id', $id_hotel);
            $requete->execute();
            $pack_company_id = $bdd->lastInsertId();
            //nombre d'agent par defaut pour le pack ressources humaines
            $nbre_agent_rh=0;
            if ($pack_id == 7) {
               $nbre_agent_rh=10;
            }
            //fin 
            //insertion t_module_company
            $modules_packs = ModulesPack($pack_id, $bdd);
            $nbreuser =0;
            $nbre_user_maj = $nbreuser;

            foreach ($modules_packs as $mp):
                $module_id = $mp->idmodule;
                $etat_module = 1;
                $montantmodule = 0;
                $requete = $bdd->prepare(
                        "INSERT INTO t_modulecompany(nbreuser,nbre_user_maj,etat_module,montantmodule,prix_id,pack_id,company_id,module_id,souscription_id,date_sous,site_id,nbre_agent)
    VALUES(:nbreuser,:nbre_user_maj,:etat_module,:montantmodule,:prix_id,:pack_id,:company_id,:module_id,:souscription_id,:date_sous,:site_id,:nbre_agent)");
                $requete->BindParam(':nbreuser', $nbreuser);
                $requete->BindParam(':nbre_user_maj', $nbre_user_maj);
                $requete->BindParam(':etat_module', $etat_module);
                $requete->BindParam(':montantmodule', $montantmodule);
                $requete->BindParam(':prix_id', $prix_id);
                $requete->BindParam(':pack_id', $pack_company_id);
                $requete->BindParam(':company_id', $companie_id);
                $requete->BindParam(':module_id', $module_id);
                $requete->BindParam(':souscription_id', $souscription);
                $requete->BindParam(':date_sous', $date_sous);
                $requete->BindParam(':site_id', $id_hotel);
                $requete->BindParam(':nbre_agent', $nbre_agent_rh);
                $requete->execute();

            endforeach;
            //fin insertion
        }
        //recuperation de tout le modules souscript
    $requete = $bdd->prepare("SELECT DISTINCT c.module_id,m.code
                            FROM  t_modulecompany AS c,souscription AS s,module AS m
                            WHERE c.etat_module=1 AND c.company_id=:id_c AND c.site_id=:id_site AND c.souscription_id=s.id AND s.etat=1 AND c.module_id=m.id");
    $requete->BindParam(':id_c', $_SESSION['company_id']);
    $requete->BindParam(':id_site',$_SESSION['id_hotel']);
    $requete->execute();
    $modules = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($modules as $mod) {
        $module_id = $mod->module_id;
        $module_code = $mod->code;
         if (!in_array($module_code, $_SESSION['module']['code_module'])) {
                array_push($_SESSION['module']['code_module'], $module_code);
         }
        //recuperation de toutes les actions des modules
        $requete = $bdd->prepare("SELECT a.code_act FROM actions AS a WHERE a.module_id=:module_id");
        $requete->BindParam(':module_id', $module_id);
        $requete->execute();
        $operations = $requete->fetchAll(PDO::FETCH_OBJ);
        $i = 0;

        foreach ($operations as $op) {
            $actions = $op->code_act;
            if (!in_array($actions, $_SESSION['actions']['code_actions'])) {
                array_push($_SESSION['actions']['code_actions'], $actions);
            }
            $i++;
        }
    }

        //envoie mail au client
        //include './mail_souscription.php';
        //fin envoie
        $json['message'] = 'succes';
    }else{
        $json['message'] = 'aucun';
    }
        echo json_encode($json);
