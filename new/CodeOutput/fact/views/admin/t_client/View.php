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
                <h3 class="box-title">Liste des clients</h3>
                <ul class="nav pull-right">
                    <!-- <a href="<?php echo H_ADMIN; ?>&view=paiement&do=extraitcompte" class="btn btn-primary btn-sm tip" title="Extrait de compte"><i class="fa fa-circle-o"></i> Extrait de compte</a> -->
                    <!--<a href="<?php echo H_ADMIN; ?>&view=t_client&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD; ?></a>-->
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=impression&do=prnt_client" target="_blank" class="btn btn-default btn-sm tip btn_prnt_client" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">

                <!--AUTO COMPLETE-->
                <div class="col-md-3 autosearch hidden">
                    <div class=" s-absolute">
                        <div class="input-group">
                            <input type="text" class="form-control input-sm styler" id="inputString" onkeyup="lookup(this.value);" placeholder="search" autocomplete="off">
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="button"><span class="fa fa-search"></span></button>
                            </span>
                        </div><!-- /input-group -->
                        <div id="suggestions"></div>
                    </div>
                </div>
                <!--/col-lg-3-->
                <!--/AUTO COMPLETE-->

                <table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Noms</th>
                            <th data-hide="phone,tablet">Entreprise</th>
                            <th data-hide="phone,tablet">Téléphone</th>
                            <th data-hide="phone,tablet">Email</th>
                            <th data-hide="phone,tablet">Sexe</th>
                            <th data-hide="phone,tablet">Adresse</th>
                            <th data-hide="phone,tablet">Compte</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $i = 1;
                        //Mise en session pour impression
                        $_SESSION['rows_client'] = array();
                        $_SESSION['rows_client']['i'] = array();
                        $_SESSION['rows_client']['entreprise'] = array();
                        $_SESSION['rows_client']['nomclient'] = array();
                        $_SESSION['rows_client']['telephone'] = array();
                        $_SESSION['rows_client']['email'] = array();
                        $_SESSION['rows_client']['sexe'] = array();
                        $_SESSION['rows_client']['adresse'] = array();
                        //Fin mise en session
                        $entreprise = '-';
                        $nomclient = "-";
                        foreach ($result as $rows) {
                            //                            $entreprise='---';
                            if (!empty($rows->designation)) {
                                $entreprise = $rows->designation;
                                $nomclient = $rows->nom_client;
                            } else {
                                $entreprise = $rows->nom_client;
                                $nomclient = "-";
                            }

                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $entreprise; ?></td>
                                <td><?php echo $nomclient; ?></td>
                                <td><?php echo $rows->telephone_client; ?></td>
                                <td><?php echo $rows->email_client; ?></td>
                                <td><?php echo $rows->sexe_client; ?></td>
                                <td><?php echo $rows->adresse_provenance_client; ?></td>
                                <td><?php echo $rows->suffixcompt; ?></td>

                                <td class="table-actions">
                                    <div class="btn-group">
                                        <a href="<?php echo H_ADMIN; ?>&view=t_client&id_client=<?php echo $rows->id_client; ?>&do=update" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>
                                        <a href="<?php echo H_ADMIN; ?>&view=t_client&id_client=<?php echo $rows->id_client; ?>&do=delete" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            //Mise en session pour impression
                            array_push($_SESSION['rows_client']['i'], $i);
                            array_push($_SESSION['rows_client']['entreprise'], $entreprise);
                            array_push($_SESSION['rows_client']['nomclient'], $nomclient);
                            array_push($_SESSION['rows_client']['telephone'], $rows->telephone_client);
                            array_push($_SESSION['rows_client']['email'], $rows->email_client);
                            array_push($_SESSION['rows_client']['sexe'], $rows->sexe_client);
                            array_push($_SESSION['rows_client']['adresse'], $rows->adresse_provenance_client);
                            //Fin mise en session
                            $i++;
                        }
                        ?>
                    </tbody>
                    <!-- <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="pagination"><?php // echo $paging; 
                                                        ?></div>
                            </td>
                        </tr>
                    </tfoot>-->
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->