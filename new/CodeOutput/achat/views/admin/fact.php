

<li class="treeview">
    <a href="#">
        <i class="fa fa-dashboard"></i> <span>Tableau de bord</span> 
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="active"><a href="<?php echo H_ADMIN;?>&view=module&do=fact"><i class="fa fa-circle-o"></i> Facturation</a></li>
        <li><a href="../../REC/tableaudebordRec.php"><i class="fa fa-circle-o"></i> Accueil</a></li>
    </ul>
</li>


<?php // if (in_array('RHGPAIE', $_SESSION['actions']['code_actions'])) { ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-file-text-o"></i> <span>Facture</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo H_ADMIN; ?>&view=t_facture&do=add"><i class="fa fa-circle-o"></i>Normale</a></li>
         <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=add"><i class="fa fa-circle-o"></i>Proforma</a></li>
        <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=viewall"><i class="fa fa-circle-o"></i> Liste</a></li>
    </ul>
</li>
<?php // } ?>
<?php // if (in_array('RHGPAIE', $_SESSION['actions']['code_actions'])) { ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-money"></i> <span>Paiements</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=add"><i class="fa fa-circle-o"></i> Payer</a></li>
        <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=viewall"><i class="fa fa-circle-o"></i> Liste</a></li>
    </ul>
</li>
<?php // } ?>
<?php // if (in_array('RHGPAIE', $_SESSION['actions']['code_actions'])) { ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-dollar"></i> <span>Caisse</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=add"><i class="fa fa-circle-o"></i> Entrée</a></li>
        <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=viewall"><i class="fa fa-circle-o"></i> Sortie</a></li>
        <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=viewall"><i class="fa fa-circle-o"></i> Journal</a></li>
    </ul>
</li>
<?php // } ?>
<?php // if (in_array('RHLE', $_SESSION['actions']['code_actions'])|| in_array('RHMIE', $_SESSION['actions']['code_actions'])) { ?>
            <li><a href="<?php // echo H_ADMIN; ?>&view=resemployes&do=viewall"><i class="fa fa-users"></i>Clients</a></li>
<?php // } ?>
 <?php // if (in_array('RHGPOINT', $_SESSION['actions']['code_actions'])) { ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-edit"></i> <span>Articles</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php // echo H_ADMIN; ?>&view=respointage&do=add"><i class="fa fa-circle-o"></i> Produits</a></li>
        <li><a href="<?php // echo H_ADMIN; ?>&view=respointage&do=vld"><i class="fa fa-circle-o"></i> Services</a></li>
       <li><a href="<?php // echo H_ADMIN; ?>&view=respointage&do=vld"><i class="fa fa-circle-o"></i> Catégories</a></li>
       <li><a href="<?php // echo H_ADMIN; ?>&view=respointage&do=vld"><i class="fa fa-circle-o"></i> Familles</a></li>
    </ul>
</li>
<?php // } ?>
<?php // if (in_array('RHFCONF', $_SESSION['actions']['code_actions'])) { ?>
 <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=viewall"> <i class="fa fa-cog"></i> Configuration</a></li>
<?php // }?>
