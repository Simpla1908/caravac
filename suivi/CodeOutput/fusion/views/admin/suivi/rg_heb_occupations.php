
<div class="content-wrapper" id="bloc_view_main">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Liste des occupations <span id="descrpt"><?php echo $description; ?></span>
            </h1>
            <ol class="breadcrumb">
<!--                <li><a href="#"  data-toggle="modal" data-target="#modalfiltrerpaie">Filtrer</a></li>-->
                <li><a href="../../REC/tableaudebordRec.php"> Tableau de bord</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="box box-default">
               
                <div class="box-body" id="viewbloc">
                     <?php include(APP_FOLDER . '/views/admin/suivi/rg_data_occupations.php'); ?> 
                </div>
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.container -->
</div>
<!-- /.content-wrapper -->


<!-- ./wrapper -->
<!-- Modal -->
<div class="modal fade" id="modalfiltrerpaie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form class="form-inline" id="frmfiltrerpaie" name="frmfiltrerpaie">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Filtrage des données</h4>
                </div>
                <div class="modal-body text-center">
                    <form class="frmpaie">
                        <div class="row">
                            <div class="col-md-3 col-sm-12 col-xs-12 form-group">

                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label for="site">Sites</label>
                                <select class=" col-md-5 form-control choz" name="site_id" id="site_id">
                                    <option value=""></option>
                                    <?php
                                   foreach ($sites as $rows){
                                        $id =$rows->id_hotel;
                                        $libelle = $rows->nom_hotel;
                                        $site_id =$id;
                                        ?>
                                        <option value="<?php echo $id ?>" nomsite="<?php echo $libelle ?>" niveau='<?php echo $site_id ?>'><?php echo $libelle ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input name="niveau" id="niveau"  type="hidden" value="">
                            <input name="nomsite" id="nomsite"  type="hidden" value="">
                            <div class="col-md-3 col-sm-12 col-xs-12 form-group">

                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group blcmp">
                                <label for="usd"> Du</label>
                                <input name="dte1" id="dte1" class="form-control datepicker2"  type="text" value="<?php echo date('d/m/Y'); ?>">
                                au
                                <input name="dte2" id="dte2" class="form-control datepicker2"  type="text" value="<?php echo date('d/m/Y'); ?>">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <div id="msg_popup" class="text-danger text-left col-md-10" style="display:none;">
                        <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                        <span id="msg_alert_popup">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                    </div>
                    <button  class="btn btn-danger pull-right col-md-2" id="btnbcachat">
                        <i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
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