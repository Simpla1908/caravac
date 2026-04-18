<?php
include '../../bdd/connexion.php';
include_once'../../FUNCTION/hebergement.php';
include_once'../traitement/fonctionalites.php';
$result=getRowsActivation($bdd);
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
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $nom_site; ?></td>
        <td><?php echo $lib_pack; ?></td>
        <td><?php echo $lib_etat ?></td>
        <td><?php echo dateAffiche($date_activ) ?></td>
        <td><?php echo dateAffiche($dte_blocage) ?></td>
        <td>
    <?php if($etat==0)  {?>
            <a href="#"
               type="1"
               souscrip="<?php echo $souscription ?>"
               idpackcomp="<?php echo $idpackcomp ?>"
               date_echeance="<?php echo $date_echeance ?>"
               class="btn btn-info btn-xs btn_active">Activer</a>
        <?php }?>
            <span class="loader text-danger hidden">
                    <i class="fa fa-refresh fa-spin fa-1x text-danger"></i> Patientez !
                  </span>
    <?php if($etat==1)  {?>
            <a href="#"
               type="0"
               souscrip="<?php echo $souscription ?>"
               idpackcomp="<?php echo $idpackcomp ?>"
               class="btn btn-info btn-xs btn_active">Désactiver</a>
    <?php }?>
        </td>
    </tr>
    <?php
    $i++;
  }
?>