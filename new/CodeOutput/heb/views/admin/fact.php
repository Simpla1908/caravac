

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
 <li><a href="<?php echo H_ADMIN; ?>&view=t_client&do=pl"><i class="fa fa-users"></i>Planning</a></li>
<?php if (in_array('FAFACTN', $_SESSION['actions']['code_actions'])||in_array('FAFACTP', $_SESSION['actions']['code_actions'])) { ?>

<li class="treeview">
    <a href="#">
        <i class="fa fa-file-text-o"></i> <span>Facture</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
       <?php if (in_array('FAFACTN', $_SESSION['actions']['code_actions'])) { ?>
        <li><a href="<?php echo H_ADMIN; ?>&view=t_facture&do=viewall&f=1"><i class="fa fa-circle-o"></i> Normale</a></li>
        <?php  } ?>
        <?php if (in_array('FAFACTP', $_SESSION['actions']['code_actions'])) { ?>
        <li><a href="<?php echo H_ADMIN; ?>&view=t_facture&do=viewall&f=0"><i class="fa fa-circle-o"></i> Proforma</a></li>
        <?php  } ?>

    </ul>
</li>
 <?php  } ?>
 <?php if (in_array('FAPAIE', $_SESSION['actions']['code_actions'])||in_array('FALPAIE', $_SESSION['actions']['code_actions'])||in_array('FAXTVA', $_SESSION['actions']['code_actions'])||in_array('FAXCPT', $_SESSION['actions']['code_actions'])) { ?>

<li class="treeview">
    <a href="#">
        <i class="fa fa-money"></i> <span>Paiements</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <?php if (in_array('FAPAIE', $_SESSION['actions']['code_actions'])) { ?>
        <li><a href="<?php echo H_ADMIN; ?>&view=paiement&do=add"><i class="fa fa-circle-o"></i> Payer</a></li>
        <?php  } ?>
        <?php if (in_array('FALPAIE', $_SESSION['actions']['code_actions'])) { ?>
        <li><a href="<?php echo H_ADMIN; ?>&view=paiement&do=viewall"><i class="fa fa-circle-o"></i> Liste</a></li>
        <?php  } ?>
         <?php if (in_array('FAXTVA', $_SESSION['actions']['code_actions'])) { ?>
        <li><a href="<?php echo H_ADMIN; ?>&view=paiement&do=extraittva"><i class="fa fa-circle-o"></i> Extrait TVA</a></li>
        <?php  } ?>

         <?php if (in_array('FAXCPT', $_SESSION['actions']['code_actions'])) { ?>
        <li><a href="<?php echo H_ADMIN; ?>&view=paiement&do=extraitcompte"><i class="fa fa-circle-o"></i> Extrait de compte</a></li>
        <?php  } ?>
    </ul>
</li>
 <?php  } ?>
   <?php if (in_array('FAGCLT', $_SESSION['actions']['code_actions'])) { ?>
   <li><a href="<?php echo H_ADMIN; ?>&view=t_client&do=viewall"><i class="fa fa-users"></i>Clients</a></li>
   <?php  } ?>
<?php if (in_array('FAGART', $_SESSION['actions']['code_actions'])) { ?>

  <li><a href="<?php echo H_ADMIN; ?>&view=stk_produit&do=viewall"><i class="fa  fa-circle-o"></i>Articles</a></li>
    <?php  } ?>
<?php if (in_array('FACONFIG', $_SESSION['actions']['code_actions'])) { ?>
    <li class="treeview">
    <a href="#">
        <i class="fa fa-cogs"></i> <span>Configurations</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
            <li><a href="<?php echo H_ADMIN; ?>&view=facconfig&id=<?php echo $_SESSION['config_id']; ?>&do=details"><i class="fa fa-cog"></i>Configurations de base</a></li>
            <li><a href="<?php echo H_ADMIN; ?>&view=facconditionpaie&do=viewall"><i class="fa fa-cog"></i>Conditions de paiement</a></li>
    </ul>
</li>
<?php }?>
