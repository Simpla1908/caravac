<?php
class Panier
{
    public function initialiser()
    {
        $_SESSION['panier'] = array();
        $_SESSION['panier']['id_article'] = array();
        $_SESSION['panier']['nom'] = array();
        $_SESSION['panier']['qte'] = array();
        $_SESSION['panier']['prix'] = array();
        $_SESSION['panier']['unite'] = array();
        $_SESSION['panier']['monnaie'] = array();
        $_SESSION['panier']['repas'] = array();
        $_SESSION['panier']['monttva'] = array();
        $_SESSION['panier']['monttvasave'] = array();
        $_SESSION['panier']['montremise'] = array();
        $_SESSION['panier']['id_client'] = 0;
        $_SESSION['panier']['remise'] = 0;
        $_SESSION['panier']['mont_total'] = 0;
        $_SESSION['panier']['mont_tva'] = 0;
        $_SESSION['panier']['mont_remise'] = 0;
        $_SESSION['panier']['mont_ttc'] = 0;
        $_SESSION['panier']['mont_ttc_remise'] = 0;
        $_SESSION['panier']['verrouille'] = false;
    }
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['panier'])) {
            $this->initialiser();
        }
    }

    public function ajouter($select)
    {
        $positionProduit = array_search($select['id'], $_SESSION['panier']['id_article']);
        if ($positionProduit !== false) {
            $_SESSION['panier']['qte'][$positionProduit] = $_SESSION['panier']['qte'][$positionProduit] + $select['qte'];
        } else {
            //Sinon on ajoute le produit
            array_push($_SESSION['panier']['id_article'], $select['id']);
            array_push($_SESSION['panier']['nom'], $select['nom']);
            array_push($_SESSION['panier']['qte'], $select['qte']);
            array_push($_SESSION['panier']['prix'], $select['prix']);
            array_push($_SESSION['panier']['repas'], $select['repas']);
            array_push($_SESSION['panier']['monttva'], $select['monttva']);
            array_push($_SESSION['panier']['montremise'], $select['montremise']);
        }
    }
    public function ajouterFact($select)
    {
        $positionProduit = array_search($select['id'], $_SESSION['panier']['id_article']);
        if ($positionProduit !== false) {
            $_SESSION['panier']['qte'][$positionProduit] = $select['qte'];
        } else {
            //Sinon on ajoute le produit
            array_push($_SESSION['panier']['id_article'], $select['id']);
            array_push($_SESSION['panier']['nom'], $select['nom']);
            array_push($_SESSION['panier']['qte'], $select['qte']);
            array_push($_SESSION['panier']['prix'], $select['prix']);
            array_push($_SESSION['panier']['monttva'], $select['monttva']);
        }
    }

    public function modifierQTeArticle($select)
    {
        //Si le panier éxiste
        //Si la quantité est positive on modifie sinon on supprime l'article
        if ($select['qte'] > 0) {
            //Recharche du produit dans le panier
            $positionProduit = array_search($select['id'], $_SESSION['panier']['id_article']);
            if ($positionProduit !== false) {
                $_SESSION['panier']['qte'][$positionProduit] = $select['qte'];
            }
        }
    }
    public function modifierPrixArticle($select)
    {
        if ($select['prix'] > 0) {
            //Recharche du produit dans le panier
            $positionProduit = array_search($select['id'], $_SESSION['panier']['id_article']);
            if ($positionProduit !== false) {
                $_SESSION['panier']['prix'][$positionProduit] = $select['prix'];
            }
        }
    }
    public function modifierLibArticle($select)
    {
            //Recharche du produit dans le panier
            $positionProduit = array_search($select['id'], $_SESSION['panier']['id_article']);
            if ($positionProduit !== false) {
                $_SESSION['panier']['nom'][$positionProduit] = $select['nom'];
            }
    }
    public function modifierMontant($select)
    {
        //Recharche du produit dans le panier
        $positionProduit = array_search($select['id'], $_SESSION['panier']['id_article']);
        if ($positionProduit !== false) {
            $_SESSION['panier']['monttva'][$positionProduit] = $_SESSION['panier']['monttva'][$positionProduit] * $select['qte'];
            $_SESSION['panier']['montremise'][$positionProduit] = $_SESSION['panier']['montremise'][$positionProduit] * $select['qte'];
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
        $_SESSION['panier']['remise'] = $select['remise'];
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
                /* L'article est absent du panier, donc on ne peut pas modifier la quantité ou bien 
                 * le nombre est exactement le même et il est inutile de le modifier 
                 * Si l'article est absent, comme on a ni la taille  ni le prix, on ne peut pas l'ajouter 
                 * Si le nombre est le même, on ne fait pas de changement. On peut donc retourner un autre 
                 * type de valeur pour indiquer une erreur qu'il faudra traiter à part lors du retour d'appel 
                 */
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
            $positionProduit = array_search($select['id'], $_SESSION['panier']['id_article']);

            if ($positionProduit !== false) {
                /* création d'un tableau temporaire de stockage des articles */
                $panier_tmp = array(
                    "id_article" => array(), "nom" => array(),
                    "qte" => array(), "prix" => array(), "repas" => array(),
                    "monttva" => array(), "montremise" => array()
                );
                /* Comptage des articles du panier */
                $nb_articles = count($_SESSION['panier']['id_article']);
                /* Transfert du panier dans le panier temporaire */
                for ($i = 0; $i < $nb_articles; $i++) {
                    /* On transfère tout sauf l'article à supprimer */
                    if ($_SESSION['panier']['id_article'][$i] != $select['id']) {
                        array_push($panier_tmp['id_article'], $_SESSION['panier']['id_article'][$i]);
                        array_push($panier_tmp['nom'], $_SESSION['panier']['nom'][$i]);
                        array_push($panier_tmp['qte'], $_SESSION['panier']['qte'][$i]);
                        array_push($panier_tmp['prix'], $_SESSION['panier']['prix'][$i]);
                        array_push($panier_tmp['repas'], $_SESSION['panier']['repas'][$i]);
                        array_push($panier_tmp['monttva'], $_SESSION['panier']['monttva'][$i]);
                        array_push($panier_tmp['montremise'], $_SESSION['panier']['montremise'][$i]);
                    }
                }
                $panier_tmp['remise'] = $_SESSION['panier']['remise'];
                $panier_tmp['mont_total'] = $_SESSION['panier']['mont_total'];
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
    public function delete_articlestock($select)
    {
        $suppression = false;
        if (!isset($_SESSION['panier']['verrouille']) || $_SESSION['panier']['verrouille'] == false) {
            /* On vérifie que l'article à supprimer est bien présent dans le panier */
            $positionProduit = array_search($select['id'], $_SESSION['panier']['id_article']);
            if ($positionProduit !== false) {
                /* création d'un tableau temporaire de stockage des articles */
                $panier_tmp = array(
                    "id_article" => array(), "nom" => array(),
                    "qte" => array(), "unite" => array()
                );
                /* Comptage des articles du panier */
                $nb_articles = count($_SESSION['panier']['id_article']);
                /* Transfert du panier dans le panier temporaire */
                for ($i = 0; $i < $nb_articles; $i++) {
                    /* On transfère tout sauf l'article à supprimer */
                    if ($_SESSION['panier']['id_article'][$i] != $select['id']) {
                        array_push($panier_tmp['id_article'], $_SESSION['panier']['id_article'][$i]);
                        array_push($panier_tmp['nom'], $_SESSION['panier']['nom'][$i]);
                        array_push($panier_tmp['qte'], $_SESSION['panier']['qte'][$i]);
                        array_push($panier_tmp['unite'], $_SESSION['panier']['unite'][$i]);
                    }
                }
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
    public function delete_articleFact($select)
    {
        $suppression = false;
        if (!isset($_SESSION['panier']['verrouille']) || $_SESSION['panier']['verrouille'] == false) {
            /* On vérifie que l'article à supprimer est bien présent dans le panier */
            $positionProduit = array_search($select['id'], $_SESSION['panier']['id_article']);
            if ($positionProduit !== false) {
                /* création d'un tableau temporaire de stockage des articles */
                $panier_tmp = array(
                    "id_article" => array(), "nom" => array(),
                    "qte" => array(),
                    "prix" => array(), "monttva" => array()
                );
                /* Comptage des articles du panier */
                $nb_articles = count($_SESSION['panier']['id_article']);
                /* Transfert du panier dans le panier temporaire */
                for ($i = 0; $i < $nb_articles; $i++) {
                    /* On transfère tout sauf l'article à supprimer */
                    if ($_SESSION['panier']['id_article'][$i] != $select['id']) {
                        array_push($panier_tmp['id_article'], $_SESSION['panier']['id_article'][$i]);
                        array_push($panier_tmp['nom'], $_SESSION['panier']['nom'][$i]);
                        array_push($panier_tmp['qte'], $_SESSION['panier']['qte'][$i]);
                        array_push($panier_tmp['prix'], $_SESSION['panier']['prix'][$i]);
                        array_push($panier_tmp['monttva'], $_SESSION['panier']['monttva'][$i]);
                    }
                }
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
        $vide = false;
        if (!isset($_SESSION['panier']['verrouille']) || $_SESSION['panier']['verrouille'] == false) {
            if (isset($_SESSION['panier'])) {
                unset($_SESSION['panier']);
                if (!isset($_SESSION['panier'])) {
                    $vide = true;
                }
            } else {
                /* Le panier était déjà détruit, on renvoie une autre valeur exploitable au retour */
                $vide = "inexistant";
            }
        }
        return $vide;
    }

    public function annuler()
    {
        $this->initialiser();
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
        /* Comptage des articles du panier */
        $nb_articles = count($_SESSION['panier']['id_article']);
        /* On va calculer le total par article */
        for ($i = 0; $i < $nb_articles; $i++) {
            $montant += $_SESSION['panier']['qte'][$i] * $_SESSION['panier']['prix'][$i] + $_SESSION['panier']['qte'][$i] * $_SESSION['panier']['monttva'][$i];
        }
        /* On retourne le résultat */
        return $montant;
    }
    function montant_panier_tva()
    {
        /* On initialise le montant */
        $montant = 0;
        /* Comptage des articles du panier */
        $nb_articles = count($_SESSION['panier']['id_article']);
        /* On va calculer le total par article */
        for ($i = 0; $i < $nb_articles; $i++) {
            $montant += $_SESSION['panier']['qte'][$i] * $_SESSION['panier']['monttva'][$i];
        }
        /* On retourne le résultat */
        return $montant;
    }

    function total_montantprod_panier_tva()
    {
        /* On initialise le montant */
        $mont_prodtva = 0;
        /* Comptage des articles du panier */
        $nb_articles = count($_SESSION['panier']['id_article']);
        /* On va calculer le total par article */
        for ($i = 0; $i < $nb_articles; $i++) {
            if ($_SESSION['panier']['monttva'][$i] != 0) {
                $mont_prodtva += $_SESSION['panier']['qte'][$i] * $_SESSION['panier']['prix'][$i];
            }
        }
        /* On retourne le résultat */
        return $mont_prodtva;
    }

    function tot_fact_tva()
    {
        /* on calcule le montant total des factures avec tva */
        $montant = 0;
        /* Comptage des articles du panier */
        $nb_articles = count($_SESSION['panier']['id_article']);
        /* On va calculer le total par article */
        for ($i = 0; $i < $nb_articles; $i++) {
            $monttva = $_SESSION['panier']['monttva'][$i];
            $qte = $_SESSION['panier']['qte'][$i];
            if ($monttva > 0) {
                $montant += ($_SESSION['panier']['prix'][$i]) * $qte;
            }
        }
        /* On retourne le résultat */
        return $montant;
    }
    function Exonerer_tva()
    {
        /* Exonerationn de la TVA */
        $nb_articles = count($_SESSION['panier']['id_article']);
        /* On va calculer le total par article */
        for ($i = 0; $i < $nb_articles; $i++) {
            $monttva = $_SESSION['panier']['monttva'][$i];
            $_SESSION['panier']['prix'][$i] = $_SESSION['panier']['prix'][$i];
            $_SESSION['panier']['monttvasave'][$i] = $monttva;
            $_SESSION['panier']['monttva'][$i] = 0;
        }
    }
    function Appliquer_tva()
    {
        /* Exonerationn de la TVA */
        $nb_articles = count($_SESSION['panier']['id_article']);
        /* On va calculer le total par article */
        for ($i = 0; $i < $nb_articles; $i++) {
            $monttva = $_SESSION['panier']['monttvasave'][$i];
            $_SESSION['panier']['prix'][$i] = $_SESSION['panier']['prix'][$i] + $monttva;
            $_SESSION['panier']['monttva'][$i] = $monttva;
        }
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
}
