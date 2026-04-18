<?php
session_start();
include("../../bdd/connexion.php");
include '../../bdd/connexion_mysql.php';
$id_res =$_GET['id_res'];
?>
          <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">Client <span class="required">*</span>
                                </label>
                                <div class="col-md-7">
                                    <select name = "id_client" id = "id_client" class = "form-control">
<option></option>
<?php

$result = mysql_query("SELECT DISTINCT a.id_client, a.nom_client FROM t_client AS a, t_client_reserve AS b
WHERE a.id_client = b.id_client AND b.id_res ='$id_res' AND b.responsable !=3") or die(mysql_error());
while( $row = mysql_fetch_array($result))
{
echo '<option value="'.$row['id_client'].'">'.$row['nom_client'].'</option>';
}
//$_SESSION['nbre_enreg']=$row['nbre'];
//$_SESSION['compteur']=0;
mysql_free_result($result);
?>
</select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">Chambre <span class="required">*</span>
                                </label>
                                <div class="col-md-7">
                                    <select name="id_chambre" id="id_chambre" class="form-control">
        <option></option>
        <?php
        $result = mysql_query("SELECT rch.idchambre,ch.num_ch,ch.capacite FROM t_chambre AS ch,t_reserve_chambre AS rch,t_reservation AS res 
                     WHERE rch.statut='reserve'	AND ch.id_ch=rch.idchambre AND  res.id_res=rch.idreserv AND  rch.idreserv='$id_res'") or die(mysql_error());

        while( $row = mysql_fetch_array($result))
        {
        echo '<option value="'.$row['idchambre'].'">'.'Ch '.$row['num_ch'].'  (Capacite:'.$row['capacite'].')</option>';
        }
        mysql_free_result($result);
        ?>
    </select>
                                </div>
                            </div>