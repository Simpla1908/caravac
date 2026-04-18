<?php
session_start();
include './bdd/connexion.php';
include './Traitement/operation_motif_edit.php';
if (isset($_SESSION['operation_last_id'])|| isset($_GET['type'])) {
    $operation_motifs = getoperation_motif($_SESSION['operation_last_id'], $bdd);
    $type=$_GET['type'];
}
?>
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div id="msg" class="alert alert-success alert-dismissable" style="display:block;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            L'enrégistrement s'est effectué avec succès!
        </div>
        <?php foreach ($operation_motifs as $operation): ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <?php if($type=="sortie"){?>
                        <div class="panel-heading">
                            <a href="impression/examples/recu_bon_sortie.php?id=<?php echo $operation->idoperation; ?>" title="Imprimer" class="btn btn-primary" id="btn_imprimer_be" target="_blank"><i class="fa fa-print fa-fw"></i> Imprimer</a>
                            <a href="bon_sortie_update.php?be_id=<?php echo $operation->idoperation; ?>" title="Modifier" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i> Modifier</a>
                        </div>
                        <?php } else {?>
                        <div class="panel-heading">
                            <a href="impression/examples/recu_bon.php?id=<?php echo $operation->idoperation; ?>" title="Imprimer" class="btn btn-primary" id="btn_imprimer_be" target="_blank"><i class="fa fa-print fa-fw"></i> Imprimer</a>
                            <a href="bon_entre_update.php?be_id=<?php echo $operation->idoperation; ?>" title="Modifier" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i> Modifier</a>
                        </div>
                        <?php }?>
                        <div class="panel-body">
                            <div class="row">
                                <form role="form" id="form" action="Traitement/operation_insertion.php">
                                    <input type="hidden" name="entree" value="e">
                                    <input type="hidden" name="sortie" value="sortie">
                                    <input type="hidden" name="idoperation" value="<?php echo $operation->idoperation; ?>">
                                    <br/>
                                    <div class="col-lg-12">

                                        <div class="table-responsive" align="center">
                                            <table width="874">
                                                <tr>
                                                    <td width="130">Type caisse&nbsp;&nbsp;</td>
                                                    <td width="321">
                                                        <?php
                                                        echo ': ' . $operation->mode_operation;
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr height="15">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td width="130">Motif&nbsp;&nbsp;</td>
                                                    <td width="321">
                                                        <?php
                                                        echo ': ' . $operation->designation;
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr height="15">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td width="130">Bénéficiaire&nbsp;&nbsp;</td>
                                                    <td width="321"><?php echo ': ' . $operation->beneficiaire; ?></td>
                                                </tr>
                                                <tr height="15">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td width="130">Libellé&nbsp;&nbsp;</td>
                                                    <td width="321">
                                                        <?php
                                                        echo ': ' . $operation->libelle;
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr height="15">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td width="130">Date&nbsp;&nbsp;</td>
                                                    <td width="321"><?php echo ': ' . $operation->date_heure_bon; ?></td>
                                                </tr>
                                                <tr height="15">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td width="130">Montant&nbsp;&nbsp;</td>
                                                    <td width="321">
                                                        <?php
                                                        if (empty($operation->montantUSD)) {
                                                            echo ': ' . $operation->montantFC . ' FC';
                                                        } elseif (empty($operation->montantFC)) {
                                                            echo ': ' . $operation->montantUSD . ' $';
                                                        } else {

                                                            echo ': ' . $operation->montantUSD . ' $ ' . ' ' . $operation->montantFC . ' FC';
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr height="15">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    if ($operation->mode_operation == 'banque') {
                                                        ?>
                                                        <td width="130">N° Bordereau&nbsp;&nbsp;</td>
                                                        <td width="321"><?php echo ': ' . $operation->numBordereau; ?></td>
                                                        <?php
                                                    } else {
                                                        ?>   
                                                        <td width="200"></td>
                                                        <td width="203"></td>
                                                        <?php
                                                    }
                                                    ?>
                                                </tr>
                                                <tr height="15">
                                                    <td></td>
                                                </tr>

                                                <tr height="15">
                                                    <td></td>
                                                </tr>

                                            </table>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        <?php endforeach; ?>

    </body>
</html>
