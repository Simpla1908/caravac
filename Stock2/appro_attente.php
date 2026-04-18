<?php
// Initialisation de la session
   
if (!isset($_SESSION)) {
    session_start();
}
    $requete = $bdd->prepare("SELECT  * FROM skt_fiche AS a,t_validation AS b,stk_produit AS c WHERE a.id_fiche=b.fiche_id AND b.produit_id=c.idprod AND a.id_fiche=:id_fiche ORDER BY a.id_fiche ASC");
    $requete->BindParam(':id_fiche', $id_fiche);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
     $i=1;
     foreach($result as $r):
         ?>
        <tr class="odd gradeX">
            <td><?php echo $i ?></td>
            <td><?php echo $r->designation?></td>
            <td>
                <?php echo $r->qte_envoye; ?>
            </td>
            <td>
             <input type="hidden" min="1" value="<?php echo $r->id_validation; ?>" class="" id="<?php echo $r->id_validation; ?>" name="validates[]">
             <input type="hidden" min="1" value="<?php echo $r->idprod; ?>" class="" id="idprod<?php echo $r->id_validation; ?>" name="idprod<?php echo $r->id_validation; ?>">
             <input type="hidden" min="1" value="<?php echo $r->qte_envoye; ?>" class="" id="qteE<?php echo $r->id_validation; ?>" name="qteE<?php echo $r->id_validation; ?>">
             <input size="10" type="number" min="1" value="<?php echo $r->qte_envoye; ?>" validate="<?php echo $r->id_validation; ?>" class="quantite_change" id="qteR<?php echo $r->id_validation; ?>" name="qteR<?php echo $r->id_validation; ?>">
            </td>
            <td id="ecrat<?php echo $r->id_validation; ?>">
                <?php echo ($r->qte_envoye-$r->qte_envoye); ?>
            </td>
             <td>
                <?php echo $r->unite; ?>
            </td>
        </tr>
     <?php 
     $i++;
     endforeach;
     ?>