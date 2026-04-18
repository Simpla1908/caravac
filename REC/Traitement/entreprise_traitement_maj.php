<?php
include('../../bdd/connexion.php');
$entreprise = $_POST['nom_site'];
$adresse = $_POST['adresse'];
$phone = $_POST['phone'];
$rccm = $_POST['rccm'];
$num_impot = $_POST['num_impot'];
$ville = $_POST['ville'];
$mail = $_POST['mail'];
$id_nat = $_POST['id_nat'];
$id_c = $_POST['company_id'];
$user_id = $_POST['id_user'];
$id_site = $_POST['id_site'];
$xlogo = $_POST['xlogo'];
if (empty($adresse) ||empty($phone) ||empty($rccm) ||empty($num_impot) ||empty($ville) ||empty($mail) ||empty($id_nat)) {
    header('Location: ../reglage_view.php?bd=yes&msg=vide');
} else {
    //selection nom_company
    $requete = $bdd->prepare("SELECT nom_c FROM  t_company  WHERE id_c=:company_id");
    $requete->BindParam(':company_id', $id_c);
    $requete->execute();
    $company_nom = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($company_nom as $c) $nom_c = $c->nom_c;
    //upoload logo
    //$extension= pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
    if (is_uploaded_file($_FILES['logo']['tmp_name'])) {
        $file_name = $_FILES['logo']['name'];
        $extension = strrchr($file_name, ".");
        move_uploaded_file($_FILES['logo']['tmp_name'], '../images/logo_entreprise/' . basename($_FILES['logo']['name']));
        $stocklogo = 'logo_' . $nom_c . $id_c . $extension;
        rename('../images/logo_entreprise/' . basename($_FILES['logo']['name']), '../images/logo_entreprise/' . $stocklogo);
    } else {
        $stocklogo = $xlogo;
    }
    //mise a jour des donnees de session
    $_SESSION['entreprise'] = $entreprise;
    $_SESSION['adresse'] = $adresse;
    $_SESSION['phone'] = $phone;
    $_SESSION['rccm'] = $rccm;
    $_SESSION['num_impot'] = $num_impot;
    $_SESSION['ville'] = $ville;
    $_SESSION['mail'] = $mail;
    $_SESSION['id_nat'] = $id_nat;
    $_SESSION['stocklogo'] = $stocklogo;
    $_SESSION['id_site'] = $id_site;
    //mise a jour table company
    $requete = $bdd->prepare("UPDATE t_company SET adresse_c=:adresse_c,logo=:logo,idnat=:idnat,rccm=:rccm,mail_company=:mail_company,ville=:ville,phone=:phone,num_impot=:num_impot,cb=:cb WHERE id_c=:id_c");
    $requete->BindParam(':adresse_c', $adresse);
    $requete->BindParam(':logo', $stocklogo);
    $requete->BindParam(':idnat', $id_nat);
    $requete->BindParam(':rccm', $rccm);
    $requete->BindParam(':mail_company', $mail);
    $requete->BindParam(':ville', $ville);
    $requete->BindParam(':phone', $phone);
    $requete->BindParam(':num_impot', $num_impot);
    $requete->BindParam(':cb', $cb);
    $requete->BindParam(':id_c', $id_c);
    $requete->execute();
    
    //mise a jour table site
    $requete = $bdd->prepare("UPDATE t_hotel SET nom_hotel=:nom_hotel,adresse_hotel=:adresse_hotel,ville_hotel=:ville_hotel,idnat=:idnat,rccm=:rccm,mail=:mail,phone=:phone,num_impot=:num_impot,cb=:cb,image=:image WHERE id_hotel=:id_hotel");
    $requete->BindParam(':nom_hotel', $entreprise);
    $requete->BindParam(':adresse_hotel', $adresse);
    $requete->BindParam(':ville_hotel', $ville);
    $requete->BindParam(':idnat', $id_nat);
    $requete->BindParam(':rccm', $rccm);
    $requete->BindParam(':mail', $mail);
    $requete->BindParam(':phone', $phone);
    $requete->BindParam(':num_impot', $num_impot);
    $requete->BindParam(':cb', $cb);
    $requete->BindParam(':image', $stocklogo);
    $requete->BindParam(':id_hotel', $id_site);
    $requete->execute();
    header('Location: ../reglage_view.php?bd=yes&msg=succes');
}

