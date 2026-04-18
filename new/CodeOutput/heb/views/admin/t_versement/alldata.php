    <?php
    $fond_cdf = 0;
    $fond_usd = 0;
    $percu_cdf = 0;
    $percu_usd = 0;
    $rendu_cdf = 0;
    $rendu_usd = 0;
    if (in_array('VTVS', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) {
        $_SESSION['fdc'] = array();
        $_SESSION['fdc']['user'] = array();
        $_SESSION['fdc']['fond_cdf'] = array();
        $_SESSION['fdc']['fond_usd'] = array();
        $requete = $bdd->prepare("SELECT SUM(cdf) AS fond_cdf,SUM(usd) AS fond_usd,user_id
        FROM fondscaisse 
        WHERE dte BETWEEN :p_debut AND :p_fin 
        AND hotel_id=:id_hotel  AND type='hebergement' GROUP BY user_id,dte");
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
            $user_id = $r->user_id;
            $fond_cdf = $r->fond_cdf;
            $fond_usd = $r->fond_usd;
            if (!in_array($user_id, $_SESSION['fdc']['user'])) {
                array_push($_SESSION['fdc']['user'], $user_id);
                $_SESSION['fdc']['fond_cdf'][$user_id] = $fond_cdf;
                $_SESSION['fdc']['fond_usd'][$user_id] = $fond_usd;
            }
        }
        $requete3 = $bdd->prepare("SELECT a.date_vers,a.user_vers,b.prenom_user,b.nom_user,SUM(a.montant_vers) AS mont_cdf,SUM(a.montantusd) AS mont_usd,a.date_vers,b.nom_user
        FROM t_versement AS a,t_utilisateur AS b
        WHERE  a.user_vers=b.id_user AND a.date_vers BETWEEN :p_debut AND :p_fin 
        AND  a.id_hotel=:id_hotel AND a.type_vers='hebergement' GROUP BY a.date_vers,a.user_vers");
        $requete3->BindParam(':p_debut', $datedebut);
        $requete3->BindParam(':p_fin', $datefin);
        $requete3->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete3->execute();
        $result = $requete3->fetchAll(PDO::FETCH_OBJ);
    } elseif (in_array('VSPVS', $_SESSION['actions']['code_actions'])) {


        $requete3 = $bdd->prepare("SELECT a.date_vers,a.user_vers,b.prenom_user,b.nom_user,SUM(a.montant_vers) AS mont_cdf,SUM(a.montantusd) AS mont_usd,a.date_vers,b.nom_user
        FROM t_versement AS a,t_utilisateur AS b
        WHERE  a.user_vers=b.id_user AND a.user_vers=:id_user AND a.date_vers BETWEEN :p_debut AND :p_fin 
        AND  a.id_hotel=:id_hotel AND a.type_vers='hebergement' GROUP BY a.date_vers,a.user_vers");
        $requete3->BindParam(':id_user', $_SESSION['id_user']);
        $requete3->BindParam(':p_debut', $datedebut);
        $requete3->BindParam(':p_fin', $datefin);
        $requete3->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete3->execute();
        $result = $requete3->fetchAll(PDO::FETCH_OBJ);
    }


    ?>
    <table class="table table-striped table-bordered table-hover example1">
        <thead>
            <tr>
                <th>#</th>
                <th>Utilisateur</th>
                <th>Date</th>
                <th>Montant versé USD</th>
                <th>Montant versé CDF</th>
                <th>Ecart USD</th>
                <th>Ecart CDF</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tb_contenu">
            <?php
            $_SESSION['versement'] = array();
            $_SESSION['versement']['n'] = array();
            $_SESSION['versement']['util'] = array();
            $_SESSION['versement']['dte'] = array();
            $_SESSION['versement']['musd'] = array();
            $_SESSION['versement']['mcdf'] = array();
            $_SESSION['versement']['susd'] = array();
            $_SESSION['versement']['scdf'] = array();
            $_SESSION['versement']['etat'] = array();
            $i = 1;
            $totcdf = 0;
            $totusd = 0;
            $totcdf1 = 0;
            $totusd1 = 0;
            $musd = getsymbole_devise();
            $mcdf = getsymbole_local();
            $fond_cdf = 0;
            $fond_usd = 0;
            foreach ($result as $r) {
                $id_user = $r->user_vers;
                if (in_array('VTVS', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) {
                    if (in_array($id_user, $_SESSION['fdc']['user'])) {
                        $fond_cdf = $_SESSION['fdc']['fond_cdf'][$id_user];
                        $fond_usd = $_SESSION['fdc']['fond_usd'][$id_user];
                    } else {
                        $fond_cdf = 0;
                        $fond_usd = 0;
                    }
                } else {
                    $requete = $bdd->prepare("SELECT SUM(cdf) AS fond_cdf,SUM(usd) AS fond_usd
					FROM fondscaisse 
					WHERE dte BETWEEN :p_debut AND :p_fin AND user_id=:id_user
					AND hotel_id=:id_hotel AND type='hebergement' GROUP BY dte");
                    $requete->BindParam(':p_debut', $datedebut);
                    $requete->BindParam(':p_fin', $datefin);
                    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                    $requete->BindParam(':id_user', $_SESSION['id_user']);
                    $requete->execute();
                    $result = $requete->fetchAll(PDO::FETCH_OBJ);
                    foreach ($result as $r) {
                        $fond_cdf = $r->fond_cdf;
                        $fond_usd = $r->fond_usd;
                    }
                }
                $dte = $r->date_vers;
                $verser_usd = $r->mont_usd;
                $verser_cdf = $r->mont_cdf;
                $recette = TotSolde($id_user, $dte, $bdd);
                $percu_cdf = $recette['percu_cdf'];
                $percu_usd = $recette['percu_usd'];
                $rendu_cdf = $recette['rendu_cdf'];
                $rendu_usd = $recette['rendu_usd'];
                $remb_usd = $recette['remb_usd'];
                $remb_cdf = $recette['remb_cdf'];
                $averser_cdf = ($fond_cdf + $percu_cdf) - $rendu_cdf - $remb_cdf;
                $averser_usd = ($fond_usd + $percu_usd) - $rendu_usd - $remb_usd;
                $solde_usd = $averser_usd - $verser_usd;
                $solde_cdf = $averser_cdf - $verser_cdf;
                $noms_user = $r->prenom_user . ' ' . $r->nom_user;
                $totcdf += $solde_cdf;
                $totusd += $solde_usd;
                $totcdf1 += $verser_cdf;
                $totusd1 += $verser_usd;
                $etat = '';
                if ($solde_usd == $averser_usd && $solde_cdf == $averser_cdf) {
                    $etat = 'Pas versé';
                } else if ($solde_usd == 0 && $solde_cdf == 0) {
                    $etat = 'Versé';
                } else {
                    $etat = 'En cours';
                }

            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $noms_user ?></td>
                    <td><?php echo dateAffiche($dte) ?></td>
                    <td><?php echo afficheMontant2($musd, $verser_usd) ?></td>
                    <td><?php echo afficheMontant2($mcdf, $verser_cdf) ?></td>
                    <td><?php echo afficheMontant2($musd, $solde_usd) ?></td>
                    <td><?php echo afficheMontant2($mcdf, $solde_cdf) ?></td>

                    <td>
                        <a class="btn btn-info btn-xs" title='Details' href="./index.php?pg=admin&view=t_versement&do=detailsheb&noms_user=<?php echo $noms_user; ?>&user=<?php echo $id_user; ?>&dte=<?php echo $dte; ?>&fond_usd=<?php echo $fond_usd; ?>&fond_cdf=<?php echo $fond_cdf; ?>&percu_cdf=<?php echo $percu_cdf; ?>&percu_usd=<?php echo $percu_usd; ?>&rendu_usd=<?php echo $rendu_usd; ?>&rendu_cdf=<?php echo $rendu_cdf; ?>&remb_usd=<?php echo $remb_usd; ?>&remb_cdf=<?php echo $remb_cdf; ?>&averser_usd=<?php echo $averser_usd; ?>&averser_cdf=<?php echo $averser_cdf; ?>&verser_usd=<?php echo $verser_usd; ?>&verser_cdf=<?php echo $verser_cdf; ?>">
                            <i class="fa fa-eye fa-fw"></i> Détails
                        </a>
                    </td>

                </tr>
            <?php
                //Mise en session pour impression
                array_push($_SESSION['versement']['n'], $i);
                array_push($_SESSION['versement']['util'], $noms_user);
                array_push($_SESSION['versement']['dte'], dateAffiche($dte));
                array_push($_SESSION['versement']['musd'], afficheMontant2($musd, $verser_usd));
                array_push($_SESSION['versement']['mcdf'], afficheMontant2($mcdf, $verser_cdf));
                array_push($_SESSION['versement']['susd'], afficheMontant2($musd, $solde_usd));
                array_push($_SESSION['versement']['scdf'], afficheMontant2($mcdf, $solde_cdf));
                array_push($_SESSION['versement']['etat'], $etat);
                //fin mise en session
                $i++;
            }
            ?>

        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><b>Total</b></td>
                <td><b><?php echo afficheMontant2($musd, $totusd1) ?></b></td>
                <td><b><?php echo afficheMontant2($mcdf, $totcdf1) ?></b></td>
                <td><b><?php echo afficheMontant2($musd, $totusd) ?></b></td>
                <td><b><?php echo afficheMontant2($mcdf, $totcdf) ?></b></td>
                <td></td>
                <?php
                $_SESSION['totusd1'] = afficheMontant2($musd, $totusd1);
                $_SESSION['totcdf1'] = afficheMontant2($musd, $totcdf1);
                $_SESSION['totusd'] = afficheMontant2($musd, $totusd);
                $_SESSION['totcdf'] = afficheMontant2($musd, $totcdf);

                ?>
            </tr>
        </tfoot>
    </table>