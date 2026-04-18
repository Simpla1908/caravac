<?PHP

if (isset($_POST['sauvegarder'])) {
    $id_client = $_POST['id_client'];
    $id_ch = $_POST['id_ch'];
    $date_occ = $_POST['date_occ'];
    $heure_occ = $_POST['heure_occ'];
   include '../bdd/connexion_mysql.php';
//_requete
$req_sql='INSERT INTO t_occupation VALUES(NULL,"'.$date_occ.'","'.$heure_occ.'",'.$id_ch.','.$id_client.')';
 mysql_query($req_sql) or die("impossible d'executer la _requette.<br>\n Erreur MySQL'".mysql_error()."'");
	
//__requete_maj_reserve_libre
$req_sql=mysql_query("UPDATE t_chambre SET 
reserve='non',
occupe='oui'
WHERE id_ch='$id_ch'") or die("impossible d'executer la requette*.<br>\n Erreur MySQL'".mysql_error()."'");

$result = mysql_query("SELECT COUNT(c.id_ch) as chr FROM  t_chambre c 
            WHERE c.reserve='oui' ORDER BY c.id_ch ASC") or die(mysql_error());
			
        while ($rows = mysql_fetch_assoc($result))
            $chr = $rows['chr'];
	echo $chr;
}
?>
             