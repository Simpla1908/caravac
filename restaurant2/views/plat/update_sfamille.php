
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Modification sous famille</h1>
</section>
<!-- Main content -->
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body">
            <form id="form_sfam" method="post" action="Traitement/s_fam_modifier.php"  data-parsley-validate class="form-horizontal form-label-left">
                <input type="hidden" name="id_s_fam" value="<?php echo $s_fam->id_s_fam; ?>">
                <br>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Famille <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="famille_id" name="famille_id" required>
                            <?php
                            echo '<option value=' . $s_fam->idfamille . '>' . $s_fam->designation . '</option>';
                            include('Traitement/famille_combo2.php');
                            foreach ($familles as $f):
                                echo '<option value=' . $f->idfamille . '>' . $f->designation . '</option>';
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Désignation <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="designation"  id="designation"  value="<?php echo $s_fam->des; ?>">
                        <input type="hidden" class="form-control" name="designation_ex" id="designation"  value="<?php echo $s_fam->des; ?>">
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
                        <button type="submit" id="update_s_famille" class="btn btn-success">Modifier</button>
                        <span class="btn btn-info hidden" id="loader_sfam">
                            <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                        </span>
                    </div>
                </div>
                <div id="msg2" class="alert alert-success alert-dismissable" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <span id="msg_alert2">Succès!</span>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->



