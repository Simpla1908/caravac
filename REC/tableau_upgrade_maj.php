 <?php 
 session_start ();
 include("../bdd/connexion.php"); 
 include("../admin/traitement/fonctionalites.php"); 
 include '../FUNCTION/hebergement.php';

 $id=$_GET['id'];
 $type=$_GET['type'];
 $result =LigneSouscription($id,$bdd);
 ?>

            <thead>
                <tr>
                    <th>Designation</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Montant</th>
                </tr>
            </thead>
            <tbody >
                 <?php
                 $tot=0;
                 $maffiche='USD';
                 $prix_pack=0;
                foreach ($result as $r) { 
                $data=ReturnPrixPack($r->id,$type,$bdd);    
                $prix_pack=$data['prix_user'];       
                ?>
                <tr>
                    <td><?php echo $r->libelle;?></td>
                    <td>1</td>
                    <td><?php echo afficheMontant($maffiche,$prix_pack);?></td>
                    <td><?php echo afficheMontant($maffiche,$prix_pack);?></td>
                </tr>
                  <?php
                   $tot=$tot+$prix_pack;
                 }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Montant Total:</th>
                    <td>
                        <input value="<?php echo $tot;?>" type="hidden" id="tot" name="tot">
                        <?php echo afficheMontant($maffiche,$tot);?>
                    </td>
                </tr>
            </tfoot>
    