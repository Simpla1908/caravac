<?php
ini_set('display_errors',1);
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
include('../bdd/connexion.php');
$type='restaurant';
include_once '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include_once '../../FUNCTION/hebergement.php';
$dte_bd1=$dte_bd2=  date('Y-m-d');
$periode="Aujourd'hui ".  dateAffiche(date('Y-m-d'));
if (isset($_POST['periode'])&&isset($_POST['current'])) {
    $periode = $_POST['periode'];
    $current = $_POST['current'];
    /* Conversion periode */
    $transpostion_periode = explode(' ', $periode);
    $date1 = $transpostion_periode[0];
    $caractere = $transpostion_periode[1];
    $date2 = $transpostion_periode[2];
    /* Conversion date1 */
    $transpostion_date1 = explode('/', $date1);
    $jour = $transpostion_date1[0];
    $mois = $transpostion_date1[1];
    $annee = $transpostion_date1[2];
    $dte_bd1 = $annee . '-' . $mois . '-' . $jour;
    /* Conversion date2 */
    $transpostion_date2 = explode('/', $date2);
    $jour2 = $transpostion_date2[0];
    $mois2 = $transpostion_date2[1];
    $annee2 = $transpostion_date2[2];
    $dte_bd2 = $annee2 . '-' . $mois2 . '-' . $jour2;
}
?>

<div class="box-header">
    <div class="col-lg-10">
        <h3 class="box-title">
            Mouvement Financier
            <small>(<?php echo $periode; ?>)</small>
        </h3>
    </div>
    <div class="col-lg-2 text-center">
        <a class="btn btn-default" href="impression/examples/mouvement_financier.php?dte_bd1=<?php echo $dte_bd1?>&dte_bd2=<?php echo $dte_bd2?>" 
           target="_blank"><i class="fa fa-print fa-fw"></i>&nbsp;Imprimer</a>
    </div>
</div>
<!-- /.box-header -->
<div class="box-body">
<table id="example6" class="table table-bordered table-striped table-hover matable table-condensed">
    <thead>
        <tr>
            <th style="text-align: center;">N°</th>
            <th style="text-align: center;">Date</th>
            <?php if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){  ?>
            <th>Resto</th>
            <?php } ?>
            <th style="text-align: center;">Vendeur</th>
            <th style="text-align: center;">Cash</th> 
            <!--<th style="text-align: center;">T.V.A</th>-->
            <th style="text-align: center;">Crédit</th> 
            <th style="text-align: center;">Don</th> 
            <!--<th style="text-align: center;">Date</th>--> 
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $total = 0;
        $total1 = 0;
        $total2=0;
        
//        $req1="SELECT a.date_edition AS date_edit1,a.mode,a.dte_time,b.nom_user
//        FROM t_facture AS a, t_utilisateur AS b
//        WHERE a.id_user=b.id_user AND a.type=:type AND a.id_hotel=:id AND a.date_edition BETWEEN :dte_bd1 AND :dte_bd2
//        GROUP BY a.date_edition";
//            $requete = $bdd->prepare($req1);
//            $requete->BindParam(':type',$type);
//            $requete->BindParam(':id',$_SESSION['id_hotel']);
//            $requete->BindParam(':dte_bd1',$dte_bd1);
//            $requete->BindParam(':dte_bd2',$dte_bd2);
//            $requete->execute();
//            $result1= $requete->fetchAll(PDO::FETCH_OBJ);
        
        if (($_SESSION['test'] == 1) || (in_array('VFTSR', $_SESSION['actions']['code_actions']))) {
            if (isset($_POST['sresto_id'])) {
                $Sresto = $_POST['sresto_id'];
                
                $_SESSION['sousresto_id'] = $Sresto;
                $sousresto = getNameSresto($Sresto, $bdd);
                foreach ($sousresto as $sr) {
                    $resto_name = $sr->libelle;
                    $_SESSION['libelle_restoMvt'] = $resto_name;
                }
            } else {
                $Sresto = 0;
                $_SESSION['libelle_restoMvt'] = 'Tout';
            }
            
            if($Sresto==0){
                $req1="SELECT f.libelle AS resto, a.date_edition AS date_edit1,a.mode,a.dte_time,b.nom_user
                FROM t_facture AS a, t_utilisateur AS b,t_sousresto AS f
                WHERE a.id_user=b.id_user AND a.id_sousresto=f.id_sousresto AND a.type=:type AND a.id_hotel=:id AND a.date_edition BETWEEN :dte_bd1 AND :dte_bd2
                GROUP BY a.date_edition";
                $requete = $bdd->prepare($req1);
                $requete->BindParam(':type',$type);
                $requete->BindParam(':id',$_SESSION['id_hotel']);
                $requete->BindParam(':dte_bd1',$dte_bd1);
                $requete->BindParam(':dte_bd2',$dte_bd2);
                $requete->execute();
                $result1= $requete->fetchAll(PDO::FETCH_OBJ);
            }  else {
                $req1="SELECT f.libelle AS resto, a.date_edition AS date_edit1,a.mode,a.dte_time,b.nom_user
                FROM t_facture AS a, t_utilisateur AS b,t_sousresto AS f
                WHERE a.id_user=b.id_user AND a.id_sousresto=f.id_sousresto AND a.type=:type AND a.id_hotel=:id AND a.id_sousresto=:id_sousresto AND a.date_edition BETWEEN :dte_bd1 AND :dte_bd2
                GROUP BY a.date_edition";
                $requete = $bdd->prepare($req1);
                $requete->BindParam(':type',$type);
                $requete->BindParam(':id',$_SESSION['id_hotel']);
                $requete->BindParam(':id_sousresto', $Sresto);
                $requete->BindParam(':dte_bd1',$dte_bd1);
                $requete->BindParam(':dte_bd2',$dte_bd2);
                $requete->execute();
                $result1= $requete->fetchAll(PDO::FETCH_OBJ);
            }
            
        }  else {
            $req1="SELECT a.date_edition AS date_edit1,a.mode,a.dte_time,b.nom_user
            FROM t_facture AS a, t_utilisateur AS b
            WHERE a.id_user=b.id_user AND a.type=:type AND a.id_hotel=:id AND a.id_sousresto IS NULL AND a.date_edition BETWEEN :dte_bd1 AND :dte_bd2
            GROUP BY a.date_edition";
            $requete = $bdd->prepare($req1);
            $requete->BindParam(':type',$type);
            $requete->BindParam(':id',$_SESSION['id_hotel']);
            $requete->BindParam(':dte_bd1',$dte_bd1);
            $requete->BindParam(':dte_bd2',$dte_bd2);
            $requete->execute();
            $result1= $requete->fetchAll(PDO::FETCH_OBJ);
        }
            
        foreach ($result1 as $op1):
        $mont_cash=0;
        $mont_credit=0;
        $mont_don=0;
        $mont_don1=0;
        
        if (in_array('VTMF', $_SESSION['actions']['code_actions'])){
            if ($op1->mode!='') {
                if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){
                    $result=getMvtFinancierGlobaleSresto($_SESSION['id_hotel'],$Sresto,$type,$dte_bd1,$dte_bd2,$bdd);
                }  else {
                    $result=getMvtFinancierGlobale($_SESSION['id_hotel'],$type,$dte_bd1,$dte_bd2,$bdd);
                }
                 
            }  else {
                if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){
                    $result=getMvtFinancierGlobaleAsresto($_SESSION['id_hotel'],$Sresto,$type,$dte_bd1,$dte_bd2,$bdd);
                }  else {
                    $result=getMvtFinancierGlobaleA($_SESSION['id_hotel'],$type,$dte_bd1,$dte_bd2,$bdd);
                }
            }
            
        }elseif(in_array('VSPMF', $_SESSION['actions']['code_actions'])){
            if ($op1->mode!='') {
                if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){
                    $result=getMvtFinancierByUserSresto($_SESSION['id_hotel'],$Sresto,$_SESSION['id_user'],$type,$dte_bd1,$dte_bd2,$bdd);
                }  else {
                    $result=getMvtFinancierByUser($_SESSION['id_hotel'],$_SESSION['id_user'],$type,$dte_bd1,$dte_bd2,$bdd);
                }
                 
            }else{
                if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){
                    $result=getMvtFinancierByUserAsresto($_SESSION['id_hotel'],$Sresto,$_SESSION['id_user'],$type,$dte_bd1,$dte_bd2,$bdd);
                }  else {
                    $result=getMvtFinancierByUserA($_SESSION['id_hotel'],$_SESSION['id_user'],$type,$dte_bd1,$dte_bd2,$bdd);
                }
                 
            }
           
        }
        foreach ($result as $op){
            $mont_ttc= montant_equivalent_bdd(getsymbole_local(),$m_affiche,$taux_op,arrondir($op->mont_ttc));
            $mont_paie= montant_equivalent_bdd(getsymbole_local(),$m_affiche,$taux_op,arrondir($op->mont_paie));
            if($op->date_edition==$op1->date_edit1){
                if($op->lib=='Cash'){
                    $mont_cash+=$mont_paie;
                }  elseif ($op->lib=='Credit') {
                    $mont_credit+=$mont_ttc;
                }elseif ($op->lib=='Don') {
                    $mont_don+=$mont_paie;
                } 
            }
         };
        ?>
        <tr>
            <td style="text-align: center;"><?php echo $i ?></td>
            <td style="text-align: center;"><?php echo dateAffiche($op1->date_edit1) ?></td>
            <?php if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){  ?>
            <td class='text-danger'><?php echo ucfirst($op1->resto) ?> </td>
            <?php } ?>
            <td style="text-align: center;"><?php echo ucfirst($op1->nom_user) ?> </td>
            <td style="text-align: center;">
                <?php 
                    echo afficheMontant($m_affiche,$mont_cash);
                ?>
            </td>
<!--            <td style="text-align: center;">
                <?php 
                    echo afficheMontant($m_affiche,montant_tva($mont_cash,0,$tva));
                ?>
            </td>-->
            <td style="text-align: center;">
                <?php 
                    echo afficheMontant($m_affiche,$mont_credit);
                
                ?>
            </td>
            <td style="text-align: center;">
                <?php 
                
                    echo afficheMontant($m_affiche,$mont_don);
                
                ?>
            </td>
            
        </tr>
        <?php
        $i++;
        $total += $mont_credit;
        $total1 += $mont_cash;
        $total2 += $mont_don;
        endforeach;
        ?>
    </tbody>
    <tfoot>
        <?php if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){  
            $nbr=1;
        }  else {
            $nbr=0;
        }
        ?>
        <tr>
            <td colspan="<?php echo 3+$nbr; ?>" class="text-right"><b>Total : </b></td> 
            <td style="text-align: center;" class="text-red"><?php echo afficheMontant($m_affiche,$total1);?></td>
            <!--<td style="text-align: center;" class="text-red"><?php // echo afficheMontant($m_affiche,montant_tva($total1,0,$tva)); ?></td>-->
            <td style="text-align: center;" class="text-red"><?php echo afficheMontant($m_affiche,$total);?></td>
            <td style="text-align: center;" class="text-red"><?php echo afficheMontant($m_affiche,$total2);?></td>
        </tr>
<!--        <tr>
            <th colspan="3" class="text-right">Montant T.V.A : </th> 
            <th style="text-align: center;"><?php echo afficheMontant($m_affiche,montant_tva($total1,0,$tva)); ?></th>
            <th colspan="2"></th>
        </tr>-->
    </tfoot>

</table> 
</div>
<!-- /.box-body -->
