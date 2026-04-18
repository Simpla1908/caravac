<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
//include('../Amelioration/bdd/connexion .php');
$hotel_id = $_SESSION['id_hotel'];
    $requete = $bdd->prepare("SELECT g.id, g.libelle AS groupe FROM groupe AS g WHERE g.hotel_id=:hotel_id ORDER BY g.libelle ASC");
    $requete->BindParam(':hotel_id', $hotel_id);
    $requete->execute();
    $groupes = $requete->fetchAll(PDO::FETCH_OBJ);
?>
<ul class="to_do" id="magazine">
    <li style="background-color: #00AEEF; color: whitesmoke; font-style:bold;">
                <p>
                 COCHER TOUS LES DROITS <input type="checkbox" id="checkAll"  class="flat pull-right">
                </p>
    </li>
    <?php
    $i = 1;
    foreach ($groupes as $ligne):
        ?>
        <li>
            <p>
                <?php echo $i.'. '.$ligne->groupe ?> <input type="checkbox" name="groupe[<?php echo $ligne->id ?>]" id="<?php echo $ligne->id ?>" value="<?php echo $ligne->id ?>" class="pull-right flat actions_groupe"> </p>
        </li>
        <?php $i = $i + 1;
    endforeach; ?>
</ul>