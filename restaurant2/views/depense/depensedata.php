<div class="col-lg-12">
    <table id="example1" class="table table-bordered table-striped table-condensed example1">
        <thead>
            <tr>
                <th>#</th>
                <th>Numero</th>
                <th>Date</th>
                <th>Agent</th>
                <th>Libelle</th>
                <th>Description</th>
                <th>USD</th>
                <th>CDF</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $totusd = $totcdf = 0;
            foreach ($depenses as $l) {
                $id = $l->id;
                $numero = $l->numero;
                $dte_dep = $l->dte_dep;
                $agent = $l->nom_user;
                $libelle = $l->designation;
                $description = $l->motif;
                $usd = $l->usd;
                $cdf = $l->cdf;
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $numero ?></td>
                    <td><?php echo dateAffiche($dte_dep) ?></td>
                    <td><?php echo $agent ?></td>
                    <td><?php echo $libelle ?></td>
                    <td><?php echo $description ?></td>
                    <td><?php echo afficheMontant('', $usd) ?></td>
                    <td><?php echo afficheMontant('', $cdf) ?></td>
                    <td>
                        <?php if (in_array('UPDATEDEP', $_SESSION['actions']['code_actions'])) { ?>

                            <a id="<?php echo $id ?>" lib="<?php echo $libelle ?>" des="<?php echo $description ?>" usd="<?php echo arrondir($usd) ?>" cdf="<?php echo arrondir($cdf) ?>" href="#" class="btn btn-primary btn-xs btndisplaypopupdep"> <span class="fa fa-edit tip"></span></a>
                        <?php } ?>
                        <?php if (in_array('DELDEP', $_SESSION['actions']['code_actions'])) { ?>

                            <a id="<?php echo $id ?>" href="#" class="btn btn-danger btn-xs btndeldep"> <span class="fa fa-times tip"></span></a>
                        <?php } ?>

                    </td>
                </tr>
            <?php
                $i++;
                $totusd += $usd;
                $totcdf += $cdf;
            }

            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6"><span class="pull-right">TOTAL</span></th>
                <th><?php echo afficheMontant('USD', $totusd); ?></th>
                <th><?php echo afficheMontant('CDF', $totcdf); ?></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>