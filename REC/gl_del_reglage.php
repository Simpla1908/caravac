<?php include('headerRec.php'); ?>
<?php include('menu_Rec.php'); ?>
<?php 


$id_regl=$_GET['id_regl']; 
include '../bdd/connexion_mysql.php';
//_requete

$result=mysql_query("DELETE FROM t_reglage WHERE id_regl='$id_regl'") or die(mysql_error());
echo "<script>
			document.location='gg_voirreglages.php'
	</script>";

?>
