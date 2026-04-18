<div class="tab-pane active" id="tab_1">
    <table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
        <thead>
            <tr>
                <th>Numéro</th>
                <th data-hide="phone,tablet">Client</th>
                <th data-hide="phone,tablet">Responsable</th>
                <th data-hide="phone,tablet">Edition</th>
                <th data-hide="phone,tablet">Montant TTC</th>
                <th data-hide="phone,tablet">Montant Payé</th>
                <th data-hide="phone,tablet">Reste</th>
                <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
            </tr>
        </thead>
        <tbody id="contenucash">
            <?php include(APP_FOLDER . '/views/admin/t_reservation/datafactcash.php'); ?>
        </tbody>
    </table>
</div>
<!-- /.tab-pane -->
<div class="tab-pane" id="tab_2">
    <table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
        <thead>
            <tr>
                <th>Numéro</th>
                <th data-hide="phone,tablet">Client</th>
                <th data-hide="phone,tablet">Responsable</th>
                <th data-hide="phone,tablet">Edition</th>
                <th data-hide="phone,tablet">Montant TTC</th>
                <th data-hide="phone,tablet">Montant Payé</th>
                <th data-hide="phone,tablet">Reste</th>
                <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
            </tr>
        </thead>
        <tbody id="contenucredit">
            <?php include(APP_FOLDER . '/views/admin/t_reservation/datafactcredit.php'); ?>
        </tbody>

    </table>
</div>
<!-- /.tab-pane -->
<div class="tab-pane" id="tab_3">
    <table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
        <thead>
            <tr>
                <th>Numéro</th>
                <th data-hide="phone,tablet">Client</th>
                <th data-hide="phone,tablet">Responsable</th>
                <th data-hide="phone,tablet">Edition</th>
                <th data-hide="phone,tablet">Montant TTC</th>
                <th data-hide="phone,tablet">Montant Payé</th>
                <th data-hide="phone,tablet">Reste</th>
                <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
            </tr>
        </thead>
        <tbody id="contenudon">
            <?php include(APP_FOLDER . '/views/admin/t_reservation/datafactdon.php'); ?>
        </tbody>
    </table>
</div>
<!-- /.tab-pane -->
<div class="tab-pane" id="tab_4">
    <table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
        <thead>
            <tr>
                <th>Numéro</th>
                <th data-hide="phone,tablet">Client</th>
                <th data-hide="phone,tablet">Respo.</th>
                <th data-hide="phone,tablet">Edition</th>
                <th data-hide="phone,tablet">Mont. TTC</th>
                <th data-hide="phone,tablet">Mont. Payé</th>
                <th data-hide="phone,tablet">Pénalité</th>
                <th data-hide="phone,tablet">Obs.</th>
                <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
            </tr>
        </thead>
        <tbody id="contenucash">
            <?php include(APP_FOLDER . '/views/admin/t_reservation/datafactannules.php'); ?>
        </tbody>
    </table>
</div>