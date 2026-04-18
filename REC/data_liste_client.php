<?php
if (!isset($_SESSION)) {
    session_start();
}
require '../bdd/connexion.php';
require '../FUNCTION/hebergement.php';

    $requete = $bdd->prepare
        ("
        SELECT * 
        FROM  t_client c, t_responsable r
        WHERE c.id_respo=r.id_respo AND c.type='client' 
        AND c.id_hotel=:id_hotel 
        ORDER BY c.nom_client
       ");
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->execute();

$result = $requete->fetchAll(PDO::FETCH_OBJ);
?>
<?php
$i = 1;
foreach ($result as $r) {
    $id_client = $r->id_client;
    ?>
    <tr class="odd gradeX">
        <td><?php echo $i ?></td>
        <td><?php echo $r->nom_client ?></td>
        <td><?php echo $r->entreprise ?></td>
        <td><?php echo $r->sexe_client ?></td>
        <td><?php echo $r->etat_civil_client ?></td>
        <td><?php echo $r->adresse_provenance_client ?></td>
        <td><?php echo $r->telephone_client ?></td>
        <td><?php echo $r->email_client ?></td>
        <td class="text-center">
            <a href="rec_maj_client.php?id_client=<?php echo $id_client ?>" title="Modifier">
                <i class="fa fa-edit"></i> 
            </a>
            <a id="<?php echo $id_client; ?>" href="#" class="confirmModalLink1" data-toggle="modal" data-target=".myModal" title="Suprimer">
                <i class="fa fa-trash"></i> 
            </a>
        </td>
    </tr>
    <?php
    $i++;
}
?>

    
<!-- Modal -->
<div class="modal fade myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                Suppression
            </div>
            <div class="modal-body">
                <h4><i class="fa fa-exclamation-triangle"></i>  Etes-vous sûr de vouloir supprimer ce client ?</h4>
            </div>
            <div class="modal-footer">
                 <a href="#" class="btn" id="confirmModalNo">Non</a>
            <a href="#" class="btn btn-primary" id="confirmModalYes">Oui</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->