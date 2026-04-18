<?php
include('../../bdd/connexion.php');
$requete = $bdd->prepare("SELECT m.id AS moduleid,m.nom,p.id,p.souscription,p.prix_user,p.prix_par_user FROM module AS m,prix p WHERE m.id=p.module_id AND m.id<>25");
$requete->execute();
$parametres= $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($parametres as $p) {
?>
<tr>
  <th><?php echo $p->nom;?></th>
  <td><?php echo $p->souscription;?></td>
  <td id="<?php echo 'prix'.$p->id;?>"><?php echo '$'.$p->prix_user;?></td>
  <td id="<?php echo 'prixp'.$p->id;?>"><?php echo '$'.$p->prix_par_user;?></td>
  <td><a href="#" title="Modifier" class="btn btn-primary btn-xs edit_prix" data-toggle="modal" data-target=".bs-example-modal-sm" module="<?php echo $p->nom;?>" moduleid="<?php echo $p->moduleid;?>" souscription="<?php echo $p->souscription;?>" prixpuser="<?php echo $p->prix_par_user;?>" prixuser="<?php echo $p->prix_user;?>" prixid="<?php echo $p->id;?>" ><i class="fa fa-edit"></i> Edit</a>
  </td>
</tr>
<?php
}
?>
