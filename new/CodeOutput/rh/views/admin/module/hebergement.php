
<?php
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Planning</h3>
            </div><!-- /.box-header -->
            <div class="box-header with-border">
                <div class="col-md-12">
                    <form class="form-inline" id="p">
                        <div class="form-group">
                            <label for="ex3">Période du</label>
                            <input id="dte1" nam="dte1" class="form-control datepicker2" placeholder=" " type="text" value="<?php echo dateAffiche($dte1);?>">
                        </div>
                        <div class="form-group">
                            <label for="ex4"> au</label>
                            <input id="dte2" nam="dte2" class="form-control datepicker2" placeholder=" " type="text" value="<?php echo dateAffiche($dte2);?>">
                        </div>
                        <button type="submit" class="btn btn-default hidden">Send invitation</button>
                    </form>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive" id="plannngdiv">
                    <?php 
                    include(APP_FOLDER . '/views/admin/module/pl.php'); ?>
                </div>
                
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->