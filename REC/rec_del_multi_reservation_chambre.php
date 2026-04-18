<?php 
if(isset($_POST["multi"])) 
{
include '../bdd/connexion_mysql.php';
$N=count($_POST["multi"]);
for($i=0;$i<$N;$i++){	
$id_res=$_POST["multi"][$i];										
//_requete
$result=mysql_query("DELETE FROM t_reservation WHERE id_res='$id_res'") or die(mysql_error());
}
echo "<script>document.location='rec_reservation_chambre.php'</script>";

}
?>
