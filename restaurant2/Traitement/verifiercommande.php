<?php

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['payer'])) {
    //verifier si la commande est vide avant de payer
    $json = array();
    $nbArticles = count($_SESSION['panier']['id_article']);
    if ($nbArticles == 0) {
        $json['message'] = 'OK';
      
    }
}
echo json_encode($json);