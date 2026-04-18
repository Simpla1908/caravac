<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Validation approvisionnement #<?php echo $num_bon ?>
        </h1>
        <ol class="breadcrumb">
            <button type="submit" id="appro_validate" href="#" class="btn btn-primary">
                <i class="fa fa-check"></i> Approuver
            </button>
            <span class="btn btn-danger hidden" id="loader"><i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...</span>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <!--<div class="box-header">
                <h3 class="box-title">Factures</h3>
            </div>-->
            <!-- /.box-header -->
            <div class="box-body">
                <div id="msg_grp" class="alert alert-danger alert-dismissable" style="display:none;">
                    <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                    <span id="msg_alert_grp">L'enrégistrement s'est effectué avec succès!</span>
                </div>
                <form role="form" id="form" action="Traitement/appro_validation.php" method="post">
                    <input type="hidden" min="1" value="<?php echo $id_fiche; ?>" name="id_fiche">
                    <input type="hidden" min="1" value="<?php echo $num_bon; ?>" name="num_bon">
                    <input type="hidden" min="1" value="<?php echo $depot_id; ?>" name="depot_id">

                    <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example01">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>PRODUIT</th>
                                <th>QUANTITE ENVOYEE</th>
                                <th>QUANTITE RECUE</th>
                                <th>ECART</th>
                                <th>UNITE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $i = 1;
                            foreach ($result as $r):
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $r->designation ?></td>
                                    <td>
                                        <?php echo $r->qte_envoye; ?>
                                    </td>
                                    <td>
                                        <input type="hidden" min="1" value="<?php echo $r->id_validation; ?>" class="" id="<?php echo $r->id_validation; ?>" name="validates[]">
                                        <input type="hidden" min="1" value="<?php echo $r->idprod; ?>" class="" id="idprod<?php echo $r->id_validation; ?>" name="idprod<?php echo $r->id_validation; ?>">
                                        <input type="hidden" min="1" value="<?php echo $r->qte_envoye; ?>" class="" id="qteE<?php echo $r->id_validation; ?>" name="qteE<?php echo $r->id_validation; ?>">
                                        <input size="10" type="number" min="1" value="<?php echo $r->qte_envoye; ?>" validate="<?php echo $r->id_validation; ?>" class="quantite_change" id="qteR<?php echo $r->id_validation; ?>" name="qteR<?php echo $r->id_validation; ?>">
                                    </td>
                                    <td id="ecrat<?php echo $r->id_validation; ?>">
                                        <?php echo ($r->qte_envoye - $r->qte_envoye); ?>
                                    </td>
                                    <td>
                                        <?php echo $r->unite; ?>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            endforeach;
                            ?>

                        </tbody>
                    </table>
                </form>

            </div>
            <!-- /.box-body -->
        </div>
    </section>
</div>

