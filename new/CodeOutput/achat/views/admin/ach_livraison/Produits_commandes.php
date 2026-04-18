<div class="tab-pane active" id="tab_1">
    <br>
    <div class="table-responsive">
        <table id="table_ingred" class="table table-striped table-condensed table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Produits</th>
                    <th>Quantité à livrer</th>
                    <th>Quantité livrée</th>
                    <th>Observation</th>
                </tr>
            </thead>
            <tbody id="liv_produit">
                <?php 
                if ($nbArticles!=-1) {
                $j=1;
                $total=0;
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                    if($_SESSION['livraison']['commande_id'][$i]==$boncommande_id){
                ?>
                <tr>
                    <td><?php echo $j; ?></td>
                    <td><?php echo ucfirst($_SESSION['livraison']['designation'][$i]); ?></td>
                    <td><?php echo $_SESSION['livraison']['qte_attendue'][$i]; ?></td>
                    <td>
                        <input type="text" value="<?php echo $_SESSION['livraison']['qte_recue'][$i] ?>" class="qte" qte_a="<?php echo $_SESSION['livraison']['qte_attendue'][$i]; ?>" id="<?php echo $_SESSION['livraison']['produit_id'][$i] ?>">
                    </td>
                    <td>
                        <input  class="form-control observation" id="<?php echo $_SESSION['livraison']['produit_id'][$i] ?>" value="<?php echo $_SESSION['livraison']['observation'][$i] ?>">
                    </td>
                </tr>
                <?php 
              
                $j++;
                } 
                }
                }?>
            </tbody>
        </table>
    </div>
    <!-- /.table-responsive -->
</div>
<!-- /.tab-pane -->