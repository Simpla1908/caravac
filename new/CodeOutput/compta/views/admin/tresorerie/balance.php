
<?php
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Balance</h3>
                <ul class="nav pull-right">
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=impression&do=listebc" target="_blank" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                </ul>
            </div><!-- /.box-header -->
            <div class="box-header with-border">
                <!--<div class="col-md-12">-->
                    <form class="form-inline" id="p">
                        <div class="form-group">
                            <label for="ex3">Année</label>
                            <select class="form-control choz"  required>
                                <option>2019</option>
                                 <option>2018</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ex4"> Comparé à </label>
                            <select class="form-control choz"  required>
                                <option> 1 an passé</option>
                                <option> 2 ans passés</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default" style="border: 1px solid black;margin-bottom:-22px;">Valider</button>
                    </form>
<!--                </div>-->
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="example4" class="table table-bordered table-striped table-hover matable table-condensed">
                    <tr>
                        <th rowspan="2" style="text-align: center;">N°</th>
                        <th rowspan="2" style="text-align: center;">LIBELLE</th>
                        <th colspan="2" style="text-align: center;">TOTAL</th>
                        <th colspan="2" style="text-align: center;">SOLDE</th>
                    </tr>
                    <tr>
                        <th style="text-align: center;">Débit</th> 
                        <th style="text-align: center;">Crédit</th> 
                        <th style="text-align: center;">Débitaire</th> 
                        <th style="text-align: center;">Créditaire</th> 
                    </tr>

                    <tr>
                        <th></th>
                        <td style="text-align: center;"></th>
                        <td style="text-align: center;"></td>
                        <td style="text-align: right;"></td>
                        <td style="text-align: center;"></td>
                        <td style="text-align: right;"></td>
                    </tr>
                    <tr>
                        <th colspan="2">Total</th> 
                        <!--<th style="text-align: right;"></th>-->
                        <th colspan="1"></th>
                        <th style="text-align: right;"></th>
                        <th colspan="1"></th>
                        <th style="text-align: right;"></th>
                    </tr>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->