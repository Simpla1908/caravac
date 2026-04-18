<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
<!--                <div class="input-group custom-search-form">
                    <img src="images/caisse2.png"/>
                </div>-->
            </li>
            
            <li>
                <a class="active" href="../REC/tableaudebordRec.php"><i class="fa fa-dashboard fa-fw"></i> Tableau de bord</a>
            </li>
            <?php if (in_array('TBS',$_SESSION['actions']['code_actions'])){?>
            <li>
                <a href="index.php">&nbsp;&nbsp;&nbsp;<i class="fa fa-credit-card fa-fw"></i> Stock</a>
            </li>
            <?php }?>
            <?php if (in_array('APPRL',$_SESSION['actions']['code_actions'])||in_array('APPRA',$_SESSION['actions']['code_actions'])){?>
            <li>
                <a href="approvisionnement_view.php?operation=appro">&nbsp;&nbsp;&nbsp;<i class="fa fa-sign-in fa-fw"></i> Approvisionnements</a>
            </li>
            <?php }?>
            <?php if (in_array('SORL',$_SESSION['actions']['code_actions'])||in_array('SORA',$_SESSION['actions']['code_actions'])){?>
            <li>
                <a href="approvisionnement_view.php?operation=sortie">&nbsp;&nbsp;&nbsp;<i class="fa fa-sign-out fa-fw"></i> Sorties (Transfert)</a>
            </li>
             <?php }?>
            <?php if (in_array('RPF',$_SESSION['actions']['code_actions'])||in_array('RFA',$_SESSION['actions']['code_actions'])){?>
            <li>
                <a href="#"><strong> Rapport</span></strong></a>
            </li>
            <?php }?>
            <?php if (in_array('RPF',$_SESSION['actions']['code_actions'])){?>
            <li>
                <a href="produit_famille_view.php">&nbsp;&nbsp; <i class="fa fa-files-o fa-fw"></i> Inventaire</a>
             </li>
             <?php }?>
            <?php if (in_array('RFA',$_SESSION['actions']['code_actions'])){?>
            <li>
                <a href="fiche_stock_view.php">&nbsp;&nbsp; <i class="fa fa-table fa-fw"></i> Fiche stock</a>
            </li>
            <?php }?>
            <?php if (in_array('PARART',$_SESSION['actions']['code_actions'])){?>
            <li>
                <a href="#"><strong> Parametrage</span></strong></a>
            </li>
            <li>
                <a href="familles_view.php">&nbsp;&nbsp;&nbsp;<i class="fa fa-star fa-fw"></i> Famille</a>
            </li>
             <li>
                <a href="sous_familles_view.php">&nbsp;&nbsp;&nbsp;<i class="fa fa-star fa-fw"></i> Sous-famille</a>
            </li>
            <li>
                <a href="produit_view.php">&nbsp;&nbsp;&nbsp;<i class="fa fa-photo fa-fw"></i> Produits</a>
            </li>
            <?php }?>
            
            
            
            <!-- Menu parametrage-->
            
            <?php 
            if (isset($_GET['module'])) {
            if ($_GET['module']=='heberge' || $_GET['module']=='MC' || $_GET['module']=='MS') {
            ?>
            
            <?php if (in_array('CCH',$_SESSION['actions']['code_actions']) || in_array('CMIH',$_SESSION['actions']['code_actions'])||$_SESSION['type_user']==1){?>
            
            <li>
                <a  href="../REC/gg_consultation_hotel.php?module=MS"><i class="fa fa-bank fa-fw"></i> Site</a>
            </li>
            <?php }?>

            <?php if (in_array('CAU',$_SESSION['actions']['code_actions'])||in_array('CMU',$_SESSION['actions']['code_actions'])||in_array('CSU',$_SESSION['actions']['code_actions'])||in_array('CVU',$_SESSION['actions']['code_actions'])||$_SESSION['type_user']==1){?>

            <li>
                <a href="#"><i class="fa fa-users fa-fw"></i> Utilisateurs<span class="fa arrow"></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="../REC/groupe_utilisateur_form.php?module=MS">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Groupes d'accès</a>
                    </li>
                    <li>
                        <a href="../REC/gl_liste_utilisateur.php?module=MS">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Utilisateurs</a>
                    </li>
                    <li>
                        <a href="../REC/affectation_droit_acces.php?module=MS">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Affectation droit d'accès</a>
                    </li>
                    <li>
                        <a href="../REC/monotoring_user.php?module=MS">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Monotoring</a>
                    </li>
                </ul>
            </li>
            <?php }?>
            <?php if (in_array('CVP',$_SESSION['actions']['code_actions'])||in_array('CAP',$_SESSION['actions']['code_actions'])||in_array('CSP',$_SESSION['actions']['code_actions'])||in_array('CMP',$_SESSION['actions']['code_actions'])||$_SESSION['type_user']==1){?>
            <?php
//            if (isset($_GET['config'])) {
            ?>
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Partenaire<span class="fa arrow"></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="../REC/gg_liste_partenaire.php?module=MS">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Partenaire</a>
                    </li>
                    <li>
                        <a href="../REC/affectation_pactenaire_hotel.php?module=MS">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Affectation Partenaire</a>
                    </li>
                </ul>
            </li>
            <?php // }?>
            <?php }?>
            <?php if (in_array('CDT',$_SESSION['actions']['code_actions']) || in_array('CDM',$_SESSION['actions']['code_actions'])||$_SESSION['type_user']==1){?>
            <?php
//            if (isset($_GET['config'])) {
            ?>
            <li>
                <a  href="../REC/reglage_view.php?module=MS"><i class="fa fa-wrench fa-fw"></i> Réglage<!--<span class="fa arrow"></span>--></a>
            </li>
            <?php // }?>
            <?php }?>
            
            <?php if (in_array('CCC',$_SESSION['actions']['code_actions']) || in_array('CMC',$_SESSION['actions']['code_actions'])||$_SESSION['type_user']==1){?>
            
            <?php 
            if (isset($_GET['module'])) {
            if ($_GET['module']=='heberge' || $_GET['module']=='MC' || $_GET['module']=='MS') {
            ?>
            <li>
                <a  href="#"><i class="fa fa-cog fa-fw"></i> <b>Parametrage module</b><!--<span class="fa arrow"></span>--></a>
            </li>
            <?php 
            }
                }?>
            
            <?php 
            if (isset($_GET['module'])) { ?>
            <?php if ($_GET['module']=='heberge') { ?>
            <li>
                <a href="#">&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<i class="fa fa-bed fa-fw"></i> Hébergement<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="ajout_niveau.php">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Niveaux</a>
                    </li>
                    <li>
                        <a href="ajout_categorie.php">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Categories</a>
                    </li>
                    <li>
                        <a href="liste_chambre.php">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Chambres</a>
                    </li>
                </ul>
            </li>
            <?php }?>
            <?php if ($_GET['module']=='MC') { ?>
            <li>
                <a href="#">&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<i class="fa fa-money fa-fw"></i> Caisse<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="../Caisse/motif_view.php?module=MC">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Identification motif</a>
                    </li>
                </ul>
            </li>
            <?php }?>
            <?php if ($_GET['module']=='MS') { ?>
            <li>
                <a href="#">&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<i class="fa fa-dropbox fa-fw"></i> Stock<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="familles_view.php?module=MS"><i class="fa fa-star fa-fw"></i> Famille produits</a>
                    </li>
                    <li>
                        <a href="sous_familles_view.php?module=MS"><i class="fa fa-star fa-fw"></i> Sous-famille produits</a>
                    </li>
                    <li>
                        <a href="produit_view.php?module=MS"><i class="fa fa-photo fa-fw"></i> Produits</a>
                    </li>
                </ul>
            </li>
            <?php }?>
            <?php }?>
            <?php }?>
            
            <?php 
            }
                }?>
            <!-- Fin Menu parametrage-->
            
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
<?php include('Rapport/liste_produit_famille.php'); ?>
