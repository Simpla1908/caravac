<?php include('headerRec.php'); ?>
<?php include('menu_Rec.php'); ?>
<?php 


$id_rep=$_GET['id_rep']; 

include '../bdd/connexion_mysql.php';
//_requete

$result=mysql_query("DELETE FROM t_responsable WHERE id_respo='$id_rep'") or die(mysql_error());
echo "<script>
			alert('La suppression est éffectuée avec succès');
			document.location='gg_liste_partenaire.php'
	</script>";

?>
