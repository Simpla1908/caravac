<?php 

$id_hotel=$_GET['id_hotel'];

include '../bdd/connexion_mysql.php';
//_requete
$result=mysql_query("DELETE FROM t_hotel WHERE id_hotel='$id_hotel'") or die(mysql_error());
echo "<script>document.location='gg_consultation_hotel.php'</script>";

?>
