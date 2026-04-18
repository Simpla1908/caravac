<?php include('headerRec.php'); ?>
<?php include('menu_Rec.php'); ?>
<?php 


$id_user=$_GET['id_user']; 
$id_hotel=$_SESSION['id_hotel']; 

include '../bdd/connexion_mysql.php';
//_requete
$psedo=1;
$nbre_user=$_SESSION['nbre_user']+1;
$result=mysql_query("UPDATE t_utilisateur SET psedo='" . $psedo . "'  WHERE id_user='$id_user'") or die(mysql_error());
$result=mysql_query("UPDATE t_hotel SET nbre_user='" . $nbre_user . "'  WHERE id_hotel='$id_hotel'") or die(mysql_error());



echo "<script>
			alert('La suppression est éffectuée avec succès');
			document.location='gl_liste_utilisateur.php'
	</script>";

?>
