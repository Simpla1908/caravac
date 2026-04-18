<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Libelles
    <!--<small>Example 2.0</small>-->
    </h1>
     
    <span class="text-danger pull-right hidden" id="loader_dte">
        <i class="fa fa-refresh fa-spin fa-1x"></i> Chargement en cours...
    </span>
    <ol class="breadcrumb">
        <!--<li><a href="#"><i class="fa fa-dashboard"></i>Liste des libellés</a></li>-->
        <li>
            <!--<a href="#">Ajouter libellé</a>-->
             <a href="#" title="Ajouter" data-toggle="modal" data-target="#mdlibelle" class="btn btn-default btn-xs" id="btnaddlibelledep">
                <i class="fa fa-plus"></i> Ajouter
            </a>
        </li>
        <!--<li class="active">Top Navigation</li>-->
     </ol>
    <br>
</section>
<section class="content" id="depense_blc">
    <div class="box">
        <!--<div class="box-header">
            <h3 class="box-title">Factures</h3>
        </div>-->
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive" id="libellediv">
            <?php include($pathview . 'depense/libelledata.php'); ?>
          </div>   
        </div>
        
        <!-- /.box-body -->
    </div>
    <div id="mdlibelle" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Ajout Libelle Depense</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="pers_frm">
                    <div class="box-body">
                        <div class="callout hidden" style="margin-bottom: 0!important;" id="notifpers">
                            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label for="designation">Designation</label>
                                <input name="designation" id="designation" type="text" class="form-control">
                            </div>
                        </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="add_libelledep_btn">Valider</button>
            </div>

        </div>
    </div>
</div>
</div>
</section>

