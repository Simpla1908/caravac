<?php session_start(); ?>
<div class="active tab-pane fade in" id="tab1">
    <div class="row">

        <div class="col-lg-10">
            <h2 class="page-header">Liste des tickets en attente</h2> 
        </div>
        <div class="col-lg-2">
            <button type="button" class="btn btn-default" id="annuler"><i class="ion-chevron-left"></i><i class="ion-chevron-left"></i> Annuler</button>
        </div>
        <?php
        include '../bdd/connexion.php';
        include './Panier.php';
        $_SESSION['id_hotel'] = 1;
        $_SESSION['panier']['remise'] = 0;
        $requete = $bdd->prepare("SELECT  r.id_res,r.num_reserv,c.designation,c.id_client,c.nom_client,c.type FROM  t_reservation AS r,t_client As c WHERE r.type='commande' AND r.etat='attente' AND r.id_client=c.id_client AND r.id_hotel=:hotel_id ORDER BY r.id_res ASC");
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        $requete->execute();
        $reservation_attente = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($reservation_attente as $ra) {
            $id = $ra->id_res;
            $id_cl= $ra->id_client;
            $cmd_num = $ra->num_reserv;
            $tbl = $ra->designation;
            $cl = $ra->nom_client;
            $typ = $ra->type;
            if ($typ == 'client') {
                $cl_tbl = $cl;
            } else if ($typ == 'table') {
                $cl_tbl = $tbl;
            }
            ?>
            <div class="col-md-3">
                <!-- DIRECT CHAT PRIMARY -->
                <div class="box box-default direct-chat direct-chat-primary panel panel-default">
                    <div class="box-header with-border center" align="center">

                        <h3 class="box-title"> <?php echo $cmd_num; ?></h3><br>
                        <span data-toggle="tooltip" title="Table:4" class="badge bg-green"><?php echo $cl_tbl; ?></span>

                    </div>
    <?php
    $ht = 0;
    $cmd_num = $id;
    $requete = $bdd->prepare("SELECT  l.qte,l.prix,p.designation FROM  lignes_commandes AS l,stk_produit As p WHERE l.produit_id=p.idprod AND l.commande_id=:cmd_id AND l.hotel_id=:hotel_id");
    $requete->BindParam(':cmd_id', $cmd_num);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $reservation_l_attente = $requete->fetchAll(PDO::FETCH_OBJ);
    ?>
                    <div class="box-body" align="center" style="overflow: auto; height: 225px;">
                        <table class="table no-border table-condensed">
                            <thead>
               
               
                <th class ='mailbox-attachment'>Qté</th>
                <th class ='mailbox-subject'> Désignation</th>
                <th class ='mailbox-date text-right'>Prix</th>
            </thead>
            <tbody>
                            <?php
                            foreach ($reservation_l_attente As $r) {
                                $qte = $r->qte;
                                $prix = $r->prix;
                                $designation = $r->designation;
                                $ht = $ht + ($qte * $prix);
                                ?>
                                <!-- /.box-header -->
                                <tr>
                                    <td><?php echo $qte; ?></td>
                                    <td><?php echo $designation; ?></td>
                                    
                                    <td class="text-right"><?php echo $prix; ?> FC</td>
                                </tr>
                            <?php
                            }

                            $tva = 16;
                            $mont_ht = $ht;
                            $mont_tva = $mont_ht * $tva / 100;
                            $mont_ttc = $mont_tva + $mont_ht;
                            $mont_ttc_remise = $mont_ttc - $mont_ttc * $_SESSION['panier']['remise'] / 100;
                            ?>
                                </tbody> 
                            <tfoot>

                                <tr>
                                    <th class ='mailbox-attachment' colspan="2">Montant HT</th>
                                    <th class="text-right"><b><?php echo $mont_ht; ?>FC</b></th> 
                                </tr>
                                <tr>
                                    <td class ='mailbox-attachment' colspan="2">TVA</td>
                                    <td class="text-right"><i><?php echo $mont_tva; ?>FC</i></td> 
                                </tr>
                                <tr>
                                    <td class ='mailbox-attachment' colspan="2">Remise</td>
                                    <td class="text-right"><i><?php echo $mont_ttc_remise; ?> FC</i></td> 
                                </tr>
                                <tr>
                                    <th class ='mailbox-attachment' colspan="2">Montant TTC</th>
                                    <th class="text-right"><i><?php echo $mont_ttc; ?> FC</i></th> 
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-default btn-block re_cmd" id1="<?php echo $id; ?>" id2="<?php echo $cl_tbl; ?>" id3="<?php echo $id_cl; ?>">Rappeler commande</button>
                    </div>
                    <!-- /.box-footer-->
                </div>
                <!--/.direct-chat -->
            </div>
            <!-- /.col -->
<?php } ?>


    </div>
    <!-- /.row -->
</div>
<!-- /.tab-pane -->
<script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>                             
<script>
// JavaScript Document
    $(document).ready(function () {
        $("#annuler").click(function (e) {
            $("#c1").show();
            $("#c3").hide();

        });
        $(".re_cmd").click(function (e) {
            var id1 = $(this).attr("id1");
            var id2 = $(this).attr("id2");
            var id3 = $(this).attr("id3");
            $.ajax({
                url: 'Traitement/produits_panier.php',
                async: true,
                type: 'POST',
                data: "id1=" + id1,
                global: false,
                cache: false,
                success: function (html) {
                    //alert(html);
                    $("#cl_chxi").empty().append(id2);
                    $('#affiche_commandes').empty().append(html);
                    $("#c1").show();
                    $("#c3").hide();
                    $("#id_cmd").val(id1);
                    $("#client_id1").val(id3);
                    $("#attente").val('attente');

                }
            });

//   $.ajax({
//            url: 'Traitement/tableau_affichage_commandes_bis.php',
//            type: 'POST',
//            data: donnees,
//            success: function (html) {
//                alert('bonjour');
//               // 
//               }
//        });     

        });

    });
</script>