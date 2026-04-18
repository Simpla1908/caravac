<?php include('Gerant_local.php'); ?>
<?php include('headerRec.php'); ?>
<?php include('./menu_Rec_config.php'); ?>

<div id="page-wrapper">        
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Liste de chambres
                <div class="pull-right"><a href="#"><i class="fa fa-mail-reply-all"></i> Retour</a></div>
            </h3>
            <div class="row" >
                <div class="col-lg-12 hotel_class">
                    <?php
//                                                            include('Traitement/fam_prod_s_fam_view.php');
                    include '../bdd/connexion_mysql.php';
                    $result = mysql_query("SELECT * FROM  t_hotel h  ORDER BY h.nom_hotel ASC") or die(mysql_error());
                    while ($rows = mysql_fetch_assoc($result)) {
                        ?>
                        <a href="#" class="btn btn-squared-default-plain btn-info cat" id="<?php echo $rows['id_hotel']; ?>"  id1="<?php echo $rows['nom_hotel']; ?>">
                            <i class="fa fa-home fa-5x"></i><br/>
                            <?php echo ucfirst($rows['nom_hotel']); ?>
                        </a>

                    <?php }
                    ?>
                </div>
                <!-- /.box -->


                <div class="col-lg-12 chambre_class" style="display:none">
<!--                                                            <ol class="breadcrumb"><li><span class="step size-64 tit_cat" style=" text-align:left"></span></li></ol>                                                  -->
                    <?php
                    $result = mysql_query("SELECT c.id_ch,c.num_ch,c.tarif_ch,k.lib_cat_cha,n.lib_niv_cha,c.id_hotel FROM  t_chambre c,categorie_chambre k,niveau_chambre n WHERE c.categorie=k.id_cat_cha AND c.niveau=n.id_niv_cha ORDER BY c.id_ch ASC") or die(mysql_error());
                    ?>
                    <?php
                    while ($rows = mysql_fetch_assoc($result)) {
                        $id_hotel = $rows['id_hotel'];
                        ?>
                        <a class="btn btn-app <?php echo $rows['id_hotel']; ?> cha" id="<?php echo $rows['id_ch']; ?>" style=" display: none;height: 100px; ">
                            <span class="badge bg-aqua" style=" background-color: blue"><?php echo ucfirst($rows['tarif_ch']) . ' $'; ?></span>
                            <i class="fa fa-bed"></i>
                            <?php echo 'Ch :' . $rows['num_ch']; ?><br>
                            <?php echo ucfirst($rows['lib_cat_cha']) ?><br>
                            <?php echo ucfirst($rows['lib_niv_cha']) ?><br>

                        </a>

                    <?php }
                    ?> 
                    <?php if (in_array('CCC',$_SESSION['actions']['code_actions'])){?>
                    <a href="gl_ajout_chambre.php?id_hotel=<?php echo $id_hotel; ?>" class="btn btn-squared-default-plain btn-warning cha_btn_add" style="display: none; margin-top: -10px; margin-left: 10px;">
                        <i class="fa fa-plus-circle fa-3x"></i><br/>
                        Ajouter <br/>Chambre
                    </a>
                    <?php }
                    ?> 
                </div>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>  <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<style>
    .btn-squared-default {
        width: auto !important;
        height: 100px !important;
        font-size: 12px;
    }
    .btn-squared-default:hover {
        border: 3px solid white;
        font-weight: 800;
    }

    .btn-squared-default-plain {
        width: auto !important;
        height: 100px !important;
        font-size: 12px;
    }
    .btn-squared-default-plain:hover {
        border: 0px solid white;
    }
</style>
<!-- Square Buttons Effects - END -->
<!-- jQuery -->
<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/sb-admin-2.js"></script>
<script src="js/script.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>
</body>

</html>
