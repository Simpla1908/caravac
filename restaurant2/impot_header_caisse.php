<header class="main-header">
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="#" class="navbar-brand"><b><i class="ion-android-restaurant"></i> Ebutelo</b>(<span class="text" id='nom_ssite'><?php echo $_SESSION['libelle_resto']?></span>)</a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                        <!-- Navbar Right Menu -->
                        <div class="navbar-custom-menu">
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                                <ul class="nav navbar-nav">
                                    <?php if (in_array('AR14',$_SESSION['actions']['code_actions'])){?>
                                    <li>
                                        <a href="../REC/tableaudebordRec.php" title="Tableau de bord"><b><i class="fa fa-home fa-2x"></i></b></a>
                                    </li>
                                    <?php }?>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-user fa-fw fa-2x"></i>  <i class="fa fa-caret-down fa-2x"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="#"><?php echo ucfirst($_SESSION['nom_user']); ?></a></li>
                                            <li class="divider"></li>
                                            <li><a href="../Authentification/logout.php"><i class="fa fa-sign-out fa-2x"></i> Déconnexion</a></li>
                                        </ul>
                                        <!-- /.dropdown-user -->
                                    </li>
                                       <?php //if (in_array('FDCRESTO',$_SESSION['actions']['code_actions'])){?>

                                        <li>
                                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-dollar fa-2x"></i></a>
                                        </li>

                                        <?php// }?>

                                </ul>
                            </div>
                            <!-- /.navbar-collapse -->
                        </div>
                        <!-- /.navbar-custom-menu -->
                    </div>
                    <!-- /.container-fluid -->
                </nav>
            </header>