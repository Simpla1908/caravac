<?php
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
session_start();
include '../bdd/connexion.php';
include '../../FUNCTION/hebergement.php';
include '../../FUNCTION/stock.php';
include '../../FUNCTION/restaurant.php';
include '../../language/eng.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include './Panier.php';
$taux_op = $_SESSION['taux_op'];
$tauxdollar = $_SESSION['tauxdollar'];
$json = array();
$json['succes'] = False;
$json['bc'] = false;
$json['bar'] = false;
$id_cmd = $_GET['id_cmd'];
$idfactcl = $_GET['idfactcl'];
$id_client = $_GET['id_client'];
$idrescl = $_GET['idrescl'];
$nom_client = $_GET['nom_client'];
$dte = date('Y-m-d');
$date_h_com = date('Y-m-d H:i:s');
$_SESSION['date_edition2'] = $date_h_com;
$taux_op = $_SESSION['taux_resto'];
$monnaie = getsymbole_local();
$libelle = 'restaurant';
$cuisine = 0;
$bar = 0;
$idcommande = 0;
$lignecmd_id = 0;
$cuisson_nom = '';
$sauce_nom = '';
$accomp = '';
$sel_nom = '';
$panier = new Panier();
$nbrcouvert = $_GET['nbrcouvert'];
$user_attente = $_GET['user_attente'];
$agent = $_SESSION['prenom_user'] . ' ' . $_SESSION['nom_user'];
$note_cmd = $_GET['note_cmd'];
$id_serveur = $_GET['id_serveur'];
$name_serveur = $_GET['name_serveur'];
$syn = 1;
global $appear_state;
global $none_state;
global $unmerge_bill_id;
$none_state = NULL;
$appear_state=1;
if (isset($id_client) && !empty($id_client)) {
    $nbArticles = count($_SESSION['panier']['id_article']);
    if ($nbArticles > 0) {
        if ($id_cmd == 0) {
            $type = $libelle;
            $num_cmd = getnumerotation($_SESSION['id_hotel'], $libelle, $bdd);
            $num_cmd_format = format_numero($num_cmd);
            $mont_commande = $panier->montant_panier();
            $res_ch_id = $_GET['res_ch_id'];
            if ($res_ch_id == 0) {
                $res_ch_id = NULL;
            }
            $mont_ttc = $_SESSION['panier']['mont_ttc_remise'];
            $montant_remise = $_SESSION['panier']['mont_remise'];
            $montant_tva = $_SESSION['panier']['mont_tva'];
            $etat = '0'; //non payé
            $etat_cmd = '1'; //signifie commande en attente
            /* Insertion dans t_reservation */
            if ($idrescl == 0) {
                $requete = $bdd->prepare("INSERT INTO t_reservation (id_client,num_reserv,type,dte,monnaie,id_hotel,statut_res)
			            VALUES(:id_client,:num_reserv,:type,:dte,:monnaie,:id_hotel,:statut_res)");
                $requete->BindParam(':id_client', $id_client);
                $requete->BindParam(':num_reserv', $num_cmd_format);
                $requete->BindParam(':type', $libelle);
                $requete->BindParam(':dte', $dte);
                $requete->BindParam(':monnaie', $monnaie);
                $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                $requete->BindParam(':statut_res', $libelle);
                $requete->execute();
                $id_res = $bdd->lastInsertId();
            } else {
                $id_res = $idrescl;
            }
            //UPDATE t_client
            $en_attente = 1;
            $user_attente = $_SESSION['id_user'];
            $depot_id = $_SESSION['depot_id'];
            $statut = "occupe";
            $requete = $bdd->prepare("UPDATE t_client  SET statut=:statut,en_attente=:en_attente,user_attente=:user_attente,nbrcouvert=:nbrcouvert,idsousdepotfact =:idsousdepotfact  WHERE id_client=:client_id");
            $requete->BindParam(':en_attente', $en_attente);
            $requete->BindParam(':statut', $statut);
            $requete->BindParam(':user_attente', $_SESSION['id_user']);
            $requete->BindParam(':nbrcouvert', $nbrcouvert);
            $requete->BindParam(':client_id', $id_client);
            $requete->BindParam(':idsousdepotfact', $depot_id);
            $requete->execute();

            /* Fin insertion dans t_reservation */
            /* Insertion dans t_facture */
            
            $requete = $bdd->prepare("INSERT INTO t_facture (type,num_fact,id_res,taux,taux_prix,tva,monnaie,date_edition,id_client,id_user,id_hotel,id_sousresto,company_id,mont_tva,remise,mont_ttc_remise,mont_ttc,res_ch_id,etat,etat_cmd,dte_time,nbrcouvert,note_cmd,syn,serveur_id,serveur_name, appear_state, mode)
                                        VALUES(:type,:num_fact,:id_res,:taux,:taux_prix,:tva,:monnaie,:date_edition,:id_client,:id_user,:id_hotel,:id_sousresto,:company_id,:mont_tva,:remise,:mont_ttc_remise,:mont_ttc,:res_ch_id,:etat,:etat_cmd,:dte_time,:nbrcouvert,:note_cmd,:syn,:serveur_id,:serveur_name,:appear_state,:mode)");
            $requete->BindParam(':type', $type);
            $requete->BindParam(':num_fact', $num_cmd_format);
            $requete->BindParam(':id_res', $id_res);
            $requete->BindParam(':taux', $taux_op);
            $requete->BindParam(':taux_prix', $tauxdollar);
            $requete->BindParam(':tva', $tva);
            $requete->BindParam(':monnaie', $m_affiche);
            $requete->BindParam(':date_edition', $dte);
            $requete->BindParam(':id_client', $id_client);
            $requete->BindParam(':id_user', $_SESSION['id_user']);
            $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
            $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
            $requete->BindParam(':company_id', $_SESSION['company_id']);
            $requete->BindParam(':mont_tva', $montant_tva);
            $requete->BindParam(':remise', $montant_remise);
            $requete->BindParam(':mont_ttc_remise', $_SESSION['panier']['remise']);
            $requete->BindParam(':mont_ttc', $mont_ttc);
            $requete->BindParam(':res_ch_id', $res_ch_id);
            $requete->BindParam(':etat', $etat);
            $requete->BindParam(':etat_cmd', $etat_cmd);
            $requete->BindParam(':dte_time', $date_h_com);
            $requete->BindParam(':nbrcouvert', $nbrcouvert);
            $requete->BindParam (':note_cmd', $note_cmd);
            $requete->BindParam(':syn',$syn);
            $requete->BindParam(':serveur_id',$id_serveur);
            $requete->BindParam(':serveur_name',$name_serveur);
            $requete->BindParam(':appear_state',$appear_state);
            $requete->BindParam(':mode', $none_state);
            $requete->execute();
            $id_fact = $bdd->lastInsertId();
            $idcommande = $id_fact;
            /* Fin d'Insertion dans t_facture */
            /* Insertion dans lignes_commandes */
            $nbArticles = count($_SESSION['panier']['id_article']);

            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                $repas = $_SESSION['panier']['repas'][$i];
                $description = $_SESSION['panier']['description'][$i];
                if ($repas == 1) {
                    $cuisine = 1;
                }
                if ($repas == 0 || $repas == 3) {
                    $bar = 1;
                }
                $quantite = $_SESSION['panier']['qte'][$i];
                $produit_id = $_SESSION['panier']['id_article'][$i];
                $prix = $_SESSION['panier']['prix'][$i];
                $requete = $bdd->prepare("INSERT INTO  lignes_commandes (qte,prix,dte,commande_id,produit_id,hotel_id,repas,accomp,unmerge_bill_id,syn)
				     VALUES(:qte,:prix,:dte,:commande_id,:produit_id,:hotel_id,:repas,:accomp,:unmerge_bill_id,:syn)");
                $requete->BindParam(':qte', $quantite);
                $requete->BindParam(':prix', $prix);
                $requete->BindParam(':dte', $dte);
                $requete->BindParam(':commande_id', $idcommande);
                $requete->BindParam(':unmerge_bill_id', $idcommande);
                $requete->BindParam(':produit_id', $produit_id);
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                $requete->BindParam(':repas', $repas);
                $requete->BindParam(':accomp', $description);
                $requete->BindParam(':syn', $syn);
                $requete->execute();
                $lignecmd_id = $bdd->lastInsertId();
                $suppr = 0;
                insertMonitoringCommande($agent, $quantite, $produit_id, $description, $idcommande, $suppr, $prix, $monnaie, $repas, $bdd);

                //Insertion produit inclus dans un autre soit repas =3
                if ($repas == 3) {
                    $prods_lier_mesurette = getProdLierMesurette($produit_id, $bdd);
                    foreach ($prods_lier_mesurette as $pl) {
                        $id_prod_lier_mesurette = $pl->produit_id;
                        $qteMout = $pl->quantite;
                        $qtex =  $quantite * $qteMout;
                        $requete = $bdd->prepare("INSERT INTO  lignes_attente (produit_id,qte,lcmd_id,facture_id)
                        VALUES(:produit_id,:qte ,:lcmd_id,:facture_id)");
                        $requete->BindParam(':produit_id', $id_prod_lier_mesurette);
                        $requete->BindParam(':qte', $qtex);
                        $requete->BindParam(':lcmd_id', $lignecmd_id);
                        $requete->BindParam(':facture_id', $idcommande);
                        $requete->execute();
                    }
                }
            }

            /* Fin Insertion lignes_commandes */
            $num_cmd += 1;
            setnumerotation($_SESSION['id_hotel'], $libelle, $num_cmd, $bdd);
            $json['idcommande'] = $idcommande;
            $json['succes'] = true;
        } else {
            //Encore Mise en attente
            //Update de la reservation
            if ($idrescl == 0) {
                $requete = $bdd->prepare("UPDATE t_reservation  SET id_client=:client_id WHERE id_res=:commande_id");
                $requete->BindParam(':client_id', $id_client);
                $requete->BindParam(':commande_id', $id_cmd);
                $requete->execute();
            }
            // Fin Update de la reservation

            //Update de mont_ttc facture
            $requete = $bdd->prepare("UPDATE t_facture  SET mont_tva=:mont_tva,remise=:remise,
                                        mont_ttc_remise=:mont_ttc_remise,mont_ttc=:mont_ttc,nbrcouvert=:nbrcouvert,note_cmd=:note_cmd,
                                        serveur_id=:serveur_id, serveur_name=:serveur_name WHERE id_fact=:id_fact");
            $requete->BindParam(':mont_tva', $_SESSION['panier']['mont_tva']);
            $requete->BindParam(':remise', $_SESSION['panier']['mont_remise']);
            $requete->BindParam(':mont_ttc_remise', $_SESSION['panier']['remise']);
            $requete->BindParam(':mont_ttc', $_SESSION['panier']['mont_ttc_remise']);
            $requete->BindParam(':nbrcouvert', $nbrcouvert);
            $requete->BindParam(':note_cmd', $note_cmd);
            $requete->BindParam(':serveur_id',$id_serveur);
            $requete->BindParam(':serveur_name',$name_serveur);
            $requete->BindParam(':id_fact', $idfactcl);
            $requete->execute();
            $idcommande = $idfactcl;
            // Fin Update de la reservation

            $nbArticles = count($_SESSION['panier']['id_article']);
            for ($i = 0; $i <= $nbArticles - 1; $i++) {

                $repas = $_SESSION['panier']['repas'][$i];
                $quantite = $_SESSION['panier']['qte'][$i];
                $produit_id = $_SESSION['panier']['id_article'][$i];
                $lgcmd = $_SESSION['panier']['pa'][$i];
                $description = $_SESSION['panier']['description'][$i];
                $prix = $_SESSION['panier']['prix'][$i];
                $cpt = $_SESSION['panier']['cpt'][$i];
                $nom = $_SESSION['panier']['nom'][$i];
                $impr = 0;
                $qte2 = 0;
                $qte2diff = 0;

                if (in_array($cpt, $_SESSION['saveprod']['cpt'])) {
                    $impr = 0;
                    $qte2 = $_SESSION['saveprod']['qte'][$lgcmd];

                    if ($quantite != $qte2) {
                        $qte2diff = $quantite - $qte2;
                        if ($qte2diff > 0) {
                            $impr = 1;
                            $qte2 = $qte2diff;
                            if ($repas == 1) {
                                $cuisine = 1;
                            }
                            if ($repas == 0 || $repas == 3) {
                                $bar = 1;
                            }
                            //Update quantite produit Ligne commande
                            $requete = $bdd->prepare("UPDATE lignes_commandes  SET qte=qte+:qteadd,impr=:impr,qte2=:qte2
                            WHERE id=:id");
                            $requete->BindParam(':qteadd', $qte2diff);
                            $requete->BindParam(':impr', $impr);
                            $requete->BindParam(':qte2', $qte2);
                            $requete->BindParam(':id', $lgcmd);
                            $requete->execute();
                            $suppr = 0;
                            insertMonitoringCommande($agent, $qte2diff, $produit_id, $description, $idcommande, $suppr, $prix, $monnaie, $repas, $bdd);
                            //Update produit inclus dans un autre soit repas =3
                            if ($repas == 3) {
                                $prods_lier_mesurette = getProdLierMesurette($produit_id, $bdd);
                                foreach ($prods_lier_mesurette as $pl) {
                                    $id_prod_lier_mesurette = $pl->produit_id;
                                    $qteMout = $pl->quantite;
                                    $qtex = $qte2diff * $qteMout;
                                    $requete = $bdd->prepare("UPDATE lignes_attente SET qte=qte+:qteadd WHERE lcmd_id=:lcmd_id");
                                    $requete->BindParam(':qteadd',  $qtex);
                                    $requete->BindParam(':lcmd_id', $lgcmd);
                                    $requete->execute();
                                }
                            }
                        } else {
                            /* $quantite=$qte2;  
                            $qte2=0; */
                            $impr = 0;
                            $requete = $bdd->prepare("UPDATE lignes_commandes  SET  qte=:qte,impr=:impr  WHERE id=:id");
                            $requete->BindParam(':impr', $impr);
                            $requete->BindParam(':qte', $quantite);
                            $requete->BindParam(':id', $lgcmd);
                            $requete->execute();
                            $suppr = 1;
                            insertMonitoringCommande($agent, $qte2diff, $produit_id, $description, $idcommande, $suppr, $prix, $monnaie, $repas, $bdd);
                            //Update produit inclus dans un autre soit repas =3
                            if ($repas == 3) {
                                $prods_lier_mesurette = getProdLierMesurette($produit_id, $bdd);
                                foreach ($prods_lier_mesurette as $pl) {
                                    $id_prod_lier_mesurette = $pl->produit_id;
                                    $qteMout = $pl->quantite;
                                    $qtex2 = $quantite * $qteMout;
                                    $requete = $bdd->prepare("UPDATE lignes_attente  SET qte=:qte WHERE lcmd_id=:lcmd_id");
                                    $requete->BindParam(':qte', $qtex2);
                                    $requete->BindParam(':lcmd_id', $lgcmd);
                                    $requete->execute();
                                }
                            }
                        }
                    } else {
                        $impr = 0;
                        $requete = $bdd->prepare("UPDATE lignes_commandes  SET prix=:prix,impr=:impr  WHERE id=:id");
                        $requete->BindParam(':prix', $prix);
                        $requete->BindParam(':impr', $impr);
                        $requete->BindParam(':id', $lgcmd);
                        $requete->execute();
                    }
                } else {
                    $impr = 1;
                    $requete = $bdd->prepare("INSERT INTO  lignes_commandes (qte,prix,dte,commande_id,produit_id,hotel_id,repas,impr,qte2,accomp,syn)
				     VALUES(:qte,:prix,:dte,:commande_id,:produit_id,:hotel_id,:repas,:impr,:qte2,:accomp,:syn)");
                    $requete->BindParam(':qte', $quantite);
                    $requete->BindParam(':prix', $prix);
                    $requete->BindParam(':dte', $dte);
                    $requete->BindParam(':commande_id', $idfactcl);
                    $requete->BindParam(':produit_id', $produit_id);
                    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                    $requete->BindParam(':repas', $repas);
                    $requete->BindParam(':impr', $impr);
                    $requete->BindParam(':qte2', $qte2);
                    $requete->BindParam(':accomp', $description);
                    $requete->BindParam(':syn', $syn);

                    $requete->execute();
                    $lignecmd_id = $bdd->lastInsertId();
                    //Insertion produit inclus dans un autre soit repas =3
                    if ($repas == 3) {
                        $prods_lier_mesurette = getProdLierMesurette($produit_id, $bdd);
                        foreach ($prods_lier_mesurette as $pl) {
                            $id_prod_lier_mesurette = $pl->produit_id;
                            $qteMout = $pl->quantite;
                            $qtex =  $quantite * $qteMout;
                            $requete = $bdd->prepare("INSERT INTO  lignes_attente (produit_id,qte,lcmd_id,facture_id)
                            VALUES(:produit_id,:qte ,:lcmd_id,:facture_id)");
                            $requete->BindParam(':produit_id', $id_prod_lier_mesurette);
                            $requete->BindParam(':qte', $qtex);
                            $requete->BindParam(':lcmd_id', $lignecmd_id);
                            $requete->BindParam(':facture_id', $idfactcl);
                            $requete->execute();
                        }
                    }
                }

                if ($lgcmd == 0) {
                    if ($repas == 1) {
                        $cuisine = 1;
                    }
                    if ($repas == 0 || $repas == 3) {
                        $bar = 1;
                    }
                    $suppr = 0;
                    insertMonitoringCommande($agent, $quantite, $produit_id, $description, $idfactcl, $suppr, $prix, $monnaie, $repas, $bdd);
                }
            }
        }

        if ($cuisine == 1) {
            $requete = $bdd->prepare("UPDATE t_facture  SET cuisine=:cuisine WHERE id_fact=:id_fact");
            $requete->BindParam(':cuisine', $cuisine);
            $requete->BindParam(':id_fact', $idcommande);
            $requete->execute();
        }

        if ($cuisine == 1) {
            $json['bc'] = true;
        }

        if ($bar == 1) {
            $json['bar'] = true;
        }

        //Impacter monitoring pour produit supprimé
        $json['idcommande'] = $idcommande;
        $_SESSION['saveprod'] = array();
        $_SESSION['saveprod']['id'] = array();
        $_SESSION['saveprod']['qte'] = array();
        ReinitialiserPanier();
        $json['succes'] = true;
    } else {
        $json['message'] = "Veuillez selectionner au moins un article";
    }
} else {
    $json['message'] = "Veuillez selectionner un client ou une table";
}

echo json_encode($json);
