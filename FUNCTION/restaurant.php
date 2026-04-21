<?php
//post
function post1($var)
{
    if (isset($_POST[$var]))
        return $_POST[$var];
}

//get
function get1($var)
{
    if (isset($_GET[$var]))
        return $_GET[$var];
}
function infosPos($id, $default, $bdd)
{
    //    $default=0 signifie pos par defaut
    if ($default != 0) {
        $requete = $bdd->prepare("SELECT *FROM t_sousresto AS a WHERE a.id_sousresto=:id_sousresto");
        $requete->BindParam(':id_sousresto', $id);
    } else {
        $requete = $bdd->prepare("SELECT *FROM t_sousresto AS a WHERE a.hotel_id=:id_hotel AND a.etat=1 AND a.statut=0");
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    }
    $requete->execute();
    $st = $requete->fetch(PDO::FETCH_OBJ);
    $id_sous_resto = $st->id_sousresto;
    $libelle_resto = $st->libelle;
    $depot_id = $st->depot_id;
    $_SESSION['id_sousresto'] = $id_sous_resto;
    $_SESSION['libelle_resto'] = $libelle_resto;
    $_SESSION['taux_resto'] = $st->taux;
    $_SESSION['depot_id'] = $depot_id;
    $_SESSION['mention'] = $st->mentionlegale;
    $_SESSION['remise'] = $st->remise;
    return $st;
}
function ListPosResto($id, $bdd)
{
    $requete = $bdd->prepare("SELECT *FROM t_sousresto AS a WHERE a.hotel_id=:id_hotel AND a.etat=1 ORDER BY a.libelle");
    $requete->BindParam(':id_hotel', $id);
    $requete->execute();
    $st = $requete->fetchAll(PDO::FETCH_OBJ);
    return $st;
}
function ListPOSRestoOne($id, $bdd)
{
    $requete = $bdd->prepare("SELECT *FROM t_sousresto AS a WHERE a.id_sousresto=:id_sousresto AND a.etat=1 ORDER BY a.libelle");
    $requete->BindParam(':id_sousresto', $id);
    $requete->execute();
    $st = $requete->fetchAll(PDO::FETCH_OBJ);
    return $st;
}
function InfosCommmande($id, $type, $bdd)
{
    $req = "
        SELECT a.*,
        c.nom_client,c.adresse_provenance_client,c.email_client,c.telephone_client,c.designation,c.type AS typecl,c.sexe_client,d.nom_user,d.prenom_user
            FROM t_facture a,t_client c,t_utilisateur AS d
             WHERE a.id_client=c.id_client
                   AND a.id_user=d.id_user AND a.id_fact=:id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result;
}
function LignesCommmande($id, $bdd)
{
    $requete = $bdd->prepare("SELECT  p.idprod,l.qte,l.prix,p.designation,p.monnaie,p.repas,l.accomp
                                    FROM  lignes_commandes AS l,stk_produit As p 
                                    WHERE l.produit_id=p.idprod AND l.commande_id=:cmd_id ORDER BY p.designation ");
    $requete->BindParam(':cmd_id', $id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function AllCommmandes($id, $type, $dte1, $dte2, $bdd)
{
    //Retourne toutes les commandes du sous-resto
    $req = "
        SELECT a.*,
        c.nom_client,c.designation,c.type,c.adresse_provenance_client,c.email_client,c.telephone_client,c.sexe_client,d.nom_user,d.prenom_user
            FROM t_facture a,t_client c,t_utilisateur AS d
             WHERE a.id_client=c.id_client
                   AND a.id_user=d.id_user 
                   AND a.id_sousresto=:id
                   AND a.type=:type 
                   AND a.date_edition BETWEEN :dte1 AND :dte2
                   ORDER BY a.id_fact DESC
                   ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->BindParam(':type', $type);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function AllCommmandesBYuser($id, $type, $dte1, $dte2, $bdd)
{
    //Retourne toutes les commandes du sous-resto
    $req = "
        SELECT a.*,
        c.nom_client,c.designation,c.type,c.adresse_provenance_client,c.email_client,c.telephone_client,c.sexe_client,d.nom_user,d.prenom_user
            FROM t_facture a,t_client c,t_utilisateur AS d
             WHERE a.id_client=c.id_client
                   AND a.id_user=d.id_user 
                   AND a.id_sousresto=:id
                   AND a.id_user=:id_user
                   AND a.type=:type
                   AND a.date_edition BETWEEN :dte1 AND :dte2
                   ORDER BY a.id_fact DESC
                   ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->BindParam(':id_user', $_SESSION['id_user']);
    $requete->BindParam(':type', $type);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function TotPayeCommande($id, $bdd)
{
    //Retourne toutes les commandes du sous-resto
    $requete = $bdd->prepare("SELECT SUM(c.montantusd*c.taux-c.rendu_usd*c.taux+c.montantcdf-c.rendu_cdf) AS montantpaye
                                FROM t_facture AS a, t_reglement AS b, paiement AS c
                                WHERE a.id_fact=b.id_fact AND b.id_regl=c.regl_id
                                 AND c.id_mode_regl IN(1,2,4,5,6)
                                AND a.id_fact=:id  
                                GROUP BY a.id_fact");
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    $montantpaye = 0;
    foreach ($result as $r) {
        $montantpaye = $r->montantpaye;
    }
    return $montantpaye;
}
function TotPayeCommande2($id, $bdd)
{
    //Retourne montant payé saisi et rendu
    $select['paye'] = 0;
    $select['rendu'] = 0;
    $requete = $bdd->prepare("SELECT SUM(c.montantusd*c.taux+c.montantcdf) AS montantpaye,SUM(c.rendu_usd*c.taux+c.rendu_cdf) AS rendu
                                FROM t_facture AS a, t_reglement AS b, paiement AS c
                                WHERE a.id_fact=b.id_fact AND b.id_regl=c.regl_id
                                AND a.id_fact=:id  
                                GROUP BY a.id_fact");
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    $montantpaye = 0;
    foreach ($result as $r) {
        $select['paye'] = $r->montantpaye;
        $select['rendu'] = $r->rendu;
    }
    return $select;
}
function ListMode($bdd)
{
    $requete = $bdd->prepare("SELECT * FROM  t_mode_reglement ORDER BY priority");
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function VerifInsertFDCJrs($id_sousresto, $dtejrs, $bdd)
{
    $id = 0;
    $nblgn = 0;
    $requete = $bdd->prepare("SELECT id FROM fondscaisse WHERE sousresto_id=:id_sousresto AND dte=:dte");
    $requete->BindParam(':id_sousresto', $id_sousresto);
    $requete->BindParam(':dte', $dtejrs);
    $requete->execute();
    $nblgn = $requete->rowCount();
    if ($nblgn > 0) {
        $st = $requete->fetch(PDO::FETCH_OBJ);
        $id = $st->id;
    }
    return $id;
}
function ReimprimerPOS($id_fact, $bdd)
{
    $tva_fact = 0;
    $tauxfct = 1;
    $remise_fact = 0;
    $_SESSION['panier1'] = array();
    $_SESSION['panier1']['id_article'] = array();
    $_SESSION['panier1']['nom'] = array();
    $_SESSION['panier1']['qte'] = array();
    $_SESSION['panier1']['prix'] = array();
    $_SESSION['panier1']['repas'] = array();
    $_SESSION['panier1']['id_client'] = 0;
    $_SESSION['panier1']['remise'] = 0;
    $_SESSION['panier1']['mont_tva'] = 0;
    $_SESSION['panier1']['mont_ttc'] = 0;
    $_SESSION['panier1']['mont_ttc_remise'] = 0;
    $_SESSION['panier1']['verrouille'] = false;
    $_SESSION['panier1']['description'] = array();
    $idcmd = $id_fact;
    $remise_fact = 0;
    $requete = $bdd->prepare("SELECT f.id_fact, f.montant_total,f.mont_tva,f.mont_ttc,f.date_edition,f.dte_time,f.mode,f.mont_ttc_remise,f.taux,f.tva,f.id_fact,f.num_fact,
                                f.id_res,c.designation,c.id_client,c.nom_client,c.designation,c.type,d.nom_user,d.prenom_user,f.nbrcouvert,f.nomcaisse, f.serveur_id,f.serveur_name
                                FROM  t_client AS c,t_facture AS f,t_utilisateur AS d
                                 WHERE f.id_client=c.id_client AND f.id_user=d.id_user 
                                       AND f.id_fact=:cmd_id  ");
    $requete->BindParam(':cmd_id', $idcmd);
    $requete->execute();
    $reservation_attente = $requete->fetchAll(PDO::FETCH_OBJ);
    // var_dump($reservation_attente);
    foreach ($reservation_attente as $ra) {
        $id = $ra->id_res;
        $id_fact = $ra->id_fact;
        $remise_fact = $ra->mont_ttc_remise;
        $mont_remise = $ra->tva;
        $tva_fact = $ra->tva;
        $mont_tva = $ra->mont_tva;
        $mont_ttc = $ra->mont_ttc;
        $id_cl = $ra->id_client;
        $cmd_num = $ra->num_fact;
        $tbl = $ra->designation;
        $cl = $ra->nom_client;
        $tauxfct = $ra->taux;
        $_SESSION['tauxfct'] = $ra->taux;
        $_SESSION['nbrcouvert'] = $ra->nbrcouvert;
        $_SESSION['mode_fact'] = $ra->mode;
        $_SESSION['date_edition'] = $ra->date_edition;
        $_SESSION['date_edition2'] = $ra->dte_time;
       // $_SESSION['date_edition2'] = $ra->date_edition;
        $_SESSION['nomserveur'] = $ra->nom_user;
        $typ = $ra->type;
        if ($typ == 'client' || $typ == 'serveur') {
            $cl_tbl = $cl;
        } else if ($typ == 'table') {
            $cl_tbl = $tbl;
        } else {
            $cl_tbl = 'Occasionnel';
        }
        $_SESSION['num_commande'] = $ra->num_fact;
        $_SESSION['nom_client'] = $cl_tbl;
        $_SESSION['serveur_name'] = $ra->serveur_name;
        $_SESSION['nom_caissier'] = $ra->nomcaisse;
        $requete = $bdd->prepare("SELECT  p.idprod,p.designation,p.monnaie,p.repas,l.*
                                    FROM  lignes_commandes AS l,stk_produit As p 
                                    WHERE l.produit_id=p.idprod AND l.commande_id=:cmd_id");
        $requete->BindParam(':cmd_id', $id_fact);
        $requete->execute();
        //       var_dump($requete);
        $reservation_l_attente = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($reservation_l_attente as $r) {
            $qte = $r->qte;
            if (round($r->qte) == 0) {
                $qte = $r->qteoffert;
            }
            $prix = $r->prix;
            $idprod = $r->idprod;
            $designation = $r->designation;
            // if ($r->accomp!=''){
            //     $designation = $r->designation . ' avec ' . $r->accomp;
            // }
            $repas = $r->repas;
            $description = $r->accomp;

            array_push($_SESSION['panier1']['id_article'], $idprod);
            array_push($_SESSION['panier1']['nom'], $designation);
            array_push($_SESSION['panier1']['qte'], $qte);
            array_push($_SESSION['panier1']['prix'], $prix);
            array_push($_SESSION['panier1']['repas'], $repas);
            array_push($_SESSION['panier1']['description'], $description);
        }
        $mont_ht = 0;
        $nb_articles = count($_SESSION['panier1']['id_article']);
        for ($i = 0; $i < $nb_articles; $i++) {
            $mont_ht += $_SESSION['panier1']['qte'][$i] * $_SESSION['panier1']['prix'][$i];
        }
        $total1 = $mont_ht;
        $total = total($total1, $tva_fact, $remise_fact);
        $mont_tva = tva($total, $tva_fact, $remise_fact);
        $mont_rmz = remise($total1, $tva_fact, $remise_fact);
        $mont_ht = ht($total, $tva_fact, $remise_fact);

        $ttc = ttc($mont_ht, $mont_tva, $mont_rmz);
        $ttc2 =  montant_equivalent_bdd('CDF', 'USD', $tauxfct, $ttc);
        $_SESSION['panier1']['mont_tva'] = $mont_tva;
        $_SESSION['panier1']['mont_ttc'] = $mont_ht - $mont_rmz;
        $_SESSION['panier1']['mont_remise'] = $mont_rmz;
        $_SESSION['panier1']['mont_ht'] = $mont_ht;
        $_SESSION['panier1']['mont_ttc_remise'] = $ttc;
        $_SESSION['panier1']['netapayer'] = $ttc - $mont_rmz;
        $_SESSION['panier1']['tvafact'] = $tva_fact;
        $_SESSION['panier1']['remise_fact'] = $remise_fact;
        $_SESSION['ttc2'] = $ttc2;
        // var_dump($nb_articles);
    }
}

function Bonfusion($id_fact, $bdd)
{
    $tva_fact = 0;
    $tauxfct = 1;
    $remise_fact = 0;
    $_SESSION['panier1'] = array();
    $_SESSION['panier1']['id_article'] = array();
    $_SESSION['panier1']['nom'] = array();
    $_SESSION['panier1']['qte'] = array();
    $_SESSION['panier1']['prix'] = array();
    $_SESSION['panier1']['repas'] = array();
    $_SESSION['panier1']['id_client'] = 0;
    $_SESSION['panier1']['remise'] = 0;
    $_SESSION['panier1']['mont_tva'] = 0;
    $_SESSION['panier1']['mont_ttc'] = 0;
    $_SESSION['panier1']['mont_ttc_remise'] = 0;
    $_SESSION['panier1']['verrouille'] = false;
    $_SESSION['panier1']['description'] = array();
    $idcmd = $id_fact;

    $remise_fact = 0;
    $merge = 1;
    /*    if ($merge ==1) {
       $sql= ""
        
    } */
    $requete = $bdd->prepare("SELECT f.id_fact, f.montant_total,f.mont_tva,f.mont_ttc,f.date_edition,f.dte_time,f.mode,f.mont_ttc_remise,f.taux,f.tva,f.id_fact,f.num_fact,
                                f.id_res,c.designation,c.id_client,c.nom_client,c.designation,c.type,d.nom_user,d.prenom_user,f.nbrcouvert,f.nomcaisse, f.serveur_id,f.serveur_name
                                FROM  t_client AS c,t_facture AS f,t_utilisateur AS d
                                 WHERE f.id_client=c.id_client AND f.id_user=d.id_user 
                                       AND f.id_fact=:cmd_id AND f.etat_cmd=1");
    $requete->BindParam(':cmd_id', $idcmd);
    $requete->execute();
    $reservation_attente = $requete->fetchAll(PDO::FETCH_OBJ);
   /// var_dump($reservation_attente);
    foreach ($reservation_attente as $ra) {
        $id = $ra->id_res;
        $id_fact= $ra->id_fact;
        $remise_fact = $ra->mont_ttc_remise;
        $mont_remise = $ra->tva;
        $tva_fact = $ra->tva;
        $mont_tva = $ra->mont_tva;
        $mont_ttc = $ra->mont_ttc;
        $id_cl = $ra->id_client;
        $cmd_num = $ra->num_fact;
        $tbl = $ra->designation;
        $cl = $ra->nom_client;
        $tauxfct = $ra->taux;
        $_SESSION['tauxfct'] = $ra->taux;
        $_SESSION['nbrcouvert'] = $ra->nbrcouvert;
        $_SESSION['mode_fact'] = $ra->mode;
        $_SESSION['date_edition'] = $ra->date_edition;
        //      $_SESSION['date_edition2'] = $ra->dte_time;
        $_SESSION['date_edition2'] = $ra->date_edition;
        $_SESSION['nomserveur'] = $ra->nom_user;
        $typ = $ra->type;
        if ($typ == 'client' || $typ == 'serveur') {
            $cl_tbl = $cl;
        } else if ($typ == 'table') {
            $cl_tbl = $tbl;
        } else {
            $cl_tbl = 'Occasionnel';
        }
        $_SESSION['num_commande'] = $ra->num_fact;
        $_SESSION['nom_client'] = $cl_tbl;
        $_SESSION['serveur_name'] = $ra->serveur_name;
        $_SESSION['nom_caissier'] = $ra->nomcaisse;
      //  $id_fact=35;
        $requete = $bdd->prepare("SELECT  p.idprod,p.designation,p.monnaie,p.repas,l.*
                                    FROM  lignes_commandes AS l,stk_produit As p 
                                    WHERE l.produit_id=p.idprod AND l.commande_id=:cmd_id");
        $requete->BindParam(':cmd_id', $id_fact);
        $f= $requete->execute();
  
        $reservation_l_attente = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($reservation_l_attente as $r) {
            $qte = $r->qte;
            if (round($r->qte) == 0) {
                $qte = $r->qteoffert;
            }
            $prix = $r->prix;
            $idprod = $r->idprod;
            $designation = $r->designation;
         
            // if ($r->accomp!=''){
            //     $designation = $r->designation . ' avec ' . $r->accomp;
            // }
            $repas = $r->repas;
            $description = $r->accomp;

            array_push($_SESSION['panier1']['id_article'], $idprod);
            array_push($_SESSION['panier1']['nom'], $designation);
            array_push($_SESSION['panier1']['qte'], $qte);
            array_push($_SESSION['panier1']['prix'], $prix);
            array_push($_SESSION['panier1']['repas'], $repas);
            array_push($_SESSION['panier1']['description'], $description);
        }
        $mont_ht = 0;
        $nb_articles = count($_SESSION['panier1']['id_article']);
        for ($i = 0; $i < $nb_articles; $i++) {
            $mont_ht += $_SESSION['panier1']['qte'][$i] * $_SESSION['panier1']['prix'][$i];
        }
        $total1 = $mont_ht;
        $total = total($total1, $tva_fact, $remise_fact);
        $mont_tva = tva($total, $tva_fact, $remise_fact);
        $mont_rmz = remise($total1, $tva_fact, $remise_fact);
        $mont_ht = ht($total, $tva_fact, $remise_fact);

        $ttc = ttc($mont_ht, $mont_tva, $mont_rmz);
        $ttc2 =  montant_equivalent_bdd('CDF', 'USD', $tauxfct, $ttc);
        $_SESSION['panier1']['mont_tva'] = $mont_tva;
        $_SESSION['panier1']['mont_ttc'] = $mont_ht - $mont_rmz;
        $_SESSION['panier1']['mont_remise'] = $mont_rmz;
        $_SESSION['panier1']['mont_ht'] = $mont_ht;
        $_SESSION['panier1']['mont_ttc_remise'] = $ttc;
        $_SESSION['panier1']['netapayer'] = $ttc - $mont_rmz;
        $_SESSION['panier1']['tvafact'] = $tva_fact;
        $_SESSION['panier1']['remise_fact'] = $remise_fact;
        $_SESSION['ttc2'] = $ttc2;
        // var_dump($nb_articles);
    }
}
function GetQteProdEnAttente($bdd)
{
    //Recuperer les quantités produits mise en attente
    $dte = date('Y-m-d');
    $_SESSION['attente'] = array();
    $_SESSION['attente']['qte'] = array();
    $_SESSION['attente']['idprod'] = array();
    $requete = $bdd->prepare("SELECT  l.produit_id,SUM(l.qte) AS qte,l.repas 
                                    FROM t_facture AS a, lignes_commandes AS l
                                    WHERE a.id_fact=l.commande_id AND a.etat_cmd='1'
                                     AND a.id_sousresto=:id_sousresto
                                     AND a.date_edition=:date_edition
                                      GROUP BY l.produit_id");
    $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
    $requete->BindParam(':date_edition', $dte);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $p) {
        $idprod = $p->produit_id;
        $quantite = $p->qte;
        $repas = $p->repas;
        if ($repas == 1) {
            $produits_plat = listeProduitIngredient($idprod, $_SESSION['id_hotel'], $bdd);
            foreach ($produits_plat as $p) {
                $idpr = $p->produit_id;
                $qte = $p->quantite;
                if (!in_array($idpr, $_SESSION['attente']['idprod'])) {
                    array_push($_SESSION['attente']['idprod'], $idpr);
                    $_SESSION['attente']['qte'][$idpr] = $quantite * $qte;
                } else {
                    $_SESSION['attente']['qte'][$idpr] += $quantite * $qte;
                }
            }
        } else {
            if (!in_array($idprod, $_SESSION['attente']['idprod'])) {
                array_push($_SESSION['attente']['idprod'], $idprod);
                $_SESSION['attente']['qte'][$idprod] = $quantite;
            } else {
                $_SESSION['attente']['qte'][$idprod] += $quantite;
            }
        }
    }
}
function QteAttenteProd($idprod)
{
    $quantite = 0;
    if (in_array($idprod, $_SESSION['attente']['idprod'])) {
        $quantite = $_SESSION['attente']['qte'][$idprod];
    }
    return $quantite;
}
function InitializePrintFacture()
{
    //cash
    $_SESSION['facture'] = array();
    $_SESSION['facture']['id'] = array();
    $_SESSION['facture']['num'] = array();
    $_SESSION['facture']['client'] = array();
    $_SESSION['facture']['vendeur'] = array();
    $_SESSION['facture']['date'] = array();
    $_SESSION['facture']['mode'] = array();
    $_SESSION['facture']['mont_paye'] = array();
    $_SESSION['facture']['mont_tot'] = array();
    //credit
    $_SESSION['facture1'] = array();
    $_SESSION['facture1']['id'] = array();
    $_SESSION['facture1']['num'] = array();
    $_SESSION['facture1']['client'] = array();
    $_SESSION['facture1']['vendeur'] = array();
    $_SESSION['facture1']['date'] = array();
    $_SESSION['facture1']['mode'] = array();
    $_SESSION['facture1']['mont_paye'] = array();
    $_SESSION['facture1']['mont_tot'] = array();
    //don
    $_SESSION['facture2'] = array();
    $_SESSION['facture2']['id'] = array();
    $_SESSION['facture2']['num'] = array();
    $_SESSION['facture2']['client'] = array();
    $_SESSION['facture2']['vendeur'] = array();
    $_SESSION['facture2']['date'] = array();
    $_SESSION['facture2']['mode'] = array();
    $_SESSION['facture2']['mont_paye'] = array();
    $_SESSION['facture2']['mont_tot'] = array();
    //annnulee
    $_SESSION['facture3'] = array();
    $_SESSION['facture3']['id'] = array();
    $_SESSION['facture3']['num'] = array();
    $_SESSION['facture3']['client'] = array();
    $_SESSION['facture3']['vendeur'] = array();
    $_SESSION['facture3']['date'] = array();
    $_SESSION['facture3']['mode'] = array();
    $_SESSION['facture3']['mont_paye'] = array();
    $_SESSION['facture3']['mont_tot'] = array();
    //fusion
    $_SESSION['facture4'] = array();
    $_SESSION['facture4']['id'] = array();
    $_SESSION['facture4']['num'] = array();
    $_SESSION['facture4']['creeepar'] = array();
    $_SESSION['facture4']['date'] = array();
    $_SESSION['facture4']['mont_tot'] = array();
}
function sessionPrintFacture($facture_id, $num_fact, $client, $vendeur, $date, $mode, $mont_paye, $mont_tot)
{
    array_push($_SESSION['facture']['id'], $facture_id);
    array_push($_SESSION['facture']['num'], $num_fact);
    array_push($_SESSION['facture']['client'], $client);
    array_push($_SESSION['facture']['vendeur'], $vendeur);
    array_push($_SESSION['facture']['date'], $date);
    array_push($_SESSION['facture']['mode'], $mode);
    array_push($_SESSION['facture']['mont_paye'], $mont_paye);
    array_push($_SESSION['facture']['mont_tot'], $mont_tot);
}

function sessionPrintFactureCredit($facture_id, $num_fact, $client, $vendeur, $date, $mode, $mont_paye, $mont_tot)
{
    array_push($_SESSION['facture1']['id'], $facture_id);
    array_push($_SESSION['facture1']['num'], $num_fact);
    array_push($_SESSION['facture1']['client'], $client);
    array_push($_SESSION['facture1']['vendeur'], $vendeur);
    array_push($_SESSION['facture1']['date'], $date);
    array_push($_SESSION['facture1']['mode'], $mode);
    array_push($_SESSION['facture1']['mont_paye'], $mont_paye);
    array_push($_SESSION['facture1']['mont_tot'], $mont_tot);
}
function sessionPrintFactureDon($facture_id, $num_fact, $client, $vendeur, $date, $mode, $mont_paye, $mont_tot)
{
    array_push($_SESSION['facture2']['id'], $facture_id);
    array_push($_SESSION['facture2']['num'], $num_fact);
    array_push($_SESSION['facture2']['client'], $client);
    array_push($_SESSION['facture2']['vendeur'], $vendeur);
    array_push($_SESSION['facture2']['date'], $date);
    array_push($_SESSION['facture2']['mode'], $mode);
    array_push($_SESSION['facture2']['mont_paye'], $mont_paye);
    array_push($_SESSION['facture2']['mont_tot'], $mont_tot);
}
function sessionPrintFactureAnnulee($facture_id, $num_fact, $client, $vendeur, $date, $mode, $mont_paye, $mont_tot)
{
    array_push($_SESSION['facture3']['id'], $facture_id);
    array_push($_SESSION['facture3']['num'], $num_fact);
    array_push($_SESSION['facture3']['client'], $client);
    array_push($_SESSION['facture3']['vendeur'], $vendeur);
    array_push($_SESSION['facture3']['date'], $date);
    array_push($_SESSION['facture3']['mode'], $mode);
    array_push($_SESSION['facture3']['mont_paye'], $mont_paye);
    array_push($_SESSION['facture3']['mont_tot'], $mont_tot);
}
function sessionPrintFactureFusion($facture_id, $num_fact, $creepar, $date, $mont_tot)
{
    array_push($_SESSION['facture4']['id'], $facture_id);
    array_push($_SESSION['facture4']['num'], $num_fact);
    array_push($_SESSION['facture4']['creeepar'], $creepar);
    array_push($_SESSION['facture4']['date'], $date);
    array_push($_SESSION['facture4']['mont_tot'], $mont_tot);
}
function GetCaffOfDayResto($bdd)
{
   
    $dte = date('Y-m-d');

    $select['usd'] = 0;
    $select['cdf'] = 0;
    $fc_usd = $fc_cdf = 0;
       // REPORT
        $rfond_cdf = 0;
        $rfond_usd = 0;

        $requete = $bdd->prepare("SELECT cdf ,usd  FROM  reportcaisse WHERE hotel_id=:id_hotel
                                     ORDER BY id DESC LIMIT 1");
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);

        foreach ($result as $r) {
            $rfond_cdf = $r->cdf;
            $rfond_usd = $r->usd;
        }

        $requete = $bdd->prepare("SELECT SUM(a.usd) AS usd,SUM(a.cdf) AS cdf
                                FROM fondscaisse AS a
                                WHERE a.hotel_id=:hotel_id
                                AND a.dte=:dte
                                ");
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        $requete->BindParam(':dte', $dte);
        $requete->execute();
        $fc = $requete->fetch(PDO::FETCH_OBJ);
        $fc_usd = $fc->usd + $rfond_usd;
        $fc_cdf = $fc->cdf + $rfond_cdf;

        $requete = $bdd->prepare("SELECT SUM(c.montantusd-(c.rendu_usd/c.taux)) AS usd,SUM(c.montantcdf-c.rendu_cdf) AS cdf
                                FROM t_facture AS a, t_reglement AS b, paiement AS c
                                WHERE a.id_fact=b.id_fact AND b.id_regl=c.regl_id
                                AND c.id_mode_regl IN(2)
                                AND b.dte=:dte
                                AND c.site_id=:site_id");
        $requete->BindParam(':dte', $dte);
        $requete->BindParam(':site_id', $_SESSION['id_hotel']);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
            $select['usd'] = $r->usd;
            $select['cdf'] = $r->cdf;
        }
    $select['usd'] += $fc_usd;
    $select['cdf'] += $fc_cdf;
    return $select;
}
function DetailsVente($id_sousresto, $date_bd1, $date_bd2, $bdd)
{
    $requete = $bdd->prepare("SELECT a.taux_prix,a.monnaie,a.mode,a.mont_ttc_remise,c.idprod,c.code, c.designation,
                                SUM(b.qte) AS qte, b.prix AS pu, b.dte_h,a.mode AS lib,SUM(b.qte*b.prix) AS mont,
                                SUM(b.qteoffert) AS qteoffert,SUM(b.qteoffert*b.prix2) AS montof
        FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
        WHERE b.produit_id= c.idprod AND a.id_fact=b.commande_id 
        AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
        AND a.id_sousresto =:id_sousresto 
        AND a.mode IS NOT NULL
        GROUP BY c.idprod, a.mode  
        ORDER BY c.designation");
    $requete->BindParam(':date_bd1', $date_bd1);
    $requete->BindParam(':date_bd2', $date_bd2);
    $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
    $requete->execute();
    $articles3 = $requete->fetchAll(PDO::FETCH_OBJ);
    return $articles3;
}
function DetailsVenteByUser($id_sousresto, $date_bd1, $date_bd2, $bdd)
{
    $requete = $bdd->prepare("SELECT a.taux_prix,a.monnaie,a.mode,a.mont_ttc_remise,c.idprod,c.code, c.designation,
                                SUM(b.qte) AS qte, b.prix AS pu, b.dte_h,a.mode AS lib,SUM(b.qte*b.prix) AS mont,
                                SUM(b.qteoffert) AS qteoffert,SUM(b.qteoffert*b.prix2) AS montof
        FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
        WHERE b.produit_id= c.idprod AND a.id_fact=b.commande_id 
        AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
        AND a.id_sousresto =:id_sousresto 
	    AND a.id_user =:id_user
        AND a.mode IS NOT NULL
        GROUP BY c.idprod, a.mode  
        ORDER BY c.designation");
    $requete->BindParam(':date_bd1', $date_bd1);
    $requete->BindParam(':date_bd2', $date_bd2);
    $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
    $requete->BindParam(':id_user', $_SESSION['id_user']);
    $requete->execute();
    $articles3 = $requete->fetchAll(PDO::FETCH_OBJ);
    return $articles3;
}
function TotVerser($id_user, $id_sousresto, $dte, $bdd)
{
    //Retourne montant payé saisi et rendu
    $select['usd'] = 0;
    $select['cdf'] = 0;
    $requete = $bdd->prepare("SELECT a.date_vers,a.user_vers,SUM(a.montant_vers) AS mont_cdf,SUM(a.montantusd) AS mont_usd,a.date_vers
        FROM t_versement AS a
        WHERE a.user_vers=:id_user 
             AND a.date_vers=:dte 
             AND a.id_sousresto=:id_sousresto
        GROUP BY a.user_vers,a.date_vers");
    $requete->BindParam(':dte', $dte);
    $requete->BindParam(':id_user', $id_user);
    $requete->BindParam(':id_sousresto', $id_sousresto);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $select['usd'] = $r->mont_usd;
        $select['cdf'] = $r->mont_cdf;
    }
    return $select;
}
function TotSolde($id_user, $id_sousresto, $dte, $bdd)
{
    //Retourne montant payé saisi et rendu
    $select['percu_cdf'] = 0;
    $select['percu_usd'] = 0;
    $select['rendu_usd'] = 0;
    $select['rendu_cdf'] = 0;
    $requete = $bdd->prepare("SELECT SUM(b.montantcdf) AS percu_cdf,SUM(b.montantusd) AS percu_usd,b.id_sousresto,
       SUM(b.rendu_cdf) AS rendu_cdf,SUM(b.rendu_usd) AS rendu_usd,a.dte AS date_vers,a.id_user AS user_vers,d.nom_user,d.prenom_user
        FROM t_reglement AS a,paiement AS b,t_utilisateur AS d
        WHERE a.id_regl=b.regl_id 
             AND a.id_user=d.id_user
	     AND b.id_sousresto=:id_sousresto 
             AND b.id_mode_regl IN(2)
             AND a.dte BETWEEN :dte AND :dte 
        GROUP BY a.id_user,a.dte");
    $requete->BindParam(':dte', $dte);
    $requete->BindParam(':id_user', $id_user);
    $requete->BindParam(':id_sousresto', $id_sousresto);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $select['percu_cdf'] = $r->percu_cdf;
        $select['percu_usd'] = $r->percu_usd;
        $select['rendu_usd'] = $r->rendu_usd;
        $select['rendu_cdf'] = $r->rendu_cdf;
    }
    return $select;
}
function FamillesPlat($bdd)
{
    $plat = 1;
    $requete = $bdd->prepare("SELECT * FROM  stk_famille AS f WHERE f.hotel_id=:hotel_id AND f.plat=:plat AND f.pseudo_supp=0 ORDER BY designation ");

    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':plat', $plat);
    $requete->execute();
    $familles = $requete->fetchAll(PDO::FETCH_OBJ);
    return $familles;
}
function SousFamillesPlat($bdd)
{
    $plat = 1;
    $requete = $bdd->prepare("SELECT * FROM  stk_famille AS f,stk_sous_famille sf"
        . " WHERE f.idfamille= sf.famille AND f.hotel_id=:hotel_id AND f.plat=:plat AND sf.pseudo_supp=0 ORDER BY sf.des");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':plat', $plat);
    $requete->execute();
    $sous_familles = $requete->fetchAll(PDO::FETCH_OBJ);
    return $sous_familles;
}
function ListePlat($bdd)
{
    $requete = $bdd->prepare("SELECT prod.idprod,prod.code,prod.designation AS produit,prod.pa,prod.pv,prod.qte_initial,prod.qte_min,prod.unite,prod.monnaie,s_fam.des,fam.designation,p.id_prix,p.prix_vente "
        . "FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam, t_prix_produit AS p "
        . "WHERE  prod.famille_id=s_fam.id_s_fam AND prod.idprod=p.produit_id "
        . "AND p.sousresto_id=:sousresto_id AND prod.hotel_id=:hotel_id AND fam.plat=1 AND s_fam.famille=fam.idfamille AND prod.pseudo_supp=0 ORDER BY prod.designation ");
    $requete->BindParam(':sousresto_id', $_SESSION['id_sousresto']);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $produits = $requete->fetchAll(PDO::FETCH_OBJ);
    return $produits;
}
function ListePlat2($bdd, $fich_sfamid)
{
    $requete = $bdd->prepare("SELECT prod.idprod,prod.code,prod.designation AS produit,prod.pa,prod.pv,prod.qte_initial,prod.qte_min,prod.unite,prod.monnaie,s_fam.des,fam.designation,p.id_prix,p.prix_vente 
    FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam, t_prix_produit AS p 
    WHERE  prod.famille_id=s_fam.id_s_fam AND prod.idprod=p.produit_id AND s_fam.id_s_fam=:fich_sfamid
    AND p.sousresto_id=:sousresto_id AND prod.hotel_id=:hotel_id AND fam.plat=1 AND s_fam.famille=fam.idfamille AND prod.pseudo_supp=0 ORDER BY prod.designation");
    $requete->BindParam(':sousresto_id', $_SESSION['id_sousresto']);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':fich_sfamid', $fich_sfamid);
    $requete->execute();
    $produits = $requete->fetchAll(PDO::FETCH_OBJ);
    return $produits;
}
function AfficheNom($nom)
{
    return substr(ucfirst($nom), 0, 10);
}
function AfficheNom2($nom)
{
    return substr(ucfirst($nom), 0, 17);
}
function AllCommmandesCredit($id, $type, $dte1, $dte2, $bdd)
{
    //Retourne toutes les commandes du sous-resto
    $mode = 'Credit';
    $req = "
        SELECT a.*,c.type AS type_client,
        c.nom_client,c.designation,c.adresse_provenance_client,c.email_client,c.telephone_client,c.sexe_client,d.nom_user,d.prenom_user
            FROM t_facture a,t_client c,t_utilisateur AS d
             WHERE a.id_client=c.id_client
                   AND a.id_user=d.id_user 
                   AND a.id_sousresto=:id
                   AND a.type=:type
                   AND a.mode=:mode
                   AND a.date_edition BETWEEN :dte1 AND :dte2
                   ORDER BY a.id_fact DESC
                   ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->BindParam(':type', $type);
    $requete->BindParam(':mode', $mode);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function HistoPaiementByFact($id, $bdd)
{
    //Retourne toutes les commandes du sous-resto
    $req = "SELECT re.id_regl,re.numero,re.dte,re.date_regl,re.id_user,pa.montantusd,pa.montantcdf,pa.rendu_usd,pa.rendu_cdf,pa.taux,mo.lib,us.nom_user,us.prenom_user
        FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo,t_utilisateur AS us
        WHERE re.id_regl=pa.regl_id 
       AND  mo.id_mode_regl=pa.id_mode_regl 
       AND  re.id_user=us.id_user
       AND re.id_fact=:id
       ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function DetailsRecu($id, $bdd)
{
    //Retourne toutes les commandes du sous-resto
    $req = "SELECT re.id_regl,re.id_fact,re.numero,re.dte,re.date_regl,re.id_user,pa.montantusd,pa.montantcdf,pa.rendu_usd,pa.rendu_cdf,pa.taux,mo.lib,us.nom_user,us.prenom_user
        FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo,t_utilisateur AS us
        WHERE re.id_regl=pa.regl_id 
       AND  mo.id_mode_regl=pa.id_mode_regl 
       AND  re.id_user=us.id_user
       AND re.id_regl=:id
       AND mo.id_mode_regl IN(1,2)
       ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result;
}
function DetailsVenteAll($date_bd1, $date_bd2, $bdd)
{
    $requete = $bdd->prepare("SELECT a.taux_prix,a.monnaie,a.mode,c.idprod,c.code, c.designation,SUM(b.qte) AS qte, b.prix AS pu, b.dte_h,a.mode AS lib,SUM(b.prix*b.qte) AS pt,SUM(c.pa*b.qte) AS pa,c.repas
        FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
        WHERE b.produit_id= c.idprod AND a.id_fact=b.commande_id 
        AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
        AND a.id_hotel =:id_hotel 
        GROUP BY c.idprod, a.mode 
        ORDER BY c.designation");
    $requete->BindParam(':date_bd1', $date_bd1);
    $requete->BindParam(':date_bd2', $date_bd2);
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->execute();
    $articles3 = $requete->fetchAll(PDO::FETCH_OBJ);
    return $articles3;
}
function insertSessionVente($numero, $bdd)
{
    $statut = 1;
    $date_ouverture = date('Y-m-d');
    $date_fermeture = date('Y-m-d');
    $dte_heure_ouvert = date('Y-m-d H:i:s');
    $dte_heure_ferm = date('Y-m-d H:i:s');
    $requete = $bdd->prepare("INSERT INTO t_session(numero,date_ouverture,date_fermeture,statut,dte_heure_ouvert,
                                                    dte_heure_ferm,user_id,souresto_id,hotel_id)
                VALUES(:numero,:date_ouverture,:date_fermeture,:statut,:dte_heure_ouvert,:dte_heure_ferm,:user_id,:souresto_id,:hotel_id)");
    $requete->BindParam(':date_ouverture', $date_ouverture);
    $requete->BindParam(':date_fermeture', $date_fermeture);
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':dte_heure_ouvert', $dte_heure_ouvert);
    $requete->BindParam(':dte_heure_ferm', $dte_heure_ferm);
    $requete->BindParam(':user_id', $_SESSION['id_user']);
    $requete->BindParam(':souresto_id', $_SESSION['id_sousresto']);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
}
function selectIdVenteSession($bdd)
{
    $numero = 0;
    $requete = $bdd->prepare("SELECT idsession FROM t_session WHERE statut=1");
    //    $requete->BindParam(':statut',$id);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op) :
        $numero = $op->idsession;
    endforeach;
    return $numero;
}
function CloturerVenteSession($idsession, $bdd)
{
    $date_fermeture = date('Y-m-d');
    $dte_heure_ferm = date('Y-m-d H:i:s');
    $statut = 0;
    $requete = $bdd->prepare("UPDATE t_session SET statut=:statut,date_fermeture=:date_fermeture,dte_heure_ferm=:dte_heure_ferm WHERE idsession=:idsession");
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':date_fermeture', $date_fermeture);
    $requete->BindParam(':dte_heure_ferm', $dte_heure_ferm);
    $requete->BindParam(':idsession', $idsession);
    $requete->execute();
}
function ReduiceDaysToDate($dte, $nbrejr)
{
    $addjr = '-' . $nbrejr . 'days';
    $date_collect = date("Y-m-d", strtotime($dte . $addjr));
    $new_date_collect = $date_collect;
    return $new_date_collect;
}
function ReimprimerBC($id_fact, $bdd)
{
    $tva_fact = 0;
    $tauxfct = 1;
    $remise_fact = 0;
    $_SESSION['dessert'] = 0;
    $_SESSION['entree'] = 0;
    $_SESSION['plats'] = 0;
    $_SESSION['panier'] = array();
    $_SESSION['panier']['id_article'] = array();
    $_SESSION['panier']['nom'] = array();
    $_SESSION['panier']['qte'] = array();
    $_SESSION['panier']['prix'] = array();
    $_SESSION['panier']['repas'] = array();
    $_SESSION['panier']['genre'] = array();
    $_SESSION['panier']['id_client'] = 0;
    $_SESSION['panier']['remise'] = 0;
    $_SESSION['panier']['mont_tva'] = 0;
    $_SESSION['panier']['mont_ttc'] = 0;
    $_SESSION['panier']['mont_ttc_remise'] = 0;
    $_SESSION['panier']['verrouille'] = false;
    $idcmd = $id_fact;
    $requete = $bdd->prepare("SELECT f.id_fact, f.montant_total,f.mont_tva,f.mont_ttc,f.date_edition,f.dte_time,f.mode,f.mont_ttc_remise,f.taux,f.tva,f.id_fact,f.num_fact,
                                f.id_res,c.designation,c.id_client,c.nom_client,c.designation,c.type,d.nom_user,d.prenom_user
                                FROM  t_client AS c,t_facture AS f,t_utilisateur AS d
                                 WHERE f.id_client=c.id_client AND f.id_user=d.id_user 
                                       AND f.id_fact=:cmd_id");
    $requete->BindParam(':cmd_id', $idcmd);
    $requete->execute();
    $reservation_attente = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($reservation_attente as $ra) {
        $id = $ra->id_res;
        $id_fact = $ra->id_fact;
        $remise_fact = $ra->mont_ttc_remise;
        $mont_remise = $ra->tva;
        $tva_fact = $ra->tva;
        $mont_tva = $ra->mont_tva;
        $mont_ttc = $ra->mont_ttc;
        $id_cl = $ra->id_client;
        $cmd_num = $ra->num_reserv;
        $tbl = $ra->designation;
        $cl = $ra->nom_client;
        $tauxfct = $ra->taux;
        $_SESSION['mode_fact'] = $ra->mode;
        $_SESSION['nom_user'] = $ra->nom_user;
        $_SESSION['date_edition'] = $ra->date_edition;
        //        $_SESSION['date_edition2'] = $ra->dte_time;
        $_SESSION['date_edition2'] = $ra->dte_time;
        $typ = $ra->type;
        if ($typ == 'client' || $typ == 'serveur') {
            $cl_tbl = $cl;
        } else if ($typ == 'table') {
            $cl_tbl = $tbl;
        } else {
            $cl_tbl = 'Occasionnel';
        }
        $_SESSION['num_commande'] = $ra->num_fact;
        $_SESSION['nom_client'] = $cl_tbl;
        $requete = $bdd->prepare("SELECT  p.idprod,p.designation,p.monnaie,p.repas,ss.genre,l.*
                                    FROM  lignes_commandes AS l,stk_produit As p,stk_sous_famille AS ss
                                    WHERE l.produit_id=p.idprod AND p.famille_id=ss.id_s_fam AND l.commande_id=:cmd_id");
        $requete->BindParam(':cmd_id', $id_fact);
        $requete->execute();
        $reservation_l_attente = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($reservation_l_attente as $r) {
            $qte = $r->qte;
            if (round($r->qte) == 0) {
                $qte = $r->qteoffert;
            }
            $prix = $r->prix;
            $idprod = $r->idprod;
            $designation = $r->designation;
            if ($r->accomp != '') {
                $designation = $r->designation . ' avec ' . $r->accomp;
            }
            $repas = $r->repas;
            $genre = $r->genre;

            array_push($_SESSION['panier']['id_article'], $idprod);
            array_push($_SESSION['panier']['nom'], $designation);
            array_push($_SESSION['panier']['qte'], $qte);
            array_push($_SESSION['panier']['prix'], $prix);
            array_push($_SESSION['panier']['repas'], $repas);
            array_push($_SESSION['panier']['genre'], $genre);
            if ($genre == 2) {
                $_SESSION['dessert'] = 1;
            } elseif ($genre == 1) {
                $_SESSION['entree'] = 1;
            } elseif ($genre == 0) {
                $_SESSION['plats'] = 1;
            }
        }
        $mont_ht = 0;
        $nb_articles = count($_SESSION['panier']['id_article']);
        for ($i = 0; $i < $nb_articles; $i++) {
            $mont_ht += $_SESSION['panier']['qte'][$i] * $_SESSION['panier']['prix'][$i];
        }
        $total1 = $mont_ht;
        $total = total($total1, $tva_fact, $remise_fact);
        $mont_tva = tva($total, $tva_fact, $remise_fact);
        $mont_rmz = remise($total1, $tva_fact, $remise_fact);
        $mont_ht = ht($total, $tva_fact, $remise_fact);

        $ttc = ttc($mont_ht, $mont_tva, $mont_rmz);
        $ttc2 =  montant_equivalent_bdd('CDF', 'USD', $tauxfct, $ttc);
        $_SESSION['panier']['mont_tva'] = $mont_tva;
        $_SESSION['panier']['mont_ttc'] = $mont_ht - $mont_rmz;
        $_SESSION['panier']['mont_remise'] = $mont_rmz;
        $_SESSION['panier']['mont_ht'] = $mont_ht;
        $_SESSION['panier']['mont_ttc_remise'] = $ttc;
        $_SESSION['ttc2'] = $ttc2;

        //DETAILS PLATS
        $_SESSION['platdetail'] = array();
        $_SESSION['platdetail']['accomp_id'] = array();
        $_SESSION['platdetail']['accomp_nom'] = array();
        $_SESSION['platdetail']['cpt'] = array();
        $_SESSION['platdetail']['cpt2'] = array();
        $_SESSION['platdetail']['cuisson_id'] = array();
        $_SESSION['platdetail']['cuisson_nom'] = array();
        $_SESSION['platdetail']['idprod'] = array();
        $_SESSION['platdetail']['sauce_id'] = array();
        $_SESSION['platdetail']['sauce_nom'] = array();
        $_SESSION['platdetail']['sel_id'] = array();
        $_SESSION['platdetail']['sel_nom'] = array();
        $_SESSION['platdetail']['keyprods'] = array();

        // $requete = $bdd->prepare("SELECT * FROM  detailsplatscommandes AS l WHERE  l.commande_id=:cmd_id");
        // $requete->BindParam(':cmd_id', $id_fact);
        // $requete->execute();
        // $details_plats = $requete->fetchAll(PDO::FETCH_OBJ);
        // $f = 0;
        // foreach ($details_plats as $r) {
        //     $idprod = $r->produit_id;
        //     $keyprod = $r->keyprod;
        //     $cuisson_nom = $r->cuisson;
        //     $sauce_nom = $r->sauce;
        //     $sel_nom = $r->sel;
        //     $accomp_nom = $r->accomp;
        //     array_push($_SESSION['platdetail']['idprod'], $idprod);
        //     $_SESSION['platdetail']['keyprods'][$f] = $keyprod;
        //     $_SESSION['platdetail']['cuisson_nom'][$keyprod] = $cuisson_nom;
        //     $_SESSION['platdetail']['sauce_nom'][$keyprod] = $sauce_nom;
        //     $_SESSION['platdetail']['sel_nom'][$keyprod] = $sel_nom;
        //     $_SESSION['platdetail']['accomp_nom'][$keyprod] = $accomp_nom;
        //     $f++;
        // }
    }
}
function RenduRetour($usd_saisi, $cdf_saisi, $totrendu, $taux)
{
    $data = array();
    $data['r_usd'] = 0;
    $data['r_cdf'] = 0;
    $totrdpe = 0;
    $totrddc = 0;
    if ($usd_saisi > $cdf_saisi) {
        $totrendu_usd = $totrendu / $taux;
        $totrdpe = floor($totrendu_usd);
        $totrddc = $totrendu_usd - $totrdpe;
        $a = $totrdpe % 5;
        $x1 = $totrdpe / 5;
        $y = floor($x1);
        if ($y >= 1) {
            $r_usd = 5 * $y;
            $r_cdf = $totrddc * $taux + $a * $taux;
        } else {
            $r_usd = 0;
            $r_cdf = $totrendu;
        }
    } else {
        $r_usd = 0;
        $r_cdf = $totrendu;
    }
    $data['r_usd'] = $r_usd;
    $data['r_cdf'] = $r_cdf;
    return $data;
}
function AddLibelleDepense($code, $designation, $site_id, $bdd)
{
    $psedo = 0;
    $code = '';
    try {
        $requete = $bdd->prepare("INSERT INTO dep_libelles(code,designation,site_id) VALUES(:code,:designation,:site_id)");
        $requete->BindParam(':code', $code);
        $requete->BindParam(':designation', $designation);
        $requete->BindParam(':site_id', $site_id);
        $requete->execute();
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
function SelectLibelleDepense($site_id, $bdd)
{
    $requete = $bdd->prepare("SELECT * FROM dep_libelles AS a WHERE a.site_id=:site_id AND a.psedo=0 ORDER BY a.designation");
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
    $st = $requete->fetchAll(PDO::FETCH_OBJ);
    return $st;
}
function AddDepense($numero, $dte_dep, $motif, $usd, $cdf, $taux, $user_id, $libelle_id, $service, $sousresto_id, $site_id, $bdd)
{
    try {
        $requete = $bdd->prepare("INSERT INTO depenses (numero,dte_dep,motif,usd,cdf,taux,service,user_id,libelle_id,sousresto_id,site_id) VALUES(:numero,:dte_dep,:motif,:usd,:cdf,:taux,:service,:user_id,:libelle_id,:sousresto_id,:site_id)");
        $requete->BindParam(':numero', $numero);
        $requete->BindParam(':dte_dep', $dte_dep);
        $requete->BindParam(':motif', $motif);
        $requete->BindParam(':usd', $usd);
        $requete->BindParam(':cdf', $cdf);
        $requete->BindParam(':taux', $taux);
        $requete->BindParam(':service', $service);
        $requete->BindParam(':user_id', $user_id);
        $requete->BindParam(':libelle_id', $libelle_id);
        $requete->BindParam(':sousresto_id', $sousresto_id);
        $requete->BindParam(':site_id', $site_id);
        $requete->execute();
        $depense_id = $bdd->lastInsertId();
        return $depense_id;
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function SelectDepense($site_id, $dte1, $dte2, $bdd)
{
    $requete = $bdd->prepare("SELECT *,a.id as id FROM depenses AS a, dep_libelles AS b, t_utilisateur AS c
                                WHERE a.libelle_id=b.id AND a.user_id=c.id_user
                                AND a.site_id=:site_id AND a.psedo=0 
                                AND a.dte_dep BETWEEN :dte1 AND :dte2
                                ORDER BY a.id DESC");
    $requete->BindParam(':site_id', $site_id);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $st = $requete->fetchAll(PDO::FETCH_OBJ);
    return $st;
}
function SelectDepenseID($id, $bdd)
{
    $requete = $bdd->prepare("SELECT * FROM depenses AS a,dep_libelles AS b WHERE a.libelle_id=b.id AND a.id=:id");
    $requete->BindParam(':id', $id);
    $requete->execute();
    $st = $requete->fetch(PDO::FETCH_OBJ);
    return $st;
}

function SelectDetailsPlats($bdd)
{
    $requete = $bdd->prepare("SELECT * FROM  detailsplats WHERE hotel_id=:hotel_id ORDER BY nom");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $st = $requete->fetchAll(PDO::FETCH_OBJ);
    return $st;
}

function SelectDetailsPlats_ID($produit_id, $bdd)
{
    $requete = $bdd->prepare("SELECT * FROM  detailsplats AS b,platspreparations AS c WHERE b.id=c.detplat_id AND c.produit_id=:produit_id");
    $requete->BindParam(':produit_id', $produit_id);
    $requete->execute();
    $st = $requete->fetchAll(PDO::FETCH_OBJ);
    return $st;
}
function supprimer_detailsplat($cpt1)
{

    if (array_key_exists($cpt1, $_SESSION['platdetail']['cpt2'])) {
        $keyprod_sup = $_SESSION['platdetail']['cpt2'][$cpt1];
        unset($_SESSION['platdetail']['idprod'][$keyprod_sup]);
        unset($_SESSION['platdetail']['keyprods'][$keyprod_sup]);
    }
}

function SelectCouverts($dte1, $dte2, $site_id, $bdd)
{
    $requete = $bdd->prepare("SELECT f.id_fact, f.num_fact,f.nbrcouvert,f.date_edition,c.designation,c.id_client
                              FROM  t_facture AS f,t_client AS c
                              WHERE f.id_client=c.id_client 
                              AND f.type='restaurant' 
                              AND f.etat_cmd!=3 
                              AND f.date_edition BETWEEN :dte1 AND :dte2
                              AND f.id_hotel=:site_id");
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
    $st = $requete->fetchAll(PDO::FETCH_OBJ);
    return $st;
}

function ReimprimerBC2($id_fact, $impr, $bdd)
{
    $tva_fact = 0;
    $tauxfct = 1;
    $remise_fact = 0;
    $_SESSION['dessert'] = 0;
    $_SESSION['entree'] = 0;
    $_SESSION['plats'] = 0;
    $_SESSION['panier'] = array();
    $_SESSION['panier']['id_article'] = array();
    $_SESSION['panier']['nom'] = array();
    $_SESSION['panier']['qte'] = array();
    $_SESSION['panier']['prix'] = array();
    $_SESSION['panier']['repas'] = array();
    $_SESSION['panier']['genre'] = array();
    $_SESSION['panier']['pa'] = array();
    $_SESSION['panier']['description'] = array();
    $_SESSION['panier']['id_client'] = 0;
    $_SESSION['panier']['remise'] = 0;
    $_SESSION['panier']['mont_tva'] = 0;
    $_SESSION['panier']['mont_ttc'] = 0;
    $_SESSION['panier']['mont_ttc_remise'] = 0;
    $_SESSION['panier']['verrouille'] = false;
    $idcmd = $id_fact;
    $requete = $bdd->prepare("SELECT f.note_cmd,f.id_fact, f.montant_total,f.mont_tva,f.mont_ttc,f.date_edition,f.dte_time,f.mode,f.mont_ttc_remise,f.taux,f.tva,f.id_fact,f.num_fact,
                                f.id_res,c.designation,c.id_client,c.nom_client,c.designation,c.type,d.nom_user,d.prenom_user,f.nbrcouvert AS nbrcouvertfac,f.preparer,f.etat_cmd, f.serveur_id,f.serveur_name
                                FROM  t_client AS c,t_facture AS f,t_utilisateur AS d
                                 WHERE f.id_client=c.id_client AND f.id_user=d.id_user 
                                       AND f.id_fact=:cmd_id");
    $requete->BindParam(':cmd_id', $idcmd);
    $requete->execute();
    $reservation_attente = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($reservation_attente as $ra) {
        $_SESSION['nbrcouvert'] = $ra->nbrcouvertfac;
        $id = $ra->id_res;
        $id_fact = $ra->id_fact;
        $remise_fact = $ra->mont_ttc_remise;
        $mont_remise = $ra->tva;
        $tva_fact = $ra->tva;
        $mont_tva = $ra->mont_tva;
        $mont_ttc = $ra->mont_ttc;
        $id_cl = $ra->id_client;
        // $cmd_num = $ra->num_reserv;
        $tbl = $ra->designation;
        $cl = $ra->nom_client;
        $tauxfct = $ra->taux;
        $_SESSION['mode_fact'] = $ra->mode;
        $_SESSION['nom_user'] = $ra->nom_user;
        $_SESSION['date_edition'] = $ra->date_edition;
        //        $_SESSION['date_edition2'] = $ra->dte_time;
        $_SESSION['date_edition2'] = $ra->dte_time;
        $typ = $ra->type;
        if ($typ == 'client' || $typ == 'serveur') {
            $cl_tbl = $cl;
        } else if ($typ == 'table') {
            $cl_tbl = $tbl;
        } else {
            $cl_tbl = 'Occasionnel';
        }
        $_SESSION['num_commande'] = $ra->num_fact;
        $_SESSION['nom_client'] = $cl_tbl;
        $_SESSION['serveur_name'] = $ra->serveur_name;
        $_SESSION['id_client'] = $id_cl;
        $statut = 'En cours';
        if ($ra->preparer == 1) {
            $statut = 'Preparé';
        }
        if ($ra->etat_cmd == 3) {
            $statut = 'Annulé';
        }
        $_SESSION['preparer'] = $ra->preparer;
        $_SESSION['etat_cmd'] = $ra->etat_cmd;
        $_SESSION['statut_cmd'] = $statut;
        $note_cmd = $ra->note_cmd;
        $_SESSION['note_cmd'] = $note_cmd;
        $requete = $bdd->prepare("SELECT  p.idprod,p.designation,p.monnaie,p.repas,ss.genre,l.*
                                    FROM  lignes_commandes AS l,stk_produit As p,stk_sous_famille AS ss
                                    WHERE l.produit_id=p.idprod AND p.famille_id=ss.id_s_fam 
                                     AND l.commande_id=:cmd_id AND l.impr=:impr");
        $requete->BindParam(':cmd_id', $id_fact);
        $requete->BindParam(':impr', $impr);
        $requete->execute();
        $reservation_l_attente = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($reservation_l_attente as $r) {
            $qte = $r->qte;
            $lignecmd_id = $r->id;
            if (round($r->qte) == 0) {
                $qte = $r->qteoffert;
            }
            $prix = $r->prix;
            $idprod = $r->idprod;
            $designation = $r->designation;

            $repas = $r->repas;
            $genre = $r->genre;
            $impr = $r->impr;
            if ($impr == 1) {
                if ($r->qte2 != 0) {
                    $qte = $r->qte2;
                }
            }
            $des_plt = $r->accomp;
            $pa = $r->pa;

            array_push($_SESSION['panier']['id_article'], $idprod);
            array_push($_SESSION['panier']['nom'], $designation);
            array_push($_SESSION['panier']['qte'], $qte);
            array_push($_SESSION['panier']['prix'], $prix);
            array_push($_SESSION['panier']['repas'], $repas);
            array_push($_SESSION['panier']['genre'], $genre);
            array_push($_SESSION['panier']['pa'], $pa);
            array_push($_SESSION['panier']['description'], $des_plt);
            if ($genre == 2) {
                $_SESSION['dessert'] = 1;
            } elseif ($genre == 1) {
                $_SESSION['entree'] = 1;
            } elseif ($genre == 0) {
                $_SESSION['plats'] = 1;
            }
        }
        $mont_ht = 0;
        $nb_articles = count($_SESSION['panier']['id_article']);
        for ($i = 0; $i < $nb_articles; $i++) {
            $mont_ht += $_SESSION['panier']['qte'][$i] * $_SESSION['panier']['prix'][$i];
        }
        $total1 = $mont_ht;
        $total = total($total1, $tva_fact, $remise_fact);
        //        $mont_tva=tva($total,$tva_fact,$remise_fact);
        $mont_rmz = remise($total1, $tva_fact, $remise_fact);
        $mont_ht = ht($total, $tva_fact, $remise_fact);

        $ttc = ttc($mont_ht, $mont_tva, $mont_rmz);
        $ttc2 =  montant_equivalent_bdd('CDF', 'USD', $tauxfct, $ttc);
        $_SESSION['panier']['mont_tva'] = $mont_tva;
        $_SESSION['panier']['mont_ttc'] = $mont_ht - $mont_rmz;
        $_SESSION['panier']['mont_remise'] = $mont_rmz;
        $_SESSION['panier']['mont_ht'] = $mont_ht;
        $_SESSION['panier']['mont_ttc_remise'] = $ttc;
        $_SESSION['ttc2'] = $ttc2;
    }
}


function listaccompagnements2($bdd)
{
    $id = 34;
    $requete = $bdd->prepare("SELECT * FROM stk_produit AS a WHERE a.pseudo_supp=0 AND a.famille_id=:id ORDER BY  a.designation");
    $requete->BindParam(':id', $id);
    $requete->execute();
    $st = $requete->fetchAll(PDO::FETCH_OBJ);
    return $st;
}

function SelectSOFT($bdd)
{
    //$id = 47;
    $requete = $bdd->prepare("SELECT * FROM stk_produit AS a WHERE a.pseudo_supp=0 AND a.famille_id IN (21,12) ORDER BY  a.designation");
    // $requete->BindParam(':id', $id);
    $requete->execute();
    $st = $requete->fetchAll(PDO::FETCH_OBJ);
    return $st;
}
function SelectSOFTBTL($bdd)
{
    //$id = 47;
    $requete = $bdd->prepare("SELECT * FROM stk_produit AS a WHERE a.pseudo_supp=0 AND a.famille_id IN (47,12) ORDER BY  a.designation");
    // $requete->BindParam(':id', $id);
    $requete->execute();
    $st = $requete->fetchAll(PDO::FETCH_OBJ);
    return $st;
}
function SelectLegumes($bdd)
{
    $id = 31;
    $requete = $bdd->prepare("SELECT * FROM stk_produit AS a WHERE a.pseudo_supp=0 AND a.famille_id=:id ORDER BY  a.designation");
    $requete->BindParam(':id', $id);
    $requete->execute();
    $st = $requete->fetchAll(PDO::FETCH_OBJ);
    return $st;
}
function SelectBouteilles($bdd)
{
    $data = array();
    $id = 20;
    $requete = $bdd->prepare("SELECT * FROM stk_produit AS a WHERE a.pseudo_supp=0 AND a.famille_id=:id ORDER BY  a.designation");
    $requete->BindParam(':id', $id);
    $requete->execute();
    $st = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($st as $r) {
        $idprod = $r->idprod;
        array_push($data, $idprod);
    }
    return $data;
}

function ListAccompagnementsUPDT($plat_id, $hotel_id, $bdd)
{
    $requete = $bdd->prepare("SELECT * FROM t_accompagnement WHERE plat_id=:plat_id AND hotel_id=:hotel_id");
    $requete->BindParam(':plat_id', $plat_id);
    $requete->BindParam(':hotel_id', $hotel_id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function EnregAccompBoisson($site_id, $idprod, $accboissonvalues, $idtab, $bdd)
{
    $nb = 0;
    $bool = 0;
    $requete = $bdd->prepare("SELECT COUNT(*) AS nb_lg FROM accompagnment_boisson_values WHERE idboisson=:idboisson  AND site_id=:site_id AND idtab=:idtab");
    /* monnaie Mis pour les besoins de la cause */
    $requete->BindParam(':idboisson', $idprod);
    $requete->BindParam(':site_id', $site_id);
    $requete->BindParam(':idtab', $idtab);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op) :
        $nb = $op->nb_lg;
    endforeach;
    if ($nb > 0) $bool = 1;

    if ($bool == 0) {
        $requete = $bdd->prepare("INSERT INTO accompagnment_boisson_values (idboisson,chainevalue,site_id,idtab)
                VALUES(:idboisson,:chainevalue,:site_id,:idtab)");
        $requete->BindParam(':idboisson', $idprod);
        $requete->BindParam(':chainevalue', $accboissonvalues);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':idtab', $idtab);
        $requete->execute();
    } elseif ($bool == 1) {
        $requete = $bdd->prepare("UPDATE accompagnment_boisson_values SET chainevalue=:chainevalue WHERE idboisson=:idboisson AND site_id=:site_id AND idtab=:idtab");
        $requete->BindParam(':chainevalue', $accboissonvalues);
        $requete->BindParam(':idboisson', $idprod);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':idtab', $idtab);

        $requete->execute();
    }
}
function AffichAccompBoisson($site_id, $idprod, $idtab, $bdd)
{
    $accboissonvalues = "";
    $requete = $bdd->prepare("SELECT chainevalue FROM accompagnment_boisson_values WHERE idboisson=:idboisson  AND site_id=:site_id AND idtab=:idtab");
    $requete->BindParam(':idboisson', $idprod);
    $requete->BindParam(':site_id', $site_id);
    $requete->BindParam(':idtab', $idtab);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op) :
        $accboissonvalues = $op->chainevalue;
    endforeach;
    return $accboissonvalues;
}

function BonAnnulation($id_fact, $impr, $bdd)
{
    $tva_fact = 0;
    $tauxfct = 1;
    $remise_fact = 0;
    $_SESSION['dessert'] = 0;
    $_SESSION['entree'] = 0;
    $_SESSION['plats'] = 0;
    $_SESSION['panier'] = array();
    $_SESSION['panier']['id_article'] = array();
    $_SESSION['panier']['nom'] = array();
    $_SESSION['panier']['qte'] = array();
    $_SESSION['panier']['prix'] = array();
    $_SESSION['panier']['repas'] = array();
    $_SESSION['panier']['genre'] = array();
    $_SESSION['panier']['pa'] = array();
    $_SESSION['panier']['description'] = array();
    $_SESSION['panier']['id_client'] = 0;
    $_SESSION['panier']['remise'] = 0;
    $_SESSION['panier']['mont_tva'] = 0;
    $_SESSION['panier']['mont_ttc'] = 0;
    $_SESSION['panier']['mont_ttc_remise'] = 0;
    $_SESSION['panier']['verrouille'] = false;
    $idcmd = $id_fact;
    $requete = $bdd->prepare("SELECT f.id_fact, f.montant_total,f.mont_tva,f.mont_ttc,f.date_edition,f.dte_time,f.mode,f.mont_ttc_remise,f.taux,f.tva,f.id_fact,f.num_fact,
                                f.id_res,c.designation,c.id_client,c.nom_client,c.designation,c.type,d.nom_user,d.prenom_user,c.nbrcouvert,f.serveur_id,f.serveur_name
                                FROM  t_client AS c,t_facture AS f,t_utilisateur AS d
                                 WHERE f.id_client=c.id_client AND f.id_user=d.id_user 
                                       AND f.id_fact=:cmd_id");
    $requete->BindParam(':cmd_id', $idcmd);
    $requete->execute();
    $reservation_attente = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($reservation_attente as $ra) {
        $_SESSION['nbrcouvert'] = $ra->nbrcouvert;
        $id = $ra->id_res;
        $id_fact = $ra->id_fact;
        $remise_fact = $ra->mont_ttc_remise;
        $mont_remise = $ra->tva;
        $tva_fact = $ra->tva;
        $mont_tva = $ra->mont_tva;
        $mont_ttc = $ra->mont_ttc;
        $id_cl = $ra->id_client;
        $cmd_num = $ra->num_reserv;
        $tbl = $ra->designation;
        $cl = $ra->nom_client;
        $tauxfct = $ra->taux;
        $_SESSION['mode_fact'] = $ra->mode;
        $_SESSION['nom_user'] = $ra->nom_user;
        $_SESSION['date_edition'] = $ra->date_edition;
        //        $_SESSION['date_edition2'] = $ra->dte_time;
        $_SESSION['date_edition2'] = $ra->dte_time;
        $typ = $ra->type;
        if ($typ == 'client' || $typ == 'serveur') {
            $cl_tbl = $cl;
        } else if ($typ == 'table') {
            $cl_tbl = $tbl;
        } else {
            $cl_tbl = 'Occasionnel';
        }
        $_SESSION['num_commande'] = $ra->num_fact;
        $_SESSION['nom_client'] = $cl_tbl;
        $_SESSION['serveur_name'] = $ra->serveur_name;
        $requete = $bdd->prepare("SELECT  p.idprod,p.designation,p.monnaie,p.repas,ss.genre,l.*
                                    FROM  lignes_commandes AS l,stk_produit As p,stk_sous_famille AS ss
                                    WHERE l.produit_id=p.idprod AND p.famille_id=ss.id_s_fam 
                                     AND l.commande_id=:cmd_id");
        $requete->BindParam(':cmd_id', $id_fact);
        $requete->execute();
        $reservation_l_attente = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($reservation_l_attente as $r) {
            $qte = $r->qte;
            $lignecmd_id = $r->id;
            if (round($r->qte) == 0) {
                $qte = $r->qteoffert;
            }
            $prix = $r->prix;
            $idprod = $r->idprod;
            $designation = $r->designation;

            $repas = $r->repas;
            $genre = $r->genre;
            $impr = $r->impr;
            if ($impr == 1) {
                if ($r->qte2 != 0) {
                    $qte = $r->qte2;
                }
            }
            $des_plt = $r->accomp;
            $pa = $r->pa;
            array_push($_SESSION['panier']['id_article'], $idprod);
            array_push($_SESSION['panier']['nom'], $designation);
            array_push($_SESSION['panier']['qte'], $qte);
            array_push($_SESSION['panier']['prix'], $prix);
            array_push($_SESSION['panier']['repas'], $repas);
            array_push($_SESSION['panier']['genre'], $genre);
            array_push($_SESSION['panier']['pa'], $pa);
            array_push($_SESSION['panier']['description'], $des_plt);
            if ($genre == 2) {
                $_SESSION['dessert'] = 1;
            } elseif ($genre == 1) {
                $_SESSION['entree'] = 1;
            } elseif ($genre == 0) {
                $_SESSION['plats'] = 1;
            }
        }
        $mont_ht = 0;
        $nb_articles = count($_SESSION['panier']['id_article']);
        for ($i = 0; $i < $nb_articles; $i++) {
            $mont_ht += $_SESSION['panier']['qte'][$i] * $_SESSION['panier']['prix'][$i];
        }
        $total1 = $mont_ht;
        $total = total($total1, $tva_fact, $remise_fact);
        //        $mont_tva=tva($total,$tva_fact,$remise_fact);
        $mont_rmz = remise($total1, $tva_fact, $remise_fact);
        $mont_ht = ht($total, $tva_fact, $remise_fact);

        $ttc = ttc($mont_ht, $mont_tva, $mont_rmz);
        $ttc2 =  montant_equivalent_bdd('CDF', 'USD', $tauxfct, $ttc);
        $_SESSION['panier']['mont_tva'] = $mont_tva;
        $_SESSION['panier']['mont_ttc'] = $mont_ht - $mont_rmz;
        $_SESSION['panier']['mont_remise'] = $mont_rmz;
        $_SESSION['panier']['mont_ht'] = $mont_ht;
        $_SESSION['panier']['mont_ttc_remise'] = $ttc;
        $_SESSION['ttc2'] = $ttc2;
    }
}

function ReimprimerPOS2($id_fact, $bdd)
{
    $tva_fact = 0;
    $tauxfct = 1;
    $remise_fact = 0;
    $_SESSION['panier1'] = array();
    $_SESSION['panier1']['id_article'] = array();
    $_SESSION['panier1']['nom'] = array();
    $_SESSION['panier1']['qte'] = array();
    $_SESSION['panier1']['prix'] = array();
    $_SESSION['panier1']['repas'] = array();
    $_SESSION['panier1']['id_client'] = 0;
    $_SESSION['panier1']['remise'] = 0;
    $_SESSION['panier1']['mont_tva'] = 0;
    $_SESSION['panier1']['mont_ttc'] = 0;
    $_SESSION['panier1']['mont_ttc_remise'] = 0;
    $_SESSION['panier1']['verrouille'] = false;
    $idcmd = $id_fact;
    $requete = $bdd->prepare("SELECT f.id_fact, f.montant_total,f.mont_tva,f.mont_ttc,f.date_edition,f.dte_time,f.mode,f.mont_ttc_remise,f.taux,f.tva,f.id_fact,f.num_fact,
                                f.id_res,c.designation,c.id_client,c.nom_client,c.designation,c.type,d.nom_user,d.prenom_user,f.nbrcouvert,f.nomcaisse
                                FROM  t_client AS c,t_facture AS f,t_utilisateur AS d
                                 WHERE f.id_client=c.id_client AND f.id_user=d.id_user 
                                       AND c.user_attente=d.id_user
                                       AND f.id_fact=:cmd_id");
    $requete->BindParam(':cmd_id', $idcmd);
    $requete->execute();
    $reservation_attente = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($reservation_attente as $ra) {
        $id = $ra->id_res;
        $id_fact = $ra->id_fact;
        $remise_fact = $ra->mont_ttc_remise;
        $mont_remise = $ra->tva;
        $tva_fact = $ra->tva;
        $mont_tva = $ra->mont_tva;
        $mont_ttc = $ra->mont_ttc;
        $id_cl = $ra->id_client;
        //  $cmd_num = $ra->num_reserv;
        $tbl = $ra->designation;
        $cl = $ra->nom_client;
        $tauxfct = $ra->taux;
        $_SESSION['tauxfct'] = $ra->taux;
        $_SESSION['nbrcouvert'] = $ra->nbrcouvert;
        $_SESSION['mode_fact'] = $ra->mode;
        $_SESSION['date_edition'] = $ra->date_edition;
        //      $_SESSION['date_edition2'] = $ra->dte_time;
        $_SESSION['date_edition2'] = $ra->date_edition;
        $_SESSION['nomserveur'] = $ra->nom_user;
        $typ = $ra->type;
        if ($typ == 'client' || $typ == 'serveur') {
            $cl_tbl = $cl;
        } else if ($typ == 'table') {
            $cl_tbl = $tbl;
        } else {
            $cl_tbl = 'Occasionnel';
        }
        $_SESSION['num_commande'] = $ra->num_fact;
        $_SESSION['nom_client'] = $cl_tbl;
        $requete = $bdd->prepare("SELECT  p.idprod,p.designation,p.monnaie,p.repas,l.*
                                    FROM  lignes_commandes AS l,stk_produit As p 
                                    WHERE l.produit_id=p.idprod AND l.commande_id=:cmd_id");
        $requete->BindParam(':cmd_id', $id_fact);
        $requete->execute();
        $reservation_l_attente = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($reservation_l_attente as $r) {
            $qte = $r->qte;
            if (round($r->qte) == 0) {
                $qte = $r->qteoffert;
            }
            $prix = $r->prix;
            $idprod = $r->idprod;
            $designation = $r->designation;
            if ($r->accomp != '') {
                $designation = $r->designation . ' avec ' . $r->accomp;
            }
            $repas = $r->repas;

            array_push($_SESSION['panier1']['id_article'], $idprod);
            array_push($_SESSION['panier1']['nom'], $designation);
            array_push($_SESSION['panier1']['qte'], $qte);
            array_push($_SESSION['panier1']['prix'], $prix);
            array_push($_SESSION['panier1']['repas'], $repas);
        }
        $mont_ht = 0;
        $nb_articles = count($_SESSION['panier1']['id_article']);
        for ($i = 0; $i < $nb_articles; $i++) {
            $mont_ht += $_SESSION['panier1']['qte'][$i] * $_SESSION['panier1']['prix'][$i];
        }
        $total1 = $mont_ht;
        $total = total($total1, $tva_fact, $remise_fact);
        //        $mont_tva=tva($total,$tva_fact,$remise_fact);
        $mont_rmz = remise($total1, $tva_fact, $remise_fact);
        $mont_ht = ht($total, $tva_fact, $remise_fact);

        $ttc = ttc($mont_ht, $mont_tva, $mont_rmz);
        $ttc2 =  montant_equivalent_bdd('CDF', 'USD', $tauxfct, $ttc);
        $_SESSION['panier1']['mont_tva'] = $mont_tva;
        $_SESSION['panier1']['mont_ttc'] = $mont_ht - $mont_rmz;
        $_SESSION['panier1']['mont_remise'] = $mont_rmz;
        $_SESSION['panier1']['mont_ht'] = $mont_ht;
        $_SESSION['panier1']['mont_ttc_remise'] = $ttc;
        $_SESSION['ttc2'] = $ttc2;
    }
}
function DetailsVenteTout($date_bd1, $date_bd2, $bdd)
{
    $idsite = $_SESSION['id_hotel'];
    $requete = $bdd->prepare("SELECT e.familletype_id,b.prixremise,a.taux_prix,a.monnaie,a.mode,a.mont_ttc_remise,c.idprod,c.code, c.designation,c.repas,c.nourriture,
                SUM(b.qte) AS qte, b.prixremise AS pu, b.dte_h,a.mode AS lib,SUM(((b.qte*b.prix)-((b.qte*b.prix*a.mont_ttc_remise)/100))) AS mont,
                SUM(b.qteoffert) AS qteoffert,SUM(b.qteoffert*b.prix2) AS montof
            FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a,
            stk_sous_famille AS d,stk_famille AS e,stk_familletype AS f
            WHERE a.id_fact=b.commande_id 
            AND b.produit_id= c.idprod
            AND c.famille_id=d.id_s_fam
            AND d.famille=e.idfamille
            AND e.familletype_id=f.id
            AND a.mode IS NOT NULL
            AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
            AND a.id_hotel  =:id_hotel 
            GROUP BY c.idprod, b.prixremise,a.mode  
            ORDER BY c.nourriture,c.designation");
    $requete->BindParam(':date_bd1', $date_bd1);
    $requete->BindParam(':date_bd2', $date_bd2);
    $requete->BindParam(':id_hotel', $idsite);
    $requete->execute();
    $articles3 = $requete->fetchAll(PDO::FETCH_OBJ);
    //  var_dump($articles3);
    return $articles3;
}
function DetailsVenteToutOld($date_bd1, $date_bd2, $bdd)
{
    $idsite = $_SESSION['id_hotel'];
    $requete = $bdd->prepare("SELECT e.familletype_id,b.prixremise,a.taux_prix,a.monnaie,a.mode,a.mont_ttc_remise,c.idprod,c.code, c.designation,c.repas,c.nourriture,
                SUM(b.qte) AS qte, b.prixremise AS pu, b.dte_h,a.mode AS lib,SUM((b.qte*b.prixremise)/a.taux_prix) AS mont,
                SUM(b.qteoffert) AS qteoffert,SUM(b.qteoffert*b.prix2) AS montof
            FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a,
            stk_sous_famille AS d,stk_famille AS e,stk_familletype AS f
            WHERE a.id_fact=b.commande_id 
            AND b.produit_id= c.idprod
            AND c.famille_id=d.id_s_fam
            AND d.famille=e.idfamille
            AND e.familletype_id=f.id
            AND a.mode IS NOT NULL
            AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
            AND a.id_hotel  =:id_hotel 
            GROUP BY c.idprod, b.prixremise, a.mode2  
            ORDER BY c.nourriture,c.designation");
    $requete->BindParam(':date_bd1', $date_bd1);
    $requete->BindParam(':date_bd2', $date_bd2);
    $requete->BindParam(':id_hotel', $idsite);
    $requete->execute();
    $articles3 = $requete->fetchAll(PDO::FETCH_OBJ);
    return $articles3;
}

function NombreCouvert($date_bd1, $date_bd2, $bdd)
{
    $idsite = $_SESSION['id_hotel'];
    $nbrcouvert = 0;
    $requete = $bdd->prepare("SELECT SUM(a.nbrcouvert) AS nbrcouvert
        FROM  t_facture AS a
        WHERE a.date_edition  BETWEEN :date_bd1 AND :date_bd2
        AND a.id_hotel  =:id_hotel 
        AND a.etat_cmd NOT IN('1','3')
        ");
    $requete->BindParam(':date_bd1', $date_bd1);
    $requete->BindParam(':date_bd2', $date_bd2);
    $requete->BindParam(':id_hotel', $idsite);
    $requete->execute();
    $articles3 = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($articles3 as $sr) {
        $nbrcouvert = $sr->nbrcouvert;
    }
    return $nbrcouvert;
}

function SelectVolalles($bdd)
{
    $id = 34;
    $d = array();
    $requete = $bdd->prepare("SELECT * FROM stk_produit AS a WHERE a.pseudo_supp=0 AND a.famille_id=:id ORDER BY  a.designation");
    $requete->BindParam(':id', $id);
    $requete->execute();
    $volailles = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($volailles as $sr) {
        $idprod = $sr->idprod;
        array_push($d, $idprod);
    }
    return $d;
}

function CheckAllCmdCustomer($id, $bdd)
{
    $req = "
        SELECT a.*,c.id_client,
        c.nom_client,c.designation,c.type,c.adresse_provenance_client,c.email_client,c.telephone_client,c.sexe_client
            FROM t_facture a,t_client c
             WHERE a.id_client=c.id_client
                   AND a.id_client=:id_client
                   AND a.etat_cmd=1
                   ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id_client', $id);
    $requete->execute();
    $bool = 0;
    $nblgn = $requete->rowCount();
    if ($nblgn > 0) {
        $bool = 1;
    }

    return $bool;
}
function InfosUser($id_user, $bdd)
{
    $datas = array();
    $datas['nom_user '] = 0;
    $datas['prenom_user'] = 0;
    $requete = $bdd->prepare("SELECT * FROM  t_utilisateur WHERE id_user=:id_user");
    $requete->BindParam(':id_user', $id_user);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $datas['nom_user'] = $r->nom_user;
        $datas['prenom_user'] = $r->prenom_user;
    }
    return $datas;
}
function DetailsVenteServeur($date_bd1, $date_bd2, $serveur_id, $bdd)
{
    $idsite = $_SESSION['id_hotel'];
    $requete = $bdd->prepare("SELECT e.familletype_id,b.prixremise,a.taux_prix,a.monnaie,a.mode,a.mont_ttc_remise,c.idprod,c.code, c.designation,c.repas,c.nourriture,
    SUM(b.qte) AS qte, b.prixremise AS pu, b.dte_h,a.mode AS lib,SUM((b.qte*b.prixremise)/a.taux_prix) AS mont,
    SUM(b.qteoffert) AS qteoffert,SUM(b.qteoffert*b.prix2) AS montof
FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a,
stk_sous_famille AS d,stk_famille AS e,stk_familletype AS f
WHERE a.id_fact=b.commande_id 
AND b.produit_id= c.idprod
AND c.famille_id=d.id_s_fam
AND d.famille=e.idfamille
AND e.familletype_id=f.id
AND a.mode IS NOT NULL
AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
AND a.id_hotel  =:id_hotel
AND a.id_user  =:id_user 
GROUP BY c.idprod, b.prixremise, a.mode  
ORDER BY c.nourriture,c.designation");
    $requete->BindParam(':date_bd1', $date_bd1);
    $requete->BindParam(':date_bd2', $date_bd2);
    $requete->BindParam(':id_hotel', $idsite);
    $requete->BindParam(':id_user', $serveur_id);
    $requete->execute();
    $articles3 = $requete->fetchAll(PDO::FETCH_OBJ);
    return $articles3;
}
function NombreCouvertServeur($date_bd1, $date_bd2, $serveur_id, $bdd)
{
    $idsite = $_SESSION['id_hotel'];
    $nbrcouvert = 0;
    $requete = $bdd->prepare("SELECT SUM(a.nbrcouvert) AS nbrcouvert
        FROM  t_facture AS a
        WHERE a.date_edition  BETWEEN :date_bd1 AND :date_bd2
        AND a.id_hotel  =:id_hotel 
        AND a.id_user  =:id_user 
        AND a.etat_cmd NOT IN('1','3')
        ");
    $requete->BindParam(':date_bd1', $date_bd1);
    $requete->BindParam(':date_bd2', $date_bd2);
    $requete->BindParam(':id_hotel', $idsite);
    $requete->BindParam(':id_user', $serveur_id);
    $requete->execute();
    $articles3 = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($articles3 as $sr) {
        $nbrcouvert = $sr->nbrcouvert;
    }
    return $nbrcouvert;
}
function CheckDetailsProduit($idprod, $bdd)
{

    $requete = $bdd->prepare("SELECT * FROM  stk_produit WHERE idprod=:idprod");
    $requete->BindParam(':idprod', $idprod);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result;
}
function SelectBIERE($bdd)
{
    // $id =14;
    $requete = $bdd->prepare("SELECT * FROM stk_produit AS a WHERE a.pseudo_supp=0 AND a.famille_id IN(14,12) ORDER BY  a.designation");
    //  $requete->BindParam(':id', $id);
    $requete->execute();
    $st = $requete->fetchAll(PDO::FETCH_OBJ);
    return $st;
}

function ReinitialiserPanier()
{
    $_SESSION['panier'] = array();
    $_SESSION['panier']['cpt'] = array();
    $_SESSION['panier']['id_article'] = array();
    $_SESSION['panier']['nom'] = array();
    $_SESSION['panier']['qte'] = array();
    $_SESSION['panier']['qteoffert'] = array();
    $_SESSION['panier']['pa'] = array();
    $_SESSION['panier']['description'] = array();
    $_SESSION['panier']['prix'] = array();
    $_SESSION['panier']['prix2'] = array();
    $_SESSION['panier']['repas'] = array();
    $_SESSION['panier']['offre'] = array();
    $_SESSION['panier']['genre'] = array();
    $_SESSION['panier']['id_client'] = 0;
    $_SESSION['panier']['remise'] = 0;
    $_SESSION['panier']['mont_tva'] = 0;
    $_SESSION['panier']['mont_ttc'] = 0;
    $_SESSION['panier']['mont_ttc_remise'] = 0;
    $_SESSION['panier']['verrouille'] = false;
    $_SESSION['cptpanier'] = 0;
    $_SESSION['panier']['qi'] = array();
    $_SESSION['panier']['qlimit'] = array();
}

function insertMonitoringCommande($agent, $qte, $produit_id, $description, $facture_id, $suppr, $prix, $monnaie, $repas, $bdd)
{
    $dte_time = date('Y-m-d H:i:s');
    $heure = date('H:i:s');
    $requete = $bdd->prepare("INSERT INTO suivifactures(dte_time,heure,agent,qte,produit_id,facture_id,suppr,description,prix,monnaie,repas)
                VALUES(:dte_time,:heure,:agent,:qte,:produit_id,:facture_id,:suppr,:description,:prix,:monnaie,:repas)");
    $requete->BindParam(':dte_time', $dte_time);
    $requete->BindParam(':heure', $heure);
    $requete->BindParam(':agent', $agent);
    $requete->BindParam(':qte', $qte);
    $requete->BindParam(':produit_id', $produit_id);
    $requete->BindParam(':facture_id', $facture_id);
    $requete->BindParam(':suppr', $suppr);
    $requete->BindParam(':description', $description);
    $requete->BindParam(':prix', $prix);
    $requete->BindParam(':monnaie', $monnaie);
    $requete->BindParam(':repas', $repas);
    $requete->execute();
}

function SelectProduitsMonitoringGroupes($facture_id, $bdd)
{
    $requete = $bdd->prepare("SELECT a.produit_id,SUM(a.qte) AS qte,b.designation FROM suivifactures AS a, stk_produit AS b 
                            WHERE a.produit_id=b.idprod AND  a.facture_id=:facture_id GROUP BY a.produit_id ORDER BY a.heure,b.designation");
    $requete->BindParam(':facture_id', $facture_id);
    $requete->execute();
    $st = $requete->fetchAll(PDO::FETCH_OBJ);
    return $st;
}
function SelectProduitsMonitoringDetails($facture_id, $bdd)
{
    $requete = $bdd->prepare("SELECT a.*,b.designation FROM suivifactures AS a, stk_produit AS b 
                            WHERE a.produit_id=b.idprod AND a.facture_id=:facture_id ORDER BY a.heure");
    $requete->BindParam(':facture_id', $facture_id);
    $requete->execute();
    $st = $requete->fetchAll(PDO::FETCH_OBJ);
    return $st;
}
//Confinement
function AllCommmandesFusion($id, $type, $dte1, $dte2, $bdd)
{
    //Retourne toutes les commandes du sous-resto
    $req = "
        SELECT a.*,d.*
            FROM t_facture a,t_utilisateur AS d
             WHERE a.id_user=d.id_user 
                   AND a.id_sousresto=:id
                   AND a.fusion=1
                   AND a.type=:type
                   AND mode IS NOT NULL
                   AND a.date_edition BETWEEN :dte1 AND :dte2
                   ORDER BY a.id_fact DESC
                   ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->BindParam(':type', $type);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function ExtraitDEcompte($idclient, $date_bd1, $date_bd2, $bdd)
{
    $data = array();
    $data['id'] = array();
    $data['date'] = array();
    $data['numfact'] = array();
    $data['numrecu'] = array();
    $data['debitusd'] = array();
    $data['creditusd'] = array();
    $data['debitcdf'] = array();
    $data['creditcdf'] = array();
    $data['taux'] = array();
    $m_affiche = getsymbole_local();
    $requete = $bdd->prepare("SELECT * FROM t_facture AS a, t_client AS b 
                                WHERE a.id_client=b.id_client
                                     AND b.id_client=:idcl
                                     AND a.type='restaurant'
                                     AND a.etat_cmd=0 ");
    $requete->BindParam(':idcl', $idclient);
    $requete->execute();
    $factures = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($factures as $fct) {
        $debitusd = 0;
        $debitcdf = 0;
        $numfact = $fct->num_fact;
        $id_fact = $fct->id_fact;
        $taux = $fct->taux;
        $monnaie = $fct->monnaie;
        $date_edition = $fct->date_edition;
        $totalfact = $fct->mont_ttc;
        if ($monnaie == 'CDF') {
            $debitcdf = $totalfact;
        } else {
            $debitusd = $totalfact;
        }
        $requete = $bdd->prepare("SELECT * FROM t_reglement AS c, paiement AS d WHERE c.id_regl=d.regl_id AND c.id_fact=:id_fact ORDER BY c.dte");
        $requete->BindParam(':id_fact', $id_fact);
        $requete->execute();
        $paiements = $requete->fetchAll(PDO::FETCH_OBJ);

        $nbre = count($paiements);
        if ($nbre > 0) {
            foreach ($paiements as $p) {
                $creditusd = 0;
                $creditcdf = 0;
                $numrecu = $p->numero;
                $montantusd = $p->montantusd;
                $montantcdf = $p->montantcdf;
                $creditcdf = $montantcdf;
                $creditusd = $montantusd;
                $taux = $p->taux;
                array_push($data['id'], $id_fact);
                array_push($data['date'], $date_edition);
                if (!in_array($numfact, $data['numfact'])) {
                    array_push($data['numfact'], $numfact);
                } else {
                    array_push($data['numfact'], $numfact);
                    $debitcdf = 0;
                    $debitusd = 0;
                }
                array_push($data['numrecu'], $numrecu);
                array_push($data['debitcdf'], $debitcdf);
                array_push($data['creditcdf'], $creditcdf);
                array_push($data['debitusd'], $debitusd);
                array_push($data['creditusd'], $creditusd);
                array_push($data['taux'], $taux);
            }
        } else {
            array_push($data['id'], $id_fact);
            array_push($data['date'], $date_edition);
            array_push($data['numfact'], $numfact);
            array_push($data['numrecu'], '');
            array_push($data['debitcdf'], $debitcdf);
            array_push($data['creditcdf'], 0);
            array_push($data['debitusd'], $debitusd);
            array_push($data['creditusd'], 0);
            array_push($data['taux'], 1);
        }
    }

    return  $data;
}

function FusionIDs($id_tbl, $bdd)
{
    $data = array();
    $data['ids'] = array();
    $requete = $bdd->prepare("SELECT * FROM  fusion_tables WHERE id_tbl=:id_tbl");
    $requete->BindParam(':id_tbl', $id_tbl);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op) {
        $id_tbl_fus = $op->id_tbl_fus;
        array_push($data['ids'], $id_tbl_fus);
    }
    return  $data;
}
function fusion_fact($id_fact_fus, $bdd)
{
    $data = array();
    $data['ids'] = array();
    $requete = $bdd->prepare("SELECT * FROM fusion_factures WHERE id_fact_fus=:id_fact_fus");
    $requete->BindParam(':id_fact_fus', $id_fact_fus);
    $requete->execute();
    $fact_filter = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($fact_filter as $fact) {
        $id_fact = $fact->id_fact;
        array_push($data['ids'], $id_fact);
    }
    return  $data;
}
function ReturnFusionID($id_fact, $bdd)
{
    $requete = $bdd->prepare("SELECT * FROM  fusion_factures WHERE id_fact =:id_fact ");
    $requete->BindParam(':id_fact', $id_fact);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    $id_fact_fus = 0;
    foreach ($operations as $op) {
        $id_fact_fus = $op->id_fact_fus;
    }
    return  $id_fact_fus;
}
//Confinement

function PaiementCreance($dte1, $dte2, $bdd)
{
    $total = 0;
    $idsite = $_SESSION['id_hotel'];
    $requete = $bdd->prepare("SELECT f.id_fact,f.taux,b.montantcdf,b.montantusd,b.rendu_cdf,b.rendu_usd
        FROM t_facture AS f,t_reglement AS fa,paiement AS b
        WHERE f.id_fact=fa.id_fact 
            AND fa.id_regl=b.regl_id
            AND f.mode='Credit'
            AND b.id_mode_regl IN(2,3)
            AND fa.dte BETWEEN :dte1 AND :dte2
            AND  b.site_id=:id_hotel");
    $requete->BindParam(':id_hotel', $idsite);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $taux = $r->taux;
        $montantusd = $r->montantusd;
        $rendu_usd = $r->rendu_usd;
        $montantcdf = $r->montantcdf;
        $rendu_cdf = $r->rendu_cdf;
        $total += ($montantusd - $rendu_usd) + ($montantcdf - $rendu_cdf) ;
    }
    return $total;
}


function SelectVinMaison($bdd)
{
    // $id =14;
    $requete = $bdd->prepare("SELECT * FROM stk_produit AS a WHERE a.pseudo_supp=0 AND a.repas!=3 AND a.famille_id IN(10) ORDER BY  a.designation");
    //  $requete->BindParam(':id', $id);
    $requete->execute();
    $st = $requete->fetchAll(PDO::FETCH_OBJ);
    return $st;
}
function getProdLierMesurette($idprod, $bdd)
{

    $requete = $bdd->prepare("SELECT * FROM  t_ingredient WHERE plat_id=:idprod");
    $requete->BindParam(':idprod', $idprod);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function ReimprimerBC_Reprint_Lines($id_fact, $impr, $bdd)
{
    $tva_fact = 0;
    $tauxfct = 1;
    $remise_fact = 0;
    $_SESSION['dessert'] = 0;
    $_SESSION['entree'] = 0;
    $_SESSION['plats'] = 0;
    $_SESSION['panier'] = array();
    $_SESSION['panier']['id_article'] = array();
    $_SESSION['panier']['nom'] = array();
    $_SESSION['panier']['qte'] = array();
    $_SESSION['panier']['prix'] = array();
    $_SESSION['panier']['repas'] = array();
    $_SESSION['panier']['genre'] = array();
    $_SESSION['panier']['pa'] = array();
    $_SESSION['panier']['description'] = array();
    $_SESSION['panier']['id_client'] = 0;
    $_SESSION['panier']['remise'] = 0;
    $_SESSION['panier']['mont_tva'] = 0;
    $_SESSION['panier']['mont_ttc'] = 0;
    $_SESSION['panier']['mont_ttc_remise'] = 0;
    $_SESSION['panier']['verrouille'] = false;
    $idcmd = $id_fact;
    $requete = $bdd->prepare("SELECT f.note_cmd,f.id_fact, f.montant_total,f.mont_tva,f.mont_ttc,f.date_edition,f.dte_time,f.mode,f.mont_ttc_remise,f.taux,f.tva,f.id_fact,f.num_fact,
                                f.id_res,c.designation,c.id_client,c.nom_client,c.designation,c.type,d.nom_user,d.prenom_user,f.nbrcouvert AS nbrcouvertfac,f.preparer,f.etat_cmd
                                FROM  t_client AS c,t_facture AS f,t_utilisateur AS d
                                 WHERE f.id_client=c.id_client AND f.id_user=d.id_user 
                                       AND f.id_fact=:cmd_id");
    $requete->BindParam(':cmd_id', $idcmd);
    $requete->execute();
    $reservation_attente = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($reservation_attente as $ra) {
        $_SESSION['nbrcouvert'] = $ra->nbrcouvertfac;
        $id = $ra->id_res;
        $id_fact = $ra->id_fact;
        $remise_fact = $ra->mont_ttc_remise;
        $mont_remise = $ra->tva;
        $tva_fact = $ra->tva;
        $mont_tva = $ra->mont_tva;
        $mont_ttc = $ra->mont_ttc;
        $id_cl = $ra->id_client;
        // $cmd_num = $ra->num_reserv;
        $tbl = $ra->designation;
        $cl = $ra->nom_client;
        $tauxfct = $ra->taux;
        $_SESSION['mode_fact'] = $ra->mode;
        $_SESSION['nom_user'] = $ra->nom_user;
        $_SESSION['date_edition'] = $ra->date_edition;
        //        $_SESSION['date_edition2'] = $ra->dte_time;
        $_SESSION['date_edition2'] = $ra->dte_time;
        $typ = $ra->type;
        if ($typ == 'client' || $typ == 'serveur') {
            $cl_tbl = $cl;
        } else if ($typ == 'table') {
            $cl_tbl = $tbl;
        } else {
            $cl_tbl = 'Occasionnel';
        }
        $_SESSION['num_commande'] = $ra->num_fact;
        $_SESSION['nom_client'] = $cl_tbl;
        $_SESSION['id_client'] = $id_cl;
        $statut = 'En cours';
        if ($ra->preparer == 1) {
            $statut = 'Preparé';
        }
        if ($ra->etat_cmd == 3) {
            $statut = 'Annulé';
        }
        $_SESSION['statut_cmd'] = $statut;
        $note_cmd = $ra->note_cmd;
        $_SESSION['note_cmd'] = $note_cmd;
        $requete = $bdd->prepare("SELECT  l.id AS idlgcmd,p.idprod,p.designation,p.monnaie,p.repas,ss.genre,l.*
                                    FROM  lignes_commandes AS l,stk_produit As p,stk_sous_famille AS ss
                                    WHERE l.produit_id=p.idprod AND p.famille_id=ss.id_s_fam 
                                     AND l.commande_id=:cmd_id");
        $requete->BindParam(':cmd_id', $id_fact);
        $requete->execute();
        $reservation_l_attente = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($reservation_l_attente as $r) {
            $idlgcmd = $r->idlgcmd;
            if (in_array($idlgcmd, $_SESSION['ProduitsSelectiones']['id_produit'])) {
                $idprod = $r->idprod;
                $qte = $r->qte;
                $prix = $r->prix;
                $designation = $r->designation;
                $repas = $r->repas;
                $genre = $r->genre;
                $des_plt = $r->accomp;
                $qte_modif = $_SESSION['ProduitsSelectiones']['qte_modif'][$idlgcmd];
                if ($qte_modif <= $qte) {
                    $qte = $qte_modif;
                }
                array_push($_SESSION['panier']['id_article'], $idprod);
                array_push($_SESSION['panier']['nom'], $designation);
                array_push($_SESSION['panier']['qte'], $qte);
                array_push($_SESSION['panier']['prix'], $prix);
                array_push($_SESSION['panier']['repas'], $repas);
                array_push($_SESSION['panier']['genre'], $genre);
                array_push($_SESSION['panier']['pa'], $idlgcmd);
                array_push($_SESSION['panier']['description'], $des_plt);
                if ($genre == 2) {
                    $_SESSION['dessert'] = 1;
                } elseif ($genre == 1) {
                    $_SESSION['entree'] = 1;
                } elseif ($genre == 0) {
                    $_SESSION['plats'] = 1;
                }
            }
        }
        $mont_ht = 0;
        $nb_articles = count($_SESSION['panier']['id_article']);
        for ($i = 0; $i < $nb_articles; $i++) {
            $idlgcmd = $_SESSION['panier']['pa'][$i];
            if (in_array($idlgcmd, $_SESSION['ProduitsSelectiones']['id_produit'])) {

                $mont_ht += $_SESSION['panier']['qte'][$i] * $_SESSION['panier']['prix'][$i];
            }
        }
        $total1 = $mont_ht;
        $total = total($total1, $tva_fact, $remise_fact);
        //        $mont_tva=tva($total,$tva_fact,$remise_fact);
        $mont_rmz = remise($total1, $tva_fact, $remise_fact);
        $mont_ht = ht($total, $tva_fact, $remise_fact);

        $ttc = ttc($mont_ht, $mont_tva, $mont_rmz);
        $ttc2 =  montant_equivalent_bdd('CDF', 'USD', $tauxfct, $ttc);
        $_SESSION['panier']['mont_tva'] = $mont_tva;
        $_SESSION['panier']['mont_ttc'] = $mont_ht - $mont_rmz;
        $_SESSION['panier']['mont_remise'] = $mont_rmz;
        $_SESSION['panier']['mont_ht'] = $mont_ht;
        $_SESSION['panier']['mont_ttc_remise'] = $ttc;
        $_SESSION['ttc2'] = $ttc2;
    }
}
function ReimprimerBC_Reprint_All($id_fact, $impr, $bdd)
{
    $tva_fact = 0;
    $tauxfct = 1;
    $remise_fact = 0;
    $_SESSION['dessert'] = 0;
    $_SESSION['entree'] = 0;
    $_SESSION['plats'] = 0;
    $_SESSION['panier'] = array();
    $_SESSION['panier']['id_article'] = array();
    $_SESSION['panier']['nom'] = array();
    $_SESSION['panier']['qte'] = array();
    $_SESSION['panier']['prix'] = array();
    $_SESSION['panier']['repas'] = array();
    $_SESSION['panier']['genre'] = array();
    $_SESSION['panier']['pa'] = array();
    $_SESSION['panier']['description'] = array();
    $_SESSION['panier']['id_client'] = 0;
    $_SESSION['panier']['remise'] = 0;
    $_SESSION['panier']['mont_tva'] = 0;
    $_SESSION['panier']['mont_ttc'] = 0;
    $_SESSION['panier']['mont_ttc_remise'] = 0;
    $_SESSION['panier']['verrouille'] = false;
    $idcmd = $id_fact;
    $requete = $bdd->prepare("SELECT f.note_cmd,f.id_fact, f.montant_total,f.mont_tva,f.mont_ttc,f.date_edition,f.dte_time,f.mode,f.mont_ttc_remise,f.taux,f.tva,f.id_fact,f.num_fact,
                                f.id_res,c.designation,c.id_client,c.nom_client,c.designation,c.type,d.nom_user,d.prenom_user,f.nbrcouvert AS nbrcouvertfac,f.preparer,f.etat_cmd
                                FROM  t_client AS c,t_facture AS f,t_utilisateur AS d
                                 WHERE f.id_client=c.id_client AND f.id_user=d.id_user 
                                       AND f.id_fact=:cmd_id");
    $requete->BindParam(':cmd_id', $idcmd);
    $requete->execute();
    $reservation_attente = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($reservation_attente as $ra) {
        $_SESSION['nbrcouvert'] = $ra->nbrcouvertfac;
        $id = $ra->id_res;
        $id_fact = $ra->id_fact;
        $remise_fact = $ra->mont_ttc_remise;
        $mont_remise = $ra->tva;
        $tva_fact = $ra->tva;
        $mont_tva = $ra->mont_tva;
        $mont_ttc = $ra->mont_ttc;
        $id_cl = $ra->id_client;
        // $cmd_num = $ra->num_reserv;
        $tbl = $ra->designation;
        $cl = $ra->nom_client;
        $tauxfct = $ra->taux;
        $_SESSION['mode_fact'] = $ra->mode;
        $_SESSION['nom_user'] = $ra->nom_user;
        $_SESSION['date_edition'] = $ra->date_edition;
        //        $_SESSION['date_edition2'] = $ra->dte_time;
        $_SESSION['date_edition2'] = $ra->dte_time;
        $typ = $ra->type;
        if ($typ == 'client' || $typ == 'serveur') {
            $cl_tbl = $cl;
        } else if ($typ == 'table') {
            $cl_tbl = $tbl;
        } else {
            $cl_tbl = 'Occasionnel';
        }
        $_SESSION['num_commande'] = $ra->num_fact;
        $_SESSION['nom_client'] = $cl_tbl;
        $_SESSION['id_client'] = $id_cl;
        $statut = 'En cours';
        if ($ra->preparer == 1) {
            $statut = 'Preparé';
        }
        if ($ra->etat_cmd == 3) {
            $statut = 'Annulé';
        }
        $_SESSION['preparer'] = $ra->preparer;
        $_SESSION['etat_cmd'] = $ra->etat_cmd;
        $_SESSION['statut_cmd'] = $statut;
        $note_cmd = $ra->note_cmd;
        $_SESSION['note_cmd'] = $note_cmd;
        $requete = $bdd->prepare("SELECT  p.idprod,p.designation,p.monnaie,p.repas,ss.genre,l.*
                                    FROM  lignes_commandes AS l,stk_produit As p,stk_sous_famille AS ss
                                    WHERE l.produit_id=p.idprod AND p.famille_id=ss.id_s_fam 
                                     AND l.commande_id=:cmd_id");
        $requete->BindParam(':cmd_id', $id_fact);
        $requete->execute();
        $reservation_l_attente = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($reservation_l_attente as $r) {
            $qte = $r->qte;
            $lignecmd_id = $r->id;
            // if (round($r->qte) == 0) {
            //     $qte = $r->qteoffert;
            // }
            $prix = $r->prix;
            $idprod = $r->idprod;
            $designation = $r->designation;

            $repas = $r->repas;
            $genre = $r->genre;
            // $impr = $r->impr;
            // if ($impr == 1) {
            //     if ($r->qte2 != 0) {
            //         $qte = $r->qte2;
            //     }
            // }
            $des_plt = $r->accomp;
            $pa = $r->pa;

            array_push($_SESSION['panier']['id_article'], $idprod);
            array_push($_SESSION['panier']['nom'], $designation);
            array_push($_SESSION['panier']['qte'], $qte);
            array_push($_SESSION['panier']['prix'], $prix);
            array_push($_SESSION['panier']['repas'], $repas);
            array_push($_SESSION['panier']['genre'], $genre);
            array_push($_SESSION['panier']['pa'], $pa);
            array_push($_SESSION['panier']['description'], $des_plt);
            if ($genre == 2) {
                $_SESSION['dessert'] = 1;
            } elseif ($genre == 1) {
                $_SESSION['entree'] = 1;
            } elseif ($genre == 0) {
                $_SESSION['plats'] = 1;
            }
        }
        $mont_ht = 0;
        $nb_articles = count($_SESSION['panier']['id_article']);
        for ($i = 0; $i < $nb_articles; $i++) {
            $mont_ht += $_SESSION['panier']['qte'][$i] * $_SESSION['panier']['prix'][$i];
        }
        $total1 = $mont_ht;
        $total = total($total1, $tva_fact, $remise_fact);
        //        $mont_tva=tva($total,$tva_fact,$remise_fact);
        $mont_rmz = remise($total1, $tva_fact, $remise_fact);
        $mont_ht = ht($total, $tva_fact, $remise_fact);

        $ttc = ttc($mont_ht, $mont_tva, $mont_rmz);
        $ttc2 =  montant_equivalent_bdd('CDF', 'USD', $tauxfct, $ttc);
        $_SESSION['panier']['mont_tva'] = $mont_tva;
        $_SESSION['panier']['mont_ttc'] = $mont_ht - $mont_rmz;
        $_SESSION['panier']['mont_remise'] = $mont_rmz;
        $_SESSION['panier']['mont_ht'] = $mont_ht;
        $_SESSION['panier']['mont_ttc_remise'] = $ttc;
        $_SESSION['ttc2'] = $ttc2;
    }
}

function ExtraitDEcompteAll($id_hotel, $bdd)
{
    $data = array();
    $data['id'] = array();
    $data['client'] = array();
    $data['debit'] = array();
    $data['credit'] = array();
    $requete = $bdd->prepare("SELECT b.id_client,b.nom_client 
                                FROM t_facture AS a, t_client AS b 
                                WHERE a.id_client=b.id_client
                                AND a.type='restaurant'
                                AND a.mode='Credit'
                                AND b.type='client'
                                AND b.id_hotel=:id_hotel
                                 AND b.pseudo_supp=0
                                GROUP BY b.id_client
                                ORDER BY b.nom_client ASC");
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->execute();
    $clients = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($clients as $cli) {
        $idclient = $cli->id_client;
        $nom_client = $cli->nom_client;
        $debit = 0;
        $credit = 0;
        $requete = $bdd->prepare("SELECT * FROM t_facture AS a, t_client AS b 
                                WHERE a.id_client=b.id_client
                                     AND b.id_client=:idcl
                                     AND a.type='restaurant'
                                     AND a.mode='Credit'
                                     ");
        $requete->BindParam(':idcl', $idclient);
        $requete->execute();
        $factures = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($factures as $fct) {
            $id_fact = $fct->id_fact;
            $taux = $fct->taux;
            $monnaie = $fct->monnaie;
            $totalfact = $fct->mont_ttc;
            if ($monnaie == 'CDF') {
                $debit += montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $taux, $totalfact);
            } else {
                $debit += $totalfact;
            }
            $requete = $bdd->prepare("SELECT * FROM t_reglement AS c, paiement AS d WHERE c.id_regl=d.regl_id AND c.id_fact=:id_fact ORDER BY c.dte");
            $requete->BindParam(':id_fact', $id_fact);
            $requete->execute();
            $paiements = $requete->fetchAll(PDO::FETCH_OBJ);
            $nbre = count($paiements);
            if ($nbre > 0) {
                foreach ($paiements as $p) {
                    $montantusd = $p->montantusd;
                    $montantcdf = $p->montantcdf;
                    $taux = $p->taux;
                    $credit += $montantusd + montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $taux, $montantcdf);
                }
            }
        }
        if ($debit > 0) {
            array_push($data['id'], $idclient);
            array_push($data['client'], $nom_client);
            array_push($data['debit'], $debit);
            array_push($data['credit'], $credit);
        }
    }
    return  $data;
}

function AllCommmandesCustom($id, $type, $dte1, $dte2, $idclient, $bdd)
{
    //Retourne toutes les commandes du sous-resto
    $req = "
        SELECT a.*,
        c.nom_client,c.designation,c.type,c.adresse_provenance_client,c.email_client,c.telephone_client,c.sexe_client,d.nom_user,d.prenom_user
            FROM t_facture a,t_client c,t_utilisateur AS d
             WHERE a.id_client=c.id_client
                   AND a.id_user=d.id_user 
                   AND a.id_sousresto=:id
                   AND a.type=:type
                   AND a.date_edition BETWEEN :dte1 AND :dte2
                   AND c.id_client=:id_client
                   ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->BindParam(':type', $type);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->BindParam(':id_client', $idclient);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function AllCommmandesCreditCustom($id, $type, $dte1, $dte2, $idclient, $bdd)
{
    //Retourne toutes les commandes du sous-resto
    $mode = 'Credit';
    $req = "
        SELECT a.*,c.type AS type_client,
        c.nom_client,c.designation,c.adresse_provenance_client,c.email_client,c.telephone_client,c.sexe_client,d.nom_user,d.prenom_user
            FROM t_facture a,t_client c,t_utilisateur AS d
             WHERE a.id_client=c.id_client
                   AND a.id_user=d.id_user 
                   AND a.id_sousresto=:id
                   AND a.type=:type
                   AND a.mode=:mode
                   AND a.date_edition BETWEEN :dte1 AND :dte2
                   AND c.id_client=:id_client
                   ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->BindParam(':type', $type);
    $requete->BindParam(':mode', $mode);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->BindParam(':id_client', $idclient);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

/* function venteGroupByFamille($id_hotel,$maffiche,$dte1,$dte2, $bdd)
{

    $data2 = array();
    $data2['id'] = array();
    $data2['des'] = array();
    $data2['cash'] = array();
    $data2['credit'] = array();
    $data2['don'] = array();
    if($maffiche=='USD'){
        $req = "SELECT  f.id,f.nom,a.taux_prix,a.monnaie,a.mont_ttc_remise
                SUM(b.qte) AS qte,SUM(b.qteoffert) AS qteoffert,
                SUM(b.qte*b.prix) AS mont,SUM(b.qteoffert*b.prix2) AS montof,a.mode
                FROM t_facture AS a,lignes_commandes AS b,stk_produit AS c,
                stk_sous_famille AS d,stk_famille AS e,stk_familletype AS f
                WHERE a.id_fact=b.commande_id
                AND b.produit_id= c.idprod
                AND c.famille_id=d.id_s_fam
                AND d.famille=e.idfamille
                AND a.mode IS NOT NULL
                AND a.id_hotel  =:id_hotel 
                AND a.date_edition  BETWEEN :dte1 AND :dte2
                AND e.affichage=1
                AND e.familletype_id=f.id
                GROUP BY f.id,a.mode";
    }else¨{
        
    }
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();

    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    
    foreach ($result as $r) {
        if (!in_array($r->id, $data2['id'])) {
            array_push($data2['id'],$r->id);
            array_push($data2['des'] ,$r->nom);
        }
        if ($r->mode == 'Cash') {
            $data2['cash'][$r->id] = $r->mont;
        }
        if ($r->mode == 'Credit') {
            $data2['credit'][$r->id] = $r->mont;
        }
        if ($r->mode == 'Don') {
            $data2['don'][$r->id] = $r->mont;
        }
    }

    

    
} */

function GetMarges($id_hotel, $dte1, $dte2, $bdd)
{
    $requete = $bdd->prepare("SELECT c.idprod,c.designation,b.pa,b.prix,b.prixremise,a.taux_prix,a.monnaie,a.mont_ttc_remise,
                                    SUM(b.qte) AS qte, SUM((b.qte*b.pa)/a.taux_prix) AS valpa,
                                    SUM((b.qte*b.prixremise-b.qte*b.prixremise*a.mont_ttc_remise/100)/a.taux_prix) AS valpv,a.mode
                                FROM t_facture AS a,lignes_commandes AS b,stk_produit AS c,
                                         stk_sous_famille AS d,stk_famille AS e
                                 WHERE a.id_fact=b.commande_id
                                            AND b.produit_id= c.idprod
                                             AND c.famille_id=d.id_s_fam
                                             AND d.famille=e.idfamille
                                             AND a.id_hotel=:id_hotel
                                             AND a.mode IN('Cash','Credit')
                                             AND e.affichage=1
                                             AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
                                             GROUP BY c.idprod, b.prixremise");
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->BindParam(':date_bd1', $dte1);
    $requete->BindParam(':date_bd2', $dte2);
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_OBJ);
    //  print_r($requete->fetchAll(PDO::FETCH_OBJ));



}

function detailsSalesCategorie($d1, $d2, $idsite, $bdd)
{
    $data = array();
    $data['id'] = array();
    $data['numTarif'] = array();
    $data['categorieVente'] = array();
    $data['montant_cash'] = array();
    $data['montant_credit'] = array();
    $data['montant_don'] = array();
    $mobilepaiements = getModesMobiles($bdd);
    $requete = $bdd->prepare("SELECT f.id,f.nom,f.designation,SUM((b.qte*b.prixremise)) AS mont,a.mode
    FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a,
            stk_sous_famille AS d,stk_famille AS e,stk_familletype AS f
	WHERE a.id_fact=b.commande_id 
	AND b.produit_id= c.idprod
	AND c.famille_id=d.id_s_fam
	AND d.famille=e.idfamille
	AND e.familletype_id=f.id
	AND a.mode IS NOT NULL
    AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
    AND a.id_hotel  =:id_hotel 
	GROUP BY f.id,a.mode2
	ORDER BY f.priority");
    $requete->BindParam(':id_hotel', $idsite);
    $requete->BindParam(':date_bd1', $d1);
    $requete->BindParam(':date_bd2', $d2);
    $requete->execute();

    $result = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($result as $r) {
        $id = $r->id;
        $nom = $r->designation;
        $mode = $r->mode;
        $montant = $r->mont;
        $numTarif = $id;

        if (!in_array($id, $data['numTarif'])) {
            array_push($data['numTarif'], $id);
        }
        $data['id'][$numTarif] = $id;
        $data['categorieVente'][$numTarif] = $nom;

        if ($mode == 'Cash') {
            $data['montant_cash'][$numTarif] = $montant;
            /* $data['montant_credit'][$numTarif]=0;
            $data['montant_don'][$numTarif]=0; */
        }
        if ($mode == 'Credit') {
            //$data['montant_cash'][$numTarif]=0;
            $data['montant_credit'][$numTarif] = $montant;
            //  $data['montant_don'][$numTarif]=0;
        }
        if (in_array($mode, $mobilepaiements)) {
            // $data['montant_cash'][$numTarif]=0;
            //$data['montant_credit'][$numTarif]=0;
            $data['montant_don'][$numTarif] = $montant;
        }
    }

    return $data;
    //  var_dump($data);
}


function getFacturesOfMobileMoney($id, $type, $dte1, $dte2, $bdd)
{
    $mobilemodes = ['M-Pesa', 'Orange Money', 'Airtel Money'];

    $req = "
        SELECT a.*,
        c.nom_client,c.designation,c.type,c.adresse_provenance_client,c.email_client,c.telephone_client,c.sexe_client,d.nom_user,d.prenom_user
            FROM t_facture a,t_client c,t_utilisateur AS d
             WHERE a.id_client=c.id_client
                   AND a.id_user=d.id_user 
                   AND a.id_sousresto=:id
                   AND a.type=:type
                   AND a.date_edition BETWEEN :dte1 AND :dte2
                   AND a.mode IN ('M-Pesa','Orange Money','Airtel Money')
                   ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->BindParam(':type', $type);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getModesMobiles($bdd)
{
    $mobilemodes = [];

    $req = "SELECT * FROM t_mode_reglement WHERE mobile=1 ";
    $requete = $bdd->prepare($req);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($result as $r) {
        $des = $r->lib;
        array_push($mobilemodes, $des);
    }

    return $mobilemodes;
}

function getMontantPercuMobileMoney($monnaie, $site_id, $dte1, $dte2, $bdd)
{
    if ($monnaie == 'USD') {
        $req = "SELECT c.lib,SUM(b.montantusd-b.rendu_usd+b.montantcdf/b.taux-b.rendu_cdf/b.taux) AS montantpaye
                FROM  t_reglement AS a,paiement AS b, t_mode_reglement AS c
                WHERE b.regl_id=a.id_regl AND b.id_mode_regl= c.id_mode_regl
                AND a.dte  BETWEEN :dte1 AND :dte2
                AND c.mobile=1
                AND b.site_id=:site_id
                GROUP BY b.id_mode_regl";
    } else {
        $req = "SELECT c.lib,SUM(b.montantusd*b.taux-b.rendu_usd*b.taux+b.montantcdf-b.rendu_cdf) AS montantpaye
                FROM  t_reglement AS a,paiement AS b, t_mode_reglement AS c
                WHERE b.regl_id=a.id_regl AND b.id_mode_regl= c.id_mode_regl
                AND a.dte  BETWEEN :dte1 AND :dte2
                AND c.mobile=1
                AND b.site_id=:site_id
                GROUP BY b.id_mode_regl";
    }

    $requete = $bdd->prepare($req);
    $requete->BindParam(':site_id', $site_id);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);

    return $result;
}

function getMontantVersementMobileMoney($site_id, $dte1, $dte2, $bdd)
{

    $req = "SELECT c.lib,SUM(b.montantusd-b.rendu_usd) AS montantusd,SUM(b.montantcdf-b.rendu_cdf) AS montantcdf
            FROM  t_reglement AS a,paiement AS b, t_mode_reglement AS c
            WHERE b.regl_id=a.id_regl AND b.id_mode_regl= c.id_mode_regl
            AND a.dte  BETWEEN :dte1 AND :dte2
            AND c.mobile=1
            AND b.site_id=:site_id
            GROUP BY b.id_mode_regl";

    $requete = $bdd->prepare($req);
    $requete->BindParam(':site_id', $site_id);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);

    return $result;
}

function getMontantVenteParMode($maffiche, $site_id, $dte1, $dte2, $bdd)
{
    if ($maffiche == 'USD') {
        $req = "SELECT a.mode AS lib,a.mode2,SUM((b.qte*b.prixremise)/a.taux_prix) AS montant
                FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
                    WHERE a.id_fact=b.commande_id 
                    AND b.produit_id= c.idprod
                    AND a.mode IS NOT NULL
                    AND a.date_edition  BETWEEN :dte1 AND :dte2
                    AND a.id_sousresto=:site_id
                    GROUP BY a.mode";
    } else {
        $req = "SELECT a.mode AS lib,a.mode2,SUM(b.qte*b.prixremise) AS montant
    FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
        WHERE a.id_fact=b.commande_id 
        AND b.produit_id= c.idprod
        AND a.mode IS NOT NULL
        AND a.date_edition  BETWEEN :dte1 AND :dte2
        AND a.id_sousresto=:site_id
        GROUP BY a.mode";
    }


    $requete = $bdd->prepare($req);
    $requete->BindParam(':site_id', $site_id);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);

    return $result;
}


function getFDCDuLendemain($maffiche, $site_id, $dte1, $dte2, $bdd)
{
    $mont = 0;
    if ($maffiche == 'USD') {
        $req = "SELECT SUM(a.usd+(a.cdf/a.taux)) AS montant
                FROM depenses AS a, dep_libelles AS b
                WHERE a.libelle_id=b.id 
                AND a.site_id=:site_id AND a.psedo=0 
                AND b.code='fdclobi'
                AND a.dte_dep BETWEEN :dte1 AND :dte2";
    } else {
        $req = "SELECT SUM(a.usd*a.taux+a.cdf) AS montant
        FROM depenses AS a, dep_libelles AS b
        WHERE a.libelle_id=b.id 
        AND a.site_id=:site_id AND a.psedo=0 
        AND b.code='fdclobi'
        AND a.dte_dep BETWEEN :dte1 AND :dte2";
    }


    $requete = $bdd->prepare($req);
    $requete->BindParam(':site_id', $site_id);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $mont = $r->montant;
    }
    return $mont;
}
function PaiementCreance2($m_affiche, $id_soussite, $dte1, $dte2, $bdd)
{
    $total = 0;
    $idsite = $_SESSION['id_hotel'];
    $requete = $bdd->prepare("SELECT f.id_fact,f.taux,b.montantcdf,b.montantusd,b.rendu_cdf,b.rendu_usd
        FROM t_facture AS f,t_reglement AS fa,paiement AS b
        WHERE f.id_fact=fa.id_fact 
            AND fa.id_regl=b.regl_id
            AND f.mode='Credit'
            AND b.id_mode_regl IN(2,3)
            AND fa.dte BETWEEN :dte1 AND :dte2
            AND  f.id_sousresto=:id_hotel");

    $requete->BindParam(':id_hotel', $id_soussite);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $taux = $r->taux;
        $montantusd = $r->montantusd;
        $rendu_usd = $r->rendu_usd;
        $montantcdf = $r->montantcdf;
        $rendu_cdf = $r->rendu_cdf;
        if ($m_affiche == 'USD') {
            $total += ($montantusd - $rendu_usd) + ($montantcdf - $rendu_cdf) / $taux;
        } else {
            $total += ($montantusd - $rendu_usd) * $taux + ($montantcdf - $rendu_cdf);
        }
    }
    return $total;
}

function getSoldeVirtuel($m_affiche, $id_sousresto, $dte, $bdd)
{
    $ventesmodes = getMontantVenteParMode($m_affiche, $id_sousresto, $dte, $dte, $bdd);
    $tot = 0;
    $totventecash = 0;
    foreach ($ventesmodes as $r) {
        $mont = $r->montant;
        if ($r->mode2 == 1) {
            $totventecash = $mont;
        }
    }

    $paiement_credit = PaiementCreance2($m_affiche, $id_sousresto, $dte, $dte, $bdd);

    $tot = $totventecash + $paiement_credit;
    return $tot;
}

function ExtraitDEcompte2($idclient, $bdd)
{
    $data = array();
    $data['id'] = array();
    $data['date'] = array();
    $data['numfact'] = array();
    $data['numrecu'] = array();
    $data['debitusd'] = array();
    $data['creditusd'] = array();
    $data['debitcdf'] = array();
    $data['creditcdf'] = array();
    $data['taux'] = array();
    $data['dterecu'] = array();
    $data['agent'] = array();
    $m_affiche = getsymbole_local();
    $requete = $bdd->prepare("SELECT * FROM t_facture AS a, t_client AS b 
                                WHERE a.id_client=b.id_client
                                     AND b.id_client=:idcl
                                     AND a.type='restaurant'
                                     AND a.mode='Credit'
                                     ORDER BY a.id_fact DESC
                                    ");
    $requete->BindParam(':idcl', $idclient);
    $requete->execute();
    $factures = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($factures as $fct) {
        $debitusd = 0;
        $debitcdf = 0;
        $numfact = $fct->num_fact;
        $id_fact = $fct->id_fact;
        $taux = $fct->taux;
        $monnaie = $fct->monnaie;
        $date_edition = $fct->date_edition;
        $totalfact = $fct->mont_ttc;
        if ($monnaie == 'CDF') {
            $debitcdf = $totalfact;
        } else {
            $debitusd = $totalfact;
        }
        $requete = $bdd->prepare("SELECT * FROM t_reglement AS c, paiement AS d,t_utilisateur AS e
         WHERE c.id_regl=d.regl_id
         AND c.id_user=e.id_user 
         AND c.id_fact=:id_fact ORDER BY c.dte");
        $requete->BindParam(':id_fact', $id_fact);
        $requete->execute();
        $paiements = $requete->fetchAll(PDO::FETCH_OBJ);

        $nbre = count($paiements);

        if ($nbre > 0) {
            foreach ($paiements as $p) {
                $dte = $p->dte;
                $creditusd = 0;
                $creditcdf = 0;
                $numrecu = $p->numero;
                $rendu_usd = $p->rendu_usd;
                if ($rendu_usd < 0) {
                    $rendu_usd = 0;
                }
                $rendu_cdf = $p->rendu_cdf;
                if ($rendu_cdf < 0) {
                    $rendu_cdf = 0;
                }
                $montantusd = $p->montantusd - $rendu_usd;
                $montantcdf = $p->montantcdf - $rendu_cdf;
                $creditcdf = $montantcdf;
                $creditusd = $montantusd;
                $taux = $p->taux;
                $nom_user = $p->nom_user;
                $dte_reglement = $p->dte;
                array_push($data['id'], $id_fact);
                array_push($data['date'], $date_edition);
                if (!in_array($numfact, $data['numfact'])) {
                    array_push($data['numfact'], $numfact);
                } else {
                    array_push($data['numfact'], $numfact);
                    $debitcdf = 0;
                    $debitusd = 0;
                }
                array_push($data['numrecu'], $numrecu);
                array_push($data['debitcdf'], $debitcdf);
                array_push($data['creditcdf'], $creditcdf);
                array_push($data['debitusd'], $debitusd);
                array_push($data['creditusd'], $creditusd);
                array_push($data['taux'], $taux);
                array_push($data['agent'], $nom_user);
                array_push($data['dterecu'], $dte_reglement);
            }
        } else {
            array_push($data['id'], $id_fact);
            array_push($data['date'], $date_edition);
            array_push($data['numfact'], $numfact);
            array_push($data['numrecu'], '');
            array_push($data['debitcdf'], $debitcdf);
            array_push($data['creditcdf'], 0);
            array_push($data['debitusd'], $debitusd);
            array_push($data['creditusd'], 0);
            array_push($data['taux'], 1);
            array_push($data['agent'], '');
            array_push($data['dterecu'], '');
        }
    }

    return  $data;
}
function rapportVersement($id_sousresto, $maffiche, $dte1, $dte2, $taux, $bdd)
{
    $data = array();
    $data['ventes'] = array();
    $data['ventes']['mode']  = array();
    $data['ventes']['montant']  = array();
    $data['ventes']['total']  = 0;
    $data['fdc'] = 0;
    $data['totpaiementcredit'] = 0;
    $data['totdepense'] = 0;
    $data['soldevirtuel'] = 0;
    $data['soldephys'] = 0;
    $data['fdcldm'] = 0;
    $data['totcash'] = 0;
    $data['balance'] = 0;
    $data['periode'] = dateAffiche($dte1) . '-' . dateAffiche($dte2);
    $totcash = 0;
    $ventes = getMontantVenteParMode($maffiche, $id_sousresto, $dte1, $dte2, $bdd);
    foreach ($ventes as $r) {
        $mont = $r->montant;
        $mode = $r->lib;
        if ($r->mode2 == 1) {
            $totcash = $mont;
        }
        array_push($data['ventes']['mode'], $mode);
        array_push($data['ventes']['montant'], $mont);
        $data['ventes']['total'] += $mont;
    }
    $data['totcash'] = $totcash;
    //Fonds de caisse

    $requete = $bdd->prepare("SELECT SUM(cdf) AS fond_cdf,SUM(usd) AS fond_usd
   FROM fondscaisse 
   WHERE dte =:dte2
     AND sousresto_id=:sousresto_id");
    $requete->BindParam(':dte2', $dte2);
    $requete->BindParam(':sousresto_id', $id_sousresto);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        if ($maffiche == 'USD') {
            $data['fdc'] = $r->fond_cdf / $taux + $r->fond_usd;
        } else {
            $data['fdc'] = $r->fond_cdf + $r->fond_usd * $taux;
        }
    }
    // Paiement credit
    $data['totpaiementcredit'] = PaiementCreance2($maffiche, $id_sousresto, $dte1, $dte2, $bdd);

    //Depenses
    if ($maffiche == 'USD') {
        $requete = $bdd->prepare("SELECT SUM(cdf/taux+usd) AS totdepense FROM depenses AS a
        WHERE  a.sousresto_id=:sousresto_id
          AND a.psedo=0 
          AND a.dte_dep BETWEEN :dte1 AND :dte2 ");
    } else {
        $requete = $bdd->prepare("SELECT SUM(cdf+usd*taux) AS totdepense FROM depenses AS a
        WHERE  a.sousresto_id=:sousresto_id
          AND a.psedo=0 
          AND a.dte_dep BETWEEN :dte1 AND :dte2");
    }


    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->BindParam(':sousresto_id', $id_sousresto);
    $requete->execute();
    $depenses = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($depenses as $r) {
        $data['totdepense'] = $r->totdepense;
    }

    $data['soldevirtuel'] = round(($totcash +  $data['fdc'] + $data['totpaiementcredit']), 2) - round($data['totdepense'], 2);

    //Versement
    if ($maffiche == 'USD') {
        $requete = $bdd->prepare("SELECT SUM(a.montant_vers/a.taux+a.montantusd) AS montverse
    FROM t_versement AS a,t_utilisateur AS b
    WHERE  a.user_vers=b.id_user
     AND a.date_vers BETWEEN :dte1 AND :dte2 AND a.id_sousresto=:id_sousresto");
    } else {
        $requete = $bdd->prepare("SELECT SUM(a.montant_vers+a.montantusd*a.taux) AS montverse
                    FROM t_versement AS a,t_utilisateur AS b
                    WHERE  a.user_vers=b.id_user
                    AND a.date_vers BETWEEN :dte1 AND :dte2 AND a.id_sousresto=:id_sousresto");
    }

    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->BindParam(':id_sousresto', $id_sousresto);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $data['soldephys'] = $r->montverse;
    }

    //Fonds de caisse du lendemain

    // Fonds de caisse du lendemain
    $fdcldm = 0;
    if ($maffiche == 'USD') {
        $req = "SELECT SUM(a.usd+(a.cdf/a.taux)) AS montant
                FROM depenses AS a, dep_libelles AS b
                WHERE a.libelle_id=b.id 
                AND a.sousresto_id=:sousresto_id AND a.psedo=0 
                AND b.code='fdclobi'
                AND a.dte_dep=:dte2";
    } else {
        $req = "SELECT SUM(a.usd*a.taux+a.cdf) AS montant
        FROM depenses AS a, dep_libelles AS b
        WHERE a.libelle_id=b.id 
        AND a.sousresto_id=:sousresto_id AND a.psedo=0 
        AND b.code='fdclobi'
        AND a.dte_dep=:dte2";
    }

    $requete = $bdd->prepare($req);
    $requete->BindParam(':sousresto_id', $id_sousresto);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $data['fdcldm'] = $r->montant;
    }
    $data['balance'] = $data['soldephys'] - $data['soldevirtuel'];
    return $data;
}
function listOfPaiements($id, $dte1, $dte2, $bdd)
{
    //Retourne toutes les commandes du sous-resto
    $req = "SELECT re.id_regl,re.numero,re.dte,re.date_regl,re.id_user,pa.montantusd,pa.montantcdf,pa.rendu_usd,pa.rendu_cdf,
                pa.taux,mo.lib,us.nom_user,us.prenom_user,cl.nom_client,cl.designation,cl.type,fc.num_fact,fc.mode,mo.lib
                FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo,t_utilisateur AS us,t_facture AS fc,t_client AS cl
                WHERE re.id_regl=pa.regl_id 
            AND  mo.id_mode_regl=pa.id_mode_regl 
            AND  re.id_user=us.id_user
            AND  re.id_fact=fc.id_fact
            AND  fc.id_client=cl.id_client
            AND pa.id_sousresto=:id
            AND re.dte BETWEEN :dte1 AND :dte2
       ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function getTotalPaymentsByMode($id, $dte1, $dte2, $maffiche, $bdd)
{
    //Retourne toutes les commandes du sous-resto
    if ($maffiche == 'USD') {
        $req = "SELECT mo.lib, SUM((pa.montantusd-pa.rendu_usd)+(pa.montantcdf-pa.rendu_cdf)/pa.taux) AS montpaye
                        FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo,t_facture AS ft
                        WHERE re.id_regl=pa.regl_id 
                    AND  mo.id_mode_regl=pa.id_mode_regl 
                    AND  ft.id_fact=re.id_fact
                    AND  ft.mode!='Credit'
                    AND mo.visible=1
                    AND pa.id_sousresto=:id
                    AND re.dte BETWEEN :dte1 AND :dte2
                    GROUP BY mo.id_mode_regl ORDER BY re.id_regl DESC";
    } else {
        $req = "SELECT mo.lib, SUM((pa.montantusd-pa.rendu_usd)*pa.taux+(pa.montantcdf-pa.rendu_cdf)) AS montpaye
                        FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo, t_facture AS ft
                        WHERE re.id_regl=pa.regl_id 
                    AND  mo.id_mode_regl=pa.id_mode_regl 
                    AND  ft.id_fact=re.id_fact
                    AND  ft.mode!='Credit'
                    AND mo.visible=1
                    AND pa.id_sousresto=:id
                    AND re.dte BETWEEN :dte1 AND :dte2
                    GROUP BY mo.id_mode_regl";
    }

    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function etatDeCaisse($id, $dte1, $dte2, $taux, $bdd)
{
    //VENTES
    $data = array();
    $data['libelle'] = array();
    $data['cdf'] = array();
    $data['usd'] = array();
    $data['usdcdf'] = array();
    $data['type'] = array();
    $data['periode'] = dateAffiche($dte1) . ' - ' . dateAffiche($dte2);

    //FONDS DE CAISSE
    $requete = $bdd->prepare("SELECT SUM(cdf) AS fond_cdf,SUM(usd) AS fond_usd
     FROM fondscaisse 
     WHERE dte=:dte AND sousresto_id=:sousresto_id");
    $requete->BindParam(':dte', $dte2);
    $requete->BindParam(':sousresto_id', $id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $montantcdf = $r->fond_cdf;
        $montantusd = $r->fond_usd;
        $libelle = 'Fonds de caisse';
        $montant = $montantusd + $montantcdf / $taux;
        array_push($data['libelle'], $libelle);
        array_push($data['cdf'], $montantcdf);
        array_push($data['usd'], $montantusd);
        array_push($data['usdcdf'], $montant);
        array_push($data['type'], 1);
    }
    //VENTE CASH
    $req = "SELECT mo.lib, SUM(pa.montantusd-pa.rendu_usd) AS montantusd,
                    SUM(pa.montantcdf-pa.rendu_cdf) AS montantcdf,
                    SUM((pa.montantusd-pa.rendu_usd)+(pa.montantcdf-pa.rendu_cdf)/pa.taux) AS montant
    FROM t_facture As a,t_reglement AS re,paiement AS pa,t_mode_reglement AS mo
            WHERE a.id_fact=re.id_fact AND re.id_regl=pa.regl_id 
        AND  mo.id_mode_regl=pa.id_mode_regl 
        AND mo.id_mode_regl NOT IN(3)
        AND mo.visible=1
        AND a.mode='Cash'
        AND pa.id_sousresto=:id
        AND re.dte BETWEEN :dte1 AND :dte2";

    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $ventes = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($ventes as $r) {
        $montantusd = $r->montantusd;
        $montantcdf = $r->montantcdf;
        $montant = $r->montant;
        $libelle = 'Vente';
        array_push($data['libelle'], $libelle);
        array_push($data['cdf'], $montantcdf);
        array_push($data['usd'], $montantusd);
        array_push($data['usdcdf'], $montant);
        array_push($data['type'], 1);
    }

    //PAIEMENT CREDIT

    $req = "SELECT mo.lib, SUM(pa.montantusd-pa.rendu_usd) AS montantusd,
    SUM(pa.montantcdf-pa.rendu_cdf) AS montantcdf,
    SUM((pa.montantusd-pa.rendu_usd)+(pa.montantcdf-pa.rendu_cdf)/pa.taux) AS montant
    FROM t_facture As a,t_reglement AS re,paiement AS pa,t_mode_reglement AS mo
            WHERE a.id_fact=re.id_fact AND re.id_regl=pa.regl_id 
        AND  mo.id_mode_regl=pa.id_mode_regl 
        AND mo.visible=1
        AND a.mode='Credit'
        AND pa.id_sousresto=:id
        AND re.dte BETWEEN :dte1 AND :dte2";

    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $paiementscredit = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($paiementscredit as $r) {
        $montantusd = $r->montantusd;
        $montantcdf = $r->montantcdf;
        $montant = $r->montant;
        $libelle = 'Paiement crédit';
        array_push($data['libelle'], $libelle);
        array_push($data['cdf'], $montantcdf);
        array_push($data['usd'], $montantusd);
        array_push($data['usdcdf'], $montant);
        array_push($data['type'], 1);
    }
    //DEPENSES
    $requete = $bdd->prepare("SELECT b.id,b.designation,SUM(a.usd) AS usd,SUM(a.cdf) AS cdf,
        SUM(a.usd+a.cdf/a.taux) AS montant
    FROM depenses AS a, dep_libelles AS b, t_utilisateur AS c
   WHERE a.libelle_id=b.id AND a.user_id=c.id_user
   AND a.sousresto_id=:sousresto_id AND a.psedo=0 
   AND a.dte_dep BETWEEN :dte1 AND :dte2
   GROUP BY b.id
   ORDER BY b.designation");
    $requete->BindParam(':sousresto_id', $id);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $sorties = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($sorties as $r) {
        $montantusd = $r->usd;
        $montantcdf = $r->cdf;
        $montant = $r->montant;
        $libelle = $r->designation;
        array_push($data['libelle'], $libelle);
        array_push($data['cdf'], $montantcdf);
        array_push($data['usd'], $montantusd);
        array_push($data['usdcdf'], $montant);
        array_push($data['type'], 0);
    }

    return $data;
}

function GetQteProdEnAttenteById($idprod, $bdd)
{
    $quantite = 0;
    $dte = date('Y-m-d');
    $requete = $bdd->prepare("SELECT  l.produit_id,SUM(l.qte) AS qte,l.repas 
                                    FROM t_facture AS a, lignes_commandes AS l
                                    WHERE a.id_fact=l.commande_id AND a.etat_cmd='1' 
                                    AND l.produit_id=:produit_id
                                    AND a.date_edition=:date_edition");
    $requete->BindParam(':produit_id', $idprod);
    $requete->BindParam(':date_edition', $dte);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $p) {
        $quantite = $p->qte;
    }

    return $quantite;
}

function getServeurs($site_id, $bdd)
{
    $requete = $bdd->prepare("SELECT * FROM serveurs AS s
             WHERE s.psedo=0 AND s.site_id=:site_id  ORDER BY s.nom");
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);

    return $result;
}

function DetailsVenteTout3($caissier_id, $serveur_id, $date_bd1, $date_bd2, $bdd)
{
    $idsite = $_SESSION['id_hotel'];
    if ($caissier_id == 0) {

        if ($serveur_id == 0) {
            $requete = $bdd->prepare("SELECT e.familletype_id,b.prixremise,a.taux_prix,a.monnaie,a.mode,a.mont_ttc_remise,c.idprod,c.code, c.designation,c.repas,c.nourriture,
            SUM(b.qte) AS qte, b.prixremise AS pu, b.dte_h,a.mode AS lib,SUM(((b.qte*b.prix)-((b.qte*b.prix*a.mont_ttc_remise)/100))) AS mont,
            SUM(b.qteoffert) AS qteoffert,SUM(b.qteoffert*b.prix2) AS montof
                FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a,
                stk_sous_famille AS d,stk_famille AS e,stk_familletype AS f
                WHERE a.id_fact=b.commande_id 
                AND b.produit_id= c.idprod
                AND c.famille_id=d.id_s_fam
                AND d.famille=e.idfamille
                AND e.familletype_id=f.id
                AND a.mode IS NOT NULL
                AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
                AND a.id_hotel  =:id_hotel 
                GROUP BY c.idprod, b.prixremise,a.mode  
                            ORDER BY c.nourriture,c.designation");
            $requete->BindParam(':date_bd1', $date_bd1);
            $requete->BindParam(':date_bd2', $date_bd2);
            $requete->BindParam(':id_hotel', $idsite);
            $requete->execute();
        } else {
            $requete = $bdd->prepare("SELECT e.familletype_id,b.prixremise,a.taux_prix,a.monnaie,a.mode,a.mont_ttc_remise,c.idprod,c.code, c.designation,c.repas,c.nourriture,
            SUM(b.qte) AS qte, b.prixremise AS pu, b.dte_h,a.mode AS lib,SUM(((b.qte*b.prix)-((b.qte*b.prix*a.mont_ttc_remise)/100))) AS mont,
            SUM(b.qteoffert) AS qteoffert,SUM(b.qteoffert*b.prix2) AS montof
                FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a,
                stk_sous_famille AS d,stk_famille AS e,stk_familletype AS f
                WHERE a.id_fact=b.commande_id 
                AND b.produit_id= c.idprod
                AND c.famille_id=d.id_s_fam
                AND d.famille=e.idfamille
                AND e.familletype_id=f.id
                AND a.mode IS NOT NULL
                AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
                AND a.id_hotel=:id_hotel
                AND a.serveur_id=:serveur_id 
                GROUP BY c.idprod, b.prixremise,a.mode  
                            ORDER BY c.nourriture,c.designation");
            $requete->BindParam(':date_bd1', $date_bd1);
            $requete->BindParam(':date_bd2', $date_bd2);
            $requete->BindParam(':id_hotel', $idsite);
            $requete->BindParam(':serveur_id', $serveur_id);
            $requete->execute();
        }
    } else {
        if ($serveur_id == 0) {
            $requete = $bdd->prepare("SELECT e.familletype_id,b.prixremise,a.taux_prix,a.monnaie,a.mode,a.mont_ttc_remise,c.idprod,c.code, c.designation,c.repas,c.nourriture,
            SUM(b.qte) AS qte, b.prixremise AS pu, b.dte_h,a.mode AS lib,SUM(((b.qte*b.prix)-((b.qte*b.prix*a.mont_ttc_remise)/100))) AS mont,
            SUM(b.qteoffert) AS qteoffert,SUM(b.qteoffert*b.prix2) AS montof
                FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a,
                stk_sous_famille AS d,stk_famille AS e,stk_familletype AS f
                WHERE a.id_fact=b.commande_id 
                AND b.produit_id= c.idprod
                AND c.famille_id=d.id_s_fam
                AND d.famille=e.idfamille
                AND e.familletype_id=f.id
                AND a.mode IS NOT NULL
                AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
                AND a.id_hotel  =:id_hotel
                AND a.id_user=:id_user 
                GROUP BY c.idprod, b.prixremise,a.mode  
                            ORDER BY c.nourriture,c.designation");
            $requete->BindParam(':date_bd1', $date_bd1);
            $requete->BindParam(':date_bd2', $date_bd2);
            $requete->BindParam(':id_hotel', $idsite);
            $requete->BindParam(':id_user', $caissier_id);
            $requete->execute();
        } else {
            $requete = $bdd->prepare("SELECT e.familletype_id,b.prixremise,a.taux_prix,a.monnaie,a.mode,a.mont_ttc_remise,c.idprod,c.code, c.designation,c.repas,c.nourriture,
            SUM(b.qte) AS qte, b.prixremise AS pu, b.dte_h,a.mode AS lib,SUM(((b.qte*b.prix)-((b.qte*b.prix*a.mont_ttc_remise)/100))) AS mont,
            SUM(b.qteoffert) AS qteoffert,SUM(b.qteoffert*b.prix2) AS montof
                FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a,
                stk_sous_famille AS d,stk_famille AS e,stk_familletype AS f
                WHERE a.id_fact=b.commande_id 
                AND b.produit_id= c.idprod
                AND c.famille_id=d.id_s_fam
                AND d.famille=e.idfamille
                AND e.familletype_id=f.id
                AND a.mode IS NOT NULL
                AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
                AND a.id_hotel  =:id_hotel
                AND a.id_user=:id_user 
                AND a.serveur_id=:serveur_id 
                GROUP BY c.idprod, b.prixremise,a.mode  
                            ORDER BY c.nourriture,c.designation");
            $requete->BindParam(':date_bd1', $date_bd1);
            $requete->BindParam(':date_bd2', $date_bd2);
            $requete->BindParam(':id_hotel', $idsite);
            $requete->BindParam(':id_user', $caissier_id);
            $requete->BindParam(':serveur_id', $serveur_id);
            $requete->execute();
        }
    }

    $articles3 = $requete->fetchAll(PDO::FETCH_OBJ);
    return $articles3;
}

function detailsSalesCategorie3($caissier_id, $d1, $d2, $idsite, $bdd)
{
    $data = array();
    $data['id'] = array();
    $data['numTarif'] = array();
    $data['categorieVente'] = array();
    $data['montant_cash'] = array();
    $data['montant_credit'] = array();
    $data['montant_don'] = array();
    $mobilepaiements = getModesMobiles($bdd);

    if ($caissier_id == 0) {
        $requete = $bdd->prepare("SELECT f.id,f.nom,f.designation,SUM((b.qte*b.prixremise)) AS mont,a.mode
    FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a,
            stk_sous_famille AS d,stk_famille AS e,stk_familletype AS f
	WHERE a.id_fact=b.commande_id 
	AND b.produit_id= c.idprod
	AND c.famille_id=d.id_s_fam
	AND d.famille=e.idfamille
	AND e.familletype_id=f.id
	AND a.mode IS NOT NULL
    AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
    AND a.id_hotel  =:id_hotel 
	GROUP BY f.id,a.mode2
	ORDER BY f.priority");
        $requete->BindParam(':id_hotel', $idsite);
        $requete->BindParam(':date_bd1', $d1);
        $requete->BindParam(':date_bd2', $d2);
        $requete->execute();
    } else {
        $requete = $bdd->prepare("SELECT f.id,f.nom,f.designation,SUM((b.qte*b.prixremise)) AS mont,a.mode
    FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a,
            stk_sous_famille AS d,stk_famille AS e,stk_familletype AS f
	WHERE a.id_fact=b.commande_id 
	AND b.produit_id= c.idprod
	AND c.famille_id=d.id_s_fam
	AND d.famille=e.idfamille
	AND e.familletype_id=f.id
	AND a.mode IS NOT NULL
    AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
    AND a.id_hotel=:id_hotel
    AND a.id_user=:id_user 
	GROUP BY f.id,a.mode2
	ORDER BY f.priority");
        $requete->BindParam(':id_hotel', $idsite);
        $requete->BindParam(':date_bd1', $d1);
        $requete->BindParam(':date_bd2', $d2);
        $requete->BindParam(':id_user', $caissier_id);
        $requete->execute();
    }

    $result = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($result as $r) {
        $id = $r->id;
        $nom = $r->designation;
        $mode = $r->mode;
        $montant = $r->mont;
        $numTarif = $id;

        if (!in_array($id, $data['numTarif'])) {
            array_push($data['numTarif'], $id);
        }
        $data['id'][$numTarif] = $id;
        $data['categorieVente'][$numTarif] = $nom;

        if ($mode == 'Cash') {
            $data['montant_cash'][$numTarif] = $montant;
            /* $data['montant_credit'][$numTarif]=0;
            $data['montant_don'][$numTarif]=0; */
        }
        if ($mode == 'Credit') {
            //$data['montant_cash'][$numTarif]=0;
            $data['montant_credit'][$numTarif] = $montant;
            //  $data['montant_don'][$numTarif]=0;
        }
        if (in_array($mode, $mobilepaiements)) {
            // $data['montant_cash'][$numTarif]=0;
            //$data['montant_credit'][$numTarif]=0;
            $data['montant_don'][$numTarif] = $montant;
        }
    }

    return $data;
}

function PaiementCreance3($caissier_id, $dte1, $dte2, $bdd)
{
    $total = 0;
    $idsite = $_SESSION['id_hotel'];
    if ($caissier_id == 0) {
        $requete = $bdd->prepare("SELECT f.id_fact,f.taux,b.montantcdf,b.montantusd,b.rendu_cdf,b.rendu_usd
        FROM t_facture AS f,t_reglement AS fa,paiement AS b
        WHERE f.id_fact=fa.id_fact 
            AND fa.id_regl=b.regl_id
            AND f.mode='Credit'
            AND b.id_mode_regl IN(2,3)
            AND fa.dte BETWEEN :dte1 AND :dte2
            AND  b.site_id=:id_hotel");
        $requete->BindParam(':id_hotel', $idsite);
        $requete->BindParam(':dte1', $dte1);
        $requete->BindParam(':dte2', $dte2);
        $requete->execute();
    } else {
        $requete = $bdd->prepare("SELECT f.id_fact,f.taux,b.montantcdf,b.montantusd,b.rendu_cdf,b.rendu_usd
        FROM t_facture AS f,t_reglement AS fa,paiement AS b
        WHERE f.id_fact=fa.id_fact 
            AND fa.id_regl=b.regl_id
            AND f.mode='Credit'
            AND b.id_mode_regl IN(2,3)
            AND fa.dte BETWEEN :dte1 AND :dte2
            AND  b.site_id=:id_hotel");
        $requete->BindParam(':id_hotel', $idsite);
        $requete->BindParam(':dte1', $dte1);
        $requete->BindParam(':dte2', $dte2);
      //  $requete->BindParam(':id_user', $caissier_id);
        $requete->execute();
    }

    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $taux = $r->taux;
        $montantusd = $r->montantusd;
        $rendu_usd = $r->rendu_usd;
        $montantcdf = $r->montantcdf;
        $rendu_cdf = $r->rendu_cdf;
        $total += ($montantusd - $rendu_usd) + ($montantcdf - $rendu_cdf) ;
    }
    return $total;
}

function getMontantVenteParMode3($caissier, $maffiche, $site_id, $dte1, $dte2, $bdd)
{
    if ($maffiche == 'USD') {
        $req = "SELECT a.mode AS lib,a.mode2,SUM((b.qte*b.prixremise)/a.taux_prix) AS montant
                FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
                    WHERE a.id_fact=b.commande_id 
                    AND b.produit_id= c.idprod
                    AND a.mode IS NOT NULL
                    AND a.date_edition  BETWEEN :dte1 AND :dte2
                    AND a.id_sousresto=:site_id
                    GROUP BY a.mode";
    } else {
        $req = "SELECT a.mode AS lib,a.mode2,SUM(b.qte*b.prixremise) AS montant
    FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
        WHERE a.id_fact=b.commande_id 
        AND b.produit_id= c.idprod
        AND a.mode IS NOT NULL
        AND a.date_edition  BETWEEN :dte1 AND :dte2
        AND a.id_sousresto=:site_id
        GROUP BY a.mode";
    }


    $requete = $bdd->prepare($req);
    $requete->BindParam(':site_id', $site_id);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);

    return $result;
}

function GetDeletes($site_id, $dte1, $dte2, $bdd)
{
    $requete = $bdd->prepare("SELECT * , a.dte_time AS date_heure FROM suivifactures AS a, stk_produit AS b,t_facture AS c
                                WHERE a.produit_id=b.idprod AND a.facture_id=c.id_fact
                                AND c.id_hotel=:site_id AND a.suppr=1 
                                AND c.date_edition BETWEEN :dte1 AND :dte2
                                ORDER BY c.date_edition");
    $requete->BindParam(':site_id', $site_id);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $st = $requete->fetchAll(PDO::FETCH_OBJ);
    return $st;
}

function listOfPaiementsByUser($caissier, $id, $dte1, $dte2, $bdd)
{
    //Retourne toutes les commandes du sous-resto
    if ($caissier == 0) {
        $req = "SELECT re.id_regl,re.numero,re.dte,re.date_regl,re.id_user,pa.montantusd,pa.montantcdf,pa.rendu_usd,pa.rendu_cdf,
        pa.taux,mo.lib,us.nom_user,us.prenom_user,cl.nom_client,cl.designation,cl.type,fc.num_fact,fc.mode,mo.lib
        FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo,t_utilisateur AS us,t_facture AS fc,t_client AS cl
            WHERE re.id_regl=pa.regl_id 
                AND  mo.id_mode_regl=pa.id_mode_regl 
                AND  re.id_user=us.id_user
                AND  re.id_fact=fc.id_fact
                AND  fc.id_client=cl.id_client
                AND pa.id_sousresto=:id
                AND re.dte BETWEEN :dte1 AND :dte2
            ";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':id', $id);
        $requete->BindParam(':dte1', $dte1);
        $requete->BindParam(':dte2', $dte2);
    } else {
        $req = "SELECT re.id_regl,re.numero,re.dte,re.date_regl,re.id_user,pa.montantusd,pa.montantcdf,pa.rendu_usd,pa.rendu_cdf,
        pa.taux,mo.lib,us.nom_user,us.prenom_user,cl.nom_client,cl.designation,cl.type,fc.num_fact,fc.mode,mo.lib
        FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo,t_utilisateur AS us,t_facture AS fc,t_client AS cl
        WHERE re.id_regl=pa.regl_id 
        AND  mo.id_mode_regl=pa.id_mode_regl 
        AND  re.id_user=us.id_user
        AND  re.id_fact=fc.id_fact
        AND  fc.id_client=cl.id_client
        AND  re.id_user=:id_user
        AND pa.id_sousresto=:id
        AND re.dte BETWEEN :dte1 AND :dte2
        ";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':id', $id);
        $requete->BindParam(':dte1', $dte1);
        $requete->BindParam(':dte2', $dte2);
        $requete->BindParam(':id_user', $caissier);
    }

    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getTotalPaymentsByModeUser($caissier_id, $id, $dte1, $dte2, $maffiche, $bdd)
{
    //Retourne toutes les commandes du sous-resto
    if ($caissier_id == 0) {

        if ($maffiche == 'USD') {
            $req = "SELECT mo.lib, SUM((pa.montantusd-pa.rendu_usd)+(pa.montantcdf-pa.rendu_cdf)/pa.taux) AS montpaye
                            FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo,t_facture AS ft
                            WHERE re.id_regl=pa.regl_id 
                        AND  mo.id_mode_regl=pa.id_mode_regl 
                        AND  ft.id_fact=re.id_fact
                        AND  ft.mode!='Credit'
                        AND mo.visible=1
                        AND pa.id_sousresto=:id
                        AND re.dte BETWEEN :dte1 AND :dte2
                        GROUP BY mo.id_mode_regl ORDER BY re.id_regl DESC";
        } else {
            $req = "SELECT mo.lib, SUM((pa.montantusd-pa.rendu_usd)*pa.taux+(pa.montantcdf-pa.rendu_cdf)) AS montpaye
                            FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo, t_facture AS ft
                            WHERE re.id_regl=pa.regl_id 
                        AND  mo.id_mode_regl=pa.id_mode_regl 
                        AND  ft.id_fact=re.id_fact
                        AND  ft.mode!='Credit'
                        AND mo.visible=1
                        AND pa.id_sousresto=:id
                        AND re.dte BETWEEN :dte1 AND :dte2
                        GROUP BY mo.id_mode_regl";
        }
        $requete = $bdd->prepare($req);
        $requete->BindParam(':id', $id);
        $requete->BindParam(':dte1', $dte1);
        $requete->BindParam(':dte2', $dte2);
    } else {
        if ($maffiche == 'USD') {
            $req = "SELECT mo.lib, SUM((pa.montantusd-pa.rendu_usd)+(pa.montantcdf-pa.rendu_cdf)/pa.taux) AS montpaye
                            FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo,t_facture AS ft
                            WHERE re.id_regl=pa.regl_id 
                        AND  mo.id_mode_regl=pa.id_mode_regl 
                        AND  ft.id_fact=re.id_fact
                        AND  ft.mode!='Credit'
                        AND mo.visible=1
                        AND pa.id_sousresto=:id
                        AND re.dte BETWEEN :dte1 AND :dte2
                        AND re.id_user=:id_user
                        GROUP BY mo.id_mode_regl ORDER BY re.id_regl DESC";
        } else {
            $req = "SELECT mo.lib, SUM((pa.montantusd-pa.rendu_usd)*pa.taux+(pa.montantcdf-pa.rendu_cdf)) AS montpaye
                            FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo, t_facture AS ft
                            WHERE re.id_regl=pa.regl_id 
                        AND  mo.id_mode_regl=pa.id_mode_regl 
                        AND  ft.id_fact=re.id_fact
                        AND  ft.mode!='Credit'
                        AND mo.visible=1
                        AND pa.id_sousresto=:id
                        AND re.dte BETWEEN :dte1 AND :dte2
                        AND re.id_user=:id_user
                        GROUP BY mo.id_mode_regl";
        }
        $requete = $bdd->prepare($req);
        $requete->BindParam(':id', $id);
        $requete->BindParam(':dte1', $dte1);
        $requete->BindParam(':dte2', $dte2);
        $requete->BindParam(':id_user', $caissier_id);
    }

    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

/* function rapportVersementUser($caissier_id,$id_sousresto, $maffiche, $dte1, $dte2, $taux, $bdd)
{
    $data = array();
    $data['ventes'] = array();
    $data['ventes']['mode']  = array();
    $data['ventes']['montant']  = array();
    $data['ventes']['total']  = 0;
    $data['fdc'] = 0;
    $data['totpaiementcredit'] = 0;
    $data['totdepense'] = 0;
    $data['soldevirtuel'] = 0;
    $data['soldephys'] = 0;
    $data['fdcldm'] = 0;
    $data['totcash'] = 0;
    $data['balance'] = 0;
    $data['periode'] = dateAffiche($dte1) . '-' . dateAffiche($dte2);
    $totcash = 0;
    $ventes =  getMontantVenteParModeUser($caissier_id,$maffiche, $id_sousresto, $dte1, $dte2, $bdd);
    foreach ($ventes as $r) {
        $mont = $r->montant;
        $mode = $r->lib;
        if ($r->mode2 == 1) {
            $totcash = $mont;
        }
        array_push($data['ventes']['mode'], $mode);
        array_push($data['ventes']['montant'], $mont);
        $data['ventes']['total'] += $mont;
    }
    $data['totcash'] = $totcash;
    //Fonds de caisse
    if($caissier_id==0){
        $requete = $bdd->prepare("SELECT SUM(cdf) AS fond_cdf,SUM(usd) AS fond_usd
        FROM fondscaisse 
        WHERE dte =:dte2
            AND sousresto_id=:sousresto_id");
            $requete->BindParam(':dte2', $dte2);
            $requete->BindParam(':sousresto_id', $id_sousresto);
    }else{
        $requete = $bdd->prepare("SELECT SUM(cdf) AS fond_cdf,SUM(usd) AS fond_usd
        FROM fondscaisse 
        WHERE dte =:dte2
            AND sousresto_id=:sousresto_id AND user_id=:user_id");
            $requete->BindParam(':dte2', $dte2);
            $requete->BindParam(':sousresto_id', $id_sousresto);
            $requete->BindParam(':user_id', $caissier_id);
    }
    
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($result as $r) {
        if ($maffiche == 'USD') {
            $data['fdc'] = $r->fond_cdf / $taux + $r->fond_usd;
        } else {
            $data['fdc'] = $r->fond_cdf + $r->fond_usd * $taux;
        }
    }
    // Paiement credit
    $data['totpaiementcredit'] = PaiementCreance2User($caissier_id,$maffiche, $id_sousresto, $dte1, $dte2, $bdd);

    //Depenses
    if($caissier_id==0){
        if ($maffiche == 'USD') {
            $requete = $bdd->prepare("SELECT SUM(cdf/taux+usd) AS totdepense FROM depenses AS a
            WHERE  a.sousresto_id=:sousresto_id
              AND a.psedo=0 
              AND a.dte_dep BETWEEN :dte1 AND :dte2
               ");
        } else {
            $requete = $bdd->prepare("SELECT SUM(cdf+usd*taux) AS totdepense FROM depenses AS a
            WHERE  a.sousresto_id=:sousresto_id
              AND a.psedo=0 
              AND a.dte_dep BETWEEN :dte1 AND :dte2");
        }
        $requete->BindParam(':dte1', $dte1);
        $requete->BindParam(':dte2', $dte2);
        $requete->BindParam(':sousresto_id', $id_sousresto);
    }else{
        if ($maffiche == 'USD') {
            $requete = $bdd->prepare("SELECT SUM(cdf/taux+usd) AS totdepense FROM depenses AS a
            WHERE  a.sousresto_id=:sousresto_id
              AND a.psedo=0 
              AND a.dte_dep BETWEEN :dte1 AND :dte2
              AND a.user_id=:user_id
               ");
        } else {
            $requete = $bdd->prepare("SELECT SUM(cdf+usd*taux) AS totdepense FROM depenses AS a
            WHERE  a.sousresto_id=:sousresto_id
              AND a.psedo=0 
              AND a.dte_dep BETWEEN :dte1 AND :dte2
              AND a.user_id=:user_id");
        }
        $requete->BindParam(':dte1', $dte1);
        $requete->BindParam(':dte2', $dte2);
        $requete->BindParam(':sousresto_id', $id_sousresto); 
        $requete->BindParam(':user_id', $caissier_id); 
    }
    
    $requete->execute();
    $depenses = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($depenses as $r) {
        $data['totdepense'] = $r->totdepense;
    }

    $data['soldevirtuel'] = round(($totcash +  $data['fdc'] + $data['totpaiementcredit']), 2) - round($data['totdepense'], 2);

    //Versement
    if($caissier_id==0){

        if ($maffiche == 'USD') {
            $requete = $bdd->prepare("SELECT SUM(a.montant_vers/a.taux+a.montantusd) AS montverse
        FROM t_versement AS a,t_utilisateur AS b
        WHERE  a.user_vers=b.id_user
         AND a.date_vers BETWEEN :dte1 AND :dte2 AND a.id_sousresto=:id_sousresto");
        } else {
            $requete = $bdd->prepare("SELECT SUM(a.montant_vers+a.montantusd*a.taux) AS montverse
                        FROM t_versement AS a,t_utilisateur AS b
                        WHERE  a.user_vers=b.id_user
                        AND a.date_vers BETWEEN :dte1 AND :dte2 AND a.id_sousresto=:id_sousresto");
        }
    
        $requete->BindParam(':dte1', $dte1);
        $requete->BindParam(':dte2', $dte2);
        $requete->BindParam(':id_sousresto', $id_sousresto);

    }else{

        if ($maffiche == 'USD') {
            $requete = $bdd->prepare("SELECT SUM(a.montant_vers/a.taux+a.montantusd) AS montverse
        FROM t_versement AS a,t_utilisateur AS b
        WHERE  a.user_vers=b.id_user
         AND a.date_vers BETWEEN :dte1 AND :dte2 AND a.id_sousresto=:id_sousresto
         AND a.user_vers=:user_vers
         ");
        } else {
            $requete = $bdd->prepare("SELECT SUM(a.montant_vers+a.montantusd*a.taux) AS montverse
                        FROM t_versement AS a,t_utilisateur AS b
                        WHERE  a.user_vers=b.id_user
                        AND a.date_vers BETWEEN :dte1 AND :dte2 AND a.id_sousresto=:id_sousresto
                        AND a.user_vers=:user_vers
                     ");
        }
    
        $requete->BindParam(':dte1', $dte1);
        $requete->BindParam(':dte2', $dte2);
        $requete->BindParam(':id_sousresto', $id_sousresto);
        $requete->BindParam(':user_vers', $caissier_id);
    }
    
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $data['soldephys'] = $r->montverse;
    }

    //Fonds de caisse du lendemain

    // Fonds de caisse du lendemain
    $fdcldm = 0;
    if($caissier_id==0){
        if ($maffiche == 'USD') {
            $req = "SELECT SUM(a.fdcl_usd +(a.fdcl_cdf/a.taux)) AS montant
                    FROM t_versement AS a
                    WHERE  a.date_vers=:dte2 AND a.id_sousresto=:sousresto_id";
        } else {
            $req = "SELECT SUM(a.fdcl_usd*a.taux+a.fdcl_cdf) AS montant
            FROM t_versement AS a
            WHERE a.date_vers=:dte2 AND a.id_sousresto=:sousresto_id";
        }
    
        $requete = $bdd->prepare($req);
        $requete->BindParam(':sousresto_id', $id_sousresto);
        $requete->BindParam(':dte2', $dte2);
    }else{
        if ($maffiche == 'USD') {
            $req = "SELECT SUM(a.fdcl_usd+(a.fdcl_cdf/a.taux)) AS montant
                    FROM t_versement AS a
                    WHERE a.id_sousresto=:sousresto_id 
                    AND a.date_vers=:dte2
                    AND a.user_vers=:user_id
                    ";
        } else {
            $req = "SELECT SUM(a.fdcl_usd*a.taux+a.fdcl_cdf) AS montant
            FROM t_versement AS a
            WHERE  a.id_sousresto=:sousresto_id 
            AND a.date_vers=:dte2
            AND a.user_vers=:user_id";
        }
    
        $requete = $bdd->prepare($req);
        $requete->BindParam(':sousresto_id', $id_sousresto);
        $requete->BindParam(':dte2',$dte2);
        $requete->BindParam(':user_id',$caissier_id);
    }
   
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $data['fdcldm'] = $r->montant;
    }
    $data['balance'] = $data['soldephys']+$data['fdcldm'] - $data['soldevirtuel'];
    return $data;
}
 */
function rapportVersementUser($caissier_id, $id_sousresto, $maffiche, $dte1, $dte2, $taux, $bdd)
{
    $data = array();
    $data['ventes'] = array();
    $data['ventes']['mode']  = array();
    $data['ventes']['montant']  = array();
    $data['ventes']['total']  = 0;
    $data['fdc'] = 0;
    $data['totpaiementcredit'] = 0;
    $data['totdepense'] = 0;
    $data['soldevirtuel'] = 0;
    $data['soldephys'] = 0;
    $data['fdcldm'] = 0;
    $data['totcash'] = 0;
    $data['balance'] = 0;
    $data['periode'] = dateAffiche($dte1) . '-' . dateAffiche($dte2);
    $totcash = 0;
    $ventes =  getMontantVenteParModeUser($caissier_id, $maffiche, $id_sousresto, $dte1, $dte2, $bdd);
    foreach ($ventes as $r) {
        $mont = $r->montant;
        $mode = $r->lib;
        if ($r->mode2 == 1) {
            $totcash = $mont;
        }
        array_push($data['ventes']['mode'], $mode);
        array_push($data['ventes']['montant'], $mont);
        $data['ventes']['total'] += $mont;
    }
    $data['totcash'] = $totcash;
    //Fonds de caisse
    if ($caissier_id == 0) {
        $requete = $bdd->prepare("SELECT SUM(cdf) AS fond_cdf,SUM(usd) AS fond_usd
        FROM fondscaisse 
        WHERE dte =:dte2
            AND sousresto_id=:sousresto_id");
        $requete->BindParam(':dte2', $dte2);
        $requete->BindParam(':sousresto_id', $id_sousresto);
    } else {
        $requete = $bdd->prepare("SELECT SUM(cdf) AS fond_cdf,SUM(usd) AS fond_usd
        FROM fondscaisse 
        WHERE dte =:dte2
            AND sousresto_id=:sousresto_id AND user_id=:user_id");
        $requete->BindParam(':dte2', $dte2);
        $requete->BindParam(':sousresto_id', $id_sousresto);
        $requete->BindParam(':user_id', $caissier_id);
    }

    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($result as $r) {
        if ($maffiche == 'USD') {
            $data['fdc'] = $r->fond_cdf / $taux + $r->fond_usd;
        } else {
            $data['fdc'] = $r->fond_cdf + $r->fond_usd * $taux;
        }
    }
    // Paiement credit
    $data['totpaiementcredit'] = PaiementCreance2User($caissier_id, $maffiche, $id_sousresto, $dte1, $dte2, $bdd);

    //Depenses
    if ($caissier_id == 0) {
        if ($maffiche == 'USD') {
            $requete = $bdd->prepare("SELECT SUM(cdf/taux+usd) AS totdepense FROM depenses AS a
            WHERE  a.sousresto_id=:sousresto_id
              AND a.psedo=0 
              AND a.dte_dep BETWEEN :dte1 AND :dte2
               ");
        } else {
            $requete = $bdd->prepare("SELECT SUM(cdf+usd*taux) AS totdepense FROM depenses AS a
            WHERE  a.sousresto_id=:sousresto_id
              AND a.psedo=0 
              AND a.dte_dep BETWEEN :dte1 AND :dte2");
        }
        $requete->BindParam(':dte1', $dte1);
        $requete->BindParam(':dte2', $dte2);
        $requete->BindParam(':sousresto_id', $id_sousresto);
    } else {
        if ($maffiche == 'USD') {
            $requete = $bdd->prepare("SELECT SUM(cdf/taux+usd) AS totdepense FROM depenses AS a
            WHERE  a.sousresto_id=:sousresto_id
              AND a.psedo=0 
              AND a.dte_dep BETWEEN :dte1 AND :dte2
              AND a.user_id=:user_id
               ");
        } else {
            $requete = $bdd->prepare("SELECT SUM(cdf+usd*taux) AS totdepense FROM depenses AS a
            WHERE  a.sousresto_id=:sousresto_id
              AND a.psedo=0 
              AND a.dte_dep BETWEEN :dte1 AND :dte2
              AND a.user_id=:user_id");
        }
        $requete->BindParam(':dte1', $dte1);
        $requete->BindParam(':dte2', $dte2);
        $requete->BindParam(':sousresto_id', $id_sousresto);
        $requete->BindParam(':user_id', $caissier_id);
    }

    $requete->execute();
    $depenses = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($depenses as $r) {
        $data['totdepense'] = $r->totdepense;
    }

    $data['soldevirtuel'] = round(($totcash +  $data['fdc'] + $data['totpaiementcredit']), 2) - round($data['totdepense'], 2);

    //Versement
    if ($caissier_id == 0) {

        if ($maffiche == 'USD') {
            $requete = $bdd->prepare("SELECT SUM(a.montant_vers/a.taux+a.montantusd) AS montverse
        FROM t_versement AS a,t_utilisateur AS b
        WHERE  a.user_vers=b.id_user
         AND a.date_vers BETWEEN :dte1 AND :dte2 AND a.id_sousresto=:id_sousresto");
        } else {
            $requete = $bdd->prepare("SELECT SUM(a.montant_vers+a.montantusd*a.taux) AS montverse
                        FROM t_versement AS a,t_utilisateur AS b
                        WHERE  a.user_vers=b.id_user
                        AND a.date_vers BETWEEN :dte1 AND :dte2 AND a.id_sousresto=:id_sousresto");
        }

        $requete->BindParam(':dte1', $dte1);
        $requete->BindParam(':dte2', $dte2);
        $requete->BindParam(':id_sousresto', $id_sousresto);
    } else {

        if ($maffiche == 'USD') {
            $requete = $bdd->prepare("SELECT SUM(a.montant_vers/a.taux+a.montantusd) AS montverse
        FROM t_versement AS a,t_utilisateur AS b
        WHERE  a.user_vers=b.id_user
         AND a.date_vers BETWEEN :dte1 AND :dte2 AND a.id_sousresto=:id_sousresto
         AND a.user_vers=:user_vers
         ");
        } else {
            $requete = $bdd->prepare("SELECT SUM(a.montant_vers+a.montantusd*a.taux) AS montverse
                        FROM t_versement AS a,t_utilisateur AS b
                        WHERE  a.user_vers=b.id_user
                        AND a.date_vers BETWEEN :dte1 AND :dte2 AND a.id_sousresto=:id_sousresto
                        AND a.user_vers=:user_vers
                     ");
        }

        $requete->BindParam(':dte1', $dte1);
        $requete->BindParam(':dte2', $dte2);
        $requete->BindParam(':id_sousresto', $id_sousresto);
        $requete->BindParam(':user_vers', $caissier_id);
    }

    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $data['soldephys'] = $r->montverse;
    }

    //Fonds de caisse du lendemain

    // Fonds de caisse du lendemain
    $fdcldm = 0;
    if ($caissier_id == 0) {
        if ($maffiche == 'USD') {
            $req = "SELECT SUM(a.usd+(a.cdf/a.taux)) AS montant
                    FROM depenses AS a, dep_libelles AS b
                    WHERE a.libelle_id=b.id 
                    AND a.sousresto_id=:sousresto_id AND a.psedo=0 
                    AND b.code='fdclobi'
                    AND a.dte_dep=:dte2";
        } else {
            $req = "SELECT SUM(a.usd*a.taux+a.cdf) AS montant
            FROM depenses AS a, dep_libelles AS b
            WHERE a.libelle_id=b.id 
            AND a.sousresto_id=:sousresto_id AND a.psedo=0 
            AND b.code='fdclobi'
            AND a.dte_dep=:dte2";
        }

        $requete = $bdd->prepare($req);
        $requete->BindParam(':sousresto_id', $id_sousresto);
        $requete->BindParam(':dte2', $dte2);
    } else {
        if ($maffiche == 'USD') {
            $req = "SELECT SUM(a.usd+(a.cdf/a.taux)) AS montant
                    FROM depenses AS a, dep_libelles AS b
                    WHERE a.libelle_id=b.id 
                    AND a.sousresto_id=:sousresto_id AND a.psedo=0 
                    AND b.code='fdclobi'
                    AND a.dte_dep=:dte2
                    AND a.user_id=:user_id
                    ";
        } else {
            $req = "SELECT SUM(a.usd*a.taux+a.cdf) AS montant
            FROM depenses AS a, dep_libelles AS b
            WHERE a.libelle_id=b.id 
            AND a.sousresto_id=:sousresto_id AND a.psedo=0 
            AND b.code='fdclobi'
            AND a.dte_dep=:dte2
            AND a.user_id=:user_id";
        }

        $requete = $bdd->prepare($req);
        $requete->BindParam(':sousresto_id', $id_sousresto);
        $requete->BindParam(':dte2', $dte2);
        $requete->BindParam(':user_id', $caissier_id);
    }

    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $data['fdcldm'] = $r->montant;
    }
    $data['balance'] = $data['soldephys'] - $data['soldevirtuel'];
    return $data;
}

function PaiementCreance2User($caissier_id, $m_affiche, $id_soussite, $dte1, $dte2, $bdd)
{
    $total = 0;
    $idsite = $_SESSION['id_hotel'];
    if ($caissier_id == 0) {
        $requete = $bdd->prepare("SELECT f.id_fact,f.taux,b.montantcdf,b.montantusd,b.rendu_cdf,b.rendu_usd
        FROM t_facture AS f,t_reglement AS fa,paiement AS b
        WHERE f.id_fact=fa.id_fact 
            AND fa.id_regl=b.regl_id
            AND f.mode='Credit'
            AND b.id_mode_regl IN(2,3)
            AND fa.dte BETWEEN :dte1 AND :dte2
            AND  f.id_sousresto=:id_hotel
            ");

        $requete->BindParam(':id_hotel', $id_soussite);
        $requete->BindParam(':dte1', $dte1);
        $requete->BindParam(':dte2', $dte2);
    } else {
        $requete = $bdd->prepare("SELECT f.id_fact,f.taux,b.montantcdf,b.montantusd,b.rendu_cdf,b.rendu_usd
        FROM t_facture AS f,t_reglement AS fa,paiement AS b
        WHERE f.id_fact=fa.id_fact 
            AND fa.id_regl=b.regl_id
            AND f.mode='Credit'
            AND b.id_mode_regl IN(2,3)
            AND fa.dte BETWEEN :dte1 AND :dte2
            AND  f.id_sousresto=:id_hotel
            AND  fa.id_user=:id_user
            ");

        $requete->BindParam(':id_hotel', $id_soussite);
        $requete->BindParam(':dte1', $dte1);
        $requete->BindParam(':dte2', $dte2);
        $requete->BindParam(':id_user', $caissier_id);
    }

    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $taux = $r->taux;
        $montantusd = $r->montantusd;
        $rendu_usd = $r->rendu_usd;
        $montantcdf = $r->montantcdf;
        $rendu_cdf = $r->rendu_cdf;
        if ($m_affiche == 'USD') {
            $total += ($montantusd - $rendu_usd) + ($montantcdf - $rendu_cdf) / $taux;
        } else {
            $total += ($montantusd - $rendu_usd) * $taux + ($montantcdf - $rendu_cdf);
        }
    }
    return $total;
}

function getMontantVenteParModeUser($caissier_id, $maffiche, $site_id, $dte1, $dte2, $bdd)
{
    if ($caissier_id == 0) {
        if ($maffiche == 'USD') {
            $req = "SELECT a.mode AS lib,a.mode2,SUM((b.qte*b.prixremise)/a.taux_prix) AS montant
                    FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
                        WHERE a.id_fact=b.commande_id 
                        AND b.produit_id= c.idprod
                        AND a.mode IS NOT NULL
                        AND a.date_edition  BETWEEN :dte1 AND :dte2
                        AND a.id_sousresto=:site_id
                        GROUP BY a.mode";
        } else {
            $req = "SELECT a.mode AS lib,a.mode2,SUM(b.qte*b.prixremise) AS montant
        FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
            WHERE a.id_fact=b.commande_id 
            AND b.produit_id= c.idprod
            AND a.mode IS NOT NULL
            AND a.date_edition  BETWEEN :dte1 AND :dte2
            AND a.id_sousresto=:site_id
            GROUP BY a.mode";
        }
        $requete = $bdd->prepare($req);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':dte1', $dte1);
        $requete->BindParam(':dte2', $dte2);
    } else {

        if ($maffiche == 'USD') {
            $req = "SELECT a.mode AS lib,a.mode2,SUM((b.qte*b.prixremise)/a.taux_prix) AS montant
                    FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
                        WHERE a.id_fact=b.commande_id 
                        AND b.produit_id= c.idprod
                        AND a.mode IS NOT NULL
                        AND a.date_edition  BETWEEN :dte1 AND :dte2
                        AND a.id_sousresto=:site_id
                        AND a.id_user=:id_user
                        GROUP BY a.mode";
        } else {
            $req = "SELECT a.mode AS lib,a.mode2,SUM(b.qte*b.prixremise) AS montant
        FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
            WHERE a.id_fact=b.commande_id 
            AND b.produit_id= c.idprod
            AND a.mode IS NOT NULL
            AND a.date_edition  BETWEEN :dte1 AND :dte2
            AND a.id_sousresto=:site_id
            AND a.id_user=:id_user
            GROUP BY a.mode";
        }
        $requete = $bdd->prepare($req);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':dte1', $dte1);
        $requete->BindParam(':dte2', $dte2);
        $requete->BindParam(':id_user', $caissier_id);
    }

    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);

    return $result;
}
