
<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		ressalaire
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

?>

<form action="<?php echo H_ADMIN_MAIN . '&view=ressalaire&do=addpro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />

            <a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=viewall" class="btn btn-default btn-sm tip hidden" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <h3 class="panel-title">Paie  
                <?php 
                   
                var_dump(PeriodePaie(date('Y-m-d')));
                ?>
                </h3></div>
            <div class="panel-body">
                <div class="output"></div>
                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
                            <div class="form-group">
                                <label for="libelle" class="col-sm-3 control-label">Employé</label>
                                <div class="col-sm-9">
                                    <select id="employe_id" name="employe_id"  class="form-control choz">
                                         <option value="">Sélectionner un employé</option>
                                        <?php
                                        foreach ($employes as $rows) {
                                            ?>
                                            <option value="<?php echo $rows->id; ?>"><?php echo $rows->noms; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="salbase" class="col-sm-3 control-label">Période</label>
                                <div class="col-sm-9">
                                    <select id="devise" name="devise"  class="form-control choz">
                                        <option>Selectionnez</option>
                                        <option value="USD">USD</option>
                                        <option value="CDF">CDF</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nbjrpreste" class="col-sm-3 control-label">Jours Prestés</label>
                                <div class="col-sm-9">
                                     <input id="nbjrpreste" name="nbjrpreste" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nbjrconge" class="col-sm-3 control-label">Jours Congés</label>
                                <div class="col-sm-9">
                                     <input id="nbjrconge" name="nbjrconge" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nbjrconge" class="col-sm-3 control-label" title="">Heure supplémentaire</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-xs-6">
                                             <input id="hrsup" name="hrsup" type="text" class="form-control">
                                        </div>
                                        <div class="col-xs-6">
                                            <select id="devise" name="ophrsup"  class="form-control choz">
                                                <option value="0">Exonéré</option>
                                                <option value="1">Payé</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                 <label for="" class="col-sm-3 control-label"></label>
                                 <div class="col-sm-9">
                                    <table class="table table-condensed table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th style="width: 10px"></th>
                                                    <th>Prime</th>
                                                    <th>Montant</th>
                                                </tr>
                                                <?php
//                                                foreach ($horaires as $rows) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="horaire_ids[]" value="<?php // echo $rows->idh ?>">
                                                            <input type="hidden" name="nbrjrstrav[]" value="<?php // echo $rows->nbrjrstrav ?>">
                                                        </td>
                                                        <td><?php // echo $rows->libh ?></td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-xs-6">
                                                                     <input id="montprime" name="montprime[]" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php // } ?>
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
