<?php
/*
 * =======================================================================
 * FILE NAME:        Details.php
 * DATE CREATED:  	08-02-2018
 * FOR TABLE:  		resconfig
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Configurations</h3>
                <ul class="nav pull-right">
                    <a href="<?php echo H_ADMIN; ?>&view=facconfig&id=<?php echo $rows->id; ?>&do=update2" title="<?php echo LANG_TIP_UPDATE; ?> Réglage" class="btn btn-default btn-xs tip"><i class="fa fa-edit"></i> Modifier</a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">
                <table data-page="false" class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <th>Logo</th>
                            <td><img src="<?php echo THUMB_FOLDER . $rows->logo; ?>" height="100"></td>
                        </tr>
                        <tr>
                            <th>Taux</th>
                            <td><?php echo $rows->taux; ?></td>
                        </tr>

                        <tr>
                            <th>TVA</th>
                            <td><?php echo $rows->tva; ?> %</td>
                        </tr>
                        <!-- <tr>
                            <th>Initial Compte Responsable</th><td><?php //echo $rows->pointage; 
                                                                    ?></td>
                        </tr> -->
                        <tr>
                            <th>Monnaie insertion </th>
                            <td><?php echo $rows->m_insert; ?></td>
                        </tr>

                        <tr>
                            <th>Monnaie facture</th>
                            <td><?php echo $rows->m_affich; ?></td>
                        </tr>

                        <tr>
                            <th>Préfixe facture</th>
                            <td><?php echo $rows->prefsanct; ?></td>
                        </tr>
                        <tr>
                            <th>Préfixe reçu</th>
                            <td><?php echo $rows->prefconge; ?></td>
                        </tr>
                        <tr>
                            <th>Heure d'entrée</th>
                            <td><?php echo $rows->checkin; ?></td>
                        </tr>

                        <tr>
                            <th>Heure de sortie</th>
                            <td><?php echo $rows->checkout; ?></td>
                        </tr>
                        <tr>
                            <th>Annulation réservation</th>
                            <td><?php echo $libellepenalite; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->