<?php
require '_header.php';
?>
<h4 class="page-header">
    <div style="margin-left:50px;">
        <a class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">Ajouter une chambre</a>
    </div>
</h4>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Liste des Chambres</h4>
            </div>
            <form method="post" action="php/addpanier2.php">
                <div class="modal-body" style="height: 450px; overflow: auto;">
                    <p>
                        <?php
                        $requete_chambre = $bdd->prepare("SELECT * FROM t_chambre AS ch
			                            WHERE id_ch NOT IN (SELECT c.id_ch
                                                    FROM t_reservation AS a, t_reserve_chambre AS b, t_chambre AS c
                                                    WHERE b.idreserv = a.id_res
                                                    AND b.idchambre = c.id_ch
                                                    AND b.statut !='libre'
                                                    AND a.dte_a >=:dte_a
                                                    AND a.dte_s <=:dte_s
                                                    AND c.id_hotel=:id_hotel)AND ch.id_hotel=:id_hotel");

                        $requete_chambre->BindParam(':dte_a', $_SESSION['date_a']);
                        $requete_chambre->BindParam(':dte_s', $_SESSION['date_s']);
                        $requete_chambre->BindParam(':id_hotel', $_SESSION['id_hotel']);
                        $requete_chambre->execute();

                        $chambres = $requete_chambre->fetchAll(PDO::FETCH_OBJ);
                        ?>

                    <table width="200" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>N° Chambre</th>
                                <th>Tarif</th>
                                <th>Action</th>
                                <td></td>
                            </tr>
                        </thead>
                        <?php
                        $i = 1;
                        foreach ($chambres as $ch):
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo 'Ch ' . $ch->num_ch ?></td>
                                <td><?php echo $ch->tarif_ch ?> $ / Nuit</td>
                                <td><a class="add" href="php/addpanier.php?id=<?php echo $ch->id_ch ?>">Ajouter</a></td>
                                <td><input name="multi[]" type="checkbox" value="<?php echo $ch->id_ch ?>"/></td>
                                <td style="display: none"><input id="hebergement" type="hidden" value="<?php echo $_SESSION['hebergement']; ?>"/></td>
                            </tr>
                            <?php
                            $i++;
                        endforeach;
                        ?>
                    </table>
<!--                    <input class="form-control" type="submit" name="send" id="add15" value="Ajouter"/>-->

                    </p>
                </div>
                <div class="modal-footer">
<!--                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                    <button type="submit" class="btn btn-primary" name="send" id="add15">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div style="margin-left:50px;">
<?php require_once 'IHMpanier.php' ?>
</div>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/script.js"></script>
