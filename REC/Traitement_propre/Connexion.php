<?php
class Connexion
{
// Définition des variables de connexion
public $user = 'root';
public  $pass = '';
public $dsn = 'mysql:host=localhost;dbname=kabe_hotel_db';

public function seconnecter()
{
	try {
		
		$bdd = new PDO($dsn, $user, $pass);
		$bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
		
		} catch (PDOException $e) {
		    print "Erreur ! : " . $e->getMessage() . "<br/>";
			die();
            return $bdd;
        }
 }
 
 }
?>