<?php
session_start();
include './bdd/connexion.php';
if (isset($_GET['numbon']) || isset($_GET['type'])) {
    $requete = $bdd->prepare("SELECT DISTINCT mvt.idmvt,mvt.type,pro.designation,mvt.num_bon,mvt.qte_entree,mvt.qte_sortie,mvt.dte_appro_heure,mvt.depot FROM stk__mouvement AS mvt,stk_produit AS pro,t_utilisateur As user WHERE mvt.produit_id=pro.idprod AND mvt.hotel_id=:hotel_id AND mvt.idmvt=:num_bon");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':num_bon', $_GET['numbon']);
    $requete->execute();
    $operation_motifs = $requete->fetchAll(PDO::FETCH_OBJ);
    $numbon = $_GET['numbon'];
    $type = $_GET['type'];
  
}
?>

<!DOCTYPE html>
<html lang="fr">
    <?php
    include('head.php');
    ?>

    <body>
        <?php include('Rapport/liste_produit_famille.php'); ?>

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
                    <a class="navbar-brand" href="Traitement/operation_affichage.php"><img src="images/logoKB1.png"/></a>
                </div>
                <!-- /.navbar-header -->

                <?php include('navigation.php'); ?> 
                <?php include('menu.php'); ?>
                <?php include('./Traitement/dateUS_fr.php'); ?>




            </nav>
            <!-- /.navbar-top-links --> 
            <div id="affichage_before_impression">
                <div id="page-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header">
                                <?php
                                if ($type == "sortie") {
                                    echo ' Détails sur une sortie';
                                } else {
                                    echo ' Détails sur un approvisionnement';
                                }
                                ?>

                            </h3>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <!--                            <div id="msg" class="alert alert-success alert-dismissable" style="display:block;">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                            L'enrégistrement s'est effectué avec succès!
                                                        </div>-->
                            <?php foreach ($operation_motifs as $operation): ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-default">
                                            <div  class="alert alert-success alert-dismissable msg_sup" style="display:none;">
                                                La suppression s'est effectué avec succès!
                                            </div>
                                            <?php if ($type == "sortie") { ?>

                                                <div class="panel-heading barre-cmd">
                                                    <?php if (in_array('IBS',$_SESSION['actions']['code_actions'])){?>
                                                    <a href="impression/examples/recu_bon_sortie.php?id=<?php echo $operation->idmvt; ?>&type=sortie" title="Imprimer" class="btn btn-primary" id="btn_imprimer_be" target="_blank"><i class="fa fa-print fa-fw"></i> Imprimer</a>
                                                    <?php } ?>
                                                        <?php if (in_array('SORM111',$_SESSION['actions']['code_actions'])){?>
                                                    <a href="sortie_update.php?idmvt=<?php echo $operation->idmvt; ?>" title="Modifier" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i> Modifier</a>
                                                    <?php } ?>
                                                     <?php if (in_array('SORS111',$_SESSION['actions']['code_actions'])){?>
                                                    <a id="<?php echo $operation->idmvt; ?>" title="Supprimer" class="btn btn-danger confirmModalLink1" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash-o fa-fw"></i> Supprimer</a>
                                                    <?php } ?>
                                                </div>
                                            <?php } else { ?>

                                                <div class="panel-heading barre-cmd">
                                                    <?php if (in_array('IBE',$_SESSION['actions']['code_actions'])){?>
                                                        <a href="impression/examples/recu_bon_sortie.php?id=<?php echo $operation->idmvt; ?>&type=appro" title="Imprimer" class="btn btn-primary" id="btn_imprimer_be" target="_blank"><i class="fa fa-print fa-fw"></i> Imprimer</a>
                                                    <?php } ?>
                                                    <?php if (in_array('APPRM111',$_SESSION['actions']['code_actions'])){?>
                                                    <a href="approv_update.php?idmvt=<?php echo $operation->idmvt; ?>" title="Modifier" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i> Modifier</a>
                                                    <?php } ?>
                                                    <?php if (in_array('APPRS111',$_SESSION['actions']['code_actions'])){?>
                                                    <a id="<?php echo $operation->idmvt; ?>" title="Supprimer" class="btn btn-danger confirmModalLink" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash-o fa-fw"></i> Supprimer</a>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                            <div class="panel-body barre-cmd">
                                                <div class="row">
                                                    <form role="form" id="form" action="Traitement/operation_insertion.php">
                                                        <input type="hidden" name="entree" value="e">
                                                        <input type="hidden" name="sortie" value="sortie">
                                                        <input type="hidden" name="idoperation" value="<?php echo $operation->idmvt; ?>">
                                                        <br/>
                                                        <div class="col-lg-12">

                                                            <div class="table-responsive" align="center">
                                                                <table width="874">
                                                                    <tr>
                                                                        <td width="130">N° Bon&nbsp;&nbsp;</td>
                                                                        <td width="321">
                                                                            <?php
                                                                            echo ': ' . $numbon;
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr height="15">
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="130">Produit&nbsp;&nbsp;</td>
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
                                                                        <td width="130">Quantite&nbsp;&nbsp;</td>
                                                                        <td width="321">
                                                                            <?php
                                                                            if ($type == "sortie") {
                                                                                echo ': ' . $operation->qte_sortie;
                                                                            } else {
                                                                                echo ': ' . $operation->qte_entree;
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr height="15">
                                                                        <td></td>
                                                                    </tr>
                                                                    <?php
                                                                    if ($type == "sortie") {
                                                                        ?>
                                                                        <tr>
                                                                            <td width="130">Dépot&nbsp;&nbsp;</td>
                                                                            <td width="321">
                                                                                <?php
                                                                                echo ': ' . $operation->depot;
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr height="15">
                                                                            <td></td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <tr>
                                                                        <td width="130">Date&nbsp;&nbsp;</td>
                                                                        <td width="321"><?php echo ': ' . $operation->dte_appro_heure; ?></td>
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
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /#page-wrapper -->
            </div>
            <!-- /#affichage_before_impression-->
        </div>
        <!-- /#wrapper -->

        <?php include('footer.php'); ?>

    </body>

</html>
