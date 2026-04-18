<label>Employé:</label>
<select class="form-control  choz emplpoint2" name="employe_id" id="employe_id">
    <option value="0">Sélectionner un employé</option>
      <?php
        foreach ($result as $rows){
          ?>
          <option value="<?php echo $rows->id; ?>"
            dteng="<?php echo $rows->dteng; ?>"
            employe_id="<?php echo $rows->id; ?>" 
            >
                <?php echo ucfirst($rows->noms); ?>
          </option>
        <?php } ?> 
</select>