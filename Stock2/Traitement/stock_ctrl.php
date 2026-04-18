<?php
// Initialisation de la session
session_start();
//Fusion horaire
date_default_timezone_set('Africa/Kinshasa');
$json = array();
$json['s'] = FALSE;
$json['message'] = FALSE;
$depot_id = 0;
$source_id = 0;
$pos_id = 0;
if (!empty($_GET['do']) && !empty($_GET['ajx'])) {
    $action = $_GET['do'];
    $ajx = $_GET['ajx'];
    if ($ajx == 0) {
    } else {
        include('../../FUNCTION/hebergement.php');
        include('../../FUNCTION/stock.php');
        include('./Panier.php');
        include '../bdd/connexion.php';
        $panier = new Panier();
        if ($action == 'addprod') {
            $op = $_POST['operation'];
            //$source_id=$_POST['empl_id'];
            $select['id'] = $_POST['prod_id'];
            $idmotif = $_POST['motif_sortie_id'];
            $qtedispo = 0;
            $testsortie = FALSE;
            if ($op == 'sortie' || $op == 'transfert') {
                $depot_id = GetDepotCentral_id($_SESSION['id_hotel'], $bdd);
                if (!empty($_POST['empl_id']) && !empty($_POST['empl_id']) != 0) {
                    $depot_id = $_POST['empl_id'];
                }
                $qtedispo = GetQteDispoByProd($bdd, $select['id'], $depot_id);
                $testsortie = TRUE;
                if ($op == 'transfert') {
                    $idmotif = 7;
                }
            }
            $select['nom'] = $_POST['prod_nom'];
            $select['qte'] = $_POST['qte'];
            $select['unite'] = $_POST['unite'];
            $select['idmotif'] = $idmotif;
            $select['motif'] = $_POST['motif_sortie_lib'];
            $json['operation'] = $op;
            $json['affichage'] = $_POST['affichage'];
            if ($select['nom'] == '') {
                $json['message'] = 'Veuillez choisir un produit!';
            } elseif (!IsNombre($select['qte'])) {
                $json['message'] = 'La quantité doit être un nombre positif';
            } elseif ($select['qte'] > $qtedispo && $testsortie) {
                $json['message'] = "La quantité doit être inférieure à " . $qtedispo;
            } elseif ($select['idmotif'] == '') {
                $json['message'] = 'Veuillez choisir un motif!';
            } else {
                $panier->ajouterstock($select);
                $json['s'] = TRUE;
            }
            //var_dump($_SESSION['panier']);
            echo json_encode($json);
        } elseif ($action == 'voirpan') {
            $op = $_GET['op'];
            if ($op == 'appro' || $op == 'transfert') {
                include './lignesmvmt.php';
            } elseif ($op == 'sortie') {
                include './lignesmvmt2.php';
            }
        } elseif ($action == 'delprod') {
            $select['id'] = $_GET['id'];
            $panier->delete_articlestock($select);
            $op = $_GET['op'];
            if ($op == 'appro' || $op == 'transfert') {
                include './lignesmvmt.php';
            } elseif ($op == 'sortie') {
                include './lignesmvmt2.php';
            }
        } elseif ($action == 'mvmt') {
            include '../bdd/connexion.php';
            $json['s'] = FALSE;
            $action2 = $_GET['do2'];
            $_SESSION['fiche'] = array();
            $_SESSION['fiche']['produit_id'] = array();
            $_SESSION['fiche']['designation'] = array();
            $_SESSION['fiche']['qte_env'] = array();
            $_SESSION['fiche']['qte_recue'] = array();
            $_SESSION['fiche']['ecart'] = array();
            $_SESSION['fiche']['unite'] = array();
            $_SESSION['fiche']['obs'] = array();
            $user = $_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user'];
            $nbArticles = count($_SESSION['panier']['id_article']);

            if (isset($_POST['source_id'])) {
                $source_id = $_POST['source_id'];
            }

            if (isset($_POST['pos_id'])) {
                $pos_id = $_POST['pos_id'];
            }

            if ($nbArticles == 0) {
                $json['message'] = 'Veuillez ajouter un produit!';
            } elseif ($source_id == $pos_id && $action2 == 'transfert') {
                $json['message'] = 'La source doit etre different de la destination';
            } else {
                $hotel_id = $_POST['hotel_id'];
                $user_id = $_SESSION['id_user'];
                $dte = date('Y-m-d');
                $dte_time = date('Y-m-d H:i:s');

                if ($action2 == 'appro') {
                    $motifappro = $_POST['motifappro'];
                    $type = 'appro';
                    //$numbon=$_POST['numbon'];
                    //if($numbon==''){
                    //$json['message']="Veuillez saisir un numéro de bon!";   
                    //}else{
                    $lib = 'BE_STK';
                    $num_cmd = getnumerotation($hotel_id, $lib, $bdd);
                    $num_cmd_format = format_numero($num_cmd);
                    $numbon = $num_cmd_format;
                    $motif_id = GetMotifMouvement($type, $bdd);
                    //$depot_id = GetDepotCentral_id($hotel_id,$bdd);
                    $depot_id = $_POST['emplacement_id'];
                    $beneficiere = '';
                    $approuve = 1;
                    $motif_fiche = 'appro';
                    $fiche_id = CreateBonStk($numbon, $type, $motif_fiche, $beneficiere, $depot_id, $user_id, $hotel_id, $nbArticles, $dte, $dte_time, $approuve, $motifappro, $bdd);
                    for ($i = 0; $i <= $nbArticles - 1; $i++) {
                        $prod_id = $_SESSION['panier']['id_article'][$i];
                        $designation = $_SESSION['panier']['nom'][$i];
                        $qte = $_SESSION['panier']['qte'][$i];
                        $unite = $_SESSION['panier']['unite'][$i];
                        $produit_id = $prod_id;
                        $ecart = 0;
                        $qte_envoye = $qte;
                        $qte_recue = 0;
                        ApprovisionnementStk($qte, $dte, $prod_id, $fiche_id, $depot_id, $user_id, $hotel_id, $motif_id, $bdd);
                        sessionDetailsBon($produit_id, $designation, $qte_envoye, $qte_recue, $ecart, $unite, ' ');
                    }
                    setnumerotation($hotel_id, $lib, $num_cmd + 1, $bdd);
                    $statut = '1';
                    sessionInfoBon($numbon, dateAffiche($dte), $user, $beneficiere, $statut);
                    $panier->annuler();
                    $json['message'] = "L'approvisionnement vient de s'effectuer avec succès!";
                    $json['s'] = TRUE;
                    //}

                } elseif ($action2 == 'sortie') {
                    $lib = 'BS_STK';
                    $bloc_affiche = $_POST['affichage'];
                    $num_cmd = getnumerotation($hotel_id, $lib, $bdd);
                    $num_cmd_format = format_numero($num_cmd);
                    $numbon = $num_cmd_format;
                    $beneficiere = $_POST['benef'];
                    $type = 'sortie';
                    $motif_fiche = 'sortie';
                    $approuve = 1;
                    $depot_id = $_POST['emplacement_id'];
                    $motifappro = '';
                    //$depot_id = GetDepotCentral_id($_SESSION['id_hotel'], $bdd);
                    $fiche_id = CreateBonStk($numbon, $type, $motif_fiche, $beneficiere, $depot_id, $user_id, $hotel_id, $nbArticles, $dte, $dte_time, $approuve, $motifappro, $bdd);
                    for ($i = 0; $i <= $nbArticles - 1; $i++) {
                        $idmotif = $_SESSION['panier']['idmotif'][$i];
                        if ($idmotif != 7) {
                            $prod_id = $_SESSION['panier']['id_article'][$i];
                            $qte = $_SESSION['panier']['qte'][$i];
                            $libelle_sortie = GetLibMotifSortie($idmotif, $bdd);
                            if ($idmotif == 1 || $idmotif == 5) {
                                $quantite = $qte;
                                $qte_declasse = 0;
                            } else {
                                $quantite = 0;
                                $qte_declasse = $qte;
                            }
                            $designation = $_SESSION['panier']['nom'][$i];
                            $unite = $_SESSION['panier']['unite'][$i];
                            $produit_id = $prod_id;
                            $ecart = 0;
                            $qte_envoye = $qte;
                            $qte_recue = 0;
                            SortieStk($quantite, $qte_declasse, $dte, $prod_id, $idmotif, $fiche_id, $depot_id, $user_id, $hotel_id, $bdd);
                            sessionDetailsBon($produit_id, $designation, $qte_envoye, $qte_recue, $ecart, $unite, $libelle_sortie);
                        }
                    }
                    setnumerotation($hotel_id, $lib, $num_cmd + 1, $bdd);
                    $statut = '1';
                    sessionInfoBon($numbon, dateAffiche($dte), $user, $beneficiere, $statut);
                    $panier->annuler();
                    $json['message'] = "La sortie vient de s'effectuer avec succès!";
                    $json['bloc_affiche'] = $bloc_affiche;
                    $json['s'] = TRUE;
                } elseif ($action2 == 'transfert') {
                    $depot_id = $_POST['pos_id'];
                    if ($depot_id == '') {
                        $json['message'] = "Veuillez choisir un point de vente!";
                    } else {
                        $lib = 'BS_STK';
                        $bloc_affiche = $_POST['affichage'];
                        $num_cmd = getnumerotation($hotel_id, $lib, $bdd);
                        $num_cmd_format = format_numero($num_cmd);
                        $numbon = $num_cmd_format;
                        $beneficiere = $_POST['posname'];
                        $type = 'transfert';
                        $motif_fiche = 'sortie';
                        $approuve = 1; //transfert direct avec validation
                        $source_id = $_POST['source_id'];
                        $motifappro = '';
                        //$source_id = GetDepotCentral_id($_SESSION['id_hotel'], $bdd);
                        $fiche_id = CreateBonStk($numbon, $type, $motif_fiche, $beneficiere, $depot_id, $user_id, $hotel_id, $nbArticles, $dte, $dte_time, $approuve, $motifappro, $bdd);
                        for ($i = 0; $i <= $nbArticles - 1; $i++) {
                            $motif_id = $_SESSION['panier']['idmotif'][$i];
                            if ($motif_id == 7) {
                                $prod_id = $_SESSION['panier']['id_article'][$i];
                                $qte_envoye = $_SESSION['panier']['qte'][$i];
                                $qte_verif = 0;
                                $designation = $_SESSION['panier']['nom'][$i];
                                $unite = $_SESSION['panier']['unite'][$i];
                                $produit_id = $prod_id;
                                $qte_recue = 0;
                                $ecart = $qte_envoye;
                                SortieStk($qte_envoye, 0, $dte, $prod_id, $motif_id, $fiche_id, $source_id, $user_id, $hotel_id, $bdd);
                                ApprovisionnementStk($qte_envoye, $dte, $prod_id, $fiche_id, $depot_id, $user_id, $hotel_id, $motif_id, $bdd);
                                CreateValidationStk($qte_envoye, $qte_verif, $motif_id, $produit_id, $fiche_id, $hotel_id, $bdd);
                                sessionDetailsBon($produit_id, $designation, $qte_envoye, $qte_recue, $ecart, $unite, ' ');
                            }
                        }
                        setnumerotation($hotel_id, $lib, $num_cmd + 1, $bdd);
                        $statut = '0';
                        sessionInfoBon($numbon, dateAffiche($dte), $user, $beneficiere, $statut);
                        $panier->annuler();
                        $json['message'] = "Le transfert vient de s'effectuer avec succès!";
                        $json['bloc_affiche'] = $bloc_affiche;
                        $json['s'] = TRUE;
                    }
                } elseif ($action2 == 'approupdate') {
                    $dte = $_POST['dte'];
                    $motifappro = $_POST['motifappro'];
                    $type = 'appro';
                    $lib = 'BE_STK';
                    // $num_cmd = getnumerotation($hotel_id, $lib, $bdd);
                    // $num_cmd_format = format_numero($num_cmd);
                    // $numbon = $num_cmd_format;
                    $numbon = $_POST['numbon'];
                    $motif_id = GetMotifMouvement($type, $bdd);
                    //$depot_id = GetDepotCentral_id($hotel_id,$bdd);
                    $depot_id = $_POST['emplacement_id'];
                    $beneficiere = $_POST['beneficiere'];
                    $approuve = 1;
                    $motif_fiche = 'appro';
                    $fiche_id = $_POST['fiche_id'];
                    //$fiche_id = CreateBonStk($numbon, $type, $motif_fiche, $beneficiere, $depot_id, $user_id, $hotel_id, $nbArticles, $dte, $dte_time, $approuve, $motifappro, $bdd);
                    $requete = $bdd->prepare("UPDATE skt_fiche  SET nbrprod=:nbrprod,motifappro=:motifappro,user_id=:user_id WHERE id_fiche=:id_fiche");
                    $requete->BindParam(':nbrprod', $nbArticles);
                    $requete->BindParam(':motifappro', $motifappro);
                    $requete->BindParam(':user_id', $user_id);
                    $requete->BindParam(':id_fiche', $fiche_id);
                    $requete->execute();
                    $requete = $bdd->prepare("DELETE FROM stk__mouvement WHERE fiche_id=:fiche_id");
                    $requete->BindParam(':fiche_id', $fiche_id);
                    $requete->execute();
                    for ($i = 0; $i <= $nbArticles - 1; $i++) {
                        $prod_id = $_SESSION['panier']['id_article'][$i];
                        $designation = $_SESSION['panier']['nom'][$i];
                        $qte = $_SESSION['panier']['qte'][$i];
                        $unite = $_SESSION['panier']['unite'][$i];
                        $produit_id = $prod_id;
                        $ecart = 0;
                        $qte_envoye = $qte;
                        $qte_recue = 0;
                        ApprovisionnementStk($qte, $dte, $prod_id, $fiche_id, $depot_id, $user_id, $hotel_id, $motif_id, $bdd);
                        sessionDetailsBon($produit_id, $designation, $qte_envoye, $qte_recue, $ecart, $unite, ' ');
                    }
                    // setnumerotation($hotel_id, $lib, $num_cmd + 1, $bdd);
                    $statut = '1';
                    sessionInfoBon($numbon, dateAffiche($dte), $user, $beneficiere, $statut);
                    $panier->annuler();
                    $json['message'] = "La modification vient de s'effectuer avec succès!";
                    $json['s'] = TRUE;
                    //}

                } elseif ($action2 == 'sortieupdate') {
                    // $lib = 'BS_STK';
                    $bloc_affiche = $_POST['affichage'];
                    // $num_cmd = getnumerotation($hotel_id, $lib, $bdd);
                    // $num_cmd_format = format_numero($num_cmd);
                    // $numbon = $num_cmd_format;
                    $numbon = $_POST['numbon'];
                    $beneficiere = $_POST['benef'];
                    $type = 'sortie';
                    $motif_fiche = 'sortie';
                    $approuve = 1;
                    $depot_id = $_POST['emplacement_id'];
                    $motifappro = '';
                    //$depot_id = GetDepotCentral_id($_SESSION['id_hotel'], $bdd);
                    // $fiche_id = CreateBonStk($numbon, $type, $motif_fiche, $beneficiere, $depot_id, $user_id, $hotel_id, $nbArticles, $dte, $dte_time, $approuve, $motifappro, $bdd);
                    $fiche_id = $_POST['fiche_id'];
                    $requete = $bdd->prepare("UPDATE skt_fiche  SET depot_id=:depot_id,beneficiere=:beneficiere,user_id=:user_id WHERE id_fiche=:id_fiche");
                    $requete->BindParam(':depot_id', $depot_id);
                    $requete->BindParam(':beneficiere', $beneficiere);
                    $requete->BindParam(':user_id', $user_id);
                    $requete->BindParam(':id_fiche', $fiche_id);
                    $requete->execute();
                    $requete = $bdd->prepare("DELETE FROM stk__mouvement WHERE fiche_id=:fiche_id");
                    $requete->BindParam(':fiche_id', $fiche_id);
                    $requete->execute();
                    for ($i = 0; $i <= $nbArticles - 1; $i++) {
                        $idmotif = $_SESSION['panier']['idmotif'][$i];
                        if ($idmotif != 7) {
                            $prod_id = $_SESSION['panier']['id_article'][$i];
                            $qte = $_SESSION['panier']['qte'][$i];
                            $libelle_sortie = GetLibMotifSortie($idmotif, $bdd);
                            if ($idmotif == 1 || $idmotif == 5) {
                                $quantite = $qte;
                                $qte_declasse = 0;
                            } else {
                                $quantite = 0;
                                $qte_declasse = $qte;
                            }
                            $designation = $_SESSION['panier']['nom'][$i];
                            $unite = $_SESSION['panier']['unite'][$i];
                            $produit_id = $prod_id;
                            $ecart = 0;
                            $qte_envoye = $qte;
                            $qte_recue = 0;
                            SortieStk($quantite, $qte_declasse, $dte, $prod_id, $idmotif, $fiche_id, $depot_id, $user_id, $hotel_id, $bdd);
                            sessionDetailsBon($produit_id, $designation, $qte_envoye, $qte_recue, $ecart, $unite, $libelle_sortie);
                        }
                    }
                    //setnumerotation($hotel_id, $lib, $num_cmd + 1, $bdd);
                    $statut = '1';
                    sessionInfoBon($numbon, dateAffiche($dte), $user, $beneficiere, $statut);
                    $panier->annuler();
                    $json['message'] = "La modification vient de s'effectuer avec succès!";
                    $json['bloc_affiche'] = $bloc_affiche;
                    $json['s'] = TRUE;
                }
            }
            echo json_encode($json);
        } elseif ($action == 'del_mvt_fiche') {
            $fiche_id = $_GET['fiche_id'];
            $requete = $bdd->prepare("DELETE FROM skt_fiche WHERE id_fiche=:fiche_id");
            $requete->BindParam(':fiche_id', $fiche_id);
            $requete->execute();
            $json['s'] = TRUE;
        }
    }
}
