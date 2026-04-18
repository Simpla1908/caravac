<?php
$p = '';
if (!empty($_GET['p'])) {
    $p = $_GET['p'];
} ?>
<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">
                    <b><i class="ion-android-restaurant"></i>Ebutelo</b>
                    <?php if ($p != 'rapport') {  ?>
                        (<span class="text" id='nom_ssite'><?php echo $_SESSION['libelle_resto'] ?></span>)
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
                        <?php if (in_array('AR14', $_SESSION['actions']['code_actions'])) { ?>
                            <li>
                                <a href="../REC/tableaudebordRec.php" title="Tableau de bord"><b><i class="fa fa-home fa-2x"></i></b></a>
                            </li>
                        <?php } ?>
                        <?php if ($caisse == 1) { ?>
                            <li><a href="caissier.php"><i class="fa fa-mail-reply-all fa-2x"></i> Accueil</a></li>
                        <?php } else { ?>
                            <li><a href="index.php?ss=<?php echo $_SESSION['id_sousresto'] ?>"><i class="fa fa-mail-reply-all fa-2x"></i> Accueil</a></li>
                        <?php } ?>

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-user fa-fw fa-2x"></i> <i class="fa fa-caret-down"></i>
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