<?php
if (!isset($_SESSION)) {
    session_start();
}
$id = $_GET['id'];
$qte = $_GET['qte'];
if (!in_array($id, $_SESSION['eclat']['id'])) {
    array_push($_SESSION['eclat']['id'], $id);
    $_SESSION['eclat']['qte_modif'][$id] = $qte;
}
