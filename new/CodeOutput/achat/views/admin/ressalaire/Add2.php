
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
//var_dump($rubriques);
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
                </h3></div>
            <div class="panel-body">
                <div class="output"></div>
                <div class="form-horizontal">
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong><?php echo ucwords('Employé') ?></strong><br>

                                Matricule: <?php // echo $responsable   ?><br>
                                Noms: <?php // echo $provenance   ?><br>
                                Fonction: <?php // echo $adresse   ?><br>
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong><?php echo ucwords('Période') ?></strong><br>
                                Libellé : <?php // echo $type_cl   ?><br>
                                Date: <?php // echo $responsable   ?><br>
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong><?php echo ucwords('Prestation') ?></strong><br>
                                Jours prestés : <?php // echo $type_cl   ?><br>
                                Jours congé: <?php // echo $responsable   ?><br>
                                Heures supplémentaires: <?php // echo $responsable   ?><br>
                            </address>
                        </div>
                    </div>
                    
                </div>
                <table class="table table-condensed table-bordered">
                    <tbody>
                        <tr>
                            <th>N°</th>
                            <th>Rubriques</th>
                            <th>Montant</th>
                        </tr>
                        <?php
                        $i=1;
                      foreach ($rubriques as $rows) {
                       if($rows->type=='remuneration'){
                        ?>
                        <tr>
                            <td>
                                <?php echo $i  ?>
                                <input type="hidden" name="rubrique_ids[]" value="<?php echo $rows->id ?>">
                            </td>
                            <td><?php echo $rows->libelle  ?></td>
                            <td>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input id="montprime" name="montprime[]" type="text" class="form-control">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php $i++;}} ?>
                        <?php
                      foreach ($rubriques as $rows) {
                       if($rows->type=='retenue'){
                        ?>
                        <tr>
                            <td>
                                <?php echo $i  ?>
                                <input type="hidden" name="rubrique_ids[]" value="<?php echo $rows->id ?>">
                            </td>
                            <td><?php echo $rows->libelle  ?></td>
                            <td>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input id="montprime" name="montprime[]" type="text" class="form-control">
                                    </div>
                                </div>
                            </td>
                        </tr>
                       <?php $i++;}} ?>
                        <?php
                           $nbre=count($_SESSION['rubrique_ids']);
                            for ($j = 0; $j <= $nbre - 1; $j++) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $i  ?>
                                <input type="hidden" name="rubrique_ids[]" value="<?php echo $_SESSION['rubrique_ids'][$j] ?>">
                            </td>
                            <td><?php echo $_SESSION['libelles'][$j]  ?></td>
                            <td>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input id="montprime" name="montprime[]" type="text" value="<?php echo $_SESSION['montprime'][$j]  ?>" class="form-control">
                                    </div>
                                </div>
                            </td>
                        </tr>
                       <?php $i++;} ?>
                    </tbody>
                </table>
                
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
            </div>

        </div><!--/col-12-->
</form>
