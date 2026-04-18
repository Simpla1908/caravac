<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Liste de couverts
    </h1>
     
    <span class="text-danger pull-right hidden" id="loader_dte">
        <i class="fa fa-refresh fa-spin fa-1x"></i> Chargement en cours...
    </span>
   <ol class="breadcrumb">
        <form class="form-inline filter_frm">
            <fieldset>
                <input type="hidden" name="sousresto_id" id="sousresto_id" value="<?php echo $_SESSION['id_sousresto'] ?>"/>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right text-left"  name="periode" id="periode"
                           value="<?php echo dateAffiche($dte1).' à '.dateAffiche($dte1); ?>"/>
                    <input type="hidden" name="current" id="current"
                           value="0"/>
                    <div class="input-group-addon">
                        <a href="#" id="filter_couverts_btn" title="Valider">
                            Valider
                        </a>
                    </div>
                </div>
            </fieldset>
        </form>
    </ol><br>
</section>
<section class="content">
    <div class="box">
        <div class="box-header">
            <!--<h3 class="box-title">Factures</h3>-->
            <a href="#" class="btn btn-primary btn-sm pull-right" id="print_liste_couverts"><i class="fa fa-print"></i> Imprimer</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive" id="alldatacouverts">
            <?php include($pathview . 'couverts/couvertsdata.php'); ?>
          </div>   
        </div>
        
        <!-- /.box-body -->
    </div>
</section>

