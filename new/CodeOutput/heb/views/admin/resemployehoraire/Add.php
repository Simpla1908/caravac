
<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	30-10-2017
 * FOR TABLE:  		resemployehoraire
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=resemployehoraire&do=addpro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />

            <a href="<?php echo H_ADMIN; ?>&view=resemployehoraire&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title">Affectation horaire</h3></div>
            <div class="panel-body">
                <div class="output"></div>
                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <br>

                            <div class="form-group">
                                <label class="col-sm-3 control-label tip"  title="Sélectionner un ou plusieurs employés" for="libelle">Employés</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 styler" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" id="employe_id" name="employe_ids[]">
                                        <option value=""></option>
                                        <?php
                                        foreach ($result as $rows) {
                                            ?>
                                            <option value="<?php echo $rows->id; ?>"><?php echo $rows->noms; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="libelle"></label>
                                <div class="col-sm-9">
                                    <table class="table table-condensed table-bordered">
                                        <tbody>
                                            <tr>
                                                <th style="width: 10px"></th>
                                                <th>Horaire</th>
                                                <th>Séquence en semaine</th>
                                                <th>Priorité</th>
                                            </tr>
                                             <?php
                                                foreach($horaires as $rows)
                                                   {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="horaire_ids[]" value="<?php echo $rows->idh?>">
                                                    <input type="hidden" name="nbrjrstrav[]" value="<?php echo $rows->nbrjrstrav?>">
                                                </td>
                                                <td><?php echo $rows->libh?></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-xs-8">
                                                           <select class="form-control choz" id="seq" name="seqs[]">
                                                                <?php
                                                                for ($i = 1; $i <=4; $i++) {
                                                                    ?>
                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                           <select class="form-control choz" id="priorite" name="priorites[]">
                                                                <?php
                                                                for ($i = 1; $i <=4; $i++) {
                                                                    ?>
                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                         <?php }?>
                                        </tbody>
                                    </table>
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
            </div>



        </div><!--/col-12-->

</form>
