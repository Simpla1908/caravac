<?php
//tableau id module
$IDMODULES['module']['id'] = array();
$requete_module = $bdd->prepare("SELECT module_id FROM t_modulecompany WHERE site_id=:site_id");
$requete_module->BindParam(':site_id',$_GET['site']);
$requete_module->execute();
$requete_module= $requete_module->fetchAll(PDO::FETCH_OBJ);
foreach ($requete_module as $mod)array_push($IDMODULES['module']['id'],$mod->module_id);
?>
