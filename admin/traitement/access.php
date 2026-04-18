<?php

// Initialisation de la session
define('AD_USERNAME','ubksebutelo');
define('AD_PASSWORD','pbksebutelo');
if (isset($_POST['pseudo']) && isset($_POST['motdepasse'])) {
    // On les récupère
    $username= trim($_POST['pseudo']);
    $password = trim($_POST['motdepasse']);
    if ($username==AD_USERNAME && $password==AD_PASSWORD) {
        echo'succes';
        
    }
    else {
        echo'echec';
    }

}

