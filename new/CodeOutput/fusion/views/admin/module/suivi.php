
<?php
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Vente du 28/08/2019 au  28/08/2019</h3>
                <ul class="nav pull-right">
                    <!--<input type="radio" name="choixrecette" id="optionsRadios1" value="jour" checked="">
                    par jour
                    <input type="radio" name="choixrecette" id="optionsRadios2" value="client">
                    par client-->
                    <a  class="btn btn-default btn-xs tip" title="Filtrer les recettes" data-toggle="modal" data-target="#modalfiltrerpaie"><i class="fa fa-sort"></i> Filtrer</a>
                </ul>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active onglet_chambre"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Détails vente</a></li>
                        <li class="onglet_service"><a href="#tab_2" data-toggle="tab" aria-expanded="false">Factures</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <table id="example4" class="table table-bordered table-striped table-hover matable table-condensed">
                                <tr>
                                    <th rowspan="2" style="text-align: center;">N°</th>
                                    <th colspan="2" style="text-align: center;">DESIGNATION</th>
                                    <th colspan="2" style="text-align: center;">CASH</th>
                                    <th colspan="2" style="text-align: center;">CREDIT</th>
                                    <th colspan="2" style="text-align: center;">DON</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center;">Numero</th> 
                                    <th style="text-align: center;">Tarif</th> 
                                    <th style="text-align: center;">QTE</th> 
                                    <th style="text-align: center;">Prix Total</th> 
                                    <th style="text-align: center;">QTE</th> 
                                    <th style="text-align: center;">Prix Total</th> 
                                    <th style="text-align: center;">QTE</th> 
                                    <th style="text-align: center;">Prix Total</th>
                                </tr>
                                <tr>
                                    <th><?php // echo $j  ?></th>
                                    <td style="text-align: center;"><?php // echo $chambre  ?></th>
                                    <td style="text-align: center;"><?php // echo afficheMontant($m_affiche, $tarif)  ?></td>
                                    <td style="text-align: center;"><?php // echo $nuites_cash  ?></td>
                                    <td style="text-align: right;"><?php // echo afficheMontant($m_affiche, $prix_total_cash)  ?></td>
                                    <td style="text-align: center;"><?php // echo $nuites_credit  ?></td>
                                    <td style="text-align: right;"><?php // echo afficheMontant($m_affiche, $prix_total_credit)  ?></td>
                                    <td style="text-align: center;"><?php // echo $nuites_don  ?></td>
                                    <td style="text-align: right;"><?php // echo afficheMontant($m_affiche, $prix_total_don)  ?></td>
                                </tr>
                                <tr>
                                    <th colspan="4">Total</th> 
                                    <th style="text-align: right;"><?php // echo afficheMontant($m_affiche, $total_cash)  ?></th>
                                    <th colspan="1"></th>
                                    <th style="text-align: right;"><?php // echo afficheMontant($m_affiche, $total_credit)  ?></th>
                                    <th colspan="1"></th>
                                    <th style="text-align: right;"><?php //echo afficheMontant($m_affiche, $total_don)  ?></th>
                                </tr>

                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">

                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>

            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
<!-- Modal -->
<div class="modal fade" id="modalfiltrerpaie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form class="form-inline" id="frmfiltrerpaie" name="frmfiltrerpaie">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Filtrage des récettes</h4>
                </div>
                <div class="modal-body text-center">
                    <div class="output"></div>
                    <input name="typerecette" id="typerecette" type="hidden" value="jour" > 
                    <div class="form-group">
                        <label for="dte1">Du</label>
                        <input name="datedebut" id="datedebut" type="text" value="<?php echo $dte1_af; ?>" class="form-control datepicker2"> 
                    </div>
                    <div class="form-group">
                        <label for="dte2">au</label>
                        <input name="datefin" id="datefin" type="text" value="<?php echo $dte2_af; ?>" class="form-control datepicker2">
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="msg_popup" class="text-danger text-left col-md-10" style="display:none;">
                        <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                        <span id="msg_alert_popup">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                    </div>
                    <button  class="btn btn-danger pull-right col-md-2"
                             id="btnfilrecet2"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
                    </button>
                    <span class="btn btn-info hidden pull-right" id="loader">
                        <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                    </span>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->