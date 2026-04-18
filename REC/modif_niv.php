<?php include('Gerant_local.php'); ?>
<?php include('headerRec.php'); ?>
<?php include('menu_Rec_config.php');
if (isset($_POST['sauvegarder'])) {

    if($_POST['lib_n']!=''){
        include './verif_dblon_niv.php';
        $id_niv = $_POST['id_niv'];
        $lib_n = $_POST['lib_n'];
        $lib_a= $_POST['lib_a'];
        $id_hotel=$_SESSION['id_hotel'];
        $existe=pas_doublon_niv2($lib_a,$lib_n);
        if($existe==0){
            $niv = new niveau($lib_n,$id_hotel);
            $niv->majniveau($id_niv);
            echo "<script src='datepicker/jquery.js'></script>
<script>
$(document).ready(function () {
$('#msg').show().fadeOut(6000);

});
</script>";
        }else{
            echo "<script src='datepicker/jquery.js'></script>
<script>
$(document).ready(function () {
$('#msg_text11').text('ce libellé ".$lib_n." existe déjà');
$('#msg11').show();

});
</script>";
        }

    }else{
        echo "<script src='datepicker/jquery.js'></script>
<script>
$(document).ready(function () {
$('#msg1').show().fadeOut(6000);

});
</script>";
    }
}
if(isset($_GET['id_niv'])){
    $id_niv=$_GET['id_niv'];
    $result=mysql_query("SELECT n.lib_niv_cha FROM niveau_chambre n WHERE n.id_niv_cha='$id_niv'") or die(mysql_error());
    while($rows=mysql_fetch_assoc($result))
        $lib_niv_cha=$rows['lib_niv_cha'];
}

?>
<div id="page-wrapper">
<div class="row">
<div class="col-lg-12">
<h3 class="page-header">Niveau ou Etage des chambres</h3>
<div class="panel panel-default">
<div class="panel-heading">
<h4>
Modifier niveau
<div class="btn-group  btn-group-sm pull-right">
<a href="liste_niveau.php?module=MH" class="btn btn-default" title="Afficher tous les niveaux"><i class="fa fa-list"></i> Voir</a>
</div>
</h4>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
<BR>

<div id="msg" class="alert alert-success alert-dismissable" style="display:none;">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<span>La modification est effectuée avec succès!</span>
</div>
<div id="msg1" class="alert alert-danger alert-dismissable" style="display:none;">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<span id="msg_text">Veuillez remplir tous les champs!</span>
</div>
<div id="msg11" class="alert alert-danger alert-dismissable" style="display:none;">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<span id="msg_text11">Veuillez remplir tous les champs!</span>
</div>
    <form method="post"  action="modif_niv.php?module=MH&id_niv=<?php echo $id_niv;?>"  data-parsley-validate class="form-horizontal form-label-left">
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Libelle <span class="required">*</span>
</label>
<div class="col-md-6 col-sm-6 col-xs-12">
    <input type="hidden" id="id_niv" name="id_niv"  class="form-control col-md-7 col-xs-12" value="<?php echo $id_niv;?>">
    <input type="text" id="lib_n" name="lib_n"  class="form-control col-md-7 col-xs-12" value="<?php echo $lib_niv_cha;?>">
    <input type="hidden" id="lib_a" name="lib_a"  class="form-control col-md-7 col-xs-12" value="<?php echo $lib_niv_cha;?>">
</div>
</div>

<div class="ln_solid"></div>
<div class="form-group">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
<!--<button type="submit" class="btn btn-primary">Cancel</button>-->
<button type="submit" name="sauvegarder" class="btn btn-success">Sauvegarder</button>
</div>
</div>

</form>
</div>
<!-- /.panel-body -->
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include('gl_footer.php'); ?>
