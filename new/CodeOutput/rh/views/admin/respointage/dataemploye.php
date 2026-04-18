
 <?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:    17-11-2017
 * FOR TABLE:       respointage
 * PRODUCED BY:     HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:          Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
  die('You are not allowed to execute this file directly');
?>
 <label>Personnel:</label>
<select class="form-control choz" name="employe_id1" id="employe_id1">
 <option value="0">Sélectionner un agent</option>
<?php
foreach ($resultdprt as $rows) {
  ?>
<option idtmppoint="<?php echo $rows->idtmppoint; ?>" idpoint="<?php echo $rows->point_id; ?>"  idpointprec="<?php echo $rows->idpointprec; ?>" compteurshift="<?php echo $rows->compteurshift; ?>" value="<?php echo $rows->id; ?>" dte_in="<?php echo $rows->dte_in; ?>" horaire_id="<?php echo $rows->horaire_id; ?>"><?php echo ucfirst($rows->noms); ?></option>
<?php } ?>
   </select>