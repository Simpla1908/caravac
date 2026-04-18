<?php
// Initialisation de la session
include('../bdd/connexion.php');
if (!isset($_SESSION)) {
    session_start();
    include'../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
    include'../../FUNCTION/hebergement.php';
}
    $requete = $bdd->prepare("SELECT prod.idprod,prod.code,prod.designation AS produit,prod.pa,prod.pv,prod.qte_initial,prod.qte_min,prod.unite,prod.monnaie,s_fam.des,fam.designation,p.id_prix,p.prix_vente "
        . "FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam, t_prix_produit AS p "
        . "WHERE  prod.famille_id=s_fam.id_s_fam AND prod.idprod=p.produit_id "
            . "AND p.sousresto_id=:sousresto_id AND prod.hotel_id=:hotel_id AND fam.plat=1 AND s_fam.famille=fam.idfamille AND prod.pseudo_supp=0 ORDER BY prod.idprod DESC ");
    $requete->BindParam(':sousresto_id', $_SESSION['id_sousresto']);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $produits = $requete->fetchAll(PDO::FETCH_OBJ);


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="../datepicker/jquery.datetimepicker.css">
        
    </head>
    <body>
        <div id="annule"></div>
        <div class="table-responsive">
        <table id="table" class="table table-bordered table-condensed example1">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Code</th>
                    <th>Désignation</th>
                    <!--<th>Prix de vente</th>-->
                    <th>Unité</th>
                    <th>Sous-Famille</th>
                    <th>Famille</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                
                foreach($produits as $p):
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $p->code?></td>
                        <td><?php echo ucfirst($p->produit)?></td>
                        <td><?php echo $p->unite?></td>
                        <td><?php echo ucfirst($p->des)?></td>
                        <td><?php echo ucfirst($p->designation)?></td>
                        <td>
                            <a href="./details_config_plat.php?detail=produit&id=<?php echo $p->idprod ?>&code=<?php echo $p->code ?>" class="confirmModalEdit1" id="<?php echo $p->idprod ?>"><span class="label label-success"><i class="fa fa-eye"></i> Voir</span></a> 
                        </td>
                    </tr>
                    <?php
                    $i++;
                endforeach;
                ?>
            </tbody>
        </table>
            </div>
        
        <div class="modal fade myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="form_insert_plat" action="Traitement/produit_insertion.php" method="post">
                    <input class="form-control hidden" name="monnaie" id="monnaie" value="<?php echo $m_insert;?>">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h5 class="modal-title" id="myModalLabel"><strong>Modification</strong></h5>
                        </div>
                        <div class="modal-body">
                               <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Famille</label>
                                            <select class="form-control" id="famille_id" name="famille_id" required> 													<option>  </option>
                                            <?php
                                            include('./Traitement/famille_combo.php');

                                            foreach ($familles  as $f):
                                                echo '<option value=' . $f->idfamille. '>' . ucfirst($f->designation) . '</option>';
                                            endforeach;
                                            ?>
                                        </select>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Sous-Famille</label>
                                            <select class="form-control" id="s_famille_id" name="s_famille_id" required>
                                            <option>  </option>
                                            <?php
        //                                                            include('./Traitement/s_famille_combo.php');
        //
        //                                                            foreach ($s_familles  as $f):
        //                                                                echo '<option value=' . $f->id_s_fam.'>' . ucfirst($f->des).'</option>';
        //                                                            endforeach;
                                            ?>
                                        </select>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Désignation</label>
                                            <input class="form-control col-md-7 col-xs-12"id="libelle" name="libelle">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Code</label>
                                            <input class="form-control col-md-7 col-xs-12" id="code" name="code">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Unité</label>
                                            <select class="form-control" id="unite" name="unite">
                                                <option></option>
                                                <option value="piece">Pièce</option>
                                                <option value="kg">Kilogramme</option>
                                                <option value="l">Litre</option>
                                                <option value="cl">Centilitre</option>
                                                <option value="g">Gramme</option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Prix de vente</label>
                                            <div class="form-group input-group">
                                                <input class="form-control" name="prix_vente" id="prix_vente" value="0">
                                                <span class="input-group-addon"> <?php echo $m_insert;?></span>
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
        <!--                                                        <div class="form-group">

                                            <input class="" type="checkbox" value="1" name="repas" id="repas">
                                            <label>à préparer</label>
                                        </div>-->
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                                <div class="row">

                                </div>
                            </div>
                        <div class="modal-footer">
                            <div class="col-md-9">
                                <div id="msg" class="alert alert-warning alert-dismissable"
                                     style=" text-align: center; display: none">
                                    <i class='fa fa-warning fa-fw'></i> <span id="msg_alert"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary pull-right"
                                        id="edit_produit"><i class="fa fa-edit fa-fw"></i>&nbsp;Modifier
                                </button>
                            </div>
                            <!--<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>-->
            <!--                <button type="submit" class="btn btn-primary"><i class="fa fa-print fa-fw"></i>&nbsp;Imprimer</button>-->
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </form>
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        
        
        
        <div class="modal fade myModalSuppr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <i class="fa fa-warning fa-fw"></i> Suppression
                    </div>
                    <div class="modal-body">
                        <h4>Etes-vous sûr de vouloir supprimer cet élément ?</h4>
                        <div id="msg" class="alert alert-warning alert-dismissable hidden"
                            style=" text-align:center; ">
                           <i class='fa fa-warning fa-fw'></i> <span id="msg_alert"></span>
                       </div>
                    </div>
                    <div class="modal-footer">
                         <a href="#" class="btn btn-primary" data-dismiss="modal">Non</a>
                    <a href="#" class="btn " id="confirmModalYesdel">Oui</a>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        
        
        <!-- Date time picker -->
        <script src="../datepicker/jquery.js"></script>
        <script src="../datepicker/jquery.datetimepicker.js"></script>
        <script>
        $(document).ready(function() {
            
            var id;
            $(".confirmModalSuppr").click(function (e) {
                e.preventDefault();
                id = $(this).attr("id");
//                alert(id);
//                $(".myModalEdit").modal("show");
            });
            $("#confirmModalYesdel").click(function (e) {
                $.ajax({
                    url: 'Traitement/prod_rmv.php?id=' + id,
                    type: 'POST',
                    success: function (html) {
                        window.location.href ="pages_actions.php?page=plat";
                    }
                });
//                $("#view_plat").load('./Traitement/view_plat.php');
//                $(".myModalSuppr").modal("hide");
        //window.location.href ="approvisionnement_view.php?operation=appro";

            });
            
            var id;
        $(".confirmModalEdit").click(function () {
            id = $(this).attr("id");
            $("#ajout").hide();
            $("#modif").show();
//            window.location.href ="pages_actions.php?page=plat&&id_pro="+id;
//            alert(id);
        });
            
            $("#edit_produit").click(function (e) {
                e.preventDefault();
                $(".myModalEdit").modal('hide');
        //        alert('ok');
            });
            
            $(".example1").DataTable();
            
        });
        </script>
    </body>
</html>