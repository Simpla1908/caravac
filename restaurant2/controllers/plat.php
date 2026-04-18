<?php
ini_set('display_errors', 1);
if ($do == 'liste') {
    $_SESSION['fiche'] = array();
    $_SESSION['fiche']['ingred_id'] = array();
    $_SESSION['fiche']['name'] = array();
    $_SESSION['fiche']['qte'] = array();
    $_SESSION['fiche']['utite'] = array();
    $_SESSION['fiche']['prix'] = array();

    $_SESSION['accomp'] = array();
    $_SESSION['accomp']['accomp_id'] = array();
    $_SESSION['accomp']['accomp_name'] = array();
    $_SESSION['accomp']['qte_accomp'] = array();
    $_SESSION['accomp']['unite_accomp'] = array();

    if ($_SESSION['type_user'] == 1) {
        $visible = 1;
        $col = 12;
        $depot = ListPOSResto($_SESSION['id_hotel'], $bdd);
    } else {
        $visible = 1;
        $col = 12;
        $depot = ListPOSRestoOne($_SESSION['id_sousresto'], $bdd);
    }
    $_SESSION['visible'] = $visible;
    $familles = FamillesPlat($bdd);
    $sous_familles = SousFamillesPlat($bdd);
    $produits = ListePlat($bdd);
    $details_plats = SelectDetailsPlats($bdd);
    include($pathview . 'plat/liste.php');
} elseif ($do == 'majliste') {
    include($pathview . 'plat/view_plat.php');
} elseif ($do == 'update') {
    $id = $_GET['id'];
    //Prix de vente
    $req2 = "SELECT a.*
                FROM t_prix_produit AS a
                WHERE  a.sousresto_id=:sousresto_id AND a.produit_id=:produit_id";
    $requete1 = $bdd->prepare($req2);
    $requete1->BindParam(':sousresto_id', $_SESSION['id_sousresto']);
    $requete1->BindParam(':produit_id', $id);
    $requete1->execute();
    $art2 = $requete1->fetch(PDO::FETCH_OBJ);
    $pv1 = $art2->prix_vente;
    $mon = $art2->monnaie;
    $id_prix = $art2->id_prix;
    $pv = montant_equivalent_bdd($mon, $m_insert, $tauxdollar, $pv1);
    //Infos produit
    $plat = 1;
    $requete = $bdd->prepare("SELECT * FROM  stk_famille AS f"
        . " WHERE f.hotel_id=:hotel_id  AND f.plat=:plat ORDER BY designation");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':plat', $plat);
    $requete->execute();
    $familles = $requete->fetchAll(PDO::FETCH_OBJ);
    $requete = $bdd->prepare("SELECT prod.path_image,prod.biere,prod.accomp, prod.softplt,prod.softbtl,prod.legume,prod.cuisso,prod.soce,prod.cond,prod.vin ,prod.pop,prod.code,prod.idprod,prod.designation AS produit,prod.pa,prod.pv,prod.statut,prod.qte_initial,prod.qte_min,prod.repas,prod.unite,prod.monnaie,prod.vendrerupturestk,s_fam.id_s_fam,s_fam.des,fam.idfamille,fam.designation ,fam.affichage,fam.plat FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam WHERE  prod.famille_id=s_fam.id_s_fam  AND prod.idprod=:idprod AND  prod.hotel_id=:hotel_id AND s_fam.famille=fam.idfamille ORDER BY prod.idprod DESC");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':idprod', $id);
    $requete->execute();
    $prod = $requete->fetch(PDO::FETCH_OBJ);

    //Sous-famille
    $requete = $bdd->prepare("SELECT * FROM  stk_sous_famille AS f"
        . " WHERE f.hotel_id=:hotel_id ORDER BY des");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $s_familles = $requete->fetchAll(PDO::FETCH_OBJ);

    //Depot
    $requete = $bdd->prepare("SELECT a.id_prix,a.prix_vente,b.id_sousresto,b.libelle AS resto,b.depot_id FROM t_prix_produit AS a, t_sousresto AS b
                    WHERE a.sousresto_id=b.id_sousresto AND b.etat=1 AND a.produit_id=:produit_id AND b.hotel_id=:id_hotel");
    $requete->BindParam(':produit_id', $id);
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->execute();
    $depot = $requete->fetchAll(PDO::FETCH_OBJ);
    /*Liste des ingredients */
    $ingredients = listeProduitIngredient($id, $_SESSION['id_hotel'], $bdd);
    foreach ($ingredients as $ingr) {
        $prod_id = $ingr->produit_id;
        $name = $ingr->designation;
        $qte = $ingr->quantite;
        $utite = $ingr->unite;
        $prix = $ingr->prix;
        if (!in_array($prod_id, $_SESSION['fiche']['ingred_id'])) {
            array_push($_SESSION['fiche']['ingred_id'], $prod_id);
            array_push($_SESSION['fiche']['name'], $name);
            array_push($_SESSION['fiche']['qte'], $qte);
            array_push($_SESSION['fiche']['utite'], $utite);
            array_push($_SESSION['fiche']['prix'], $prix);
        }
    }
    /*Liste des ingredients */
    $nbArticles = count($_SESSION['fiche']['ingred_id']);
    include($pathview . 'plat/update.php');
} elseif ($do == 'majfam') {
    //MAJ de la liste des familles
    $familles = FamillesPlat($bdd);
    include($pathview . 'plat/view_famille.php');
} elseif ($do == 'upfam') {
    $id = $_GET['id'];
    $requete = $bdd->prepare("SELECT fam.idfamille,fam.designation FROM stk_famille AS fam WHERE fam.idfamille=:famille_id AND fam.hotel_id=:hotel_id ORDER BY fam.idfamille DESC");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':famille_id', $id);
    $requete->execute();
    $fam = $requete->fetch(PDO::FETCH_OBJ);
    include($pathview . 'plat/update_famille.php');
} elseif ($do == 'majsfam') {
    //MAJ de la liste des familles
    $sous_familles = SousFamillesPlat($bdd);
    include($pathview . 'plat/view_sousfamille.php');
} elseif ($do == 'upsfam') {
    $id = $_GET['id'];
    $requete = $bdd->prepare("SELECT s_fam.id_s_fam,s_fam.des,fam.idfamille,fam.designation"
        . " FROM stk_sous_famille AS s_fam,stk_famille AS fam"
        . " WHERE s_fam.id_s_fam=:famille_id AND s_fam.famille=fam.idfamille"
        . " AND s_fam.hotel_id=:hotel_id ORDER BY s_fam.id_s_fam DESC");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':famille_id', $id);
    $requete->execute();
    $s_fam = $requete->fetch(PDO::FETCH_OBJ);
    include($pathview . 'plat/update_sfamille.php');
} elseif ($do == 'delsfam') {
    $id = $_GET['id'];
    $pseudo_supp = 1;
    $requete = $bdd->prepare("UPDATE stk_sous_famille SET pseudo_supp=:pseudo_supp WHERE id_s_fam=:id");
    $requete->BindParam(':pseudo_supp', $pseudo_supp);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $json['s'] = True;
    echo json_encode($json);
} elseif ($do == 'delfam') {
    $id = $_GET['id'];
    $pseudo_supp = 1;
    $requete = $bdd->prepare("UPDATE stk_famille SET pseudo_supp=:pseudo_supp WHERE idfamille=:id");
    $requete->BindParam(':pseudo_supp', $pseudo_supp);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $json['s'] = True;
    echo json_encode($json);
} elseif ($do == 'majplat') {
    //MAJ de la liste des plats
    $produits = ListePlat($bdd);
    include($pathview . 'plat/view_plat.php');
} elseif ($do == 'delplat') {
    $id = $_GET['id'];
    $pseudo_supp = 1;
    $requete = $bdd->prepare("UPDATE stk_produit SET pseudo_supp=:pseudo_supp WHERE idprod=:id");
    $requete->BindParam(':pseudo_supp', $pseudo_supp);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $json['s'] = True;
    echo json_encode($json);
} elseif ($do == 'majcuisson') {
    //MAJ de la liste des cuisson
    $details_plats = SelectDetailsPlats($bdd);
    include($pathview . 'plat/view_cuisson.php');
} elseif ($do == 'majsauce') {
    //MAJ de la liste des cuisson
    $details_plats = SelectDetailsPlats($bdd);
    include($pathview . 'plat/view_sauce.php');
} elseif ($do == 'majviewfiche') {
    //MAJ de la liste de fiches techniques
    $fich_sfamid = $_GET['fich_sfamid'];
    if ($fich_sfamid == 0) {
        include($pathview . 'plat/view_fiches.php');
    } else {
        include($pathview . 'plat/view_fiches_2.php');
    }
}
