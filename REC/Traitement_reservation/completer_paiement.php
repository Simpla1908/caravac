<?php

// Initialisation de la session
session_start();
require '../../bdd/connexion.php';
include '../Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../../FUNCTION/hebergement.php';
include '../Amelioration/reglage/monnaie.php';
include '../../souscription/select_data_motif.php';
if (empty($_POST['mode']) && (empty($_POST['montantUSD']) || empty($_POST['montantFC']))) {
    echo 1;
} else {
    if (isset($_POST['mode']) && isset($_POST['montantUSD']) && isset($_POST['montantFC']) && isset($_POST['reste']) && isset($_POST['num_fact']) && isset($_POST['id_fact']) && isset($_POST['id_ch']) && isset($_POST['id_res']) && isset($_POST['id_client'])) {
        $rejete=0;
        $monnaie=NULL;
        $mode = $_POST['mode'];
        $typecl = $_POST['type_cl'];
        $mont_saisi_usd = $_POST['montantUSD'];
        $mont_saisi_fc = $_POST['montantFC'];
        $justif = $_POST['justif'];
//    $reservation=$_POST['reservation'];
        $reste_heb_resto = $_POST['reste'];
        $num_fact = $_POST['num_fact'];
        $id_fact = $_POST['id_fact'];
        $id_ch = $_POST['id_ch'];
        $id_client = $_POST['id_client'];
        $id_res = $_POST['id_res'];
        //nouveaux codes sources
        //variable utilisée pour l'insertion caisse
        $operation_caisse='entree';
        //$sql = 'SELECT * FROM v_reglement WHERE id_respo=:id_respo';
        $sql="SELECT d.montant_total,SUM(montant_dollar) AS montant_dollar,SUM(montant_fc) AS montant_fc,a.id_hotel,a.id_client,a.nom_client,d.id_fact,d.num_fact,d.date_edition,d.type AS typefact,d.mont_ttc_remise
         FROM t_client AS a,t_reserve_chambre AS c, t_facture AS d, t_reglement AS f, t_mode_reglement AS g
         WHERE  c.id_client=a.id_client
               AND c.id=d.res_ch_id
               AND d.id_fact=f.id_fact
               AND f.id_mode_regl=g.id_mode_regl
               AND a.id_client=:id_client
               GROUP BY f.id_fact";
        $requete = $bdd->prepare($sql);
        $requete->BindParam(':id_client', $id_client);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
        $montant_saisi = round(affiche_montant('USD', $tauxdollar, $mont_saisi_fc, $mont_saisi_usd),2);
        $bool=0;
        var_dump($result);
        foreach ($result as $r){
            if($r->typefact=='restaurant'){
                // A enlever
                $motif_id=$motif_id_resto;
                $montant_total =round( affiche_montant('USD', $tauxdollar, 0, $r->mont_ttc_remise),2);
                $libelle='resto';
            }else{
                // A enlever
                $motif_id=$motif_id_heb;
                $montant_total =round( affiche_montant('USD', $tauxdollar, 0, $r->montant_total),2);
                $libelle='Heberge';
            }

            $montant_paye = round(affiche_montant('USD', $tauxdollar, $r->montant_fc, $r->montant_dollar),2);
            $mont_saisi_fc_dollar = round(affiche_montant('USD', $tauxdollar,$mont_saisi_fc,0),2);
            $reste = $montant_total - $montant_paye;
            //if ($montant_saisi > 0 && $montant_saisi - $reste >= 0) {

            if ($mont_saisi_usd >= $reste) {
                $mont_saisi_usd = $mont_saisi_usd - $reste;
                $montantUSD_paye = $reste;
                $montantFC_paye = 0;

            }else{
                $som_mont_usd_reste=$mont_saisi_usd + $mont_saisi_fc_dollar;
                if($som_mont_usd_reste >= $reste){
                    $mont_reste_cdf=$reste - $mont_saisi_usd;
                    $montantUSD_paye = $mont_saisi_usd;
                    $montantFC_paye = $mont_reste_cdf*$tauxdollar;
                    $mont_saisi_usd=0;
                    $mont_saisi_fc_dollar=$mont_saisi_fc_dollar - $mont_reste_cdf;
                }else{
                    $montantUSD_paye = $mont_saisi_usd;
                    $montantFC_paye = $mont_saisi_fc_dollar*$tauxdollar;
                    $bool=1;
                }
            }
            /* Insertion dans t_reglement */
            //CASH
            $requete = $bdd->prepare("INSERT INTO  t_reglement (montant_fc,montant_dollar,reste,id_mode_regl,date_regl,id_fact,id_monnaie,id_user,id_hotel)
			                    VALUES(:montant_fc,:montant_dollar,:reste,:id_mode_regl,:date_regl,:id_fact,:id_monnaie,:id_user,:id_hotel)");
            $dte_regl = date('Y-m-d H:i:s');
            //valeur erronée  Reste c donné sans calcul
            $reste = 0;
            //Fin valeur erronée
            $requete->BindParam(':montant_fc', $montantFC_paye);
            $requete->BindParam(':montant_dollar', $montantUSD_paye);
            $requete->BindParam(':reste', $reste);
            $requete->BindParam(':id_mode_regl', $mode);
            $requete->BindParam(':date_regl', $dte_regl);
            $requete->BindParam(':id_fact', $r->id_fact);
            $requete->BindParam(':id_monnaie',$monnaie);
            $requete->BindParam(':id_user',$iduser);
            $requete->BindParam(':id_hotel',$idhotel);
            $requete->execute();

            $montantUSD=$montantUSD_paye;
            $montantFC=$montantFC_paye;
            $operation_caisse = 'entree';
            include '../Amelioration/caisse/caisse_insertion_global.php';
            if($typecl=='client partenaire'){
                //Credit
                $mode_credit=3;
                $val_rejeter=1;
                $requete = $bdd->prepare("INSERT INTO  t_reglement (montant_fc,montant_dollar,reste,id_mode_regl,date_regl,id_fact,id_monnaie,id_user,id_hotel,rejete)
			                    VALUES(:montant_fc,:montant_dollar,:reste,:id_mode_regl,:date_regl,:id_fact,:id_monnaie,:id_user,:id_hotel,:rejete)");
                $dte_regl = date('Y-m-d H:i:s');
                //valeur erronée  Reste c donné sans calcul
                $reste = 0;
                //Fin valeur erronée
                $requete->BindParam(':montant_fc', $montantFC_paye);
                $requete->BindParam(':montant_dollar', $montantUSD_paye);
                $requete->BindParam(':reste', $reste);
                $requete->BindParam(':id_mode_regl', $mode_credit);
                $requete->BindParam(':date_regl', $dte_regl);
                $requete->BindParam(':id_fact', $r->id_fact);
                $requete->BindParam(':id_monnaie',$monnaie);
                $requete->BindParam(':id_user',$iduser);
                $requete->BindParam(':id_hotel',$idhotel);
                $requete->BindParam(':rejete',$val_rejeter);
                $requete->execute();
            }

            if ($bool==1){
                break;
            }
            // }

        }
        //fin
//nos codes precedents
        /*      $mont_fc_heb_insert = 0;
              $mont_usd_heb_insert = 0;

              $montant_ttc_fc_usd = $montantFC / $tauxdollar;
              $mont_ttc_usd = $montantUSD + $montant_ttc_fc_usd;
              if ($mont_ttc_usd == $reste_heb_resto) {


                  $requete_resto = $bdd->prepare("SELECT SUM(mont_ttc_remise) AS montant_resto
                  FROM t_reservation AS b, t_facture AS c
                  WHERE b.id_res=c.id_res
                  AND b.id_hotel=:id_hotel
                  AND b.type='commande'
                  AND b.etat_credit='credit'
                  AND b.id_client=:client_id ");
                  $requete_resto->BindParam(':id_hotel', $_SESSION['id_hotel']);
                  $requete_resto->BindParam(':client_id', $id_client);
                  $requete_resto->execute();
                  $restaurant = $requete_resto->fetchAll(PDO::FETCH_OBJ);
                  foreach ($restaurant as $resto) {
                      $montant_cmd_resto = $resto->montant_resto;
                  }
                  $montant_cmd_resto = $montant_cmd_resto / $tauxdollar;
                  $reste_heb_usd = $reste_heb_resto - $montant_cmd_resto;
                  $reste_resto_usd = $montant_cmd_resto;



                  if ($montantUSD == $reste_heb_usd) {

                      $mont_usd_heb_insert = $montantUSD;
                      $mont_fc_heb_insert = 0;

                      $mont_usd_resto_insert = 0;
                      $mont_fc_resto_insert = $montantFC;
                  } elseif ($montantUSD > $reste_heb_usd) {

                      $mont_usd_heb_insert = $reste_heb_usd;
                      $mont_fc_heb_insert = 0;

                      $mont_usd_resto_insert = $montantUSD - $reste_heb_usd;
                      $mont_fc_resto_insert = $montantFC;
                  } else {

                      $mont_usd_heb_insert = $montantUSD;
                      $diff_usd = $reste_heb_usd - $montantUSD;
                      $diff_fc = $diff_usd * $tauxdollar;

                      $mont_fc_heb_insert = $diff_fc;
                      $mont_usd_resto_insert = 0;
                      $mont_fc_resto_insert = $montantFC - $diff_fc;
                  }
                  echo 'reste_heb_usd:' . $reste_heb_usd . ' ' . 'reste_resto_usd:' . $reste_resto_usd . '<br>';

                  echo 'mont_usd_heb_insert:' . $mont_usd_heb_insert . ' ' . 'mont_fc_heb_insert:' . $mont_fc_heb_insert;
                  $dte_regl = date('Y-m-d H:i:s', time() + 7200);
                  $reste = 0;

      //Insertion pour l'hebergement
                  //CASH
                  $requete = $bdd->prepare("INSERT INTO  t_reglement (montant_fc,montant_dollar,reste,id_mode_regl,date_regl,id_fact,id_monnaie,id_user,id_hotel,rejete)
              VALUES(:montant_fc,:montant_dollar,:reste,:id_mode_regl,:date_regl,:id_fact,:id_monnaie,:id_user,:id_hotel,:rejete)");
                  $requete->BindParam(':montant_fc', round($mont_fc_heb_insert,2));
                  $requete->BindParam(':montant_dollar',round($mont_usd_heb_insert,2));
                  $requete->BindParam(':reste', round($reste,2));
                  $requete->BindParam(':id_mode_regl', $mode);
                  $requete->BindParam(':date_regl', $dte_regl);
                  $requete->BindParam(':id_fact', $id_fact);
                  $requete->BindParam(':id_monnaie', $monnaie);
                  $requete->BindParam(':id_user', $_SESSION['id_user']);
                  $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                  $requete->BindParam(':rejete',$rejete);
                  $requete->execute();
                  //credit
                  $requete = $bdd->prepare("INSERT INTO  t_reglement (montant_fc,montant_dollar,reste,id_mode_regl,date_regl,id_fact,id_monnaie,id_user,id_hotel,rejete)
                          VALUES(:montant_fc,:montant_dollar,:reste,:id_mode_regl,:date_regl,:id_fact,:id_monnaie,:id_user,:id_hotel,:rejete)");
                  $rejete_credit=1;
                  $mode_credit=3;
                  $requete->BindParam(':montant_fc', round($mont_fc_heb_insert,2));
                  $requete->BindParam(':montant_dollar',round($mont_usd_heb_insert,2));
                  $requete->BindParam(':reste', round($reste,2));
                  $requete->BindParam(':id_mode_regl', $mode_credit);
                  $requete->BindParam(':date_regl', $dte_regl);
                  $requete->BindParam(':id_fact', $id_fact);
                  $requete->BindParam(':id_monnaie', $monnaie);
                  $requete->BindParam(':id_user', $_SESSION['id_user']);
                  $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                  $requete->BindParam(':rejete',$rejete_credit);
                  $requete->execute();

                  $statut = 'occupe';
                  $requete = $bdd->prepare("UPDATE t_reserve_chambre  SET mont_paye_heb=mont_paye_heb+:mont_paye_heb,mont_paye_resto=mont_paye_resto+:mont_paye_resto
                                       WHERE idreserv=:idreserv AND idchambre=:idchambre AND statut=:statut ");

                  $requete->BindParam(':idreserv', $id_res);
                  $requete->BindParam(':idchambre', $id_ch);
                  $requete->BindParam(':statut', $statut);
                  $requete->BindParam(':mont_paye_heb', $reste_heb_usd);
                  $requete->BindParam(':mont_paye_resto', $reste_resto_usd);
                  $requete->execute();



                  //Query Restaurant
                  $requete_resto = $bdd->prepare("SELECT id_fact, mont_ttc_remise
      FROM t_reservation AS b, t_facture AS c
      WHERE b.id_res=c.id_res
      AND b.id_hotel=:id_hotel
      AND b.type='commande'
      AND b.etat_credit='credit'
      AND b.id_client=:client_id ");
                  $requete_resto->BindParam(':id_hotel', $_SESSION['id_hotel']);
                  $requete_resto->BindParam(':client_id', $id_client);
                  $requete_resto->execute();
                  $restaurant = $requete_resto->fetchAll(PDO::FETCH_OBJ);
                  $i = 0;
                  foreach ($restaurant as $resto) {
                      $id_facture = $resto->id_fact;
                      $montant_resto = $resto->mont_ttc_remise;


                      if ($montantUSD == $reste_heb_usd) {


                          $mont_usd_resto_insert = 0;
                          $mont_fc_resto_insert = $montant_resto;

                          //Insertion pour le restaurant
                          $requete = $bdd->prepare("INSERT INTO  t_reglement (montant_fc,montant_dollar,reste,id_mode_regl,date_regl,id_fact,id_monnaie,id_user,id_hotel,rejete)
              VALUES(:montant_fc,:montant_dollar,:reste,:id_mode_regl,:date_regl,:id_fact,:id_monnaie,:id_user,:id_hotel,:rejete)");

                          $requete->BindParam(':montant_fc', round($mont_fc_resto_insert,2));
                          $requete->BindParam(':montant_dollar', round($mont_usd_resto_insert,2));
                          $requete->BindParam(':reste',round($reste,2));
                          $requete->BindParam(':id_mode_regl', $mode);
                          $requete->BindParam(':date_regl', $dte_regl);
                          $requete->BindParam(':id_fact', $id_facture);
                          $requete->BindParam(':id_monnaie', $monnaie);
                          $requete->BindParam(':id_user', $_SESSION['id_user']);
                          $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                          $requete->BindParam(':rejete',$rejete);
                          $requete->execute();
                          //credit
                          $requete = $bdd->prepare("INSERT INTO  t_reglement (montant_fc,montant_dollar,reste,id_mode_regl,date_regl,id_fact,id_monnaie,id_user,id_hotel,rejete)
                          VALUES(:montant_fc,:montant_dollar,:reste,:id_mode_regl,:date_regl,:id_fact,:id_monnaie,:id_user,:id_hotel,:rejete)");
                          $rejete_credit=1;
                          $mode_credit=3;
                          $requete->BindParam(':montant_fc', round($mont_fc_resto_insert,2));
                          $requete->BindParam(':montant_dollar', round($mont_usd_resto_insert,2));
                          $requete->BindParam(':reste',round($reste,2));
                          $requete->BindParam(':id_mode_regl',$mode_credit);
                          $requete->BindParam(':date_regl', $dte_regl);
                          $requete->BindParam(':id_fact', $id_facture);
                          $requete->BindParam(':id_monnaie', $monnaie);
                          $requete->BindParam(':id_user', $_SESSION['id_user']);
                          $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                          $requete->BindParam(':rejete',$rejete_credit);
                          $requete->execute();
                      } elseif ($montantUSD > $reste_heb_usd) {

                          $montant_resto_fc_usd = $montant_resto / $tauxdollar;

      //    $mont_usd_resto_insert = $montantUSD - $reste_heb_usd;
      //    $mont_fc_resto_insert=$montantFC;

                          if ($mont_usd_resto_insert == $montant_resto_fc_usd) {
                              $montant_cmd_usd = $mont_usd_resto_insert;
                              $montant_cmd_fc = 0;
      //        $mont_usd_resto_insert=$mont_usd_resto_insert-$montant_resto_fc_usd;
                          } elseif ($mont_usd_resto_insert < $montant_resto_fc_usd) {
                              $diff_dol = $montant_resto_fc_usd - $mont_usd_resto_insert;
                              $diff_franc = $diff_dol * $tauxdollar;
                              $montant_cmd_usd = $mont_usd_resto_insert;
                              $montant_cmd_fc = $diff_franc;
                              $mont_fc_resto_insert = $mont_fc_resto_insert - $diff_franc;

      //        $mont_usd_resto_insert=$mont_usd_resto_insert-$montant_resto_fc_usd;
                          } elseif ($mont_usd_resto_insert == 0) {
                              $montant_cmd_usd = 0;
                              $montant_cmd_fc = $montant_resto;
      //        $mont_usd_resto_insert=$mont_usd_resto_insert-$montant_resto_fc_usd;
                              $mont_fc_resto_insert = $mont_fc_resto_insert - $montant_resto;
                          } elseif ($mont_usd_resto_insert > $montant_resto_fc_usd) {
                              $montant_cmd_usd = $montant_resto_fc_usd;
                              $montant_cmd_fc = 0;
      //        $mont_usd_resto_insert=$mont_usd_resto_insert-$montant_resto_fc_usd;
                          }
      //    $i=$i+1;
      //    echo 'i:'.$i.'<br>';
      //    echo 'montant_resto_fc_usd:'.$montant_resto_fc_usd.'<br>';
      //    echo 'mont_usd_resto_insert:'.$mont_usd_resto_insert.'<br>';
      //    echo 'montant_cmd_usd:'.$montant_cmd_usd.'<br>';
      //    echo 'montant_cmd_fc:'.$montant_cmd_fc.'<br>';
                          //Insertion pour le restaurant
                          //CASH
                          $requete = $bdd->prepare("INSERT INTO  t_reglement (montant_fc,montant_dollar,reste,id_mode_regl,date_regl,id_fact,id_monnaie,id_user,id_hotel,rejete)
              VALUES(:montant_fc,:montant_dollar,:reste,:id_mode_regl,:date_regl,:id_fact,:id_monnaie,:id_user,:id_hotel,:rejete)");

                          $requete->BindParam(':montant_fc', round($montant_cmd_fc,2));
                          $requete->BindParam(':montant_dollar',round($montant_cmd_usd,2));
                          $requete->BindParam(':reste',round($reste,2));
                          $requete->BindParam(':id_mode_regl',$mode);
                          $requete->BindParam(':date_regl', $dte_regl);
                          $requete->BindParam(':id_fact', $id_facture);
                          $requete->BindParam(':id_monnaie', $monnaie);
                          $requete->BindParam(':id_user', $_SESSION['id_user']);
                          $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                          $requete->BindParam(':rejete',$rejete);
                          $requete->execute();

                          //credit
                          $requete = $bdd->prepare("INSERT INTO  t_reglement (montant_fc,montant_dollar,reste,id_mode_regl,date_regl,id_fact,id_monnaie,id_user,id_hotel,rejete)
                          VALUES(:montant_fc,:montant_dollar,:reste,:id_mode_regl,:date_regl,:id_fact,:id_monnaie,:id_user,:id_hotel,:rejete)");
                          $rejete_credit=1;
                          $mode_credit=3;
                          $requete->BindParam(':montant_fc', round($montant_cmd_fc,2));
                          $requete->BindParam(':montant_dollar',round($montant_cmd_usd,2));
                          $requete->BindParam(':reste',round($reste,2));
                          $requete->BindParam(':id_mode_regl', $mode_credit);
                          $requete->BindParam(':date_regl', $dte_regl);
                          $requete->BindParam(':id_fact', $id_facture);
                          $requete->BindParam(':id_monnaie', $monnaie);
                          $requete->BindParam(':id_user', $_SESSION['id_user']);
                          $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                          $requete->BindParam(':rejete',$rejete_credit);
                          $requete->execute();
                          $mont_usd_resto_insert = $mont_usd_resto_insert - $montant_resto_fc_usd;
                      } else {

                          $mont_usd_heb_insert = $montantUSD;
                          $diff_usd = $reste_heb_usd - $montantUSD;
                          $diff_fc = $diff_usd * $tauxdollar;

                          $mont_fc_heb_insert = $diff_fc;
                          $mont_usd_resto_insert = 0;
                          $r = $montantFC - $diff_fc;
      //     $r=150000-143504;
                          $mont_fc_resto_insert = $r;


                          if ($mont_fc_resto_insert == $montant_resto) {
                              $montant_cmd_fc = $mont_fc_resto_insert;
      //         $mont_fc_resto_insert=$mont_fc_resto_insert-$montant_resto;
                          } elseif ($mont_fc_resto_insert < $montant_resto && $mont_fc_resto_insert != 0) {
                              $diff_dol = $montant_resto - $mont_fc_resto_insert;
                              $diff_franc = $diff_dol * $tauxdollar;
                              $montant_cmd_fc = $mont_fc_resto_insert;
                              $montant_cmd_fc = $diff_franc;
                              $mont_fc_resto_insert = $mont_fc_resto_insert - $diff_franc;
                              $montant_cmd_usd = 0;
      //        $mont_fc_resto_insert=$mont_fc_resto_insert-$montant_resto;
      //    }  elseif ($mont_fc_resto_insert==0) {
      //        $montant_cmd_usd=0;
      //        $montant_cmd_fc=$montant_resto;
      //        $mont_fc_resto_insert=$mont_fc_resto_insert-$montant_resto;
      //        $mont_fc_resto_insert=$mont_fc_resto_insert-$montant_resto;
                          } elseif ($mont_fc_resto_insert > $montant_resto) {
                              $montant_cmd_fc = $montant_resto;
                              $montant_cmd_usd = 0;
      //        $mont_fc_resto_insert=$mont_fc_resto_insert-$montant_resto;
                          }


                          $i = $i + 1;
                          echo '<br>' . 'i:' . $i . '<br>';
                          echo '$montant_resto:' . $montant_resto . '<br>';
                          echo 'montant_cmd_usd:' . $montant_cmd_usd . '<br>';
                          echo 'montant_cmd_fc:' . $montant_cmd_fc . '<br>';
                          echo '$mont_usd_heb_insert:' . $mont_usd_heb_insert . '<br>';
                          echo '$montantFC:' . $montantFC . '<br>';
                          echo '$diff_usd:' . $diff_usd . '<br>';
                          echo '$diff_fc:' . $diff_fc . '<br>';
                          echo '$mont_fc_resto_insert:' . $mont_fc_resto_insert . '<br>';

                          $requete = $bdd->prepare("INSERT INTO  t_reglement (montant_fc,montant_dollar,reste,id_mode_regl,date_regl,id_fact,id_monnaie,id_user,id_hotel,rejete)
              VALUES(:montant_fc,:montant_dollar,:reste,:id_mode_regl,:date_regl,:id_fact,:id_monnaie,:id_user,:id_hotel,:rejete)");
                          //cash
                          $requete->BindParam(':montant_fc', round($montant_cmd_fc,2));
                          $requete->BindParam(':montant_dollar',round($montant_cmd_usd,2));
                          $requete->BindParam(':reste', round($reste,2));
                          $requete->BindParam(':id_mode_regl', $mode);
                          $requete->BindParam(':date_regl', $dte_regl);
                          $requete->BindParam(':id_fact', $id_facture);
                          $requete->BindParam(':id_monnaie', $monnaie);
                          $requete->BindParam(':id_user', $_SESSION['id_user']);
                          $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                          $requete->BindParam(':rejete',$rejete);
                          $requete->execute();
                          //credit
                          $requete = $bdd->prepare("INSERT INTO  t_reglement (montant_fc,montant_dollar,reste,id_mode_regl,date_regl,id_fact,id_monnaie,id_user,id_hotel,rejete)
                          VALUES(:montant_fc,:montant_dollar,:reste,:id_mode_regl,:date_regl,:id_fact,:id_monnaie,:id_user,:id_hotel,:rejete)");
                          $rejete_credit=1;
                          $mode_credit=3;
                          $requete->BindParam(':montant_fc', round($montant_cmd_fc,2));
                          $requete->BindParam(':montant_dollar',round($montant_cmd_usd,2));
                          $requete->BindParam(':reste', round($reste,2));
                          $requete->BindParam(':id_mode_regl', $mode_credit);
                          $requete->BindParam(':date_regl', $dte_regl);
                          $requete->BindParam(':id_fact', $id_facture);
                          $requete->BindParam(':id_monnaie', $monnaie);
                          $requete->BindParam(':id_user', $_SESSION['id_user']);
                          $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                          $requete->BindParam(':rejete',$rejete_credit);
                          $requete->execute();
                          $mont_fc_resto_insert = $mont_fc_resto_insert - $montant_resto;
                      }
                  }
                  echo 3;
              } else {
                  echo 2;
              }*/
    }
}
//var_dump($_POST);