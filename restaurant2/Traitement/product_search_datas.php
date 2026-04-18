<?php
if (!isset($_SESSION)) {
    session_start();
}
//include('../bdd/connexion.php');
$motif=strtolower(trim($_GET['motif']));
$N = count($_SESSION['product']['name']);
if($motif==''){

    for ($i = 0; $i < $N; $i++) {
    $name=$_SESSION['product']['name'][$i];
    echo $_SESSION['product']['content'][$name];
    }
}else{
    $chdg='';
    for ($i = 0; $i < $N; $i++) {
    $name=$_SESSION['product']['name'][$i];
    $namecomp=strtolower($name);
    $chdg=strstr($namecomp,$motif);
    if($chdg!=''){
            echo $_SESSION['product']['content'][$name];
    }
    $chdg='';
    }
}
?>
