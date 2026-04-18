<?php
// session_start();
// include '../../FUNCTION/hebergement.php';
// //Connexion 1
// $user = 'ebutelociruserbd';
// $pass = 'Mdpebutelo20';
// $dsn = 'mysql:host=ebutelociruserbd.mysql.db;dbname=ebutelociruserbd';
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
// try {
//     $bdd = new PDO($dsn, $user, $pass);
//     $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
//     echo 'con2 ok';
// } catch (PDOException $e) {
//     echo 'Echec2';
//     print "Erreur ! : " . $e->getMessage() . "<br/>";
//     die();
// }
// //DONNEES DE BASE
// $company_id=178;
// $id_hotel = 186;
// $id_sousresto=82;
// $datedebut='2018-01-01';
// $datefin='2019-02-28';

// //$requete = $bdd1->prepare("SELECT  * FROM t_operation WHERE libelle='Heberge' AND idoperation=1355");
// $requete = $bdd1->prepare("SELECT  * FROM t_operation WHERE libelle='resto' AND hotel_id=:id_hotel AND date_bon BETWEEN :d1 AND :d2 ORDER BY idoperation ASC");
// $requete->BindParam(':id_hotel', $id_hotel);
// $requete->BindParam(':d1',$datedebut);
// $requete->BindParam(':d2',$datefin);
// $requete->execute();
// $result = $requete->fetchAll(PDO::FETCH_OBJ);
// var_dump($result);
// foreach ($result as $op) {
// $montant_cdf = $op->montantFC ;
// $montant_usd = $op->montantUSD ;
// $paie_id='';
// $type_vers='restaurant';
// $motif='restaurant';
// $user_vers = $op->user_vers;
// $m_affiche='CDF';
// $dte=$op->date_bon;
// $tauxdollar=1;
// /* $lib='BV';
// $num_cmd=getnumerotation2($id_sousresto,$lib,$bdd);
// $num_cmd_format = format_numero($num_cmd);
// $numbon=$num_cmd_format; */

// $lib = 'BVH';
// $num_cmd = getnumerotation($id_hotel, $lib, $bdd);
// $num_cmd_format = format_numero($num_cmd);
// $numbon =$lib.$num_cmd_format;
// insertmontantVersement($user_vers,$dte,$montant_cdf,$montant_usd,$m_affiche,$type_vers,$tauxdollar,$motif,$paie_id,$id_hotel,$id_sousresto,$numbon,$bdd);
// setnumerotation($id_hotel,$lib,$num_cmd+1,$bdd);
// echo 'ok';
// }








