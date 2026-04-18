<?php
if (!isset($_SESSION)) {
            session_start();
        }
include '../bdd/connexion.php';
$requete = $bdd->prepare("SELECT DISTINCT res.id_res,res.num_bc,res.etat,cl.designation AS client_designation ,cl.nom_client,bc.nameprod,bc.quantite,bc.dte_h FROM  t_reservation AS res,t_client AS cl,bon_commandes AS bc WHERE bc.commande_id=res.id_res  AND res.id_client=cl.id_client AND  res.id_hotel=:hotel_id GROUP BY bc.commande_id ");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();
$bc_commandes= $requete->fetchAll(PDO::FETCH_OBJ);


 ?>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Tous les bons de commande</h4>
        </div>
        <div class="panel-body ">
        <?php
            foreach ($bc_commandes as $commande) {
                $num_bc = $commande->num_bc;
                $nom_client = $commande->nom_client;
                $client_designation = $commande->client_designation;
                $id_res = $commande->id_res;
                ?>
        <div class="col-md-3">
            <!-- DIRECT CHAT PRIMARY -->
            <div class="box box-default direct-chat direct-chat-primary panel panel-default">
                
                <div class="box-header with-border center" align="center">

                    <h3 class="box-title"> <?php echo $num_bc;   ?></h3><br>
                    <span data-toggle="tooltip" title="Table:4" class="badge bg-green"><?php if (empty($client_designation)) { echo $nom_client;} else {echo $client_designation;} ?></span>

                </div>
                    <div class="box-body" align="center" style="overflow: auto; height: 225px;">
                        <table class="table no-border table-condensed">
                            <thead>
                                <th>Qté</th>
                                <th>Désignation</th>
                            </thead>
                            <tbody>
                                <?php
                                 $requete = $bdd->prepare("SELECT res.num_bc,res.etat,cl.designation AS client_designation ,cl.nom_client,bc.nameprod,bc.quantite,bc.dte_h FROM  t_reservation AS res,t_client AS cl,bon_commandes AS bc WHERE bc.commande_id=res.id_res  AND res.id_client=cl.id_client AND  res.id_hotel=:hotel_id  AND  res.id_res=:id_res ");
                                    $requete->BindParam(':hotel_id',$_SESSION['id_hotel']);
                                    $requete->BindParam(':id_res',$id_res);
                                    $requete->execute();
                                    $bc= $requete->fetchAll(PDO::FETCH_OBJ);
                                 foreach ($bc as $commande) {
                                ?>
                                <tr>
                                    <td><?php echo $commande->quantite;   ?></td>
                                    <td><?php  echo $commande->nameprod;  ?></td>
                                </tr>
                             <?php }  ?>
                            </tbody> 
                        </table>
                    </div>

                </div>
           
                <!--/.direct-chat -->
            </div>
             <?php  } ?>
            <!-- /.col -->


        </div>
    </div>
</div>