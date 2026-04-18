<table class="table table-striped table-bordered table-hover example1">
    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Utilisateur</th>
            <th>FOND USD</th>
            <th>FOND CDF</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="tb_contenu">
        <?php
        $i = 1;
        $musd = getsymbole_devise();
        $mcdf = getsymbole_local();
        $totusd = 0;
        $totcdf = 0;
        foreach ($result as $r) {
            $id = $r->id;
            $id_user = $r->id_user;
            $dte = $r->dte;
            $hr = $r->hr;
            $mont_cdf = $r->fond_cdf;
            $mont_usd = $r->fond_usd;
            $noms_user = $r->prenom_user . ' ' . $r->nom_user;
            $totusd = $totusd + $mont_usd;
            $totcdf = $totcdf + $mont_cdf;
            $motif = $r->motif;
        ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo dateAffiche($dte) . ' ' . $hr ?></td>
                <td><?php echo $noms_user ?></td>
                <td>
                    <div class="txtfdc<?php echo $id; ?>" id="fondusd<?php echo $id; ?>">
                        <?php echo afficheMontant($musd, $mont_usd) ?>
                    </div>
                    <div class="input-group inputfdc<?php echo $id; ?>" style="display:none">
                        <input type="text" id="montant_usd<?php echo $id; ?>" name="montant_usd" class="form-control text-right text-blue " value="<?php echo arrondir($mont_usd); ?>">
                        <span class="input-group-addon">USD</span>
                    </div>
                </td>
                <td>
                    <div class="txtfdc<?php echo $id; ?>" id="fondcdf<?php echo $id; ?>">
                        <?php echo afficheMontant($mcdf, $mont_cdf) ?>
                    </div>
                    <div class="input-group inputfdc<?php echo $id; ?>" style="display:none">
                        <input type="text" id="montant_cdf<?php echo $id; ?>" name="montant_cdf" class="form-control text-right text-blue " value="<?php echo arrondir($mont_cdf); ?>">
                        <span class="input-group-addon">CDF</span>
                    </div>
                </td>
                <td>

                    <div class="txtfdc<?php echo $id; ?>" id="motif<?php echo $id; ?>">
                        <?php echo $motif ?>
                    </div>
                    <div class="input-group inputfdc<?php echo $id; ?>" style="display:none">
                        <textarea name="fdcmotif" class="form-control" id="fdcmotif<?php echo $id; ?>" rows="1"><?php echo $motif; ?></textarea>
                    </div>
                </td>
                <td>
                    <?php if (in_array('UPDATEFDC', $_SESSION['actions']['code_actions'])) { ?>

                        <a class="btn bg-olive btn-xs modifierfdc modifierfdc<?php echo $id; ?>" title='Modifier' idfdc="<?php echo $id; ?>">
                            <i class="fa fa-edit fa-fw"></i> Modifier
                        </a>

                        <a style="display:none" class="btn btn-info btn-xs validerfdc validerfdc<?php echo $id; ?>" title='Modifier' id="<?php echo $id; ?>" montusd="<?php echo $mont_usd; ?>" montcdf="<?php echo $mont_cdf; ?>">
                            <i class="fa fa-edit fa-fw"></i> Valider
                        </a>
                    <?php } ?>

                    <?php if (in_array('DELFDC', $_SESSION['actions']['code_actions'])) { ?>

                        <a id="<?php echo $id ?>" href="#" class="btn btn-danger btn-xs btndelfdc"> <span class="fa fa-times tip"> Supprimer</span></a>
                    <?php } ?>

                </td>

            </tr>
        <?php
            $i++;
        }
        ?>

    </tbody>
    <tfoot>
        <th colspan="3">Total</th>
        <th id="totusd"><?php echo afficheMontant($musd, $totusd) ?></th>
        <th id="totcdf"><?php echo afficheMontant($mcdf, $totcdf) ?></th>
    </tfoot>
</table>