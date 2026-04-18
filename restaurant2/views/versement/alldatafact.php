<table class="table table-striped table-bordered table-hover example1">
    <thead>
        <tr>
            <th>#</th>
            <th>Utilisateur</th>
            <th>Date</th>
            <th>USD</th>
            <th>CDF</th>
            <th>Total</th>
            <th>Balance</th>
            <!-- <th>Etat</th> -->
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="tb_contenu">
        <?php
        $i = 1;
        $totcdf = 0;
        $totusd = 0;
        $totcdf1 = 0;
        $totusd1 = 0;
        $totsolde_virtuel=0;
        $totbalance=0;
        $musd = getsymbole_devise();
        $mcdf = getsymbole_local();
        foreach ($result as $r) {
            $id_user=$r->user_vers;
          /* if (in_array('VTVS', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) {
                   if (in_array($id_user, $_SESSION['fdc']['user'])) {
                    $fond_cdf=$_SESSION['fdc']['fond_cdf'][$id_user];
                    $fond_usd=$_SESSION['fdc']['fond_usd'][$id_user];
                    }else{
                    $fond_cdf=0;
                    $fond_usd=0; 
                    }
                } */
            $id_sousresto=$r->id_sousresto;
		    $dte=$r->date_vers;
			/* $recette= TotSolde($id_user,$id_sousresto,$dte,$bdd);
            $percu_cdf =$recette['percu_cdf'];
            $percu_usd =$recette['percu_usd'];
            $rendu_cdf =$recette['rendu_cdf'];
            $rendu_usd =$recette['rendu_usd']; */
           /*  $averser_cdf = ($fond_cdf + $percu_cdf) - $rendu_cdf;
            $averser_usd = ($fond_usd + $percu_usd) - $rendu_usd; */
			$mont_usd=$r->usd;
            $mont_cdf=$r->cdf;
           /*  $solde_usd = $averser_usd - $mont_usd;
            $solde_cdf = $averser_cdf - $mont_cdf; */
            $noms_user = $r->prenom_user . ' ' . $r->nom_user;
            /* $totcdf+=$solde_cdf;
            $totusd+=$solde_usd; */
            $solde_virtuel=$r->solde_virtuel;
            $balance=$r->balance;
            $totcdf1+=$mont_cdf;
            $totusd1+=$mont_usd;
            $totsolde_virtuel+=$solde_virtuel;
            $totbalance+=$balance;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $noms_user ?></td>
                <td><?php echo dateAffiche($dte) ?></td>
                <td><?php echo afficheMontant2('',$mont_usd) ?></td>
                <td><?php echo afficheMontant2('',$mont_cdf) ?></td>
                <td><?php echo afficheMontant2('', $solde_virtuel) ?></td>
                <td><?php echo afficheMontant2('', $balance) ?></td>
          
                <td>
                    <a class="btn btn-info btn-xs" title='Details' href="?p=versement&d=details&ss=<?php echo $_SESSION['id_sousresto']?>&noms_user=<?php echo $noms_user; ?>&user=<?php echo $id_user; ?>&dte=<?php echo $dte; ?>&fond_usd=<?php echo $fond_usd; ?>&fond_cdf=<?php echo $fond_cdf; ?>&percu_cdf=<?php echo 0; ?>&percu_usd=<?php echo 0; ?>&rendu_usd=<?php echo 0; ?>&rendu_cdf=<?php echo 0; ?>&averser_usd=<?php echo 0; ?>&averser_cdf=<?php echo 0; ?>&verser_usd=<?php echo 0; ?>&verser_cdf=<?php echo 0; ?>">
                        <i class="fa fa-eye fa-fw"></i> Détails
                    </a> 
                </td>

            </tr>
            <?php
            $i++;
        }
        ?>
        
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"><b>Total</b></td>
            <td><b><?php echo afficheMontant2('', $totusd1) ?></b></td>
            <td><b><?php echo afficheMontant2('', $totcdf1) ?></b></td>
            <td><b><?php echo afficheMontant2('', $totsolde_virtuel) ?></b></td>
            <td><b><?php echo afficheMontant2('', $totbalance) ?></b></td>
            <td> </td>
        </tr>
    </tfoot>
</table>
