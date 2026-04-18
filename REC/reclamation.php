<?php include('Receptionniste.php'); ?>
<?php include('head.php'); ?>
<?php include('menu_Rec.php'); ?>

<div id="page-wrapper" style=" height:650px;">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Réclamations</h3>
            <div id="msg" class="alert alert-success alert-dismissable" style="display:none;">
                <span id="msg_alert">Votre enregistrement est effectué avec succes!</span>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div id="total_chambre" class="col-lg-12">
                            <div class="col-md-9">
                                <i class="fa fa-save"></i> Enregistrer
                            </div>
                            <div class="col-md-3">
                                <?php if (in_array('LSTRECL',$_SESSION['actions']['code_actions'])){?>
                                <a class="btn btn-primary btn-xs"  href="reclamations_view.php"><i class="fa fa-list"></i> Liste de reclamations</a>
                                <?php }?>
                            </div> 
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal form-label-left" method="POST" id="form_reclamation" action='Traitement/insertion_reclamation.php'>
<!--                  <div class="form-group">
                    <label class="control-label col-md-3" for="Niveau">Niveau / Etage <span class="required">*</span>
                    </label>
                    <div class="col-md-7">
                        <select class="select2 form-control col-md-7 col-xs-12" name="niveau" id="niveau">
                        <option></option>
                        <option value="1">Niveau 1</option>
                      </select>
                    </div>
                  </div>-->
                  <div class="form-group">
                    <label class="control-label col-md-3" for="last-name">Chambre <span class="required">*</span>
                    </label>
                    <div class="col-md-7">
                      <select class="select2 form-control col-md-7 col-xs-12" name="chambre_id" id='chambre_id'>
                        <option></option>
                        <?php
                        include '../bdd/connexion.php';
                        
                        $requete = $bdd->prepare("SELECT * FROM t_chambre WHERE id_hotel=:hotel_id");
                        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                        $requete->execute();
                        $operation_ch = $requete->fetchAll(PDO::FETCH_OBJ);

                        foreach ($operation_ch  as $ch):
                            echo '<option value=' . $ch->id_ch . '>' . 'CH'.$ch->num_ch . '</option>';
                        endforeach;
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Réclamation <span class="required">*</span></label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <textarea name="reclamation" id="reclamation" class="resizable_textarea form-control" type="text" placeholder="Noter les plaintes et rémarques que les clients font pour cette chambre..."></textarea>
                    </div>
                  </div>
                 <?php if (in_array('ENRECL',$_SESSION['actions']['code_actions'])){?>
                    <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success" id="save_reclamation"><i class="fa fa-save"></i> &nbsp;Enregistrer</button>
                    </div>
                  </div>
                  <?php }?>
                </div>
              </div>
                </form>
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

<?php include('gl_footer.php'); ?>
<script type="text/javascript">

$('#save_reclamation').click(function (event) {
//    alert('gggh');
        event.preventDefault();
        var donnees = $('#form_reclamation').serialize();
        $.ajax({
            url: 'Traitement/insertion_reclamation.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (data.message == 'succes') {
                    $("#chambre_id").removeAttr('selected');
                    $("#reclamation").val(' ');
                    $('#msg').show().fadeOut(5000);
                }else{
                $('#msg').show().fadeOut(5000);
                  $('#msg_alert').text('Veuillez remplir tous les champs');
                }

            }, dataType: 'json'
        });
});
</script>