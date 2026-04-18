<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans nom</title>
</head>

<body>
	<?php
 	if(isset($_GET['id'])){
 		$panier->del($_GET['id']);
 	}
	$ids=array_keys($_SESSION['panier']);
	if(empty($ids)){
		$chambre=array();
	}else{
	$req = $bd -> prepare('SELECT id_ch, num_ch, tarif_ch FROM t_chambre WHERE id_ch in ('.implode(',', $ids).')');
	$req -> execute();
	$chambre = $req -> fetchAll(PDO::FETCH_OBJ);
	}
?>
<h1>Votre panier de reservation</h1>
<p>Total chambre:<?php echo count($_SESSION['panier'])?></p>
<form method="post" action="panier.php">
<table width="200" border="1">
  <tr>
    <td>n°</td>
    <td>nomChambre</td>
    <td>tarif</td>
	<td>identifiant</td>
    <td>action</td>
  </tr>
  <?php $i=1;$som=0;foreach($chambre as $d):?>
  <tr>
    <td><?php echo $i?></td>
    <td><?php echo 'ch'.$d->num_ch?></td>
    <td><?php echo $d->tarif_ch?>$</td>
	<td><input type="text" name="id" value="<?php echo $d->id_ch?>"/></td>
    <td><a href="rec_ajout_reservation.php?id=<?php echo $d->id_ch?>">Supprimer</a></td>
  </tr>
  <?php $i++;$som+=$d->tarif_ch;endforeach;?>
</table>
    <div>Total à payer&nbsp;:&nbsp;<?php echo $som?> $</div>
<a href="catalogue.php">voir catalogue</a></br></br>
<input type="submit" name="reserver" value="reserver"/>
</form>
</body>
</html>
