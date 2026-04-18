<option value="0">Choisir employé</option>
<?php
foreach ($result as $rows) {
?>
<option value="<?php echo $rows->id; ?>"><?php echo ucfirst($rows->noms); ?></option>
<?php } ?>