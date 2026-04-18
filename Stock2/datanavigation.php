 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell fa-fw"></i> <span class="label label-warning">10</span> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-alerts">
            <li>
                <a href="#">
                    <div>
                        <b>BON DE LIVRAISON</b>
                        <span class="pull-right text-muted"><b>PRODUIT</b></span>
                    </div>
                </a>
            </li>
            <?php    
            $requete = $bdd->prepare("SELECT * FROM skt_fiche WHERE type='achat' AND approuve=0 AND hotel_id=:hotel_id ORDER BY id_fiche ASC");
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
            foreach($result as $r):
            ?>
            <li class="divider"></li>
            <li>
                <a href="approvisionnement_en_attente.php?id_fiche=<?php echo $r->id_fiche?>&num_bon=<?php echo $r->numero?>&depot_id=<?php echo $r->depot_id?>">
                    <div>
                        <i class="fa fa-file-text-o fa-fw"></i> <?php echo 'BL'.$r->numero?>
                        <span class="pull-right text-muted"><?php echo $r->nbrprod?></span>
                    </div>
                </a>
            </li>
            <?php    
              endforeach;
            ?>
        </ul>
        <!-- /.dropdown-alerts -->