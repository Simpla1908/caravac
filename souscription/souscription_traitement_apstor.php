    <?php
        session_start();
 include('../bdd/connexion.php');
        $json = array();
        if (isset($_POST["modules"])){
        //insertion module selectionne dans session
        $_SESSION['souscri']['module'] = array();
        $_SESSION['souscri']['module_nom'] = array();
        $_SESSION['souscri']['users'] = array();
        $_SESSION['souscri']['licence'] = array();
        $_SESSION['souscri']['prix'] = array();
        $N = count($_POST["modules"]);
        for ($i = 0; $i < $N; $i++) {
        $idmodule=$_POST["modules"][$i];
        $module_nom="modules_nom".$idmodule;
        $users="users".$idmodule;
        $licence="licence".$idmodule;
        $prix=$_POST["prix".$idmodule];
            if($idmodule==22){
                //on met les donnees du module stock en session
                $idmodule_stock=24;
                $module_nom_stock="stock";
                $users_stock=3;
                $licence_stock=$_POST[$licence];
                //calcul prix module stock
                $requete = $bdd->prepare("SELECT prix_user FROM  prix WHERE module_id=:module AND souscription=:souscription");
                $requete->BindParam(':module',$idmodule_stock);
                $requete->BindParam(':souscription',$licence_stock);
                $requete->execute();
                $prix_requette= $requete->fetchAll(PDO::FETCH_OBJ);
                foreach ($prix_requette as $p) $prix_stock = $p->prix_user;
                //echo '$prix_stock:'.$prix_stock;

                array_push($_SESSION['souscri']['module'],$idmodule_stock);
                array_push($_SESSION['souscri']['module_nom'],$module_nom_stock);
                array_push($_SESSION['souscri']['users'],$users_stock);
                array_push($_SESSION['souscri']['licence'],$licence_stock);
                array_push($_SESSION['souscri']['prix'],$prix_stock);
                //modification prix resto
                $prix=$prix-$prix_stock;
                //echo 'prix:'.$prix;
            }
            array_push($_SESSION['souscri']['module'],$idmodule);
            array_push($_SESSION['souscri']['module_nom'],$_POST[$module_nom]);
            array_push($_SESSION['souscri']['users'],$_POST[$users]);
            array_push($_SESSION['souscri']['licence'],$_POST[$licence]);
            array_push($_SESSION['souscri']['prix'],$prix);

        }
        $json['message_succes']='succes';
            echo json_encode($json);
        }
        else{
            $json['message_vide']='videmodule';
            echo json_encode($json);
        }
