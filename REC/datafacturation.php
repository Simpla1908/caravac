   <?php
if (!isset($_SESSION)) {
    session_start();
}
require '../bdd/connexion.php';
require '../FUNCTION/hebergement.php';
include './Amelioration/reglage/recuperer_valeurs_reglages.php';
$partenaire=$_POST['partenaire'];
$libentreprise=$_GET['libentreprise'];
$typefact=$_POST['typefact'];
$libtypefact=$_GET['libtypefact'];
$datedebut=$_POST['datedebut'];
$datefin=$_POST['datefin'];
$datedebutbdd=dateToformatBdd($datedebut);
$datefinbdd=dateToformatBdd($datefin);
if($typefact=='heberge'){
    include 'datafactheberge.php';
}else{
    include 'datafactresto.php';
}
?>

                