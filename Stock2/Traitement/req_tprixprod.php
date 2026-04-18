<?php
// include('../../FUNCTION/hebergement.php');
// include('../../FUNCTION/stock.php');
// //Connexion1
// $user = 'ebutelociruserbd';
// $pass = 'Mdpebutelo20';
// $dsn = 'mysql:host=ebutelociruserbd.mysql.db;dbname=ebutelociruserbd';
// // Connexion à la base de données
// try {
//     $bdd1 = new PDO($dsn, $user, $pass);
//     $bdd1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
//     echo 'con1 ok';
// } catch (PDOException $e) {
//     echo 'Echec1';
//     print "Erreur ! : " . $e->getMessage() . "<br/>";
//     die();
// }
// //Connexion2
// $user = 'ebutelocirbp4265';
// $pass = 'Mot2pa553';
// $dsn = 'mysql:host=ebutelocirbp4265.mysql.db;dbname=ebutelocirbp4265';
// // Connexion à la base de données
// try {
//     $bdd = new PDO($dsn, $user, $pass);
//     $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
//     echo 'con2 ok';
// } catch (PDOException $e) {
//     echo 'Echec2';
//     print "Erreur ! : " . $e->getMessage() . "<br/>";
//     die();
// }
// $id_hotel =186;
// $requete = $bdd1->prepare("SELECT  * FROM  stk_produit WHERE hotel_id=:id_hotel");
// $requete->BindParam(':id_hotel', $id_hotel);
// $requete->execute();
// $result = $requete->fetchAll(PDO::FETCH_OBJ);
// var_dump($result);
// foreach ($result as $op) {
//     $sousresto_id = 82;
//     $prix_vente_site =$op->pv;
//     $article=$op->idprod;
//     $monnaie=$op->monnaie;
//     $requete = $bdd->prepare("INSERT INTO t_prix_produit (prix_vente,produit_id,sousresto_id,monnaie)
//              VALUES(:prix_vente,:produit_id,:sousresto_id,:monnaie)");
//     $requete->BindParam(':prix_vente', $prix_vente_site);
//     $requete->BindParam(':produit_id', $article);
//     $requete->BindParam(':sousresto_id', $sousresto_id);
//     $requete->BindParam(':monnaie', $monnaie);
//     $requete->execute();
//     echo 'okkkkkk      ';

// } 

    