<?php
 foreach ($servicesFamilles as $sf){
    $id_fam=$sf->id;
    $libelle_fam=$sf->nom;
?>
   <a href="#" class="btn btn-squared-default btn-default catprod"
       title="<?php echo $libelle_fam; ?>"
       id="<?php echo $id_fam; ?>" style="width:120px;margin-bottom: 4px">
        <span class="badge bg-aqua"><?php echo AfficheNom2($libelle_fam); ?></span><br/>
        <i class="fa fa-barcode fa-3x"></i><br/><br/>
    </a>
   
<?php } ?>

