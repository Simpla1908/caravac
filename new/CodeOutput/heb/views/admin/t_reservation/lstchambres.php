
<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_reservation
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>

<!-- Modal service-->
<div class="modal fade" id="mdchambres" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Liste des chambres disponibles</h4>
            </div>
            <div class="modal-body">
                <form id="chambreform">
                    <div class="table-responsive no-padding" style="overflow: auto; height: 300px;">
                        <table class="table table-hover table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <th></th>
                                    <th>Désignation</th>
                                    <th>Prix</th>
                                </tr>
                                <?php
                                  $today=date('Y-m-d');
                                  if($today>$date_lib){
                                   $date_lib= AddDaysToDate($today,1);
                                  }
                                 $data = getchambreIndisponibles($idsite,$today,$date_lib, $checkin, $checkout,$hrs_sys,$bdd);
                                foreach ($chambres as $rows) {
                                    $id_ch = $rows->id_ch;
                                    if (!in_array($id_ch,$data['chambres']['id'])){
                                    $tarif_ch1 = $rows->tarif_ch;
                                    $monnaie_ch = $rows->monnaie;
                                    $tarif_ch2 = montant_equivalent_bdd($monnaie_ch,$_SESSION['Paie_affiche'], $_SESSION['Paie_taux'], $tarif_ch1);
                                    ?>
                                    <tr>
                                        <td><input name="ch_ids" value="<?php echo $id_ch ?>"  type="radio"></td>
                                        <td><?php echo $rows->num_ch ?></td>
                                        <td class="form-inline">
                                            <div class="input-group" > 
                                                <input name="price<?php echo $id_ch ?>"   class="form-control "  type="text" value="<?php echo arrondir($tarif_ch2); ?>">
                                                <span class="input-group-addon"><?php echo AfficheMonnaie($_SESSION['Paie_affiche']); ?></span>
                                            </div> 
                                        </td>
                                    </tr>
                                
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                    <input name="id_histo" id="id_histo" type="hidden" value="<?php echo $idchambre; ?>">
                    <input name="nbre_nte" id="nbre_nte" type="hidden" value="<?php echo $nuitesave; ?>">
                    <input name="resch_id3" id="resch_id" type="hidden" value="<?php echo $id_resch; ?>">
                    <input name="dte_lib1" id="dte_lib1" type="hidden" value="<?php echo $date_lib; ?>">
                    <input name="dte_in" id="dte_in" type="hidden" value="<?php echo $date_occ; ?>">
                    <input name="id_chx_ex" id="id_chx_ex" type="hidden" value="<?php echo $id_chx_ex; ?>">
                    <input name="id_res2"  type="hidden" value="<?php echo $id_res; ?>">
                </form>
                <div class="callout callout-danger hidden" style="margin-bottom: 0!important;" id="notification2">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button  class="btn btn-danger"
                         id="add_chamb_sej"> Changer
                </button>
            </div>
        </div>
         <!--.modal-content--> 
    </div>
     <!--modal-dialog--> 
</div>