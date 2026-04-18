
<?php
$nbre=count($periodes['mois']);
?>
<select id="periode" name="periode" class="form-control choz">
    <option value="">Mois à déduire</option>
    <?php for ($i =0; $i <= $nbre-1; $i++) { ?>
    <?php if (!in_array($periodes['mois'][$i],$periodepayees['mois'])){?>
        <option value="<?php echo $periodes['mois2'][$i]?>" numero="<?php echo $periodes['numero'][$i]?>" annee="<?php echo $periodes['annee'][$i]?>" libelle="<?php echo $periodes['mois'][$i]?>"><?php echo $periodes['mois'][$i]?></option>
     <?php }?>
    <?php }?>
</select>