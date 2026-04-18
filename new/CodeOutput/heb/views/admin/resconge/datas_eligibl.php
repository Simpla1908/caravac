   <?php
   $site_id=$_SESSION['idsite'];
     $requete = 'SELECT * FROM  resemploye_eligibl WHERE site_id=:site_id';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':site_id',$site_id);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
   $i=1;
    foreach ($result as $rows) {
        $id=$rows->id;
        $employe_id=$rows->employe_id;
        $noms_employe=$rows->noms_employe;
        $dteengag=$rows->dteengag;
        $dte=date('Y-m-d');
        $dte1=$rows->dte1;
        $dtecg=$rows->dtecg;
        $dte2=$rows->dte2;
        $nbrjcg=$rows->nbrjcg;
        if($dtecg==''){
        $nbrjcg=0;
        $nbrjcs=0;
        $nbrjrs=0;
        }else{
        $nbrjcs=NJrsCsnm($dtecg,$dte,$employe_id);
        $nbrjrs=$nbrjcg-$nbrjcs;   
        }

            if($dtecg!=''){
            if($nbrjcs>$nbrjcg){
                $nbrjrs=0;
             //update dte1 dans resemploye_eligibl 
            $dte_next=NextDateEngage($dte1);
            $query = HDB::hus()->prepare("UPDATE resemploye_eligibl SET dte1=:dte1,dtecg=NULL,dte2=NULL,nbrjcg=0 WHERE id=:id");
            $query->BindParam(':dte1', $dte_next);
            $query->BindParam(':id', $id);
            $query->execute();
            //fin update
            //recuperation donnée mis ajour
            $requete = 'SELECT dte1 FROM  resemploye_eligibl WHERE id=:id';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$id);
            try {
                $query->execute();
                $result1 = $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
             foreach ($result1 as $rows1) {
               $dte1=$rows1->dte1;

             }
            //fin
            }
              }
        $NJrsdte1dte=NJrs($dte1,$dte,$employe_id);
        //echo $NJrsdte1dte;
        //le 365 peut etre configuré
        if($NJrsdte1dte>=365){
   
        ?>
        <tr>
            <td><?php echo $i;?></td>
            <td><?php echo ucfirst($noms_employe);?></td>
            <td><?php echo dateAffiche($dteengag);?></td>
            <td><?php 
            if($dtecg!=''){
            echo 'Du '.dateAffiche($dtecg).' au '.dateAffiche($dte2);
            }
            ?></td>
             <td><?php echo $nbrjcg;?></td>
            <td><?php echo $nbrjcs;?></td>
             <td><?php echo $nbrjrs;?></td>
        </tr>
    <?php 
    $i++;
    }
    } 
    ?>

