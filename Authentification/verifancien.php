<?php

// Initialisation de la session
session_start();

//Fusion horaire
date_default_timezone_set('Africa/Kinshasa');

// Inclusion du fichier contenant la connexion à la base
require '../bdd/connexion.php';
include('../lib/password_compat-master/lib/password.php');
include('../FUNCTION/hebergement.php');
include '../admin/traitement/fonctionalites.php';
$json = array();
// Si on a reçu les données d’un formulaire :
$_SESSION['company_id'] =0;
if (isset($_POST['pseudo']) && isset($_POST['motdepasse'])) {
    // On les récupère
    $compte = trim($_POST['pseudo']);
    $motdepasse = trim($_POST['motdepasse']);

    $_SESSION['actions'] = array();
    $_SESSION['actions']['code_actions'] = array();
    $_SESSION['module'] = array();
    $_SESSION['module']['code_module'] = array();

    //$user_exist =0;
    // Selection de user sur base de login et mdp
    $requete = $bdd->prepare("SELECT * FROM t_utilisateur AS u,t_hotel AS st,t_company AS cp WHERE u.id_hotel=st.id_hotel AND u.company_id=cp.id_c AND u.email_user=:login_sql ");
    $requete->BindParam(':login_sql', $compte);
    $requete->execute();
    $user = $requete->fetchAll(PDO::FETCH_OBJ);
    $hash = '';
    $module_dflt ='';
    foreach ($user as $u)
        $hash = $u->mdp_user;
    //echo '$motdepasse'.$motdepasse.'<br>';
    // echo '$hash'.$hash.'<br>';
    if ($hash = !'' && password_verify($motdepasse, $hash)) {
        //identifiant ou mot de passe corecte
        // echo 'Le mot de passe est valide !';
        foreach ($user as $u) {
            $id_user = $u->id_user;
            //si c'est superadmin
            if ($u->type == 1) {
                //company actif
                if ($u->etat == 1) {
                    //verification si aumoins un site est activé
                    include 'compteur_sites.php';

                    if ($nbrsiteactif > 0) {
                        //user actif
                        if ($u->actif == 1) {
                            $_SESSION['pos_id']=0;
                            $_SESSION['id_hotel'] = $u->id_hotel;
                            $_SESSION['nom_hotel'] = $u->nom_hotel;
                            $_SESSION['id_user'] = $u->id_user;
                            $_SESSION['user'] = $u->email_user;
                            $_SESSION['nom_user'] = $u->nom_user;
                            $_SESSION['prenom_user'] = $u->prenom_user;
                            $_SESSION['role'] = '';
                            $_SESSION['droits'] = '';
                            $_SESSION['libe_droit'] = ' ';
                            $_SESSION['type_user'] = $u->type;
                            $_SESSION['fconnect'] = $u->fconnect;
                            $_SESSION['company_id'] = $u->company_id;
                            $_SESSION['company_name'] = $u->nom_c;
                            $_SESSION['pointage'] = $u->pointage;
                            //Mise en session de la date et heure de connexion
                            $date_con = date('Y-m-d H:i:s');
                            $_SESSION['date_con'] = $date_con;
                            //mise a jours du champs connect
                            $requete = $bdd->prepare("UPDATE t_utilisateur SET connect=1 WHERE id_user=:id_user");
                            $requete->BindParam(':id_user', $id_user);
                            $requete->execute();

                            //recuperation de tout le modules souscript
                            $requete = $bdd->prepare("SELECT DISTINCT c.module_id,m.code
                                                    FROM  t_modulecompany AS c,souscription AS s,module AS m
                                                    WHERE c.etat_module=1 AND c.company_id=:id_c AND c.site_id=:id_site AND c.souscription_id=s.id AND s.etat=1 AND c.module_id=m.id");
                            $requete->BindParam(':id_c', $u->company_id);
                            $requete->BindParam(':id_site', $u->id_hotel);
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
                            //var_dump($_SESSION['module']['code_module']);
                            include '../REC/Amelioration/reglage/monnaie.php';
                            $_SESSION['monnaie'] = $site_monnaie_id;
                            //Mise en session des reglages
                            //include '../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
                            //PAIE
                            $_SESSION['idsite']=$_SESSION['id_hotel'];
                            $requete = $bdd->prepare("SELECT * FROM resconfig  WHERE site_id=:id");
                            $requete->BindParam(':id',$_SESSION['idsite']);
                            $requete->execute();
                            $configpaie = $requete->fetch(PDO::FETCH_OBJ);
                            $_SESSION['hezecom_users']='admin';
                            $_SESSION['Paie_insert']=$configpaie->m_insert;
                            $_SESSION['Paie_affiche']=$configpaie->m_affich;
                            $_SESSION['Paie_taux']=$configpaie->taux;
                            $_SESSION['Age_Lmt_Enfant_Bm']=$configpaie->age;
                            $_SESSION['config_id']=$configpaie->id;
                             $_SESSION['hopital_compagni']=$configpaie->hopital;
                            $_SESSION['penalite']=$configpaie->penalite;
                            $_SESSION['prefconge']=$configpaie->prefconge;
                            $_SESSION['prefsanct']=$configpaie->prefsanct;
                            $_SESSION['tva']=$configpaie->tva;
                           // echo'superadmin';
                            $json['message'] = 'superadmin';
                        } else {
                            //user inactif
                           // echo'userinactif';
                            $json['message'] = 'userinactif';
                        }
                    } else {
                        //user aucunsite
                        //echo'aucunsite';
                        $json['message'] = 'aucunsite';

                    }
                } else {
                    //company inactif
                    //echo'companyinactif';
                     $json['message'] = 'companyinactif';

                }
            } else {

                $requete = $bdd->prepare("SELECT * FROM t_hotel AS h, t_utilisateur AS u WHERE h.id_hotel=u.id_hotel AND u.id_user=:user_id");
                $requete->BindParam(':user_id', $id_user);
                $requete->execute();
                $site = $requete->fetchAll(PDO::FETCH_OBJ);
                foreach ($site as $st) {
                    $id_site = $st->id_hotel;
                    $nom_site = $st->nom_hotel;
                    $adresse_hotel = $st->adresse_hotel;
                    $province_hotel = $st->province_hotel;
                    $ville_hotel = $st->ville_hotel;
                    $etat_site = $st->etat;
                    $id_utilisateur = $st->id_user;
                    $module_dflt = $st->module_dflt;
                    //Autres informations
                    $idnat = $st->idnat;
                    $rccm = $st->rccm;
                    $mail = $st->mail;
                    $phone = $st->phone;
                    //fin
                }
                //si c'est user ordinaire
                if ($u->etat == 1) {
                    //company actif
                    if ($etat_site == 1) {
                        //hotel actif
                        if ($u->actif == 1) {
                            //user actif
                            $_SESSION['pos_id']=$u->pos_id;
                            $_SESSION['id_hotel'] = $id_site;
                            $_SESSION['nom_hotel'] = $nom_site;
                            $_SESSION['id_user'] = $id_utilisateur;
                            $_SESSION['user'] = $u->email_user;
                            $_SESSION['nom_user'] = $u->nom_user;
                            $_SESSION['prenom_user'] = $u->prenom_user;
                            $_SESSION['role'] = '';
                            $_SESSION['droits'] = '';
                            $_SESSION['libe_droit'] = ' ';
                            $_SESSION['type_user'] = $u->type;
                            $_SESSION['company_id'] = $u->company_id;
                            $_SESSION['company_name'] = $u->nom_c;
                            $_SESSION['company_logo'] = $u->logo;
                            //Autres informations
                            $_SESSION['adresse_hotel'] = $adresse_hotel;
                            $_SESSION['province_hotel'] = $province_hotel;
                            $_SESSION['ville_hotel'] = $ville_hotel;
                            $_SESSION['idnat'] = $idnat;
                            $_SESSION['rccm'] = $rccm;
                            $_SESSION['mail'] = $mail;
                            $_SESSION['phone'] = $phone;
                            $_SESSION['pointage'] = $u->pointage;
                            //fin
                            $id_user = $u->id_user;


                            $requete = $bdd->prepare("SELECT * FROM users_groupes AS ug WHERE  ug.user_id=:user_id");
                            $requete->BindParam(':user_id', $id_user);
                            $requete->execute();
                            $groupe = $requete->fetchAll(PDO::FETCH_OBJ);
                            foreach ($groupe as $grp) {
                                $group_id = $grp->group_id;
                                //recuperation de toutes les actions du groupe
                                //                $requete = $bdd->prepare("SELECT a.code_act FROM actions AS a,actions_groupe AS ag,t_modulecompany AS mc,module AS m WHERE mc.module_id=m.id AND mc.etat_module=1 AND ag.action_id=a.id_act AND ag.group_id=:group_id");
                                $requete = $bdd->prepare("SELECT a.code_act FROM actions AS a,actions_groupe AS ag,module m WHERE ag.action_id=a.id_act AND a.module_id=m.id AND ag.group_id=:group_id AND a.module_id IN(SELECT m.id FROM module m,t_modulecompany AS mc WHERE mc.module_id=m.id AND mc.etat_module=1)");
                                $requete->BindParam(':group_id', $group_id);
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
                            //Mise en session de la date et heure de connexion
                            $date_con = date('Y-m-d H:i:s');
                            $_SESSION['date_con'] = $date_con;
                            //Mise en session de la monnaie
                            include '../REC/Amelioration/reglage/monnaie.php';
                            $_SESSION['monnaie'] = $site_monnaie_id;
                            //Mise en session des reglages
                            //include '../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
                            //PAIE
                             $_SESSION['idsite'] = $_SESSION['id_hotel'];
                             $requete = $bdd->prepare("SELECT * FROM resconfig  WHERE site_id=:id");
                             $requete->BindParam(':id', $_SESSION['idsite']);
                             $requete->execute();
                             $configpaie = $requete->fetch(PDO::FETCH_OBJ);
                             $_SESSION['hezecom_users'] = 'admin';
                             $_SESSION['Paie_insert'] = $configpaie->m_insert;
                             $_SESSION['Paie_affiche'] = $configpaie->m_affich;
                             $_SESSION['Paie_taux'] = $configpaie->taux;
                             $_SESSION['Age_Lmt_Enfant_Bm'] = $configpaie->age;
                             $_SESSION['config_id'] = $configpaie->id;
                             $_SESSION['hopital_compagni'] = $configpaie->hopital;
                             $_SESSION['penalite'] = $configpaie->penalite;
                             $_SESSION['prefconge'] = $configpaie->prefconge;
                             $_SESSION['prefsanct'] = $configpaie->prefsanct;
                             $_SESSION['tva'] = $configpaie->tva;
                           // echo'user';
                           $json['message'] = 'user';
                           $json['moduledflt'] =$module_dflt;

                        } else {
                            //user inactif
                            //echo'userinactif';
                            $json['message'] = 'userinactif';
                        }
                    } else {
                        //hotel inactif
                        //echo'siteinactif';
                        $json['message'] = 'siteinactif';

                    }
                } else {
                    //company inactif
                    //echo'companyinactif';
                    $json['message'] = 'companyinactif';

                }
            }
        }
        
        //Blocage souscription
//        BlocageScrptCompany($_SESSION['company_id'], $bdd);
//        GenererFactCompany($_SESSION['company_id'], $bdd);
        
    } else {
        //identifiant ou mot de passe incorecte
        //echo'idmpdincorect';
        $json['message'] = 'idmpdincorect';

    }
    
      $_SESSION['user'] =  $_SESSION['nom_user'].' '. $_SESSION['prenom_user'];                   
echo json_encode($json);
}

