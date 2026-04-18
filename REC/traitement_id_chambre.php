 <?php

if(!isset($_SESSION)){
			session_start();
		}
		if(!isset($_SESSION['panier'])){
			$_SESSION['panier']=array();
		}

include '../bdd/connexion_mysql.php';
$id_hotel=$_SESSION['id_hotel'];
if (isset($_POST['send'])) {
	$t=array();
	$t=explode(',',$_POST["tab"][0]);
$N=count($t);	

for($i=0;$i<$N;$i++) {
	$v=$t[$i];
	if($v!=',')$_SESSION['panier'][$v]=1;

	
}

/*print_r($_SESSION['panier']);*/
 	if(isset($_GET['id'])){
 		unset($_SESSION['panier'][$_GET['id']]);
 	}
	$ids=array_keys($_SESSION['panier']);
	if(empty($ids)){
		$chambre=array();
	}else{
$chaine_id_session=implode(',',$ids);

echo 'idsession:'.$chaine_id_session;
$chaine_id=implode(',',$t);
echo 'idtab:'.$chaine_id;
 $i=1;
$R=mysql_query("SELECT DISTINCT id_ch,num_ch,tarif_ch FROM t_chambre WHERE id_ch IN (".$chaine_id_session.")");
while($rows=mysql_fetch_assoc($R)){
		 ?>
<tr>
    <td><?php echo $i;?></td>
    <td><?php echo $rows['num_ch']?></td>
    <td><?php echo $rows['tarif_ch']?>$</td>
	<td><input type="text" name="id" value="<?php echo $rows['id_ch']?>"/></td>
    <td><a href="traitement_id_chambre.php?id=<?php echo $rows['id_ch']?>"><img src="../img/icone_poubelle.png"></a></td>
  </tr>
	<?php $i++;	
	}
		}
  
 }?>	
	

