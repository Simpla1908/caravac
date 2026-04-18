<?php
// Initialisation de la session
   
if (!isset($_SESSION)) {
    session_start();
}
    include('../bdd/connexion.php');
    require '../FUNCTION/hebergement.php';
    
    if (isset($_POST['datedebut']) && isset($_POST['datefin'])) {
    $_SESSION['p_debut'] = $_POST['datedebut'];
    $_SESSION['p_fin'] = $_POST['datefin'];
    }
    $datedebut = dateToformatBdd($_SESSION['p_debut']);
    $datefin = dateToformatBdd($_SESSION['p_fin']);
    $requete = $bdd->prepare("SELECT  * FROM skt_fiche AS a,t_utilisateur AS b WHERE a.user_id=b.id_user AND a.type='appro' AND a.approuve=1 AND a.hotel_id=:hotel_id  AND a.dte BETWEEN :p_debut AND :p_fin ORDER BY a.numero ASC");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':p_debut', $datedebut);
    $requete->BindParam(':p_fin', $datefin);
    $requete->execute();
    $mouvements = $requete->fetchAll(PDO::FETCH_OBJ);
     $i=1;
     foreach($mouvements as $ap):
         $user_name=$ap->prenom_user.' '.$ap->nom_user;
         ?>
        <tr class="odd gradeX">
            <td><?php echo $i ?></td>
            <td><?php echo $ap->numero?></td>
            <td>
                <?php echo $ap->nbrprod; ?>
            </td>
            <td>
                <?php echo $ap->motifappro; ?>
            </td>
            <td><?php echo dateAffiche($ap->dte)?></td>
             <td><?php echo $user_name?></td>
            <td>
               <a href="approvisionnement_details.php?fiche_id=<?php echo $ap->id_fiche;?>&fiche_num=<?php echo $ap->numero;?>&fiche_dte=<?php echo dateAffiche($ap->dte);?>&user_name=<?php echo $user_name;?>" class="btn btn-info btn-xs" title='Details'>
                    <i class="fa fa-eye fa-fw"></i> Détails
                 </a>
            </td>
        </tr>

     <?php 
     $i++;
     endforeach;
     ?>