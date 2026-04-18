<?php
if(!isset($_SESSION)){
   session_start();
}
include '../bdd/connexion.php';
include'../../FUNCTION/hebergement.php';
include'../../FUNCTION/stock.php';
include'../../FUNCTION/restaurant.php';
include'../../language/eng.php';


