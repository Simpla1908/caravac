<?php

// inclure la classe
include("Numbers/Words.php");
 
// créer l'objet
$nw = new Numbers_Words();
 
// convertir en chaîne
echo "10000 en lettres donne " . $nw->toWords(100000);
?>