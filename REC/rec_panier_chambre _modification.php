<?php
require '_header.php';
?>
<h4 class="page-header">
	<div class="modal" id="infos_ch" style="width:800px; height:550px; background-color:#c2c1c1; margin:auto; border-radius:10px; color:#FFF;">
    <div class="modal-header" style="height:40px;"> 
        <a class="close" data-dismiss="modal">×</a>
        <h3 style="margin-top:-5px;">Liste des Chambres</h3>
    </div>
    <div class="modal-body">
    <p>
        <?php
		
			$requete_chambre = $bdd->prepare("SELECT * FROM t_chambre WHERE id_ch NOT IN (
										SELECT c.id_ch FROM t_reservation AS a, t_reserve_chambre AS b, t_chambre AS c
										WHERE b.idreserv = a.id_res AND b.idchambre = c.id_ch
										AND date_occ >=:date_occ AND date_lib <=:date_lib)");
										
			$requete_chambre->BindParam(':date_occ',$_SESSION['date_arrive']);
			$requete_chambre->BindParam(':date_lib',$_SESSION['date_sorti']);
			$requete_chambre->execute();
			
			$chambres=$requete_chambre->fetchAll(PDO::FETCH_OBJ);
		
			?>
		<form method="post" action="php/addpanier2.php">
			<table width="200" class="table table-bordered">
			  <tr>
				<td>N°</td>
				<td>Numéro Chambre</td>
				<td>Tarif</td>
				<td>Action</td>
				<td></td>
			  </tr>
			  <?php $i=1;foreach($chambres as $ch):?>
			  <tr>
				<td><?php echo $i?></td>
				<td><?php echo 'Ch '.$ch->num_ch?></td>
				<td><?php echo $ch->tarif_ch?> $ / Nuit</td>
				<td><a class="addmodif" href="php/addpanier.php?id=<?php echo $ch->id_ch?>">Ajouter</a></td>
				<td><input name="multi[]" type="checkbox" value="<?php echo $ch->id_ch?>"/></td>
			  </tr>
			  <?php $i++;endforeach;?>
			</table>
			<input class="form-control" type="submit" name="send" id="add15" value="Ajouter"/>
		</form>
		
        
    </p>
    </div>
</div>
<div style="margin-left:50px;">
	<a class="btn btn-primary" data-toggle="modal" href="#infos_ch">Ajouter une chambre</a>
</div>
</h4>

<div style="margin-left:50px;">
	<?php require_once 'IHMpanier _modification.php'?>
</div>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/script.js"></script>
