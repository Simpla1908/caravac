<?php include("../bdd/connexion.php"); ?>
<?php include("../FUNCTION/hebergement.php");
session_start();
 ?>
<?php
$i = 1;
$requete= $bdd->prepare("SELECT *
                                FROM souscription 
                                WHERE site_id=:site_id
                                ORDER BY id");
$requete->BindParam(':site_id', $_SESSION['id_hotel']);
$requete->execute();
while ($donnees = $requete->fetch()) {
$id = $donnees['id'];
$libelle = $donnees['libelle'];
$type_souscription = $donnees['type_souscription'];
$date1 = $donnees['date_activ'];
$statut = $donnees['statut'];
$etat=$donnees['etat'];
$date2 = $donnees['dte_echeance'];
$dtesous = dateAffiche($donnees['date_sous']);
$periode='Du '.dateAffiche($date1).' au '.dateAffiche($date2); ?>
    <tr>
        <td><?php echo $i;?></td>
        <td><a href="#" statut="<?php echo $statut;?>" dtesous="<?php echo $dtesous;?>" id="<?php echo $id;?>" lib="<?php echo $libelle;?>" type="<?php echo $type_souscription;?>" title="détails souscription" class="detail_souscript" data-toggle="modal" data-target="#detail_souscription"> <?php echo $libelle;?> </a></td>
        <td><?php echo $periode;?></td>
        <td>
    <?php
        if($statut=='demo'){  
            if($etat==1){
        ?> 
        <span class="label label-info">Démo</span>
        <?php
        }else{
        ?> 
        <span class="label label-danger">Désactivé</span>
         <?php
        }
        ?>
        <?php
        }elseif($statut=='abonne'){     
            if($etat==1){
        ?> 
        <span class="label label-success">Abonné</span>
        <?php
        }else{
        ?> 
        <span class="label label-danger">Désactivé</span>
         <?php
        }
        }
        ?> 
        </td>
        <td align="center"><a href="factures_company.php?souscription_id=<?php echo $id;?>" class="btn btn-primary btn-xs" ><i class="fa fa-files-o"></i> Factures</a></td>
        <td align="center"><a href="#" id="<?php echo $id;?>" lib="<?php echo $libelle;?>" <?php if($statut!='demo'){ ?> disabled="disabled" <?php } ?> class="btn btn-success btn-xs upgrade_souscript" data-toggle="modal" data-target="#upgrade">Upgrade <i class="fa fa-external-link"></i></a></td>

    </tr>
   <?php
   $i++;
    }
    ?> 
                         
