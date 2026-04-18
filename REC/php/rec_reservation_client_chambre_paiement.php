<?php include('Receptionniste.php'); ?>
<?php include('./headerRec_popup.php'); ?>
<?php include('menu_Rec.php'); ?>
<?php include('../FUNCTION/checkdates.php'); ?>
<?php require '_header.php';?>


<div id="page-wrapper" style=" height:auto;">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                <?php
                /* Test d'affichage d'Occupation ou reservation à h2 */
                if (isset($_GET['hebergement'])) {
                    $hebergement = $_GET['hebergement'];
                    if ($hebergement == 1) {
                        echo 'Reservation';
                    } else {
                        echo 'Occupation';
                    }
                }
                ?>
            </h2>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>
<?php
/* Test d'affichage d'Occupation ou reservation à h2 */
if (isset($_GET['hebergement'])) {
    $hebergement = $_GET['hebergement'];
    if ($hebergement == 1) {
        echo 'Reservation';
    } else {
        echo 'Occupation';
    }
}
?>

                    </h4>

                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">

                    <BR>
                    <form role="form" method="post" action="" id="">
                        <fieldset>
                            <input name="heberge" id="hebergement" type="hidden" value="<?php echo $hebergement; ?>">
                            <table width="852" border="0"  style="margin-left:20px;">
                                <tr>
                                    <td align="left" > <label for="date"><b>Date&nbsp;</b></label></td>
                                    <td width="10" style="border-right:1px solid #000"></td>
                                    <td align="left">&nbsp;&nbsp;<?php echo $_SESSION['date_res']; ?> </td>
                                </tr>
                                <tr height="15">
                                    <td></td>
                                </tr>
                                <tr>
                                    <td align="left" > <label><strong>Client&nbsp;</strong></label></td>
                                    <td width="10" style="border-right:1px solid #000"></td>
                                    <td align="left">&nbsp;&nbsp;<?php echo $_SESSION['nom_client']; ?></td>
                                    <td width="50"></td>
                                </tr>
                                <tr height="15">
                                    <td></td>
                                </tr>
                                <tr height="15">
                                    <td></td>
                                </tr>
                                <tr>
                                    <td align="left" > <label for="date"><strong>Date prévue d'arrivée&nbsp;</strong></label></td>
                                    <td width="10" style="border-right:1px solid #000"></td>
                                    <td align="left">&nbsp;&nbsp;<?php echo $_SESSION['date_arrive']; ?></td>
                                    <td width="50"></td>
                                    <td align="right" > <label for="date"><strong>Date prévue de sortie&nbsp;</strong></label></td>
                                    <td width="10" style="border-right:1px solid #000"></td>
                                    <td align="left">&nbsp;&nbsp;<?php echo $_SESSION['date_sorti']; ?></td>
                                    <td width="30"></td>
                                    <td align="left"><font color="#FF0000"><strong>&nbsp;Soit <?php echo $_SESSION['nbre_jr']; ?> Jour(s)</strong></font></td>
                                </tr>
                                <tr height="15">
                                    <td></td>
                                </tr>

                            </table>
                            </div>
                            <div id="panier">
                     <div class="accordion panel panel-body" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel">
                                    <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <h4 class="panel-title">Liste de chambres</h4>
                                    </a>
                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                        <div class="panel-body">
                                          <div id="total_chambre" class="col-lg-12">
                                            <div class="col-lg-6 pull-left">Total chambre&nbsp;:&nbsp;<?php echo count($_SESSION['panier'])?></div>

                                        <div class="col-lg-6 text-right">
Total à payer pour <?php echo $_SESSION['nbre_jr'];?> jour(s):
    <?php
                if (empty($_SESSION['panier'])) {
                   $som=0;
                } else {
                  $som=0;   
                $ids=array_keys($_SESSION['panier']);
                 
                $req = $bd -> prepare('SELECT id_ch, num_ch, tarif_ch FROM t_chambre WHERE id_ch in ('.implode(',', $ids).')');
                $req -> execute();
                $chambre = $req -> fetchAll(PDO::FETCH_OBJ);
               
                foreach($chambre as $d):
                $som+=$d->tarif_ch;
                endforeach; 
                }
                
                
        $_SESSION['montant_nuite']=$som; 
        $_SESSION['total']=$som*$_SESSION['nbre_jr'];
        echo $_SESSION['total'];
        
    ?> $
    </div>


                                          </div> 
                                            <p>
                        <?php
                        $requete_chambre = $bdd->prepare("SELECT * FROM t_chambre AS ch
			                            WHERE id_ch NOT IN (SELECT c.id_ch
                                                    FROM t_reservation AS a, t_reserve_chambre AS b, t_chambre AS c
                                                    WHERE b.idreserv = a.id_res
                                                    AND b.idchambre = c.id_ch
                                                    AND b.statut !='libre'
                                                    AND a.dte_a >=:dte_a
                                                    AND a.dte_s <=:dte_s
                                                    AND c.id_hotel=:id_hotel)AND ch.id_hotel=:id_hotel");

                        $requete_chambre->BindParam(':dte_a', $_SESSION['date_a']);
                        $requete_chambre->BindParam(':dte_s', $_SESSION['date_s']);
                        $requete_chambre->BindParam(':id_hotel', $_SESSION['id_hotel']);
                        $requete_chambre->execute();

                        $chambres = $requete_chambre->fetchAll(PDO::FETCH_OBJ);
                        ?>
                                                <table width="200" class="table_chambre table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>N° Chambre</th>
                                <th>Tarif</th>
                                <td></td>
                            </tr>
                        </thead>
                        <?php
                        $i = 1;
                        foreach ($chambres as $ch):
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo 'Ch ' . $ch->num_ch ?></td>
                                <td><?php echo $ch->tarif_ch ?> $ / Nuit</td>
                                <td>
                                    <input name="chambre[]" type="checkbox" value="<?php echo $ch->id_ch ?>" id="<?php echo $ch->id_ch ?>" class="checkbox_chambre" <?php if (isset($_SESSION['panier'][$ch->id_ch])) {?> checked="checked" <?php }?>/>
                               </td>
                                <td style="display: none"><input id="hebergement" type="hidden" value="<?php echo $_SESSION['hebergement']; ?>"/></td>
                            </tr>
                            <?php
                            $i++;
                        endforeach;
                        ?>
                    </table>
<!--                    <input class="form-control" type="submit" name="send" id="add15" value="Ajouter"/>-->

                    </p>
                      </div>
                     </form>

                </div>

            </div>
            <!-- /.panel-body -->
        </div>
                            </div>
<?php // include('rec_panier_chambre.php'); ?>
                            </div>

                            <div style="margin-left:70px;">
                                <table width="937" height="50" border="0">
                                    <tr valign="top">
                                        <td width="460">
<?php if ($hebergement == 1) { ?>
                                                <a class="btn btn-primary" href="rec_reservation_multiple.php?hebergement=1" style="font-style:italic;"><i class=" fa fa-arrow-left"></i>&nbsp;&nbsp;Précedent</a>
                                            <?php } ?>
                                            <?php if ($hebergement == 2) { ?>
                                                <a class="btn btn-primary" href="rec_reservation_multiple.php?hebergement=2" style="font-style:italic;"><i class=" fa fa-arrow-left"></i>&nbsp;&nbsp;Précedent</a>
                                            <?php } ?>
                                        </td>
                                        <td width="182" align="right">
                                            <button  name="suivant" id="suivant2" type="submit" class="btn btn-primary"><i class=" fa fa-arrow-right"></i>&nbsp;&nbsp;Suivant</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>

                    </form>

                </div>

            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<script src="../datepicker/jquery.js"></script>
<script src="../datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#datetimepicker6').datetimepicker();
    $('#datetimepickerOcc').datetimepicker();
    $('#datetimepickerLib').datetimepicker();
    $('#datetimepickerLib1').datetimepicker();
</script>

<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap-modal.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/sb-admin-2.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });

</script>
<!-- Authentification -->
	<!--<script src="../js_auth/jquery.js"></script>-->
	<script src="../Authentification/control_userAjax.js"></script>
        <script>
    $(document).ready(function () {
      alert('bon');
        $(".checkbox_chambre").click(function () {
//            alert('bon2');
             var idchambre = $(this).attr('id');
          alert(idchambre);
            var donnees = $('#form_chambres').serialize();
   $.ajax({
            url: 'php/ajout_chambre_panier.php?idchambre='+idchambre,
            type: 'POST',
            data: donnees,
            success: function (data) {
                  $("#total_chambre").empty().append(data);
            }
        });
        
        });
    });

</script>
    <!-- Reservation -->
    <script src="Traitement_reservation/verification_reservation.js"></script>
    <script src="Traitement_reservation/script_paie.js"></script>

<?php // include('rec_footer.php'); ?>