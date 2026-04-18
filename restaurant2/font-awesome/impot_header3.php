<?php 
$p='';
if(!empty($_GET['p'])){ 
   $p=$_GET['p']; 
} ?>
<header class="main-header">
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="#" class="navbar-brand">
                                <b><i class="ion-android-restaurant"></i>Ebutelo</b>
                                <?php if($p!='rapport'){  ?>
                                (<span class="text" id='nom_ssite'><?php echo $_SESSION['libelle_resto']?></span>)
                                <?php } ?>
                            </a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                        <!-- Navbar Right Menu -->
                        <div class="navbar-custom-menu">
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                                <ul class="nav navbar-nav">
                                    
                                     <?php 
                                     if ($_SESSION['type_user'] == 1) { ?>
                                        <li><a href="index.php?ss=<?php echo $_SESSION['id_sousresto'] ?>"><i
                                                    class="fa fa-mail-reply-all"></i> Retour</a></li>
                                        <?php}else{?>
                                        <li><a href="caissier.php"><i class="fa fa-mail-reply-all"></i> Retour</a></li>
                                        <?php } ?>
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
                                    </li>
                                    <?php } ?>
                                    <!-- fin notifiaction approvisionnement-->
                                    <!--<li><a href="#">Taux du jour: <b><span id="taux_jr"><?php // echo arrondir($taux_op); ?></span></b> </a></li>-->
                                    <!-- Notifications: style can be found in dropdown.less -->
                                    
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="#"><?php echo ucfirst($_SESSION['nom_user']); ?></a></li>
                                            <li class="divider"></li>
                                            <li><a href="../Authentification/logout.php"><i class="fa fa-sign-out fa-fw"></i> Déconnexion</a></li>
                                        </ul>
                                        <!-- /.dropdown-user -->
                                    </li>
                                </ul>
                            </div>
                            <!-- /.navbar-collapse -->
                        </div>
                        <!-- /.navbar-custom-menu -->
                    </div>
                    <!-- /.container-fluid -->
                </nav>
            </header>