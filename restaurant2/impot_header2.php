<header class="main-header">
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="index.php" class="navbar-brand"><b><i class="ion-android-restaurant"></i> Ebutelo</b> RESTO (<span class="text" id='nom_ssite'><?php echo $_SESSION['libelle_resto']?></span>)</a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                        <!-- Navbar Right Menu -->
                        <div class="navbar-custom-menu">
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                                <ul class="nav navbar-nav">
                                    <li><a href="index.php?ss=<?php echo $_SESSION['id_sousresto']?>"><i class="fa fa-mail-reply-all"></i> Retour</a></li>
                                    <!--<li><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i> Plus</a></li>-->
                                    <!-- notifiaction approvisionnement-->
                                     <?php
                                        $nbrbl = 0;
                                        $requete = $bdd->prepare("SELECT COUNT(*) AS nbrbl FROM skt_fiche AS a,t_depot AS b,t_sousresto AS c WHERE a.depot_id=b.id_depot AND b.id_depot=c.depot_id AND a.type='transfert' AND a.approuve=0 AND c.id_sousresto=:id_sousresto ORDER BY a.id_fiche ASC");
                                        $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
                                        $requete->execute();
                                        $result = $requete->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result as $r):
                                            $nbrbl = $r->nbrbl;
                                        endforeach;
                                        ?>
                                     <?php if($nbrbl>0){  ?>
                                    <li class="dropdown notifications-menu">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-bell fa-fw"></i> 
                                            <span class="label label-warning">
                                                <?php echo $nbrbl; ?>
                                            </span> 
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
                                            $requete = $bdd->prepare("SELECT a.id_fiche,a.numero,b.id_depot,a.nbrprod FROM skt_fiche AS a,t_depot AS b,t_sousresto AS c WHERE a.depot_id=b.id_depot AND b.id_depot=c.depot_id AND a.type='transfert' AND a.approuve=0 AND c.id_sousresto=:id_sousresto ORDER BY a.id_fiche ASC");
                                            $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
                                            $requete->execute();
                                            $result = $requete->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($result as $r):
                                                ?>
                                                <li class="divider"></li>
                                                <li>
                                                    <a href="approvalidat.php?id_fiche=<?php echo $r->id_fiche ?>&num_bon=<?php echo $r->numero ?>&depot_id=<?php echo $r->id_depot ?>">
                                                        <div>
                                                            <i class="fa fa-file-text-o fa-fw"></i> <?php echo 'BL' . $r->numero ?>
                                                            <span class="pull-right text-muted"><?php echo $r->nbrprod ?></span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <?php
                                            endforeach;
                                            ?>
                                        </ul>
                                        <!-- /.dropdown-alerts -->
                                    </li>
                                    <?php } ?>
                                    <!-- fin notifiaction approvisionnement-->
                                    <!--<li><a href="#">Taux du jour: <b><span id="taux_jr"><?php // echo arrondir($taux_op); ?></span></b> </a></li>-->
                                    <!-- Notifications: style can be found in dropdown.less -->
                                    <li class="dropdown">
                                        <a href="#" title="Liste des sous-sites" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-bank fa-fw"></i>
                                            <!--<span class="label label-warning">10</span>-->
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <?php foreach ($sous_sites as $r){ ?>
                                            <li>
                                                <a href="?ss=<?php echo $r->id_sousresto?>">
                                                    <i class="fa fa-circle-o text-aqua"></i> <?php echo $r->libelle?>
                                                </a>
                                            </li>
                                             <li class="divider"></li>
                                           <?php } ?>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="#"><?php echo ucfirst($_SESSION['nom_user']); ?></a>
                                            </li>
                                            <li><a href="#">
                                                    <?php
                                                    if ($_SESSION['type_user'] == 1) {
                                                        echo strtoupper($_SESSION['company_name']);
                                                    } else {
                                                        echo strtoupper($_SESSION['nom_hotel']);
                                                    }
                                                    ?>
                                                </a>
                                            </li>
                                            <li><a href="#">
                                                    <?php
                                                    if ($_SESSION['test'] == 1) {
                                                        echo '(' . $_SESSION['libelle_resto'] . ')';
                                                    }
                                                    ?>
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li><a href="../Authentification/logout.php"><i class="fa fa-sign-out fa-fw"></i> Déconnexion</a>
                                            </li>
                                        </ul>
                                        <!-- /.dropdown-user -->
                                    </li>
                                    <?php if (in_array('AR10', $_SESSION['actions']['code_actions'])) { ?>
                                        <li>
                                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                                        </li>
                                    <?php } ?>
                                   
                                </ul>
                            </div>
                            <!-- /.navbar-collapse -->
                        </div>
                        <!-- /.navbar-custom-menu -->
                    </div>
                    <!-- /.container-fluid -->
                </nav>
            </header>