<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
include '../Traitement/verif_code_prod_1.php';
include('../../FUNCTION/stock.php');
$json = array();
// Vérification des champs saisie
$idprod = $_POST['idprod'];
$famille_id = trim($_POST['famille_id'], ' ');
$s_famille_id = trim($_POST['s_famille_id'], ' ');
$qte_min = 0;
$libelle = trim($_POST['libelle'], ' ');
$prix_achat = $_POST['paplat'];
$quantite = 0;
$prix_vente = trim($_POST['prix_vente'], ' ');
$unite = trim($_POST['unite'], ' ');
$code = trim($_POST['code'], ' ');
$code_ex = $_POST['code_ex'];
$enreg = $_POST['enreg'];
$monnaie = $_POST['monnaie'];
$vendrerupturestk = $_POST['vendrerupturestk'];
$accompagnement = 0;
$legume = 0;
$sauce = 0;
$cond = 0;
$softplast = 0;
$softbtl = 0;
$biere = 0;
$cuisson = 0;
$vin = 0;
$pop = 0;
$repas = 1;

if (isset($_POST['accompagnement'])) {
    $accompagnement = 1;
    $pop = 1;
}
if (isset($_POST['legume'])) {
    $legume = 1;
    $pop = 1;
}

if (isset($_POST['sauce'])) {
    $sauce = 1;
    $pop = 1;
}

if (isset($_POST['cond'])) {
    $cond = 1;
    $pop = 1;
}
if (isset($_POST['softplast'])) {
    $softplast = 1;
    $pop = 1;
}
if (isset($_POST['softbtl'])) {
    $softbtl = 1;
    $pop = 1;
}

if (isset($_POST['biere'])) {
    $biere = 1;
    $pop = 1;
}
if (isset($_POST['vin'])) {
    $vin = 1;
    $pop = 1;
}
if (isset($_POST['cuisson'])) {
    $cuisson = 1;
    $pop = 1;
}

$type = '';
$url = '';
if (!empty($_FILES['image']['name'])) {
    $type = explode('.', $_FILES['image']['name']);
    $type = $type[count($type) - 1];
    $url = 'images/' . uniqid(rand()) . '.' . $type;
}

if (in_array($type, array('gif', 'jpg', 'jpeg', 'png'))) {
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $url)) {

            //initialisation idmvt
            $verif_code = verif_code_prod_1($code_ex, $code);
            if ($verif_code == 0) {
                $msg = 'vide';
                if (empty($libelle) || empty($unite) || empty($code)) {
                    $json['message_vide'] = 'vide';
                } else {
                    $bool = 0;
                    $NBR_ID = count($_POST['prix_vente_site']);
                    for ($i = 0; $i < $NBR_ID; $i++) {
                        $prix_vente_site = $_POST['prix_vente_site'][$i];
                        if ($prix_vente_site == '' || $prix_vente_site == 0) {
                            $bool = 1;
                        }
                    }
                    if ($bool == 1) {
                        $json['message_prix'] = 'nocorrect';
                    } else {
                        $requete = $bdd->prepare("UPDATE stk_produit SET code=:code,designation=:designation,path_image=:path_image,qte_min=:qte_min,qte_initial=:qte_initial,pa=:pa,pv=:pv,
                        repas=:repas,unite=:unite,famille_id=:famille_id,monnaie=:monnaie,
                        accomp=:accomp,softplt=:softplt,softbtl=:softbtl,
                        legume=:legume,cuisso=:cuisso,soce=:soce,cond=:cond,vin=:vin,biere=:biere,pop=:pop,vendrerupturestk=:vendrerupturestk
                        WHERE idprod=:idprod");
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
                        $requete->BindParam(':accomp', $accompagnement);
                        $requete->BindParam(':softplt', $softplast);
                        $requete->BindParam(':softbtl', $softbtl);
                        $requete->BindParam(':legume', $legume);
                        $requete->BindParam(':cuisso', $cuisson);
                        $requete->BindParam(':soce', $sauce);
                        $requete->BindParam(':cond', $cond);
                        $requete->BindParam(':vin', $vin);
                        $requete->BindParam(':biere', $biere);
                        $requete->BindParam(':pop', $pop);
                        $requete->BindParam(':vendrerupturestk', $vendrerupturestk);
                        $requete->execute();
                        //insertion dans table t_prix_produit
                        $NBR_ID = count($_POST['prix_vente_site']);
                        for ($i = 0; $i < $NBR_ID; $i++) {
                            $prix_id = $_POST['prix_id'][$i];
                            $sousresto_id = $_POST['sousresto_id'][$i];
                            $prix_vente_site = $_POST['prix_vente_site'][$i];
                            $requete = $bdd->prepare("UPDATE t_prix_produit SET prix_vente=:prix_vente WHERE id_prix=:id_prix");
                            $requete->BindParam(':prix_vente', $prix_vente_site);
                            $requete->BindParam(':id_prix', $prix_id);
                            $requete->execute();
                        }
                        /*Update des ingrédients */
                        $requete = $bdd->prepare("DELETE FROM t_ingredient WHERE plat_id=:plat_id");
                        $requete->BindParam(':plat_id', $idprod);
                        $requete->execute();
                        $nbArticles = count($_SESSION['fiche']['ingred_id']);
                        for ($i = 0; $i <= $nbArticles - 1; $i++) {
                            $produit_id = $_SESSION['fiche']['ingred_id'][$i];
                            $designation = $_SESSION['fiche']['name'][$i];
                            $unite_ing = $_SESSION['fiche']['utite'][$i];
                            $quantite = $_SESSION['fiche']['qte'][$i];
                            $plat_id = $idprod;
                            $prix = $_SESSION['fiche']['prix'][$i];
                            $requete = $bdd->prepare("INSERT INTO  t_ingredient (produit_id,designation,unite,quantite,plat_id,prix,hotel_id)
                                                             VALUES(:produit_id,:designation,:unite,:quantite,:plat_id,:prix,:hotel_id)");
                            $requete->BindParam(':produit_id', $produit_id);
                            $requete->BindParam(':designation', $designation);
                            $requete->BindParam(':unite', $unite_ing);
                            $requete->BindParam(':quantite', $quantite);
                            $requete->BindParam(':plat_id', $plat_id);
                            $requete->BindParam(':prix', $prix);
                            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                            $requete->execute();
                        }
                        /* Update des ingrédients */
                        $json['message_succes'] = 'succes';
                    }
                }
            }
            $json['id_sousresto'] = $_SESSION['id_sousresto'];
        } else {
            $json['message_erreur'] = 'erreur';
        }
    }
} else {
    //initialisation idmvt
    $verif_code = verif_code_prod_1($code_ex, $code);
    if ($verif_code == 0) {
        $msg = 'vide';
        if (empty($libelle) || empty($unite) || empty($code)) {
            $json['message_vide'] = 'vide';
        } else {
            $bool = 0;
            $NBR_ID = count($_POST['prix_vente_site']);
            for ($i = 0; $i < $NBR_ID; $i++) {
                $prix_vente_site = $_POST['prix_vente_site'][$i];
                if ($prix_vente_site == '' || $prix_vente_site == 0) {
                    $bool = 1;
                }
            }
            if ($bool == 1) {
                $json['message_prix'] = 'nocorrect';
            } else {
                $requete = $bdd->prepare("UPDATE stk_produit SET code=:code,designation=:designation,qte_min=:qte_min,qte_initial=:qte_initial,pa=:pa,pv=:pv,
 repas=:repas,unite=:unite,famille_id=:famille_id,monnaie=:monnaie,
 accomp=:accomp,softplt=:softplt,softbtl=:softbtl,
 legume=:legume,cuisso=:cuisso,soce=:soce,cond=:cond,vin=:vin,biere=:biere,pop=:pop,vendrerupturestk=:vendrerupturestk
 WHERE idprod=:idprod");
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
                $requete->BindParam(':accomp', $accompagnement);
                $requete->BindParam(':softplt', $softplast);
                $requete->BindParam(':softbtl', $softbtl);
                $requete->BindParam(':legume', $legume);
                $requete->BindParam(':cuisso', $cuisson);
                $requete->BindParam(':soce', $sauce);
                $requete->BindParam(':cond', $cond);
                $requete->BindParam(':vin', $vin);
                $requete->BindParam(':biere', $biere);
                $requete->BindParam(':pop', $pop);
                $requete->BindParam(':vendrerupturestk', $vendrerupturestk);
                $requete->execute();
                //insertion dans table t_prix_produit
                $NBR_ID = count($_POST['prix_vente_site']);
                for ($i = 0; $i < $NBR_ID; $i++) {
                    $prix_id = $_POST['prix_id'][$i];
                    $sousresto_id = $_POST['sousresto_id'][$i];
                    $prix_vente_site = $_POST['prix_vente_site'][$i];
                    $requete = $bdd->prepare("UPDATE t_prix_produit SET prix_vente=:prix_vente WHERE id_prix=:id_prix");
                    $requete->BindParam(':prix_vente', $prix_vente_site);
                    $requete->BindParam(':id_prix', $prix_id);
                    $requete->execute();
                }
                /*Update des ingrédients */
                $requete = $bdd->prepare("DELETE FROM t_ingredient WHERE plat_id=:plat_id");
                $requete->BindParam(':plat_id', $idprod);
                $requete->execute();
                $nbArticles = count($_SESSION['fiche']['ingred_id']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                    $produit_id = $_SESSION['fiche']['ingred_id'][$i];
                    $designation = $_SESSION['fiche']['name'][$i];
                    $unite_ing = $_SESSION['fiche']['utite'][$i];
                    $quantite = $_SESSION['fiche']['qte'][$i];
                    $plat_id = $idprod;
                    $prix = $_SESSION['fiche']['prix'][$i];
                    $requete = $bdd->prepare("INSERT INTO  t_ingredient (produit_id,designation,unite,quantite,plat_id,prix,hotel_id)
                                                             VALUES(:produit_id,:designation,:unite,:quantite,:plat_id,:prix,:hotel_id)");
                    $requete->BindParam(':produit_id', $produit_id);
                    $requete->BindParam(':designation', $designation);
                    $requete->BindParam(':unite', $unite_ing);
                    $requete->BindParam(':quantite', $quantite);
                    $requete->BindParam(':plat_id', $plat_id);
                    $requete->BindParam(':prix', $prix);
                    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                    $requete->execute();
                }
                /* Update des ingrédients */
                $json['message_succes'] = 'succes';
            }
        }
    }
    $json['id_sousresto'] = $_SESSION['id_sousresto'];
}


echo json_encode($json);
