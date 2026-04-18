<?php
if (!isset($_SESSION)) {
    session_start();
}
//include('../bdd/connexion.php');
$motif=strtolower(trim($_GET['motif']));
$N = count($_SESSION['TableResto']['name']);
if($motif==''){

    for ($i = 0; $i < $N; $i++) {
    $name=$_SESSION['TableResto']['name'][$i];
    echo $_SESSION['TableResto']['content'][$name];
    }
}else{
    $chdg='';
    for ($i = 0; $i < $N; $i++) {
    $name=$_SESSION['TableResto']['name'][$i];
    $namecomp=strtolower($name);
    $chdg=strstr($namecomp,$motif);
    if($chdg!=''){
            echo $_SESSION['TableResto']['content'][$name];
    }
    $chdg='';
    }
}
?>
