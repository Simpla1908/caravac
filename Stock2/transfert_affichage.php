<?php
// Initialisation de la session
   
if (!isset($_SESSION)) {
    session_start();
}

    $_SESSION['p_debut']=date('d/m/Y');
    $_SESSION['p_fin']=date('d/m/Y');
    if (isset($_POST['datedebut']) && isset($_POST['datefin'])) {
    include('../bdd/connexion.php');
    require '../FUNCTION/hebergement.php';
    $_SESSION['p_debut'] = $_POST['datedebut'];
    $_SESSION['p_fin'] = $_POST['datefin'];
    }
    $datedebut = dateToformatBdd($_SESSION['p_debut']);
    $datefin = dateToformatBdd($_SESSION['p_fin']);
    $requete = $bdd->prepare("SELECT  * FROM skt_fiche AS a,t_utilisateur AS b,t_depot AS c WHERE a.user_id=b.id_user AND a.type='transfert' AND a.hotel_id=:hotel_id  AND a.depot_id=c.id_depot AND a.dte BETWEEN :p_debut AND :p_fin ORDER BY a.numero ASC");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':p_debut', $datedebut);
    $requete->BindParam(':p_fin', $datefin);
    $requete->execute();
    $mouvements = $requete->fetchAll(PDO::FETCH_OBJ);
    $i=1;
     foreach($mouvements as $ap):?>
        <tr class="odd gradeX">
            <td><?php echo $i ?></td>
            <td><?php echo $ap->numero?></td>
             <td>
                <?php echo $ap->libelle; ?>
            </td>
<!--            <td>
                <?php // echo $ap->nbrprod; ?>
            </td>-->
            <td><?php echo dateAffiche($ap->dte)?></td>
             <td><?php 
             $user=$ap->prenom_user.' '.$ap->nom_user;
             echo $user?>
           </td>
            <td>
               <a href="transfert_details.php?fiche_id=<?php echo $ap->id_fiche;?>&fiche_num=<?php echo $ap->numero;?>&approuve=<?php echo $ap->approuve;?>&pos=<?php echo $ap->libelle;?>&user=<?php echo $user;?>&fiche_dte=<?php echo dateAffiche($ap->dte);?>" class="btn btn-info btn-xs" title='Details'>
                    <i class="fa fa-eye fa-fw"></i> Détails
                 </a>
            </td>
        </tr>

     <?php 
     $i++;
     endforeach;
     ?>
  