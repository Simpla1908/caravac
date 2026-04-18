<br>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-condensed dataTables-example" id="dataTables-example10000">
        <thead>
            <tr>
                <th>#</th>
                <th>N° Réservation</th>
                <th>Clients</th>
                <th>Montant payé</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            $tot=0;
            foreach ($result as $r):
                $montant_paye=affiche_montant($m_affiche, $tauxdollar, $r->montant_fc, $r->montant_dollar)
            ?>
            <tr class="gradeX">
                <td><?php echo $i ?></td>
                <td><?php echo $r->num_reserv; ?></td>
                <td><?php echo $r->nom_client; ?></td>
                <td><?php echo $montant_paye.' '.$m_affiche; ?></td>
                <td class="center"><a href="details_paiement_cash.php?id_res=<?php echo $r->id_res; ?>&num_res=<?php echo $r->num_reserv; ?>" title="Afficher le detail" class="btn btn-info btn-xs"><i class="fa fa-list"></i> Détails </a></td>
            </tr>
            <?php
            $i++;
            $tot=$tot+$montant_paye;
            endforeach;
            ?>
        </tbody>
        <tfoot>
            <tr class="gradeU">
                <th colspan="3">Total</th>
                <th><?php echo $tot.' '.$m_affiche; ?></th>
                <th colspan="2"></th>
            </tr>
        </tfoot>
    </table>
</div>
<!-- /.table-responsive -->