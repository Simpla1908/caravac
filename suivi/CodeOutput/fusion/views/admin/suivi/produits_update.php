<table id="table_ingred" class="table table-striped table-condensed table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Désignation</th>
            <th>Quantité</th>
            <th>Prix unitaire</th>
            <th>Sous-total</th>
            <th>
                <div class="tools text-center">
                    <a href="#" title="Selectionner &amp; Supprimer" id="btn_suppprodcom" class="text-danger"><i class="fa fa-trash-o"></i></a>
                </div>
            </th>
        </tr>
    </thead>
    <tbody id="produit_list">
        <?php
        $j=1;
        $total=0;
        for ($i = 0; $i <= $nbArticles - 1; $i++) {
        ?>
        <tr>
            <td><?php echo $j; ?></td>
            <td><?php echo $_SESSION['commande']['designation'][$i]; ?></td>
            <td>
                <input type="text" value="<?php echo $_SESSION['commande']['qte_dispo'][$i] ?>" class="qte_cmd" id="<?php echo $_SESSION['commande']['produit_id'][$i] ?>" des="<?php echo $_SESSION['commande']['designation'][$i]; ?>" prix="<?php echo $_SESSION['commande']['prix_unit'][$i]; ?>">
            </td>
            <td>
            <input type="text" value="<?php echo $_SESSION['commande']['prix_unit'][$i]; ?>" class="prix_unit" id="<?php echo $_SESSION['commande']['produit_id'][$i] ?>" des="<?php echo $_SESSION['commande']['designation'][$i]; ?>" qte="<?php echo $_SESSION['commande']['qte_dispo'][$i]; ?>">
            </td>
            <td id="sous_tot"><?php echo format_chiffre($_SESSION['commande']['sous_tot'][$i]); ?></td>
            <td align="center">
                 <input name="prodids" class="prodids" type="checkbox"  value="<?php echo $_SESSION['commande']['produit_id'][$i] ?>"> 
           </td>
        </tr>
       <?php $j++; $total=$total + $_SESSION['commande']['sous_tot'][$i];} 
       $_SESSION['montant']=$total;
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4" align="right">Total</th>
            <th><?php echo format_chiffre($total); ?></th>
             <th></th>
        </tr>
    </tfoot>
</table>
    