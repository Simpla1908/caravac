<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Rapport des ventes (<span id="vspdte"><?php echo date("d/m/Y") . ' au ' . date("d/m/Y"); ?></span>)
    </h1>
    <!--    <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Layout</a></li>
            <li class="active">Top Navigation</li>
        </ol>-->
    
    <ol class="breadcrumb">
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
                    <div class="input-group-addon">
                        <a href="#" id="btn_rppvente" title="Valider">
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
        <!--<div class="box-header">
            <h3 class="box-title">Factures</h3>
        </div>-->
        <!-- /.box-header -->
        <div class="box-body">
            <span class="text-danger pull-right hidden loader" id="loader">
                <i class="fa fa-refresh fa-spin fa-1x"></i> Chargement en cours...
            </span>
          <div  id="alldatafact">
            <?php include($pathview.'rapport/datavente.php'); ?>
          </div>   
        </div>
        
        <!-- /.box-body -->
    </div>
</section>

