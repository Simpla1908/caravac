<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
include('../../FUNCTION/stock.php');
//Fusion horaire
date_default_timezone_set('Africa/Kinshasa');
$json = array();
include '../Traitement/verif_code_prod.php';
include '../Traitement/verif_des_prod.php';
// Vérification des champs saisie
$famille_id = trim($_POST['famille_id'], ' ');
$s_famille_id = trim($_POST['s_famille_id'], ' ');
$statut = 0;
$qte_min = $_POST['qte_min'];
$libelle = trim($_POST['libelle'], ' ');
$prix_achat = $_POST['prix_achat'];
$quantite = $_POST['qte'];
$prix_vente = $_POST['prix_vente'];
$unite = trim($_POST['unite'], ' ');
$code = trim($_POST['code'], ' ');
$monnaie = $_POST['monnaie'];
$repas = 0;
$venteprod = $_POST['venteprod'];
$vendable = $_POST['repas'];
if ($venteprod == 'groupe') {
    $repas = 3;
    $nbArticles = count($_SESSION['panier']['id_article']);
    for ($i = 0; $i <= $nbArticles - 1; $i++) {
        $idmotif = $_SESSION['panier']['idmotif'][$i];
        $id = $_SESSION['panier']['id_article'][$i];
        $nom = $_SESSION['panier']['nom'][$i];
        $qte = $_SESSION['panier']['qte'][$i];
        $unite = $_SESSION['panier']['unite'][$i];
        $motif = $_SESSION['panier']['motif'][$i];
        array_push($_SESSION['fiche']['ingred_id'], $id);
        array_push($_SESSION['fiche']['name'], $nom);
        array_push($_SESSION['fiche']['qte'], $qte);
        array_push($_SESSION['fiche']['utite'], $unite);
    }
    unset($_SESSION['panier']);
}
$type = explode('.', $_FILES['image']['name']);
$type = $type[count($type) - 1];
$url = 'images/' . uniqid(rand()) . '.' . $type;
if (in_array($type, array('gif', 'jpg', 'jpeg', 'png'))) {
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $url)) {
            $verif_code = verif_code_prod($code);
            $verif_des = verif_code_prod($libelle);
            if (($verif_code == 0) && ($verif_des == 0)) {
                $msg = 'vide';
                if (empty($libelle)  || empty($unite) || empty($code)) {
                    $json['message_vide'] = 'vide';
                    //echo 'Remplissez tous les champs';
                } else {
                    $bool = 0;
                    if ($vendable == 1) {
                        $NBR_ID = count($_POST['prix_vente_site']);
                        for ($i = 0; $i < $NBR_ID; $i++) {
                            $prix_vente_site = $_POST['prix_vente_site'][$i];
                            if ($prix_vente_site == '' || $prix_vente_site <= 0) {
                                $bool = 1;
                            }
                        }
                    }
                    if ($bool == 1) {
                        $json['message_prix'] = 'nocorrect';
                    } else {

                        $requete = $bdd->prepare("INSERT INTO stk_produit (code,designation,path_image,qte_min,qte_initial,pa,pv,repas,statut,unite,famille_id,hotel_id,monnaie)
                                                     VALUES(:code,:designation,:path_image,:qte_min,:qte_initial,:pa,:pv,:repas,:statut,:unite,:famille_id,:hotel_id,:monnaie)");
                        $requete->BindParam(':code', $code);
                        $requete->BindParam(':designation', $libelle);
                        $requete->BindParam(':path_image', $url);
                        $requete->BindParam(':qte_min', $qte_min);
                        $requete->BindParam(':qte_initial', $quantite);
                        $requete->BindParam(':pa', $prix_achat);
                        $requete->BindParam(':pv', $prix_vente);
                        $requete->BindParam(':repas', $repas);
                        $requete->BindParam(':statut', $statut);
                        $requete->BindParam(':unite', $unite);
                        $requete->BindParam('famille_id', $s_famille_id);
                        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                        $requete->BindParam(':monnaie', $monnaie);
                        $requete->execute();
                        $article = $bdd->lastInsertId();
                        /* Insertion des ingrédients */
                        $nbArticles = count($_SESSION['fiche']['ingred_id']);
                        for ($i = 0; $i <= $nbArticles - 1; $i++) {
                            $produit_id = $_SESSION['fiche']['ingred_id'][$i];
                            $designation = $_SESSION['fiche']['name'][$i];
                            $unite_ing = $_SESSION['fiche']['utite'][$i];
                            $quantite = $_SESSION['fiche']['qte'][$i];
                            $plat_id = $article;
                            $requete = $bdd->prepare("INSERT INTO  t_ingredient (produit_id,designation,unite,quantite,plat_id,hotel_id)
                                                         VALUES(:produit_id,:designation,:unite,:quantite,:plat_id,:hotel_id)");
                            $requete->BindParam(':produit_id', $produit_id);
                            $requete->BindParam(':designation', $designation);
                            $requete->BindParam(':unite', $unite_ing);
                            $requete->BindParam(':quantite', $quantite);
                            $requete->BindParam(':plat_id', $plat_id);
                            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                            $requete->execute();
                        }
                        //insertion dans table t_prix_produit
                        $NBR_ID = count($_POST['sousresto_id']);
                        //                $NBR_DES = count($_POST['prix_vente_site']);
                        for ($i = 0; $i < $NBR_ID; $i++) {
                            $sousresto_id = $_POST['sousresto_id'][$i];
                            $prix_vente_site = $_POST['prix_vente_site'][$i];
                            $requete = $bdd->prepare("INSERT INTO t_prix_produit (prix_vente,produit_id,sousresto_id,monnaie)
                                                     VALUES(:prix_vente,:produit_id,:sousresto_id,:monnaie)");
                            $requete->BindParam(':prix_vente', $prix_vente_site);
                            $requete->BindParam(':produit_id', $article);
                            $requete->BindParam(':sousresto_id', $sousresto_id);
                            $requete->BindParam(':monnaie', $_SESSION['m_insert']);
                            $requete->execute();
                        }
                        $json['message_succes'] = 'succes';
                    }
                }
            } else {
                $json['message_erreur'] = 'erreur';
                $json['code_value'] = $code;
            }
        } else {
            $json['message_erreur'] = 'erreur';
        }
    }
} else {

    $verif_code = verif_code_prod($code);
    $verif_des = verif_code_prod($libelle);
    if (($verif_code == 0) && ($verif_des == 0)) {
        $msg = 'vide';

        if (empty($libelle)  || empty($unite) || empty($code)) {
            $json['message_vide'] = 'vide';
            //echo 'Remplissez tous les champs';
        } else {
            $bool = 0;
            if ($vendable == 1) {
                $NBR_ID = count($_POST['prix_vente_site']);
                for ($i = 0; $i < $NBR_ID; $i++) {
                    $prix_vente_site = $_POST['prix_vente_site'][$i];
                    if ($prix_vente_site == '' || $prix_vente_site <= 0) {
                        $bool = 1;
                    }
                }
            }
            if ($bool == 1) {
                $json['message_prix'] = 'nocorrect';
            } else {
                $requete = $bdd->prepare("INSERT INTO stk_produit (code,designation,qte_min,qte_initial,pa,pv,repas,statut,unite,famille_id,hotel_id,monnaie)
                                             VALUES(:code,:designation,:qte_min,:qte_initial,:pa,:pv,:repas,:statut,:unite,:famille_id,:hotel_id,:monnaie)");
                $requete->BindParam(':code', $code);
                $requete->BindParam(':designation', $libelle);
                $requete->BindParam(':qte_min', $qte_min);
                $requete->BindParam(':qte_initial', $quantite);
                $requete->BindParam(':pa', $prix_achat);
                $requete->BindParam(':pv', $prix_vente);
                $requete->BindParam(':repas', $repas);
                $requete->BindParam(':statut', $statut);
                $requete->BindParam(':unite', $unite);
                $requete->BindParam('famille_id', $s_famille_id);
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                $requete->BindParam(':monnaie', $monnaie);
                $requete->execute();
                $article = $bdd->lastInsertId();
                $nbArticles = count($_SESSION['fiche']['ingred_id']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                    $produit_id = $_SESSION['fiche']['ingred_id'][$i];
                    $designation = $_SESSION['fiche']['name'][$i];
                    $unite_ing = $_SESSION['fiche']['utite'][$i];
                    $quantite = $_SESSION['fiche']['qte'][$i];
                    $plat_id = $article;
                    $requete = $bdd->prepare("INSERT INTO  t_ingredient (produit_id,designation,unite,quantite,plat_id,hotel_id)
                                                 VALUES(:produit_id,:designation,:unite,:quantite,:plat_id,:hotel_id)");
                    $requete->BindParam(':produit_id', $produit_id);
                    $requete->BindParam(':designation', $designation);
                    $requete->BindParam(':unite', $unite_ing);
                    $requete->BindParam(':quantite', $quantite);
                    $requete->BindParam(':plat_id', $plat_id);
                    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                    $requete->execute();
                }
                //insertion dans table t_prix_produit
                $NBR_ID = count($_POST['sousresto_id']);
                //                $NBR_DES = count($_POST['prix_vente_site']);
                for ($i = 0; $i < $NBR_ID; $i++) {
                    $sousresto_id = $_POST['sousresto_id'][$i];
                    $prix_vente_site = $_POST['prix_vente_site'][$i];
                    $requete = $bdd->prepare("INSERT INTO t_prix_produit (prix_vente,produit_id,sousresto_id,monnaie)
                                             VALUES(:prix_vente,:produit_id,:sousresto_id,:monnaie)");
                    $requete->BindParam(':prix_vente', $prix_vente_site);
                    $requete->BindParam(':produit_id', $article);
                    $requete->BindParam(':sousresto_id', $sousresto_id);
                    $requete->BindParam(':monnaie', $_SESSION['m_insert']);
                    $requete->execute();
                }
                $json['message_succes'] = 'succes';
            }
        }
    } else {
        $json['message_erreur'] = 'erreur';
        $json['code_value'] = $code;
    }
}
$_SESSION['fiche'] = array();
$_SESSION['fiche']['ingred_id'] = array();
$_SESSION['fiche']['name'] = array();
$_SESSION['fiche']['qte'] = array();
$_SESSION['fiche']['utite'] = array();
echo json_encode($json);
