<select class="form-control choz" id="boncommande_id" name="boncommande_id">
    <option>Selectionnez </option>
    <?php
    $nbLigne = count($_SESSION['boncmd']['facture_id']);
    for ($i = 0; $i <= $nbLigne - 1; $i++) {
        ?>
        <option value="<?php echo $_SESSION['boncmd']['facture_id'][$i]; ?>"><?php echo $_SESSION['boncmd']['numerobom'][$i]; ?></option>
    <?php } ?>
</select>