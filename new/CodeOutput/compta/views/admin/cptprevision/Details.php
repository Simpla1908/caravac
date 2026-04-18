<?php
/*
  	* =======================================================================
  	* FILE NAME:        Add.php
  	* DATE CREATED:  	18-04-2019
  	* FOR TABLE:  		cptjournal
  	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
  	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
  	* =======================================================================
  	*/
if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
?>
<style type="text/css">
    body {
        color: #404E67;
        background: #F5F7FA;
        font-family: 'Open Sans', sans-serif;
    }

    .table-wrapper {
        background: #fff;
        padding: 20px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

    .table-title {
        padding-bottom: 10px;
        margin: 0 0 10px;
    }

    .table-title h2 {
        margin: 6px 0 0;
        font-size: 22px;
    }

    .table-title .add-new {
        float: right;
        height: 30px;
        font-weight: bold;
        font-size: 12px;
        text-shadow: none;
        min-width: 100px;
        line-height: 13px;
    }

    .table-title .add-new i {
        margin-right: 4px;
    }
</style>


<div class="table-wrapper">
    <div class="table-title">
        <div class="row">
            <div class="col-sm-6">
                <h4><b>PREVISION <?php echo  strtoupper($rows->exercice_lib);
                                    $_SESSION['exercice_lib'] = $rows->exercice_lib; ?>
                    </b></h4>
                <br>

                <p>Date d'édition : <?php
                                    echo dateAffiche($rows->dte);
                                    $_SESSION['dte'] = dateAffiche($rows->dte);
                                    ?></p>
                <br>

            </div>
            <div class="col-sm-6" style="text-align:right;">

                <a href="<?php echo H_ADMIN; ?>&view=cptprevision&do=update&id=<?php echo $id; ?>" class="btn btn-primary btn-flat" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-edit"></i> Modifier</a>
                <a id="<?php echo $id; ?>" class="btn btn-danger btn-flat supprevi"><i class="fa fa-trash-o"></i> Supprimer </a>
                <a href="./main.php?pg=admin&view=impression&do=detailsprevi" id="btnprintdetprevi" class="btn btn-success btn-flat" target="_blank"><i class="fa fa-print"></i> Imprimer </a>
            </div>
            <br>
            <br>
            <br>

        </div>





        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Compte</th>
                    <th>Montant</th>

                </tr>
            </thead>
            <tbody>
                <?php
                //Mise en session pour impression
                $_SESSION['details'] = array();
                $_SESSION['details']['compte'] = array();
                $_SESSION['details']['montant'] = array();
                //fin mise en session
                $total = 0;
                foreach ($result as $rows) {
                    $data = INFOSFromAccountNumber($rows->compte_ecriture, $rows->long_compte, $bdd);
                    $libcompte = $rows->compte_ecriture . ' ' . $data['lib'];
                ?>
                    <tr>
                        <td><?php echo ucfirst($libcompte); ?></td>
                        <td>
                            <?php
                            $montant = $rows->mont;
                            $devise = $rows->devise;
                            $total = $total + $montant;
                            echo afficheMontant($devise, $montant);
                            ?>
                        </td>

                    </tr>
                <?php
                    array_push($_SESSION['details']['compte'], ucfirst($libcompte));
                    array_push($_SESSION['details']['montant'], afficheMontant($devise, $montant));
                }
                $_SESSION['total'] = afficheMontant($devise, $total);
                ?>

            </tbody>
            <tfoot>
                <tr>
                    <th>TOTAL</th>
                    <th><?php echo afficheMontant($devise, $total); ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="modal fade" id="myModalsupprevi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Suppression prévision</h4>
                </div>
                <div class="modal-body">
                    <input id="idprevi" name="idprevi" type="hidden" value="">
                    <p>
                        Voulez-vous supprimer cette prévision
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" id="supprevioui"><i class="fa fa-fw fa-thumbs-up"></i>&nbsp;Oui</button>
                    <button class="btn btn-danger pull-right" id="supprevinon"><i class="fa fa-fw fa-thumbs-down"></i>&nbsp;Non</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>