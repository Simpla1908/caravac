<?php
session_start();
$nbArticles = count($_SESSION['panier']['id_article']);
echo $nbArticles;
