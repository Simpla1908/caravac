<?php
if (!isset($_SESSION)) {
    session_start();
}
include('Traitement/cl_tbl.php'); ?>
<div class="panel panel-default box" style="overflow: auto; height: 700px;">
    <ol class="breadcrumb">
        <li><a href="#"><b>Liste des serveurs </b></a></li>
        <li class="pull-right"><a href="#" title="Retour" id="fermer_tab3"><span class="step size-64"><i
                        class="fa fa-mail-reply-all"></i> Retour</span></a></li>

    </ol>
    <div class="box-body">
        <div class="row">
            <div class="col-lg-12 listetable_client" id="produit10">
                <!--Client occasionnel-->
                <?php foreach ($serveurs as $cl): ?>
                    <a class="btn btn-app  bg-maroon client_table" id1="<?php echo $cl->id_client; ?>"
                       id2="<?php echo $cl->nom_client; ?>" tp-cl="<?php echo $cl->type; ?>">
                        <?php echo ucfirst($cl->nom_client); ?><br>
                        <span class="label label-success"></span>
                    </a>
                <?php endforeach; ?>
                <!-- Fin Client occasionnel-->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.box -->
</div>
