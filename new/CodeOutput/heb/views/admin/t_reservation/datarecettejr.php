 <table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2">
    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th data-hide="phone,tablet">Séjour</th>
            <th data-hide="phone,tablet">Consommations</th>
            <th data-hide="phone,tablet">Montant Total</th>
            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
        </tr>
    </thead>
    <tbody id="bloc_recette"> 
       <?php include(APP_FOLDER . '/views/admin/t_reservation/datarecette.php'); ?>
    </tbody>
</table>
