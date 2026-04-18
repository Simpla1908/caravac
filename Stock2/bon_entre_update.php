<?php
    session_start();
    include './bdd/connexion.php';
    include './Traitement/operation_motif_edit.php';
    if (isset($_GET['be_id'])) {
        $operation_motifs = getoperation_motif($_GET['be_id'], $bdd);
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <?php
    include('head.php');
    ?>

    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="images/logoKB1.png"/></a>
                </div>
                <!-- /.navbar-header -->

                <?php include('navigation.php'); ?> 
                <?php include('menu.php'); ?>
                <?php include('Fonctions/fx_.php'); ?>
            </nav>
            <!-- /.navbar-top-links -->
            
            
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            <h2 class="page-header">Bon d'entrée</h2>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6" align="right">
                            <h2 class="page-header"><a href="bon_entre_view.php?operation=entree" title="Vue liste" class="btn btn-danger"><i class="fa fa-list"></i></a></h2>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div id="affichage_before_impression">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="msg" class="alert alert-danger alert-dismissable" style="display:none;">
                                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                                <span id="msg_alert">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Modification du bon</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <?php foreach ($operation_motifs as $operation):
                                            $dte_h_be=str_replace('-','/',$operation->date_heure_bon);
                                            $an=substr($dte_h_be, 0, 4);
                                            $m=substr($dte_h_be,5,2);
                                            $jr=substr($dte_h_be, 8, 2);
                                            $h=substr($dte_h_be, 10, 9);
                                            $date_h_b=$jr.'/'.$m.'/'.$an.$h;
                                            ?>
                                        <form role="form" id="form" action="Traitement/operation_modifier.php" method="post">
                                            <input type="hidden" name="entree" value="entree">
                                            <input type="hidden" name="sortie" value="s">
                                             <input type="hidden" name="idoperation" value="<?php echo $operation->idoperation; ?>">
                                            <br/>
                                            <div class="col-lg-12">

                                                <div class="table-responsive">
                                                    <table width="874">
                                                        <tr>
                                                            <td width="128"><label>Motif&nbsp;&nbsp;</label></td>
                                                            <td width="233">
                                                                <select class="form-control" id="motif" name="motif_id" required>
                                                                    <?php
                                                                    echo '<option value=' . $operation->idmotif . '>' . $operation->designation . '</option>';
                                                                    include('./Traitement/operation_motif_combo.php');
                                                                    ?>
                                                                </select>
                                                            </td>
                                                            <td width="93">&nbsp;</td>
                                                            <td width="121"><label>Provenance&nbsp;&nbsp;</label></td>
                                                            <td width="247"><input class="form-control"id="beneficiaire" name="beneficiaire" value="<?php echo $operation->beneficiaire; ?>" required></td>
                                                        </tr>
                                                        <tr height="15">
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="128"><label>Libellé&nbsp;&nbsp;</label></td>
                                                            <td width="233"><input class="form-control" id="libelle" name="libelle" value="<?php echo $operation->libelle; ?>" required></td>
                                                            <td width="93">&nbsp;</td>
                                                            <td width="121"><label>Date&nbsp;&nbsp;</label></td>
                                                            <td width="247"><input class="form-control" id="datebonentre" name="date_heure_bon" value="<?php echo $date_h_b; ?>" required></td>
                                                        </tr>
                                                        <tr height="15">
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="128"><label class="modif">N° Bordereau&nbsp;&nbsp</label></td>
                                                            <td width="233"><input class="form-control modif" name="numBordereau" id="ui" value="<?php if ($operation->mode_operation == 'banque') { echo $operation->numBordereau; } else {echo ' '; }?>" ></td>
                                                            <td width="93">&nbsp;</td>
                                                            <td width="121"></td>
                                                            <td width="247"></td>
                                                        </tr>
                                                        <tr height="15">
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="128">
                                                                <label>Montant en USD&nbsp;&nbsp;:&nbsp;</label>
                                                            </td>
                                                            <td width="233">
                                                                <div class="form-group input-group">
                                                                    <span class="input-group-addon">$</span>
                                                                    <input type="number" min="0" class="form-control" placeholder="Montant en USD" id="montantUSD" name="montantUSD" value="<?php echo $operation->montantUSD; ?>">
                                                                </div>
                                                            </td>
                                                            <td width="93">&nbsp;</td>
                                                            <td width="121"><label>Montant en FC&nbsp;&nbsp;:&nbsp;</label></td>
                                                            <td width="247" id="changer_input">
                                                                <div class="form-group input-group">
                                                                    <span class="input-group-addon">Fc</span>
                                                                    <input type="number" min="0" class="form-control" placeholder="Montant en FC" id="montantFC2" name="montantFC" value="<?php echo $operation->montantFC; ?>">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr height="15">
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="128"></td>
                                                            <td width="233">
                                                                <button type="submit" class="btn btn-primary" id="update_operation" name="update_operation">
                                                                    <i class=" fa fa-save"></i>&nbsp;&nbsp;Modifier
                                                                </button>
                                                            </td>
                                                            <td width="93">&nbsp;</td>
                                                            <td width="121"></td>
                                                            <td width="247" align="right">
                                                                
                                                            </td>
                                                        </tr>
                                                        <tr height="15">
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </form>
                                        <?php endforeach; ?>
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
                </div>
                <!-- /#affichage_before_impression -->
            </div>
            <!-- /#page-wrapper -->
            
        </div>
        <!-- /#wrapper -->

        <?php include('footer.php'); ?>

    </body>

</html>
