<?php
include('../../bdd/connexion.php');
$moduleid = $_POST['moduleid'];
$souscription = $_POST['souscription'];
$prixuser = $_POST['moduleprix'];
$prixpuser = $_POST['moduleprix_user'];
$prixid = $_POST['prixid'];
$nom_module = $_POST['licence'];
//mise à jour prix dans la table prix
$requete = $bdd->prepare("UPDATE prix SET prix_user=:prix_user,prix_par_user=:prixpuser WHERE module_id=:module_id AND souscription=:souscription");
$requete->BindParam(':prix_user',$prixuser);
$requete->BindParam(':prixpuser',$prixpuser);
$requete->BindParam(':module_id', $moduleid);
$requete->BindParam(':souscription', $souscription);
$requete->execute();
?>
<a href="#" title="Modifier" class="btn btn-primary btn-xs edit_prix" data-toggle="modal" data-target=".bs-example-modal-sm" module="<?php echo $nom_module;?>" moduleid="<?php echo $moduleid;?>" souscription="<?php echo $souscription;?>" prixpuser="<?php echo $prixpuser;?>" prixuser="<?php echo $prixuser;?>" prixid="<?php echo $prixid;?>" ><i class="fa fa-edit"></i> Edit</a>