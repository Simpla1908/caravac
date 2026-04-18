<?php foreach ($clients as $rows) { ?>
<li><a class="lien" href="#" id="<?php echo $rows->id_client ?>" nom="<?php echo $rows->nom_client ?>"><?php echo $rows->nom_client ?></a></li>
<?php } ?>