<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans nom</title>
</head>

<body>
	<?php
	$hebergement=$_SESSION['hebergement'];
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
  <thead>
    <tr>
    <th width="20">N°</th>
    <th width="30">N° Chambre</th>
    <th width="30">Tarif</th>
    <th width="20">Action</th>
  </tr>
  </thead>
  <tbody>
  <?php $i=1;$som=0;foreach($chambre as $d):?>
  <tr>
    <td width="20"><?php echo $i?></td>
    <td width="30"><?php echo 'Ch '.$d->num_ch?></td>
    <td width="30"><?php echo $d->tarif_ch?>&nbsp;$</td>
	<input type="hidden" name="id" value="<?php echo $d->id_ch?>"/>
    <td width="20"><a href="rec_reservation_client_chambre_paiement.php?id=<?php echo $d->id_ch?>&hebergement=<?php echo $hebergement;?>#panier"><img src="../img/icone_poubelle.png"></a></td>
  </tr>
  <?php $i++;$som+=$d->tarif_ch;endforeach;?>
  <?php if($som!=0){?>
  <tr>
  	
    <th width="30"></th>
    <th width="30"><font size="+1" color="#FF0000">Total à payer pour <?php echo $_SESSION['nbre_jr'];?> jour(s): </font></th>
	<!--<th>identifiant</th>-->
    <th width="20">
    <font size="+1" color="#FF0000">
	<?php
		$_SESSION['montant_nuite']=$som; 
		$_SESSION['total']=$som*$_SESSION['nbre_jr'];
		echo $_SESSION['total'];
		
	?> $
    </font></th>
    <th width="20"></th>
  </tr>
  <?php }?>
  </tbody>
</table>
</form>
</body>
</html>
