<table id="example1" class="table table-bordered table-striped table-condensed">
    <thead>
        <tr>
            <th>#</th>
            <th>N° Facture</th>
            <th>Client</th>
            <th>N° Réçu</th>
            <th>Agent</th>
            <th>Date</th>
            <th>Mode</th>
            <th>Montant Payé</th>
            <th>Observation</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $tot1 = 0;
        $monnaie =  getsymbole_local();
        $totpaiementcredit=0;
         foreach ($paiements as $p) {
            $mode = $p->mode;
            $id_regl = $p->id_regl;
            $numero = $p->numero;
            $user = $p->nom_user . ' ' . $p->prenom_user;
            $dte = $p->dte;
            $dte_h = $p->date_regl;
            $tx_paie = $p->taux;
            $mont_paye1 = ($p->montantusd * $p->taux + $p->montantcdf) - ($p->rendu_usd * $p->taux + $p->rendu_cdf);
            $mont_paye = montant_equivalent_bdd($monnaie, $m_affiche,$tx_paie, $mont_paye1);
            $num_fact = $p->num_fact;
            $mode = $p->mode;
            $nom_client = $p->nom_client;
            $designation = $p->designation;
            $type = $p->type;
            $num_fact = $p->num_fact;
            $lib = $p->lib;
            if($type=='table'){
                $nom_client=$designation;
            }
            $observation='';
            if($mode=='Credit'){
                $observation='paiement credit';
                $totpaiementcredit+=$mont_paye;
            }
            if ($mont_paye > 0) {
        ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $num_fact ?></td>
                    <td><?php echo $nom_client ?></td>
                    <td><?php echo $numero ?></td>
                    <td><?php echo $user ?></td>
                    <td><?php echo dateAffiche($dte) ?></td>
                    <td><?php echo $lib ?></td>
                    <td><?php echo afficheMontant2($m_affiche, $mont_paye); ?></td>
                    <td><?php echo $observation; ?></td>
                </tr>
        <?php
           }
           $tot1 += $mont_paye;
           $i++;
      }
        ?>
    </tbody>
    <tfoot>
         <?php
         foreach ($paimentsbymodes as $p) {
             if($p->lib!='Credit'){
        ?>
        <tr>
            <th colspan="7"><span class="pull-right"><?php echo 'Total '.$p->lib; ?></span></th>
            <th><?php echo afficheMontant2($m_affiche, $p->montpaye); ?></th>
            <th></th>
        </tr>
        <?php
         }}
        ?>
        <tr>
            <th colspan="7"><span class="pull-right">Total Paiement crédit</span></th>
            <th><?php echo afficheMontant2($m_affiche, $totpaiementcredit); ?></th>
            <th></th>
        </tr>
    </tfoot>
 </table>