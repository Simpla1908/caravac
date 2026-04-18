<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
include '../Traitement/verif_code_prod_1.php';
include('../../FUNCTION/stock.php');
$_SESSION['fiche'] = array();
$_SESSION['fiche']['ingred_id'] = array();
$_SESSION['fiche']['name'] = array();
$_SESSION['fiche']['qte'] = array();
$_SESSION['fiche']['utite'] = array();
$json = array();
$idprod = $_POST['idprod'];
$famille_id = $_POST['famille_id'];
$s_famille_id = $_POST['s_famille_id'];
$qte_min = trim($_POST['qte_min'], ' ');
$libelle = trim($_POST['libelle'], ' ');
$prix_achat = $_POST['prix_achat'];
$quantite = $_POST['qte'];
$prix_vente = $_POST['prix_vente'];
$unite = trim($_POST['unite'], ' ');
$code = trim($_POST['code'], ' ');
$code_ex = $_POST['code_ex'];
$enreg = $_POST['enreg'];
$monnaie = $_POST['monnaie'];
$repas = $_POST['repas'];
$type = explode('.', $_FILES['image']['name']);
$type = $type[count($type) - 1];
$url = 'images/' . uniqid(rand()) . '.' . $type;
$vendable = $_POST['vendable'];
if (in_array($type, array('gif', 'jpg', 'jpeg', 'png'))) {
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $url)) {
            //initialisation idmvt
            $idmvt = 0;
            $verif_code = verif_code_prod_1($code_ex, $code);
            if ($verif_code == 0) {
                $msg = 'vide';
                if ($enreg == 1) {
                    if (empty($libelle) || empty($unite) || empty($code)) {
                        $json['message_vide'] = 'vide';
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
                            $requete = $bdd->prepare("UPDATE stk_produit SET code=:code,designation=:designation,path_image=:path_image,qte_min=:qte_min,qte_initial=:qte_initial,pa=:pa,pv=:pv,repas=:repas,unite=:unite,famille_id=:famille_id,monnaie=:monnaie WHERE idprod=:idprod");
                            $requete->BindParam(':code', $code);
                            $requete->BindParam(':designation', $libelle);
                            $requete->BindParam(':path_image', $url);
                            $requete->BindParam(':qte_min', $qte_min);
                            $requete->BindParam(':qte_initial', $quantite);
                            $requete->BindParam(':pa', $prix_achat);
                            $requete->BindParam(':pv', $prix_vente);
                            $requete->BindParam(':repas', $repas);
                            $requete->BindParam(':unite', $unite);
                            $requete->BindParam(':famille_id', $s_famille_id);
                            $requete->BindParam(':idprod', $idprod);
                            $requete->BindParam(':monnaie', $monnaie);
                            $requete->execute();
                            //insertion dans table t_prix_produit
                            if ($vendable == 1) {
                                $NBR_ID = count($_POST['prix_id']);
                                for ($i = 0; $i < $NBR_ID; $i++) {
                                    $prix_id = $_POST['prix_id'][$i];
                                    $sousresto_id = $_POST['sousresto_id'][$i];
                                    $prix_vente_site = $_POST['prix_vente_site'][$i];
                                    $requete = $bdd->prepare("UPDATE t_prix_produit SET prix_vente=:prix_vente,monnaie=:monnaie WHERE id_prix=:id_prix");
                                    $requete->BindParam(':prix_vente', $prix_vente_site);
                                    $requete->BindParam(':id_prix', $prix_id);
                                    $requete->BindParam(':monnaie', $_SESSION['m_insert']);
                                    $requete->execute();
                                }
                            }
                            $json['message_succes'] = 'succes';
                        }
                    }
                } else if ($enreg == 0) {
                    $prix_vente = 0;
                    if (empty($libelle) || empty($unite) || empty($code)) {
                        $json['message_vide'] = 'vide';
                        //echo 'Remplissez tous les champs';
                    } else {
                        $requete = $bdd->prepare("UPDATE stk_produit SET code=:code,designation=:designation,path_image=:path_image,qte_min=:qte_min,qte_initial=:qte_initial,pa=:pa,pv=:pv,repas=:repas,unite=:unite,famille_id=:famille_id,monnaie=:monnaie WHERE idprod=:idprod");
                        $requete->BindParam(':code', $code);
                        $requete->BindParam(':designation', $libelle);
                        $requete->BindParam(':path_image', $url);
                        $requete->BindParam(':qte_min', $qte_min);
                        $requete->BindParam(':qte_initial', $quantite);
                        $requete->BindParam(':pa', $prix_achat);
                        $requete->BindParam(':pv', $prix_vente);
                        $requete->BindParam(':repas', $repas);
                        $requete->BindParam(':unite', $unite);
                        $requete->BindParam(':famille_id', $s_famille_id);
                        $requete->BindParam(':idprod', $idprod);
                        $requete->BindParam(':monnaie', $monnaie);
                        $requete->execute();
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

    //initialisation idmvt
    $idmvt = 0;
    $verif_code = verif_code_prod_1($code_ex, $code);

    if ($verif_code == 0) {
        $msg = 'vide';
        if ($enreg == 1) {
            if (empty($libelle) || empty($unite) || empty($code)) {
                $json['message_vide'] = 'vide';
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
                    $requete = $bdd->prepare("UPDATE stk_produit SET code=:code,designation=:designation,qte_min=:qte_min,qte_initial=:qte_initial,pa=:pa,pv=:pv,repas=:repas,unite=:unite,famille_id=:famille_id,monnaie=:monnaie WHERE idprod=:idprod");
                    $requete->BindParam(':code', $code);
                    $requete->BindParam(':designation', $libelle);
                    $requete->BindParam(':qte_min', $qte_min);
                    $requete->BindParam(':qte_initial', $quantite);
                    $requete->BindParam(':pa', $prix_achat);
                    $requete->BindParam(':pv', $prix_vente);
                    $requete->BindParam(':repas', $repas);
                    $requete->BindParam(':unite', $unite);
                    $requete->BindParam(':famille_id', $s_famille_id);
                    $requete->BindParam(':idprod', $idprod);
                    $requete->BindParam(':monnaie', $monnaie);
                    $requete->execute();
                    //insertion dans table t_prix_produit
                    if ($vendable == 1) {
                        $NBR_ID = count($_POST['sousresto_id']);
                        $requete = $bdd->prepare("DELETE FROM t_prix_produit WHERE produit_id=:produit_id");
                        $requete->BindParam(':produit_id', $idprod);
                        $requete->execute();
                        for ($i = 0; $i < $NBR_ID; $i++) {
                            $prix_vente_site = $_POST['prix_vente_site'][$i];
                            if ($prix_vente_site > 0) {
                                $sousresto_id = $_POST['sousresto_id'][$i];
                                $requete = $bdd->prepare("INSERT INTO t_prix_produit (prix_vente,produit_id,sousresto_id,monnaie)
                                                         VALUES(:prix_vente,:produit_id,:sousresto_id,:monnaie)");
                                $requete->BindParam(':prix_vente', $prix_vente_site);
                                $requete->BindParam(':produit_id', $idprod);
                                $requete->BindParam(':sousresto_id', $sousresto_id);
                                $requete->BindParam(':monnaie', $_SESSION['m_insert']);
                                $requete->execute();
                            }
                        }
                    }
                    $json['message_succes'] = 'succes';
                }
            }
        } else if ($enreg == 0) {
            $prix_vente = 0;
            if (empty($libelle) || empty($unite) || empty($code)) {
                $json['message_vide'] = 'vide';
                //echo 'Remplissez tous les champs';
            } else {
                $requete = $bdd->prepare("UPDATE stk_produit SET code=:code,designation=:designation,path_image=:path_image,qte_min=:qte_min,qte_initial=:qte_initial,pa=:pa,pv=:pv,repas=:repas,unite=:unite,famille_id=:famille_id,monnaie=:monnaie WHERE idprod=:idprod");
                $requete->BindParam(':code', $code);
                $requete->BindParam(':designation', $libelle);
                $requete->BindParam(':path_image', $url);
                $requete->BindParam(':qte_min', $qte_min);
                $requete->BindParam(':qte_initial', $quantite);
                $requete->BindParam(':pa', $prix_achat);
                $requete->BindParam(':pv', $prix_vente);
                $requete->BindParam(':repas', $repas);
                $requete->BindParam(':unite', $unite);
                $requete->BindParam(':famille_id', $s_famille_id);
                $requete->BindParam(':idprod', $idprod);
                $requete->BindParam(':monnaie', $monnaie);
                $requete->execute();
                $json['message_succes'] = 'succes';
            }
        }
    } else {
        $json['message_erreur'] = 'erreur';
        $json['code_value'] = $code;
    }
}
if ($repas == 0) {
    $requete = $bdd->prepare("DELETE FROM t_ingredient WHERE plat_id=:produit_id");
    $requete->BindParam(':produit_id', $idprod);
    $requete->execute();
} elseif ($repas == 3) {
    $requete = $bdd->prepare("DELETE FROM t_ingredient WHERE plat_id=:produit_id");
    $requete->BindParam(':produit_id', $idprod);
    $requete->execute();
    $nbArticles = count($_SESSION['panier']['id_article']);
    for ($i = 0; $i <= $nbArticles - 1; $i++) {
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
    $nbArticles = count($_SESSION['fiche']['ingred_id']);
    for ($i = 0; $i <= $nbArticles - 1; $i++) {
        $produit_id = $_SESSION['fiche']['ingred_id'][$i];
        $designation = $_SESSION['fiche']['name'][$i];
        $unite_ing = $_SESSION['fiche']['utite'][$i];
        $quantite = $_SESSION['fiche']['qte'][$i];
        $plat_id = $idprod;
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
    unset($_SESSION['fiche']);
}
echo json_encode($json);
