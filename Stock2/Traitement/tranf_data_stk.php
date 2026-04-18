<?php
 include('../../FUNCTION/hebergement.php');
 include('../../FUNCTION/stock.php');
//Connexion1
$user = 'ebutelociruserbd';
$pass = 'Mdpebutelo20';
$dsn = 'mysql:host=ebutelociruserbd.mysql.db;dbname=ebutelociruserbd';
// Connexion à la base de données
try {
  $bdd1 = new PDO($dsn, $user, $pass);
  $bdd1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  echo 'con1 ok';
} catch (PDOException $e) {
    echo 'Echec1';
 print "Erreur ! : " . $e->getMessage() . "<br/>";
 die();
}
//Connexion2
$user = 'ebutelocirbp4265';
$pass = 'Mot2pa553';
$dsn = 'mysql:host=ebutelocirbp4265.mysql.db;dbname=ebutelocirbp4265';
 
try {
  $bdd = new PDO($dsn, $user, $pass);
 $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    echo 'con2 ok';
} catch (PDOException $e) {
      echo 'Echec2';
      print "Erreur ! : " . $e->getMessage() . "<br/>";
	  die();
}
$id_hotel =186;
$d1='2019-04-01';
$d2='2019-04-30';
$depot_id =81;

$requete = $bdd1->prepare("SELECT  * FROM stk__mouvement WHERE dte_appro BETWEEN :d1 AND :d2 AND hotel_id=:id_hotel  ORDER BY idmvt ASC");
$requete->BindParam(':id_hotel', $id_hotel);
$requete->BindParam(':d1',$d1);
$requete->BindParam(':d2',$d2);
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);
var_dump($result);
foreach ($result as $op) {
 $numbon = $op->num_bon;
 $type = $op->type;
 $motif_id = 6;
 $beneficiere = $op->depot;
$motif_fiche = 'appro';
if ($type == 'sortie') {
$motif_id = 7;
$motif_fiche = 'sortie';
 }
 $hotel_id = $id_hotel;
 $user_id = $op->user_id;
$approuve = 1;
$nbArticles = 1;
$dte = $op->dte_appro;
$dte_time = $op->dte_appro_heure;
$fiche_id = CreateBonStk($numbon, $type, $motif_fiche, $beneficiere, $depot_id, $user_id, $hotel_id, $nbArticles, $dte, $dte_time, $approuve, $bdd);
if ($type == 'appro') {
  $prod_id = $op->produit_id;
  $qte = $op->qte_entree;
  $ecart = 0;
 ApprovisionnementStk($qte, $dte, $prod_id, $fiche_id, $depot_id, $user_id, $hotel_id, $motif_id, $bdd);
  echo 'appro ok';
} else {
 $idmotif =7;
 $prod_id =$op->produit_id;
 $qte =$op->qte_sortie;
 $quantite = $qte;
 $qte_declasse = 0;
 $produit_id = $prod_id;
 $ecart = 0;
 $qte_envoye = $qte;
 $qte_recue = 0;
 SortieStk($quantite, $qte_declasse, $dte, $prod_id, $idmotif, $fiche_id, $depot_id, $user_id, $hotel_id, $bdd);
   echo 'sortie ok';
}
} 

  