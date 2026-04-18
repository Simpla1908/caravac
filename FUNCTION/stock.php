<?php
function montant_equivalent_bdd_stk($m1, $m2, $tauxdollar1, $montant1)
{
    if ($m1 == $m2) {
        $mont = $montant1;
    } else {
        if ($m1 == 'USD' && $m2 == 'CDF') {
            $mont = $montant1 * $tauxdollar1;
        } else {
            $mont = $montant1 / $tauxdollar1;
        }
    }
    return $mont;
}
function reportStock($bdd, $data, $action)
{

    if ($action == 'insert') {
        $requete = $bdd->prepare("INSERT stk_report (qte_initial_save,dte_report,dte_report_time,produit_id,idmvt,hotel_id)
                                         VALUES(:qte_initial_save,:dte_report,:dte_report_time,:produit_id,:idmvt,:hotel_id)");

        $requete->BindParam(':qte_initial_save', $data['qte_initial_save']);
        $requete->BindParam(':dte_report', $data['dte_report']);
        $requete->BindParam(':dte_report_time', $data['dte_report_time']);
        $requete->BindParam(':produit_id', $data['produit_id']);
        $requete->BindParam(':idmvt', $data['idmvt']);
        $requete->BindParam(':hotel_id', $data['id_hotel']);
        $requete->execute();
    } else {
        $req = "UPDATE stk_report 
                SET qte_initial_save =:qte_initial_save
                WHERE idmvt=:idmvt";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':qte_initial_save', $data['qte_initial_save']);
        $requete->BindParam(':idmvt', $data['idmvt']);
        $requete->execute();
    }
}
function getQinitialProduit($bdd, $produit_id)
{
    $qo = 0;
    $requete = $bdd->prepare("SELECT rep.dte_report,rep.produit_id,rep.qte_initial_save
                                FROM stk_report AS rep
                                        WHERE rep.produit_id=:produit_id
                                                AND rep.id=(SELECT MAX(rep.id)
                                                        FROM stk_report AS rep
                                             WHERE rep.produit_id=:produit_id)");
    $requete->BindParam(':produit_id', $produit_id);
    $requete->execute();
    $reports = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($reports as $c) {
        $qo = $c->qte_initial_save;
    }
    return $qo;
}
function getQuantiteProduit($bdd, $produit_id)
{

    $requete = $bdd->prepare("SELECT (prod.qte_initial+SUM(m.qte_entree))-SUM(m.qte_sortie) AS qte_tot_prod
    FROM stk_produit AS prod, stk__mouvement AS m 
    WHERE  prod.idprod=m.produit_id
    AND prod.idprod=:idprod AND prod.hotel_id=:hotel_id");
    $requete->BindParam(':idprod', $produit_id);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $articles = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($articles  as $a) {
        $qte_tot_prod = $a->qte_tot_prod;
    }
    return $qte_tot_prod;
}
function setQuantiteProduit($bdd, $produit_id, $quantite, $action)
{
    if ($action == '-') {
        $qte_prod = -$quantite;
    } else {
        $qte_prod = $quantite;
    }
    $requete = $bdd->prepare("UPDATE stk_produit  SET qte_dispo=qte_dispo+:qte_dispo WHERE idprod=:idprod");
    $requete->BindParam(':qte_dispo', $qte_prod);
    $requete->BindParam(':idprod', $produit_id);
    $requete->execute();
}
function MajValueQteDispo($typmouve, $aqte, $nqte, $idprod, $bdd)
{
    if ($typmouve == 1) {
        $requete = $bdd->prepare("UPDATE stk_produit SET qte_dispo=qte_dispo-:aqte+:nqte WHERE idprod=:idprod");
    } else if ($typmouve == 0) {
        $requete = $bdd->prepare("UPDATE stk_produit SET qte_dispo=qte_dispo+:aqte-:nqte WHERE idprod=:idprod");
    }
    $requete->BindParam(':aqte', $aqte);
    $requete->BindParam(':nqte', $nqte);
    $requete->BindParam(':idprod', $idprod);
    $requete->execute();
}
function getQuantiteProduitSousResto($bdd, $produit_id, $depot_id)
{

    $requete = $bdd->prepare("SELECT (prod.qte_initial+SUM(m.qte_entree))-SUM(m.qte_sortie) AS qte_tot_prod
    FROM stk_produit AS prod, stk__mouvement AS m, t_depot AS d 
    WHERE  prod.idprod=m.produit_id AND d.id_depot=m.depot_id 
    AND prod.idprod=:idprod AND m.depot_id=:depot_id AND prod.hotel_id=:hotel_id");
    $requete->BindParam(':idprod', $produit_id);
    $requete->BindParam(':depot_id', $depot_id);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $articles = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($articles  as $a) {
        $qte_tot_prod = $a->qte_tot_prod;
    }
    return $qte_tot_prod;
}

function getQuantiteProduitDepot($bdd, $produit_id, $depot_id)
{

    $requete = $bdd->prepare("SELECT (SUM(qte_entree)-SUM(qte_sortie)) AS qte_dispo 
                FROM stk__mouvement AS m, stk_produit AS p, t_depot AS d
                WHERE m.produit_id=p.idprod AND d.id_depot=m.depot_id
                AND p.pseudo_supp=0 AND m.depot_id=:depot_id
                AND m.produit_id=:produit_id AND m.hotel_id=:hotel_id
                GROUP BY m.produit_id ORDER BY p.designation");
    $requete->BindParam(':depot_id', $depot_id);
    $requete->BindParam(':produit_id', $produit_id);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $articles = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($articles  as $a) {
        $qte_tot_prod = $a->qte_dispo;
    }
    return $qte_tot_prod;
}

//MISE A JOUR
function CreateBonStk($numero, $type, $motif, $beneficiere, $depot_id, $user_id, $hotel_id, $nbreprod, $dte, $dte_time, $approuve, $motifappro, $bdd)
{

    $requete = $bdd->prepare("INSERT skt_fiche (numero,type,motif,beneficiere,depot_id,user_id,hotel_id,nbrprod,dte,dte_time,approuve,motifappro)
                                     VALUES(:numero,:type,:motif,:beneficiere,:depot_id,:user_id,:hotel_id,:nbreprod,:dte,:dte_time,:approuve,:motifappro)");
    $requete->BindParam(':numero', $numero);
    $requete->BindParam(':type', $type);
    $requete->BindParam(':motif', $motif);
    $requete->BindParam(':beneficiere', $beneficiere);
    $requete->BindParam(':depot_id', $depot_id);
    $requete->BindParam(':user_id', $user_id);
    $requete->BindParam(':hotel_id', $hotel_id);
    $requete->BindParam(':nbreprod', $nbreprod);
    $requete->BindParam(':dte', $dte);
    $requete->BindParam(':dte_time', $dte_time);
    $requete->BindParam(':approuve', $approuve);
    $requete->BindParam(':motifappro', $motifappro);
    $requete->execute();
    $bon_id = $bdd->lastInsertId();
    return $bon_id;
}
function CreateValidationStk($qte_envoye, $qte_verif, $motif_id, $produit_id, $fiche_id, $hotel_id, $bdd)
{
    $requete = $bdd->prepare("INSERT t_validation (qte_envoye,qte_verif ,motif_id,produit_id,fiche_id,hotel_id)
                               VALUES(:qte_envoye,:qte_verif ,:motif_id ,:produit_id,:fiche_id,:hotel_id)");
    $requete->BindParam(':qte_envoye', $qte_envoye);
    $requete->BindParam(':qte_verif', $qte_envoye);
    $requete->BindParam(':motif_id', $motif_id);
    $requete->BindParam(':produit_id', $produit_id);
    $requete->BindParam(':fiche_id', $fiche_id);
    $requete->BindParam(':hotel_id', $hotel_id);
    $requete->execute();
}
function ApprovisionnementStk($quantite, $date_bon, $article, $fiche_id, $depot_id, $user_id, $hotel_id, $motif_sortie_id, $bdd)
{
    $qte_declasse = $qte_sortie = 0;
    $date_heure_bon = date('Y-m-d H:i:s');
    $type = 'appro';
    $qte_report0 = GetReportByProd($article, $depot_id, $bdd);
    $qte_report = $qte_report0 + $quantite;
    $requete = $bdd->prepare("INSERT stk__mouvement
                               (type,qte_entree,qte_sortie,qte_declasse,qte_report,dte_appro,
                                dte_appro_heure,produit_id,fiche_id,motif_sortie_id,depot_id,user_id,hotel_id)
                                
                               VALUES(:type,:qte_entree,:qte_sortie,:qte_declasse,:qte_report,
                                    :dte_appro,:dte_appro_heure,:produit_id,:fiche_id,:motif_sortie_id,
                                    :depot_id,:user_id,:hotel_id)");

    $requete->BindParam(':type', $type);
    $requete->BindParam(':qte_entree', $quantite);
    $requete->BindParam(':qte_sortie', $qte_sortie);
    $requete->BindParam(':qte_declasse', $qte_declasse);
    $requete->BindParam(':qte_report', $qte_report);
    $requete->BindParam(':dte_appro', $date_bon);
    $requete->BindParam(':dte_appro_heure', $date_heure_bon);
    $requete->BindParam(':produit_id', $article);
    $requete->BindParam(':fiche_id', $fiche_id);
    $requete->BindParam(':motif_sortie_id', $motif_sortie_id);
    $requete->BindParam(':depot_id', $depot_id);
    $requete->BindParam(':user_id', $user_id);
    $requete->BindParam(':hotel_id', $hotel_id);
    $requete->execute();
}
function SortieStk($quantite, $qte_declasse, $date_bon, $article, $motif_sortie_id, $fiche_id, $depot_id, $user_id, $hotel_id, $bdd)
{
    $qte_entree = 0;
    $date_heure_bon = date('Y-m-d H:i:s');
    $type = 'sortie';
    $qte_report0 = GetReportByProd($article, $depot_id, $bdd);
    $qte_report = $qte_report0 - ($quantite + $qte_declasse);
    $requete = $bdd->prepare("INSERT stk__mouvement
                               (type,qte_entree,qte_sortie,qte_declasse,qte_report,dte_appro,
                                dte_appro_heure,produit_id,fiche_id,motif_sortie_id,depot_id,user_id,hotel_id)
                                
                               VALUES(:type,:qte_entree,:qte_sortie,:qte_declasse,:qte_report,
                                    :dte_appro,:dte_appro_heure,:produit_id,:fiche_id,:motif_sortie_id,
                                    :depot_id,:user_id,:hotel_id)");

    $requete->BindParam(':type', $type);
    $requete->BindParam(':qte_entree', $qte_entree);
    $requete->BindParam(':qte_sortie', $quantite);
    $requete->BindParam(':qte_declasse', $qte_declasse);
    $requete->BindParam(':qte_report', $qte_report);
    $requete->BindParam(':dte_appro', $date_bon);
    $requete->BindParam(':dte_appro_heure', $date_heure_bon);
    $requete->BindParam(':produit_id', $article);
    $requete->BindParam(':fiche_id', $fiche_id);
    $requete->BindParam(':motif_sortie_id', $motif_sortie_id);
    $requete->BindParam(':depot_id', $depot_id);
    $requete->BindParam(':user_id', $user_id);
    $requete->BindParam(':hotel_id', $hotel_id);
    $requete->execute();
}
function GetMotifMouvement($libelle, $bdd)
{
    $qo = 0;
    $requete = $bdd->prepare("SELECT *
                                FROM t_motif_sortie
                                        WHERE etat=0 AND libelle=:libelle");
    $requete->BindParam(':libelle', $libelle);
    $requete->execute();
    $reports = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($reports as $c) {
        $qo = $c->id_motif_sortie;
    }
    return $qo;
}
function GetDepotCentral_id($hotel_id, $bdd)
{
    $depot_id = 0;
    $requete = $bdd->prepare("SELECT *
                                FROM t_sousresto
                                        WHERE etat=0 AND hotel_id=:hotel_id");
    $requete->BindParam(':hotel_id', $hotel_id);
    $requete->execute();
    $reports = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($reports as $c) {
        $depot_id = $c->depot_id;
    }
    return $depot_id;
}
function GetReportByProd($produit_id, $depot_id, $bdd)
{
    //Renvoi le dernier report d'un produit
    $qo = 0;
    $requete = $bdd->prepare("
                            SELECT qte_report  FROM stk__mouvement AS a
                                WHERE a.produit_id=:produit_id AND a.depot_id=:depot_id
                                AND a.idmvt=(SELECT MAX(b.idmvt) 
                                             FROM stk__mouvement AS b 
                                                WHERE b.produit_id=:produit_id AND b.depot_id=:depot_id)");
    $requete->BindParam(':produit_id', $produit_id);
    $requete->BindParam(':depot_id', $depot_id);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($resultat as $c) {
        $qo = $c->qte_report;
    }
    return $qo;
}
function GetQteDispoByProd($bdd, $produit_id, $depot_id)
{
    $qte_report = GetReportByProd($produit_id, $depot_id, $bdd);
    $qte_tot_prod = 0;
    $requete = $bdd->prepare("SELECT SUM(b.qte) AS qte
   FROM t_facture AS a,lignes_attente AS b
   WHERE a.id_fact=b.facture_id AND a.etat_cmd='1' AND b.produit_id=:produit_id");
    $requete->BindParam(':produit_id', $produit_id);
    $requete->execute();
    $articles = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($articles  as $a) {
        $qte_tot_prod = $a->qte;
    }
    return $qte_report - $qte_tot_prod;
}
function ListMotifSortie($bdd)
{
    $requete = $bdd->prepare("SELECT *FROM t_motif_sortie");
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function IsNombre($val)
{
    $bool = FALSE;
    if (is_numeric($val) && $val > 0) {
        $bool = TRUE;
    }
    return $bool;
}

function sessionInfoBon($numbon, $date, $user, $benef, $statut)
{
    $_SESSION['numbon'] = $numbon;
    $_SESSION['date'] = $date;
    $_SESSION['user'] = $user;
    $_SESSION['benef'] = $benef;
    $_SESSION['statut'] = $statut;
}

function sessionDetailsBon($produit_id, $designation, $qte_envoye, $qte_recue, $ecart, $unite, $obs)
{
    array_push($_SESSION['fiche']['produit_id'], $produit_id);
    array_push($_SESSION['fiche']['designation'], $designation);
    array_push($_SESSION['fiche']['qte_env'], $qte_envoye);
    array_push($_SESSION['fiche']['qte_recue'], $qte_recue);
    array_push($_SESSION['fiche']['ecart'], $ecart);
    array_push($_SESSION['fiche']['unite'], $unite);
    array_push($_SESSION['fiche']['obs'], $obs);
}
function ListPOS($hotel_id, $bdd)
{
    //Retourne la liste des POS
    $requete = $bdd->prepare("SELECT * FROM t_sousresto WHERE hotel_id=:hotel_id ORDER BY etat,libelle");
    $requete->BindParam(':hotel_id', $hotel_id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function GetLibMotifSortie($id_motif_sortie, $bdd)
{
    $libelle = '';
    $requete = $bdd->prepare("SELECT * FROM t_motif_sortie WHERE id_motif_sortie=:id_motif_sortie");
    $requete->BindParam(':id_motif_sortie', $id_motif_sortie);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $libelle = $r->libelle;
    }
    return $libelle;
}
function MajNbreArticleFiche($id_fiche, $nbrprod, $bdd)
{
    $requete = $bdd->prepare("UPDATE skt_fiche SET nbrprod=:nbrprod WHERE id_fiche=:id_fiche");
    $requete->BindParam(':nbrprod', $nbrprod);
    $requete->BindParam(':id_fiche', $id_fiche);
    $requete->execute();
}
function MvtOut($bdd)
{
    $dte = date('Y-m-d');
    $date_h_com = date('Y-m-d H:i:s');
    $user_id = $_SESSION['id_user'];
    $hotel_id = $_SESSION['id_hotel'];
    $_SESSION['panier3']['id_article'] = array();
    $_SESSION['panier3']['qte'] = array();
    $_SESSION['panier3']['repas'] = array();
    $nom_client = $_SESSION['nom_client'];
    $nbArticles = count($_SESSION['panier']['id_article']);
    for ($i = 0; $i <= $nbArticles - 1; $i++) {
        $prod_id = $_SESSION['panier']['id_article'][$i];
        $repas = $_SESSION['panier']['repas'][$i];
        $quantite = $_SESSION['panier']['qte'][$i];
        if ($repas == 0) {
            array_push($_SESSION['panier3']['id_article'], $prod_id);
            array_push($_SESSION['panier3']['qte'], $quantite);
        } else {
            //Recuperation des entrées de plat
            $req = "SELECT * FROM t_ingredient AS a
            WHERE a.plat_id=:plat_id";
            $requete = $bdd->prepare($req);
            $requete->BindParam(':plat_id', $prod_id);
            $requete->execute();
            $produits_plat = $requete->fetchAll(PDO::FETCH_OBJ);
            foreach ($produits_plat as $p) {
                $idp = $p->produit_id;
                $qt = $p->quantite;
                array_push($_SESSION['panier3']['id_article'], $idp);
                array_push($_SESSION['panier3']['qte'], $quantite * $qt);
            }
        }
    }
    $nbArticles2 = count($_SESSION['panier3']['id_article']);
    $lib = 'BS_STK';
    $num_cmd = getnumerotation($hotel_id, $lib, $bdd);
    $num_cmd_format = format_numero($num_cmd);
    $numbon = $num_cmd_format;
    $beneficiere = $nom_client;
    $type = 'sortie';
    $motif_fiche = 'sortie';
    $approuve = 1;
    $depot_id = $_SESSION['depot_id'];
    $user_id = $_SESSION['id_user'];
    $dte_time = $date_h_com;
    $qte_declasse = 0;
    $idmotif = 1;
    $motifappro = '';
    if ($_SESSION['stock'] == 1) {
        $fiche_id = CreateBonStk($numbon, $type, $motif_fiche, $beneficiere, $depot_id, $user_id, $hotel_id, $nbArticles2, $dte, $dte_time, $approuve, $motifappro, $bdd);
        for ($i = 0; $i <= $nbArticles2 - 1; $i++) {
            $idp = $_SESSION['panier3']['id_article'][$i];
            $quantite = $_SESSION['panier3']['qte'][$i];
            SortieStk($quantite, $qte_declasse, $dte, $idp, $idmotif, $fiche_id, $depot_id, $user_id, $hotel_id, $bdd);
        }
        setnumerotation($hotel_id, $lib, $num_cmd + 1, $bdd);
    }
}
function MvtOut2($id_sousresto, $bdd)
{
    $dte = date('Y-m-d');
    $date_h_com = date('Y-m-d H:i:s');
    $user_id = $_SESSION['id_user'];
    $hotel_id = $_SESSION['id_hotel'];
    $_SESSION['panier3']['id_article'] = array();
    $_SESSION['panier3']['qte'] = array();
    $_SESSION['panier3']['repas'] = array();
    $nom_client = $_SESSION['nom_client'];
    $nbArticles = count($_SESSION['panier']['id_article']);
    for ($i = 0; $i <= $nbArticles - 1; $i++) {
        $prod_id = $_SESSION['panier']['id_article'][$i];
        $repas = $_SESSION['panier']['repas'][$i];
        $quantite = $_SESSION['panier']['qte'][$i];
        if ($repas == 0) {
            array_push($_SESSION['panier3']['id_article'], $prod_id);
            array_push($_SESSION['panier3']['qte'], $quantite);
        } else if ($repas == 3) {
            $req = "SELECT * FROM t_ingredient AS a
            WHERE a.plat_id=:plat_id";
            $requete = $bdd->prepare($req);
            $requete->BindParam(':plat_id', $prod_id);
            $requete->execute();
            $produits_plat = $requete->fetchAll(PDO::FETCH_OBJ);
            foreach ($produits_plat as $p) {
                $idp = $p->produit_id;
                $qt = $p->quantite;
                array_push($_SESSION['panier3']['id_article'], $idp);
                array_push($_SESSION['panier3']['qte'], $quantite * $qt);
            }
        }
    }
    $nbArticles2 = count($_SESSION['panier3']['id_article']);
    $lib = 'BS_STK';
    $num_cmd = getnumerotation($hotel_id, $lib, $bdd);
    $num_cmd_format = format_numero($num_cmd);
    $numbon = $num_cmd_format;
    $beneficiere = $nom_client;
    $type = 'sortie';
    $motif_fiche = 'sortie';
    $approuve = 1;
    $depot_id = $id_sousresto;
    $user_id = $_SESSION['id_user'];
    $dte_time = $date_h_com;
    $qte_declasse = 0;
    $idmotif = 1;
    $motifappro = '';
    if ($_SESSION['stock'] == 1) {
        $fiche_id = CreateBonStk($numbon, $type, $motif_fiche, $beneficiere, $depot_id, $user_id, $hotel_id, $nbArticles2, $dte, $dte_time, $approuve, $motifappro, $bdd);
        for ($i = 0; $i <= $nbArticles2 - 1; $i++) {
            $idp = $_SESSION['panier3']['id_article'][$i];
            $quantite = $_SESSION['panier3']['qte'][$i];
            SortieStk($quantite, $qte_declasse, $dte, $idp, $idmotif, $fiche_id, $depot_id, $user_id, $hotel_id, $bdd);
        }
        setnumerotation($hotel_id, $lib, $num_cmd + 1, $bdd);
    }
}
function SortiAccompgnmt($idp, $quantite, $bdd)
{

    $dte = date('Y-m-d');
    $date_h_com = date('Y-m-d H:i:s');
    $user_id = $_SESSION['id_user'];
    $hotel_id = $_SESSION['id_hotel'];
    $_SESSION['panier3']['id_article'] = array();
    $_SESSION['panier3']['qte'] = array();
    $_SESSION['panier3']['repas'] = array();
    $nom_client = $_SESSION['nom_client'];

    $lib = 'BS_STK';
    $num_cmd = getnumerotation($hotel_id, $lib, $bdd);
    $num_cmd_format = format_numero($num_cmd);
    $numbon = $num_cmd_format;
    $beneficiere = $nom_client;
    $type = 'sortie';
    $motif_fiche = 'sortie';
    $approuve = 1;
    $depot_id = $_SESSION['depot_id'];
    $user_id = $_SESSION['id_user'];
    $dte_time = $date_h_com;
    $qte_declasse = 0;
    $idmotif = 1;
    $nbArticles2 = 1;
    $motifappro = '';
    if ($_SESSION['stock'] == 1) {
        $fiche_id = CreateBonStk($numbon, $type, $motif_fiche, $beneficiere, $depot_id, $user_id, $hotel_id, $nbArticles2, $dte, $dte_time, $approuve, $motifappro, $bdd);
        SortieStk($quantite, $qte_declasse, $dte, $idp, $idmotif, $fiche_id, $depot_id, $user_id, $hotel_id, $bdd);
        setnumerotation($hotel_id, $lib, $num_cmd + 1, $bdd);
    }
}

function gettypefamilleid($bdd, $idfamille)
{
    $requete = $bdd->prepare("SELECT familletype_id FROM stk_famille WHERE idfamille=:idfamille");
    $requete->BindParam(':idfamille', $idfamille);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    $familletype_id = $result->familletype_id;
    if ($familletype_id == Null) $familletype_id = 5;
    return $familletype_id;
}
function gettypefamillelib($bdd, $familletype_id)
{
    $requete = $bdd->prepare("SELECT nom FROM stk_familletype WHERE id=:familletype_id");
    $requete->BindParam(':familletype_id', $familletype_id);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    $nom = $result->nom;
    return $nom;
}
