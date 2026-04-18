
<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	09-07-2018
 * FOR TABLE:  		ach_livraison
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

//Declaration session pour impression
$_SESSION['rows_livraison'] = array();
$_SESSION['rows_livraison']['i'] = array();
$_SESSION['rows_livraison']['num_liv'] = array();
$_SESSION['rows_livraison']['num_cmd'] = array();
$_SESSION['rows_livraison']['date'] = array();
$_SESSION['rows_livraison']['fsse'] = array();
$_SESSION['rows_livraison']['user'] = array();
//Fin Declaration session

?>
<?php AjaxSearchSuggest('' . H_ADMIN_MAIN . '&view=ach_livraison&do=autosearch'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title titrepg">Liste de Livraison</h3>
                <ul class="nav pull-right">
                    
                    <?php if (in_array('ACHEL', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                    <a href="<?php echo H_ADMIN; ?>&view=ach_livraison&do=add" class="btn btn-danger btn-sm tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-save"></i> Enregistrer</a>
                    <?php } ?>
                    <a  class="btn btn-primary btn-sm tip" title="Filtrer la liste" data-toggle="modal" data-target="#modalfiltre"><i class="fa fa-sort"></i> Filtrer</a>
                    <?php if (in_array('ACHIL', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=impression&do=listeliv" target="_blank" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                    <?php } ?>
<!--                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=ach_livraison&do=export&hexport=yes&etype=excel" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_EXCEL; ?>"><i class="fa fa-table"></i> <?php echo LANG_EXCEL; ?></a>
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=ach_livraison&do=export&hexport=yes&etype=word" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_WORD; ?>"><i class="fa fa-file-o"></i> <?php echo LANG_WORD; ?></a>
                    <a href="<?php echo H_ADMIN; ?>&view=ach_livraison&do=truncate" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_TRUNCATE; ?>" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><i class="fa fa-trash-o"></i> <?php echo LANG_TRUNCATE; ?></a>-->
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">
                <table data-page="false" class="table table-bordered table-condensed table-hover table-striped t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th data-hide="phone,tablet">N° Bon livraison</th>
                            <th data-hide="phone,tablet">N° Bon commande</th>
                            <th data-hide="phone,tablet">Date</th>
                            <th data-hide="phone,tablet">Fournisseur</th>
                            <th data-hide="phone,tablet">Utilisateur</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody id="dataview">
                        <?php
                        $i=1;
                        foreach ($result as $rows) {
                            $format1='0000-00-00 00:00:00'; 
                            $format2='00-00-0000 00:00:00';
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $rows->numBon_liv; ?></td>
                                <td><a href="<?php echo H_ADMIN; ?>&view=ach_livraison&id_liv=<?php echo $rows->id_liv; ?>&bcommande_id=<?php echo $rows->bcommande_id; ?>&do=fiche"  class="btn btn-info btn-xs"><?php echo $rows->num_cmd; ?></a></td>
                                <td><?php echo format_stringdateTodatetime('Y-m-d H:i:s', $rows->date_h, 'd/m/Y H:i:s');//dateAffiche($rows->date); ?></td>
                                <td><?php echo ucfirst($rows->nom_entreprise); ?></td>
                                <td><?php echo ucfirst($rows->nom_user.' '.$rows->prenom_user); ?></td>
                                <td class="table-actions">
                                    <div class="btn-group">
                                        <a href="<?php echo H_ADMIN; ?>&view=ach_livraison&id_liv=<?php echo $rows->id_liv; ?>&do=details"  class="btn btn-info btn-xs"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS; ?>"></span></a>
                                        <?php if (in_array('ACHML', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                                        <a href="<?php echo H_ADMIN; ?>&view=ach_livraison&id_liv=<?php echo $rows->id_liv; ?>&do=update" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>
                                        <?php } ?>
                                        <?php if (in_array('ACHSL', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                                        <a href="<?php echo H_ADMIN; ?>&view=ach_livraison&id_liv=<?php echo $rows->id_liv; ?>&do=delete" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                        <?php 
                        $_SESSION['datedebut']='';
                        $_SESSION['datefin']='';
                        unset($_SESSION['datedebut']);
                        unset($_SESSION['datefin']);
                        //Mise en session pour impression
                        array_push($_SESSION['rows_livraison']['i'], $i);
                        array_push($_SESSION['rows_livraison']['num_liv'], $rows->numBon_liv);
                        array_push($_SESSION['rows_livraison']['num_cmd'], $rows->num_fact);
                        array_push($_SESSION['rows_livraison']['date'], dateAffiche($rows->date));
                        array_push($_SESSION['rows_livraison']['fsse'], ucfirst($rows->nom_entreprise));
                        array_push($_SESSION['rows_livraison']['user'], ucfirst($rows->nom_user.' '.$rows->prenom_user));
                        //Fin mise en session
                        
                        $i++;} ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

  <!-- Modal -->
<div class="modal fade" id="modalfiltre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form class="form-inline" id="frmfiltre" name="frmfiltre">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Filtrage</h4>
            </div>
            <div class="modal-body text-center">
            	  <div class="output"></div>

                <div class="form-group">
                        <label for="dte1">Du</label>
                          <input name="datedebut" id="datedebut" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control datepicker2"> 
                    </div>
                    <div class="form-group">
                        <label for="dte2">au</label>
                        <input name="datefin" id="datefin" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control datepicker2">
                    </div>
        </div>
        <div class="modal-footer">
            <div id="msg_popup" class="text-danger text-left col-md-10" style="display:none;">
                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                <span id="msg_alert_popup">Veuillez saisir les valeurs correctes dans tous les champs!</span>
            </div>
            <button  class="btn btn-danger pull-right col-md-2"
                id="btnfiltre"><i class="fa fa-check fa-fw"></i>&nbsp;Valider
            </button>
            <span class="btn btn-info hidden pull-right" id="loader">
                <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
            </span>
        </div>
        </div>
        <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->