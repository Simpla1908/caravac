<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Détails facture</a></li>
        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Historique paiement</a></li>
        <?php if ($_SESSION['type_user'] == 1) { ?>
           <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Annulations</a></li>
        <?php } ?>
    </ul>
    <div class="tab-content" id="contenu">
         <?php include(APP_FOLDER . '/views/admin/t_reservation/sejourdata.php'); ?>
        
    </div>
    <!-- /.tab-content -->
</div>