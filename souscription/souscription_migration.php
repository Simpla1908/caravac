<?php

// session_start();
// $json = array();
// include('../bdd/connexion.php');
// include '../FUNCTION/reference.php';
// include '../FUNCTION/hebergement.php';
// include '../admin/traitement/fonctionalites.php';
// include '../lib/password_compat-master/lib/password.php';
// require_once '../PHPMailer/class.phpmailer.php';
// include '../FUNCTION/envoi_mail.php';
//    //Recuperation des données du form
//     $nom ='amene';
//     $prenom ='amene';
//     $sexe ='masculin';
//     $adresse ='41, Avenue Comité Urbain,C/Gombe';
//     $tel ='0818585806';
//     $email ='';
//     $login = 'amene';
//     $mdp = 'amene';
//     $pack_id =5;
//     $compagnie ='AMENE MOI A LA MONTAGNE';
//     //fin recuperation
             
//         //creation company
//         $requete = $bdd->prepare("INSERT INTO t_company(nom_c,etat,adresse_c,logo,idnat,rccm)
//                              VALUES(:nom_c,:etat,:adresse_c,:logo,:idnat,:rccm)");
//         $nom_c = $compagnie;
//         $etat =1;
//         $adresse_c = $adresse;
//         $logo = 'logo_AMENE MOI A LA MONTAGNE178.jpg';
//         $idnat = '01-93-N28854G';
//         $rccm = '18-A-00360';
//         $requete->BindParam(':nom_c', $nom_c);
//         $requete->BindParam(':etat', $etat);
//         $requete->BindParam(':adresse_c', $adresse_c);
//         $requete->BindParam(':logo', $logo);
//         $requete->BindParam(':idnat', $idnat);
//         $requete->BindParam(':rccm', $rccm);
//         $requete->execute();
//         $companie_id = $bdd->lastInsertId();
        
//         //creation site
//         $requete = $bdd->prepare("INSERT INTO t_hotel(nom_hotel,adresse_hotel,province_hotel,ville_hotel,default_site,company_id,statut_site,nbre_user)
//                              VALUES(:nom_hotel,:adresse_hotel,:province_hotel,:ville_hotel,:default,:company_id,:statut_site,:nbre_user)");
//         $nom_hotel = $compagnie;
//         $adresse_hotel = $adresse;
//         $province_hotel = 'Kinshasa';
//         $ville_hotel = 'Kinshasa';
//         $default = 1;
//         $statut_site = 'opérationnel';
//         $nbre_user =15;
//         $requete->BindParam(':nom_hotel', $nom_hotel);
//         $requete->BindParam(':adresse_hotel', $adresse_hotel);
//         $requete->BindParam(':province_hotel', $province_hotel);
//         $requete->BindParam(':ville_hotel', $ville_hotel);
//         $requete->BindParam(':default', $default);
//         $requete->BindParam(':company_id', $companie_id);
//         $requete->BindParam(':statut_site', $statut_site);
//         $requete->BindParam(':nbre_user', $nbre_user);

//         $requete->execute();
//         $hotel_id = $bdd->lastInsertId();
        
//         //creation utilisateur
//         $requete = $bdd->prepare(
//                 "INSERT INTO t_utilisateur (nom_user,prenom_user,sexe_user,telephone_user,email_user,mdp_user,type,actif,id_hotel,company_id,id_droit,fconnect,adresse_mail)
//                 VALUES(:nom_user,:prenom_user,:sexe_user,:telephone_user,:email_user,:mdp_user,:type,:actif,:id_hotel,:company_id,:id_droit,:fconnect,:adresse_mail)");

//         $nom_user = $nom;
//         $prenom_user = $prenom;
//         $sexe_user = $sexe;
//         $telephone_user = $tel;
//         $email_user = $login;
//         $mdp_user = password_hash($mdp, PASSWORD_DEFAULT);
//         //$mdp_user=$_SESSION['mdp'];
//         $adresse_mail = $email;
//         $type = 1;
//         $actif = 1;
//         //Mise à jour id_hotel dans la table user(n'est doit pas etre NULL)
//         $id_hotel = $hotel_id;
//         $id_droit = 1;
//         $fconnect = 0;
//         $requete->BindParam(':nom_user', $nom_user);
//         $requete->BindParam(':prenom_user', $prenom_user);
//         $requete->BindParam(':sexe_user', $sexe_user);
//         $requete->BindParam(':telephone_user', $telephone_user);
//         $requete->BindParam(':email_user', $email_user);
//         $requete->BindParam(':mdp_user', $mdp_user);
//         $requete->BindParam(':type', $type);
//         $requete->BindParam(':actif', $actif);
//         $requete->BindParam(':id_hotel', $id_hotel);
//         $requete->BindParam(':company_id', $companie_id);
//         $requete->BindParam(':id_droit', $id_droit);
//         $requete->BindParam(':fconnect', $fconnect);
//         $requete->BindParam(':adresse_mail', $adresse_mail);
//         $requete->execute();
//         $user_id = $bdd->lastInsertId();

//         //creation souscription
//         $requete = $bdd->prepare("INSERT INTO souscription(compagny_id,libelle,date_sous,date_activ,dte_echeance,dte_blocage,dte_upgrade,mode_paie,montant_tot_sous,statut,type_souscription,site_id)
//                                 VALUES(:compagny_id,:libelle,:date_sous,:date_activ,:dte_echeance,:dte_blocage,:dte_upgrade,:mode_paie,:montant_tot_sous,:statut,:type_souscription,:site_id)");
//         $libelle = 'SCT' . reference();
//         $date_sous = date('Y-m-d');
//         $date_activ = $date_sous;
//         $dte_upgrade=date('Y-m-d');
//         $nbrejr=7;
//         $month=1;
//         $dte_echeance=AddMonthToDate($dte_upgrade,$month);
//         $dte_blocage=AddDaysToDate($dte_echeance, $nbrejr);
//         $montant_tot_sous = 0;
//         $mode_paie='';
//         $statut='abonne';
//         $type_souscription='annuel';
//         $requete->BindParam(':compagny_id', $companie_id);
//         $requete->BindParam(':libelle', $libelle);
//         $requete->BindParam(':date_sous', $date_sous);
//         $requete->BindParam(':date_activ', $date_activ);
//         $requete->BindParam(':dte_echeance', $dte_echeance);
//         $requete->BindParam(':dte_blocage', $dte_blocage);
//          $requete->BindParam(':dte_upgrade', $dte_upgrade);
//         $requete->BindParam(':mode_paie', $mode_paie);
//         $requete->BindParam(':montant_tot_sous', $montant_tot_sous);
//         $requete->BindParam(':statut', $statut);
//         $requete->BindParam(':type_souscription', $type_souscription);
//         $requete->BindParam(':site_id', $id_hotel);
//         $requete->execute();
//         $souscription = $bdd->lastInsertId();
//         //creation pack company & module company
//        //$nb = count($_SESSION['souscri']['module']);
            
           
//             $etat_pack = 0;
//             $licence="annuel";
//             $data = PrixPack($pack_id,$licence,$bdd);
//             $prix_id = $data['id'];
//             $requete = $bdd->prepare("INSERT INTO t_pack_company(pack_id,company_id,etat,prix_id,souscript_id,site_id)
//                              VALUES(:pack_id,:company_id,:etat,:prix_id,:souscript_id,:site_id)");
//             $requete->BindParam(':pack_id', $pack_id);
//             $requete->BindParam(':company_id', $companie_id);
//             $requete->BindParam(':etat', $etat_pack);
//             $requete->BindParam(':prix_id', $prix_id);
//             $requete->BindParam(':souscript_id', $souscription);
//             $requete->BindParam(':site_id', $id_hotel);
//             $requete->execute();
//             $pack_company_id = $bdd->lastInsertId();
//             //nombre d'agent par defaut pour le pack ressources humaines
//             $nbre_agent_rh=0;
//             if ($_POST["pack_id"] == 7) {
//                $nbre_agent_rh=10;
//             }
//             //fin 
//             //insertion t_module_company
//             $modules_packs = ModulesPack($pack_id, $bdd);
//             $nbreuser =0;
//             $nbre_user_maj = $nbreuser;

//             foreach ($modules_packs as $mp):
//                 $module_id = $mp->idmodule;
//                 $etat_module = 1;
//                 $montantmodule = 0;
//                 $requete = $bdd->prepare(
//                         "INSERT INTO t_modulecompany(nbreuser,nbre_user_maj,etat_module,montantmodule,prix_id,pack_id,company_id,module_id,souscription_id,date_sous,site_id,nbre_agent)
//     VALUES(:nbreuser,:nbre_user_maj,:etat_module,:montantmodule,:prix_id,:pack_id,:company_id,:module_id,:souscription_id,:date_sous,:site_id,:nbre_agent)");
//                 $requete->BindParam(':nbreuser', $nbreuser);
//                 $requete->BindParam(':nbre_user_maj', $nbre_user_maj);
//                 $requete->BindParam(':etat_module', $etat_module);
//                 $requete->BindParam(':montantmodule', $montantmodule);
//                 $requete->BindParam(':prix_id', $prix_id);
//                 $requete->BindParam(':pack_id', $pack_company_id);
//                 $requete->BindParam(':company_id', $companie_id);
//                 $requete->BindParam(':module_id', $module_id);
//                 $requete->BindParam(':souscription_id', $souscription);
//                 $requete->BindParam(':date_sous', $date_sous);
//                 $requete->BindParam(':site_id', $hotel_id);
//                 $requete->BindParam(':nbre_agent', $nbre_agent_rh);
//                 $requete->execute();

//             endforeach;
//             //fin insertion
         
//         //RESPONSABLE PAR DEFAUT
//         $requete=$bdd->prepare("INSERT INTO t_responsable(nom_respo,telephone_respo,email,adresse_respo,entreprise,filtre,company_id)
//                                  VALUES(:nom_respo,:telephone_respo,:email,:adresse_respo,:entreprise,:filtre,:company_id)");
//         $nom_respo='prive';
//         $telephone_respo='';
//         $email2='';
//         $adresse_respo='';
//         $telephone_respo='';
//         $adresse_respo='';
//         $entreprise='prive';
//         $filtre=0;
//         $requete->BindParam(':nom_respo',$nom_respo);
//         $requete->BindParam(':telephone_respo',$telephone_respo);
//         $requete->BindParam(':email',$email2);
//         $requete->BindParam(':adresse_respo',$adresse_respo);
//         $requete->BindParam(':entreprise',$entreprise);
//         $requete->BindParam(':filtre', $filtre);
//         $requete->BindParam(':company_id',$companie_id);
//         $requete->execute(); 
//         //Données de base
//         include('data_configuration.php');
//         //envoie mail au client
//        echo 'Souscription effectuée avec succes';
//      