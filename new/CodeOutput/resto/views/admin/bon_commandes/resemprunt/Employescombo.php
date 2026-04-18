<select id="idagent" name="idagent"  class="form-control choz employe_emprnt">
<option value="0">Employé</option>
<?php
foreach ($result as $rows) {
  ?>
  <option value="<?php echo $rows->id; ?>" nom="<?php echo ucfirst($rows->noms); ?>"><?php echo ucfirst($rows->noms); ?></option>
<?php } ?>
</select>