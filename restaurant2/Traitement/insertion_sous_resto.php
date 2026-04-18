<?php
session_start();
$json = array();
include '../bdd/connexion.php';

$sous_resto=$_GET['sous_resto'];
$affect=$_GET['affect'];
if($affect==1){
$requete = $bdd->prepare("INSERT INTO  t_sousresto(libelle,hotel_id)
                    VALUES(:libelle,:hotel_id)");

$requete->BindParam(':libelle', $sous_resto);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();
}
//  echo 'Enregistrement effectue avec succes';
//$json['message_succes'] = 'succes';
//
//
//echo json_encode($json);

    $requete = $bdd->prepare
    ("SELECT * FROM t_sousresto AS a
        WHERE a.hotel_id=:id_hotel ");
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->execute();

$result = $requete->fetchAll(PDO::FETCH_OBJ);
?>
<?php
foreach ($result as $r) {
    ?>
<?php if($affect==1){?>
    <div class="form-group">
        <label class="control-sidebar-subheading">
          <?php echo $r->libelle ?>
        </label>
      </div>
    <!-- /.form-group -->
    <?php }else{ ?>
    <div class="form-group">
        <label class="control-sidebar-subheading">
          <?php echo $r->libelle ?>
          <input type="radio" name="optionsRadios"  id="<?php echo $r->id_sousresto; ?>" value="<?php echo $r->id_sousresto; ?>" class="pull-right">
        </label>
      </div>
    <?php } ?>
    <?php
}

?>