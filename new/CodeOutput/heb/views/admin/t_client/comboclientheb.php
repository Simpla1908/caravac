<label for="exampleInputEmail1">Client</label>
<select class="form-control col-md-3 choz pers" name="id_client" id="id_client">
    <option value="0"></option>
    <?php foreach ($clients as $rows) { ?>
        <option value="<?php echo $rows->id_client ?>"><?php echo $rows->nom_client ?></option>
    <?php } ?>
</select>