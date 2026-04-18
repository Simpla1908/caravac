<?php

class Panier
{

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
            $_SESSION['panier']['cpt'] = array();
            $_SESSION['panier']['id_article'] = array();
            $_SESSION['panier']['nom'] = array();
            $_SESSION['panier']['qte'] = array();
            $_SESSION['panier']['qteoffert'] = array();
            $_SESSION['panier']['pa'] = array();
            $_SESSION['panier']['prix'] = array();
            $_SESSION['panier']['prix2'] = array();
            $_SESSION['panier']['repas'] = array();
            $_SESSION['panier']['fact_id'] = array();
            $_SESSION['panier']['offre'] = array();
            $_SESSION['panier']['genre'] = array();
            $_SESSION['panier']['description'] = array();
            $_SESSION['panier']['id_client'] = 0;
            $_SESSION['panier']['remise'] = 0;
            $_SESSION['panier']['mont_tva'] = 0;
            $_SESSION['panier']['mont_ttc'] = 0;
            $_SESSION['panier']['mont_ttc_remise'] = 0;
            $_SESSION['panier']['verrouille'] = false;
            $_SESSION['panier']['qi'] = array();
            $_SESSION['panier']['qlimit'] = array();
        }
    }
    public function initialiser()
    {
        $_SESSION['panier'] = array();
        $_SESSION['panier']['cpt'] = array();
        $_SESSION['panier']['id_article'] = array();
        $_SESSION['panier']['nom'] = array();
        $_SESSION['panier']['qte'] = array();
        $_SESSION['panier']['qteoffert'] = array();
        $_SESSION['panier']['pa'] = array();
        $_SESSION['panier']['prix'] = array();
        $_SESSION['panier']['prix2'] = array();
        $_SESSION['panier']['repas'] = array();
        $_SESSION['panier']['offre'] = array();
        $_SESSION['panier']['genre'] = array();
        $_SESSION['panier']['description'] = array();
        $_SESSION['panier']['fact_id'] = array();
        $_SESSION['panier']['id_client'] = 0;
        $_SESSION['panier']['remise'] = 0;
        $_SESSION['panier']['mont_tva'] = 0;
        $_SESSION['panier']['mont_ttc'] = 0;
        $_SESSION['panier']['mont_ttc_remise'] = 0;
        $_SESSION['panier']['verrouille'] = false;
        $_SESSION['panier']['qi'] = array();
        $_SESSION['panier']['qlimit'] = array();
    }
    public function ajouter($select)
    {
        $positionProduit = array_search($select['id'], $_SESSION['panier']['id_article']);
        $offre = 0;
        $select['qteoffert'] = 0;
        $select['pa'] = 0;
        $qte_attente = 0;
        $qte = 0;
        $qteMout = 0;
        $id_prod_lier_mesurette = 0;
        $qlimit = 0;
        if ($positionProduit !== false) {
            include '../bdd/connexion.php';
            $price = $_SESSION['panier']['prix'][$positionProduit];
            if ($price == 0) {
                if ($select['repas'] == 3) {
                    $qte_increase = 1;
                    $prod_lier_mesurette = getProdLierMesurette($select['id'], $bdd);
                    if (isset($prod_lier_mesurette->produit_id)) {
                        $id_prod_lier_mesurette = $prod_lier_mesurette->produit_id;
                        $qteMout = $prod_lier_mesurette->quantite;
                        $qlimit = $qteMout;
                    }

                    $qte_attente = QteAttenteProd($id_prod_lier_mesurette);
                    $qte = GetQteDispoByProd($bdd, $id_prod_lier_mesurette, $_SESSION['depot_id']);
                    $qte -= $qte_attente;
                    $qte -= $qteMout;
                    if ($qte >= $qteMout) {
                        array_push($_SESSION['panier']['cpt'], $select['cptpanier']);
                        array_push($_SESSION['panier']['id_article'], $select['id']);
                        array_push($_SESSION['panier']['nom'], $select['nom']);
                        array_push($_SESSION['panier']['qte'], $select['qte']);
                        array_push($_SESSION['panier']['qteoffert'], $select['qteoffert']);
                        array_push($_SESSION['panier']['pa'], $select['pa']);
                        array_push($_SESSION['panier']['prix'], $select['prix']);
                        array_push($_SESSION['panier']['prix2'], $select['prix']);
                        array_push($_SESSION['panier']['repas'], $select['repas']);
                        array_push($_SESSION['panier']['offre'], $offre);
                        array_push($_SESSION['panier']['genre'], $offre);
                        array_push($_SESSION['panier']['description'], $select['description']);
                        array_push($_SESSION['panier']['qi'], 0);
                        array_push($_SESSION['panier']['qlimit'], $qteMout);
                        $_SESSION['cptpanier'] += 1;
                        $_SESSION['panier']['qte'][$positionProduit] = $qte_increase;
                        $_SESSION['panier']['qlimit'][$positionProduit] += $qteMout;
                    }
                } else {
                    array_push($_SESSION['panier']['cpt'], $select['cptpanier']);
                    array_push($_SESSION['panier']['id_article'], $select['id']);
                    array_push($_SESSION['panier']['nom'], $select['nom']);
                    array_push($_SESSION['panier']['qte'], $select['qte']);
                    array_push($_SESSION['panier']['qteoffert'], $select['qteoffert']);
                    array_push($_SESSION['panier']['pa'], $select['pa']);
                    array_push($_SESSION['panier']['prix'], $select['prix']);
                    array_push($_SESSION['panier']['prix2'], $select['prix']);
                    array_push($_SESSION['panier']['repas'], $select['repas']);
                    array_push($_SESSION['panier']['offre'], $offre);
                    array_push($_SESSION['panier']['genre'], $offre);
                    array_push($_SESSION['panier']['description'], $select['description']);
                    array_push($_SESSION['panier']['qi'], 0);
                    array_push($_SESSION['panier']['qlimit'], 0);
                    $_SESSION['cptpanier'] += 1;
                }
            } else {
                $qte_increase = $_SESSION['panier']['qte'][$positionProduit] + 1;
                $qi = $_SESSION['panier']['qi'][$positionProduit];


                if ($select['repas'] == 0 || $select['repas'] == 3) {
                    if ($_SESSION['stock'] == 1) {
                        if ($select['repas'] == 3) {
                            /* $prod_lier_mesurette= getProdLierMesurette($select['id'], $bdd);
                            $id_prod_lier_mesurette=$prod_lier_mesurette->produit_id;
                            $qteMout=$prod_lier_mesurette->quantite;
                            $qlimit= $_SESSION['panier']['qlimit'][$positionProduit]+$qteMout; */

                            $prod_lier_mesurette = getProdLierMesurette($select['id'], $bdd);
                            if (isset($prod_lier_mesurette->produit_id)) {
                                $id_prod_lier_mesurette = $prod_lier_mesurette->produit_id;
                                $qteMout = $prod_lier_mesurette->quantite;
                                $qlimit = $qteMout;
                            }

                            $qte_attente = QteAttenteProd($id_prod_lier_mesurette);
                            $qte = GetQteDispoByProd($bdd, $id_prod_lier_mesurette, $_SESSION['depot_id']);
                            $qte -= $qte_attente;
                            if ($qi == 0) {
                                $qte -= $qteMout;
                            }
                            if ($qlimit <= $qte) {
                                $_SESSION['panier']['qte'][$positionProduit] = $qte_increase;
                                $_SESSION['panier']['qlimit'][$positionProduit] += $qteMout;
                            }
                        } else {
                            $qlimit = $_SESSION['panier']['qlimit'][$positionProduit] + 1;
                            /* $qte_attente = QteAttenteProd($select['id']);
                            $qte = GetQteDispoByProd($bdd, $select['id'], $_SESSION['depot_id']);
                            $qte -= $qte_attente;
                            //Lorsque le produit est ajoute pour la 1ere fois
                            if ($qi == 0) {
                                $qte -= 1;
                            }
                            if ($qlimit <= $qte) { */
                            $_SESSION['panier']['qte'][$positionProduit] = $qte_increase;
                            $_SESSION['panier']['qlimit'][$positionProduit] += 1;
                            // }
                        }

                        /* elseif ($select['repas'] == 3) {
                            $_SESSION['panier']['qte'][$positionProduit] = $qte_increase;
                        } */
                    } else {
                        $_SESSION['panier']['qte'][$positionProduit] = $qte_increase;
                    }
                } elseif ($select['repas'] == 1) {
                    $requete = $bdd->prepare("SELECT * FROM  stk_produit WHERE idprod=:idprod");
                    $requete->BindParam(':idprod', $select['id']);
                    $requete->execute();
                    $prod = $requete->fetch(PDO::FETCH_OBJ);
                    if ($prod->pop == 0) {
                        $_SESSION['panier']['qte'][$positionProduit] = $qte_increase;
                    }
                }
            }
        } else {
            //Sinon on ajoute le produit
            if ($select['repas'] == 3) {
                include '../bdd/connexion.php';
                $qte_increase = 1;
                $qteMout = 0;
                $id_prod_lier_mesurette = 0;
                $prod_lier_mesurette = getProdLierMesurette($select['id'], $bdd);
                if (isset($prod_lier_mesurette->produit_id)) {
                    $id_prod_lier_mesurette = $prod_lier_mesurette->produit_id;
                    $qteMout = $prod_lier_mesurette->quantite;
                }

                $qlimit = $qteMout;
                $qte_attente = QteAttenteProd($id_prod_lier_mesurette);
                $qte = GetQteDispoByProd($bdd, $id_prod_lier_mesurette, $_SESSION['depot_id']);
                $qte -= $qte_attente;
                $qte -= $qteMout;
                if ($qte >= $qteMout) {
                    array_push($_SESSION['panier']['cpt'], $select['cptpanier']);
                    array_push($_SESSION['panier']['id_article'], $select['id']);
                    array_push($_SESSION['panier']['nom'], $select['nom']);
                    array_push($_SESSION['panier']['qte'], $select['qte']);
                    array_push($_SESSION['panier']['qteoffert'], $select['qteoffert']);
                    array_push($_SESSION['panier']['pa'], $select['pa']);
                    array_push($_SESSION['panier']['prix'], $select['prix']);
                    array_push($_SESSION['panier']['prix2'], $select['prix']);
                    array_push($_SESSION['panier']['repas'], $select['repas']);
                    array_push($_SESSION['panier']['offre'], $offre);
                    array_push($_SESSION['panier']['genre'], $offre);
                    array_push($_SESSION['panier']['description'], $select['description']);
                    array_push($_SESSION['panier']['qi'], 0);
                    array_push($_SESSION['panier']['qlimit'], $qteMout);
                    $_SESSION['cptpanier'] += 1;
                    $_SESSION['panier']['qte'][$positionProduit] = $qte_increase;
                    $_SESSION['panier']['qlimit'][$positionProduit] += $qteMout;
                }
                /*  else{
                    echo '<div class="alert alert-danger text-center msg_alert1">' . "Stock insuffisant " .'</div>';
                } */
            } else {
                array_push($_SESSION['panier']['cpt'], $select['cptpanier']);
                array_push($_SESSION['panier']['id_article'], $select['id']);
                array_push($_SESSION['panier']['nom'], $select['nom']);
                array_push($_SESSION['panier']['qte'], $select['qte']);
                array_push($_SESSION['panier']['qteoffert'], $select['qteoffert']);
                array_push($_SESSION['panier']['pa'], $select['pa']);
                array_push($_SESSION['panier']['prix'], $select['prix']);
                array_push($_SESSION['panier']['prix2'], $select['prix']);
                array_push($_SESSION['panier']['repas'], $select['repas']);
                array_push($_SESSION['panier']['offre'], $offre);
                array_push($_SESSION['panier']['genre'], $offre);
                array_push($_SESSION['panier']['description'], $select['description']);
                array_push($_SESSION['panier']['qi'], 0);
                array_push($_SESSION['panier']['qlimit'], 1);
                $_SESSION['cptpanier'] += 1;
            }
        }
    }
    public function modifierQTeArticle($select)
    {
        //Si le panier éxiste
        if ($select['qte'] > 0) {
            //Recharche du produit dans le panier
            $positionProduit = array_search($select['id'], $_SESSION['panier']['cpt']);
            if ($positionProduit !== false) {
                $_SESSION['panier']['qte'][$positionProduit] = $select['qte'];
            }
        }
    }

    public function verif_panier($select)
    {
        /* On initialise la variable de retour */
        $present = false;
        /* On vérifie les numéros de références des articles et on compare avec l'article à vérifier */
        if (count($_SESSION['panier']['id_article']) > 0 && array_search($select['id'], $_SESSION['panier']['id_article']) !== false) {
            $present = true;
        }
        return $present;
    }
    public function remise($select)
    {
        /* On initialise la variable de retour */
        $_SESSION['panier']['remise'] =  $select['remise'];
    }
    public function modif_qte($ref_article, $qte)
    {
        /* On initialise la variable de retour */
        $modifie = false;
        if (!isset($_SESSION['panier']['verrouille']) || $_SESSION['panier']['verrouille'] == false) {
            if ($this->nombre_article($ref_article) != false && $qte != $this->nombre_article($ref_article)) {
                /* On compte le nombre d'articles différents dans le panier */
                $nb_articles = count($_SESSION['panier']['id_article']);
                /* On parcoure le tableau de session pour modifier l'article précis. */
                for ($i = 0; $i < $nb_articles; $i++) {
                    if ($ref_article == $_SESSION['panier']['id_article'][$i]) {
                        $_SESSION['panier']['qte'][$i] += $qte;
                        $modifie = true;
                    }
                }
            } else {
                if ($this->nombre_article($ref_article) != false) {
                    $modifie = "absent";
                }
                if ($qte != $this->nombre_article($ref_article)) {
                    $modifie = "qte_ok";
                }
            }
        }
        return $modifie;
    }

    public function supprimer_article($select)
    {
        $suppression = false;
        if (!isset($_SESSION['panier']['verrouille']) || $_SESSION['panier']['verrouille'] == false) {
            /* On vérifie que l'article à supprimer est bien présent dans le panier */
            $positionProduit = array_search($select['id'], $_SESSION['panier']['cpt']);

            if ($positionProduit !== false) {
                /* création d'un tableau temporaire de stockage des articles */
                $panier_tmp = array(
                    "id_article" => array(), "nom" => array(), "qte" => array(),
                    "prix" => array(), "repas" => array(), "cpt" => array(), "qteoffert" => array(), "pa" => array(), "prix2" => array(),
                    "offre" => array(), "genre" => array(), "description" => array(),
                    "qi" => array(), "qlimit" => array()
                );
                /* Comptage des articles du panier */
                $nb_articles = count($_SESSION['panier']['id_article']);
                /* Transfert du panier dans le panier temporaire */
                for ($i = 0; $i < $nb_articles; $i++) {
                    /* On transfère tout sauf l'article à supprimer */
                    if ($_SESSION['panier']['cpt'][$i] != $select['id']) {
                        array_push($panier_tmp['id_article'], $_SESSION['panier']['id_article'][$i]);
                        array_push($panier_tmp['nom'], $_SESSION['panier']['nom'][$i]);
                        array_push($panier_tmp['qte'], $_SESSION['panier']['qte'][$i]);
                        array_push($panier_tmp['prix'], $_SESSION['panier']['prix'][$i]);
                        array_push($panier_tmp['repas'], $_SESSION['panier']['repas'][$i]);
                        array_push($panier_tmp['cpt'], $_SESSION['panier']['cpt'][$i]);
                        array_push($panier_tmp['qteoffert'], $_SESSION['panier']['qteoffert'][$i]);
                        array_push($panier_tmp['pa'], $_SESSION['panier']['pa'][$i]);
                        array_push($panier_tmp['prix2'], $_SESSION['panier']['prix2'][$i]);
                        array_push($panier_tmp['offre'], $_SESSION['panier']['offre'][$i]);
                        array_push($panier_tmp['genre'], $_SESSION['panier']['genre'][$i]);
                        array_push($panier_tmp['description'], $_SESSION['panier']['description'][$i]);
                        array_push($panier_tmp['qi'], $_SESSION['panier']['qi'][$i]);
                        array_push($panier_tmp['qlimit'], $_SESSION['panier']['qlimit'][$i]);
                    }
                }
                $panier_tmp['remise'] = $_SESSION['panier']['remise'];
                $panier_tmp['mont_tva'] = $_SESSION['panier']['mont_tva'];
                $panier_tmp['mont_ttc'] = $_SESSION['panier']['mont_ttc'];
                $panier_tmp['mont_ttc_remise'] = $_SESSION['panier']['mont_ttc_remise'];
                /* Le transfert est terminé, on ré-initialise le panier */
                $_SESSION['panier'] = $panier_tmp;
                /* Option : on peut maintenant supprimer notre panier temporaire: */
                unset($panier_tmp);
                $suppression = true;
            } else {
                $suppression == "absent";
            }
        }
        return $suppression;
    }

    public function vider_panier()
    {
        $_SESSION['panier'] = array();
        $_SESSION['panier']['cpt'] = array();
        $_SESSION['panier']['id_article'] = array();
        $_SESSION['panier']['nom'] = array();
        $_SESSION['panier']['qte'] = array();
        $_SESSION['panier']['qteoffert'] = array();
        $_SESSION['panier']['pa'] = array();
        $_SESSION['panier']['prix'] = array();
        $_SESSION['panier']['prix2'] = array();
        $_SESSION['panier']['repas'] = array();
        $_SESSION['panier']['offre'] = array();
        $_SESSION['panier']['genre'] = array();
        $_SESSION['panier']['description'] = array();
        $_SESSION['panier']['id_client'] = 0;
        $_SESSION['panier']['remise'] = 0;
        $_SESSION['panier']['mont_tva'] = 0;
        $_SESSION['panier']['mont_ttc'] = 0;
        $_SESSION['panier']['mont_ttc_remise'] = 0;
        $_SESSION['panier']['verrouille'] = false;
        $_SESSION['panier']['qi'] = array();
        $_SESSION['panier']['qlimit'] = array();
    }

    public function nombre_article($ref_article)
    {
        /* On initialise la variable de retour */
        $nombre = false;
        /* Comptage du panier */
        $nb_art = count($_SESSION['panier']['id_article']);
        /* On parcoure le panier à la recherche de l'article pour vérifier le cas échéant combien sont enregistrés */
        for ($i = 0; $i < $nb_art; $i++) {
            if ($_SESSION['panier']['id_article'][$i] == $ref_article)
                $nombre = $_SESSION['panier']['qte'][$i];
        }
        return $nombre;
    }

    /**
     * Calcule le montant total du panier 
     * 
     * @return Double 
     */
    function montant_panier()
    {
        /* On initialise le montant */
        $montant = 0;
        $nb_articles = count($_SESSION['panier']['id_article']);
        /* On va calculer le total par article */
        for ($i = 0; $i < $nb_articles; $i++) {
            $qte = intval($_SESSION['panier']['qte'][$i]);
            $prix = floatval($_SESSION['panier']['prix'][$i]);
            $tarif1 = $prix * $qte;
            $montant += $tarif1;
        }
        /* On retourne le résultat */
        return $montant;
    }

    /**
     * Fonction de verrouillage du panier pendant la phase de paiement. 
     * 
     */
    public function preparerPaiement()
    {
        $_SESSION['panier']['verrouille'] = true;
        header("Location: URL_DU_SITE_DE_BANQUE");
    }

    /**
     * Fonction qui va enregistrer les informations de la commande dans 
     * la base de données et détruire le panier. 
     * 
     */
    public function paiementAccepte()
    {
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        /*   Stockage du panier dans la BDD   */
        /* ajoutez ici votre code d'insertion */
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        unset($_SESSION['panier']);
    }
    public function modifierPriceArticle($select)
    {
        $positionProduit = array_search($select['id'], $_SESSION['panier']['cpt']);
        $id = $select['id'];
        if ($positionProduit !== false) {
            if ($select['qteprod'] == 0) {
                $_SESSION['panier']['prix'][$positionProduit] = 0;
            } elseif ($select['qteprod'] >= 1) {
                $_SESSION['panier']['qte'][$positionProduit] = $select['qteprod'];
            }
        }
    }

    public function getcpt($idprod1)
    {
        $nb_articles = count($_SESSION['panier']['id_article']);
        /* Transfert du panier dans le panier temporaire */
        for ($i = 0; $i < $nb_articles; $i++) {
            $idprod2 = $_SESSION['panier']['id_article'][$i];
            if ($idprod1 = $idprod2) {
                return $_SESSION['panier']['cpt'][$i];
            }
        }
    }

    public function ajouter2($select)
    {
        $positionProduit = array_search($select['id'], $_SESSION['panier']['id_article']);
        $offre = 0;
        //$select['qteoffert'] = 0;
        $select['pa'] = 0;
        /* if ($positionProduit!== false){
        }else{ */
        //Sinon on ajoute le produit

        array_push($_SESSION['panier']['cpt'], $select['cptpanier']);
        array_push($_SESSION['panier']['id_article'], $select['id']);
        array_push($_SESSION['panier']['nom'], $select['nom']);
        array_push($_SESSION['panier']['qte'], $select['qte']);
        array_push($_SESSION['panier']['qteoffert'], $select['qteoffert']);
        array_push($_SESSION['panier']['pa'], $select['pa']);
        array_push($_SESSION['panier']['prix'], $select['prix']);
        array_push($_SESSION['panier']['prix2'], $select['prix']);
        array_push($_SESSION['panier']['repas'], $select['repas']);
        array_push($_SESSION['panier']['offre'], $offre);
        array_push($_SESSION['panier']['genre'], $offre);
        array_push($_SESSION['panier']['description'], $select['description']);
        array_push($_SESSION['panier']['qi'], 0);
        array_push($_SESSION['panier']['qlimit'], 0);
        //}
    }
}
