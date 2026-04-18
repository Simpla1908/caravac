<?php
$id_res=$_GET['id_res'];
include '../../bdd/connexion_mysql.php';
$result = mysql_query("SELECT rch.idchambre,ch.num_ch,ch.capacite FROM t_chambre AS ch,t_reserve_chambre AS rch,t_reservation AS res 
                     WHERE rch.statut='reserve'	AND ch.id_ch=rch.idchambre AND  res.id_res=rch.idreserv AND  rch.idreserv='$id_res'") or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
    echo '<option value="' . $row['idchambre'] . '">' . 'Ch ' . $row['num_ch'] . '  (Capacite:' . $row['capacite'] . ')</option>';
}
mysql_free_result($result);
?>