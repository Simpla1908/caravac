<?php
include './Amelioration/reglage/recuperer_valeurs_reglages.php';
?>                                        

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Montant Total</th>
                    <th>Montant payé</th>
                    <th>Reste</th> 
                    <th>Employé</th>
                    <?php
                    if ($page == 'paiement') {
                        ?>
                        <th></th>
                        <?php
                    } else {
                        ?>

                        <?php
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $som_reste = 0;
                $som_mont_p = 0;
                /* Recuperation du paiement d'un client */
                $requete_paie = $bdd->prepare("SELECT a.nom_client, b.num_reserv,b.type,c.id_fact, c.num_fact, c.montant_total,d.id_regl, d.montant_dollar, d.montant_fc, d.reste, d.date_regl, CONCAT(e.nom_user,' ',e.prenom_user) AS employer FROM t_client AS a, t_reservation AS b, t_facture AS c, t_reglement AS d, t_utilisateur AS e 
												WHERE a.id_client=b.id_client 
												AND b.id_res=c.id_res 
												AND c.id_fact=d.id_fact 
												AND d.id_user=e.id_user
												AND c.num_fact=:num_fact");
                $requete_paie->BindParam(':num_fact', $num_fact);
                $requete_paie->execute();
                while ($donnees = $requete_paie->fetch()) {
                    ?>
                    <?php
                    $monnaie = 1;
                    $montant_tot = $donnees['montant_total'];
                    $montantUSD = $donnees['montant_dollar'];
                    $montantFC = $donnees['montant_fc'];
                    $reste = $donnees['reste'];
                    $date_regl = $donnees['date_regl'];

                    $employer = $donnees['employer'];
                    $nom_client = $donnees['nom_client'];

                    $num_fact = $donnees['num_fact'];
                    $type = $donnees['type'];
                    $id_fact = $donnees['id_fact'];
                    $id_regl = $donnees['id_regl'];

                    $_SESSION['id_fact'] = $id_fact;
                    $_SESSION['nom_client'] = $nom_client;
                    $_SESSION['num_fact'] = $num_fact;
                    $_SESSION['type'] = $type;
                    $_SESSION['reste'] = $reste;
                    $_SESSION['id_fact'] = $id_fact;
                    $_SESSION['montant_tot'] = $montant_tot;
                    
                    $_SESSION['id_regl'] = $id_regl;
                    //Selection  du taux de la monnaie dans la base
//													$taux = $bdd->prepare("SELECT taux FROM ` monnaie` 
//																		   WHERE id_monnaie=:id_monnaie");
//													$taux->BindParam(':id_monnaie', $monnaie);
//													$taux->execute();
//													
//													while ($donnees = $taux->fetch())
//													{						
//														$toDujr = $donnees['taux'];
//													}
                    //conversion montant FC en USD
                    $montantFC_en_USD = round($montantFC / $tauxdollar, 2);

                    //calcul du montant payer à partir du montantFC convertit en USD
                    $montant_paye = $montantUSD + $montantFC_en_USD;

                    if ($m_affiche == 'CDF') {
                        $montant_paye = round($montant_paye * $tauxdollar, 2);
                        $montant_tot = round($montant_tot * $tauxdollar, 2);
                        $reste=$montant_tot-$montant_paye;
                    } else {
                        $montant_paye = $montant_paye;
                        $montant_tot=$montant_tot;
                        $reste=$montant_tot-$montant_paye;
                    }
                    ?>
                    <?php
                    $date_regl1 = explode('-', $date_regl);
                    $date_regl_Heure = explode(' ', $date_regl1[2]);


                    $date_regl_expl = $date_regl_Heure[0] . '/' . $date_regl1[1] . '/' . $date_regl1[0] . ' ' . $date_regl_Heure[1];

                    $date_regl_compara = explode(' ', $date_regl);
                    $date_regl_compara1 = $date_regl_compara[0];

                    $date_op = date('Y-m-d');
                    //$date_regl_compara1='2015-11-26';
                    ?>
                    <?php
                    //$reste=$montant_tot-$montant_paye;
                    if ($reste != 0) {
                        ?>

                        <tr >
                            <td><?php echo $date_regl_expl; ?></td>
                            <td><?php echo $montant_tot .' '.$m_affiche; ?></td>
                            <td><?php echo $montant_paye .' '.$m_affiche; ?></td>
                            <td><?php echo $reste .' '.$m_affiche; ?></td>
                            <td><img src="../img/user1.png">&nbsp;<?php echo strtoupper($employer); ?></td>
        <?php
        if ($page == 'paiement') {
            ?>
                                <?php if (($date_op == $date_regl_compara1) && ($_SESSION['libe_droit'] == 'Receptionniste')) { ?>
                                    <td>
                                        <a href="rec_paiement_additif_facture _modif.php?num_fact=<?php echo $num_fact; ?>&nom_client=<?php echo $nom_client; ?>&type=<?php echo $_SESSION['type']; ?>&id_fact=<?php echo $id_fact; ?>&reste=<?php echo $reste; ?>&montant_tot=<?php echo $montant_tot; ?>"><img src="../img/edit.png" title="Modifier"></a>
                                    </td>
                <?php
            } else if ((date('Y-m-d') != $date_regl_compara1) && ($_SESSION['libe_droit'] == 'Receptionniste')) {
                ?>
                                    <td>
                                    </td>

                <?php
            }
            ?>

                                <?php
                            } else {
                                ?>


                                <?php
                            }
                            ?>

                        </tr>
                            <?php
                        } else {
                            ?>
                        <tr>
                        <tr >
                            <td><?php echo $date_regl_expl; ?></td>
                            <td><?php echo $montant_tot .' '.$m_affiche; ?></td>
                            <td><?php echo $montant_paye .' '.$m_affiche; ?></td>
                            <td><?php echo $reste .' '.$m_affiche; ?></td>
                            <td><img src="../img/user1.png">&nbsp;<?php echo strtoupper($employer); ?></td>
        <?php
        if ($page == 'paiement') {
            ?>
                                <?php if (($date_op == $date_regl_compara1) && ($_SESSION['libe_droit'] == 'Receptionniste')) { ?>
                                    <td>
                                        <a href="rec_paiement_additif_facture _modif.php?num_fact=<?php echo $num_fact; ?>&nom_client=<?php echo $nom_client; ?>&type=<?php echo $type; ?>&id_fact=<?php echo $id_fact; ?>&reste=<?php echo $reste; ?>&montant_tot=<?php echo $montant_tot; ?>"><img src="../img/edit.png" title="Modifier"></a>
                                    </td>
                                    <?php
                                } else if ((date('Y-m-d') != $date_regl_compara1) && ($_SESSION['libe_droit'] == 'Receptionniste')) {
                                    ?>
                                    <td>
                                    </td>

                                    <?php
                                }
                                ?>

                                <?php
                            } else {
                                ?>


                                <?php
                            }
                            ?>
                        </tr>
                            <?php
                        }
                        ?>


                    <?php
                    $i++;
                    if ($m_affiche == 'CDF') {
                        $som_mont_p = $som_mont_p + $montant_paye;
                        $som_reste = $som_reste + $reste;
                    } else {
                        $som_mont_p = $som_mont_p + $montant_paye;
                        $som_reste = $som_reste + $reste;
                    }

                }
                /* Fin de la Recuperation du paiement d'un client */
                ?>
            </tbody>
            <tfoot>
            <tr style="color:#ff1b2d;">
                <th colspan="2">Total</th>

                <th><?php echo $som_mont_p.' '.$m_affiche; ?></th>
                <th>
                <?php
                if ($reste == 0) {
                    echo' ';
                } else {
                    echo $reste.' '.$m_affiche;
                }
                ?>
                </th> 
                <th colspan="2"></th>
            </tr>
            <?php //test du statut 
            if ($statut_res == 'annulee') { 
            ?>
            <tr>
                <th colspan="5" class="text-danger">Detail après annulation de cette réservation</th>
            </tr>
                <?php
                $requete_paie = $bdd->prepare("SELECT * FROM t_annule_reservation WHERE id_res=:id_res");
                $requete_paie->BindParam(':id_res', $_GET['id_res']);
                $requete_paie->execute();
                $hebergement = $requete_paie->fetchAll(PDO::FETCH_OBJ);
                foreach ($hebergement as $heb) {
                    $Montant_retirer = $heb->Montant_retirer;
                    $poucentage = $heb->poucentage;
                    $mont_remb = $heb->mont_remb;
                }
                ?>
            <tr>
                <td colspan="2" align='right'><i>Montant retiré</i></td>

                <td><?php echo $Montant_retirer.' '.$m_affiche; ?></td>
                <td></td> 
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="2"><i>Pourcentage appliqué</i></td>

                <td><?php echo $poucentage.'%'; ?></td>
                <td></td> 
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="2"><i>Montant rembourssé</i></td>

                <td><?php echo $mont_remb.' '.$m_affiche; ?></td>
                <td></td> 
                <td colspan="2"></td>
            </tr>
            
            <?php } ?>
            </tfoot>
        </table>

    </div>


