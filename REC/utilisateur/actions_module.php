<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
include('../Amelioration/bdd/connexion .php');
$json = array();
if (!empty($_POST['module'])) {
    $module = $_POST['module'];
} else {
    $module = 0;
}

$requete = $bdd->prepare("SELECT visible,id_act,lib_act FROM actions WHERE affiche=1 AND module_id=:module_id  ORDER BY lib_act");
$requete->BindParam(':module_id', $module);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);
// résultats
foreach ($operations as $op) {
    $id_act = $op->id_act;
    $lib_act = $op->lib_act;
}
?>
<div class="tab-pane fade in active" id="profile">
    <br>
    <div class="col-md-12">
        <ul class="to_do module_caisse" id="magazine">
            <li style="background-color: #00AEEF; color: whitesmoke; font-style:bold;">
                <p>
                 COCHER TOUS LES DROITS <input type="checkbox" id="checkAll"  class="flat pull-right actions_caisse">
                </p>
            </li>
            <?php $i=1; foreach ($operations as $op): ?>
                   <?php if($op->visible==1){ ?>
                    <li>
                      <p>    
                        <?php echo $i.'. '.$op->lib_act; ?> <input type="checkbox" id="<?php echo $op->id_act; ?>" name="action[]" class="flat pull-right actions_caisse" value="<?php echo $op->id_act; ?>">
                    </p>
                   </li>
                  <?php }else { ?>
                   <input type="checkbox"  name="action[]" class="flat actions_caisse hidden" value="<?php echo $op->id_act; ?>" checked="checked">
                   <?php } ?>
            <?php $i++; endforeach; ?>
        </ul>
    </div>

</div>