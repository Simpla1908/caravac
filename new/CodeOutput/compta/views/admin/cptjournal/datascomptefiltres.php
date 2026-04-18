  <input id="compte_id" name="compte_id" type="hidden" value="">
  <input id="compte_id2" name="compte_id2" type="hidden" value="">
  <select id="selectcompte" name="selectcompte" class="form-control choz">
      <?php
      $nbre=count($_SESSION['Comptes']['numero']);
      for ($i = 0; $i <$nbre; $i++){
      $id=$_SESSION['Comptes']['id'][$i];
      $numero=$_SESSION['Comptes']['numero'][$i];
      $nom=$_SESSION['Comptes']['nom'][$i];
      $classe=$_SESSION['Comptes']['classe'][$i];
      $cat=$_SESSION['Comptes']['categorie_id'][$i];
      $compt=$_SESSION['Comptes']['compte_id'][$i];
      $modif=$_SESSION['Comptes']['modif'][$i];
        ?>
        <option value="<?php echo $id; ?>" cat="<?php echo $cat; ?>" compt="<?php echo $compt; ?>" num="<?php echo $numero; ?>"><?php echo ucfirst($numero.' . '.$nom); ?></option>
      <?php 
                                   }
        ?>
  </select>