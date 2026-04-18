<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <tbody>
        <tr>
            <th>LIBELLE</th>
            <th>ENTREE</th>
            <th>SORTIE</th>
        </tr>
        <?php
        $totalentree=0;
        $totalsortie=0;
        for ($i = 0; $i <= $nbre - 1; $i++) {
            $libelle =$data['libelle'][$i];
            $montant =$data['usdcdf'][$i];
            $type =$data['type'][$i];
            $montantentree=0;
            $montantsortie=0;
            if($type==1){
                $montantentree=$montant;
                $montantsortie=0;
                $totalentree+=$montantentree;
            }else{
                $montantentree=0;
                $montantsortie=$montant;
                $totalsortie+=$montantsortie;
            }
        ?>
        <tr>
            <td><?php echo  $libelle?></td>
            <td> <?php 
                    if($montantentree>0){
                        echo  afficheMontant2($musd,$montantentree);
                    }
                    ?>
            </td>
            <td> <?php 
                    if($montantsortie>0){
                        echo  afficheMontant2($musd,$montantsortie);
                    }
                   
            ?></td>
        </tr>
        <?php }
        $solde=round($totalentree,2)-round($totalsortie,2);
         ?>
        <tr>
            <th>TOTAL</th>
            <th><?php echo afficheMontant2($musd,$totalentree);?></th>
            <th><?php echo afficheMontant2($musd,$totalsortie);?></th>
        </tr>
        <tr>
            <th>SOLDE</th>
            <th colspan="2" align="center"><?php echo $solde;?></th>
        </tr>
    </tbody>
</table>