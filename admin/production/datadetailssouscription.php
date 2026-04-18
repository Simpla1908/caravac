<?php
include '../../bdd/connexion.php';
include_once'../../FUNCTION/hebergement.php';
include_once'../traitement/fonctionalites.php';
//Ici type doit etre souscription
$site_id = 0;
if (isset($_GET['id'])) {
    $site_id = (int) $_GET['id'];
}
$result = getRowsSouscriptionDetails($site_id, $bdd);
$i = 1;
foreach ($result as $o) {
    $id_site = $o->id_hotel;
    $nom_site = $o->nom_hotel;
    $id_pack = $o->id;
    $lib_pack = $o->libelle;
    $idpackcomp= $o->idpackcomp;
    $etat= $o->etat;
    $lib_etat='desactivé';
    if($etat==1)$lib_etat='activé';
    $date_sous= $o->date_sous;
    $date_activ= $o->date_activ;
    $date_echeance= $o->date_echeance;
    $dte_blocage= $o->dte_blocage;
    $souscription= $o->souscription;
    $prix_user= $o->prix_user;
    $prix_par_user= $o->prix_par_user;
    $paye= $o->paye;
       ?> 
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $lib_pack ?> </td>
        <td><?php echo $souscription ?> </td>
        <td><?php echo $lib_etat?> </td>
        <td><?php echo afficheMontant(getsymbole_devise(),$prix_user); ?> </td>
        <td><?php echo afficheMontant(getsymbole_devise(),$prix_par_user); ?> </td>
         <td>
        <?php 
        if($paye==1)  {
        if($etat==0)  {?>
             
                <a href="#"
                   type="1"
                   site="<?php echo $id_site ?>"
                   souscrip="<?php echo $souscription ?>"
                   idpackcomp="<?php echo $idpackcomp ?>"
                   date_echeance="<?php echo $date_echeance ?>"
                   class="btn btn-info btn-xs btn_active">Activer</a>
            <?php }?>
        <?php if($etat==1)  {?>
                <a href="#"
                   type="0"
                   site="<?php echo $id_site ?>"
                   souscrip="<?php echo $souscription ?>"
                   idpackcomp="<?php echo $idpackcomp ?>"
                   class="btn btn-info btn-xs btn_active">Désactiver</a>
        <?php } }?>
            </td>
    </tr>
    <?php $i++;
} ?>