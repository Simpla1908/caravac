<?php
require '_header.php';
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans nom</title>
</head>

<body>
	<h1>CATALOGUE DES CHAMBRES</h1>
	<?php
	$req=$bd->prepare("SELECT * FROM t_chambre");
	$req->execute();
	$chambres=$req->fetchAll(PDO::FETCH_OBJ);
	//var_dump($req->fetchAll(PDO::FETCH_OBJ));
	?>
<form method="post" action="IHMpanier.php">
	<table width="200" border="0">
	  <tr>
		<td>n°</td>
		<td>nomChambre</td>
		<td>tarif</td>
		<td>action</td>
		<td>Multi</td>
	  </tr>
	  <?php $i=1;foreach($chambres as $ch):?>
	  <tr>
		<td><?php echo $i?></td>
		<td><?php echo 'ch'.$ch->num_ch?></td>
		<td><?php echo $ch->tarif_ch?>$/nuit</td>
		<td><a class="add" href="php/addpanier.php?id=<?php echo $ch->id_ch?>">ajouter</a></td>
		<td><input name="multi[]" type="checkbox" value="1"/></td>
	  </tr>
	  <?php $i++;endforeach;?>
	</table>
	<input type="submit" name="send" value="ajouter tout"/>
</form>
<a href="IHMpanier.php">panier</a>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
