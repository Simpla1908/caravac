<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
include('../bdd/connexion .php');
 if(($_SESSION['libe_droit']=='Gerant Local')||($_SESSION['libe_droit']=='Receptionniste')){
 $id_hotel = $_SESSION['id_hotel'];}
 else {
   $id_hotel =$_GET['id_hotel']; 
}
if ($id_hotel == 0) {
    // Situation Journalière caisse entree
    $entree='entree';
    $sortie='sortie';
    $date_bon = date('Y-m-d');
    $requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_entree_jr ,SUM(montantUSD) AS montantUSD_entree_jr"
            . " FROM t_operation AS op  WHERE op.type=:type AND op.date_bon<:date_bon AND op.libelle='Heberge'");
    $requete->BindParam(':type', $entree);
    $requete->BindParam(':date_bon', $date_bon);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($operations as $op) {
        $montantFC_entree_jr = $op->montantFC_entree_jr;
        $montantUSD_entree_jr = $op->montantUSD_entree_jr;
    }

//    Situation Journalière caisse sortie
    $requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_sortie_jr ,SUM(montantUSD) AS montantUSD_sortie_jr"
            . " FROM t_operation AS op  WHERE op.type=:type AND op.date_bon<:date_bon AND op.libelle='Heberge'");
    $requete->BindParam(':type', $sortie);
    $requete->BindParam(':date_bon', $date_bon);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($operations as $op) {
        $montantFC_sortie_jr = $op->montantFC_sortie_jr;
        $montantUSD_sortie_jr = $op->montantUSD_sortie_jr;
    }
} else {
// Situation Journalière caisse entree
    $entree='entree';
    $sortie='sortie';
    $date_bon = date('Y-m-d');
    if(($_SESSION['libe_droit']=='Gerant Local')||($_SESSION['libe_droit']=='Receptionniste')){
    $requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_entree_jr ,SUM(montantUSD) AS montantUSD_entree_jr"
            . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id AND op.date_bon<:date_bon AND op.libelle='Heberge'");
    $requete->BindParam(':type', $entree);
    $requete->BindParam(':hotel_id',$id_hotel);
    $requete->BindParam(':date_bon', $date_bon);
    }  else {
    $requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_entree_jr ,SUM(montantUSD) AS montantUSD_entree_jr"
            . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id AND op.date_bon<:date_bon AND op.libelle='Heberge'");
    $requete->BindParam(':type', $entree);
    $requete->BindParam(':hotel_id', $id_hotel);
    $requete->BindParam(':date_bon', $date_bon);  
    }
 $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($operations as $op) {
        $montantFC_entree_jr = $op->montantFC_entree_jr;
        $montantUSD_entree_jr = $op->montantUSD_entree_jr;
    }

//    Situation Journalière caisse sortie
    $requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_sortie_jr ,SUM(montantUSD) AS montantUSD_sortie_jr"
            . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id AND op.date_bon<:date_bon AND op.libelle='Heberge'");
    $requete->BindParam(':type', $sortie);
    $requete->BindParam(':hotel_id', $id_hotel);
    $requete->BindParam(':date_bon', $date_bon);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($operations as $op) {
        $montantFC_sortie_jr = $op->montantFC_sortie_jr;
        $montantUSD_sortie_jr = $op->montantUSD_sortie_jr;
    }
}
$caisse_montantUSD_entree=$montantUSD_entree_jr;
$caisse_montantFC_entree=$montantFC_entree_jr;
$caisse_montantUSD_sortie=$montantUSD_sortie_jr;
$caisse_montantFC_sortie=$montantFC_sortie_jr ;
$caisse_montantUSD_solde=$caisse_montantUSD_entree - $caisse_montantUSD_sortie;
$caisse_montantFC_solde=$caisse_montantFC_entree - $caisse_montantFC_sortie;
?>
<div class="col-lg-4">
    <div class="panel panel-default">
        <div class="panel-heading">Entrée</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <h4>USD&nbsp;:&nbsp;
                        <font color="#428bd1">
                        <?php
                        if ($caisse_montantUSD_entree == 0) {
                            echo '0 $';
                        } else {
                            echo $caisse_montantUSD_entree . ' $';
                        }
                        ?>
                        </font>
                    </h4> 
                </div>
                <div class="col-lg-12">
                    <h4>CDF&nbsp;:&nbsp;
                        <font color="#428bd1">
                        <?php
                        if ($caisse_montantFC_entree == 0) {
                            echo '0 FC';
                        } else {
                            echo $caisse_montantFC_entree . ' FC';
                        }
                        ?>
                        </font>
                    </h4> 
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="col-lg-4">
    <div class="panel panel-default">
        <div class="panel-heading">Sortie</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <h4>USD&nbsp;:&nbsp;
                        <font color="#428bd1">
                        <?php
                        if ($caisse_montantUSD_sortie == 0) {
                            echo '0 $';
                        } else {
                            echo $caisse_montantUSD_sortie . ' $';
                        }
                        ?>
                        </font>
                    </h4> 
                </div>
                <div class="col-lg-12">
                    <h4>CDF&nbsp;:&nbsp;
                        <font color="#428bd1">
                        <?php
                        if ($caisse_montantFC_sortie == 0) {
                            echo '0 FC';
                        } else {
                            echo $caisse_montantFC_sortie . ' FC';
                        }
                        ?>
                        </font>
                    </h4> 
                </div>
            </div>
        </div>
    </div>
</div> 

<div class="col-lg-4">
    <div class="panel panel-default">
        <div class="panel-heading">Solde</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <h4>USD&nbsp;:&nbsp;
                        <font color="#428bd1">
                        <?php
                        if ($caisse_montantUSD_solde == 0) {
                            echo '0 $';
                        } else {
                            echo $caisse_montantUSD_solde . ' $';
                        }
                        ?>
                        </font>
                    </h4> 
                </div>
                <div class="col-lg-12">
                    <h4>CDF&nbsp;:&nbsp;
                        <font color="#428bd1">
                        <?php
                        if ($caisse_montantFC_solde == 0) {
                            echo '0 FC';
                        } else {
                            echo $caisse_montantFC_solde . ' FC';
                        }
                        ?>
                        </font>
                    </h4> 
                </div>
            </div>
        </div>
    </div>
</div> 