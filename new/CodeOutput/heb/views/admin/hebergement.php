<li class="treeview">
    <a href="#">
        <i class="fa fa-dashboard"></i> <span>Tableau de bord</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <!--<li class="active"><a href="<?php // echo H_ADMIN; 
                                        ?>&view=module&do=heb2"><i class="fa fa-circle-o"></i> Hébergement</a></li>-->
        <?php if (in_array('HVTBP', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
            <li><a href="../../REC/tableaudebordRec.php"><i class="fa fa-circle-o"></i> Accueil</a></li>
        <?php } ?>
    </ul>
</li>
<?php if (in_array('HVPL1', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
    <li><a href="<?php echo H_ADMIN; ?>&view=module&do=heb2"><i class="fa fa-calendar"></i> Planning</a></li>
<?php } ?>
<?php if (in_array('HDTV', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
    <li><a <a href="<?php echo H_ADMIN; ?>&view=t_chambre_histo&do=viewall"><i class="fa fa-file-text"></i> Détails vente</a></li>
<?php } ?>
<?php if (in_array('VR', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
    <li><a href="<?php echo H_ADMIN; ?>&view=t_reservation&do=factall"><i class="fa fa-file-text-o"></i> Factures</a></li>
<?php } ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-money"></i>Caisse</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
          <?php if ($_SESSION['type_user'] == 1) { ?>
            <li><a <a href="<?php echo H_ADMIN; ?>&view=fondscaisse&do=viewall"><i class="fa fa-circle-o"></i> Fonds de caisse</a></li>
        <?php } ?>
        <?php if (in_array('VTRCT', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
            <li><a <a href="<?php echo H_ADMIN; ?>&view=t_reservation&do=recette"><i class="fa fa-circle-o"></i> Recettes</a></li>
        <?php } ?>
        <?php if (
            in_array('HENRVSM', $_SESSION['actions']['code_actions'])
            || in_array('HLTVMT', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1
        ) { ?>
            <li><a <a href="<?php echo H_ADMIN; ?>&view=t_versement&do=viewallheb"><i class="fa fa-circle-o"></i> Versement</a></li>
        <?php } ?>
      
    </ul>
</li>
<?php if (in_array('VLCLI', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
    <!--<li><a href="<?php echo H_ADMIN; ?>&view=t_client&do=viewall"><i class="fa fa-users"></i> Clients</a></li>-->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i> <span>Clients</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo H_ADMIN; ?>&view=t_client&do=viewall"><i class="fa fa-circle-o"></i> Liste</a></li>
            <li><a href="<?php echo H_ADMIN; ?>&view=t_client&do=occupation"><i class="fa fa-circle-o"></i> Occupations</a></li>
            <li><a href="<?php echo H_ADMIN; ?>&view=t_client&do=reservation"><i class="fa fa-circle-o"></i> Réservations</a></li>
            <!-- <li><a href="<?php //echo H_ADMIN; 
                                ?>&view=t_client&do=res_online"><i class="fa fa-circle-o"></i> Réservations Online</a></li> -->
            <li><a href="<?php echo H_ADMIN; ?>&view=t_client&do=liberation"><i class="fa fa-circle-o"></i> Liberations</a></li>
            <li><a href="<?php echo H_ADMIN; ?>&view=t_client&do=fiche"><i class="fa fa-circle-o"></i>Fiche client</a></li>
        </ul>
    </li>
<?php } ?>
<?php if (in_array('HFCT', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-cogs"></i> <span>Configurations</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo H_ADMIN; ?>&view=categorie_chambre&do=viewall"><i class="fa fa-circle-o"></i> Catégories</a></li>
            <!-- <li><a href="<?php echo H_ADMIN; ?>&view=categorie_chambre&do=viewall_details"><i class="fa fa-circle-o"></i> Détail Catégories</a></li> -->
            <!-- <li><a href="<?php echo H_ADMIN; ?>&view=categorie_chambre&do=viewall_images"><i class="fa fa-circle-o"></i> Images Slider</a></li> -->
            <li><a href="<?php echo H_ADMIN; ?>&view=t_chambre&do=viewall&c=1"><i class="fa fa-circle-o"></i> Chambres</a></li>
            <li><a href="<?php echo H_ADMIN; ?>&view=t_chambre&do=viewall2"><i class="fa fa-circle-o"></i> Services</a></li>
            <li><a href="<?php echo H_ADMIN; ?>&view=t_responsable&do=viewall"><i class="fa fa-circle-o"></i> Partenaires</a></li>
            <li><a href="<?php echo H_ADMIN; ?>&view=facconfig&id=23&do=details2"><i class="fa fa-circle-o"></i> Réglage </a></li>
            <li><a href="<?php echo H_ADMIN; ?>&view=t_hotel&do=update&id_hotel=<?php echo $_SESSION['idsite']; ?>"><i class="fa fa-circle-o"></i> Termes & Conditions </a></li>
        </ul>
    </li>
<?php } ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-th fa-fw"></i> <b>Modules</b>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <?php if (in_array('VMC', $_SESSION['actions']['code_actions'])) { ?>
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=module&do=compta">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Comptabilité</a>
            </li>
        <?php } ?>
        <?php if (in_array('VMS', $_SESSION['actions']['code_actions'])) { ?>
            <li>
                <a href="../../Stock2/index.php">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Stock</a>
            </li>
        <?php } ?>
        <?php if (in_array('VMH', $_SESSION['actions']['code_actions'])) { ?>
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=module&do=heb2">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Hebergement</a>
            </li>
        <?php } ?>
        <?php if (in_array('VRH', $_SESSION['actions']['code_actions'])) { ?>
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=module&do=rh">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Ress. Humaines</a>
            </li>
        <?php } ?>
        <?php if (in_array('VMACH', $_SESSION['actions']['code_actions'])) { ?>
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=module&do=achat">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Achat</a>
            </li>
        <?php } ?>
        <?php if (in_array('VMFACT', $_SESSION['actions']['code_actions'])) { ?>
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=module&do=fact">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Facturation</a>
            </li>
        <?php } ?>
        <?php if (in_array('VMR', $_SESSION['actions']['code_actions'])) { ?>
            <li>
                <a href="../../restaurant2/index.php">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Restaurant</a>
            </li>
        <?php } ?>
        <?php if (in_array('VMPOS', $_SESSION['actions']['code_actions'])) { ?>
            <li>
                <a href="../../pos/index.php">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> POS</a>
            </li>
        <?php } ?>
    </ul>
</li>