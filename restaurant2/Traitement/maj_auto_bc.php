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
            $requete = $bdd->prepare("UPDATE t_facture  SET mont_tva=:mont_tva,remise=:remise,mont_ttc_remise=:mont_ttc_remise,mont_ttc=:mont_ttc,nbrcouvert=:nbrcouvert WHERE id_fact=:id_fact");
            $requete->BindParam(':mont_tva', $_SESSION['panier']['mont_tva']);
            $requete->BindParam(':remise', $_SESSION['panier']['mont_remise']);
            $requete->BindParam(':mont_ttc_remise', $_SESSION['panier']['remise']);
            $requete->BindParam(':mont_ttc', $_SESSION['panier']['mont_ttc_remise']);
            $requete->BindParam(':nbrcouvert', $nbrcouvert);
            $requete->BindParam(':id_fact', $idfactcl);
            $requete->execute();
            $idcommande = $idfactcl;
            // Fin Update de la reservation
            // suppression de tous les produits
            $requete = $bdd->prepare("DELETE FROM  lignes_commandes WHERE commande_id=:id");
            $requete->BindParam(':id', $idfactcl);
            $requete->execute();
            /* Insertion dans lignes_commandes */

            $nbArticles = count($_SESSION['panier']['id_article']);
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                
                $repas = $_SESSION['panier']['repas'][$i];
                $quantite = $_SESSION['panier']['qte'][$i];
                $produit_id = $_SESSION['panier']['id_article'][$i];
                $lgcmd = $_SESSION['panier']['pa'][$i];
                $description = $_SESSION['panier']['description'][$i];
                $prix = $_SESSION['panier']['prix'][$i];
                $impr = 1;
                $qte2 = 0;

                if (in_array($lgcmd, $_SESSION['saveprod']['id']) && $lgcmd != 0) {
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
                            $suppr = 0;
                            insertMonitoringCommande($agent, $qte2diff, $produit_id, $description, $idcommande, $suppr, $prix, $monnaie, $repas, $bdd);
                        } else {
                            /* $quantite=$qte2;  
                            $qte2=0; */
                            $suppr = 1;
                            insertMonitoringCommande($agent, $qte2diff, $produit_id, $description, $idcommande, $suppr, $prix, $monnaie, $repas, $bdd);
                        }
                    }
                }
             

                $requete = $bdd->prepare("INSERT INTO  lignes_commandes (qte,prix,dte,commande_id,produit_id,hotel_id,repas,impr,qte2,accomp)
                     VALUES(:qte,:prix,:dte,:commande_id,:produit_id,:hotel_id,:repas,:impr,:qte2,:accomp)");
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
                $requete->execute();

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
        
        if ($cuisine == 1) {
            $requete = $bdd->prepare("UPDATE t_facture  SET cuisine=:cuisine WHERE id_fact=:id_fact");
            $requete->BindParam(':cuisine', $cuisine);
            $requete->BindParam(':id_fact', $idcommande);
            $requete->execute();
        }

       
