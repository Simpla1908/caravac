<?php
class Panier {
    public function __construct(){
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['panier'])) {
            $this->initialiser();
        }
    }
    public function initialiser(){
        $_SESSION['panier'] = array();
        $_SESSION['panier']['id_article'] = array();
        $_SESSION['panier']['nom'] = array();
        $_SESSION['panier']['qte'] = array();
        $_SESSION['panier']['fact_id'] = array();
        $_SESSION['panier']['unite'] = array();
        $_SESSION['panier']['idmotif'] = array();
        $_SESSION['panier']['motif'] = array();
        $_SESSION['panier']['verrouille'] = false;
    }
    

    public function ajouterstock($select) {
        $positionProduit = array_search($select['id'], $_SESSION['panier']['id_article']);
        if ($positionProduit !== false) {
            $_SESSION['panier']['qte'][$positionProduit] = $select['qte'];
        } else {
            //Sinon on ajoute le produit
            array_push($_SESSION['panier']['id_article'],$select['id']);
            array_push($_SESSION['panier']['nom'],$select['nom']);
            array_push($_SESSION['panier']['qte'],$select['qte']);
            array_push($_SESSION['panier']['unite'],$select['unite']);
            array_push($_SESSION['panier']['idmotif'],$select['idmotif']);
            array_push($_SESSION['panier']['motif'],$select['motif']);
        }
    }
   
    public function modifierQTeArticle($select) {
        //Si le panier éxiste
        //Si la quantité est positive on modifie sinon on supprime l'article
        if ($select['qte'] > 0) {
            //Recharche du produit dans le panier
            $positionProduit = array_search($select['id'], $_SESSION['panier']['id_article']);
            if ($positionProduit !== false){
                $_SESSION['panier']['qte'][$positionProduit] = $select['qte'];
            }
        }
    }
   
    public function delete_articlestock($select) {
        $suppression = false;
        if (!isset($_SESSION['panier']['verrouille']) || $_SESSION['panier']['verrouille'] == false) {
            /* On vérifie que l'article à supprimer est bien présent dans le panier */
            $positionProduit = array_search($select['id'],$_SESSION['panier']['id_article']);
            if ($positionProduit !== false) {
                /* création d'un tableau temporaire de stockage des articles */
                $panier_tmp = array("id_article" => array(), "nom" => array(),
                                    "qte" => array(), "unite" => array(),"idmotif" => array(),
                                    "motif" => array());
                /* Comptage des articles du panier */
                $nb_articles = count($_SESSION['panier']['id_article']);
                /* Transfert du panier dans le panier temporaire */
                for ($i = 0; $i < $nb_articles; $i++) {
                    /* On transfère tout sauf l'article à supprimer */
                    if ($_SESSION['panier']['id_article'][$i] != $select['id']) {
                        array_push($panier_tmp['id_article'], $_SESSION['panier']['id_article'][$i]);
                        array_push($panier_tmp['nom'],$_SESSION['panier']['nom'][$i]);
                        array_push($panier_tmp['qte'],$_SESSION['panier']['qte'][$i]);
                        array_push($panier_tmp['unite'],$_SESSION['panier']['unite'][$i]);
                        array_push($panier_tmp['idmotif'],$_SESSION['panier']['idmotif'][$i]);
                        array_push($panier_tmp['motif'],$_SESSION['panier']['motif'][$i]);
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


    public function annuler() {
        $this->initialiser();
    }
 
}
