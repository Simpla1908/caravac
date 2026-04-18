<?php
if (!isset($_SESSION)) {
    session_start();
    
}
//require '../../bdd/connexion.php';
//include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
//require '../../FUNCTION/hebergement.php';


    $requete = $bdd->prepare
    ("SELECT * FROM t_sousresto AS a
        WHERE a.hotel_id=:id_hotel ");
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->execute();

$result = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($result as $r) {
    ?>
    <div class="form-group">
        <label class="control-sidebar-subheading">
          <?php echo $r->libelle ?>
          <input type="radio" name="optionsRadios"  id="<?php echo $r->id_sousresto; ?>" value="<?php echo $r->id_sousresto; ?>" class="pull-right">
        </label>
      </div>
    <!-- /.form-group -->
    <?php
}
?>

