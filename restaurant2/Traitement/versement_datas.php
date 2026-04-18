
<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include('./func_versement.php');
        $requete = $bdd->prepare("SELECT uti.id_user,CONCAT(uti.prenom_user,' ',uti.nom_user) AS user,res.dte_a,SUM(reg.montant_dollar) AS montant_USD,SUM(reg.montant_fc) AS montant_CDF FROM t_reservation AS res,t_facture AS fac, t_reglement AS reg,t_utilisateur AS uti WHERE res.id_res=fac.id_res AND fac.id_fact=reg.id_fact AND uti.id_user=fac.id_user AND reg.rejete=0 AND res.id_hotel=:hotel_id AND fac.id_user=:id_user GROUP BY res.dte_a ORDER BY res.dte_a DESC ");
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        $requete->BindParam(':id_user', $_SESSION['id_user']);
        $requete->execute();
        $commandes = $requete->fetchAll(PDO::FETCH_OBJ);
        $i = 1;
        $id_hotel=$_SESSION['id_hotel'];
        $montantFCUSD=0;
        $montantUSDFC=0;
        $montant=0;
        $montant_tot=0;
        foreach ($commandes as $cmd):
            $statut =StatutVersement($cmd->id_user,$cmd->dte_a,$id_hotel,$bdd);
            $montant_tot=$cmd->montant_USD + ($cmd->montant_CDF * 1 / $tauxdollar);
            if ($m_affiche == 'USD') {
                $montantFCUSD = $cmd->montant_CDF * 1 / $tauxdollar;
                $montant = $cmd->montant_USD + $montantFCUSD;
            } else if ($m_affiche == 'CDF') {
                $montantUSDFC =$cmd->montant_USD * $tauxdollar;
                $montant = $cmd->montant_CDF + $montantUSDFC;
            }
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $i; ?></td>
                <td style="text-align: center;"><?php echo $cmd->user; ?></td>
                <td style="text-align: center;"><?php echo $cmd->dte_a; ?> </td>
                <td style="text-align: center;"><?php echo $montant.'  '.$m_affiche; ?></td>
                <td style="text-align: center;"><?php echo $statut; ?></td>
                <td style="text-align: center;">
                    <?php
                    if($statut=='Versé'){
                        ?>
                        <span>Pas d'action</span>
                        <?php
                    }else{
                        if($m_affiche=='USD'){
                            $m_affiche_eq='CDF';
                            $montant_eq=$montant*$tauxdollar;
                        }else{
                            $m_affiche_eq='USD';
                            $montant_eq=$montant/$tauxdollar;
                        }
                        ?>
                        <a class="btn btn-primary btn-sm btn_pop_up_vers" href="#" data-toggle="modal" data-target="#myModal_versement" tot="<?php echo $montant_tot;?>" amount="<?php echo $montant;?>" amounte="<?php echo $montant_eq;?>" dte="<?php echo $cmd->dte_a; ?>" mon="<?php echo $m_affiche; ?>" mone="<?php echo $m_affiche_eq; ?>">Verser</a>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
            $i++;
        endforeach;
            ?>
