<?php
class Panier{
    public function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
            $_SESSION['panier']['id'] = array();
            $_SESSION['panier']['nom'] = array();
            $_SESSION['panier']['prix'] = array();
            $_SESSION['panier']['monnaie'] = array();
        }
    }

	public function ajouter($select) {
        $positionProduit = array_search($select['id'], $_SESSION['panier']['id']);
        if ($positionProduit !== false) {
          $_SESSION['panier']['prix'][$positionProduit] = $select['prix'];
        } else {
            //Sinon on ajoute le produit
            array_push($_SESSION['panier']['id'], $select['id']);
            array_push($_SESSION['panier']['nom'],$select['nom']);
            array_push($_SESSION['panier']['prix'],$select['prix']);
            array_push($_SESSION['panier']['monnaie'], $select['monnaie']);
        }
       }
       public function supprimer_article($select) {
        $suppression = false;
        if (!isset($_SESSION['panier']['verrouille']) || $_SESSION['panier']['verrouille'] == false) {
            /* On vérifie que l'article à supprimer est bien présent dans le panier */
            $positionProduit = array_search($select['id'], $_SESSION['panier']['id']);
            
            if ($positionProduit !== false) {
                /* création d'un tableau temporaire de stockage des articles */
               $panier_tmp = array("id"=>array(),"nom"=>array(),"prix"=>array(),"monnaie"=>array()); 
                /* Comptage des articles du panier */
                $nb_articles = count($_SESSION['panier']['id']);
                /* Transfert du panier dans le panier temporaire */
                for ($i = 0; $i < $nb_articles; $i++) {
                    /* On transfère tout sauf l'article à supprimer */
                    if ($_SESSION['panier']['id'][$i] != $select['id']) {
                        array_push($panier_tmp['id'],$_SESSION['panier']['id'][$i]);
                         array_push($panier_tmp['nom'],$_SESSION['panier']['nom'][$i]);
                        array_push($panier_tmp['prix'],$_SESSION['panier']['prix'][$i]);
                        array_push($panier_tmp['monnaie'],$_SESSION['panier']['monnaie'][$i]);
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
	public function add($id_chambre){
		 $_SESSION['panier'][$id_chambre]=1;
	}
        public function vider_panier() {
                $vide = false;
                    if (isset($_SESSION['panier'])) {
                        unset($_SESSION['panier']);
                        if (!isset($_SESSION['panier'])) {
                            $vide = true;
                        }
                    } else {
                        /* Le panier était déjà détruit, on renvoie une autre valeur exploitable au retour */
                        $vide = "inexistant";
                    }
           
                return $vide;
            }

        }
?>