<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_client
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<?php // AjaxSearchSuggest(''.H_ADMIN_MAIN.'&view=t_client&do=autosearch'); 
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title" id="titlelcl">Liste des clients</h3>
                <ul class="nav pull-right">
                    <a href="<?php echo H_ADMIN; ?>&view=t_client&do=viewall" class="btn btn-default btn-xs tip hidden" title="Liste des clients"><i class="fa fa-users"></i> Liste des clients</a>
                    <a href="<?php echo H_ADMIN; ?>&view=t_client&do=reservation" class="btn btn-default btn-xs tip hidden" title="Liste des reservations"><i class="fa fa-users"></i> Reservations</a>
                    <a href="<?php echo H_ADMIN; ?>&view=t_client&do=occupation" class="btn btn-default btn-xs tip hidden" title="Liste des occupations"><i class="fa fa-users"></i> Occupations</a>
                    <a href="<?php echo H_ADMIN; ?>&view=t_client&do=liberation" class="btn btn-default btn-xs tip hidden" title="Liste des libérations"><i class="fa fa-users"></i> Libérations</a>
                    <a href="./main.php?pg=admin&view=impression&do=listeclients" target="_blank" class="btn btn-default btn-xs tip" title="Imprimer la liste">
                        <i class="fa fa-print"></i> Imprimer
                    </a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">
                <table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Compte</th>
                            <th>Noms</th>
                            <th data-hide="phone,tablet">Téléphone</th>
                            <th data-hide="phone,tablet">Email</th>
                            <th data-hide="phone,tablet">Sexe</th>
                            <th data-hide="phone,tablet">Adresse</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        //Mise en session pour impression
                        $_SESSION['client'] = array();
                        $_SESSION['client']['i'] = array();
                        $_SESSION['client']['compte'] = array();
                        $_SESSION['client']['nom'] = array();
                        $_SESSION['client']['entreprise'] = array();
                        $_SESSION['client']['telephone'] = array();
                        $_SESSION['client']['email'] = array();
                        $_SESSION['client']['sexe'] = array();
                        $_SESSION['client']['adresse'] = array();
                        //Fin mise en session
                        $i = 1;
                        foreach ($result as $rows) {
                            //GetAccountCustomer($rows->id_sous_compte, $bdd);
                            //  $compte = $_SESSION['souscomptes_num'];
                            array_push($_SESSION['client']['i'], $i);
                            array_push($_SESSION['client']['compte'], $rows->suffixcompt);
                            array_push($_SESSION['client']['nom'], $rows->nom_client);
                            array_push($_SESSION['client']['telephone'], $rows->telephone_client);
                            array_push($_SESSION['client']['email'], $rows->email_client);
                            array_push($_SESSION['client']['sexe'], $rows->sexe_client);
                            array_push($_SESSION['client']['adresse'], $rows->adresse_provenance_client);

                        ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $rows->suffixcompt; ?></td>
                                <td><?php echo $rows->nom_client; ?></td>
                                <td><?php echo $rows->telephone_client; ?></td>
                                <td><?php echo $rows->email_client; ?></td>
                                <td><?php echo $rows->sexe_client; ?></td>
                                <td><?php echo $rows->adresse_provenance_client; ?></td>
                                <td class="table-actions">
                                    <div class="btn-group">
                                        <?php if (in_array('MINFCLI', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                                            <a href="<?php echo H_ADMIN; ?>&view=t_client&id_client=<?php echo $rows->id_client; ?>&do=update" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>
                                        <?php } ?>
                                        <?php if (in_array('SCLI', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                                            <a href="<?php echo H_ADMIN; ?>&view=t_client&id_client=<?php echo $rows->id_client; ?>&do=delete" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>
                                        <?php } ?>


                                    </div>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>

            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->