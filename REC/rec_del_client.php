<?php 

$id_client=$_GET['id_client'];

include '../bdd/connexion_mysql.php';
//_requete
$result=mysql_query("DELETE FROM t_client WHERE id_client='$id_client'") or die(mysql_error());
echo "<script>document.location='rec_liste_clients.php'</script>";

?>
