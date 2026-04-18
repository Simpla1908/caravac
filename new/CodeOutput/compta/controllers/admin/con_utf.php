<?php

// Définition des variables de connexion
$user = 'root';
$pass = '';
$dsn = 'mysql:host=localhost;dbname=ebuhoteldb';
// Connexion à la base de données
try {
    $bdd = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
    print "Erreur ! : " . $e->getMessage() . "<br/>";
    die();
}
