<?php include('Gerant_global.php'); ?>
<?php include('headerRec.php'); ?>
<?php
include('menu_Rec.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Réglages</h3>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Nouveau réglage</h4>
                    <!-- <div class="success" style="margin-top:-40px; margin-left:90px;">Une chambre ajoutée avec succes</div>-->
                    <div style="margin-top:-40px; margin-left:790px;"><a class="btn btn-default btn-lg btn-block"  href="gg_voirreglages.php" style="width:200px;">Voir réglages</a></div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="msg" class="alert alert-success alert-dismissable" style="display:none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        L'enrégistrement s'est effectué avec succès!
                    </div>
                    <div style=" width:400px; border:1px solid #fff;">
                        <BR>

                        <form role="form" method="post"  action="Amelioration/reglage/insertion.php"id="form">

                            <fieldset>
                                <table width="400" border="0" >
                                    <tr>
                                        <td align="right"><label>Taux $ -> FC</label></td>
                                        <td width="30"></td>
                                        <td>
                                            <input name="tauxdollar" class="form-control" type="number" min="1.0" value="" required>
                                        </td>
                                    </tr>
                                    <tr height="15">
                                        <td></td>

                                    </tr>
                                    <tr>
                                        <td align="right"><label>TVA</label></td>
                                        <td width="30"></td>
                                        <td>
                                            <input name="tva" class="form-control" type="number" min="1.0" value="" required>
                                        </td>
                                    </tr>
                                    <tr height="15">
                                        <td></td>

                                    </tr>
                                    <tr>
                                        <td align="right" > <label>Rémise (%)</label></td>
                                        <td width="30"></td>
                                        <td align="center"> <input name="remise" class="form-control"  type="number" min="1.0" required></td>
                                    </tr>
                                    <tr height="15">
                                        <td></td>

                                    </tr>
                                    <tr>
                                        <td align="right" ><label>Majoration (%)</label></td>
                                        <td width="30"></td>
                                        <td align="center"> 
                                            <input name="majoration" class="form-control" type="number" min="1.0" value="" required>
                                        </td>
                                    </tr>

                                    <tr height="15">
                                        <td></td>

                                    </tr>
                                    <tr>
                                        <td align="right"><label>Temps Reglage</label></td>
                                        <td width="30"></td>
                                        <td>

                                            <input name="temps_regl"  type="time" class="form-control" placeholder="00:00:00" required>
                                        </td>
                                    </tr>

                                    <tr height="15">
                                        <td></td> 

                                    </tr>
                                    <tr>
                                        <td align="right"><label>Date</label></td>
                                        <td width="30"></td>
                                        <td>
                                            <input name="date_regl" class="form-control"  type="text"  value="<?php echo date('d/m/Y H:i:s', time() + 3600); ?>" id="datetimepicker6" required>
                                        </td>
                                    </tr>
                                    <tr height="15">
                                        <td></td>

                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td width="30"></td>
                                        <td> <button name="sauvegarder" type="submit" class="btn btn-primary" id="btn_valider"><i class=" fa fa-save"></i>&nbsp;Sauvegarder</button></td>
                                    </tr>
                                </table>
                            </fieldset>

                        </form>
                    </div>
                    <div style=" width:290px; height:270px;margin-left:500px; margin-top:-250px;">

                        <img src="../img/reglage.png">
                        <?php 
                           
                        ?>
                        </font>

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

<!-- jQuery -->


</body>

</html>
