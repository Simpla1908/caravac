<?php
if(count($result)>0){
	?>
<span> <label class="control-label">Membre de familles</label></span>
<?php
foreach ($result as $rows) {
	$affich=0;
	if($rows->type=='conjoint'){
		$affich=1;
	}else{
		if(NbAnnee($rows->datenais)<=$_SESSION['Age_Lmt_Enfant_Bm'])$affich=1;
		else
			$affich=0;
	}
	if($affich==1){
?>
<div class="radio">
<label>
  <input type="radio" name="idmalade" id="<?php echo $rows->id; ?>" value="<?php echo $rows->id; ?>">
 <?php echo $rows->nom; ?>
</label>
</div>
<?php } 		
	}
}
else{
?>
    Aucun membre de familles.
<?php
}

?>
