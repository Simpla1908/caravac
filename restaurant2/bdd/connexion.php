<?php
ini_set('max_execution_time',300);//300 secondes = 5 minutes
// Définition des variables de connexion
$user = 'root';
$pass = 'E1b2u3t4e5l6o@';
$dsn = 'mysql:host=localhost;dbname=caravacdb';
// Connexion à la base de données
try {
$bdd = new PDO($dsn, $user, $pass);
$bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
print "Erreur ! : " . $e->getMessage() . "<br/>";
die();
}
