<?php include('Receptionniste.php'); ?>
<?php include('headerRec.php'); ?>
<?php include('menu_Rec.php'); ?>
<?php unset($_SESSION['panier']); ?>


<div id="page-wrapper" style=" height:auto;">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                <?php
                if (isset($_GET['hebergement']) && ($_GET['hebergement'] == 1)) {

                    echo 'Réservation';
                    $res = 1;
                    $_SESSION['hebergement'] = 1;
                } else {
                    echo'Occupation directe';
                    $res = 2;
                    $_SESSION['hebergement'] = 2;
                }
                ?>
            </h2>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>
                            <?php
                            if (isset($_GET['hebergement']) && $_GET['hebergement'] == 1) {
                                echo 'Enregistrement réservation';
                            } else {
                                echo'Enregistrement occupation';
                            }
                            ?>										
                        </h4>

                        <div class="pull-right" style="margin-top:-30px;">
                            <!-- Bloc de boutton -->                               
                            <table width="132" border="0">
                                <tr>
                                    <td> 
                                        <a class="btn btn-primary" href="rec_ajout_client.php" style="font-style:italic;"><i class="fa fa-user-plus"></i> Ajouter un client</a>                     
                                    </td>
                                </tr>
                            </table>
                            <!-- / Bloc de boutton -->  
                        </div>
                    </div>

                    <!-- /.panel-heading -->
                    <div class="box-body">
                        <BR>
                        <form role="form" method="post" action="Traitement_reservation/envoi_data_reservation.php">
                            <fieldset>
                                <input name="heberge" id="hebergement" type="hidden" value="<?php echo $res; ?>">
                                

                                
                                
                                <table width="852" border="0"  style="margin-left:20px;">
                                    <tr>
                                        <td align="right" > <label for="date">Date&nbsp;/&nbsp;Heure <span class="required">*</span>&nbsp;:</label></td>
                                        <td width="30"></td>
                                        <td align="center">
                                            <input type="text" class="form-control"  name="date_res" id="datetimepicker6"  value="<?php echo date('d/m/Y H:i:s', time() + 3600); ?>" required>
                                        </td>
                                    </tr>
                                    <tr height="15">
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td align="right" > <label>Client <span class="required">*</span>&nbsp;:</label></td>
                                        <td width="30"></td>
                                        <td align="center"> 
                                            <select class="form-control select2" name="id_client" id="id_client" style="width: 100%;" required="required">
                                                <option value=" ">Selectionner un client</option>
                                                <?php
                                                if (isset($_GET['nom_client']) && isset($_GET['id_client'])) {
                                                    echo '<option value="' . $_GET['id_client'] . '" selected>' . $_GET['nom_client'] . '</option>';
                                                } else {
                                                    echo'<option> </option>';
                                                }
                                                ?>

                                                <?php
                                                include '../bdd/connexion_mysql.php';
                                                $result = mysql_query("SELECT * FROM  t_client c WHERE c.id_hotel='$id_hotel' AND c.type='client' ORDER BY c.id_client DESC") or die(mysql_error());
                                                while ($row = mysql_fetch_array($result)) {
                                                    if (isset($_GET['nom_client']) && isset($_GET['id_client'])) {
                                                        if ($row['id_client']!=$_GET['id_client']) {
                                                        echo '<option value="' . $row['id_client'] . '">' . $row['nom_client'] . '</option>';
                                                    }
                                                    } else {
                                                        echo '<option value="' . $row['id_client'] . '">' . $row['nom_client'] . '</option>';
                                                    }
                                                }
                                                mysql_free_result($result);
                                                ?>
                                            </select>
                                        </td>
                                        <td width="30"></td>
                                        <td align="right" ></td>
                                        <td width="30"></td>
                                        <td align="center">

                                        </td>
                                    </tr>
                                    <tr height="15">
                                        <td></td>
                                    </tr>
                                    <tr height="15" style="display:none;">
                                        <td align="right" > <label>Commissionnaire&nbsp;:</label></td>
                                        <td width="30"></td>
                                        <td>
                                            <select class="form-control" name="id_ch" id="id_commissionnaire1" >
                                                <option></option>
                                                <?php
                                                include '../bdd/connexion_mysql.php';
                                                $result = mysql_query("SELECT id_com, nomcom FROM t_commussionnaire ORDER BY id_com ASC") or die(mysql_error());
                                                while ($row = mysql_fetch_array($result)) {
                                                    echo '<option value="' . $row['id_com'] . '">' . $row['nomcom'] . '</option>';
                                                }
                                                mysql_free_result($result);
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr height="15">
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td align="right" > <label for="date">Date prévue d'arrivée <span class="required">*</span>&nbsp;:</label></td>
                                        <td width="30"></td>
                                        <td align="center">
<?php if (isset($_GET['date_occ']) && isset($_GET['id_ch'])) { ?>
                                                <input type="text" class="form-control"  name="date_arrive"  id="datetimepickerOcc"  value="<?php if (isset($_GET['date_occ']) && isset($_GET['id_ch'])) {
        echo $_GET['date_occ'];
        $_SESSION['panier'][$_GET['id_ch']] = 1;
    } else {
        echo' ';
    } ?>" required disabled>
                                                <input type="hidden" class="form-control"  name="date_arrive"  id="datetimepickerOcc"  value="<?php if (isset($_GET['date_occ']) && isset($_GET['id_ch'])) {
                                                echo $_GET['date_occ'];
                                                $_SESSION['panier'][$_GET['id_ch']] = 1;
                                            } else {
                                                echo' ';
                                            } ?>" required>
    <?php } else {
    ?>
                                                <input type="text" class="form-control"  name="date_arrive"  id="datetimepickerOcc" required>
    <?php }
?>

                                        </td>
                                        <td width="30"></td>
                                        <td align="right" > <label for="date">Date prévue de sortie <span class="required">*</span>&nbsp;:</label></td>
                                        <td width="30"></td>
                                        <td align="center">

                                            <input type="text" class="form-control"  name="date_sortie" id="datetimepickerLib" required>
                                        </td>
                                    </tr>
                                    <tr height="15">
                                        <td></td>
                                    </tr>
                                    <tr style="display:none;">
                                        <td align="right" > <label for="date">Adulte&nbsp;:</label></td>
                                        <td width="30"></td>
                                        <td align="center">

                                            <input type="number" min="1" class="form-control"  name="adulte" id="adulte"/>
                                        </td>
                                        <td width="30"></td>
                                        <td align="right" > <label for="date">Enfant&nbsp;:</label></td>
                                        <td width="30"></td>
                                        <td align="center">

                                            <input type="number" min="0" class="form-control" value="0"  name="enfant" id="enfant"/>
                                        </td>
                                    </tr>
                                    <tr height="15">
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td align="right" > </td>
                                        <td width="30"></td>
                                        <td align="center"></td>
                                        <td width="30"></td>
                                        <td align="right" ></td>
                                        <td width="30"></td>
                                        <td align="right">
                                            <button  name="suivant"  id="suivant1" type="submit" class="btn btn-success"><i class=" fa fa-arrow-right"></i>&nbsp;&nbsp;Suivant</button>
                                        </td>
                                    </tr>
                                </table>
                                <div style=" width:400px; height:200px; margin-left:525px; margin-top:-210px; border:1px solid #fff;"></div>
                                <br>
                            </fieldset>

                        </form>
                    </div>
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

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });

</script>
<!-- Authentification -->
	<!--<script src="../js_auth/jquery.js"></script>-->
	<script src="../Authentification/control_userAjax.js"></script>
    <!-- Reservation -->
    <script src="Traitement_reservation/verification_reservation.js"></script>
    <script src="Traitement_reservation/script_paie.js"></script>

<?php // include('rec_footer.php'); ?>
