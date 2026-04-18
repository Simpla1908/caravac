<?php

// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}

    $_SESSION['id_hotel'] = $_POST['hotel'];

?>
