<?php
// Initialisation de la session
if (!isset($_SESSION)) {
session_start();
}
include('../../bdd/connexion.php');
$site_id=$_GET['site_id'];
if ($site_id==0) {
$requete = $bdd->prepare("SELECT a.id_hotel, a.nom_hotel, b.id_user, b.nom_user, b.prenom_user, c.id_con, c.date_con, c.date_decon
FROM t_hotel AS a, t_utilisateur AS b, connexion AS c
WHERE a.id_hotel=b.id_hotel AND b.id_user=c.id_user
AND b.company_id=:company_id ORDER BY c.date_con DESC");
$requete->BindParam(':company_id', $_SESSION['company_id']);
} else {
$requete = $bdd->prepare("SELECT a.id_hotel, a.nom_hotel, b.id_user, b.nom_user, b.prenom_user, c.id_con, c.date_con, c.date_decon
FROM t_hotel AS a, t_utilisateur AS b, connexion AS c
WHERE a.id_hotel=b.id_hotel AND b.id_user=c.id_user
AND b.company_id=:company_id AND a.id_hotel=:site_id ORDER BY c.date_con DESC");
$requete->BindParam(':company_id', $_SESSION['company_id']);
$requete->BindParam(':site_id',$site_id);# code...
}

$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);
?>
<table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example">
<thead>
<tr>
<th>N°</th>
<th>Utilisateur</th>
<th>Date et Heure de connexion</th>
<th>Date et Heure de déconnexion</th>
</tr>
</thead>
<tbody>
<?php $i = 1;
foreach ($operations as $operation): ?>
<tr class="odd gradeX"> 	
<td><?php echo $i ?></td>
<td><?php echo $operation->prenom_user.' '.$operation->nom_user ?></td>
<td><?php echo $operation->date_con ?></td>
<td><?php echo $operation->date_decon ?></td>
</tr>
<?php
$i++;
endforeach;
?>
</tbody>
</table>

<!-- jQuery -->
<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    
    });
</script>