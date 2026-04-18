 <br>
 <div class="table-responsive">
     <div class="box-body" id="listboncommandes">
         <?php
            $impr_row = 1;
            $compt_row = 4;
            $produits = ListePlat2($bdd, $fich_sfamid);
            foreach ($produits as $pr) {
                $idprod = $pr->idprod;
                $code = $pr->code;
                $plat = $pr->produit;
                $sous_famille = $pr->des;
            ?>
             <?php
                if ($impr_row == 1) {
                    $impr_row = 0;
                ?>
                 <div class="row">
                 <?php }
                $impr = 0;
                $produits_plat = listeProduitIngredient($idprod, $_SESSION['id_hotel'], $bdd);
                    ?>
                 <div class="col-md-3">
                     <!-- DIRECT CHAT PRIMARY -->
                     <div class="box box-default direct-chat direct-chat-primary panel panel-default">
                         <div class="box-header with-border center" align="center">
                             <h3 class="box-title"><?php echo $code; ?></h3><br><br>
                             <h3 class="box-title"><?php echo $plat; ?></h3><br><br>
                             <h3 class="box-title"><?php echo $sous_famille; ?></h3><br><br>
                         </div>
                         <table class="table table-hover table-condensed" id="tab_commandes">
                             <tbody>
                                 <tr>
                                     <th class='mailbox-subject'> PROD</th>
                                     <th class='mailbox-attachment'>QTE</th>
                                     <th class='mailbox-attachment'>UNITE</th>
                                     <th class='mailbox-attachment'>CR(USD)</th>
                                 </tr>


                                 <?php
                                    $tot = 0;
                                    foreach ($produits_plat as $pp) {
                                        $prod = $pp->designation;
                                        $qte = $pp->quantite;
                                        $unite = $pp->unite;
                                        $cr = $pp->prix;
                                    ?>
                                     <tr>
                                         <td class='mailbox-subject'><?php echo ucfirst($prod); ?></td>
                                         <td class='mailbox-attachment'><?php echo $qte; ?></td>
                                         <td class='mailbox-attachment'><?php echo $unite; ?></td>
                                         <td class='mailbox-attachment'><?php echo $cr; ?></td>
                                         <td></td>

                                     </tr>
                                 <?php
                                        $tot = $tot + $cr;
                                    }
                                    ?>
                                 <tr>
                                     <th style="text-align:center;" colspan="3">TOTAL</th>
                                     <th><?php echo $tot ?></th>
                                 </tr>
                             </tbody>
                             <tfoot>

                             </tfoot>
                         </table>
                     </div>
                     <!--/.direct-chat -->
                 </div>
                 <!-- /.col -->
                 <?php
                    $compt_row--;
                    if ($compt_row == 0) {
                        $impr_row = 1;
                        $compt_row = 4;
                    }
                    if ($impr_row == 1) {
                        $impr_row = 1;
                    ?>
                 </div>
             <?php
                    }
                ?>
         <?php }
            ?>
         <!-- /.box -->
     </div>
 </div>