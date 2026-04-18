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

<h4><p>Total chambre&nbsp;:&nbsp;<?php echo count($_SESSION['panier'])?></p></h4>
<form method="post" action="panier.php">
<table width="100" class="table">
  <tr>
    <th width="20">N°</th>
    <th width="30">Numéro Chambre</th>
    <th width="30">Tarif</th>
	<!--<th>identifiant</th>-->
    <th width="20">Action</th>
  </tr>
  <?php $i=1;$som=0;foreach($chambre as $d):?>
  <tr>
    <td width="20"><?php echo $i?></td>
    <td width="30"><?php echo 'Ch '.$d->num_ch?></td>
    <td width="30"><?php echo $d->tarif_ch?>&nbsp;$</td>
	<input type="hidden" name="id" value="<?php echo $d->id_ch?>"/>
    <td width="20"><a href="rec_modification_reservation_client.php?id=<?php echo $d->id_ch?>#panier"><img src="../img/icone_poubelle.png"></a></td>
  </tr>
  <?php $i++;$som+=$d->tarif_ch;endforeach;?>

</table>
</form>
</body>
</html>
