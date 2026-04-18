
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Modification famille</h1>
</section>
<!-- Main content -->
<!-- Main content -->
<section class="content">
    <div class="box">

        <div class="box-body">
            <form id="formfamEdit" method="post" action="Traitement/fam_modifier.php"  data-parsley-validate class="form-horizontal form-label-left">
            <input type="hidden" name="idfamille" value="<?php echo $fam->idfamille; ?>">
            <br>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="designation">Désignation <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" name="designation" id="designation" value="<?php echo $fam->designation; ?>">
                    <input type="hidden" class="form-control" name="designation_ex" id="designation" required value="<?php echo $fam->designation; ?>">
                </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
                    <button type="submit" id="update_famille" class="btn btn-success">Modifier</button>
                    <span class="btn btn-info hidden" id="loader_fam">
                        <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                    </span>
                </div>
            </div>
            <div id="msg1" class="alert alert-success alert-dismissable" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <span id="msg_alert1">Succès!</span>
            </div>
        </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->



