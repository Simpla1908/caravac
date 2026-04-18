<?php
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
if (!isset($_SESSION)) {
    session_start();
}
include '../../FUNCTION/hebergement.php';
include '../../FUNCTION/stock.php';
include '../../FUNCTION/restaurant.php';
$tauxdollar = $_SESSION['tauxdollar'];
$m_affiche = $_SESSION['m_affiche'];
$tva = $_SESSION['tva'];
$taux_op = $_SESSION['taux_resto'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php
    include './Panier.php';
    $accpgmt = 0;
    $bc = 0;
    if (isset($_GET['idprod']) && isset($_GET['prixprod']) && isset($_GET['nameprod']) && isset($_GET['repas'])) {
        //Ajouter un produit dans .  
        if (!isset($_SESSION)) {
            session_start();
            $_SESSION['panier'] = array();
        }
        $_SESSION['visible-popup'] = 1;
        $panier = new Panier();
        $idprod = $_GET['idprod'];
        $repas = $_GET['repas'];
        $nom_plat = $_GET['nameprod'];
        $qty = 1;
        if ($repas == 1) {
            include '../bdd/connexion.php';
            $detailsprod = CheckDetailsProduit($idprod, $bdd);
            $popup = $detailsprod->pop;
            $bool = FALSE;
            if ($_SESSION['stock'] == 1) {
                $requete = $bdd->prepare("SELECT * FROM  stk_produit WHERE idprod=:idprod");
                $requete->BindParam(':idprod', $idprod);
                $requete->execute();
                $prod = $requete->fetch(PDO::FETCH_OBJ);
                if ($prod->vendrerupturestk == 1) {
                    $produits_plat = listeProduitIngredient($idprod, $_SESSION['id_hotel'], $bdd);
                    foreach ($produits_plat as $p) {
                        $idpr = $p->produit_id;
                        $quantite = $qty * $p->quantite;
                        $qte_attente = QteAttenteProd($idpr);
                        $quantite_reste = GetQteDispoByProd($bdd, $idpr, $_SESSION['depot_id']);
                        $quantite_reste -= $qte_attente;
                        if ($quantite > $quantite_reste) {
                            $bool = TRUE;
                            $_SESSION['visible-popup'] = 0;
                            break;
                        }
                    }
                }
            }
            if (!$bool) {
                if ($popup == 0) {
                    $select['cptpanier'] = $_SESSION['cptpanier'];
                    $select['id'] = $idprod;
                    $select['nom'] = $_GET['nameprod'];
                    $select['qte'] = 1;
                    $prix = $_GET['prixprod'];
                    $select['prix'] = $prix;
                    $select['repas'] = $_GET['repas'];
                    $select['pa'] = $_GET['pa'];
                    $select['description'] = '';
                    $panier->ajouter($select);
                }
            } else {
                echo '<div class="alert alert-danger text-center" id="alert_qte"><i class="fa fa-warning fa-fw"></i> Pas moyen de vendre ce plat à cause des ingredients insuffisants!</div>';
            }
        } elseif ($repas == 3) {
            //Add produit groupe in panier
            include '../bdd/connexion.php';
            $detailsprod = CheckDetailsProduit($idprod, $bdd);
            $positionProduit = array_search($idprod, $_SESSION['panier']['id_article']);
            $qlimit = 1;
            if (isset($_SESSION['panier']['qlimit'][$positionProduit])) {
                $qlimit = $_SESSION['panier']['qlimit'][$positionProduit] + 1;
            }
            $qte_increase = 1;
            $qteMout = 0;
            $id_prod_lier_mesurette = 0;
            $prods_lier_mesurette = getProdLierMesurette($idprod, $bdd);
            $testbool = false;
            foreach ($prods_lier_mesurette as $pl) {
                $id_prod_lier_mesurette = $pl->produit_id;
                $qteMout = $pl->quantite;
                $qteStock = GetQteDispoByProd($bdd, $id_prod_lier_mesurette, $_SESSION['depot_id']);
                $qteAttente = QteAttenteProd($id_prod_lier_mesurette);
                $qteDispo = $qteStock - $qteAttente;
                $qteDispo = floor($qteDispo / $qteMout);
                if ($qlimit > $qteDispo) {
                    $testbool = true;
                }
            }
            $popup = $detailsprod->pop;

            if ($popup == 0 &&  !$testbool) {
                $select['cptpanier'] = $_SESSION['cptpanier'];
                $select['id'] = $idprod;
                $select['nom'] = $_GET['nameprod'];
                $select['qte'] = 1;
                $prix = $_GET['prixprod'];
                $select['prix'] = $prix;
                $select['repas'] = $_GET['repas'];
                $select['qte'] = 1;
                $prix = $_GET['prixprod'];
                $select['prix'] = $prix;
                $select['repas'] = $_GET['repas'];
                $select['pa'] = $_GET['pa'];
                $select['description'] = '';

                $panier->ajouter($select);
            } else {
                echo '<div class="alert alert-danger text-center" id="alert_qte"><i class="fa fa-warning fa-fw"></i> Quantité insuffisante!</div>';
            }

            $nbArticles = count($_SESSION['panier']['id_article']);
        } else {
            include '../bdd/connexion.php';
            $select['cptpanier'] = $_SESSION['cptpanier'];
            $select['id'] = $idprod;
            $select['nom'] = $_GET['nameprod'];
            $select['qte'] = 1;
            $prix = $_GET['prixprod'];
            $select['prix'] = $prix;
            $select['repas'] = $_GET['repas'];
            $select['pa'] = $_GET['pa'];
            $select['description'] = '';

            $qte = GetQteDispoByProd($bdd, $select['id'], $_SESSION['depot_id']);
            $qteattente = GetQteProdEnAttenteById($select['id'], $bdd);
            $qdispo = $qte - $qteattente;
            $positionProduit = array_search($select['id'], $_SESSION['panier']['id_article']);

            if ($positionProduit !== false) {
                $qlimit = $_SESSION['panier']['qlimit'][$positionProduit] + 1;
                if ($qlimit <= $qdispo) {
                    $panier->ajouter($select);
                } else {
                    echo '<div class="alert alert-danger text-center" id="alert_qte"><i class="fa fa-warning fa-fw"></i>' . $select['nom'] . ' a déja atteint sa quantité disponible!' . '!</div>';
                }
            } else {
                $panier->ajouter($select);
            }
        }
        $nbArticles = count($_SESSION['panier']['id_article']);
    } elseif (isset($_GET['action']) && $_GET['action'] == 'moins' && isset($_GET['id_produit']) && isset($_GET['qte_produit']) && isset($_GET['repas_resto'])) {
        //Dimunuer qte.   
        if (!isset($_SESSION)) {
            session_start();
        }
        $panier = new Panier();
        //  if (!empty($_GET['id_produit1']) != '') {

        $select['id'] = $_GET['id_produit1'];
        $qty = $_GET['qte_produit'];
        $idprod = $_GET['id_produit'];
        $repas = $_GET['repas_resto'];
        $idcptlign = $_GET['id_produit1'];
        $qtesession = $_SESSION['panier']['qte'][$idcptlign];
        $select['qte'] = $qtesession + $qty;
        $panier->modifierQTeArticle($select);
        $_SESSION['panier']['qlimit'][$idcptlign] -= 1;
        //}
        $nbArticles = count($_SESSION['panier']['id_article']);
    } elseif (isset($_GET['id_produit']) && isset($_GET['qte_produit']) && isset($_GET['repas_resto'])) {
        //Modifier quantité du produit sélectionné.   
        if (!isset($_SESSION)) {
            session_start();
        }
        include '../bdd/connexion.php';
        if ($_SESSION['stock'] == 1) {
            GetQteProdEnAttente($bdd);
        }
        $panier = new Panier();
        $select['id'] = $_GET['id_produit1'];
        $positionProduit = $select['id'];
        $qty = $_GET['qte_produit'];
        $idprod = $_GET['id_produit'];
        $repas = $_GET['repas_resto'];
        if ($repas == 1) {
            //include '../bdd/connexion.php';
            $bool = FALSE;
            if ($_SESSION['stock'] == 1) {
                $requete = $bdd->prepare("SELECT * FROM  stk_produit WHERE idprod=:idprod");
                $requete->BindParam(':idprod', $idprod);
                $requete->execute();
                $prod = $requete->fetch(PDO::FETCH_OBJ);
                if ($prod->vendrerupturestk == 1) {
                    $produits_plat = listeProduitIngredient($idprod, $_SESSION['id_hotel'], $bdd);
                    foreach ($produits_plat as $p) {
                        $idpr = $p->produit_id;
                        $quantite = $qty * $p->quantite;
                        $qte_attente = QteAttenteProd($idpr);
                        $quantite_reste = GetQteDispoByProd($bdd, $idpr, $_SESSION['depot_id']);
                        $quantite_reste -= $qte_attente;
                        if ($quantite > $quantite_reste) {
                            $bool = TRUE;
                            break;
                        }
                    }
                }
            }
            if (!$bool) {
                $select['qte'] = $qty;
                $panier->modifierQTeArticle($select);
                $_SESSION['panier']['qlimit'][$positionProduit] = $select['qte'];
            } else {
                echo '<div class="alert alert-danger text-center" id="alert_qte"><i class="fa fa-warning fa-fw"></i> Pas moyen de vendre ce plat à cause des ingredients insuffisants!</div>';
                $select['qte'] = 1;
                $panier->modifierQTeArticle($select);
                $_SESSION['panier']['qlimit'][$positionProduit] = 0;
            }
            $nbArticles = count($_SESSION['panier']['id_article']);
        } elseif ($repas == 3) {
            //include '../bdd/connexion.php';
            $bool = FALSE;
            if ($_SESSION['stock'] == 1) {
                $produits_plat = listeProduitIngredient($idprod, $_SESSION['id_hotel'], $bdd);
                foreach ($produits_plat as $p) {
                    $idpr = $p->produit_id;
                    $quantite = $qty * $p->quantite;
                    $qte_attente = QteAttenteProd($idpr);
                    $quantite_reste = GetQteDispoByProd($bdd, $idpr, $_SESSION['depot_id']);
                    $quantite_reste -= $qte_attente;
                    if ($quantite > $quantite_reste) {
                        $bool = TRUE;
                        break;
                    }
                }
            }
            if (!$bool) {
                $select['qte'] = $qty;
                $panier->modifierQTeArticle($select);
                $_SESSION['panier']['qlimit'][$positionProduit] = $select['qte'];
            } else {
                if ($repas == 3) {
                    echo '<div class="alert alert-danger text-center" id="alert_qte"><i class="fa fa-warning fa-fw"></i> Pas moyen de vendre ce produit à cause des quantités insuffisantes!</div>';
                } else {
                    echo '<div class="alert alert-danger text-center" id="alert_qte"><i class="fa fa-warning fa-fw"></i>Les entrées de ce plat ne suffiront pas pour préparer une telle quantité</div>';
                }
                $select['qte'] = 1;
                $panier->modifierQTeArticle($select);
                $_SESSION['panier']['qlimit'][$positionProduit] = 0;
            }
            $nbArticles = count($_SESSION['panier']['id_article']);
        } else {
            // Récuperation du Qté
            //$qty=$_GET['qte_produit'];
            $idpr = $idprod;
            if ($_SESSION['stock'] == 1) {
                $qte_attente = QteAttenteProd($idpr);
                $qte = GetQteDispoByProd($bdd, $idpr, $_SESSION['depot_id']);
                $qte -= $qte_attente;
            } else {
                $qte = 0;
            }
            //Fin  Récuperation du Qté
            if ($qty > $qte && $_SESSION['stock'] == 1) {
                echo '<div class="alert alert-danger text-center" id="alert_qte"><i class="fa fa-warning fa-fw"></i> La Quantité saisie doit être inférieure ou égale à ' . $qte . '</div>';
                $select['qte'] = 1;
                $panier->modifierQTeArticle($select);
                $_SESSION['panier']['qlimit'][$positionProduit] = 0;
            } else {
                $select['qte'] = $qty;
                $panier->modifierQTeArticle($select);
                $_SESSION['panier']['qlimit'][$positionProduit] = $select['qte'];
            }

            $nbArticles = count($_SESSION['panier']['id_article']);
        }
    } elseif (isset($_GET['id_produit']) && isset($_GET['supprimer'])) {
        //Suppridu produit sélectionné.
        if (!isset($_SESSION)) {
            session_start();
        }
        $supprimer = $_GET['supprimer'];
        if ($supprimer == 'OK') {
            $idprod = $_GET['id_produit'];
            $select['id'] = $idprod;
            $panier = new Panier();
            $panier->supprimer_article($select);
            $nbArticles = count($_SESSION['panier']['id_article']);
        }
    } elseif (isset($_GET['remise_val']) && isset($_GET['remise'])) {
        //Remise sur une commande.
        if (!isset($_SESSION)) {
            session_start();
        }
        $remise = $_GET['remise'];
        if ($remise == 'OK') {
            $select['remise'] = $_GET['remise_val'];
            $panier = new Panier();
            if ($_SESSION['panier']['mont_ttc_remise'] > $select['remise']) {
                $panier->remise($select);
            }
            $nbArticles = count($_SESSION['panier']['id_article']);
        }
    } elseif (isset($_GET['offert'])) {
        //OFFERT
        if (!isset($_SESSION)) {
            session_start();
        }
        $panier = new Panier();
        if (isset($_GET['id_produit2']) && isset($_GET['id_produit'])) {
            $idprod2 = $_GET['id_produit2'];
            $idprod = $_GET['id_produit'];
            // echo  $idprod;
            $positionProduit = array_search($idprod, $_SESSION['panier']['cpt']);
            $idprod = $positionProduit;
            if ($idprod2 != '') {
                $qteofferte = $_GET['qteofferte'];
                $qte_produit = $_SESSION['panier']['qte'][$positionProduit];
                $select['id'] = $idprod;
                $select['qteprod'] = $qte_produit - $qteofferte;
                if ($select['qteprod'] == 0) {
                    $_SESSION['panier']['offre'][$idprod] = 1;
                    $_SESSION['panier']['prix'][$idprod] = 0;
                }
                if ($select['qteprod'] >= 1) {
                    array_push($_SESSION['panier']['cpt'], $_SESSION['cptpanier']);
                    array_push($_SESSION['panier']['id_article'], $idprod2);
                    array_push($_SESSION['panier']['nom'], $_SESSION['panier']['nom'][$idprod]);
                    array_push($_SESSION['panier']['qte'], $qteofferte);
                    array_push($_SESSION['panier']['qteoffert'], $qteofferte);
                    array_push($_SESSION['panier']['pa'], $_SESSION['panier']['pa'][$idprod]);
                    array_push($_SESSION['panier']['prix'], 0);
                    array_push($_SESSION['panier']['prix2'], $_SESSION['panier']['prix2'][$idprod]);
                    array_push($_SESSION['panier']['repas'], $_SESSION['panier']['repas'][$idprod]);
                    array_push($_SESSION['panier']['offre'], 1);
                    array_push($_SESSION['panier']['description'], $_SESSION['panier']['description'][$idprod]);
                    array_push($_SESSION['panier']['qi'], $_SESSION['panier']['qi'][$idprod]);
                    array_push($_SESSION['panier']['qlimit'], $_SESSION['panier']['qlimit'][$idprod]);
                    array_push($_SESSION['panier']['genre'], 1);
                    $_SESSION['cptpanier'] += 1;
                    $panier->modifierPriceArticle($select);
                }
            }
        }

        $nbArticles = count($_SESSION['panier']['id_article']);
    } elseif (isset($_GET['price'])) {
        $panier = new Panier();
        $idprod2 = $_GET['id_produit2'];
        $idprod = $_GET['id_produit'];
        $prix = $_GET['prix'];
        $_SESSION['panier']['prix'][$idprod] = $prix;
        $nbArticles = count($_SESSION['panier']['id_article']);
    } elseif ($_GET['action'] == 'initialiser') {
        $typecl1 = 'table';
        $remise_client = 0;

        if (isset($_GET['typecl'])) {
            include '../bdd/connexion.php';
            $typecl1 = $_GET['typecl'];
            $client_id = $_GET['client_id'];
            if ($typecl1 == 'client') {
                $requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_client=:id_client");
                $requete->BindParam(':id_client', $client_id);
                $requete->execute();
                $client_occasionnel = $requete->fetchAll(PDO::FETCH_OBJ);
                foreach ($client_occasionnel as $cl) {
                    $remise_client = $cl->remise;
                }
            }
        }

        $panier = new Panier();
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
        $_SESSION['panier']['id_client'] = 0;
        $_SESSION['panier']['remise'] = $remise_client;
        $_SESSION['panier']['mont_tva'] = 0;
        $_SESSION['panier']['mont_ttc'] = 0;
        $_SESSION['panier']['mont_ttc_remise'] = 0;
        $_SESSION['panier']['verrouille'] = false;
        $_SESSION['cptpanier'] = 0;
        $_SESSION['panier']['genre'] = array();
        $_SESSION['panier']['qi'] = array();
        $_SESSION['panier']['qlimit'] = array();
        $_SESSION['note_cmd'] = "";
 
        // ReinitialiserPanier();

        $nbArticles = 0;
    } elseif ($_GET['action'] == 'detcompplat') {
        if (!isset($_SESSION)) {
            session_start();
        }
        $panier = new Panier();
        $accomp_nom = '';
        $idprod = $_GET['idprod'];
        $accomp_id = 0;
        $cuisson_id = $_GET['cuisson_id'];
        $cuisson_nom = $_GET['cuisson_nom'];
        $sauce_id = $_GET['sauce_id'];
        $sauce_nom = $_GET['sauce_nom'];
        $sel_id = $_GET['sel_id'];
        $sel_nom = $_GET['sel_nom'];
        $cpt = $_GET['cpt'];
        $id_cmd = $_GET['id_cmd'];

        $select['cptpanier'] = $_SESSION['cptpanier'];
        $select['id'] = $idprod;
        $select['nom'] = $_GET['nameprod'];
        $select['qte'] = 1;
        $select['qteoffert'] = 1;
        $prix = $_GET['prixprod'];
        $select['prix'] = $prix;
        $select['repas'] = 1;
        $select['pa'] = $_GET['pa'];
        $bc = $cpt;

        //Accompagnements
        if (isset($_POST['chx_accomp'])) {
            $accompagnements = $_POST['chx_accomp'];
            $nbre_accomp = count($accompagnements);
            for ($i = 0; $i <= $nbre_accomp - 1; $i++) {

                $acp_id = 'accomp' . $_POST['chx_accomp'][$i];
                $acp_qte_name_input = $acp_id . 'qte';
                $accomp_qte = $_POST[$acp_qte_name_input];
                if ($i == $nbre_accomp - 1) {
                    $accomp_nom .= $_POST[$acp_id] . '(' . $accomp_qte . ')';
                } else {
                    $accomp_nom .= $_POST[$acp_id] . '(' . $accomp_qte . ')' . ', ';
                }
            }
        }

        if ($cuisson_nom != 'undefined') {
            $accomp_nom .= ', ' . $cuisson_nom;
        }
        if ($sauce_nom != 'undefined') {
            $accomp_nom .= ', ' . $sauce_nom;
        }
        if ($sel_nom != 'undefined') {
            $accomp_nom .= ', ' . $sel_nom;
        }

        $select['description'] = $accomp_nom;
        $panier->ajouter2($select);
        $_SESSION['cptpanier'] = $_SESSION['cptpanier'] + 1;

        //Soft offre
        if (isset($_POST['chx_soft'])) {
            include '../bdd/connexion.php';
            $chx_soft = $_POST['chx_soft'];
            $nbre_soft = count($chx_soft);

            for ($i = 0; $i <= $nbre_soft - 1; $i++) {
                $soft_id = $chx_soft[$i];
                $acp_id = 'soft' . $soft_id;
                $qte_soft = 'softqte' . $soft_id;
                $soft_name = $_POST[$acp_id];
                $soft_qte = $_POST[$qte_soft];

                $select['cptpanier'] = $_SESSION['cptpanier'];
                $select['id'] = $soft_id;
                $select['nom'] = $soft_name;
                $select['qte'] = $soft_qte;
                $select['qteoffert'] = $soft_qte;
                $prix = 0;
                $select['prix'] = $prix;
                $select['repas'] = 0;
                $select['pa'] = 0;
                $select['description'] = '';
                $qty = $soft_qte;
                $idpr = $soft_id;

                //Verification Stock

                $quantite = $qty;
                $quantite_reste = 0;
                if ($_SESSION['stock'] == 1) {
                    $qte_attente = QteAttenteProd($idpr);
                    $quantite_reste = GetQteDispoByProd($bdd, $idpr, $_SESSION['depot_id']);
                    $quantite_reste -= $qte_attente;

                    if ($quantite <= $quantite_reste) {
                        $panier->ajouter2($select);
                        $_SESSION['cptpanier'] = $_SESSION['cptpanier'] + 1;
                    } else {
                        echo '<div class="alert alert-danger text-center msg_alert1">' . "La quantite de " . $soft_name . ' ne peut pas depasser ' . $quantite_reste . '</div>';
                    }
                } else {
                    $panier->ajouter2($select);
                    $_SESSION['cptpanier'] = $_SESSION['cptpanier'] + 1;
                }
            }
        }

        //Offre legumes
        if (isset($_POST['chx_legume'])) {
            //include '../bdd/connexion.php';
            $chx_soft = $_POST['chx_legume'];
            $nbre_soft = count($chx_soft);

            for ($i = 0; $i <= $nbre_soft - 1; $i++) {
                $soft_id = $chx_soft[$i];
                $acp_id = 'leg' . $_POST['chx_legume'][$i];
                $soft_name = $_POST[$acp_id];

                $select['cptpanier'] = $_SESSION['cptpanier'];
                $select['id'] = $soft_id;
                $select['nom'] = $soft_name;
                $select['qte'] = 1;
                $select['qteoffert'] = 1;
                $prix = 0;
                $select['prix'] = $prix;
                $select['repas'] = 1;
                $select['pa'] = 0;
                $select['description'] = '';
                $qty = 1;
                $idpr = $soft_id;

                $panier->ajouter2($select);

                $_SESSION['cptpanier'] = $_SESSION['cptpanier'] + 1;
            }
        }
        $nbArticles = count($_SESSION['panier']['id_article']);
    } elseif ($_GET['action'] == 'accboissonaction') {
        //accompagnement boisson
        $panier = new Panier();
        include '../bdd/connexion.php';
        include './accompgnmt_boisson.php';
        $nbArticles = count($_SESSION['panier']['id_article']);
    }
    // Récuperation du TVA
    if ($nbArticles != -1) {
        $total1 = $panier->montant_panier();
        $total = total($total1, $tva, $_SESSION['panier']['remise']);
        $mont_tva = tva($total, $tva, $_SESSION['panier']['remise']);
        $mont_rmz = remise($total1, $tva, $_SESSION['panier']['remise']);
        $mont_ht = ht($total, $tva, $_SESSION['panier']['remise']);
        $ttc22 =  ttc($mont_ht, $mont_tva, $mont_rmz);
        //NET A PAYER
        $ttc = $ttc22 - $mont_rmz;
        $_SESSION['panier']['mont_tva'] = $mont_tva;
        $_SESSION['panier']['mont_ttc'] = $mont_ht - $mont_rmz;
        $_SESSION['panier']['mont_remise'] = $mont_rmz;
        $_SESSION['panier']['mont_ht'] = $mont_ht;
        $_SESSION['panier']['mont_ttc_remise'] = $ttc;

    ?>
        <table class="table table-hover" id="tab_commandes">
            <thead>
                <th></th>
                <th><a href='#'></a></th>
                <th class='mailbox-attachment'>QTE</th>
                <th class='mailbox-subject'> DESIGNATION</th>
                <th class='mailbox-attachment'></th>
                <th class='mailbox-date text-right'>PRIX</th>
            </thead>
            <tbody>
                <?php
                $monnaie_local = getsymbole_local();
                $mont_tva = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier']['mont_tva']);
                $total_fact = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier']['mont_ht']);
                $mont_remise = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier']['mont_remise']);
                $ttc = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier']['mont_ttc_remise']);
                $des_plt = '';
                $kt = 0;
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                    $des_plt = $_SESSION['panier']['description'][$i];
                    $tarif = $_SESSION['panier']['prix'][$i] * $_SESSION['panier']['qte'][$i];
                    $tarif = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $tarif);
                    $plat_idc = $_SESSION['panier']['id_article'][$i];
                    $cpt_pan = $_SESSION['panier']['cpt'][$i];


                ?>
                    <tr class="clcprod" idp="<?php echo 'xx' . $_SESSION['panier']['cpt'][$i] ?>" idcpt="<?php echo $_SESSION['panier']['cpt'][$i] ?>" idart='<?php echo $_SESSION['panier']['id_article'][$i] ?>'>
                        <td>
                            <?php if (isset($_GET['action']) && ($_GET['action'] == 'plus' || $_GET['action'] == 'moins') && $_GET['id_produit'] == $_SESSION['panier']['id_article'][$i]) { ?>
                                <input name="affichage_produit" type='radio' class="affichage_produit <?php echo 'xx' . $_SESSION['panier']['cpt'][$i] ?>" repas="<?php echo $_SESSION['panier']['repas'][$i] ?>" id="<?php echo $_SESSION['panier']['cpt'][$i] ?>" idp="<?php echo $_SESSION['panier']['id_article'][$i] ?>" value="<?php echo $_SESSION['panier']['id_article'][$i] ?>" checked="checked" pn="<?php echo $_SESSION['panier']['nom'][$i] ?>" pd="<?php echo $_SESSION['panier']['description'][$i] ?>" pq="<?php echo $_SESSION['panier']['qte'][$i] ?>" pt="<?php echo $tarif ?>">
                            <?php } else { ?>
                                <input name="affichage_produit" type='radio' class="affichage_produit <?php echo 'xx' . $_SESSION['panier']['cpt'][$i] ?>" repas="<?php echo $_SESSION['panier']['repas'][$i] ?>" id="<?php echo $_SESSION['panier']['cpt'][$i] ?>" idp="<?php echo $_SESSION['panier']['id_article'][$i] ?>" value="<?php echo $_SESSION['panier']['id_article'][$i] ?>" pn="<?php echo $_SESSION['panier']['nom'][$i] ?>" pd="<?php echo $_SESSION['panier']['description'][$i] ?>" pq="<?php echo $_SESSION['panier']['qte'][$i] ?>" pt="<?php echo $tarif ?>">

                            <?php } ?>
                        </td>
                        <td><a href='#'></a></td>
                        <td class='mailbox-attachment' id="<?php echo $_SESSION['panier']['id_article'][$i] ?>">
                            <?php echo $_SESSION['panier']['qte'][$i] ?></td>
                        <td class='mailbox-subject' id="<?php echo 'libelle_repas' . $_SESSION['panier']['id_article'][$i] ?>">
                            <?php
                            echo $_SESSION['panier']['nom'][$i] . '</br>' . $des_plt;
                            ?>
                        </td>
                        <td class='mailbox-attachment'></td>
                        <td class='mailbox-date text-right'><?php echo afficheMontant2($m_affiche, $tarif) ?></td>
                    </tr>
                <?php };
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class='mailbox-attachment' colspan="5">Montant HT</th>
                    <th class="text-right">
                        <i>
                            <?php
                            echo afficheMontant2($m_affiche, $total_fact);
                            ?>
                        </i>

                    </th>
                </tr>
                <tr>
                    <th class='mailbox-attachment' colspan="5">TVA(<?php echo $tva . ' %'; ?>)</th>
                    <th class="text-right">
                        <i>
                            <?php
                            echo afficheMontant2($m_affiche, $mont_tva);
                            ?>
                        </i>

                    </th>
                </tr>
                <tr>
                    <th class='mailbox-attachment' colspan="5">Montant TTC</th>
                    <th class="text-right">
                        <i>
                            <?php
                            echo afficheMontant2($m_affiche, montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar, $ttc22));
                            if ($m_affiche != getsymbole_devise()) {
                                $m_symbole_monnaie = getsymbole_devise();
                            } else {
                                $m_symbole_monnaie = getsymbole_local();
                            }
                            $mont_tot_panier_local = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier']['mont_ttc_remise']);
                            $mont_tot_panier_devise = montant_equivalent_bdd($m_affiche, $m_symbole_monnaie, $taux_op, $mont_tot_panier_local);
                            $mont_tot_panier_devise_af = afficheMontant2($m_symbole_monnaie, $mont_tot_panier_devise);
                            ?>
                        </i>
                    </th>
                </tr>
                <?php
                if ($mont_remise > 0) {
                ?>
                    <tr>
                        <th class='mailbox-attachment' colspan="5">Remise(<?php echo round($_SESSION['panier']['remise'], 2) . ' %'; ?>)
                        </th>
                        <th class="text-right">
                            <i>
                                <?php
                                echo afficheMontant2($m_affiche, $mont_remise);
                                ?>
                            </i>
                        </th>
                    </tr>
                    <tr>
                        <th class='mailbox-attachment' colspan="5">NET A PAYER
                        </th>
                        <th class="text-right">
                            <i>
                                <?php
                                echo afficheMontant2($m_affiche, $ttc);
                                ?>
                            </i>
                        </th>
                    </tr>
                <?php
                   
            
            } ?>

            </tfoot>
        </table>
        <div class="form-group shadow-textarea" style="text-align: center;">
            <label for="note_cmd">NOTE :</label>
            <textarea class="form-control z-depth-1" id="note_cmd" name="note_cmd" rows="3" placeholder="Saisissez quelque chose ici..."></textarea>
        </div>
        <input type="hidden" name="mont_tot_panier_devise" id="mont_tot_panier_devise" value="<?php echo $mont_tot_panier_devise ?> ">
        <input type="hidden" name="mont_tot_panier_devise_af" id="mont_tot_panier_devise_af" value="<?php echo $mont_tot_panier_devise_af ?> ">
        <input type="hidden" name="mont_tot_panier" id="mont_tot_panier" value="<?php echo $ttc ?> ">
        <input type="hidden" name="mont_tot_panier_af" id="mont_tot_panier_af" value="<?php echo afficheMontant2($m_affiche, $ttc) ?> ">
        <input type="hidden" name="accpgmt" id="accpgmt" value="<?php echo $accpgmt ?> ">
        <input type="hidden" name="plat_cpt_id" id="plat_cpt_id" value="<?php echo $_SESSION['cptpanier'] - 1 ?> ">
        <!-- bool_addition A verifier -->
        <input type="hidden" name="bool_addition" id="bool_addition" value="0">

    <?php } ?>
    <div class="modal fade" id="myModalCHXACC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                    <h4 class="modal-title text-center titre_mod_details_plat" id="myModalLabel"><b>Accompagnement</b>
                    </h4>
                    <input type="hidden" id="lib_repas" name="lib_repas" value="">
                    <input type="hidden" id="pa_repas" name="pa_repas" value="">
                    <input type="hidden" id="pv_repas" name="pv_repas" value="">
                    <input type="hidden" id="idrepas" name="idrepas" value="">
                    <input type="hidden" name="plat_cpt_id2" id="plat_cpt_id2" value="">
                    <div class="alert alert-danger alert-dismissible fade in hidden" role="alert" id="div_message">
                        <span id="message"></span>
                    </div>
                </div>
                <div class="modal-body overflow-auto" id="datasaccompagn" style="overflow-y:auto;max-height:300px;">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_modal btn-lg" data-dismiss="modal">ANNULER</button>
                    <button type="button" class="btn btn-primary btn-lg" id="btn_md_add_accomp">VALIDER</button>

                    <span class="btn btn-info hidden" id="loader" style="display: block; margin: 0 auto;">
                        <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                    </span>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#affiche_commandes").on('click', '.affichage_produit', function() {
                var idprod, idprod2, affichage, repas;
                if ($(this).is(":checked")) {
                    idprod = $(this).attr('id');
                    idprod2 = $(this).attr('idp');
                    repas = $(this).attr('repas');
                    $("#qte_produit").attr('disabled', false);
                    $("#btn_qte_produit").attr('disabled', false);
                    $('#id_produit').val(idprod);
                    $('#id_produit2').val(idprod2);
                    $("#btn_sup_produit").attr('disabled', false);
                    $('#repas_resto').val(repas);
                    $('#btn_offert').attr('disabled', false);
                    $('#btn_update_price').attr('disabled', false);
                } else {
                    $('#id_produit').val(' ');
                    $('#qte_produit').val(' ');
                    $("#qte_produit").attr('disabled', true);
                    $("#btn_qte_produit").attr('disabled', true);
                    $("#btn_sup_produit").attr('disabled', true);
                    $('#btn_offert').attr('disabled', true);
                    //$("#div_qte_produit").hide();
                    //$("#div_remise").show();
                    $('#btn_update_price').attr('disabled', true);
                }
            });

            $("#affiche_commandes").on('click', '.clcprod', function() {
                var idart = $(this).attr('idart');
                var idcpt = $(this).attr('idcpt');
                var prod_tr = $(this).attr('idp');
                var select_tr = '.' + prod_tr;
                //var idprod = $('input[name="affichage_produit"]:checked').attr('id');
                //var idprod2 = $('input[name="affichage_produit"]:checked').attr('idp');
                var repas = $('input[name="affichage_produit"]:checked').attr('repas');
                // alert(idcpt);
                // alert(idart);
                $("#qte_produit").attr('disabled', false);
                $("#btn_qte_produit").attr('disabled', false);
                $('#id_produit').val(idcpt);
                $('#id_produit2').val(idart);
                $("#btn_sup_produit").attr('disabled', false);
                $('#repas_resto').val(repas);
                $('#btn_offert').attr('disabled', false);
                $('#btn_update_price').attr('disabled', false);
                $(select_tr).prop("checked", true);
                return false;
            });

            $('#btn_md_add_accomp').click(function(e) {
                e.preventDefault();
                var nameprod = $('#lib_repas').val();
                var pa = $('#pa_repas').val();
                var prixprod = $('#pv_repas').val();
                var cpt = $('#plat_cpt_id2').val();
                var accomp_id = $('input[type=radio][name=chx_accomp]:checked').attr('value');
                var accomp_nom = $('input[type=radio][name=chx_accomp]:checked').attr('nom');
                var cuisson_id = $('input[type=radio][name=chx_cuisson]:checked').attr('value');
                var cuisson_nom = $('input[type=radio][name=chx_cuisson]:checked').attr('nom');
                var sauce_id = $('input[type=radio][name=chx_sauce]:checked').attr('value');
                var sauce_nom = $('input[type=radio][name=chx_sauce]:checked').attr('nom');
                var sel_id = $('input[type=radio][name=chx_cond]:checked').attr('value');
                var sel_nom = $('input[type=radio][name=chx_cond]:checked').attr('nom');
                var idprod = $('#idrepas').val();
                var id_cmd = $("#id_cmd").val();
                var donnees = $(".accomp_frm").serialize();

                $.ajax({
                    url: 'Traitement/tableau_affichage_commandes.php?action=detcompplat' +
                        "&accomp_id=" + accomp_id + "&accomp_nom=" + accomp_nom + "&cuisson_id=" +
                        cuisson_id + "&cuisson_nom=" + cuisson_nom + "&sauce_id=" + sauce_id +
                        "&sauce_nom=" + sauce_nom + "&idprod=" + idprod + "&sel_id=" + sel_id +
                        "&sel_nom=" + sel_nom + "&nameprod=" + nameprod + "&pa=" + pa +
                        "&prixprod=" + prixprod + "&cpt=" + cpt + "&id_cmd=" + id_cmd,
                    type: 'POST',
                    data: donnees,
                    success: function(data) {

                        $('#affiche_commandes').html(data);
                        $("#myModalCHXACC").modal('hide');

                    }
                    //, dataType: 'json'
                });
            });

            $("#datasaccompagn").on('click', '.platdet', function() {
                var prod_tr = $(this).attr('idp');
                var select_tr = '.' + prod_tr;
                if ($(select_tr).is(":checked")) {
                    $(select_tr).prop("checked", false);
                    var qte = '#inp' + prod_tr;
                    $(qte).val(1);
                } else {
                    $(select_tr).prop("checked", true);

                }

                return false;
            });
            $("#datasaccompagn").on('click', '.qteboisson', function() {
                var prod_tr = $(this).attr('idp');
                var select_tr = '.' + prod_tr;
                if ($(select_tr).is(":checked")) {

                } else {
                    $(select_tr).prop("checked", true);
                }

                return false;
            });
        });
    </script>

</body>

</html>