    <label for="exampleInputEmail1">Accompagné</label>
    <select class="form-control col-md-3 choz " name="accomp_id" id="accomp_id">
        <option value="0">Non</option>
        <?php foreach ($clients as $rows) { ?>
            <option value="<?php echo $rows->id_client ?>"><?php echo $rows->nom_client ?></option>
        <?php } ?>
    </select>
