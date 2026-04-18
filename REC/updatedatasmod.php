<?php
// Initialisation de la session
session_start();
$id = $_GET['id'];
if ($id == 'fact') {
    $_SESSION['app_folder'] = 'fact';
    $_SESSION['fichierjs'] = 'fact';
    $_SESSION['function'] = 'fact';
    $_SESSION['title'] = 'STOCK';
    $_SESSION['menu'] = 'menuparam';
}
