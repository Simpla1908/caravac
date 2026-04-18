<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               ETAT DE CAISSE
                <small></small>
            </h1>
           <ol class="breadcrumb">
            <form class="form-inline filter_frm">
                    <fieldset>
                        <input type="hidden" name="sousresto_id" id="sousresto_id" value="<?php echo $_SESSION['id_sousresto'] ?>"/>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right text-left" name="periode" id="periode"
                                value="<?php echo dateAffiche($dte1) . ' - ' . dateAffiche($dte1); ?>"/>
                            <input type="hidden" name="current" id="current"
                                value="0"/>
                            <div class="input-group-addon btn_vers">
                                <a href="#" id="btn_rapport_etatcaisse" title="Valider">
                                    Valider
                                </a>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </ol>
            <br>
        </section>


        <!-- Main content -->
        <!-- Main content -->
        <section class="content">
            <div class="box" id="details_versement">
            <div class="box-header">
                <div class="col-md-9">
                    <h3 class="box-title">
                    Période(<span id="speriode_versement"><?php echo dateAffiche($dte1).'-'.dateAffiche($dte1);?></span>)
                    </h3>
                </div>
                <div class="col-md-3">
                    <div class="btn-group  btn-group-sm">
                        <a id="prt_det_vers2" href="impression/examples/etatdecaisse.php" target="_blank"  class="btn btn-xs btn-primary" title="Imprimer la liste">
                            <i class="fa fa-print"></i> Imprimer
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive" id='bcqdetails2'>
                <?php include($pathview . 'versement/etatcaissedata.php');?>
            </div>

        </div>
        <!-- /.box -->
        </section>
        
    </div>

    <!-- /.content -->
    <div class="clearfix"></div>

</div>

