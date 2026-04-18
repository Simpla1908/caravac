<?php 
if(isset($_POST["multi"])) 
{
include '../bdd/connexion_mysql.php';
$N=count($_POST["multi"]);
for($i=0;$i<$N;$i++){	
$id_ch=$_POST["multi"][$i];										
//_requete
$result=mysql_query("DELETE FROM t_chambre WHERE id_ch='$id_ch'") or die(mysql_error());
}
echo "<script>document.location='gl_consultation_chambre.php'</script>";	

}
?>
