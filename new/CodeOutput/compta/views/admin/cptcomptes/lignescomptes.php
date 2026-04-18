<?php 
$nbre=count($_SESSION['Comptes']['numero']);
for ($i = 0; $i <$nbre; $i++){
    $id=$_SESSION['Comptes']['id'][$i];
    $numero=$_SESSION['Comptes']['numero'][$i];
    $nom=$_SESSION['Comptes']['nom'][$i];
    $classe=$_SESSION['Comptes']['classe'][$i];
    $modif=$_SESSION['Comptes']['modif'][$i];
?> 
<tr>
    <!--<td><?php // echo $i; ?></td>-->
    <td><?php echo $numero ; ?></td>
    <td><?php echo $nom; ?></td>
    <td><?php echo  strtolower($classe); ?></td>
    <td class="table-actions">
        <?php if($modif==1){ 
        $data=DataSubAccount($id,$bdd);
       // var_dump($data);
        $id=$data['idsouscpt'];
        $nom=$data['libsouscpte'];
        $numero=$data['sufxesouscpte'];
        $idcpt=$data['idcpt'];
        $libcpt=$data['libcpt'];
        $numcpt=$data['numcpt'];
        $idcat=$data['idcat'];
        $libcat=$data['libcat'];
        $numcat=$data['numcat'];
        ?>
            <div class="btn-group">
                <a data-toggle="modal" data-target="#modalUpdateSubAccount" id="<?php echo $id;?>" numero="<?php echo $numero;?>" nom="<?php echo $nom;?>" classe="<?php echo $classe;?>" idcpt="<?php echo $idcpt;?>" libcpt="<?php echo $libcpt;?>" numcpt="<?php echo $numcpt;?>" libcat="<?php echo $libcat;?>" class="btn btn-primary btn-xs btnpopupdtSubAcount"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>
                <a id="<?php echo $id;?>" class="btn btn-danger btn-xs delsubaccount"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>
            </div>
        <?php }?> 
    </td>
</tr>
<?php }?> 