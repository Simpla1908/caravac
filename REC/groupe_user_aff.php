<?php
//Selection de tous les groupes de l'utilisateur
$requete = $bdd->prepare("SELECT group_id FROM users_groupes WHERE user_id=:user_id");
$requete->BindParam(':user_id', $_GET['id_user']);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);
// résultats
$GROUPES['groupe'] = array();
$GROUPES['groupe']['groupe_id'] = array();
foreach ($operations as $op) {
    $group_id = $op->group_id;
    array_push($GROUPES['groupe']['groupe_id'], $group_id);
}
//fin selection
//selection id_hotel
$requete = $bdd->prepare("SELECT id_hotel FROM t_utilisateur WHERE id_user=:user_id");
$requete->BindParam(':user_id', $_GET['id_user']);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);
// résultats
foreach ($operations as $op)
    $id_hotel = $op->id_hotel;
$requete = $bdd->prepare("SELECT * FROM groupe WHERE hotel_id=:hotel_id ORDER BY libelle ASC");
$requete->BindParam(':hotel_id', $id_hotel);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);
// résultats
?>
<div class="tab-pane fade in active groupes" id="profile">
    <br>
    <div class="col-md-12">
        <ul class="to_do">
            <form  id="form_grp_user_aff" method="post" action="utilisateur/groupe_user_aff_traitement">
                <input id="id_user" class="form-control col-md-7 col-xs-12"  name="id_user"  type="hidden" value="<?php echo $_GET['id_user']; ?>">

                <li style="background-color: #00AEEF; color: whitesmoke; font-style:bold;">
                    <p>
                        COCHER TOUS LES GROUPES <input type="checkbox" id="checkAll"  class="flat pull-right">
                    </p>
                </li>
<?php $i = 1;
foreach ($operations as $op): ?>
                    <li>
                        <p>
                            <?php echo $i . '. ' . $op->libelle; ?> 
                            <?php if (in_array($op->id, $GROUPES['groupe']['groupe_id'])) { ?>
                                <input type="checkbox" id="<?php echo $op->id; ?>" name="groupe[]" class="flat pull-right groupe_cls" value="<?php echo $op->id; ?>" checked="checked">
                            <?php } else { ?>
                                <input type="checkbox" id="<?php echo $op->id; ?>" name="groupe[]" class="flat pull-right groupe_cls" value="<?php echo $op->id; ?>">
                    <?php } ?>
                        </p>
                    </li>
    <?php $i++;
endforeach; ?>
            </form>   
        </ul>
    </div>
</div>
