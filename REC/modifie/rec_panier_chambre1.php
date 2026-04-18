<?php
require '_header.php';
?>
<h4 class="page-header">
	<div class="modal" id="infos_ch" style="width:800px; height:500px; background-color:#c2c1c1; margin:auto; border-radius:10px; color:#FFF;">
    <div class="modal-header"> 
    <a class="close" data-dismiss="modal">×</a>
    <h3>Liste des Chambres</h3>
    </div>
    <div class="modal-body">
    <p>
        <?php
			$req=$bd->prepare("SELECT DISTINCT id_ch, num_ch, tarif_ch FROM t_chambre");
			$req->execute();
			$chambres=$req->fetchAll(PDO::FETCH_OBJ);
			//var_dump($req->fetchAll(PDO::FETCH_OBJ));
			?>
		<form method="post" action="">
			<table width="200" border="0">
			  <tr>
				<td>n°</td>
				<td>nomChambre</td>
				<td>tarif</td>
				<!--<td>action</td>-->
				<td></td>
			  </tr>
			  <?php $i=1;foreach($chambres as $ch):?>
			  <tr>
				<td><?php echo $i?></td>
				<td><?php echo 'ch'.$ch->num_ch?></td>
				<td><?php echo $ch->tarif_ch?>$/nuit</td>
				<td><a class="add" href="php/addpanier.php?id=<?php echo $ch->id_ch?>">ajouter</a></td>
				<td><input name="case" type="checkbox" value="<?php echo $ch->id_ch?>"/></td>
			  </tr>
			  <?php $i++;endforeach;?>
			</table>
			<input class="form-control" type="submit" name="send" id="send" value="Ajouter"/>
		</form>
		
        
    </p>
    </div>
</div>
<a class="btn btn-primary" data-toggle="modal" href="#infos_ch" >Ajouter une chambre</a>
</h4>

<div style="margin-left:50px;">
	<?php require_once 'IHMpanier.php'?>
</div>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/script.js"></script>
<!--<script src="../js/jquery.js"></script>
<script type="text/javascript">-->
<!--//$(document).ready(function() {
//
//$('#send').click(function() {
//var send=$('#send').val();
//var tab=new Array();
//var inputs = document.getElementsByTagName('input'),
//inputsLength = inputs.length;
//for (var i = 0 ; i < inputsLength ; i++) {
//if (inputs[i].type == 'checkbox' && inputs[i].checked ) {
//tab.push(inputs[i].value);
//}
//}
//$.ajax({
//url:'traitement_id_chambre.php',
//async:true,
//type:'POST',
//data:"send="+send+"&tab[]="+tab, 
//global: false,
//cache: false,
//success: function(html){
//$("#t_chambre").append(html);
//}
//});
//
//return false;
//});
//});
//--><!--</script>-->