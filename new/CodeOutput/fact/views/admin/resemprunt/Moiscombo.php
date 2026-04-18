<select id="dte_deduct" name="dte_deduct" class="form-control choz">
<option value="">Mois à déduire</option>
<?php
for ($i =0; $i < 12; $i++){
?>
<option value="<?php echo $mois[$i].$annee; ?>" ><?php echo $mois[$i].' '.$annee; ?></option>
<?php } ?>
</select>