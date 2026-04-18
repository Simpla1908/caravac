<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Fonds de caisse
        <span class="text-danger loader hidden">
        <i class="fa fa-refresh fa-spin fa-1x"></i>
       </span>
    </h1>
    
    <ol class="breadcrumb fvlder">
        <form class="form-inline filter_frm">
            <fieldset>
                <input type="hidden" name="sousresto_id" id="sousresto_id" value="<?php echo $_SESSION['id_sousresto'] ?>"/>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right text-left" 
                           name="periode" id="periode"
                           value="<?php echo date("d/m/Y") . ' à ' . date("d/m/Y"); ?>"/>
                    <input type="hidden" name="current" id="current"
                           value="0"/>
                    <div class="input-group-addon filtrer_fdc">
                        <a href="#" id="filtrer_fdc" title="Valider">
                            Valider
                        </a>
                    </div>
                </div>
            </fieldset>
        </form>
    </ol>
    <br>
</section>
<section class="content">
    <div class="container">
        <div class="box">
        <div class="box-header">
            <h3 class="box-title pull-right">
                <a href="././impression/examples/historique_fdc.php" target="_blank" class="btn btn-xs btn-primary" title="Imprimer la liste">
                    <i class="fa fa-print"></i> Imprimer
                </a>
            </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="msgcl" class="alert alert-success alert-dismissable" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <span id="msgcl_alert">Succès!</span>
            </div>
          <div class="table-responsive" id="alldata">
            <?php include($pathview.'fdc/alldatas.php'); ?>
          </div>   
        </div>
        
        <!-- /.box-body -->
    </div>
    </div>
</section>