<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
if (isset($_GET['famille_id'])) {
    $famille_id = $_GET['famille_id'];
$requete = $bdd->prepare("SELECT  * FROM  stk_sous_famille AS s_fam WHERE s_fam.hotel_id=:hotel_id AND famille=:famille ORDER BY s_fam.des ASC");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':famille', $famille_id);
$requete->execute();
$s_familles = $requete->fetchAll(PDO::FETCH_OBJ);
}
?>


<?php foreach ($s_familles as $s_fam): ?>

    <a href="#" class="btn btn-squared-default btn-default" id="<?php echo $fam->famille; ?>"><br/>
        <i class="fa fa-barcode fa-3x"></i><br/><br/>
        <span class="badge bg-aqua" id="<?php echo $fam->famille; ?>"><?php echo $fam->des; ?></span>
    </a>

<?php endforeach; ?>

