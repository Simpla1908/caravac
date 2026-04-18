<?php
// Inclusion du fichier contenant la connexion à la base
require '../bdd/connexion.php';
include('Receptionniste.php');
?>
<?php include('head.php'); ?>
<?php include('menu_Rec.php'); ?>
<?php 
$_SESSION['p_debut']=date('d/m/Y');
$_SESSION['p_fin']=date('d/m/Y');
?>

<div id="page-wrapper">
    <div class="col-lg-12">
        <h2 class="page-header">Facturation
        <small class='hidden'> <span id="sous_titre1">Tout</span> <i class="fa fa-sort-desc"></i></small>
        </h2>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div id="total_chambre" class="col-lg-12">
                        <div class="col-md-9">
                            <span id="sous_titre">Aperçu de la facture</span>
                        </div>
                        <div class="col-md-3">
                            <div class="btn-group  btn-group-sm">
                                <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal1" title="Filtrer la liste" >
                                    <i class="fa fa-hourglass-half"></i> Filtrer
                                </a>
                                <?php if (in_array('ER',$_SESSION['actions']['code_actions'])) { ?>
    <!--                            <a href="rec_reservation_multiple.php?hebergement=1" class="btn btn-success" title="Editer une Réservation" >
                                    <i class="fa fa-edit"></i> 
                                </a>-->
                                <?php } ?>

                                <?php if (in_array('ILR',$_SESSION['actions']['code_actions'])){?>
                                <a id="impression" href="#" class="btn btn-primary btn-xs" title="Imprimer la liste">
                                    <i class="fa fa-print"></i> Imprimer
                                </a>
                                <?php } ?>
                            </div>
                        </div> 
                    </div>
                </div>
                    <input type="hidden" name="p_debut" id="p_debut" value="<?php echo $_SESSION['p_debut']; ?>">
                    <input type="hidden" name="p_fin" id="p_fin" value="<?php echo $_SESSION['p_fin'] ; ?>">
                    <input type="hidden" name="type_client" id="type_client" value="tout"> 
                    <input type="hidden" name="service_heb" id="service_heb" value="reservation"> 
            </div>
            <!-- /.panel-heading -->


            <!-- Div stratégique -->
            <div class="panel-body" id="div_datafact">
            
                <!-- /.panel-body -->

            </div>
            <!-- / Div stratégique -->
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<!-- Modal -->
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h5 class="modal-title" id="myModalLabel">Filtrage liste </h5>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="form">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6 form-group">
                                    <label>Partenaire&nbsp;:</label>
                                    <select class="form-control" id="partenaire" name="partenaire" required>
                                        <?php
                                        $requete = $bdd->prepare("SELECT id_respo,entreprise
                                        FROM t_responsable
                                        WHERE company_id=:company_id
                                        AND nom_respo<>'prive'
                                        ");
                                        $requete->BindParam(':company_id',$_SESSION['company_id'] );
                                        $requete->execute();
                                        $responsables = $requete->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($responsables as $resp):
                                        echo '<option lib="' . $resp->entreprise . '" value="' . $resp->id_respo . '">' . $resp->entreprise . '</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label>Type &nbsp;:</label>
                                    <select class="form-control" id="typefact" name="typefact" required>
                                        <option lib="Hébergement" value="heberge" selected="selected">Hébergement</option>
                                        <option lib="Restaurant" value="resto"> Restaurant</option>
                                    </select>
                                </div>
                               
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6 form-group">
                                    <label>Période du&nbsp;:</label>
                                    <input class="form-control" id="datedebut" name="datedebut" required="required" value="<?php echo date('d/m/Y'); ?>">
                                </div>
                                <!-- /.col-lg-6 -->
                                <div class="col-lg-6 form-group">
                                    <label>au&nbsp;:</label>
                                    <input class="form-control" id="datefin" name="datefin" required="required" value="<?php echo date('d/m/Y'); ?>">
                                </div>
                                <!-- /.col-lg-6 -->
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="btn_facturation">&nbsp;Valider</button>
                     <span class="btn btn-danger hidden" id="loader">
                    <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                     </span>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


<!-- jQuery -->
	<script src="../datepicker/jquery.js"></script>
	<script src="../datepicker/jquery.datetimepicker.js"></script>
    <script>
    $('#datedebut').datetimepicker({format: 'd/m/Y'});
    $('#datefin').datetimepicker({format: 'd/m/Y'});
</script>

     <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
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
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
        
        
        $('#btn_facturation').click(function (e) {
            e.preventDefault();
            var bool=false;
            var libentreprise=$('#partenaire option:selected').attr('lib')
            var libtypefact=$('#typefact option:selected').attr('lib')
            var donnees = $('#form').serialize();
            $.ajax({
                url: 'datafacturation.php?libentreprise=' + libentreprise + '&libtypefact=' + libtypefact,
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader").removeClass('hidden');
                    $("#btn_facturation").addClass('hidden');
                },
                success: function (data) {
                    $('#div_datafact').empty().append(data);
                    $("#myModal1").modal('hide');
                    bool=true;

                },complete: function () {
                    if (bool) {
                        $("#loader").addClass('hidden');
                         $("#btn_facturation").removeClass('hidden');
                    } else {
                        $("#loader").removeClass('hidden');
                    }
                }
            });

         });
    
        
        $('#impression').click(function (e) {
         e.preventDefault();
         var libtypefact=$('#typefact option:selected').attr('value');
         if(libtypefact=='heberge'){
                     window.open('impression/imprime_facturation_heberge.php');
         }else{
                    window.open('impression/imprime_facturation_resto.php');
   
         }
     });
        
    });
	
    </script>