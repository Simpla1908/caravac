<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                
            </li>
            <li>
                <a class="active" href="tableaudebordRec.php"><i class="fa fa-dashboard fa-fw"></i> Tableau de bord</a>
            </li>
            <?php if ($_SESSION['type_user'] == 1) { ?>
                <li>
                    <a  href="mes_souscriptions.php"><i class="fa fa-server fa-fw"></i> Mes souscriptions</a>
                </li>
            <?php } ?>
<!--            <li>
                <a href="gg_liste_partenaire.php"><i class="fa fa-dot-circle-o fa-fw"></i> Partenaires</a>
            </li>-->
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Utilisateurs<span class="fa arrow"></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="groupe_utilisateur_form.php">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Groupes d'accès</a>
                    </li>
                    <li>
                        <a href="gl_liste_utilisateur.php">&nbsp;<i class="fa fa-user fa-fw"></i> Utilisateurs</a>
                    </li>
                    <li>
                        <a href="affectation_droit_acces.php">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Affectation droit d'accès</a>
                    </li>
                    <li>
                        <a href="monotoring_user.php">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Monotoring</a>
                    </li>
                </ul>
            </li>
            <li>
                <a  href="reglage_view.php?bd=yes"><i class="fa fa-gear fa-fw"></i> Configuration</a>
            </li>
            
            <li>
                <a href="#"><i class="fa fa-th fa-fw"></i> <b>Modules</b><span class="fa arrow"></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Comptabilité</a>
                    </li>
                    <li>
                        <a href="#">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Stock</a>
                    </li>
                    <li>
                        <a href="#">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Hebergement</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>

<!-- Modal AJOUTER MODULE BEFORE SITE-->
<?php include './appstore_site.php';?>
<!-- /.modal -->