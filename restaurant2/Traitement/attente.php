<?php
if (!isset($_SESSION)) {
    session_start();
}
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
$idcommande = 0;
$_SESSION['lastload'] = time();
$json = array();
$json['succes'] = False;

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
            $mont_ttc = montant_equivalent_bdd($_SESSION['m_affiche'], $monnaie, $taux_op, $_SESSION['panier']['mont_ttc_remise']);
            $montant_remise = montant_equivalent_bdd($_SESSION['m_affiche'], $monnaie, $taux_op, $_SESSION['panier']['mont_remise']);
            $montant_tva = montant_equivalent_bdd($_SESSION['m_affiche'], $monnaie, $taux_op, $_SESSION['panier']['mont_tva']);
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
            $requete = $bdd->prepare("UPDATE t_client  SET en_attente=:en_attente WHERE id_client=:client_id");
            $requete->BindParam(':en_attente', $en_attente);
            $requete->BindParam(':client_id', $id_client);
            $requete->execute();

            /* Fin insertion dans t_reservation */
            /* Insertion dans t_facture */
            $requete = $bdd->prepare("INSERT INTO t_facture (type,num_fact,id_res,taux,taux_prix,tva,monnaie,date_edition,id_client,id_user,id_hotel,id_sousresto,company_id,mont_tva,remise,mont_ttc_remise,mont_ttc,res_ch_id,etat,etat_cmd,dte_time)
                                        VALUES(:type,:num_fact,:id_res,:taux,:taux_prix,:tva,:monnaie,:date_edition,:id_client,:id_user,:id_hotel,:id_sousresto,:company_id,:mont_tva,:remise,:mont_ttc_remise,:mont_ttc,:res_ch_id,:etat,:etat_cmd,:dte_time)");
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
            $requete->execute();
            $id_fact = $bdd->lastInsertId();
            $idcommande = $id_fact;
            /* Fin d'Insertion dans t_facture */
            /* Insertion dans lignes_commandes */
            $nbArticles = count($_SESSION['panier']['id_article']);
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                $repas = $_SESSION['panier']['repas'][$i];
                if ($repas == 1) {
                    $cuisine = 1;
                }
                $quantite = $_SESSION['panier']['qte'][$i];
                $produit_id = $_SESSION['panier']['id_article'][$i];
                //$prix = montant_equivalent_bdd($_SESSION['m_affiche'], $monnaie, $taux_op, $_SESSION['panier']['prix'][$i]);
                $prix = $_SESSION['panier']['prix'][$i];
                $requete = $bdd->prepare("INSERT INTO  lignes_commandes (qte,prix,dte,commande_id,produit_id,hotel_id,repas)
				     VALUES(:qte,:prix,:dte,:commande_id,:produit_id,:hotel_id,:repas)");
                $requete->BindParam(':qte', $quantite);
                $requete->BindParam(':prix', $prix);
                $requete->BindParam(':dte', $dte);
                $requete->BindParam(':commande_id', $id_fact);
                $requete->BindParam(':produit_id', $produit_id);
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                $requete->BindParam(':repas', $repas);
                $requete->execute();
            }
            /* Fin Insertion lignes_commandes */
            $num_cmd += 1;
            setnumerotation($_SESSION['id_hotel'], $libelle, $num_cmd, $bdd);
            $json['succes'] = true;
            $_SESSION['cptpanier'] = 0;
            $panier->vider_panier();
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
            //UPDATE t_client
            $en_attente = 1;
            $requete = $bdd->prepare("UPDATE t_client  SET en_attente=:en_attente WHERE id_client=:client_id");
            $requete->BindParam(':en_attente', $en_attente);
            $requete->BindParam(':client_id', $id_client);
            $requete->execute();

            //Update de mont_ttc facture
            $requete = $bdd->prepare("UPDATE t_facture  SET mont_tva=:mont_tva,remise=:remise,mont_ttc_remise=:mont_ttc_remise,mont_ttc=:mont_ttc WHERE id_fact=:id_fact");
            $requete->BindParam(':mont_tva', $_SESSION['panier']['mont_tva']);
            $requete->BindParam(':remise', $_SESSION['panier']['mont_remise']);
            $requete->BindParam(':mont_ttc_remise', $_SESSION['panier']['remise']);
            $requete->BindParam(':mont_ttc', $_SESSION['panier']['mont_ttc_remise']);
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
                if ($repas == 1) {
                    $cuisine = 1;
                }
                $quantite = $_SESSION['panier']['qte'][$i];
                $produit_id = $_SESSION['panier']['id_article'][$i];
                $prix = $_SESSION['panier']['prix'][$i];
                $requete = $bdd->prepare("INSERT INTO  lignes_commandes (qte,prix,dte,commande_id,produit_id,hotel_id,repas)
				     VALUES(:qte,:prix,:dte,:commande_id,:produit_id,:hotel_id,:repas)");
                $requete->BindParam(':qte', $quantite);
                $requete->BindParam(':prix', $prix);
                $requete->BindParam(':dte', $dte);
                $requete->BindParam(':commande_id', $idfactcl);
                $requete->BindParam(':produit_id', $produit_id);
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                $requete->BindParam(':repas', $repas);
                $requete->execute();
            }
            /* Fin Insertion lignes_commandes */
        }
        if ($cuisine == 1) {
            $requete = $bdd->prepare("UPDATE t_facture  SET cuisine=:cuisine WHERE id_fact=:id_fact");
            $requete->BindParam(':cuisine', $cuisine);
            $requete->BindParam(':id_fact', $idcommande);
            $requete->execute();
        }
        $_SESSION['cptpanier'] = 0;
        $panier->vider_panier();
        $json['succes'] = true;
    } else {
        echo '<div class="alert alert-danger text-center msg_alert1">Veuillez selectionner au moins un article</div>';
    }
} else {
    echo '<div class="alert alert-danger text-center msg_alert1">Veuillez selectionner un client ou une table</div>';
}
