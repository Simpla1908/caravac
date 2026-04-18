<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Versements
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
                    <input type="text" class="form-control pull-right text-left" name="periode" id="periode"
                           value="<?php echo dateAffiche($dte1) . ' à ' . dateAffiche($dte1); ?>"/>
                    <input type="hidden" name="current" id="current"
                           value="0"/>
                    <div class="input-group-addon btn_vers">
                        <a href="#" id="btn_vers" title="Valider">
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
                <a href="#" class="btn btn-danger modal_versement" >
                    <i class="fa fa-money"></i> Verser
                </a>
            </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive" id="alldatafact">
            <?php include($pathview.'versement/alldatafact.php'); ?>
          </div>   
        </div>
        
        <!-- /.box-body -->
    </div>
    </div>
</section>
<?php include($pathview.'versement/popup_versement.php'); ?>
