
<select id="employe_id" name="employe_id"  class="form-control choz employe">
    <option value="">Sélectionner un employé</option>                                     
    <?php
    foreach ($employes as $rows) {
        if($rows->actif=='1'){
        $anciennete=GetAncienneteEmploye($rows->dteng);
        $lib_anciennete=AfficheAncienneteEmploye($anciennete);
        ?>
        <option value="<?php echo $rows->id; ?>" employe_id="<?php echo $rows->id; ?>" 
                dteng="<?php echo $rows->dteng; ?>"
                dteng2="<?php echo dateAffiche($rows->dteng); ?>" 
                anciennete="<?php echo $lib_anciennete; ?>"
                salbase="<?php echo $rows->salbase; ?>" 
                montantjr="<?php echo $rows->montantjr; ?>" 
                dteng="<?php echo $rows->dteng; ?>" 
                devise="<?php echo $rows->devise; ?>"
                idcat="<?php echo $rows->idcat; ?>"
                preavis="<?php echo $rows->preavis; ?>"
                matricule="<?php echo $rows->matricule; ?>"
                fonction="<?php echo $rows->fonction; ?>"
                nbrenf="<?php echo $rows->nbrenf; ?>"
                ><?php echo $rows->noms; ?></option>
            <?php } ?> 
         <?php } ?> 
</select>