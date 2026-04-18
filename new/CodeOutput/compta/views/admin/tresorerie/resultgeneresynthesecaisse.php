    <?php
    $type_op ="normal";
    $monnaie = $_POST['devise'];
    $dte1=dateToformatBdd($_POST['dte1']);
    $dte2=dateToformatBdd($_POST['dte2']);
    $mont_usd_report = 0;
    $mont_cdf_report = 0;
    //mise en session
    $_SESSION['devise']=$_POST['devise'];
    $_SESSION['dte1']=$_POST['dte1'];
    $_SESSION['dte2']=$_POST['dte2'];
    //mise en session
    $report = report_mensuel2($dte1,$_SESSION['id_hotel'],$bdd);
    if ($type_op == 'normal') {
        $mont_usd_report = $report['soldeusd_normal'];
        $mont_cdf_report = $report['soldefc_normal'];
    } elseif ($type_op == 'banque') {
        $mont_usd_report = $report['soldeusd_bank'];
        $mont_cdf_report = $report['soldefc_bank'];
    }
    if (isset($_POST)) {
        $sql = "SELECT op.libelle,op.motif_id AS numcompte,op.format,op.type,SUM(op.montantFC) AS montantFC,SUM(op.montantUSD) AS montantUSD 
                FROM t_operation AS op
                WHERE op.mode_operation=:mode_operation
                AND op.date_bon BETWEEN :dte1 AND :dte2
                AND op.hotel_id=:hotel_id
                GROUP BY op.motif_id, op.type";
        $requete = $bdd->prepare($sql);
        $requete->BindParam(':mode_operation',$type_op);
        $requete->BindParam(':dte1',$dte1);
        $requete->BindParam(':dte2',$dte2);
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        $requete->execute();
        $operations = $requete->fetchAll(PDO::FETCH_OBJ);
        //var_dump($operations);
        $sql = "SELECT op.type 
                FROM t_operation AS op
                WHERE op.hotel_id=:hotel_id GROUP BY type";
        $requete = $bdd->prepare($sql);
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        $requete->execute();
        $typeoperations = $requete->fetchAll(PDO::FETCH_OBJ);
        //var_dump($typeoperations);

    }
    ?>

    <table class="table table-bordered table-hover">
        <?php
             $tot=0;
            foreach ($typeoperations as $t) { ?>
            <?php if($monnaie=='usd'){ ?>
            <tbody>
                <tr>
                    <th scope="rowgroup" colspan="2"><?php echo strtoupper ($t->type) ?></th> 
                </tr>
                <?php
                $tot1 = 0;
                foreach ($operations as $o) {

                     if($o->montantUSD >0){
                    $_SESSION['m_affiche']='USD';
                    $montantFC=0;
                    $montantUSD= $o->montantUSD;
                    $montant =$montantUSD;
                    if ($t->type == $o->type) {
                        ?>

                        <tr>
                            <td>
                            <?php
                            $data=INFOSFromAccountNumber($o->numcompte,$o->format,$bdd);
                            $compte=$o->numcompte.'  '.$data['lib'];
                            echo $compte;
                            ?>    
                            </td>
                            <td>
                                <?php echo afficheMontant($_SESSION['m_affiche'], $montant);  ?>
                            </td>
                        </tr>
                        <?php $tot1 = $tot1 + $montant;
                    }
                }} ?>
                <tr>
                    <td colspan="1"><span class="pull-right">Total</span></td>
                    <td><?php echo afficheMontant($_SESSION['m_affiche'], $tot1); ?></td>
                </tr>
            </tbody>
            <?php } elseif($monnaie=='fc'){?>
             <tbody>
                <tr>
                    <th scope="rowgroup" colspan="2"><?php echo strtoupper ($t->type) ?></th> 
                </tr>
                <?php
                $tot1 = 0;
                foreach ($operations as $o) {
                    if($o->montantFC >0){
                    $_SESSION['m_affiche']='CDF';
                    $montantFC= $o->montantFC;
                    $montantUSD=0;
                    $montant =$montantFC;
                    if ($t->type == $o->type) {
                        ?>

                        <tr>
                            <td>
                            <?php
                            $data=INFOSFromAccountNumber($o->numcompte,$o->format,$bdd);
                            $compte=$o->numcompte.'  '.$data['lib'];
                            echo $compte;
                            ?>           
                            </td>
                            <td>
                                <?php echo afficheMontant($_SESSION['m_affiche'], $montant); ?>
                            </td>
                        </tr>
                        <?php $tot1 = $tot1 + $montant;
                    }
                } }?>
                <tr>
                    <td colspan="1"><span class="pull-right">Total</span></td>
                    <td><?php echo afficheMontant($_SESSION['m_affiche'], $tot1) ?></td>
                </tr>
            </tbody>
            <?php }?>
         <?php
            if($t->type=='entree'){
                $tot=$tot+$tot1;
            }  else {
              $tot=$tot-$tot1;
            }
         } ?>
        <tfoot>
        <?php if($monnaie=='usd') {
            $_SESSION['m_affiche']='USD';
            $mont_cdf_report=0;
            $report =$mont_usd_report;
            ?> 
        <tr>  
            <th><span class="">REPORT</span></th>
            <td><?php echo  afficheMontant($_SESSION['m_affiche'], $report) ?></td>
        </tr>
        <tr>  
            <th><span class="">SOLDE</span></th>
            <td><?php echo afficheMontant($_SESSION['m_affiche'],$tot +$report)?></td>
        </tr>
        <?php }else if($monnaie=='fc') {
            $_SESSION['m_affiche']='CDF';
            $mont_usd_report=0;
            $report =$mont_cdf_report;
             ?> 
            <tr>  
                <th><span class="">REPORT</span></th>
                <td><?php echo  afficheMontant($_SESSION['m_affiche'], $report) ?></td>
            </tr>
            <tr>  
                <th><span class="">SOLDE</span></th>
                <td><?php echo afficheMontant($_SESSION['m_affiche'],$tot +$report)?></td>
            </tr>
        <?php 
           }    
         ?>
      </tfoot>
    </table> 