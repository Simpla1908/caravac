<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <tbody>
        <tr>
            <th colspan="2">VENTES</th>
        </tr>
        <?php
        for ($i = 0; $i <= $nbre - 1; $i++) {
            $mode =$data['ventes']['mode'][$i];
            $montant =$data['ventes']['montant'][$i];
        ?>
        <tr>
            <td> <?php echo $mode?></td>
            <td><?php echo  afficheMontant2($musd,$montant)?></td>
        </tr>
        <?php } ?>
        <tr>
            <td>TOTAL</td>
            <td><b> <?php echo  afficheMontant2($musd,$data['ventes']['total'])?></b></td>
        </tr>
        <tr>
            <th colspan="2">DETAILS CAISSE</th>
        </tr>
        <tr>
            <td>FONDS DE CAISSE</td>
            <td><?php echo afficheMontant2($musd,$data['fdc']) ?></td>
        </tr>
        <tr>
            <td>CASH</td>
            <td><?php echo afficheMontant2($musd,$data['totcash']) ?></td>
        </tr>
        <tr>
            <td>PAIEMENTS CREDIT</td>
            <td><?php echo afficheMontant2($musd,$data['totpaiementcredit']) ?></td>
        </tr>
        <tr>
            <td>DEPENSES</td>
            <td><?php  echo afficheMontant2($musd,$data['totdepense']) ?></td>
        </tr>
        <tr>
            <td>SOLDE VIRTUEL</td>
            <td><?php  echo afficheMontant2($musd,$data['soldevirtuel']) ?></td>
        </tr>
        <tr>
            <td>SOLDE PHYSIQUE </td>
            <td colspan="2"><b><?php  echo afficheMontant2($musd,$data['soldephys']) ?></b></td>
        </tr>
        <tr>
            <td>BALANCE </td>
            <td colspan="2"><?php echo afficheMontant2($musd, $data['balance']) ?></td>
        </tr>
        <tr>
            <td>FONDS DE CAISSE DU LENDEMAIN</td>
            <td colspan="2"><?php echo afficheMontant2($musd,$data['fdcldm']) ?></td>
        </tr>
    </tbody>
</table>