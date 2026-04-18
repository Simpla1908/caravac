
<li class="treeview">
    <a href="#">
        <i class="fa fa-dashboard"></i> <span>Tableau de bord</span> 
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <!--<li class="active"><a href="<?php // echo H_ADMIN; ?>&view=module&do=heb2"><i class="fa fa-circle-o"></i> Hébergement</a></li>-->
        <?php if (in_array('HVTBP', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
        <li><a href="../../REC/tableaudebordRec.php"><i class="fa fa-circle-o"></i> Accueil</a></li>
        <?php } ?>
    </ul>
</li>

<?php if (in_array('ACHLEB', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
<li class="treeview">
    <a href="<?php echo H_ADMIN; ?>&view=t_facture&do=view_bon_cmd">
        <i class="fa fa-file-text"></i> <span>Etat de besoins</span>
    </a>
</li>
<?php } ?>
<?php if (in_array('ACHLBC', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
<li class="treeview">
    <a href="<?php echo H_ADMIN; ?>&view=t_facture&do=view_commande">
        <i class="fa fa-newspaper-o"></i> <span>Bon de commande</span>
    </a>
</li>
<?php } ?>
<?php if (in_array('ACHLPBC', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
<li class="treeview">
    <a href="<?php echo H_ADMIN; ?>&view=paiement&do=view_paiement">
        <i class="fa fa-tags"></i> <span>Paiement</span>
    </a>
</li>
<?php } ?>
<?php if (in_array('ACHLL', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
<li class="treeview">
    <a href="<?php echo H_ADMIN; ?>&view=ach_livraison&do=viewall">
        <i class="fa fa-truck"></i> <span>Livraison</span>
    </a>
</li>
<?php } ?>
<?php if (in_array('ACHLF', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
<li class="treeview">
    <a href="<?php echo H_ADMIN; ?>&view=t_client&do=viewall_ach">
        <i class="fa fa-user-times"></i> <span>Fournisseur</span>
    </a>
</li>
<li class="treeview">
    <a href="<?php echo H_ADMIN; ?>&view=t_client&do=extraitcompte">
        <i class="fa fa-user-times"></i> <span>Extrait de compte</span>
    </a>
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