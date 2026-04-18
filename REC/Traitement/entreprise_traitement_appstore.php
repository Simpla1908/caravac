<?php

session_start();
include('../../bdd/connexion.php');
include '../../FUNCTION/reference.php';
include '../../FUNCTION/hebergement.php';
include '../../admin/traitement/fonctionalites.php';
if (isset($_POST["packs"])) {
    $nom_site = $_POST['site'];
    $adresse = $_POST['adresse'];
    $phone = $_POST['phone'];
    $rccm = $_POST['rccm'];
    $num_impot = $_POST['num_impot'];
    $ville = $_POST['ville'];
    $mail = $_POST['mail'];
    $id_nat = $_POST['id_nat'];
    $cb = $_POST['cb'];
    $companie_id = $_SESSION['company_id'];
    $user_id = $_SESSION['id_user'];

//upoload logo
//$extension= pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
    $file_name = $_FILES['logo']['name'];
    $extension = strrchr($file_name, ".");
    move_uploaded_file($_FILES['logo']['tmp_name'], '../images/logo_entreprise/' . basename($_FILES['logo']['name']));
    $stocklogo = 'logo_' . $nom_site . $extension;
    rename('../images/logo_entreprise/' . basename($_FILES['logo']['name']), '../images/logo_entreprise/' . $stocklogo);

//creation site
    $requete = $bdd->prepare("INSERT INTO t_hotel(nom_hotel,adresse_hotel,province_hotel,ville_hotel,etat,default_site,company_id,statut_site,idnat,rccm,mail,phone,num_impot,cb,image,nbre_user)
                     VALUES(:nom_hotel,:adresse_hotel,:province_hotel,:ville_hotel,:etat,:default,:company_id,:statut_site,:idnat,:rccm,:mail,:phone,:num_impot,:cb,:image,:nbre_user)");
//    $nom_hotel = $compagnie;
    $adresse_hotel = $adresse;
    $province_hotel = '';
    $ville_hotel = '';
    $etat=1;
    $default = 0;
    $nbre_user = 15;
    $statut_site = 'opérationnel';
    $requete->BindParam(':nom_hotel', $nom_site);
    $requete->BindParam(':adresse_hotel', $adresse);
    $requete->BindParam(':province_hotel', $province_hotel);
    $requete->BindParam(':ville_hotel', $ville);
    $requete->BindParam(':etat', $etat);
    $requete->BindParam(':default', $default);
    $requete->BindParam(':company_id', $companie_id);
    $requete->BindParam(':statut_site', $statut_site);
    $requete->BindParam(':idnat', $id_nat);
    $requete->BindParam(':rccm', $rccm);
    $requete->BindParam(':mail', $mail);
    $requete->BindParam(':phone', $phone);
    $requete->BindParam(':num_impot', $num_impot);
    $requete->BindParam(':cb', $cb);
    $requete->BindParam(':image', $stocklogo);
    $requete->BindParam(':nbre_user', $nbre_user);
    $requete->execute();
    $hotel_id = $bdd->lastInsertId();

//Données de base
    include('../../souscription/data_configuration.php');

//creation souscription
    $requete = $bdd->prepare("INSERT INTO souscription(compagny_id,libelle,date_sous,date_activ,dte_echeance,dte_blocage,dte_upgrade,mode_paie,montant_tot_sous,statut,etat,type_souscription,site_id)
                        VALUES(:compagny_id,:libelle,:date_sous,:date_activ,:dte_echeance,:dte_blocage,:dte_upgrade,:mode_paie,:montant_tot_sous,:statut,:etat_sous,:type_souscription,:site_id)");
    $libelle = 'SCT' . reference();
    $date_sous = date('Y-m-d');
    $date_activ =date('Y-m-d');
    $dte_upgrade=date('Y-m-d');
    $nbrejr=7;
    $month=1;
    $dte_echeance=AddMonthToDate($dte_upgrade,$month);
    $dte_blocage=AddDaysToDate($dte_echeance, $nbrejr);
    $montant_tot_sous = 0;
    $mode_paie = '';
    $statut = 'demo';
    $etat_sous =1;
    $type_souscription = 'mensuel';
    $requete->BindParam(':compagny_id', $companie_id);
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':date_sous', $date_sous);
    $requete->BindParam(':date_activ', $date_activ);
    $requete->BindParam(':dte_echeance', $dte_echeance);
    $requete->BindParam(':dte_blocage', $dte_blocage);
    $requete->BindParam(':dte_upgrade', $dte_upgrade);
    $requete->BindParam(':mode_paie', $mode_paie);
    $requete->BindParam(':montant_tot_sous', $montant_tot_sous);
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':etat_sous', $etat_sous);
    $requete->BindParam(':type_souscription', $type_souscription);
    $requete->BindParam(':site_id', $hotel_id);
    $requete->execute();
    $souscription = $bdd->lastInsertId();

//creation pack company & module company
    $N = count($_POST["packs"]);
    for ($i = 0; $i < $N; $i++) {
        $pack_id = $_POST["packs"][$i];
        $etat_pack = 1;
        $licence = "mensuel";
        $data = PrixPack($pack_id, $licence, $bdd);
        $prix_id = $data['id'];
        $requete = $bdd->prepare("INSERT INTO t_pack_company(pack_id,company_id,etat,prix_id,souscript_id,site_id)
                 VALUES(:pack_id,:company_id,:etat,:prix_id,:souscript_id,:site_id)");
        $requete->BindParam(':pack_id', $pack_id);
        $requete->BindParam(':company_id', $companie_id);
        $requete->BindParam(':etat', $etat_pack);
        $requete->BindParam(':prix_id', $prix_id);
        $requete->BindParam(':souscript_id', $souscription);
        $requete->BindParam(':site_id', $hotel_id);
        $requete->execute();
        $pack_company_id = $bdd->lastInsertId();
//nombre d'agent par defaut pour le pack ressources humaines
        $nbre_agent_rh = 0;
        if ($pack_id == 7) {
            $nbre_agent_rh = 10;
        }
//fin 
//insertion t_module_company
        $modules_packs = ModulesPack($pack_id, $bdd);
        $nbreuser = 0;
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
            $requete->BindParam(':site_id', $hotel_id);
            $requete->BindParam(':nbre_agent', $nbre_agent_rh);
            $requete->execute();

        endforeach;
//fin insertion
    }

    // On détruit les variables de notre session 
//        session_unset (); 
//    unset($_SESSION['actions']);
    $_SESSION['actions'] = array();
    $_SESSION['actions']['code_actions'] = array();
    $_SESSION['module'] = array();
    $_SESSION['module']['code_module'] = array();
    //recuperation de tout le modules souscript
    $requete = $bdd->prepare("SELECT DISTINCT c.module_id,m.code
                            FROM  t_modulecompany AS c,souscription AS s,module AS m
                            WHERE c.etat_module=1 AND c.company_id=:id_c AND c.site_id=:id_site AND c.souscription_id=s.id AND s.etat=1 AND c.module_id=m.id");
    $requete->BindParam(':id_c', $_SESSION['company_id']);
    $requete->BindParam(':id_site', $hotel_id);
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

//mise en session des donnees
    $_SESSION['entreprise']  =$nom_site ;
    $_SESSION['adresse'] = $adresse;
    $_SESSION['phone'] = $phone;
    $_SESSION['rccm'] = $rccm;
    $_SESSION['num_impot'] = $num_impot;
    $_SESSION['ville'] = $ville;
    $_SESSION['mail'] = $mail;
    $_SESSION['id_nat'] = $id_nat;
    $_SESSION['stocklogo'] = $stocklogo;
    $_SESSION['id_site'] = $hotel_id;
    $_SESSION['cb'] = $cb;
    $_SESSION['id_hotel'] = $hotel_id;
    $_SESSION['nom_hotel'] = $nom_site;
    header('location:../tableaudebordRec.php');
}

