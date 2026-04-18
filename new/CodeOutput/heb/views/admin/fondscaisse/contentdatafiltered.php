 
  <table data-page="false" class="table table-bordered table-hover table-striped t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
	<thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th data-hide="phone,tablet">Utilisateur</th>
            <th data-hide="phone,tablet">FOND USD</th>
            <th data-hide="phone,tablet">FOND CDF</th>
            <th data-sort-ignore="true"><?php echo LANG_ACTIONS;?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        //Mise en session pour impression
        $_SESSION['fdc'] = array();
        $_SESSION['fdc']['i'] = array();
        $_SESSION['fdc']['date'] = array();
        $_SESSION['fdc']['utilisateur'] = array();
        $_SESSION['fdc']['fondusd'] = array();
        $_SESSION['fdc']['fondcdf'] = array();
        //Fin mise en session
        $i = 1;
        $musd = getsymbole_devise();
        $mcdf = getsymbole_local();
        $totusd=0;
        $totcdf=0;
        foreach ($result as $r) {
            $id=$r->id;
            $id_user=$r->id_user;
            $dte=$r->dte;
            $hr=$r->hr;
            $mont_cdf = $r->fond_cdf;
            $mont_usd = $r->fond_usd;
            $noms_user = $r->prenom_user . ' ' . $r->nom_user;
            $totusd=$totusd+$mont_usd;
            $totcdf=$totcdf+$mont_cdf;
            array_push($_SESSION['fdc']['i'], $i);
            array_push($_SESSION['fdc']['date'],dateAffiche($dte).' '.$hr);
            array_push($_SESSION['fdc']['utilisateur'],$noms_user);
            array_push($_SESSION['fdc']['fondusd'], afficheMontant($musd, $mont_usd));
            array_push($_SESSION['fdc']['fondcdf'], afficheMontant($mcdf, $mont_cdf));

            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo dateAffiche($dte).' '.$hr ?></td>
                <td><?php echo $noms_user ?></td>
                <td>
                <?php echo afficheMontant($musd,$mont_usd) ?>
                </td>
                <td>
                <?php echo afficheMontant($mcdf,$mont_cdf) ?>
                </td>
                <td class="table-actions">
				 <div class="btn-group">
				<a href="<?php echo H_ADMIN;?>&view=fondscaisse&id=<?php echo $id?>&do=update" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE;?>"></span></a>
				 </div>
				 </td>

            </tr>
            <?php
            $i++;
        }
                $_SESSION['fdctotusd']=afficheMontant($musd,$totusd);
                $_SESSION['fdctotcdf']=afficheMontant($mcdf,$totcdf);
                $_SESSION['datedebut']=$datedebut;
                $_SESSION['datefin']=$datefin;
        ?>
        
    </tbody>
  <tfoot>
     <th colspan="3">Total</th>
    <th id="totusd"><?php echo afficheMontant($musd,$totusd) ?></th>
     <th id="totcdf"><?php echo afficheMontant($mcdf,$totcdf) ?></th>
</tfoot>
</table>